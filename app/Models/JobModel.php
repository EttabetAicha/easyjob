<?php

namespace App\Models;

use App\Config\Db as ConfigDb;

use PDO;

class JobModel extends ConfigDb
{
    public function getJobs($isActive)
    {
        $conn = ConfigDb::getConn();
        if ($isActive == 1) {
            $stmt = $conn->prepare(" SELECT * FROM jobs ");
            $stmt->execute();
        } else {
            $stmt = $conn->prepare("SELECT * FROM jobs WHERE IsActive = ? AND approve = 0");
            $stmt->execute([$isActive]);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addJob($title, $description, $entreprise, $location, $isActive, $approve, $src)
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("INSERT INTO jobs (title, `description`, entreprise,`location`, IsActive, approve ,imageURL) VALUES (?,?,?,?,?,?,?)");
        return $stmt->execute([$title, $description, $entreprise, $location, $isActive, $approve, $src]);
    }

    public function updateJob($title, $description, $entreprise, $location, $isActive, $approve, $idJobs)
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("UPDATE jobs SET title=?, `description`=?, entreprise=?, `location`=?, IsActive=?, approve=? WHERE jobID =?");
        return $stmt->execute([$title, $description, $entreprise, $location, $isActive, $approve, $idJobs]);
    }

    public function deleteJob($idJob)
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("DELETE FROM jobs WHERE jobID=?");
        return $stmt->execute([$idJob]);
    }

    public function searchJobs($searchType, $searchValue)
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("SELECT * FROM jobs WHERE $searchType LIKE ?");
        $search = "%$searchValue%";
        $stmt->execute([$search]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateApprove($idOffer, $approve)
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("UPDATE jobs SET approve=? WHERE jobID =?");
        return $stmt->execute([$approve, $idOffer]);
    }
    public function totalJobs()
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("SELECT count(*) as 'contjob' FROM jobs");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function statistic($status)
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("SELECT count(*) as 'statusjobs' FROM jobs WHERE IsActive=?");
        $stmt->execute([$status]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countApprovedJobs($status)
    {
        $conn = ConfigDb::getConn();
        $stmt = $conn->prepare("SELECT count(*) as 'approvejobs' FROM jobs WHERE approve=?");
        $stmt->execute([$status]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
