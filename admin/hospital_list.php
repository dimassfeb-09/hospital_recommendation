<?php
include('../navbar.php');
require_once('../models/Hospital.php');

$hospital = new Hospital($conn);
$result = $hospital->getAllHospital();

?>

<div class="table_body_custom">
    <div>
        <div>
            <a href="hospital_add.php" class="button_action_custom">Tambah Rumah Sakit</a>
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) :
            ?>
            <tr>
                <td><?= $row['hospital_id'] ?></td>
                <td><?= $row["name"] ?></td>
                <td><?= $row["address"] ?></td>
                <td><?= $row["phone"] ?></td>
                <td><?= $row["email"] ?></td>
                <td>
                    <form action="hospital_edit.php?hospital_id=<?= $row["hospital_id"] ?>" method="post">
                        <button type="submit" name="edit" class="button_action_custom">Edit</button>
                    </form>
                    <form action="hospital_delete.php?hospital_id=<?= $row["hospital_id"] ?>" method="post">
                        <button type="submit" name="submit" class="button_action_custom">Delete</button>
                    </form>
                </td>
            </tr>

            <?php endwhile; ?>

        </tbody>
    </table>
</div>

<?php include('../footer.php'); ?>
