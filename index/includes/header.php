<?php
session_start();
include "../db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore India</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- ════════════════════════════════════════════════════════════
     HEADER
     ════════════════════════════════════════════════════════════ -->
<div class="header-container">

    <!-- Top utility bar -->
    <div class="header-topbar">
        <div class="topbar-left">
            <span><i class="fas fa-phone-alt"></i> +91 7397043171</span>
            <span><i class="fas fa-envelope"></i> hello@exploreindia.travel</span>
        </div>
        <div class="topbar-right">
            <span><i class="fas fa-clock"></i> Mon–Sun, 9 AM – 8 PM</span>
            <span class="topbar-divider">|</span>
            <span><i class="fas fa-globe"></i> India Tourism</span>
        </div>
    </div>

    <!-- Main header -->
    <div class="header-top">
        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
            <i class="fas fa-bars" id="hamburgerIcon"></i>
        </button>

        <a href="index.php" class="logo-section" style="text-decoration:none;">
            <div class="logo">
                <i class="fas fa-torii-gate"></i>
            </div>
            <div class="logo-text-wrap">
                <div class="logo-text">Explore <span class="logo-india">India</span></div>
                <div class="tagline">Discover Destinations, Culture &amp; Heritage</div>
            </div>
        </a>

        <div class="search-section">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" id="searchInput"
                       placeholder="Search destinations, heritage sites, hotels…">
                <span class="search-kbd">↵</span>
            </div>
        </div>

        <div class="user-section">
            <!-- Wishlist -->
            <div class="wishlist" id="wishlistBtn" onclick="wishlistClick()" title="My Wishlist">
                <i class="fas fa-heart"></i>
                <?php if (isset($_SESSION['user_id'])):
                    $res   = mysqli_query($conn,"SELECT COUNT(*) AS total FROM wishlist WHERE user_id='".$_SESSION['user_id']."'");
                    $count = mysqli_fetch_assoc($res)['total'];
                ?>
                    <span class="wishlist-count"><?= $count ?></span>
                <?php endif; ?>
            </div>

            <!-- User pill -->
            <div class="user-info">
                <div class="user-icon"><i class="fas fa-user"></i></div>
                <div class="user-text">
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <div class="user-name">Hello, <?= htmlspecialchars($_SESSION['user_name']) ?></div>
                        <a href="logout.php" onclick="return confirm('Do you really want to sign out?');"
                           style="text-decoration:none;">
                            <div class="login-text">Sign out</div>
                        </a>
                    <?php else: ?>
                        <div class="user-name">Welcome</div>
                        <a href="login.php" style="text-decoration:none;">
                            <div class="login-text">Sign in</div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div><!-- /header-top -->

    <!-- Navigation -->
    <div class="nav-container" id="navContainer">
        <div class="mobile-search" style="display:none;">
            <div class="search-container" style="padding:0;">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search destinations…">
            </div>
        </div>

        <?php
        include "../db.php";
        $currentCategory = isset($_GET['category']) ? $_GET['category'] : '';
        $categories = mysqli_query($conn,"SELECT * FROM categories ORDER BY id ASC");
        ?>

        <ul class="nav-menu" id="navMenu">
            <?php while ($cat = mysqli_fetch_assoc($categories)):
                $catId  = $cat['id'];
                $active = ($currentCategory == $catId) ? 'active' : '';
                $subs   = mysqli_query($conn,"SELECT * FROM sub_categories WHERE category_id='$catId' ORDER BY id ASC");
                $hasSub = mysqli_num_rows($subs) > 0;
            ?>
            <li class="nav-item <?= $hasSub ? 'has-sub' : '' ?>">
                <a href="category.php?category=<?= $catId ?>"
                   class="nav-link <?= $active ?>">
                    <?= htmlspecialchars($cat['category_name']) ?>
                    <?php if ($hasSub): ?>
                        <i class="fas fa-chevron-down arrow"></i>
                    <?php endif; ?>
                </a>
                <?php if ($hasSub): ?>
                <ul class="sub-menu">
                    <?php while ($sub = mysqli_fetch_assoc($subs)): ?>
                    <li>
                        <a href="subcategory.php?sub=<?= $sub['id'] ?>">
                            <i class="fas fa-map-pin sub-pin"></i>
                            <?= htmlspecialchars($sub['sub_category_name']) ?>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endwhile; ?>
        </ul>
    </div><!-- /nav-container -->

</div><!-- /header-container -->