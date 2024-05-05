<?php
require_once('config.php');

session_start();

$isAuthenticated = isset($_SESSION['authenticated']) ?? false;
$emailSession = $_SESSION['email'] ?? '';

$sqlGetUserInfo = "SELECT user_id, role FROM user WHERE email = '$emailSession'";
$resultUserInfo = mysqli_query($conn, $sqlGetUserInfo);

$row = mysqli_fetch_assoc($resultUserInfo);
$userID = $row["user_id"];
$role = $row["role"];

$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, '/admin/') === 0) {
    if ($role != "admin") {
        header("Location: ../login.php");
    }
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    if (strpos($requestUri, '/admin/') === 0) {
        header("Location: ../login.php");
    } else {
        header("Location: /login.php");
    }
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <nav>
        <ul>
            <li><a href="../index.php">Dashboard</a></li>
            <?php if ($role === "admin" && $isAuthenticated) : ?>
                <li id="adminLink"><a href="#">Admin</a></li>
            <?php endif; ?>

        </ul>

        <a href="index.php">
            <div class="brand">Hospital</div>
        </a>


        <?php if ($isAuthenticated) : ?>
            <form method="post">
                <button type="submit" class="button_custom" name="logout">Logout</button>
            </form>
        <?php else : ?>
            <form action="login.php">
                <button type="submit" class="button_custom">Login</button>
            </form>
        <?php endif; ?>
    </nav>

    <div id="adminPopup" class="popup">
        <ul>
            <li><a href="/admin/doctor_list.php">Dokter</a></li>
            <li><a href="/admin/hospital_list.php">Rumah Sakit</a></li>
            <li><a href="/admin/user_list.php">Akun Pengguna</a></li>
        </ul>
    </div>