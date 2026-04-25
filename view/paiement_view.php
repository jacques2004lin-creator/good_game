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
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/css/tom-select.css" rel="stylesheet">
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
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>
</html>