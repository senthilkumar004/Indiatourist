<?php
session_start();
include "../db.php";
?>


<?php
include "../db.php";

$subId = $_GET['sub'];

$places = mysqli_query($conn, "
    SELECT * FROM place1 
    WHERE sub_category_id = '$subId'
    ORDER BY id DESC
");
?>




<!DOCTYPE html>
<html lang="en">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incredible India</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }


        /* Light glassmorphism header container */
        .header-container {
            width: 100%;
           position: sticky;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
           
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 
                0 10px 30px rgba(0, 0, 0, 0.08),
                0 1px 3px rgba(0, 0, 0, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
            /* overflow: hidden; */
            color: #333;
            z-index: 10000;
        }

        /* Top header section */
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 30px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            background: rgba(44, 205, 44, 0.4);
        }

        /* Logo section */
        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-shrink: 0;
        }

        .logo {
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, #FF9933, #FFFFFF, #138808);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #000;
            box-shadow: 
                0 6px 15px rgba(0, 0, 0, 0.08),
                inset 0 1px 2px rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
            box-shadow: 
                0 8px 20px rgba(0, 0, 0, 0.12),
                inset 0 1px 2px rgba(255, 255, 255, 0.8);
        }

        .logo-text {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(90deg, #FF9933, #138808);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 0.3px;
        }

        .tagline {
            font-size: 12px;
            color: #666;
            font-weight: 500;
            margin-top: 2px;
            letter-spacing: 0.5px;
        }

        /* Search section - Centered */
        .search-section {
            flex: 1;
            max-width: 600px;
            margin: 0 30px;
            position: relative;
        }

        .search-container {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 14px 20px 14px 52px;
            border-radius: 50px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.8);
            color: #333;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: 
                0 4px 12px rgba(0, 0, 0, 0.03),
                inset 0 1px 2px rgba(255, 255, 255, 0.8);
        }

        .search-input::placeholder {
            color: #888;
            font-weight: 500;
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 
                0 6px 18px rgba(0, 0, 0, 0.08),
                inset 0 1px 2px rgba(255, 255, 255, 0.9);
            border-color: rgba(255, 153, 51, 0.4);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 16px;
            z-index: 1;
        }

        /* User section */
        .user-section {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-shrink: 0;
        }

        .wishlist {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .wishlist:hover {
            background: rgba(255, 240, 245, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 107, 129, 0.1);
            border-color: rgba(255, 107, 129, 0.2);
        }

        .wishlist i {
            font-size: 20px;
            color: #ff6b81;
        }

        .wishlist-count {
            position: absolute;
            top: -6px;
            right: -6px;
            background: linear-gradient(135deg, #ff6b81, #ff4757);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 8px rgba(255, 107, 129, 0.3);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.7);
            padding: 8px 18px 8px 14px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .user-info:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
            border-color: rgba(255, 153, 51, 0.2);
        }

        .user-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF9933, #138808);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .user-name {
            font-weight: 600;
            font-size: 15px;
            color: #333;
            letter-spacing: 0.3px;
        }

        .login-text {
            font-size: 12px;
            color: #666;
            margin-top: 1px;
        } 

.card {
    position: relative;
}

.card-heart {
    position: absolute;
    top: 14px;
    right: 14px;
    width: 38px;
    height: 38px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 5px 12px rgba(0,0,0,.15);
    transition: .3s;
}

.card-heart i {
    color: #ff6b81;
    font-size: 16px;
}

.card-heart:hover {
    transform: scale(1.15);
}


/* =========================
   RESPONSIVE FIXES
   ========================= */

/* Tablets & small laptops */
@media (max-width: 1024px) {
    .header-top {
        padding: 14px 20px;
        gap: 16px;
    }

    .logo {
        width: 56px;
        height: 56px;
        font-size: 22px;
    }

    .logo-text {
        font-size: 24px;
    }

    .search-section {
        max-width: 420px;
        margin: 0 15px;
    }

    .search-input {
        padding: 12px 18px 12px 46px;
        font-size: 14px;
    }

    .wishlist,
    .user-icon {
        width: 44px;
        height: 44px;
    }
}

/* Mobile devices */
@media (max-width: 768px) {
    .header-top {
        flex-wrap: wrap;
        padding: 12px 16px;
    }

    /* Logo row */
    .logo-section {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }

    .logo {
        width: 52px;
        height: 52px;
    }

    .logo-text {
        font-size: 22px;
    }

    .tagline {
        display: none;
    }

    /* Search full width */
    .search-section {
        width: 100%;
        max-width: 100%;
        margin: 10px 0;
    }

    .search-input {
        width: 100%;
        padding: 12px 16px 12px 44px;
        font-size: 14px;
    }

    /* User & wishlist row */
    .user-section {
        width: 100%;
        justify-content: space-between;
        margin-top: 8px;
    }

    .user-info {
        padding: 6px 14px;
    }

    .user-name {
        font-size: 14px;
    }

    .login-text {
        font-size: 11px;
    }
}

/* Small mobile phones */
@media (max-width: 480px) {
    .header-top {
        padding: 10px 12px;
    }

    .logo {
        width: 46px;
        height: 46px;
        font-size: 20px;
    }

    .logo-text {
        font-size: 20px;
    }

    .wishlist {
        width: 42px;
        height: 42px;
    }

    .wishlist-count {
        width: 18px;
        height: 18px;
        font-size: 10px;
    }

    .user-info {
        padding: 6px 12px;
    }
}

/* =========================
   CARD HEART RESPONSIVE
   ========================= */

@media (max-width: 768px) {
    .card-heart {
        width: 34px;
        height: 34px;
        top: 10px;
        right: 10px;
    }

    .card-heart i {
        font-size: 15px;
    }
}

@media (max-width: 480px) {
    .card-heart {
        width: 32px;
        height: 32px;
        top: 8px;
        right: 8px;
    }

    .card-heart i {
        font-size: 14px;
    }
}



        </style>

    <div class="header-container">
        <!-- Top section with logo, search, and user info -->
        <div class="header-top">
            <!-- Logo section - Left side -->
         <a href="index.php"  style="text-decoration:none;" >   <div class="logo-section">
                <div class="logo">
                    <i class="fas fa-torii-gate"></i>
                </div>
                <div>
                    <div class="logo-text">Explore India</div>
                    <div class="tagline">Discover Destinations, Culture & Heritage</div>
                </div>
            </div>
</a>
            <!-- Search section - Center -->
            <div class="search-section">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search destinations, heritage sites, hotels...">
                </div>
            </div>

            <!-- User section - Right side -->
            <div class="user-section">

    <!-- Wishlist Icon (always visible) -->
    <div class="wishlist" id="wishlistBtn" onclick="wishlistClick()">
        <i class="fas fa-heart"></i>

        <?php if (isset($_SESSION['user_id'])):
            $res = mysqli_query($conn,
                "SELECT COUNT(*) AS total 
                 FROM wishlist 
                 WHERE user_id='".$_SESSION['user_id']."'"
            );
            $count = mysqli_fetch_assoc($res)['total'];
        ?>
            <span class="wishlist-count"><?= $count ?></span>
        <?php endif; ?>
    </div>

    <!-- User Info -->
    <div class="user-info">
        <div class="user-icon">
            <i class="fas fa-user"></i>
        </div>
        <div>
            <?php if(isset($_SESSION['user_name'])): ?>
                <div class="user-name">
                    Hello, <?= htmlspecialchars($_SESSION['user_name']); ?>
                </div>
                <a href="logout.php" onclick="return confirm('Do you really want to sign out?');">
                    <div class="login-text">Sign out</div>
                </a>
            <?php else: ?>
                <div class="user-name">Welcome</div>
                <a href="login.php">
                    <div class="login-text">Sign in</div>
                </a>
            <?php endif; ?>
        </div>
    </div>

</div>
                </div>
                <!-- Mobile menu button -->
               
            </div>
        </div>





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