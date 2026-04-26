<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Remove from wishlist
if (isset($_POST['remove_wishlist_id'])) {
    $wid = intval($_POST['remove_wishlist_id']);
    mysqli_query($conn, "DELETE FROM wishlist WHERE id = '$wid' AND user_id = '$user_id'");
    header("Location: wishlist.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>My Wishlist • Incredible India</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet"/>

    <style>
        :root {
            --primary: #d32f2f;        /* Indian saffron red */
            --primary-dark: #b71c1c;
            --accent: #f57c00;         /* Saffron accent */
            --dark: #1a1a1a;
            --light: #f8f5f2;
            --gold: #ffc107;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #fffaf0 0%, #f5f0e9 100%);
            color: var(--dark);
            min-height: 100vh;
            background-attachment: fixed;
        }

        .page-header {
            text-align: center;
            padding: 60px 20px 40px;
            background: linear-gradient(135deg, rgba(211,47,47,0.07) 0%, rgba(245,240,233,0.4) 100%);
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.4rem;
            color: var(--primary);
            margin-bottom: 12px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.08);
        }

        .page-header p {
            color: #555;
            font-size: 1.15rem;
            max-width: 580px;
            margin: 0 auto;
        }

        .wishlist-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 25px 60px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 30px;
        }

        .wishlist-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            background: white;
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
            transition: all 0.35s ease;
            transform: translateY(0);
        }

        .wishlist-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 22px 50px rgba(0,0,0,0.18);
        }

        .card-image {
            height: 260px;
            overflow: hidden;
            position: relative;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .wishlist-card:hover .card-image img {
            transform: scale(1.08);
        }

        .remove-btn-container {
            position: absolute;
            top: 18px;
            right: 18px;
            z-index: 10;
        }

        .remove-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255,255,255,0.92);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .remove-btn i {
            color: var(--primary);
            font-size: 1.4rem;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: var(--primary);
            transform: scale(1.1);
        }

        .remove-btn:hover i {
            color: white;
        }

        .card-content {
            padding: 22px 24px 28px;
        }

        .card-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.55rem;
            margin-bottom: 10px;
            color: var(--dark);
            line-height: 1.2;
        }

        .card-content p {
            color: #5c5c5c;
            font-size: 0.96rem;
            line-height: 1.55;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .empty-state {
            text-align: center;
            padding: 120px 30px;
            color: #666;
        }

        .empty-state i {
            font-size: 5.5rem;
            color: #ddd;
            margin-bottom: 25px;
        }

        .empty-state h2 {
            font-family: 'Playfair Display', serif;
            color: #777;
            margin-bottom: 18px;
        }

        @media (max-width: 992px) {
            .wishlist-container {
                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            }
        }

        @media (max-width: 680px) {
            .page-header h1 {
                font-size: 2.6rem;
            }
            .wishlist-container {
                padding: 0 15px 50px;
            }
        }
    </style>
</head>
<body>

<div class="page-header">
  <a href="index.php"  style="text-decoration:none;" >    <h1>My Wishlist</h1>  </a>
    <p>Your favourite destinations across Incredible India – places you dream to visit</p>
</div>

<div class="wishlist-container">

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
        <i class="far fa-heart"></i>
        <h2>Your Wishlist is Empty</h2>
        <p>Start exploring the beauty of India and add your dream destinations to your wishlist ❤️</p>
    </div>

<?php } else {

    while ($row = mysqli_fetch_assoc($query)) {

        $placeName = $row['place_name'] ?? 'Place not available';
        $desc      = $row['place_desc'] ?? 'No description available';
        $image     = !empty($row['place_image'])
                        ? "../uploads/" . htmlspecialchars($row['place_image'])
                        : "../assets/no-image.png";
?>

    <div class="wishlist-card">
        <div class="card-image">
            <img src="<?= $image ?>" alt="<?= htmlspecialchars($placeName) ?>">
        </div>

        <div class="remove-btn-container">
            <form method="post" class="remove-form">
                <input type="hidden" name="remove_wishlist_id" value="<?= $row['wishlist_id'] ?>">
                <button type="submit" class="remove-btn" title="Remove from Wishlist">
                    <i class="fas fa-heart"></i>
                </button>
            </form>
        </div>

        <div class="card-content">
            <h3><?= htmlspecialchars($placeName) ?></h3>
            <p><?= htmlspecialchars($desc) ?></p>
        </div>
    </div>

<?php 
    } 
} 
?>

</div>

</body>
</html>