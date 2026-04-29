<?php
/* ============================================================
   ob_start() buffers ALL output — so header() works even after
   header.php has printed its HTML. No session_start() here,
   so header.php's session_start() on line 2 runs exactly once.
   ============================================================ */
ob_start();
include "includes/header.php";   // session starts here, $conn available

if (!isset($_SESSION['user_id'])) {
    ob_end_clean();
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['remove_wishlist_id'])) {
    $wid = intval($_POST['remove_wishlist_id']);
    mysqli_query($conn, "DELETE FROM wishlist WHERE id = '$wid' AND user_id = '$user_id'");
    ob_end_clean();
    header("Location: wishlist.php");
    exit;
}

// No redirect needed — flush the buffered header HTML to the browser
ob_end_flush();
?>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<!-- ===== PAGE HEADER ===== -->
<div class="wl-page-header">
    <div class="wl-header-inner">
        <!-- <div class="wl-header-icon">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </div> -->
        <a href="index.php" style="text-decoration:none;">
            <h1>My Wishlist</h1>
        </a>
        <p>Your handpicked destinations across Incredible India</p>
    </div>
</div>

<!-- ===== GRID ===== -->
<div class="places-section">
<div class="grid">

<?php
$query = mysqli_query($conn, "
    SELECT 
        w.id AS wishlist_id,
        w.place_id,
        p.place_name,
        p.place_image,
        p.place_desc
    FROM wishlist w
    LEFT JOIN place1 p ON p.id = w.place_id
    WHERE w.user_id = '$user_id'
");

if (!$query) {
    die("SQL Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($query) == 0) { ?>

    <div class="empty-state">
        <div class="empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </div>
        <h2>Your Wishlist is Empty</h2>
        <p>Start exploring the beauty of India and add your dream destinations ❤️</p>
        <a href="index.php" class="explore-link">
            Discover Places
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>

<?php } else {
    while ($row = mysqli_fetch_assoc($query)) {
        $placeName = $row['place_name'] ?? 'Place not available';
        $desc      = $row['place_desc'] ?? 'No description available';
        $image     = !empty($row['place_image'])
                        ? "../uploads/" . htmlspecialchars($row['place_image'])
                        : "../assets/no-image.png";
?>

    <div class="card">

        <div class="card-image-wrap">
            <img src="<?= $image ?>" alt="<?= htmlspecialchars($placeName) ?>">
            <div class="card-overlay"></div>

            <!-- ❤️ REMOVE FROM WISHLIST -->
            <form method="post" class="remove-form">
                <input type="hidden" name="remove_wishlist_id" value="<?= $row['wishlist_id'] ?>">
                <button type="submit" class="card-heart active" title="Remove from Wishlist" onclick="return confirmRemove(this)">
                    <!-- Outline heart -->
                    <svg class="heart-outline" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                    <!-- Filled heart -->
                    <svg class="heart-filled" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </button>
            </form>

            <div class="card-badge">
                <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
                </svg>
                India
            </div>
        </div>

        <div class="card-body">
            <h3><?= htmlspecialchars($placeName) ?></h3>
            <p><?= htmlspecialchars($desc) ?></p>
            <div class="card-footer">
                <span class="saved-tag">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                    Saved
                </span>
                <div class="card-dots">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>

    </div>

<?php 
    } 
} 
?>

</div>
</div>

<!-- ===== TOAST ===== -->
<div id="wl-toast" class="wl-toast" role="status" aria-live="polite"></div>

<style>
/* ===== ROOT ===== */
:root {
    --saffron:    #E8601C;
    --saffron-lt: #FFF0E8;
    --gold:       #C8860A;
    --teal:       #0B6E5E;
    --ink:        #1A1209;
    --slate:      #4B4436;
    --mist:       #F9F5F0;
    --card-radius: 20px;
    --img-height:  260px;
}

/* ===== PAGE HEADER ===== */
.wl-page-header {
    background: linear-gradient(135deg, #fff8f4 0%, #fdf5ec 60%, #f0faf6 100%);
    padding: 56px 20px 48px;
    text-align: center;
    border-bottom: 1px solid rgba(232,96,28,0.1);
}

.wl-header-inner {
    max-width: 600px;
    margin: 0 auto;
}

.wl-header-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 18px;
    background: linear-gradient(135deg, var(--saffron), var(--gold));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 24px rgba(232,96,28,0.28);
}

.wl-header-icon svg {
    width: 26px;
    height: 26px;
    color: #fff;
}

.wl-page-header h1 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(2.2rem, 5vw, 3rem);
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 10px;
    letter-spacing: -0.3px;
    transition: color 0.2s;
}

.wl-page-header h1:hover {
    color: var(--saffron);
}

.wl-page-header p {
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    color: var(--slate);
    line-height: 1.6;
}

/* ===== SECTION ===== */
.places-section {
    background: var(--mist);
    min-height: 50vh;
    padding: 10px 0 70px;
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
    display: flex;
    flex-direction: column;
    animation: cardIn 0.5s cubic-bezier(.23,1,.32,1) both;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow:
        0 4px 12px rgba(26,18,9,0.07),
        0 24px 60px rgba(26,18,9,0.14);
}

.card:nth-child(1)  { animation-delay: 0.04s; }
.card:nth-child(2)  { animation-delay: 0.08s; }
.card:nth-child(3)  { animation-delay: 0.12s; }
.card:nth-child(4)  { animation-delay: 0.16s; }
.card:nth-child(5)  { animation-delay: 0.20s; }
.card:nth-child(6)  { animation-delay: 0.24s; }
.card:nth-child(7)  { animation-delay: 0.28s; }
.card:nth-child(8)  { animation-delay: 0.32s; }

@keyframes cardIn {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
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

.card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(26,18,9,0.02)  0%,
        rgba(26,18,9,0.0)  40%,
        rgba(26,18,9,0.55) 100%
    );
    pointer-events: none;
    transition: opacity 0.4s ease;
}

