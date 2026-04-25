<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier <?php echo htmlspecialchars((string)$cat['nom']); ?> - Good Game</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <link href="css/modifier.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>
    <main>
        <header>
            <h1>Modifier : <?php echo htmlspecialchars((string)$cat['nom']); ?></h1>
            <a href="admin.php" class="lien">Annuler et retourner à l'accueil admin</a>
        </header>

        <form method="POST" class="form-ajout-jeu">
            <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">

            <!-- Informations Catégorie -->
            <h4>Informations catégorie</h4>
            <div class="infos-generales">
                <div>
                    <label>Nom :</label><br>
                    <input type="text" name="nom" value="<?php echo htmlspecialchars((string)$cat['nom']); ?>">
                </div>
                <div>
                    <label>Icone (Font Awesome) :</label><br>
                    <input type="text" name="icone" value="<?php echo htmlspecialchars((string)$cat['icone']); ?>">
                </div>
                <div>
                    <label>Couleur :</label><br>
                    <input type="color" name="couleur" value="<?php echo htmlspecialchars((string)$cat['couleur']); ?>" class="couleur_boite">
                </div>
            </div>  

            <button type="submit" name="modifier_tout" class="btn btn-ajouter">
                ENREGISTRER TOUTES LES MODIFICATIONS
            </button>
        </form>
    </main>
</body>
</html>