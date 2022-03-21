-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2022 at 06:21 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vitemonbookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idCategory` int(3) NOT NULL,
  `nameCategory` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE `command` (
  `idCommand` int(3) NOT NULL,
  `idUserCommand` int(3) DEFAULT NULL,
  `amountCommand` int(3) NOT NULL,
  `dateCommand` datetime NOT NULL,
  `stateCommand` varchar(280) NOT NULL DEFAULT 'En cours de traitement'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detailscommand`
--

CREATE TABLE `detailscommand` (
  `idDetailsCommand` int(3) NOT NULL,
  `idCommandDetailsCommand` int(3) DEFAULT NULL,
  `idProductDetailsCommand` int(3) DEFAULT NULL,
  `quantityDetailsCommand` int(3) NOT NULL,
  `priceDetailsCommand` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `idMember` int(3) NOT NULL,
  `pseudoMember` varchar(20) NOT NULL,
  `passwordMember` varchar(300) NOT NULL,
  `nameMember` varchar(20) NOT NULL,
  `firstnameMember` varchar(20) NOT NULL,
  `emailMember` varchar(50) NOT NULL,
  `cityMember` varchar(20) NOT NULL,
  `postalCodeMember` varchar(5) NOT NULL,
  `adressMember` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`idMember`, `pseudoMember`, `passwordMember`, `nameMember`, `firstnameMember`, `emailMember`, `cityMember`, `postalCodeMember`, `adressMember`, `isAdmin`) VALUES
(16, 'JohnDoe', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Doe', 'John', 'admin@gmail.com', 'Bourges', '18000', '55 Rue Charles de Gaulles', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idProduct` int(3) NOT NULL,
  `nameProduct` varchar(100) NOT NULL,
  `descriptionProduct` text NOT NULL,
  `imageProduct` varchar(250) NOT NULL,
  `priceProduct` int(3) NOT NULL,
  `stockProduct` int(3) NOT NULL,
  `idCategoryProduct` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`idCommand`),
  ADD KEY `idUserCommand` (`idUserCommand`);

--
-- Indexes for table `detailscommand`
--
ALTER TABLE `detailscommand`
  ADD PRIMARY KEY (`idDetailsCommand`),
  ADD KEY `idProductDetailsCommand` (`idProductDetailsCommand`),
  ADD KEY `idCommandDetailsCommand` (`idCommandDetailsCommand`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idMember`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `idCategoryProduct` (`idCategoryProduct`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `command`
--
ALTER TABLE `command`
  MODIFY `idCommand` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detailscommand`
--
ALTER TABLE `detailscommand`
  MODIFY `idDetailsCommand` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `idMember` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idProduct` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
