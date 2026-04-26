<?php
include "../db.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM experience_places WHERE id='$id'"
));

if(isset($_POST['update'])){

    $sub_category_id = $_POST['sub_category_id'];
    $type = $_POST['experience_type'];
    $season = $_POST['best_season'];
    $location = $_POST['location'];
    $desc = $_POST['short_description'];
    $rating = $_POST['rating'];
    $map = $_POST['google_map_link'];

    // Image update (optional)
    if(!empty($_FILES['image']['name'])){
        $img = time()."_".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$img);
    } else {
        $img = $data['image'];
    }

    mysqli_query($conn, "
        UPDATE experience_places SET
        sub_category_id='$sub_category_id',
        experience_type='$type',
        best_season='$season',
        location='$location',
        short_description='$desc',
        rating='$rating',
        google_map_link='$map',
        image='$img'
        WHERE id='$id'
    ");

    header("Location: experience_places.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Experience</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<main class="content">

<h2>Edit Experience</h2>

<form method="POST" enctype="multipart/form-data">

<label>State</label>
<select name="sub_category_id">
<?php
$states = mysqli_query($conn,"SELECT * FROM sub_categories");
while($s = mysqli_fetch_assoc($states)){
    $selected = ($s['id'] == $data['sub_category_id']) ? "selected" : "";
    echo "<option value='{$s['id']}' $selected>{$s['sub_category_name']}</option>";
}
?>
</select>

<label>Experience Type</label>
<input type="text" name="experience_type" value="<?= $data['experience_type']; ?>">

<label>Best Season</label>
<input type="text" name="best_season" value="<?= $data['best_season']; ?>">

<label>Location</label>
<input type="text" name="location" value="<?= $data['location']; ?>">

<label>Description</label>
<textarea name="short_description"><?= $data['short_description']; ?></textarea>

<label>Rating</label>
<input type="number" step="0.1" name="rating" value="<?= $data['rating']; ?>">

<label>Google Map Link</label>
<input type="text" name="google_map_link" value="<?= $data['google_map_link']; ?>">

<label>Image</label>
<input type="file" name="image">
<br>
<img src="../uploads/<?= $data['image']; ?>" width="100">

<br><br>
<button type="submit" name="update" class="add-btn">Update</button>

</form>

</main>
</body>
</html>