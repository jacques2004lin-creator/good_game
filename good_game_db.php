<?php
mysqli_report(MYSQLI_REPORT_OFF);

// On récupère le nom de l'hôte (ex: localhost ou goodgame.gamer.gd)
$host_actuel = $_SERVER['HTTP_HOST'];

// MODIFICATION : On ajoute 'gamer.gd' dans la détection
if (strpos($host_actuel, 'gamer.gd') !== false) {

    // CONFIGURATION INFINITYFREE
    $servername = "sql310.infinityfree.com";
    $username   = "if0_41112905";
    $password   = "jacqueslin";
    $dbname     = "if0_41112905_good_game";
} else {
    // CONFIGURATION LOCALE
    $dbname = "good_game";
    $username = "root";

    // On teste Docker en premier
    $conn_test = @new mysqli("db", "root", "root");
    if ($conn_test->connect_error) {
        // Si Docker échoue, c'est XAMPP
        $servername = "localhost";
        $password = "";
    } else {
        $servername = "db";
        $password = "root";
        $conn_test->close();
    }
}

// TENTATIVE DE CONNEXION
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() === 1049) {
        header("Location: ini.php");
        exit();
    } else {
        die("Erreur de connexion : " . $e->getMessage() . " (Hôte : $servername)");
    }
}
