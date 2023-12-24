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
            header('location:?route=offer');
        }
    }
    public function getoffer()
    {
        $jobs = $this->jobModel->getJobs(1);
        require(__DIR__ .'/../../views/dashboard/offer.php');
    }
 

    public function index()
    {
        $jobs = $this->jobModel->getJobs(1);
        require(__DIR__ .'/../../views/home.php');
    }
 
    public function deleteJob($idJob)
    {
        $result = $this->jobModel->deleteJob($idJob);
        if ($result) {
            header('location: ?route=offer');
        }
    }
    public function updateJob($title, $description, $entreprise, $location, $isActive, $approve, $idJobs)
    {
        $result = $this->jobModel->updateJob($title, $description, $entreprise, $location, $isActive, $approve, $idJobs);
        if ($result) {
            header('location:?route=offer');
        }
    }
    
    public function searchJobs($searchType, $searchValue)
    {
        
        return $this->jobModel->searchJobs($searchType, $searchValue);
    }
    public function totalJobs()
    {
        $total =$this->jobModel->totalJobs();
        $statistic =$this->jobModel->statistic(1);
        $countApprove= $this->jobModel->countApprovedJobs(0);
        $countApproveinactive= $this->jobModel->countApprovedJobs(1);
        require(__DIR__.'/../../views/dashboard/dashboard.php');
    }


}
