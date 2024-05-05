<?php
include('navbar.php');

$hospital_id = $_GET["hospital_id"];

$sql = "SELECT * FROM hospital WHERE hospital_id = $hospital_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
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

    $sqlInsertRating = "INSERT INTO rating (hospital_id, user_id, rating_value, comment) 
                            VALUES ('$hospital_id', '$userID', '$rate', '$comment')";
    $resultInsertRating = mysqli_query($conn, $sqlInsertRating);

    if ($resultInsertRating) {
        echo "<script>alert('Berhasil memberikan rating.')</script>";
    } else {
        echo "<script>alert('Gagal memberikan rating.')</script>";
    }
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
            $sql = "
                    SELECT
                        d.doctor_id as doctor_id,
                        d.name AS doctor_name,
                        d.specialization as specialization,
                        d.phone as phone,
                        h.hospital_id,
                        h.name AS hospital_name
                    FROM
                        doctor d
                        INNER JOIN doctor_hospital dh ON d.doctor_id = dh.doctor_id
                        INNER JOIN hospital h ON dh.hospital_id = h.hospital_id
                    WHERE
                    h.hospital_id = '$hospital_id';";

            $result = mysqli_query($conn, $sql);
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) :
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
$quertGetRating = "SELECT r.rating_value, r.comment, r.created_at, u.full_name
        FROM rating r
        JOIN user u ON r.user_id = u.user_id
        WHERE r.hospital_id = '$hospital_id'
        ORDER BY r.created_at ASC";

$result = mysqli_query($conn, $quertGetRating);
while ($row = mysqli_fetch_assoc($result)) :
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
    <form id="ratingForm" class="rating_card" method="post" action="detail_rs.php?hospital_id=<?= $hospital_id ?>">
        <h3>Berikan rating kamu</h3>
        <?php if ($isAuthenticated) : ?>
            <div class="rate">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
            </div>
            <textarea id="comment" name="comment" rows="4" cols="30"></textarea>
            <button type="submit" name="submit" value="submit" class="button_custom" style="margin-top: 10px;">Submit</button>
        <?php else : ?>
            <div><a href="login.php">Login</a> untuk memberikan rating</div>
        <?php endif ?>
    </form>
</div>

<script>
    const toggleOpenRating = document.querySelector(".toggleOpenRating");
    const toggleCloseRating = document.querySelector(".toggleCloseRating");
    const ratingCard = document.querySelector(".popupRating");

    toggleOpenRating.addEventListener("click", () => {
        ratingCard.style.display = ratingCard.style.display === "block" ? "none" : "block";
    });

    toggleCloseRating.addEventListener("click", () => {
        ratingCard.style.display = ratingCard.style.display === "block" ? "none" : "block";
    });
</script>

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
</script>


</body>

</html>


</body>

</html>