<?php
include('../navbar.php');
require_once('../models/Doctor.php');

$doctor = new Doctor($conn);

$doctorId = $_GET['doctor_id'];
if (!isset($doctorId)) {
    header("Location: doctor_list.php");
    exit;
}

$result = $doctor->getDetailDoctor($doctorId);
if (mysqli_num_rows($result) > 0) {
    $userData = $result->fetch_assoc();
    $name = $userData['name'];
    $specialization = $userData['specialization'];
    $phone = $userData['phone'];
} else {
    echo "<script>window.location.href = 'doctor_list.php';</script>";
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];

    $result = $doctor->updateDoctor($doctorId, $name, $specialization, $phone);
    if ($result) {
        echo "<script>alert('Berhasil ubah data dokter.');</script>";
        echo "<script>window.location.href = 'doctor_list.php';</script>";
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