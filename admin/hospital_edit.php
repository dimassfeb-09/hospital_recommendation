<?php
require('../navbar.php');

$email = $_SESSION['email'];
$hospitalId = $_GET['hospital_id'];

$sqlGetHospitalDetail = "SELECT name, address, phone, email, website, image, description, rating, num_ratings FROM hospital WHERE hospital_id = '$hospitalId'";
$result = mysqli_query($conn, $sqlGetHospitalDetail);
if (mysqli_num_rows($result) > 0) {
    $hospitalData = mysqli_fetch_assoc($result);
    $name = $hospitalData['name'];
    $address = $hospitalData['address'];
    $phone = $hospitalData['phone'];
    $email = $hospitalData['email'];
    $image = $hospitalData['image'];
    $website = $hospitalData['website'];
    $description = $hospitalData['description'];
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    $sqlInsertDataHospital = "UPDATE hospital
    SET name='$name', address='$address', phone='$phone', email='$email', website='$website', image='$image', description='$description'
    WHERE hospital_id='$hospitalId'";

    $result = mysqli_query($conn, $sqlInsertDataHospital);
    if ($result) {
        echo "<script>alert('Berhasil ubah data rumah sakit.');</script>";
        header("Location: hospital_list.php");
        // exit();
    }
}
?>


<div class="section_form_input">
    <form class="form_custom" method="post">

        <h2>Tambah Rumah Sakit</h2>

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= $name ?>" placeholder="Masukkan nama rumah sakit" required>
        </div>

        <div>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?= $address ?>" placeholder="Masukkan alamat" required>
        </div>

        <div>
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?= $phone ?>" placeholder="Masukkan nomor telepon" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= $email ?>" placeholder="Masukkan email" required>
        </div>

        <div>
            <label for="website">Website</label>
            <input type="text" id="website" name="website" value="<?= $website ?>" placeholder="Masukkan url website" required>
        </div>

        <div>
            <label for="image">Gambar Rumah Sakit</label>
            <input type="text" id="image" name="image" value="<?= $image ?>" placeholder="Masukkan url gambar rumah sakit" required>
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
