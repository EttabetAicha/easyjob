<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class JobModel extends DB
{
    public function totalJobs()
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("SELECT count(*) as 'the total jobs is' FROM jobs");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function statistic($status)
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("SELECT count(*) as 'statistique jobs active and inactive' FROM jobs WHERE IsActive=?");
        $stmt->execute([$status]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countApprovedJobs($status)
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("SELECT count(*) as 'statistique the approve jobs' FROM jobs WHERE approve=?");
        $stmt->execute([$status]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getJobs($isActive)
    {
        $conn = $this->getConn();
        if ($isActive == 1) {
            $stmt = $conn->prepare("SELECT * FROM jobs");
        } else {
            $stmt = $conn->prepare("SELECT * FROM jobs WHERE IsActive =? AND approve=0");
            $stmt->execute([$isActive]);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addJob($title, $description, $entreprise, $location, $isActive, $approve, $src)
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("INSERT INTO jobs (title, description, entreprise, location, IsActive, imageURL, approve) VALUES (?,?,?,?,?,?,?)");
        return $stmt->execute([$title, $description, $entreprise, $location, $isActive, $src, $approve]);
    }

    public function updateJob($title, $description, $entreprise, $location, $isActive, $approve, $idJobs)
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("UPDATE jobs SET title=?, description=?, entreprise=?, location=?, IsActive=?, approve=? WHERE jobID =?");
        return $stmt->execute([$title, $description, $entreprise, $location, $isActive, $approve, $idJobs]);
    }

    public function deleteJob($idJob)
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("DELETE FROM jobs WHERE jobID=?");
        return $stmt->execute([$idJob]);
    }

    public function searchJob($searchValue, $searchType)
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("SELECT * FROM jobs WHERE $searchType LIKE ?");
        $search = "%$searchValue%";
        $stmt->execute([$search]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateApprove($idOffer, $approve)
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("UPDATE jobs SET approve=? WHERE jobID =?");
        return $stmt->execute([$approve, $idOffer]);
    }
}
