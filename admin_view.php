<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Good Game</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>
    <main>
        <header>
            <h1>Espace Administrateur</h1>
            <p>Bienvenue Patron. <a href="index.php" class="lien">Retour au site</a></p>
        </header>

        <?php
        if($message) {
            echo "<p class='msg'>$message</p>";
        }
        ?>

        <!-- Achat -->
        <section>
            <h2>Gestion des Achats</h2>
            <div class="table-wrapper">
                <table>
                    <tr>
                        <th>N°</th>
                        <th>Utilisateur</th>
                        <th>Détails</th>
                        <th>Total</th>
                    </tr>
                    <?php 
                    if($res_achats->num_rows > 0) {
                        while ($a = $res_achats->fetch_assoc()) {
                            echo "<tr>";
                                echo "<td>#" . $a['id'] . "</td>";
                                echo "<td><strong>" . htmlspecialchars((string)$a['nom'] . " " . $a['prenom']) . "</strong></td>";
                                echo "<td><ul>";
                                    $id_a = $a['id'];
                                    $details = $conn->query("SELECT jeux.titre FROM achat_jeux JOIN jeux ON achat_jeux.jeu_id = jeux.id WHERE achat_id = $id_a");
                                    while($j = $details->fetch_assoc()) {
                                        echo "<li>" . htmlspecialchars((string)$j['titre']) . "</li>";
                                    }
                                echo "</td></ul>";
                                echo "<td>" . $a['sous_total'] . " €</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='vide'>Aucune commande.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </section>

        <!-- Catalogue -->
        <section>
            <h2>Gestion du Catalogue</h2>
            <div class="form-box">
                <h3>Ajouter un nouveau jeu</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="ajouter_jeu">
                    <h4>Infos de base</h4>
                    <div class="infos-generales">
                        <input type="text" name="titre" placeholder="Titre" required>
                        <input type="number" step="0.01" name="prix" placeholder="Prix" required>
                        <select name="categorie_id" required>
                            <option value="">-- Catégorie --</option>
                            <?php
                            while($c = $cats->fetch_assoc()) {
                                echo "<option value='" . $c['id'] . "'>" . $c['nom'] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="text" name="image" placeholder="Image principale (ex: jeu.jpg)" required>
                        <input type="text" name="img_min1" placeholder="Miniature 1">
                        <input type="text" name="img_min2" placeholder="Miniature 2">
                        <input type="text" name="img_min3" placeholder="Miniature 3">
                        <input type="text" name="pegi" placeholder="PEGI (ex: 18)">
                        <input type="text" name="developpeur" placeholder="Développeur">
                        <input type="text" name="editeur" placeholder="Éditeur">
                        <input type="date" name="date_sortie">
                    </div>

                    <h4 class="saut-ligne">Descriptions & Fonctions</h4>
                    <textarea name="description" placeholder="Description courte" required class="textarea-court"></textarea>
                    <textarea name="description_longue" placeholder="Description longue" required class="textarea-long"></textarea>
                    <input type="text" name="fonctionnalites" placeholder="Fonctionnalités (Solo, Coop...)" required>
                    <div class="langues">
                        <input type="text" name="lang_audio" placeholder="Langues Audio">
                        <input type="text" name="lang_texte" placeholder="Langues Texte">
                    </div>

                    <h4 class="saut-ligne">Configurations</h4>
                    <div class="config">
                        <div class="config-group">
                            <strong>Minimum :</strong>
                            <input type="text" name="sys_min_os" placeholder="OS">
                            <input type="text" name="sys_min_cpu" placeholder="CPU">
                            <input type="text" name="sys_min_ram" placeholder="RAM">
                            <input type="text" name="sys_min_gpu" placeholder="GPU">
                            <input type="text" name="sys_min_dx" placeholder="DirectX">
                            <input type="text" name="sys_min_stockage" placeholder="Espace">
                        </div>
                        <div class="config-group">
                            <strong>Recommandée :</strong>
                            <input type="text" name="sys_rec_os" placeholder="OS">
                            <input type="text" name="sys_rec_cpu" placeholder="CPU">
                            <input type="text" name="sys_rec_ram" placeholder="RAM">
                            <input type="text" name="sys_rec_gpu" placeholder="GPU">
                            <input type="text" name="sys_rec_dx" placeholder="DirectX">
                            <input type="text" name="sys_rec_stockage" placeholder="Espace">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-ajouter">+ Ajouter le jeu</button>
                </form>
            </div>

            <!-- Tableau catalogue -->
            <div class="table-wrapper">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>PEGI</th>
                        <th>Dév/Édit</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if($res_liste->num_rows > 0) {
                        while ($j = $res_liste->fetch_assoc()) {
                            echo "<tr>";
                                echo "<td>" . $j['id'] . "</td>";
                                echo "<td><ul>";
                                    echo "<li>". $j['image'] . "</li>";
                                    echo "<li>". $j['img_min1'] . "</li>";
                                    echo "<li>". $j['img_min2'] . "</li>";
                                    echo "<li>". $j['img_min3'] . "</li>";
                                echo "</ul></td>";
                                echo "<td><strong>" . htmlspecialchars((string)$j['titre']) . "</strong></td>";
                                echo "<td>" . htmlspecialchars((string)$j['cat_nom']) . "</td>";
                                echo "<td>" . $j['prix'] . " €</td>";
                                echo "<td>" . $j['pegi'] . "</td>";
                                echo "<td>" . htmlspecialchars((string)$j['developpeur']) . "</td>";
                                echo "<td>" . mb_strimwidth((string)$j['description'], 0, 30, "...") . "</td>";
                                echo "<td>";
                                    echo "<div class='boutons'>";
                                        echo "<a href='modifier_jeu.php?id=" . $j['id'] . "' class='btn btn-update'>Modif</a>";
                                        echo "<form method='POST' onsubmit=\"return confirm('Supprimer ?')\">";
                                            echo "<input type='hidden' name='action' value='supprimer_jeu'>";
                                            echo "<input type='hidden' name='id_jeu' value='" . $j['id'] . "'>";
                                            echo "<button type='submit' class='btn btn-supprimer'>Supprimer</button>";
                                        echo "</form>";
                                    echo "</div>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='vide'>Catalogue vide.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </section>
    </main>
</body>
</html>