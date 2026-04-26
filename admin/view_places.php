<?php include "../db.php"; ?>
<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>View Places</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="main-content">

<h2>Places List</h2>  <br><br>
<a href="add_place.php" class="btn">+ Add Place</a>

<table class="admin-table">
<tr>
<th>Image</th>
<th>Place</th>
<th>Location</th>
<th>Category</th>
<th>Sub Category</th>
<th>Action</th>
</tr>

<?php
$q = mysqli_query($conn,"
SELECT p.*, c.category_name, s.sub_category_name
FROM places p
JOIN categories c ON p.category_id=c.id
JOIN sub_categories s ON p.sub_category_id=s.id
");

while($row=mysqli_fetch_assoc($q)){
?>
<tr>
<td><img src="../uploads/<?= $row['image'] ?>" width="70"></td>
<td><?= $row['place_name'] ?></td>
<td><?= $row['location'] ?></td>
<td><?= $row['category_name'] ?></td>
<td><?= $row['sub_category_name'] ?></td>
<td>
<a href="edit_place.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
<a href="delete_place.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Delete?')">Delete</a>
</td>
</tr>
<?php } ?>
</table>

</div>

<style>/* MAIN CONTENT AREA */
.main-content{
    margin-left: 260px;   /* sidebar width */
    padding: 100px 30px 30px; /* header height */
    /* background: #f6f8fb;
    min-height: 100vh;
} */

/* TABLE DESIGN */
.admin-table{
    width: 200%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.admin-table th{
    background: #1e293b;
    color: #fff;
    text-align: left;
    padding: 14px;
    font-size: 14px;
}

.admin-table td{
    padding: 14px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
    vertical-align: middle;
}

.admin-table tr:hover{
    background: #f1f5f9;
}

/* IMAGE */
.admin-table img{
    border-radius: 8px;
}

/* BUTTON */
.btn{
    display: inline-block;
    margin-bottom: 15px;
    padding: 10px 16px;
    background: #2563eb;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
}

/* ACTION LINKS */
.admin-table .edit{
    color: #2563eb;
    font-weight: 600;
    margin-right: 10px;
}

.admin-table .delete{
    color: #dc2626;
    font-weight: 600;
}

    </style>

</body>
</html>
