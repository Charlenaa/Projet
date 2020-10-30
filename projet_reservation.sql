-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 30 oct. 2020 à 15:10
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_reservation`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_com` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `date_c` datetime DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `id`, `date_c`, `message`) VALUES
(1, 21, '2020-10-30 11:17:13', 'ghghghghgh'),
(5, 21, '2020-10-30 14:23:05', 'llklkllklkl');

-- --------------------------------------------------------

--
-- Structure de la table `creneau`
--

CREATE TABLE `creneau` (
  `Num_S` int(11) NOT NULL,
  `num_C` int(11) NOT NULL,
  `date_Debut` time NOT NULL,
  `date_Fin` time NOT NULL,
  `dateRes` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `creneau`
--

INSERT INTO `creneau` (`Num_S`, `num_C`, `date_Debut`, `date_Fin`, `dateRes`) VALUES
(1, 31, '00:17:48', '05:29:06', '2020-10-20'),
(1, 32, '09:26:47', '11:40:57', '2020-01-16'),
(1, 65, '07:49:28', '03:54:32', '2021-08-24'),
(1, 79, '05:55:08', '15:50:59', '2021-09-07'),
(2, 21, '14:00:00', '15:00:00', '2021-02-27'),
(2, 23, '07:44:02', '04:09:55', '2020-07-22'),
(2, 35, '00:26:41', '05:44:45', '2019-11-28'),
(2, 38, '10:49:25', '12:00:00', '2021-02-07'),
(2, 45, '02:44:38', '09:11:38', '2020-12-08'),
(2, 53, '02:24:22', '07:38:38', '2021-02-16'),
(2, 64, '05:11:30', '02:19:59', '2021-05-21'),
(2, 82, '01:27:53', '02:44:02', '2020-04-11'),
(3, 12, '04:06:51', '05:05:51', '2020-12-08'),
(3, 33, '15:34:58', '10:51:46', '2021-01-26'),
(3, 48, '19:41:02', '08:04:23', '2020-11-04'),
(3, 50, '01:34:49', '06:01:30', '2020-06-27'),
(3, 63, '02:43:54', '16:31:07', '2021-10-09'),
(4, 20, '01:27:39', '02:50:11', '2020-09-21'),
(4, 22, '08:51:47', '07:07:43', '2020-02-21'),
(4, 28, '12:02:40', '11:38:26', '2021-07-06'),
(4, 30, '14:55:46', '20:44:10', '2020-11-12'),
(4, 37, '19:29:43', '12:50:39', '2020-12-20'),
(4, 39, '05:59:07', '08:05:44', '2020-03-10'),
(4, 55, '10:19:36', '02:28:43', '2020-04-24'),
(4, 68, '10:21:38', '04:48:15', '2019-10-14'),
(4, 93, '03:33:21', '14:49:18', '2021-05-12'),
(5, 6, '04:56:29', '13:03:05', '2020-03-05'),
(5, 43, '05:18:27', '22:03:07', '2020-07-30'),
(5, 100, '13:01:50', '11:11:23', '2020-07-14'),
(6, 66, '19:21:07', '14:05:24', '2020-08-15'),
(7, 7, '23:49:59', '15:45:02', '2021-06-06'),
(7, 9, '08:03:45', '18:23:38', '2021-08-12'),
(7, 42, '09:14:53', '14:44:23', '2021-05-30'),
(7, 73, '20:18:43', '17:30:36', '2020-06-11'),
(7, 83, '18:31:16', '11:36:03', '2021-04-01'),
(7, 89, '11:01:52', '11:35:18', '2020-09-14'),
(7, 95, '12:46:23', '15:07:10', '2021-07-26'),
(8, 24, '10:47:05', '10:56:01', '2020-10-24'),
(8, 26, '23:23:41', '04:56:54', '2020-12-07'),
(8, 27, '18:02:43', '21:44:17', '2020-01-31'),
(8, 34, '09:09:06', '19:25:26', '2020-08-08'),
(8, 54, '07:48:04', '20:06:21', '2020-12-15'),
(8, 71, '05:28:00', '10:37:12', '2020-11-10'),
(8, 76, '06:11:31', '15:11:16', '2020-09-30'),
(8, 77, '20:02:34', '03:47:55', '2021-08-12'),
(8, 98, '03:10:32', '08:02:18', '2021-04-15'),
(9, 16, '22:01:19', '01:21:46', '2019-12-09'),
(9, 17, '16:21:39', '23:44:09', '2019-12-09'),
(9, 36, '04:10:07', '21:31:52', '2021-10-03'),
(9, 81, '08:19:08', '22:45:51', '2021-05-25'),
(10, 1, '02:08:15', '16:36:59', '2021-09-08'),
(10, 14, '17:23:15', '12:32:19', '2021-05-24'),
(10, 60, '19:09:19', '18:46:34', '2021-07-21'),
(10, 69, '05:41:03', '18:32:44', '2020-04-01'),
(10, 84, '07:34:56', '08:04:27', '2021-08-26'),
(11, 5, '04:06:28', '21:41:02', '2020-12-19'),
(11, 44, '05:24:00', '02:58:08', '2021-05-02'),
(11, 92, '01:35:00', '07:54:40', '2020-07-14'),
(12, 15, '17:59:23', '04:49:56', '2021-06-10'),
(12, 49, '22:24:46', '16:36:40', '2020-10-16'),
(12, 56, '23:16:59', '16:47:52', '2020-10-02'),
(12, 72, '00:33:08', '03:54:38', '2020-11-12'),
(13, 8, '02:59:08', '13:55:32', '2021-01-14'),
(13, 18, '15:12:17', '18:07:53', '2019-11-07'),
(13, 86, '16:55:59', '23:38:01', '2019-11-08'),
(14, 41, '05:24:20', '22:38:45', '2020-11-28'),
(14, 61, '00:41:35', '05:07:33', '2021-05-18'),
(14, 85, '23:06:45', '05:08:41', '2020-06-15'),
(14, 90, '01:46:50', '14:59:30', '2020-04-01'),
(15, 4, '05:56:17', '02:31:52', '2020-11-30'),
(15, 25, '22:56:48', '08:52:08', '2021-04-12'),
(15, 75, '18:04:07', '03:06:29', '2019-12-08'),
(16, 2, '01:31:51', '16:30:51', '2021-01-15'),
(16, 10, '23:07:00', '03:56:44', '2020-05-09'),
(16, 52, '08:55:12', '09:29:04', '2019-10-29'),
(16, 57, '06:49:12', '19:34:08', '2021-05-07'),
(16, 58, '00:06:48', '08:18:09', '2019-10-25'),
(16, 67, '18:16:19', '18:13:38', '2021-08-04'),
(16, 70, '09:01:59', '07:45:07', '2020-03-31'),
(16, 87, '01:00:16', '00:53:30', '2021-09-11'),
(16, 91, '15:44:11', '22:48:23', '2020-05-14'),
(16, 97, '11:23:26', '15:06:05', '2021-09-01'),
(17, 11, '00:37:27', '05:42:51', '2020-09-24'),
(17, 46, '17:35:11', '00:04:37', '2019-11-25'),
(17, 47, '02:46:14', '04:33:01', '2019-12-22'),
(18, 19, '17:31:19', '21:39:55', '2020-09-17'),
(18, 40, '04:34:35', '12:53:40', '2020-12-23'),
(18, 51, '08:20:07', '05:10:22', '2021-07-06'),
(18, 62, '13:26:22', '16:09:16', '2021-09-12'),
(18, 88, '14:05:59', '21:24:45', '2021-08-07'),
(18, 94, '03:31:53', '21:29:10', '2020-03-28'),
(18, 96, '01:59:54', '01:43:13', '2019-11-04'),
(19, 13, '01:14:46', '07:48:27', '2021-09-22'),
(19, 78, '17:50:12', '16:27:28', '2020-01-19'),
(20, 3, '10:30:26', '06:51:36', '2021-06-13'),
(20, 59, '04:34:05', '16:03:05', '2019-11-11'),
(20, 74, '22:11:52', '12:20:27', '2020-01-20'),
(20, 99, '07:45:54', '17:55:42', '2021-02-27');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(55) NOT NULL,
  `classe` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `droits` varchar(50) NOT NULL,
  `code_secret` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `email`, `classe`, `mdp`, `pseudo`, `droits`, `code_secret`) VALUES
