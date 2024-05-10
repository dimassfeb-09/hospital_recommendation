<?php

$host = "localhost";
$username = "root";
$password = "Aa11bb22_";
$database = "";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    echo ("Koneksi gagal: " . $conn->connect_error);
}
