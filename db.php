<?php
$conn = new mysqli("localhost", "root", "","tourism");
// $conn = mysqli_connect("localhost", "tourism_user", "Tourism123!", "tourism");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
