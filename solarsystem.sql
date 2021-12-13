-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 déc. 2021 à 16:06
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
  `rayon` varchar(255) NOT NULL,
  `masse` varchar(200) NOT NULL,
  `gravite` varchar(255) NOT NULL,
  `periode_orbitale` varchar(200) NOT NULL,
  `inclinaison_ecliptique` varchar(200) NOT NULL,
  `journee` varchar(200) NOT NULL,
  `inclinaison_axe` varchar(250) NOT NULL,
  `nombre_satellite` int(2) DEFAULT NULL,
  `etymologie` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `planet`
--

INSERT INTO `planet` (`id_planet`, `nom`, `distance_soleil`, `position_soleil`, `rayon`, `masse`, `gravite`, `periode_orbitale`, `inclinaison_ecliptique`, `journee`, `inclinaison_axe`, `nombre_satellite`, `etymologie`, `description`) VALUES
(1, 'Mercure', '57,91 millions de km', 1, '2439.70', '3,285 x 10^23 kg', '3.70', '88 jours', '7,00°', '58 jours 15 heures 30 minutes', '', 0, 'Mercurius, dans la mythologie romaine est le messager des dieux, il est très connu pour sa rapidité.', 'Mercure est la première planète du système solaire et la plus petites. C\'est une planète tellurique comme Venus, la Terre ou Mars. Elle est trois fois plus petite que la terre et vingt fois moins massique.'),
(3, 'Vénus', '108 millions de km', 2, '6052 km', '4.867 x 10^24kg', '8.87 m/s²', '224.7 jours', '3,39471°', '243 jours', '177,36°', 0, 'Son nom vient de la déesse de l\\\'amour dans la mythologie romaine. ', 'Vénus est la deuxième planète du système solaire. C\\\'est une planète tellurique au même titre que Mercure, la Terre et Mars. Elle est parfois appelée planète sœur de la Terre car elle partage de nombreuses caractéristiques avec notre planète (composition, taille, proximité au soleil). '),
(4, 'La Terre', '149 597 887 km', 3, '6371 km', '5,9736 x 10^24 kg', '9,81m/s²', '365,25 jours', '0', '24h', '23,4366907752°', 1, 'Son nom vient du latin terra qui signifie \\&quot;la terre, le sol\\&quot;. ', 'La terre est la troisième planète du système solaire. C\\\'est une planète tellurique au même titre que Mercure, Venus et Mars. C\\\'est la planète ou nous vivons. C\\\'est la cinquième plus grande planète du système solaire, la plus grande des planète telluriques. A ce jour c\\\'est le seul objet céleste connu qui abrite de la vie. '),
(5, 'Mars', '227 944 000 km', 4, '3389,5 km', '6,4185 x 10^23 kg', '3,711 m/s²', '686,885 jours', '1,85°', '24,623h', '25,19°', 2, 'Son nom vient du dieu de la guerre dans la mythologie romaine. ', 'Mars est la quatrième planète du système solaire. C\\\'est la dernière planète tellurique du système solaire au même titre que Mercure, Venus et la Terre. Elle est surnommée la planète rouge. '),
(6, 'Jupiter', '778 340 000 km', 5, '69 911 km', '1,8986 x 10^27 kg', '24,796m/s²', '4 332,01 jours', '1,304°', '9h 55min 27s', '3,12°', 79, 'Son nom vient du roi des dieux de la mythologie romaine. ', 'Jupiter est la cinquième planète du système solaire. C\\\'est la plus grosse planète de notre système solaire.'),
(7, 'Saturne', '1 426 700 000 km', 6, '58 232 km', '5,684 x 10^26 kg', '10,44 m/s²', '10 754 jours', '2,486°', '10h 33min', '26,73°', 82, 'Saturne est le dieu romain de l\\\'agriculture. ', 'Saturne est la sixième planète du système solaire. C\\\'est la deuxième plus grosse planète de notre système solaire.'),
(8, 'Uranus', '2 870 700 000 km', 7, '25 362 km', '8,681 x 10^25 kg', '8,87 m/s²', '30 698 jours', '0,773°', '17h 14min', '97,8°', 27, 'Uranus dans la mythologie romaine est le dieu du ciel. ', 'Uranus est la septième planète du système solaire. '),
(9, 'Neptune', '4 498 400 000 km', 8, '24 622 km', '102,43 x 10^24 kg', '11,15 m/s²', '60 216,8 jours', '1,77°', '16h 6min ', '28,32°', 14, 'Neptune dans la mythologie romaine est le dieu de la mer et des océans. ', 'Neptune est la huitième et dernière planète du système solaire.');

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
  MODIFY `id_planet` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
