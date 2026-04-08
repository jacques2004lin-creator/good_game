<?php
$servername = "db";
$username = "root";
$passowrd = "root";
$dbname = "good_game";

$conn = @new mysqli($servername, $username, $passowrd, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_errno == 1049) {
    header("Location: setup.php");
    exit();
}