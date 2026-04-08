<?php
session_start();

// On vérifie si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include "good_game_db.php";

$id_utilisateur = $_SESSION['id_utilisateur'];
$message_succes = "";
$message_erreur = "";

// Changement de Prénom
if (isset($_POST['btn_update_pseudo'])) {
    $nouveau_pseudo = $conn->real_escape_string(trim($_POST['nouveau_pseudo']));

    if (!empty($nouveau_pseudo)) {
        $sql = "UPDATE utilisateurs SET prenom = '$nouveau_pseudo' WHERE id = $id_utilisateur";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['prenom'] = $nouveau_pseudo;
            $message_succes = "Votre Prénom a été mis à jour avec succès.";
        } else {
            $message_erreur = "Erreur lors de la mise à jour de votre prénom.";
        }
    }
}

// Changement d'accès (Email et/ou Mot de passe)
if (isset($_POST['btn_update_acces'])) {
    $nouvel_email = $conn->real_escape_string(trim($_POST['nouvel_email']));
    $nouveau_mdp = trim($_POST['nouveau_mdp']);

    $updates = [];

    if (!empty($nouvel_email)) {
        $updates[] = "email = '$nouvel_email'";
    }
    if (!empty($nouveau_mdp)) {
        $mdp_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);
        $updates[] = "motdepasse = '$mdp_hash'";
    }

    if (count($updates) > 0) {
        $sql_update = "UPDATE utilisateurs SET " . implode(", ", $updates) . " WHERE id = $id_utilisateur";
        if ($conn->query($sql_update) === TRUE) {
            $message_succes = "Vos informations de connexion ont été mises à jour.";
        } else {
            $message_erreur = "Erreur lors de la mise à jour (Cet email est peut-être déjà pris).";
        }
    }
}

// Suppression du compte
if (isset($_POST['btn_delete_account'])) {
    $confirmation = trim($_POST['confirm_delete']);

    if ($confirmation === "CONFIRM") {
        $sql = "DELETE FROM utilisateurs WHERE id = $id_utilisateur";
        if ($conn->query($sql) === TRUE) {
            // Détruit la session et renvoie à l'accueil
            session_destroy();
            header("Location: accueil.php");
            exit();
        } else {
            $message_erreur = "Erreur lors de la suppression du compte.";
        }
    } else {
        $message_erreur = "Vous devez taper exactement 'CONFIRM' pour supprimer votre compte.";
    }
}

// RÉCUPÉRATION DES DONNÉES ACTUELLES DE L'UTILISATEUR
$sql_user = "SELECT * FROM utilisateurs WHERE id = $id_utilisateur";
$result = $conn->query($sql_user);
$utilisateur_actuel = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/compte.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Good Game</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <?php if (!empty($message_succes)): ?>
        <div>
            <?php echo $message_succes; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($message_erreur)): ?>
        <div>
            <?php echo $message_erreur; ?>
        </div>
    <?php endif; ?>

    <div class="account-layout">

        <aside class="account-sidebar">
            <div class="sidebar-header">
                <h3>Accès Rapide</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#sec-compte">Compte</a></li>
                <li><a href="#sec-acces">Accès au compte</a></li>
                <li><a href="#sec-supprimer">Supprimer le compte</a></li>
            </ul>
        </aside>

        <main class="account-content">

            <div class="account-card" id="sec-compte">
                <div class="card-left">
                    <h3>Compte</h3>
                    <p>Changez de Prénom quand vous voulez.</p>
                </div>
                <div class="card-right">
                    <form action="" method="POST">
                        <div class="input-group">
                            <label>Changer de prénom</label>
                            <input type="text" name="nouveau_pseudo" placeholder="<?php echo htmlspecialchars($utilisateur_actuel['prenom']); ?>" required>
                        </div>
                        <button type="submit" name="btn_update_pseudo" class="btn-green">CONFIRMER</button>
                    </form>
                </div>
            </div>

            <div class="account-card" id="sec-acces">
                <div class="card-left">
                    <h3>Accès au compte</h3>
                    <p>Gérez votre adresse mail ou modifiez votre mot de passe.</p>
                </div>
                <div class="card-right">
                    <form action="" method="POST">
                        <div class="input-group">
                            <label>Changer d'adresse mail</label>
                            <input type="email" name="nouvel_email" placeholder="<?php echo htmlspecialchars($utilisateur_actuel['email']); ?>">
                        </div>
                        <div class="input-group">
                            <label>Changer de mot de passe</label>
                            <input type="password" name="nouveau_mdp" placeholder="Nouveau mot de passe...">
                        </div>
                        <button type="submit" name="btn_update_acces" class="btn-green">SAUVEGARDER</button>
                    </form>
                </div>
            </div>

            <div class="account-card" id="sec-supprimer">
                <div class="card-left">
                    <h3>Supprimer le compte</h3>
                    <p>Supprimer mon compte. Attention : la suppression de vos données est définitive.</p>
                </div>
                <div class="card-right">
                    <form action="" method="POST" onsubmit="return confirm('Êtes-vous vraiment sûr de vouloir supprimer votre compte ?');">
                        <div class="input-group">
                            <label class="warning-label">CETTE ACTION EST IRRÉVERSIBLE ! TAPE "CONFIRM" CI-DESSOUS</label>
                            <input type="text" name="confirm_delete" placeholder="Tape &quot;CONFIRM&quot;" required>
                        </div>
                        <button type="submit" name="btn_delete_account" class="btn-red">SUPPRIMER MON COMPTE</button>
                    </form>
                </div>
            </div>

        </main>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>

</html>
<?php
$conn->close();
?>