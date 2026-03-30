<?php
session_start();

// Connexion à la base de données
$conn = new mysqli("db", "root", "root", "good_game");
$conn->set_charset("utf8mb4");

$message = ""; // Variable pour stocker les messages de notification

// GESTION DU PANIER ET DE LA LISTE DE SOUHAITS
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['id_utilisateur'])) {
        header("Location: connexion.php");
        exit();
    }

    $id_user = $_SESSION['id_utilisateur'];
    $id_jeu_post = (int)$_POST['id_produit'];

    // AJOUT AU PANIER
    if ($_POST['action'] == 'ajouter') {
        // Vérifier s'il n'est pas déjà dans le panier
        $check = $conn->query("SELECT * FROM panier WHERE utilisateur_id = $id_user AND jeu_id = $id_jeu_post");
        if ($check->num_rows == 0) {
            $conn->query("INSERT INTO panier (utilisateur_id, jeu_id) VALUES ($id_user, $id_jeu_post)");
            $message = "<div class='msg-succes'>Jeu ajouté au panier !</div>";
        } else {
            $message = "<div class='msg-info'>Ce jeu est déjà dans votre panier.</div>";
        }
    }

    // AJOUT À LA LISTE DE SOUHAITS
    if ($_POST['action'] == 'ajouter_souhait') {
        // Vérifier s'il n'est pas déjà dans la liste
        $check = $conn->query("SELECT * FROM souhait WHERE utilisateur_id = $id_user AND jeu_id = $id_jeu_post");
        if ($check->num_rows == 0) {
            $conn->query("INSERT INTO souhait (utilisateur_id, jeu_id) VALUES ($id_user, $id_jeu_post)");
            $message = "<div class='msg-succes'>Jeu ajouté aux souhaits !</div>";
        } else {
            $message = "<div class='msg-info'>Ce jeu est déjà dans votre liste.</div>";
        }
    }
}


// Vérifie si on a bien l'id du jeu dans l'URL
if(isset($_GET['id'])) {
    $id_url = $conn->real_escape_string($_GET['id']);
    
    $sql = "SELECT jeux.*, categories.nom AS nom_categorie 
            FROM jeux 
            JOIN categories ON jeux.categorie_id = categories.id 
            WHERE jeux.id = '$id_url'";
    
    $res_jeux = $conn->query($sql);

    if($res_jeux->num_rows > 0) {
        $jeu = $res_jeux->fetch_assoc();
        $cat_brute = $jeu['nom_categorie'];
        $titre_categorie = ucwords(strtolower(str_replace('_', ' ', $cat_brute)));

    } else {
        die("Ce jeu n'existe pas.");
    }

} else {
    header("Location: index.php");
    exit();
}

$nom_dossier = str_replace(' ', '_', strtolower(htmlspecialchars($jeu['titre'])));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($jeu['titre']); ?></title>
    <link href="css/jeux.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <h1 class="titre-principal"><?php echo htmlspecialchars($jeu['titre']); ?></h1>

        <section class="jeu">
            <div class="jeu-galerie">
    
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="<?php echo htmlspecialchars($jeu['titre']); ?>"></div>
                        <?php if(!empty($jeu['img_min1'])) { echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min1']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>"; } ?>
                        <?php if(!empty($jeu['img_min2'])) { echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min2']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>"; } ?>
                        <?php if(!empty($jeu['img_min3'])) { echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min3']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>"; } ?>
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <div class="swiper thumbSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="image/jeux/<?php echo $nom_dossier; ?>/<?php echo htmlspecialchars($jeu['image']); ?>" alt="<?php echo htmlspecialchars($jeu['titre']); ?>"></div>
                        <?php if(!empty($jeu['img_min1'])) { echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min1']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>"; } ?>
                        <?php if(!empty($jeu['img_min2'])) { echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min2']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>"; } ?>
                        <?php if(!empty($jeu['img_min3'])) { echo "<div class='swiper-slide'><img src='image/jeux/" . $nom_dossier . "/" . htmlspecialchars((string)$jeu['img_min3']) . "' alt='" . htmlspecialchars($jeu['titre']) . "'></div>"; } ?>
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

                <?php if(!empty($message)) echo $message; ?>

                <form action="" method="POST">
                    <input type="hidden" name="action" value="ajouter">
                    <input type="hidden" name="id_produit" value="<?php echo $jeu['id']; ?>">
                    <button type="submit" class="btn-achat">Acheter</button>
                </form>
                
                <form action="" method="POST">
                    <input type="hidden" name="action" value="ajouter_souhait">
                    <input type="hidden" name="id_produit" value="<?php echo $jeu['id']; ?>">
                    <button type="submit" class="btn-souhait">Liste de souhaits</button>
                </form>

                <ul class="jeu-info">
                    <li><strong>Classification :</strong> PEGI <?php echo htmlspecialchars($jeu['pegi']); ?></li>
                    <li><strong>Développeur :</strong> <?php echo htmlspecialchars($jeu['developpeur']); ?></li>
                    <li><strong>Éditeur :</strong> <?php echo htmlspecialchars($jeu['editeur']); ?></li>
                    <li><strong>Date de sortie :</strong> <?php echo htmlspecialchars($jeu['date_sortie']); ?></li>
                </ul>
            </div>
        </section>

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

        <section class="jeu-description">
            <h2>À propos de ce jeu</h2>
            
            <div class="texte-description">
                <?php echo nl2br(htmlspecialchars($jeu['description_longue'])); ?>
            </div>
        </section>

        <section class="jeu-config">
            <h2>Configuration système requise pour <?php echo htmlspecialchars($jeu['titre']); ?></h2>
            
            <div class="config-tabs">
                <span class="tab">Windows</span>
            </div>

            <div class="config-box">
                <div class="config-grid">

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

                <div class="config-langues">
                    <span class="label">Langues disponibles :</span>
                    <p><strong>Audio :</strong> <?php echo htmlspecialchars($jeu['lang_audio']); ?><br>
                    <strong>Texte :</strong> <?php echo htmlspecialchars($jeu['lang_texte']); ?></p>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/slider.js"></script>
</body>
</html>

<?php
$conn->close();
?>
