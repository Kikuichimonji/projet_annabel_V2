-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for annabel
CREATE DATABASE IF NOT EXISTS `annabel` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `annabel`;

-- Dumping structure for table annabel.cabinet
CREATE TABLE IF NOT EXISTS `cabinet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table annabel.cabinet: ~2 rows (approximately)
/*!40000 ALTER TABLE `cabinet` DISABLE KEYS */;
INSERT INTO `cabinet` (`id`, `libelle`) VALUES
	(5, 'Logelbach'),
	(11, 'Kunheim');
/*!40000 ALTER TABLE `cabinet` ENABLE KEYS */;

-- Dumping structure for table annabel.consultation
CREATE TABLE IF NOT EXISTS `consultation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `date_consult` datetime NOT NULL,
  `test` longtext COLLATE utf8mb4_unicode_ci,
  `traitement` longtext COLLATE utf8mb4_unicode_ci,
  `conseil` longtext COLLATE utf8mb4_unicode_ci,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `montant` double DEFAULT NULL,
  `numero_cheque` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anamnese` longtext COLLATE utf8mb4_unicode_ci,
  `moyen_paiement_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_964685A66B899279` (`patient_id`),
  KEY `IDX_964685A69C7E259C` (`moyen_paiement_id`),
  KEY `IDX_964685A6FB88E14F` (`utilisateur_id`),
  CONSTRAINT `FK_964685A66B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  CONSTRAINT `FK_964685A69C7E259C` FOREIGN KEY (`moyen_paiement_id`) REFERENCES `moyen_paiement` (`id`),
  CONSTRAINT `FK_964685A6FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table annabel.consultation: ~5 rows (approximately)
/*!40000 ALTER TABLE `consultation` DISABLE KEYS */;
INSERT INTO `consultation` (`id`, `patient_id`, `date_consult`, `test`, `traitement`, `conseil`, `note`, `montant`, `numero_cheque`, `anamnese`, `moyen_paiement_id`, `utilisateur_id`) VALUES
	(37, 31, '2020-10-05 00:00:00', 'aze', 'aze', 'aze', 'aze', 0, NULL, 'aze', 3, 6),
	(38, 31, '2020-09-30 00:00:00', 'aze', 'aze', 'ae', 'aze', 55, '77989', 'aze', 2, 6),
	(39, 31, '2020-10-14 00:00:00', 'aze', 'aze', 'aze', 'aze', 50, NULL, 'aze', 1, 6),
	(40, 31, '2020-09-09 00:00:00', 'aze', 'aze', 'aze', 'aze', 0, NULL, 'aze', 3, 6),
	(41, 30, '2020-10-01 00:00:00', 'test', 'traitement', 'conseil', 'note', 0, NULL, 'anamnèse', 3, 5),
	(42, 31, '2020-01-06 00:00:00', 'test', 'trait', 'conseil', 'note', 0, NULL, 'ana', 3, 5);
/*!40000 ALTER TABLE `consultation` ENABLE KEYS */;

-- Dumping structure for table annabel.consult_calendar
CREATE TABLE IF NOT EXISTS `consult_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table annabel.consult_calendar: ~0 rows (approximately)
/*!40000 ALTER TABLE `consult_calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `consult_calendar` ENABLE KEYS */;

-- Dumping structure for table annabel.doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table annabel.doctrine_migration_versions: ~0 rows (approximately)
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20200629093040', '2020-06-29 09:30:50', 407);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;

-- Dumping structure for table annabel.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `path` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_63540596B899279` (`patient_id`),
  CONSTRAINT `FK_63540596B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table annabel.files: ~0 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table annabel.moyen_paiement
