-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 21 juil. 2019 à 14:42
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id_auteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `bio` mediumtext NOT NULL,
  `date_de_naissance` datetime NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_auteur`),
  UNIQUE KEY `id_UNIQUE` (`id_auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id_auteur`, `nom`, `prenom`, `bio`, `date_de_naissance`, `photo`) VALUES
(1, 'vernes', 'jules', 'jules vernes', '1750-07-16 00:00:00', '.png'),
(2, 'zola', 'emile', 'emile zola', '1845-07-23 00:00:00', '.png'),
(3, 'robillard', 'anne', 'anne robillard', '1967-07-16 00:00:00', '.png'),
(4, 'Moliere', 'moliere', 'moliere', '1786-12-17 00:00:00', ''),
(5, 'sarkozy', 'nicolas', 'nicolas sarkozy', '1957-01-17 00:00:00', '.png'),
(6, 'allegre', 'laurent', 'kdeiui op', '2019-07-01 00:00:00', 'image/test.jpg'),
(7, 'Engels', 'jean', 'spécialisé dans les livres informatiques', '1988-01-03 00:00:00', 'image/no-profile.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `email`, `password`) VALUES
(3, 'maccione', 'aldo', 'champs elysee', 75200, 'tartenpion', 'aldo@dbmail.com', '147852'),
(4, 'Dauba', 'benoit', 'route d\'avignon', 84172, 'entraigues', 'benoit.dauba@webforce-code.fr', '123456'),
(6, 'Loursac', 'guilhem', 'rue de la republique', 84200, 'carpentras', 'loursac.guilhem@gmail.com', '789456'),
(9, 'allegre', 'roger', '80 allee de la resistance', 84170, 'MONTEUX', 'roger@aol.com', '456123'),
(12, 'Astor', 'joseph', 'montée du couchadou', 84210, 'pernes les fontaines', 'na2si@hotmail.fr', '7777'),
(13, 'allegre', 'laurent', '78allee de la resistance', 84170, 'MONTEUX-centre', 'laurent.allegre@dbmail.com', '111111'),
(14, 'Sirvent', 'ludovic', 'rue porte de monteux', 84500, 'mazan', 'ludovic.sirvent@orange.fr', '951753'),
(15, 'allegre', 'danielle', 'residence topia', 84200, 'carpentras', 'danielle@aol.com', '2541');

-- --------------------------------------------------------

--
-- Structure de la table `collection`
--

DROP TABLE IF EXISTS `collection`;
CREATE TABLE IF NOT EXISTS `collection` (
  `id_collection` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_collection`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `collection`
--

INSERT INTO `collection` (`id_collection`, `nom`) VALUES
(4, 'gallimard'),
(5, 'hachette'),
(6, 'Eyrolles');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_panier` int(11) NOT NULL,
  `date_commande` datetime NOT NULL,
  `status_commande` varchar(45) NOT NULL,
  `frais_port` decimal(3,2) NOT NULL,
  `livraison` varchar(45) NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `fk_commande_panier1_idx` (`id_panier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `format`
--

DROP TABLE IF EXISTS `format`;
CREATE TABLE IF NOT EXISTS `format` (
  `id_format` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_format`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `format`
--

INSERT INTO `format` (`id_format`, `nom`) VALUES
(1, 'kindle'),
(2, 'relier'),
(3, 'poche');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `nom`) VALUES
(1, 'littéraire'),
(2, 'fantastic'),
(3, 'aventure'),
(4, 'littérature'),
(5, 'cours');

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

DROP TABLE IF EXISTS `langue`;
CREATE TABLE IF NOT EXISTS `langue` (
  `id_langue` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_langue`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`id_langue`, `nom`) VALUES
