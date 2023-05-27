-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 10:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(4) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact` varchar(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `name`, `contact`, `username`, `email`, `password`) VALUES
(1, 'MPMS Admin', '09702803748', 'admin1', 'mpmsadmin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_ID` int(4) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact` varchar(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_ID`, `name`, `contact`, `username`, `email`, `password`) VALUES
(2, 'Ruy Embiado', '09702803748', 'ruyembiado1', 'ruyembiado1@gmail.com', '9b4059eb3a810671d46505700dded4f3'),
(3, 'Rucus', '12345678901', 'rucus', 'rucus@gmail.com', 'def8a61f25c65f17e5fbc5393a14d223');

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `map_ID` int(2) NOT NULL,
  `market_ID` int(2) DEFAULT NULL,
  `market_admin_ID` int(4) DEFAULT NULL,
  `map_name` varchar(50) NOT NULL,
  `map_floor` int(2) NOT NULL,
  `map_img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `map`
--

INSERT INTO `map` (`map_ID`, `market_ID`, `market_admin_ID`, `map_name`, `map_floor`, `map_img`) VALUES
(7, 8, 9, 'Iloilo Central Market', 1, '../map_img/641cf9730be08.png'),
(8, 10, 11, 'Jaro Big Market', 1, '../map_img/6450b0f16cf37.jpg'),
(9, 12, 12, 'SIM PIN MARKET', 1, '../map_img/645325051903b.jpg'),
(10, 9, 10, 'Iloilo Terminal Market', 1, '../map_img/6453b1bd0607b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `market_ID` int(2) NOT NULL,
  `admin_ID` int(4) DEFAULT NULL,
  `market_name` varchar(50) DEFAULT NULL,
  `market_status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`market_ID`, `admin_ID`, `market_name`, `market_status`) VALUES
(8, 1, 'Iloilo Central Market', 1),
(9, 1, 'Iloilo Terminal Market', 1),
(10, 1, 'Jaro Big Market', 1),
(11, 1, 'La Paz Public Market', 0),
(12, 1, 'SIM PIN MARKET', 1);

-- --------------------------------------------------------

--
-- Table structure for table `market_admin`
--

