-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 08, 2026 at 11:42 AM
-- Server version: 10.11.16-MariaDB-ubu2204
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `good_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `achats`
--

CREATE TABLE `achats` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `sous_total` decimal(10,2) DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achats`
--

INSERT INTO `achats` (`id`, `utilisateur_id`, `sous_total`) VALUES
(1, 8, 11.55),
(2, 8, 23.99),
(3, 8, 69.99),
(4, 8, 0.00),
(5, 8, 69.99),
(6, 8, 31.49),
(7, 8, 69.99),
(8, 8, 11.99),
(9, 8, 11.99),
(10, 8, 87.98),
(11, 8, 0.00),
(12, 8, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `achat_jeux`
--

CREATE TABLE `achat_jeux` (
  `id` int(11) NOT NULL,
  `achat_id` int(11) DEFAULT NULL,
  `jeu_id` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achat_jeux`
--

INSERT INTO `achat_jeux` (`id`, `achat_id`, `jeu_id`, `prix`) VALUES
(1, 1, 1, 11.55),
(2, 2, 5, 23.99),
(3, 3, 16, 69.99),
(4, 4, 15, 0.00),
(5, 5, 4, 69.99),
(6, 6, 3, 31.49),
(7, 7, 7, 69.99),
(8, 8, 6, 11.99),
(9, 9, 6, 11.99),
(10, 10, 2, 39.99),
(11, 10, 9, 47.99),
(12, 11, 13, 0.00),
(13, 12, 10, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `biblio`
--

CREATE TABLE `biblio` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `jeu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biblio`
--

INSERT INTO `biblio` (`id`, `utilisateur_id`, `jeu_id`) VALUES
(1, 8, 1),
(10, 8, 2),
(6, 8, 3),
(5, 8, 4),
(2, 8, 5),
(8, 8, 6),
(7, 8, 7),
(11, 8, 9),
(13, 8, 10),
(12, 8, 13),
(4, 8, 15),
(3, 8, 16);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `couleur` varchar(7) DEFAULT '#333333',
  `icone` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `couleur`, `icone`) VALUES
(1, 'fps', '#4a3621', 'fa-solid fa-crosshairs'),
(2, 'aventure', '#2ecc71', 'fa-solid fa-compass'),
(3, 'rpg', '#777777', 'fa-solid fa-dragon'),
(4, 'open_world', '#2ecc71', 'fa-solid fa-earth-americas'),
(5, 'jeu_de_guerre', '#333333', 'fa-solid fa-gun'),
(6, 'action', '#333333', ''),
(7, 'horreur', '#333333', ''),
(8, 'gratuit', '#333333', ''),
(9, 'moba', '#333333', '');

-- --------------------------------------------------------

--
-- Table structure for table `jeux`
--

CREATE TABLE `jeux` (
  `id` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `date_sortie` date DEFAULT NULL,
  `developpeur` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default.png',
  `categorie_id` int(11) DEFAULT NULL,
  `editeur` varchar(100) DEFAULT 'Non renseigné',
  `fonctionnalites` text DEFAULT NULL,
  `description_longue` longtext DEFAULT NULL,
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
  `lang_audio` text DEFAULT NULL,
  `lang_texte` text DEFAULT NULL,
  `pegi` varchar(10) DEFAULT '18',
  `img_min1` varchar(255) DEFAULT 'default_min.jpg',
  `img_min2` varchar(255) DEFAULT 'default_min.jpg',
  `img_min3` varchar(255) DEFAULT 'default_min.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jeux`
--

INSERT INTO `jeux` (`id`, `titre`, `description`, `prix`, `date_sortie`, `developpeur`, `image`, `categorie_id`, `editeur`, `fonctionnalites`, `description_longue`, `sys_min_os`, `sys_min_cpu`, `sys_min_ram`, `sys_min_gpu`, `sys_min_dx`, `sys_min_stockage`, `sys_rec_os`, `sys_rec_cpu`, `sys_rec_ram`, `sys_rec_gpu`, `sys_rec_dx`, `sys_rec_stockage`, `lang_audio`, `lang_texte`, `pegi`, `img_min1`, `img_min2`, `img_min3`) VALUES
(1, 'Icarus', 'Icarus est un jeu de survie JcE en session. Explorez une nature sauvage en proie au chaos.', 11.55, '2021-12-04', 'RocketWerkz', 'icarus.jpg', 2, 'RocketWerkz', 'Solo, Multijoueur en ligne, Coopération en ligne', 'ICARUS est un jeu de survie JcE en session jusqu\'à huit joueurs en coop ou en solo.\n\nExplorez une nature sauvage extraterrestre en proie au chaos suite à une terraformation ratée. Survivez assez longtemps pour extraire de la matière exotique, puis retournez en orbite pour fabriquer des technologies plus avancées. Les prospecteurs descendent à la surface de la planète pour des sessions à durée limitée afin d\'accomplir des missions de faction ou de rechercher des matériaux exotiques.', 'Windows 10 (64-bit)', 'Intel i5 8400', '16 Go', 'Nvidia GTX 1060 6GB', 'DirectX 11', '70 Go', 'Windows 10 (64-bit)', 'Intel i7-9700', '32 Go', 'NVIDIA RTX 3060ti', 'DirectX 11', '70 Go', 'Anglais', 'Français, Anglais, Allemand, Espagnol, Japonais, Chinois simplifié', '16', 'image1.jpg', 'image2.jpg', 'image3.jpg'),
(2, 'ARC Raiders', 'Shooter coopératif à la troisième personne.', 39.99, NULL, NULL, 'arc_raiders.jpg', 1, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(3, 'Marathon', 'Un nouveau départ pour le célèbre shooter de Bungie.', 31.49, NULL, NULL, 'marathon.jpg', 1, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(4, 'Battlefield 6', 'La guerre totale est de retour.', 69.99, NULL, NULL, 'battlefield6.jpg', 1, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(5, 'REANIMAL', 'Un nouveau jeu d\'horreur sombre.', 23.99, NULL, NULL, 'reanimal.jpg', 7, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(6, 'StarRupture', 'Exploration spatiale intense.', 11.99, NULL, NULL, 'star_rupture.jpg', 2, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(7, 'Crimson Desert', 'Un RPG d\'action en monde ouvert.', 69.99, NULL, NULL, 'crimson_desert.jpg', 4, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(8, 'Grounded 2', 'Le monde est encore plus grand.', 29.99, NULL, NULL, 'grounded2.jpg', 2, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(9, 'DayZ', 'Combien de temps survivrez-vous ?', 47.99, NULL, NULL, 'dayz.jpg', 4, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(10, 'Halo Infinite', 'Le multijoueur légendaire.', 0.00, NULL, NULL, 'halo.jpg', 8, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(11, 'Rocket League', 'Le foot avec des voitures.', 0.00, NULL, NULL, 'rocket.jpg', 8, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(12, 'Fall Guys', 'La course aux obstacles déjantée.', 0.00, NULL, NULL, 'fallguys.jpg', 8, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(13, 'FIFA Mobile', 'Le foot partout avec vous.', 0.00, NULL, NULL, 'fifa.jpg', 8, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(14, 'Fortnite', 'Battle Royale et créativité.', 0.00, NULL, NULL, 'fortnite.jpg', 8, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(15, 'Fruit Ninja', 'Tranchez des fruits en folie.', 0.00, NULL, NULL, 'fruitninja.jpg', 8, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg'),
(16, 'Resident Evil Requiem', 'Jeu d\'horreur', 69.99, NULL, NULL, 'residentevil.jpg', 7, 'Non renseigné', NULL, NULL, 'Windows 10', NULL, NULL, NULL, 'DirectX 11', NULL, 'Windows 10/11', NULL, NULL, NULL, 'DirectX 12', NULL, NULL, NULL, '18', 'default_min.jpg', 'default_min.jpg', 'default_min.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `jeu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `souhait`
--

CREATE TABLE `souhait` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `jeu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `role` enum('client','admin') DEFAULT 'client',
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `motdepasse`, `role`) VALUES
(3, '', '', 'admin@test.com', 'admin', 'admin'),
(4, '', '', 'client@test.com', '1234', 'client'),
(5, 'zeaz', 'ezaeza', 'zeaz@gmail.com', '$2y$10$ci.eRicp2J7IypsCY9jr0.GSssbsRWZCv2fVvKold4wm5t7YH8pLe', 'client'),
(6, 'zeae', 'ezae', 'zeaze@gmail.com', '$2y$10$F4UfenWKYBYIlHZAeR0JFeKo5Hd.4fdtvzYvrAOV0VqQfkuwZwVDi', 'client'),
(7, 'rtgg', 'dfg', 'zaea@gmail.com', '$2y$10$00U34CYsLkgwe0wcgvbedONkomt5k61JQBcBD5EV51DLtp4SJM2si', 'client'),
(8, 'eza', 'eza', 'eza@test.com', '$2y$10$BJMOb//dBoJxmMA2ddGWgOBjekxni6tG6GDVE6AMw6GtJ48nUySAq', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Indexes for table `achat_jeux`
--
ALTER TABLE `achat_jeux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achat_id` (`achat_id`),
  ADD KEY `jeu_id` (`jeu_id`);

--
-- Indexes for table `biblio`
--
ALTER TABLE `biblio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `utilisateur_id` (`utilisateur_id`,`jeu_id`),
  ADD KEY `jeu_id` (`jeu_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `utilisateur_id` (`utilisateur_id`,`jeu_id`),
  ADD KEY `jeu_id` (`jeu_id`);

--
-- Indexes for table `souhait`
--
ALTER TABLE `souhait`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `utilisateur_id` (`utilisateur_id`,`jeu_id`),
  ADD KEY `jeu_id` (`jeu_id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achats`
--
ALTER TABLE `achats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `achat_jeux`
--
ALTER TABLE `achat_jeux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `biblio`
--
ALTER TABLE `biblio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `souhait`
--
ALTER TABLE `souhait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `achats_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);

--
-- Constraints for table `achat_jeux`
--
ALTER TABLE `achat_jeux`
  ADD CONSTRAINT `achat_jeux_ibfk_1` FOREIGN KEY (`achat_id`) REFERENCES `achats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `achat_jeux_ibfk_2` FOREIGN KEY (`jeu_id`) REFERENCES `jeux` (`id`);

--
-- Constraints for table `biblio`
--
ALTER TABLE `biblio`
  ADD CONSTRAINT `biblio_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `biblio_ibfk_2` FOREIGN KEY (`jeu_id`) REFERENCES `jeux` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `jeux_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`jeu_id`) REFERENCES `jeux` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `souhait`
--
ALTER TABLE `souhait`
  ADD CONSTRAINT `souhait_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `souhait_ibfk_2` FOREIGN KEY (`jeu_id`) REFERENCES `jeux` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
