-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 avr. 2026 à 09:57
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `helbdesk_nassihi_soufiane`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_de_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `ticket_id`, `user_id`, `message`, `date_de_creation`) VALUES
(1, 1, 1, 'Je ne peux pas me connecter depuis ce matin', '2026-04-03 09:15:34'),
(2, 1, 1, 'Toujours le même problème', '2026-04-03 09:15:34'),
(3, 1, 1, 'Ça fonctionne maintenant', '2026-04-03 09:15:34'),
(4, 2, 1, 'Le design est cassé sur mobile', '2026-04-03 09:15:34'),
(5, 2, 1, 'Problème toujours présent', '2026-04-03 09:15:34'),
(6, 2, 1, 'Corrigé après mise à jour', '2026-04-03 09:15:34'),
(7, 3, 1, 'Carte refusée', '2026-04-03 09:15:34'),
(8, 3, 1, 'J’ai essayé avec une autre carte', '2026-04-03 09:15:34'),
(9, 3, 1, 'Toujours bloqué', '2026-04-03 09:15:34'),
(10, 4, 1, 'Le mode sombre serait utile', '2026-04-03 09:15:34'),
(11, 4, 1, 'Ça améliorerait le confort', '2026-04-03 09:15:34'),
(12, 4, 1, 'Merci de considérer', '2026-04-03 09:15:34'),
(13, 5, 1, 'Le site met 10 secondes à charger', '2026-04-03 09:15:34'),
(14, 5, 1, 'Même problème sur mobile', '2026-04-03 09:15:34'),
(15, 5, 1, 'Un peu mieux maintenant', '2026-04-03 09:15:34'),
(40, 1, 1, 'salut', '2026-04-21 08:59:13'),
(41, 1, 1, 'zdzdzdzd', '2026-04-21 09:01:49'),
(42, 1, 1, 'comment', '2026-04-21 09:06:01'),
(43, 36, 1, 'salut\r\n', '2026-04-21 09:11:32'),
(44, 38, 1, 'bonjours monsieur', '2026-04-21 09:58:24'),
(45, 38, 1, 'j\'espere que vous aller bien ', '2026-04-21 09:58:33'),
(46, 38, 3, 'bien et vous ', '2026-04-21 09:59:14'),
(47, 38, 3, 'comment puis-je vous aider ?', '2026-04-21 10:05:52'),
(48, 38, 1, 'je constate que mes cables sont défecteux\r\n', '2026-04-21 10:06:48'),
(49, 38, 1, 'comment je peux faire pour réparé ca ?\r\n', '2026-04-21 10:07:19'),
(50, 40, 9, 'reussi', '2026-04-23 12:01:08'),
(51, 40, 3, 'oui reussi', '2026-04-23 12:01:29'),
(52, 40, 10, 'oui bientot réussi', '2026-04-23 12:20:15');

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `statut` enum('ouvert','en_cours','ferme','') NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_de_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `titre`, `description`, `statut`, `user_id`, `date_de_creation`) VALUES
(1, 'Problème connexion', 'Impossible de se connecter', 'ferme', 1, '2026-04-20 14:01:31'),
(2, 'Bug affichage', 'Le tableau ne s’affiche pas correctement', 'ouvert', 1, '2026-04-10 09:19:29'),
(3, 'Erreur paiement', 'Paiement refusé sans raison', 'ferme', 1, '2026-04-20 14:16:07'),
(4, 'Suggestion amélioration', 'Ajouter un mode sombre', 'ferme', 1, '2026-04-20 14:16:06'),
(5, 'Problème lenteur', 'Le site est très lent', 'ferme', 1, '2026-04-20 14:16:05'),
(38, 'test2(user1)', 'ddd', 'ouvert', 1, '2026-04-21 09:57:13'),
(39, 'zez', 'zeze', 'ouvert', 8, '2026-04-23 11:52:03'),
(40, 'bientot fini ?', 'dzdzd', 'ouvert', 9, '2026-04-23 12:00:56'),
(41, 'ezez', 'zezez', 'ouvert', 9, '2026-04-23 12:28:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('technicien','admin','user','') NOT NULL,
  `date_de_création` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `mot_de_passe`, `role`, `date_de_création`) VALUES
(3, 'fréderic', 'frederic1@gmail.com', 'lol123', 'technicien', '2026-04-09 11:19:45'),
(5, 'papa', 'boss@gmail.com', 'lol123', 'admin', '2026-04-09 11:35:35'),
(7, '', 'dzdzd@gmail.com', 'lol123', 'user', '2026-04-23 11:48:50'),
(8, '', 'lol@gmail', 'lol123', 'user', '2026-04-23 11:50:22'),
(9, '', 'kelian@gmail.com', '123', 'user', '2026-04-23 12:00:15'),
(10, '', 'pp@gmail.com', '123', 'technicien', '2026-04-23 12:18:05'),
(11, '', 'wsm@gmail.com', '123', 'user', '2026-04-24 06:52:42');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
