<?php
include "../db.php";

// Count Categories
$cat_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM categories"))['total'];

// Count Sub Categories
$subcat_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM sub_categories"))['total'];

// Count Tourist Places
$places_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM places"))['total'];

// Count Users
$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];

// Count Sub Places (if you have another table, e.g., sub_places)
$subplaces_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM place1"))['total'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - India Tourism</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="admin.css">
    <style>
        /* Reset & Base Styles */
       
    </style>
</head>
<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<!-- Hamburger Menu Toggle -->
<!-- <button class="menu-toggle" id="menuBtn">
    <i class="fas fa-bars"></i>
</button> -->

<!-- Header -->
<!-- <header class="header">
    <div class="logo">INDIA TOURISM</div>
    
    <div class="admin-profile">
        <img src="https://ui-avatars.com/api/?name=Admin+User&background=667eea&color=fff&bold=true&size=128" alt="Profile">
        <span>Admin User</span>
    </div>
</header> -->

<!-- Sidebar -->
<!-- <aside class="sidebar" id="sidebar">
    <ul>
        <li><a href="admin.php" ><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
        <li><a href="category.php"><i class="fas fa-layer-group"></i> <span>Category</span></a></li>
        <li><a href="#"><i class="fas fa-folder-open"></i> <span>Sub Category</span></a></li>
        <li><a href="#"><i class="fas fa-map-marked-alt"></i> <span>Tourist Places</span></a></li>
        <li><a href="#"><i class="fas fa-users"></i> <span>Users</span></a></li>
        <li><a href="#"><i class="fas fa-chart-bar"></i> <span>Analytics</span></a></li>
        <li><a href="#"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
        <li><a href="#"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
    </ul>
</aside> -->

<!-- Content -->
<main class="content" id="content">
    <div class="welcome-section">
        <h1>Welcome to Admin Panel</h1>
       
    </div>
    
    <div class="dashboard-cards">
    <div class="card">
        <div class="card-header">
            <h3>Categories</h3>
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="card-content">
            <h2><?= $cat_count ?></h2>
            <p>Total categories added</p>
        </div>
    </div>
    
    <div class="card subcategory">
        <div class="card-header">
            <h3>Sub Categories</h3>
            <i class="fas fa-folder-open"></i>
        </div>
        <div class="card-content">
            <h2><?= $subcat_count ?></h2>
            <p>Total sub categories</p>
        </div>
    </div>
    
    <div class="card places">
        <div class="card-header">
            <h3>Tourist Places</h3>
            <i class="fas fa-map-marked-alt"></i>
        </div>
        <div class="card-content">
            <h2><?= $places_count ?></h2>
            <p>Places listed</p>
        </div>
    </div>

    <div class="card users">
        <div class="card-header">
            <h3>Users</h3>
            <i class="fas fa-users"></i>
        </div>
        <div class="card-content">
            <h2><?= $user_count ?></h2>
            <p>Total registered users</p>
        </div>
    </div>

    <div class="card subplaces">
        <div class="card-header">
            <h3>Sub Places</h3>
            <i class="fas fa-map-pin"></i>
        </div>
        <div class="card-content">
            <h2><?= $subplaces_count ?></h2>
            <p>Total sub places</p>
        </div>
    </div>
</div>

</main>


</body>
</html>