-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 03 nov. 2023 à 16:35
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
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--
CREATE TABLE `chat` (
  `User` int(11) NOT NULL,
  `Message` int(254) NOT NULL,
  `ID_room` int(11) NOT NULL,
  `Room` varchar(11) NOT NULL,
  `User_list` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `User` int(11) NOT NULL,
  `Post` int(11) NOT NULL,
  `ID_comment` int(11) NOT NULL,
  `Author` varchar(11) NOT NULL,
  `Date_of_creation` int(11) NOT NULL,
  `Date_of_edit` int(11) NOT NULL,
  `Content` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `User` int(11) NOT NULL,
  `Topic` int(11) NOT NULL,
  `ID_forum` int(11) NOT NULL,
  `Name_forum` varchar(32) NOT NULL,
  `Date_of_creation` int(11) NOT NULL,
  `Date_of_edit` int(11) NOT NULL,
  `Category_forum` varchar(32) NOT NULL,
  `Type_forum` varchar(32) NOT NULL,
  `List_member_forum` varchar(324) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `User` int(11) NOT NULL,
  `Chat` int(11) NOT NULL,
  `Session` int(11) NOT NULL,
  `ID_message` int(11) NOT NULL,
  `Date_of_creation_msg` int(11) NOT NULL,
  `Date_of_edit_msg` int(11) NOT NULL,
  `Content` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `User` int(11) NOT NULL,
  `Topic` int(11) NOT NULL,
  `Author` varchar(32) NOT NULL,
  `ID_post` int(11) NOT NULL,
  `Content` varchar(254) NOT NULL,
  `Date_of_creation` int(11) NOT NULL,
  `Date_of_edit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `User` int(11) NOT NULL,
  `Chat` int(11) NOT NULL,
  `Message` int(254) NOT NULL,
  `ID_session` int(11) NOT NULL,
  `Type_session` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `User` int(11) NOT NULL,
  `Post` int(11) NOT NULL,
  `ID_topic` int(11) NOT NULL,
  `Date_of_creation` int(11) NOT NULL,
  `Date_of_edit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID_user` int(11) NOT NULL,
  `Firstname` varchar(32) NOT NULL,
  `Lastname` varchar(32) NOT NULL,
  `Date_of_creation` date NOT NULL DEFAULT current_timestamp(),
  `Nickname` varchar(32) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email_address` varchar(64) NOT NULL,
  `Date_of_birth` date DEFAULT NULL,
  `Tel` varchar(11) NOT NULL,
  `Statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='The table defines all the user information';

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID_user`, `Firstname`, `Lastname`, `Date_of_creation`, `Nickname`, `Password`, `Email_address`, `Date_of_birth`, `Tel`, `Statut`) VALUES
(5, 'Sinane', 'Adi', '0000-00-00', 'Sinane', 'motdepasse', 'sinaneadi@gmail.com', '0000-00-00', '', 1),
(6, 'Test', 'Test', '0000-00-00', 'Test', 'test', 'test@gmail.com', '0000-00-00', '0610101010', 0),
(7, 'Lebon', 'Jean-Michel', '2023-11-03', 'SuperPro70', 'supergame4000', 'jeanmichlebon@gmail.com', '0000-00-00', '0415758465', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID_room`),
  ADD KEY `chatmessage_message` (`Message`),
  ADD KEY `chatuser_user` (`User`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID_comment`),
  ADD KEY `commentpostp_post` (`Post`),
  ADD KEY `commentuser_user` (`User`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`ID_forum`),
  ADD KEY `forumuser_user` (`User`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID_message`),
  ADD KEY `messagechat_chat` (`Chat`),
  ADD KEY `messageuser_user` (`User`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID_post`),
  ADD KEY `postuser_user` (`User`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`ID_session`),
  ADD KEY `sessionchat_chat` (`Chat`),
  ADD KEY `sessionmessage_message` (`Message`),
  ADD KEY `sessionuser_user` (`User`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`ID_topic`),
  ADD KEY `topicuser_user` (`User`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_user`),
  ADD UNIQUE KEY `Nickname_3` (`Nickname`),
  ADD KEY `Nickname` (`Nickname`),
  ADD KEY `Nickname_2` (`Nickname`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `ID_room` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `ID_forum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `ID_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `ID_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `ID_session` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `ID_topic` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chatmessage_message` FOREIGN KEY (`Message`) REFERENCES `message` (`ID_message`),
  ADD CONSTRAINT `chatuser_user` FOREIGN KEY (`User`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `commentpost_post` FOREIGN KEY (`Post`) REFERENCES `post` (`ID_post`),
  ADD CONSTRAINT `commentuser_user` FOREIGN KEY (`User`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forumuser_user` FOREIGN KEY (`User`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `messagechat_chat` FOREIGN KEY (`Chat`) REFERENCES `chat` (`ID_room`),
  ADD CONSTRAINT `messageuser_user` FOREIGN KEY (`User`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `postuser_user` FOREIGN KEY (`User`) REFERENCES `user` (`ID_user`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `sessionchat_chat` FOREIGN KEY (`Chat`) REFERENCES `chat` (`ID_room`),
  ADD CONSTRAINT `sessionmessage_message` FOREIGN KEY (`Message`) REFERENCES `message` (`ID_message`),
  ADD CONSTRAINT `sessionuser_user` FOREIGN KEY (`User`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topicuser_user` FOREIGN KEY (`User`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
