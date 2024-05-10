<?php
include('navbar.php');
require_once('models/Hospital.php');
require_once('models/Rating.php');

$hospitalId = $_GET["hospital_id"];
$hospital = new Hospital($conn);
$ratingObj = new Rating($conn);

$result = $hospital->getDetailHospital($hospitalId);
while ($row = $result->fetch_assoc()) {
    $name = $row["name"];
    $address = $row["address"];
    $image = $row["image"];
    $phone = $row["phone"];
    $email = $row["email"];
    $website = $row["website"];
    $description = $row["description"];
    $rating = $row["rating"];
}

if (isset($_POST['submit'])) {
    $rate = $_POST['rate'];
    $comment = $_POST['comment'];

    $result = $ratingObj->getRatingByHospitalAndUser($hospitalId, $userID);
    if (mysqli_num_rows($result) == 1) {
        echo "<script>alert('Sudah pernah memberikan rating.')</script>";
        echo "<script>window.location.href='detail_rs.php?hospital_id=$hospitalId';</script>";
        return;
    }

    $result = $ratingObj->insertRating($hospitalId, $userID, $rate, $comment);
    if ($result) {
        $ratingObj->calculateAverageRating($hospitalId);
        echo "<script>alert('Berhasil memberikan rating.')</script>";
    } else {
        echo "<script>alert('Gagal memberikan rating.')</script>";
    }
}

if (isset($_POST['submitEdit'])) {
    $rate = $_POST['rate'];
    $comment = $_POST['comment'];
    $ratingId = $_POST['rating_id'];

    $result = $ratingObj->updateRating($ratingId, $rate, $comment);
    if ($result) {
        $ratingObj->calculateAverageRating($hospitalId);
        echo "<script>alert('Berhasil update rating.')</script>";
    } else {
        echo "<script>alert('Gagal memberikan rating.')</script>";
    }
}



$resultGetRating = $hospital->getRatingHospital($hospitalId);
$resultGetDoctor = $hospital->getDoctorHospital($hospitalId);
$resultIsUserAlreadyRating = $ratingObj->getRatingByHospitalAndUser($hospitalId, $userID);
while ($row = $resultIsUserAlreadyRating->fetch_assoc()) {
    $userRatingId = $row['rating_id'] ?? 0;
    $userRating = $row['rating_value'] ?? 0;
    $userComment = $row['comment'] ?? '';
}

?>




<div class="flex_bg">
    <div class="gradient-color-purple"></div>
</div>

<section class="about_detail_rs">
    <span>ABOUT</span>
    <span style="margin-left: 10px;"><i style="color:gold;" class="fa fa-star"></i> <?= $rating ?></span>
</section>


<section class="about_rs">
    <span><?= $name ?></span>
    <?php if ($image) : ?>
        <img src="<?= $image ?>" alt="Foto <?= $name ?>" style="margin: 30px 0px; border-radius: 20px;">
    <?php endif ?>
    <span><?= $description ?></span>
</section>

<section class="contact mt-5">
    <div class="address">
        <div>Alamat</div>
        <div><?= $address ?></div>
    </div>
    <div class="phone">
        <div>Hubungi Kami</div>
        <div><?= $phone ?></div>
    </div>
    <div class="email">
        <div>Email</div>
        <div><?= $email ?></div>
    </div>


</section>

<section class="table_doctor">
    <div class="h1_title">Data Dokter di <?= $name ?></div>

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Spesialisasi</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($resultGetDoctor)) :
            ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $row["doctor_name"] ?></td>
                    <td><?= $row["specialization"] ?></td>
                    <td><?= $row["phone"] ?></td>
                </tr>

            <?php endwhile; ?>

        </tbody>
    </table>

</section>



<div class="h1_title">Rating di <?= $name ?></div>

<?php
while ($row = mysqli_fetch_assoc($resultGetRating)) :
?>
    <section class="rating_user">
        <div class="rating_card_user">
            <div class="profile_detail">
                <i class="fa fa-user profile_icon"></i>
                <div>
                    <div><?= $row['full_name'] ?></div>
                    <div><?= $row['created_at'] ?></div>
                    <div>
                        <i class="fa fa-star"></i>
                        <?= $row['rating_value'] ?>
                    </div>
                </div>
            </div>
            <div class="comment_review"><?= $row['comment'] ?></div>
        </div>
    </section>

