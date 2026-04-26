<?php
include "../db.php";

$id = $_GET['id'];

$q = mysqli_query($conn,"SELECT place_image FROM place1 WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

unlink("../uploads/".$data['place_image']);

mysqli_query($conn,"DELETE FROM place1 WHERE id='$id'");

header("Location: view_places1.php?view=list");
