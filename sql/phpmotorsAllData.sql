-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2024 a las 10:02:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `phpmotors`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(1, 'Ricardo', 'Bacilio', 'ricardo@gmail.com', '$2y$10$HJE2pup6k2snmdT6VIu/T.tHpwAJRLorIL.Dahvmb3dLiKtkzATmu', '3', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(1, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2024-08-22 04:41:29', 1),
(2, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2024-08-22 04:41:29', 1),
(3, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2024-08-22 04:41:56', 1),
(4, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2024-08-22 04:41:57', 1),
(5, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2024-08-22 04:42:12', 1),
(6, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2024-08-22 04:42:12', 1),
(7, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2024-08-22 04:42:36', 1),
(8, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2024-08-22 04:42:36', 1),
(9, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2024-08-22 04:43:33', 1),
(10, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2024-08-22 04:43:33', 1),
(11, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2024-08-22 04:43:53', 1),
(12, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2024-08-22 04:43:54', 1),
(13, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2024-08-22 04:45:12', 1),
(14, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2024-08-22 04:45:12', 1),
(15, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2024-08-22 04:45:33', 1),
(16, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2024-08-22 04:45:33', 1),
(17, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2024-08-22 04:45:45', 1),
(18, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2024-08-22 04:45:45', 1),
(19, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2024-08-22 04:46:35', 1),
(20, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2024-08-22 04:46:36', 1),
(21, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2024-08-22 04:47:16', 1),
(22, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2024-08-22 04:47:16', 1),
(23, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2024-08-22 04:47:50', 1),
(24, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2024-08-22 04:47:50', 1),
(25, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2024-08-22 04:48:06', 1),
(26, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2024-08-22 04:48:06', 1),
(27, 8, 'truck.jpg', '/phpmotors/images/vehicles/truck.jpg', '2024-08-22 04:49:10', 1),
(28, 8, 'truck-tn.jpg', '/phpmotors/images/vehicles/truck-tn.jpg', '2024-08-22 04:49:10', 1),
(29, 16, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2024-08-23 03:40:07', 1),
(30, 16, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2024-08-23 03:40:07', 1),
(31, 15, 'fbix2.jpg', '/phpmotors/images/vehicles/fbix2.jpg', '2024-08-23 03:41:57', 0),
(32, 15, 'fbix2-tn.jpg', '/phpmotors/images/vehicles/fbix2-tn.jpg', '2024-08-23 03:41:57', 0),
(33, 3, 'lambo.jpg', '/phpmotors/images/vehicles/lambo.jpg', '2024-08-23 03:43:03', 0),
(34, 3, 'lambo-tn.jpg', '/phpmotors/images/vehicles/lambo-tn.jpg', '2024-08-23 03:43:04', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/images/jeep-wrangler.jpg', '/images/jeep-wrangler-tn.jpg', 28045, 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/images/ford-modelt.jpg', '/images/ford-modelt-tn.jpg', 30000, 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/images/lambo-Adve.jpg', '/images/lambo-Adve-tn.jpg', 417650, 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/images/monster.jpg', '/images/monster-tn.jpg', 150000, 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/images/ms.jpg', '/images/ms-tn.jpg', 100, 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/images/bat.jpg', '/images/bat-tn.jpg', 65000, 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/images/mm.jpg', '/images/mm-tn.jpg', 10000, 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/images/fire-truck.jpg', '/images/fire-truck-tn.jpg', 50000, 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/images/crown-vic.jpg', '/images/crown-vic-tn.jpg', 10000, 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/images/camaro.jpg', '/images/camaro-tn.jpg', 25000, 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/images/escalade.jpg', '/images/escalade-tn.jpg', 75195, 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/images/hummer.jpg', '/images/hummer-tn.jpg', 58800, 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/images/aerocar.jpg', '/images/aerocar-tn.jpg', 1000000, 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/images/fbi.jpg', '/images/fbi-tn.jpg', 20000, 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/images/dog.jpg', '/images/dog-tn.jpg', 35000, 1, 'Brown', 2),
(16, 'DMC DeLorean', 'DMC', 'This is a classic car', '/phpmotors/images/no-image.png', '/phpmotors/images/no-image.png', 10000, 30, 'Gray', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indices de la tabla `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
