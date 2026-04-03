<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

// SUPPRIMER UN JEU SPÉCIFIQUE
if (isset($_POST['btn_supprimer'])) {
    $jeu_id_a_supprimer = (int)$_POST['jeu_id'];
    $conn->query("DELETE FROM panier WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id_a_supprimer");
}

// SUPPRIMER TOUT LE PANIER
if (isset($_POST['btn_supprimer_tout'])) {
    $conn->query("DELETE FROM panier WHERE utilisateur_id = $id_utilisateur");
}

// DÉPLACER VERS LA LISTE DE SOUHAITS
if (isset($_POST['btn_deplacer_souhait'])) {
    $jeu_id = (int)$_POST['jeu_id'];

    // On vérifie que le jeu n'est pas déjà dans la liste de souhaits
    $check_souhait = $conn->query("SELECT * FROM souhait WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id");
    if ($check_souhait->num_rows == 0) {
        $conn->query("INSERT INTO souhait (utilisateur_id, jeu_id) VALUES ($id_utilisateur, $jeu_id)");
    }

    // Ensuite on le supprime du panier
    $conn->query("DELETE FROM panier WHERE utilisateur_id = $id_utilisateur AND jeu_id = $jeu_id");

    // On recharge la page proprement
    header("Location: panier.php");
    exit();
}

// RÉCUPÉRER LES JEUX DU PANIER
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

                        <?php
                        $total_panier += $jeu['prix'];

                        // RÉSOLUTION DU PROBLÈME D'IMAGE : On génère le nom du dossier
                        $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre'])));
                        ?>

                        <div class="gg-cart-card">
                            <img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="Jeu" class="gg-item-img">

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

                                    <form action="" method="POST" style="margin: 0;">
                                        <input type="hidden" name="jeu_id" value="<?php echo $jeu['id']; ?>">
                                        <button type="submit" name="btn_deplacer_souhait" class="gg-btn-outline">Ajouter à la liste de souhaits</button>
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
</body>

</html>
<?php $conn->close(); ?>