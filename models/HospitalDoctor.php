<?php

class HospitalDoctor
{
    var $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    private function exec($query)
    {
        return $this->conn->query($query);
    }

    public function checkDoctorRelation($doctorId)
    {
        $query = "SELECT doctor_id FROM doctor_hospital WHERE doctor_id = '$doctorId' LIMIT 1";
        return $this->exec($query);
    }

    public function checkHospitalRelation($hospitalId)
    {
        $query = "SELECT hospital_id FROM rating WHERE hospital_id = '$hospitalId' LIMIT 1";
        return $this->exec($query);
    }
}
