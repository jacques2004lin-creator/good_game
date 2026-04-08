<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titre); ?></title>
    <link href="css/genre.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/css/tom-select.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <h2 class="section-titre"><?php echo htmlspecialchars($titre); ?></h2>
        <div class="grille-jeux">
            <?php
            if($res_genre && $res_genre->num_rows > 0) {
                while($jeu = $res_genre->fetch_assoc()) {
                    $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre'])));
                    echo "<div class='carte-jeu'>";
                        echo "<a href='jeux.php?id=" . $jeu['id'] . "'>";
                            echo "<img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars($jeu['image']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'>";
                            echo "<h3>" . htmlspecialchars($jeu['titre']) . "</h3>";
                            if($jeu['prix'] > 0) {
                                echo "<p>" . number_format($jeu['prix'], 2, ',', ' ') . " €</p>";
                            } else {
                                echo "<p>Gratuit</p>";
                            }
                        echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p class='vide'>Il n'y a pas de jeu pour le moment.</p>";
            }
            ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>
</html>