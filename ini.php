<?php
// Config connexion
mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);

$servername = "db";
$username = "root";
$password = "root";
$dbname = "good_game";

try {
  // On se connecte AU SERVEUR (sans base)
  $conn = new mysqli($servername, $username, $password);
  $conn->set_charset("utf8mb4");

  // On crée la base et on rentre dedans
  $conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
  $conn->select_db($dbname);

  // On prépare le mot de passe admin crypté
  $pass_admin = password_hash("123", PASSWORD_DEFAULT);

  $sql = "
  SET FOREIGN_KEY_CHECKS = 0;

  CREATE TABLE IF NOT EXISTS `categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` varchar(100) NOT NULL,
    `couleur` varchar(7) DEFAULT '#333333',
    `icone` varchar(255) DEFAULT ''
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  CREATE TABLE IF NOT EXISTS `utilisateurs` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` varchar(100) NOT NULL,
    `prenom` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL UNIQUE,
    `motdepasse` varchar(255) NOT NULL,
    `role` enum('client','admin') DEFAULT 'client'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  CREATE TABLE IF NOT EXISTS `jeux` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titre` varchar(150) NOT NULL,
    `description` text,
    `prix` decimal(10,2) NOT NULL,
    `date_sortie` date DEFAULT NULL,
    `developpeur` varchar(100) DEFAULT NULL,
    `image` varchar(255) DEFAULT 'default.png',
    `categorie_id` int(11) DEFAULT NULL,
    `editeur` varchar(100) DEFAULT 'Non renseigné',
    `fonctionnalites` text,
    `description_longue` longtext,
    `sys_min_os` varchar(100) DEFAULT 'Windows 10',
    `sys_min_cpu` varchar(150) DEFAULT NULL,
    `sys_min_ram` varchar(50) DEFAULT NULL,
    `sys_min_gpu` varchar(150) DEFAULT NULL,
    `sys_min_dx` varchar(50) DEFAULT 'DirectX 11',
    `sys_min_stockage` varchar(50) DEFAULT NULL,
    `sys_rec_os` varchar(100) DEFAULT 'Windows 10/11',
    `sys_rec_cpu` varchar(150) DEFAULT NULL,
    `sys_rec_ram` varchar(50) DEFAULT NULL,
    `sys_rec_gpu` varchar(150) DEFAULT NULL,
    `sys_rec_dx` varchar(50) DEFAULT 'DirectX 12',
    `sys_rec_stockage` varchar(50) DEFAULT NULL,
    `lang_audio` text,
    `lang_texte` text,
    `pegi` varchar(10) DEFAULT '18',
    `img_min1` varchar(255) DEFAULT 'default_min.jpg',
    `img_min2` varchar(255) DEFAULT 'default_min.jpg',
    `img_min3` varchar(255) DEFAULT 'default_min.jpg',
    CONSTRAINT `fk_cat` FOREIGN KEY (`categorie_id`) REFERENCES `categories`(`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  CREATE TABLE IF NOT EXISTS `achats` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `utilisateur_id` int(11) DEFAULT NULL,
    `sous_total` decimal(10,2) DEFAULT NULL,
    `date_achat` datetime DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_user_achat` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  CREATE TABLE IF NOT EXISTS `achat_jeux` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `achat_id` int(11) DEFAULT NULL,
    `jeu_id` int(11) DEFAULT NULL,
    `prix` decimal(10,2) DEFAULT NULL,
    CONSTRAINT `fk_achat` FOREIGN KEY (`achat_id`) REFERENCES `achats`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_jeu_achat` FOREIGN KEY (`jeu_id`) REFERENCES `jeux`(`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  CREATE TABLE IF NOT EXISTS `biblio` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `utilisateur_id` int(11) DEFAULT NULL,
    `jeu_id` int(11) DEFAULT NULL,
    UNIQUE KEY `user_game` (`utilisateur_id`,`jeu_id`),
    CONSTRAINT `fk_user_bib` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_jeu_bib` FOREIGN KEY (`jeu_id`) REFERENCES `jeux`(`id`) ON DELETE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  CREATE TABLE IF NOT EXISTS `panier` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `utilisateur_id` int(11) DEFAULT NULL,
    `jeu_id` int(11) DEFAULT NULL,
    UNIQUE KEY `user_game_panier` (`utilisateur_id`,`jeu_id`),
    CONSTRAINT `fk_user_pan` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_jeu_pan` FOREIGN KEY (`jeu_id`) REFERENCES `jeux`(`id`) ON DELETE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  CREATE TABLE IF NOT EXISTS `souhait` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `utilisateur_id` int(11) DEFAULT NULL,
    `jeu_id` int(11) DEFAULT NULL,
    UNIQUE KEY `user_game_souhait` (`utilisateur_id`,`jeu_id`),
    CONSTRAINT `fk_user_sou` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_jeu_sou` FOREIGN KEY (`jeu_id`) REFERENCES `jeux`(`id`) ON DELETE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  INSERT IGNORE INTO `categories` (`id`, `nom`, `couleur`, `icone`) VALUES
  (1, 'fps', '#4a3621', 'fa-solid fa-crosshairs'),
  (2, 'aventure', '#2ecc71', 'fa-solid fa-compass'),
  (3, 'rpg', '#777777', 'fa-solid fa-dragon'),
  (4, 'open_world', '#2ecc71', 'fa-solid fa-earth-americas'),
  (5, 'jeu_de_guerre', '#333333', 'fa-solid fa-gun'),
  (6, 'action', '#333333', ''),
  (7, 'horreur', '#333333', ''),
  (8, 'gratuit', '#333333', ''),
  (9, 'moba', '#333333', '');

  INSERT IGNORE INTO `jeux` (
    `id`, `titre`, `description`, `prix`, `image`, `categorie_id`, 
    `date_sortie`, `developpeur`, `editeur`, `fonctionnalites`, `description_longue`, 
    `sys_min_os`, `sys_min_cpu`, `sys_min_ram`, `sys_min_gpu`, `sys_min_dx`, `sys_min_stockage`, 
    `sys_rec_os`, `sys_rec_cpu`, `sys_rec_ram`, `sys_rec_gpu`, `sys_rec_dx`, `sys_rec_stockage`, 
    `lang_audio`, `lang_texte`, `pegi`, `img_min1`, `img_min2`, `img_min3`
  ) VALUES 
  (1, 'Icarus', 'Icarus est un jeu de survie JcE en session. Explorez une nature sauvage en proie au chaos.', 11.55, 'icarus.jpg', 2, '2021-12-04', 'RocketWerkz', 'RocketWerkz', 'Solo, Multijoueur en ligne, Coopération en ligne', 'ICARUS est un jeu de survie JcE en session jusqu\'à huit joueurs en coop ou en solo. Explorez une nature sauvage extraterrestre en proie au chaos suite à une terraformation ratée. Survivez assez longtemps pour extraire de la matière exotique, puis retournez en orbite pour fabriquer des technologies plus avancées.', 'Windows 10', 'Intel i5 8400', '16 Go', 'Nvidia GTX 1060 6GB', 'DirectX 11', '70 Go', 'Windows 10/11', 'Intel i7-9700', '32 Go', 'NVIDIA RTX 3060ti', 'DirectX 11', '70 Go', 'Anglais', 'Français, Anglais, Allemand, Espagnol, Japonais', '16', 'image1.jpg', 'image2.jpg', 'image3.jpg'),
  (2, 'ARC Raiders', 'Shooter coopératif à la troisième personne.', 39.99, 'arc_raiders.jpg', 1, '2025-10-30', 'Embark Studios', 'Embark Studios', 'Multijoueur en ligne, JcJ, JcE', 'ARC Raiders est un jeu de tir d\'extraction multijoueur à la troisième personne, gratuit. Entrez dans la Résistance, combattez avec d\'autres joueurs et fuyez les menaces mécaniques planétaires pour survivre.', 'Windows 10', 'Core i5-6600K / Ryzen 5 1600', '12 Go', 'GeForce GTX 970 / Radeon RX 580', 'DirectX 12', '50 Go', 'Windows 10/11', 'Core i7-9700K / Ryzen 5 3600', '16 Go', 'GeForce RTX 2070 / Radeon RX 5700 XT', 'DirectX 12', '50 Go', 'Anglais', 'Français, Anglais, Espagnol', '16', DEFAULT, DEFAULT, DEFAULT),
  (3, 'Marathon', 'Un nouveau départ pour le célèbre shooter de Bungie.', 31.49, 'marathon.jpg', 1, '2025-11-20', 'Bungie', 'Bungie', 'Multijoueur en ligne, JcJ', 'Personne ne sait ce qui s\'est passé un siècle plus tôt, lorsque l\'expédition du Marathon a cessé de donner signe de vie. Devenez un Coureur et pillez les artéfacts dans ce nouveau jeu de tir par extraction en équipe de Bungie.', 'Windows 10', 'Core i5-7400 / Ryzen 5 1400', '8 Go', 'GeForce GTX 1060 / Radeon RX 580', 'DirectX 12', '60 Go', 'Windows 10/11', 'Core i7-9700 / Ryzen 7 3700X', '16 Go', 'GeForce RTX 2060 / Radeon RX 6600', 'DirectX 12', '60 Go', 'Anglais', 'Français, Anglais, Allemand', '18', DEFAULT, DEFAULT, DEFAULT),
  (4, 'Battlefield 6', 'La guerre totale est de retour.', 69.99, 'battlefield6.jpg', 1, '2021-11-19', 'DICE', 'Electronic Arts', 'Multijoueur en ligne, Coopération', 'Battlefield marque le retour à la guerre totale emblématique de la franchise. Adaptez-vous et triomphez sur des champs de bataille dynamiques avec l\'aide de votre escouade et d\'un arsenal de pointe.', 'Windows 10', 'Core i5-6600K / Ryzen 5 1600', '8 Go', 'GeForce GTX 1050 Ti / Radeon RX 560', 'DirectX 12', '100 Go', 'Windows 10/11', 'Core i7-4790 / Ryzen 7 2700X', '16 Go', 'GeForce RTX 3060 / Radeon RX 6600 XT', 'DirectX 12', '100 Go', 'Français, Anglais', 'Français, Anglais', '18', DEFAULT, DEFAULT, DEFAULT),
  (5, 'REANIMAL', 'Un nouveau jeu d\'horreur sombre.', 23.99, 'reanimal.jpg', 7, '2026-02-13', 'Tarsier Studios', 'THQ Nordic', 'Solo, Coopération en ligne', 'Les créateurs de Little Nightmares reviennent pour vous plonger dans un voyage encore plus terrifiant. Dans ce jeu d\'aventure et d\'horreur en coop, un frère et sa sœur traversent l\'enfer pour sauver leurs amis disparus.', 'Windows 10', 'Core i5-4460 / Ryzen 3 1200', '8 Go', 'GeForce GTX 1650 / Radeon RX 570', 'DirectX 12', '30 Go', 'Windows 10/11', 'Core i7-6700 / Ryzen 5 2600', '16 Go', 'GeForce RTX 2060 / Radeon RX 5600 XT', 'DirectX 12', '30 Go', 'Anglais', 'Français, Anglais, Italien', '18', DEFAULT, DEFAULT, DEFAULT),
  (6, 'StarRupture', 'Exploration spatiale intense.', 11.99, 'star_rupture.jpg', 2, '2025-10-15', 'Creepy Jar', 'Creepy Jar', 'Solo, Coopération en ligne', 'StarRupture est un jeu de construction de base en monde ouvert à la première personne. Explorez, extrayez des ressources, créez un système industriel complexe et affrontez des hordes de monstres extraterrestres.', 'Windows 10', 'Core i7-6700K / Ryzen 5 3600', '12 Go', 'GeForce GTX 1080 / Radeon RX 5700 XT', 'DirectX 12', '30 Go', 'Windows 10/11', 'Core i7-9700K / Ryzen 7 3700X', '16 Go', 'GeForce RTX 2070 / Radeon RX 6700 XT', 'DirectX 12', '30 Go', 'Anglais', 'Français, Anglais, Polonais', '18', DEFAULT, DEFAULT, DEFAULT),
  (7, 'Crimson Desert', 'Un RPG d\'action en monde ouvert.', 69.99, 'crimson_desert.jpg', 4, '2025-08-20', 'Pearl Abyss', 'Pearl Abyss', 'Solo, Action-Aventure', 'Crimson Desert est un jeu d\'action-aventure en monde ouvert racontant l\'histoire de mercenaires luttant pour leur survie sur le vaste continent de Pywel.', 'Windows 10', 'Core i5-4430 / Ryzen 3 1200', '8 Go', 'GeForce GTX 960 / Radeon R9 280', 'DirectX 11', '50 Go', 'Windows 10/11', 'Core i7-6700K / Ryzen 5 3600', '16 Go', 'GeForce GTX 1070 / Radeon RX 5700', 'DirectX 11', '50 Go', 'Coréen, Anglais', 'Français, Anglais', '18', DEFAULT, DEFAULT, DEFAULT),
  (8, 'Grounded 2', 'Le monde est encore plus grand.', 29.99, 'grounded2.jpg', 2, '2022-09-27', 'Obsidian Entertainment', 'Xbox Game Studios', 'Solo, Coopération en ligne', 'Le monde est vaste, beau et très dangereux, surtout quand on a été réduit à la taille d\'une fourmi. Explorez, construisez et survivez dans cette aventure de survie coopérative.', 'Windows 10', 'Core i3-3225 / FX-4300', '4 Go', 'GeForce GTX 650 Ti / Radeon HD 7850', 'DirectX 11', '8 Go', 'Windows 10/11', 'Core i7-7700K / Ryzen 5 1600', '8 Go', 'GeForce GTX 1060 / Radeon RX 470', 'DirectX 11', '8 Go', 'Anglais', 'Français, Anglais, Italien', '16', DEFAULT, DEFAULT, DEFAULT),
  (9, 'DayZ', 'Combien de temps survivrez-vous ?', 47.99, 'dayz.jpg', 4, '2018-12-13', 'Bohemia Interactive', 'Bohemia Interactive', 'Multijoueur en ligne, JcJ, Survie', 'Jusqu\'où irez-vous pour survivre ? L\'ère post-apocalyptique est là. Cherchez des ressources, construisez votre base, et survivez face aux infectés et aux autres joueurs dans un monde immense et impitoyable.', 'Windows 10', 'Core i5-4430 / FX-6300', '8 Go', 'GeForce GTX 760 / Radeon R9 270X', 'DirectX 11', '25 Go', 'Windows 10/11', 'Core i5-6600K / Ryzen 5 1600', '12 Go', 'GeForce GTX 1060 / Radeon RX 580', 'DirectX 11', '25 Go', 'Anglais', 'Français, Anglais, Espagnol', '18', DEFAULT, DEFAULT, DEFAULT),
  (10, 'Halo Infinite', 'Le multijoueur légendaire.', 0.00, 'halo.jpg', 8, '2021-12-08', '343 Industries', 'Xbox Game Studios', 'Solo, Multijoueur en ligne', 'Quand tout espoir est perdu et que le destin de l\'humanité est en jeu, le Master Chief est prêt à affronter l\'ennemi le plus impitoyable qu\'il ait jamais affronté dans une aventure épique.', 'Windows 10', 'Core i5-4440 / Ryzen 5 1600', '8 Go', 'GeForce GTX 1050 Ti / Radeon RX 570', 'DirectX 12', '50 Go', 'Windows 10/11', 'Core i7-9700K / Ryzen 7 3700X', '16 Go', 'GeForce RTX 2070 / Radeon RX 5700 XT', 'DirectX 12', '50 Go', 'Français, Anglais', 'Français, Anglais', '16', DEFAULT, DEFAULT, DEFAULT),
  (11, 'Rocket League', 'Le foot avec des voitures.', 0.00, 'rocket.jpg', 8, '2015-07-07', 'Psyonix', 'Epic Games', 'Multijoueur en ligne, Multiplateforme', 'Un mélange explosif de football d\'arcade et de chaos automobile avec des commandes faciles à comprendre et un système physique fluide et basé sur l\'inertie.', 'Windows 10', 'Dual Core 2.5 GHz', '4 Go', 'GeForce GTX 760 / Radeon R7 270X', 'DirectX 11', '20 Go', 'Windows 10/11', 'Quad Core 3.0 GHz', '8 Go', 'GeForce GTX 1060 / Radeon RX 470', 'DirectX 11', '20 Go', 'Anglais', 'Français, Anglais, Allemand', '3', DEFAULT, DEFAULT, DEFAULT),
  (12, 'Fall Guys', 'La course aux obstacles déjantée.', 0.00, 'fallguys.jpg', 8, '2020-08-04', 'Mediatonic', 'Epic Games', 'Multijoueur en ligne, MMO', 'Fall Guys est un party game multijoueur, gratuit et multiplateforme où vous et les autres participants concourez à travers des parcours d\'obstacles absurdes de plus en plus chaotiques.', 'Windows 10', 'Core i5 / AMD équivalent', '8 Go', 'GeForce GTX 660 / Radeon HD 7950', 'DirectX 11', '2 Go', 'Windows 10/11', 'Core i5 / AMD équivalent', '8 Go', 'GeForce GTX 660 / Radeon HD 7950', 'DirectX 11', '2 Go', 'Anglais', 'Français, Anglais, Espagnol', '3', DEFAULT, DEFAULT, DEFAULT),
  (13, 'FIFA Mobile', 'Le foot partout avec vous.', 0.00, 'fifa.jpg', 8, '2023-09-29', 'EA Sports', 'Electronic Arts', 'Solo, Multijoueur en ligne, Sport', 'EA SPORTS FC vous plonge au cœur du Jeu Universel avec les joueurs, les équipes et les championnats les plus fidèles à la réalité pour l\'expérience de football la plus authentique.', 'Windows 10', 'Core i5-6600K / Ryzen 5 1600', '8 Go', 'GeForce GTX 1050 Ti / Radeon RX 570', 'DirectX 12', '100 Go', 'Windows 10/11', 'Core i7-6700 / Ryzen 7 2700X', '12 Go', 'GeForce GTX 1660 / Radeon RX 5600 XT', 'DirectX 12', '100 Go', 'Français, Anglais', 'Français, Anglais', '3', DEFAULT, DEFAULT, DEFAULT),
  (14, 'Fortnite', 'Battle Royale et créativité.', 0.00, 'fortnite.jpg', 8, '2017-07-21', 'Epic Games', 'Epic Games', 'Multijoueur en ligne, Battle Royale', 'Créez, jouez et affrontez d\'autres joueurs gratuitement dans Fortnite. Explorez des concerts, participez à d\'immenses Battle Royale, ou créez votre propre île et vos propres règles.', 'Windows 10', 'Core i3-3225 / AMD équivalent', '8 Go', 'Intel HD 4000 / Radeon Vega 8', 'DirectX 11', '30 Go', 'Windows 10/11', 'Core i5-7300U / Ryzen 3 3300U', '16 Go', 'GeForce GTX 960 / Radeon R9 280', 'DirectX 11', '30 Go', 'Français, Anglais', 'Français, Anglais', '12', DEFAULT, DEFAULT, DEFAULT),
  (15, 'Fruit Ninja', 'Tranchage fruits en folie.', 0.00, 'fruitninja.jpg', 8, '2010-04-21', 'Halfbrick Studios', 'Halfbrick Studios', 'Solo, Arcade', 'Préparez votre lame ! Le jeu mobile d\'action fruité classique avec des modes excitants pour des découpes juteuses arrive avec toute son intensité.', 'Windows 10', 'Dual Core 2.0 GHz', '2 Go', 'Intel HD Graphics', 'DirectX 11', '1 Go', 'Windows 10/11', 'Quad Core 2.5 GHz', '4 Go', 'GeForce GTX 650', 'DirectX 11', '1 Go', 'Aucun', 'Français, Anglais', '3', DEFAULT, DEFAULT, DEFAULT),
  (16, 'Resident Evil Requiem', 'Jeu d''horreur épique.', 69.99, 'residentevil.jpg', 7, '2023-03-24', 'Capcom', 'Capcom', 'Solo, Horreur', 'La survie n\'est que le début. Le cauchemar reprend de plus belle dans ce chapitre horrifique intense et immersif. Chaque recoin cache un nouveau danger prêt à frapper.', 'Windows 10', 'Core i5-7500 / Ryzen 3 1200', '8 Go', 'GeForce GTX 1050 Ti / Radeon RX 560', 'DirectX 12', '40 Go', 'Windows 10/11', 'Core i7-8700 / Ryzen 5 3600', '16 Go', 'GeForce GTX 1070 / Radeon RX 5700', 'DirectX 12', '40 Go', 'Français, Anglais, Japonais', 'Français, Anglais, Italien', '18', DEFAULT, DEFAULT, DEFAULT);

  INSERT IGNORE INTO `utilisateurs` (`email`, `motdepasse`, `role`, `prenom`, `nom`) 
  VALUES ('admin@test.com', '$pass_admin', 'admin', 'admin', 'admin');

  SET FOREIGN_KEY_CHECKS = 1;
  ";

  // Exécution
  if($conn->multi_query($sql)) {
    do {
      if($result = $conn->store_result()) {
        $result->free();
      }
    } while($conn->more_results() && $conn->next_result());
    
    if ($conn->errno) {
      die("Erreur SQL : " . $conn->error);
    }

    $conn->close();
    header("Location: index.php");
    exit();
  } else {
    die("Erreur multi_query : " . $conn->error);
  }

} catch (mysqli_sql_exception $e) {
  die("Erreur connexion : " . $e->getMessage());
}
?>