<?php
require('../config.php');

// Function to calculate similarity
function calculateSimilarity($conn, $hospitalId, $user1Id, $user2Id)
{
    $query = "SELECT POW((AVG(r1.rating_value) - AVG(r2.rating_value)), 2) AS dis
              FROM rating r1
              JOIN rating r2 ON r1.hospital_id = r2.hospital_id
              WHERE r1.user_id = $user1Id
              AND r2.user_id = $user2Id
              AND r1.hospital_id = $hospitalId
              AND r2.hospital_id = $hospitalId";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dis = $row['dis'];
        $similarity = 1 / (1 + $dis);
        return $similarity;
    } else {
        return 0; // Return 0 if no similarity found
    }
}
$sqlGetAllUserIds = "SELECT user_id FROM user";
$resultsUserIds = $conn->query($sqlGetAllUserIds);

$listofUserId = [];

if ($resultsUserIds->num_rows > 0) {
    while ($row = $resultsUserIds->fetch_assoc()) {
        $listofUserId[] = $row['user_id'];
    }
} else {
    echo "No user IDs found.";
}

// Get all hospital IDs
$sqlGetAllHospitalIds = "SELECT hospital_id FROM hospital";
$resultsHospitalIds = $conn->query($sqlGetAllHospitalIds);

$listofHospitalId = [];

if ($resultsHospitalIds->num_rows > 0) {
    while ($row = $resultsHospitalIds->fetch_assoc()) {
        $listofHospitalId[] = $row['hospital_id'];
    }

    foreach ($listofHospitalId as $hospitalId) {
        foreach ($listofUserId as $userId) {
            $simTotal = calculateSimilarity($conn, $hospitalId, $listofUserId[0], $userId);
            echo $hospitalId . "," . $simTotal . ",\n";
        }
    }
}
