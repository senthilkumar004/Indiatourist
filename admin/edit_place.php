<?php
include "../db.php";

$id = $_GET['id'];

// Fetch existing place data
$place_q = mysqli_query($conn,"
SELECT * FROM places WHERE id='$id'
");
$place = mysqli_fetch_assoc($place_q);

// Update place
if(isset($_POST['update_place'])){

    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $name = $_POST['place_name'];
    $location = $_POST['location'];

    // Image update (optional)
    if($_FILES['image']['name'] != ""){
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp,"../uploads/$img");

        mysqli_query($conn,"UPDATE places SET
            category_id='$category',
            sub_category_id='$subcategory',
            place_name='$name',
            location='$location',
            image='$img'
            WHERE id='$id'
        ");
    }else{
        mysqli_query($conn,"UPDATE places SET
            category_id='$category',
            sub_category_id='$subcategory',
            place_name='$name',
            location='$location'
            WHERE id='$id'
        ");
    }

    header("Location: view_places.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Place</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<!-- MAIN CONTENT -->
<div class="main-content">

<h2>Edit Place</h2>
<br><br>
<div class="form-card">
<form method="post" enctype="multipart/form-data">

<!-- CATEGORY -->
<select name="category" id="category" required>
<option value="">Select Category</option>
<?php
$cat = mysqli_query($conn,"SELECT * FROM categories");
while($c=mysqli_fetch_assoc($cat)){
    $selected = ($c['id']==$place['category_id']) ? "selected" : "";
?>
<option value="<?= $c['id'] ?>" <?= $selected ?>>
    <?= $c['category_name'] ?>
</option>
<?php } ?>
</select>

<!-- SUB CATEGORY -->
<select name="subcategory" id="subcategory" required>
<option value="">Select Sub Category</option>
<?php
$sub = mysqli_query($conn,"
SELECT * FROM sub_categories 
WHERE category_id='{$place['category_id']}'
");
while($s=mysqli_fetch_assoc($sub)){
    $sel = ($s['id']==$place['sub_category_id']) ? "selected" : "";
?>
<option value="<?= $s['id'] ?>" <?= $sel ?>>
    <?= $s['sub_category_name'] ?>
</option>
<?php } ?>
</select>

<input type="text" name="place_name" value="<?= $place['place_name'] ?>" required>
<input type="text" name="location" value="<?= $place['location'] ?>">

<img src="../uploads/<?= $place['image'] ?>" width="120" style="margin:10px 0">

<input type="file" name="image">

<button name="update_place">Update Place</button>

</form>
</div>

</div>

<script>
document.getElementById("category").addEventListener("change", function(){
    fetch("get_subcategories.php?cat_id="+this.value)
    .then(res=>res.text())
    .then(data=>document.getElementById("subcategory").innerHTML=data);
});
</script>


<style>
    .main-content{
    margin-left: 260px;
    padding: 100px 30px 30px;
    /* background: #f6f8fb;
    min-height: 100vh; */
}

.form-card{
    max-width: 650px;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.form-card select,
.form-card input{
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
}

.form-card button{
    padding: 12px 18px;
    background: #16a34a;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.form-card button:hover{
    background: #15803d;
}

</style>
</body>
</html>
