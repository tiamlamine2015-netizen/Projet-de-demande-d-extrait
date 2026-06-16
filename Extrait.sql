-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 15 avr. 2026 à 16:13
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Extrait`
--

-- --------------------------------------------------------

--
-- Structure de la table `Others`
--

CREATE TABLE `Others` (
  `identite_num` varchar(9) NOT NULL,
  `nom_complet` text NOT NULL,
  `born` date NOT NULL,
  `lieu` text NOT NULL,
  `sexe` text NOT NULL,
  `nom_pere` text NOT NULL,
  `nom_mere` text NOT NULL,
  `mairie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Others`
--

INSERT INTO `Others` (`identite_num`, `nom_complet`, `born`, `lieu`, `sexe`, `nom_pere`, `nom_mere`, `mairie`) VALUES
('000203203', 'Aby FALL', '2026-03-10', 'Sebikotane', 'Feminin', 'Ablaye FAll', 'Fanta Mboup', 'sacre-coeur'),
('000204204', 'Abdoulaye Seck', '2010-03-02', 'Sacre_coeur', 'Masculin', 'Ousmane Seck', 'Fatou Ndir', 'Sacre Coeur'),
('000205205', 'Awa Diouf', '2014-03-03', 'Sacre_coeur', 'Feminin', 'Modou Bousso Diouf', 'Arame gueye', 'Sacre_Coeur'),
('000206206', 'Zeynabou Niang', '2005-03-16', 'Sacre_coeur', 'Feminin', 'Alioune Niang', 'Ngoma Dieng', 'Sacre Coeur'),
('000207207', 'Fatima Gueye', '2017-05-13', 'Khar Yalla', 'Feminin', 'Abdou Gueye', 'Badiene Diallo', 'Sacre Coeur'),
('000209209', 'Malick Cisse', '2005-10-30', 'Guediawaye', 'Masculin', 'Alioune Cisse', 'Awa Mbalo', 'Sacre Coeur');

-- --------------------------------------------------------

--
-- Structure de la table `retrait`
--

CREATE TABLE `retrait` (
  `ID` int(11) NOT NULL,
  `nom_complet` text NOT NULL,
  `date_naissance` date NOT NULL,
  `localite` text NOT NULL,
  `sexe` text NOT NULL,
  `nom_pere` text NOT NULL,
  `nom_mere` text NOT NULL,
  `mairie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `retrait`
--

INSERT INTO `retrait` (`ID`, `nom_complet`, `date_naissance`, `localite`, `sexe`, `nom_pere`, `nom_mere`, `mairie`) VALUES
(1, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(2, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(3, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(4, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(5, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(6, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(7, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(8, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(9, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(10, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(11, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(12, 'Alssane Thiam', '2003-02-14', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(13, 'Ousmane Gueye', '2025-12-12', 'Rufisque', 'masculin', 'Ablaye Gueye', 'Astou Fall', 'sacre-coeur'),
(14, 'Ousmane Gueye', '2025-12-12', 'Rufisque', 'masculin', 'Ablaye Gueye', 'Astou Fall', 'sacre-coeur'),
(15, 'Alssane Thiam', '2025-06-13', 'Rufisque', 'masculin', 'ousmane Thiam', 'Amy gueye', 'sacre-coeur'),
(16, 'Alioune Gueye', '2025-02-12', 'guediawaye', 'masculin', 'Abdou Gueye', 'Assietou Fall', 'sacre-coeur'),
(17, 'Khadija Niang', '2025-02-14', 'Sebikotane', 'feminin', 'Abdou Niang', 'Fatou Seck', 'sacre-coeur'),
(18, 'Khadija Niang', '2025-02-14', 'Sebikotane', 'feminin', 'Abdou Niang', 'Fatou Seck', 'sacre-coeur'),
(19, 'Alssane Thiam', '2008-12-12', 'Rufisque', 'masculin', 'Youssou Thiam', 'Aminata Mbow', 'sacre-coeur'),
(20, 'FATOU DIONE', '2005-02-23', 'THIES', 'feminin', 'LAMINE', 'AMINA', 'sacre-coeur'),
(21, 'lamine thiam', '2003-02-14', 'Rufisque', 'masculin', 'Assane Thiam', 'Fatou Gueye', 'sacre-coeur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `retrait`
--
ALTER TABLE `retrait`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `retrait`
--
ALTER TABLE `retrait`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
