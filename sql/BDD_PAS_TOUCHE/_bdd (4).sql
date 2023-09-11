-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 11 sep. 2023 à 11:59
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
  `game_title` varchar(120) NOT NULL,
  `coll_name` varchar(120) NOT NULL,
  `coll_date_add` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `compose`
--

INSERT INTO `compose` (`game_title`, `coll_name`, `coll_date_add`) VALUES
('AMAZING GAME', 'Collection de user2', '2023-09-11'),
('Grand theft auto : 4', 'aaaa', '2023-09-06'),
('Grand theft auto : 4', 'NOM_DE_LA_NOUVELLE_COLLECTION', '2023-09-08'),
('JEUDETEST', 'aaaa', '2023-09-06'),
('MUCK', 'Collection de user2', '2023-09-06'),
('Pokemon : OR', 'Collection de THIERRY', '2023-09-07'),
('Sekiro : Shadow Die', 'Collection de THIERRY', '2023-09-01'),
('Starcraft : II', 'Collection de user2', '2023-09-06'),
('Voluptatem quod repu', 'aaaa', '2023-09-11');

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
('AMAZING GAME', 'Facere expedita volu'),
('Cupiditate nostrud i', 'Dolores laborum Rer'),
('Enim dolorem ipsum ', 'Fuga Eius iste iure'),
('JEUDETEST', 'PS5'),
('JEUUUUUUUU', 'Eveniet consectetur'),
('Minim iste omnis cil', 'Quia voluptatem dolo'),
('MONJEUAMOI', 'Sit illo et porro q'),
('MONSUPERJEU1', 'XBOB'),
('MUCK', 'PC'),
('Voluptatem quod repu', 'Voluptas facere exce');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `game_title` varchar(120) NOT NULL,
  `game_condition` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`game_title`, `game_condition`) VALUES
