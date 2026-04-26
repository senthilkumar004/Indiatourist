<?php
include "../db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sub Categories</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<main class="content">

    <div class="page-header">
        <h2>Sub Categories</h2>
        <a href="add_sub_category.php" class="add-btn">+ Add Sub Category</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $result = mysqli_query($conn, "
            SELECT sc.*, c.category_name
            FROM sub_categories sc
            JOIN categories c ON sc.category_id = c.id
            ORDER BY sc.id DESC
        ");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['sub_category_name']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="edit_sub_category.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                        <a href="delete_sub_category.php?id=<?php echo $row['id']; ?>"
                           class="delete-btn"
                           onclick="return confirm('Delete this sub category?')">
                           Delete
                        </a>
                    </td>
                </tr>
        <?php }
        } else { ?>
            <tr>
                <td colspan="5" align="center">No Sub Categories Found</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</main>
</body>
</html>
