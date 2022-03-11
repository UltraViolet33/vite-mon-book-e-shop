-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 mars 2022 à 10:26
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vitemonbookdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `idCategory` int(3) NOT NULL AUTO_INCREMENT,
  `nameCategory` varchar(20) NOT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

DROP TABLE IF EXISTS `command`;
CREATE TABLE IF NOT EXISTS `command` (
  `idCommand` int(3) NOT NULL AUTO_INCREMENT,
  `idUserCommand` int(3) DEFAULT NULL,
  `amountCommand` int(3) NOT NULL,
  `dateCommand` datetime NOT NULL,
  `stateCommand` enum('Commande en cours de traitement','Commande envoyée','Commande livrée') NOT NULL,
  PRIMARY KEY (`idCommand`),
  KEY `idUserCommand` (`idUserCommand`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `detailscommand`
--

DROP TABLE IF EXISTS `detailscommand`;
CREATE TABLE IF NOT EXISTS `detailscommand` (
  `idDetailsCommand` int(3) NOT NULL AUTO_INCREMENT,
  `idCommandDetailsCommand` int(3) DEFAULT NULL,
  `idProductDetailsCommand` int(3) DEFAULT NULL,
  `quantityDetailsCommand` int(3) NOT NULL,
  `priceDetailsCommand` int(3) NOT NULL,
  PRIMARY KEY (`idDetailsCommand`),
  KEY `idProductDetailsCommand` (`idProductDetailsCommand`),
  KEY `idCommandDetailsCommand` (`idCommandDetailsCommand`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `idMember` int(3) NOT NULL AUTO_INCREMENT,
  `pseudoMember` varchar(20) NOT NULL,
  `passwordMember` varchar(32) NOT NULL,
  `nameMember` varchar(20) NOT NULL,
  `firstMember` varchar(20) NOT NULL,
  `emailMember` varchar(50) NOT NULL,
  `cityMember` varchar(20) NOT NULL,
  `postalCodeMember` varchar(5) NOT NULL,
  `adressMember` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`idMember`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `idProduct` int(3) NOT NULL AUTO_INCREMENT,
  `nameProduct` varchar(100) NOT NULL,
  `descriptionProduct` text NOT NULL,
  `imageProduct` varchar(250) NOT NULL,
  `priceProduct` int(3) NOT NULL,
  `stockProduct` int(3) NOT NULL,
  `idCategoryProduct` int(3) NOT NULL,
  PRIMARY KEY (`idProduct`),
  KEY `idCategoryProduct` (`idCategoryProduct`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
