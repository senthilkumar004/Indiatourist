<?php include "includes/header.php"; ?>

<?php
include "../db.php";

$subId = $_GET['sub'];

$places = mysqli_query($conn, "
    SELECT * FROM place1 
    WHERE sub_category_id = '$subId'
    ORDER BY id DESC
");

// Build a set of wishlisted place IDs for the logged-in user
$wishlisted = [];
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $wq  = mysqli_query($conn, "SELECT place_id FROM wishlist WHERE user_id = '$uid'");
    while ($w = mysqli_fetch_assoc($wq)) {
        $wishlisted[] = (int)$w['place_id'];
    }
}
?>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<div class="places-section">
    <div class="grid">
    <?php
    if (mysqli_num_rows($places) > 0) {
        while ($p = mysqli_fetch_assoc($places)) {
    ?>
        <div class="card">

            <div class="card-image-wrap">
                <img src="../uploads/<?= $p['place_image']; ?>" alt="<?= $p['place_name']; ?>">
                <div class="card-overlay"></div>

                <!-- ❤️ WISHLIST ICON (TOP RIGHT INSIDE CARD) -->
                <button
                    class="card-heart <?= in_array((int)$p['id'], $wishlisted) ? 'active' : ''; ?>"
                    onclick="toggleWishlist(<?= $p['id']; ?>, this)"
                    aria-label="Add to wishlist">

                    <!-- Outline heart — shown when NOT wishlisted -->
                    <svg class="heart-outline" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>

                    <!-- Filled heart — shown when wishlisted -->
                    <svg class="heart-filled" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </button>

                <div class="card-badge">
                    <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
                    </svg>
                    India
                </div>
            </div>

            <div class="card-body">
                <h3><?= $p['place_name']; ?></h3>
                <p><?= $p['place_desc']; ?></p>
                <div class="card-footer">
                    <span class="explore-btn">Explore
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </span>
                    <div class="card-dots">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>

        </div>
    <?php
        }
    } else {
        echo '<div class="empty-state"><p>No places added yet.</p></div>';
    }
    ?>
    </div>
</div>

<style>

/* ===== FONTS & ROOT ===== */
:root {
    --saffron:    #E8601C;
    --saffron-lt: #FFF0E8;
    --gold:       #C8860A;
    --gold-lt:    #FEF3D0;
    --teal:       #0B6E5E;
    --teal-lt:    #E0F5F0;
    --ink:        #1A1209;
    --slate:      #4B4436;
    --mist:       #F9F5F0;
    --card-radius: 20px;
    --img-height:  240px;
}

/* ===== SECTION WRAPPER ===== */
.places-section {
    background: var(--mist);
    min-height: 60vh;
    padding: 20px 0 60px;
}

/* ===== GRID ===== */
.grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
    padding: 40px 32px;
    max-width: 1440px;
    margin: 0 auto;
}

/* ===== CARD ===== */
.card {
    background: #fff;
    border-radius: var(--card-radius);
    overflow: hidden;
    box-shadow:
        0 2px 6px rgba(26,18,9,0.06),
        0 12px 32px rgba(26,18,9,0.08);
    transition: transform 0.38s cubic-bezier(.23,1,.32,1),
                box-shadow 0.38s cubic-bezier(.23,1,.32,1);
    cursor: pointer;
    display: flex;
    flex-direction: column;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow:
        0 4px 12px rgba(26,18,9,0.07),
        0 24px 60px rgba(26,18,9,0.14);
}

/* ===== IMAGE WRAP ===== */
.card-image-wrap {
    position: relative;
    overflow: hidden;
    height: var(--img-height);
    flex-shrink: 0;
}

.card-image-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.6s cubic-bezier(.23,1,.32,1);
}

.card:hover .card-image-wrap img {
    transform: scale(1.07);
}

/* Cinematic gradient overlay */
.card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(26,18,9,0.02) 0%,
        rgba(26,18,9,0.0)  40%,
        rgba(26,18,9,0.55) 100%
    );
    pointer-events: none;
    transition: opacity 0.4s ease;
}

.card:hover .card-overlay {
    opacity: 0.85;
}

/* ===== HEART BUTTON ===== */
.card-heart {
    position: absolute;
    top: 14px;
    right: 14px;
    width: 38px;
    height: 38px;
    background: rgba(255,255,255,0.92);
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 12px rgba(0,0,0,0.15);
    transition: background 0.25s ease, transform 0.2s ease;
    z-index: 3;
    padding: 0;
}

/* Both SVGs sit on top of each other */
.card-heart svg {
    width: 17px;
    height: 17px;
    position: absolute;
    transition: opacity 0.25s ease, transform 0.3s cubic-bezier(.34,1.56,.64,1);
}

/* Default: outline visible, filled hidden */
.card-heart .heart-outline {
    color: #b0a89e;
    opacity: 1;
    transform: scale(1);
}

.card-heart .heart-filled {
    color: var(--saffron);
    opacity: 0;
    transform: scale(0.5);
}

/* Active (wishlisted): filled visible, outline hidden */
.card-heart.active .heart-outline {
    opacity: 0;
    transform: scale(0.5);
}

.card-heart.active .heart-filled {
    opacity: 1;
    transform: scale(1);
}

.card-heart:hover {
    background: #fff;
    transform: scale(1.12);
}

/* Pulse animation on toggle */
@keyframes heartPop {
    0%   { transform: scale(1); }
    40%  { transform: scale(1.35); }
    70%  { transform: scale(0.88); }
    100% { transform: scale(1); }
}

.card-heart.popping .heart-filled {
    animation: heartPop 0.4s cubic-bezier(.23,1,.32,1);
}

