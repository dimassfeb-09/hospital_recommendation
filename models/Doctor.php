<?php

class Doctor
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

    function getDetailDoctor($doctorId)
    {
        $query = "SELECT * FROM doctor WHERE doctor_id = '$doctorId'";
        return $this->exec($query);
    }

    function getAllDoctor()
    {
        $query = "SELECT * FROM doctor";
        return $this->exec($query);
    }

    function insertDoctor($name, $specialization, $phone)
    {
        $query = "INSERT INTO doctor (name, specialization, phone) VALUES ('$name', '$specialization', '$phone')";
        return $this->exec($query);
    }

    function updateDoctor($doctorId, $name, $specialization, $phone)
    {
        $query = "UPDATE doctor SET name='$name', specialization='$specialization', phone='$phone' WHERE doctor_id='$doctorId'";
        return $this->exec($query);
    }

    function deleteDoctor($doctorId)
    {
        $query = "DELETE FROM doctor WHERE doctor_id='$doctorId'";
        return $this->exec($query);
    }
}
