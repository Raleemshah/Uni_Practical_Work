<?php
namespace App\Services;

use App\Core\Database;
use PDOException;

class UserService
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function register($name, $email, $password, $role = 'user')
    {
        try {
            $checkSql = "SELECT id FROM users WHERE email = :email";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->execute([':email' => $email]);

            if ($checkStmt->fetch()) {
                return "Email already exists.";
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, email, password, role)
                    VALUES (:name, :email, :password, :role)";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':role' => $role
            ]);

            return true;
        } catch (PDOException $e) {
            return "Registration failed: " . $e->getMessage();
        }
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch();
    }

    public function getAllUsers()
    {
        $sql = "SELECT id, name, email, role FROM users ORDER BY id DESC";
        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll();
    }
}
