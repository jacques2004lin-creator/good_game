<?php
mysqli_report(MYSQLI_REPORT_OFF);

$username = "root";
$dbname = "good_game";

// Détection de l'environnement
if (gethostbyname('db') !== 'db') {
    // Docker
    $servername = "db";
    $password = "root";
} else {
    // XAMPP
    $servername = "localhost";
    $password = "";
}

// Tentative de connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// GESTION DES ERREURS
if ($conn->connect_errno) {
    // Erreur 1049 = La base de données n'existe pas
    if ($conn->connect_errno == 1049) {
        header("Location: ini.php");
        exit();
    } else {
        // Autre erreur
        die("Erreur de connexion : " . $conn->connect_error);
    }
}