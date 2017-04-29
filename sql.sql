-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 25 Avril 2017 à 10:07
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `biblio`
--
CREATE DATABASE IF NOT EXISTS `biblio` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `biblio`;

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE `adherent` (
  `IdAdherent` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `MotDePass` varchar(45) DEFAULT NULL,
  `AdPrenom` varchar(45) NOT NULL,
  `AdNom` varchar(45) NOT NULL,
  `AdMail` varchar(45) DEFAULT NULL,
  `AdAdresse` varchar(45) DEFAULT NULL,
  `AdPaiement` date DEFAULT NULL,
  `AdAdhesion` date DEFAULT NULL,
  `AdNaissance` date DEFAULT NULL,
  `AdTel` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `adminame` varchar(45) NOT NULL,
  `AdmPrenom` varchar(45) DEFAULT NULL,
  `AdmNom` varchar(45) DEFAULT NULL,
  `AdmMail` varchar(45) DEFAULT NULL,
  `IdAdmin` int(11) NOT NULL,
  `MotDePass` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`adminame`, `AdmPrenom`, `AdmNom`, `AdmMail`, `IdAdmin`, `MotDePass`) VALUES
('admin', 'admin', 'moustaine', 'moustaine-khadija@hotmail.fr', 1, 'khadijaja');

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `cote` int(11) NOT NULL,
  `id_Mot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `appartient`
--

INSERT INTO `appartient` (`cote`, `id_Mot`) VALUES
(123, 1),
(49846251, 2),
(85474155, 1);

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `nomAuteur` varchar(25) NOT NULL,
  `IdAuteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `dateCommnde` date DEFAULT NULL,
  `Commentaire` varchar(255) NOT NULL,
  `titreOeuvre` varchar(255) DEFAULT NULL,
  `cote` int(6) NOT NULL DEFAULT '0',
  `idAdhérent` int(123) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `conference`
--

CREATE TABLE `conference` (
  `nom` varchar(25) DEFAULT NULL,
  `conferencier` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
  `IdEdit` int(11) NOT NULL,
  `NomEdit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `NumEv` int(11) NOT NULL,
  `DateEv` date NOT NULL,
  `LieuEv` varchar(25) NOT NULL,
  `CapaciteEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `exemplaire`
--

CREATE TABLE `exemplaire` (
  `NumExmp` int(11) NOT NULL,
  `cote` int(11) NOT NULL,
  `Prolongement` tinyint(1) NOT NULL,
  `EtatExmp` tinyint(1) DEFAULT NULL,
  `cote_oeuvre` int(11) DEFAULT NULL,
  `IdEdit` int(11) NOT NULL,
  `IdRa` int(11) NOT NULL,
  `IdAdherent` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `exposition`
--

CREATE TABLE `exposition` (
  `nom` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mot_clefs`
--

CREATE TABLE `mot_clefs` (
  `nom` varchar(25) NOT NULL,
  `id_Mot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `mot_clefs`
--

INSERT INTO `mot_clefs` (`nom`, `id_Mot`) VALUES
('Amour', 1),
('Homme', 2),
('Badine', 3),
('moderne', 4);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre`
--

CREATE TABLE `oeuvre` (
  `cote` int(11) NOT NULL,
  `titre` varchar(25) DEFAULT NULL,
  `date_parution` date DEFAULT NULL,
  `TypeOeuvre` varchar(25) DEFAULT NULL,
  `PrixAchat` decimal(15,3) DEFAULT NULL,
  `DomOeuvre` varchar(25) DEFAULT NULL,
  `IdAuteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `oeuvre`
--

INSERT INTO `oeuvre` (`cote`, `titre`, `date_parution`, `TypeOeuvre`, `PrixAchat`, `DomOeuvre`, `IdAuteur`) VALUES
(122, 'mabano', NULL, 'DVD', NULL, NULL, 6),
(123, 'Amour', '2017-04-11', 'SOCIO', '45.000', 'S', 2),
(124, 'amrani', NULL, 'Periode', NULL, NULL, 6),
(234, 'DAIZJ', NULL, 'DVD', NULL, NULL, 8),
(1234, 'NINA', '1989-12-22', 'DVD', '8.000', 'Socio', 18),
(123456, 'HISTOIRE', NULL, 'Periode', NULL, NULL, 9),
(123456779, 'KHADIJA', NULL, 'DVD', NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `IdAdherent` int(11) NOT NULL,
  `NumEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projection`
--

CREATE TABLE `projection` (
  `nom` varchar(25) DEFAULT NULL,
  `cote` int(11) NOT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rayon`
--

CREATE TABLE `rayon` (
  `IdRa` int(11) NOT NULL,
  `domaineRa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reserve`
--

CREATE TABLE `reserve` (
  `DateReservation` date DEFAULT NULL,
  `cote` int(11) NOT NULL,
  `IdAdherent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `spectacle`
--

CREATE TABLE `spectacle` (
  `nom` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `NumEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `nom` varchar(25) NOT NULL,
  `id_Theme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`IdAdherent`,`username`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminame`,`IdAdmin`);

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`cote`,`id_Mot`);

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`IdAuteur`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`cote`,`idAdhérent`);

--
-- Index pour la table `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`NumEv`);

--
-- Index pour la table `editeur`
--
ALTER TABLE `editeur`
  ADD PRIMARY KEY (`IdEdit`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`NumEv`);

--
-- Index pour la table `exemplaire`
--
ALTER TABLE `exemplaire`
  ADD PRIMARY KEY (`NumExmp`);

--
-- Index pour la table `exposition`
--
ALTER TABLE `exposition`
  ADD PRIMARY KEY (`NumEv`);

--
-- Index pour la table `mot_clefs`
--
ALTER TABLE `mot_clefs`
  ADD PRIMARY KEY (`id_Mot`);

--
-- Index pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  ADD PRIMARY KEY (`cote`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`IdAdherent`,`NumEv`);

--
-- Index pour la table `projection`
--
ALTER TABLE `projection`
  ADD PRIMARY KEY (`NumEv`);

--
-- Index pour la table `rayon`
--
ALTER TABLE `rayon`
  ADD PRIMARY KEY (`IdRa`);

--
-- Index pour la table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`cote`,`IdAdherent`);

--
-- Index pour la table `spectacle`
--
ALTER TABLE `spectacle`
  ADD PRIMARY KEY (`NumEv`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id_Theme`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `IdAdherent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `IdAdmin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `IdAuteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
  MODIFY `IdEdit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `NumEv` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `exemplaire`
--
ALTER TABLE `exemplaire`
  MODIFY `NumExmp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `mot_clefs`
--
ALTER TABLE `mot_clefs`
  MODIFY `id_Mot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `oeuvre`
--
ALTER TABLE `oeuvre`
  MODIFY `cote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123456780;
--
-- AUTO_INCREMENT pour la table `rayon`
--
ALTER TABLE `rayon`
  MODIFY `IdRa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id_Theme` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
