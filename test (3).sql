-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20240509.2a58575683
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Sam. 15 Juin 2024 à 01:16
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `bank_account`
--

CREATE TABLE `bank_account` (
  `id_account` int(20) NOT NULL,
  `solde` double(10,5) NOT NULL,
  `type_compte` varchar(20) NOT NULL,
  `plafond_r` double(10,5) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bank_account`
--

INSERT INTO `bank_account` (`id_account`, `solde`, `type_compte`, `plafond_r`, `id_user`) VALUES
(12, 2555.50000, 'Savings', 10000.00000, 30),
(13, 1000.00000, 'Checking', 5000.00000, 24),
(14, 2500.50000, 'Savings', 10000.00000, 25),
(15, 500.25000, 'Checking', 3000.00000, 26),
(16, 15000.75000, 'Savings', 20000.00000, 27),
(17, 750.00000, 'Checking', 5000.00000, 28),
(18, 3000.00000, 'Savings', 15000.00000, 29),
(19, 200.50000, 'Checking', 2000.00000, 30),
(20, 10000.25000, 'Savings', 25000.00000, 31),
(21, 9100.75000, 'Checking', 4000.00000, 32),
(22, 4000.50000, 'Savings', 12000.00000, 33),
(23, 800.00000, 'Checking', 6000.00000, 34),
(24, 4945.00000, 'Savings', 500.00000, 35);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(5) NOT NULL,
  `nom_cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'dd', 'dd@gmail.xn--cp-pka', 'dd', '2024-04-29 20:22:20'),
