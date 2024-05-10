<?php
require('../config.php');
require_once('../models/User.php');
require_once('../models/Hospital.php');
require_once('../models/HospitalDoctor.php');

session_start();

$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];
$hospitalId = $_GET['hospital_id'];

$user = new User($conn);
$hospitalDoctor = new HospitalDoctor($conn);
$hospital = new Hospital($conn);

$resultUser = $user->getUserDetailByEmail($email);
if (!$resultUser || mysqli_num_rows($resultUser) <= 0) {
    $errorMsg = "Gagal mengambil data user.";
    echo "<script>alert('$errorMsg');</script>";
    header("Location: hospital_list.php");
    exit;
}

$userData = $resultUser->fetch_assoc();
$role = $userData['role'];

$resultHospitalRelation = $hospitalDoctor->checkHospitalRelation($hospitalId);
if ($resultHospitalRelation && mysqli_num_rows($resultHospitalRelation) > 0) {
    echo "<script>alert('Gagal hapus data rumah sakit.');</script>";
    echo "<script>window.location.href='hospital_list.php';</script>";
    exit;
}

$deleteResult = $hospital->deleteHospital($hospitalId);
if ($deleteResult) {
    echo "<script>alert('Berhasil hapus data rumah sakit');</script>";
    echo "<script>window.location.href='hospital_list.php';</script>";
    exit;
} else {
    $errorMsg = "Gagal menghapus data rumah sakit.";
    echo "<script>alert('$errorMsg');</script>";
    echo "<script>window.location.href='hospital_list.php';</script>";
    exit;
}
