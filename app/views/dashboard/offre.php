<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="side">
            <div class="h-100">
                <div class="sidebar_logo d-flex align-items-end">
                   
                    <a href="#" class="nav-link text-white-50">Dashboard</a>
                  
                </div>

                <ul class="sidebar_nav">
                    <li class="sidebar_item active" style="width: 100%;">
                        <a href="dashboard.php" class="sidebar_link"> <img src="img/1. overview.svg" alt="icon">Overview</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="candidat.php" class="sidebar_link"> <img src="img/agents.svg" alt="icon">Candidat</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="offre.php" class="sidebar_link"> <img src="img/task.svg" alt="icon">Offre</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="contact.php" class="sidebar_link"><img src="img/agent.svg" alt="icon">Contact</a>
                    </li>
                    <li class="sidebar_item">
                        <a href="#" class="sidebar_link"><img src="img/articles.svg" alt="icon">Articles</a>
                    </li>

                </ul>
                <div class="line"></div>
                <a href="#" class="sidebar_link"><img src="img/settings.svg" alt="">Settings</a>


            </div>
        </aside>
        <div class="main">
            <nav class="navbar justify-content-space-between pe-4 ps-2">
                <button class="btn open">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar  gap-4">
                    <div class="">
                        <input type="search" class="search " placeholder="Search">
                        <img class="search_icon" src="img/search.svg" alt="iconicon">
                    </div>
                    <!-- <img src="img/search.svg" alt="icon"> -->
                    <img class="notification" src="img/new.svg" alt="icon">
                    <div class="card new w-auto">
                        <div class="list-group list-group-light">
                            <div class="list-group-item px-3 d-flex justify-content-between align-items-center ">
                                <p class="mt-auto">Notification</p><a href="#"><img src="img/settingsno.svg" alt="icon"></a>
                            </div>
                            <div class="list-group-item px-3 d-flex"><img src="img/notif.svg" alt="iconimage">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <small class="card-text">1  day ago</small>
                                </div>
                            </div>
                            <div class="list-group-item px-3 d-flex"><img src="img/notif.svg" alt="iconimage">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <small class="card-text">1  day ago</small>
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
                                <img src="img/photo_admin.svg" alt="icon">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end position-absolute">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Account Setting</a>
                                <a class="dropdown-item" href="/PeoplePerTask/project/pages/index.html">Log out</a>
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
                            <th>status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="freelancer">
                            <td>
                                <div class="d-flex align-items-center">
                                    
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 f_name">John Doe</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title">I need someone for InDesign work on a semi-regular basis. Must be proficient in Indesign and page layout. Must be detail-oriented and highly organized. Fast turnaround times are a must and need to work during USA EST business hours.</p>

                            </td>
                            <td>
                                <a href="#" class="f_status">Adobe InDesign Brochure Design Graphic Design PDF Photoshop</a>
                            </td>
                            <td class="f_position">Inactif</td>
                            <td class="">
                                <img class="accept_task w-50" src="img/journal-check.svg" alt="icon" >
                                <img class="delet_user w-50" src="img/journal-x.svg" alt="icon">
                            </td>
                        </tr>
                        <tr class="freelancer">
                            <td>
                                <div class="d-flex align-items-center">
                                    
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 f_name">John Doe</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title">I need someone for InDesign work on a semi-regular basis. Must be proficient in Indesign and page layout. Must be detail-oriented and highly organized. Fast turnaround times are a must and need to work during USA EST business hours.                                </p>

                            </td>
                            <td>
                                <a href="#" class="f_status">Adobe InDesign Graphic Design Brochure Design Photoshop PDF</a>
                            </td>
                            <td class="f_position">Actif</td>
                            <td class="">
                                <img class="accept_task w-50" src="img/journal-check.svg" alt="icon" >
                                <img class="delet_user w-50" src="img/journal-x.svg" alt="icon">
                            </td>
                        </tr>
                        <tr class="freelancer">
                            <td>
                                <div class="d-flex align-items-center">
                                    
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 f_name">John Doe</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title">I am looking for a metadata expert who can optimize the metadata for my project.</p>

                            </td>
                            <td>
                                <a href="#" class="f_status">Ghostwriting Reviews Search Engine Marketing</a>
                            </td>
                            <td class="f_position">Inactif</td>
                            <td class="">
                                <img class="accept_task w-50" src="img/journal-check.svg" alt="icon" >
                                <img class="delet_user w-50" src="img/journal-x.svg" alt="icon">
                            </td>
                        </tr>
                        <tr class="freelancer">
                            <td>
                                <div class="d-flex align-items-center">
                                    
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 f_name">John Doe</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title">I am looking for a freelancer to help me with an AI project it’s very small and I need it in 5 hours.                                </p>

                            </td>
                            <td>
                                <a href="#" class="f_status">Python Mathematics</a>
                            </td>
                            <td class="f_position">Actif</td>
                            <td class="">
                                <img class="accept_task w-50" src="img/journal-check.svg" alt="icon" >
                                <img class="delet_user w-50" src="img/journal-x.svg" alt="icon">
                            </td>
                        </tr>
                        <tr class="freelancer">
                            <td>
                                <div class="d-flex align-items-center">
                                    
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 f_name">John Doe</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title">I am looking for a photo editor who can assist me with my project. The specific edits that I require for my photos are color correction. I have more than 20 photos that need editing, and I am looking for a quick turnaround time of within 24 hours.</p>

                            </td>
                            <td>
                                <a href="#" class="f_status">Photoshop Photo Editing Photoshop Design Photography Graphic Design </a>
                            </td>
                            <td class="f_position">Inactif</td>
                            <td class="">
                                <img class="accept_task w-50" src="img/journal-check.svg" alt="icon" >
                                <img class="delet_user w-50" src="img/journal-x.svg" alt="icon">
                            </td>
                        </tr>
                        <tr class="freelancer">
                            <td>
                                <div class="d-flex align-items-center">
                                    
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 f_name">John Doe</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title">I need someone for InDesign work on a semi-regular basis. Must be proficient in Indesign and page layout. Must be detail-oriented and highly organized. Fast turnaround times are a must and need to work during USA EST business hours.</p>

                            </td>
                            <td>
                                <a href="#" class="f_status">Adobe InDesign Brochure Design Graphic Design PDF Photoshop</a>
                            </td>
                            <td class="f_position">Actif</td>
                            <td class="">
                                <img class="accept_task w-50" src="img/journal-check.svg" alt="icon" >
                                <img class="delet_user w-50" src="img/journal-x.svg" alt="icon">
                            </td>
                        </tr>
                        <tr class="freelancer">
                            <td>
                                <div class="d-flex align-items-center">
                                    
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 f_name">John Doe</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1 f_title">I need someone for InDesign work on a semi-regular basis. Must be proficient in Indesign and page layout. Must be detail-oriented and highly organized. Fast turnaround times are a must and need to work during USA EST business hours.</p>

                            </td>
                            <td>
                                <a href="#" class="f_status">Adobe InDesign Brochure Design Graphic Design PDF Photoshop</a>
                            </td>
                            <td class="f_position">Actif</td>
                            <td class="">
                                <img class="accept_task w-50" src="img/journal-check.svg" alt="icon" >
                                <img class="delet_user w-50" src="img/journal-x.svg" alt="icon">
                            </td>
                        </tr>
                    </tbody>
                </table>


            </section>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
</body>

</html>