-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th7 22, 2020 lúc 05:18 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `201_demo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `category_slug` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `category_gender_id` int(11) NOT NULL,
  `category_show` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug`, `parent_id`, `category_gender_id`, `category_show`) VALUES
(1, 'Áo Nam', 'ao-nam', 0, 1, 1),
(2, 'Quần Nam', 'quan-nam', 0, 1, 1),
(3, 'Áo Nữ', 'ao-nu', 0, 2, 1),
(4, 'Quần Nữ', 'quan-nu', 0, 2, 1),
(5, 'Đầm & Váy', 'dam-vay', 0, 2, 1),
(6, 'Áo Sơ Mi Nam', 'ao-so-mi-nam', 1, 1, 1),
(7, 'Áo Thun Nam', 'ao-thun-nam', 1, 1, 1),
(8, 'Quần Short Nam', 'quan-short-nam', 2, 1, 1),
(9, 'Quần Dài Nam', 'quan-dai-nam', 2, 1, 1),
(10, 'Áo Sơ Mi Nữ', 'ao-so-mi-nu', 3, 2, 1),
(11, 'Áo Thun Nữ', 'ao-thun-nu', 3, 2, 1),
(12, 'Quần Short Nữ', 'quan-short-nu', 4, 2, 1),
(13, 'Quần Dài Nữ', 'quan-dai-nu', 4, 2, 1),
(14, 'Đầm Thun', 'dam-thun', 5, 2, 1),
(15, 'Chân Váy', 'chan-vay', 5, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_gender`
--

CREATE TABLE `category_gender` (
  `category_gender_id` int(11) NOT NULL,
  `category_gender_name` varchar(20) NOT NULL,
  `category_gender_slug` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category_gender`
--

INSERT INTO `category_gender` (`category_gender_id`, `category_gender_name`, `category_gender_slug`) VALUES
(1, 'Thời Trang Nam', 'thoi-trang-nam'),
(2, 'Thời Trang Nữ', 'thoi-trang-nu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `color_value` varchar(7) NOT NULL,
  `color_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`color_value`, `color_name`) VALUES
('#000', 'Đen'),
('#0095B4', 'Xanh navy'),
('#16422C', 'Xanh Rêu'),
('#199959', 'luc lam'),
('#469B70', 'aaa'),
('#779ECB', 'Xanh'),
('#9B0ACD', 'Tím'),
('#9C1616', 'Đỏ đô'),
('#AB5637', 'Cam Đất'),
('#ccc', 'Xám'),
('#E4BC4D', 'Vàng'),
('#F5F5DC', 'Kem'),
('#FCFF0F', 'vang khe'),
('#fff', 'Trắng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`comment_id`, `product_id`, `user_id`, `comment_content`, `created_at`, `updated_at`) VALUES
(17, 23, 4, 'Còn hàng không v shop?', '2020-07-15 08:13:44', '2020-07-15 08:13:44'),
(18, 22, 38, 'Chất liệu ok', '2020-07-16 03:55:38', '2020-07-16 03:55:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `date_sale`
--

CREATE TABLE `date_sale` (
  `date_id` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `date_sale`
--

INSERT INTO `date_sale` (`date_id`, `date_start`, `date_end`) VALUES
(1, NULL, NULL),
(2, '2020-07-01', '2020-08-10'),
(3, '2020-06-27', '2020-07-24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import_coupon`
--

CREATE TABLE `import_coupon` (
  `coupon_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `vat` int(11) NOT NULL,
  `name_employee` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `import_coupon`
--

INSERT INTO `import_coupon` (`coupon_id`, `supplier_id`, `date_created`, `vat`, `name_employee`) VALUES
(1, 1, '2020-03-28 20:06:03', 5, 'vuong'),
(2, 1, '2020-03-29 00:06:08', 5, 'vuong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_user_name` varchar(60) NOT NULL,
  `payment_id` int(11) NOT NULL DEFAULT 1,
  `order_address` varchar(100) NOT NULL,
  `order_phone` decimal(11,0) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_current_day` date NOT NULL,
  `order_state` int(11) NOT NULL DEFAULT 0,
  `order_note` text DEFAULT NULL,
  `order_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_user_name`, `payment_id`, `order_address`, `order_phone`, `order_date`, `order_current_day`, `order_state`, `order_note`, `order_total`) VALUES
(68, NULL, 'Lê Quốc Vương', 1, 'Cái Răng, TPCT', '123456789', '2020-07-14 16:51:09', '2020-07-14', 1, 'giao hàng tiết kiệm', 177000),
(69, NULL, 'Kinglee', 1, 'CR-TPCT', '123123123', '2020-07-15 15:13:07', '2020-07-15', 1, NULL, 756000),
(70, NULL, 'ok', 1, '132332', '121', '2020-07-15 18:27:18', '2020-07-16', 1, '12133', 504000),
(71, NULL, 'test', 1, 'test', '1231322132', '2020-07-16 03:26:28', '2020-07-16', 1, 'no', 477000),
(72, NULL, 'test-final', 1, 'test', '1233132', '2020-07-16 06:35:54', '2020-07-16', 1, NULL, 192000),
(73, NULL, 'vuong', 1, '13212231', '121311', '2020-07-21 13:08:18', '2020-07-21', 0, NULL, 252000),
(74, NULL, 'test', 1, 'ok', '123131131', '2020-07-21 13:08:54', '2020-07-21', 0, NULL, 96000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_detail_name` varchar(100) NOT NULL,
  `order_detail_quantity` decimal(8,0) NOT NULL,
  `order_detail_color` varchar(30) NOT NULL,
  `order_detail_size` varchar(2) NOT NULL,
  `order_detail_price` float NOT NULL,
  `order_detail_percent_sale` int(11) DEFAULT NULL,
  `order_detail_price_sale` float DEFAULT NULL,
  `order_detail_sku` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `order_detail_id`, `product_id`, `order_detail_name`, `order_detail_quantity`, `order_detail_color`, `order_detail_size`, `order_detail_price`, `order_detail_percent_sale`, `order_detail_price_sale`, `order_detail_sku`) VALUES
(68, 781, 23, 'SMTD MACFION THÊU WHALEROAD', '1', 'Xanh Rêu', 'XL', 177000, NULL, NULL, 'SMZA20XL'),
(69, 782, 24, 'ÁO TAY DÀI HOẠ TIẾT PHỐI DÂY KEM', '3', 'Kem', 'L', 210000, NULL, NULL, 'SMN20LK'),
(69, 783, 25, 'ATTN BUNY BUNY HOA TIẾT', '1', 'Xám', 'L', 126000, 10, 140000, '1654-1B'),
(70, 784, 25, 'ATTN BUNY BUNY HOA TIẾT', '4', 'Xám', 'L', 126000, 10, 140000, '1654-1B'),
(71, 785, 23, 'SMTD MACFION THÊU WHALEROAD', '1', 'Xanh Rêu', 'XL', 177000, NULL, NULL, 'SMZA20XL'),
(71, 786, 22, 'SMTD LINEN CT ZARA VIỀN BÂU', '2', 'Xám', 'L', 150000, NULL, NULL, 'SM1420L'),
(72, 787, 27, 'Chân Váy Nữ KC123', '2', 'Trắng', 'M', 96000, 20, 120000, 'V123'),
(73, 788, 25, 'ATTN BUNY BUNY HOA TIẾT', '2', 'Xám', 'L', 126000, 10, 140000, '1654-1B'),
(74, 789, 27, 'Chân Váy Nữ KC123', '1', 'Trắng', 'M', 96000, 20, 120000, 'V123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_content` text DEFAULT NULL,
  `payment_link` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_content`, `payment_link`) VALUES
(1, 'Thanh toán khi nhận hàng (COD)', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `percent_sale`
--

CREATE TABLE `percent_sale` (
  `percent_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `percent_sale`
--

INSERT INTO `percent_sale` (`percent_value`) VALUES
(0),
(10),
(20),
(30);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prices`
--

CREATE TABLE `prices` (
  `date_id` int(11) NOT NULL,
  `percent_value` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `promotion_price` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `prices`
--

INSERT INTO `prices` (`date_id`, `percent_value`, `product_id`, `unit_price`, `promotion_price`) VALUES
(1, 0, 28, 123000, 0),
(2, 10, 24, 220000, 0),
(2, 10, 25, 140000, 0),
(2, 20, 26, 120000, 0),
(2, 20, 27, 120000, 0),
(2, 30, 22, 150000, 0),
(3, 10, 23, 177000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_gender_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_slug` varchar(100) NOT NULL,
  `product_image` varchar(500) DEFAULT NULL,
  `product_unit` varchar(10) NOT NULL DEFAULT 'cái',
  `product_description` text DEFAULT NULL,
  `product_active` int(1) NOT NULL DEFAULT 1,
  `product_new` int(1) NOT NULL DEFAULT 1,
  `product_show` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `category_gender_id`, `supplier_id`, `product_name`, `product_slug`, `product_image`, `product_unit`, `product_description`, `product_active`, `product_new`, `product_show`, `created_at`, `updated_at`) VALUES
(22, 6, 1, 1, 'SMTD LINEN CT ZARA VIỀN BÂU', 'smtd-linen-ct-zara-vien-bau', 'img2020071422515857785100.jpeg', 'cái', '<p>K&iacute;ch thước (<strong>cm</strong>):</p>\n\n<ul>\n	<li>M: ngực 104, d&agrave;i &aacute;o 70</li>\n	<li>&nbsp;L: ngực 108 d&agrave;i &aacute;o 72</li>\n	<li>&nbsp;XL: ngực 114, d&agrave;i &aacute;o 74</li>\n	<li>&nbsp;XXL: ngực 120, d&agrave;i &aacute;o 75</li>\n</ul>', 1, 1, 1, '2020-07-14 15:51:58', '2020-07-14 15:51:58'),
(23, 6, 1, 1, 'SMTD MACFION THÊU WHALEROAD', 'smtd-macfion-theu-whaleroad', 'img2020071423000167697400.webp', 'cái', '<p>K&iacute;ch thước (<strong>cm</strong>):</p>\n\n<ul>\n	<li>&nbsp;M: ngực 106 d&agrave;i &aacute;o 70</li>\n	<li>&nbsp;L: ngực 110, d&agrave;i &aacute;o 70</li>\n	<li>&nbsp;XL: ngực 116, d&agrave;i &aacute;o 71</li>\n</ul>', 1, 1, 1, '2020-07-14 16:00:01', '2020-07-14 16:00:01'),
(24, 10, 2, 3, 'ÁO TAY DÀI HOẠ TIẾT PHỐI DÂY KEM', 'ao-tay-dai-hoa-tiet-phoi-day-kem', 'img2020071423155420060300.jpeg', 'cái', '<p>K&iacute;ch thước:</p>\n\n<p>- Vạt &aacute;o trước 61, vạt &aacute;o sau 63, ngang vai 46, ngực 108, eo 106, tay &aacute;o d&agrave;i 48&nbsp;</p>', 1, 1, 1, '2020-07-14 16:15:54', '2020-07-14 16:21:50'),
(25, 11, 2, 3, 'ATTN BUNY BUNY HOA TIẾT', 'attn-buny-buny-hoa-tiet', 'img2020071423270788536800.jpeg', 'cái', '<p>K&iacute;ch thước:</p>\n\n<p>D&agrave;i 62, ngang vai 43, ngực 100</p>', 1, 1, 1, '2020-07-14 16:27:07', '2020-07-14 16:27:07'),
(26, 12, 2, 2, 'SHORTS JEAN 2454', 'shorts-jean-2454', 'img2020071423303964667800.jpeg', 'cái', NULL, 1, 1, 1, '2020-07-14 16:30:39', '2020-07-14 17:27:56'),
(27, 15, 2, 3, 'Chân Váy Nữ KC123', 'chan-vay-nu-kc123', 'img2020071610294253820900.jpeg', 'cái', '<p>Ch&acirc;n v&aacute;y <strong>nữ</strong> thời trang</p>', 1, 1, 1, '2020-07-16 03:29:42', '2020-07-16 06:48:32'),
(28, 6, 1, 1, 'abc', 'abc', 'img2020071614221309126800.jpeg', 'cái', '<p>test abc<strong> mo ta</strong></p>', 1, 1, 1, '2020-07-16 07:22:13', '2020-07-16 07:22:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attribute`
--

CREATE TABLE `product_attribute` (
  `size_value` varchar(2) NOT NULL,
  `color_value` varchar(7) NOT NULL,
  `product_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL DEFAULT 1,
  `quantity_current` int(11) NOT NULL,
  `sku` varchar(25) NOT NULL,
  `price_input` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product_attribute`
--

INSERT INTO `product_attribute` (`size_value`, `color_value`, `product_id`, `coupon_id`, `quantity_current`, `sku`, `price_input`) VALUES
('29', '#779ECB', 26, 1, 20, '1422-S', NULL),
('L', '#ccc', 22, 1, 20, 'SM1420L', NULL),
('L', '#ccc', 25, 1, 10, '1654-1B', NULL),
('L', '#F5F5DC', 24, 1, 15, 'SMN20LK', NULL),
('M', '#F5F5DC', 24, 1, 10, 'SMN20MK', NULL),
('M', '#fff', 24, 1, 10, 'SMN20MT', NULL),
('M', '#fff', 27, 1, 10, 'V123', NULL),
('M', '#fff', 28, 1, 10, '123', NULL),
('XL', '#16422C', 23, 1, 10, 'SMZA20XL', NULL),
('XL', '#9B0ACD', 22, 1, 12, 'SM1420XL', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ranking`
--

CREATE TABLE `ranking` (
  `ranking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `revenue_current_day`
--

CREATE TABLE `revenue_current_day` (
  `revenue_current_day_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `revenue_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `size_value` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`size_value`) VALUES
('29'),
('30'),
('31'),
('L'),
('M'),
('S'),
('XL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_link` text NOT NULL,
  `slide_show` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_link`, `slide_show`) VALUES
(7, 'img2020042919405751338100.webp', 0),
(8, 'img2020052223200644548100.webp', 1),
(9, 'img2020052223315768237600.webp', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`) VALUES
(1, 'Yame'),
(2, 'IVYMODA'),
(3, 'aliceblue'),
(4, 'ELISE'),
(5, 'Calvin Klein');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(16) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` text NOT NULL,
  `user_role` int(1) NOT NULL DEFAULT 0,
  `password` varchar(150) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_role`, `password`, `remember_token`, `created_at`, `updated_at`, `user_register_date`) VALUES
(2, 'vuong', 'vuong@gmail.com', 'vuong@gmail.com', 1, '$2y$10$Ytvn00hfwRQ.tzG949PCruZVnVDhJUzWmXv4s2iarOh5yFgIkqRAu', NULL, NULL, NULL, '0000-00-00'),
(4, 'test', 'test@gmail.com', '23411', 0, '$2y$10$f29XLBxe79Gr4pFn1689z.nz1eKSAD/8UzKPlljQW9IneE9tj096u', '3aYL9f46xG4l3uTShFmxq6Vqrow6bGRfzjklXRS5dA4hSecIDoDy7bYhCZ40', '2020-04-15 04:10:09', '2020-04-15 04:10:09', '0000-00-00'),
(5, 'test123', 'test@gmail.com', '527277', 0, '$2y$10$TRnje8yhbq7e9Kd126.eYO9pFIXW8zNEi7GmNesbdUnSU8xHZZR2a', NULL, '2020-04-15 04:40:38', '2020-04-15 04:40:38', '0000-00-00'),
(7, 'thien', 'thien@gmail.com', '0256897255', 0, '$2y$10$cj6eKGEVSEnKlvz.nkf/5upmUGoebSL9qnC5LJ7LyZLDg9cM7NUAS', NULL, NULL, NULL, '0000-00-00'),
(30, 'VuongLe', 'vuong@gmail123.com', '1256888888', 0, '$2y$10$X.a.p77wTvNfF0C8UvlHJOd3OXu6NBbgtDVzXAMY0vhx8.2gyesb.', NULL, '2020-04-25 06:30:32', '2020-04-25 06:30:32', '0000-00-00'),
(33, 'friends', 'friends@gmail.com', '2525252525', 0, '$2y$10$KmByvVITB2YrEZfA.sTfDeegrfoDZlRCTVp.jhQmC0.Cvm5ReWr3e', NULL, '2020-05-15 01:35:51', '2020-05-15 01:35:51', '2020-05-15'),
(35, 'vuongb1709583', 'vuongctu@gmail.com', '0365895212', 0, '$2y$10$UvZuFwjKkacchCaOxYRRmeLzMjI7pXYLwicZNFPlxQGQNwUEnQqFC', '5GbIXvUa1rGKm1EmfE3vBsrVibjPqlm6uVGUIsr2', '2020-07-11 08:51:24', '2020-07-11 08:51:24', '2020-07-11'),
(36, 'phong', 'phongbui241299@gmail.com', '1515465', 0, '$2y$10$obj.8XDqOLTzJJHvuXuMbODT.30tHTWQjqGcvzlEBl0PEtRpH.qE2', '31G4OSZ5WLR7Q8klyvm0MAzqSucLcL1yU3CGYef6z4tkgeVfTNRoOV42Z5Qw', '2020-07-13 12:08:40', '2020-07-13 12:08:40', '2020-07-13'),
(37, 'phong', 'phong@gmail.com', '654654164', 0, '$2y$10$WC6aUYm2JWXi/zZOBc3Z/.WjeEorP7au/042X6KLqh78PpU4LxlNK', 'wvlgLjpqqsasLGojOGefek2MhaRwjlJSuy79B5PH', '2020-07-14 10:21:32', '2020-07-14 10:21:32', '2020-07-14'),
(38, 'Join', 'join@gmail.com', '123456789', 0, '$2y$10$78J9R/IIAm.QvkPuuRTyxeP3qrY8tC5nleOGt59e9TKVefujDHWky', 'vrmJETM6tZrFDASeKm1slzeW8uNlZgMd8FbRzFVL', '2020-07-16 03:54:47', '2020-07-16 03:54:47', '2020-07-16');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_gender_id` (`category_gender_id`);

--
-- Chỉ mục cho bảng `category_gender`
--
ALTER TABLE `category_gender`
  ADD PRIMARY KEY (`category_gender_id`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`color_value`),
  ADD UNIQUE KEY `color_value` (`color_value`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `FK_product_comment` (`product_id`),
  ADD KEY `FK_user_comment` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Chỉ mục cho bảng `date_sale`
--
ALTER TABLE `date_sale`
  ADD PRIMARY KEY (`date_id`);

--
-- Chỉ mục cho bảng `import_coupon`
--
ALTER TABLE `import_coupon`
  ADD PRIMARY KEY (`coupon_id`),
  ADD KEY `FK_coupon_supplier` (`supplier_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_payment_order` (`payment_id`),
  ADD KEY `FK_user_order` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `FK_product_order_detail` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Chỉ mục cho bảng `percent_sale`
--
ALTER TABLE `percent_sale`
  ADD PRIMARY KEY (`percent_value`);

--
-- Chỉ mục cho bảng `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`date_id`,`percent_value`,`product_id`),
  ADD KEY `FK_discount_value` (`percent_value`),
  ADD KEY `FK_product_price` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`) USING BTREE,
  ADD KEY `FK_product_category` (`category_id`),
  ADD KEY `FK_product_gender` (`category_gender_id`),
  ADD KEY `FK_product_supplier` (`supplier_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`size_value`,`color_value`,`product_id`,`coupon_id`),
  ADD KEY `FK_attribute_color` (`color_value`),
  ADD KEY `FK_attribute_product` (`product_id`),
  ADD KEY `FK_stock_attribue` (`coupon_id`);

--
-- Chỉ mục cho bảng `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`ranking_id`),
  ADD KEY `FK_product_ranking` (`product_id`),
  ADD KEY `FK_user_ranking` (`user_id`),
  ADD KEY `ranking_id` (`ranking_id`);

--
-- Chỉ mục cho bảng `revenue_current_day`
--
ALTER TABLE `revenue_current_day`
  ADD PRIMARY KEY (`revenue_current_day_id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_value`),
  ADD UNIQUE KEY `size_value` (`size_value`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Chỉ mục cho bảng `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`,`user_phone`) USING HASH,
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `category_gender`
--
ALTER TABLE `category_gender`
  MODIFY `category_gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=790;

--
-- AUTO_INCREMENT cho bảng `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `ranking`
--
ALTER TABLE `ranking`
  MODIFY `ranking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `revenue_current_day`
--
ALTER TABLE `revenue_current_day`
  MODIFY `revenue_current_day_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`category_gender_id`) REFERENCES `category_gender` (`category_gender_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_product_comment` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `import_coupon`
--
ALTER TABLE `import_coupon`
  ADD CONSTRAINT `FK_coupon_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_payment_order` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_order` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_product_order_detail` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Các ràng buộc cho bảng `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `FK_discount_day` FOREIGN KEY (`date_id`) REFERENCES `date_sale` (`date_id`),
  ADD CONSTRAINT `FK_discount_value` FOREIGN KEY (`percent_value`) REFERENCES `percent_sale` (`percent_value`),
  ADD CONSTRAINT `FK_product_price` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `FK_product_gender` FOREIGN KEY (`category_gender_id`) REFERENCES `category_gender` (`category_gender_id`),
  ADD CONSTRAINT `FK_product_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Các ràng buộc cho bảng `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `FK_attribute_color` FOREIGN KEY (`color_value`) REFERENCES `colors` (`color_value`),
  ADD CONSTRAINT `FK_attribute_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `FK_attribute_size` FOREIGN KEY (`size_value`) REFERENCES `sizes` (`size_value`),
  ADD CONSTRAINT `FK_stock_attribue` FOREIGN KEY (`coupon_id`) REFERENCES `import_coupon` (`coupon_id`);

--
-- Các ràng buộc cho bảng `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `FK_product_ranking` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `FK_user_ranking` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
