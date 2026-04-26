<?php
include "../db.php";

// ADD PLACE
if (isset($_POST['add_place'])) {

    $sub_id = $_POST['sub_category_id'];
    $name   = $_POST['place_name'];
    $desc   = $_POST['place_desc'];

    $imgName = time() . "_" . $_FILES['place_image']['name'];
    $tmpImg  = $_FILES['place_image']['tmp_name'];

    move_uploaded_file($tmpImg, "../uploads/$imgName");

    mysqli_query($conn, "
        INSERT INTO place1 
        (sub_category_id, place_name, place_image, place_desc)
        VALUES ('$sub_id', '$name', '$imgName', '$desc')
    ");
}
?>



<!DOCTYPE html>
<html>
<head>
    <?php include "header.php"; ?>
<?php include "sidebar.php"; ?>
    <title>Add Place</title>
    <style>
       /* ===== BODY ===== */
body {
    font-family: 'Inter', 'Segoe UI', sans-serif;
    background: #f6f8fb;
    margin: 0;
}

/* ===== MAIN CONTENT (LIKE ADMIN PAGE) ===== */
.main-content {
    margin-left: 260px;           /* sidebar width */
    padding: 100px 30px 30px;     /* header height */
    min-height: 100vh;
}

/* ===== FORM CARD ===== */
.box {
    max-width: 600px;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* ===== TITLE ===== */
.box h2 {
    margin-bottom: 25px;
    font-size: 22px;
    font-weight: 600;
    color: #0f172a;
}

/* ===== FORM ELEMENTS ===== */
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

/* Focus */
.box select:focus,
.box input:focus,
.box textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}

/* ===== BUTTON ===== */
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

/* ===== RESPONSIVE ===== */
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
    <h2>Add Place</h2>

    <form method="POST" enctype="multipart/form-data">

        <!-- SUB CATEGORY -->
        <label>Select Sub Category</label>
        <select name="sub_category_id" required>
            <option value="">-- Select --</option>

            <?php
            $subs = mysqli_query($conn, "SELECT * FROM sub_categories ORDER BY id DESC");
            while ($s = mysqli_fetch_assoc($subs)) {
            ?>
                <option value="<?= $s['id']; ?>">
                    <?= $s['sub_category_name']; ?>
                </option>
            <?php } ?>
        </select>

        <!-- PLACE NAME -->
        <input type="text" name="place_name" placeholder="Place Name" required>

        <!-- PLACE IMAGE -->
        <input type="file" name="place_image" required>

        <!-- DESCRIPTION -->
        <textarea name="place_desc" placeholder="Description"></textarea>

        <button type="submit" name="add_place">Add Place</button>
    </form>
</div>
            </div>
</body>
</html>
