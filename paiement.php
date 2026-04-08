<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

// VÉRIFIER QUE LE PANIER N'EST PAS VIDE
$sql_panier = "SELECT j.id, j.prix FROM panier p JOIN jeux j ON p.jeu_id = j.id WHERE p.utilisateur_id = $id_utilisateur";
$resultat_panier = $conn->query($sql_panier);

if ($resultat_panier->num_rows == 0) {
    header("Location: panier.php");
    exit();
}

// CALCUL DU SOUS-TOTAL ET PRÉPARATION DES JEUX
$sous_total = 0;
$jeux_a_acheter = [];
while ($jeu = $resultat_panier->fetch_assoc()) {
    $sous_total += $jeu['prix'];
    $jeux_a_acheter[] = $jeu;
}

// TRANSACTION DANS LA BASE DE DONNÉES
$sql_achat = "INSERT INTO achats (utilisateur_id, sous_total, status) VALUES ($id_utilisateur, $sous_total, 'Validée')";

if ($conn->query($sql_achat) === TRUE) {
    $id_achat = $conn->insert_id; 

    foreach ($jeux_a_acheter as $jeu) {
        $jeu_id = $jeu['id'];
        $prix = $jeu['prix'];

        $conn->query("INSERT INTO achat_jeux (achat_id, jeu_id, prix) VALUES ($id_achat, $jeu_id, $prix)");
        $conn->query("INSERT IGNORE INTO biblio (utilisateur_id, jeu_id) VALUES ($id_utilisateur, $jeu_id)");
    }

    $conn->query("DELETE FROM panier WHERE utilisateur_id = $id_utilisateur");
    $achat_reussi = true;
} else {
    $achat_reussi = false;
}

include "paiement_view.php";

$conn->close();
?>