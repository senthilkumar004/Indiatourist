<?php
include "../db.php";  // your DB connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Category Management</title>
<link rel="stylesheet" href="admin.css">
</head>

<body>



<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<main class="content">

    <div class="page-header">
        <h2>Categories</h2>
        <a href="add_category.php" class="add-btn">+ Add Category</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>

                        <!-- Category ID for user display (you can format it like CAT001) -->
                        <td><?php echo "CAT" . str_pad($row['id'], 3, "0", STR_PAD_LEFT); ?></td>

                        <td><?php echo $row['category_name']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>

                        <td>
                            <a href="edit_category.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                            <a href="delete_category.php?id=<?php echo $row['id']; ?>" class="delete-btn"
                               onclick="return confirm('Are you sure you want to delete this category?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No categories found</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

</body>
</html>
