-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 23 juin 2019 à 12:44
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
-- Base de données :  `braincards`
--

-- --------------------------------------------------------

--
-- Structure de la table `brainstorm`
--

DROP TABLE IF EXISTS `brainstorm`;
CREATE TABLE IF NOT EXISTS `brainstorm` (
  `BR_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - identifiant',
  `BR_code` int(11) NOT NULL COMMENT 'Code pour rejoindre le brainstorm',
  `BR_master_id` int(11) NOT NULL COMMENT 'FK - Master du brainstorm',
  `BR_etat` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'true si le brainstorm est en cours - false si archivé',
  `BR_titre` varchar(40) NOT NULL COMMENT 'Titre du brainstorm',
  `BR_description` varchar(140) NOT NULL COMMENT 'Description du brainstorm',
  `BR_nb_tours` int(2) NOT NULL DEFAULT '3' COMMENT 'Nombre d''échange de cards',
  `BR_timer_tour` int(4) NOT NULL DEFAULT '180' COMMENT 'Timer entre 2 échanges de cards',
  `BR_relecture_timer` int(4) NOT NULL DEFAULT '60' COMMENT 'Timer de relecture',
  PRIMARY KEY (`BR_id`),
  KEY `BR_master_id` (`BR_master_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `brainstorm`
--

INSERT INTO `brainstorm` (`BR_id`, `BR_code`, `BR_master_id`, `BR_etat`, `BR_titre`, `BR_description`, `BR_nb_tours`, `BR_timer_tour`, `BR_relecture_timer`) VALUES
(1, 1000, 1, 1, 'Premier brainsto', 'Brainsto de test', 3, 100, 100),
(2, 1001, 2, 0, 'bonjour', 'descritptionef', 1, 1000, 1000),
(3, 81197, 1, 1, 'Brainstorm from webstorm', 'Description', 3, 180, 60),
(4, 24274, 1, 1, 'coucou', 'deuxieme', 3, 180, 60);

-- --------------------------------------------------------

--
-- Structure de la table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `CARD_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - identifiant',
  `CARD_objet_html` text COMMENT 'Objet html de la card',
  `CARD_auteur_id` int(11) NOT NULL COMMENT 'FK - id de l''auteur de la carde',
  `CARD_brainsto_id` int(11) NOT NULL COMMENT 'FK - id du brainstorm associé à la card',
  PRIMARY KEY (`CARD_ID`),
  KEY `CARD_auteur_id` (`CARD_auteur_id`),
  KEY `CARD_brainsto_id` (`CARD_brainsto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `card`
--

INSERT INTO `card` (`CARD_ID`, `CARD_objet_html`, `CARD_auteur_id`, `CARD_brainsto_id`) VALUES
(1, 'Il faudrait essayer de faire du papier qui ne brule pas, ce serait trop bien pour les gens', 1, 2),
(2, 'Il faut absolument faire de l eau qui ne s evapore pas', 2, 1),
(3, '<h1>coucou</h1>', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `MSG_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - identifiant',
  `MSG_contenu` varchar(140) NOT NULL COMMENT 'Texte du message envoye',
  `MSG_auteur_id` int(11) NOT NULL COMMENT 'FK - auteur du message',
  `MSG_brainsto_id` int(11) NOT NULL COMMENT 'FK - brainstorm où le message a été posté',
  PRIMARY KEY (`MSG_id`),
  KEY `MSG_auteur_id` (`MSG_auteur_id`),
  KEY `MSG_brainsto_id` (`MSG_brainsto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`MSG_id`, `MSG_contenu`, `MSG_auteur_id`, `MSG_brainsto_id`) VALUES
(1, 'Trop bien ton idee Thomas !', 2, 1),
(2, 'Merci Max !', 1, 1),
(3, 'Bonjour Maximilien !', 1, 2),
(4, 'Salut Thomas !', 2, 2),
(5, 'Salut tout le monde !', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - identifiant',
  `USER_USERNAME` varchar(10) NOT NULL COMMENT 'Username de l''utilisateur',
  `USER_PASSWORD` varchar(16) NOT NULL COMMENT 'Password de l''utilisateur',
  `USER_READY` tinyint(1) DEFAULT '0' COMMENT 'true si l''utilisateur a cliqué sur prêt dans son lobby, false sinon (non connecté, pas prêt etc...)',
  `USER_BRAINSTO_COURANT_ID` int(11) DEFAULT NULL COMMENT 'FK - référence l''id du brainstorm si l''utilisateur est dans un lobby, NULL sinon',
  PRIMARY KEY (`USER_ID`),
  KEY `USER_BRAINSTO_COURANT_ID` (`USER_BRAINSTO_COURANT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`USER_ID`, `USER_USERNAME`, `USER_PASSWORD`, `USER_READY`, `USER_BRAINSTO_COURANT_ID`) VALUES
(1, 'ThomasBC', 'toto', 0, 1),
(2, 'Maximator', 'max', 0, 1),
(3, 'ajout', 'deux', 0, NULL),
(4, 'Yoyo', 'yoyo', 0, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `brainstorm`
--
ALTER TABLE `brainstorm`
  ADD CONSTRAINT `FK_BR_MASTER_ID` FOREIGN KEY (`BR_master_id`) REFERENCES `user` (`USER_ID`);

--
-- Contraintes pour la table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `FK_CARD_AUTEUR_ID` FOREIGN KEY (`CARD_auteur_id`) REFERENCES `user` (`USER_ID`),
  ADD CONSTRAINT `FK_CARD_BR_ID` FOREIGN KEY (`CARD_brainsto_id`) REFERENCES `brainstorm` (`BR_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_MSG_AUTEUR_ID` FOREIGN KEY (`MSG_auteur_id`) REFERENCES `user` (`USER_ID`),
  ADD CONSTRAINT `FK_MSG_BR_ID` FOREIGN KEY (`MSG_brainsto_id`) REFERENCES `brainstorm` (`BR_id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_BRAINSTO_COURANT` FOREIGN KEY (`USER_BRAINSTO_COURANT_ID`) REFERENCES `brainstorm` (`BR_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
