-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 apr 2023 om 22:07
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
  `naam_gevangenen` varchar(50) NOT NULL,
  `tijd` time NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bezoekers`
--

INSERT INTO `bezoekers` (`bezoek_id`, `naam_bezoeker`, `naam_gevangenen`, `tijd`, `datum`) VALUES
(5, 'Hannah Visser', 'Rik Balvers', '14:30:00', '2022-04-23'),
(6, 'Julian van Stavel', 'Siebren Bijl', '15:00:00', '2022-04-23'),
(7, 'Julian van Stavel', 'Dirk van Stavel', '12:00:00', '2022-05-07');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gevangenen`
--

CREATE TABLE `gevangenen` (
  `gevangenen_id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `woonplaats` varchar(50) NOT NULL,
  `begin_straf` date NOT NULL,
  `eind_straf` date NOT NULL,
  `cel_nummer` int(11) NOT NULL,
  `vleugel` varchar(11) NOT NULL,
  `opmerking` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `gevangenen`
--

INSERT INTO `gevangenen` (`gevangenen_id`, `naam`, `woonplaats`, `begin_straf`, `eind_straf`, `cel_nummer`, `vleugel`, `opmerking`) VALUES
(1, 'gevangenen1', 'Amsterdam', '2023-04-21', '2023-08-04', 1, 'A', ''),
(2, 'gevangenen2', 'Rotterdam', '2023-02-14', '2023-04-27', 2, 'A', 'Aggresief'),
(3, 'gevangenen3', 'Hengelo', '2023-03-16', '2025-03-13', 6, 'B', ''),
(4, 'gevangenen4', 'Utrecht', '2023-02-14', '2024-02-09', 7, 'B', ''),
(5, 'gevangenen5', 'Groningen', '2018-04-05', '2026-08-19', 15, 'C', 'Gevaarlijk'),
(6, 'gevangenen6', 'Lelystad', '2018-04-02', '2030-04-16', 16, 'C', ''),
(7, 'gevangenen7', 'den Haag', '2023-03-24', '2023-04-23', 3, 'A', 'Goed gedrag');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personeel`
--

CREATE TABLE `personeel` (
  `personeel_id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `wachtwoord` varchar(50) NOT NULL,
  `gebruikersnaam` varchar(50) NOT NULL,
  `functie` varchar(50) NOT NULL,
  `wwhash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `personeel`
--

INSERT INTO `personeel` (`personeel_id`, `naam`, `wachtwoord`, `gebruikersnaam`, `functie`, `wwhash`) VALUES
(1, 'Opperhek', '0pperh3k!', 'Opperhek', 'Directeur', '$2y$10$ZT9G41V7xm2aCCfd2Clx3ee6B4J6nutJcbwKNTvG7QfN/p8ojMQ9O'),
(2, 'Menno', 'M3nn0!', 'Coordinator1', 'Coordinator', '$2y$10$pLaOJISMu02vTmE3XSYJtuUjfPTqlsD1.bnRKCwqlb.dQZ6nPsaDW'),
(3, 'Aiden', 'A1d3n!', 'Coordinator2', 'Coordinator', '$2y$10$wma3Hb5gOkgX.nS/wK/IT.EqS1xOPAnx2HtbadgpwXFUTg06cLbwC'),
(4, 'Juan', 'Ju@n!', 'Bewaker1', 'Bewaker', '$2y$10$CsZkOOuuy0ao28f727dQ1.VbPIZVhKFSvel2cqZ2Queou4E21dhca'),
(5, 'Jack', 'J@ck!', 'Bewaker2', 'Bewaker', '$2y$10$XXX2R5S4c8GBQUKtEzHQsulXWxwRIOeluKCFweCNU/Z3cc7Rd9LTS'),
(6, 'Herman', 'H3rm@n!', 'Bewaker3', 'Bewaker', '$2y$10$3cMBRiEhhsEoB4Ap3CEX7.V0aoXvQbB6BsPijfdIKbPPecN45Bznq'),
(7, 'Adam', '@d@m!', 'Bewaker4', 'Bewaker', '$2y$10$ibEoGHuatrKnDhQvNoyAGuEsOJn0taR3qLjujsQKM7aIh4vhGHrCa'),
(8, 'Piet', 'P13t!', 'Bewaker5', 'Bewaker', '$2y$10$RPjaNOPwDQ5.Yw0sX0mp5eaoI/QDKzEhMQvpzeI1IF1xSjG/u/6zG'),
(9, 'Julian', 'adminww', 'admingn', 'Admin', '$2y$10$Fih1VTSCSJ.LaKBqb4pvie4lTrShRRgfWKr2bWmj6DYeKc1iZwb0m');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bezoekers`
--
ALTER TABLE `bezoekers`
  ADD PRIMARY KEY (`bezoek_id`);

--
-- Indexen voor tabel `gevangenen`
--
ALTER TABLE `gevangenen`
  ADD PRIMARY KEY (`gevangenen_id`);

--
-- Indexen voor tabel `personeel`
--
ALTER TABLE `personeel`
  ADD PRIMARY KEY (`personeel_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bezoekers`
--
ALTER TABLE `bezoekers`
  MODIFY `bezoek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT voor een tabel `gevangenen`
--
ALTER TABLE `gevangenen`
  MODIFY `gevangenen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT voor een tabel `personeel`
--
ALTER TABLE `personeel`
  MODIFY `personeel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
