<?php
include "../db.php";
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM places WHERE id='$id'");
header("Location: view_places.php");
?>
