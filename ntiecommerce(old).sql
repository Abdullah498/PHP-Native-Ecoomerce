-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2021 at 12:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ntiecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresss`
--

CREATE TABLE `addresss` (
  `id` int(10) UNSIGNED NOT NULL,
  `street` varchar(40) NOT NULL,
  `building` int(10) NOT NULL,
  `floor` varchar(10) NOT NULL,
  `flat` int(5) NOT NULL,
  `detail` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresss`
--

INSERT INTO `addresss` (`id`, `street`, `building`, `floor`, `flat`, `detail`, `user_id`, `region_id`) VALUES
(12, 'mohamed Ali', 5, '5rd', 5, '                                                                                                                                        hello\r\n                                                                                                                                                                                            ', 14, 3),
(14, 'horia', 4, '9', 6, '\r\n                                                            ', 14, 1),
(20, 'Elakhder', 2, '1', 1, '\r\n                                                            ', 14, 5);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `photo` varchar(20) DEFAULT 'brand.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `photo`) VALUES
(1, 'Ahmed Tea', 'brand.jpg'),
(2, 'Lipton', 'brand.jpg'),
(3, 'Royal', 'brand.jpg'),
(4, 'Imtnan', 'brand.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `photo` varchar(40) DEFAULT 'category.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `photo`) VALUES
(1, 'Ashab', 'category.jpg'),
(2, 'Drinks', 'category.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `citys`
--

CREATE TABLE `citys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citys`
--

INSERT INTO `citys` (`id`, `name`, `latitude`, `longitude`) VALUES
(1, 'Cairo', '20.0', '40.0'),
(2, 'Alex', '50.0', '70.0'),
(3, 'Giza', '10.0', '78.0'),
(4, 'Qalubia', '55.0', '47.0');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `dicount` int(3) NOT NULL,
  `type` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `max_discount_value` int(5) NOT NULL,
  `mini_order_value` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `dicount`, `type`, `start_date`, `expire_date`, `max_discount_value`, `mini_order_value`) VALUES
(1, 10, 'jbcd,j', '2021-01-12', '2021-01-11', 454, 546),
(2, 45, 'dkenlked', '2021-01-06', '2021-01-26', 5453, 613),
(3, 10, 'jbcd,j', '2021-01-12', '2021-01-11', 454, 546),
(4, 45, 'dkenlked', '2021-01-06', '2021-01-26', 5453, 613);

-- --------------------------------------------------------

--
-- Stand-in structure for view `most_ordered`
-- (See below for the actual view)
--
CREATE TABLE `most_ordered` (
`id` int(10) unsigned
,`name` varchar(40)
,`photo` varchar(20)
,`price` varchar(10)
,`code` varchar(10)
,`detail` text
,`views` int(10)
,`brand_id` int(10) unsigned
,`subcat_id` int(10) unsigned
,`supplier_id` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`orders_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `most_rated`
-- (See below for the actual view)
--
CREATE TABLE `most_rated` (
`id` int(10) unsigned
,`name` varchar(40)
,`photo` varchar(20)
,`price` varchar(10)
,`code` varchar(10)
,`detail` text
,`views` int(10)
,`brand_id` int(10) unsigned
,`subcat_id` int(10) unsigned
,`supplier_id` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`reviews_count` bigint(21)
,`avg_rating` double(17,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `photo` varchar(40) DEFAULT NULL,
  `discount` int(3) NOT NULL,
  `details` text NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `total` int(10) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `user_id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `latitude`, `longitude`, `total`, `date`, `status`, `user_id`, `coupon_id`) VALUES
