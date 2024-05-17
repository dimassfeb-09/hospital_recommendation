<?php

$host = "localhost";
$username = "root";
$password = "root";
$database = "hospital_test";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    echo ("Koneksi gagal: " . $conn->connect_error);
}
