-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 03:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `euphoria_pdo`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_news`
--

CREATE TABLE `category_news` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `options` mediumtext DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_products`
--

CREATE TABLE `category_products` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `photo1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `photo2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `photo3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `photo4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category_products`
--

INSERT INTO `category_products` (`id`, `id_parent`, `level`, `title`, `photo1`, `photo2`, `photo3`, `photo4`, `type`, `status`, `slug`, `description`, `content`, `options`, `hash`, `num`, `deleted_at`, `created_at`, `updated_at`) VALUES
(68, 0, 1, 'Thời trang nổi bật nữ 2024', 'Rectangle 25 (2).png', NULL, NULL, NULL, 'san-pham', 'noibat,hienthi', 'thoi-trang-noi-bat-nu-2024', '&lt;div&gt;\r\n&lt;div&gt;&lt;strong&gt;M&amp;ocirc; tả&lt;/strong&gt; lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/div&gt;\r\n&lt;/div&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', NULL, 't1ld', 1, NULL, '1707741176', '1707818259'),
(69, 0, 1, 'Thời trang nổi bật nam 2024', 'Rectangle 22.png', NULL, NULL, NULL, 'san-pham', 'noibat,hienthi', 'thoi-trang-noi-bat-nam-2024', '&lt;div&gt;\r\n&lt;div&gt;&lt;strong&gt;M&amp;ocirc; tả&lt;/strong&gt; lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/div&gt;\r\n&lt;/div&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', NULL, '0ye9', 2, NULL, '1707741455', '1707821694'),
(70, 69, 2, 'Thời trang giá rẻ', 'Rectangle 20.png', NULL, NULL, NULL, 'san-pham', 'noibat,hienthi', 'thoi-trang-gia-re', '&lt;div&gt;\r\n&lt;div&gt;&lt;strong&gt;M&amp;ocirc; tả&lt;/strong&gt; lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/div&gt;\r\n&lt;/div&gt;', NULL, NULL, 'o29v', 1, NULL, '1707741606', '1707821674'),
(71, 68, 2, 'Thời trang cao cấp dành cho nữ', 'Rectangle 25 (5).png', NULL, NULL, NULL, 'san-pham', 'noibat,hienthi', 'thoi-trang-cao-cap-danh-cho-nu', '&lt;div&gt;\r\n&lt;div&gt;&lt;strong&gt;M&amp;ocirc; tả&lt;/strong&gt; lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/div&gt;\r\n&lt;/div&gt;', NULL, NULL, 'mave', 2, NULL, '1707741910', '1707821683');

-- --------------------------------------------------------

--
-- Table structure for table `chart`
--

CREATE TABLE `chart` (
  `id_chart` int(11) NOT NULL,
  `order_date` varchar(30) NOT NULL,
  `order` int(11) NOT NULL,
  `order_sales` varchar(255) NOT NULL,
  `order_buy_qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `chart`
--

INSERT INTO `chart` (`id_chart`, `order_date`, `order`, `order_sales`, `order_buy_qty`) VALUES
(1, '2024-01-23', 50, '1550000', 100),
(2, '2024-01-22', 20, '3550000', 20),
(3, '2024-01-24', 40, '9550000', 90),
(4, '2024-01-25', 10, '1950000', 40),
(5, '2024-01-26', 20, '6950000', 30),
(9, '2024-02-21', 2, '1600000', 6),
(10, '2024-02-25', 1, '400000', 7);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id_color` int(11) NOT NULL,
  `name_color` varchar(255) DEFAULT NULL,
  `type_color` varchar(255) DEFAULT NULL,
  `num_color` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id_color`, `name_color`, `type_color`, `num_color`) VALUES
