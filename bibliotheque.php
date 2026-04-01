<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

// 1. GESTION DU FILTRE DE CATÉGORIE
$filtre_sql = ""; // Par défaut, pas de filtre
$categorie_active = null;

if (isset($_GET['categorie_id']) && is_numeric($_GET['categorie_id'])) {
    $categorie_active = (int)$_GET['categorie_id'];
    // On ajoute une condition à la requête SQL pour filtrer par la catégorie cliquée
    $filtre_sql = " AND j.categorie_id = $categorie_active";
}

// 2. RÉCUPÉRER LES JEUX DE LA BIBLIOTHÈQUE (Avec ou sans filtre)
$sql_biblio = "
    SELECT j.id, j.titre, j.image 
    FROM biblio b 
    JOIN jeux j ON b.jeu_id = j.id 
    WHERE b.utilisateur_id = $id_utilisateur
    $filtre_sql
";
$resultat_biblio = $conn->query($sql_biblio);

// 3. RÉCUPÉRER TOUTES LES CATÉGORIES POUR LE MENU LATÉRAL
$sql_categories = "SELECT id, nom FROM categories ORDER BY nom ASC";
$resultat_categories = $conn->query($sql_categories);
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
    <?php include 'includes/header.php'; ?>

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
                    <div style="grid-column: 1 / -1; color: #888; padding: 20px;">
                        <p>Aucun jeu ne correspond à cette recherche dans votre bibliothèque.</p>
                    </div>
                <?php endif; ?>
            </div>

            <aside class="gg-lib-sidebar">
                <h3 class="gg-filter-title">FILTRE</h3>

                <div class="gg-filter-search">
                    <input type="text" placeholder="Recherche">
                </div>

                <h4 class="gg-filter-subtitle">Catégories:</h4>
                <ul class="gg-filter-list">
                    
                    <li>
                        <a href="bibliotheque.php" <?php if(!$categorie_active) echo 'style="color: white; font-weight: bold;"'; ?>>
                            Tous les jeux
                        </a>
                    </li>
                    <li style="margin-bottom: 10px; border-bottom: 1px solid #333; padding-bottom: 10px;"></li>

                    <?php if ($resultat_categories && $resultat_categories->num_rows > 0): ?>
                        <?php while ($cat = $resultat_categories->fetch_assoc()): ?>
                            <?php 
                                // Nettoyage du nom pour l'affichage (ex: "open_world" devient "Open world")
                                $nom_affiche = ucfirst(strtolower(str_replace('_', ' ', $cat['nom'])));
                                
                                // Si cette catégorie est celle cliquée, on la met en surbrillance (texte blanc)
                                $style_actif = ($categorie_active == $cat['id']) ? 'style="color: white; font-weight: bold;"' : '';
                            ?>
                            <li>
                                <a href="bibliotheque.php?categorie_id=<?php echo $cat['id']; ?>" <?php echo $style_actif; ?>>
                                    <?php echo htmlspecialchars($nom_affiche); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>

                </ul>
            </aside>

        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>

</html>
<?php $conn->close(); ?>