<?php
require('../config.php');
require_once('../models/User.php');
require_once('../models/Rating.php');

session_start();

$rating = new Rating($conn);
$user = new User($conn);

$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];
$userId = $_GET['user_id'];

$selectUserSession = $user->getUserDetailByEmail($email);
if (!$selectUserSession || mysqli_num_rows($selectUserSession) <= 0) {
    $errorMsg = "Gagal mengambil data user.";
    echo "<script>alert('$errorMsg');</script>";
    header("Location: user_list.php");
    exit;
}

$userData = $selectUserSession->fetch_assoc();
$role = $userData['role'];

$resultUserRelation = $rating->getUserRating($userId);
if ($resultUserRelation && mysqli_num_rows($resultUserRelation) > 0) {
    echo "<script>alert('Tidak dapat hapus data user.');</script>";
    echo "<script>window.location.href='user_list.php';</script>";
    exit;
}

$deleteUser = $user->deleteUser($userId);
if ($deleteUser) {
    echo "<script>alert('Berhasil hapus data user');</script>";
    echo "<script>window.location.href='user_list.php';</script>";
    exit;
} else {
    $errorMsg = "Gagal menghapus data user.";
    echo "<script>alert('$errorMsg');</script>";
    echo "<script>window.location.href='user_list.php';</script>";
    exit;
}
