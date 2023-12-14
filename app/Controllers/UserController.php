<?php

namespace App\Controllers;

use App\Models\UserModel;

class userController
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

            $_SESSION['idUser'] = $user['userID'];
            $_SESSION['role'] = $user['role'];

            if ($_SESSION['roleUser'] == 'admin') {
                header("location: ../dashboard/dashboard.php");
            } elseif ($_SESSION['role'] == 'condidate') {
                header("location: ../index.php");
            }
        } else {

            $_SESSION['loginError'] = "Invalid credentials";
            header("location: ../login.php");
        }
    }

    public function getUsers()
    {
        $users = $this->userModel->getUsers();
        return $users;
    }
   
    public function deleteUser($id_user)
    {
        $result = $this->userModel->deleteUser($id_user);
        if ($result) {
            header('location:../dashboard/candidat.php');
        }
    }

    public function updateUser($name, $email, $roleuserID, $id_user)
    {
        $result = $this->userModel->updateUser($name, $email, $id_user);
        if ($result) {
            header('location:../dashboard/candidat.php');
        }
    }
}