(2, 'Màu đỏ', 'san-pham', 1),
(3, 'Màu đen', 'san-pham', 2),
(4, 'Màu trắng', 'san-pham', 3),
(5, 'Màu xanh', 'san-pham', 4),
(6, 'Màu xám', 'san-pham', 5);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_parent` int(11) DEFAULT 0,
  `hash` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `id_color` int(11) DEFAULT 0,
  `file_attach` varchar(255) DEFAULT NULL,
  `link_video` mediumtext DEFAULT NULL,
  `num` int(11) DEFAULT 0,
  `type` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `id_parent`, `hash`, `photo`, `title`, `id_color`, `file_attach`, `link_video`, `num`, `type`, `status`, `created_at`, `updated_at`) VALUES
(401, 330, NULL, 'shop-5.jpg', 'shop-5', 0, NULL, NULL, 0, 'san-pham', 'hienthi', '1709626969', NULL),
(400, 330, NULL, 'shop-3.jpg', 'shop-3', 0, NULL, NULL, 0, 'san-pham', 'hienthi', '1709626969', NULL),
(399, 330, NULL, 'shop-1.jpg', 'shop-1', 0, NULL, NULL, 0, 'san-pham', 'hienthi', '1709626969', NULL),
(398, 330, NULL, 'Rectangle 25 (9).png', 'Rectangle 25 (9)', 0, NULL, NULL, 0, 'san-pham', 'hienthi', '1709626942', NULL),
(397, 330, NULL, 'Rectangle 25 (8).png', 'Rectangle 25 (8)', 0, NULL, NULL, 0, 'san-pham', 'hienthi', '1709626942', NULL),
(396, 330, NULL, 'Rectangle 25 (7).png', 'Rectangle 25 (7)', 0, NULL, NULL, 0, 'san-pham', 'hienthi', '1709626942', NULL),
(395, 330, NULL, 'Rectangle 25 (4).png', 'Rectangle 25 (4)', 0, NULL, NULL, 0, 'san-pham', 'hienthi', '1709626804', NULL),
(394, 330, NULL, 'Rectangle 25 (3).png', 'Rectangle 25 (3)', 0, NULL, NULL, 0, 'san-pham', 'hienthi', '1709626804', NULL),
(393, 330, NULL, 'Rectangle 25 (2).png', 'Rectangle 25 (2)', 0, NULL, NULL, 0, 'san-pham', 'hienthi', '1709626804', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `momo`
--

CREATE TABLE `momo` (
  `id_momo` int(11) NOT NULL,
  `partnercode` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `momo_order_id` varchar(50) NOT NULL,
  `momo_order_info` varchar(255) NOT NULL,
  `momo_order_type` varchar(50) NOT NULL,
  `momo_trans_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `id_parent1` int(11) DEFAULT NULL,
  `id_parent2` int(11) DEFAULT NULL,
  `id_parent3` int(11) DEFAULT NULL,
  `id_parent4` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `file_attach` varchar(255) DEFAULT NULL,
  `file_mp4` varchar(255) DEFAULT NULL,
  `file_youtube` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `options` mediumtext DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `id_parent1`, `id_parent2`, `id_parent3`, `id_parent4`, `slug`, `photo1`, `photo2`, `photo3`, `photo4`, `file_attach`, `file_mp4`, `file_youtube`, `title`, `description`, `content`, `status`, `type`, `num`, `hash`, `options`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, NULL, NULL, NULL, NULL, 'tieu-de-tin-tuc-1', 'Rectangle 25 (7).png', NULL, NULL, NULL, '', '', NULL, 'Tiêu đề tin tức 1', '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;div&gt;\r\n&lt;div&gt;&lt;strong&gt;Nội dung&lt;/strong&gt; lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/div&gt;\r\n&lt;/div&gt;', 'noibat,hienthi', 'tin-tuc', 1, '1z5s', NULL, NULL, '1707740747', '1709295223'),