CREATE TABLE `market_admin` (
  `market_admin_ID` int(4) NOT NULL,
  `market_ID` int(2) DEFAULT NULL,
  `admin_ID` int(4) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact` varchar(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `market_admin_status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `market_admin`
--

INSERT INTO `market_admin` (`market_admin_ID`, `market_ID`, `admin_ID`, `name`, `contact`, `username`, `email`, `password`, `market_admin_status`) VALUES
(9, 8, 1, 'Reynaldo Ilangos', '12345678900', 'reynaldo', 'reynaldo@gmail.com', 'b26dfb803cb6b93401d41a2f10bf398d', 1),
(10, 9, 1, 'Fel Jun Palawan', '1234567890', 'feljun', 'feljun@gmail.com', 'f24caee4550cfcac39d1ad497ef22c14', 1),
(11, 10, 1, 'Ruy Embiado', '12345678900', 'ruy', 'ruyembiado@gmail.com', '60d812674aec5c13d5c453c8cee68efa', 1),
(12, 12, 1, 'Ruden Buensuceso', '09191234567', 'Ruden', 'ruden@gmail.com', 'a125f852854bff5d6d876183b1a2562c', 1),
(13, 11, 1, 'Shelley Lamb', 'Non est est', 'faloweka', 'cara@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_ID` int(5) NOT NULL,
  `stall_ID` int(3) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_img` text DEFAULT NULL,
  `product_category` varchar(50) DEFAULT NULL,
  `product_unit` varchar(10) DEFAULT NULL,
  `product_price` varchar(50) DEFAULT NULL,
  `product_status` int(2) DEFAULT NULL,
  `date_added` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_ID`, `stall_ID`, `product_name`, `product_img`, `product_category`, `product_unit`, `product_price`, `product_status`, `date_added`) VALUES
(7, 14, 'CHICKEN DRUMSTICKS', '../product_img/6450b18473537.jfif', 'Meat', 'Kilo', '240.00', 1, '2023-05-02 14:45:24.472499'),
(8, 14, 'CHICKEN WINGS', '../product_img/6450b19dea260.jfif', 'Meat', 'Kilo', '250.00', 1, '2023-05-02 14:45:49.959191'),
(9, 14, 'PORK LEG', '../product_img/6450b1bce70e8.jfif', 'Meat', 'Kilo', '260', 1, '2023-05-02 14:46:20.946685'),
(10, 14, 'WHOLE CHICKEN', '../product_img/6450b204eb1ab.jfif', 'Meat', 'Pc.', '500.00', 1, '2023-05-02 14:47:32.963071'),
(11, 13, 'Century Tuna Flakes in Oil', '../product_img/6450b2c6b8a57.jpg', 'Canned/Jarred Goods', 'Pc.', '34.00', 1, '2023-05-02 14:50:46.756465'),
(12, 13, 'Argentina Corn Beef', '../product_img/6450b2dec7608.jfif', 'Canned/Jarred Goods', 'Pc.', '34', 1, '2023-05-02 14:51:10.816773'),
(13, 13, 'Mega Sardines', '../product_img/6450b301c9a32.jfif', 'Canned/Jarred Goods', 'Pc.', '24', 1, '2023-05-02 14:51:45.826030'),
(16, 15, 'Simcard pin', '../product_img/64532585947d0.jpg', 'Cleaners', 'Pc.', '12222', 1, '2023-05-04 11:24:53.608336'),
(17, 15, 'CARROT', '../product_img/645341ce4f214.jpg', 'Beverages', 'Kilo', '10.33', 1, '2023-05-04 13:25:34.324217'),
(18, 13, 'Clorox', '../product_img/6453b076da0bc.jpg', 'Cleaners', 'Pc.', '120.00', 1, '2023-05-04 21:17:42.893367'),
(19, 13, 'Lysol', '../product_img/6453b090a943e.jpg', 'Cleaners', 'Pc.', '70.00', 1, '2023-05-04 21:18:08.693570'),
(20, 13, 'Pork Leg', '../product_img/6453b0be6ada4.jfif', 'Meat', 'Kilo', '350.00', 1, '2023-05-04 21:18:54.437873'),
(21, 13, 'Lettuce', '../product_img/6453b12ce6c1b.jfif', 'Fruits/Vegetables', 'Pack', '30.00', 1, '2023-05-04 21:20:44.945272'),
(22, 16, 'Sap sap', '../product_img/6453b1fdc8fdf.jfif', 'Fish', 'Kilo', '240.00', 1, '2023-05-04 21:24:13.823326'),
(23, 16, 'Tulingan', '../product_img/6453b21c10477.jfif', 'Fish', 'Kilo', '250.00', 1, '2023-05-04 21:24:44.067006'),
(24, 16, 'Lapu Lapu', '../product_img/6453b237a206f.jfif', 'Fish', 'Kilo', '250.00', 1, '2023-05-04 21:25:11.663950'),
(25, 16, 'Tanigue', '../product_img/6453b25822ee7.jfif', 'Fish', 'Kilo', '260.00', 1, '2023-05-04 21:25:44.143238');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_ID` int(8) NOT NULL,
  `product_ID` int(5) NOT NULL,
  `vendor_ID` int(4) NOT NULL,
  `customer_ID` int(4) NOT NULL,
  `reservation_date` datetime DEFAULT NULL,
  `reservation_expdate` datetime DEFAULT NULL,
  `quantity` int(5) NOT NULL,
  `reserve_status` int(2) NOT NULL,
  `reserve_index` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_ID`, `product_ID`, `vendor_ID`, `customer_ID`, `reservation_date`, `reservation_expdate`, `quantity`, `reserve_status`, `reserve_index`) VALUES
