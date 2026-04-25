<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($jeu['titre']); ?> - Good Game</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/jeux.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/css/tom-select.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Titre -->
        <h1 class="titre-principal"><?php echo htmlspecialchars($jeu['titre']); ?></h1>

        <section class="jeu">
            <div class="jeu-galerie">
    
                <!-- Slider Principal -->
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="<?php echo htmlspecialchars($jeu['titre']); ?>"></div>
                        <?php
                        if(!empty($jeu['img_min1'])) {
                            echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min1']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>";
                        }
                        ?>
                        <?php
                        if(!empty($jeu['img_min2'])) {
                            echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min2']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>";
                        }
                        ?>
                        <?php
                        if(!empty($jeu['img_min3'])) {
                            echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min3']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>";
                        }
                        ?>
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <!-- Slider des Miniatures -->
                <div class="swiper thumbSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="<?php echo htmlspecialchars($jeu['titre']); ?>"></div>
                        <?php
                        if(!empty($jeu['img_min1'])) {
                            echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min1']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>";
                        }
                        ?>
                        <?php
                        if(!empty($jeu['img_min2'])) {
                            echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min2']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>";
                        }
                        ?>
                        <?php
                        if(!empty($jeu['img_min3'])) {
                            echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min3']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>";
                        }
                        ?>
                    </div>
                </div>

                <p class="description-courte">
                    <?php echo nl2br(htmlspecialchars($jeu['description'])); ?>
                </p>
            </div>

            <div class="jeu-sidebar">
                <img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="<?php echo htmlspecialchars($jeu['titre']); ?>" class="img-cover">

                <div class="prix-box">
                    <?php
                    if($jeu['prix'] > 0) {
                        echo "<div>" . number_format($jeu['prix'], 2, ',', ' ') . " €</div>";
                    } else {
                        echo "<div>Gratuit</div>";
                    }
                    ?>
                </div>

                <!-- Boutons -->
                <div class="actions-jeu">
                    <?php 
                    if ($deja_possede) {
                        // Si le jeu est possédé : Un seul bouton vert non cliquable
                        echo "<button class='btn-achat' style='background-color: #28a745; color: white; cursor: default;'>Possédé</button>";
                    } else {
                        // Si le jeu n'est pas possédé : On affiche Acheter + Liste de souhaits
                        echo "<form action='panier.php' method='POST'>";
                            echo "<input type='hidden' name='action' value='ajouter'>";
                            echo "<input type='hidden' name='id_produit' value='" . $jeu['id'] . "'>";
                            echo "<button type='submit' class='btn-achat'>Acheter</button>";
                        echo "</form>";
                        
                        echo "<form action='liste_souhaits.php' method='POST'>";
                            echo "<input type='hidden' name='action' value='ajouter_souhait'>";
                            echo "<input type='hidden' name='id_produit' value='" . $jeu['id'] . "'>";
                            echo "<button type='submit' class='btn-souhait'>Liste de souhaits</button>";
                        echo "</form>";
                    }
                    ?>
                </div>

                <!-- Infos -->
                <ul class="jeu-info">
                    <li><strong>Classification :</strong> PEGI <?php echo htmlspecialchars($jeu['pegi']); ?></li>
                    <li><strong>Développeur :</strong> <?php echo htmlspecialchars($jeu['developpeur']); ?></li>
                    <li><strong>Éditeur :</strong> <?php echo htmlspecialchars($jeu['editeur']); ?></li>
                    <li><strong>Date de sortie :</strong> <?php echo htmlspecialchars($jeu['date_sortie']); ?></li>
                </ul>
            </div>
        </section>

        <!-- Tags & fonctionnalités -->
        <section class="jeu-tags">
            <div class="col-tags">
                <h3>Genre</h3>
                <div class="tags-list">
                    <span class="tag"><?php echo htmlspecialchars($titre_categorie); ?></span>
                </div>
            </div>
            <div class="separateur"></div>
            <div class="col-fonctionnalite">
                <h3>Fonctionnalités</h3>
                <p><?php echo htmlspecialchars($jeu['fonctionnalites']); ?></p>
            </div>
        </section>

        <!-- Description longue -->
        <section class="jeu-description">
            <h2>À propos de ce jeu</h2>
            
            <div class="texte-description">
                <?php echo nl2br(htmlspecialchars($jeu['description_longue'])); ?>
            </div>
        </section>

        <!-- Configuration -->
        <section class="jeu-config">
            <h2>Configuration système requise pour <?php echo htmlspecialchars($jeu['titre']); ?></h2>
            
            <div class="config-tabs">
                <span class="tab">Windows</span>
            </div>

            <div class="config-box">
                <div class="config-grid">

                    <!-- Minimum -->
                    <div class="config-col">
                        <h4>Minimum</h4>
                        <ul>
                            <li><span class="label">Système d'exploitation</span><br><?php echo htmlspecialchars($jeu['sys_min_os']); ?></li>
                            <li><span class="label">Processeur</span><br><?php echo htmlspecialchars($jeu['sys_min_cpu']); ?></li>
                            <li><span class="label">Mémoire vive</span><br><?php echo htmlspecialchars($jeu['sys_min_ram']); ?></li>
                            <li><span class="label">Carte graphique</span><br><?php echo htmlspecialchars($jeu['sys_min_gpu']); ?></li>
                            <li><span class="label">DirectX</span><br><?php echo htmlspecialchars($jeu['sys_min_dx']); ?></li>
                            <li><span class="label">Stockage</span><br><?php echo htmlspecialchars($jeu['sys_min_stockage']); ?></li>
                        </ul>
                    </div>

                    <!-- Recommandée -->
                    <div class="config-col">
                        <h4>Configuration recommandée</h4>
                        <ul>
                            <li><span class="label">Système d'exploitation</span><br><?php echo htmlspecialchars($jeu['sys_rec_os']); ?></li>
                            <li><span class="label">Processeur</span><br><?php echo htmlspecialchars($jeu['sys_rec_cpu']); ?></li>
                            <li><span class="label">Mémoire vive</span><br><?php echo htmlspecialchars($jeu['sys_rec_ram']); ?></li>
                            <li><span class="label">Carte graphique</span><br><?php echo htmlspecialchars($jeu['sys_rec_gpu']); ?></li>
                            <li><span class="label">DirectX</span><br><?php echo htmlspecialchars($jeu['sys_rec_dx']); ?></li>
                            <li><span class="label">Stockage</span><br><?php echo htmlspecialchars($jeu['sys_rec_stockage']); ?></li>
                        </ul>
                    </div>
                </div>

                <!-- Langues -->
                <div class="config-langues">
                    <span class="label">Langues disponibles :</span>
                    <p><strong>Audio :</strong> <?php echo htmlspecialchars($jeu['lang_audio']); ?><br>
                    <strong>Texte :</strong> <?php echo htmlspecialchars($jeu['lang_texte']); ?></p>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/tom.js"></script>
</body>
</html>