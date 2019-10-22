-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Ott 22, 2019 alle 15:45
-- Versione del server: 5.7.27-0ubuntu0.18.04.1
-- Versione PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `ID_auto` varchar(30) NOT NULL,
  `marca` text NOT NULL,
  `modello` text NOT NULL,
  `costo` double NOT NULL,
  `cilindrata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `bara`
--

CREATE TABLE `bara` (
  `ID_bara` varchar(30) NOT NULL,
  `ID_tipo_bara` varchar(30) NOT NULL,
  `ID_mat_bara` varchar(30) NOT NULL,
  `costo_base` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `composizione`
--

CREATE TABLE `composizione` (
  `ID_composizione` varchar(30) NOT NULL,
  `nome_composizione` text NOT NULL,
  `costo_base` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `funerale`
--

CREATE TABLE `funerale` (
  `cf_defunto` varchar(16) NOT NULL,
  `nome_defunto` text NOT NULL,
  `cognome_defunto` int(50) NOT NULL,
  `data_nascita` date NOT NULL,
  `data_decesso` date NOT NULL,
  `nome_cliente` text NOT NULL,
  `cognome_cliente` text NOT NULL,
  `num_telefono` varchar(10) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_tipo` varchar(30) NOT NULL,
  `ID_bara` varchar(30) NOT NULL,
  `ID_urna` varchar(30) DEFAULT NULL,
  `ID_auto` varchar(30) NOT NULL,
  `ID_ordine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `materiale_bara`
--

CREATE TABLE `materiale_bara` (
  `ID_mat_bara` varchar(30) NOT NULL,
  `nome_materiale` text NOT NULL,
  `surplus_costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `materiale_urna`
--

