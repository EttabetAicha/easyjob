<?php

namespace App\Controllers;

use App\Models\ApplyModel;

class ApplyController
{
    private $applyModel;

    public function __construct()
    {
        $this->applyModel = new ApplyModel();
    }

    public function applyForJob($idJob, $idUser)
    {
        $result = $this->applyModel->applyOffre($idJob, $idUser);

        if ($result) {
          
            echo "Application successful!";
        } else {
           
            echo "You have already applied for this job.";
        }
    }

    public function getAppliedJobs($isApproved)
    {
        $appliedJobs = $this->applyModel->getApplyOnline($isApproved);

        
        print_r($appliedJobs);
    }

    public function approveOffer($idOffer, $test)
    {
        $result = $this->applyModel->AprouvOffer($idOffer, $test);

        if ($result) {
           
            echo "Offer status updated successfully.";
        } else {
            
            echo "Error updating offer status.";
        }
    }

    public function declineOffer($idOffer)
    {
        $result = $this->applyModel->DeclineOffer($idOffer);

        if ($result) {
            
            echo "Offer declined successfully.";
        } else {
          
            echo "Error declining offer.";
        }
    }

    public function getUserNotifications($idUser)
    {
        $notifications = $this->applyModel->getNotefication($idUser);

      
        print_r($notifications);
    }
}
