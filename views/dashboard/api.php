<?php
// header('Content-Type: application/json');


require __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\ApplyController;
use App\Controllers\JobController;
use App\Controllers\UserController;

$jobController = new JobController();
$userController = new UserController();
$applyController = new ApplyController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $route = $_GET['route'] ?? '';

    switch ($route) {
        case 'logincheck':
            extract($_POST);
            $userController->login(['email' => $email, 'password' => $password]);
            break;
        
        case 'registercheck':
            extract($_POST);
            $role = ''; 
            $userController->register(['name' => $name, 'email' => $email, 'password' => $password, 'confpassword' => $confpassword, 'role' => $role]);
            break;
       
        case 'dashboard':
            $jobController->index();
            break;
        case 'addJob':
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $entreprise = $_POST['entreprise'] ?? '';
            $location = $_POST['location'] ?? '';
            $isActive = $_POST['IsActive'] ?? '';
            $approve = $_POST['approve'] ?? '';
            $idJobs = $_POST['jobID'] ?? '';
            $photo = isset($_FILES['photo']) ? $_FILES['photo'] : '';

            if ($photo['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = 'assets/upload/';
                $targetFile = $targetDirectory . basename($photo['name']);

                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                $allowedImageTypes = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($imageFileType, $allowedImageTypes)) {
                    if (!file_exists($targetDirectory)) {
                        mkdir($targetDirectory, 0777, true);
                    }

                    if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
                        $originalFileName = basename($photo['name']);
                        $jobController->addJob($title, $description, $entreprise, $location, $isActive, $approve, $originalFileName);
                        echo json_encode(['success' => true, 'message' => 'Job added successfully.']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error uploading file.']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'File upload error: ' . $photo['error']]);
            }
            break;


        case 'updateJob':
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $entreprise = $_POST['entreprise'] ?? '';
            $location = $_POST['location'] ?? '';
            $isActive = $_POST['IsActive'] ?? '';
            $approve = $_POST['approve'] ?? '';
            $idJobs = $_POST['jobID'] ?? '';

            $jobController->updateJob($title, $description, $entreprise, $location, $isActive, $approve, $idJobs);
            echo json_encode(['success' => true, 'message' => 'Job updated successfully.']);
            break;


        case 'deleteJob':
            $idJob = $_POST['jobID'] ?? '';
            $jobController->deleteJob($idJob);
            echo json_encode(['success' => true, 'message' => 'Job deleted successfully.']);
            break;

        case 'deleteUser':
            $userID = $_POST['userID'] ?? '';
            $result = $userController->deleteUser($userID);
            echo json_encode(['success' => $result, 'message' => 'User deleted successfully.']);
            break;
        case 'search':
            
            $searchData = $_POST['searchData'] ?? [];

            $searchType = $searchData['field'] ?? '';
            $searchValue = $searchData[$searchType] ?? '';

            $searchController = new JobController();

            try {
                $searchResults = $searchController->searchJobs($searchType, $searchValue);

                echo json_encode(['success' => true, 'data' => $searchResults]);
            } catch (Exception $e) {
                error_log('Search failed: ' . $e->getMessage());

                echo json_encode(['success' => false, 'message' => 'An error occurred during the search.']);
            }
            break;

        case 'applyoffer':
            $Job = $_POST['applyOffre'];
            $JobOffer = explode("/", $Job);
            $idUser = $JobOffer[0];
            $idJob = $JobOffer[1];

            if ($idUser !== null && $idJob !== null) {
                $res = $applyController->applyOffer($idJob, $idUser);

                if ($res) {
                    $response = array('status' => 'success');
                } else {
                    $response = array('status' => 'error');
                }
            } else {
                $response = array('status' => 'not found');
            }
            header('Content-Type: application/json');
            echo json_encode($response);
            break;

            case 'approveOffer':
                $offerID = $_POST['ApplyOnlineID'] ?? '';
                $status = $_POST['status'] ?? '';
                $userId = $_SESSION['id'];
                $subject = 'Approve your Offer';
                $htmlContent = '';
            
                $result = $applyController->approveOffer($offerID, $userId, $subject, $htmlContent);
            
                $response = [
                    'success' => $result,
                    'message' => $result ? 'Offer approved successfully.' : 'Failed to approve offer.'
                ];
            
                header('Content-Type: application/json');
                echo json_encode($response);
                break;
            
            case 'declineOffer':
                $offerID = $_POST['ApplyOnlineID'] ?? '';
                $message = 'u are not accepted';
                $result = $applyController->declineOffer($offerID, $message);
            
                $response = [
                    'success' => $result,
                    'message' => $result ? 'Offer declined successfully.' : 'Failed to decline offer.'
                ];
            
                header('Content-Type: application/json');
                echo json_encode($response);
                break;
            
    }
}





// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $action = $_POST['action'] ?? '';

//     if ($action === 'search') {
//         $searchData = $_POST['searchData'] ?? [];

//         $searchType = $searchData['field'] ?? '';
//         $searchValue = $searchData[$searchType] ?? '';

//         $searchController = new JobController();

//         try {
//             $searchResults = $searchController->searchJobs($searchType, $searchValue);

//             echo json_encode(['success' => true, 'data' => $searchResults]);
//         } catch (Exception $e) {
//             error_log('Search failed: ' . $e->getMessage());

//             echo json_encode(['success' => false, 'message' => 'An error occurred during the search.']);
//         }
//     } else {
//         echo 'error search ';
//     }
// }
