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

    public function applyOffer($idJob, $idUser)
    {
        $result = $this->applyModel->applyOffre($idJob, $idUser);

        if ($result) {
            return ['success' => true, 'message' => 'Application submitted successfully.'];
        } else {
            return ['success' => false, 'message' => 'You have already applied for this job.'];
        }
    }

    public function getAppliedJobs($isApproved)
    {
        return $this->applyModel->getApplyOnline($isApproved);
    }

    public function approveOffer($idOffer, $test)
    {
        $result = $this->applyModel->AprouvOffer($idOffer, $test);

        if ($result) {
            return ['success' => true, 'message' => 'Offer status updated successfully.'];
        } else {
            return ['success' => false, 'message' => 'Error updating offer status.'];
        }
    }

    public function declineOffer($idOffer)
    {
        $result = $this->applyModel->DeclineOffer($idOffer);

        if ($result) {
            return ['success' => true, 'message' => 'Offer declined successfully.'];
        } else {
            return ['success' => false, 'message' => 'Error declining offer.'];
        }
    }

    public function getUserNotifications($idUser)
    {
        return $this->applyModel->getNotifications($idUser);
    }
}
