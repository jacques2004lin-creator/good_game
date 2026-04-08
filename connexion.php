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

include "connexion_view.php";

$conn->close();
?>