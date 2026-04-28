<?php include "includes/header.php"; ?>

<?php
include "../db.php";

$subId = $_GET['sub'];

$places = mysqli_query($conn, "
    SELECT * FROM place1 
    WHERE sub_category_id = '$subId'
    ORDER BY id DESC
");
?>





<div class="grid">
<?php
if (mysqli_num_rows($places) > 0) {
    while ($p = mysqli_fetch_assoc($places)) {
?>
    <div class="card">

        <!-- ❤️ WISHLIST ICON (TOP RIGHT INSIDE CARD) -->
        <div class="card-heart" onclick="toggleWishlist(<?= $p['id']; ?>)">
            <i class="fas fa-heart"></i>
        </div>

        <img src="../uploads/<?= $p['place_image']; ?>">
        <h3><?= $p['place_name']; ?></h3>
        <p><?= $p['place_desc']; ?></p>

    </div>
<?php
    }
} else {
    echo "<p>No places added yet.</p>";
}
?>
</div>



<style>

    /* ===== GRID ===== */
.grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 36px;
    padding: 50px 20px;
}

/* ===== CARD ===== */
.card {
    background: rgba(255, 255, 255, 0.85);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
}

/* Hover */
/* .card:hover {
    transform: translateY(-12px);
    box-shadow: 0 40px 80px rgba(0,0,0,0.15);
} */

/* ===== IMAGE ===== */
.card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    transition: transform 0.6s ease;
}

/* .card:hover img {
    transform: scale(1.06);
} */

/* ===== TEXT ===== */
.card h3 {
    font-size: 21px;
    font-weight: 700;
    padding: 18px 22px 8px;
    color: #0f172a;
    letter-spacing: 0.3px;
}

.card p {
    font-size: 15px;
    line-height: 1.8;
    padding: 0 22px 26px;
    color: #475569;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    .grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 900px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .grid {
        grid-template-columns: 1fr;
    }
}

</style>


<script>
function toggleWishlist(placeId) {

<?php if (!isset($_SESSION['user_id'])) { ?>
    alert("Please login to use wishlist ❤️");
  
    return;
<?php } ?>

fetch("wishlist_action.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "place_id=" + placeId
})
.then(res => res.text())
.then(() => location.reload());
}
</script>

<script>
function wishlistClick() {
    <?php if (!isset($_SESSION['user_id'])) { ?>
        alert("Please login to view your wishlist ❤️");
       
        return;
    <?php } ?>

    // If logged in, go to wishlist page
    window.location.href = "wishlist.php";
}
</script>

<?php include "includes/footer.php"; ?>