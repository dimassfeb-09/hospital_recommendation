<?php
require('../config.php');

session_start();
$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];
$doctorId = $_GET['doctor_id'];

$sqlSelectUserSession = "SELECT role FROM user WHERE email = '$email' LIMIT 1";
$resultUserSession = mysqli_query($conn, $sqlSelectUserSession);
if (!$resultUserSession) {
    $errorMsg = "Gagal mengambil data user, " . mysqli_error($conn);
    echo "<script>alert('$errorMsg');</script>";
    header("Location: doctor_list.php");
    exit();
}
if (mysqli_num_rows($resultUserSession) > 0) {
    $userData = mysqli_fetch_assoc($resultUserSession);
    $role = $userData['role'];
}

$getDoctorIsRelationWithHospitalDoctor = "SELECT doctor_id FROM doctor_hospital WHERE doctor_id = '$doctorId' LIMIT 1";
$resultDoctorRelation = mysqli_query($conn, $getDoctorIsRelationWithHospitalDoctor);
if ($resultDoctorRelation && mysqli_num_rows($resultDoctorRelation) > 0) {
    echo "<script>alert('Data dokter tidak dapat dihapus');</script>";
    echo "<script>window.location.href='doctor_list.php';</script>";
    exit();
} else {
    $sqlDeleteDoctor = "DELETE FROM doctor WHERE doctor_id = $doctorId";
    $resultDeleteDoctor = mysqli_query($conn, $sqlDeleteDoctor);
    if ($resultDeleteDoctor) {
        echo "<script>alert('Berhasil hapus data dokter');</script>";
        echo "<script>window.location.href='doctor_list.php';</script>";
        exit();
    } else {
        $errorMsg = "Gagal menghapus data dokter, " . mysqli_error($conn);
        echo "<script>alert('$errorMsg');</script>";
        echo "<script>window.location.href='doctor_list.php';</script>";
        exit();
    }
}