<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

if (isset($_POST['action']) && $_POST['action'] == 'ajouter') {
    $jeu_id_a_ajouter = (int)$_POST['id_produit'];
    
    // On vérifie d'abord si le jeu n'est pas déjà dans le panier
    $verif_panier = $conn->query("SELECT * FROM panier WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_ajouter");
    
    if ($verif_panier->num_rows == 0) {
        // S'il n'y est pas, on l'ajoute dans la base de données !
        $conn->query("INSERT INTO panier (utilisateur_id, jeu_id) VALUES ($id_utilisateur, $jeu_id_a_ajouter)");
    }
    
    // On recharge la page proprement
    header("Location: panier.php");
    exit();
}

// SUPPRIMER UN JEU SPÉCIFIQUE
if (isset($_POST['btn_supprimer'])) {
    $jeu_id_a_supprimer = (int)$_POST['jeu_id'];
    $conn->query("DELETE FROM panier WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_supprimer");
    header("Location: panier.php"); 
    exit();
}

// SUPPRIMER TOUT LE PANIER
if (isset($_POST['btn_supprimer_tout'])) {
    $conn->query("DELETE FROM panier WHERE utilisateur_id = $id_utilisateur");
    header("Location: panier.php");
    exit();
}

// RÉCUPÉRER LES JEUX POUR LES AFFICHER
$sql_panier = "
    SELECT j.id, j.titre, j.prix, j.image 
    FROM panier p 
    JOIN jeux j ON p.jeu_id = j.id 
    WHERE p.utilisateur_id = $id_utilisateur
";
$resultat_panier = $conn->query($sql_panier);
$total_panier = 0;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/panier.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - Good Game</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="gg-cart-container">
        <h1 class="gg-cart-title">Mon panier</h1>

        <?php if ($resultat_panier->num_rows > 0): ?>

            <div class="gg-cart-layout">

                <div class="gg-cart-items-section">
                    <?php while ($jeu = $resultat_panier->fetch_assoc()): ?>
                        <?php $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre']))); ?>
                        <?php $total_panier += $jeu['prix']; ?>

                        <div class="gg-cart-card">
                            <img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="<?php echo htmlspecialchars($jeu['titre']); ?>" alt="Jeu" class="gg-item-img">

                            <div class="gg-item-content">
                                <div class="gg-item-top">
                                    <div class="gg-item-info">
                                        <h3><?php echo htmlspecialchars($jeu['titre']); ?></h3>
                                        <img src="image/windows_logo.png" alt="Windows" class="gg-platform-icon-img">
                                    </div>
                                    <div class="gg-item-price">
                                        <?php echo number_format($jeu['prix'], 2, ',', ''); ?>€
                                    </div>
                                </div>

                                <div class="gg-item-actions">
                                    <form action="" method="POST" style="margin: 0;">
                                        <input type="hidden" name="jeu_id" value="<?php echo $jeu['id']; ?>">
                                        <button type="submit" name="btn_supprimer" class="gg-btn-text">Supprimer</button>
                                    </form>

                                    <form action="liste_souhaits.php" method="POST">
                                        <input type="hidden" name="action" value="ajouter_souhait">
                                        <input type="hidden" name="id_produit" value="<?php echo $jeu['id']; ?>">
                                        <button type="submit" class="gg-btn-outline">Ajouter à la liste de souhaits</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <div class="gg-cart-footer-actions">
                        <form action="" method="POST">
                            <button type="submit" name="btn_supprimer_tout" class="gg-link-underline">Supprimer tous les articles</button>
                        </form>
                    </div>
                </div>

                <div class="gg-cart-summary">
                    <div class="gg-summary-row">
                        <span class="gg-summary-bold">Sous-total</span>
                        <span class="gg-summary-bold"><?php echo number_format($total_panier, 2, ',', ' '); ?> €</span>
                    </div>
                    <p class="gg-summary-text">
                        Le montant de la taxe sur les ventes sera calculé au moment de l'achat, le cas échéant<br>
                        Passer au paiement
                    </p>

                    <form action="paiement.php" method="POST">
                        <button type="submit" class="gg-btn-white-full">Paiement</button>
                    </form>
                </div>

            </div>

        <?php else: ?>

            <div class="gg-cart-empty">
                <h2>Votre panier est vide.</h2>
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