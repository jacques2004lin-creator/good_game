<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "database/good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

// On récupère uniquement les achats de l'utilisateur connecté
$sql = "SELECT * FROM achats WHERE utilisateur_id = $id_utilisateur ORDER BY id DESC";
$achats = $conn->query($sql);

include "view/historique_view.php";

$conn->close();
?>