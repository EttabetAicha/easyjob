<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\ApplyController;
use App\Controllers\JobController;
use App\Controllers\UserController;

$jobController = new JobController();
$userController = new UserController();
$applyController = new ApplyController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
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
                $targetDirectory = '../../../public/upload/';
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
            // api.php
        case 'applyoffer':
            $Job = $_POST['applyOffre'];
            $JobOffer = explode("/", $Job);
            $idUser = $JobOffer[0];
            $idJob = $JobOffer[1];
            if ($idUser !== null && $idJob !== null) {
                $res = $applyController->applyOffer($idJob, $idUser);
                if ($res) {
                    echo "seccess";
                } else {
                    echo "error";
                }
            } else {
                echo "not found"; // or any other appropriate error response
            }
            break;

        case 'approveOffer':
            $offerID = $_POST['ApplyOnlineID'] ?? '';
            $status = $_POST['status'] ?? ''; // Corrected to use 'status' instead of 'test'

            $result = $applyController->approveOffer($offerID, $status);

            echo json_encode(['success' => $result, 'message' => $result ? 'Offer approved successfully.' : 'Failed to approve offer.']);
            break;

        case 'declineOffer':
            $offerID = $_POST['ApplyOnlineID'] ?? '';
            $result = $applyController->declineOffer($offerID);

            echo json_encode(['success' => $result, 'message' => $result ? 'Offer declined successfully.' : 'Failed to decline offer.']);
            break;
    }
}





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'search') {
        $searchData = $_POST['searchData'] ?? [];

        $searchType = $searchData['field'] ?? '';
        $searchValue = $searchData[$searchType] ?? '';

        $searchController = new JobController();

        try {
            // Attempt to perform the search
            $searchResults = $searchController->searchJobs($searchType, $searchValue);

            // Send the search results as JSON response
            echo json_encode(['success' => true, 'data' => $searchResults]);
        } catch (Exception $e) {
            // Log the error details
            error_log('Search failed: ' . $e->getMessage());

            // Send an error response
            echo json_encode(['success' => false, 'message' => 'An error occurred during the search.']);
        }
    } else {
        // Handle other actions if needed
    }
}

