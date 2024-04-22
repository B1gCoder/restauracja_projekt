-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Kwi 2024, 10:03
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `glod_restauracja`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `dostepnosc_stolikow`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `konta`
--

INSERT INTO `konta` (`id_konta`, `email`, `nr_telefonu`, `haslo`) VALUES
(1, 'john@gmail.com', '+1234567890', 'password123'),
(2, 'susan@gmail.com', '+1987654321', 'susanpassword'),
(3, 'james@gmail.com', '+18887776666', 'jamespass'),
(4, 'alice@gmail.com', '+15555555555', 'alicepassword'),
(5, 'mike@gmail.com', '+14444444444', 'mikepass'),
(6, 'lisa@gmail.com', '+13333333333', 'lisapassword'),
(7, 'robert@gmail.com', '+12222222222', 'robertpass'),
(8, 'emily@gmail.com', '+16666666666', 'emilypassword'),
(9, 'david@gmail.com', '+1993219999', 'davidp321ass'),
(10, 'ddwd@gmail.com', '+1999999329999', 'davidpa2ss'),
(11, 'dadsvawvid@gmail.com', '+12234132199', 'david4pass'),
(12, 'davdavid@gmail.com', '+123239999', 'davidp13ass'),
(13, 'davvdasid@gmail.com', '+1995324319999', 'david2pass'),
(14, '321david@gmail.com', '+1942199999', 'davidpa52ss'),
(15, '32avid@gmail.com', '+1942193429999', 'da2332ss'),
(16, '321da543vid@gmail.com', '+1942132199999', 'dav43a52ss'),
(17, '3211234avid@gmail.com', '+194213599999', '32533pa52ss'),
(18, '321543avid@gmail.com', '+1942154399999', '754dpa52ss'),
(19, 'rbsjsd@gmail.com', '+131351241239', '41f2s'),
(20, 'ol435143ivia@gmail.com', '+18888888888', 'oliviapass4215word'),
(21, 'robber@gmail.com', '+1234567890', 'password123'),
(22, 'jean@gmail.com', '+2345678901', 'password456'),
(23, 'emily@gmail.com', '+3456789012', 'password789'),
(24, 'robert@gmail.com', '+4567890123', 'passwordabc'),
(25, 'zoe@gmail.com', '+5678901234', 'passworddef'),
(26, 'lisa@gmail.com', '+6789012345', 'passwordghi'),
(27, 'taylor@gmail.com', '+7890123456', 'passwordjkl'),
(28, 'stephan@gmail.com', '+8901234567', 'passwordmno'),
(29, 'bruce@gmail.com', '+9012345678', 'passwordpqr'),
(30, 'jackie@gmail.com', '+0123456789', 'passwordstu');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `menu`
--

