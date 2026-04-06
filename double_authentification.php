<?php
session_start();
$conn = new mysqli("db", "root", "root", "good_game");

if (isset($_POST['valider'])) {
    $pin_saisi = $_POST['pin'];
    $id_temp = $_SESSION['id_utilisateur'];

    // On vérifie si le PIN est le bon dans la base
    $sql = "SELECT * FROM utilisateurs WHERE id = $id_temp AND code_2fa = '$pin_saisi'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        // SUCCÈS : On connecte pour de vrai
        $utilisateur = $res->fetch_assoc();
        $_SESSION['id_utilisateur'] = $utilisateur['id'];
        $_SESSION['prenom'] = $utilisateur['prenom'];
        $_SESSION['role'] = $utilisateur['role'];
        
        header("Location: index.php");
        exit();
    } else {
        $erreur = "Code PIN incorrect !";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/double_authentification.css">
</head>
<body>
    <form method="POST">
        <h2>Vérification de sécurité</h2>
        <p>Entrez votre code PIN à 4 chiffres</p>
        
        <?php if(isset($erreur)) echo "<p class='erreur'>$erreur</p>"; ?>
        
        <input type="password" name="pin" maxlength="4" placeholder="****">
        <br>
        <button type="submit" name="valider" class="btn-ajouter">Vérifier</button>
    </form>
</body>
</html>