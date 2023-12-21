<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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

    public function approveOffer($idOffer, $userId, $message)
    {
        $result = $this->applyModel->AprouvOffer($idOffer, $message);

        if ($result) {
            $this->sendEmailNotification($userId, 'Offer approved', 'Your offer has been approved.');
            return ['success' => true, 'message' => 'Offer status updated successfully.'];
        } else {
            return ['success' => false, 'message' => 'Error updating offer status.'];
        }
    }


    public function declineOffer($idOffer)
    {
        $result = $this->applyModel->DeclineOffer($idOffer);

        if ($result) {
            $this->sendEmailNotification($this->applyModel->getUserIdByOfferId($idOffer), 'Offer approved', 'Your offer has been approved.');
            return ['success' => true, 'message' => 'Offer declined successfully.'];
        } else {
            return ['success' => false, 'message' => 'Error declining offer.'];
        }
    }

    public function getUserNotifications($idUser)
    {
        return $this->applyModel->getNotifications($idUser);
    }
    private function sendEmailNotification($userId, $subject, $message)
    {

        require "../../vendor/autoload.php";

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aicha70tabite@gmail.com';
            $mail->Password = 'dmop gxru uyic fxon';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('aicha70tabite@gmail.com', 'aicha ettabet');

            $applyModel = new ApplyModel();
            $userEmail = $applyModel->getUserEmailById($userId);

            if ($userEmail) {
                $mail->addAddress($userEmail);

                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send();
                echo 'Email sent successfully';
            } else {
                echo 'User email not found';
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
