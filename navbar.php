<?php
require_once('config.php');
require_once('models/User.php');
session_start();

$isAuthenticated = isset($_SESSION['authenticated']) && $_SESSION['authenticated'];
$emailSession = $_SESSION['email'] ?? '';

$user = new User($conn);

$userID = 0;
$role = '';

if ($emailSession) {
    $resultUserInfo = $user->getUserDetailByEmail($emailSession);

    if ($resultUserInfo) {
        $row = mysqli_fetch_assoc($resultUserInfo);
        if ($row) {
            $userID = $row["user_id"];
            $role = $row["role"];
        } else {
            error_log("User details not found for email: $emailSession");
        }
    } else {
        error_log("Failed to retrieve user details for email: $emailSession");
    }
}

if (isset($_POST['logout'])) {
    $user->logout();
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ($role == 'admin' ? '../' : '') . 'assets/css/style.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
