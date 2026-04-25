<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "database/good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

if (isset($_POST['action']) && $_POST['action'] == 'ajouter') {
    $jeu_id_a_ajouter = (int)$_POST['id_produit'];
    
    // On vérifie d'abord si le jeu n'est pas déjà dans le panier
    $verif_panier = $conn->query("SELECT * FROM panier WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_ajouter");
    
    if ($verif_panier->num_rows == 0) {
        // S'il n'y est pas, on l'ajoute dans la base de données !
        $conn->query("INSERT INTO panier (utilisateur_id, jeu_id) VALUES ($id_utilisateur, $jeu_id_a_ajouter)");
        $_SESSION['message'] = "Jeu ajouté à votre panier !";
    } else {
        $_SESSION['message'] = "Ce jeu est déjà dans votre panier.";
    } 
    
    header("Location: panier.php");
    exit();
}

// SUPPRIMER UN JEU SPÉCIFIQUE
if (isset($_POST['btn_supprimer'])) {
    $jeu_id_a_supprimer = (int)$_POST['jeu_id'];
    $conn->query("DELETE FROM panier WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_supprimer");
    $_SESSION['message'] = "Jeu retiré du panier !";
    header("Location: panier.php"); 
    exit();
}

// SUPPRIMER TOUT LE PANIER
if (isset($_POST['btn_supprimer_tout'])) {
    $conn->query("DELETE FROM panier WHERE utilisateur_id = $id_utilisateur");
    $_SESSION['message'] = "Votre panier a été vidé !";
    header("Location: panier.php");
    exit();
}

// RÉCUPÉRER LES JEUX POUR LES AFFICHER
$sql_panier = "
    SELECT j.id, j.titre, j.prix, j.image 
    FROM panier p 
    JOIN jeux j ON p.jeu_id = j.id 
    WHERE p.utilisateur_id = $id_utilisateur
";
$resultat_panier = $conn->query($sql_panier);
$total_panier = 0;

include "view/panier_view.php";

$conn->close();
?>