<?php
include "../db.php";

if(isset($_POST['add'])){
    $name = $_POST['category_name'];

    $query = "INSERT INTO categories (category_name) VALUES ('$name')";
    if(mysqli_query($conn, $query)){
        header("Location: category.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>
<link rel="stylesheet" href="admin.css">
</head>

<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<main class="content">
    <h2>Add Category</h2>

    <form method="POST">
        <label>Category Name:</label>
        <input type="text" name="category_name" required>

        <button type="submit" name="add" class="add-btn">Add</button>
    </form>
</main>

</body>
</html>
