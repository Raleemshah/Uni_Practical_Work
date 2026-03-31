<?php
require '../autoload.php';

use App\Models\Admin;
use App\Models\RegularUser;
use App\Services\AuthService;

$admin = new Admin("Alice", "alice@example.com", "admin123", "admin");
$user = new RegularUser("Bob", "bob@example.com", "user123", "user");

$authService = new AuthService();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OOP Test</title>
</head>
<body>
    <h1>Version 4 - OOP Authentication Test</h1>

    <h2>Admin Test</h2>
    <p><?php echo $authService->authenticate($admin, "alice@example.com", "admin123"); ?></p>
    <p><?php echo $admin->logout(); ?></p>

    <h2>Regular User Test</h2>
    <p><?php echo $authService->authenticate($user, "bob@example.com", "user123"); ?></p>
    <p><?php echo $user->logout(); ?></p>
</body>
</html>
