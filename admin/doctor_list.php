<?php
include('../navbar.php');

$sql = "SELECT * FROM doctor";
$result = mysqli_query($conn, $sql);

?>

<div class="table_body_custom">
    <div>
        <div>
            <a href="/admin/doctor_add.php" class="button_action_custom">Tambah Dokter</a>
        </div>
        <div></div>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Spesialisasi</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) :
            ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $row["name"] ?></td>
                <td><?= $row["specialization"] ?></td>
                <td><?= $row["phone"] ?></td>
                <td>
                    <form action="/admin/doctor_edit.php?doctor_id=<?= $row["doctor_id"] ?>" method="post">
                        <button type="submit" name="edit" class="button_action_custom">Edit</button>
                    </form>
                    <form action="/admin/doctor_delete.php?doctor_id=<?= $row["doctor_id"] ?>" method="post">
                        <button type="submit" name="submit" class="button_action_custom">Delete</button>
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

<?php include('../footer.php'); ?>