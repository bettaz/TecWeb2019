SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `preventivo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `preventivo`;

DROP TABLE IF EXISTS `auto`;
CREATE TABLE IF NOT EXISTS `auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modello` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL,
  `cilindrata` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `auto` (`id`, `marca`, `modello`, `costoBase`, `cilindrata`) VALUES
(2, 'Maserati', 'Ghibli', '5000.50', 4000),
(4, 'asd', 'asd', '123.00', 123);

DROP TABLE IF EXISTS `bare`;
CREATE TABLE IF NOT EXISTS `bare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `versione` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materiale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bare` (`id`, `versione`, `materiale`, `costoBase`) VALUES
(1, 'Elemental', 'Vetroresina', '300.00'),
(2, 'RoofTop', 'Legno - Ebano', '60000.50'),
(3, 'Warhammer', 'Acciaio INOX', '3000.00'),
(4, 'Lounge', 'Oro 25k', '305000.87');

DROP TABLE IF EXISTS `cerimonie`;
CREATE TABLE IF NOT EXISTS `cerimonie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipologia` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cerimonie` (`id`, `tipologia`, `costoBase`) VALUES
(1, 'Rito Buddista - Località Fontana Alta - Prato Erboso', '6000.55'),
(2, 'Rito Agnostico - Sala cerimonie funebri - Forni Crematori Borgoricco', '2000.00'),
(3, 'Rito cattolico - Chiesa Barocca - Parrocchia di S.Maria della Fusoliera', '800.00');

DROP TABLE IF EXISTS `composizioni`;
CREATE TABLE IF NOT EXISTS `composizioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `composizioni` (`id`, `nome`, `costoBase`) VALUES
(1, 'Fiordalisi', '20.50'),
(2, 'Rose Bianche', '45.00'),
(3, 'Lilium', '37.50'),
(4, 'Calle', '1.00'),
(25, 'asd', '1.00'),
(26, 'as', '123.00');

DROP TABLE IF EXISTS `defunti`;
CREATE TABLE IF NOT EXISTS `defunti` (
  `cf` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeDefunto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cognomeDefunto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataNascita` date NOT NULL,
  `dataDecesso` date NOT NULL,
  `residenza` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeCliente` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cognomeCliente` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeroTelefono` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idCerimonia` int(11) NOT NULL,
  `idBara` int(11) NOT NULL,
  `idUrna` int(11) DEFAULT NULL,
  `idAuto` int(11) NOT NULL,
  `isPublic` tinyint(1) NOT NULL DEFAULT 0,
  `proposta` decimal(13,2) DEFAULT NULL,
  `idFiori` int(11) NOT NULL,
  PRIMARY KEY (`cf`),
  KEY `cerimonia` (`idCerimonia`),
  KEY `urna` (`idUrna`),
  KEY `auto` (`idAuto`),
  KEY `bara` (`idBara`),
  KEY `idFiori` (`idFiori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `defunti` (`cf`, `nomeDefunto`, `cognomeDefunto`, `dataNascita`, `dataDecesso`, `residenza`, `nomeCliente`, `cognomeCliente`, `numeroTelefono`, `data`, `idCerimonia`, `idBara`, `idUrna`, `idAuto`, `isPublic`, `proposta`, `idFiori`) VALUES
('BTTLSS91H02A459X', 'Alessio', 'Bettarello', '1991-06-02', '2020-06-20', 'Padova', 'Mattia', 'Gottardello', '3098754671', '2020-07-12 09:41:22', 1, 2, 1, 1, 1, '10022.00', 1),
('DNOBRN57H22A429X', 'asd', 'asd', '2020-10-10', '2020-12-12', 'asd - asd (AT)', 'asd', 'asd', '123456789', '2020-08-12 14:29:23', 2, 2, 2, 2, 0, NULL, 1),
('DNOBRN57H22A459X', 'Don', 'Barbano', '1957-06-22', '2020-05-13', 'Via della Speranza - S.Maria di Sala', 'Widspots', 'Pacchettino', '1234134123', '2020-07-12 09:42:37', 3, 4, NULL, 2, 1, '0.00', 3),
('DNOBRN57H22A469X', 'SDFFDS', 'ASDFSDA', '1212-12-12', '2020-11-13', 'asd 12 - asd (AO)', 'asd', 'asd', '123456789', '2020-08-11 13:31:58', 1, 1, 1, 2, 0, NULL, 1);

DROP TABLE IF EXISTS `urne`;
CREATE TABLE IF NOT EXISTS `urne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `versione` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materiale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `urne` (`id`, `versione`, `materiale`, `costoBase`) VALUES
(1, 'Mogadiscio', 'Vetroresina', '30.00'),
(2, 'Samurai', 'Ceramica', '4500.00'),
(3, 'Hardended', 'Acciaio INOX', '400.00'),
(4, 'Luxury', 'Oro 25 Carati', '45000.35'),
(6, 'asd', 'asd', '123.00');

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `enc_password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `enc_password`) VALUES
(1, 'bettaz', 'a0b5d3e939ba85297973c12c8e0a256b7d6635d73fbe17650ea7c60662254a28'),
(2, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');


ALTER TABLE `defunti`
  ADD CONSTRAINT `defunti_ibfk_1` FOREIGN KEY (`idAuto`) REFERENCES `auto` (`id`),
  ADD CONSTRAINT `defunti_ibfk_2` FOREIGN KEY (`idUrna`) REFERENCES `urne` (`id`),
  ADD CONSTRAINT `defunti_ibfk_3` FOREIGN KEY (`idCerimonia`) REFERENCES `cerimonie` (`id`),
  ADD CONSTRAINT `defunti_ibfk_4` FOREIGN KEY (`idBara`) REFERENCES `bare` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
