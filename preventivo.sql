-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Giu 24, 2020 alle 13:05
-- Versione del server: 10.1.40-MariaDB
-- Versione PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `preventivo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `auto`
--

CREATE TABLE `auto` (
  `id` int(11) NOT NULL,
  `marca` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modello` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL,
  `cilindrata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `auto`
--

INSERT INTO `auto` (`id`, `marca`, `modello`, `costoBase`, `cilindrata`) VALUES
(1, 'Mercedes-Benz', 'Classe E', '2570.00', 3000),
(2, 'Maserati', 'Ghibli', '5000.50', 4000);

-- --------------------------------------------------------

--
-- Struttura della tabella `bare`
--

CREATE TABLE `bare` (
  `id` int(11) NOT NULL,
  `versione` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materiale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `bare`
--

INSERT INTO `bare` (`id`, `versione`, `materiale`, `costoBase`) VALUES
(1, 'Elemental', 'Vetroresina', '300.00'),
(2, 'RoofTop', 'Legno - Ebano', '60000.50'),
(3, 'Warhammer', 'Acciaio INOX', '3000.00'),
(4, 'Lounge', 'Oro 25k', '305000.87');

-- --------------------------------------------------------

--
-- Struttura della tabella `cerimonie`
--

CREATE TABLE `cerimonie` (
  `id` int(11) NOT NULL,
  `tipologia` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `cerimonie`
--

INSERT INTO `cerimonie` (`id`, `tipologia`, `costoBase`) VALUES
(1, 'Rito Buddista - Località Fontana Alta - Prato Erboso', '6000.55'),
(2, 'Rito Agnostico - Sala cerimonie funebri - Forni Crematori Borgoricco', '2000.00'),
(3, 'Rito cattolico - Chiesa Barocca - Parrocchia di S.Maria della Fusoliera', '800.00');

-- --------------------------------------------------------

--
-- Struttura della tabella `composizioni`
--

CREATE TABLE `composizioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `composizioni`
--

INSERT INTO `composizioni` (`id`, `nome`, `costoBase`) VALUES
(1, 'Fiordalisi', '20.50'),
(2, 'Rose Bianche', '45.00'),
(3, 'Lilium', '37.50'),
(4, 'Calle', '20.00');

-- --------------------------------------------------------

--
-- Struttura della tabella `defunti`
--

CREATE TABLE `defunti` (
  `cf` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeDefunto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cognomeDefunto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataNascita` date NOT NULL,
  `dataDecesso` date NOT NULL,
  `residenza` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeCliente` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cognomeCliente` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeroTelefono` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idCerimonia` int(11) NOT NULL,
  `idBara` int(11) NOT NULL,
  `idUrna` int(11) DEFAULT NULL,
  `idAuto` int(11) NOT NULL,
  `isPublic` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `defunti`
--

INSERT INTO `defunti` (`cf`, `nomeDefunto`, `cognomeDefunto`, `dataNascita`, `dataDecesso`, `residenza`, `nomeCliente`, `cognomeCliente`, `numeroTelefono`, `data`, `idCerimonia`, `idBara`, `idUrna`, `idAuto`, `isPublic`) VALUES
('BTTLSS91H02A459X', 'Alessio', 'Bettarello', '1991-06-02', '2020-06-20', 'Padova', 'Mattia', 'Gottardello', '3098754671', '2020-06-23 10:09:24', 1, NULL, 1, 1, 0),
('DNOBRN57H22A459X', 'Don', 'Barbano', '1957-06-22', '2020-05-13', 'Via della Speranza - S.Maria di Sala', 'Widspots', 'Pacchettino', '1234134123', '2020-06-23 15:13:47', 3, 4, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `defunti_composizioni`
--

CREATE TABLE `defunti_composizioni` (
  `id` int(11) NOT NULL,
  `idDefunto` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idComposizione` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `defunti_composizioni`
--

INSERT INTO `defunti_composizioni` (`id`, `idDefunto`, `idComposizione`, `quantita`) VALUES
(1, 'DNOBRN57H22A459X', 3, 5),
(2, 'DNOBRN57H22A459X', 1, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `urne`
--

CREATE TABLE `urne` (
  `id` int(11) NOT NULL,
  `versione` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materiale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `urne`
--

INSERT INTO `urne` (`id`, `versione`, `materiale`, `costoBase`) VALUES
(1, 'Mogadiscio', 'Vetroresina', '30.00'),
(2, 'Samurai', 'Ceramica', '4500.00'),
(3, 'Hardended', 'Acciaio INOX', '400.00'),
(4, 'Luxury', 'Oro 25 Carati', '45000.35');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `enc_password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `enc_password`) VALUES
(1, 'bettaz', 'ciao');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `bare`
--
ALTER TABLE `bare`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `cerimonie`
--
ALTER TABLE `cerimonie`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `composizioni`
--
ALTER TABLE `composizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `defunti`
--
ALTER TABLE `defunti`
  ADD PRIMARY KEY (`cf`),
  ADD KEY `cerimonia` (`idCerimonia`),
  ADD KEY `urna` (`idUrna`),
  ADD KEY `auto` (`idAuto`);

--
-- Indici per le tabelle `defunti_composizioni`
--
ALTER TABLE `defunti_composizioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `defunto` (`idDefunto`),
  ADD KEY `composizione` (`idComposizione`);

--
-- Indici per le tabelle `urne`
--
ALTER TABLE `urne`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `bare`
--
ALTER TABLE `bare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `cerimonie`
--
ALTER TABLE `cerimonie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `composizioni`
--
ALTER TABLE `composizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `defunti_composizioni`
--
ALTER TABLE `defunti_composizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `urne`
--
ALTER TABLE `urne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `defunti`
--
ALTER TABLE `defunti`
  ADD CONSTRAINT `auto` FOREIGN KEY (`idAuto`) REFERENCES `auto` (`id`),
  ADD CONSTRAINT `bara` FOREIGN KEY (`idBara`) REFERENCES `bare` (`id`),
  ADD CONSTRAINT `cerimonia` FOREIGN KEY (`idCerimonia`) REFERENCES `cerimonie` (`id`),
  ADD CONSTRAINT `urna` FOREIGN KEY (`idUrna`) REFERENCES `urne` (`id`);

--
-- Limiti per la tabella `defunti_composizioni`
--
ALTER TABLE `defunti_composizioni`
  ADD CONSTRAINT `composizione` FOREIGN KEY (`idComposizione`) REFERENCES `composizioni` (`id`),
  ADD CONSTRAINT `defunto` FOREIGN KEY (`idDefunto`) REFERENCES `defunti` (`cf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
