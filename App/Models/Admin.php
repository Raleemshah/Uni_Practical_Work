<?php
namespace App\Models;

use App\Core\AbstractUser;
use App\Core\AuthInterface;
use App\Core\LoggerTrait;

class Admin extends AbstractUser implements AuthInterface
{
    use LoggerTrait;

    public function userRole()
    {
        return 'Admin';
    }

    public function login($email, $password)
    {
        if ($email === $this->email && password_verify($password, $this->password)) {
            $_SESSION['user'] = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role
            ];

            $this->logActivity("Admin {$this->name} logged in.");
            return true;
        }

        return false;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $this->logActivity("Admin {$this->name} logged out.");
            session_unset();
            session_destroy();
        }
    }
}
