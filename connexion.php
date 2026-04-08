<?php
// DÉMARRAGE DE LA SESSION
session_start();

include "good_game_db.php";

$message = "";

// On vérifie si l'utilisateur a cliqué sur le bouton "Se connecter"
if (isset($_POST['btn_connexion'])) {

    // On sécurise l'email saisi
    $email = $conn->real_escape_string($_POST['email']);
    $mdp_saisi = $_POST['mdp'];

    // On cherche l'utilisateur dans la base de données via son email
    $sql = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $resultat = $conn->query($sql);

    // Si l'email existe dans la base
    if ($resultat->num_rows > 0) {
        $utilisateur = $resultat->fetch_assoc();

        // On vérifie si le mot de passe saisi correspond au mot de passe crypté en base
        if (password_verify($mdp_saisi, $utilisateur['motdepasse'])) {

            // Succès ! On stocke les infos dans la session
            $_SESSION['id_utilisateur'] = $utilisateur['id'];
            $_SESSION['prenom'] = $utilisateur['prenom'];
            $_SESSION['role'] = $utilisateur['role'];

            // On redirige vers l'accueil
            header("Location: index.php");
            exit();
        } else {
            $message = "<p>Mot de passe incorrect.</p>";
        }
    } else {
        $message = "<p>Aucun compte trouvé avec cet email.</p>";
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
    <title>Connexion - Good Game</title>
    <script defer src="/_vercel/insights/script.js"></script>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="inscription-wrapper">
        <div class="form-header">
            <img src="image/gg.png" alt="Logo Good Game" class="form-logo">
            <h2>Connexion</h2>
        </div>

        <?php if (!empty($message)) echo $message; ?>

        <form action="" method="post" class="inscription-form">
            <input type="email" class="form-input" name="email" placeholder="E-mail" required>
            <input type="password" class="form-input" name="mdp" placeholder="Mot de passe" required>

            <button type="submit" name="btn_connexion" class="btn-submit">Se connecter</button>

            <div class="back-link-container">
                <span>Pas encore de compte ? </span>
                <a href="inscription.php" class="back-link">
                    S'inscrire
                </a>
            </div>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>

</html>
<?php
$conn->close();
?>