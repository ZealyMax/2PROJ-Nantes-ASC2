-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 12 juin 2020 à 00:08
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
  `number_answer_sheet` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`id_answers`, `id_surveys`, `id_questions`, `id_sub_questions`, `answer`, `number_answer_sheet`) VALUES
(23, 115, 602, 0, ' fds', 1),
(24, 115, 603, 0, ' fds', 1),
(25, 115, 605, 0, ' LD1', 1),
(26, 115, 606, 0, ' 5', 1),
(27, 115, 609, 0, ' 2020-06-01', 1),
(28, 115, 610, 0, ' 22:22', 1),
(29, 115, 602, 0, ' fds', 2),
(30, 115, 603, 0, ' fds', 2),
(31, 115, 604, 3151, 'CaC1', 2),
(32, 115, 604, 3152, 'CaC2', 2),
(33, 115, 605, 0, ' LD1', 2),
(34, 115, 606, 0, ' 5', 2),
(35, 115, 607, 3157, 'GaCM C1_GaCM L1', 2),
(36, 115, 607, 3158, 'GaCM C2_GaCM L2', 2),
(37, 115, 608, 3161, 'GaCM C2_GaCaC L1', 2),
(38, 115, 608, 3162, 'GaCM C2_GaCaC L2', 2),
(39, 115, 609, 0, ' 2020-06-01', 2),
(40, 115, 610, 0, ' 22:22', 2),
(41, 115, 611, 3165, 'CM1', 2);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id_questions` int(25) NOT NULL,
  `id_surveys` int(25) NOT NULL,
  `question` varchar(200) CHARACTER SET latin7 COLLATE latin7_general_cs NOT NULL,
  `type` varchar(25) NOT NULL,
  `mustDo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_questions`, `id_surveys`, `question`, `type`, `mustDo`) VALUES
(289, 53, 'EL 1-8 (must)', 'linear-scale', 0),
(290, 53, 'GaCM (must)', 'grid-multiple', 0),
(291, 53, 'GaCaC (pas must)', 'grid-checkbox', 0),
(292, 53, 'D (must)', 'date', 0),
(293, 53, 'H (must)', 'hour', 0),
(533, 99, '', 'short', 1),
(534, 99, '', 'list', 1),
(535, 99, '', 'linear-scale', 1),
(536, 99, '', 'short', 1),
(587, 109, 'pute szaldf,skjkdjl lkkkl pute szaldf,skjkdjl lkkkl pute szaldf,skjkdjl lkkkl pute szaldf,skjkdjl lkkkl pute szaldf,skjkdjl lkkkl pute szaldf,skjkdjl lkkkl pute szaldf,skjkdjl lkkkl pute szaldf,skjkdj', 'short', 0),
(602, 115, 'RC', 'short', 1),
(603, 115, 'P', 'long', 1),
(604, 115, 'CaC', 'checkbox', 1),
(605, 115, 'LD', 'list', 1),
(606, 115, 'EL 1-8', 'linear-scale', 1),
(607, 115, 'GaCM', 'grid-multiple', 1),
(608, 115, 'GaCaC', 'grid-checkbox', 1),
(609, 115, 'D', 'date', 1),
(610, 115, 'H', 'hour', 1),
(611, 115, 'CM', 'multiple', 1),
(612, 116, '?a crée?', 'short', 0),
(613, 117, 'GaCM', 'grid-multiple', 0),
(614, 117, 'GdCaC', 'grid-checkbox', 0),
(615, 117, 'GaCM2', 'grid-multiple', 0),
(616, 117, 'GdCaC2', 'grid-checkbox', 0),
(637, 120, 'RC', 'short', 0),
(638, 120, 'P', 'long', 0),
(639, 120, 'CM', 'multiple', 0),
(640, 120, 'CaC', 'checkbox', 0),
(641, 120, 'LD', 'list', 0),
(642, 120, 'EL', 'linear-scale', 0),
(643, 120, 'GdCM', 'grid-multiple', 0),
(644, 120, 'GdCaC', 'grid-checkbox', 0),
(645, 120, 'Date', 'date', 0),
(646, 120, 'Heure', 'hour', 0);

-- --------------------------------------------------------

--
-- Structure de la table `sub_questions`
--

CREATE TABLE `sub_questions` (
  `id_sub_questions` int(25) NOT NULL,
  `id_questions` int(4) NOT NULL,
  `type` varchar(25) NOT NULL,
  `value` varchar(25) CHARACTER SET latin7 COLLATE latin7_general_cs NOT NULL,
  `scale_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sub_questions`
--

INSERT INTO `sub_questions` (`id_sub_questions`, `id_questions`, `type`, `value`, `scale_name`) VALUES
(312, 289, 'min-scale', '1', ''),
(313, 289, 'max-scale', '8', ''),
(314, 290, 'line', 'GaCM L1', ''),
(315, 290, 'line', 'GaCM L2', ''),
(316, 290, 'column-multiple', 'GaCM C1', ''),
(317, 290, 'column-multiple', 'GaCM C2', ''),
(318, 291, 'line', 'GaCaC L1', ''),
(319, 291, 'line', 'GaCaC L2', ''),
(320, 291, 'column-checkbox', 'GaCaC C1', ''),
(321, 291, 'column-checkbox', 'GaCaC C2', ''),
(579, 534, 'list', '', ''),
(580, 535, 'min-scale', '0', ''),
(581, 535, 'max-scale', '2', ''),
(3151, 604, 'checkbox', 'CaC1', ''),
(3152, 604, 'checkbox', 'CaC2', ''),
(3153, 605, 'list', 'LD1', ''),
(3154, 605, 'list', 'LD2', ''),
(3155, 606, 'min-scale', '1', 'Bas'),
(3156, 606, 'max-scale', '8', 'Haut'),
(3157, 607, 'line', 'GaCM L1', ''),
(3158, 607, 'line', 'GaCM L2', ''),
(3159, 607, 'column-multiple', 'GaCM C1', ''),
(3160, 607, 'column-multiple', 'GaCM C2', ''),
(3161, 608, 'line', 'GaCaC L1', ''),
(3162, 608, 'line', 'GaCaC L2', ''),
(3163, 608, 'column-checkbox', 'GaCaC C1', ''),
(3164, 608, 'column-checkbox', 'GaCM C2', ''),
(3165, 611, 'radio', 'CM1', ''),
(3166, 611, 'radio', 'CM2', ''),
(3167, 613, 'line', 'GaCM L1', ''),
(3168, 613, 'line', 'GaCM L2', ''),
(3169, 613, 'column-multiple', 'GaCM C1', ''),
(3170, 613, 'column-multiple', 'GaCM C2', ''),
(3171, 614, 'line', 'GdCaC L1', ''),
(3172, 614, 'line', 'GdCaC L2', ''),
(3173, 614, 'column-checkbox', 'GdCaC C1', ''),
(3174, 614, 'column-checkbox', 'GdCaC C2', ''),
(3175, 615, 'line', 'GaCM2 L1', ''),
(3176, 615, 'line', 'GaCM2 L2', ''),
(3177, 615, 'column-multiple', 'GaCM2 C1', ''),
(3178, 615, 'column-multiple', 'GaCM2 C2', ''),
(3179, 616, 'line', 'GdCaC2 L1', ''),
(3180, 616, 'line', 'GdCaC2 L2', ''),
(3181, 616, 'column-checkbox', 'GdCaC2 C1', ''),
(3182, 616, 'column-checkbox', 'GdCaC2 C2', ''),
(3207, 639, 'radio', 'CM1', ''),
(3208, 639, 'radio', 'CM2', ''),
(3209, 640, 'checkbox', '', ''),
(3210, 641, 'list', 'LD1', ''),
(3211, 641, 'list', 'LD2', ''),
(3212, 641, 'list', 'LD3', ''),
(3213, 642, 'min-scale', '1', 'Poulet'),
(3214, 642, 'max-scale', '8', 'Au curry'),
(3215, 643, 'line', 'GdCML1', ''),
(3216, 643, 'line', 'GdCML2', ''),
(3217, 643, 'column-multiple', 'GdCMC1', ''),
(3218, 643, 'column-multiple', 'GdCMC2', ''),
(3219, 644, 'line', 'GdCaCL1', ''),
(3220, 644, 'line', 'GdCaCL2', '');

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
(41, 1, 'Test date', '', 0, '2020-06-01 02:07:05'),
(53, 1, 'test all questions (must / pas must) 2', 'this is a description', 0, '2020-06-10 12:29:52'),
(99, 1, 'test some question all must', '', 0, '2020-06-10 13:58:04'),
(109, 1, 'putain sa mere il est repare le create sa race', '', 0, '2020-06-11 02:29:45'),
(115, 1, 'test all questions all must', '', 0, '2020-06-11 16:54:39'),
(116, 1, 'test création ', '', 0, '2020-06-11 19:22:12'),
(117, 1, 'full grilles', '', 0, '2020-06-11 19:34:48'),
(120, 1, 'All basic', '', 0, '2020-06-11 22:02:40');

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
  MODIFY `id_answers` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_questions` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=647;

--
-- AUTO_INCREMENT pour la table `sub_questions`
--
ALTER TABLE `sub_questions`
  MODIFY `id_sub_questions` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3221;

--
-- AUTO_INCREMENT pour la table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id_surveys` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

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
