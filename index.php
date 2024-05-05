<?php
include('navbar.php');

?>

<div class="cards-rs">
    <div class="grid-3">
        <?php
        $sql = "SELECT hospital_id, name, address, phone, rating FROM hospital ORDER BY rating DESC;";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) :
        ?>
            <article class="information [ card-rs ]">
                <span class="tag">Rumah Sakit</span>
                <span class="tag">
                    <i class="fa fa-star"></i>
                    <span><?= $row["rating"] ?></span>
                </span>
                <h2 class="title"><?= $row["name"] ?></h2>
                <p class="info"><?= $row["address"] ?>.</p>
                <p class="info">No Phone: <?= $row["phone"] ?>.</p>

                <a href="detail_rs.php?hospital_id=<?= $row["hospital_id"] ?>">
                    <button class="button mt-5">
                        Lihat Detail
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4v3z" fill="currentColor" />
                        </svg>
                    </button>
                </a>
            </article>
        <?php endwhile; ?>
    </div>
</div>

<?php
include('footer.php');
?>