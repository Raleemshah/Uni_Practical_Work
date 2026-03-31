<?php
require '../autoload.php';

use App\Services\UserService;

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($name === '' || $email === '' || $password === '') {
        $message = 'All fields are required.';
    } else {
        $userService = new UserService();
        $result = $userService->register($name, $email, $password, $role);

        if ($result === true) {
            $message = 'User registered successfully.';
        } else {
            $message = $result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="role">Role:</label><br>
        <select id="role" name="role">
            <option value="user">Regular User</option>
            <option value="admin">Admin</option>
        </select><br><br>

        <button type="submit">Register</button>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
