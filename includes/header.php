<header>
    <a href="index.php" class="logo-container">
        <img src="image/gg.png" alt="Logo Good Game" class="logo">
    </a>

    <nav class="main-nav">
        <div class="search-wrapper">
            <select id="search-input" placeholder="Recherche" autocomplete="off"></select>
        </div>
        <a href="index.php" class="head">Accueil</a>
        <a href="bibliotheque.php" class="head">Bibliothèque</a>
        <a href="categories.php" class="head">Catégories</a>
        <a href="support.php" class="head">Support</a>
    </nav>

    <div class="user-actions">
        <a href="panier.php" class="cart-icon"><img src="image/caddie.png" class="icon" alt="Panier"></a>

        <div class="profile-container">
            <img src="image/profile.png" class="profile-trigger" id="profileBtn" alt="Profil">
            <ul class="dropdown-menu" id="sideMenu">
                <?php 
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    echo "<li><a href='admin.php' style='color: #ff4757;'>Administration</a></li>";
                }
                ?>
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