INSERT INTO `menu` (`id_potrawy`, `menu_nazwa`, `menu_kategoria`, `menu_cena`, `menu_opis`) VALUES
('C1', 'Kamikaze', 'Drinks', '28.00', 'cocktails'),
('C2', 'Singapore Sling', 'Drinks', '29.00', 'cocktails'),
('C3', 'Long Island Iced Tea', 'Drinks', '29.00', 'cocktails'),
('C4', 'Lady on the Beach', 'Drinks', '29.00', 'cocktails'),
('C5', 'Margarita', 'Drinks', '29.00', 'cocktails'),
('C6', 'Pina Colada', 'Drinks', '26.00', 'cocktails'),
('C7', 'Mojito', 'Drinks', '29.00', 'cocktails'),
('CP1', 'Green Apple', 'Drinks', '15.00', 'fresh pressed juice'),
('CP2', 'Orange', 'Drinks', '15.00', 'fresh pressed juice'),
('CP3', 'Carrot', 'Drinks', '15.00', 'fresh pressed juice'),
('CP4', 'Watermelon', 'Drinks', '13.00', 'fresh pressed juice'),
('CP5', 'Pineapple', 'Drinks', '13.00', 'fresh pressed juice'),
('CP6', 'Lime', 'Drinks', '10.00', 'fresh pressed juice'),
('HC1', 'Shoney Iced Tea', 'Drinks', '32.00', 'Gin, Rum'),
('HC2', 'Blue Lady', 'Drinks', '30.00', 'Vodka'),
('HC3', 'Black Mambaa', 'Drinks', '30.00', 'Vodka'),
('HC4', 'Lycheetini', 'Drinks', '25.00', 'Vodka'),
('HC5', 'Chichi', 'Drinks', '25.00', 'Vodka'),
('HD1', 'Brownies', 'Side Snacks', '15.00', 'delicious brownies'),
('HD2', 'American Cheese Cake', 'Side Snacks', '15.00', 'delicious cheese cake'),
('HD3', 'Pie of the Day', 'Side Snacks', '13.00', 'delicious served with vanilla ice cream'),
('HD4', 'Coated Ice Cream', 'Side Snacks', '12.00', 'delicious ice cream'),
('HD5', 'Messy Sundae', 'Side Snacks', '14.00', 'delicious brownies'),
('L1', 'Blended Scotch (Black Label)', 'Drinks', '310.00', 'Johnny Walker Black Label Sherry 700ml'),
('L2', 'Blended Scotch (Gold Label)', 'Drinks', '390.00', 'Johnny Walker Gold Label 750ml'),
('L3', 'American Whisky (Jack Daniel)', 'Drinks', '290.00', '700ml'),
('L4', 'American Whisky (Jim Beam)', 'Drinks', '270.00', '750ml'),
('L5', 'Single Malt', 'Drinks', '360.00', 'Singleton Signature 700ml'),
('L6', 'Cognac', 'Drinks', '390.00', 'Hennessy VSOP 700ml'),
('L7', 'Vodka', 'Drinks', '195.00', 'Smirnoff Red 700ml'),
('L8', 'Tequila', 'Drinks', '165.00', 'Jose Cuervo 750ml'),
('L9', 'Gin', 'Drinks', '210.00', 'Gordon 700ml'),
('M1', 'Cool & Refreshing', 'Drinks', '16.00', 'Cucumber,peppermint,lemon'),
('M2', 'Virgin Apple Mojito', 'Drinks', '16.00', 'Green apple, mint leaf'),
('M3', 'Shirley Temple', 'Drinks', '16.00', 'Lemonade, grenadine'),
('M4', 'Purple Rain', 'Drinks', '16.00', 'Blackcurrant, strawberry'),
('M5', 'Silly Rose', 'Drinks', '16.00', 'Green Tea, lychee, rose'),
('M6', 'Incredible Green', 'Drinks', '16.00', 'Green apple, lemon, lime, soda'),
('MD1', 'Prime Rib Steak', 'Main Dishes', '96.00', '300g'),
('MD10', 'Braised Lamb Shank', 'Main Dishes', '52.00', 'delicious braised lamb shank'),
('MD11', 'Catch of the day', 'Main Dishes', '46.00', 'fresh seafood'),
('MD12', 'Grilled Salmon', 'Main Dishes', '48.00', 'fresh salmon'),
('MD13', 'Jambalaya', 'Main Dishes', '28.00', 'delicious jambalaya'),
('MD14', 'Fish & Chips', 'Main Dishes', '35.00', 'delicious fish & chips'),
('MD15', 'Classic Cheese Burger', 'Main Dishes', '30.00', 'delicious burger'),
('MD16', 'Hickory Burger', 'Main Dishes', '30.00', 'delicious burger'),
('MD17', 'Fried Chicken Burger', 'Main Dishes', '24.00', 'delicious burger'),
('MD18', 'Grilled Chicken Burger', 'Main Dishes', '24.00', 'delicious burger'),
('MD19', 'Chili Dog', 'Main Dishes', '25.00', 'delicious sandwich'),
('MD2', 'Sirloin Steak', 'Main Dishes', '79.00', '230g'),
('MD20', 'Meatballs Sandwich', 'Main Dishes', '25.00', 'delicious sandwich'),
('MD21', 'Street Car', 'Main Dishes', '24.00', 'delicious sandwich'),
('MD22', 'Shrimp Po Boy', 'Main Dishes', '32.00', 'delicious sandwich'),
('MD23', 'Chicken Po Boy', 'Main Dishes', '28.00', 'delicious sandwich'),
('MD24', 'Chicken Tortilla', 'Main Dishes', '22.00', 'delicious sandwich'),
('MD25', 'Bolognese', 'Main Dishes', '26.00', 'Spaghetti'),
('MD26', 'Meat Balls', 'Main Dishes', '28.00', 'Spaghetti'),
('MD27', 'Carbonara', 'Main Dishes', '28.00', 'Penne'),
('MD28', 'Chicken & Mushroom Aglio Olio', 'Main Dishes', '28.00', 'Penne'),
('MD29', 'Chicken Arabiatta', 'Main Dishes', '28.00', 'Spaghetti'),
('MD3', 'Ribeye Steak', 'Main Dishes', '96.00', '230g'),
('MD30', 'Seafood Aglio Olio', 'Main Dishes', '32.00', 'Spaghetti'),
('MD31', 'Shrimp', 'Main Dishes', '32.00', 'Penne'),
('MD32', 'Italian Chicken', 'Main Dishes', '30.00', 'Chef\'s Signature Pasta'),
('MD33', 'Braised Lamb Cutlet', 'Main Dishes', '33.00', 'Chef\'s Signature Pasta'),
('MD34', 'Fries', 'Side Snacks', '9.00', 'delicious'),
('MD35', 'Potato Wedges', 'Side Snacks', '9.00', 'delicious'),
('MD36', 'Garden Salad', 'Side Snacks', '9.00', 'delicious'),
('MD37', 'V.O.D', 'Side Snacks', '9.00', 'delicious vegetables'),
('MD38', 'Wan Tan', 'Side Snacks', '9.00', 'delicious'),
('MD39', 'Buttered Corn', 'Side Snacks', '9.00', 'delicious'),
('MD4', 'BBQ Ribs', 'Main Dishes', '59.00', '400g'),
('MD40', 'Coleslaw', 'Side Snacks', '9.00', 'delicious'),
('MD41', 'Garlic Bread', 'Side Snacks', '9.00', 'delicious'),
('MD42', 'Dirty Rice', 'Side Snacks', '9.00', 'delicious'),
('MD5', 'Grilled Chicken ½ Bird', 'Main Dishes', '33.00', '½ Bird'),
('MD6', 'Southern Fried Chicken ½ Bird', 'Main Dishes', '33.00', '½ Bird'),
('MD7', 'Pan Seared Chicken', 'Main Dishes', '28.00', '300g'),
('MD8', 'Chicken Chop', 'Main Dishes', '28.00', '300g'),
('MD9', 'Grilled Lamb Chops', 'Main Dishes', '48.00', 'delicious grilled lamb chop'),
('S1', 'Buffalo Wings', 'Side Snacks', '24.00', 'delicious buffalo wings'),
('S10', 'Shoney Salad', 'Side Snacks', '20.00', 'delicious salad'),
('S2', 'Fried Calamari', 'Side Snacks', '29.00', 'delicious fried calamari'),
('S3', 'Cheesy Baked Mussels ½ Dozen', 'Side Snacks', '23.00', '½ Dozen'),
('S4', 'Cheesy Baked Mussels 1 Dozen', 'Side Snacks', '38.00', '1 Dozen'),
('S5', 'Chopped Lamb Chops', 'Side Snacks', '39.00', 'Delicious lamb chop'),
('S6', 'Nachos', 'Side Snacks', '28.00', 'delicious nachos'),
('S7', 'Cheesy Fries', 'Side Snacks', '14.00', 'delicious cheesy fries'),
('S8', 'Cheesy Meat Fries', 'Side Snacks', '22.00', 'delicious cheesy meat fries'),
('S9', 'Grilled Chicken Caesar Salad', 'Side Snacks', '24.00', 'delicious salad'),
('SK1', 'Chicken Tenders', 'Side Snacks', '12.00', 'delicious chicken tenders'),
('SK2', 'Chicken Wings', 'Side Snacks', '12.00', 'delicious chicken wings'),
('SK3', 'Fish Fingers', 'Side Snacks', '15.00', 'served with fries & corn'),
('SK4', 'Cheesy Pasta', 'Side Snacks', '12.00', 'delicious cheesy pasta'),
('SK5', 'Meat Sauce Pasta', 'Side Snacks', '12.00', 'delicious pasta'),
('SK6', 'Milo', 'Side Snacks', '2.50', '200ml pack'),
('SK7', 'Ribena', 'Side Snacks', '3.50', '330ml pack'),
('SK8', 'Fruity Yogurt Smoothies', 'Side Snacks', '5.00', 'watermelon or pineapple'),
('SK9', 'Ice Cream MilkShakes', 'Side Snacks', '5.00', 'vanilla or chocolate');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id_pracownika` int(11) NOT NULL,
  `nazwa_pracownik` varchar(255) DEFAULT NULL,
  `stanowisko` varchar(255) DEFAULT NULL,
  `id_konta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`id_pracownika`, `nazwa_pracownik`, `stanowisko`, `id_konta`) VALUES
