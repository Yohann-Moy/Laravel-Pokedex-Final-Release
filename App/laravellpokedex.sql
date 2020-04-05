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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table laravellpokedex_hasmany.pokemon : ~3 rows (environ)
/*!40000 ALTER TABLE `pokemon` DISABLE KEYS */;
INSERT INTO `pokemon` (`id`, `numero`, `nom`, `type1`, `type2`, `image`, `created_at`, `updated_at`) VALUES
	(2, 1, 'Bulbizarre', 'Electrik', 'Plante', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/001.png', '2020-02-27 22:17:21', '2020-02-28 11:15:39'),
	(4, 3, 'Herbizarre', 'Plante', 'Poison', 'https://assets.pokemon.com/assets/cms2/img/pokedex/detail/002.png', '2020-02-28 00:50:05', '2020-02-28 11:15:26'),
	(5, 0, 'MissingN0', '/', '/', '/img/missingno.png', '2020-02-28 11:18:23', '2020-02-28 11:18:23');
/*!40000 ALTER TABLE `pokemon` ENABLE KEYS */;

-- Listage de la structure de la table laravellpokedex_hasmany. pokemon_user
CREATE TABLE IF NOT EXISTS `pokemon_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pokemon_id` bigint(20) unsigned NOT NULL,
  `pkmn_surnom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/',
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table laravellpokedex_hasmany.pokemon_user : ~3 rows (environ)
/*!40000 ALTER TABLE `pokemon_user` DISABLE KEYS */;
INSERT INTO `pokemon_user` (`id`, `pokemon_id`, `pkmn_surnom`, `user_id`, `created_at`, `updated_at`) VALUES
	(12, 2, 'The Last Projkt', 2, NULL, NULL),
	(14, 2, '/', 2, NULL, NULL),
	(22, 4, 'ENCULEY', 3, NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table laravellpokedex_hasmany.users : ~2 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Yohann MOY', 'yohann.moy@gmail.com', NULL, '$2y$10$FE8glCm.bIYiP0mGStvQNe5Ock5HC.3uh43LqrFTm4j.XA48ETfHK', 1, NULL, '2020-02-27 22:16:55', '2020-02-27 22:16:55'),
	(2, 'TOUNA MAMA Dominique', 'infos@jassimile.com', NULL, '$2y$10$XGGjNoB/W7n3Sz0XCcoTQuT1Sm7peKmx78FNlBUsNnzkGaSD/005y', 0, NULL, '2020-02-27 22:18:28', '2020-02-27 22:18:28'),
	(3, 'ANTHEDESIGN', 'contact@anthedesign.fr', NULL, '$2y$10$nte69G6zNsANpV4fHApM6uVQz3E.4FlBu5pNgNK82CyC4.WZeBMbO', 0, NULL, '2020-02-28 00:46:00', '2020-02-28 00:46:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
