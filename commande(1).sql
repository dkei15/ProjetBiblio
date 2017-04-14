-- phpMyAdmin SQL Dump
-- version 3.3.7deb6
-- http://www.phpmyadmin.net
--
-- Host: dbs-perso.luminy.univmed.fr:3306
-- Generation Time: Apr 14, 2017 at 11:16 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-7+squeeze3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `t14001089`
--

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `dateCommnde` date DEFAULT NULL,
  `Commentaire` varchar(255) NOT NULL,
  `titreOeuvre` varchar(255) DEFAULT NULL,
  `cote` int(6) NOT NULL DEFAULT '0',
  `idAdhérent` int(123) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cote`,`idAdhérent`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commande`
--

