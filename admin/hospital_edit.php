<?php
require('../navbar.php');
require_once('../models/Hospital.php');

$hospitalId = $_GET['hospital_id'];
if (!isset($hospitalId)) {
    header("Location: hospital_list.php");
    exit;
}

$hospital = new Hospital($conn);

$result = $hospital->getDetailHospital($hospitalId);
if (mysqli_num_rows($result) > 0) {
    $hospitalData = $result->fetch_assoc();
    $name = $hospitalData['name'];
    $address = $hospitalData['address'];
    $phone = $hospitalData['phone'];
    $email = $hospitalData['email'];
    $image = $hospitalData['image'];
    $website = $hospitalData['website'];
    $description = $hospitalData['description'];
} else {
    header("Location: hospital_list.php");
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $image = $_POST['image'];
    $website = $_POST['website'];
    $description = $_POST['description'];

    $result =  $hospital->updateHospital($hospitalId, $name, $address, $phone, $email, $image, $website, $description);
    if ($result) {
        echo "<script>alert('Berhasil ubah data rumah sakit.');</script>";
        echo "<script>window.location.href='hospital_list.php';</script>";
    }
}
?>


<div class="section_form_input">
    <form class="form_custom" method="post">

        <h2>Tambah Rumah Sakit</h2>

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= $name ?>" placeholder="Masukkan nama rumah sakit"
                required>
        </div>

        <div>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?= $address ?>" placeholder="Masukkan alamat"
                required>
        </div>

        <div>
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?= $phone ?>" placeholder="Masukkan nomor telepon"
                required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= $email ?>" placeholder="Masukkan email" required>
        </div>

        <div>
            <label for="website">Website</label>
            <input type="text" id="website" name="website" value="<?= $website ?>" placeholder="Masukkan url website"
                required>
        </div>

        <div>
            <label for="image">Gambar Rumah Sakit</label>
            <input type="text" id="image" name="image" value="<?= $image ?>"
                placeholder="Masukkan url gambar rumah sakit" required>
        </div>

        <div>
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="<?= $description ?>" required>
        </div>

        <button type="submit" name="submit" class="button_custom" value="submit">Submit</button>
    </form>
</div>


<?php
require('../footer.php');