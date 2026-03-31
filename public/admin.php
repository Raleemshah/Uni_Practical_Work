<?php
session_start();
require '../autoload.php';

use App\Services\UserService;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['user']['role'] !== 'admin') {
    echo "Access denied. Admins only.";
    exit;
}

$userService = new UserService();
$users = $userService->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <h2>All Registered Users</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <p><a href="profile.php">Back to Profile</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
