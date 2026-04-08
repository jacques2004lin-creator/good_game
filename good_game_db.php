<?php
if (gethostbyname('db') !== 'db') {
    // Docker
    $servername = "db";
    $password = "root";
} else {
    // XAMPP
    $servername = "localhost";
    $password = "";
}

$conn = @new mysqli($servername, $username, $passowrd, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_errno == 1049) {
    header("Location: ini.php");
    exit();
}