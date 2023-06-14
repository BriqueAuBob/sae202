-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 09 juin 2023 à 11:01
-- Version du serveur : 10.3.29-MariaDB-0+deb10u1
-- Version de PHP : 8.1.15

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae202`
--


--
-- Déchargement des données de la table `trips`
--

INSERT INTO `trips` (`id`, `departure_city`, `departure_address`, `departure_at`, `destination_city`, `destination_address`, `arrival_at`, `user_id`, `created_at`) VALUES
(1, 'Troyes', NULL, '2023-06-05 15:00:00', 'Romilly', NULL, '0000-00-00 00:00:00', 3, '2023-06-09 08:40:21'),
(2, 'Troyes', NULL, '2023-06-06 16:00:00', 'Bar sur Aube ', NULL, '0000-00-00 00:00:00', 4, '2023-06-09 08:41:41'),
(3, 'Troyes', NULL, '2023-06-12 17:00:00', 'Bar sur Aube', NULL, '0000-00-00 00:00:00', 4, '2023-06-09 08:45:24'),
(4, 'Troyes', NULL, '2023-06-06 14:00:00', 'Romilly', NULL, '0000-00-00 00:00:00', 3, '2023-06-09 08:49:13'),
(5, 'Troyes', NULL, '2023-06-07 05:30:00', 'Bar sur Aube', NULL, '0000-00-00 00:00:00', 4, '2023-06-09 08:52:22'),
(6, 'Troyes', NULL, '2023-06-05 15:00:00', 'La Chapelle Saint Luc', NULL, '0000-00-00 00:00:00', 7, '2023-06-09 08:55:11'),
(7, 'Bar sur Aube', NULL, '2023-06-14 18:00:00', 'Troyes', NULL, '0000-00-00 00:00:00', 4, '2023-06-09 08:56:27'),
(8, 'Romilly', NULL, '2023-06-13 13:00:00', 'Troyes', NULL, '0000-00-00 00:00:00', 3, '2023-06-09 08:57:59'),
(9, 'La Chapelle Saint Luc ', NULL, '2023-06-14 09:00:00', 'Troyes ', NULL, '0000-00-00 00:00:00', 7, '2023-06-09 08:58:41'),
(10, 'Troyes', NULL, '2023-06-21 18:00:00', 'Romilly', NULL, '0000-00-00 00:00:00', 3, '2023-06-09 08:59:13');

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `picture`, `email`, `password`, `status`, `created_at`) VALUES
(1, 'Lamaty', 'Cassandre', 'default.png', 'lamatycassandre@gmail.com', '$2y$10$igfZG3p/GgGg.feWcf0cqelkHV/W0U7CsGAbx9R4l4ftJC.c0vXZa', NULL, '2023-06-09 06:19:04'),
(2, 'Clément', 'Brandon', 'default.png', 'brandon.clement@etudiant.univ-reims.fr', '$2y$10$O117/BJ/lPEEa6kJMwGRWetDRlxTFbro5dL3FaxdjcEGfmMDylqSO', NULL, '2023-06-09 06:38:57'),
(3, 'Dylan', 'Bob', 'default.png', 'bob.dylan@etudiant.univ-reims.fr', 'fnezifizfienfifnc', NULL, '2023-06-09 08:28:10'),
(4, 'Lataupe', 'Réné', 'default.png', 'réné.lataupe@etudiant.univ-reims.fr', 'feofeof,eo', NULL, '2023-06-09 08:29:03'),
(5, 'Ochon', 'Paul', 'default.png', 'paul.ochon@etudiant.univ-reims.fr', 'fezifjoezjfde', NULL, '2023-06-09 08:29:35'),
(6, 'Suffy', 'Sam', 'default.png', 'sam.suffy@etudiant.univ-reims.fr', 'fezopjfdzipeofdj', NULL, '2023-06-09 08:30:17'),
(7, 'Point', 'Théo', 'default.png', 'théo.point@etudiant.univ-reims.fr', 'fzeofzeopf,zeopf', NULL, '2023-06-09 08:31:31'),
(8, 'Tag', 'Bill', 'default.png', 'bill.tag@etudiant.univ-reims.fr', 'fnzuhfiozehio', NULL, '2023-06-09 08:32:35'),
(9, 'Blink', 'Zack', 'default.png', 'zack.blink@etudiant.univ-reims.fr', 'dzepfkzped', NULL, '2023-06-09 08:34:15'),
(10, 'Bulga', 'Zoe', 'default.png', 'zoe.bulga@etudiant.univ-reims.fr', 'azkdzoepakda^d', NULL, '2023-06-09 08:34:40'),
(11, 'Patos', 'Sandy', 'default.png', 'sandy.patos@etudiant.univ-reims.fr', 'fzoekdzpjdfefioz', NULL, '2023-06-09 08:35:12'),
(12, 'Dupond', 'Polux', 'default.png', 'polux.dupond@etudiant.univ-reims.fr', 'zefuhzijdopeajfzpoie', NULL, '2023-06-09 08:35:44');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
