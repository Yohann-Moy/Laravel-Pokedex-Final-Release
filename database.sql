-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour laravellpokedex_hasmany
CREATE DATABASE IF NOT EXISTS `laravellpokedex_hasmany` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `laravellpokedex_hasmany`;

-- Listage de la structure de la table laravellpokedex_hasmany. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table laravellpokedex_hasmany.failed_jobs : ~0 rows (environ)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table laravellpokedex_hasmany. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table laravellpokedex_hasmany.migrations : ~5 rows (environ)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_02_22_105153_create_pokemon', 1),
	(5, '2020_02_27_131619_create_pokemon_user_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table laravellpokedex_hasmany. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table laravellpokedex_hasmany.password_resets : ~0 rows (environ)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table laravellpokedex_hasmany. pokemon
CREATE TABLE IF NOT EXISTS `pokemon` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MissingN0',
  `type1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Vol',
  `type2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/',
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/img/missingno.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table laravellpokedex_hasmany.pokemon : ~12 rows (environ)
DELETE FROM `pokemon`;
/*!40000 ALTER TABLE `pokemon` DISABLE KEYS */;
INSERT INTO `pokemon` (`id`, `numero`, `nom`, `type1`, `type2`, `image`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Bulbizarre', 'Plante', 'Poison', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/001.png', '2020-04-04 21:53:33', '2020-04-04 21:53:33'),
	(2, 2, 'Herbizarre', 'Plante', 'Poison', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/002.png', '2020-04-04 21:54:00', '2020-04-04 21:54:00'),
	(3, 3, 'Florizarre', 'Plante', 'Poison', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/003.png', '2020-04-04 21:54:18', '2020-04-04 21:54:18'),
	(4, 4, 'Salamèche', 'Feu', '/', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/004.png', '2020-04-04 21:54:43', '2020-04-04 21:54:43'),
	(5, 5, 'Reptincel', 'Feu', '/', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/005.png', '2020-04-04 21:54:57', '2020-04-04 21:54:57'),
	(6, 6, 'Dracaufeu', 'Feu', 'Vol', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/006.png', '2020-04-04 21:55:16', '2020-04-04 21:55:16'),
	(7, 7, 'Carapuce', 'Eau', '/', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/007.png', '2020-04-04 21:55:34', '2020-04-04 21:55:34'),
	(8, 8, 'Carabaffe', 'Eau', '/', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/008.png', '2020-04-04 21:55:48', '2020-04-04 21:55:48'),
	(9, 9, 'Tortank', 'Eau', '/', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/009.png', '2020-04-04 21:56:06', '2020-04-04 21:56:06'),
	(10, 10, 'Chenipan', 'Insecte', '/', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/010.png', '2020-04-04 21:56:50', '2020-04-04 21:56:50'),
	(11, 11, 'Chrysacier', 'Insecte', '/', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/011.png', '2020-04-04 21:57:13', '2020-04-04 21:57:13'),
	(12, 12, 'Papilusion', 'Insecte', 'Vol', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/012.png', '2020-04-04 21:57:38', '2020-04-04 21:57:38');
/*!40000 ALTER TABLE `pokemon` ENABLE KEYS */;

-- Listage de la structure de la table laravellpokedex_hasmany. pokemon_user
CREATE TABLE IF NOT EXISTS `pokemon_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pokemon_id` bigint(20) unsigned NOT NULL,
  `pkmn_surnom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/',
  `user_id` bigint(20) unsigned NOT NULL,
  `echange` tinyint(1) NOT NULL DEFAULT '0',
  `origin_trainer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `notification` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table laravellpokedex_hasmany.pokemon_user : ~0 rows (environ)
DELETE FROM `pokemon_user`;
/*!40000 ALTER TABLE `pokemon_user` DISABLE KEYS */;
INSERT INTO `pokemon_user` (`id`, `pokemon_id`, `pkmn_surnom`, `user_id`, `echange`, `origin_trainer`, `notification`, `created_at`, `updated_at`) VALUES
	(3, 1, 'Bourgeon', 5, 1, 'Louka', 0, NULL, NULL),
	(4, 4, 'Queue Qui Brule', 5, 0, 'Louka', 0, NULL, NULL),
	(5, 7, 'Tortue bleue', 5, 0, 'Louka', 0, NULL, NULL),
	(6, 2, 'Eclosion', 3, 0, 'Brice', 0, NULL, NULL),
	(7, 8, 'Mec vénère', 3, 0, 'Brice', 0, NULL, NULL),
	(8, 5, 'Barbecue', 3, 1, 'Brice', 0, NULL, NULL),
	(9, 3, 'Grosse fleur', 2, 0, 'Red', 0, NULL, NULL),
	(10, 6, 'Dragon de feu', 2, 0, 'Red', 0, NULL, NULL),
	(11, 9, 'Archibald the Turtle', 2, 1, 'Red', 0, NULL, NULL),
	(12, 10, 'Chenille verte', 4, 0, 'Silver', 0, NULL, NULL),
	(13, 11, 'Chrysalide', 4, 0, 'Silver', 0, NULL, NULL),
	(14, 12, 'Papillon moche', 4, 1, 'Silver', 0, NULL, NULL);
/*!40000 ALTER TABLE `pokemon_user` ENABLE KEYS */;

-- Listage de la structure de la table laravellpokedex_hasmany. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table laravellpokedex_hasmany.users : ~5 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$3nqwSXFEf.Hp2PTruftNh.pPbvQhIjPep9LOL5hJnB..zEhQdx8lu', 1, NULL, '2020-04-04 21:48:19', '2020-04-04 21:48:19'),
	(2, 'Red', 'red@gmail.com', NULL, '$2y$10$MlAhyifFwPZ/9NK1qoD.p.g6TfFipLIyQA/s9826I1kSCBMnP0p0a', 0, NULL, '2020-04-04 21:50:28', '2020-04-04 21:50:28'),
	(3, 'Brice', 'brice@gmail.com', NULL, '$2y$10$LCX17cs/jCEb65TU5TzAZOvcdvmq.c1uX3maJg2h8iPECKaazl/xq', 0, NULL, '2020-04-04 21:52:02', '2020-04-04 21:52:02'),
	(4, 'Silver', 'silver@gmail.com', NULL, '$2y$10$Jr8/OndAWYQ/wGdBpY/4cOvKAqWYoBm6AdKgUNF1wpFMZXRkxpO2G', 0, NULL, '2020-04-04 21:52:30', '2020-04-04 21:52:30'),
	(5, 'Louka', 'louka@gmail.com', NULL, '$2y$10$GcElbeb5gHsd/CcAMkdQoO5mPAEkJih1HARC9Gu2rVKwmVOPLxyJS', 0, NULL, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