('AMAZING GAME', 'neuf'),
('Cupiditate nostrud i', 'neuf'),
('Enim dolorem ipsum ', 'casi-neuf'),
('JEUDETEST', 'neuf'),
('JEUUUUUUUU', 'casi-neuf'),
('Minim iste omnis cil', 'casi-neuf'),
('MONJEUAMOI', 'neuf'),
('MONSUPERJEU1', 'casi-neuf'),
('MUCK', 'neuf'),
('Voluptatem quod repu', 'neuf');

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
(124, 1),
(1, 2),
(2, 2),
(1, 3),
(6, 3),
(2, 4),
(6, 4),
(98, 4),
(99, 4),
(2, 5),
(4, 6),
(7, 6),
(97, 6),
(4, 7),
(1, 8),
(7, 8),
(106, 8),
(97, 16),
(98, 17),
(100, 17),
(119, 17),
(99, 18),
(100, 19),
(106, 25),
(119, 38),
(122, 41),
(123, 42),
(124, 43),
(125, 44);

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
(1, 'Grand theft auto : 4', 'Grand Theft Auto IV (GTA 4) : Plongez dans un monde ouvert dynamique et immersif où vous incarnez un criminel cherchant fortune et survie dans les rues impitoyables de Liberty City.', 'gta4.jpg', '2023-08-16', NULL),
(2, 'Sekiro : Shadow Die', 'Sekiro: Shadows Die Twice est un jeu d\'action-aventure se déroulant dans un Japon médiéval. Incarnez un shinobi et maîtrisez l\'art du combat au sabre tout en affrontant des ennemis redoutables pour sauver votre maître. Ce jeu est célèbre pour sa difficulté et son monde magnifiquement conçu.', 'sekiro.jpg', '2023-08-16', NULL),
(4, 'Starcraft : II', 'Un jeu de gestion de base et de stratégie en temps réel. Détruisez la base ennemie en récoltant des ressources.', 'starcraft.jpg', '2023-08-16', NULL),
(6, 'Pokemon : OR', 'Pokemon est un jeu de capture de pokemon', '../uploads/imgj/200px-Jaquette_Pokémon_Or.png', '2023-08-31', NULL),
(7, 'LEAGUE OF LEGENDS', 'UN JEU DE MERDE', '../uploads/imgj/Yuumi_1.jpg', '2023-08-31', NULL),
(97, 'MUCK', 'UNE TUERIE FRERE', '../uploads/imgj/capsule_616x353.jpg', '2023-09-06', NULL),
(98, 'JEUDETEST', 'UN SUPER BON JEU', '../uploads/imgj/cat-trolling1.jpg', '2023-09-07', NULL),
(99, 'MONSUPERJEU1', 'Aperiam ipsum volup', '../uploads/imgj/domenico-loia-EhTcC9sYXsw-unsplash.jpg', '2023-09-11', NULL),
(100, 'Cupiditate nostrud i', 'Et enim impedit pla', '../uploads/imgj/kalen-emsley-fUNTOGILNa0-unsplash.jpg', '2023-09-11', NULL),
(106, 'Minim iste omnis cil', 'Ipsa dolores quia q', '../uploads/imgj/cat-trolling1.png.jpg', '2023-09-11', NULL),
(119, 'Enim dolorem ipsum ', 'Nihil lorem in cumqu', '../uploads/imgj/macarons.png', '2023-09-11', NULL),
(122, 'JEUUUUUUUU', 'Ut commodi nihil und', '../uploads/imgj/115-1159115_minecraft-character-art-minecraft-characters-png-transparent-png.png', '2023-09-11', NULL),
(123, 'MONJEUAMOI', 'Recusandae Et maxim', '../uploads/imgj/arena_Meta-ShareImage.jpg', '2023-09-11', NULL),
(124, 'AMAZING GAME', 'Voluptatum quis reru', '../uploads/imgj/PoB63.PNG', '2023-09-11', NULL),
(125, 'Voluptatem quod repu', 'Sapiente consequuntu', '../uploads/imgj/raoul-droog-yMSecCHsIBc-unsplash.jpg', '2023-09-11', NULL);

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
  `game_title` varchar(120) NOT NULL,
  `game_type` varchar(70) NOT NULL,
  `game_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `physique`
--

INSERT INTO `physique` (`game_title`, `game_type`, `game_id`) VALUES
('AMAZING GAME', 'physique', 124),
('JEUDETEST', 'physique', 98),
('JEUUUUUUUU', 'physique', 122),
('Minim iste omnis cil', 'physique', 106);

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
('aaaa', '2023-09-01', '2023-09-07', 'djamel'),
('Collection de abc1', '2023-09-11', '2023-09-11', 'abc1'),
('Collection de abcd', '2023-09-11', '2023-09-11', 'abcd'),
('Collection de jeanmichel', '2023-09-08', '2023-09-08', 'jeanmichel'),
('Collection de jeanmichela', '2023-09-08', '2023-09-08', 'jeanmichela'),
('Collection de THIERRY', '2023-09-08', '2023-09-08', 'THIERRY'),
('Collection de user1', '2023-09-11', '2023-09-11', 'user1'),
('Collection de user2', '2023-09-11', '2023-09-11', 'user2'),
('NOM_DE_LA_NOUVELLE_COLLECTION', '2023-09-01', '2023-09-07', 'user1');

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
(41, 'aaaabbbb'),
(1, 'aventure'),
(17, 'BAGARRE'),
(8, 'fps'),
(42, 'In sed nostrud ipsam'),
(4, 'Jeu solo'),
(14, 'JEUUUUU'),
(2, 'monde ouvert'),
(6, 'Multijoueur'),
(5, 'Ninja'),
(19, 'Qui eaque veritatis'),
(44, 'Qui Nam ut nulla pla'),
(25, 'Quis iste ipsam id q'),
(38, 'Rerum eveniet dolor'),
(3, 'rpg'),
(7, 'Stratégie'),
(43, 'Sunt omnis recusanda'),
(16, 'survie'),
(18, 'tagtest'),
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

--
-- Déchargement des données de la table `usercollection`
--

INSERT INTO `usercollection` (`coll_name`, `coll_desc`, `coll_keywords`, `coll_rate`) VALUES
('aaaa', 'aaaa', 'aaa', '1'),
('Collection de abc1', 'Insérez ici votre description', 'Mots clés de votre collection', '1'),
('Collection de abcd', 'Insérez ici votre description', 'Mots clés de votre collection', '1'),
('Collection de jeanmichel', 'Insérez ici votre description', 'aoe', '1'),
('Collection de jeanmichela', 'Insérez ici votre description', 'aoe', '1'),
('Collection de THIERRY', 'Insérez ici votre description', 'Mots clés de votre collection', '1'),
('Collection de user1', 'Insérez ici votre description', 'Mots clés de votre collection', '1'),
('Collection de user2', 'Insérez ici votre description', 'Mots clés de votre collection', '1'),
('NOM_DE_LA_NOUVELLE_COLLECTION', 'Description de la nouvelle collection', 'Mots clés de la nouvelle collection', 'R');

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
('abc1', 'otjhrt@hot.fr', 'greg', '1234', 'gregory', '1991-02-01', 'un bon utilisateur', '0'),
('abcd', 'kiwaz@mailinator.com', 'Cleo Grimes', '1234', 'Iure inventore irure', '2021-08-18', 'Nesciunt aliquam ex', '0'),
('Antoine', 'bafuvan@mailinator.com', 'Janna Tanner', '1234', 'Ipsum commodi id ne', '1985-05-14', 'Atque doloribus nihi', '0'),
('djamel', 'djamel.b13@laposte.net', 'dja', '1234', 'mel', '1995-08-09', 'un grand gamer', ''),
('jeanmichel', 'LOL@lol.fr', 'ELCHAMPION', '1234', 'lulu', '1990-01-01', 'Parlez de vous...', '0'),
('jeanmichela', 'LOL@lol.fr', 'ELCHAMPION', '1234', 'lulu', '1990-01-01', 'Parlez de vous...', '0'),
('jigeka', 'temicoh@mailinator.com', 'Desirae Barnes', '12345', 'Consequatur ad cons', '1988-09-26', 'Enim voluptatem duci', '1'),
('MOHA', 'MOHAAAAAAAAA@HOTMAIL.FR', 'ZEROTWO', '1234', 'MOHA', '2013-12-07', 'UN GROS FER', '0'),
('serge', 'jeheho@mailinator.com', 'Cathleen Mathews', '1234', 'Quibusdam eius dicta', '2021-12-08', 'Amet esse quia et a', '0'),
('THIERRY', 'iohergg@hotmail.fr', 'lhermitte', '1234', 'THIERYLERMITE', '1992-08-01', 'XD', '0'),
('tifiqejota', 'bogunufypa@mailinator.com', 'Ifeoma Wallace', 'Pa$$w0rd!', 'Distinctio Id reici', '2019-12-04', 'In consequat Ex vol', '0'),
('user1', 'gikic@mailinator.com', 'Kiara Miranda', '1234', 'Id dolore saepe et ', '1988-06-22', 'Et labore odio non i', '0'),
('user2', 'syzawadod@mailinator.com', 'Cally Richards', '1234', 'Aut deserunt enim vo', '2016-08-26', 'Mollit sed voluptate', '0');

-- --------------------------------------------------------

--
-- Structure de la table `virtuel`
--

CREATE TABLE `virtuel` (
  `game_title` varchar(120) NOT NULL,
  `game_keys` text,
  `game_type` varchar(70) NOT NULL,
  `game_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `virtuel`
