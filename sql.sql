-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021 年 11 月 22 日 05:43
-- 伺服器版本： 8.0.22
-- PHP 版本： 7.3.29-to-be-removed-in-future-macOS

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `midterm`
--

-- --------------------------------------------------------

--
-- 資料表結構 `rollcalls`
--

CREATE TABLE `rollcalls` (
  `id` int NOT NULL,
  `class_name` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  `delay` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `rollcalls`
--

INSERT INTO `rollcalls` (`id`, `class_name`, `date`, `time`, `delay`) VALUES
(1, '程式設計', '2021-11-22', '13:35', '30');

-- --------------------------------------------------------

--
-- 資料表結構 `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `school_number` text COLLATE utf8_unicode_ci NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `image_path` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `students`
--

INSERT INTO `students` (`id`, `name`, `school_number`, `status`, `image_path`, `time`) VALUES
(1, '陳昀鴻', '108AC1007', '辨識成功', 'images/108ac1007.png', '2021-11-16 12:07:00');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `account` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `class` text COLLATE utf8_unicode_ci NOT NULL,
  `school_number` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `account`, `password`, `class`, `school_number`, `name`) VALUES
(1, '106390026@ntut.edu.tw', '1234', '互動四', '106390026', '李紹瑋'),
(2, '106650006@ntut.edu.tw', '1234', '互動四', '106650006', '鄭頤'),
(3, '107360102@ntut.edu.tw', '1234', '互動四', '107360102', '陳嵥翔'),
(4, '107390024@ntut.edu.tw', '1234', '互動四', '107390024', '朱子希'),
(5, '107AC2026@ntut.edu.tw', '1234', '互動三', '107AC2026', '王羿淩'),
(6, '107AC2032@ntut.edu.tw', '1234', '互動三', '107AC2032', '余正鵬'),
(7, '108840003@ntut.edu.tw', '1234', '互動三', '108840003', '白紹廷'),
(8, '108840005@ntut.edu.tw', '1234', '互動三', '108840005', '謝婷安'),
(9, '108840006@ntut.edu.tw', '1234', '互動三', '108840006', '姚怡如'),
(10, '108840009@ntut.edu.tw', '1234', '互動三', '108840009', '劉潔昕'),
(11, '108840010@ntut.edu.tw', '1234', '互動三', '108840010', '蕭維信'),
(12, '108840012@ntut.edu.tw', '1234', '互動三', '108840012', '陳佩霞'),
(13, '108840013@ntut.edu.tw', '1234', '互動三', '108840013', '鄭郁齡'),
(14, '108840014@ntut.edu.tw', '1234', '互動三', '108840014', '黃可榆'),
(15, '108840016@ntut.edu.tw', '1234', '互動三', '108840016', '李筠'),
(16, '108AC1001@ntut.edu.tw', '1234', '互動三', '108AC1001', '呂亞衡'),
(17, '108AC1002@ntut.edu.tw', '1234', '互動三', '108AC1002', '林昱秀'),
(18, '108AC1003@ntut.edu.tw', '1234', '互動三', '108AC1003', '李佳霖'),
(19, '108AC1004@ntut.edu.tw', '1234', '互動三', '108AC1004', '周祐羽'),
(20, '108AC1005@ntut.edu.tw', '1234', '互動三', '108AC1005', '陳宏威'),
(21, '108AC1006@ntut.edu.tw', '1234', '互動三', '108AC1006', '鄭高峰'),
(22, '108AC1007@ntut.edu.tw', '1234', '互動三', '108AC1007', '陳昀鴻'),
(23, '108AC1008@ntut.edu.tw', '1234', '互動三', '108AC1008', '劉子豪'),
(24, '108AC1009@ntut.edu.tw', '1234', '互動三', '108AC1009', '陳語哲'),
(25, '108AC1010@ntut.edu.tw', '1234', '互動三', '108AC1010', '陳柏鈺'),
(26, '108AC1011@ntut.edu.tw', '1234', '互動三', '108AC1011', '劉芝良'),
(27, '108AC1012@ntut.edu.tw', '1234', '互動三', '108AC1012', '藍科晨'),
(28, '108AC1013@ntut.edu.tw', '1234', '互動三', '108AC1013', '王威程'),
(29, '108AC1015@ntut.edu.tw', '1234', '互動三', '108AC1015', '紀棋峰'),
(30, '108AC1016@ntut.edu.tw', '1234', '互動三', '108AC1016', '廖祐凜'),
(31, '108AC1017@ntut.edu.tw', '1234', '互動三', '108AC1017', '鄭子暘'),
(32, '108AC1018@ntut.edu.tw', '1234', '互動三', '108AC1018', '徐牧凡'),
(33, '108AC1019@ntut.edu.tw', '1234', '互動三', '108AC1019', '陳冠臻'),
(34, '108AC1020@ntut.edu.tw', '1234', '互動三', '108AC1020', '盧姿予'),
(35, '108AC1021@ntut.edu.tw', '1234', '互動三', '108AC1021', '謝妤羚'),
(36, '108AC1022@ntut.edu.tw', '1234', '互動三', '108AC1022', '林辰'),
(37, '108AC1023@ntut.edu.tw', '1234', '互動三', '108AC1023', '陳裔妘'),
(38, '108AC1024@ntut.edu.tw', '1234', '互動三', '108AC1024', '魏均佾'),
(39, '108AC1025@ntut.edu.tw', '1234', '互動三', '108AC1025', '林沛琪'),
(40, '108AC1027@ntut.edu.tw', '1234', '互動三', '108AC1027', '吳佳濨'),
(41, '108AC1028@ntut.edu.tw', '1234', '互動三', '108AC1028', '賴品尤'),
(42, '108AC1030@ntut.edu.tw', '1234', '互動三', '108AC1030', '劉家仁'),
(43, '108AC1031@ntut.edu.tw', '1234', '互動三', '108AC1031', '梁宇欣'),
(44, '108AC1033@ntut.edu.tw', '1234', '互動三', '108AC1033', '張永義'),
(45, '108AC1034@ntut.edu.tw', '1234', '互動三', '108AC1034', '林珂渝'),
(46, '108AC1035@ntut.edu.tw', '1234', '互動三', '108AC1035', '梁紫欣'),
(47, '108AC1036@ntut.edu.tw', '1234', '互動三', '108AC1036', '蔡祿昌'),
(48, '108AC1037@ntut.edu.tw', '1234', '互動三', '108AC1037', '黃靖娉'),
(49, '108AC2002@ntut.edu.tw', '1234', '互動三', '108AC2002', '張哲甄'),
(50, '108AC2005@ntut.edu.tw', '1234', '互動三', '108AC2005', '謝佩臻'),
(51, '108AC2006@ntut.edu.tw', '1234', '互動三', '108AC2006', '賴韋岑'),
(52, '108AC2007@ntut.edu.tw', '1234', '互動三', '108AC2007', '李佩佳'),
(53, '108AC2008@ntut.edu.tw', '1234', '互動三', '108AC2008', '簡妙如'),
(54, '108AC2009@ntut.edu.tw', '1234', '互動三', '108AC2009', '宋明彥'),
(55, '108AC2010@ntut.edu.tw', '1234', '互動三', '108AC2010', '李婕澐'),
(56, '108AC2011@ntut.edu.tw', '1234', '互動三', '108AC2011', '郭芝伶'),
(57, '108AC2012@ntut.edu.tw', '1234', '互動三', '108AC2012', '謝承邑'),
(58, '108AC2013@ntut.edu.tw', '1234', '互動三', '108AC2013', '鄭力綾'),
(59, '108AC2014@ntut.edu.tw', '1234', '互動三', '108AC2014', '朱映如'),
(60, '108AC2015@ntut.edu.tw', '1234', '互動三', '108AC2015', '廖芊嘉'),
(61, '108AC2016@ntut.edu.tw', '1234', '互動三', '108AC2016', '劉志賢'),
(62, '108AC2017@ntut.edu.tw', '1234', '互動三', '108AC2017', '盧昱瑄'),
(63, '108AC2018@ntut.edu.tw', '1234', '互動三', '108AC2018', '陳冠廷'),
(64, '108AC2019@ntut.edu.tw', '1234', '互動三', '108AC2019', '謝平怡'),
(65, '108AC2020@ntut.edu.tw', '1234', '互動三', '108AC2020', '彭翌臻'),
(66, '108AC2021@ntut.edu.tw', '1234', '互動三', '108AC2021', '洪錫範'),
(67, '108AC2022@ntut.edu.tw', '1234', '互動三', '108AC2022', '王品勻'),
(68, '108AC2023@ntut.edu.tw', '1234', '互動三', '108AC2023', '暤芷瓔'),
(69, '108AC2024@ntut.edu.tw', '1234', '互動三', '108AC2024', '卓心雲'),
(70, '108AC2025@ntut.edu.tw', '1234', '互動三', '108AC2025', '陳紹恩'),
(71, '108AC2026@ntut.edu.tw', '1234', '互動三', '108AC2026', '黃丞君'),
(72, '108AC2031@ntut.edu.tw', '1234', '互動三', '108AC2031', '廖嘉欣'),
(73, '108AC2033@ntut.edu.tw', '1234', '互動三', '108AC2033', '林健朗'),
(74, '108AC2034@ntut.edu.tw', '1234', '互動三', '108AC2034', '黃卉吟'),
(75, '108AC2035@ntut.edu.tw', '1234', '互動三', '108AC2035', '李思學'),
(76, '108AC2036@ntut.edu.tw', '1234', '互動三', '108AC2036', '劉善聰'),
(77, '108AC2038@ntut.edu.tw', '1234', '互動三', '108AC2038', '佘家陞'),
(78, '108AC2039@ntut.edu.tw', '1234', '互動三', '108AC2039', '林美蒨'),
(79, '108AC2040@ntut.edu.tw', '1234', '互動三', '108AC2040', '陳愷彥'),
(80, '108AC2041@ntut.edu.tw', '1234', '互動三', '108AC2041', '葉昊天'),
(81, '110AEK002@ntut.edu.tw', '1234', '二互動港生一', '110AEK002', '湯曉琪'),
(82, '110AEK003@ntut.edu.tw', '1234', '二互動港生一', '110AEK003', '李鴻杰');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `rollcalls`
--
ALTER TABLE `rollcalls`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rollcalls`
--
ALTER TABLE `rollcalls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
