<?php
session_start();

include "database/good_game_db.php";

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
        header("Location: connexion.php");
        exit();
    } else {
        $message = "<p>Erreur (Cet email est peut-être déjà utilisé).</p>";
    }
}

include "view/inscription_view.php";

$conn->close();
?>