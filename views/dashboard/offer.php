<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\JobController;

file_put_contents('api_log.txt', 'Reached here');
session_start();

$jobController = new JobController;
$listJobs = $jobController->getJobs(1);

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
    <!-- jQuery -->


</head>

<body>
    <div class="wrapper">
        <?php include('sidebar.php') ?>
        <div class="main">
            <div class="main">
                <nav class="navbar justify-content-space-between pe-4 ps-2">
                    <button class="btn open">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar  gap-4">
                        <div class="">
                            <input type="search" class="search " placeholder="Search">
                            <img class="search_icon" src="../../public/img/search.svg" alt="iconicon">
                        </div>
                        <!-- <img src="../../public/img/search.svg" alt="icon"> -->
                        <img class="notification" src="../../public/img/new.svg" alt="icon">
                        <div class="card new w-auto">
                            <div class="list-group list-group-light">
                                <div class="list-group-item px-3 d-flex justify-content-between align-items-center ">
                                    <p class="mt-auto">Notification</p><a href="#"><img src="../../public/img/settingsno.svg" alt="icon"></a>
                                </div>
                                <div class="list-group-item px-3 d-flex"><img src="../../public/img/notif.svg" alt="iconimage">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                            the bulk of the card's content.</p>
                                        <small class="card-text">1 day ago</small>
                                    </div>
                                </div>
                                <div class="list-group-item px-3 d-flex"><img src="../../public/img/notif.svg" alt="iconimage">
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
                    <input value='Add Offer' data-bs-toggle="modal" data-bs-target="#addOffer" class="btn btn-success  mb-4 me-4">
                    <table class="agent table align-middle bg-white">
                        <thead class="bg-light">
                            <th>Image</th>
                            <th>Title</th>
                            <th>description</th>
                            <th>entreprise</th>
                            <th>location</th>
                            <th>Is Active</th>
                            <th>Is Approve</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php foreach ($listJobs as $job) : ?>
                                <tr class="freelancer">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../../public/upload/<?= $job['imageURL'] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            <p class="fw-bold mb-1 f_name"><?= $job['title'] ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1 f_title"><?= $job['description'] ?> </p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1 f_title"><?= $job['entreprise'] ?> </p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1 f_title"><?= $job['location'] ?> </p>
                                    </td>
                                    <td class="f_position"><?= $job['IsActive'] == 1 ? "Active" : "In Active"; ?> </td>
                                    <td class="f_position"><?= $job['approve'] == 1 ? "Aprouve" : "In Aprouve"; ?> </td>
                                    <td>
                                        <img class="ms-2 delete-job" data-bs-toggle="modal" data-bs-target="#delete<?= $job['jobID'] ?>" src="../../public/img/user-x.svg" alt="">

                                        <img class="ms-2 edit-job" data-bs-toggle="modal" data-bs-target="#edit<?= $job['jobID'] ?>" src="../../public/img/edit.svg" alt="">
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
                <!-- Edit Modal -->
                <?php foreach ($listJobs as $job) : ?>
                    <div class="modal fade" id="edit<?= $job['jobID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Job</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method='post' action="api.php">
                                        <input type="hidden" name="action" value="updateJob">
                                        <input type="hidden" name="jobID" value="<?= $job['jobID'] ?>">
                                        <div class="mb-4">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="<?= $job['title'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" required><?= $job['description'] ?></textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Entreprise</label>
                                            <input type="text" name="entreprise" class="form-control" value="<?= $job['entreprise'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control" value="<?= $job['location'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Role User</label>
                                            <select name="IsActive" class="form-control email" id="" required>
                                                <option value="0" <?= $job['IsActive'] == 0 ? 'selected' : '' ?>>Inactive</option>
                                                <option value="1" <?= $job['IsActive'] == 1 ? 'selected' : '' ?>>Active</option>
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label">Role User</label>
                                            <select name="approve" class="form-control email" id="" required>
                                                <option value="1" <?= $job['approve'] == 1 ? 'selected' : '' ?>>Is Approve</option>
                                                <option value="0" <?= $job['approve'] == 0 ? 'selected' : '' ?>>Inapprove</option>
                                            </select>
                                        </div>


                                        <div class="d-flex w-100 justify-content-center">
                                            <button type="submit" class="btn btn-primary btn-update-job">Update</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php endforeach; ?>

                <!-- Delete Modal -->
                <?php foreach ($listJobs as $job) : ?>
                    <!-- Delete Modal -->
                    <div class="modal fade" id="delete<?= $job['jobID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this job?</p>
                                </div>
                                <div class="modal-footer">
                                    <form method='post' action="api.php">
                                        <input type="hidden" name="action" value="deleteJob">
                                        <input type="hidden" name="jobID" value="<?= $job['jobID'] ?>">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger delete-job-btn">Delete</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </section>
                <!-- Add Offer Modal -->
                <div class="modal fade" id="addOffer" tabindex="-1" aria-labelledby="addOfferLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Offer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method='post' action="api.php" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="addJob">
                                    <input type="hidden" name="jobID" value="<?= $job['jobID'] ?>">
                                    <div class="row mb-4">
                                        <div class="">
                                            <input type="file" name='photo' class="form-control first_name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="">
                                            <input placeholder="Title" type="text" name='title' class="form-control first_name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="">
                                            <input placeholder="Description" type="text" name='description' class="form-control first_name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="">
                                            <input placeholder="Entreprise" type="text" name='entreprise' class="form-control first_name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="">
                                            <input placeholder="Location" type="text" name='location' class="form-control first_name" required>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Role User</label>
                                        <select name="IsActive" class="form-control email" id="" required>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>

                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Role User</label>
                                        <select name="approve" class="form-control email" id="" required>
                                            <option value="0">Is Approve</option>
                                            <option value="1">Inapprove</option>
                                        </select>
                                    </div>
                                    <div class="d-flex w-100 justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
                                        <button class="btn btn-danger btn-block mb-4" data-bs-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
                <script src="../../public/js/dashboard.js"></script>
                <script src="../../public/js/agents.js"></script>
                <script src="../../public/js/your-other-scripts.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>