(1, 'John Smith', 'Waiter', 1),
(2, 'Susan Johnson', 'Waiter', 2),
(3, 'James Brown', 'Waiter', 3),
(4, 'Alice Davis', 'Waiter', 4),
(5, 'Mike Wilson', 'Waiter', 5),
(6, 'Lisa Martinez', 'Chef', 6),
(7, 'Robert Miller', 'Manager', 7),
(8, 'Emily Moore', 'Manager', 8),
(9, 'David Taylor', 'Chef', 9),
(10, 'Olivia Anderson', 'Chef', 10);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rezerwacje`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `stoliki`
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
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `dostepnosc_stolikow`
--
ALTER TABLE `dostepnosc_stolikow`
  MODIFY `id_dostepnosc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1320243;

--
-- AUTO_INCREMENT dla tabeli `konta`
--
ALTER TABLE `konta`
  MODIFY `id_konta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `id_pracownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14202411;

--
-- AUTO_INCREMENT dla tabeli `stoliki`
--
ALTER TABLE `stoliki`
  MODIFY `id_stolika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `dostepnosc_stolikow`
--
ALTER TABLE `dostepnosc_stolikow`
  ADD CONSTRAINT `dostepnosc_stolikow_ibfk_1` FOREIGN KEY (`id_stolika`) REFERENCES `stoliki` (`id_stolika`);

--
-- Ograniczenia dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD CONSTRAINT `pracownicy_ibfk_1` FOREIGN KEY (`id_konta`) REFERENCES `konta` (`id_konta`);

--
-- Ograniczenia dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`id_stolika`) REFERENCES `stoliki` (`id_stolika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
