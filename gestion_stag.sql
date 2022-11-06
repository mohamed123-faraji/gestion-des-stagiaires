-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2022 at 08:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

drop database if exists gestion_stag;
create database if not exists gestion_stag;
use gestion_stag;

-- --------------------------------------------------------

--
-- Table structure for table `demande_stage`
--

CREATE TABLE `demande_stage` (
  `idDemande` int(4) NOT NULL,
  `idOffre` int(4) NOT NULL,
  `idUser` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `demande_stage`
--

INSERT INTO `demande_stage` (`idDemande`, `idOffre`, `idUser`) VALUES
(2, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `encadrants`
--

CREATE TABLE `encadrants` (
  `idEncadrant` int(4) NOT NULL,
  `nom` varchar(24) NOT NULL,
  `prenom` varchar(24) NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `telephone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encadrants`
--

INSERT INTO `encadrants` (`idEncadrant`, `nom`, `prenom`, `adresse`, `telephone`) VALUES
(1, 'balouki', 'youssef', 'SETTAT rue 13,boulvard HASSAN I', '0667565765');

-- --------------------------------------------------------

--
-- Table structure for table `etablissements`
--

CREATE TABLE `etablissements` (
  `idEtablissement` int(4) NOT NULL,
  `nomEtablissement` varchar(30) NOT NULL,
  `adresse` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etablissements`
--

INSERT INTO `etablissements` (`idEtablissement`, `nomEtablissement`, `adresse`) VALUES
(1, 'ENCG', 'SETTAT rue 13'),
(2, 'ENSA', 'caza rue 17');

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `idFiliere` int(4) NOT NULL,
  `nomFiliere` varchar(50) DEFAULT NULL,
  `niveau` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`idFiliere`, `nomFiliere`, `niveau`) VALUES
(8, 'informatique', 'M'),
(9, 'securiy', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `offre_stage`
--

CREATE TABLE `offre_stage` (
  `idOffre` int(4) NOT NULL,
  `sujet_stage` varchar(40) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `idFiliere` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offre_stage`
--

INSERT INTO `offre_stage` (`idOffre`, `sujet_stage`, `date_debut`, `date_fin`, `idFiliere`) VALUES
(5, 'application web gestion entreprise', '2022-08-25', '2022-08-30', 8),
(6, 'application mobile gestion entreprise', '2022-08-27', '2022-09-10', 8);

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `idStage` int(4) NOT NULL,
  `idEncadrant` int(4) NOT NULL,
  `idStagiaire` int(4) DEFAULT NULL,
  `idOffre` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`idStage`, `idEncadrant`, `idStagiaire`, `idOffre`) VALUES
(2, 1, 21, 5);

-- --------------------------------------------------------

--
-- Table structure for table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `idStagiaire` int(4) NOT NULL,
  `idEtablissement` int(4) DEFAULT NULL,
  `iduser` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stagiaire`
--

INSERT INTO `stagiaire` (`idStagiaire`, `idEtablissement`, `iduser`) VALUES
(21, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `iduser` int(4) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `etat` int(1) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `civilite` varchar(1) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `photo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`iduser`, `login`, `email`, `role`, `etat`, `pwd`, `civilite`, `prenom`, `photo`) VALUES
(1, 'admin', 'MOHMEDFARAJI5@GMAIL.COM', 'ADMIN', 1, '827ccb0eea8a706c4c34a16891f84e7b', 'M', 'admin', '20210714_175441~2.jpg'),
(2, 'Ibrahim', 'USER1@GMAIL.COM', 'VISITEUR', 1, '202cb962ac59075b964b07152d234b70', 'M', 'allaoui', 'daniel_samba.jpg'),
(6, 'brahim', 'BRAHIM@GMAIL.COM', 'VISITEUR', 1, '827ccb0eea8a706c4c34a16891f84e7b', 'F', '', 'Desert.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demande_stage`
--
ALTER TABLE `demande_stage`
  ADD PRIMARY KEY (`idDemande`),
  ADD KEY `idOffre` (`idOffre`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `encadrants`
--
ALTER TABLE `encadrants`
  ADD PRIMARY KEY (`idEncadrant`);

--
-- Indexes for table `etablissements`
--
ALTER TABLE `etablissements`
  ADD PRIMARY KEY (`idEtablissement`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`idFiliere`);

--
-- Indexes for table `offre_stage`
--
ALTER TABLE `offre_stage`
  ADD PRIMARY KEY (`idOffre`),
  ADD KEY `idFiliere` (`idFiliere`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`idStage`),
  ADD KEY `idStagiaire` (`idStagiaire`),
  ADD KEY `idEncadrant` (`idEncadrant`),
  ADD KEY `idOffre` (`idOffre`);

--
-- Indexes for table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`idStagiaire`),
  ADD KEY `idEtablissement` (`idEtablissement`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `demande_stage`
--
ALTER TABLE `demande_stage`
  MODIFY `idDemande` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `encadrants`
--
ALTER TABLE `encadrants`
  MODIFY `idEncadrant` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `etablissements`
--
ALTER TABLE `etablissements`
  MODIFY `idEtablissement` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `idFiliere` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offre_stage`
--
ALTER TABLE `offre_stage`
  MODIFY `idOffre` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `idStage` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `idStagiaire` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `iduser` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
