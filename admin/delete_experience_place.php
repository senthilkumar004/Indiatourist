<?php
include "../db.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM experience_places WHERE id='$id'");

header("Location: experience_places.php");
exit;