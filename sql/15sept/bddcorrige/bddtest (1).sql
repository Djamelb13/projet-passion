-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 15 sep. 2023 à 13:56
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bddtest`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
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
-- Structure de la table `compose`
--

CREATE TABLE `compose` (
  `coll_name` varchar(120) NOT NULL,
  `coll_date_add` date NOT NULL,
  `game_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `compose`
--

INSERT INTO `compose` (`coll_name`, `coll_date_add`, `game_id`) VALUES
('Collection de djamel', '2023-09-15', 3);

-- --------------------------------------------------------

--
-- Structure de la table `console`
--

CREATE TABLE `console` (
  `game_id` int NOT NULL,
  `platform` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `console`
--

INSERT INTO `console` (`game_id`, `platform`) VALUES
(3, 'XBOX');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `game_id` int NOT NULL,
  `game_condition` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`game_id`, `game_condition`) VALUES
(3, 'neuf');

-- --------------------------------------------------------

--
-- Structure de la table `gametags`
--

CREATE TABLE `gametags` (
  `game_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `gametags`
--

INSERT INTO `gametags` (`game_id`, `tag_id`) VALUES
(1, 1),
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
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
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`game_id`, `game_title`, `game_desc`, `game_img`, `game_date`, `comm_id`) VALUES
(1, 'abc', 'errgerg', 'eeee', '2023-08-16', NULL),
(3, 'superbe jeu', 'ergregerg', '../uploads/imgj/arcane-la-serie-netflix-inspiree-de-lol-aura-droit-a-une-saison-2jpeg-min.jpeg', '2023-09-15', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
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
-- Structure de la table `physique`
--

CREATE TABLE `physique` (
  `game_type` varchar(70) NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `physique`
--

INSERT INTO `physique` (`game_type`, `game_id`) VALUES
('physique', 3);

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

CREATE TABLE `possede` (
  `coll_name` varchar(120) NOT NULL,
  `date_modif` date NOT NULL,
  `date_creation` date NOT NULL,
  `user_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `possede`
--

INSERT INTO `possede` (`coll_name`, `date_modif`, `date_creation`, `user_name`) VALUES
('Collection de djamel', '2023-09-15', '2023-09-15', 'djamel');

-- --------------------------------------------------------

--
-- Structure de la table `propose_une_vente`
--

CREATE TABLE `propose_une_vente` (
  `sell_date` date NOT NULL,
  `sell_price` decimal(6,2) NOT NULL,
  `user_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int NOT NULL,
  `tag_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'aventure'),
(2, 'tag1');

-- --------------------------------------------------------

--
-- Structure de la table `usercollection`
--

CREATE TABLE `usercollection` (
  `coll_name` varchar(120) NOT NULL,
  `coll_desc` varchar(500) NOT NULL,
  `coll_keywords` varchar(250) NOT NULL,
  `coll_rate` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `usercollection`
--

INSERT INTO `usercollection` (`coll_name`, `coll_desc`, `coll_keywords`, `coll_rate`) VALUES
('Collection de djamel', 'Insérez ici votre description', 'Mots clés de votre collection', '1');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
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
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`user_name`, `user_mail`, `user_nickname`, `user_pwd`, `user_prenom`, `user_birthdate`, `user_description`, `user_picture`) VALUES
('djamel', 'tydakapyd@mailinator.com', 'Djamel123', '$2y$10$rXv3rxBFklirTMnP8CyJaeWeLvGqEETMN139lkwb0R9K3WKA0l83.', 'DjamelXD', '1992-08-01', 'awwfef', '0');

-- --------------------------------------------------------

--
-- Structure de la table `virtuel`
--

CREATE TABLE `virtuel` (
  `game_keys` text,
  `game_type` varchar(70) NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`comm_id`);

--
-- Index pour la table `compose`
--
ALTER TABLE `compose`
  ADD PRIMARY KEY (`coll_name`),
  ADD KEY `coll_name` (`coll_name`),
  ADD KEY `fk_compose_jeu` (`game_id`);

--
-- Index pour la table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`game_id`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`game_id`);

--
-- Index pour la table `gametags`
--
ALTER TABLE `gametags`
  ADD PRIMARY KEY (`game_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `comm_id` (`comm_id`),
  ADD KEY `idx_game_title` (`game_title`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `comm_id` (`comm_id`);

--
-- Index pour la table `physique`
--
ALTER TABLE `physique`
  ADD PRIMARY KEY (`game_id`);

--
-- Index pour la table `possede`
--
ALTER TABLE `possede`
  ADD PRIMARY KEY (`coll_name`),
  ADD KEY `user_name` (`user_name`);

--
-- Index pour la table `propose_une_vente`
--
ALTER TABLE `propose_une_vente`
  ADD KEY `user_name` (`user_name`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Index pour la table `usercollection`
--
ALTER TABLE `usercollection`
  ADD PRIMARY KEY (`coll_name`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`user_name`);

--
-- Index pour la table `virtuel`
--
ALTER TABLE `virtuel`
  ADD PRIMARY KEY (`game_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `comm_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `console`
--
ALTER TABLE `console`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `pay_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `compose`
--
ALTER TABLE `compose`
  ADD CONSTRAINT `compose_ibfk_2` FOREIGN KEY (`coll_name`) REFERENCES `usercollection` (`coll_name`),
  ADD CONSTRAINT `fk_compose_jeu` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);

--
-- Contraintes pour la table `console`
--
ALTER TABLE `console`
  ADD CONSTRAINT `console_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);

--
-- Contraintes pour la table `etat`
--
ALTER TABLE `etat`
  ADD CONSTRAINT `etat_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);

--
-- Contraintes pour la table `gametags`
--
ALTER TABLE `gametags`
  ADD CONSTRAINT `gametags_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `gametags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`comm_id`) REFERENCES `commande` (`comm_id`);

--
-- Contraintes pour la table `physique`
--
ALTER TABLE `physique`
  ADD CONSTRAINT `physique_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);

--
-- Contraintes pour la table `possede`
--
ALTER TABLE `possede`
  ADD CONSTRAINT `possede_ibfk_1` FOREIGN KEY (`coll_name`) REFERENCES `usercollection` (`coll_name`),
  ADD CONSTRAINT `possede_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `utilisateur` (`user_name`);

--
-- Contraintes pour la table `propose_une_vente`
--
ALTER TABLE `propose_une_vente`
  ADD CONSTRAINT `propose_une_vente_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `utilisateur` (`user_name`);

--
-- Contraintes pour la table `virtuel`
--
ALTER TABLE `virtuel`
  ADD CONSTRAINT `virtuel_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
