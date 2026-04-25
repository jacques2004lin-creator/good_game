<?php
mysqli_report(MYSQLI_REPORT_OFF);

// On récupère le nom de l'hôte
$host_actuel = $_SERVER['HTTP_HOST'];

// On ajoute 'gamer.gd' dans la détection
if(strpos($host_actuel, 'gamer.gd') !== false) {
    // CONFIGURATION INFINITYFREE
    $servername = "sql310.infinityfree.com";
    $username   = "if0_41112905";
    $password   = "MOT_DE_PASSE_SECRET";
    $dbname     = "if0_41112905_good_game";
} else {
    // CONFIGURATION LOCALE
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "good_game";
}

// TENTATIVE DE CONNEXION
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
} catch(mysqli_sql_exception $e) {
    // Code 1049 = Base de données inconnue
    if($e->getCode() === 1049) {
        header("Location: ini.php");
        exit();
    } else {
        die("Erreur de connexion : " . $e->getMessage() . " (Hôte : $servername)");
    }
}
