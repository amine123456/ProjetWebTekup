-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 23 jan. 2020 à 08:48
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `joblist`
--

-- --------------------------------------------------------

--
-- Structure de la table `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(55) COLLATE utf8_bin NOT NULL,
  `description` varchar(500) COLLATE utf8_bin NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `location` varchar(255) COLLATE utf8_bin NOT NULL,
  `workhours` varchar(55) COLLATE utf8_bin NOT NULL,
  `salaire` varchar(55) COLLATE utf8_bin NOT NULL,
  `Company` varchar(55) COLLATE utf8_bin NOT NULL,
  `experience` varchar(25) COLLATE utf8_bin NOT NULL,
  `contract` varchar(55) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `contacte` varchar(255) COLLATE utf8_bin NOT NULL,
  `publishdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Domaine` varchar(55) COLLATE utf8_bin NOT NULL,
  `auteur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auteur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `job`
--

INSERT INTO `job` (`id`, `titre`, `description`, `url`, `location`, `workhours`, `salaire`, `Company`, `experience`, `contract`, `image`, `contacte`, `publishdate`, `Domaine`, `auteur`) VALUES
(3, 'titre', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'www.google.com', 'zarzouna Bizerte', '5-7', '1500', 'google', '5-7', 'test@gmail.com', 'test.png', 'test@gmail.com', '2019-12-31 22:35:08', 'Domaine Informatique', 13),
(4, 'Designer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n', 'www.Microsoft.com', 'Tunis', '50', '2000', 'Microsoft', '2', 'CDI', '19799894885e0b2d6575def.png', 'test@gmail.com', '2019-12-31 12:13:41', 'Domaine Informatique', 13),
(5, 'Developpeur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'www.Apple.com', 'USA', '15', '1200', 'Apple', '5', 'Full-Time', '5284865365e0c7f95ab25b.png', 'apple@gmail.com', '2020-01-01 12:16:37', 'Domaine Informatique', 13),
(6, 'joi', 'oijoijoijoijoij', 'oijoij', '5', '5', '4', 'jio', '4', 'CDI', '4912831345e0c8099941d9.png', 'jioj', '2020-01-01 12:20:57', 'Domaine Informatique', 13);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Nom` char(55) COLLATE utf8_bin NOT NULL,
  `Prenom` char(55) COLLATE utf8_bin NOT NULL,
  `naissance` date NOT NULL,
  `email` varchar(55) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Nom`, `Prenom`, `naissance`, `email`, `id`, `password`) VALUES
('trabel', 'hamda', '1997-08-11', 'hamda@gmail.com', 1, '$2y$10$ZLLPZd7CdZ4DG/DYwAIgxOB1U1vKrAOupwXNDILcB1lp77RQnOpZW'),
('test', 'test', '2021-02-01', 'test@gmail.com', 13, '$2y$10$v8yuFFNbHc7eV2TIBwQEUeVn3oIXQULHHerV0bpxgE3vPdA2i27hm'),
('nomt', 'prenom', '2022-02-02', 'nom@gmail.com', 14, '$2y$10$HBGmUcTGGSOlcdtDKan2venRbjzjdiQl7RDZEom5GX5Rh3hq2CzA6');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`auteur`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