(1, 'Cohen', 'Aladdin', '', 'I1', '$2y$10$6Af0xSVOOa/udVfRbTDmlOvowyLut4k1P9xzqfslyynUdkrJNe1Jy', 'Jordan', 'etudiant', 'd7903d98998eeb4ba331f3aaca75be42199bd516'),
(2, 'Walter', 'Lysandra', '', 'M2', '$2y$10$FeU2pLGUANaAqmU1gEosMOB4ZDUBdiHtGRB2QVd9u0ys2B4e0qZya', 'Bennett', 'etudiant', '1e101af85c97a93d27e1527c3e3eca83718df7aa'),
(3, 'Rutledge', 'Clinton', '', 'M2', '$2y$10$QsIP1Msp/DBXWJF5oKTo5e4lLxGeDjH0upiKx7S1jnnNjSQ7d5qUu', 'Landry', 'etudiant', '2cd13334a781b57002f3aa4b662e41098cf66083'),
(4, 'Brennan', 'Dora', '', 'I3', '$2y$10$fU4wonuSN25hAQROvrNNPuFidNPw7uS7nAy0PD451Q4ULCGhE2dIO', 'Cain', 'etudiant', 'eec9d02085ae4257bee56081845b351a2fe11110'),
(5, 'Pennington', 'Jelani', '', 'L3', '$2y$10$4sP0LZjnfF87/HCzEwABvOmWetNbjcoCPbGagl8MVx/W/47wdz4OC', 'Rodgers', 'etudiant', '1058465f7b3814be1d665acf30fea2022dab46b7'),
(6, 'Poole', 'Amela', '', 'CP1', '$2y$10$wdLF9q/VBmcfU2fAMd2ikui9qy53eaGuJPK80J/mEXh/S0O4RiFdC', 'Guerrero', 'etudiant', '68386ea7bce7e9d7baa3f2ba569974907367bfc8'),
(7, 'Curry', 'Daryl', '', 'L3', '$2y$10$FcaMfpV7E.OWIw/wTZqm7.zhV4.wT..Nnm2sJ3u5VdlRS5vfAkwSy', 'Austin', 'etudiant', 'd56e2cebf97cd2544669e4d22af823c3377ae22c'),
(8, 'Fitzpatrick', 'Alika', '', 'I3', '$2y$10$1aK1FIif/ijfof8hw099N.eICq0VbnaKTlXFSnICvGKRAJN5FvAHm', 'Sweet', 'etudiant', 'c7c357091918dabe8f046d85c222926a6662f39b'),
(9, 'Reese', 'Lev', '', 'I3', '$2y$10$vkAaVqnKRzr3dk5DneSuqOwYmIhKkJ8UOI/TlHycAU7B7NsL43lPy', 'Walters', 'etudiant', '2d1022d46ad8c10fe6c64755b5517a0d654712ca'),
(10, 'Rowe', 'Gil', '', 'L3', '$2y$10$QvAQ6LqBf21QWmuk5jcz7utgNEI5yg0dJ3mxyJ8R1RCnPGQdTpKI6', 'Molina', 'etudiant', '382fd223a8915e24bd77dddebf592462fd706135'),
(11, 'David', 'Deborah', '', 'M2', '$2y$10$IrouAGjUOIYN.bR7EJpmOueCLQAzapSBg6kGCDCzB8Laya14njU1O', 'Gallegos', 'etudiant', '593c6860500fba6cb2aa0af5dd76e7fbecccf2e2'),
(12, 'Bailey', 'Kai', '', 'I3', '$2y$10$BiaNq6dU4OsSTcNK5QXqKu43bxzHGP5/NVAG5MgF9/vRqz80c8fgW', 'Stevenson', 'etudiant', 'd7fcdd1239b83146ac63ce8f8cba609604db75ef'),
(13, 'Snyder', 'Palmer', '', 'I2', '$2y$10$WdcLuImQzvP868rAlFFKauxTyX0PXuCaa/.s.OFEEiyI1r3QJ8As6', 'Thompson', 'etudiant', 'f382662042a039da507346456f780dcd293fddbb'),
(14, 'Terry', 'Hyacinth', '', 'CP2', '$2y$10$m1iGhByk2VOrgOh71qfYHO0ip5Iv1KLNxzWze3EqusU.YM9cR5kEa', 'Baird', 'etudiant', '96959c4186132992e3e7e84e176b26590bfc798d'),
(15, 'Mack', 'Bell', '', 'CP1', '$2y$10$0nldldyUvDjxwPJhPMm3Guupk7QyQSvexNt8aWaVV1Arn8UpkLara', 'Kemp', 'etudiant', 'BAD-ACD-ZKA-XZB-YCR-DGF'),
(16, 'Morris', 'Wyatt', '', 'I2', '$2y$10$sSDLg1331Q0h6LPlOTcIxeb7nwdnfrGOX3lyP2pUY73j5tockOTP.', 'Miranda', 'etudiant', 'e556fe0a7070d4e06ec73a426f75856a3ff6c8d7'),
(17, 'Castro', 'Iris', '', 'M1', '$2y$10$QUFyL36cEHuCICNQa.TSIOcUXtdiiZ4.dbyXKptz/lRBVFFothIAK', 'Mclean', 'etudiant', '14bd6e1bcb2ba9e41e69a992baffb90c1f351686'),
(18, 'Rocha', 'Gregory', '', 'I1', '$2y$10$IOqjJ8QQqcBRmg71QKDPX.xwhxJ1vPVK6OFmtki.M.kOYte3x8lQO', 'Salinas', 'etudiant', 'a0bcfab49eb517fefcf27de716ef2d26931218c9'),
(19, 'Roach', 'Kirestin', '', 'CP1', 'BAD-ACD-ZKA-XZB-YCR-DGF', 'Barker', 'etudiant', '970f95e7908571212b8ca69de61e3932e245a38f'),
(20, 'Whitney', 'Troy', '', 'CP2', '$2y$10$1yqMi3fjYNZ6hh1gT15mruFZNie8XWMRznuRb7iDv1J4Ipmo.pdOG', 'Bell', 'etudiant', '47506c69a714850c993ead64817dee33589a0b97'),
(21, 'TAGNE', 'Leonel', 'admin@3il.fr', 'I1', '$2y$10$85hz/4VpT4zzDmI8tT1NWOW0vV8mChYqKJB94Lh/tppn7D5RLMu0.', 'admin', 'admin', '9dce8be5bc7a0d095fbbe40653feff13bece27c0');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_rep` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `date_c` datetime DEFAULT NULL,
  `message` text DEFAULT NULL,
  `id_com` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_rep`, `id`, `date_c`, `message`, `id_com`) VALUES
