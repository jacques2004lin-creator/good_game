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
    $sql = "SELECT * FROM jeux WHERE id = $id";
    $res = $conn->query($sql);
    $jeu = $res->fetch_assoc();
    if (!$jeu) {
        die("Jeu introuvable.");
    }
}

// Sauvegarde modif
if(isset($_POST['modifier_tout'])) {
    $id = intval($_POST['id']);
    $titre = $conn->real_escape_string((string)$_POST['titre']);
    $prix = floatval($_POST['prix']);
    $cat = intval($_POST['categorie_id']);
    $desc = $conn->real_escape_string((string)$_POST['description']);
    $desc_longue = $conn->real_escape_string((string)$_POST['description_longue']);
    $img = $conn->real_escape_string((string)$_POST['image']);
    $date_s = $conn->real_escape_string((string)$_POST['date_sortie']);
    $dev = $conn->real_escape_string((string)$_POST['developpeur']);
    $edit = $conn->real_escape_string((string)$_POST['editeur']);
    $pegi = $conn->real_escape_string((string)$_POST['pegi']);
    $func = $conn->real_escape_string((string)$_POST['fonctionnalites']);
    $aud = $conn->real_escape_string((string)$_POST['lang_audio']);
    $txt = $conn->real_escape_string((string)$_POST['lang_texte']);
    $m_os = $conn->real_escape_string((string)$_POST['sys_min_os']);
    $m_cpu = $conn->real_escape_string((string)$_POST['sys_min_cpu']);
    $m_ram = $conn->real_escape_string((string)$_POST['sys_min_ram']);
    $m_gpu = $conn->real_escape_string((string)$_POST['sys_min_gpu']);
    $m_dx = $conn->real_escape_string((string)$_POST['sys_min_dx']);
    $m_st = $conn->real_escape_string((string)$_POST['sys_min_stockage']);
    $r_os = $conn->real_escape_string((string)$_POST['sys_rec_os']);
    $r_cpu = $conn->real_escape_string((string)$_POST['sys_rec_cpu']);
    $r_ram = $conn->real_escape_string((string)$_POST['sys_rec_ram']);
    $r_gpu = $conn->real_escape_string((string)$_POST['sys_rec_gpu']);
    $r_dx = $conn->real_escape_string((string)$_POST['sys_rec_dx']);
    $r_st = $conn->real_escape_string((string)$_POST['sys_rec_stockage']);

    $sql = "UPDATE jeux SET 
            titre='$titre', prix='$prix', categorie_id='$cat', description='$desc', 
            description_longue='$desc_longue', image='$img', date_sortie='$date_s', 
            developpeur='$dev', editeur='$edit', pegi='$pegi', 
            fonctionnalites='$func', lang_audio='$aud', lang_texte='$txt',
            sys_min_os='$m_os', sys_min_cpu='$m_cpu', sys_min_ram='$m_ram', sys_min_gpu='$m_gpu', sys_min_dx='$m_dx', sys_min_stockage='$m_st',
            sys_rec_os='$r_os', sys_rec_cpu='$r_cpu', sys_rec_ram='$r_ram', sys_rec_gpu='$r_gpu', sys_rec_dx='$r_dx', sys_rec_stockage='$r_st'
            WHERE id = $id";

    if($conn->query($sql)) {
        header("Location: admin.php?msg=Le jeu a été mis à jour");
        exit();
    } else {
        $message = "Erreur : " . $conn->error;
    }
}

$cats = $conn->query("SELECT * FROM categories");

include "view/modifier_jeu_view.php";

$conn->close();
?>