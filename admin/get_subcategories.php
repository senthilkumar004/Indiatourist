<?php
include "../db.php";
$cat_id = $_GET['cat_id'];

$res = mysqli_query($conn,"SELECT * FROM sub_categories WHERE category_id='$cat_id'");
while($r=mysqli_fetch_assoc($res)){
    echo "<option value='{$r['id']}'>{$r['sub_category_name']}</option>";
}
?>
