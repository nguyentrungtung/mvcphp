-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 13, 2018 lúc 08:01 AM
-- Phiên bản máy phục vụ: 10.1.29-MariaDB
-- Phiên bản PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mvc_php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name_cate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT '0',
  `time_create` int(11) DEFAULT NULL,
  `time_update` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name_cate`, `status`, `time_create`, `time_update`) VALUES
(21, 'category 4', 1, 1531448050, 1531448050),
(22, 'category 5', 1, 1531448056, 1531448056),
(23, 'category 6', 0, 1531448061, 1531448061),
(24, 'category 7', 0, 1531448075, 1531448075),
(25, 'category 8', 0, 1531448081, 1531448081);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` double DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `time_create` int(11) DEFAULT NULL,
  `time_update` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name_product`, `image`, `description`, `price`, `status`, `time_create`, `time_update`) VALUES
(19, 'product 35665656', '1.jpg/2.jpg/4.jpg', '																																																		rẻwerwrr																																																																																																																																																																																															', 54545546, 0, 1531315894, 1531369947),
(21, 'product 2', 'monan3.png/monan4.png/gallery4.png', '																														dsdsdad11111111111111																																		', 5435354, 0, 1531317441, 1531319413),
(22, 'product 3456111', '2.jpg/larg-1.jpg/s2.jpg/9.jpg', '																				rêrerererer																		', 1250000, 0, 1531362623, 1531365326),
(23, 'product 12', '3.jpg/8.jpg/13.jpg/larg-4.jpg', 'dádadas', 1250000, 0, 1531370076, 1531370076),
(24, 'product 3111', '3.jpg/2.jpg/6.jpg/1.jpg', 'sdsdsdsd', 45280000, 0, 1531377885, 1531377885),
(25, 'product 3333', '6.jpg/4.jpg/8.jpg/10.jpg', 'dsdsdss', 45280000, 0, 1531386109, 1531386109),
(26, 'product 254545', '12.jpg/6.jpg/1.jpg', 'dsdsđsdsd', 45280000, 0, 1531386138, 1531386138),
(27, 'product 343333', '3.jpg/6.jpg/1.jpg/9.jpg/10.jpg/s2.jpg/9.jpg', '										đsdsdsds									', 45280000, 0, 1531388898, 1531390117),
(29, 'product 312', 'gallery4.png/monan1.png/monan3.png/monan2.png/gallery3.png', 'dấdasdsadsads', 45280000, 0, 1531454019, 1531454019);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT '0',
  `time_create` int(11) DEFAULT NULL,
  `time_update` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_user`
--

INSERT INTO `tb_user` (`id`, `user`, `password`, `status`, `time_create`, `time_update`) VALUES
(20, 'administrator121', '0192023a7bbd73250516f069df18b500', 0, 1531196360, 1531453971),
(22, 'tungnt92', 'fcde09b335ffc9ee559ed42716218bab', 0, 1531208356, 1531280271),
(24, 'admin1111111', '25f9e794323b453885f5181f1b624d0b', 0, 1531390069, 1531390069),
(26, 'administrator12333', '25d55ad283aa400af464c76d713c07ad', 0, 1531453960, 1531453960);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
