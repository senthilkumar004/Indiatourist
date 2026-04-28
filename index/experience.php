


<?php include "includes/header.php"; ?>

<?php
include "../db.php";

$type = $_GET['type'];

$query = mysqli_query($conn, "
    SELECT ep.*, s.sub_category_name
    FROM experience_places ep
    JOIN sub_categories s ON ep.sub_category_id = s.id
    WHERE ep.experience_type = '$type'
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?= htmlspecialchars($type) ?> in India | Luxury Travel Guide</title>
    <!-- Google Fonts + Font Awesome for premium icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f8fafc;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            line-height: 1.5;
        }

        /* premium background pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.3;
            pointer-events: none;
            z-index: -1;
        }

        /* === HERO SECTION (premium intro) === */
        .experience-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 60px 40px 70px;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 40px;
        }

        .experience-hero::after {
            content: "✦";
            font-size: 280px;
            color: rgba(255,255,255,0.03);
            position: absolute;
            bottom: -40px;
            right: -30px;
            font-family: serif;
            pointer-events: none;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255,215,0,0.2);
            backdrop-filter: blur(6px);
            padding: 6px 18px;
            border-radius: 40px;
            font-size: 13px;
            letter-spacing: 1px;
            font-weight: 500;
            color: #facc15;
            margin-bottom: 20px;
            border: 0.5px solid rgba(250,204,21,0.3);
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 52px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.02em;
            margin-bottom: 18px;
        }

        .hero-title span {
            background: linear-gradient(120deg, #fbbf24, #f59e0b);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .hero-sub {
            color: #cbd5e1;
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
            font-weight: 400;
        }

        /* stats / meta line (premium touch) */
        .destination-stats {
            display: flex;
            justify-content: center;
            gap: 32px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.08);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 14px;
            color: #e2e8f0;
        }

        .stat-item i {
            color: #facc15;
            font-size: 14px;
        }

        /* === MODERN CARD GRID : Premium magazine style === */
        .journey-grid {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 40px 60px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 32px;
        }

        /* card — glassmorphism meets elegant shadows */
        .destination-card {
            background: rgba(255, 255, 255, 0.96);
            border-radius: 28px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0,0,0,0.02);
            backdrop-filter: blur(0px);
            border: 1px solid rgba(255,255,255,0.6);
            position: relative;
        }

        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 45px -18px rgba(0, 0, 0, 0.2);
            border-color: rgba(250,204,21,0.4);
        }

        /* image container with overlay gradient */
        .card-media {
            position: relative;
            height: 240px;
            overflow: hidden;
            background: #eef2ff;
        }

        .card-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .destination-card:hover .card-media img {
            transform: scale(1.05);
        }

        /* category badge (replaces old badge, more elegant) */
        .category-badge {
            position: absolute;
            top: 18px;
            left: 18px;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(4px);
            padding: 6px 16px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            z-index: 2;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .category-badge i {
            font-size: 11px;
            color: #facc15;
        }

        /* rating pill on image corner */
        .rating-pill {
            position: absolute;
            bottom: 16px;
            right: 18px;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(8px);
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            color: #ffd966;
            display: flex;
            align-items: center;
            gap: 5px;
            z-index: 2;
        }

        .rating-pill i {
            font-size: 12px;
            color: #fbbf24;
        }

        /* card content */
        .card-content {
            padding: 22px 22px 24px;
        }

        .location-head {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .location-icon {
            color: #ef4444;
            font-size: 14px;
        }

        .location-name {
            font-weight: 600;
            font-size: 18px;
            letter-spacing: -0.2px;
            color: #0f172a;
        }

        .season-chip {
            background: #f1f5f9;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
            color: #334155;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 14px;
            width: fit-content;
        }

        .season-chip i {
            color: #38bdf8;
            font-size: 11px;
        }

        .description-text {
            font-size: 14px;
            line-height: 1.55;
            color: #334155;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* card footer with premium map button */
        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eef2ff;
            padding-top: 18px;
            margin-top: 6px;
        }

        .explore-link {
            background: linear-gradient(100deg, #0f172a, #1e293b);
            color: white;
            padding: 8px 20px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            letter-spacing: 0.2px;
            border: none;
            cursor: pointer;
        }

        .explore-link i {
            font-size: 12px;
            transition: transform 0.2s;
        }

        .explore-link:hover {
            background: linear-gradient(100deg, #f59e0b, #d97706);
            box-shadow: 0 6px 12px -8px rgba(245,158,11,0.4);
        }

        .explore-link:hover i {
            transform: translateX(4px);
        }

        /* secondary rating small (for extra style) */
        .rating-mini {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            font-weight: 500;
            color: #fbbf24;
            background: #fffbeb;
            padding: 5px 10px;
            border-radius: 30px;
        }

        /* empty state / fallback */
        .empty-message {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 48px;
            margin: 40px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
        }

        .empty-message i {
            font-size: 56px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        /* responsive refinements */
        @media (max-width: 1024px) {
            .journey-grid {
                gap: 24px;
                padding: 20px 24px 50px;
            }
            .hero-title {
                font-size: 42px;
            }
        }

        @media (max-width: 768px) {
            .experience-hero {
                padding: 48px 24px 56px;
            }
            .hero-title {
                font-size: 32px;
            }
            .hero-sub {
                font-size: 15px;
            }
            .destination-stats {
                gap: 18px;
            }
            .journey-grid {
                grid-template-columns: 1fr;
                gap: 28px;
            }
        }

        @media (max-width: 480px) {
            .card-content {
                padding: 18px;
            }
            .location-name {
                font-size: 16px;
            }
        }

        /* subtle micro-animation */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .destination-card {
            animation: fadeSlideUp 0.5s ease forwards;
            opacity: 0;
        }

        .destination-card:nth-child(1) { animation-delay: 0.05s; }
        .destination-card:nth-child(2) { animation-delay: 0.1s; }
        .destination-card:nth-child(3) { animation-delay: 0.15s; }
        .destination-card:nth-child(4) { animation-delay: 0.2s; }
        .destination-card:nth-child(5) { animation-delay: 0.25s; }
        .destination-card:nth-child(6) { animation-delay: 0.3s; }
    </style>
</head>
<body>

<?php
// original db include and query logic remains untouched, but with security hardening
include "../db.php";

// sanitize input to prevent SQL injection — preserving functionality but making it secure
$type = isset($_GET['type']) ? trim($_GET['type']) : '';
$safe_type = mysqli_real_escape_string($conn, $type);

$query = mysqli_query($conn, "
    SELECT ep.*, s.sub_category_name
    FROM experience_places ep
    JOIN sub_categories s ON ep.sub_category_id = s.id
    WHERE ep.experience_type = '$safe_type'
");

// optional: count results for dynamic stats
$total_results = mysqli_num_rows($query);
?>

<!-- PREMIUM HERO SECTION with dynamic type info -->
<div class="experience-hero">
    <div class="hero-badge">
        <i class="fas fa-map-marked-alt"></i> INDIAN HERITAGE & EXPERIENCES
    </div>
    <h1 class="hero-title">
        Discover <span><?= htmlspecialchars($type) ?></span> in India
    </h1>
    <p class="hero-sub">
        From timeless landscapes to soulful journeys — curated experiences that redefine travel.
    </p>
    <div class="destination-stats">
        <div class="stat-item"><i class="fas fa-location-dot"></i> <?= $total_results ?> Authentic Places</div>
        <div class="stat-item"><i class="fas fa-calendar-alt"></i> Best seasons mapped</div>
        <div class="stat-item"><i class="fas fa-star"></i> Expert ratings</div>
    </div>
</div>

<!-- CARD GRID: New premium design, same PHP logic unchanged -->
<div class="journey-grid">
    <?php if(mysqli_num_rows($query) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($query)): 
            // use original data with proper escaping for safety
            $image_name = htmlspecialchars($row['image']);
            $sub_cat = htmlspecialchars($row['sub_category_name']);
            $location = htmlspecialchars($row['location']);
            $best_season = htmlspecialchars($row['best_season']);
            $short_desc = htmlspecialchars($row['short_description']);
            $rating = floatval($row['rating']);
            $map_link = htmlspecialchars($row['google_map_link']);
            // truncate description properly (original substr logic kept but safe)
            $display_desc = strlen($short_desc) > 100 ? substr($short_desc, 0, 100) . '...' : $short_desc;
        ?>
            <div class="destination-card">
                <div class="card-media">
                    <img src="../uploads/<?= $image_name ?>" alt="<?= $location ?>, India" loading="lazy">
                    <!-- elegant category badge -->
                    <div class="category-badge">
                        <i class="fas fa-tag"></i> <?= $sub_cat ?>
                    </div>
                    <!-- rating pill on image -->
                    <div class="rating-pill">
                        <i class="fas fa-star"></i> <?= number_format($rating, 1) ?>
                    </div>
                </div>
                <div class="card-content">
                    <div class="location-head">
                        <i class="fas fa-map-pin location-icon"></i>
                        <span class="location-name"><?= $location ?></span>
                    </div>
                    <div class="season-chip">
                        <i class="fas fa-cloud-sun"></i> Best time: <?= $best_season ?>
                    </div>
                    <p class="description-text">
                        <?= nl2br($display_desc) ?>
                    </p>
                    <div class="card-actions">
                        <!-- hidden rating preserved as a subtle badge but also separate style -->
                        <div class="rating-mini">
                            <i class="fas fa-star-half-alt"></i> <?= number_format($rating, 1) ?> · experience
                        </div>
                        <a href="<?= $map_link ?>" target="_blank" class="explore-link" rel="noopener noreferrer">
                            <span>View on Map</span> <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <!-- elegant empty state -->
        <div class="empty-message" style="grid-column: 1/-1;">
            <i class="fas fa-compass"></i>
            <h3 style="font-family: 'Playfair Display'; margin-top: 12px;">No experiences found</h3>
            <p style="color: #475569; margin-top: 8px;">We're curating amazing <?= htmlspecialchars($type) ?> destinations. Check back soon!</p>
        </div>
    <?php endif; ?>
</div>

<!-- small decorative wave / footer indication (premium minimal) -->
<div style="text-align: center; padding: 30px 20px 45px; border-top: 1px solid #e2e8f0; margin-top: 10px; background: white;">
    <p style="font-size: 13px; color: #64748b;">
        <i class="fas fa-route"></i> Handpicked by travel experts · Authentic recommendations
    </p>
</div>

</body>
</html>

<?php include "includes/footer.php"; ?>