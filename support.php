<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - Good Game</title>
    <link href="css/support.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <div class="support-container">
            <a href="support_commandes.php" class="support-carte">
                <i class="fa-solid fa-box-open carte-icone"></i>
                <h3 class="carte-titre">Commandes et produits</h3>
                <p class="carte-texte">Assistance pour l'activation des clés et les informations sur les produits.</p>
            </a>

            <a href="support_compte.php" class="support-carte">
                <i class="fa-solid fa-user carte-icone"></i>
                <h3 class="carte-titre">Compte et sécurité</h3>
                <p class="carte-texte">Assistance à la gestion des comptes et à la sécurité.</p>
            </a>

            <a href="support_paiement.php" class="support-carte">
                <i class="fa-solid fa-credit-card carte-icone"></i>
                <h3 class="carte-titre">Paiement</h3>
                <p class="carte-texte">Aide pour tout problème ou question lié au paiement.</p>
            </a>
        </div>

        <div class="contact">
            <div class="contact-carte">
                <p class="carte-texte">Contactez-nous : <a href="mailto:support@goodgame.com" class="contact-lien">support@goodgame.com</a> (faux mail)</p>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>
</html>