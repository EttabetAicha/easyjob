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
            <div class=" row contact" style="--bs-gutter-x: 0rem !important;">
                <div class="col pX0">
                    <div class="bg-cont navbar justify-content-space-between pe-4 ps-2">
                        <div>Chat</div>
                        
                        <div class="navbar  gap-4">
                            <div class="">
                                <input type="search" class="search " placeholder="Search">
                                <img class="search_icon" src="img/search.svg" alt="icon">
                            </div>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-icon pe-md-0 position-relative" data-bs-toggle="dropdown">
                                        <img src="img/carbon.svg" alt="">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end position-absolute">
                                        <a class="dropdown-item" href="#">Profile</a>
                                        <a class="dropdown-item" href="#">Account Setting</a>
                                        <a class="dropdown-item" href="#">Block</a>
                                    </div>
                                </li>
                            </ul>
                        
                        </div>
                    </div>
                    <div class="container pX0">
                        <div class="bg-white navbar justify-content-between">
                            <div class="d-flex gap-4">
                                <img src="img/photo_admin.svg" alt="icon">
                                <div>
                                    <p class="chat_username">Alex haze</p>
                                    <p class="chat_object">send massege</p>
                                </div>
                            </div>
                            
                            <div class="navbar  gap-4">
                                <img src="img/check.svg" alt="icon" style="width:2rem;">
                            
                            </div>
                        </div>
                        <div class="bg-white navbar justify-content-between">
                            <div class="d-flex gap-4">
                                <img src="img/photo_admin.svg" alt="icon">
                                <div>
                                    <p class="chat_username">Alex haze</p>
                                    <p class="chat_object">send massege</p>
                                </div>
                            </div>
                            
                            <div class="navbar  gap-4">
                                <img src="img/check.svg" alt="icon" style="width:2rem;">
                            
                            </div>
                        </div>
                        <div class="bg-white navbar justify-content-between">
                            <div class="d-flex gap-4">
                                <img src="img/photo_admin.svg" alt="icon">
                                <div>
                                    <p class="chat_username">Alex haze</p>
                                    <p class="chat_object">send massege</p>
                                </div>
                            </div>
                            
                            <div class="navbar  gap-4">
                                <img src="img/check.svg" alt="icon" style="width:2rem;">
                            
                            </div>
                        </div>
                        <div class="bg-white navbar justify-content-between">
                            <div class="d-flex gap-4">
                                <img src="img/photo_admin.svg" alt="icon">
                                <div>
                                    <p class="chat_username">Alex haze</p>
                                    <p class="chat_object">send massege</p>
                                </div>
                            </div>
                            
                            <div class="navbar  gap-4">
                                <img src="img/check.svg" alt="icon" style="width:2rem;">
                            
                            </div>
                        </div>
                        <div class="bg-white navbar justify-content-between">
                            <div class="d-flex gap-4">
                                <img src="img/photo_admin.svg" alt="icon">
                                <div>
                                    <p class="chat_username">Alex haze</p>
                                    <p class="chat_object">send massege</p>
                                </div>
                            </div>
                            
                            <div class="navbar  gap-4">
                                <img src="img/check.svg" alt="icon" style="width:2rem;">
                            
                            </div>
                        </div>
                        <div class="bg-white navbar justify-content-between">
                            <div class="d-flex gap-4">
                                <img src="img/photo_admin.svg" alt="icon">
                                <div>
                                    <p class="chat_username">Alex haze</p>
                                    <p class="chat_object">send massege</p>
                                </div>
                            </div>
                            
                            <div class="navbar  gap-4">
                                <img src="img/check.svg" alt="icon" style="width:2rem;">
                            
                            </div>
                        </div>
                        <div class="bg-white navbar justify-content-between">
                            <div class="d-flex gap-4">
                                <img src="img/photo_admin.svg" alt="icon">
                                <div>
                                    <p class="chat_username">Alex haze</p>
                                    <p class="chat_object">send massege</p>
                                </div>
                            </div>
                            
                            <div class="navbar  gap-4">
                                <img src="img/check.svg" alt="icon" style="width:2rem;">
                            
                            </div>
                        </div>
                        <div class="bg-white navbar justify-content-between">
                            <div class="d-flex gap-4">
                                <img src="img/photo_admin.svg" alt="icon">
                                <div>
                                    <p class="chat_username">Alex haze</p>
                                    <p class="chat_object">send massege</p>
                                </div>
                            </div>
                            
                            <div class="navbar  gap-4">
                                <img src="img/check.svg" alt="icon" style="width:2rem;">
                            
                            </div>
                        </div>
                        <div class="bg-white navbar justify-content-between">
                            <div class="d-flex gap-4">
                                <img src="img/photo_admin.svg" alt="icon">
                                <div>
                                    <p class="chat_username">Alex haze</p>
                                    <p class="chat_object">send massege</p>
                                </div>
                            </div>
                            
                            <div class="navbar  gap-4">
                                <img src="img/check.svg" alt="icon" style="width:2rem;">
                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col pX0">
                    <div class="bg-cont navbar justify-content-space-between pe-4 ps-2">
                        <div class="d-flex gap-4">
                            <img src="img/photo_admin.svg" alt="icon">
                            <div>
                                <p class="chat_username">Alex haze</p>
                                <p class="chat_object">send massege</p>
                            </div>
                        </div>
                        
                        <div class="navbar  gap-4">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-icon pe-md-0 position-relative" data-bs-toggle="dropdown">
                                        <img src="img/carbon.svg" alt="">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end position-absolute">
                                        <a class="dropdown-item" href="#">Profile</a>
                                        <a class="dropdown-item" href="#">Account Setting</a>
                                        <a class="dropdown-item" href="#">Block</a>
                                    </div>
                                </li>
                            </ul>
                        
                        </div>
                    </div>
                    <div class="d-flex justify-content-end flex-column " id="Message" style="height: 25rem;">
                        <div class="w-50 bg-white p-2 mb-3 me-4 rounded d-flex justify-content-between">
                            <p>i need some help</p>
                            <img src="img/check-all.svg" alt="icon">
                        </div>
                    </div>
                    <div class="bg-cont navbar ">
                        <img class="cursor" src="img/smail.svg" alt="icon">
                        <img class="cursor" src="img/fille.svg" alt="icon">
                        <div class="form-outline">
                            <input type="text" id="form12" class="massege_input form-control" >
                        </div>
                        <img class="cursor send-message" src="img/sand.svg" alt="icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
    <script src="contact.js"></script>
</body>

</html>