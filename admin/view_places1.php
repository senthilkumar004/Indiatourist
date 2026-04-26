<?php
include "../db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Places</title>
    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>

    <style>
        body{
            font-family: Inter, sans-serif;
            background:#f6f8fb;
        }

        .main-content{
            margin-left:260px;
            padding:100px 30px 30px;
            min-height:100vh;
        }

        .card{
            background:#fff;
            padding:25px;
            border-radius:14px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
        }

        .card h2{
            margin-bottom:20px;
            font-size:22px;
            color:#0f172a;
        }

        table{
            width:100%;
            border-collapse:collapse;
            font-size:14px;
        }

        thead{
            background:#f1f5f9;
        }

        th,td{
            padding:14px;
            border-bottom:1px solid #e5e7eb;
            text-align:left;
        }

        td img{
            width:90px;
            height:60px;
            object-fit:cover;
            border-radius:8px;
        }
.edit-btn,
.delete-btn {
    pointer-events: auto !important;
    position: relative;
    z-index: 1001;
}

    
        .edit-btn, .delete-btn{
    display:inline-block;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
}

.edit-btn{ background:#2563eb; color:#fff; }
.delete-btn{ background:#dc2626; color:#fff; }
td {
    word-wrap: break-word;
    max-width: 250px;
}

    </style>
</head>

<body>

<div class="main-content">

    <div class="card">
        <h2>All Added Places</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sub Category</th>
                    <th>Place Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $q = mysqli_query($conn,"
                SELECT p.*, s.sub_category_name 
                FROM place1 p
                JOIN sub_categories s ON s.id=p.sub_category_id
                ORDER BY p.id DESC
            ");
            $i=1;
            while($row=mysqli_fetch_assoc($q)){
            ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['sub_category_name'] ?></td>
                    <td><?= $row['place_name'] ?></td>
                    <td><?= $row['place_desc'] ?></td>
                    <td>
                        <img src="../uploads/<?= $row['place_image'] ?>">
                    </td>
                    <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
                    <td>
    <a href="edit_place1.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
    <a href="delete_place1.php?id=<?= $row['id'] ?>"
       onclick="return confirm('Delete this place?')"
       class="delete-btn">Delete</a>
</td>

                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>

</div>

</body>
</html>
