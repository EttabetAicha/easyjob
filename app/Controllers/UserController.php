<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register($name, $email, $password, $confpassword, $role)
    {

        return  $this->userModel->register($name, $email, $password, $confpassword, $role);
    }

    public function login($email, $password)
    {
        $user = $this->userModel->login($email, $password);

        if ($user) {
            $_SESSION['id'] = $user['userID'];
            $_SESSION['role'] = $user['role'];
            if ($_SESSION['role'] == 'admin') {
                header("location: ../views/dashboard/dashboard.php");
            } elseif ($_SESSION['role'] == 'condidate') { // Typo: 'condidate' should be 'candidate'
                header("location: ../views/home.php");
            }
        } else {
            $_SESSION['loginError'] = "Invalid credentials";
            header("location: ../views/login.php");
        }
    }


    public function getUsers()
    {
        $users = $this->userModel->getUsers();
        return $users;
    }

    public function deleteUser($id)
{ 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteUser') {
        $userID = $_POST['userID'];
        $result = $this->userModel->deleteUser($userID);

        if ($result) {
            header('location:../dashboard/candidat.php');
        } else {
           print_r($result);
        }
    }
}


    
    public function updateUser($name, $email, $userID)
    {
        $result = $this->userModel->updateUser($name, $email, $userID);
        if ($result) {
            header('location:../dashboard/candidat.php');
        }
    }
}