(1, 'francais'),
(2, 'anglais');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_panier`
--

DROP TABLE IF EXISTS `ligne_panier`;
CREATE TABLE IF NOT EXISTS `ligne_panier` (
  `id_ligne_panier` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_panier` int(11) NOT NULL,
  PRIMARY KEY (`id_ligne_panier`),
  KEY `fk_ligne_panier_livre1_idx` (`id_livre`),
  KEY `fk_ligne_panier_panier1_idx` (`id_panier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id_livre` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `prix` decimal(7,2) NOT NULL,
  `note` decimal(7,2) DEFAULT '0.00',
  `nb_pages` int(11) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_collection` int(11) NOT NULL,
  `id_format` int(11) NOT NULL,
  `id_langue` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `resume` text NOT NULL,
  PRIMARY KEY (`id_livre`),
  KEY `id_auteur#_idx` (`id_auteur`),
  KEY `fk_livre_collection1_idx` (`id_collection`),
  KEY `fk_livre_format1_idx` (`id_format`),
  KEY `fk_livre_langue1_idx` (`id_langue`),
  KEY `fk_livre_genre1_idx` (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id_livre`, `titre`, `prix`, `note`, `nb_pages`, `annee`, `photo`, `id_auteur`, `id_collection`, `id_format`, `id_langue`, `id_genre`, `resume`) VALUES
(1, 'voyage au centre de la terre', '12.90', '5.00', 320, 1895, 'image/voyage.jpg', 1, 4, 2, 1, 2, 'Le professeur Lidenbrock est persuadé d\'avoir découvert le chemin qui mène au centre de la Terre. Accompagné de son neveu Axel, l\'impétueux géologue part en Islande. '),
(2, 'de la terre à la lune ', '14.80', '5.00', 380, 1865, 'image/de-la-terre.jpg', 1, 4, 2, 1, 2, 'A la fin de la guerre fédérale des états-Unis, les fanatiques artilleurs du Gun-Club (Club-Canon) de Baltimore sont bien désoeuvrés. Un beau jour, le président, Impey Barbicane, leur fait une proposition ...'),
(3, 'Vingt mille lieux sous les mers', '24.90', '5.50', 352, 1869, 'image/20-milles-lieux.jpg', 1, 4, 2, 1, 3, 'Un monstre marin, \" une chose énorme \", ayant été signalé par plusieurs navires à travers le monde, une expédition est organisée sur l\'Abraham Lincoln, frégate américaine, pour purger les mers de ce monstre inquiétant. '),
(4, 'l\'affaire dreyfus', '8.90', '3.50', 178, 1999, 'image/dreyfus.jpg', 2, 5, 1, 2, 1, 'Le 22 décembre 1894, un procès d\'État condamne un capitaine juif, alsacien, innocent de toute charge, pour crime de \" haute trahison \" (en faveur de l\'Allemagne). S\'ouvre, deux ans plus tard, une crise majeure de la République.'),
(5, 'la fortune des rougons', '13.55', '4.20', 250, 1986, 'image/la-fortune.jpg', 2, 5, 3, 1, 1, 'Médiocre marchand d\'huile à la retraite, Pierre Rougon, avec l\'aide de son fils Eugène et de son demi-frère Antoine Macquart, réussit à se faire passer pour un héros de la révolte de la Provence ...'),
(6, 'l\'argent', '7.60', '3.20', 185, 1999, 'image/argent.jpg', 2, 5, 3, 1, 1, 'Pénétrer la Bourse, cette \" caverne mystérieuse et béante, où se passent des choses auxquelles personne ne comprend rien \" : tel est l\'un des buts que se donne Zola en écrivant L\'Argent (1891). '),
(7, 'les chevaliers d\'emeraude tome 1', '14.50', '5.60', 326, 2001, 'image/chevaliers.jpg', 3, 4, 2, 1, 2, 'L\'Empereur Noir, Amecareth, a levé ses armées monstrueuses pour envahir les royaumes d\'Enkidiev. Bientôt, le continent subit les attaques féroces de ses dragons et hommes-insectes. Pourquoi mettre à feu et à sang les terres glacées de Shola..'),
(8, 'les chevaliers d\'emeraude tome 2', '12.90', '5.60', 320, 2002, 'image/chevalier-2.jpg', 3, 4, 2, 1, 2, 'Après des siècles de paix, les armées de l\'Empereur Noir Amecareth envahissent soudain les royaumes du continent d\'Enkidiev. Les Chevaliers d\'Emeraude doivent alors protéger Kira, l\'enfant magique...'),
(9, 'les chevaliers d\'emeraude tome 3', '12.90', '5.20', 325, 2003, 'image/chevalier-3.jpg', 3, 4, 2, 1, 2, 'Après des siècles de paix, les armées de l\'Empereur Noir Amecareth envahissent soudain les royaumes du continent d\'Enkidiev. Les Chevaliers d\'Émeraude doivent alors protéger Kira, l\'enfant magique '),
(10, 'le malade imaginaire', '14.50', '4.60', 255, 1980, 'image/malade-imaginaire.jpg', 4, 5, 1, 1, 4, 'Angélique et Cléante se sont promis l\'un à l\'autre... Argan, père autoritaire, en a décidé autrement : sa fille Angélique épousera un médecin'),
(11, 'les fourberies de scapin ', '7.90', '3.00', 129, 1984, 'image/fourberie.jpg', 4, 4, 3, 1, 4, 'Scapin, le valet italien, est fourbe. Il est menteur, voleur, hypocrite et perfide. Mais, à sa façon, il est aussi fidèle et courageux. Il lutte en permanence contre les injustices de son temps...'),
(12, 'les chevaliers d\'emeraude tome 4', '12.90', '5.60', 326, 2005, 'image/chevalier-4.jpg', 3, 4, 2, 1, 2, 'Après des siècles de paix, les armées de l\'Empereur Noir Amecareth envahissent soudain les royaumes du continent d\'Enkidiev. Les Chevaliers d\'Émeraude doivent alors protéger Kira'),
(13, 'le bourgeois gentilhomme', '14.75', '3.25', 266, 1999, 'image/bourgeois.jpg', 4, 5, 1, 2, 4, 'Infortuné Monsieur Jourdain, égaré par son absurde vanité, sa prétention, son snobisme dévorant. Moqué, berné, il s\'est livré à ses maîtres d\'armes'),
(14, 'l\'ile mystérieuse', '15.99', '4.20', 290, 1995, 'image/ile-mysterieuse.jpg', 1, 5, 3, 1, 3, 'Une île déserte, en plein océan Pacifique. Cinq naufragés américains organisent leur survie, accompagnés de leur chien Top...'),
(15, 'PHP 7: Cours et exercices', '29.90', '5.00', 586, 2017, 'image/php7.jpg', 7, 6, 2, 1, 5, 'Ce manuel d\'initiation vous conduira des premiers pas en PHP jusqu\'à la réalisation d\'un site Web dynamique complet interagissant avec une base de données MySQL ou SQLite .'),
(16, 'Votre première base de données avec MySQL', '13.50', '4.00', 195, 2011, 'image/Mysql.jpg', 7, 6, 3, 1, 5, 'si vous voulez construire un site réellement dynamique, capable d\'afficher à la volée des pages personnalisées à la demande de vos visiteurs, si vous souhaitez mettre votre catalogue de produit en ligne ...'),
(17, 'HTML5 et CSS3 - Maîtrisez les standards de la création de sites web', '29.90', '5.00', 288, 2017, 'image/html.jpg', 7, 6, 2, 1, 5, 'Ce livre sur le langage HTML5 (en version 5.2 au moment de l\'écriture) et les feuilles de styles CSS3, langages fondateurs dans la création de sites web, s\'adresse aux développeurs qui souhaitent disposer des connaissances...');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime NOT NULL,
  PRIMARY KEY (`id_panier`),
  KEY `fk_panier_client1_idx` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_panier1` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id_panier`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ligne_panier`
--
ALTER TABLE `ligne_panier`
  ADD CONSTRAINT `fk_ligne_panier_livre1` FOREIGN KEY (`id_livre`) REFERENCES `livre` (`id_livre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ligne_panier_panier1` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id_panier`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `fk_livre_collection1` FOREIGN KEY (`id_collection`) REFERENCES `collection` (`id_collection`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_livre_format1` FOREIGN KEY (`id_format`) REFERENCES `format` (`id_format`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_livre_genre1` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_livre_langue1` FOREIGN KEY (`id_langue`) REFERENCES `langue` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_auteur#` FOREIGN KEY (`id_auteur`) REFERENCES `auteur` (`id_auteur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `fk_panier_client1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
