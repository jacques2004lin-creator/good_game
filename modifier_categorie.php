<?php
session_start();
include "database/good_game_db.php";

// On Vérifie si c'est bien l'Admin
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$message = "";

// Chargement des données
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM categories WHERE id = $id";
    $res = $conn->query($sql);
    $cat = $res->fetch_assoc();
    if (!$cat) {
        die("Catégorie introuvable.");
    }
}

// Sauvegarde modif
if(isset($_POST['modifier_tout'])) {
    $id = intval($_POST['id']);
    $nom = $conn->real_escape_string((string)$_POST['nom']);
    $icone = $conn->real_escape_string((string)$_POST['icone']);
    $couleur = $conn->real_escape_string((string)$_POST['couleur']);

    $sql = "UPDATE categories SET 
            nom='$nom', icone='$icone', couleur='$couleur'
            WHERE id = $id";

    if($conn->query($sql)) {
        header("Location: admin.php?msg=La catégorie a été mis à jour");
        exit();
    } else {
        $message = "Erreur : " . $conn->error;
    }
}

include "view/modifier_categorie_view.php";

$conn->close();
?>