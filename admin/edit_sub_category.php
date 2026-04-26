<?php
include "../db.php";

$id = $_GET['id'];

// Fetch sub category details
$sub = mysqli_query($conn, "
    SELECT * FROM sub_categories WHERE id = '$id'
");
$data = mysqli_fetch_assoc($sub);

// Update logic
if (isset($_POST['update'])) {
    $category_id = $_POST['category_id'];
    $sub_category_name = $_POST['sub_category_name'];

    mysqli_query($conn, "
        UPDATE sub_categories 
        SET category_id = '$category_id',
            sub_category_name = '$sub_category_name'
        WHERE id = '$id'
    ");

    header("Location: sub_category.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Sub Category</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<main class="content">

    <h2>Edit Sub Category</h2>

    <form method="post" class="form">

        <label>Category</label>
        <select name="category_id" required>
            <?php
            $cat = mysqli_query($conn, "SELECT * FROM categories");
            while ($row = mysqli_fetch_assoc($cat)) {
                $selected = ($row['id'] == $data['category_id']) ? "selected" : "";
                echo "<option value='{$row['id']}' $selected>
                        {$row['category_name']}
                      </option>";
            }
            ?>
        </select>

        <label>Sub Category Name</label>
        <input type="text" name="sub_category_name"
               value="<?php echo $data['sub_category_name']; ?>" required>

        <button type="submit" name="update" class="add-btn">
            Update Sub Category
        </button>

    </form>

</main>
</body>
</html>