(2, 'dd', 'ddd@ff.com', 'fff', '2024-04-29 20:22:31'),
(3, 'cd', 'ddd@gmail.com', 'ddd', '2024-04-30 19:22:52'),
(4, 're', 'doudod@gmail.com', 'ee', '2024-05-02 13:54:22'),
(5, 'zz', 'zz@ff.cpm', 'zz', '2024-05-02 13:55:02'),
(6, 'rff', 'fff@gmai.com', 'ff', '2024-05-09 08:52:20');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id_demande` int(20) NOT NULL,
  `description` text NOT NULL,
  `id_cat` int(5) NOT NULL,
  `etat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(3) NOT NULL,
  `nom_role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `nom_role`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'agent');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(20) NOT NULL,
  `montant` double(10,5) NOT NULL,
  `compte_sender` int(20) NOT NULL,
  `compte_receiver` int(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `montant`, `compte_sender`, `compte_receiver`, `date`) VALUES
(27, 100.50000, 12, 24, '2024-05-10 08:00:00'),
(28, 50.25000, 24, 12, '2024-05-11 10:30:00'),
(29, 75.75000, 12, 23, '2024-05-12 15:45:00'),
(30, 120.00000, 23, 24, '2024-05-13 12:00:00'),
(31, 80.50000, 24, 22, '2024-05-14 09:15:00'),
(32, 60.75000, 22, 24, '2024-05-15 17:30:00'),
(33, 150.25000, 24, 21, '2024-05-16 14:45:00'),
(34, 30.00000, 21, 24, '2024-05-17 11:00:00'),
(35, 45.75000, 24, 20, '2024-05-18 08:30:00'),
(36, 200.50000, 20, 24, '2024-05-19 16:45:00'),
(37, 300.00000, 24, 19, '2024-05-20 14:00:00'),
(38, 500.00000, 19, 24, '2024-05-21 12:30:00'),
(39, 75.25000, 24, 18, '2024-05-22 10:45:00'),
(40, 90.50000, 18, 24, '2024-05-23 09:00:00'),
(41, 110.75000, 24, 17, '2024-05-24 17:15:00'),
(42, 180.25000, 17, 24, '2024-05-25 15:30:00'),
(43, 250.75000, 24, 16, '2024-05-26 13:45:00'),
(44, 400.00000, 16, 24, '2024-05-27 12:00:00'),
(45, 600.50000, 24, 15, '2024-05-28 10:15:00'),
(46, 800.75000, 15, 24, '2024-05-29 08:30:00'),
(47, 1000.25000, 24, 14, '2024-05-30 16:45:00'),
(48, 100.00000, 24, 21, '2024-05-19 13:06:52'),
(49, 100.00000, 24, 21, '2024-05-19 13:11:20'),
(50, 100.00000, 24, 21, '2024-05-19 13:11:20'),
(51, 100.00000, 24, 21, '2024-05-19 13:26:28'),
(52, 300.00000, 24, 21, '2024-05-19 14:15:07'),
(53, 300.00000, 24, 21, '2024-05-19 14:15:08'),
(54, 200.00000, 24, 21, '2024-05-19 14:16:23'),
(55, 200.00000, 24, 21, '2024-05-19 14:16:23'),
(56, 100.00000, 24, 21, '2024-05-19 14:17:48'),
(57, 100.00000, 24, 21, '2024-05-19 14:17:48'),
(58, 100.00000, 24, 21, '2024-05-19 14:21:35'),
(59, 100.00000, 24, 21, '2024-05-19 14:21:35'),
(60, 100.00000, 24, 21, '2024-05-19 14:24:15'),
(61, 100.00000, 24, 21, '2024-05-19 14:24:15'),
(62, 100.00000, 24, 21, '2024-05-19 14:27:23'),
(63, 100.00000, 24, 21, '2024-05-19 14:27:23'),
(64, 100.00000, 24, 21, '2024-05-19 14:33:31'),
(65, 100.00000, 24, 21, '2024-05-19 14:33:31'),
(66, 100.00000, 24, 21, '2024-05-19 14:34:55'),
(67, 55.00000, 24, 12, '2024-05-19 18:35:32');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `User_id` int(10) NOT NULL,
  `Firstname` varchar(20) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `Numtel` varchar(8) NOT NULL,
  `Date_N` date NOT NULL,
  `Adresse` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `id_role` int(3) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`User_id`, `Firstname`, `Lastname`, `Numtel`, `Date_N`, `Adresse`, `Email`, `id_role`, `password`, `token`, `token_expires_at`) VALUES
(17, 'azazazaz', '', '', '0000-00-00', '', '', 1, '', '', '2024-05-08 20:35:22'),
(18, 'fffffffffff', '', '', '0000-00-00', '', 'aaaa@aaaa.com', 1, '123', '', '2024-05-08 20:35:22'),
(19, '', '', '', '0000-00-00', '', '', 1, '', '', '2024-05-08 20:35:22'),
(20, 'aaa', '', '', '0000-00-00', '', '', 1, '', '', '2024-05-08 20:35:22'),
(21, 'dsddfsdfsd', '', '', '0000-00-00', '', 'aaaaaaaa', 3, '', '', '2024-05-08 20:35:22'),
(22, '555', '', '', '0000-00-00', '', '', 1, '', '', '2024-05-08 20:35:22'),
(23, 'aaaaa', '', '7978787', '2024-04-16', 'gdgdgd@kdkdkd.com', 'gdgdgd@kdkdkd.com', 1, 'asasasasa', '', '2024-05-08 20:35:22'),
(24, 'aaaaa', '', '4545454', '2024-04-24', 'aaaaaa', 'hi@hi.hi', 2, 'aaaa', '', '2024-05-08 20:35:22'),
(25, 'aaaaa', '', '4545454', '2024-04-24', 'aaaaaa', 'hi@hi.hi', 2, '$2y$10$67d8C6UL8slKu', '', '2024-05-08 20:35:22'),
(26, 'aaaa', '', 'aaaaa', '2024-04-17', 'aaaaaa', 'hii@hi.com', 1, '$2y$10$jYWe6VOxuvGRj', '', '2024-05-08 20:35:22'),
(27, 'aaaa', '', '4747474', '2024-04-24', 'aaaa', 'aa@aa.com', 1, '$2y$10$N0gFlIY8oC1jk', '', '2024-05-08 20:35:22'),
(28, 'hi', '', '123456', '2024-04-24', 'aaaaaa', 'hi@hi.comm', 1, '$2y$10$BH5UCpEvHxDMi', '', '2024-05-08 20:35:22'),
(29, 'test', '', '323232', '2024-04-25', 'azazazaz', 'email@test.com', 3, '$2y$10$t3zfURy52F16/7YBI713g.DNNkdpn0bqeNrALvWMqbpQepFrf.9j.', '', '2024-05-08 20:35:22'),
(30, 'dd', '', '78811744', '2024-04-17', 'hhh', 'doudod@gmail.com', 2, '$2y$10$reJfItneI/tr.YiiKVj2JeIexensvb9vXNVdsAdgf6I8fm9d6K3Dq', '', '2024-05-08 20:35:22'),
(31, 'dd', '', '78811744', '2024-04-17', 'hhh', 'doudod@gmail.com', 2, '$2y$10$w1OdigqeXKfpoXfjNqoiKuv1/EIppBLJ38sMDAcNqc.Rj3XeZ4boW', '', '2024-05-08 20:35:22'),
(32, 'mark', 'joe', '78811744', '2024-04-18', 'aaa', 'behi@hotmail.com', 1, '$2y$10$C4uE12BeSHVHloxOXDQXA.xhdJY67M3I6MR6PgGAam3SILzln5ohO', '', '2024-05-08 20:35:22'),
(33, 'hhh', '', '78811744', '2024-05-25', 'fff', 'jhohoh@flfflf.com', 2, '$2y$10$BH2wNX60PSbSlvbeeeuXzOCdFYswxdPOaQ0LSSbWC0CihHWlU.aQW', '', '2024-05-08 20:35:22'),
(34, 'se', '', '78811744', '2024-06-01', 'fff', 'doudod@gmail.com', 1, '$2y$10$VyErkOwyd1sTFC1JWQ2WCuJ/w6pf4VKNmrfNpsmfXljSXDiBqerx6', '', '2024-05-08 20:35:22'),
(35, 'Zouari', 'Jaouher', '7777', '2024-05-31', 'azazaz', 'jaouher2002@gmail.com', 2, '$2y$10$REwhKbonCEFXTEtiIRzy..oOTpZzpUSnXQjaJu5th3l.qScTsb3RO', '663d180cb7d00', '2024-05-09 21:38:04'),
(37, 'mahdi', 'mahdi', '002255', '2024-06-05', 'dddd', 'mahdi@mahdi.com', 3, '$2y$10$cUHlxEoXP8UJ/s.lbvgt0.ZaaQK1HMC88vwLnT1MfuTFkPZp3NkMi', '', '0000-00-00 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id_account`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_demande`),
  ADD UNIQUE KEY `cat` (`id_cat`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_compte` (`compte_sender`),
  ADD KEY `id_compte2` (`compte_receiver`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`),
  ADD KEY `role_id` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id_account` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5464;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_demande` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bank_account`
--
ALTER TABLE `bank_account`
  ADD CONSTRAINT `bank_account_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`compte_receiver`) REFERENCES `bank_account` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`compte_sender`) REFERENCES `bank_account` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