--

INSERT INTO `virtuel` (`game_title`, `game_keys`, `game_type`, `game_id`) VALUES
('Cupiditate nostrud i', '8586586', 'virtuel', 100),
('Enim dolorem ipsum ', 'aaaa', 'virtuel', 119),
('MONJEUAMOI', '868686', 'virtuel', 123),
('MONSUPERJEU1', 'KEY1, 86868', 'virtuel', 99),
('MUCK', 'a', 'virtuel', 97),
('Voluptatem quod repu', 'aaaaa', 'virtuel', 125);

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
  ADD PRIMARY KEY (`game_title`,`coll_name`),
  ADD KEY `coll_name` (`coll_name`);

--
-- Index pour la table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`game_title`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`game_title`);

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
  ADD PRIMARY KEY (`game_title`);

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
  ADD PRIMARY KEY (`game_title`),
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
  ADD PRIMARY KEY (`game_title`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `comm_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `game_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `pay_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `compose`
--
ALTER TABLE `compose`
  ADD CONSTRAINT `compose_ibfk_1` FOREIGN KEY (`game_title`) REFERENCES `jeu` (`game_title`),
  ADD CONSTRAINT `compose_ibfk_2` FOREIGN KEY (`coll_name`) REFERENCES `usercollection` (`coll_name`);

--
-- Contraintes pour la table `gametags`
--
ALTER TABLE `gametags`
  ADD CONSTRAINT `gametags_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `jeu` (`game_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `gametags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD CONSTRAINT `jeu_ibfk_1` FOREIGN KEY (`comm_id`) REFERENCES `commande` (`comm_id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`comm_id`) REFERENCES `commande` (`comm_id`);

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
  ADD CONSTRAINT `propose_une_vente_ibfk_1` FOREIGN KEY (`game_title`) REFERENCES `jeu` (`game_title`),
  ADD CONSTRAINT `propose_une_vente_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `utilisateur` (`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
