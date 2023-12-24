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

    public function register($data)
    { 
        extract($data);
        $res = $this->userModel->register($name, $email, $password, $confpassword, $role);
        if ($res) {
            header('location: ?route=login');
            exit;
        }
    }
    
    public function login($info)
    {
        extract($info);
        $user = $this->userModel->login($email, $password);
    
        if ($user) {
            $_SESSION['id'] = $user['userID'];
            $_SESSION['role'] = $user['role'];
            if ($_SESSION['role'] == 'admin') {
                header("location: ?route=dashboard");
                exit; 
            } elseif ($_SESSION['role'] == 'condidate') { 
                header("location: ?route=home");
                exit; 
            }
        } else {
            $_SESSION['loginError'] = "Invalid credentials";
            header("location: ?route=login");
            exit; 
        }
    }
    
    
    public function loginHtml(){
        require(__DIR__ ."/../../views/login.php");
    }
    public function registerHtml(){
        require(__DIR__ ."/../../views/register.php");
    }
    public function logout(){
        session_destroy();
        header('location: ?route=login');
    }

    public function index()
    {
        $users = $this->userModel->getUsers();
        require(__DIR__.'/../../views/dashboard/candidat.php');
    }

    public function deleteUser($id)
{ 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteUser') {
        $userID = $_POST['userID'];
        $result = $this->userModel->deleteUser($userID);

        if ($result) {
            header('location: ?route=candidate');
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
