<?php
include('navbar.php');
require_once('models/Rating.php');
require_once('models/Hospital.php');

// function getHospitalRatingRecommendation($conn, $userId)
// {

//     $results = $conn->query("SELECT * FROM rating");
//     $ratings = array();
//     while ($row = $results->fetch_assoc()) {
//         $ratings[] = array(
//             'hospital_id' => $row['hospital_id'],
//             'user_id' => $row['user_id'],
//             'rating_value' => $row['rating_value']
//         );
//     }

//     function pearson_correlation($ratings, $user1, $user2)
//     {
//         $common_items = array();
//         foreach ($ratings as $rating) {
//             if ($rating['user_id'] == $user1 || $rating['user_id'] == $user2) {
//                 $common_items[$rating['hospital_id']][] = $rating['rating_value'];
//             }
//         }

//         $n = count($common_items);
//         if ($n == 0) return 0;

//         $sum1 = array_sum($common_items[$user1]);
//         $sum2 = array_sum($common_items[$user2]);
//         $sum1Sq = array_sum(array_map(function ($x) {
//             return pow($x, 2);
//         }, $common_items[$user1]));
//         $sum2Sq = array_sum(array_map(function ($x) {
//             return pow($x, 2);
//         }, $common_items[$user2]));
//         $pSum = array_sum(array_map(function ($x, $y) {
//             return $x * $y;
//         }, $common_items[$user1], $common_items[$user2]));

//         $num = $pSum - ($sum1 * $sum2 / $n);
//         $den = sqrt(($sum1Sq - pow($sum1, 2) / $n) * ($sum2Sq - pow($sum2, 2) / $n));

//         if ($den == 0) return 0;

//         return $num / $den;
//     }

//     $target_user_id = $userId;

//     $target_ratings = array_filter($ratings, function ($rating) use ($target_user_id) {
//         return $rating['user_id'] == $target_user_id;
//     });
//     $target_hospital_ids = array_column($target_ratings, 'hospital_id');

//     $recommended_hospitals = array();
//     foreach ($ratings as $rating) {
//         if ($rating['user_id'] != $target_user_id && !in_array($rating['hospital_id'], $target_hospital_ids)) {
//             $recommended_hospitals[] = $rating['hospital_id'];
//         }
//     }

//     $hospitalIdsFiltered = [];
//     foreach ($recommended_hospitals as $hospital_id) {
//         if (!in_array($hospital_id, $hospitalIdsFiltered)) {
//             $hospitalIdsFiltered[] = $hospital_id;
//         }
//     }

//     foreach ($hospitalIdsFiltered as $hospital_id) {
//         $conn->query("DELETE FROM recommendation
//         WHERE user_id = '$target_user_id' AND hospital_id = '$hospital_id'");

//         $countQuery = "SELECT COUNT(*) AS count FROM recommendation WHERE user_id = '$target_user_id'";
//         $countResult = $conn->query($countQuery);
//         $countRow = $countResult->fetch_assoc();
//         $countRecommendations = $countRow['count'];
//         if ($countRecommendations >= 4) {
//             return;
//         }

//         $conn->query("INSERT INTO recommendation (user_id, hospital_id)
//         SELECT '$target_user_id', '$hospital_id'
//         FROM DUAL
//         WHERE NOT EXISTS (
//             SELECT 1
//             FROM recommendation
//             WHERE user_id = '$target_user_id' AND hospital_id = '$hospital_id'
//         )
//     ");
//     }
// }

$hospital = new Hospital($conn);

if ($userID) {
    $ratingObj = new Rating($conn);
    $ratingObj->getHospitalRatingRecommendation($userID);
}

?>

<div class="cards-rs">
    <div class="grid-3">
        <?php
        $hospitalIds = $hospital->getRecommendationHospitalIds($userID);
        $data = $hospital->getRecommendedAndOtherHospitals($userID, $hospitalIds);
        $recommendations = $data['recommendations'];
        $otherHospitals = $data['otherHospitals'];
        foreach ($recommendations as $row) :
        ?>
            <article class="information card-rs">
                <span class="tag">Rekomendasi Rumah Sakit</span>
                <span class="tag">
                    <i class="fa fa-star"></i>
                    <span><?= $row["rating"] ?></span>
                </span>
                <h2 class="title"><?= $row["name"] ?></h2>
                <p class="info"><?= $row["address"] ?>.</p>
                <p class="info">No Phone: <?= $row["phone"] ?>.</p>

                <a href="detail_rs.php?hospital_id=<?= $row["hospital_id"] ?>">
                    <button class="button mt-5">
                        Lihat Detail
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4v3z" fill="currentColor" />
                        </svg>
                    </button>
                </a>
            </article>
        <?php endforeach; ?>

        <?php
        // Menampilkan data rumah sakit biasa
        foreach ($otherHospitals as $row) :
        ?>
            <article class="information card-rs">
                <!-- Tambahkan logika atau tampilan yang sesuai untuk rumah sakit biasa -->
                <span class="tag">Rumah Sakit</span>
                <span class="tag">
                    <i class="fa fa-star"></i>
                    <span><?= $row["rating"] ?></span>
                </span>
                <h2 class="title"><?= $row["name"] ?></h2>
                <p class="info"><?= $row["address"] ?>.</p>
                <p class="info">No Phone: <?= $row["phone"] ?>.</p>

                <a href="detail_rs.php?hospital_id=<?= $row["hospital_id"] ?>">
                    <button class="button mt-5">
                        Lihat Detail
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4v3z" fill="currentColor" />
                        </svg>
                    </button>
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</div>



<?php
include('footer.php');
?>