/* ===== TOAST NOTIFICATION ===== */
.wl-toast {
    position: fixed;
    bottom: 36px;
    left: 50%;
    transform: translateX(-50%) translateY(20px);
    opacity: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 22px;
    border-radius: 50px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.2px;
    white-space: nowrap;
    pointer-events: none;
    z-index: 9999;
    transition: opacity 0.3s ease, transform 0.35s cubic-bezier(.23,1,.32,1);
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
}

.wl-toast.toast-added {
    background: #fff8f4;
    color: var(--saffron);
    border: 1.5px solid rgba(232,96,28,0.25);
}

.wl-toast.toast-removed {
    background: #f5f4f2;
    color: var(--slate);
    border: 1.5px solid rgba(75,68,54,0.18);
}

.wl-toast.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}

/* ===== LOCATION BADGE ===== */
.card-badge {
    position: absolute;
    bottom: 12px;
    left: 14px;
    background: rgba(255,255,255,0.18);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.35);
    color: #fff;
    font-family: 'DM Sans', sans-serif;
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    padding: 5px 10px 5px 8px;
    border-radius: 30px;
    display: flex;
    align-items: center;
    gap: 5px;
    z-index: 3;
}

.card-badge svg {
    opacity: 0.9;
}

/* ===== CARD BODY ===== */
.card-body {
    padding: 20px 22px 18px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.card-body h3 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 19px;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 8px;
    line-height: 1.3;
    letter-spacing: 0.1px;
}

.card-body p {
    font-family: 'DM Sans', sans-serif;
    font-size: 13.5px;
    line-height: 1.75;
    color: var(--slate);
    margin: 0 0 18px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* ===== CARD FOOTER ===== */
.card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid #F0EBE3;
    padding-top: 14px;
    margin-top: auto;
}

.explore-btn {
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 500;
    color: var(--saffron);
    display: flex;
    align-items: center;
    gap: 5px;
    letter-spacing: 0.2px;
    transition: gap 0.2s ease;
}

.card:hover .explore-btn {
    gap: 9px;
}

.card-dots {
    display: flex;
    gap: 4px;
}

.card-dots span {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #E0D8CF;
    display: block;
    transition: background 0.3s ease;
}

.card:hover .card-dots span:nth-child(1) { background: var(--saffron); }
.card:hover .card-dots span:nth-child(2) { background: var(--gold);    transition-delay: 0.07s; }
.card:hover .card-dots span:nth-child(3) { background: var(--teal);    transition-delay: 0.14s; }

/* ===== EMPTY STATE ===== */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    font-family: 'DM Sans', sans-serif;
    font-size: 16px;
    color: var(--slate);
}

/* ===== CARD ENTRANCE ANIMATION ===== */
@keyframes cardIn {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

.card {
    animation: cardIn 0.5s cubic-bezier(.23,1,.32,1) both;
}

.card:nth-child(1)  { animation-delay: 0.04s; }
.card:nth-child(2)  { animation-delay: 0.08s; }
.card:nth-child(3)  { animation-delay: 0.12s; }
.card:nth-child(4)  { animation-delay: 0.16s; }
.card:nth-child(5)  { animation-delay: 0.20s; }
.card:nth-child(6)  { animation-delay: 0.24s; }
.card:nth-child(7)  { animation-delay: 0.28s; }
.card:nth-child(8)  { animation-delay: 0.32s; }

/* ===== RESPONSIVE ===== */
@media (max-width: 1280px) {
    .grid { grid-template-columns: repeat(3, 1fr); gap: 24px; padding: 36px 28px; }
}

@media (max-width: 960px) {
    .grid { grid-template-columns: repeat(2, 1fr); gap: 20px; padding: 28px 20px; }
    :root { --img-height: 220px; }
}

@media (max-width: 600px) {
    .grid { grid-template-columns: 1fr; gap: 18px; padding: 20px 16px; }
    :root { --img-height: 200px; }
    .card-body h3 { font-size: 18px; }
}

</style>

<div id="wl-toast" class="wl-toast" role="status" aria-live="polite"></div>

<script>
/* ── Toast helper ── */
let toastTimer;
function showToast(msg, type) {
    const t = document.getElementById('wl-toast');
    clearTimeout(toastTimer);
    t.textContent = msg;
    t.className = 'wl-toast ' + type;
    requestAnimationFrame(() => t.classList.add('show'));
    toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
}

/* ── Toggle wishlist ── */
function toggleWishlist(placeId, btn) {

<?php if (!isset($_SESSION['user_id'])) { ?>
    showToast('Please login to use wishlist ❤️', 'toast-removed');
    return;
<?php } ?>

    const isActive = btn.classList.contains('active');

    /* Optimistic UI — flip immediately */
    btn.classList.toggle('active');
    btn.classList.add('popping');
    btn.addEventListener('animationend', () => btn.classList.remove('popping'), { once: true });

    if (!isActive) {
        showToast('❤️  Added to Wishlist', 'toast-added');
    } else {
        showToast('🤍  Removed from Wishlist', 'toast-removed');
    }

    fetch("wishlist_action.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "place_id=" + placeId
    })
    .then(res => res.text())
    .catch(() => {
        /* On error: revert the UI */
        btn.classList.toggle('active');
        showToast('Something went wrong. Try again.', 'toast-removed');
    });
}
</script>

<script>
function wishlistClick() {
    <?php if (!isset($_SESSION['user_id'])) { ?>
        showToast('Please login to view your wishlist ❤️', 'toast-removed');
        return;
    <?php } ?>

    window.location.href = "wishlist.php";
}
</script>

<?php include "includes/footer.php"; ?>