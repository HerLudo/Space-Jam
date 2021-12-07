-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 27 nov. 2021 à 13:40
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `solarsystem`
--

-- --------------------------------------------------------

--
-- Structure de la table `planet`
--

CREATE TABLE `planet` (
  `id_planet` int(2) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `distance_soleil` varchar(200) NOT NULL,
  `position_soleil` int(2) NOT NULL,
  `rayon` decimal(65,2) NOT NULL,
  `masse` varchar(200) NOT NULL,
  `gravité` decimal(65,2) NOT NULL,
  `periode_orbitale` varchar(200) NOT NULL,
  `inclinaison` varchar(200) NOT NULL,
  `journee` varchar(200) NOT NULL,
  `nombre_satellite` int(2) DEFAULT NULL,
  `etymologie` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `planet`
--

INSERT INTO `planet` (`id_planet`, `nom`, `distance_soleil`, `position_soleil`, `rayon`, `masse`, `gravité`, `periode_orbitale`, `inclinaison`, `journee`, `nombre_satellite`, `etymologie`, `description`) VALUES
(1, 'Mercure', '57,91 millions de km', 1, '2439.70', '3,285 x 10^23 kg', '3.70', '88 jours', '7,00°', '58 jours 15 heures 30 minutes', 0, 'Mercurius, dans la mythologie romaine est le messager des dieux, il est très connu pour sa rapidité.', 'Mercure est la première planète du système solaire et la plus petites. C\'est une planète tellurique comme Venus, la Terre ou Mars. Elle est trois fois plus petite que la terre et vingt fois moins massique.');

-- --------------------------------------------------------

--
-- Structure de la table `satelitte`
--

CREATE TABLE `satelitte` (
  `id_satelitte` int(3) NOT NULL,
  `planet_id` int(3) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `distance_astre` float NOT NULL,
  `position_astre` int(3) NOT NULL,
  `rayon` float NOT NULL,
  `masse` varchar(200) NOT NULL,
  `gravite` varchar(200) NOT NULL,
  `periode_orbitale` float NOT NULL,
  `inclinaison` float NOT NULL,
  `journee` float NOT NULL,
  `etymologie` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `planet`
--
ALTER TABLE `planet`
  ADD PRIMARY KEY (`id_planet`);

--
-- Index pour la table `satelitte`
--
ALTER TABLE `satelitte`
  ADD PRIMARY KEY (`id_satelitte`),
  ADD KEY `lienplanet` (`planet_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `planet`
--
ALTER TABLE `planet`
  MODIFY `id_planet` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `satelitte`
--
ALTER TABLE `satelitte`
  MODIFY `id_satelitte` int(3) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `satelitte`
--
ALTER TABLE `satelitte`
  ADD CONSTRAINT `lienplanet` FOREIGN KEY (`planet_id`) REFERENCES `planet` (`id_planet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
