-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Ott 25, 2019 alle 13:06
-- Versione del server: 10.4.8-MariaDB
-- Versione PHP: 7.3.10

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
  `costoBase` double NOT NULL,
  `cilindrata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `bara`
--

CREATE TABLE `bara` (
  `id` int(11) NOT NULL,
  `versione` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materiale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cerimonia`
--

CREATE TABLE `cerimonia` (
  `id` int(11) NOT NULL,
  `tipologia` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `composizione`
--

CREATE TABLE `composizione` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `defunto`
--

CREATE TABLE `defunto` (
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
  `idAuto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `defunto_composizione`
--

CREATE TABLE `defunto_composizione` (
  `id` int(11) NOT NULL,
  `idDefunto` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idComposizione` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `urna`
--

CREATE TABLE `urna` (
  `id` int(11) NOT NULL,
  `versione` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materiale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costoBase` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `bara`
--
ALTER TABLE `bara`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `cerimonia`
--
ALTER TABLE `cerimonia`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `composizione`
--
ALTER TABLE `composizione`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `defunto`
--
ALTER TABLE `defunto`
  ADD PRIMARY KEY (`cf`),
  ADD KEY `cerimonia` (`idCerimonia`),
  ADD KEY `bara` (`idBara`),
  ADD KEY `urna` (`idUrna`),
  ADD KEY `auto` (`idAuto`);

--
-- Indici per le tabelle `defunto_composizione`
--
ALTER TABLE `defunto_composizione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `defunto` (`idDefunto`),
  ADD KEY `composizione` (`idComposizione`);

--
-- Indici per le tabelle `urna`
--
ALTER TABLE `urna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `bara`
--
ALTER TABLE `bara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cerimonia`
--
ALTER TABLE `cerimonia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `composizione`
--
ALTER TABLE `composizione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `defunto_composizione`
--
ALTER TABLE `defunto_composizione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `urna`
--
ALTER TABLE `urna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `defunto`
--
ALTER TABLE `defunto`
  ADD CONSTRAINT `auto` FOREIGN KEY (`idAuto`) REFERENCES `auto` (`id`),
  ADD CONSTRAINT `bara` FOREIGN KEY (`idBara`) REFERENCES `bara` (`id`),
  ADD CONSTRAINT `cerimonia` FOREIGN KEY (`idCerimonia`) REFERENCES `cerimonia` (`id`),
  ADD CONSTRAINT `urna` FOREIGN KEY (`idUrna`) REFERENCES `urna` (`id`);

--
-- Limiti per la tabella `defunto_composizione`
--
ALTER TABLE `defunto_composizione`
  ADD CONSTRAINT `composizione` FOREIGN KEY (`idComposizione`) REFERENCES `composizione` (`id`),
  ADD CONSTRAINT `defunto` FOREIGN KEY (`idDefunto`) REFERENCES `defunto` (`cf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
