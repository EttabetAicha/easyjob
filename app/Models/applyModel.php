<?php

namespace App\Models;


use App\database\db;
use PDO;

class ApplyModel extends db
{
    public function applyOffre($idJob, $idUser)
    {
        $conn = db::getConn();

        $stmtCheck = $conn->prepare("SELECT * FROM applyonline WHERE userID = ? AND jobID = ?");
        $stmtCheck->execute([$idUser, $idJob]);
        $numRows = $stmtCheck->rowCount();

        if ($numRows > 0) {
            return false;
        }
        $status = 0;
        $notification = 0;

        $stmtInsert = $conn->prepare("INSERT INTO applyonline (userID, jobID, Status, notification) VALUES (?, ?, ?, ?)");
        $result = $stmtInsert->execute([$idUser, $idJob, $status, $notification]);

        return $result;
    }

    public function getApplyOnline($isAprouve)
    {
        $conn = db::getConn();
        $stmt = $conn->prepare("SELECT * FROM users NATURAL JOIN applyonline NATURAL JOIN jobs WHERE Status = ?");
        $stmt->execute([$isAprouve]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function AprouvOffer($idOffer, $test)
    {
        $conn = db::getConn();

        if ($test == 1) {
            $status = 1;
            $notification = 1;
            $stmtUpdate = $conn->prepare("UPDATE applyonline SET Status = ?, notification = ? WHERE ApplyOnlineID = ?");
            $stmtUpdate->execute([$status, $notification, $idOffer]);
            $stmtSelectJobID = $conn->prepare("SELECT jobID FROM applyonline WHERE ApplyOnlineID = ?");
            $stmtSelectJobID->execute([$idOffer]);
            $jobID = $stmtSelectJobID->fetchColumn();

           
            $jobModel = new JobModel();
            $jobModel->updateApprove($jobID, 1);
        } else {
            
            $stmtDelete = $conn->prepare("DELETE FROM applyonline WHERE ApplyOnlineID = ?");
            $stmtDelete->execute([$idOffer]);
        }

        return true;
    }

    public function DeclineOffer($idOffer)
    {
        $conn = db::getConn();

        $status = 2;
        $notification = 1;

        $stmt = $conn->prepare("UPDATE applyonline SET Status = ?, notification = ? WHERE ApplyOnlineID = ?");
        $stmt->execute([$status, $notification, $idOffer]);

        return true;
    }

    public function getNotefication($idUser)
    {
        $conn = db::getConn();

        $stmt = $conn->prepare("SELECT * FROM users NATURAL JOIN applyonline NATURAL JOIN jobs WHERE userID = ?");
        $stmt->execute([$idUser]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}


