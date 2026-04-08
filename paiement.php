<?php
session_start();

// VÉRIFICATION DE SÉCURITÉ
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";
$id_utilisateur = $_SESSION['id_utilisateur'];

// VÉRIFIER QUE LE PANIER N'EST PAS VIDE
$sql_panier = "SELECT j.id, j.prix FROM panier p JOIN jeux j ON p.jeu_id = j.id WHERE p.utilisateur_id = $id_utilisateur";
$resultat_panier = $conn->query($sql_panier);

if ($resultat_panier->num_rows == 0) {
    header("Location: panier.php");
    exit();
}

// CALCUL DU SOUS-TOTAL ET PRÉPARATION DES JEUX
$sous_total = 0;
$jeux_a_acheter = [];
while ($jeu = $resultat_panier->fetch_assoc()) {
    $sous_total += $jeu['prix'];
    $jeux_a_acheter[] = $jeu;
}

// TRANSACTION DANS LA BASE DE DONNÉES
$sql_achat = "INSERT INTO achats (utilisateur_id, sous_total, status) VALUES ($id_utilisateur, $sous_total, 'Validée')";

if ($conn->query($sql_achat) === TRUE) {
    $id_achat = $conn->insert_id; 

    foreach ($jeux_a_acheter as $jeu) {
        $jeu_id = $jeu['id'];
        $prix = $jeu['prix'];

        $conn->query("INSERT INTO achat_jeux (achat_id, jeu_id, prix) VALUES ($id_achat, $jeu_id, $prix)");
        $conn->query("INSERT IGNORE INTO biblio (utilisateur_id, jeu_id) VALUES ($id_utilisateur, $jeu_id)");
    }

    $conn->query("DELETE FROM panier WHERE utilisateur_id = $id_utilisateur");
    $achat_reussi = true;
} else {
    $achat_reussi = false;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/panier.css">
    <link rel="stylesheet" href="css/paiement.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de commande - Good Game</title>
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <div class="gg-cart-container gg-payment-container">
        
        <?php if (isset($achat_reussi) && $achat_reussi): ?>
            
            <h1 class="gg-cart-title gg-payment-success-title">Paiement réussi !</h1>
            <p class="gg-payment-text">
                Merci pour votre confiance. Votre commande n° <strong>#GG-<?php echo sprintf("%05d", $id_achat); ?></strong> a bien été confirmée. <br>
                Les jeux ont été ajoutés de manière permanente à votre compte.
            </p>
            
            <div class="gg-payment-actions">
                <a href="bibliotheque.php" class="gg-btn-white">Aller à la bibliothèque</a>
                <a href="historique.php" class="gg-btn-outline-white">Voir ma facture</a>
            </div>

        <?php else: ?>
            
            <h1 class="gg-cart-title gg-payment-error-title">Erreur lors du paiement</h1>
            <p class="gg-payment-text">Une erreur critique est survenue lors de l'enregistrement de votre commande en base de données.</p>
            <div class="gg-payment-actions">
                <a href="panier.php" class="gg-btn-white">Retourner au panier</a>
            </div>
            
        <?php endif; ?>

    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>
</html>
<?php $conn->close(); ?>