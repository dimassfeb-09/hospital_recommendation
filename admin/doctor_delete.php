<?php
require_once('../config.php');
require_once('../models/User.php');
require_once('../models/Doctor.php');
require_once('../models/HospitalDoctor.php');

$user = new User($conn);
$hospitalDoctor = new HospitalDoctor($conn);
$doctor = new Doctor($conn);

session_start();
$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];
$doctorId = $_GET['doctor_id'];

$resultUserSession = $user->getUserDetailByEmail($email);

if (!$resultUserSession) {
    $errorMsg = "Gagal mengambil data user, " . mysqli_error($conn);
    echo "<script>alert('$errorMsg');</script>";
    header("Location: doctor_list.php");
    exit();
} else if (mysqli_num_rows($resultUserSession) > 0) {
    $userData = $resultUserSession->fetch_assoc();
    $role = $userData['role'];
}

$resultDoctorRelation = $hospitalDoctor->checkDoctorRelation($doctorId);
if ($resultDoctorRelation && mysqli_num_rows($resultDoctorRelation) > 0) {
    echo "<script>alert('Gagal menghapus data dokter.');</script>";
    echo "<script>window.location.href='doctor_list.php';</script>";
    exit();
} else {
    $result = $doctor->deleteDoctor($doctorId);
    if ($result) {
        echo "<script>alert('Berhasil hapus data dokter');</script>";
    } else {
        $errorMsg = "Gagal menghapus data dokter, " . mysqli_error($conn);
        echo "<script>alert('$errorMsg');</script>";
    }
    echo "<script>window.location.href='doctor_list.php';</script>";
    exit();
}
