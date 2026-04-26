<?php
include "../db.php";

if(isset($_POST['submit']) && !empty($_POST['sub_category_id'])){

    $sub_category_id = $_POST['sub_category_id'];
    $type = $_POST['experience_type'];
    $season = $_POST['best_season'];
    $location = $_POST['location'];
    $desc = $_POST['short_description'];
    $rating = $_POST['rating'];
    $map = $_POST['google_map_link'];

    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../uploads/$img");

    mysqli_query($conn, "INSERT INTO experience_places
    (sub_category_id, experience_type, best_season, short_description, location, rating, google_map_link, image)
    VALUES
    ('$sub_category_id','$type','$season','$desc','$location','$rating','$map','$img')");

    header("Location: experience_places.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Experience</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<!-- MAIN CONTENT -->
<div class="main-content">

<h2>Add Experience</h2> <br><br>

<div class="form-card">
<form method="POST" enctype="multipart/form-data">

<!-- STATE -->
<select name="sub_category_id" required>
<option value="">Select State</option>
<?php
$states = mysqli_query($conn,"SELECT * FROM sub_categories");
while($s = mysqli_fetch_assoc($states)){
?>
<option value="<?= $s['id'] ?>">
    <?= $s['sub_category_name'] ?>
</option>
<?php } ?>
</select>

<!-- TYPE -->
<select name="experience_type">
<option>Beaches</option>
<option>Hill Stations</option>
<option>Heritage</option>
<option>Festivals</option>
<option>Adventure</option>
<option>Food</option>
<option>Wildlife</option>
<option>Pilgrimage</option>
</select>

<input type="text" name="best_season" placeholder="Best Season">
<input type="text" name="location" placeholder="Location">

<textarea name="short_description" placeholder="Description"></textarea>

<input type="number" step="0.1" name="rating" placeholder="Rating">

<input type="text" name="google_map_link" placeholder="Google Map Link">

<input type="file" name="image" required>

<button type="submit" name="submit">Add Experience</button>

</form>
</div>

</div>

<!-- SAME STYLE AS ADD PLACE -->
<style>
.main-content{
    margin-left: 260px;
    padding: 100px 30px 30px;
}

.form-card{
    max-width: 600px;
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.form-card select,
.form-card input,
.form-card textarea{
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

.form-card textarea{
    height: 100px;
    resize: none;
}

.form-card button{
    padding: 12px 18px;
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.form-card button:hover{
    background: #1e40af;
}
</style>

</body>
</html>