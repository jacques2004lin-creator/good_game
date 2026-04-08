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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bibliotheque.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque - Good Game</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main class="gg-lib-container">
        <h1 class="gg-page-title">Bibliothèque</h1>

        <div class="gg-lib-layout">
            <!-- Grille des jeux -->
            <div class="gg-lib-grid">
                <?php if ($resultat_biblio && $resultat_biblio->num_rows > 0): ?>
                    <?php while ($jeu = $resultat_biblio->fetch_assoc()): ?>
                        <?php $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre']))); ?>
                        <div class="gg-lib-card">
                            <img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="<?php echo htmlspecialchars($jeu["titre"]); ?>" class="gg-lib-img">
                            <h3 class="gg-lib-title"><?php echo htmlspecialchars($jeu['titre']); ?></h3>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="gg-lib-empty">
                        <p>Aucun jeu ne correspond à cette recherche.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Filtres -->
            <aside class="gg-lib-sidebar">
                <h3 class="gg-filter-title">FILTRE</h3>
                
                <form action="bibliotheque.php" method="GET" id="filterForm">
                    <div class="gg-filter-search">
                        <input type="text" name="q_lib" placeholder="Recherche..." value="<?php echo htmlspecialchars($recherche_lib); ?>">
                    </div>

                    <h4 class="gg-filter-subtitle">Catégories:</h4>

                    <!-- PC -->
                    <ul class="gg-filter-list desktop-only">
                        <li>
                            <a href="bibliotheque.php" class="<?php echo ($categorie_active == 0) ? 'gg-filter-active' : ''; ?>">Tous les jeux</a>
                        </li>
                        <li class="gg-filter-divider"></li>
                        <?php 
                        if ($resultat_categories->num_rows > 0) {
                            $resultat_categories->data_seek(0);
                            while ($cat = $resultat_categories->fetch_assoc()) {
                                $nom_affiche = ucfirst(strtolower(str_replace('_', ' ', $cat['nom'])));
                                $class_actif = ($categorie_active == $cat['id']) ? 'class="gg-filter-active"' : '';
                                echo "<li><a href='bibliotheque.php?categorie_id=".$cat['id']."' $class_actif>".htmlspecialchars($nom_affiche)."</a></li>";
                            }
                        }
                        ?>
                    </ul>

                    <!-- Mobile -->
                    <select name="categorie_id" class="mobile-only-select" onchange="this.form.submit()">
                        <option value="0">Toutes les catégories</option>
                        <?php 
                        if ($resultat_categories->num_rows > 0) {
                            $resultat_categories->data_seek(0);
                            while ($cat = $resultat_categories->fetch_assoc()) {
                                $nom_affiche = ucfirst(strtolower(str_replace('_', ' ', $cat['nom'])));
                                $selected = ($categorie_active == $cat['id']) ? 'selected' : '';
                                echo "<option value='".$cat['id']."' $selected>".htmlspecialchars($nom_affiche)."</option>";
                            }
                        }
                        ?>
                    </select>
                </form>
            </aside>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>
</html>