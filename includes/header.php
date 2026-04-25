<header class="site-header">
    <!-- Menu Burger -->
    <i class="fa-solid fa-bars" id="burgerBtn"></i>

    <!-- Le Logo -->
    <a href="index.php" class="logo-container">
        <img src="image/gg.png" alt="Logo Good Game" class="logo">
    </a>

    <!-- Recherche -->
    <nav class="main-nav">
        <div class="search-wrapper">
            <select id="search-input" placeholder="Recherche un jeu..." autocomplete="off">
                <option value=""></option>
                <?php
                $res_tous_jeux = $conn->query("SELECT id, titre FROM jeux ORDER BY titre ASC");
                while ($un_jeu = $res_tous_jeux->fetch_assoc()) {
                    echo "<option value='" . $un_jeu['id'] . "'>" . htmlspecialchars($un_jeu['titre']) . "</option>";
                }
                ?>
            </select>
        </div>
        
        <!-- Les liens de navigation -->
        <div class="nav-links" id="navLinks"> 
            <a href="index.php" class="head">Accueil</a>
            <a href="bibliotheque.php" class="head">Bibliothèque</a>
            <a href="categories.php" class="head">Catégories</a>
            <a href="support.php" class="head">Support</a>
        </div>
    </nav>

    <!-- Caddie + Profil -->
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
                <li><hr></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</header>

<?php if (isset($_SESSION['message'])): ?>
    <div class="notification">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>