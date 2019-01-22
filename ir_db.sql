-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 09 jan. 2019 à 10:41
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ir_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `idCours` int(11) NOT NULL,
  `nomCours` varchar(255) DEFAULT NULL,
  `detailsCours` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cours_enseigne`
--

CREATE TABLE `cours_enseigne` (
  `idCe` int(11) NOT NULL,
  `idPe` int(11) DEFAULT NULL,
  `idProf` int(11) DEFAULT NULL,
  `idCours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `idDep` int(11) NOT NULL,
  `nomDep` varchar(50) DEFAULT NULL,
  `idFac` int(11) DEFAULT NULL,
  `detailsDep` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `idEtd` int(11) NOT NULL,
  `matriculeEtd` varchar(45) DEFAULT NULL,
  `nomEtd` varchar(45) DEFAULT NULL,
  `postnomEtd` varchar(45) DEFAULT NULL,
  `prenomEtd` varchar(45) DEFAULT NULL,
  `emailEtd` varchar(45) DEFAULT NULL,
  `genreEtd` varchar(1) DEFAULT NULL,
  `pwdEtd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

CREATE TABLE `professeurs` (
  `idProf` int(11) NOT NULL,
  `matriculeProf` varchar(45) DEFAULT NULL,
  `nomProf` varchar(45) DEFAULT NULL,
  `postnomProf` varchar(45) DEFAULT NULL,
  `prenomProf` varchar(45) DEFAULT NULL,
  `emailProf` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `idPromo` int(11) NOT NULL,
  `nomPromo` varchar(45) DEFAULT NULL,
  `idDept` int(11) DEFAULT NULL,
  `detailsPromo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `promo_encours`
--

CREATE TABLE `promo_encours` (
  `idPe` int(11) NOT NULL,
  `idPromo` int(11) DEFAULT NULL,
  `idEtd` int(11) DEFAULT NULL,
  `annee` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `recours`
--

CREATE TABLE `recours` (
  `idRecours` int(11) NOT NULL,
  `idEtd` int(11) DEFAULT NULL,
  `dateRec` date DEFAULT NULL,
  `txtRecours` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resultat_cours`
--

CREATE TABLE `resultat_cours` (
  `idRc` int(11) NOT NULL,
  `idCe` int(11) DEFAULT NULL,
  `idEtd` int(11) DEFAULT NULL,
  `td` float DEFAULT NULL,
  `tp` float DEFAULT NULL,
  `interro` float DEFAULT NULL,
  `examen` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `verif_result`
--

CREATE TABLE `verif_result` (
  `idVr` int(11) NOT NULL,
  `idEtd` int(11) DEFAULT NULL,
  `dateConnexion` varchar(45) DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `nbV` int(11) DEFAULT NULL,
  `nbTele` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`idCours`);

--
-- Index pour la table `cours_enseigne`
--
ALTER TABLE `cours_enseigne`
  ADD PRIMARY KEY (`idCe`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`idDep`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`idEtd`);

--
-- Index pour la table `professeurs`
--
ALTER TABLE `professeurs`
  ADD PRIMARY KEY (`idProf`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`idPromo`);

--
-- Index pour la table `promo_encours`
--
ALTER TABLE `promo_encours`
  ADD PRIMARY KEY (`idPe`),
  ADD UNIQUE KEY `idx_promo_encours_idEtd` (`idEtd`),
  ADD UNIQUE KEY `idx_promo_encours_idPromo` (`idPromo`);

--
-- Index pour la table `recours`
--
ALTER TABLE `recours`
  ADD PRIMARY KEY (`idRecours`);

--
-- Index pour la table `resultat_cours`
--
ALTER TABLE `resultat_cours`
  ADD PRIMARY KEY (`idRc`);

--
-- Index pour la table `verif_result`
--
ALTER TABLE `verif_result`
  ADD PRIMARY KEY (`idVr`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idCours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cours_enseigne`
--
ALTER TABLE `cours_enseigne`
  MODIFY `idCe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `idDep` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `idEtd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `professeurs`
--
ALTER TABLE `professeurs`
  MODIFY `idProf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `idPromo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `promo_encours`
--
ALTER TABLE `promo_encours`
  MODIFY `idPe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recours`
--
ALTER TABLE `recours`
  MODIFY `idRecours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `resultat_cours`
--
ALTER TABLE `resultat_cours`
  MODIFY `idRc` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `promo_encours`
--
ALTER TABLE `promo_encours`
  ADD CONSTRAINT `promo_encours_ibfk_1` FOREIGN KEY (`idEtd`) REFERENCES `etudiant` (`idEtd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
