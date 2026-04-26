<?php
include "../db.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM categories WHERE id=$id"));

if(isset($_POST['update'])){
    $name = $_POST['category_name'];

    $update = "UPDATE categories SET category_name='$name' WHERE id=$id";
    if(mysqli_query($conn, $update)){
        header("Location: category.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Category</title>
<link rel="stylesheet" href="admin.css">
</head>

<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<main class="content">
    <h2>Edit Category</h2>

    <form method="POST">
        <label>Category Name:</label>
        <input type="text" name="category_name" value="<?php echo $data['category_name']; ?>" required>

        <button type="submit" name="update" class="edit-btn">Update</button>
    </form>
</main>

</body>
</html>
