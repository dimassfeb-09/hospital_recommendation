<?php
require('../config.php');

session_start();
$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];
$hospitalId = $_GET['hospital_id'];

$sqlSelectUserSession = "SELECT role FROM user WHERE email = '$email' LIMIT 1";
$resultUserSession = mysqli_query($conn, $sqlSelectUserSession);
if (!$resultUserSession) {
    $errorMsg = "Gagal mengambil data user, " . mysqli_error($conn);
    echo "<script>alert('$errorMsg');</script>";
    header("Location: hospital_list.php");
    exit();
}
if (mysqli_num_rows($resultUserSession) > 0) {
    $userData = mysqli_fetch_assoc($resultUserSession);
    $role = $userData['role'];
}

$getHospitalIsRelationWithHospitalHospital = "SELECT hospital_id FROM doctor_hospital WHERE hospital_id = '$hospitalId' LIMIT 1";
$resultHospitalRelation = mysqli_query($conn, $getHospitalIsRelationWithHospitalHospital);
if ($resultHospitalRelation && mysqli_num_rows($resultHospitalRelation) > 0) {
    echo "<script>alert('Data rumah sakit tidak dapat dihapus.');</script>";
    echo "<script>window.location.href='hospital_list.php';</script>";
    exit();
} else {
    $sqlDeleteHospital = "DELETE FROM hospital WHERE hospital_id = $hospitalId";
    $resultDeleteHospital = mysqli_query($conn, $sqlDeleteHospital);
    if ($resultDeleteHospital) {
        echo "<script>alert('Berhasil hapus data rumah sakit');</script>";
        echo "<script>window.location.href='hospital_list.php';</script>";
        exit();
    } else {
        $errorMsg = "Gagal menghapus data rumah sakit, " . mysqli_error($conn);
        echo "<script>alert('$errorMsg');</script>";
        echo "<script>window.location.href='hospital_list.php';</script>";
        exit();
    }
}
