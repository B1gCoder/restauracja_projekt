-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 14, 2024 at 11:32 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glod_restauracja`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostepnosc_stolikow`
--

CREATE TABLE `dostepnosc_stolikow` (
  `id_dostepnosc` int(11) NOT NULL,
  `id_stolika` int(11) DEFAULT NULL,
  `data_rezerwacji` date DEFAULT NULL,
  `godzina_rezerwacji` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dostepnosc_stolikow`
--

INSERT INTO `dostepnosc_stolikow` (`id_dostepnosc`, `id_stolika`, `data_rezerwacji`, `godzina_rezerwacji`, `status`) VALUES
(1020245, 5, '2024-04-05', '10:00:00', 'Nie'),
(1320242, 2, '2024-04-18', '13:00:00', 'Nie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `id_konta` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nr_telefonu` varchar(255) DEFAULT NULL,
  `haslo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `id_potrawy` varchar(6) NOT NULL,
  `menu_nazwa` varchar(255) DEFAULT NULL,
  `menu_kategoria` varchar(255) DEFAULT NULL,
  `menu_cena` decimal(10,2) DEFAULT NULL,
  `menu_opis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id_pracownika` int(11) NOT NULL,
  `nazwa_pracownik` varchar(255) DEFAULT NULL,
  `stanowisko` varchar(255) DEFAULT NULL,
  `id_konta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id_rezerwacji` int(11) NOT NULL,
  `imie` varchar(255) DEFAULT NULL,
  `id_stolika` int(11) DEFAULT NULL,
  `godzina_rezerwacji` time DEFAULT NULL,
  `data_rezerwacji` date DEFAULT NULL,
  `liczba_miejsc` int(11) DEFAULT NULL,
  `dodatkowe_informacje` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezerwacje`
--

INSERT INTO `rezerwacje` (`id_rezerwacji`, `imie`, `id_stolika`, `godzina_rezerwacji`, `data_rezerwacji`, `liczba_miejsc`, `dodatkowe_informacje`) VALUES
(1020245, 'Mati', 5, '10:00:00', '2024-04-05', 6, 'allah'),
(1111111, 'Default', 9, '19:15:00', '2023-10-05', 2, 'Description'),
(1320242, 'Pascal', 2, '13:00:00', '2024-04-18', 4, 'glupi jestem');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stoliki`
--

CREATE TABLE `stoliki` (
  `id_stolika` int(11) NOT NULL,
  `pojemnosc` int(11) DEFAULT NULL,
  `czy_dostepny` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stoliki`
--

INSERT INTO `stoliki` (`id_stolika`, `pojemnosc`, `czy_dostepny`) VALUES
(1, 4, 1),
(2, 4, 1),
(3, 4, 1),
(4, 6, 1),
(5, 6, 1),
(6, 6, 1),
(7, 6, 1),
(8, 8, 1),
(9, 8, 1),
(10, 8, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dostepnosc_stolikow`
--
ALTER TABLE `dostepnosc_stolikow`
  ADD PRIMARY KEY (`id_dostepnosc`),
  ADD KEY `table_id` (`id_stolika`);

--
-- Indeksy dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD PRIMARY KEY (`id_konta`);

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_potrawy`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id_pracownika`),
  ADD KEY `account_id` (`id_konta`);

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id_rezerwacji`),
  ADD KEY `id_stolika` (`id_stolika`) USING BTREE;

--
-- Indeksy dla tabeli `stoliki`
--
ALTER TABLE `stoliki`
  ADD PRIMARY KEY (`id_stolika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dostepnosc_stolikow`
--
ALTER TABLE `dostepnosc_stolikow`
  MODIFY `id_dostepnosc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1320243;

--
-- AUTO_INCREMENT for table `konta`
--
ALTER TABLE `konta`
  MODIFY `id_konta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `id_pracownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14202411;

--
-- AUTO_INCREMENT for table `stoliki`
--
ALTER TABLE `stoliki`
  MODIFY `id_stolika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dostepnosc_stolikow`
--
ALTER TABLE `dostepnosc_stolikow`
  ADD CONSTRAINT `dostepnosc_stolikow_ibfk_1` FOREIGN KEY (`id_stolika`) REFERENCES `stoliki` (`id_stolika`);

--
-- Constraints for table `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD CONSTRAINT `pracownicy_ibfk_1` FOREIGN KEY (`id_konta`) REFERENCES `konta` (`id_konta`);

--
-- Constraints for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`id_stolika`) REFERENCES `stoliki` (`id_stolika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
