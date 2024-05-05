<?php
include('../navbar.php');

$doctorId = $_GET['doctor_id'];

$sqlGetDoctorDetail = "SELECT name, specialization, phone FROM doctor WHERE doctor_id = '$doctorId'";
$result = mysqli_query($conn, $sqlGetDoctorDetail);
if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $name = $userData['name'];
    $specialization = $userData['specialization'];
    $phone = $userData['phone'];
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];


    $sqlInsertDataDokter = "UPDATE doctor SET name='$name', specialization='$specialization', phone='$phone' WHERE doctor_id='$doctorId'";
    $result = mysqli_query($conn, $sqlInsertDataDokter);
    if ($result) {
        echo "<script>alert('Berhasil ubah data dokter.');</script>";
        header("Location: doctor_list.php");
        // exit();
    }
}
?>

<div class="section_form_input">
    <form class="form_custom" method="post">

        <h2>Edit Dokter</h2>

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= $name ?>" required>
        </div>

        <div>
            <label for="specialization">Specialization</label>
            <input type="text" id="specialization" name="specialization" value="<?= $specialization ?>" required>
        </div>

        <div>
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?= $phone ?>" required>
        </div>

        <button type="submit" name="submit" class="button_custom" value="submit">Submit</button>
    </form>
</div>


<?php include('../footer.php'); ?>