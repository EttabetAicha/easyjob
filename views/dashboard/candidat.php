<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\UserController;

session_start();
$user = new UserController();
$listUsers = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/dashboard.css">
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
                <div class="navbar gap-4">
                    <div class="">
                        <input type="search" class="search" placeholder="Search">
                        <img class="search_icon" src="../../public/img/search.svg" alt="iconicon">
                    </div>
                    <img class="notification" src="../../public/img/new.svg" alt="icon">
                    <div class="card new w-auto">
                        <!-- Notification card content here... -->
                    </div>
                    <div class="inline"></div>
                    <div class="name">Admin</div>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-icon pe-md-0 position-relative" data-bs-toggle="dropdown">
                                <img src="../../public/img/photo_admin.svg" alt="icon">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end position-absolute">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Account Setting</a>
                                <?php if ($_SESSION['role'] != 'admin') { ?>
                                    <a class="dropdown-item" href="../login.php">Login</a>
                                <?php } else { ?>
                                    <a class="dropdown-item" href="../login.php">Log out</a>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <section class="Agents px-4">
                <table class="agent table align-middle bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listUsers as $index => $users) : ?>
                            <tr class="freelancer">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1 f_name"><?= $users['username'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1 f_title"><?= $users['email'] ?></p>
                                </td>
                                <td class="f_position"><?= $users['role'] ?></td>
                                <td>
                                    <form id="deleteForm<?= $index ?>" action="api.php" method="POST">
                                        <input type="hidden" name="action" value="deleteUser">
                                        <input type="hidden" name="userID" value="<?= $users['userID'] ?>">
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $index ?>)">
                                            Delete
                                        </button>
                                    </form>
                                    <button class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#edit<?= $index ?>">
                                        Edit
                                    </button>
                                </td>
                                <script>
                                    function confirmDelete(index) {
                                        if (confirm("Are you sure you want to delete this user?")) {
                                            document.getElementById('deleteForm' + index).submit();
                                        }
                                    }
                                </script>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="edit<?= $index ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $index ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?= $index ?>">Edit Candidate</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Add your form for editing user details here -->
                                            <form id="editForm<?= $index ?>" action="api.php" method="POST">
                                                <input type="hidden" name="action" value="updateUser">
                                                <input type="hidden" name="userID" value="<?= $users['userID'] ?>">

                                                <!-- Input fields for editing user details (replace these with your actual fields) -->
                                                <div class="mb-3">
                                                    <label for="editName<?= $index ?>" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="editName<?= $index ?>" name="name" value="<?= $users['username'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="editEmail<?= $index ?>" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="editEmail<?= $index ?>" name="email" value="<?= $users['email'] ?>">
                                                </div>

                                                <!-- Add other fields as needed -->

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" onclick="submitEditForm(<?= $index ?>)">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
    <script src="agents.js"></script>
</body>

</html>
