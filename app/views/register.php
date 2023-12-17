<?php
session_start();
if (isset($_SESSION['role'])) {
  if ($_SESSION['role'] == 'admin') {
    header("location: ../views/dashboard/dashboard.php");
  } else if ($_SESSION['role'] == 'condidate') { // Typo: 'condidate' should be 'candidate'
    header("location: ../views/index.php");
  }
  }
require __DIR__.'/../../vendor/autoload.php';
use App\Controllers\userController;

$authregister = new userController();
if(isset($_POST["register"])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confpassword=$_POST['verfypassword'];
    $result = $authregister->register($name, $email, $password, $confpassword, $role);
    if($result) {
        header('location:.../../login.php');
    }
}
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Registration or Sign Up form in HTML CSS | CodingLab </title>
  <link rel="stylesheet" href="../../public/css/registerstyle.css">
</head>

<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form action="" method="POST">
      <div class="input-box">
        <input type="text" placeholder="Enter your name"  name="name" required>
      </div>
      <div class="input-box">
        <input type="text" placeholder="Enter your email" name="email" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Create password" name="password" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Confirm password" name="verfypassword" required>
      </div>
      <div class="policy">
        <input type="checkbox">
        <h3>I accept all terms & condition</h3>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Register Now" name='register'>
      </div>
      <div class="text">
        <h3>Already have an account? <a href="login.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>

</html>