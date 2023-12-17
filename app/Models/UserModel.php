<?php

namespace App\Models;

require __DIR__ . '/../../vendor/autoload.php';

use App\Config\Db as ConfigDb;

use PDO;

class UserModel extends ConfigDb

{
    public function register($name, $email, $password, $confpassword, $role)
    {
        $conn = ConfigDb::getConn();

        if ($password !== $confpassword) {
            return false;
        }

        $passhash = password_hash($password, PASSWORD_DEFAULT);

        $role = 'condidate';

        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");

        if ($password === $confpassword) {
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $passhash);
            $stmt->bindValue(4, $role);

            $result = $stmt->execute();
            if ($result) {
                return true;
            }
        }


        return false;
    }


    public function login($email, $password)
    {
        $conn = ConfigDb::getConn();
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
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function UpdateUser($name, $email, $userID)
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE userID =?");
        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $userID, PDO::PARAM_STR);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($id)
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("DELETE FROM users WHERE userID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result) {
            return true;
        }

        return false;
    }
}
