-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 08 sep. 2023 à 07:31
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
-- Base de données : ` bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `comm_id` float NOT NULL,
  `comm_price` decimal(4,2) NOT NULL,
  `comm_status` varchar(50) NOT NULL,
  `comm_games` varchar(250) NOT NULL,
  `comm_statut` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `compose`
--

CREATE TABLE `compose` (
  `game_title` varchar(120) NOT NULL,
  `coll_name` varchar(120) NOT NULL,
  `coll_date_add` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `console`
--

CREATE TABLE `console` (
  `game_title` varchar(120) NOT NULL,
  `platform` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `console`
--

INSERT INTO `console` (`game_title`, `platform`) VALUES
('JEUDETEST', 'PS5'),
('MUCK', 'PC');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `game_title` varchar(120) NOT NULL,
  `game_condition` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`game_title`, `game_condition`) VALUES
('JEUDETEST', 'neuf'),
('MUCK', 'neuf');

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
(6, 1),
(97, 1),
(1, 2),
(2, 2),
(1, 3),
(6, 3),
(2, 4),
(6, 4),
(98, 4),
(2, 5),
(4, 6),
(7, 6),
(97, 6),
(4, 7),
(1, 8),
(7, 8),
(97, 16),
(98, 17);

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
  `comm_id` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`game_id`, `game_title`, `game_desc`, `game_img`, `game_date`, `comm_id`) VALUES
(1, 'Grand theft auto : 4', 'Grand Theft Auto IV (GTA 4) : Plongez dans un monde ouvert dynamique et immersif où vous incarnez un criminel cherchant fortune et survie dans les rues impitoyables de Liberty City.', 'gta4.jpg', '2023-08-16', NULL),
(2, 'Sekiro : Shadow Die', '\"Sekiro: Shadows Die Twice\" est un jeu d\'action-aventure se déroulant dans un Japon médiéval. Incarnez un shinobi et maîtrisez l\'art du combat au sabre tout en affrontant des ennemis redoutables pour sauver votre maître. Ce jeu est célèbre pour sa difficulté et son monde magnifiquement conçu.', 'sekiro.jpg', '2023-08-16', NULL),
(4, 'Starcraft : II', 'Un jeu de gestion de base et de stratégie en temps réel. Détruisez la base ennemie en récoltant des ressources.', 'starcraft.jpg', '2023-08-16', NULL),
(6, 'Pokemon : OR', 'Pokemon est un jeu de capture de pokemon', '../uploads/imgj/200px-Jaquette_Pokémon_Or.png', '2023-08-31', NULL),
(7, 'LEAGUE OF LEGENDS', 'UN JEU DE MERDE', '../uploads/imgj/Yuumi_1.jpg', '2023-08-31', NULL),
(97, 'MUCK', 'UNE TUERIE FRERE', '../uploads/imgj/capsule_616x353.jpg', '2023-09-06', NULL),
(98, 'JEUDETEST', 'UN SUPER BON JEU', '../uploads/imgj/cat-trolling1.jpg', '2023-09-07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `pay_id` float NOT NULL,
  `pay_status` varchar(50) NOT NULL,
  `pay_amount` decimal(4,2) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_method` varchar(70) NOT NULL,
  `comm_id` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `physique`
--

