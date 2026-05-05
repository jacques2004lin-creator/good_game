<?php
session_start();

// On vérifie si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "database/good_game_db.php";

$id_utilisateur = $_SESSION['id_utilisateur'];
$message_succes = "";
$message_erreur = "";

// Changement de Prénom
if (isset($_POST['btn_update_pseudo'])) {
    $nouveau_pseudo = $conn->real_escape_string(trim($_POST['nouveau_pseudo']));

    if (!empty($nouveau_pseudo)) {
        $sql = "UPDATE utilisateurs SET prenom = '$nouveau_pseudo' WHERE id = $id_utilisateur";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['prenom'] = $nouveau_pseudo;
            $message_succes = "Votre Prénom a été mis à jour avec succès.";
        } else {
            $message_erreur = "Erreur lors de la mise à jour de votre prénom.";
        }
    }
}

// Changement d'accès (Email et/ou Mot de passe)
if (isset($_POST['btn_update_acces'])) {
    $nouvel_email = $conn->real_escape_string(trim($_POST['nouvel_email']));
    $nouveau_mdp = trim($_POST['nouveau_mdp']);

    $updates = [];

    if (!empty($nouvel_email)) {
        $updates[] = "email = '$nouvel_email'";
    }
    if (!empty($nouveau_mdp)) {
        $mdp_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);
        $updates[] = "motdepasse = '$mdp_hash'";
    }

    if (count($updates) > 0) {
        $sql_update = "UPDATE utilisateurs SET " . implode(", ", $updates) . " WHERE id = $id_utilisateur";
        if ($conn->query($sql_update) === TRUE) {
            $message_succes = "Vos informations de connexion ont été mises à jour.";
        } else {
            $message_erreur = "Erreur lors de la mise à jour (Cet email est peut-être déjà pris).";
        }
    }
}

// Suppression du compte
if (isset($_POST['btn_delete_account'])) {
    $confirmation = trim($_POST['confirm_delete']);

    if ($confirmation === "CONFIRM") {
        $sql = "DELETE FROM utilisateurs WHERE id = $id_utilisateur";
        if ($conn->query($sql) === TRUE) {
            // Détruit la session et renvoie à l'accueil
            session_destroy();
            header("Location: index.php");
            exit();
        } else {
            $message_erreur = "Erreur lors de la suppression du compte.";
        }
    } else {
        $message_erreur = "Vous devez taper exactement 'CONFIRM' pour supprimer votre compte.";
    }
}

// RÉCUPÉRATION DES DONNÉES ACTUELLES DE L'UTILISATEUR
$sql_user = "SELECT * FROM utilisateurs WHERE id = $id_utilisateur";
$result = $conn->query($sql_user);
$utilisateur_actuel = $result->fetch_assoc();

include "view/compte_view.php";

$conn->close();
?>