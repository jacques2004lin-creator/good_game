<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

// RÉCUPÉRER LES JEUX DE LA BIBLIOTHÈQUE DE L'UTILISATEUR
$sql_biblio = "
    SELECT j.id, j.titre, j.image 
    FROM biblio b 
    JOIN jeux j ON b.jeu_id = j.id 
    WHERE b.utilisateur_id = $id_utilisateur
";
$resultat_biblio = $conn->query($sql_biblio);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/bibliotheque.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque - Good Game</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="gg-lib-container">
        <h1 class="gg-page-title">Bibliothèque</h1>

        <div class="gg-lib-layout">

            <div class="gg-lib-grid">
                <?php if ($resultat_biblio && $resultat_biblio->num_rows > 0): ?>
                    <?php while ($jeu = $resultat_biblio->fetch_assoc()): ?>
                        <div class="gg-lib-card">
                            <img src="<?php echo htmlspecialchars($jeu['image']); ?>" alt="Jeu" class="gg-lib-img">
                            <h3 class="gg-lib-title"><?php echo htmlspecialchars($jeu['titre']); ?></h3>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Votre bibliothèque est vide pour le moment.</p>
                <?php endif; ?>
            </div>

            <aside class="gg-lib-sidebar">
                <h3 class="gg-filter-title">FILTRE</h3>

                <div class="gg-filter-search">
                    <input type="text" placeholder="Recherche">
                </div>

                <h4 class="gg-filter-subtitle">Catégories:</h4>
                <ul class="gg-filter-list">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Nouveaux</a></li>
                    <li><a href="#">Gratuit</a></li>
                    <li><a href="#">FPS</a></li>
                    <li><a href="#">Aventure</a></li>
                    <li><a href="#">Jeux de guerre</a></li>
                    <li><a href="#">RPG</a></li>
                    <li><a href="#">Open world</a></li>
                    <li><a href="#">Combat</a></li>
                    <li><a href="#">Horreur</a></li>
                    <li><a href="#">MOBA</a></li>
                    <li><a href="#">Stratégies</a></li>
                    <li><a href="#">2D</a></li>
                    <li><a href="#">3D</a></li>
                </ul>
            </aside>

        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="burger_profile.js"></script>
</body>

</html>
<?php $conn->close(); ?>