CREATE TABLE IF NOT EXISTS `moyen_paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table annabel.moyen_paiement: ~3 rows (approximately)
/*!40000 ALTER TABLE `moyen_paiement` DISABLE KEYS */;
INSERT INTO `moyen_paiement` (`id`, `libelle`) VALUES
	(1, 'Espèce'),
	(2, 'Chèque'),
	(3, 'Non payé');
/*!40000 ALTER TABLE `moyen_paiement` ENABLE KEYS */;

-- Dumping structure for table annabel.patient
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loisir` longtext COLLATE utf8mb4_unicode_ci,
  `date_naissance` date NOT NULL,
  `num_fixe` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_portable` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `ant_tete` longtext COLLATE utf8mb4_unicode_ci,
  `ant_orl` longtext COLLATE utf8mb4_unicode_ci,
  `ant_ophtalmo` longtext COLLATE utf8mb4_unicode_ci,
  `ant_auditif` longtext COLLATE utf8mb4_unicode_ci,
  `ant_dent` longtext COLLATE utf8mb4_unicode_ci,
  `ant_pulmo` longtext COLLATE utf8mb4_unicode_ci,
  `ant_cardia` longtext COLLATE utf8mb4_unicode_ci,
  `ant_digest` longtext COLLATE utf8mb4_unicode_ci,
  `ant_urin` longtext COLLATE utf8mb4_unicode_ci,
  `ant_gyneco` longtext COLLATE utf8mb4_unicode_ci,
  `ant_endoc` longtext COLLATE utf8mb4_unicode_ci,
  `ant_dermato` longtext COLLATE utf8mb4_unicode_ci,
  `ant_famille` longtext COLLATE utf8mb4_unicode_ci,
  `ant_trauma` longtext COLLATE utf8mb4_unicode_ci,
  `ant_ope` longtext COLLATE utf8mb4_unicode_ci,
  `ant_prise_medic` longtext COLLATE utf8mb4_unicode_ci,
  `utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1ADAD7EBFB88E14F` (`utilisateur_id`),
  CONSTRAINT `FK_1ADAD7EBFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table annabel.patient: ~14 rows (approximately)
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` (`id`, `nom`, `prenom`, `sexe`, `adresse`, `code_postal`, `ville`, `email`, `profession`, `loisir`, `date_naissance`, `num_fixe`, `num_portable`, `date_creation`, `ant_tete`, `ant_orl`, `ant_ophtalmo`, `ant_auditif`, `ant_dent`, `ant_pulmo`, `ant_cardia`, `ant_digest`, `ant_urin`, `ant_gyneco`, `ant_endoc`, `ant_dermato`, `ant_famille`, `ant_trauma`, `ant_ope`, `ant_prise_medic`, `utilisateur_id`) VALUES
	(30, 'Jean', 'Michele', 'Homme', '2 rue de la bas', '6800', 'Colmar', NULL, NULL, NULL, '2013-01-05', '06 78 96 48 75', NULL, '2020-10-05 14:21:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(31, 'Jean', 'Remplaçant', 'femme', '55 rue random', '68147', 'Mulhouse', NULL, NULL, NULL, '2020-10-05', '07 04 08 09 90', NULL, '2020-10-05 14:36:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6),
	(32, 'Corette', 'Lavallée', 'femme', '54, avenue Voltaire', '64700', 'MAISONS-ALFORT', NULL, NULL, NULL, '1584-05-04', NULL, '06 79 74 7 15 32', '2020-10-05 14:44:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(33, 'Madelene', 'Marcil', 'femme', '60, Rue du Limas', '64100', 'BAYONNE', NULL, NULL, NULL, '1547-06-25', NULL, NULL, '2020-10-05 14:45:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(34, 'Ambra', 'Bourdette', 'femme', '46, Chemin des Bateliers', '20090', 'AJACCIO', NULL, NULL, NULL, '2654-03-21', NULL, NULL, '2020-10-05 14:46:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(35, 'Honoré', 'Busque', 'Homme', '63, Rue Frédéric Chopin', '78000', 'VERSAILLES', NULL, NULL, NULL, '2161-12-31', NULL, NULL, '2020-10-05 14:46:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(36, 'Élise', 'Lajeunesse', 'femme', '94, boulevard Albin Durand', '71100', 'CHALON-SUR-SAÔNE', NULL, NULL, NULL, '1985-01-10', '03.05.40.98.85', NULL, '2020-10-05 14:47:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(37, 'De La Vergne', 'Crescent', 'femme', '41, rue Nationale', '75005', 'PARIS', NULL, NULL, NULL, '0160-10-01', '01.14.28.83.11', NULL, '2020-10-05 14:48:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(38, 'Donat', 'Montminy', 'Homme', '23, Place de la Gare', '31770', 'COLOMIERS', NULL, NULL, NULL, '5044-06-10', NULL, NULL, '2020-10-05 14:49:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(39, 'Fournier', 'Neville', 'Homme', '53, rue de Penthièvre', '95000', 'PONTOISE', NULL, NULL, NULL, '9874-05-06', NULL, NULL, '2020-10-06 06:45:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(40, 'Paré', 'Nicolas', 'Homme', '1, Place du Jeu de Paume', '94800', 'VILLEJUIF', NULL, NULL, NULL, '4987-02-13', '06 78 96 48 75', NULL, '2020-10-06 06:46:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(41, 'Gauvin', 'Marthe', 'Homme', '88, rue des six frères Ruellan', '95110', 'SANNOIS', NULL, NULL, NULL, '1684-03-21', '01.61.16.38.11', NULL, '2020-10-06 06:49:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(42, 'Bellemare', 'Astrid', 'femme', '89, rue du Clair Bocage', '33260', 'LA TESTE-DE-BUCH', NULL, NULL, NULL, '6545-03-12', NULL, '05.94.44.30.07', '2020-10-06 06:51:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(43, 'Rabican', 'Fontaine', 'Homme', '41, rue de Raymond Poincaré', '93330', 'NEUILLY-SUR-MARNE', NULL, NULL, NULL, '9844-05-06', NULL, '01.49.14.93.43', '2020-10-06 06:52:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5);
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;

-- Dumping structure for table annabel.patient_cabinet
CREATE TABLE IF NOT EXISTS `patient_cabinet` (
  `patient_id` int(11) NOT NULL,
  `cabinet_id` int(11) NOT NULL,
  PRIMARY KEY (`patient_id`,`cabinet_id`),
  KEY `IDX_118E505B6B899279` (`patient_id`),
  KEY `IDX_118E505BD351EC` (`cabinet_id`),
  CONSTRAINT `FK_118E505B6B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_118E505BD351EC` FOREIGN KEY (`cabinet_id`) REFERENCES `cabinet` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table annabel.patient_cabinet: ~17 rows (approximately)
/*!40000 ALTER TABLE `patient_cabinet` DISABLE KEYS */;
INSERT INTO `patient_cabinet` (`patient_id`, `cabinet_id`) VALUES
	(30, 5),
	(30, 11),
	(31, 5),
	(31, 11),
	(32, 5),
	(32, 11),
	(33, 5),
	(34, 5),
	(35, 5),
	(36, 5),
	(37, 5),
	(38, 5),
	(39, 11),
	(40, 11),
	(41, 11),
	(42, 11),
	(43, 11);
/*!40000 ALTER TABLE `patient_cabinet` ENABLE KEYS */;

-- Dumping structure for table annabel.utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table annabel.utilisateur: ~2 rows (approximately)
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`id`, `username`, `password`, `roles`) VALUES
	(5, 'Osteo', '$argon2id$v=19$m=65536,t=4,p=1$dTY2bloxcFVEZTJXY3dGZw$jGNy/R6ON5BoZjmzRn7UA0vpzOkVfeJFtx8KUgTbsgM', '["ROLE_ADMIN"]'),
	(6, 'Remplacant', '$argon2id$v=19$m=65536,t=4,p=1$dVA4MG5vWVlXTHJORE9TVw$/jcwE1Cfb9w2dLWNEySXrC65FW4+AkxTHw5TjG/v1AI', '["ROLE_USER"]');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
