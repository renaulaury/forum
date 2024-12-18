-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forumlily
CREATE DATABASE IF NOT EXISTS `forumlily` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forumlily`;

-- Listage de la structure de table forumlily. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `typeCategory` varchar(50) NOT NULL,
  `sortCategory` int NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumlily.category : ~3 rows (environ)
REPLACE INTO `category` (`id_category`, `typeCategory`, `sortCategory`) VALUES
	(1, 'Expositions', 1),
	(2, 'Le coin des passionnés', 2),
	(3, 'Questions et conseils', 3);

-- Listage de la structure de table forumlily. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `postMsg` text NOT NULL,
  `postCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `FK1_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  CONSTRAINT `FK2_topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumlily.post : ~6 rows (environ)
REPLACE INTO `post` (`id_post`, `postMsg`, `postCreation`, `user_id`, `topic_id`) VALUES
	(1, 'Cool', '2024-12-17 20:36:35', 3, 6),
	(2, 'Trop génial !', '2024-12-17 20:37:11', 3, 1),
	(3, 'C\'était une expérience enivrante', '2024-12-17 20:37:40', 3, 3),
	(4, 'azzz', '2024-12-18 16:31:03', 1, 6),
	(5, 'vvv', '2024-12-18 16:31:05', 1, 6),
	(6, 'vvv', '2024-12-18 16:31:07', 1, 6);

-- Listage de la structure de table forumlily. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `topicTitle` varchar(50) NOT NULL,
  `topicCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `textTopic` text NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `categorie_id` (`category_id`) USING BTREE,
  CONSTRAINT `FK1_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK2_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumlily.topic : ~6 rows (environ)
REPLACE INTO `topic` (`id_topic`, `topicTitle`, `topicCreation`, `textTopic`, `locked`, `category_id`, `user_id`) VALUES
	(1, 'L\'incident de Kyujo', '2024-12-17 20:30:34', 'Bla', 0, 1, 1),
	(2, 'La guerre fédérale', '2024-12-17 20:32:45', 'Bla', 0, 1, 2),
	(3, 'La guerre d\'hiver', '2024-12-17 20:33:31', 'Bla', 0, 1, 1),
	(4, 'Pointillisme', '2024-12-17 20:34:03', 'Bloup', 0, 2, 3),
	(5, 'Broderie', '2024-12-17 20:34:56', 'Blurp', 0, 2, 3),
	(6, 'Jsuis perdu', '2024-12-17 20:35:31', 'sos', 0, 3, 3);

-- Listage de la structure de table forumlily. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumlily.user : ~4 rows (environ)
REPLACE INTO `user` (`id_user`, `nickname`, `mail`, `password`, `role`) VALUES
	(1, 'lily', 'lily@elan.fr', '1234', 'admin'),
	(2, 'mickael', 'micka@elan.fr', '1234', 'admin'),
	(3, 'bilou', 'biloup@gmail.com', '1234', 'user'),
	(4, 'blondeDu98', 'blondy@wanadoo.fr', '1234', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
