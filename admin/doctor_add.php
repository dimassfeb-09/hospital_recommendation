<?php
include('../navbar.php');


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];

    $sqlInsertDataDokter = "INSERT INTO doctor (name, specialization, phone) VALUES ('$name', '$specialization', '$phone');";
    $result = mysqli_query($conn, $sqlInsertDataDokter);
    if ($result) {
        echo "<script>alert('Berhasil tambah dokter.');</script>";
        echo "<script>window.location.href='doctor_list.php';</script>";
        exit();
    }
}
?>

<div class="section_form_input">
    <form class="form_custom" method="post">

        <h2>Tambah Dokter</h2>

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="specialization">Specialization</label>
            <input type="text" id="specialization" name="specialization" required>
        </div>

        <div>
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <button type="submit" name="submit" class="button_custom" value="submit">Submit</button>
    </form>
</div>

<?php include('../footer.php'); ?>