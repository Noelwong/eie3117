-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019-02-16 23:42:19
-- 伺服器版本: 10.1.34-MariaDB
-- PHP 版本： 5.6.37

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

-- --------------------------------------------------------

--
-- 資料表結構 `passengers`
--

CREATE TABLE `passengers` (
  `username` text NOT NULL,
  `homeLocation` text NOT NULL,
  `workLocation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `pending_ride`
--

CREATE TABLE `pending_ride` (
  `passenger` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pickupTime` time NOT NULL,
  `freeToll` varchar(3) NOT NULL,
  `tips` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `pending_ride`
--

INSERT INTO `pending_ride` (`passenger`, `address`, `pickupTime`, `freeToll`, `tips`) VALUES
('admin', 'CityOne Shatin', '18:00:00', 'No', 10);

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
(4, 'admin', '$2y$10$4wd9ciLNy8r45lm0pCoMueV6lpxXgU/nrjhY5ZdvkG/QAYjFc/G1u', 12345678, 'gaj@com.hk', 1, '4da044be3dae5ed748c26071671a3715', '2019-02-16 16:49:36'),
(3, 'charleswmc', '$2y$10$GV8GjP/sFlArQj3EsqMpRemaqp74MSkhQblMy29ja4deiTgX0JpSq', 66452438, 'charleswmc19970124@gmail.com', 0, 'ad9a7155ffdf16110343bb8013301084', '2019-02-15 11:21:39'),
(1, 'noel', '$2y$10$kDOV.n6gsibiyJRDCR1X9OU1GSvcFqu6swMh.fz.u45FsTpdCThuG', NULL, NULL, 0, NULL, '2019-01-15 14:36:54'),
(2, 'noelwong', '$2y$10$.kJhEOZcWtzCLvTEvA2QdOMJV2UCNyrgs7VLZ8ZQSXU5TV1hCbTQ.', NULL, NULL, 0, NULL, '2019-01-30 18:56:24');

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
-- 資料表索引 `pending_ride`
--
ALTER TABLE `pending_ride`
  ADD PRIMARY KEY (`passenger`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