(1, '20.0', '40.0', 5645, '2021-01-13', 1, 14, 2),
(2, '50.0', '70.0', 464, '2021-01-06', 1, 15, 4),
(3, '10.0', '78.0', 97687, '2021-01-13', 1, 16, 1),
(4, '20.0', '40.0', 5645, '2021-01-13', 1, 14, 3),
(5, '50.0', '70.0', 464, '2021-01-06', 1, 15, 1),
(6, '10.0', '78.0', 97687, '2021-01-13', 1, 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `photo` varchar(20) NOT NULL DEFAULT 'product.jpg',
  `price` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `detail` text NOT NULL DEFAULT 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.',
  `views` int(10) NOT NULL DEFAULT 0,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `subcat_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `photo`, `price`, `code`, `detail`, `views`, `brand_id`, `subcat_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(1, 'Thyme', 'product-1.jpg', '50', 'dghf6gd', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 7, 4, 2, 1, '2021-01-06 18:00:46', '2021-01-16 10:26:37'),
(2, 'Rosemary', 'product-2.jpg', '70', 'gsff56df', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 8, 4, 2, 2, '2021-01-02 18:00:46', '2021-01-15 23:42:09'),
(3, 'saffron', 'product-3.jpg', '40', '46ghu7', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 5, 3, 1, 2, '2021-01-16 18:00:46', '2021-01-16 09:25:07'),
(4, 'sage', 'product-4.jpg', '20', 'hy651g', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 30, 4, 1, 1, '2021-01-01 18:00:46', '2021-01-16 10:26:27'),
(5, 'yansoon', 'product-5.jpg', '50', 'dghf6gd2', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 5, 2, 3, 1, '2021-01-11 18:00:46', '2021-01-16 10:11:05'),
(6, 'shamer', 'product-6.jpg', '20', 'gsff56df9', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 12, 1, 3, 2, '2021-01-10 18:00:46', '2021-01-16 10:10:49'),
(7, 'ice tea', 'product-7.jpg', '30', '46ghu766', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 4, 2, 4, 2, '2021-01-05 21:41:12', '2021-01-15 23:10:37'),
(8, 'mint lemonade', 'product-8.jpg', '40', 'hy651g55', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 10, 3, 4, 1, '2021-01-15 18:00:46', '2021-01-15 23:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `products_offers`
--

CREATE TABLE `products_offers` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `offer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products_orders`
--

CREATE TABLE `products_orders` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_orders`
--

INSERT INTO `products_orders` (`product_id`, `order_id`, `quantity`, `price`) VALUES
(4, 4, 2, '40'),
(5, 1, 1, '50'),
(5, 2, 2, '70'),
(6, 4, 1, '50'),
(7, 1, 1, '40'),
(7, 3, 1, '50'),
(8, 5, 2, '20'),
(8, 6, 2, '70');

-- --------------------------------------------------------

--
-- Table structure for table `products_photos`
--

CREATE TABLE `products_photos` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(20) DEFAULT 'product.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `products_reviews`
-- (See below for the actual view)
--
CREATE TABLE `products_reviews` (
`id` int(10) unsigned
,`name` varchar(40)
,`photo` varchar(20)
,`price` varchar(10)
,`code` varchar(10)
,`detail` text
,`brand_id` int(10) unsigned
,`subcat_id` int(10) unsigned
,`supplier_id` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`reviews_count` bigint(21)
,`avg_rating` double(17,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `value` varchar(20) NOT NULL,
  `comment` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`user_id`, `product_id`, `value`, `comment`, `created_at`, `updated_at`) VALUES
(14, 1, '5', 'very nice', '2021-01-16 10:04:08', '2021-01-16 10:05:22'),
(14, 2, '5', 'amazing', '2021-01-16 10:04:08', '2021-01-16 10:05:22'),
(14, 3, '4', 'so good', '2021-01-16 10:04:08', '2021-01-16 10:05:22'),
(15, 1, '3', 'nice', '2021-01-16 10:04:08', '2021-01-16 10:05:22'),
(15, 2, '2', 'not bad', '2021-01-16 10:04:08', '2021-01-16 10:05:22'),
(15, 4, '1', 'bad product', '2021-01-16 10:04:08', '2021-01-16 10:05:22'),
(16, 1, '2', 'not bad', '2021-01-16 10:04:08', '2021-01-16 10:05:22'),
(16, 2, '4', 'pretty good!', '2021-01-16 10:04:08', '2021-01-16 10:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `latitude`, `longitude`, `city_id`) VALUES
(1, 'Ataba', '20.0', '40.0', 1),
(2, 'Abbasia', '50.0', '70.0', 1),
(3, 'Baltim', '20.0', '40.0', 2),
(4, 'Raml', '50.0', '70.0', 2),
(5, 'Banha', '20.0', '40.0', 4),
(6, 'Qnatir', '50.0', '70.0', 4);

-- --------------------------------------------------------

--
-- Table structure for table `specss`
--

CREATE TABLE `specss` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `value` varchar(40) NOT NULL,
  `poduct_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategorys`
--

CREATE TABLE `subcategorys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `photo` varchar(20) DEFAULT 'category.jpg',
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategorys`
--

INSERT INTO `subcategorys` (`id`, `name`, `photo`, `category_id`) VALUES
(1, 'Dry', 'category.jpg', 1),
(2, 'Fresh', 'category.jpg', 1),
(3, 'Hot', 'category.jpg', 2),
(4, 'Cold', 'category.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `national_id` int(14) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `photo` varchar(20) DEFAULT 'supplier.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `national_id`, `phone`, `email`, `photo`) VALUES
(1, 'Ahmed', 65456, '54654', 'a@gmai.com', 'supplier.jpg'),
(2, 'Mohamed', 453486, '867645', 'm@gmai.com', 'supplier.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `photo` varchar(40) DEFAULT 'profile.jpg',
  `status` tinyint(1) DEFAULT 2,
  `code` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `gender`, `photo`, `status`, `code`, `created_at`, `updated_at`) VALUES
(14, 'Abdullah', '0102554888', 'apdullahetman30@gmail.com', 'ea3b021455b26692b5539a918d7a2cd7d34b9ac9', 'm', '1610716457.jpg', 1, 93332, '2021-01-11 22:15:04', '2021-01-15 13:14:17'),
(15, 'Omar', '0125465896', 'a@gmai.com', 'ayhaga', 'm', 'profile.jpg', 2, NULL, '2021-01-15 18:23:47', '2021-01-15 18:23:47'),
(16, 'Qasem', '014578523553', 'Q@gmai.com', 'ay habd', 'm', 'profile.jpg', 2, NULL, '2021-01-15 18:24:53', '2021-01-15 18:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `most_ordered`
--
DROP TABLE IF EXISTS `most_ordered`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `most_ordered`  AS SELECT `products`.`id` AS `id`, `products`.`name` AS `name`, `products`.`photo` AS `photo`, `products`.`price` AS `price`, `products`.`code` AS `code`, `products`.`detail` AS `detail`, `products`.`views` AS `views`, `products`.`brand_id` AS `brand_id`, `products`.`subcat_id` AS `subcat_id`, `products`.`supplier_id` AS `supplier_id`, `products`.`created_at` AS `created_at`, `products`.`updated_at` AS `updated_at`, count(`products_orders`.`product_id`) AS `orders_count` FROM (`products` left join `products_orders` on(`products_orders`.`product_id` = `products`.`id`)) GROUP BY `products`.`id` ORDER BY count(`products_orders`.`product_id`) DESC, `products`.`views` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `most_rated`
--
DROP TABLE IF EXISTS `most_rated`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `most_rated`  AS SELECT `products`.`id` AS `id`, `products`.`name` AS `name`, `products`.`photo` AS `photo`, `products`.`price` AS `price`, `products`.`code` AS `code`, `products`.`detail` AS `detail`, `products`.`views` AS `views`, `products`.`brand_id` AS `brand_id`, `products`.`subcat_id` AS `subcat_id`, `products`.`supplier_id` AS `supplier_id`, `products`.`created_at` AS `created_at`, `products`.`updated_at` AS `updated_at`, count(`ratings`.`product_id`) AS `reviews_count`, if(round(avg(`ratings`.`value`),0) is null,0,round(avg(`ratings`.`value`),0)) AS `avg_rating` FROM (`products` left join `ratings` on(`ratings`.`product_id` = `products`.`id`)) GROUP BY `products`.`id` ORDER BY if(round(avg(`ratings`.`value`),0) is null,0,round(avg(`ratings`.`value`),0)) DESC, count(`ratings`.`product_id`) DESC ;

-- --------------------------------------------------------

--
-- Structure for view `products_reviews`
--
DROP TABLE IF EXISTS `products_reviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_reviews`  AS SELECT `products`.`id` AS `id`, `products`.`name` AS `name`, `products`.`photo` AS `photo`, `products`.`price` AS `price`, `products`.`code` AS `code`, `products`.`detail` AS `detail`, `products`.`brand_id` AS `brand_id`, `products`.`subcat_id` AS `subcat_id`, `products`.`supplier_id` AS `supplier_id`, `products`.`created_at` AS `created_at`, `products`.`updated_at` AS `updated_at`, count(`ratings`.`product_id`) AS `reviews_count`, if(round(avg(`ratings`.`value`),0) is null,0,round(avg(`ratings`.`value`),0)) AS `avg_rating` FROM (`products` left join `ratings` on(`ratings`.`product_id` = `products`.`id`)) GROUP BY `products`.`id` ORDER BY if(round(avg(`ratings`.`value`),0) is null,0,round(avg(`ratings`.`value`),0)) DESC, count(`ratings`.`product_id`) DESC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresss`
--
ALTER TABLE `addresss`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userAddress` (`user_id`),
  ADD KEY `regionAddress` (`region_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `cartProducts` (`product_id`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citys`
--
ALTER TABLE `citys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userOrder` (`user_id`),
  ADD KEY `couponOrder` (`coupon_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productBrand` (`brand_id`),
  ADD KEY `productSubcat` (`subcat_id`),
  ADD KEY `productSupplier` (`supplier_id`);

--
-- Indexes for table `products_offers`
--
ALTER TABLE `products_offers`
  ADD PRIMARY KEY (`product_id`,`offer_id`),
  ADD KEY `offer` (`offer_id`);

--
-- Indexes for table `products_orders`
--
ALTER TABLE `products_orders`
  ADD PRIMARY KEY (`product_id`,`order_id`),
  ADD KEY `orderProduct` (`order_id`);

--
-- Indexes for table `products_photos`
--
ALTER TABLE `products_photos`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `productRating` (`product_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cityRegion` (`city_id`);

--
-- Indexes for table `specss`
--
ALTER TABLE `specss`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productSpecs` (`poduct_id`);

--
-- Indexes for table `subcategorys`
--
ALTER TABLE `subcategorys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorySub` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `wishlistProduct` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresss`
--
ALTER TABLE `addresss`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `citys`
--
ALTER TABLE `citys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products_offers`
--
ALTER TABLE `products_offers`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_orders`
--
ALTER TABLE `products_orders`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products_photos`
--
ALTER TABLE `products_photos`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specss`
--
ALTER TABLE `specss`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategorys`
--
ALTER TABLE `subcategorys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresss`
--
ALTER TABLE `addresss`
  ADD CONSTRAINT `regionAddress` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userAddress` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `cartProducts` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userCart` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `couponOrder` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userOrder` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `productBrand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productSubcat` FOREIGN KEY (`subcat_id`) REFERENCES `subcategorys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productSupplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_offers`
--
ALTER TABLE `products_offers`
  ADD CONSTRAINT `offer` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_orders`
--
ALTER TABLE `products_orders`
  ADD CONSTRAINT `orderProduct` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productOrder` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_photos`
--
ALTER TABLE `products_photos`
  ADD CONSTRAINT `productsPhotos` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `productRating` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userRating` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `cityRegion` FOREIGN KEY (`city_id`) REFERENCES `citys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specss`
--
ALTER TABLE `specss`
  ADD CONSTRAINT `productSpecs` FOREIGN KEY (`poduct_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategorys`
--
ALTER TABLE `subcategorys`
  ADD CONSTRAINT `categorySub` FOREIGN KEY (`category_id`) REFERENCES `categorys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `userWishlist` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlistProduct` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
