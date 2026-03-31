<?php
namespace App\Models;

use App\Core\AbstractUser;
use App\Core\AuthInterface;

class RegularUser extends AbstractUser implements AuthInterface
{
    public function userRole()
    {
        return 'Regular User';
    }

    public function login($email, $password)
    {
        if ($email === $this->email && password_verify($password, $this->password)) {
            $_SESSION['user'] = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role
            ];

            return true;
        }

        return false;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }
}
