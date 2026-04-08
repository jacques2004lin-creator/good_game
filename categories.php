<?php
session_start();

// Connexion à la base de données
include "good_game_db.php";

// Requete pour récupérer les catégories
$sql_categories = "SELECT * FROM categories"; 
$res_categories = $conn->query($sql_categories);

include "categories_view.php";

$conn->close();
?>