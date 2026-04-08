<?php
$servername = "db";
$username = "root";
$password = "root";
$dbname = "good_game";
 
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
 
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() === 1049) {
        header("Location: ini.php");
        exit();
    } else {
        die("Erreur de connexion : " . $e->getMessage());
    }
}