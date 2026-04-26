




<?php
session_start();
include "../db.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        // Store user info in session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        
        header("Location: index.php"); // Redirect to dashboard or home page
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
/* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Background */
body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #dbeafe, #fef9c3);
}

/* Glassmorphism Form Container */
.login-container {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    padding: 40px;
    width: 350px;
    text-align: center;
}

/* Form Heading */
.login-container h2 {
    margin-bottom: 25px;
    color: #1e293b;
    font-size: 24px;
}

/* Input Fields */
.login-container input[type="email"],
.login-container input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0;
    border-radius: 12px;
    border: none;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(5px);
    font-size: 14px;
    outline: none;
    transition: all 0.3s ease;
}

.login-container input[type="email"]:focus,
.login-container input[type="password"]:focus {
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0 0 8px rgba(37,99,235,0.4);
}

/* Submit Button */
.login-container button {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    border-radius: 12px;
    border: none;
    background: #2563eb;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.login-container button:hover {
    background: #1e40af;
}

/* Register Link */
.login-container p {
    margin-top: 15px;
    font-size: 14px;
    color: #1e293b;
}

.login-container p a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 600;
}

.login-container p a:hover {
    text-decoration: underline;
}

/* Error Message */
.error {
    color: #dc2626;
    margin-top: 15px;
    font-size: 14px;
}
</style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form method="POST">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit" name="login">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
</div>

</body>
</html>
