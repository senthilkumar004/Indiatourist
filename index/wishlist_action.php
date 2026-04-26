<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_id'])) {
    echo "LOGIN";
    exit;
}

$user_id  = $_SESSION['user_id'];
$place_id = $_POST['place_id'];

$check = mysqli_query($conn,
    "SELECT id FROM wishlist 
     WHERE user_id='$user_id' AND place_id='$place_id'"
);

if (mysqli_num_rows($check) > 0) {
    mysqli_query($conn,
        "DELETE FROM wishlist 
         WHERE user_id='$user_id' AND place_id='$place_id'"
    );
    echo "REMOVED";
} else {
    mysqli_query($conn,
        "INSERT INTO wishlist (user_id, place_id)
         VALUES ('$user_id','$place_id')"
    );
    echo "ADDED";
}
