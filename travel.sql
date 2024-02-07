-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024-02-07 07:44:47
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `travel`
--

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `rooms` int(1) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `roomnum` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `no` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `rooms`, `start`, `end`, `roomnum`, `days`, `no`, `name`, `email`, `tel`, `note`, `payment`, `created_at`) VALUES
(1, 1, '2024-01-13', '2024-01-13', '6', 1, '202402060001', 'dsfsadf', 'sdafsadf', 'sdfsdf', 'sdfsdafsadf', 5000, '2024-02-06 06:44:11'),
(2, 1, '2024-01-11', '2024-01-17', '1', 7, '202402060002', 'dsfasdf', 'sdfsdfs', 'fasdfsdaf', 'sdfasdfas', 35000, '2024-02-06 06:44:25'),
(3, 1, '2024-01-14', '2024-01-14', '2', 1, '202402060003', 'dfads', 'sdafsadf', 'sdfsafsd', 'fsafasf', 5000, '2024-02-06 06:44:37'),
(4, 1, '2024-02-13', '2024-02-24', '6', 12, '202402060004', 'fdgdfsg', 'fdgsdfgfds', 'gdfsgdsfg', 'dfgdfsgfds', 60000, '2024-02-06 07:36:58'),
(5, 1, '2024-02-21', '2024-02-21', '5', 1, '202402060005', 'fdgsfg', 'dfgdsfg', 'dfgsdfg', 'dfgdsfg', 5000, '2024-02-06 07:37:08'),
(6, 1, '2024-02-13', '2024-02-13', '8', 1, '202402060006', 'dfasdf', 'sfsdaf', 'sdfsdaf', 'sfsafsa', 5000, '2024-02-06 08:26:36'),
(7, 1, '2024-02-19', '2024-02-24', '5', 6, '202402060007', 'dsfaf', 'sdfsa', 'fsdfsdf', 'fsdafsad', 30000, '2024-02-06 08:27:13'),
(8, 1, '2024-02-19', '2024-02-21', '3', 3, '202402060008', '', '', '', '', 15000, '2024-02-06 08:36:33'),
(9, 1, '2024-03-11', '2024-03-16', '4', 6, '202402060009', 'sdafs', 'fsdfsdf', 'sdfsadfsd', 'sdfafdsadfsdfsd\nsdfsdfaf', 30000, '2024-02-06 08:46:50'),
(10, 1, '2024-02-21', '2024-02-24', '7', 4, '202402070010', 'dsfsaf', 'sfsaf', 'sdfsfsa', 'sdfas', 20000, '2024-02-07 06:43:36'),
(11, 1, '2024-02-23', '2024-02-23', '8', 1, '202402070011', 'dsafsdf', 'dsafsad', 'sdfsad', 'fsafas', 5000, '2024-02-07 06:43:52');

-- --------------------------------------------------------

--
-- 資料表結構 `room_booked`
--

CREATE TABLE `room_booked` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `roomnum` tinyint(1) UNSIGNED NOT NULL,
  `orderno` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `room_booked`
--

INSERT INTO `room_booked` (`id`, `date`, `roomnum`, `orderno`) VALUES
(1, '2024-01-13', 6, '202402060001'),
(2, '2024-01-12', 1, '202402060002'),
(3, '2024-01-13', 1, '202402060002'),
(4, '2024-01-14', 1, '202402060002'),
(5, '2024-01-15', 1, '202402060002'),
(6, '2024-01-16', 1, '202402060002'),
(7, '2024-01-17', 1, '202402060002'),
(8, '2024-01-18', 1, '202402060002'),
(9, '2024-01-14', 2, '202402060003'),
(10, '2024-02-14', 6, '202402060004'),
(11, '2024-02-15', 6, '202402060004'),
(12, '2024-02-16', 6, '202402060004'),
(13, '2024-02-17', 6, '202402060004'),
(14, '2024-02-18', 6, '202402060004'),
(15, '2024-02-19', 6, '202402060004'),
(16, '2024-02-20', 6, '202402060004'),
(17, '2024-02-21', 6, '202402060004'),
(18, '2024-02-22', 6, '202402060004'),
(19, '2024-02-23', 6, '202402060004'),
(20, '2024-02-24', 6, '202402060004'),
(21, '2024-02-25', 6, '202402060004'),
(22, '2024-02-21', 5, '202402060005'),
(23, '2024-02-13', 8, '202402060006'),
(24, '2024-02-20', 5, '202402060007'),
(25, '2024-02-21', 5, '202402060007'),
(26, '2024-02-22', 5, '202402060007'),
(27, '2024-02-23', 5, '202402060007'),
(28, '2024-02-24', 5, '202402060007'),
(29, '2024-02-25', 5, '202402060007'),
(30, '2024-02-19', 3, '202402060008'),
(31, '2024-02-20', 3, '202402060008'),
(32, '2024-02-21', 3, '202402060008'),
(33, '2024-03-11', 4, '202402060009'),
(34, '2024-03-12', 4, '202402060009'),
(35, '2024-03-13', 4, '202402060009'),
(36, '2024-03-14', 4, '202402060009'),
(37, '2024-03-15', 4, '202402060009'),
(38, '2024-03-16', 4, '202402060009'),
(39, '2024-02-21', 7, '202402070010'),
(40, '2024-02-22', 7, '202402070010'),
(41, '2024-02-23', 7, '202402070010'),
(42, '2024-02-24', 7, '202402070010'),
(43, '2024-02-23', 8, '202402070011');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `room_booked`
--
ALTER TABLE `room_booked`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `room_booked`
--
ALTER TABLE `room_booked`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
