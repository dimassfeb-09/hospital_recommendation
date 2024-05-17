<?php

class User
{
    var $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    private function exec($query)
    {
        return $this->conn->query($query);
    }

    function getUserDetail($userId)
    {
        $query = "SELECT * FROM user WHERE user_id = '$userId' LIMIT 1;";
        return $this->exec($query);
    }

    function getUserDetailByEmail($email)
    {
        $query = "SELECT user_id, full_name, email, role FROM user WHERE email = '$email'";
        return $this->exec($query);
    }

    function getAllUser()
    {
        $query = "SELECT * FROM user;";
        return $this->exec($query);
    }

    function insertUser($fullName, $email, $password, $role)
    {
        $query = "INSERT INTO user (full_name, email, password, role)
        VALUES ('$fullName', '$email', '$password', '$role')";
        return $this->exec($query);
    }

    function updateUser($userId, $fullName, $email, $role)
    {
        $query = "UPDATE user SET full_name='$fullName', email='$email', role='$role' WHERE user_id='$userId'";
        return $this->exec($query);
    }

    function changePasswordUser($userId, $newPassword)
    {
        $query = "UPDATE user SET password = '$newPassword' WHERE email = '$userId'";
        return $this->exec($query);
    }

    function deleteUser($userId)
    {
        $query = "DELETE FROM user WHERE user_id = '$userId'";
        return $this->exec($query);
    }

    function logout()
    {

        $currentPath = $_SERVER['REQUEST_URI'];
        $isAdmin = strpos($currentPath, '/admin') !== false;

        session_unset();
        session_destroy();

        $redirectUrl = $isAdmin ? "../login.php" : "login.php";
        header("Location: $redirectUrl");
    }
}
