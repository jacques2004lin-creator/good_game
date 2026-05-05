<?php
// On désactive les alertes automatiques pour gérer les erreurs nous-mêmes
mysqli_report(MYSQLI_REPORT_OFF);

// On récupère le nom de l'hôte
$host_actuel = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';

// Détection de l'environnement
if (strpos($host_actuel, 'gamer.gd') !== false) {
    // CONFIGURATION INFINITYFREE
    $servername = "sql310.infinityfree.com";
    $username   = "if0_41112905";
    $password   = "MOT_DE_PASSE_SECRET";
    $dbname     = "if0_41112905_good_game";
} else {
    // CONFIGURATION LOCALE
    $servername = "db"; 
    $username   = "root";
    $password   = "root"; 
    $dbname     = "good_game";
}

// TENTATIVE DE CONNEXION
$conn = @new mysqli($servername, $username, $password, $dbname);

// Si la connexion échoue
if ($conn->connect_error) {
    // Si l'erreur est 1049 (Base de données inconnue)
    if ($conn->connect_errno == 1049) {
        // On redirige automatiquement vers le script de création !
        header("Location: ini.php");
        exit();
    } else {
        // Sinon, c'est une autre erreur (mauvais mot de passe, serveur éteint...)
        die("Erreur de connexion MySQL : " . $conn->connect_error);
    }
}

// Si on arrive ici, c'est que la base de données existe et fonctionne
$conn->set_charset("utf8mb4");
?>