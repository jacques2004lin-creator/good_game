<?php
<<<<<<< HEAD
session_start();
include "good_game_db.php";

// Récupérer le terme de recherche
$recherche = "";
if (isset($_GET['q'])) {
    $recherche = $conn->real_escape_string($_GET['q']);
}

// Chercher dans la base de données les jeux qui contiennent le terme recherché
$sql_recherche = "SELECT * FROM jeux WHERE titre LIKE '%$recherche%'";
$resultat_recherche = $conn->query($sql_recherche);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/bibliotheque.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche - Good Game</title>
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <div class="gg-lib-container">
        <h1 class="gg-page-title">Résultats pour "<?php echo htmlspecialchars($recherche); ?>"</h1>

        <div class="gg-lib-layout">
            <div class="gg-lib-grid gg-search-grid">

                <?php if ($resultat_recherche && $resultat_recherche->num_rows > 0): ?>
                    <?php while ($jeu = $resultat_recherche->fetch_assoc()): ?>

                        <?php
                        // Générer le nom du dossier pour l'image
                        $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre'])));
                        ?>

                        <a href="jeux.php?id=<?php echo $jeu['id']; ?>" class="gg-search-link">
                            <div class="gg-lib-card">
                                <img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="Jeu" class="gg-lib-img">
                                <h3 class="gg-lib-title"><?php echo htmlspecialchars($jeu['titre']); ?></h3>
                                <p class="gg-search-price"><?php echo number_format($jeu['prix'], 2, ',', ' '); ?> €</p>
                            </div>
                        </a>

                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="gg-lib-empty gg-search-empty">
                        <h2>Oups ! Aucun jeu trouvé.</h2>
                        <p>Essayez de vérifier l'orthographe ou d'utiliser d'autres mots-clés.</p>
                        <a href="index.php" class="gg-btn-white gg-search-empty-btn">Retour à l'accueil</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
<?php $conn->close(); ?>
=======
include "good_game_db.php";
$q = $_GET['q'] ?? '';

$sql = "SELECT id, titre FROM jeux WHERE titre LIKE '%$q%' LIMIT 10";
$result = $conn->query($sql);

$json = [];
while($row = $result->fetch_assoc()){
    $json[] = $row;
}

echo json_encode($json);
>>>>>>> 0cf97e16ee60aa865a3be2f016aecf0fac80f642
