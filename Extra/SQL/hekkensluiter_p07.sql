-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 jun 2023 om 01:12
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hekkensluiter_p07`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bezoekers`
--

CREATE TABLE `bezoekers` (
  `bezoek_id` int(11) NOT NULL,
  `naam_bezoeker` varchar(50) NOT NULL,
  `email_bezoeker` varchar(50) NOT NULL,
  `naam_gevangenen` varchar(50) NOT NULL,
  `reden_bezoek` varchar(100) NOT NULL,
  `bezoek_verzoek_id` int(11) NOT NULL DEFAULT 1,
  `tijd` time NOT NULL,
  `datum` date NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bezoekers`
--

INSERT INTO `bezoekers` (`bezoek_id`, `naam_bezoeker`, `email_bezoeker`, `naam_gevangenen`, `reden_bezoek`, `bezoek_verzoek_id`, `tijd`, `datum`, `create_date`) VALUES
(127, 'test', '47854@hoornbeeck.nl', 'test', 'test', 2, '14:53:00', '2023-06-22', '2023-06-19 21:46:30'),
(128, 'test', 'julianvstavel@gmail.com', 'test', 'test', 3, '14:47:00', '2023-06-18', '2023-06-19 21:48:42'),
(129, 'testadd', '47854@hoornbeeck.nl', 'testadd', 'testadd', 2, '14:26:00', '2023-06-21', '2023-06-20 11:08:41'),
(130, 'Dick', 'famvanstavel@ziggo.nl', 'Annette', 'Gezelligheid', 3, '14:49:00', '2023-06-28', '2023-06-23 15:47:13'),
(132, 'test', 'test@gmail.com', 'test', 'test', 1, '14:18:00', '2023-06-15', '2023-06-23 01:18:51'),
(133, 'test', 'test@gmail.com', 'test', 'test', 1, '15:18:00', '2023-06-14', '2023-06-23 01:19:15');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bezoek_verzoek`
--

CREATE TABLE `bezoek_verzoek` (
  `bezoek_verzoek_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bezoek_verzoek`
--

INSERT INTO `bezoek_verzoek` (`bezoek_verzoek_id`, `status`) VALUES
(1, 'Afwachting'),
(2, 'Geaccepteerd'),
(3, 'Afgewezen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cellen`
--

CREATE TABLE `cellen` (
  `vleugel_cel_id` int(11) NOT NULL,
  `vleugel_cel_nr` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `cellen`
--

INSERT INTO `cellen` (`vleugel_cel_id`, `vleugel_cel_nr`) VALUES
(1, 'A01'),
(2, 'A02'),
(3, 'A03'),
(4, 'A04'),
(5, 'A05'),
(6, 'A06'),
(7, 'A07'),
(8, 'A08'),
(9, 'A09'),
(10, 'A10'),
(11, 'B01'),
(12, 'B02'),
(13, 'B03'),
(14, 'B04'),
(15, 'B05'),
(16, 'B06'),
(17, 'B07'),
(18, 'B08'),
(19, 'B09'),
(20, 'B10'),
(21, 'C01'),
(22, 'C02'),
(23, 'C03'),
(24, 'C04'),
(25, 'C05'),
(26, 'C06'),
(27, 'C07'),
(28, 'C08'),
(29, 'C09'),
(30, 'C10');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cellen_bezetting`
--

CREATE TABLE `cellen_bezetting` (
  `cellen_bezetting_id` int(11) NOT NULL,
  `vleugel_cel_id` int(11) NOT NULL,
  `id_gevangenen` int(11) NOT NULL,
  `datum_begin` date NOT NULL,
  `datum_eind` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `cellen_bezetting`
--

INSERT INTO `cellen_bezetting` (`cellen_bezetting_id`, `vleugel_cel_id`, `id_gevangenen`, `datum_begin`, `datum_eind`) VALUES
(279751, 12, 4, '2023-06-25', '0000-00-00'),
(639851, 3, 2, '2023-06-23', '2023-06-23'),
(836524, 4, 2, '2023-06-23', '0000-00-00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `files`
--

CREATE TABLE `files` (
  `files_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longblob NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_gevangenen` int(11) DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `files`
--

INSERT INTO `files` (`files_id`, `name`, `content`, `type`, `description`, `id_gevangenen`, `category`) VALUES
(34, 'Testbewijs.txt', '', 'text/plain', 'Test bewijsmateriaal voor testen van PHP bestanden en SQL database', 1, 'Bewijsmateriaal');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `functie`
--

CREATE TABLE `functie` (
  `functie_id` int(11) NOT NULL,
  `functie_naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `functie`
--

INSERT INTO `functie` (`functie_id`, `functie_naam`) VALUES
(1, 'bewaker'),
(2, 'coordinator'),
(3, 'directeur'),
(4, 'admin'),
(5, 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `functie_permissie`
--

CREATE TABLE `functie_permissie` (
  `functie_id` int(11) NOT NULL,
  `permissie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `functie_permissie`
--

INSERT INTO `functie_permissie` (`functie_id`, `permissie_id`) VALUES
(1, 1),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gevangenen`
--

CREATE TABLE `gevangenen` (
  `id_gevangenen` int(11) NOT NULL,
  `naam_gevangenen` varchar(50) NOT NULL,
  `woonplaats` varchar(50) NOT NULL,
  `begin_straf` date NOT NULL,
  `eind_straf` date NOT NULL,
  `reden_straf` varchar(50) NOT NULL,
  `vleugel_cel_nr` varchar(10) NOT NULL,
  `cellen_bezetting_id` int(11) NOT NULL,
  `bezoek_aantal` int(11) NOT NULL,
  `opmerking` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `gevangenen`
--

INSERT INTO `gevangenen` (`id_gevangenen`, `naam_gevangenen`, `woonplaats`, `begin_straf`, `eind_straf`, `reden_straf`, `vleugel_cel_nr`, `cellen_bezetting_id`, `bezoek_aantal`, `opmerking`) VALUES
(1, 'gevangenen1', 'Amsterdam', '2023-04-21', '2023-08-04', '', 'A01', 0, 0, ''),
(2, 'gevangenen2', 'Rotterdam', '2023-02-14', '2023-04-27', '', 'A04', 836524, 0, 'Agressief'),
(3, 'gevangenen3', 'Hengelo', '2023-03-16', '2025-03-13', '', 'A10', 0, 0, ''),
(4, 'gevangenen4', 'Utrecht', '2023-02-14', '2024-02-09', '', 'B02', 279751, 0, ''),
(5, 'gevangenen5', 'Groningen', '2018-04-05', '2026-08-19', '', 'B05', 0, 0, 'Gevaarlijk'),
(6, 'gevangenen6', 'Lelystad', '2018-04-02', '2030-04-16', '', 'C01', 0, 0, ''),
(7, 'gevangenen7', 'den Haag', '2023-03-24', '2023-04-23', '', 'C04', 0, 0, 'Goed gedrag');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `permissie`
--

CREATE TABLE `permissie` (
  `permissie_id` int(11) NOT NULL,
  `permissie_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `permissie`
--

INSERT INTO `permissie` (`permissie_id`, `permissie_desc`) VALUES
(1, 'Bezoek review'),
(2, 'Bezoek edit'),
(3, 'Bezoek delete'),
(4, 'Gevangenen cel history'),
(5, 'Gevangenen edit'),
(6, 'Gevangenen delete'),
(7, 'Gevangenen bestanden'),
(8, 'Beheermodule'),
(9, 'Functie edit'),
(10, 'Functie delete'),
(11, 'Functie toevoegen'),
(12, 'Permissies'),
(13, 'Rol aanmaken'),
(14, 'Overzicht personeel');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personeel`
--

CREATE TABLE `personeel` (
  `id_personeel` int(11) NOT NULL,
  `naam_personeel` varchar(50) NOT NULL,
  `gebruikersnaam` varchar(50) NOT NULL,
  `functie_id` int(11) NOT NULL,
  `email_personeel` varchar(50) NOT NULL,
  `wwhash` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `personeel`
--

INSERT INTO `personeel` (`id_personeel`, `naam_personeel`, `gebruikersnaam`, `functie_id`, `email_personeel`, `wwhash`, `token`) VALUES
(1, 'Opperhek', 'Opperhek', 3, 'opperhek@hoornhack.com', '$2y$10$ZT9G41V7xm2aCCfd2Clx3ee6B4J6nutJcbwKNTvG7QfN/p8ojMQ9O', 'd2a911e0f5c12fe2f88bd155af2c1a40fcf703e6e3a0bf55266f5af62dc340f6'),
(2, 'Menno', 'Coordinator1', 2, 'menno@hoornhack.com', '$2y$10$pLaOJISMu02vTmE3XSYJtuUjfPTqlsD1.bnRKCwqlb.dQZ6nPsaDW', 'd2a911e0f5c12fe2f88bd155af2c1a40fcf703e6e3a0bf55266f5af62dc340f6'),
(3, 'Aiden', 'Coordinator2', 2, 'aiden@hoornhack.com', '$2y$10$wma3Hb5gOkgX.nS/wK/IT.EqS1xOPAnx2HtbadgpwXFUTg06cLbwC', 'd2a911e0f5c12fe2f88bd155af2c1a40fcf703e6e3a0bf55266f5af62dc340f6'),
(4, 'Juan', 'Bewaker1', 1, 'juan@hoornhack.com', '$2y$10$CsZkOOuuy0ao28f727dQ1.VbPIZVhKFSvel2cqZ2Queou4E21dhca', 'd2a911e0f5c12fe2f88bd155af2c1a40fcf703e6e3a0bf55266f5af62dc340f6'),
(5, 'Jack', 'Bewaker2', 1, 'jack@hoornhack.com', '$2y$10$XXX2R5S4c8GBQUKtEzHQsulXWxwRIOeluKCFweCNU/Z3cc7Rd9LTS', 'd2a911e0f5c12fe2f88bd155af2c1a40fcf703e6e3a0bf55266f5af62dc340f6'),
(6, 'Herman', 'Bewaker3', 1, 'herman@hoornhack.com', '$2y$10$3cMBRiEhhsEoB4Ap3CEX7.V0aoXvQbB6BsPijfdIKbPPecN45Bznq', 'd2a911e0f5c12fe2f88bd155af2c1a40fcf703e6e3a0bf55266f5af62dc340f6'),
(7, 'Adam', 'Bewaker4', 1, 'adam@hoornhack.com', '$2y$10$ibEoGHuatrKnDhQvNoyAGuEsOJn0taR3qLjujsQKM7aIh4vhGHrCa', 'd2a911e0f5c12fe2f88bd155af2c1a40fcf703e6e3a0bf55266f5af62dc340f6'),
(8, 'Piet', 'Bewaker5', 1, 'piet@hoornhack.com', '$2y$10$RPjaNOPwDQ5.Yw0sX0mp5eaoI/QDKzEhMQvpzeI1IF1xSjG/u/6zG', 'd2a911e0f5c12fe2f88bd155af2c1a40fcf703e6e3a0bf55266f5af62dc340f6'),
(9, 'Julian', 'admingn', 4, '47854@hoornbeeck.nl', '$2y$10$Fih1VTSCSJ.LaKBqb4pvie4lTrShRRgfWKr2bWmj6DYeKc1iZwb0m', 'a6a2e64afd4d794c2838e0157ec65676397fed6eb2816cf97401089e0e00871e'),
(10, 'Julian', 'bewakergn', 1, 'julianvstavel@gmail.com', '$2y$10$Jxg.xjOZsSiLr7R3/1Iu8u5osR1IaSUNT1t9V/FusCvAvwKOQDdvK', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bezoekers`
--
ALTER TABLE `bezoekers`
  ADD PRIMARY KEY (`bezoek_id`);

--
-- Indexen voor tabel `bezoek_verzoek`
--
ALTER TABLE `bezoek_verzoek`
  ADD PRIMARY KEY (`bezoek_verzoek_id`);

--
-- Indexen voor tabel `cellen`
--
ALTER TABLE `cellen`
  ADD PRIMARY KEY (`vleugel_cel_id`);

--
-- Indexen voor tabel `cellen_bezetting`
--
ALTER TABLE `cellen_bezetting`
  ADD PRIMARY KEY (`cellen_bezetting_id`),
  ADD KEY `vleugel_cel_id` (`vleugel_cel_id`),
  ADD KEY `id_gevangenen` (`id_gevangenen`);

--
-- Indexen voor tabel `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`files_id`),
  ADD KEY `id_gevangenen` (`id_gevangenen`);

--
-- Indexen voor tabel `functie`
--
ALTER TABLE `functie`
  ADD PRIMARY KEY (`functie_id`);

--
-- Indexen voor tabel `functie_permissie`
--
ALTER TABLE `functie_permissie`
  ADD KEY `fk_functie_permissie_permissie` (`permissie_id`);

--
-- Indexen voor tabel `gevangenen`
--
ALTER TABLE `gevangenen`
  ADD PRIMARY KEY (`id_gevangenen`),
  ADD KEY `vleugel_cel_id` (`vleugel_cel_nr`);

--
-- Indexen voor tabel `permissie`
--
ALTER TABLE `permissie`
  ADD PRIMARY KEY (`permissie_id`);

--
-- Indexen voor tabel `personeel`
--
ALTER TABLE `personeel`
  ADD PRIMARY KEY (`id_personeel`),
  ADD KEY `fk_personeel_functie` (`functie_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bezoekers`
--
ALTER TABLE `bezoekers`
  MODIFY `bezoek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT voor een tabel `bezoek_verzoek`
--
ALTER TABLE `bezoek_verzoek`
  MODIFY `bezoek_verzoek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `cellen`
--
ALTER TABLE `cellen`
  MODIFY `vleugel_cel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT voor een tabel `files`
--
ALTER TABLE `files`
  MODIFY `files_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `gevangenen`
--
ALTER TABLE `gevangenen`
  MODIFY `id_gevangenen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT voor een tabel `permissie`
--
ALTER TABLE `permissie`
  MODIFY `permissie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `personeel`
--
ALTER TABLE `personeel`
  MODIFY `id_personeel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `cellen_bezetting`
--
ALTER TABLE `cellen_bezetting`
  ADD CONSTRAINT `cellen_bezetting_ibfk_1` FOREIGN KEY (`vleugel_cel_id`) REFERENCES `cellen` (`vleugel_cel_id`),
  ADD CONSTRAINT `cellen_bezetting_ibfk_2` FOREIGN KEY (`id_gevangenen`) REFERENCES `gevangenen` (`id_gevangenen`);

--
-- Beperkingen voor tabel `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`id_gevangenen`) REFERENCES `gevangenen` (`id_gevangenen`);

--
-- Beperkingen voor tabel `functie_permissie`
--
ALTER TABLE `functie_permissie`
  ADD CONSTRAINT `fk_functie_permissie_functie` FOREIGN KEY (`functie_id`) REFERENCES `functie` (`functie_id`),
  ADD CONSTRAINT `fk_functie_permissie_permissie` FOREIGN KEY (`permissie_id`) REFERENCES `permissie` (`permissie_id`);

--
-- Beperkingen voor tabel `personeel`
--
ALTER TABLE `personeel`
  ADD CONSTRAINT `fk_personeel_functie` FOREIGN KEY (`functie_id`) REFERENCES `functie` (`functie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
