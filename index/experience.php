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
<html>
<head>
    <title><?= $type ?> in India</title>
</head>
<body>

<h2 class="title"><?= $type ?> in India</h2>

<div class="card-container">
<?php while($row = mysqli_fetch_assoc($query)): ?>
    
    <div class="card">
        <div class="image-box">
            <img src="../uploads/<?= $row['image'] ?>">
            <span class="badge"><?= $row['sub_category_name'] ?></span>
        </div>

        <div class="card-body">
            
            <p class="location">📍 <?= $row['location'] ?></p>

            <p class="season">🌤 Best Time: <?= $row['best_season'] ?></p>

            <p class="desc">
                <?= substr($row['short_description'],0,100) ?>...
            </p>

            <div class="card-footer">
                <span class="rating">⭐ <?= $row['rating'] ?></span>

                <a href="<?= $row['google_map_link'] ?>" target="_blank" class="map-btn">
                    View Map
                </a>
            </div>

        </div>
    </div>

<?php endwhile; ?>
</div>

<style>

/* TITLE */
.title{
    text-align: center;
    margin: 30px 0;
    font-size: 28px;
    font-weight: 600;
}

/* GRID - 4 CARDS */
.card-container{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    padding: 20px 40px;
}

/* CARD */
.card{
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.card:hover{
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

/* IMAGE */
.image-box{
    position: relative;
}

.image-box img{
    width: 100%;
    height: 180px;
    object-fit: cover;
}

/* BADGE */
.badge{
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(0,0,0,0.6);
    color: #fff;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
}

/* BODY */
.card-body{
    padding: 15px;
}

.location{
    font-weight: 500;
    margin-bottom: 5px;
}

.season{
    font-size: 13px;
    color: #666;
    margin-bottom: 10px;
}

.desc{
    font-size: 14px;
    color: #444;
    line-height: 1.5;
    margin-bottom: 15px;
}

/* FOOTER */
.card-footer{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* RATING */
.rating{
    font-weight: bold;
    color: #f59e0b;
}

/* BUTTON */
.map-btn{
    text-decoration: none;
    padding: 6px 12px;
    background: #2563eb;
    color: #fff;
    border-radius: 6px;
    font-size: 13px;
    transition: 0.2s;
}

.map-btn:hover{
    background: #1e40af;
}

/* RESPONSIVE */

/* Tablet */
@media (max-width: 1024px){
    .card-container{
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile */
@media (max-width: 600px){
    .card-container{
        grid-template-columns: 1fr;
    }
}

</style>

</body>
</html>