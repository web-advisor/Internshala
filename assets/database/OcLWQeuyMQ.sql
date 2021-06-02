-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2021 at 07:47 AM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OcLWQeuyMQ`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `code` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `password`, `code`) VALUES
(1, 'abraham@gmail.com', '73e86ad9ea104ea995e88fdb3dd079e2', '575dec'),
(2, 'alibaba@gmail.com', '3020f545359462784c5e59d1e626e3ec', '16645a'),
(3, 'paridhi@gmail.com', '990ede4c881975a31837287d926a8dff', 'fed4e8'),
(5, 'sinha2712@gmail.com', '1d7bd944990dec4554114697182cce2e', 'd1acb5'),
(6, 'amarsinha@gmail.com', 'ae8cb503d5faf7574c300826a32e5931', 'f35526');

-- --------------------------------------------------------

--
-- Table structure for table `cust_address`
--

CREATE TABLE `cust_address` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `line` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `state` text COLLATE utf8_unicode_ci NOT NULL,
  `pin` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cust_address`
--

INSERT INTO `cust_address` (`id`, `cust_id`, `line`, `city`, `state`, `pin`, `lat`, `lng`) VALUES
(1, 1, 'Palam', 'Delhi', 'Delhi(UT)', '110010', 40.685542, -73.672834),
(2, 2, 'Rajiv Chowk', 'New Delhi', 'Delhi(UT)', '110001', 39.25024, -111.75103),
(3, 6, 'Dilshad Colony', 'Delhi ', 'Delhi (UT)', '110095', 39.25024, -111.75103);

-- --------------------------------------------------------

--
-- Table structure for table `cust_details`
--

CREATE TABLE `cust_details` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `preferences` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cust_details`
--

INSERT INTO `cust_details` (`id`, `cust_id`, `name`, `phone`, `preferences`) VALUES
(3, 1, 'Abraham Lincoln', '32874978', 'vegetarian'),
(4, 2, 'Alibaba', '09813091', 'non-vegetarian'),
(5, 6, 'Amar', 'Sinha', 'non-vegetarian');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `fname` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `category` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `rest_id`, `fname`, `keywords`, `category`, `rating`, `description`, `image`, `price`, `status`) VALUES
(1, 1, 'Aloo Tikka', 'Aloo Tikka, Aloo Tikki', 'Snacks', 'vegetarian', 'Aloo Tikka is one of our famous lunchtime and evening snacks for decades ! Have a try today ', 'aloo tikka.jpg', 50, '0'),
(2, 1, 'Chicken Tikka', 'Chicken Tikka, Chicken Tikki', 'Snacks', 'non-vegetarian', 'Feeding Chicken Tikka since 1971', 'ChickenTikka.jpg', 75, '0'),
(3, 1, 'Paneer Tikka', 'Paneer Tikka, Paneer Tikki', 'Snacks', 'vegetarian', 'Paneer Tikka Lajawaaab', 'PaneerTikka.jpg', 210, '0'),
(4, 1, 'Soya Tikka Roll', 'Soya Tikka Roll, Soya Roll, Soya Tikka', 'Snacks', 'vegetarian', 'Tryout the best ', 'SoyaTikkaRoll.jpg', 100, '1'),
(5, 2, 'THE RED SAUCE PASTA', 'red sauce pasta, red sauce, pasta', 'Snacks', 'vegetarian', 'Try not to fall in Love with our Red Sauce Pasta ! ', 'redSaucePasta.jpg', 120, '1'),
(6, 2, 'Thai Food', 'Lunch, Thai Food ', 'Lunch', 'eggetarian', 'Well Cooked Thai Food Thali Awaits you ! ', 'thali.jpg', 350, '1'),
(7, 2, 'Waffle Treat', 'Waffle, Chocolate Waffle, Caramel Waffle', 'Snacks', 'vegetarian', 'A long range of Waffles, can be Customised !', 'waffle.jpg', 80, '1'),
(8, 3, 'Chocolate Brownie', 'Chocolate Brownie, Best Brownie, brownie', 'Snacks', 'vegetarian', 'The Best Chocolate Brownie of the City !', 'choco.jpg', 120, '1'),
(9, 3, 'Breakfast Delight', 'Bread, Breakfast, Coffee, Mushroom', 'Breakfast', 'vegetarian', 'A Perfect combo Breakfast ! ', 'break.jpg', 300, '1'),
(10, 3, 'Rotzaa Dinner', 'Dinner, Pizza, Paratha, Rotzaa, ', 'Dinner', 'eggetarian', 'When you know, you know', 'party.jpg', 500, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ordering`
--

