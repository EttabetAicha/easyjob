<?php

namespace App\Controllers;

use App\Models\jobModel;

class JobController
{
    private $jobModel;

    public function __construct()
    {
        $this->jobModel = new jobModel();
    }

    public function addJob($title, $description, $entreprise, $location, $isActive, $approve, $photo)
    {
        $result = $this->jobModel->addJob($title, $description, $entreprise, $location, $isActive, $approve, $photo);
        if ($result) {
            header('location: ../dashboard/offreCrud.php');
        }
    }

    public function deleteJob($idJob)
    {
        $result = $this->jobModel->deleteJob($idJob);
        if ($result) {
            header('location:../dashboard/offreCrud.php');
        }
    }

    public function updateJob($title, $description, $entreprise, $location, $isActive, $approve, $id_Jobs)
    {
        $result = $this->jobModel->updateJob($title, $description, $entreprise, $location, $isActive, $approve, $id_Jobs);
        if ($result) {
            header('location:../dashboard/offreCrud.php');
        }
    }

    
}
