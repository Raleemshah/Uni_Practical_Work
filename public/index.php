<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management System</title>
</head>
<body>
    <h1>User Management System</h1>

    <p>This project allows users to register, log in, view profiles, and log out.</p>
    <p>It also supports Admin and Regular User roles with different permissions.</p>

    <p><a href="register.php">Register</a></p>
    <p><a href="login.php">Login</a></p>
</body>
</html>
