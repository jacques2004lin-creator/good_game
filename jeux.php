<?php
session_start();

// Connexion à la base de données
include "good_game_db.php";

// Vérifie si on a bien l'id du jeu dans l'URL
if(isset($_GET['id'])) {
    $id_url = $conn->real_escape_string($_GET['id']);
    
    $sql = "SELECT jeux.*, categories.nom AS nom_categorie 
            FROM jeux 
            JOIN categories ON jeux.categorie_id = categories.id 
            WHERE jeux.id = '$id_url'";
    
    $res_jeux = $conn->query($sql);

    if($res_jeux->num_rows > 0) {
        $jeu = $res_jeux->fetch_assoc();
        $cat_brute = $jeu['nom_categorie'];
        $titre_categorie = ucwords(strtolower(str_replace('_', ' ', $cat_brute)));

    } else {
        die("Ce jeu n'existe pas.");
    }

} else {
    header("Location: index.php");
    exit();
}

$nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre'])));

$deja_possede = false;

// Vérifie si l'utilisateur à deja le jeu
if (isset($_SESSION['id_utilisateur'])) {
    $id_user = $_SESSION['id_utilisateur'];
    $id_jeu = $jeu['id'];
    
    $check_biblio = $conn->query("SELECT * FROM biblio WHERE utilisateur_id = '$id_user' AND jeu_id = '$id_jeu'");
    
    if ($check_biblio && $check_biblio->num_rows > 0) {
        $deja_possede = true;
    }
}

include "jeux_view.php";

$conn->close();
?>