(8, NULL, NULL, NULL, NULL, 'tieu-de-tin-tuc-5', 'Rectangle 25 (9).png', NULL, NULL, NULL, '', '', NULL, 'Tiêu đề tin tức 5', '&lt;p class=&quot;desc-newshome text-split&quot;&gt;Nike Phantom GT l&amp;agrave; đ&amp;ocirc;i gi&amp;agrave;y đ&amp;aacute; b&amp;oacute;ng được tạo ra từ sự ph&amp;acirc;n t&amp;iacute;ch một lượng lớn dữ liệu từ c&amp;aacute;c cầu thủ v&amp;agrave; c&amp;ocirc;ng nghệ băng d&amp;aacute;n độc đ&amp;aacute;o&lt;/p&gt;', '&lt;div&gt;\r\n&lt;div&gt;&lt;strong&gt;Nội dung&lt;/strong&gt; lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/div&gt;\r\n&lt;/div&gt;', 'noibat,hienthi', 'tin-tuc', 5, 'azll', NULL, NULL, '1707740942', '1709863351'),
(10, NULL, NULL, NULL, NULL, 'tieu-de-tin-tuc-2', 'Rectangle 25 (8).png', NULL, NULL, NULL, '', '', NULL, 'Tiêu đề tin tức 2', '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;div&gt;\r\n&lt;div&gt;&lt;strong&gt;Nội dung&lt;/strong&gt; lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/div&gt;\r\n&lt;/div&gt;', 'noibat,hienthi', 'tin-tuc', 2, '6me', NULL, NULL, '1707741019', '1709863338'),
(11, NULL, NULL, NULL, NULL, 'tieu-de-tin-tuc-3', 'Rectangle 25 (11).png', NULL, NULL, NULL, '', '', NULL, 'Tiêu đề tin tức 3', '&lt;p class=&quot;desc-newshome text-split&quot;&gt;Nike Phantom GT l&amp;agrave; đ&amp;ocirc;i gi&amp;agrave;y đ&amp;aacute; b&amp;oacute;ng được tạo ra từ sự ph&amp;acirc;n t&amp;iacute;ch một lượng lớn dữ liệu từ c&amp;aacute;c cầu thủ v&amp;agrave; c&amp;ocirc;ng nghệ băng d&amp;aacute;n độc đ&amp;aacute;o&lt;/p&gt;', '&lt;div&gt;\r\n&lt;div&gt;&lt;strong&gt;Nội dung&lt;/strong&gt; lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/div&gt;\r\n&lt;/div&gt;', 'noibat,hienthi', 'tin-tuc', 3, 'ovir', NULL, NULL, '1707741022', '1709642622'),
(12, NULL, NULL, NULL, NULL, 'tieu-de-tin-tuc-4', 'Rectangle 25 (10).png', NULL, NULL, NULL, '', '', NULL, 'Tiêu đề tin tức 4', '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;div&gt;\r\n&lt;div&gt;&lt;strong&gt;Nội dung&lt;/strong&gt; lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/div&gt;\r\n&lt;/div&gt;', 'noibat,hienthi', 'tin-tuc', 4, 'k1vc', NULL, NULL, '1707741025', '1709863346'),
(16, NULL, NULL, NULL, NULL, 'chinh-sach-bao-hanh', NULL, NULL, NULL, NULL, '', '', NULL, 'Chính sách bảo hành', NULL, '&lt;div&gt;\r\n&lt;div&gt;Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi eos numquam natus, voluptatibus nulla sit facere commodi vero? Neque adipisci, reiciendis harum nostrum asperiores iusto quaerat cum cupiditate ipsam. Doloribus.&lt;/div&gt;\r\n&lt;/div&gt;', 'hienthi', 'chinh-sach', 1, 'wic', NULL, NULL, '1709640572', '1709782066'),
(17, NULL, NULL, NULL, NULL, 'chinh-sach-khach-hang', NULL, NULL, NULL, NULL, '', '', NULL, 'Chính sách khách hàng', NULL, '&lt;div&gt;\r\n&lt;div&gt;Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi eos numquam natus, voluptatibus nulla sit facere commodi vero? Neque adipisci, reiciendis harum nostrum asperiores iusto quaerat cum cupiditate ipsam. Doloribus.&lt;/div&gt;\r\n&lt;/div&gt;', 'hienthi', 'chinh-sach', 2, 'x2t6', NULL, NULL, '1709640584', '1709782074'),
(18, NULL, NULL, NULL, NULL, 'chinh-sach-doi-tra', NULL, NULL, NULL, NULL, '', '', NULL, 'Chính sách đổi trả', NULL, '&lt;div&gt;\r\n&lt;div&gt;Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi eos numquam natus, voluptatibus nulla sit facere commodi vero? Neque adipisci, reiciendis harum nostrum asperiores iusto quaerat cum cupiditate ipsam. Doloribus.&lt;/div&gt;\r\n&lt;/div&gt;', 'hienthi', 'chinh-sach', 1, 'a1dq', NULL, NULL, '1709640596', '1709782048'),
(19, NULL, NULL, NULL, NULL, 'tu-van-2424', NULL, NULL, NULL, NULL, '', '', NULL, 'Tư vấn 24/24', NULL, '&lt;div&gt;\r\n&lt;div&gt;Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi eos numquam natus, voluptatibus nulla sit facere commodi vero? Neque adipisci, reiciendis harum nostrum asperiores iusto quaerat cum cupiditate ipsam. Doloribus.&lt;/div&gt;\r\n&lt;/div&gt;', 'hienthi', 'chinh-sach', 4, 'u6xw', NULL, NULL, '1709640620', '1709782081');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `num` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `subject` mediumtext DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `fullname`, `email`, `phone`, `type`, `hash`, `address`, `num`, `status`, `subject`, `note`, `created_at`, `updated_at`) VALUES
(6, 'Đỗ Lâm Thành Phát', 'dolamthanhphat@gmail.com', '0704138356', 'newsletter', 'mtir', 'HCM', '1', 'hienthi', 'abc', 'cde', '1709779407', NULL),
(7, 'Nguyễn Văn A', 'abcaaaaaaaaa@gmail.com', '0987654321', 'newsletter', 'xitq', 'HCM', '2', 'hienthi', '', '', '1709779573', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `order_payment` varchar(255) DEFAULT NULL,
  `time_buy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_order_detail` int(11) NOT NULL,
  `id_products` int(11) NOT NULL,
  `code_order_detail` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `numb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `num` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `title`, `photo`, `type`, `action`, `link`, `hash`, `status`, `num`, `created_at`, `updated_at`) VALUES
(23, 'Slideshow 1', 'slide-07.jpg', 'slideshow', 'photo_multiple', 'https://www.google.com/', 'u6q1', 'hienthi', '1', '1707650422', NULL),
(24, 'Slideshow 2', 'slide-06.jpg', 'slideshow', 'photo_multiple', 'https://www.google.com/', 'u6q2', 'hienthi', '2', '1707650422', NULL),
(25, 'Tiêu đề banner', 'misc2-4853.jpg', 'banner', 'photo_static', NULL, 'qowf', NULL, NULL, '1707653312', '1707657145'),
(26, 'Logo', 'logo-7665.png', 'logo', 'photo_static', NULL, '2moc', NULL, NULL, '1707653661', '1707742708'),
(27, 'Favicon', 'mceclip019-35060.png', 'favicon', 'photo_static', NULL, 'fcv3', NULL, NULL, '1707653679', '1707657112'),
(28, 'partner1', 'partner-4839-93010.jpg', 'partner', 'photo_multiple', 'https://www.google.com/', 'rd71', 'hienthi', '1', '1707654367', '1709782279'),
(30, 'partner 2', 'partner-4839-930101.jpg', 'partner', 'photo_multiple', 'https://www.google.com/', 'rd73', 'hienthi', '2', '1707654367', '1709783776'),
(31, 'partner 3', 'partner-5044-82861.jpg', 'partner', 'photo_multiple', 'https://www.google.com/', 'rd74', 'hienthi', '3', '1707654367', '1709783781'),
(36, 'fb', 'mxh1-1-1957-80510.png', 'social_footer', 'photo_multiple', 'https://www.google.com/', 'gwy1', 'hienthi', '1', '1707656985', NULL),
(37, 'gg', 'mxh1-2-1178-74341.png', 'social_footer', 'photo_multiple', 'https://www.google.com/', 'gwy2', 'hienthi', '2', '1707656986', NULL),
(38, 'tw', 'mxh1-3-4655-85900.png', 'social_footer', 'photo_multiple', 'https://www.google.com/', 'gwy3', 'hienthi', '3', '1707656986', NULL),
(39, 'pri', 'mxh1-4-6766-68891.png', 'social_footer', 'photo_multiple', 'https://www.google.com/', 'gwy4', 'hienthi', '4', '1707656986', NULL),
(40, 'partner 5', 'partner-5044-828610.jpg', 'partner', 'photo_multiple', 'https://www.google.com/', 'jbz1', 'hienthi', '5', '1709783902', NULL),
(41, 'partner 6', 'partner-5044-828611.jpg', 'partner', 'photo_multiple', 'https://www.google.com/', 'jbz2', 'hienthi', '6', '1709783902', NULL),
(42, 'partner 7', 'partner-5044-658710.jpg', 'partner', 'photo_multiple', 'https://www.google.com/', 'jbz3', 'hienthi', '7', '1709783902', NULL),
(43, 'partner 8', 'partner-5044-828612.jpg', 'partner', 'photo_multiple', 'https://www.google.com/', 'jbz4', 'hienthi', '8', '1709783902', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_parent1` int(11) DEFAULT NULL,
  `id_parent2` int(11) DEFAULT NULL,
  `id_parent3` int(11) DEFAULT NULL,
  `id_parent4` int(11) DEFAULT NULL,
  `id_brand` int(11) DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `photo1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `photo2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `photo3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `photo4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `file_attach` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `file_mp4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `file_youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `regular_price` double DEFAULT 0,
  `sale_price` double DEFAULT 0,
  `discount` double DEFAULT 0,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_parent1`, `id_parent2`, `id_parent3`, `id_parent4`, `id_brand`, `slug`, `photo1`, `photo2`, `photo3`, `photo4`, `code`, `file_attach`, `file_mp4`, `file_youtube`, `title`, `regular_price`, `sale_price`, `discount`, `description`, `content`, `status`, `type`, `quantity`, `num`, `hash`, `options`, `deleted_at`, `created_at`, `updated_at`) VALUES
(293, 68, 71, NULL, NULL, NULL, 'black-sweatshirt', 'Rectangle 25.png', NULL, NULL, NULL, 'eup#1', '', '', NULL, 'Black Sweatshirt', 800000, 400000, 50, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'banchay,noibat,hienthi', 'san-pham', 100, 1, 's44k', NULL, NULL, '1707742025', '1708868077'),
(295, 68, 71, NULL, NULL, NULL, 'levender-hoodie', 'bg_register.png', NULL, NULL, NULL, 'eup#1', '', '', NULL, 'Levender hoodie', 800000, 500000, 38, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'banchay,noibat,hienthi', 'san-pham', 100, 3, 'fgla', NULL, NULL, '1707742055', '1708868093'),
(296, 68, 71, NULL, NULL, NULL, 'dress-fashion-2024', 'shop-3.jpg', NULL, NULL, NULL, 'eup#1', '', '', NULL, 'Dress fashion 2024', 800000, 250000, 69, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'banchay,noibat,hienthi', 'san-pham', 100, 4, '7w5f', NULL, NULL, '1707742057', '1708868071'),
(297, 68, 71, NULL, NULL, NULL, 'shoe-fashion-2024', 'shop-5.jpg', NULL, NULL, NULL, 'eup#1', '', '', NULL, 'Shoe fashion 2024', 800000, 200000, 75, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'banchay,noibat,hienthi', 'san-pham', 100, 5, 'st0p', NULL, NULL, '1707750295', '1708868108'),
(298, 69, 70, NULL, NULL, NULL, 'black-jacket-hot', 'shop-1.jpg', NULL, NULL, NULL, 'eup#1', '', '', NULL, 'Black Jacket Hot', 800000, 400000, 50, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'banchay,noibat,hienthi', 'san-pham', 100, 6, 'modi', NULL, NULL, '1707818067', '1708868113'),
(300, 0, 0, NULL, NULL, NULL, 'pink-jacket', 'Rectangle 250.png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Pink Jacket', 400000, 200000, 50, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 7, 'ntns', NULL, NULL, '1708865312', '1708868120'),
(316, 0, 0, NULL, NULL, NULL, 'leaves-pattern', 'Rectangle 25 (1).png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Leaves Pattern', 1000000, 450000, 55, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 8, 'vklf', NULL, NULL, '1708866598', '1708868322'),
(317, 0, 0, NULL, NULL, NULL, 'yellow-sweatshirt', 'Rectangle 25 (2).png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Yellow Sweatshirt', 300000, 123000, 59, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 9, 'ochw', NULL, NULL, '1708866601', '1708868521'),
(318, 0, 0, NULL, NULL, NULL, 'flower-pattern-black', 'Rectangle 25 (3).png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Flower Pattern Black', 300000, 123000, 59, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 10, 'wyh3', NULL, NULL, '1708868530', '1708868616'),
(319, 0, 0, NULL, NULL, NULL, 'graphic-t-shirt', 'Rectangle 25 (4).png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Graphic T-shirt', 300000, 230000, 23, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 11, '2nwt', NULL, NULL, '1708868621', '1708868695'),
(320, 0, 0, NULL, NULL, NULL, 'barboreal-gray-sweat-shirt', 'Rectangle 25 (5).png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Barboreal Gray Sweat-Shirt', 300000, 230000, 23, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 12, '7hkp', NULL, NULL, '1708868701', '1708868764'),
(321, 0, 0, NULL, NULL, NULL, 'barboreal-gray-sweat-shirt 5ltq', 'Rectangle 25 (6).png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Barboreal Gray Sweat-Shirt 5ltq', 300000, 230000, 23, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 13, '5ltq', NULL, NULL, '1708868776', '1708869037'),
(322, 0, 0, NULL, NULL, NULL, 'barboreal-gray-sweat-shirt m4z2', 'Rectangle 25 (8).png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Barboreal Gray Sweat-Shirt m4z2', 300000, 230000, 23, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 14, 'm4z2', NULL, NULL, '1708868784', '1708869220'),
(323, 0, 0, NULL, NULL, NULL, 'barboreal-gray-sweat-shirt vf9r', 'Rectangle 25 (7).png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Barboreal Gray Sweat-Shirt vf9r', 300000, 230000, 23, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 15, 'vf9r', NULL, NULL, '1708868796', '1708869242'),
(324, 0, 0, NULL, NULL, NULL, 'barboreal-gray-sweat-shirt bgtb', 'Rectangle 25 (9).png', NULL, NULL, NULL, 'abc', '', '', NULL, 'Barboreal Gray Sweat-Shirt bgtb', 300000, 230000, 23, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung &lt;/strong&gt;lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae.&lt;/p&gt;', 'noibat,hienthi', 'san-pham', 1, 16, 'bgtb', NULL, NULL, '1708868809', '1708869261'),
(330, 0, 0, NULL, NULL, NULL, 'jeans', 'Rectangle 21.png', NULL, NULL, NULL, 'eup#2', '', '', NULL, 'Jeans', 3450000, 2000000, 42, '&lt;p&gt;&lt;strong&gt;M&amp;ocirc; tả&lt;/strong&gt;&amp;nbsp;dolor sit amet consectetur adipisicing elit. Quam quod porro ullam, vitae numquam maxime quia suscipit vero magnam sint doloribus quaerat est consectetur et ducimus tempore perferendis. Ipsam, doloribus.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung&lt;/strong&gt;&amp;nbsp;dolor sit amet consectetur adipisicing elit. Quam quod porro ullam, vitae numquam maxime quia suscipit vero magnam sint doloribus quaerat est consectetur et ducimus tempore perferendis. Ipsam, doloribus.&lt;/p&gt;', 'banchay,noibat,hienthi', 'san-pham', 10, 2, 'jwsg', NULL, NULL, '1709626630', '1709627212');

-- --------------------------------------------------------

--
-- Table structure for table `product_sale`
--

CREATE TABLE `product_sale` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) DEFAULT 0,
  `photo_color` varchar(255) DEFAULT NULL,
  `id_color` int(11) DEFAULT NULL,
  `id_size` int(11) DEFAULT NULL,
  `sale_price` varchar(255) DEFAULT NULL,
  `regular_price` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `product_sale`
--

INSERT INTO `product_sale` (`id`, `id_parent`, `photo_color`, `id_color`, `id_size`, `sale_price`, `regular_price`, `discount`, `type`) VALUES
(6, 330, 'and-machines-vqTWfa4DjEk-unsplash 1.png', 5, 6, '1250000', '4000000', '69', 'san-pham'),
(7, 330, 'poduct-1-1758-7258.jpeg', 2, 7, '800000', '1200000', '34', 'san-pham');

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `hash_seo` varchar(255) DEFAULT NULL,
  `title_seo` mediumtext DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  `description_seo` mediumtext DEFAULT NULL,
  `schema` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`id`, `id_parent`, `type`, `hash_seo`, `title_seo`, `keywords`, `description_seo`, `schema`) VALUES
(378, 293, 'san-pham', 's44k', 'Black Sweatshirt', 'Black Sweatshirt', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(367, 71, 'san-pham', 'mave', 'Thời trang cao cấp dành cho nữ', 'Thời trang cao cấp dành cho nữ', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(361, 5, 'tin-tuc', '1z5s', 'Tiêu đề tin tức 1', 'Tiêu đề tin tức 1', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(362, 68, 'san-pham', 't1ld', 'Thời trang nổi bật nữ 2024', 'Thời trang nổi bật nữ 2024', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(363, 69, 'san-pham', '0ye9', 'Thời trang nổi bật nam 2024', 'Thời trang nổi bật nam 2024', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(364, 70, 'san-pham', 'o29v', 'Thời trang giá rẻ', 'Thời trang giá rẻ', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(373, 295, 'san-pham', 'fgla', 'Levender hoodie', 'Levender hoodie', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(374, 296, 'san-pham', '7w5f', 'Dress fashion 2024', 'Dress fashion 2024', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(375, 297, 'san-pham', 'st0p', 'Shoe fashion 2024', 'Shoe fashion 2024', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(376, 298, 'san-pham', 'modi', 'Black Jacket Hot', 'Black Jacket Hot', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(377, 300, 'san-pham', 'ntns', 'Pink Jacket', 'Pink Jacket', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(393, 330, 'san-pham', 'jwsg', 'Jeans', 'Jeans', ' Mô tả dolor sit amet consectetur adipisicing elit. Quam quod porro ullam, vitae numquam maxime quia suscipit vero magnam sint doloribus quaerat est consectetur et ducimus tempore perferendis. Ipsam, doloribus. ', NULL),
(379, 316, 'san-pham', 'vklf', 'Leaves Pattern', 'Leaves Pattern', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(380, 317, 'san-pham', 'ochw', 'Yellow Sweatshirt', 'Yellow Sweatshirt', '', NULL),
(381, 318, 'san-pham', 'wyh3', 'Flower Pattern Black', 'Flower Pattern Black', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(382, 319, 'san-pham', '2nwt', 'Graphic T-shirt', 'Graphic T-shirt', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(383, 320, 'san-pham', '7hkp', 'Barboreal Gray Sweat-Shirt', 'Barboreal Gray Sweat-Shirt', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(384, 321, 'san-pham', '5ltq', '', '', '', NULL),
(385, 322, 'san-pham', 'm4z2', 'Barboreal Gray Sweat-Shirt m4z2', 'Barboreal Gray Sweat-Shirt m4z2', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(386, 323, 'san-pham', 'vf9r', '', '', '', NULL),
(387, 324, 'san-pham', 'bgtb', '', '', '', NULL),
(388, 10, 'tin-tuc', '6me', 'Tiêu đề tin tức 2', 'Tiêu đề tin tức 2', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(389, 11, 'tin-tuc', 'ovir', 'Tiêu đề tin tức 3', 'Tiêu đề tin tức 3', ' Nike Phantom GT là đôi giày đá bóng được tạo ra từ sự phân tích một lượng lớn dữ liệu từ các cầu thủ và công nghệ băng dán độc đáo ', NULL),
(390, 12, 'tin-tuc', 'k1vc', 'Tiêu đề tin tức 4', 'Tiêu đề tin tức 4', ' Mô tả lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi impedit, ipsam labore esse omnis vero illum sint harum maxime dignissimos blanditiis explicabo voluptates reiciendis nobis atque animi sapiente! Tempore, quae. ', NULL),
(391, 8, 'tin-tuc', 'azll', 'Tiêu đề tin tức 5', 'Tiêu đề tin tức 5', ' Nike Phantom GT là đôi giày đá bóng được tạo ra từ sự phân tích một lượng lớn dữ liệu từ các cầu thủ và công nghệ băng dán độc đáo ', NULL),
(394, NULL, 'gioi-thieu', 'atiq', 'Giới thiệu chung', 'Giới thiệu chung', ' Mô tả lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate officiis aut molestias libero a deserunt eos est, facilis vel asperiores quod ex. Odio magnam suscipit consectetur odit nobis cum hic. ', NULL),
(395, NULL, 'footer', 'p54c', NULL, NULL, NULL, NULL),
(396, 18, 'chinh-sach', 'a1dq', 'Chính sách đổi trả', 'Chính sách đổi trả', '', NULL),
(397, 16, 'chinh-sach', 'wic', 'Chính sách bảo hành', 'Chính sách bảo hành', '', NULL),
(398, 17, 'chinh-sach', 'x2t6', 'Chính sách khách hàng', 'Chính sách khách hàng', '', NULL),
(399, 19, 'chinh-sach', 'u6xw', 'Tư vấn 24/24', 'Tư vấn 24/24', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seopage`
--

CREATE TABLE `seopage` (
  `id` int(11) UNSIGNED NOT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `title` mediumtext DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `options` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `seopage`
--

INSERT INTO `seopage` (`id`, `photo1`, `type`, `title`, `keywords`, `description`, `hash`, `options`) VALUES
(7, 'and-machines-vqTWfa4DjEk-unsplash 1.png', 'home', 'Euphoria', 'Euphoria', 'Euphoria', 'nmwv', NULL),
(9, 'Rectangle 25 (2).png', 'tin-tuc', 'Tin tức ', 'Tin tức ', 'Tin tức ', 'w8sr', NULL),
(12, 'Rectangle 250.png', 'san-pham', 'Sản phẩm', 'Sản phẩm', 'Sản phẩm', 'djob', NULL),
(14, NULL, 'contact', 'Liên hệ', 'Liên hệ', 'Liên hệ', 'v4mz', NULL),
(15, 'Rectangle 25 (7).png', 'gioi-thieu', 'Giới thiệu', 'Giới thiệu', 'Giới thiệu', 'ufxy', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `headjs` mediumtext DEFAULT NULL,
  `bodyjs` mediumtext DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `options` mediumtext DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `type`, `headjs`, `bodyjs`, `address`, `copyright`, `options`, `hash`) VALUES
(1, 'Euphoria', 'setting', '', '', 'Q12/364 Tô Ký, Tân Chánh Hiệp, Quận 12, Thành phố Hồ Chí Minh, Việt Nam', 'euphoria', '{\"worktime\":\"8h - 22h\",\"email\":\"dolamthanhphat@gmail.com\",\"hotline\":\"0987654321\",\"phone\":\"0987654322\",\"zalo\":\"0987654321\",\"website\":\"www.abc.com\",\"fanpage\":\"https:\\/\\/www.facebook.com\\/facebook\",\"link_ggmap\":\"https:\\/\\/maps.app.goo.gl\\/eaGpgUXcozRhFCVy7\",\"iframe_ggmap\":\"<iframe src=\\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3918.3598228814!2d106.61753057586947!3d10.860212957641014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752a18605f989d%3A0x3addffb82ce344e!2zcTEyLzM2NCBUw7QgS8O9LCBUw6JuIENow6FuaCBIaeG7h3AsIFF14bqtbiAxMiwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1707392845548!5m2!1svi!2s\\\" width=\\\"600\\\" height=\\\"450\\\" style=\\\"border:0;\\\" allowfullscreen=\\\"\\\" loading=\\\"lazy\\\" referrerpolicy=\\\"no-referrer-when-downgrade\\\"><\\/iframe>\"}', 'qjdd');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id_size` int(11) NOT NULL,
  `name_size` varchar(255) DEFAULT NULL,
  `type_size` varchar(255) DEFAULT NULL,
  `num_size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id_size`, `name_size`, `type_size`, `num_size`) VALUES
(5, 'Size M', 'san-pham', 1),
(6, 'Size XL', 'san-pham', 3),
(7, 'Size L', 'san-pham', 2),
(8, 'Size XXL', 'san-pham', 4);

-- --------------------------------------------------------

--
-- Table structure for table `static`
--

CREATE TABLE `static` (
  `id` int(11) NOT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `options` mediumtext DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `file_attach` varchar(255) DEFAULT NULL,
  `file_youtube` varchar(255) DEFAULT NULL,
  `file_mp4` varchar(255) DEFAULT NULL,
  `created_at` int(255) DEFAULT NULL,
  `updated_at` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `static`
--

INSERT INTO `static` (`id`, `slogan`, `title`, `slug`, `description`, `content`, `type`, `status`, `photo1`, `photo2`, `photo3`, `photo4`, `options`, `hash`, `file_attach`, `file_youtube`, `file_mp4`, `created_at`, `updated_at`) VALUES
(3, NULL, 'Giới thiệu chung', 'gioi-thieu-chung', '&lt;div style=&quot;line-height: 1.4;&quot;&gt;&lt;strong&gt;M&amp;ocirc; tả&lt;/strong&gt; lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate officiis aut molestias libero a deserunt eos est, facilis vel asperiores quod ex. Odio magnam suscipit consectetur odit nobis cum hic.&lt;/div&gt;', '&lt;p&gt;&lt;strong&gt;Nội dung&lt;/strong&gt;&amp;nbsp;lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate officiis aut molestias libero a deserunt eos est, facilis vel asperiores quod ex. Odio magnam suscipit consectetur odit nobis cum hic.&lt;/p&gt;', 'gioi-thieu', 'hienthi', NULL, NULL, NULL, NULL, NULL, 'atiq', NULL, NULL, NULL, 1707315395, 1709628763),
(4, NULL, 'Chào mừng bạn đến với website của chúng tôi!', NULL, NULL, NULL, 'slogan', NULL, NULL, NULL, NULL, NULL, NULL, 'ozqa', NULL, NULL, NULL, 1707362212, NULL),
(5, NULL, 'Euphoria', NULL, NULL, '&lt;p&gt;&lt;strong&gt;Địa chỉ:&lt;/strong&gt; Đường A, Phường B, Quận C, T.p Hồ Ch&amp;iacute; Minh&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Email:&lt;/strong&gt; &lt;a href=&quot;mailto:dolamthanhphat@gmail.com&quot;&gt;dolamthanhphat@gmail.com&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Contact:&lt;/strong&gt; 098.765.4321&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Worktime:&lt;/strong&gt; 8h - 22h&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Website:&lt;/strong&gt; www.abc.com&lt;/p&gt;', 'footer', NULL, NULL, NULL, NULL, NULL, NULL, 'p54c', NULL, NULL, NULL, 1707362546, 1709814329),
(9, NULL, NULL, NULL, NULL, '&lt;p&gt;&lt;strong&gt;Li&amp;ecirc;n hệ&lt;/strong&gt;&lt;/p&gt;\r\n&lt;div&gt;\r\n&lt;div&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Praesentium numquam, reiciendis repellat ad dolores veritatis. Dolores rem ad veniam, illo, quidem distinctio iste, dolor qui saepe assumenda placeat aliquid iusto.&lt;/div&gt;\r\n&lt;/div&gt;', 'contact', NULL, NULL, NULL, NULL, NULL, NULL, 'sgx8', NULL, NULL, NULL, 1707363487, 1707363586);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `num` int(11) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permision` enum('subcriber','admin') NOT NULL,
  `is_active` enum('0','1') DEFAULT '0',
  `active_token` varchar(255) DEFAULT NULL,
  `is_reset_token` enum('0','1') NOT NULL DEFAULT '0',
  `reset_token` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `num`, `fullname`, `email`, `address`, `phone`, `job`, `gender`, `username`, `password`, `permision`, `is_active`, `active_token`, `is_reset_token`, `reset_token`, `status`, `created_at`, `updated_at`) VALUES
(7, 0, 'Admin Phát', 'dolamthanhphat@gmail.com', 'TP HCM', 987654321, 'Developer', 'male', 'Euphoria_pdo', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'admin', '1', '1', '0', NULL, 'hienthi', '1708247100', NULL),
(8, 0, 'Đỗ Lâm Thành Phát', 'dltphat301@gmail.com', 'Quận 12 TP Hồ Chí Minh', NULL, NULL, 'male', 'user12345', '5725dbcc7254ee8422d1cb60db29625c', 'subcriber', '1', 'fe29efdd9710b383d619e258fcb8c3d3', '0', NULL, 'hienthi', '1709774398', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vnpay`
--

CREATE TABLE `vnpay` (
  `id_vnpay` int(11) NOT NULL,
  `vnp_amount` varchar(50) NOT NULL,
  `vnp_bankcode` varchar(50) NOT NULL,
  `vnp_banktranno` varchar(50) NOT NULL,
  `vnp_cardtype` varchar(50) NOT NULL,
  `vnp_orderinfo` varchar(255) NOT NULL,
  `vnp_tmncode` varchar(50) NOT NULL,
  `vnp_transactionno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `vnpay`
--

INSERT INTO `vnpay` (`id_vnpay`, `vnp_amount`, `vnp_bankcode`, `vnp_banktranno`, `vnp_cardtype`, `vnp_orderinfo`, `vnp_tmncode`, `vnp_transactionno`) VALUES
(2, '280000000', 'NCB', 'VNP14304595', 'ATM', 'Thanh toán hóa đơn đặt hàng tại website', 'G7PTV3KW', '14304595');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_news`
--
ALTER TABLE `category_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_products`
--
ALTER TABLE `category_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`id_chart`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id_momo`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id_order_detail`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sale`
--
ALTER TABLE `product_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seopage`
--
ALTER TABLE `seopage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id_size`);

--
-- Indexes for table `static`
--
ALTER TABLE `static`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vnpay`
--
ALTER TABLE `vnpay`
  ADD PRIMARY KEY (`id_vnpay`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_news`
--
ALTER TABLE `category_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category_products`
--
ALTER TABLE `category_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `chart`
--
ALTER TABLE `chart`
  MODIFY `id_chart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `momo`
--
ALTER TABLE `momo`
  MODIFY `id_momo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `product_sale`
--
ALTER TABLE `product_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `seopage`
--
ALTER TABLE `seopage`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `static`
--
ALTER TABLE `static`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vnpay`
--
ALTER TABLE `vnpay`
  MODIFY `id_vnpay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