CREATE TABLE `physique` (
  `game_title` varchar(120) NOT NULL,
  `game_type` varchar(70) NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `physique`
--

INSERT INTO `physique` (`game_title`, `game_type`, `game_id`) VALUES
('JEUDETEST', 'physique', 98);

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

-- --------------------------------------------------------

--
-- Structure de la table `propose_une_vente`
--

CREATE TABLE `propose_une_vente` (
  `game_title` varchar(120) NOT NULL,
  `sell_date` date NOT NULL,
  `sell_price` decimal(6,2) NOT NULL,
  `user_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `propose_une_vente`
--

INSERT INTO `propose_une_vente` (`game_title`, `sell_date`, `sell_price`, `user_name`) VALUES
('Grand theft auto : 4', '2023-08-16', 20.00, 'djamel'),
('Sekiro : Shadow Die', '2023-08-01', 25.00, 'djamel'),
('Starcraft : II', '2023-08-10', 10.00, 'djamel');

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
(17, 'BAGARRE'),
(8, 'fps'),
(4, 'Jeu solo'),
(14, 'JEUUUUU'),
(2, 'monde ouvert'),
(6, 'Multijoueur'),
(5, 'Ninja'),
(3, 'rpg'),
(7, 'Stratégie'),
(16, 'survie'),
(10, 'test2'),
(15, 'Ut minima voluptatib');

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
('Antoine', 'bafuvan@mailinator.com', 'Janna Tanner', '1234', 'Ipsum commodi id ne', '1985-05-14', 'Atque doloribus nihi', '0'),
('djamel', 'djamel.b13@laposte.net', 'dja', '1234', 'mel', '1995-08-09', 'un grand gamer', ''),
('jigeka', 'temicoh@mailinator.com', 'Desirae Barnes', '12345', 'Consequatur ad cons', '1988-09-26', 'Enim voluptatem duci', '1'),
('MOHA', 'MOHAAAAAAAAA@HOTMAIL.FR', 'ZEROTWO', '1234', 'MOHA', '2013-12-07', 'UN GROS FER', '0'),
('serge', 'jeheho@mailinator.com', 'Cathleen Mathews', '1234', 'Quibusdam eius dicta', '2021-12-08', 'Amet esse quia et a', '0'),
('tifiqejota', 'bogunufypa@mailinator.com', 'Ifeoma Wallace', 'Pa$$w0rd!', 'Distinctio Id reici', '2019-12-04', 'In consequat Ex vol', '0');

-- --------------------------------------------------------

--
-- Structure de la table `virtuel`
--

CREATE TABLE `virtuel` (
  `game_title` varchar(120) NOT NULL,
  `game_keys` text,
  `game_type` varchar(70) NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `virtuel`
--

INSERT INTO `virtuel` (`game_title`, `game_keys`, `game_type`, `game_id`) VALUES
('MUCK', 'a', 'virtuel', 97);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`comm_id`),
  ADD UNIQUE KEY `UK_commande_comm_id` (`comm_id`);

--
-- Index pour la table `compose`
--
ALTER TABLE `compose`
  ADD PRIMARY KEY (`game_title`,`coll_name`),
  ADD UNIQUE KEY `UK_compose_game_title` (`game_title`),
  ADD KEY `FK_compose_collection` (`coll_name`);

--
-- Index pour la table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`game_title`),
  ADD UNIQUE KEY `UK_console_game_title` (`game_title`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`game_title`),
  ADD UNIQUE KEY `UK_etat_game_title` (`game_title`);

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
  ADD UNIQUE KEY `UK_jeu_game_title` (`game_title`),
  ADD KEY `FK_jeu_commande` (`comm_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`pay_id`),
  ADD UNIQUE KEY `UK_paiement_pay_id` (`pay_id`),
  ADD UNIQUE KEY `UK_paiement_comm_id` (`comm_id`);

--
-- Index pour la table `physique`
--
ALTER TABLE `physique`
  ADD PRIMARY KEY (`game_id`),
  ADD UNIQUE KEY `UK_Physique_game_title` (`game_title`);

--
-- Index pour la table `possede`
--
ALTER TABLE `possede`
  ADD PRIMARY KEY (`coll_name`),
  ADD UNIQUE KEY `UK_possede_coll_name` (`coll_name`),
  ADD KEY `FK_possede_utilisateur` (`user_name`);

--
-- Index pour la table `propose_une_vente`
--
ALTER TABLE `propose_une_vente`
  ADD PRIMARY KEY (`game_title`),
  ADD UNIQUE KEY `UK_propose_une_vente_game_title` (`game_title`),
  ADD KEY `FK_propose_une_vente_utilisateur` (`user_name`);

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
  ADD PRIMARY KEY (`coll_name`),
  ADD UNIQUE KEY `UK_collection_coll_name` (`coll_name`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`user_name`),
  ADD UNIQUE KEY `UK_utilisateur_user_name` (`user_name`);

--
-- Index pour la table `virtuel`
--
ALTER TABLE `virtuel`
  ADD PRIMARY KEY (`game_id`),
  ADD UNIQUE KEY `UK_virtuel_game_title` (`game_title`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT pour la table `physique`
--
ALTER TABLE `physique`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `virtuel`
--
ALTER TABLE `virtuel`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_commande_jeu` FOREIGN KEY (`comm_id`) REFERENCES `jeu` (`comm_id`);

--
-- Contraintes pour la table `compose`
--
ALTER TABLE `compose`
  ADD CONSTRAINT `FK_compose_collection` FOREIGN KEY (`coll_name`) REFERENCES `usercollection` (`coll_name`),
  ADD CONSTRAINT `FK_compose_game` FOREIGN KEY (`game_title`) REFERENCES `jeu` (`game_title`);

--
-- Contraintes pour la table `console`
--
ALTER TABLE `console`
  ADD CONSTRAINT `FK_console_game` FOREIGN KEY (`game_title`) REFERENCES `jeu` (`game_title`);

--
-- Contraintes pour la table `etat`
--
ALTER TABLE `etat`
  ADD CONSTRAINT `FK_etat_game` FOREIGN KEY (`game_title`) REFERENCES `jeu` (`game_title`);

--
-- Contraintes pour la table `gametags`
--
ALTER TABLE `gametags`
  ADD CONSTRAINT `gametags_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `gametags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);

--
-- Contraintes pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD CONSTRAINT `FK_jeu_commande` FOREIGN KEY (`comm_id`) REFERENCES `commande` (`comm_id`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `FK_paiement_commande` FOREIGN KEY (`comm_id`) REFERENCES `commande` (`comm_id`);

--
-- Contraintes pour la table `physique`
--
ALTER TABLE `physique`
  ADD CONSTRAINT `FK_Physique_game` FOREIGN KEY (`game_title`) REFERENCES `jeu` (`game_title`);

--
-- Contraintes pour la table `possede`
--
ALTER TABLE `possede`
  ADD CONSTRAINT `FK_possede_collection` FOREIGN KEY (`coll_name`) REFERENCES `usercollection` (`coll_name`),
  ADD CONSTRAINT `FK_possede_utilisateur` FOREIGN KEY (`user_name`) REFERENCES `utilisateur` (`user_name`);

--
-- Contraintes pour la table `propose_une_vente`
--
ALTER TABLE `propose_une_vente`
  ADD CONSTRAINT `FK_propose_une_vente_game` FOREIGN KEY (`game_title`) REFERENCES `jeu` (`game_title`),
  ADD CONSTRAINT `FK_propose_une_vente_utilisateur` FOREIGN KEY (`user_name`) REFERENCES `utilisateur` (`user_name`);

--
-- Contraintes pour la table `usercollection`
--
ALTER TABLE `usercollection`
  ADD CONSTRAINT `FK_collection_compose` FOREIGN KEY (`coll_name`) REFERENCES `compose` (`coll_name`),
  ADD CONSTRAINT `FK_collection_possede` FOREIGN KEY (`coll_name`) REFERENCES `possede` (`coll_name`);

--
-- Contraintes pour la table `virtuel`
--
ALTER TABLE `virtuel`
  ADD CONSTRAINT `FK_virtuel_game` FOREIGN KEY (`game_title`) REFERENCES `jeu` (`game_title`),
  ADD CONSTRAINT `fk_virtuel_jeu` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
