<?php
include "../db.php";

// Fetch all users
$users = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
?>
<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<!-- Main Content Area -->
<div class="main-content">
    <h2>Admin Panel - User Details</h2>

    <div > <!-- Scrollable for smaller screens -->
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password (plain text)</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = mysqli_fetch_assoc($users)){ ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= $user['name']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['password']; ?></td>
                    <td><?= $user['created_at']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- CSS for Admin Table -->
<style>
/* MAIN CONTENT AREA */
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

</style>
