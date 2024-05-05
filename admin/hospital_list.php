<?php
include('../navbar.php');

$email = $_SESSION['email'];

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
            <a href="/admin/hospital_add.php" class="button_action_custom">Tambah Rumah Sakit</a>
        </div>
        <div></div>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Website</th>
                <th>Description</th>
                <th>Rating</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM hospital";
            $result = mysqli_query($conn, $sql);
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) :
            ?>
            <tr>
                <td><?= $row['hospital_id'] ?></td>
                <td><?= $row["name"] ?></td>
                <td><?= $row["address"] ?></td>
                <td><?= $row["phone"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["website"] ?></td>
                <td><?= $row["description"] ?></td>
                <td><?= $row["rating"] ?></td>
                <td><?= $row["num_ratings"] ?></td>
                <td>
                    <form action="/admin/hospital_edit.php?hospital_id=<?= $row["hospital_id"] ?>" method="post">
                        <button type="submit" name="edit" class="button_action_custom">Edit</button>
                    </form>
                    <form action="/admin/hospital_delete.php?hospital_id=<?= $row["hospital_id"] ?>" method="post">
                        <button type="submit" name="submit" class="button_action_custom">Delete</button>
                    </form>
                </td>
            </tr>

            <?php endwhile; ?>

        </tbody>
    </table>
</div>

<?php include('../footer.php'); ?>