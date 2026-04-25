<?php
// Config connexion
mysqli_report(MYSQLI_REPORT_OFF);

$servername = "db";
$username = "root";
$password = "root";
$dbname = "good_game";
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Création de la base
$conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
$conn->select_db($dbname);

// SQL
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
  `role` enum('client','admin') DEFAULT 'client',
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
  FOREIGN KEY (`categorie_id`) REFERENCES `categories`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `achats` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `utilisateur_id` int(11) DEFAULT NULL,
  `sous_total` decimal(10,2) DEFAULT NULL,
  `date_achat` datetime DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `achat_jeux` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `achat_id` int(11) DEFAULT NULL,
  `jeu_id` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  FOREIGN KEY (`achat_id`) REFERENCES `achats`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`jeu_id`) REFERENCES `jeux`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `biblio` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `utilisateur_id` int(11) DEFAULT NULL,
  `jeu_id` int(11) DEFAULT NULL,
  UNIQUE KEY `user_game` (`utilisateur_id`,`jeu_id`),
  FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`jeu_id`) REFERENCES `jeux`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `utilisateur_id` int(11) DEFAULT NULL,
  `jeu_id` int(11) DEFAULT NULL,
  UNIQUE KEY `user_game_panier` (`utilisateur_id`,`jeu_id`),
  FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`jeu_id`) REFERENCES `jeux`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `souhait` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `utilisateur_id` int(11) DEFAULT NULL,
  `jeu_id` int(11) DEFAULT NULL,
  UNIQUE KEY `user_game_souhait` (`utilisateur_id`,`jeu_id`),
  FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`jeu_id`) REFERENCES `jeux`(`id`) ON DELETE CASCADE
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

INSERT IGNORE INTO `jeux` (`id`, `titre`, `description`, `prix`, `date_sortie`, `developpeur`, `image`, `categorie_id`, `editeur`, `pegi`) VALUES
(1, 'Icarus', 'Icarus est un jeu de survie JcE en session. Explorez une nature sauvage en proie au chaos.', 11.55, 
'2021-12-04', 'RocketWerkz', 'RocketWerkz', 'icarus.jpg', 2, 'Solo, Multijoueur en ligne, Coopération en ligne', 'ICARUS 
est un jeu de survie JcE en session jusqu\'à huit joueurs en coop ou en solo. Explorez une nature sauvage extraterrestre 
en proie au chaos suite à une terraformation ratée. Survivez assez longtemps pour extraire de la matière exotique, puis 
retournez en orbite pour fabriquer des technologies plus avancées.', 'Windows 10 (64-bit)', 'Intel i5 8400', '16 Go', 
'Nvidia GTX 1060 6GB', 'DirectX 11', '70 Go', 'Windows 10 (64-bit)', 'Intel i7-9700', '32 Go', 'NVIDIA RTX 3060ti', 
'DirectX 11', '70 Go', 'Anglais', 'Français, Anglais, Allemand, Espagnol, Japonais', '16', 'image1.jpg', 'image2.jpg', 
'image3.jpg'),
(2, 'ARC Raiders', 'Shooter coopératif.', 39.99, NULL, NULL, 'arc_raiders.jpg', 1, 'Non renseigné', '18'),
(3, 'Marathon', 'Shooter de Bungie.', 31.49, NULL, NULL, 'marathon.jpg', 1, 'Non renseigné', '18'),
(4, 'Battlefield 6', 'Guerre totale.', 69.99, NULL, NULL, 'battlefield6.jpg', 1, 'Non renseigné', '18'),
(5, 'REANIMAL', 'Horreur sombre.', 23.99, NULL, NULL, 'reanimal.jpg', 7, 'Non renseigné', '18'),
(6, 'StarRupture', 'Exploration spatiale.', 11.99, NULL, NULL, 'star_rupture.jpg', 2, 'Non renseigné', '18'),
(7, 'Crimson Desert', 'RPG Monde ouvert.', 69.99, NULL, NULL, 'crimson_desert.jpg', 4, 'Non renseigné', '18'),
(8, 'Grounded 2', 'Monde géant.', 29.99, NULL, NULL, 'grounded2.jpg', 2, 'Non renseigné', '18'),
(9, 'DayZ', 'Survie zombie.', 47.99, NULL, NULL, 'dayz.jpg', 4, 'Non renseigné', '18'),
(10, 'Halo Infinite', 'Multijoueur.', 0.00, NULL, NULL, 'halo.jpg', 8, 'Non renseigné', '18'),
(11, 'Rocket League', 'Foot auto.', 0.00, NULL, NULL, 'rocket.jpg', 8, 'Non renseigné', '18'),
(12, 'Fall Guys', 'Course obstacles.', 0.00, NULL, NULL, 'fallguys.jpg', 8, 'Non renseigné', '18'),
(13, 'FIFA Mobile', 'Foot partout.', 0.00, NULL, NULL, 'fifa.jpg', 8, 'Non renseigné', '18'),
(14, 'Fortnite', 'Battle Royale.', 0.00, NULL, NULL, 'fortnite.jpg', 8, 'Non renseigné', '18'),
(15, 'Fruit Ninja', 'Tranchage fruits.', 0.00, NULL, NULL, 'fruitninja.jpg', 8, 'Non renseigné', '18'),
(16, 'Resident Evil Requiem', 'Horreur.', 69.99, NULL, NULL, 'residentevil.jpg', 7, 'Non renseigné', '18');

SET FOREIGN_KEY_CHECKS = 1;
";

// Compte Admin
$email_admin = "admin@test.com";
$pass_admin = password_hash("123", PASSWORD_DEFAULT);

$conn->query("DELETE FROM utilisateurs WHERE email = '$email_admin'");

$conn->query("INSERT INTO utilisateurs (email, motdepasse, role, prenom, nom) VALUES ('$email_admin', '$pass_admin', 'admin', 'admin', 'admin')");

// Execute plusieurs requêtes SQL, nettoie la mémoire puis redirige vers la page d'accueil
if($conn->multi_query($sql)) {
    do {
        if($result = $conn->store_result()) {
            $result->free();
        }
    } while($conn->more_results() && $conn->next_result());

    $conn->close();
    
    header("Location: index.php");
    exit();
} else {
    echo "Erreur lors de l'exécution : " . $conn->error;
}
?>