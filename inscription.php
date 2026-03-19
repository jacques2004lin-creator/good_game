<?php
// DÉMARRAGE DE LA SESSION
session_start();

include "good_game_db.php";

$message = "";

// TRAITEMENT DE L'INSCRIPTION
// On vérifie si l'utilisateur a cliqué sur le bouton "S'inscrire"
if (isset($_POST['btn_inscription'])) {
    // On récupère et sécurise les données
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $email = $conn->real_escape_string($_POST['email']);
    $mdp = $_POST['mdp'];

    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
    $sql = "INSERT INTO utilisateurs (nom, prenom, email, motdepasse) VALUES ('$nom', '$prenom', '$email', '$mdp_hash')";

    if ($conn->query($sql) === TRUE) {
        $message = "<p>Inscription réussie ! Vous pouvez maintenant vous connecter.</p>";
    } else {
        $message = "<p>Erreur (Cet email est peut-être déjà utilisé).</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="burger_profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veuillez vous inscrire</title>
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
            <a href="blibliotheque.php" class="head">Bibliothèque</a>
            <a href="categories.php" class="head">Catégories</a>
            <a href="support.php" class="head">Support</a>
        </nav>

        <div class="user-actions">
            <a href="panier.php" class="cart-icon"><img src="caddie.png" class="icon" alt="Panier"></a>
            </a>

            <div class="profile-container">
                <img src="profile.png" class="profile-trigger" id="profileBtn" alt="Profil">
                <ul class="dropdown-menu" id="sideMenu">
                    <li><a href="compte.php">Compte</a></li>
                    <li><a href="#liste_de_souhait">Liste de souhaits</a></li>
                    <li><a href="#commende">Mes commandes</a></li>
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
    <div class="inscription-wrapper">
        <div class="form-header">
            <img src="gg.png" alt="Logo Good Game" class="form-logo">
            <h2>Inscription</h2>
        </div>

        <form action="" method="post" class="inscription-form">
            <input type="text" class="form-input" name="nom" placeholder="Nom" required>
            <input type="text" class="form-input" name="prenom" placeholder="Prenom" required>
            <input type="email" class="form-input" name="email" placeholder="E-mail" required>
            <input type="password" class="form-input" name="mdp" placeholder="Mot de passe" required>

            <div class="checkbox-group">
                <input type="checkbox" id="conditions" name="conditions" required>
                <label for="conditions">J'accepte les conditions de ventes et la politique de confidentialité</label>
            </div>

            <button type="submit" name="btn_inscription" class="btn-submit">S'inscrire</button>

            <div class="back-link-container">
                <a href="connexion.php" class="back-link">
                    <span class="chevron">&lt;</span> Retour
                </a>
            </div>
        </form>
    </div>
    <footer>
        <div id="contact">
            <h2>Contactez-nous</h2>
            <a class="mail" href="mailto: good_game@example.com">Envoyez-nous un email</a>
            </p>
        </div>
    </footer>
</body>

</html>
<?php
$conn->close();
?>fsefs