CREATE TABLE `materiale_urna` (
  `ID_mat_urna` varchar(30) NOT NULL,
  `nome_materiale` text NOT NULL,
  `surplus_costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine_fiori`
--

CREATE TABLE `ordine_fiori` (
  `ID_ordine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `riga_ordine`
--

CREATE TABLE `riga_ordine` (
  `ID_riga` int(11) NOT NULL,
  `ID_ordine` int(11) NOT NULL,
  `ID_composizzione` varchar(30) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_bara`
--

CREATE TABLE `tipo_bara` (
  `ID_tipo_bara` varchar(30) NOT NULL,
  `nome_tipo` text NOT NULL,
  `surplus_costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_fun`
--

CREATE TABLE `tipo_fun` (
  `ID_tipo` varchar(30) NOT NULL,
  `nome_modalita` text NOT NULL,
  `costo_base` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_urna`
--

CREATE TABLE `tipo_urna` (
  `ID_tipo_urna` varchar(30) NOT NULL,
  `nome_tipo` text NOT NULL,
  `surplus_costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `urna`
--

CREATE TABLE `urna` (
  `ID_urna` varchar(30) NOT NULL,
  `ID_tipo_urna` varchar(30) NOT NULL,
  `ID_mat_urna` varchar(30) NOT NULL,
  `costo_base` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`ID_auto`);

--
-- Indici per le tabelle `bara`
--
ALTER TABLE `bara`
  ADD PRIMARY KEY (`ID_bara`),
  ADD KEY `materiale_bara` (`ID_mat_bara`),
  ADD KEY `tipo_bara` (`ID_tipo_bara`);

--
-- Indici per le tabelle `composizione`
--
ALTER TABLE `composizione`
  ADD PRIMARY KEY (`ID_composizione`);

--
-- Indici per le tabelle `funerale`
--
ALTER TABLE `funerale`
  ADD PRIMARY KEY (`cf_defunto`),
  ADD KEY `tipo` (`ID_tipo`),
  ADD KEY `bara` (`ID_bara`),
  ADD KEY `urna` (`ID_urna`),
  ADD KEY `auto` (`ID_auto`),
  ADD KEY `fiori` (`ID_ordine`);

--
-- Indici per le tabelle `materiale_bara`
--
ALTER TABLE `materiale_bara`
  ADD PRIMARY KEY (`ID_mat_bara`);

--
-- Indici per le tabelle `materiale_urna`
--
ALTER TABLE `materiale_urna`
  ADD PRIMARY KEY (`ID_mat_urna`);

--
-- Indici per le tabelle `ordine_fiori`
--
ALTER TABLE `ordine_fiori`
  ADD PRIMARY KEY (`ID_ordine`);

--
-- Indici per le tabelle `riga_ordine`
--
ALTER TABLE `riga_ordine`
  ADD PRIMARY KEY (`ID_riga`),
  ADD KEY `composizione` (`ID_composizzione`),
  ADD KEY `ordine_riferimento` (`ID_ordine`);

--
-- Indici per le tabelle `tipo_bara`
--
ALTER TABLE `tipo_bara`
  ADD PRIMARY KEY (`ID_tipo_bara`);

--
-- Indici per le tabelle `tipo_fun`
--
ALTER TABLE `tipo_fun`
  ADD PRIMARY KEY (`ID_tipo`);

--
-- Indici per le tabelle `tipo_urna`
--
ALTER TABLE `tipo_urna`
  ADD PRIMARY KEY (`ID_tipo_urna`);

--
-- Indici per le tabelle `urna`
--
ALTER TABLE `urna`
  ADD PRIMARY KEY (`ID_urna`),
  ADD KEY `tipo_urna` (`ID_tipo_urna`),
  ADD KEY `materiale_urna` (`ID_mat_urna`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ordine_fiori`
--
ALTER TABLE `ordine_fiori`
  MODIFY `ID_ordine` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `riga_ordine`
--
ALTER TABLE `riga_ordine`
  MODIFY `ID_riga` int(11) NOT NULL AUTO_INCREMENT;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bara`
--
ALTER TABLE `bara`
  ADD CONSTRAINT `materiale_bara` FOREIGN KEY (`ID_mat_bara`) REFERENCES `materiale_bara` (`ID_mat_bara`),
  ADD CONSTRAINT `tipo_bara` FOREIGN KEY (`ID_tipo_bara`) REFERENCES `tipo_bara` (`ID_tipo_bara`);

--
-- Limiti per la tabella `funerale`
--
ALTER TABLE `funerale`
  ADD CONSTRAINT `auto` FOREIGN KEY (`ID_auto`) REFERENCES `auto` (`ID_auto`),
  ADD CONSTRAINT `bara` FOREIGN KEY (`ID_bara`) REFERENCES `bara` (`ID_bara`),
  ADD CONSTRAINT `fiori` FOREIGN KEY (`ID_ordine`) REFERENCES `ordine_fiori` (`ID_ordine`),
  ADD CONSTRAINT `tipo` FOREIGN KEY (`ID_tipo`) REFERENCES `tipo_fun` (`ID_tipo`),
  ADD CONSTRAINT `urna` FOREIGN KEY (`ID_urna`) REFERENCES `urna` (`ID_urna`);

--
-- Limiti per la tabella `riga_ordine`
--
ALTER TABLE `riga_ordine`
  ADD CONSTRAINT `composizione` FOREIGN KEY (`ID_composizzione`) REFERENCES `composizione` (`ID_composizione`),
  ADD CONSTRAINT `ordine_riferimento` FOREIGN KEY (`ID_ordine`) REFERENCES `ordine_fiori` (`ID_ordine`);

--
-- Limiti per la tabella `urna`
--
ALTER TABLE `urna`
  ADD CONSTRAINT `materiale_urna` FOREIGN KEY (`ID_mat_urna`) REFERENCES `materiale_urna` (`ID_mat_urna`),
  ADD CONSTRAINT `tipo_urna` FOREIGN KEY (`ID_tipo_urna`) REFERENCES `tipo_urna` (`ID_tipo_urna`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
