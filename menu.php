<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="page.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header class="site-header">
        <a href="accueil.php" class="logo-container">
            <img src="gg.png" alt="Logo Good Game" class="logo">
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
            <a href="panier.php" class="cart-icon"><img src="caddie.png" class="icon" alt="Panier"></a>

            <div class="profile-container">
                <img src="profile.png" class="profile-trigger" id="profileBtn" alt="Profil">
                <ul class="dropdown-menu" id="sideMenu">
                    <li><a href="compte.php">Compte</a></li>
                    <li><a href="liste_souhaits.php">Liste de souhaits</a></li>
                    <li><a href="historique.php">Mes commandes</a></li>
                    <li><a href="#support">Assistance</a></li>
                    <li>
                        <hr>
                    </li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </header>
    <script src="burger_profile.js"></script>

</body>

</html>