-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 01 juin 2020 à 12:50
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `survey`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id_questions` int(4) NOT NULL,
  `id_surveys` int(4) NOT NULL,
  `question` varchar(25) CHARACTER SET latin7 COLLATE latin7_general_cs NOT NULL,
  `type` varchar(25) NOT NULL,
  `mustDo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sub_questions`
--

CREATE TABLE `sub_questions` (
  `id_sub_questions` int(25) NOT NULL,
  `id_questions` int(4) NOT NULL,
  `type` varchar(25) NOT NULL,
  `value` varchar(25) CHARACTER SET latin7 COLLATE latin7_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `surveys`
--

CREATE TABLE `surveys` (
  `id_surveys` int(25) NOT NULL,
  `id_users` int(25) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_users` int(4) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_questions`),
  ADD UNIQUE KEY `id_questions` (`id_questions`),
  ADD KEY `fk_id_question_id_survey` (`id_surveys`);

--
-- Index pour la table `sub_questions`
--
ALTER TABLE `sub_questions`
  ADD PRIMARY KEY (`id_sub_questions`),
  ADD UNIQUE KEY `id_sub_questions` (`id_sub_questions`),
  ADD KEY `id_sub_quesitions_id_questions` (`id_questions`);

--
-- Index pour la table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id_surveys`),
  ADD UNIQUE KEY `id_formulaires` (`id_surveys`),
  ADD KEY `fk_id_users_surveys` (`id_users`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `id_utilisateurs` (`id_users`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_questions` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sub_questions`
--
ALTER TABLE `sub_questions`
  MODIFY `id_sub_questions` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id_surveys` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(4) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_id_question_id_survey` FOREIGN KEY (`id_surveys`) REFERENCES `surveys` (`id_surveys`);

--
-- Contraintes pour la table `sub_questions`
--
ALTER TABLE `sub_questions`
  ADD CONSTRAINT `id_sub_quesitions_id_questions` FOREIGN KEY (`id_questions`) REFERENCES `questions` (`id_questions`);

--
-- Contraintes pour la table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `fk_id_users_surveys` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;