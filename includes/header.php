<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header class="site-header">
        <a href="accueil.php" class="logo-container">
            <img src="image/gg.png" alt="Logo Good Game" class="logo">
        </a>

        <div class="search-container">
            <input type="text" placeholder="Recherche" class="search-bar">
        </div>

        <nav class="main-nav">
            <a href="accueil.php" class="head">Accueil</a>
            <a href="bibliotheque.php" class="head">Bibliothèque</a>
            <a href="categories.php" class="head">Catégories</a>
            <a href="support.php" class="head">Support</a>
        </nav>

        <div class="user-actions">
            <a href="panier.php" class="cart-icon"><img src="image/caddie.png" class="icon" alt="Panier"></a>

            <div class="profile-container">
                <img src="image/profile.png" class="profile-trigger" id="profileBtn" alt="Profil">
                <ul class="dropdown-menu" id="sideMenu">
                    <li><a href="compte.php">Compte</a></li>
                    <li><a href="liste_souhaits.php">Liste de souhaits</a></li>
                    <li><a href="historique.php">Mes commandes</a></li>
                    <li><a href="support.php">Assistance</a></li>
                    <li>
                        <hr>
                    </li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </header>
    <script src="js/script.js"></script>

</body>

</html>