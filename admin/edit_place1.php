<?php
include "../db.php";

$id = $_GET['id'];

// FETCH PLACE DATA
$p = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM place1 WHERE id='$id'"));

// UPDATE PLACE
if(isset($_POST['update'])){
    $sub_id = $_POST['sub_category_id'];
    $name   = $_POST['place_name'];
    $desc   = $_POST['place_desc'];

    // IMAGE UPLOAD
    if(isset($_FILES['place_image']) && $_FILES['place_image']['name'] != ''){
        $imgName = time() . "_" . $_FILES['place_image']['name'];
        $tmpImg  = $_FILES['place_image']['tmp_name'];
        move_uploaded_file($tmpImg, "../uploads/$imgName");

        mysqli_query($conn,"UPDATE place1 
            SET sub_category_id='$sub_id', place_name='$name', place_image='$imgName', place_desc='$desc'
            WHERE id='$id'
        ");
    } else {
        mysqli_query($conn,"UPDATE place1 
            SET sub_category_id='$sub_id', place_name='$name', place_desc='$desc'
            WHERE id='$id'
        ");
    }

    header("Location: view_places1.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>
    <title>Edit Place</title>
    <style>
body {
    font-family: 'Inter', 'Segoe UI', sans-serif;
    background: #f6f8fb;
    margin: 0;
}

.main-content {
    margin-left: 260px;
    padding: 100px 30px 30px;
    min-height: 100vh;
}

.box {
    max-width: 600px;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.box h2 {
    margin-bottom: 25px;
    font-size: 22px;
    font-weight: 600;
    color: #0f172a;
}

.box select,
.box input,
.box textarea {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 18px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    transition: border 0.3s ease, box-shadow 0.3s ease;
}

.box textarea {
    min-height: 90px;
    resize: vertical;
}

.box select:focus,
.box input:focus,
.box textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}

.box button {
    padding: 12px 20px;
    background: #2563eb;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.3s ease, transform 0.2s ease;
}

.box button:hover {
    background: #1e40af;
    transform: translateY(-2px);
}

@media (max-width: 900px) {
    .main-content {
        margin-left: 0;
        padding: 90px 20px 20px;
    }

    .box {
        max-width: 100%;
    }
}

.btn-view{
    padding:10px 16px;
    background:#0f172a;
    color:#fff;
    text-decoration:none;
    border-radius:8px;
    font-size:14px;
}
.btn-view:hover{
    background:#1e293b;
}
    </style>
</head>

<body>
<div class="main-content">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <a href="view_places1.php" class="btn-view">Show Places</a>
    </div>

    <div class="box">
        <h2>Edit Place</h2>

        <form method="POST" enctype="multipart/form-data">

            <!-- SUB CATEGORY -->
            <label>Select Sub Category</label>
            <select name="sub_category_id" required>
                <option value="">-- Select --</option>
                <?php
                $subs = mysqli_query($conn, "SELECT * FROM sub_categories ORDER BY id DESC");
                while ($s = mysqli_fetch_assoc($subs)) {
                    $selected = ($p['sub_category_id'] == $s['id']) ? 'selected' : '';
                ?>
                    <option value="<?= $s['id']; ?>" <?= $selected; ?>>
                        <?= $s['sub_category_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <!-- PLACE NAME -->
            <input type="text" name="place_name" placeholder="Place Name" value="<?= $p['place_name']; ?>" required>

            <!-- CURRENT IMAGE -->
            <?php if($p['place_image'] != ''): ?>
            <div style="margin-bottom:15px;">
                <img src="../uploads/<?= $p['place_image']; ?>" style="width:150px; height:auto; border-radius:8px;">
            </div>
            <?php endif; ?>

            <!-- PLACE IMAGE -->
            <input type="file" name="place_image">

            <!-- DESCRIPTION -->
            <textarea name="place_desc" placeholder="Description"><?= $p['place_desc']; ?></textarea>

            <button type="submit" name="update">Update Place</button>
        </form>
    </div>
</div>
</body>
</html>