CREATE TABLE `ordering` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `cust_status` text COLLATE utf8_unicode_ci NOT NULL,
  `rest_status` text COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordering`
--

INSERT INTO `ordering` (`id`, `cust_id`, `rest_id`, `food_id`, `cust_status`, `rest_status`, `datetime`) VALUES
(1, 1, 2, 7, '4', 'Received', '2021-06-02 02:24:13'),
(2, 1, 2, 5, '3', 'Received', '2021-06-02 02:31:26'),
(3, 1, 3, 9, '3', 'Received', '2021-06-02 03:33:15'),
(4, 1, 1, 2, '2', 'Received', '2021-06-02 03:45:50'),
(5, 1, 1, 4, '1', 'Received', '2021-06-02 04:00:31'),
(6, 1, 1, 3, '2', 'Received', '2021-06-02 06:15:48'),
(7, 6, 2, 7, '1', 'Received', '2021-06-02 06:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `code` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `email`, `password`, `code`) VALUES
(1, 'khanchacha@gmail.com', '43bf3ad908011f793e0e641a0d949ef5', '76238e'),
(2, 'cafewynk@gmail.com', '0254b893d8893df03262974ce5eb23e4', '82d4e8'),
(3, 'cafe.ama@yahoo.com', '6b87f77a785d2e6505a4153b074952d5', 'd2c3bc');

-- --------------------------------------------------------

--
-- Table structure for table `rest_address`
--

CREATE TABLE `rest_address` (
  `id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `line` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `state` text COLLATE utf8_unicode_ci NOT NULL,
  `pin` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rest_address`
--

INSERT INTO `rest_address` (`id`, `rest_id`, `line`, `city`, `state`, `pin`, `lat`, `lng`) VALUES
(1, 1, 'Khan Market, Rabindra Nagar', 'New Delhi', 'Delhi', '110003', 28.6000464, 77.2269971),
(2, 2, 'Anand Vihar', 'Delhi', 'Delhi (UT)', ' 110092', 39.25024, -111.75103),
(3, 3, 'Majnu-ka-tilla, New Aruna Nagar', 'New Delhi', 'Delhi (UT)', '110054', 40.686599, -73.705303);

-- --------------------------------------------------------

--
-- Table structure for table `rest_details`
--

CREATE TABLE `rest_details` (
  `id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `website` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rest_details`
--

INSERT INTO `rest_details` (`id`, `rest_id`, `name`, `phone`, `website`, `rating`, `image`) VALUES
(2, 1, 'Khan Chacha Restaurant', '9238492094', 'https://khanchacha.com/', 'non-vegetarian', 'Delhi-Eatery-Khan-Chacha.jpeg'),
(3, 2, 'Cafe Wink', '09582289249', 'http://cafewink.net/', 'non-vegetarian', 'cafewink.jpg'),
(4, 3, 'AMA Cafe', '98234792792', 'https://www.zomato.com/ncr/ama-cafe-majnu-ka-tila-new-delhi/menu', 'eggetarian', 'ama.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `status` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type`, `userid`, `status`) VALUES
(1, 'customers', 1, 0),
(2, 'customers', 2, 0),
(3, 'restaurant', 1, 0),
(4, 'customers', 3, 0),
(6, 'customers', 5, 0),
(7, 'restaurant', 2, 0),
(8, 'restaurant', 3, 0),
(9, 'customers', 6, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`) USING BTREE COMMENT 'Customer Login Credentials ';

--
-- Indexes for table `cust_address`
--
ALTER TABLE `cust_address`
  ADD PRIMARY KEY (`id`) USING BTREE COMMENT 'Customer Address Storing ',
  ADD KEY `customer_connector` (`cust_id`);

--
-- Indexes for table `cust_details`
--
ALTER TABLE `cust_details`
  ADD PRIMARY KEY (`id`) USING BTREE COMMENT 'Customer Basic Info ',
  ADD KEY `customers_connector` (`cust_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`) USING BTREE COMMENT 'All Food Related Details',
  ADD KEY `food_restaurant` (`rest_id`);

--
-- Indexes for table `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`id`) USING BTREE COMMENT 'Ordering Management',
  ADD KEY `customer_cart` (`cust_id`),
  ADD KEY `restaurant_order` (`rest_id`),
  ADD KEY `food_order` (`food_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`) USING BTREE COMMENT 'Restaurant Login Credentials ';

--
-- Indexes for table `rest_address`
--
ALTER TABLE `rest_address`
  ADD PRIMARY KEY (`id`) USING BTREE COMMENT 'Restaurant Address Storing ',
  ADD KEY `restaurant_location` (`rest_id`);

--
-- Indexes for table `rest_details`
--
ALTER TABLE `rest_details`
  ADD PRIMARY KEY (`id`) USING BTREE COMMENT 'Restaurant Basic Info ',
  ADD KEY `restaurant_connector` (`rest_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`) USING BTREE COMMENT 'Storing Type of User';

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cust_address`
--
ALTER TABLE `cust_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cust_details`
--
ALTER TABLE `cust_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ordering`
--
ALTER TABLE `ordering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rest_address`
--
ALTER TABLE `rest_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rest_details`
--
ALTER TABLE `rest_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cust_address`
--
ALTER TABLE `cust_address`
  ADD CONSTRAINT `customer_connector` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cust_details`
--
ALTER TABLE `cust_details`
  ADD CONSTRAINT `customers_connector` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_restaurant` FOREIGN KEY (`rest_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordering`
--
ALTER TABLE `ordering`
  ADD CONSTRAINT `customer_cart` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `food_order` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `restaurant_order` FOREIGN KEY (`rest_id`) REFERENCES `restaurant` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `rest_address`
--
ALTER TABLE `rest_address`
  ADD CONSTRAINT `restaurant_location` FOREIGN KEY (`rest_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rest_details`
--
ALTER TABLE `rest_details`
  ADD CONSTRAINT `restaurant_connector` FOREIGN KEY (`rest_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
