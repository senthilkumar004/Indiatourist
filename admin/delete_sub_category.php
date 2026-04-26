<?php
include "../db.php";

$id = $_GET['id'];

mysqli_query($conn, "
    DELETE FROM sub_categories WHERE id = '$id'
");

header("Location: sub_category.php");
exit;
