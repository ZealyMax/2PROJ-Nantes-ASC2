-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 10 juin 2020 à 01:40
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
-- Structure de la table `answers`
--

CREATE TABLE `answers` (
  `id_answers` int(25) NOT NULL,
  `id_surveys` int(25) NOT NULL,
  `id_questions` int(25) NOT NULL,
  `id_sub_questions` int(25) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `numéro_feuille_réponse` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_questions`, `id_surveys`, `question`, `type`, `mustDo`) VALUES
(237, 49, 'must', 'short', 0),
(238, 49, 'pas must', 'short', 1),
(239, 49, 'must', 'short', 0),
(240, 50, 'RC (must)', 'short', 1),
(241, 50, 'P (must)', 'long', 1),
(242, 50, 'CM (must)', 'multiple', 1),
(243, 50, 'CaC (must)', 'checkbox', 1),
(244, 50, 'LD (must)', 'list', 1),
(245, 50, 'EL 1-8 (must)', 'linear-scale', 0),
(246, 50, 'GaCM (pas must)', 'grid-multiple', 0),
(247, 50, 'GaCaC (pas must)', 'grid-checkbox', 0),
(248, 50, 'D (must)', 'date', 0),
(249, 50, 'H (must)', 'hour', 0),
(274, 52, '', 'short', 1),
(275, 52, '', 'short', 1),
(276, 52, '', 'short', 1),
(277, 52, '', 'short', 1),
(278, 52, '', 'short', 1),
(279, 52, '', 'short', 1),
(280, 52, '', 'short', 1),
(281, 52, '', 'short', 1),
(282, 52, '', 'short', 1),
(283, 52, '', 'short', 1),
(284, 52, '', 'short', 1),
(285, 52, '', 'short', 1),
(286, 52, '', 'short', 1),
(287, 52, '', 'short', 1),
(288, 52, '', 'short', 1);

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

--
-- Déchargement des données de la table `sub_questions`
--

INSERT INTO `sub_questions` (`id_sub_questions`, `id_questions`, `type`, `value`) VALUES
(298, 242, 'radio', 'CM1'),
(299, 242, 'radio', 'CM2'),
(300, 244, 'list', 'LD1'),
(301, 244, 'list', 'LD2'),
(302, 245, 'min-scale', '1'),
(303, 245, 'max-scale', '8'),
(304, 246, 'line', 'GaCM L1'),
(305, 246, 'line', 'GaCM L2'),
(306, 246, 'column-multiple', 'GaCM C1'),
(307, 246, 'column-multiple', 'GaCM C2'),
(308, 247, 'line', 'GaCaC L1'),
(309, 247, 'line', 'GaCaC L2'),
(310, 247, 'column-checkbox', 'GaCaC C1'),
(311, 247, 'column-checkbox', 'GaCaC C2');

-- --------------------------------------------------------

--
-- Structure de la table `surveys`
--

CREATE TABLE `surveys` (
  `id_surveys` int(25) NOT NULL,
  `id_users` int(25) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `order_surveys` int(11) NOT NULL,
  `date_ouverture` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `surveys`
--

INSERT INTO `surveys` (`id_surveys`, `id_users`, `title`, `description`, `order_surveys`, `date_ouverture`) VALUES
(40, 1, 'plop', '', 0, '2020-06-06 00:00:00'),
(41, 1, 'Test date', '', 0, '2020-06-01 02:07:05'),
(43, 1, 'vide comme ta soeur', '', 0, '2020-06-02 20:30:08'),
(44, 1, 'wallah ca se dit pas', 'ouais trop daccord', 0, '2020-06-09 20:34:02'),
(49, 1, 'dla merde', '', 0, '2020-06-10 00:34:07'),
(50, 1, 'test all questions (must / pas must) 2', 'this is a description', 0, '2020-06-10 00:34:41'),
(52, 1, 'dla merde 2.0 (all must)', '', 0, '2020-06-10 00:36:45');

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
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `login`, `password`) VALUES
(1, 'Zealy', 'Zealy');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id_answers`),
  ADD UNIQUE KEY `id_answers` (`id_answers`);

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
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
  MODIFY `id_answers` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_questions` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT pour la table `sub_questions`
--
ALTER TABLE `sub_questions`
  MODIFY `id_sub_questions` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT pour la table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id_surveys` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
