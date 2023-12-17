<?php

namespace App\Models;

use App\Config\Db as ConfigDb;

use PDO;
use PDOException;

class ApplyModel extends ConfigDb
{
    public function applyOffre($idJob, $idUser)
    {
        $conn = ConfigDb::getConn();

        $stmtCheck = $conn->prepare("SELECT * FROM applyonline WHERE userID = ? AND jobID = ?");
        $stmtCheck->execute([$idUser, $idJob]);
        $numRows = $stmtCheck->rowCount();

        if ($numRows > 0) {
            return false;
        }

        $status = 0;
        $notification = 0;

        $conn->beginTransaction();

        try {
            $stmtInsert = $conn->prepare("INSERT INTO applyonline (userID, jobID, `Status`, `notification`) VALUES (?, ?, ?, ?)");
            $result = $stmtInsert->execute([$idUser, $idJob, $status, $notification]);

            $stmtUpdateJob = $conn->prepare("UPDATE jobs SET approve = 1 WHERE jobID = ?");
            $stmtUpdateJob->execute([$idJob]);

            $conn->commit();

            return $result;
        } catch (PDOException $e) {
            $conn->rollBack();

            return false;
        }
    }


    public function getApplyOnline($isAprouve)
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("SELECT * FROM users U , applyonline A ,jobs J WHERE U.userID=A.userID and A.jobID=J.jobID and  Status = ?");
        $stmt->execute([$isAprouve]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function AprouvOffer($idOffer)
    {
        $conn = ConfigDb::getConn();

        $status = 1;
        $notification = 1;

        $stmtUpdate = $conn->prepare("UPDATE applyonline SET Status = ?, notification = 1 WHERE ApplyOnlineID = ?");
        $stmtUpdate->execute([$status, $idOffer]);

        $stmtSelectJobID = $conn->prepare("SELECT jobID FROM applyonline WHERE ApplyOnlineID = ?");
        $stmtSelectJobID->execute([$idOffer]);
        $jobID = $stmtSelectJobID->fetchColumn();

        $jobModel = new JobModel();
        $jobModel->updateApprove($jobID, 1);

        return true;
    }

    public function DeclineOffer($idOffer)
    {
        $conn = ConfigDb::getConn();
    
        $conn->beginTransaction();
    
        try {
            // Fetch the jobID before deleting the offer
            $stmtSelectJobID = $conn->prepare("SELECT jobID FROM applyonline WHERE ApplyOnlineID = ?");
            $stmtSelectJobID->execute([$idOffer]);
            $jobID = $stmtSelectJobID->fetchColumn();
    
            // Delete the offer
            $stmtDelete = $conn->prepare("DELETE FROM applyonline WHERE ApplyOnlineID = ?");
            $stmtDelete->execute([$idOffer]);
    
            // Check if the jobID exists in applyonline for the user
            $stmtCheckJob = $conn->prepare("SELECT * FROM applyonline WHERE jobID = ? AND Status = 1");
            $stmtCheckJob->execute([$jobID]);
            $jobExists = $stmtCheckJob->rowCount() > 0;
    
            // If no other user has accepted the job, update the approve value in the jobs table to 0
            if (!$jobExists) {
                $jobModel = new JobModel();
                $jobModel->updateApprove($jobID, 0);
            }
    
            $conn->commit();
    
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
    
            return false;
        }
    }
    
    public function getNotifications($idUser)
    {
        $conn = ConfigDb::getConn();

        $stmt = $conn->prepare("SELECT * FROM applyonline A 
                           JOIN jobs J ON A.jobID = J.jobID 
                           WHERE A.userID = ?");
        $stmt->execute([$idUser]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
