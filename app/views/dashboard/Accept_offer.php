<?php
session_start();

use App\Controllers\ApplyController;

require __DIR__ . '/../../../vendor/autoload.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        <?php include('sidebar.php') ?>

        <div class="main">
            <nav class="navbar justify-content-space-between pe-4 ps-2">
                <button class="btn open">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar  gap-4">
                    <div class="">
                        <input type="search" class="search " placeholder="Search">
                        <img class="search_icon" src="../../../public/img/search.svg" alt="iconicon">
                    </div>
                    <img class="notification" src="../../../public/img/new.svg" alt="icon">
                    <div class="card new w-auto">
                        <div class="list-group list-group-light">
                            <div class="list-group-item px-3 d-flex justify-content-between align-items-center ">
                                <p class="mt-auto">Notification</p><a href="#"><img src="../../../public/img/settingsno.svg" alt="icon"></a>
                            </div>
                            <div class="list-group-item px-3 d-flex"><img src="../../../public/img/notif.svg" alt="iconimage">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <small class="card-text">1 day ago</small>
                                </div>
                            </div>
                            <div class="list-group-item px-3 d-flex"><img src="../../../public/img/notif.svg" alt="iconimage">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <small class="card-text">1 day ago</small>
                                </div>
                            </div>
                            <div class="list-group-item px-3 text-center"><a href="#">View all notifications</a></div>
                        </div>
                    </div>
                    <div class="inline"></div>
                    <div class="name"> Admin</div>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-icon pe-md-0 position-relative" data-bs-toggle="dropdown">
                                <img src="../../../public/img/photo_admin.svg" alt="icon">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end position-absolute">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Account Setting</a>
                                <?php if ($_SESSION['role'] != 'admin') { ?>
                                    <a class="dropdown-item" href="../login.php">login</a>
                                <?php } else { ?>
                                    <a class="dropdown-item" href="../login.php">Log out</a>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <section class="Agents px-4">
                <table class="agent table align-middle bg-white" style="min-width: 700px;">
                    <thead class="bg-light">
                        <tr>
                            <th>Name Candidat</th>
                            <th>description</th>
                            <th>tags</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $jobs = new ApplyController;
                        $res = $jobs->getAppliedJobs(0);
                        foreach ($res as $list) {
                        ?>
                            <tr class="freelancer">
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div class="ms-3">
                                            <p class="fw-bold mb-1 f_name"><?= $list["username"] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1 f_title"><?= $list["title"] ?></p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1 f_title"><?= $list["description"] ?></p>
                                </td>
                                <td class="">
                                    <form class="apply-form" action="" method="post">
                                        <input type="hidden" name="action" value="approveOffer">
                                        <input type="hidden" name="ApplyOnlineID" value="<?= $list["ApplyOnlineID"] ?>">

                                        <button type="button" class="btn btn-success apply-btn" data-status="approve">Approve</button>
                                        <button type="button" class="btn btn-danger apply-btn" data-status="decline">Decline</button>
                                    </form>


                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>


            </section>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../../public/js/dashboard.js"></script>
    <script>
        $(document).ready(function() {
            $(".apply-btn").click(function() {
                var form = $(this).closest("form");
                var status = $(this).data("status");

                $.post("api.php", form.serialize() + "&action=" + status + "Offer", function(response) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            // You might want to reload the page or update the UI accordingly
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to process the application.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }, "json").fail(function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to process the application.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            });
        });
    </script>



</body>

</html>