.card:hover .card-overlay {
    opacity: 0.85;
}

/* ===== REMOVE FORM ===== */
.remove-form {
    position: absolute;
    top: 14px;
    right: 14px;
    z-index: 3;
}

/* ===== HEART BUTTON ===== */
.card-heart {
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
    padding: 0;
}

.card-heart svg {
    width: 17px;
    height: 17px;
    position: absolute;
    transition: opacity 0.25s ease, transform 0.3s cubic-bezier(.34,1.56,.64,1);
}

/* Default: outline visible */
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

/* Active (wishlisted): filled visible */
.card-heart.active .heart-outline {
    opacity: 0;
    transform: scale(0.5);
}

.card-heart.active .heart-filled {
    opacity: 1;
    transform: scale(1);
}

.card-heart:hover {
    background: #fff2ee;
    transform: scale(1.12);
}

/* Shake animation on remove hover */
@keyframes heartShake {
    0%,100% { transform: scale(1) rotate(0deg); }
    25%      { transform: scale(1.1) rotate(-8deg); }
    75%      { transform: scale(1.1) rotate(8deg); }
}

.card-heart:hover .heart-filled {
    animation: heartShake 0.4s ease;
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

.saved-tag {
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 500;
    color: var(--saffron);
    display: flex;
    align-items: center;
    gap: 6px;
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
    padding: 80px 30px;
    font-family: 'DM Sans', sans-serif;
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 24px;
    background: #FFF0E8;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-icon svg {
    width: 38px;
    height: 38px;
    color: #f0c0a0;
}

.empty-state h2 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 24px;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 10px;
}

.empty-state p {
    font-size: 15px;
    color: var(--slate);
    margin-bottom: 28px;
    max-width: 380px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.7;
}

.explore-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--saffron);
    color: #fff;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 500;
    padding: 12px 26px;
    border-radius: 50px;
    text-decoration: none;
    transition: background 0.25s ease, transform 0.2s ease, gap 0.2s ease;
    box-shadow: 0 6px 20px rgba(232,96,28,0.28);
}

.explore-link:hover {
    background: #cf5218;
    transform: translateY(-2px);
    gap: 11px;
}

/* ===== TOAST ===== */
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

.wl-toast.toast-removed {
    background: #f5f4f2;
    color: var(--slate);
    border: 1.5px solid rgba(75,68,54,0.18);
}

.wl-toast.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}

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
    .wl-page-header { padding: 40px 20px 32px; }
}
</style>

<script>
/* ── Confirm remove with toast feedback ── */
let toastTimer;

function showToast(msg, type) {
    const t = document.getElementById('wl-toast');
    clearTimeout(toastTimer);
    t.textContent = msg;
    t.className = 'wl-toast ' + type;
    requestAnimationFrame(() => t.classList.add('show'));
    toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
}

function confirmRemove(btn) {
    /* Animate heart out before form submits */
    btn.classList.remove('active');
    const card = btn.closest('.card');
    if (card) {
        card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
        card.style.opacity    = '0';
        card.style.transform  = 'scale(0.94)';
    }
    showToast('🤍  Removed from Wishlist', 'toast-removed');
    /* Let the animation play briefly before the form submits (native submit) */
    return true;
}
</script>

<?php include "includes/footer.php"; ?>