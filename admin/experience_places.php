<?php
include "../db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Experience Places</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<main class="content">

    <div class="page-header">
        <h2>Experience Places</h2>
        <a href="add_experience_place.php" class="add-btn">+ Add Experience</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>State</th>
                <th>Type</th>
                <th>Location</th>
                <th>Rating</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $result = mysqli_query($conn, "
            SELECT ep.*, sc.sub_category_name
            FROM experience_places ep
            JOIN sub_categories sc 
            ON ep.sub_category_id = sc.id
            ORDER BY ep.id DESC
        ");

        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['sub_category_name']; ?></td>
                <td><?= $row['experience_type']; ?></td>
                <td><?= $row['location']; ?></td>
                <td><?= $row['rating']; ?></td>
                <td>
                    <img src="../uploads/<?= $row['image']; ?>" width="80">
                </td>
                <td>
                    <a href="edit_experience_place.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                    <a href="delete_experience_place.php?id=<?= $row['id']; ?>" 
                       class="delete-btn"
                       onclick="return confirm('Delete this item?')">
                       Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</main>
</body>
</html>