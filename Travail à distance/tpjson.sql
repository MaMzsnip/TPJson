-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 05 déc. 2022 à 14:23
-- Version du serveur :  10.5.6-MariaDB-1:10.5.6+maria~stretch
-- Version de PHP : 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tpjson`
--

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `numero` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `codepostal` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `numeroTelephone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Client`
--

INSERT INTO `Client` (`numero`, `nom`, `prenom`, `adresse`, `codepostal`, `ville`, `numeroTelephone`) VALUES
(1, 'Flagg', 'Berte', '5507 Kedzie Junction', '7005-724', 'São Manços', '5479989332'),
(2, 'Demoge', 'Ed', '91 Florence Place', '1120', 'Sydney', '1114750857'),
(3, 'Whorlton', 'Ettore', '5 Debra Terrace', '67961 CEDEX 9', 'Strasbourg', '3738382274'),
(4, 'Carlisi', 'Dacie', '624 Ridgeview Parkway', '16-433', 'Suwałki', '6241552683'),
(8, 'Rubinovici', 'Kaleb', '7 Jackson Way', '452189', 'Priyutovo', '4815254424'),
(10, 'Assel', 'Mikaela', '6557 Pennsylvania Court', '361215', 'Urozhaynoye', '6305339428'),
(14, 'Obispo', 'Kristofor', '572 Atwood Trail', '475038', 'Plato', '4225823841'),
(15, 'Geffe', 'Emilee', '05 La Follette Place', '184366', 'Baykalovo', '7543858747'),
(16, 'Hardesty', 'Farica', '7 Cody Way', '43210', 'Ban Bueng', '7357541161'),
(18, 'Cran', 'Rochester', '78941 Scofield Court', '911-0812', 'Ino', '7259565670'),
(20, 'Carnow', 'Noble', '5 Clyde Gallagher Pass', '38-116', 'Gwoźnica Górna', '6635886830'),
(23, 'Bartomeu', 'Saree', '1 Cody Drive', '3571', 'Lākshām', '8714725349'),
(24, 'Barks', 'Jonell', '7 Mallory Junction', '6543', 'Naval', '1536363378'),
(26, 'Roads', 'Haze', '3 Forest Road', '32-860', 'Czchów', '8081915327'),
(62, 'Quilliard', 'Yvan', '18 rue de la libération', '55800', 'Revigny', '0767537127');

-- --------------------------------------------------------

--
-- Structure de la table `Contenir`
--

CREATE TABLE `Contenir` (
  `reference` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Contenir`
--

INSERT INTO `Contenir` (`reference`, `numero`) VALUES
('4TE8', 1),
('ANYN', 2),
('AYMW', 3),
('BIVO', 4),
('EFIT', 5),
('KBOF', 6);

-- --------------------------------------------------------

--
-- Structure de la table `Facture`
--

CREATE TABLE `Facture` (
  `numero` int(11) NOT NULL,
  `date` date NOT NULL,
  `numero_Client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Facture`
--

INSERT INTO `Facture` (`numero`, `date`, `numero_Client`) VALUES
(1, '2022-11-22', 1),
(2, '2022-11-03', 2),
(3, '2022-11-08', 3),
(4, '2022-12-14', 4),
(5, '2022-12-28', 8),
(6, '2023-01-18', 10);

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `reference` varchar(100) NOT NULL,
  `libelle` varchar(1000) NOT NULL,
  `prixUnitaire` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`reference`, `libelle`, `prixUnitaire`) VALUES
('4TE8', 'Sloe Gin - Mcguinness', 49),
('ANYN', 'Melon - Watermelon Yellow', 39),
('AYMW', 'Gatorade - Cool Blue Raspberry', 55),
('BIVO', 'Wine - Wyndham Estate Bin 777', 1),
('EFIT', 'Sloe Gin - Mcguinness', 53),
('KBOF', 'Veal - Tenderloin, Untrimmed', 48),
('KGJT', 'Capers - Pickled', 3),
('KOKS', 'Beer - Mcauslan Apricot', 14),
('KSAA', 'Oil - Coconut', 10),
('LFRZ', 'Aromat Spice / Seasoning', 53),
('LSGL', 'Potatoes - Pei 10 Oz', 17),
('OPMP', 'Beef - Short Ribs', 60),
('SAWS', 'Wine - White, Gewurtzraminer', 98),
('SBMA', 'Beef - Ground, Extra Lean, Fresh', 10),
('SVCP', 'Juice - V8, Tomato', 88),
('SVHG', 'Pumpkin - Seed', 87),
('VGSD', 'Tart - Raisin And Pecan', 32),
('WAKQ', 'Cheese - Havarti, Salsa', 38),
('WMPR', 'Mini - Vol Au Vents', 39),
('YERL', 'Sage Derby', 85),
('YMUK', 'Soup Campbells Mexicali Tortilla', 5),
('ZPDL', 'Wine - Savigny - Les - Beaune', 18);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `Contenir`
--
ALTER TABLE `Contenir`
  ADD PRIMARY KEY (`reference`,`numero`),
  ADD KEY `Contenir_Facture0_FK` (`numero`);

--
-- Index pour la table `Facture`
--
ALTER TABLE `Facture`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `Facture_Client_FK` (`numero_Client`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`reference`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `Facture`
--
ALTER TABLE `Facture`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Contenir`
--
ALTER TABLE `Contenir`
  ADD CONSTRAINT `Contenir_Facture0_FK` FOREIGN KEY (`numero`) REFERENCES `Facture` (`numero`),
  ADD CONSTRAINT `Contenir_Produit_FK` FOREIGN KEY (`reference`) REFERENCES `Produit` (`reference`);

--
-- Contraintes pour la table `Facture`
--
ALTER TABLE `Facture`
  ADD CONSTRAINT `Facture_Client_FK` FOREIGN KEY (`numero_Client`) REFERENCES `Client` (`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
