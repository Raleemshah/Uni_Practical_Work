<?php
session_start();
require '../autoload.php';

use App\Models\Admin;
use App\Models\RegularUser;
use App\Services\AuthService;
use App\Services\UserService;

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === '' || $password === '') {
        $message = 'All fields are required.';
    } else {
        $userService = new UserService();
        $userData = $userService->findByEmail($email);

        if ($userData) {
            if ($userData['role'] === 'admin') {
                $user = new Admin(
                    $userData['name'],
                    $userData['email'],
                    $userData['password'],
                    $userData['role']
                );
            } else {
                $user = new RegularUser(
                    $userData['name'],
                    $userData['email'],
                    $userData['password'],
                    $userData['role']
                );
            }

            $authService = new AuthService();
            $result = $authService->authenticate($user, $email, $password);

            if ($result === true) {
                header('Location: profile.php');
                exit;
            } else {
                $message = 'Invalid email or password.';
            }
        } else {
            $message = 'User not found.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>

    <p><a href="register.php">Go to Register</a></p>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
