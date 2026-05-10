-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 11 mai 2026 à 00:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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
(66, 49, 1, 'Je ne peux pas me connecter depuis ce matin', '2026-05-05 17:23:20'),
(67, 49, 1, 'Toujours le même problème', '2026-05-05 17:23:32'),
(68, 49, 1, 'Ça fonctionne maintenant', '2026-05-05 17:23:41'),
(69, 50, 1, 'Le design est cassé sur mobile', '2026-05-05 17:23:55'),
(70, 50, 1, 'Problème toujours présent', '2026-05-05 17:24:10'),
(71, 50, 1, 'Corrigé après mise à jour', '2026-05-05 17:24:22'),
(72, 51, 1, 'Carte refusée', '2026-05-05 17:24:30'),
(73, 51, 1, 'J’ai essayé avec une autre carte', '2026-05-05 17:24:38'),
(74, 51, 1, 'Toujours bloqué', '2026-05-05 17:24:47'),
(75, 52, 1, 'Le mode sombre serait utile', '2026-05-05 17:25:07'),
(76, 52, 1, 'Ça améliorerait le confort', '2026-05-05 17:25:14'),
(77, 52, 1, 'Merci de considérer', '2026-05-05 17:25:21'),
(78, 53, 1, 'Le site met 10 secondes à charger', '2026-05-05 17:25:29'),
(79, 53, 1, 'Même problème sur mobile', '2026-05-05 17:25:37'),
(80, 53, 1, 'Un peu mieux maintenant', '2026-05-05 17:25:45'),
(84, 49, 10, 'comment puis-je vous aider ?', '2026-05-05 23:52:10'),
(85, 49, 20, 'enfin réussi', '2026-05-05 23:53:37'),
(87, 56, 1, 'je suis assez content du résultat', '2026-05-06 00:34:07'),
(89, 57, 10, 'je vous vous conseillerai de moin les voir ', '2026-05-06 13:52:38'),
(90, 57, 20, 'de ma part, je dirai une fois par moi !', '2026-05-06 13:53:27'),
(92, 0, 1, 'on va voir si sa fonctionne\r\n', '2026-05-07 01:21:32'),
(93, 0, 1, 'on va voir si sa fonctionne', '2026-05-07 01:21:49'),
(94, 0, 1, 'aeaze', '2026-05-07 01:21:57'),
(95, 0, 1, 'zdzdzd', '2026-05-07 01:22:20'),
(97, 60, 10, 'Bonjours qu\'elle est la raison de votre tickets ?', '2026-05-07 16:29:22'),
(98, 60, 20, 'oui,bonjours dites nous ce qui s\'est passé ', '2026-05-07 16:32:00'),
(100, 61, 10, 'les ecoute pas, fait ce que tu veux ', '2026-05-07 16:55:55'),
(101, 61, 20, 'bv', '2026-05-07 16:57:12'),
(102, 62, 27, 'bonjour', '2026-05-07 17:46:07'),
(103, 62, 10, 'comment aller vous ', '2026-05-07 17:46:57'),
(104, 62, 20, 'lol', '2026-05-07 17:47:24'),
(106, 65, 10, 'zrze', '2026-05-09 16:31:50'),
(107, 66, 27, 'ukukuk', '2026-05-10 19:34:57'),
(108, 66, 27, 'asasasasasas', '2026-05-10 20:14:09'),
(109, 66, 27, 'sasasasagetgrtjtyikuy!o!çpo!çàp^çà^\r\n', '2026-05-10 20:14:16'),
(110, 66, 10, 'asasasasasasasasas', '2026-05-10 20:14:47'),
(111, 53, 20, 'je comprends, avec nos équipe nous esseaieons de voir le probème et une fois résolue nous vous recontactons\r\n', '2026-05-10 21:23:23'),
(112, 53, 1, 'ok, parfait merci bien!', '2026-05-10 21:24:55'),
(113, 53, 1, 'bien a vous', '2026-05-10 21:25:02'),
(114, 49, 28, 'je n\'ai pas beosin d\'intervenir', '2026-05-10 21:32:10'),
(115, 53, 28, 'top', '2026-05-10 21:32:16');

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
(49, 'Problème connexion', 'Impossible de se connecter', 'ouvert', 1, '2026-05-06 19:33:10'),
(50, 'Bug affichage', 'Le tableau ne s’affiche pas correctement', 'ouvert', 1, '2026-05-06 19:33:11'),
(51, 'Erreur paiement', 'Paiement refusé sans raison', 'ouvert', 1, '2026-05-06 19:33:13'),
(52, 'Suggestion amélioration', 'Ajouter un mode sombre', 'ouvert', 1, '2026-05-06 19:33:16'),
(53, 'Problème lenteur', 'Le site est très lent', 'ouvert', 1, '2026-05-06 19:33:17'),
(55, 'WIFI', 'Pb de wifi', 'ferme', 23, '2026-05-06 19:45:31'),
(56, 'sa rend plus beau la non ?', 'oui trés trés beau ', 'ferme', 1, '2026-05-06 19:33:33'),
(58, 'test ', 'test 2', 'ferme', 1, '2026-05-07 01:25:35'),
(62, 'test ', 'test', 'ferme', 27, '2026-05-07 17:49:01'),
(63, 'test', 'test', 'ferme', 1, '2026-05-08 16:11:11'),
(64, 'final', 'final2', 'ferme', 1, '2026-05-09 16:19:54'),
(66, 'probleme de id ', 'dzde', 'ferme', 27, '2026-05-10 21:32:33');

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
(1, 'lol', 'lol@gmail.com', '$2y$10$u7E2kkQdNyKEa4FjKQCzaOgpjJSFizp5pfT6cnZ6IJnzSEF3vKkB.', 'user', '2026-05-10 22:00:49'),
(10, 'frederic', 'frederic1@gmail.com', '$2y$10$qp5IJlVlL6zpEyNNzlNwz.xK3Ao.F6AZJzYnDnSGMlWMEvWBlxTK.', 'technicien', '2026-05-10 22:00:56'),
(20, 'boss', 'boss@gmail.com', '$2y$10$IlalvYCtoNUB/VM4PaCHq.gfn0F6YoRe.DkTa6Nh6wFA4s901SRoy', 'admin', '2026-05-10 21:53:38'),
(23, 'loupie', 'loupietoupie@gmail.com', '$2y$10$oQYQ19FXJawkRK1CTnSRgeZJugVqXznaUsCDoKsBHdIXyHU.X98Su', 'user', '2026-05-10 22:01:06'),
(27, 'salman', 'salman@gmail.com', '$2y$10$SgBQTHMhBqBTKALrDzvn.ulq5UrYsj5KxMSwkDFOjTQuOFE.iNW9G', 'user', '2026-05-10 21:41:29'),
(28, 'slt', 'slt@grmail.com', '$2y$10$Sx45WIoLov4NhfPeSue5/ul7Um48YdxEPoR8yNK/JVHBAFpqCuahS', 'technicien', '2026-05-10 22:01:12'),
(30, 'test', 'test@gmail.com', '$2y$10$A4EBNd1iqHRn6FOXup8ECuNiiW8a9PPWmvgd6tt7eEgbAkHI3zsAi', 'user', '2026-05-10 21:55:49');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
