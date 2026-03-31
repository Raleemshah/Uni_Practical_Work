# User Management System

## Project Description
This is a PHP OOP User Management System with:
- user registration
- login/logout using PHP sessions
- profile page
- Admin and Regular User roles
- password hashing
- MySQL database storage

## Technologies Used
- PHP
- MySQL
- PDO
- GitHub

## Project Structure
- `App/Core` - abstract class, interface, trait, database connection
- `App/Models` - Admin and RegularUser classes
- `App/Services` - authentication and user service logic
- `public` - pages for register, login, profile, admin, logout

## How to Run
1. Start MySQL
2. Create the database using `database.sql`
3. Open terminal in project folder
4. Run:

```bash
php -S localhost:8000 -t public
