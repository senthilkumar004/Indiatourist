<?php
include "../db.php";

if (isset($_POST['submit'])) {
    $category_id = $_POST['category_id'];
    $sub_category_name = $_POST['sub_category_name'];

    mysqli_query($conn, "
        INSERT INTO sub_categories (category_id, sub_category_name)
        VALUES ('$category_id', '$sub_category_name')
    ");

    header("Location: sub_category.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Sub Category</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<main class="content">

    <h2>Add Sub Category</h2>

    <form method="post" class="form">

        <label>Category</label>
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php
            $cat = mysqli_query($conn, "SELECT * FROM categories");
            while ($row = mysqli_fetch_assoc($cat)) {
                echo "<option value='{$row['id']}'>{$row['category_name']}</option>";
            }
            ?>
        </select>

        <label>Sub Category Name</label>
        <input type="text" name="sub_category_name" required>

        <button type="submit" name="submit" class="add-btn">
            Add Sub Category
        </button>

    </form>

</main>
</body>
</html>
