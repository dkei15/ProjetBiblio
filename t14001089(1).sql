-- phpMyAdmin SQL Dump
-- version 3.3.7deb6
-- http://www.phpmyadmin.net
--
-- Host: dbs-perso.luminy.univmed.fr:3306
-- Generation Time: Apr 14, 2017 at 11:17 AM
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
-- Table structure for table `adherent`
--

CREATE TABLE IF NOT EXISTS `adherent` (
  `IdAdherent` int(11) NOT NULL AUTO_INCREMENT,
  `AdNom` varchar(25) NOT NULL,
  `AdAdresse` varchar(25) DEFAULT NULL,
  `AdAdhesion` date NOT NULL,
  `AdNaissance` date DEFAULT NULL,
  `AdTel` varchar(11) NOT NULL,
  `AdMail` varchar(25) NOT NULL,
  `AdPaiement` date NOT NULL,
  PRIMARY KEY (`IdAdherent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `adherent`
--

INSERT INTO `adherent` (`IdAdherent`, `AdNom`, `AdAdresse`, `AdAdhesion`, `AdNaissance`, `AdTel`, `AdMail`, `AdPaiement`) VALUES
(1, 'Pepito', '65 rue de la betonnerie', '0000-00-00', NULL, '04.56.10.22', 'alex@gmail.com', '0000-00-00'),
(2, 'Bose', '65 la concorde', '2017-03-28', '2002-03-13', '06.85.10.22', 'zdsqd@gmail.com', '2017-03-01'),
(3, 'Kadi', '74 rue Montmartre', '0000-00-00', NULL, '04.91.10.22', 'duhnrf@gmail.com', '0000-00-00'),
(4, 'Yoniman', '12 rue du berceau', '0000-00-00', NULL, '04.16.10.22', 'louffik@hotmail.com', '0000-00-00'),
(5, 'Uglyman', '81 stpierre', '0000-00-00', NULL, '04.78.10.22', 'garnier@efrg.fr', '0000-00-00'),
(6, 'Bertrand', '18 rue l’escalade', '0000-00-00', NULL, '06.56.10.22', 'durand@hotmail.fr', '0000-00-00'),
(7, 'Louiton', '65 rue de la betonnerie', '0000-00-00', NULL, '07.56.10.22', 'duhnrf@gmail.com', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `appartient`
--

CREATE TABLE IF NOT EXISTS `appartient` (
  `cote` int(11) NOT NULL,
  `id_Mot` int(11) NOT NULL,
  PRIMARY KEY (`cote`,`id_Mot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appartient`
--

INSERT INTO `appartient` (`cote`, `id_Mot`) VALUES
(49846251, 2),
(85474155, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Auteur`
--

CREATE TABLE IF NOT EXISTS `Auteur` (
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `NaisAuteur` date NOT NULL,
  `IdAuteur` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IdAuteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Auteur`
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


-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

CREATE TABLE IF NOT EXISTS `conference` (
  `nom` varchar(25) DEFAULT NULL,
  `conferencier` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conference`
--


-- --------------------------------------------------------

--
-- Table structure for table `editeur`
--

CREATE TABLE IF NOT EXISTS `editeur` (
  `IdEdit` int(11) NOT NULL AUTO_INCREMENT,
  `NomEdit` varchar(25) NOT NULL,
  PRIMARY KEY (`IdEdit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `editeur`
--


-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `NumEv` int(11) NOT NULL AUTO_INCREMENT,
  `DateEv` date NOT NULL,
  `LieuEv` varchar(25) NOT NULL,
  `CapaciteEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `evenement`
--


-- --------------------------------------------------------

--
-- Table structure for table `exemplaire`
--

CREATE TABLE IF NOT EXISTS `exemplaire` (
  `NumExmp` int(11) NOT NULL AUTO_INCREMENT,
  `cote` int(11) NOT NULL,
  `Prolongement` tinyint(1) NOT NULL,
  `EtatExmp` tinyint(1) DEFAULT NULL,
  `cote_oeuvre` int(11) DEFAULT NULL,
  `IdEdit` int(11) NOT NULL,
  `IdRa` int(11) NOT NULL,
  PRIMARY KEY (`NumExmp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `exemplaire`
--


-- --------------------------------------------------------

--
-- Table structure for table `exposition`
--

CREATE TABLE IF NOT EXISTS `exposition` (
  `nom` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exposition`
--


-- --------------------------------------------------------

--
-- Table structure for table `mot_clefs`
--

CREATE TABLE IF NOT EXISTS `mot_clefs` (
  `nom` varchar(25) NOT NULL,
  `id_Mot` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_Mot`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mot_clefs`
--

INSERT INTO `mot_clefs` (`nom`, `id_Mot`) VALUES
('Amour', 1),
('Homme', 2),
('Badine', 3),
('moderne', 4);

-- --------------------------------------------------------

--
-- Table structure for table `oeuvre`
--

CREATE TABLE IF NOT EXISTS `oeuvre` (
  `cote` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) DEFAULT NULL,
  `date_parution` date DEFAULT NULL,
  `TypeOeuvre` varchar(25) DEFAULT NULL,
  `PrixAchat` decimal(15,3) DEFAULT NULL,
  `DomOeuvre` varchar(25) DEFAULT NULL,
  `IdAuteur` int(11) NOT NULL,
  PRIMARY KEY (`cote`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2147483647 ;

--
-- Dumping data for table `oeuvre`
--

INSERT INTO `oeuvre` (`cote`, `titre`, `date_parution`, `TypeOeuvre`, `PrixAchat`, `DomOeuvre`, `IdAuteur`) VALUES
(445, 'grgrdg', '2014-04-19', 'Roman', '0.000', 'Littérature', 0),
(549482, 'Le dessin', '2017-03-14', 'Livre', NULL, 'Arts', 0),
(49846251, 'Homme moderne', '2005-07-18', 'Roman', NULL, 'Sociologie', 0),
(85474155, 'On ne badine pas amour', NULL, 'Science-fiction', NULL, 'Science', 0),
(2147483647, 'NAture morte', NULL, 'Magazine', NULL, 'Science', 0);

-- --------------------------------------------------------

--
-- Table structure for table `participe`
--

CREATE TABLE IF NOT EXISTS `participe` (
  `IdAdherent` int(11) NOT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`IdAdherent`,`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participe`
--


-- --------------------------------------------------------

--
-- Table structure for table `projection`
--

CREATE TABLE IF NOT EXISTS `projection` (
  `nom` varchar(25) DEFAULT NULL,
  `cote` int(11) NOT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projection`
--


-- --------------------------------------------------------

--
-- Table structure for table `rayon`
--

CREATE TABLE IF NOT EXISTS `rayon` (
  `IdRa` int(11) NOT NULL AUTO_INCREMENT,
  `domaineRa` varchar(25) NOT NULL,
  PRIMARY KEY (`IdRa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rayon`
--


-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE IF NOT EXISTS `reserve` (
  `DateReservation` date DEFAULT NULL,
  `cote` int(11) NOT NULL,
  `IdAdherent` int(11) NOT NULL,
  PRIMARY KEY (`cote`,`IdAdherent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserve`
--


-- --------------------------------------------------------

--
-- Table structure for table `spectacle`
--

CREATE TABLE IF NOT EXISTS `spectacle` (
  `nom` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spectacle`
--


-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `nom` varchar(25) NOT NULL,
  `id_Theme` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_Theme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `theme`
--

