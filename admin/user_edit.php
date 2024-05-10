<?php
require('../navbar.php');
require_once('../models/User.php');

$userId = $_GET['user_id'] ?? 0;
if ($userId === 0) {
    header("Location: user_list.php");
    exit;
}

$user = new User($conn);
$result = $user->getUserDetail($userId);
if (mysqli_num_rows($result) > 0) {
    $userData = $result->fetch_assoc();
    $fullName = $userData['full_name'];
    $email = $userData['email'];
    $role = $userData['role'];
} else {
    header("Location: user_list.php");
    exit;
}

if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $isEmailAlreadyExists = $user->getUserDetailByEmail($email);
    if (mysqli_num_rows($isEmailAlreadyExists) > 0) {
        echo "<script>alert('Email telah digunakan.');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        exit;
    }

    $result = $user->updateUser($userId, $fullName, $email, $role);
    if ($result) {
        if ($emailSession == $email) {
            session_unset();
            session_destroy();
            echo "<script>alert('Kamu mengubah akun admin, silahkan login kembali.');</script>";
            echo "<script>window.location.href='../login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Berhasil ubah data user.');</script>";
            echo "<script>window.location.href='user_list.php';</script>";
            exit;
        }
    }
}
?>



<div class="section_form_input">
    <form class="form_custom" method="post">

        <h2>Edit User</h2>

        <div>
            <label for="name">Name</label>
            <input type="text" id="full_name" name="full_name" value="<?= $fullName ?>" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?= $email ?>" required>
        </div>

        <div>
            <label for="role">Role</label>

            <select class="select_role" name="role" id="role">
                <option value="admin">Admin</option>
                <option value="basic">Basic</option>
            </select>
        </div>

        <button type="submit" name="submit" class="button_custom" value="submit">Submit</button>
    </form>
</div>


<?php require('../footer.php'); ?>