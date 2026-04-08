<?php
session_start();
include "good_game_db.php";

// On Vérifie si c'est bien l'Admin
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
} 

$message = "";

// Gestion des actions
if (isset($_POST['action'])) {

    // Action : Ajouter un jeu
    if ($_POST['action'] == 'ajouter_jeu') {
        $titre = $conn->real_escape_string($_POST['titre']);
        $prix = floatval($_POST['prix']);
        $cat = intval($_POST['categorie_id']);
        $desc = $conn->real_escape_string($_POST['description']);
        $desc_l = $conn->real_escape_string($_POST['description_longue']);
        $img = $conn->real_escape_string($_POST['image']);
        $img1 = $conn->real_escape_string($_POST['img_min1']);
        $img2 = $conn->real_escape_string($_POST['img_min2']);
        $img3 = $conn->real_escape_string($_POST['img_min3']);
        $dev = $conn->real_escape_string($_POST['developpeur']);
        $edit = $conn->real_escape_string($_POST['editeur']);
        $pegi = $conn->real_escape_string($_POST['pegi']);
        $date_s = $conn->real_escape_string($_POST['date_sortie']);
        $m_cpu = $conn->real_escape_string($_POST['sys_min_cpu']);
        $m_ram = $conn->real_escape_string($_POST['sys_min_ram']);
        $m_gpu = $conn->real_escape_string($_POST['sys_min_gpu']);
        $m_os = $conn->real_escape_string($_POST['sys_min_os']);
        $m_dx = $conn->real_escape_string($_POST['sys_min_dx']);
        $m_st = $conn->real_escape_string($_POST['sys_min_stockage']);
        $r_cpu = $conn->real_escape_string($_POST['sys_rec_cpu']);
        $r_ram = $conn->real_escape_string($_POST['sys_rec_ram']);
        $r_gpu = $conn->real_escape_string($_POST['sys_rec_gpu']);
        $r_os = $conn->real_escape_string($_POST['sys_rec_os']);
        $r_dx = $conn->real_escape_string($_POST['sys_rec_dx']);
        $r_st = $conn->real_escape_string($_POST['sys_rec_stockage']);
        $l_aud = $conn->real_escape_string($_POST['lang_audio']);
        $l_txt = $conn->real_escape_string($_POST['lang_texte']);
        $func = $conn->real_escape_string($_POST['fonctionnalites']);

        $sql_insert = "INSERT INTO jeux (
            titre, prix, categorie_id, description, description_longue, image, 
            img_min1, img_min2, img_min3, developpeur, editeur, pegi, date_sortie,
            sys_min_os, sys_min_cpu, sys_min_ram, sys_min_gpu, sys_min_dx, sys_min_stockage,
            sys_rec_os, sys_rec_cpu, sys_rec_ram, sys_rec_gpu, sys_rec_dx, sys_rec_stockage,
            lang_audio, lang_texte, fonctionnalites
        ) VALUES (
            '$titre', '$prix', $cat, '$desc', '$desc_l', '$img', 
            '$img1', '$img2', '$img3', '$dev', '$edit', '$pegi', '$date_s',
            '$m_os', '$m_cpu', '$m_ram', '$m_gpu', '$m_dx', '$m_st',
            '$r_os', '$r_cpu', '$r_ram', '$r_gpu', '$r_dx', '$r_st',
            '$l_aud', '$l_txt', '$func'
        )";

        if($conn->query($sql_insert)) {
            $message = "Jeu ajouté avec succès !";
        } else {
            $message = "Erreur : " . $conn->error;
        }
    }

    // Action : Supprimer
    if ($_POST['action'] == 'supprimer_jeu') {
        $id = intval($_POST['id_jeu']);
        $conn->query("DELETE FROM jeux WHERE id = $id");
        $message = "Jeu supprimé !";
    }
}

// Affichage des données
$sql_achats = "SELECT achats.*, utilisateurs.nom, utilisateurs.prenom 
               FROM achats 
               JOIN utilisateurs ON achats.utilisateur_id = utilisateurs.id 
               ORDER BY achats.id DESC";
$res_achats = $conn->query($sql_achats);

$sql_liste = "SELECT jeux.*, categories.nom as cat_nom 
              FROM jeux JOIN categories ON jeux.categorie_id = categories.id 
              ORDER BY id DESC";
$res_liste = $conn->query($sql_liste);

$cats = $conn->query("SELECT * FROM categories");

include "admin_view.php";

$conn->close();
?>