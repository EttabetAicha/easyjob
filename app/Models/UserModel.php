<?php

namespace App\Models;

use App\database\db;
use PDO;

class UserModel extends db
{
    public function register($name, $email, $password, $confpassword, $role)
    {
        $conn = db::getConn();
    
        if ($password !== $confpassword) {
            return false; 
        }
    
        $passhash = password_hash($password, PASSWORD_DEFAULT);
    
        $role = 'condidate';
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $passhash);
        $stmt->bindValue(4, $role);
    
        $result = $stmt->execute();
    
        if ($result) {
            return true;
        }
    
        return false;
    }
    

    public function login($email, $password)
    {
        $conn = db::getConn();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        
        $stmt->bindValue(1, $email);
        
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
    public function getUsers()
    {
        $conn = db::getConn();
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function UpdateUser($name, $email, $id)
    {
        $conn = db::getConn();
        $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE user_id =?");
        $stmt->bindParam("sss", $name, $email, $id);
        $result = $stmt->execute();
        if ($result)
            return true;
    }
    public function DeleteUser($id)
    {
        $conn = db::getConn();
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id =?");
        $stmt->bindParam("s", $id);
        $result = $stmt->execute();
        if ($result)
            return true;
    }
}
