<?php
require('../navbar.php');
require('../models/User.php');

$user = new User($conn);

if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $resultEmailIsExists = $user->getUserDetailByEmail($email);
    if (mysqli_num_rows($resultEmailIsExists) > 0) {
        echo "<script>alert('Email telah digunakan.');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        return;
    }

    $result = $user->insertUser($fullName, $email, $password, $role);
    if ($result) {
        echo "<script>alert('Berhasil tambah Pengguna.');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        exit();
    }
}
?>


<div class="section_form_input">
    <form class="form_custom" method="post">

        <h2>Tambah Anggota</h2>

        <div>
            <label for="fullName">Name</label>
            <input type="text" id="fullName" name="fullName" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="text" id="password" name="password" required>
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