<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil - Good Game</title>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/accueil.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/css/tom-select.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'includes/header.php'; ?>

        <!-- Banniere de la page -->
        <main>
            <section class="banniere">
                <?php
                if ($banniere) {
                    $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($banniere['titre'])));
                    echo "<a href='jeux.php?id=" . $banniere["id"] . "' class='lien'>";
                        echo "<img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars($banniere['image']) . "' alt='" . htmlspecialchars($banniere["titre"]) . "' class='banniere-img'>";
                    echo "</a>";
                } else {
                    echo "<p class='vide'>Pas de banniere pour le moment.</p>";
                }
                ?>
            </section>

            <!-- Nouveautés et slider -->
            <section class="nouveaux-section">
                <h2 class="section-titre">Nouveaux</h2>
                <?php 
                if($res_nouveaux->num_rows > 0) {
                    echo "<div class='swiper sliderNouveaux'>";
                        echo "<div class='swiper-wrapper'>";
                            while($nouveau = $res_nouveaux->fetch_assoc()) {
                                $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($nouveau['titre'])));
                                echo "<div class='swiper-slide'>";
                                    echo "<a href='jeux.php?id=" . $nouveau["id"] . "' class='jeu-lien'>";
                                        echo "<div class='image-container'>";
                                            echo "<img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars($nouveau["image"]) . "' alt='" . htmlspecialchars($nouveau["titre"]) . "'>";
                                            echo "<div class='titre'>";
                                                echo "<h3>" . htmlspecialchars($nouveau["titre"]) . "</h3>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</a>";
                                echo "</div>";
                            }                            
                        echo "</div>";

                        echo "<div class='swiper-button-prev'></div>";
                        echo "<div class='swiper-button-next'></div>";
                        echo "<div class='swiper-pagination'></div>";
                    echo "</div>";
                } else {
                    echo "<p class='vide'>Aucune nouveauté pour le moment.</p>";
                }
                ?>
            </section>

            <!-- Jeux en tendances -->
            <section class="tendances-section">
                <h2 class="section-titre">Tendances</h2>
                <div class="swiper sliderJeux">
                    <div class="grille-jeux swiper-wrapper">
                        <?php
                        if($res_tendance->num_rows > 0) {
                            while($jeu = $res_tendance->fetch_assoc()) {
                                $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre'])));
                                echo "<div class='carte-jeu swiper-slide'>";
                                    echo "<a href='jeux.php?id=" . $jeu["id"] . "'>";
                                        echo "<img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars($jeu["image"]) . "' alt='" . htmlspecialchars($jeu["titre"]) . "'>";
                                        echo "<h3>" . htmlspecialchars($jeu["titre"]) . "</h3>";
                                        echo "<p>" . number_format($jeu["prix"], 2, ',', ' ') . " €</p>";
                                    echo "</a>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='vide'>Aucun jeu en tendance pour le moment.</p>";
                        }
                        ?>
                    </div>
                </div>
            </section>

            <!-- Jeux gratuit -->
            <section class="gratuit-section">
                <h2 class="section-titre">Gratuit</h2>
                <div class="swiper sliderJeux">
                    <div class="swiper-wrapper grille-jeux">
                        <?php
                        if($res_gratuit->num_rows > 0) {
                            while($jeu_gratuit = $res_gratuit->fetch_assoc()) {
                                $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu_gratuit['titre'])));
                                echo "<div class='carte-jeu swiper-slide'>";
                                    echo "<a href='jeux.php?id=" . $jeu_gratuit["id"] . "'>";
                                        echo "<img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars($jeu_gratuit["image"]) . "' alt='" . htmlspecialchars($jeu_gratuit["titre"]) . "'>";
                                        echo "<h3>" . htmlspecialchars($jeu_gratuit["titre"]) . "</h3>";
                                        echo "<p>Gratuit</p>";
                                    echo "</a>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='vide'>Aucun jeu gratuit pour le moment.</p>";
                        }
                        ?>
                    </div>
            </section>

            <!-- Genre -->
            <section class="genres-section">
                <h2 class="section-titre">Explorer par Genre</h2>
                <div class="genres-container">
                    <?php
                    if($res_genres->num_rows > 0) {
                        while($cat = $res_genres->fetch_assoc()) {
                            $titre = str_replace("_", " ", $cat["nom"]);
                            echo "<a href='genre.php?cat=" . $cat["nom"] . "' class='genre-carte' style='background-color: " . htmlspecialchars($cat["couleur"]) . ";'>";
                                echo "<div class='genre-icone'>";
                                    echo "<i class='" . htmlspecialchars($cat["icone"]) . "'></i>";
                                echo "</div>";
                                echo "<div class='genre-titre'>" . strtoupper(htmlspecialchars($titre)) . "</div>";
                            echo "</a>";
                        }
                    } else {
                        echo "<p class='vide'>Aucune catégorie pour le moment.</p>";
                    }
                    ?>
                </div>

                <div class="voir-plus">
                    <a href="categories.php" class="btn-voir-plus">
                        VOIR PLUS
                        <div class="fleche-bas">▼</div>
                    </a>
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