(7, 21, '2020-10-30 13:10:32', 'ok', 1),
(9, 21, '2020-10-30 14:22:51', 'kjkjkjkjh', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

CREATE TABLE `reserver` (
  `Num_S` int(11) NOT NULL,
  `num_C` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `dateRes` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reserver`
--

INSERT INTO `reserver` (`Num_S`, `num_C`, `id`, `dateRes`) VALUES
(1, 65, 1, '2021-08-24'),
(1, 79, 1, '2021-09-07');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `Num_S` int(11) NOT NULL,
  `Nbre_Place` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`Num_S`, `Nbre_Place`) VALUES
(1, 0),
(2, 15),
(3, 16),
(4, 8),
(5, 30),
(6, 13),
(7, 16),
(8, 3),
(9, 13),
(10, 26),
(11, 7),
(12, 9),
(13, 20),
(14, 27),
(15, 9),
(16, 26),
(17, 18),
(18, 1),
(19, 11),
(20, 25);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `creneau`
--
ALTER TABLE `creneau`
  ADD PRIMARY KEY (`Num_S`,`num_C`,`dateRes`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id_rep`),
  ADD KEY `id` (`id`),
  ADD KEY `id_com` (`id_com`);

--
-- Index pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD PRIMARY KEY (`Num_S`,`num_C`,`id`,`dateRes`),
  ADD KEY `Reserver_Creneau_FK` (`Num_S`,`num_C`,`dateRes`),
  ADD KEY `Reserver_Etudiant0_FK` (`id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`Num_S`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_rep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `Num_S` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `creneau`
--
ALTER TABLE `creneau`
  ADD CONSTRAINT `Creneau_Salle_FK` FOREIGN KEY (`Num_S`) REFERENCES `salle` (`Num_S`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`id`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`id_com`) REFERENCES `commentaire` (`id_com`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD CONSTRAINT `Reserver_Creneau_FK` FOREIGN KEY (`Num_S`,`num_C`,`dateRes`) REFERENCES `creneau` (`Num_S`, `num_C`, `dateRes`),
  ADD CONSTRAINT `Reserver_Etudiant0_FK` FOREIGN KEY (`id`) REFERENCES `etudiant` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
