<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/compte.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/css/tom-select.css" rel="stylesheet">
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
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>

</html>