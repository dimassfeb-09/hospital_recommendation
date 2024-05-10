<?php

class Hospital
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

    function getDetailHospital($hospitalId)
    {
        $query = "SELECT * FROM hospital WHERE hospital_id = $hospitalId";
        return $this->exec($query);
    }

    function getAllHospital()
    {
        $query = "SELECT * FROM hospital;";
        return $this->exec($query);
    }

    function getRatingHospital($hospitalId)
    {
        $query = "SELECT r.user_id, r.rating_value, r.comment, r.created_at, u.full_name
        FROM rating r
        JOIN user u ON r.user_id = u.user_id
        WHERE r.hospital_id = '$hospitalId'
        ORDER BY r.created_at ASC";
        return $this->exec($query);
    }

    function getDoctorHospital($hospitalId)
    {
        $query = "
            SELECT
                d.doctor_id as doctor_id,
                d.name AS doctor_name,
                d.specialization as specialization,
                d.phone as phone,
                h.hospital_id,
                h.name AS hospital_name
            FROM
                doctor d
                INNER JOIN doctor_hospital dh ON d.doctor_id = dh.doctor_id
                INNER JOIN hospital h ON dh.hospital_id = h.hospital_id
            WHERE
            h.hospital_id = '$hospitalId';
            ";

        return $this->exec($query);
    }

    function insertRatingHospital($hospitalId, $userId, $rate, $comment)
    {
        $query = "INSERT INTO rating(hospital_id, user_id, rating_value, comment) VALUES('$hospitalId', '$userId', '$rate', '$comment');";
        $result =  $this->exec($query);
        return $result ? true : false;
    }

    function insertHospital($name, $address, $phone, $email, $image, $website, $description)
    {
        $query = "INSERT INTO hospital (name, address, phone, email, image, website, description)
    VALUES ('$name', '$address', '$phone', '$email', '$image', '$website', '$description')";
        return $this->exec($query);
    }

    function updateHospital($hospitalId, $name, $address, $phone, $email, $image, $website, $description)
    {
        $query = "UPDATE hospital
              SET name='$name', address='$address', phone='$phone', email='$email', image='$image', website='$website', description='$description'
              WHERE hospital_id='$hospitalId'";
        return $this->exec($query);
    }

    function updateUserRatingHospital($hospitalId, $userId, $rate, $comment)
    {
        $query = "UPDATE rating SET rating_value = '$rate', comment = '$comment' WHERE hospital_id = '$hospitalId' AND user_id = '$userId'";
        $result =  $this->exec($query);
        return $result ? true : false;
    }


    function deleteHospital($hospitalId)
    {
        $query = "DELETE FROM hospital WHERE hospital_id = '$hospitalId'";
        return $this->exec($query);
    }


    function getRecommendationHospitalIds($userID)
    {
        $query = "SELECT hospital_id FROM recommendation WHERE user_id = '$userID'";
        $result = $this->exec($query);

        $hospitalIds = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hospitalIds[] = $row['hospital_id'];
            }
        }

        return $hospitalIds;
    }

    function getRecommendedAndOtherHospitals($userID, $hospitalIds)
    {
        $hospitalIdsString = implode(',', $hospitalIds);
        if ($hospitalIdsString) {
            $query = "SELECT h.hospital_id, h.name, h.address, h.phone, h.rating, r.user_id
        FROM hospital h
        LEFT JOIN recommendation r ON h.hospital_id = r.hospital_id AND r.user_id = '$userID'
        WHERE h.hospital_id IN ($hospitalIdsString) OR r.hospital_id IS NULL
        ORDER BY FIELD(h.hospital_id, $hospitalIdsString) DESC, h.rating DESC
        ";
        } else {
            $query = "SELECT * FROM hospital";
        }

        $result = $this->exec($query);

        $recommendations = [];
        $otherHospitals = [];

        while ($row = mysqli_fetch_assoc($result)) {
            // Memisahkan data rumah sakit rekomendasi dan biasa
            if (in_array($row["hospital_id"], $hospitalIds)) {
                $recommendations[] = $row;
            } else {
                $otherHospitals[] = $row;
            }
        }

        return [
            'recommendations' => $recommendations,
            'otherHospitals' => $otherHospitals
        ];
    }
}