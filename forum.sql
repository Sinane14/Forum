-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 04 juin 2024 à 16:22
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
  `ID_forum` int(11) NOT NULL,
  `Title` varchar(55) NOT NULL,
  `Label` varchar(55) NOT NULL,
  `Date_of_creation` datetime NOT NULL,
  `Num` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`ID_forum`, `Title`, `Label`, `Date_of_creation`, `Num`) VALUES
(1, 'Général', 'général', '2022-10-01 09:00:00', 1),
(2, 'TP', 'tp', '2022-10-01 09:00:00', 2),
(3, 'Entreprise', 'entreprise', '2022-10-01 09:00:00', 3),
(4, 'Projet', 'projet', '2022-10-01 09:00:00', 4);

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
  `ID_topic` int(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` longtext NOT NULL,
  `Date_of_creation` date NOT NULL,
  `Date_of_edit` date NOT NULL,
  `Statut` int(1) NOT NULL DEFAULT 0,
  `ID_forum` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`ID_topic`, `Title`, `Content`, `Date_of_creation`, `Date_of_edit`, `Statut`, `ID_forum`, `ID_user`) VALUES
(2, 'Bienvenue', 'Bienvenue dans la catégorie Générale. Vous pouvez parler de tout ici.', '2024-06-01', '2024-06-01', 0, 1, 9);

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
(9, '', '', '2024-05-07', 'Lfksdpfsdpj', '$argon2id$v=19$m=65536,t=4,p=1$QU1keGJTc0c3Z29RbU9BNg$+VIWTnKufozyxR5aEJZdJ0Jb9Irn3xQWAueR9lFv3fw', 'dpfjdsjfosjfisdj@fksjfj.com', NULL, '', 0),
(10, '', '', '2024-06-01', 'Petittest', '$argon2id$v=19$m=65536,t=4,p=1$NW02bVZrdEpLZUVwZ2E2cQ$/dMNoV2BK9WuZrZM54f7OfrVloGRyp5q8aVASp6XpIw', 'test123@gmail.com', NULL, '', 0),
(11, '', '', '2024-06-02', 'Sjcoqhj', '$argon2id$v=19$m=65536,t=4,p=1$UENwMzRDUy43WXZYOFJPTg$0BsGrJtNQ1C786HY1Ck+TnlXOt4yb8rT+saJWx1QHeU', 'ocdhouch@ksdjskd.skojd', NULL, '', 0),
(13, '', '', '2024-06-02', 'Eipfjosdij', '$argon2id$v=19$m=65536,t=4,p=1$amdnT3FoNXlNeEovS1hoVQ$2Q9q5jkhbos87aHL1RF605tZyC/P0yYLlWWZzGJ4vpQ', 'kejfoij@foisdjfosj.kjofjsd', NULL, '', 0),
(14, '', '', '2024-06-02', 'Salut', '$argon2id$v=19$m=65536,t=4,p=1$eklJR0NsQ1ZoejAuSi5Zeg$BigXRosFsuvi8LoPOwCkuNB2HjEjOfnBCQMU5zNgbbs', '123@gmail.com', NULL, '', 0),
(15, '', '', '2024-06-02', 'Coucou', '$argon2id$v=19$m=65536,t=4,p=1$em5OS21iZ2ljWm9xZjY0Yw$TGIuvifFtTGl1efQqd9Oe1oWprRTNM7+OUI6KeyJ6JA', '1234@gmail.com', NULL, '', 0),
(16, '', '', '2024-06-02', 'Dinguerie123', '$argon2id$v=19$m=65536,t=4,p=1$UU9QQjJhRjBlRjY2akoyQQ$2/yxS2h9QNp+xGJx6Ac128xPTbSpWJ1sMUNvUqZPiDc', 'dinguerie123@gmail.com', NULL, '', 0),
(17, '', '', '2024-06-02', 'Chut123', '$argon2id$v=19$m=65536,t=4,p=1$QTZQQ2VFTEV1Wm5ldzlCTA$RlP3AdSg6uuk+L3A2+l+Nki7roUJnU6/R7Vxq7UmsPE', 'chut123@gmail.com', NULL, '', 0),
(18, '', '', '2024-06-02', 'Admin', '$argon2id$v=19$m=65536,t=4,p=1$Z3RoazRiMzRyRGIuM21ocQ$OAg+G1V1chIK45Prs0+0zuDgb8lqQO4P1P2BF6W4feY', 'admin@admin.admin', NULL, '', 2),
(19, '', '', '2024-06-02', 'Modérateur', '$argon2id$v=19$m=65536,t=4,p=1$MXg0QjVzWHUuWi9rZVQ1Vw$6tiW7dgfb6miH9MMLtt7z+YvKgi8CW5ILFTeU+SXErE', 'modo@modo.modo', NULL, '', 3),
(20, '', '', '2024-06-03', 'Test7', '$argon2id$v=19$m=65536,t=4,p=1$MkFEMksyRTNsa010MHh5Qg$c1B6jSBLwukDDFcPobmnmdq1nu50N2wci3s1TlNVoLI', 'test7@test.fr', NULL, '', 0),
(21, '', '', '2024-06-03', 'Sinane', '$argon2id$v=19$m=65536,t=4,p=1$UUVQU1Bhc3l4c1lseTBJQQ$myn/jrXE5sx4Kjgdtb3DEqBR1suqBZL2fYTLmSRO/ZA', 'sinaneadi@gmail.com', NULL, '', 1),
(22, '', '', '2024-06-03', 'Test10', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'test123@gmail.com', NULL, '', 0),
(23, '', '', '2024-06-03', 'Test123', 'a8327d4a49d4631631d090a72297d8d749337a30e6eb0416bd3655b71e36481b', 'test@test.test', NULL, '', 0),
(24, '', '', '2024-06-04', 'Salut123', '$2y$10$fnEVwnqLUeM18MztHjutCeMDiGFuaeOlASR3pA40R0QO6RQoVOIEC', 'slt@gmail.com', NULL, '', 0);

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
  ADD PRIMARY KEY (`ID_forum`);

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
  ADD KEY `ID_forum` (`ID_forum`),
  ADD KEY `ID_user` (`ID_user`);

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
  MODIFY `ID_forum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `ID_topic` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`ID_forum`) REFERENCES `forum` (`ID_forum`),
  ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
