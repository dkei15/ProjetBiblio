-- phpMiniAdmin dump 1.9.170312
-- Datetime: 2017-04-26 17:35:06
-- Host: 
-- Database: biblio

/*!40030 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

DROP TABLE IF EXISTS `Auteur`;
CREATE TABLE `Auteur` (
  `nomAuteur` varchar(25) NOT NULL,
  `prenomAuteur` varchar(25) NOT NULL,
  `IdAuteur` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IdAuteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `Auteur` DISABLE KEYS */;
/*!40000 ALTER TABLE `Auteur` ENABLE KEYS */;

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE `adherent` (
  `IdAdherent` int(11) NOT NULL AUTO_INCREMENT,
  `AdNom` varchar(25) NOT NULL,
  `AdAdresse` varchar(25) DEFAULT NULL,
  `AdAdhesion` date NOT NULL,
  `AdNaissance` date DEFAULT NULL,
  `AdTel` int(11) NOT NULL,
  `AdMail` varchar(25) NOT NULL,
  `AdPaiement` date NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `MotDePass` varchar(40) NOT NULL,
  PRIMARY KEY (`IdAdherent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `adherent` DISABLE KEYS */;
/*!40000 ALTER TABLE `adherent` ENABLE KEYS */;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `adminame` varchar(25) DEFAULT NULL,
  `AdmPrenom` varchar(25) DEFAULT NULL,
  `AdmNom` varchar(25) DEFAULT NULL,
  `AdmMail` varchar(25) DEFAULT NULL,
  `IdAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `MotDePass` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`IdAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

DROP TABLE IF EXISTS `appartient`;
CREATE TABLE `appartient` (
  `cote` int(11) NOT NULL,
  `id_Mot` int(11) NOT NULL,
  PRIMARY KEY (`cote`,`id_Mot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `appartient` DISABLE KEYS */;
/*!40000 ALTER TABLE `appartient` ENABLE KEYS */;

DROP TABLE IF EXISTS `conference`;
CREATE TABLE `conference` (
  `nom` varchar(25) DEFAULT NULL,
  `conferencier` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `conference` DISABLE KEYS */;
/*!40000 ALTER TABLE `conference` ENABLE KEYS */;

DROP TABLE IF EXISTS `editeur`;
CREATE TABLE `editeur` (
  `IdEdit` int(11) NOT NULL AUTO_INCREMENT,
  `NomEdit` varchar(25) NOT NULL,
  PRIMARY KEY (`IdEdit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `editeur` DISABLE KEYS */;
/*!40000 ALTER TABLE `editeur` ENABLE KEYS */;

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE `evenement` (
  `NumEv` int(11) NOT NULL AUTO_INCREMENT,
  `DateEv` date NOT NULL,
  `LieuEv` varchar(25) NOT NULL,
  `CapaciteEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `evenement` DISABLE KEYS */;
/*!40000 ALTER TABLE `evenement` ENABLE KEYS */;

DROP TABLE IF EXISTS `exemplaire`;
CREATE TABLE `exemplaire` (
  `NumExmp` int(11) NOT NULL AUTO_INCREMENT,
  `Prolongement` tinyint(1) NOT NULL,
  `EtatExmp` tinyint(1) DEFAULT NULL,
  `DateRetour` date DEFAULT NULL,
  `cote` int(11) DEFAULT NULL,
  `IdEdit` int(11) NOT NULL,
  `IdRa` int(11) NOT NULL,
  `dateEmprunt` date NOT NULL,
  `IdAdherent` int(11) NOT NULL,
  PRIMARY KEY (`NumExmp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `exemplaire` DISABLE KEYS */;
/*!40000 ALTER TABLE `exemplaire` ENABLE KEYS */;

DROP TABLE IF EXISTS `exposition`;
CREATE TABLE `exposition` (
  `nom` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `exposition` DISABLE KEYS */;
/*!40000 ALTER TABLE `exposition` ENABLE KEYS */;

DROP TABLE IF EXISTS `mot_clefs`;
CREATE TABLE `mot_clefs` (
  `nom` varchar(25) NOT NULL,
  `id_Mot` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_Mot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `mot_clefs` DISABLE KEYS */;
/*!40000 ALTER TABLE `mot_clefs` ENABLE KEYS */;

DROP TABLE IF EXISTS `oeuvre`;
CREATE TABLE `oeuvre` (
  `cote` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) DEFAULT NULL,
  `date_parution` date DEFAULT NULL,
  `TypeOeuvre` varchar(25) DEFAULT NULL,
  `PrixAchat` decimal(15,3) DEFAULT NULL,
  `DomOeuvre` varchar(25) DEFAULT NULL,
  `IdAuteur` int(11) NOT NULL,
  PRIMARY KEY (`cote`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `oeuvre` DISABLE KEYS */;
/*!40000 ALTER TABLE `oeuvre` ENABLE KEYS */;

DROP TABLE IF EXISTS `participe`;
CREATE TABLE `participe` (
  `IdAdherent` int(11) NOT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`IdAdherent`,`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `participe` DISABLE KEYS */;
/*!40000 ALTER TABLE `participe` ENABLE KEYS */;

DROP TABLE IF EXISTS `projection`;
CREATE TABLE `projection` (
  `nom` varchar(25) DEFAULT NULL,
  `cote` int(11) NOT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `projection` DISABLE KEYS */;
/*!40000 ALTER TABLE `projection` ENABLE KEYS */;

DROP TABLE IF EXISTS `rayon`;
CREATE TABLE `rayon` (
  `IdRa` int(11) NOT NULL AUTO_INCREMENT,
  `domaineRa` varchar(25) NOT NULL,
  PRIMARY KEY (`IdRa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `rayon` DISABLE KEYS */;
/*!40000 ALTER TABLE `rayon` ENABLE KEYS */;

DROP TABLE IF EXISTS `reserve`;
CREATE TABLE `reserve` (
  `DateReservation` date DEFAULT NULL,
  `cote` int(11) NOT NULL,
  `IdAdherent` int(11) NOT NULL,
  PRIMARY KEY (`cote`,`IdAdherent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `reserve` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserve` ENABLE KEYS */;

DROP TABLE IF EXISTS `spectacle`;
CREATE TABLE `spectacle` (
  `nom` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL,
  PRIMARY KEY (`NumEv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `spectacle` DISABLE KEYS */;
/*!40000 ALTER TABLE `spectacle` ENABLE KEYS */;

DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `nom` varchar(25) NOT NULL,
  `id_Theme` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_Theme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;


-- phpMiniAdmin dump end
