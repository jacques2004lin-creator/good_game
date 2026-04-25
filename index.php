<?php
session_start();

// Connexion à la base de données
include "database/good_game_db.php";

// Requête pour récupérer Resident Evil Requiem
$sql_banniere = "SELECT * FROM jeux WHERE id = 16";
$res_banniere = $conn->query($sql_banniere);

$banniere = $res_banniere->fetch_assoc();

// Requête pour récupérer les jeux "Nouveaux"
$sql_nouveaux = "SELECT * FROM jeux ORDER BY id DESC LIMIT 7";
$res_nouveaux = $conn->query($sql_nouveaux);

// Requête pour récupérer les jeux en "Tendances"
$sql_tendance = "SELECT * FROM jeux LIMIT 9";
$res_tendance = $conn->query($sql_tendance);

// Requete pour récupérer les jeux gratuit
$sql_gratuit = "SELECT * FROM jeux WHERE categorie_id = 8 LIMIT 9";
$res_gratuit = $conn->query($sql_gratuit);

// Requete pour récupérer les catégories
$sql_genres = "SELECT * FROM categories LIMIT 5"; 
$res_genres = $conn->query($sql_genres);

include "view/index_view.php";

$conn->close();
?>