<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

// GESTION DES FILTRES
$categorie_active = (int)($_GET['categorie_id'] ?? 0);
$recherche_lib = $conn->real_escape_string($_GET['q_lib'] ?? "");

$filtre_sql = "";
if ($categorie_active > 0) {
    $filtre_sql .= " AND jeux.categorie_id = $categorie_active";
}
if (!empty($recherche_lib)) {
    $filtre_sql .= " AND jeux.titre LIKE '%$recherche_lib%'";
}

// RÉCUPÉRER LES JEUX FILTRÉS
$sql_biblio = "
    SELECT jeux.id, jeux.titre, jeux.image 
    FROM biblio 
    JOIN jeux ON biblio.jeu_id = jeux.id 
    WHERE biblio.utilisateur_id = $id_utilisateur
    $filtre_sql
    ORDER BY jeux.titre ASC
";
$resultat_biblio = $conn->query($sql_biblio);

// RÉCUPÉRER TOUTES LES CATÉGORIES
$sql_categories = "SELECT id, nom FROM categories ORDER BY nom ASC";
$resultat_categories = $conn->query($sql_categories);

include "bibliotheque_view.php";

$conn->close();
?>