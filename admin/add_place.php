<?php
include "../db.php";

if(isset($_POST['add_place'])){
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $name = $_POST['place_name'];
    $location = $_POST['location'];

    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp,"../uploads/$img");

    mysqli_query($conn,"INSERT INTO places(category_id,sub_category_id,place_name,location,image)
    VALUES('$category','$subcategory','$name','$location','$img')");

    header("Location: view_places.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Place</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<!-- MAIN CONTENT -->
<div class="main-content">

<h2>Add New Place</h2>  <br><br>

<div class="form-card">
<form method="post" enctype="multipart/form-data">

<select name="category" id="category" required>
<option value="">Select Category</option>
<?php
$cat = mysqli_query($conn,"SELECT * FROM categories");
while($c=mysqli_fetch_assoc($cat)){
?>
<option value="<?= $c['id'] ?>"><?= $c['category_name'] ?></option>
<?php } ?>
</select>

<select name="subcategory" id="subcategory" required>
<option value="">Select Sub Category</option>
</select>

<input type="text" name="place_name" placeholder="Place Name" required>
<input type="text" name="location" placeholder="Location">
<input type="file" name="image" required>

<button name="add_place">Add Place</button>
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
<style>/* MAIN CONTENT ALIGNMENT */
.main-content{
    margin-left: 260px;      /* sidebar width */
    padding: 100px 30px 30px; /* header height */
    /* background: #f6f8fb;
    min-height: 100vh; */
}

/* FORM CARD (TABLE-LIKE LOOK) */
.form-card{
    max-width: 600px;
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

/* FORM ELEMENTS */
.form-card select,
.form-card input{
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

/* BUTTON */
.form-card button{
    padding: 12px 18px;
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

.form-card button:hover{
    background: #1e40af;
}

    </style>
</body>
</html>
