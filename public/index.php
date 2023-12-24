 <?php
    session_start();
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Controllers\UserController;
    use App\Controllers\JobController;
    use App\Controllers\ApplyController; // Add this line

    $userController = new UserController();
    $jobController = new JobController();
    $applyController = new ApplyController(); // Add this line

    $route = isset($_GET['route']) ? $_GET['route'] : 'home';
    // var_dump($route);
    switch ($route) {


        case 'home':
            $jobController->index();
            break;
        case 'search':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'applyoffer':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'logout':
            $userController->logout();
            break;
        case 'login':
            $userController->loginHtml();
            break;
        case 'registercheck':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'logincheck':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'approveOffer':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'declineOffer':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'register':
            $userController->registerHtml();
            break;
        case 'dashboard':
            $jobController->totalJobs();
            break;
        case 'candidate':
            $userController->index();
            break;
        case 'offer':
            $jobController->getoffer();
            break;
        case 'notifoffer':
            $applyController->index();
            break;
        case 'contact':
            require(__DIR__ . '/../views/dashboard/contact.php');
            break;
        case 'deleteUser':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'deleteJob':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'addJob':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'updateJob':
            require(__DIR__ . '/../views/dashboard/api.php');
            break;
        case 'notifications':

            $applyController->getUserNotifications();
            break;

            // case 'updateUser':
            //     $userController->updateUser($_POST);
            //     break;
            // case 'addJob':
            //     $jobController->addJob($_POST['title'], $_POST['description'], $_POST['entreprise'], $_POST['location'], $_POST['isActive'], $_POST['approve'], $_FILES['photo']);
            //     break;
            // case 'getJobs':
            //     $jobController->index();
            //     break;
            // case 'deleteJob':
            //     $jobController->deleteJob($_GET['jobID']);
            //     break;
            // case 'updateJob':
            //     $jobController->updateJob($_POST['title'], $_POST['description'], $_POST['entreprise'], $_POST['location'], $_POST['IsActive'], $_POST['approve'], $_POST['idJobs']);
            //     break;
            // case 'searchJobs':
            //     $jobController->searchJobs($_GET['searchType'], $_GET['searchValue']);
            //     break;
            // case 'totalJobs':
            //     $jobController->totalJobs();
            //     break;
            // case 'statistic':
            //     $jobController->statistic($_GET['status']);
            //     break;
            // case 'countApprovedJobs':
            //     $jobController->countApprovedJobs($_GET['status']);
            //     break;
            // case 'applyOffer':
            //     $applyController->applyOffer($_POST['idJob'], $_SESSION['id']);
            //     break;
            // case 'getAppliedJobs':
            //     $applyController->index($_GET['isApproved']);
            //     break;
            // case 'approveOffer':
            //     $applyController->approveOffer($_POST['idOffer'], $_SESSION['id'], $_POST['message']);
            //     break;
            // case 'declineOffer':
            //     $applyController->declineOffer($_POST['idOffer']);
            //     break;
            // case 'getUserNotifications':
            //     $applyController->getUserNotifications($_SESSION['id']);
            //     break;
        default:
            header('HTTP/1.0 404 Not Found');

            break;
    }
