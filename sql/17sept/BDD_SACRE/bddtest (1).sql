-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2023 at 09:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bddtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `comm_id` int NOT NULL,
  `comm_price` decimal(6,2) NOT NULL,
  `comm_status` varchar(50) NOT NULL,
  `comm_statut` varchar(50) NOT NULL,
  `comm_games` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compose`
--

CREATE TABLE `compose` (
  `coll_name` varchar(120) NOT NULL,
  `coll_date_add` date NOT NULL,
  `game_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `compose`
--

INSERT INTO `compose` (`coll_name`, `coll_date_add`, `game_id`) VALUES
('Collection de djamel', '2023-09-15', 3),
('Collection de djamel', '2023-09-06', 7),
('Collection de djamel', '2023-09-16', 11),
('Collection de djamel', '2023-09-16', 12),
('Collection de user1', '2023-09-16', 13),
('Collection de djamel', '2023-09-16', 14);

-- --------------------------------------------------------

--
-- Table structure for table `console`
--

CREATE TABLE `console` (
  `game_id` int NOT NULL,
  `platform` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `console`
--

INSERT INTO `console` (`game_id`, `platform`) VALUES
(3, 'XBOUX'),
(7, 'Sed suscipit reicien'),
(8, 'Molestiae voluptas a'),
(9, 'Minim ex rem aut nes'),
(10, 'Minim ex rem aut nes'),
(11, 'Temporibus et reicie'),
(12, 'Beatae suscipit dolo'),
(13, 'Dolor sapiente conse'),
(14, 'Sed suscipit reicien');

-- --------------------------------------------------------

--
-- Table structure for table `etat`
--

CREATE TABLE `etat` (
  `game_id` int NOT NULL,
  `game_condition` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `etat`
--

INSERT INTO `etat` (`game_id`, `game_condition`) VALUES
(3, 'casi-neuf'),
(7, 'casi-neuf'),
(8, 'neuf'),
(9, 'neuf'),
(10, 'neuf'),
(11, 'casi-neuf'),
(12, 'casi-neuf'),
(13, 'neuf'),
(14, 'casi-neuf');

-- --------------------------------------------------------

--
-- Table structure for table `gametags`
--

CREATE TABLE `gametags` (
  `game_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gametags`
--

INSERT INTO `gametags` (`game_id`, `tag_id`) VALUES
(1, 1),
(3, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(3, 2),
(10, 2),
(7, 7),
(8, 8),
(9, 9),
(10, 9),
(11, 10),
(12, 11),
(13, 12),
(13, 13),
(14, 14);

-- --------------------------------------------------------

--
-- Table structure for table `jeu`
--

CREATE TABLE `jeu` (
  `game_id` int NOT NULL,
  `game_title` varchar(120) NOT NULL,
  `game_desc` varchar(500) NOT NULL,
  `game_img` varchar(120) NOT NULL,
  `game_date` date NOT NULL,
  `comm_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jeu`
--

INSERT INTO `jeu` (`game_id`, `game_title`, `game_desc`, `game_img`, `game_date`, `comm_id`) VALUES
(1, 'abc', 'errgerg', 'eeee', '2023-08-16', NULL),
(3, 'abcdaf', 'Natus fugiat eiusmod', '../uploads/frame.png', '2023-09-15', NULL),
(7, 'JEUUUUU', 'Consequuntur possimu', '../uploads/imgj/aron-visuals-NYwZhS4afQc-unsplash.jpg', '2023-09-16', NULL),
(8, 'test1', 'Illo fugiat in dolo', '../uploads/imgj/arena_Meta-ShareImage.jpg', '2023-09-16', NULL),
(9, 'test2', 'Qui quasi ut repelle', '../uploads/imgj/capture-decran-2021-11-10-a-18-04-21.jpg', '2023-09-16', NULL),
(10, 'test24', 'Qui quasi ut repelle', '../uploads/imgj/frame (1).png', '2023-09-16', NULL),
(11, 'kiki', 'Officia possimus ex', '../uploads/imgj/aron-visuals-NYwZhS4afQc-unsplash.jpg', '2023-09-16', NULL),
(12, 'Minima nisi dolor au', 'Eaque ut ipsa saepe', '../uploads/imgj/frame.png', '2023-09-16', NULL),
(13, 'WOW WHAT A GAME', 'Eu vero est eius re', '../uploads/imgj/raoul-droog-yMSecCHsIBc-unsplash.jpg', '2023-09-16', NULL),
(14, 'Facilis dolor qui oc', 'Consequuntur possimu', '../uploads/imgj/mohammad-alizade-XgeZu2jBaVI-unsplash (1).jpg', '2023-09-16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paiement`
--

CREATE TABLE `paiement` (
  `pay_id` int NOT NULL,
  `pay_status` varchar(50) NOT NULL,
  `pay_amount` decimal(6,2) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_method` varchar(70) NOT NULL,
  `comm_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physique`
--

CREATE TABLE `physique` (
  `game_type` varchar(70) NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `physique`
--

INSERT INTO `physique` (`game_type`, `game_id`) VALUES
('physique', 7),
('physique', 8),
('physique', 9),
('physique', 10),
('physique', 12),
('physique', 13),
('physique', 14);

-- --------------------------------------------------------

--
-- Table structure for table `possede`
--

CREATE TABLE `possede` (
  `coll_name` varchar(120) NOT NULL,
  `date_modif` date NOT NULL,
  `date_creation` date NOT NULL,
  `user_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `possede`
--

INSERT INTO `possede` (`coll_name`, `date_modif`, `date_creation`, `user_name`) VALUES
('Collection de djamel', '2023-09-15', '2023-09-15', 'djamel'),
('Collection de user1', '2023-09-16', '2023-09-16', 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `propose_une_vente`
--

CREATE TABLE `propose_une_vente` (
  `game_id` int NOT NULL,
  `sell_date` date NOT NULL,
  `sell_price` decimal(6,2) NOT NULL,
  `user_name` varchar(70) NOT NULL,
  `sell_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `propose_une_vente`
--

INSERT INTO `propose_une_vente` (`game_id`, `sell_date`, `sell_price`, `user_name`, `sell_id`) VALUES
(3, '2023-08-16', '20.00', 'djamel', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int NOT NULL,
  `tag_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'aventure'),
(9, 'Do est laudantium'),
(14, 'Nulla qui sit sed e'),
(11, 'Perspiciatis conseq'),
(8, 'Quibusdam sequi null'),
(13, 'ROBOT'),
(7, 'Sit est ut ad est'),
(2, 'tag1'),
(12, 'TIR'),
(10, 'Voluptate ut minim v');

-- --------------------------------------------------------

--
-- Table structure for table `usercollection`
--

CREATE TABLE `usercollection` (
  `coll_name` varchar(120) NOT NULL,
  `coll_desc` varchar(500) NOT NULL,
  `coll_keywords` varchar(250) NOT NULL,
  `coll_rate` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usercollection`
--

INSERT INTO `usercollection` (`coll_name`, `coll_desc`, `coll_keywords`, `coll_rate`) VALUES
('Collection de djamel', 'Insérez ici votre description', 'Mots clés de votre collection', '1'),
('Collection de user1', 'Insérez ici votre description', 'Mots clés de votre collection', '1');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `user_name` varchar(70) NOT NULL,
  `user_mail` varchar(120) NOT NULL,
  `user_nickname` varchar(70) NOT NULL,
  `user_pwd` varchar(120) NOT NULL,
  `user_prenom` varchar(70) NOT NULL,
  `user_birthdate` date NOT NULL,
  `user_description` varchar(70) NOT NULL,
  `user_picture` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`user_name`, `user_mail`, `user_nickname`, `user_pwd`, `user_prenom`, `user_birthdate`, `user_description`, `user_picture`) VALUES
('djamel', 'tydakapyd@mailinator.com', 'Djamel123', '$2y$10$rXv3rxBFklirTMnP8CyJaeWeLvGqEETMN139lkwb0R9K3WKA0l83.', 'DjamelXD', '1992-08-01', 'awwfef', '0'),
('user1', 'womyvol@mailinator.com', 'Pandora Kerr', '$2y$10$KTFro8N.QI4acIw1afK/nuZJdWeI0NCozxjWqvUwjzxiAT027YLFG', 'Voluptate deserunt e', '1989-06-04', 'Minus quo ut ea sit', '1');

-- --------------------------------------------------------

--
-- Table structure for table `virtuel`
--

CREATE TABLE `virtuel` (
  `game_keys` text,
  `game_type` varchar(70) NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `virtuel`
--

INSERT INTO `virtuel` (`game_keys`, `game_type`, `game_id`) VALUES
('kkkk', 'virtuel', 3),
('4411', 'virtuel', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `compose`
--
ALTER TABLE `compose`
  ADD KEY `coll_name` (`coll_name`),
  ADD KEY `fk_compose_jeu` (`game_id`);

--
-- Indexes for table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `gametags`
--
ALTER TABLE `gametags`
  ADD PRIMARY KEY (`game_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `comm_id` (`comm_id`),
  ADD KEY `idx_game_title` (`game_title`);

--
-- Indexes for table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `comm_id` (`comm_id`);

--
-- Indexes for table `physique`
--
ALTER TABLE `physique`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `possede`
--
ALTER TABLE `possede`
  ADD PRIMARY KEY (`coll_name`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `propose_une_vente`
--
ALTER TABLE `propose_une_vente`
  ADD PRIMARY KEY (`sell_id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `usercollection`
--
ALTER TABLE `usercollection`
  ADD PRIMARY KEY (`coll_name`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`user_name`);

--
-- Indexes for table `virtuel`
--
ALTER TABLE `virtuel`
  ADD PRIMARY KEY (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `comm_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `console`
--
ALTER TABLE `console`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `etat`
--
ALTER TABLE `etat`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `pay_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `propose_une_vente`
--
ALTER TABLE `propose_une_vente`
  MODIFY `sell_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compose`
--
ALTER TABLE `compose`
  ADD CONSTRAINT `compose_ibfk_2` FOREIGN KEY (`coll_name`) REFERENCES `usercollection` (`coll_name`),
  ADD CONSTRAINT `fk_compose_jeu` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);

--
-- Constraints for table `console`
--
ALTER TABLE `console`
  ADD CONSTRAINT `console_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);

--
-- Constraints for table `etat`
--
ALTER TABLE `etat`
  ADD CONSTRAINT `etat_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);

--
-- Constraints for table `gametags`
--
ALTER TABLE `gametags`
  ADD CONSTRAINT `gametags_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `gametags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`comm_id`) REFERENCES `commande` (`comm_id`);

--
-- Constraints for table `physique`
--
ALTER TABLE `physique`
  ADD CONSTRAINT `physique_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);

--
-- Constraints for table `possede`
--
ALTER TABLE `possede`
  ADD CONSTRAINT `possede_ibfk_1` FOREIGN KEY (`coll_name`) REFERENCES `usercollection` (`coll_name`),
  ADD CONSTRAINT `possede_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `utilisateur` (`user_name`);

--
-- Constraints for table `propose_une_vente`
--
ALTER TABLE `propose_une_vente`
  ADD CONSTRAINT `propose_une_vente_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `utilisateur` (`user_name`),
  ADD CONSTRAINT `propose_une_vente_ibfk_3` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);

--
-- Constraints for table `virtuel`
--
ALTER TABLE `virtuel`
  ADD CONSTRAINT `virtuel_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
