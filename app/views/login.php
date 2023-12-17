<?php
session_start();
// if (isset($_SESSION['role'])) {
// if ($_SESSION['role'] == 'admin') {
//   header("location: ../views/dashboard/dashboard.php");
// } else if ($_SESSION['role'] == 'condidate') { // Typo: 'condidate' should be 'candidate'
//   header("location: ../views/index.php");
// }
// }
require __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\UserController;


$authController = new UserController();


if (isset($_POST["login"])) {
  extract($_POST);
  $result = $authController->login($email, $password);
 
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
        <input type="hidden" name='id'>
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