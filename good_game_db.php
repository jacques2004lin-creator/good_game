<?php
mysqli_report(MYSQLI_REPORT_OFF);

if (strpos($_SERVER['HTTP_HOST'], 'infinityfreeapp.com') !== false || strpos($_SERVER['HTTP_HOST'], 'epizy.com') !== false) {
    // CONFIGURATION INFINITYFREE
    $servername = "sql310.infinityfree.com";
    $username   = "if0_41112905";
    $password   = "jacqueslin";
    $dbname     = "if0_41112905_good_game";
} else {
    // Docker
    $username = "root";
    $dbname   = "good_game";
    $servername = "db";
    $password   = "root";
    $conn_test = @new mysqli($servername, $username, $password, $dbname);

    $conn_test->close();
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
        die("Erreur de connexion : " . $e->getMessage());
    }
}