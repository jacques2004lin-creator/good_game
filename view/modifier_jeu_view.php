<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier <?php echo htmlspecialchars((string)$jeu['titre']); ?> - Good Game</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <link href="css/modifier.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>
    <main>
        <header>
            <h1>Modifier : <?php echo htmlspecialchars((string)$jeu['titre']); ?></h1>
            <a href="admin.php" class="lien">Annuler et retourner à l'accueil admin</a>
        </header>

        <form method="POST" class="form-ajout-jeu">
            <input type="hidden" name="id" value="<?php echo $jeu['id']; ?>">

            <!-- Informations Générales -->
            <h4>Informations Générales</h4>
            <div class="infos-generales">
                <div>
                    <label>Titre :</label><br>
                    <input type="text" name="titre" value="<?php echo htmlspecialchars((string)$jeu['titre']); ?>">
                </div>
                <div>
                    <label>Prix :</label><br>
                    <input type="number" step="0.01" name="prix" value="<?php echo $jeu['prix']; ?>">
                </div>
                <div>
                    <label>Image (nom fichier) :</label><br>
                    <input type="text" name="image" value="<?php echo htmlspecialchars((string)$jeu['image']); ?>">
                </div>
                <div>
                    <label>Miniature 1 (nom fichier) :</label><br>
                    <input type="text" name="image" value="<?php echo htmlspecialchars((string)$jeu['img_min1']); ?>">
                </div>
                <div>
                    <label>Miniature 2 (nom fichier) :</label><br>
                    <input type="text" name="image" value="<?php echo htmlspecialchars((string)$jeu['img_min2']); ?>">
                </div>
                <div>
                    <label>Miniature 3 (nom fichier) :</label><br>
                    <input type="text" name="image" value="<?php echo htmlspecialchars((string)$jeu['img_min3']); ?>">
                </div>
                <div>
                    <label>Développeur :</label><br>
                    <input type="text" name="developpeur" value="<?php echo htmlspecialchars((string)$jeu['developpeur']); ?>">
                </div>
                <div>
                    <label>Éditeur :</label><br>
                    <input type="text" name="editeur" value="<?php echo htmlspecialchars((string)$jeu['editeur']); ?>">
                </div>
                <div>
                    <label>PEGI :</label><br>
                    <input type="text" name="pegi" value="<?php echo htmlspecialchars((string)$jeu['pegi']); ?>">
                </div>
                <div>
                    <label>Date Sortie :</label><br>
                    <input type="date" name="date_sortie" value="<?php echo $jeu['date_sortie']; ?>">
                </div>
                <div>
                    <label>Catégorie :</label><br>
                    <select name="categorie_id">
                        <?php
                        while($c = $cats->fetch_assoc()) {
                            $selection = ($c['id'] == $jeu['categorie_id']) ? "selected" : "";
                            echo "<option value='".$c['id']."' $selection>".$c['nom']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Descriptions & Fonctionnaliés -->
            <h4>Descriptions & Fonctionnalités</h4>
            <label>Description courte :</label><br>
            <textarea name="description" class="textarea-court"><?php echo htmlspecialchars((string)$jeu['description']); ?></textarea>
            
            <label>Description longue :</label><br>
            <textarea name="description_longue" class="textarea-long"><?php echo htmlspecialchars((string)$jeu['description_longue']); ?></textarea>
            
            <label>Fonctionnalités (Coop, Solo...) :</label><br>
            <input type="text" name="fonctionnalites" value="<?php echo htmlspecialchars((string)$jeu['fonctionnalites']); ?>">

            <div class="langues">
                <div>
                    <label>Langues Audio :</label><br>
                    <input type="text" name="lang_audio" value="<?php echo htmlspecialchars((string)$jeu['lang_audio']); ?>">
                </div>
                <div>
                    <label>Langues Texte :</label><br>
                    <input type="text" name="lang_texte" value="<?php echo htmlspecialchars((string)$jeu['lang_texte']); ?>">
                </div>
            </div>

            <!-- Config -->
            <div class="config">
                <div class="config-group">
                    <h4>Configuration Minimum :</h4>
                    <input type="text" name="sys_min_os" placeholder="OS" value="<?php echo htmlspecialchars((string)$jeu['sys_min_os']); ?>">
                    <input type="text" name="sys_min_cpu" placeholder="CPU" value="<?php echo htmlspecialchars((string)$jeu['sys_min_cpu']); ?>">
                    <input type="text" name="sys_min_ram" placeholder="RAM" value="<?php echo htmlspecialchars((string)$jeu['sys_min_ram']); ?>">
                    <input type="text" name="sys_min_gpu" placeholder="GPU" value="<?php echo htmlspecialchars((string)$jeu['sys_min_gpu']); ?>">
                    <input type="text" name="sys_min_dx" placeholder="DirectX" value="<?php echo htmlspecialchars((string)$jeu['sys_min_dx']); ?>">
                    <input type="text" name="sys_min_stockage" placeholder="Stockage" value="<?php echo htmlspecialchars((string)$jeu['sys_min_stockage']); ?>">
                </div>

                <div class="config-group">
                    <h4>Configuration Recommandée :</h4>
                    <input type="text" name="sys_rec_os" placeholder="OS" value="<?php echo htmlspecialchars((string)$jeu['sys_rec_os']); ?>">
                    <input type="text" name="sys_rec_cpu" placeholder="CPU" value="<?php echo htmlspecialchars((string)$jeu['sys_rec_cpu']); ?>">
                    <input type="text" name="sys_rec_ram" placeholder="RAM" value="<?php echo htmlspecialchars((string)$jeu['sys_rec_ram']); ?>">
                    <input type="text" name="sys_rec_gpu" placeholder="GPU" value="<?php echo htmlspecialchars((string)$jeu['sys_rec_gpu']); ?>">
                    <input type="text" name="sys_rec_dx" placeholder="DirectX" value="<?php echo htmlspecialchars((string)$jeu['sys_rec_dx']); ?>">
                    <input type="text" name="sys_rec_stockage" placeholder="Stockage" value="<?php echo htmlspecialchars((string)$jeu['sys_rec_stockage']); ?>">
                </div>
            </div>

            <button type="submit" name="modifier_tout" class="btn btn-ajouter">
                ENREGISTRER TOUTES LES MODIFICATIONS
            </button>
        </form>
    </main>
</body>
</html>