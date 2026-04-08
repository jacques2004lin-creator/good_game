<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

$conn->query("
    DELETE FROM souhait 
    WHERE utilisateur_id = $id_utilisateur 
    AND jeu_id IN (SELECT jeu_id FROM biblio WHERE utilisateur_id = $id_utilisateur)
");

// AJOUTER UN JEU À LA LISTE DE SOUHAITS
if (isset($_POST['action']) && $_POST['action'] == 'ajouter_souhait') {
    $jeu_id_a_ajouter = (int)$_POST['id_produit'];
    
    // On vérifie d'abord si l'utilisateur possède DÉJÀ ce jeu dans sa bibliothèque
    $verif_biblio = $conn->query("SELECT * FROM biblio WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_ajouter");
    
    if ($verif_biblio->num_rows == 0) {
        $verif_souhait = $conn->query("SELECT * FROM souhait WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_ajouter");
        
        if ($verif_souhait->num_rows == 0) {
            $conn->query("INSERT INTO souhait (utilisateur_id, jeu_id) VALUES ($id_utilisateur, $jeu_id_a_ajouter)");
        }
    }
    
    header("Location: liste_souhaits.php");
    exit();
}

// SUPPRIMER UN JEU DE LA LISTE MANUELLEMENT
if (isset($_POST['btn_supprimer'])) {
    $jeu_id_a_retirer = (int)$_POST['jeu_id'];
    $conn->query("DELETE FROM souhait WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_retirer");
    header("Location: liste_souhaits.php"); 
    exit();
}

// DÉPLACER VERS LE PANIER
if (isset($_POST['btn_ajouter_panier'])) {
    $jeu_id = (int)$_POST['jeu_id'];

    // Vérifier si le jeu n'est pas déjà dans le panier
    $check_panier = $conn->query("SELECT * FROM panier WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id");

    if ($check_panier->num_rows == 0) {
        $conn->query("INSERT INTO panier (utilisateur_id, jeu_id) VALUES ($id_utilisateur, $jeu_id)");
        $conn->query("DELETE FROM souhait WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id");
    }
    
    header("Location: liste_souhaits.php"); 
    exit();
}

// RÉCUPÉRER LES JEUX DE LA LISTE DE SOUHAITS POUR L'AFFICHAGE
$sql_souhait = "
    SELECT j.id, j.titre, j.prix, j.image 
    FROM souhait s 
    JOIN jeux j ON s.jeu_id = j.id 
    WHERE s.utilisateur_id = $id_utilisateur
";
$resultat_souhait = $conn->query($sql_souhait);

include "liste_souhaits_view.php";

$conn->close();
?>