(169, 13, 1, 2, '2023-05-03 11:39:42', '2023-05-04 21:50:00', 1, 5, 13),
(170, 12, 1, 2, '2023-05-03 11:39:42', '2023-05-04 21:50:00', 1, 5, 13),
(171, 11, 1, 2, '2023-05-03 11:39:42', '2023-05-04 21:50:00', 1, 5, 13),
(172, 9, 3, 2, '2023-05-03 11:39:42', NULL, 1, 5, 14),
(173, 8, 3, 2, '2023-05-03 11:39:42', NULL, 1, 5, 14),
(174, 7, 3, 2, '2023-05-03 11:39:42', NULL, 1, 5, 14),
(175, 10, 3, 2, '2023-05-03 11:39:42', NULL, 1, 5, 14),
(176, 16, 4, 3, '2023-05-04 11:30:16', '2023-05-05 13:28:00', 1, 5, 15),
(177, 17, 4, 3, '2023-05-04 13:27:06', '2023-05-05 13:27:00', 10, 5, 15),
(178, 16, 4, 3, '2023-05-04 13:27:06', '2023-05-05 13:27:00', 1000, 5, 15),
(179, 10, 3, 2, NULL, NULL, 1, 0, 14),
(180, 9, 3, 2, NULL, NULL, 1, 0, 14),
(181, 13, 1, 2, NULL, NULL, 1, 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `stall`
--

CREATE TABLE `stall` (
  `stall_ID` int(3) NOT NULL,
  `map_ID` int(2) DEFAULT NULL,
  `market_admin_ID` int(4) DEFAULT NULL,
  `vendor_ID` int(4) DEFAULT NULL,
  `stall_name` varchar(50) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `stall_status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stall`
--

INSERT INTO `stall` (`stall_ID`, `map_ID`, `market_admin_ID`, `vendor_ID`, `stall_name`, `latitude`, `longitude`, `stall_status`) VALUES
(13, 7, 9, 1, 'Reynaldo\'s Stall 1', 14.5804, 13.8349, 2),
(14, 8, 11, 3, 'Ruy`s Store', 18.1095, 18.4545, 2),
(15, 9, 12, 4, 'Simcard stall', 50.2994, 3.6796, 2),
(16, 10, 10, 2, 'Claire` Store 1', 73.3992, 67.6493, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_ID` int(4) NOT NULL,
  `market_admin_ID` int(4) DEFAULT NULL,
  `vendor_status` int(2) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact` varchar(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_ID`, `market_admin_ID`, `vendor_status`, `name`, `contact`, `username`, `email`, `password`) VALUES
(1, 9, 1, 'Reynaldo Ilangos', '12345678900', 'reynaldovendor', 'reynaldoVen@gmail.com', 'e1fa195f6e07eed277c5e5db62363781'),
(2, 10, 1, 'Claire Sunico', '12345678900', 'claire', 'ruyembiadoofficial@gmail.com', '60d812674aec5c13d5c453c8cee68efa'),
(3, 11, 1, 'Ruden Buensuceso', '12345678900', 'ruden', 'testtest@gmail.com', '7ff7319644a7c63d8b12260325d63258'),
(4, 12, 1, 'Ruven', '09123456798', 'Ruven', 'ruven@gmail.com', 'd9b5bb13537a876fef2af8961cf3a2db');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_ID`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`map_ID`),
  ADD KEY `market_admin_ID` (`market_admin_ID`),
  ADD KEY `market_ID` (`market_ID`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`market_ID`),
  ADD KEY `admin_ID` (`admin_ID`) USING BTREE;

--
-- Indexes for table `market_admin`
--
ALTER TABLE `market_admin`
  ADD PRIMARY KEY (`market_admin_ID`),
  ADD KEY `admin_ID` (`admin_ID`),
  ADD KEY `market_ID` (`market_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_ID`),
  ADD KEY `stall_ID` (`stall_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_ID`),
  ADD KEY `vendor_ID` (`vendor_ID`),
  ADD KEY `product_ID` (`product_ID`),
  ADD KEY `customer_ID` (`customer_ID`);

--
-- Indexes for table `stall`
--
ALTER TABLE `stall`
  ADD PRIMARY KEY (`stall_ID`),
  ADD KEY `map_ID` (`map_ID`),
  ADD KEY `market_admin_ID` (`market_admin_ID`),
  ADD KEY `vendor_ID` (`vendor_ID`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_ID`),
  ADD KEY `market_admin_ID` (`market_admin_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `map_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `market_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `market_admin`
--
ALTER TABLE `market_admin`
  MODIFY `market_admin_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `stall`
--
ALTER TABLE `stall`
  MODIFY `stall_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `map`
--
ALTER TABLE `map`
  ADD CONSTRAINT `map_ibfk_1` FOREIGN KEY (`market_admin_ID`) REFERENCES `market_admin` (`market_admin_ID`),
  ADD CONSTRAINT `map_ibfk_2` FOREIGN KEY (`market_ID`) REFERENCES `market` (`market_ID`);

--
-- Constraints for table `market`
--
ALTER TABLE `market`
  ADD CONSTRAINT `market_ibfk_1` FOREIGN KEY (`admin_ID`) REFERENCES `admin` (`admin_ID`);

--
-- Constraints for table `market_admin`
--
ALTER TABLE `market_admin`
  ADD CONSTRAINT `market_admin_ibfk_2` FOREIGN KEY (`admin_ID`) REFERENCES `admin` (`admin_ID`),
  ADD CONSTRAINT `market_admin_ibfk_3` FOREIGN KEY (`market_ID`) REFERENCES `market` (`market_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`stall_ID`) REFERENCES `stall` (`stall_ID`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customer_ID`) REFERENCES `customer` (`customer_ID`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`product_ID`) REFERENCES `product` (`product_ID`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`vendor_ID`) REFERENCES `vendor` (`vendor_ID`);

--
-- Constraints for table `stall`
--
ALTER TABLE `stall`
  ADD CONSTRAINT `stall_ibfk_1` FOREIGN KEY (`map_ID`) REFERENCES `map` (`map_ID`),
  ADD CONSTRAINT `stall_ibfk_3` FOREIGN KEY (`vendor_ID`) REFERENCES `vendor` (`vendor_ID`);

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`market_admin_ID`) REFERENCES `market_admin` (`market_admin_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
