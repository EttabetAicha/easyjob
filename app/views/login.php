<?php

use App\Controllers\userController;

session_start();

$authController = new userController();
if(isset($_POST["login"])){
    extract($_POST);
    $result = $authController->login($email, $password);
    $_SESSION['idUser'] = $result['userID'];
    $_SESSION['role'] = $result['role'];
    if($_SESSION['role'] == 'admin') {
        header("location: ../dashboard/dashboard.php");
    }
    if($_SESSION['role'] == 'condidate') {
        header("location: ../index.php");
    }
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | CodingLab</title>
  <link rel="stylesheet" href="../../public/css/loginstyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
  <div class="container">
    <div class="wrapper">
      <div class="title"><span>Login Form</span></div>
      <h1></h1>
      <form action="" method="POST">
        <div class="row">
          <i class="fas fa-user"></i>
          <input type="text" name="email" placeholder="Email or Phone" required>
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="pass"><a href="#">Forgot password?</a></div>
        <div class="row button">
          <input type="submit" value="Login" name="login">
        </div>
        <span style="color:red;"></span>
        <div class="signup-link">Not a member? <a href="./register.php">Signup now</a></div>
      </form>
    </div>
  </div>

</body>

</html>
