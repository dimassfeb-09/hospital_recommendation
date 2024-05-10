<?php

class Rating
{

    var $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    private function exec($query)
    {
        return $this->conn->query($query);
    }


    function getRatingByHospitalAndUser($hospitalId, $userId)
    {
        $query = "SELECT * FROM rating WHERE hospital_id = '$hospitalId' AND user_id = '$userId' LIMIT 1";
        return $this->exec($query);
    }

    function getUserRating($userId)
    {
        $query = "SELECT * FROM rating WHERE user_id = '$userId'";
        return $this->exec($query);
    }

    function calculateAverageRating($hospitalId)
    {
        $query = "SELECT AVG(rating_value) AS average_rating, COUNT(*) AS num_ratings FROM rating WHERE hospital_id = '$hospitalId'";
        $result = $this->exec($query);
        while ($row = $result->fetch_assoc()) {
            $average_rating = $row['average_rating'];
            $num_ratings = $row['num_ratings'];
        }

        $queryUpdateRating = "UPDATE hospital SET rating = '$average_rating', num_ratings = '$num_ratings' WHERE hospital_id = '$hospitalId'";
        $this->exec($queryUpdateRating);
    }

    function updateRating($ratingId, $newRating, $comment)
    {
        $query = "UPDATE rating SET rating_value = '$newRating', comment = '$comment' WHERE rating_id = '$ratingId'";
        return $this->exec($query);
    }

    function insertRating($hospitalId, $userId, $rate, $comment)
    {
        $query = "INSERT INTO rating (hospital_id, user_id, rating_value, comment) VALUES ('$hospitalId', '$userId', '$rate', '$comment')";
        return $this->exec($query);
    }

    function getHospitalRatingRecommendation($userId)
    {
        $query = "SELECT * FROM rating";
        $results = $this->exec($query);
        $ratings = array();
        while ($row = $results->fetch_assoc()) {
            $ratings[] = array(
                'hospital_id' => $row['hospital_id'],
                'user_id' => $row['user_id'],
                'rating_value' => $row['rating_value']
            );
        }

        function pearson_correlation($ratings, $user1, $user2)
        {
            $common_items = array();
            foreach ($ratings as $rating) {
                if ($rating['user_id'] == $user1 || $rating['user_id'] == $user2) {
                    $common_items[$rating['hospital_id']][] = $rating['rating_value'];
                }
            }

            $n = count($common_items);
            if ($n == 0) return 0;

            $sum1 = array_sum($common_items[$user1]);
            $sum2 = array_sum($common_items[$user2]);
            $sum1Sq = array_sum(array_map(function ($x) {
                return pow($x, 2);
            }, $common_items[$user1]));
            $sum2Sq = array_sum(array_map(function ($x) {
                return pow($x, 2);
            }, $common_items[$user2]));
            $pSum = array_sum(array_map(function ($x, $y) {
                return $x * $y;
            }, $common_items[$user1], $common_items[$user2]));

            $num = $pSum - ($sum1 * $sum2 / $n);
            $den = sqrt(($sum1Sq - pow($sum1, 2) / $n) * ($sum2Sq - pow($sum2, 2) / $n));

            if ($den == 0) return 0;

            return $num / $den;
        }

        $target_user_id = $userId;

        $target_ratings = array_filter($ratings, function ($rating) use ($target_user_id) {
            return $rating['user_id'] == $target_user_id;
        });
        $target_hospital_ids = array_column($target_ratings, 'hospital_id');

        $recommended_hospitals = array();
        foreach ($ratings as $rating) {
            if ($rating['user_id'] != $target_user_id && !in_array($rating['hospital_id'], $target_hospital_ids)) {
                $recommended_hospitals[] = $rating['hospital_id'];
            }
        }

        $hospitalIdsFiltered = [];
        foreach ($recommended_hospitals as $hospital_id) {
            if (!in_array($hospital_id, $hospitalIdsFiltered)) {
                $hospitalIdsFiltered[] = $hospital_id;
            }
        }

        foreach ($hospitalIdsFiltered as $hospital_id) {
            $query = "DELETE FROM recommendation WHERE user_id = '$target_user_id' AND hospital_id = '$hospital_id'";
            $this->exec($query);

            $query = "SELECT COUNT(*) AS count FROM recommendation WHERE user_id = '$target_user_id'";
            $countResult = $this->exec($query);;
            $countRow = $countResult->fetch_assoc();
            $countRecommendations = $countRow['count'];
            if ($countRecommendations >= 4) {
                return;
            }

            $query = "INSERT INTO recommendation (user_id, hospital_id)
            SELECT '$target_user_id', '$hospital_id'
            FROM DUAL
            WHERE NOT EXISTS (
                SELECT 1
                FROM recommendation
                WHERE user_id = '$target_user_id' AND hospital_id = '$hospital_id'
            )
        ";
            $this->exec($query);
        }
    }
}
