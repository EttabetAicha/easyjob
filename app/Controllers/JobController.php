<?php

namespace App\Controllers;

use App\Models\JobModel;

class JobController
{
    private $jobModel;

    public function __construct()
    {
        $this->jobModel = new JobModel();
    }

    public function addJob($title, $description, $entreprise, $location, $isActive, $approve, $photo)
    {
        $result = $this->jobModel->addJob($title, $description, $entreprise, $location, $isActive, $approve, $photo);
        if ($result) {
            header('location:../dashboard/offer.php');
        }
    }

    public function getJobs($isActive)
    {
        $jobs = $this->jobModel->getJobs($isActive);
        return $jobs;
    }

    public function deleteJob($idJob)
    {
        $result = $this->jobModel->deleteJob($idJob);
        if ($result) {
            header('location:../dashboard/offer.php');
        }
    }
    public function updateJob($title, $description, $entreprise, $location, $isActive, $approve, $idJobs)
    {
        $result = $this->jobModel->updateJob($title, $description, $entreprise, $location, $isActive, $approve, $idJobs);
        if ($result) {
            header('location:../dashboard/offer.php');
        }
    }
    
    public function searchJobs($searchType, $searchValue)
    {
        
        return $this->jobModel->searchJobs($searchType, $searchValue);
    }
    public function totalJobs()
    {
        return $this->jobModel->totalJobs();
    }

    public function statistic($status)
    {
        return $this->jobModel->statistic($status);
    }

    public function countApprovedJobs($status)
    {
        return $this->jobModel->countApprovedJobs($status);
    }

}
