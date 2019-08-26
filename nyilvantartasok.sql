-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Máj 09. 14:53
-- Kiszolgáló verziója: 10.1.37-MariaDB
-- PHP verzió: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `nyilvantartasok`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `felhasznalonev` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `admine` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`felhasznalonev`, `jelszo`, `admine`) VALUES
('admin', 'admin', 1),
('user', 'user', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `archiv`
--

CREATE TABLE `archiv` (
  `ID` int(11) DEFAULT NULL,
  `Nev` varchar(200) COLLATE utf32_hungarian_ci NOT NULL,
  `Beosztas` varchar(200) COLLATE utf32_hungarian_ci NOT NULL,
  `tel_imei` int(110) NOT NULL,
  `Telefon_tipus` varchar(200) COLLATE utf32_hungarian_ci NOT NULL,
  `Vasarlas_datuma` date DEFAULT NULL,
  `Garancia` date DEFAULT NULL,
  `Kiadas` date DEFAULT NULL,
  `Visszavetel` date DEFAULT NULL,
  `Sajat` tinyint(4) NOT NULL,
  `IMEI` int(110) NOT NULL,
  `Telefonszam` varchar(100) COLLATE utf32_hungarian_ci NOT NULL,
  `Pin1` int(11) NOT NULL,
  `Pin2` int(11) NOT NULL,
  `Puk1` int(11) NOT NULL,
  `Puk2` int(11) NOT NULL,
  `Hang` tinyint(4) NOT NULL,
  `Internet` tinyint(4) NOT NULL,
  `Huseg` int(11) DEFAULT NULL,
  `Huseg_kezdete` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_hungarian_ci;

--
-- A tábla adatainak kiíratása `archiv`
--

INSERT INTO `archiv` (`ID`, `Nev`, `Beosztas`, `tel_imei`, `Telefon_tipus`, `Vasarlas_datuma`, `Garancia`, `Kiadas`, `Visszavetel`, `Sajat`, `IMEI`, `Telefonszam`, `Pin1`, `Pin2`, `Puk1`, `Puk2`, `Hang`, `Internet`, `Huseg`, `Huseg_kezdete`) VALUES
(3, 'Dobrik József', 'Rendszergazda', 1342, 'Samsung S9 Plus', '2019-01-04', '2019-04-07', '2019-02-04', '2019-03-28', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
(1, 'Karalyos Béla', 'Gyakornok', 1234, 'Huawei Mate 10 Pro', '2019-01-01', '2019-03-09', '2019-02-04', '2019-03-28', 1, 0, '', 0, 0, 0, 0, 0, 0, 0, '0000-00-00'),
(1, 'Karalyos Béla', 'Gyakornok', 1342, 'Samsung S9 Plus', '2019-01-04', '2019-04-07', '2019-03-28', '2019-03-28', 0, 4000, '06309988192', 9874, 9104, 1671, 4560, 1, 1, 1, '2019-04-04'),
(1, 'Karalyos Béla', 'Gyakornok', 1234, 'Huawei Mate 10 Pro', '2019-01-01', '2019-03-09', '2019-03-28', '2019-03-28', 1, 1000, '06301234651', 1111, 2222, 3333, 4444, 1, 0, 1, '2019-01-04');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `ID` int(11) NOT NULL,
  `Nev` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `Osztaly` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `Beosztas` varchar(200) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`ID`, `Nev`, `Osztaly`, `Beosztas`) VALUES
(27, 'Nagy Barna', 'IT', 'IT'),
(28, 'Raktar Csop Vez. Bagi', 'Raktar', 'Csop vez.'),
(29, 'Rózsa Ilona', 'HR', ''),
(30, 'Bódi Sándor', 'Termeles', 'Manager'),
(31, 'Makai Peter', 'Maintenance', ''),
(32, 'Éles Zsuzsanna', 'Sales', 'Sales Manager'),
(33, 'Kovács János', 'Maintenance', 'Maintainer'),
(34, 'Bagi László', 'Warehouse', 'Warehouse Leader'),
(35, 'Horváth Sándor', 'Maintenance', ''),
(36, 'Orban Csaba', 'Management', 'Operation Manager'),
(37, 'Héjjas János', 'Sales', 'Sales Representative'),
(38, 'Bányász Imre', 'Logistics', 'Planner'),
(39, 'Kiss Fruzsina', 'Planning', 'Production Planner'),
(40, 'Jacek Malecki', 'Management', 'MD'),
(41, 'Nagy János', 'Maintenance', 'Technologist'),
(42, 'Túrós Veronika', 'Sales', 'Assistant/Sales representative'),
(43, 'Piotr Serbinski', 'Finance', 'Financial Director'),
(44, 'Lovas Ferenc', 'Management', 'Operation Manager'),
(45, 'Persely Szilvia', 'Finance', 'Chief Controller'),
(46, 'Bojtor Barnabás', 'Planning', 'Demand Planner'),
(47, 'Gépbeállítók Műszakvezető', 'Termelés', ''),
(48, 'Vezető Csomagoló', 'Termelés', ''),
(49, 'Anyagfelöntő', 'termelés', ''),
(50, 'Nagy Erzsébet', 'Termelés', ''),
(51, 'Gepbeallitok 2', 'termeles', ''),
(52, 'Nagy Krisztina Zsuzsa', '', ''),
(53, 'Karbantarás', 'Karbantartás', ''),
(54, 'VÁM', '', ''),
(55, 'Quality', 'Quality', 'Quality'),
(56, 'Customer service', 'Customer service', 'Customer service'),
(57, 'Piotr Kaszuba', 'Finance', 'Finance Manager'),
(58, 'Erdelyi Krisztina', 'Raktár', 'Raktári Adminisztráció'),
(59, 'Külső raktár', 'Porta', 'Porta'),
(60, 'Szabó Judit', 'Quality', ''),
(61, 'Füge Katalin', 'Sales', 'Sales Assistant'),
(62, 'Papp Nóra', 'HR', 'HR'),
(63, 'Igyarto Lajos', 'Customer service', 'Customer service assistant'),
(64, 'Pisák István', 'Supply Chain', 'Garden Furniture Planner'),
(65, 'Tóth-Palicz Anita', 'Planning', 'Deman Planner'),
(66, 'Csorvási Antónia', 'Finance', 'Controller'),
(67, 'Czipa György', 'Finance', 'Chief Accountant'),
(68, 'Szabó Edit', 'Quality', 'Quality assistant'),
(69, 'Majer Endre', 'Maintenance', 'Maintenance Manager'),
(70, 'Recepció', 'Recepció', 'Recepció'),
(71, 'Kujbus Anikó', 'Planning', 'Planning'),
(72, 'Both Stella', 'Warehouse', 'Warehouse Admin. Leader'),
(73, 'Tóth Zsigmond', 'Logistics', 'Raktárvezető'),
(74, 'Szarka Csaba', 'Logistics', ''),
(75, 'Karbantartás Elektromos', 'Karbantartás', ''),
(76, 'Karbantartás Szerszám', 'Karbantartás', ''),
(77, 'Bogdan Nistor', 'Sales', 'Sales Manager RO'),
(78, 'Széll -Szőke Krisztina', 'Sales', 'Junior KAM'),
(79, 'Ferencz Evelin', 'Planning', 'Buyer'),
(80, 'Aleksanda Osiak', 'Controlling', 'Controlling Manager'),
(81, 'Erdeiné Szegi Erika', 'Logistics', 'Warehouse'),
(82, 'Dorogi Zoltán', 'Expert', 'Expert'),
(83, 'László Csaba', 'Logistics', 'Fuvarszervező'),
(84, 'Raktár Műszakvezető 1.', 'Raktár', 'Raktár Műszakvezető'),
(85, 'Raktár Műszakvezető 2.', 'Raktár', 'Raktár Műszakvezető'),
(86, 'Andrassy Attila', 'Management', 'Operational Manager'),
(87, 'Kasza Norbert', 'Sales', 'Sales Representative'),
(88, 'Bene Arlette', 'Customer service', 'Customer Service Manager'),
(89, 'Ilyés Evelin', 'Finance', 'Finance Analyst'),
(90, 'Kocsis Norbert', 'Logistics', 'Logistics Manager'),
(91, 'Csige Judit', 'HR', 'HR'),
(92, 'Bódi Krisztina', 'Controling', 'Controller'),
(93, 'Fári Róbert', 'Termelés', 'Termelés'),
(94, 'Kocsis Norbert', 'Logistics', 'Logistics Manager'),
(95, 'IT test', 'IT', 'IT'),
(97, 'Buzdor Attila', 'Production', 'Production Manager'),
(98, 'Karacs Csaba', 'Finence', 'Finace'),
(99, 'Komlósi Balázs', 'Logistics', 'Logistics Manger'),
(100, 'Bencze István', 'Production', 'Shift Leader'),
(101, 'Molnár Ádám', 'Production', 'Shift Leader'),
(102, 'Köblös János', 'Finance', 'Controller'),
(103, 'Gyuricza József', 'Production', 'Shift Leader'),
(104, 'Csík Ákos', 'Production', 'Shift Leader'),
(105, 'Rácsai Lajos', 'Maintenance', 'Karbantartás'),
(106, 'Kása Renáta', 'Finance', ''),
(107, 'Németh Márk', 'Sales', 'Salesman'),
(108, 'Hideg Annamária', 'Sales', 'Sales'),
(109, 'Jürgen Frey', 'Quality', 'Quality Manager'),
(111, 'Lőrinzc Melinda', 'Quality', 'Quality'),
(112, 'Siket Attila', 'Maintenance', 'Maintenance'),
(113, 'Kecsey Tuzson', 'Sales', 'Sales'),
(114, 'Szilágyi Balázs', 'Maintenance', 'Engineer'),
(115, 'Tariska Krisztina', 'Transport planning', 'Transport planning'),
(116, 'Geszti Brigitta', 'Warehouse Assistant', 'Warehouse Assistant'),
(117, 'Szőke Róbert', 'Production', 'Production'),
(118, 'Csobán Dóra', 'Sales', 'Slaes'),
(119, 'Pázmándi Antia', 'Quality', 'Quality'),
(120, 'Kovács Tamás', 'Customer service', 'Customer service'),
(121, 'Trane SMS modem', 'Maintenance', 'Maintenance'),
(122, 'Szilágyi Károly', 'Fuvarszervező', 'Logisztika'),
(123, 'Bíró Krisztina', 'Planing', 'Planner'),
(124, 'Balla Beáta', 'Quality', 'Quality Manager'),
(125, 'Szűcs István', 'Logistics', 'Logistics Manager'),
(126, 'Szebeni Anett', 'Logistics', 'Transport Planner'),
(127, 'Tóth Róbert', 'Karbantartás', 'Technológus'),
(128, 'Almási Róbert', 'Production', 'Shift Leader'),
(129, 'Dézsi Kornél', 'Logistics', 'Warehouse Admin Leader'),
(130, 'Vásárhelyi Tamás', 'Quality', 'Quality Leader'),
(131, 'Tamás Lívia', 'Quality', 'Quality Assistant'),
(132, 'Nagy Attila', 'Termelés', 'Vezető Gépbeállító'),
(133, 'Dudics Ferenc', 'Production', 'Vezető gépbeállító'),
(134, 'Raktár Airport', 'Warehouse', 'Warehouse'),
(135, 'Varga Tibor', 'Termelés', 'Vezető gépbeállító'),
(136, 'Tőtős András', 'Termelés', 'Vezető alapanyag raktáros'),
(137, 'Szarvadi Gábor', 'Warehouse', 'Warehouse'),
(138, 'Lővey Balázs', 'Beszerzés', 'Beszerző'),
(139, 'karbantartás ügyelet', 'Karbantartás', 'Ügyelet'),
(140, 'Quality KMES', 'Quality', 'Quality'),
(141, 'Csörgő Gábor', 'Logistics', 'Logistics'),
(142, 'Mónus Anita', 'Supply chain', 'Buyer'),
(143, 'Reptér Laptop', 'Logistics', 'Logistics'),
(144, 'Ferenczi Bettina', 'Logistics', 'Transport Planner'),
(145, 'Nimrod Tueta', 'Interim Manager', 'Interim Manager'),
(146, 'Sagi Butbul', 'Management', 'Site Manager'),
(147, 'Kiss Ágnes', 'Logistics', 'Tranposrt Planner'),
(148, 'Petisné Szabó Henrietta', 'Quality', 'Quality Assistant'),
(149, 'Hegedűs István', 'HR', 'HR Manager'),
(150, 'IT Server Room', 'IT', 'GSM Temperature alert'),
(151, 'Lengyel Anita', 'Production', 'Shift Leader'),
(152, 'Zagyva Béla', 'Production', 'Vezető Gépbeállító'),
(153, 'Gál Csaba', 'Management', 'Operational Manager'),
(154, 'Madarász Sándor', 'Maintenance', 'Engineer'),
(155, 'Meeting Room', '', ''),
(156, 'Pálmai Miklós', 'Maintenance', 'Tool Engineer'),
(157, 'Kovács Dávid', 'Sales', 'Sales Rep.'),
(158, 'Raktár Kaba', 'Warehouse', 'Warehouse'),
(159, 'Véső Csenge', 'Logistics', 'Administrator'),
(160, 'Pádár Zoltán', 'Beszerzés', 'Műszaki beszerző'),
(161, 'Koji Balázs', 'Sales', 'Key Account Manager'),
(162, 'Quality 2', 'Quality', 'Quality'),
(163, 'Kádár Zoltán', 'Production', 'Vezető Gépbeállító'),
(164, 'Szarka Tamás', 'Karbantartás', 'Üzemi mérnök'),
(165, 'Stranbinger Mariann', 'Sales', 'Sales Representative'),
(166, 'Kozma Zsolt', 'Supply Chain', 'Purchasing & Planning manager'),
(167, 'Marczin Carla', 'Logistics', 'Keszlet koordinator'),
(168, 'teszt elek', 'x', 'x'),
(169, 'Dobrik József', 'IT', 'IT Specialist'),
(170, 'Takarito Mobil', 'HR', 'Takarito'),
(171, 'Szilágyi László', 'Production', 'Shift Leader'),
(172, 'Agrotex II.', 'Logistics', 'Raktaros'),
(173, 'Sector D', 'Production', 'Sector Lead'),
(174, 'Sector A', 'Production', 'Sector Lead'),
(175, 'Sector B', 'Production', 'Sector Lead'),
(176, 'Sector C', 'Production', 'Sector Lead'),
(177, 'Agrotex III.', 'Logistics', 'Raktaros'),
(178, 'Agrotex IV.', 'Logistics', 'Raktaros'),
(179, 'Agrotex V.', 'Logistics', 'Raktaros'),
(180, 'Agrotex MV.', 'Logistics', 'Shift Leader'),
(181, 'Raktári Üzemes', 'Logistics', 'Raktáros'),
(182, 'Darányi Tamás', 'Production', 'Production Manager'),
(183, 'Tóth Zsuzsa', 'Quality', 'Quality Assistant');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sim`
--

CREATE TABLE `sim` (
  `IMEI` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `Telefon_IMEI` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Telefonszam` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `Pin1` int(20) NOT NULL,
  `Pin2` int(20) NOT NULL,
  `Puk1` int(20) NOT NULL,
  `Puk2` int(20) NOT NULL,
  `Hang` tinyint(4) NOT NULL,
  `Internet` tinyint(4) NOT NULL,
  `Huseg` tinyint(4) DEFAULT NULL,
  `Huseg_kezdete` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `sim`
--

INSERT INTO `sim` (`IMEI`, `Telefon_IMEI`, `Telefonszam`, `Pin1`, `Pin2`, `Puk1`, `Puk2`, `Hang`, `Internet`, `Huseg`, `Huseg_kezdete`) VALUES
('3406110308566', NULL, '36309657086', 8996, 811, 56154528, 4591265, 1, 1, NULL, NULL),
('3417080187310', '358395083418378', '36305825080', 1654, 8781, 95375211, 32691861, 1, 0, NULL, NULL),
('7080187278', '357876081932156', '36301926773', 2449, 191, 39232807, 59549584, 1, 1, NULL, NULL),
('8930303413020973257', '860783037108628', '36307277123', 1895, 5901, 30108312, 25519496, 1, 1, NULL, NULL),
('8930303413100435482', '355672078513444', '36304881160', 5165, 5033, 95588340, 62472122, 1, 1, NULL, NULL),
('8930303416120332183', '353068097404099', '36304364528', 4840, 7991, 70514768, 27662015, 1, 1, NULL, NULL),
('8936302605110653027', '359615066688419', '36304572984', 1390, 8252, 88823968, 27017627, 1, 0, NULL, NULL),
('8936302608040668983', '352770053447803', '36304660014', 4979, 2806, 51589295, 97664010, 1, 0, NULL, NULL),
('8936303407120108962', NULL, '36304368764', 3083, 5822, 45105757, 71240342, 1, 1, NULL, NULL),
('8936303410100950858', '864695036191023', '36302258485', 5430, 4401, 35203107, 59042823, 1, 1, NULL, NULL),
('8936303411030126593', NULL, '36303770692', 7533, 9585, 64436231, 14421252, 1, 1, NULL, NULL),
('8936303412070791395', '358395081758932', '36306469595', 4052, 6591, 96151285, 92437815, 1, 1, NULL, NULL),
('8936303412080632571', '358395083416877', '36305777916', 5984, 5153, 44585175, 96025202, 1, 0, NULL, NULL),
('8936303412100549201', '355669074327266', '36309389649', 4547, 6018, 72396606, 13993664, 1, 1, NULL, NULL),
('8936303413021395526', '866089010331870', '36309852107', 6377, 1123, 12933440, 24349435, 1, 1, NULL, NULL),
('8936303413021532441', '0001', '36309787535', 4358, 3335, 56256343, 60095321, 1, 1, NULL, NULL),
('8936303413070430158', '358491093450954', '36305977416', 4611, 3542, 14007442, 21588502, 1, 1, NULL, NULL),
('8936303414020964247', '861349037819207', '36302076905', 5871, 691, 61054220, 65805187, 1, 1, NULL, NULL),
('8936303414030052850', 'aaaaaaaaaaaaaaa', '36309511544', 3456, 5592, 55462015, 12279424, 1, 1, NULL, NULL),
('8936303414061560417', NULL, '36308171772', 9121, 1863, 6481888, 73958183, 1, 1, NULL, NULL),
('8936303414070993518', '359615067378333', '36304458065', 6970, 433, 74645880, 91217996, 1, 1, NULL, NULL),
('8936303414071556710', '863691030611539', '36306394249', 5942, 8234, 61771870, 32423856, 1, 1, NULL, NULL),
('8936303414071617785', '863323032377436', '36306094699', 9388, 1455, 65446158, 60512865, 1, 1, NULL, NULL),
('8936303414071617793', NULL, '36306094829', 8083, 9802, 13474648, 90047052, 1, 1, NULL, NULL),
('8936303414071644003', '358395084426073', '36301900378', 996, 1333, 65345663, 90182224, 1, 0, NULL, NULL),
('8936303414071766285', '352770053433068', '36307212441', 5367, 4653, 8987019, 32184891, 1, 0, NULL, NULL),
('8936303414071945772', '353776100243649', '36304457747', 3854, 5706, 44295581, 50284421, 1, 1, NULL, NULL),
('8936303414100067473', '352054069213925', '36304989930', 6758, 4376, 6318930, 15331463, 1, 1, NULL, NULL),
('8936303415010353580', '353074092060415', '36302076903', 9520, 5068, 17308443, 56077527, 1, 1, NULL, NULL),
('8936303415010597731', 'TEST', '36302256511', 9948, 356, 40532149, 75281543, 1, 1, NULL, NULL),
('8936303415030331038', '352945062127659', '36301925760', 8122, 9353, 41755335, 54945960, 1, 1, NULL, NULL),
('8936303415100168013', '356713070348501', '36307277313', 134, 8690, 41515182, 70910697, 1, 1, NULL, NULL),
('8936303416010282092', '353066096315662', '36303056133', 7344, 3790, 64690774, 84156490, 1, 1, NULL, NULL),
('8936303416070450589', NULL, '36305825127', 5077, 6254, 85653761, 98380086, 1, 0, NULL, NULL),
('8936303416070616882', '359209070930734', '36308202964', 1626, 5570, 74260429, 36905200, 1, 1, NULL, NULL),
('8936303416070698757', '862790037256024', '36305075927', 7639, 5191, 92775953, 39842873, 1, 1, NULL, NULL),
('8936303416070791115', '353068096256763', '36306193809', 3819, 7963, 99224426, 38443838, 1, 1, NULL, NULL),
('8936303416100489003', '860899035495914', '36305825033', 2817, 3665, 5957101, 31520968, 1, 1, NULL, NULL),
('8936303416101078102', '356802084428068', '36309649714', 4108, 3629, 87419300, 924459, 1, 1, NULL, NULL),
('8936303416101078110', '357876081094973', '36309649724', 2505, 2767, 51754634, 61035693, 1, 1, NULL, NULL),
('8936303416101078151', '867173034499514', '36309649745', 7147, 3255, 91005034, 16541748, 1, 1, NULL, NULL),
('8936303416101078177', '863691030601720', '36309649747', 5772, 3254, 27345447, 55385367, 1, 1, NULL, NULL),
('8936303416121064595', '359615067037798', '36302330879', 5060, 7203, 42332919, 72470997, 1, 0, NULL, NULL),
('8936303416121064603', '359615067034654', '36302331395', 3768, 8340, 79042341, 64947575, 1, 0, NULL, NULL),
('8936303417020021868', '356124080511809', '36303244946', 7483, 947, 7979311, 4166715, 1, 1, NULL, NULL),
('8936303417030353442', 'xxx', '36308273771', 8801, 6952, 63433967, 65471740, 1, 0, NULL, NULL),
('8936303417030353830', '353065097606145', '36306223032', 2629, 9061, 61098525, 60531293, 1, 1, NULL, NULL),
('8936303417051208954', '863691032324404', '36302448035', 9910, 8613, 64757452, 40458774, 1, 1, NULL, NULL),
('8936303417051208962', '355328084577960', '36302448164', 285, 1264, 53205461, 38621018, 1, 1, NULL, NULL),
('8936303417070049876', '357876082681372', '36305264795', 6085, 5852, 97047178, 78826407, 1, 0, NULL, NULL),
('8936303417070058695', '357876080619390', '36305825040', 3801, 6358, 10942515, 38169888, 1, 0, NULL, NULL),
('8936303417070058711', '86899036782583', '36302962511', 1249, 6243, 54318096, 90579584, 1, 1, NULL, NULL),
('8936303417080171926', '860899038043851', '36303919730', 4463, 6989, 78560472, 40140560, 1, 1, NULL, NULL),
('8936303417100380606', '357876081089650', '36304660017', 1650, 1015, 90132451, 49481728, 1, 1, NULL, NULL),
('8936303418060182230', '353074092000114', '36301609586', 7845, 1034, 20019710, 94952119, 1, 1, NULL, NULL),
('8936303418100430045', '357876081953939', '36307812298', 6061, 3963, 74508092, 90690910, 1, 1, NULL, NULL),
('8936303418100430052', '357876082686371', '36307813065', 8469, 1668, 93345495, 86729621, 1, 1, NULL, NULL),
('8936303418100430060', '357876082682016', '36307813234', 4507, 4501, 96442468, 45147851, 1, 1, NULL, NULL),
('8936303418100430078', '352770053453843', '36307813340', 7867, 3841, 65342967, 39412502, 1, 1, NULL, NULL),
('8936303418100430086', '357876082681794', '36307813570', 2426, 2715, 73547543, 69741988, 1, 1, NULL, NULL),
('8936303418100430094', '357876082688419', '36307813654', 7124, 4031, 65347024, 47170493, 1, 1, NULL, NULL),
('8936303418100430102', '357876082692015', '36307814351', 6124, 7110, 74463822, 50296195, 1, 1, NULL, NULL),
('8936303418100501787', '357876082143712', '36304276925', 1492, 2271, 25860087, 28073651, 1, 1, NULL, NULL),
('8936303418100502363', '356130090941852', '36302543963', 4602, 2555, 36294335, 31948763, 1, 1, NULL, NULL),
('8936303418100642839', '353325109693501', '36301650340', 5104, 6286, 33559507, 43007624, 1, 1, NULL, NULL),
('8936303419010068693', '358098074809700', '36305825073', 1921, 6578, 68758342, 84605038, 1, 0, NULL, NULL),
('8936304015030145138', '359615062828811', '36305825145', 3611, 9083, 13319586, 11103542, 1, 0, NULL, NULL),
('8936304015030400715', '355257095716673', '36301968051', 3759, 6926, 55293022, 43680730, 1, 1, NULL, NULL),
('8936304015030400723', '863691039767050', '36301968052', 6654, 1957, 59052353, 65162784, 1, 1, NULL, NULL),
('8936304015030400731', '357876081100291', '36301968056', 18, 6201, 72183941, 13224342, 1, 1, NULL, NULL),
('8936304015030400798', '354424069275695', '36301968059', 9250, 4103, 42359803, 52493054, 1, 1, NULL, NULL),
('8936304015030400814', '356966061468627', '36301968060', 5492, 8831, 1820222, 16413812, 1, 1, NULL, NULL),
('8936304015090140177', '352937080200154', '36308666258', 6285, 8361, 59541164, 48202660, 1, 1, NULL, NULL),
('8936304015090140185', '864597031983885', '36308668356', 8755, 5099, 91534914, 35390621, 1, 1, NULL, NULL),
('8936304015090140193', NULL, '36308669906', 422, 6478, 19431295, 67187240, 1, 1, NULL, NULL),
('8936304015090140623', '352088071865314', '36309380379', 651, 2317, 68028976, 90425124, 1, 0, NULL, NULL),
('8936304015090387448', '354683090999991', '36306196811', 2349, 9209, 80516315, 89945635, 1, 1, NULL, NULL),
('8936304015090401751', '863691039718996', '36301828030', 3204, 4029, 71084974, 4301546, 1, 1, NULL, NULL),
('8936304015090401769', '86899038603431', '36301828033', 1761, 6186, 97077603, 78828547, 1, 1, NULL, NULL),
('8936304015100371028', '353066096730688', '36309787544', 2435, 9670, 66568442, 2285107, 1, 1, NULL, NULL),
('8936304015100371036', '353068093958593', '36305070084', 2918, 2903, 89308669, 1587659, 1, 1, NULL, NULL),
('8936304015110496377', '359213074109006', '36306032564', 1734, 1595, 36375932, 43193299, 1, 1, NULL, NULL),
('8936304015110635768', '354282078090079', '36301850927', 2044, 5163, 97660150, 79697095, 1, 1, NULL, NULL),
('8936304015110635776', '353066097201861', '36301850928', 3280, 0, 12654947, 46896275, 1, 1, NULL, NULL),
('8936304015110759873', '356130090530317', '36304461966', 5563, 8050, 67381829, 55512402, 1, 1, NULL, NULL),
('8936304015110786181', '356613089151633', '36304660013', 5049, 2371, 35846924, 37379173, 1, 1, NULL, NULL),
('8936304016010269492', '355795071611350', '36302494037', 1001, 2382, 48715443, 16849353, 1, 1, NULL, NULL),
('8936304016010558159', '863691033663701', '36306030379', 4764, 6255, 70250115, 12327079, 1, 1, NULL, NULL),
('8936304016010913875', NULL, '36309348492', 261, 5104, 12607644, 36847419, 1, 1, NULL, NULL),
('8936304016030453910', NULL, '36306394248', 1022, 2460, 27144992, 16737230, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `telefon`
--

CREATE TABLE `telefon` (
  `imei` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `User_id` int(11) DEFAULT NULL,
  `Telefon_tipus` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `Vasarlas_datuma` date NOT NULL,
  `Garancia` date DEFAULT NULL,
  `Kiadas` date DEFAULT NULL,
  `Visszavetel` date DEFAULT NULL,
  `Sajat` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `telefon`
--

INSERT INTO `telefon` (`imei`, `User_id`, `Telefon_tipus`, `Vasarlas_datuma`, `Garancia`, `Kiadas`, `Visszavetel`, `Sajat`) VALUES
('1858073616258', NULL, 'MS Lumia 640LTE', '2019-03-28', '2019-06-11', NULL, NULL, 0),
('352054069213925', 161, 'iPhone 5S 16GB', '2019-03-29', NULL, NULL, NULL, 0),
('352088071865314', 105, 'Iphone 6 64G', '2019-03-30', NULL, NULL, NULL, 0),
('352765091056012', NULL, 'Sony XA', '2019-03-31', NULL, NULL, NULL, 0),
('352770053433068', 76, 'CAT B25', '2019-04-01', NULL, NULL, NULL, 0),
('352770053447803', 33, 'CAT B25', '2019-04-02', NULL, NULL, NULL, 0),
('352770053453843', 181, 'CAT B25', '2019-04-03', NULL, NULL, NULL, 0),
('352937080200154', 151, 'Samsung G. A5.6', '2019-04-04', NULL, NULL, NULL, 0),
('352945062127659', 149, 'Sony Z2 TAB', '2019-04-05', NULL, NULL, NULL, 0),
('352990090224813', 153, 'iphone 8', '2019-04-06', NULL, NULL, NULL, 0),
('353065097606145', 147, 'iPhone SE 32GB', '2019-04-07', NULL, NULL, NULL, 0),
('353066096315662', 118, 'iPhone SE 32GB', '2019-04-08', NULL, NULL, NULL, 0),
('353066096680875', NULL, 'iPhone SE 32GB', '2019-04-09', NULL, NULL, NULL, 0),
('353066096730688', 106, 'iPhone SE 32GB', '2019-04-10', NULL, NULL, NULL, 0),
('353066097201861', 159, 'iPhone SE 32GB', '2019-04-11', NULL, NULL, NULL, 0),
('353068093958593', 129, 'iPhone SE 32GB', '2019-04-12', NULL, NULL, NULL, 0),
('353068096256763', 144, 'iPhone SE 32GB', '2019-04-13', NULL, NULL, NULL, 0),
('353068097404099', 141, 'iPhone SE 32GB', '2019-04-14', NULL, NULL, NULL, 0),
('353074092000114', 166, 'iPhone 7 32GB', '2019-04-15', NULL, NULL, NULL, 0),
('353074092060415', 42, 'iPhone 7 32GB', '2019-04-16', NULL, NULL, NULL, 0),
('353325109693501', 182, 'Samsung S9', '2019-04-17', NULL, NULL, NULL, 0),
('353776100243649', 34, 'Samsung A7', '2019-04-18', NULL, NULL, NULL, 0),
('354282078090079', 124, 'Sony Z5 Compact', '2019-04-19', NULL, NULL, NULL, 0),
('354424069275695', 42, 'iPad Air2 16GB', '2019-04-20', NULL, NULL, NULL, 0),
('354473062942306', NULL, 'CAT B15Q', '2019-04-21', NULL, NULL, NULL, 0),
('354683090999991', 169, 'Sony X Z2', '2019-04-22', NULL, NULL, NULL, 0),
('355257095716673', 88, 'Galaxy S8', '2019-04-23', NULL, NULL, NULL, 0),
('355328084577960', 149, 'iPhone 7 128', '2019-04-24', NULL, NULL, NULL, 0),
('355657070579188', 32, 'iPad Pro 128GB', '2019-04-25', NULL, NULL, NULL, 0),
('355669074327266', 113, 'iPhone 5S 16GB', '2019-04-26', NULL, NULL, NULL, 0),
('355672078513444', 65, 'iPhone 5S 16GB', '2019-04-27', NULL, NULL, NULL, 0),
('355795071611350', 32, 'iPhone SE 64GB', '2019-04-28', NULL, NULL, NULL, 0),
('356023082950280', NULL, 'Nokia 5', '2019-04-29', NULL, NULL, NULL, 0),
('356123082950249', NULL, 'Nokia 5', '2019-04-30', NULL, NULL, NULL, 0),
('356124080511809', 82, 'HTC U11', '2019-05-01', NULL, NULL, NULL, 0),
('356130090530317', 165, 'iPhone SE 32GB', '2019-05-02', NULL, NULL, NULL, 0),
('356130090941852', 39, 'iPhone SE 32GB', '2019-05-03', NULL, NULL, NULL, 0),
('356608080713779', NULL, 'iPhone SE 32GB', '2019-05-04', NULL, NULL, NULL, 0),
('356613089151633', 63, 'iPhone SE 32GB', '2019-05-05', NULL, NULL, NULL, 0),
('356713070348501', 68, 'Samsung G A3', '2019-05-06', NULL, NULL, NULL, 0),
('356802084428068', 136, 'Nokia 3', '2019-05-07', NULL, NULL, NULL, 0),
('356966061468627', 141, 'iPad Air2 16GB', '2019-05-08', NULL, NULL, NULL, 0),
('357765073852474', NULL, 'Samsung G. A5.6', '2019-05-09', NULL, NULL, NULL, 0),
('357876080619390', 152, 'CAT S41', '2019-05-10', NULL, NULL, NULL, 0),
('357876081089650', 28, 'CAT S41', '2019-05-11', NULL, NULL, NULL, 0),
('357876081094973', 132, 'CAT B30', '2019-05-12', NULL, NULL, NULL, 0),
('357876081100291', 160, 'CAT B30', '2019-05-13', NULL, NULL, NULL, 0),
('357876081932156', 163, 'CAT S41', '2019-05-14', NULL, NULL, NULL, 0),
('357876081953939', 174, 'CAT S41', '2019-05-15', NULL, NULL, NULL, 0),
('357876082143712', 173, 'CAT S41', '2019-05-16', NULL, NULL, NULL, 0),
('357876082681372', 180, 'CAT S41', '2019-05-17', NULL, NULL, NULL, 0),
('357876082681794', 179, 'CAT S41', '2019-05-18', NULL, NULL, NULL, 0),
('357876082682016', 176, 'CAT S41', '2019-05-19', NULL, NULL, NULL, 0),
('357876082686371', 175, 'CAT S41', '2019-05-20', NULL, NULL, NULL, 0),
('357876082688419', 178, 'CAT S41', '2019-05-21', NULL, NULL, NULL, 0),
('357876082692015', 177, 'CAT S41', '2019-05-22', NULL, NULL, NULL, 0),
('358098074809700', 183, 'Sony Xperia X', '2019-05-23', NULL, NULL, NULL, 0),
('358395081758932', 158, 'CAT B30', '2019-05-24', NULL, NULL, NULL, 0),
('358395083416877', 55, 'CAT B30', '2019-05-25', NULL, NULL, NULL, 0),
('358395083418378', 172, 'CAT B30', '2019-05-26', NULL, NULL, NULL, 0),
('358395084426073', 81, 'CAT B30', '2019-05-27', NULL, NULL, NULL, 0),
('358491093450954', 120, 'Samsung G A8', '2019-05-28', NULL, NULL, NULL, 0),
('359145071124143', NULL, 'iPhone SE 64GB', '2019-05-29', NULL, NULL, NULL, 0),
('359209070930734', 40, 'iPhone 7 128', '2019-05-30', NULL, NULL, NULL, 0),
('359213074109006', 31, 'iPhone 7 32GB', '2019-05-31', NULL, NULL, NULL, 0),
('359261062915108', NULL, 'iPhone 5S 16GB', '2019-06-01', NULL, NULL, NULL, 0),
('359261068099717', NULL, 'iPhone 5S 16GB', '2019-06-02', NULL, NULL, NULL, 0),
('359615062828811', 53, 'CAT B30', '2019-06-03', NULL, NULL, NULL, 0),
('359615065300859', NULL, 'CAT B30', '2019-06-04', NULL, NULL, NULL, 0),
('359615066688419', 75, 'CAT B30', '2019-06-05', NULL, NULL, NULL, 0),
('359615066732399', NULL, 'CAT B30', '2019-06-06', NULL, NULL, NULL, 0),
('359615067034654', 139, 'CAT B30', '2019-06-07', NULL, NULL, NULL, 0),
('359615067037798', 139, 'CAT B30', '2019-06-08', NULL, NULL, NULL, 0),
('359615067378333', 170, 'CAT B30', '2019-06-09', NULL, NULL, NULL, 0),
('860783037108628', 40, 'HUA E5577Cs', '2019-06-10', NULL, NULL, NULL, 0),
('860899035495914', 50, 'Honor 7 lite', '2019-06-11', NULL, NULL, NULL, 0),
('860899035897937', NULL, 'Honor 7 lite', '2019-06-12', NULL, NULL, NULL, 0),
('860899036671471', NULL, 'Honor 7 lite', '2019-06-13', NULL, NULL, NULL, 0),
('860899038043851', 167, 'Honor 7 lite', '2019-06-14', NULL, NULL, NULL, 0),
('861145017050361', NULL, 'Web\'n Walk USB stick', '2019-06-15', NULL, NULL, NULL, 0),
('861349037819207', 122, 'Honor 8', '2019-06-16', NULL, NULL, NULL, 0),
('862790037256024', 130, 'P10 DS', '2019-06-17', NULL, NULL, NULL, 0),
('863323032377436', 93, 'Honor 8 Lite', '2019-06-18', NULL, NULL, NULL, 0),
('863691030601720', 135, 'Honor 8', '2019-06-19', NULL, NULL, NULL, 0),
('863691030611539', 35, 'Honor 8', '2019-06-20', NULL, NULL, NULL, 0),
('863691031360201', 131, 'Honor 8', '2019-06-21', NULL, NULL, NULL, 0),
('863691032324404', 171, 'Honor 8', '2019-06-22', NULL, NULL, NULL, 0),
('863691033663701', 142, 'Honor 8', '2019-06-23', NULL, NULL, NULL, 0),
('863691039718996', 70, 'Honor 8', '2019-06-24', NULL, NULL, NULL, 0),
('863691039767050', 89, 'Honor 8', '2019-06-25', NULL, NULL, NULL, 0),
('863691039770930', NULL, 'Honor 8', '2019-06-26', NULL, NULL, NULL, 0),
('864597031983885', 128, 'Honor 9 DS', '2019-06-27', NULL, NULL, NULL, 0),
('864695036191023', 146, 'HUA E5577Cs', '2019-06-28', NULL, NULL, NULL, 0),
('866089010331870', 40, 'HUA E5776S router', '2019-06-29', NULL, NULL, NULL, 0),
('867173034499514', 133, 'Honor 9 DS', '2019-06-30', NULL, NULL, NULL, 0),
('86899036782583', 154, 'Honor 7 lite', '2019-07-01', NULL, NULL, NULL, 0),
('86899038603431', 127, 'Honor 7 lite', '2019-07-02', NULL, NULL, NULL, 0),
('aaaaaaaaaaaaaaa', NULL, 'Other', '2019-07-03', NULL, NULL, NULL, 0),
('HA0UE6LK', 155, 'Lenovo TAB 10', '2019-07-04', NULL, NULL, NULL, 0),
('HA0UF575', 155, 'Lenovo TAB 10', '2019-07-05', NULL, NULL, NULL, 0),
('HUEBEL0001', 143, 'Other', '2019-07-06', NULL, NULL, NULL, 0),
('R52HC13MF5K', 140, 'Galaxy TAB A', '2019-07-07', NULL, NULL, NULL, 0),
('R52HC13N8JF', 140, 'Galaxy TAB A', '2019-07-08', NULL, NULL, NULL, 0),
('R52HC13NFKM', 140, 'Galaxy TAB A', '2019-07-09', NULL, NULL, NULL, 0),
('R52J10RNWPZ', 140, 'Galaxy TAB A', '2019-07-10', NULL, NULL, NULL, 0),
('R52J10RPAXX', 140, 'Galaxy TAB A', '2019-07-11', NULL, NULL, NULL, 0),
('R52J10RPT3M', 140, 'Galaxy TAB A', '2019-07-12', NULL, NULL, NULL, 0),
('TEST', 95, 'Sajat', '2019-07-13', NULL, NULL, NULL, 0),
('xxx', 150, 'Other', '2019-07-14', NULL, NULL, NULL, 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `sim`
--
ALTER TABLE `sim`
  ADD PRIMARY KEY (`IMEI`),
  ADD KEY `Telefon_IMEI` (`Telefon_IMEI`);

--
-- A tábla indexei `telefon`
--
ALTER TABLE `telefon`
  ADD PRIMARY KEY (`imei`),
  ADD KEY `User_id` (`User_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