<?php endwhile; ?>

<div class="giving_rating_card ">

    <form id="ratingForm" class="rating_card" method="post">
        <h3><?= $userRatingId ? 'Ubah rating kamu' : 'Berikan rating kamu' ?></h3>

        <?php if ($isAuthenticated) : ?>

            <?php if ($userRatingId) : ?>
                <input type="text" name="rating_id" value="<?= $userRatingId ?>" hidden />
            <?php endif; ?>

            <div class="rate">
                <?php for ($i = 5; $i >= 1; $i--) : ?>
                    <input type="radio" id="star<?= $i ?>" name="rate" value="<?= $i ?>" <?= $i == $userRating ? 'checked' : '' ?> />
                    <label for="star<?= $i ?>" title="<?= $i ?> stars" class="cursor-pointer" onclick="handleRating(<?= $i ?>)">
                        <svg class="w-6 h-6 fill-current <?= $i <= $userRating ? 'text-yellow-500' : 'text-gray-500' ?>" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.31 6.91.82-5 4.87 1.18 7.19L12 18.77l-6.09 3.22 1.18-7.19-5-4.87 6.91-.82L12 2z">
                            </path>
                        </svg>
                    </label>
                <?php endfor; ?>
            </div>

            <textarea id="comment" name="comment" rows="4" cols="30" style="padding: 5px;" placeholder="<?= $userRatingId ? 'Edit Pesan' : 'Masukkan Pesan' ?>" <?= $userRatingId ? 'disabled' : '' ?>><?= $userComment ?? '' ?></textarea>

            <div class="flex">
                <?php if (mysqli_num_rows($resultIsUserAlreadyRating) == 1) : ?>
                    <button type="button" name="edit" value="edit" class="button_custom" style="margin-top: 10px;" onclick="handleEdit()">Edit</button>
                    <button type="submit" name="submitEdit" value="submitEdit" class="button_custom hidden" style="margin-top: 10px;">Submit Edit</button>
                    <button type="button" name="cancel" value="cancel" class="button_custom hidden" style="margin-top: 10px;" onclick="handleCancel()">Cancel</button>
                <?php else : ?>
                    <button type="submit" name="submit" value="submit" class="button_custom" style="margin-top: 10px;">Submit</button>
                <?php endif; ?>

            </div>
        <?php else : ?>
            <div><a href="login.php">Login</a> untuk memberikan rating</div>
        <?php endif; ?>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('ratingForm');
        var radios = form.querySelectorAll('input[type="radio"]');

        radios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                window.scrollTo(0, form.offsetTop);
            });
        });
    });

    function handleRating(rating) {
        const radios = document.querySelectorAll('input[name="rate"]');
        radios.forEach((radio, index) => {

            if (radio.disabled == true) {
                return;
            }

            const starSVG = radio.nextElementSibling.querySelector('.w-6.h-6.fill-current');
            if (index < rating) {
                starSVG.classList.add('text-yellow-500');
                starSVG.classList.remove('text-gray-500');
            } else {
                starSVG.classList.remove('text-yellow-500');
                starSVG.classList.add('text-gray-500');
            }
        });
    }

    function handleEdit() {
        const editBtn = document.querySelector('[name="edit"]');
        const cancelBtn = document.querySelector('[name="cancel"]');
        const submitEditBtn = document.querySelector('[name="submitEdit"]');
        const textarea = document.getElementById('comment');

        editBtn.classList.add('hidden');
        cancelBtn.classList.remove('hidden');
        submitEditBtn.classList.remove('hidden');
        textarea.disabled = false;
        document.querySelectorAll('input[name="rate"]').forEach(radio => radio.disabled = false);
    }

    function handleCancel() {
        const editBtn = document.querySelector('[name="edit"]');
        const cancelBtn = document.querySelector('[name="cancel"]');
        const submitEditBtn = document.querySelector('[name="submitEdit"]');
        const textarea = document.getElementById('comment');

        editBtn.classList.remove('hidden');
        cancelBtn.classList.add('hidden');
        submitEditBtn.classList.add('hidden');
        textarea.disabled = true;
        document.querySelectorAll('input[name="rate"]').forEach(radio => radio.disabled = true);
    }
</script>

<?php include('footer.php') ?>