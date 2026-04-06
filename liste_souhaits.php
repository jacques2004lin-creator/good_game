<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

$conn->query("
    DELETE FROM souhait 
    WHERE utilisateur_id = $id_utilisateur 
    AND jeu_id IN (SELECT jeu_id FROM biblio WHERE utilisateur_id = $id_utilisateur)
");

// AJOUTER UN JEU À LA LISTE DE SOUHAITS
if (isset($_POST['action']) && $_POST['action'] == 'ajouter_souhait') {
    $jeu_id_a_ajouter = (int)$_POST['id_produit'];
    
    // On vérifie d'abord si l'utilisateur possède DÉJÀ ce jeu dans sa bibliothèque
    $verif_biblio = $conn->query("SELECT * FROM biblio WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_ajouter");
    
    // S'il ne l'a pas, on continue
    if ($verif_biblio->num_rows == 0) {
        
        // On vérifie s'il n'est pas déjà dans la liste de souhaits
        $verif_souhait = $conn->query("SELECT * FROM souhait WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_ajouter");
        
        if ($verif_souhait->num_rows == 0) {
            // S'il n'y est pas, on l'ajoute dans la base de données
            $conn->query("INSERT INTO souhait (utilisateur_id, jeu_id) VALUES ($id_utilisateur, $jeu_id_a_ajouter)");
        }
    }
    
    header("Location: liste_souhaits.php");
    exit();
}

// SUPPRIMER UN JEU DE LA LISTE MANUELLEMENT
if (isset($_POST['btn_supprimer'])) {
    $jeu_id_a_retirer = (int)$_POST['jeu_id'];
    $conn->query("DELETE FROM souhait WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_retirer");
    header("Location: liste_souhaits.php"); 
    exit();
}

// DÉPLACER VERS LE PANIER
if (isset($_POST['btn_ajouter_panier'])) {
    $jeu_id = (int)$_POST['jeu_id'];

    // Vérifier si le jeu n'est pas déjà dans le panier
    $check_panier = $conn->query("SELECT * FROM panier WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id");

    if ($check_panier->num_rows == 0) {
        $conn->query("INSERT INTO panier (utilisateur_id, jeu_id) VALUES ($id_utilisateur, $jeu_id)");
        $conn->query("DELETE FROM souhait WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id");
    }
    
    header("Location: liste_souhaits.php"); 
    exit();
}

// RÉCUPÉRER LES JEUX DE LA LISTE DE SOUHAITS POUR L'AFFICHAGE
$sql_souhait = "
    SELECT j.id, j.titre, j.prix, j.image 
    FROM souhait s 
    JOIN jeux j ON s.jeu_id = j.id 
    WHERE s.utilisateur_id = $id_utilisateur
";
$resultat_souhait = $conn->query($sql_souhait);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/panier.css">
    <link rel="stylesheet" href="css/liste_souhaits.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de souhaits - Good Game</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="gg-wl-container">
        <h1 class="gg-wl-title">Ma liste de souhait</h1>
        <?php if ($resultat_souhait->num_rows > 0): ?>

            <div class="gg-wl-list">
                <?php while ($jeu = $resultat_souhait->fetch_assoc()): ?>
                    <?php $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre']))); ?>
                    <div class="gg-wl-card">
                        <img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="Jeu" class="gg-wl-img">

                        <div class="gg-wl-content">
                            <div class="gg-wl-top">
                                <div class="gg-wl-info">
                                    <h3><?php echo htmlspecialchars($jeu['titre']); ?></h3>
                                    <img src="image/windows_logo.png" alt="Windows" class="gg-platform-icon-img">
                                </div>
                                <div class="gg-wl-price">
                                    <?php echo number_format($jeu['prix'], 2, ',', ''); ?>€
                                </div>
                            </div>

                            <div class="gg-wl-bottom">
                                <form action="" method="POST" style="margin: 0;">
                                    <input type="hidden" name="jeu_id" value="<?php echo $jeu['id']; ?>">
                                    <button type="submit" name="btn_supprimer" class="gg-btn-text">Supprimer</button>
                                </form>

                                <form action="" method="POST" style="margin: 0;">
                                    <input type="hidden" name="jeu_id" value="<?php echo $jeu['id']; ?>">
                                    <button type="submit" name="btn_ajouter_panier" class="gg-btn-white-small">Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>

        <?php else: ?>

            <div class="gg-cart-empty">
                <h2>Votre liste de souhaits est vide.</h2>
                <a href="index.php" class="gg-btn-white">Acheter des jeux et des applications</a>
            </div>

        <?php endif; ?>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/tom.js"></script>
</body>

</html>
<?php $conn->close(); ?>