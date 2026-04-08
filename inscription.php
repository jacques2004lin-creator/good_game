<?php
session_start();

include "good_game_db.php";

$message = "";

// On vérifie si l'utilisateur a cliqué sur le bouton "S'inscrire"
if (isset($_POST['btn_inscription'])) {
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/css/tom-select.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veuillez vous inscrire</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <div class="inscription-wrapper">
            <div class="form-header">
                <img src="image/gg.png" alt="Logo Good Game" class="form-logo">
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
    </main>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>

</html>
<?php
$conn->close();
?>