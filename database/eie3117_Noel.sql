-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2019 年 02 月 17 日 13:44
-- 伺服器版本: 10.1.37-MariaDB
-- PHP 版本： 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `eie3117`
--

-- --------------------------------------------------------

--
-- 資料表結構 `drivers`
--

CREATE TABLE `drivers` (
  `username` varchar(20) NOT NULL,
  `carClass` varchar(20) NOT NULL,
  `carModel` varchar(20) NOT NULL,
  `carPlateNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `drivers_map_mark`
--

CREATE TABLE `drivers_map_mark` (
  `drivers_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `history`
--

CREATE TABLE `history` (
  `passengerName` varchar(20) NOT NULL,
  `driverName` int(11) NOT NULL,
  `startingLocation_lat` double NOT NULL,
  `startingLocation_lng` double NOT NULL,
  `destination_lat` double NOT NULL,
  `destination_lng` double NOT NULL,
  `pickUpTime` date NOT NULL,
  `tips` int(11) NOT NULL,
  `freeToll` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL COMMENT 'Confirmed = 1, Cancelled = 2, Finished = 3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'Love.Fish', '580 Darling Street, Rozelle, NSW', -33.861034, 151.171936, 'restaurant'),
(2, 'Young Henrys', '76 Wilford Street, Newtown, NSW', -33.898113, 151.174469, 'bar'),
(3, 'Hunter Gatherer', 'Greenwood Plaza, 36 Blue St, North Sydney NSW', -33.840282, 151.207474, 'bar'),
(4, 'The Potting Shed', '7A, 2 Huntley Street, Alexandria, NSW', -33.910751, 151.194168, 'bar'),
(5, 'Nomad', '16 Foster Street, Surry Hills, NSW', -33.879917, 151.210449, 'bar'),
(6, 'Three Blue Ducks', '43 Macpherson Street, Bronte, NSW', -33.906357, 151.263763, 'restaurant'),
(7, 'Single Origin Roasters', '60-64 Reservoir Street, Surry Hills, NSW', -33.881123, 151.209656, 'restaurant'),
(8, 'Red Lantern', '60 Riley Street, Darlinghurst, NSW', -33.874737, 151.215530, 'restaurant');

-- --------------------------------------------------------

--
-- 資料表結構 `passengers`
--

CREATE TABLE `passengers` (
  `username` text NOT NULL,
  `homeLocation` text NOT NULL,
  `workLocation` text NOT NULL,
  `startingLocation_placeID` varchar(300) NOT NULL,
  `destination_placeID` varchar(300) NOT NULL,
  `pickUpTime` varchar(20) NOT NULL,
  `tips` double NOT NULL,
  `freeToll` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` int(12) DEFAULT NULL,
  `email` text,
  `verified` int(11) NOT NULL COMMENT '0=no, 1=yes',
  `verification_code` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phoneNumber`, `email`, `verified`, `verification_code`, `created_at`) VALUES
(3, 'charleswmc', '$2y$10$GV8GjP/sFlArQj3EsqMpRemaqp74MSkhQblMy29ja4deiTgX0JpSq', 66452438, 'charleswmc19970124@gmail.com', 0, 'ad9a7155ffdf16110343bb8013301084', '2019-02-15 11:21:39'),
(1, 'noel', '$2y$10$kDOV.n6gsibiyJRDCR1X9OU1GSvcFqu6swMh.fz.u45FsTpdCThuG', NULL, NULL, 0, NULL, '2019-01-15 14:36:54'),
(2, 'noelwong', '$2y$10$.kJhEOZcWtzCLvTEvA2QdOMJV2UCNyrgs7VLZ8ZQSXU5TV1hCbTQ.', NULL, NULL, 1, NULL, '2019-01-30 18:56:24');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 資料表索引 `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`username`(1));

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
