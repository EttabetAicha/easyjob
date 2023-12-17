<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\ApplyController;

session_start();
$idUser = $_SESSION['id'];

// Call the getNotifications method to fetch user-specific notifications
$applycontroller = new ApplyController();
$notifications = $applycontroller->getUserNotifications($idUser);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        JobEase
    </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobEase</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Your custom styles -->
    <link rel="stylesheet" href="../../public/css/style.css">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
</head>

<body>
    <header>


        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container">
                <!-- Brand/logo -->
                <a class="navbar-brand" href="#">
                    <i class="fas fa-code"></i>
                    <h1>JobEase &nbsp &nbsp</h1>
                </a>

                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notification.php">Notification</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                language
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">FR</a>
                                <a class="dropdown-item" href="#">EN</a>
                            </div>
                        </li>

                        <span class="nav-item active">
                            <a class="nav-link" href="#">EN</a>
                        </span>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"> <?= $_SESSION['id']; ?></a>

                        </li>
                        <?php
                        if (!isset($_SESSION['role'])) {

                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>

                            </li>


                        <?php } else {
                        ?>
                            <li class="nav-item">
                                <form method="post">
                                    <button type='submit' class="btn btn-light text-dark" href="login.php" name="logout">logout</button>
                                </form>
                            </li>
                        <?php }
                        if (isset($_POST['logout'])) {
                            session_destroy();
                            header('location:login.php');
                        }; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container mt-5">
        <h2>Notifications</h2>
        <?php
        // Check if there are any notifications
        if (!empty($notifications)) {
            foreach ($notifications as $notification) {
                $status = $notification['Status'];
                $jobTitle = $notification['title'];
                $entreprise = $notification['entreprise'];

                // Display notification based on status
                if ($status == 1) {
                    echo "<div class='alert alert-success' role='alert'>
                    Congratulation! Your offer for the job '$jobTitle' at '$entreprise' is accepted.
                </div>";
                } elseif ($status == 2) {
                    echo "<div class='alert alert-danger' role='alert'>
                    Sorry, your offer for the job '$jobTitle' at '$entreprise' is declined.
                </div>";
                } else {
                    // Handle other status values if needed
                    echo "<div class='alert alert-info' role='alert'>
                    New notification with status $status for the job '$jobTitle' at '$entreprise'.
                </div>";
                }
            }
        } else {
            echo "<p>No notifications found.</p>";
        }
        ?>

    </div>
</body>

</html>