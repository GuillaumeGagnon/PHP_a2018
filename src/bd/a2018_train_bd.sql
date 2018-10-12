-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 12 Octobre 2018 à 03:38
-- Version du serveur :  5.6.37
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `a2018_train_bd`
--
CREATE DATABASE IF NOT EXISTS `a2018_train_bd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `a2018_train_bd`;

-- --------------------------------------------------------

--
-- Structure de la table `i18n`
--

DROP TABLE IF EXISTS `i18n`;
CREATE TABLE IF NOT EXISTS `i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `passengers`
--

DROP TABLE IF EXISTS `passengers`;
CREATE TABLE IF NOT EXISTS `passengers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `train_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `other` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `passengers`
--

INSERT INTO `passengers` (`id`, `user_id`, `train_id`, `name`, `address`, `phone`, `other`, `created`, `modified`) VALUES
(1, 19, 19, 'Guillaume Gagnon', '6720 Rue Rivière', '450-123-1234', 'test_member', '2018-10-12 02:21:57', '2018-10-12 02:21:57'),
(2, 18, 18, 'Guillaume Gagnon', '6720 Rue Rivière', '450-123-1234', 'test_admin', '2018-10-12 02:22:01', '2018-10-12 02:22:01'),
(3, 18, 19, 'Daniel Latour', '1234 Chemin De L''Échec', '012-345-6789', '', '2018-10-12 02:23:03', '2018-10-12 02:23:03'),
(4, 19, 20, 'Yévite L''Échec', '9876 Chemin De L''Échec', '987-654-3210', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', '2018-10-12 02:24:30', '2018-10-12 02:24:30');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(191) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(2, 'admin'),
(1, 'member');

-- --------------------------------------------------------

--
-- Structure de la table `stations`
--

DROP TABLE IF EXISTS `stations`;
CREATE TABLE IF NOT EXISTS `stations` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `type` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `stations`
--

INSERT INTO `stations` (`id`, `name`, `type`, `created`, `modified`) VALUES
(10, 'Cartier', 1, NULL, NULL),
(11, 'Rosemont', 1, NULL, '2018-10-12 02:01:11'),
(12, 'Valcartier', 3, NULL, NULL),
(16, 'test_civile', 1, '2018-10-12 01:51:58', '2018-10-12 01:51:58'),
(17, 'test_industrielle', 2, '2018-10-12 01:52:14', '2018-10-12 01:52:14'),
(18, 'test_militaire', 3, '2018-10-12 01:52:32', '2018-10-12 01:52:32'),
(19, 'test_', 1, '2018-10-12 01:59:35', '2018-10-12 01:59:47');

-- --------------------------------------------------------

--
-- Structure de la table `station_types`
--

DROP TABLE IF EXISTS `station_types`;
CREATE TABLE IF NOT EXISTS `station_types` (
  `id` int(11) NOT NULL,
  `type` varchar(191) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `station_types`
--

INSERT INTO `station_types` (`id`, `type`, `description`, `created`, `modified`) VALUES
(1, 'station_civile', 'Une station de train traditionnelle.', '2018-10-04 19:35:09', '2018-10-12 02:04:03'),
(2, 'station_industrielle', 'Une station de train destinée à l''acheminement de marchandises industrielles.', '2018-10-04 19:34:59', '2018-10-04 19:34:59'),
(3, 'station_militaire', 'Une station créée à des fins d''activités militaires.', '2018-10-04 19:35:20', '2018-10-04 19:35:20'),
(4, 'futur_station', 'Une station non-construite mais qui est prévue.', '2018-10-12 02:06:17', '2018-10-12 02:06:17');

-- --------------------------------------------------------

--
-- Structure de la table `trains`
--

DROP TABLE IF EXISTS `trains`;
CREATE TABLE IF NOT EXISTS `trains` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `origin_station` int(11) NOT NULL,
  `final_station` int(11) NOT NULL,
  `private` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `trains`
--

INSERT INTO `trains` (`id`, `name`, `origin_station`, `final_station`, `private`, `created`, `modified`) VALUES
(18, 'TGV', 10, 12, 0, '2018-10-12 02:19:40', '2018-10-12 02:19:40'),
(19, 'MailExpress', 12, 10, 1, '2018-10-12 02:20:04', '2018-10-12 02:20:04'),
(20, 'Royal_Mark_V', 11, 12, 1, '2018-10-12 02:20:47', '2018-10-12 02:20:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `role`, `password`, `created`, `modified`) VALUES
(6, 'admin@admin.com', 2, '$2y$10$Z8v3k4rjJTt.LDhuXqznh.gjoJvFfZcp/GVq5JgIEDHh3FajXHKfOÔÅÄ', NULL, NULL),
(12, '123@123.ru', 2, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, '2018-10-12 01:18:15'),
(13, 'admin@me.com', 1, '1234', '2018-10-11 23:37:09', '2018-10-11 23:37:09'),
(16, 'qwe@qwe.qwe', 1, '123', '2018-10-11 23:39:33', '2018-10-12 01:14:09'),
(17, 'ewq@ewq.com', 2, '123', '2018-10-11 23:40:10', '2018-10-12 01:13:45'),
(18, '123@admin.admin', 2, '$2y$10$6J4pnGptylXmSjtKplRt2uN8O8SUHSHPdEhsIuyDdnbbKe7svI59.', '2018-10-11 23:44:03', '2018-10-11 23:44:03'),
(19, 'gaguifire@hotmail.ca', 1, '$2y$10$ogK7ULUmq3ecvHVoGpMqdOoCUyB4GHgILAQQaqvdJZch8Jei56C2m', '2018-10-12 00:12:40', '2018-10-12 01:18:34'),
(24, '123@soleil.lune', 1, '$2y$10$4hIYwON8iJA.EWhaKGHyW.uNxy7tucwNvVoi6Udgv2Qpz/oPxWmPG', '2018-10-12 00:22:57', '2018-10-12 00:22:57'),
(28, 'dernier@test.pls', 1, '$2y$10$guG17yK50hM.zxVqIHQoL.22v3gAwNSNROmz8s.fZUna2YcPYVti6', '2018-10-12 00:44:31', '2018-10-12 00:44:31'),
(29, 'final_test_admin@efef.com', 2, '$2y$10$AdzJZyg55VwqipFQdxIchuC0V91Wj8nxUWBKELbwro/LK4BwX15yC', '2018-10-12 01:02:53', '2018-10-12 01:02:53'),
(30, 'final_test_member@efef.com', 1, '$2y$10$EI5hFRWvvJ6zRHdBEEZXXOvI/mvouPrOzLNtdZSn0ScDf8i7oxwYu', '2018-10-12 01:03:10', '2018-10-12 01:03:10'),
(31, 'test_new_logged_as_member@g.com', 1, '$2y$10$A/aImmEeu4SHpyUfnp9L.OX.yZyyTQhnhKMp6Czh.2SDes.dD2PUW', '2018-10-12 01:06:40', '2018-10-12 01:06:40'),
(32, 'test@123.com', 1, '$2y$10$xWPJ8Fi5REsOtTWu3FXyjORd5hzPCclJc8/ObRR6VgMx7ZQtcXeGe', '2018-10-12 01:20:32', '2018-10-12 01:20:32');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `i18n`
--
ALTER TABLE `i18n`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  ADD KEY `I18N_FIELD` (`model`,`foreign_key`,`field`);

--
-- Index pour la table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passengers_ibfk_1` (`train_id`),
  ADD KEY `passengers_ibfk_2` (`user_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Index pour la table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_stationType` (`type`);

--
-- Index pour la table `station_types`
--
ALTER TABLE `station_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Index pour la table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_station_orig` (`origin_station`),
  ADD KEY `fk_station_finale` (`final_station`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `i18n`
--
ALTER TABLE `i18n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `station_types`
--
ALTER TABLE `station_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `trains`
--
ALTER TABLE `trains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `passengers_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `trains` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `passengers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stations`
--
ALTER TABLE `stations`
  ADD CONSTRAINT `fk_stationType` FOREIGN KEY (`type`) REFERENCES `station_types` (`id`);

--
-- Contraintes pour la table `trains`
--
ALTER TABLE `trains`
  ADD CONSTRAINT `fk_station_finale` FOREIGN KEY (`final_station`) REFERENCES `stations` (`id`),
  ADD CONSTRAINT `fk_station_orig` FOREIGN KEY (`origin_station`) REFERENCES `stations` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
