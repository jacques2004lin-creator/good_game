<?php
session_start();

// Connexion à la base de données
include "database/good_game_db.php";

// On vérifie si la catégorie est bien présente dans l'URL
if(isset($_GET['cat']) && !empty($_GET['cat'])) {
    $categorie_choisie = $conn->real_escape_string($_GET['cat']);

    // On récupére les jeux qui ont ce nom de catégorie
    $sql_genre = "SELECT jeux.* FROM jeux 
                JOIN categories ON jeux.categorie_id = categories.id 
                WHERE categories.nom = '$categorie_choisie'";

    $res_genre = $conn->query($sql_genre);

    $titre_page = $_GET['cat'];
    $titre_avec_espaces = str_replace('_', ' ', $titre_page);
    $titre = ucwords(strtolower($titre_avec_espaces));

} else {
    header("Location: index.php");
    exit();
}

include "view/genre_view.php";

$conn->close();
?>