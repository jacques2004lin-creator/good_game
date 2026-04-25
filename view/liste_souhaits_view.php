<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="css/panier.css">
    <link rel="stylesheet" href="css/liste_souhaits.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/css/tom-select.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de souhaits - Good Game</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="gg-wl-container">
        <h1 class="gg-wl-title">Ma liste de souhait</h1>
        <?php if ($resultat_souhait->num_rows > 0): ?>

            <div class="gg-wl-list">
                <?php while ($jeu = $resultat_souhait->fetch_assoc()): ?>
                    <?php $nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre']))); ?>
                    <div class="gg-wl-card">
                        <img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="Jeu" class="gg-wl-img">

                        <div class="gg-wl-content">
                            <div class="gg-wl-top">
                                <div class="gg-wl-info">
                                    <h3><?php echo htmlspecialchars($jeu['titre']); ?></h3>
                                    <img src="image/windows_logo.png" alt="Windows" class="gg-platform-icon-img">
                                </div>
                                <div class="gg-wl-price">
                                    <?php echo number_format($jeu['prix'], 2, ',', ''); ?>€
                                </div>
                            </div>

                            <div class="gg-wl-bottom">
                                <form action="" method="POST" style="margin: 0;">
                                    <input type="hidden" name="jeu_id" value="<?php echo $jeu['id']; ?>">
                                    <button type="submit" name="btn_supprimer" class="gg-btn-text">Supprimer</button>
                                </form>

                                <form action="" method="POST" style="margin: 0;">
                                    <input type="hidden" name="jeu_id" value="<?php echo $jeu['id']; ?>">
                                    <button type="submit" name="btn_ajouter_panier" class="gg-btn-white-small">Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>

        <?php else: ?>

            <div class="gg-cart-empty">
                <h2>Votre liste de souhaits est vide.</h2>
                <a href="index.php" class="gg-btn-white">Acheter des jeux et des applications</a>
            </div>

        <?php endif; ?>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/js/tom-select.complete.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/tom.js"></script>
</body>

</html>