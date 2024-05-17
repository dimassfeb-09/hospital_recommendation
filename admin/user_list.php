<?php
include('../navbar.php');
require '../config.php';
session_start();

$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];

if ($isAuthenticated && isset($email)) {
    require_once('../models/User.php');

    $user = new User($conn);
    $result = $user->getAllUser();

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        $userIdSession = $userData['user_id'];
        $fullName = $userData['full_name'];
        $userEmail = $userData['email'];
        $role = $userData['role'];
    }
}

if (!$isAuthenticated) {
    echo "<script>alert('Silahkan login terlebih dahulu.');</script>";
    header("Location: ../login.php");
    exit();
}

if ($role != "admin") {
    echo "<script>alert('Akses tidak diizinkan, silahkan hubungi admin.');</script>";
    header("Location: doctor_list.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}

?>

<div class="table_body_custom">
    <div>
        <div>
            <a href="user_add.php" class="button_action_custom">Tambah Pengguna</a>
        </div>
        <div></div>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM user";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
            <tr>
                <td><?= $row["user_id"] ?></td>
                <td><?= $row["full_name"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["role"] ?></td>
                <td>
                    <form action="user_edit.php?user_id=<?= $row["user_id"] ?>" method="post">
                        <button type="submit" name="edit" class="button_action_custom"
                            <?php echo ($row["user_id"] == $userIdSession) ? 'disabled="true" style="background-color: grey;"' : ''; ?>>Edit</button>
                    </form>
                    <form action="user_delete.php?user_id=<?= $row["user_id"] ?>" method="post"
                        style="margin-top:20px;">
                        <button type="submit" name="submit" class="button_action_custom"
                            <?php echo ($row["user_id"] == $userIdSession) ? 'disabled="true" style="background-color: grey;"' : 'style="background-color: red;"'; ?>>Delete</button>
                    </form>
                </td>
            </tr>

            <?php endwhile; ?>

        </tbody>
    </table>
</div>

<script>
function showAdminPopup() {
    var popup = document.getElementById('adminPopup');
    popup.style.display = popup.style.display === 'none' ? 'block' : 'none';
}

document.getElementById('adminLink').addEventListener('click', function(event) {
    event.preventDefault();
    showAdminPopup();
});
</script>

</body>

</html>
