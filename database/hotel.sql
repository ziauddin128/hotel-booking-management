-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 10:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`id`, `name`, `password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `total_pay` float NOT NULL,
  `room_no` int(11) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone_num` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phone_num`, `address`) VALUES
(2, 2, 'Delux', 800, 5600, NULL, 'ZIA UDDIN BABLU', '8756452654', 'Feni, Bangladesh\r\nBangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `trans_amt` float NOT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(255) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `session_id`, `trans_id`, `trans_amt`, `trans_status`, `trans_resp_msg`, `datetime`) VALUES
(2, 5, 15, '2025-03-18', '2025-03-25', 0, NULL, 'booked', '933746', 'cs_test_a1UWkxmOUbZMxMrQLI9JoilrFltAhVAc2RAZN2zxG7DjsG5P8gzD9pUGMG', 'pi_3R2qwaJChN1dztHC0S7cqqqb', 5600, 'succeeded', NULL, '2025-03-15 15:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `image`) VALUES
(2, 'IMG_10381.jpg'),
(3, 'IMG_10596.jpg'),
(4, 'IMG_90795.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_det`
--

CREATE TABLE `contacts_det` (
  `id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gmap` varchar(500) DEFAULT NULL,
  `phn1` varchar(50) DEFAULT NULL,
  `phn2` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fb` varchar(100) DEFAULT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts_det`
--

INSERT INTO `contacts_det` (`id`, `address`, `gmap`, `phn1`, `phn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'Dhaka, Bangladesh', 'https://maps.app.goo.gl/TpuEg8M3yca15Uz17', '+8801578457845', '+8801578457846', 'tjhotel@gmail.com', 'https://www.fb.com/tjhotel', 'https://www.instagram.com/tjhotel', 'https://www.twitter.com/tjhotel', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17574.9557016029!2d91.39517049999999!3d23.03082315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3753685a3edbeb99%3A0x319f9ae6bf1bfd99!2sReverse%20Club%20Ground!5e1!3m2!1sen!2sbd!4v1740684136665!5m2!1sen!2sbd');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `facility_icon` varchar(100) DEFAULT NULL,
  `facility_name` varchar(100) DEFAULT NULL,
  `facility_desc` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `facility_icon`, `facility_name`, `facility_desc`) VALUES
(4, 'IMG_75759.svg', 'Television', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur hic aliquam reiciendis ea explicabo maiores illum eius suscipit aliquid iusto.'),
(5, 'IMG_12816.svg', 'Air-Conditioner', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur hic aliquam reiciendis ea explicabo maiores illum eius suscipit aliquid iusto.'),
(6, 'IMG_98845.svg', 'Room Heater', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur hic aliquam reiciendis ea explicabo maiores illum eius suscipit aliquid iusto.'),
(7, 'IMG_82025.svg', 'Wifi', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur hic aliquam reiciendis ea explicabo maiores illum eius suscipit aliquid iusto.');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `feature_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature_name`) VALUES
(9, 'Bedroom'),
(10, 'Balcony'),
(11, 'Bathroom');

-- --------------------------------------------------------

--
-- Table structure for table `room-facilities`
--

CREATE TABLE `room-facilities` (
  `id` int(11) NOT NULL,
  `room_id` int(50) DEFAULT NULL,
  `facilities_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room-facilities`
--

INSERT INTO `room-facilities` (`id`, `room_id`, `facilities_id`) VALUES
(28, 14, 4),
(29, 14, 5),
(30, 14, 7),
(31, 15, 4),
(32, 15, 5),
(33, 15, 6),
(34, 15, 7),
(35, 16, 4),
(36, 16, 5),
(37, 16, 6),
(38, 16, 7);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `area` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(50) DEFAULT NULL,
  `adult` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(11, 'Simple Room2', 1512, 122, 122, 12, 12, 'vvav avdvdvad22', 1, 1),
(12, 'simple room 2q', 12, 12, 45, 45, 4, 'dav avdda adv', 1, 1),
(13, 'Simple room 1', 45, 200, 12, 2, 1, 'AV avbkbva vdabvdb vadbkvad', 1, 1),
(14, 'Simple', 30, 500, 12, 3, 2, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur hic aliquam reiciendis ea explicabo maiores illum eius suscipit aliquid iusto.', 1, 0),
(15, 'Delux', 60, 800, 20, 8, 5, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur hic aliquam reiciendis ea explicabo maiores illum eius suscipit aliquid iusto.', 1, 0),
(16, 'Supreme', 100, 1200, 15, 12, 8, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur hic aliquam reiciendis ea explicabo maiores illum eius suscipit aliquid iusto.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `id` int(11) NOT NULL,
  `room_id` int(50) NOT NULL,
  `feature_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`id`, `room_id`, `feature_id`) VALUES
(40, 14, 9),
(41, 14, 10),
(42, 14, 11),
(43, 15, 9),
(44, 15, 10),
(45, 15, 11),
(46, 16, 9),
(47, 16, 10),
(48, 16, 11);

-- --------------------------------------------------------

--
-- Table structure for table `room_image`
--

CREATE TABLE `room_image` (
  `id` int(11) NOT NULL,
  `room_id` int(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_image`
--

INSERT INTO `room_image` (`id`, `room_id`, `image`, `thumb`) VALUES
(11, 16, 'IMG_15075.jpg', 1),
(12, 16, 'IMG_21204.jpg', 0),
(13, 15, 'IMG_47668.jpg', 1),
(14, 15, 'IMG_48012.jpg', 0),
(15, 14, 'IMG_39315.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `site_about` varchar(500) DEFAULT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'TJ HOTEL', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `id` int(11) NOT NULL,
  `member_name` varchar(100) DEFAULT NULL,
  `member_picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`id`, `member_name`, `member_picture`) VALUES
(4, 'zia uddin', 'IMG_47122.jpg'),
(5, 'Rana Mahmud', 'IMG_99583.jpg'),
(7, 'Raju Mondol', 'IMG_49313.jpg'),
(8, 'Jahir Rayhan', 'IMG_63928.jpg'),
(9, NULL, NULL),
(10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` int(50) NOT NULL,
  `dob` date NOT NULL,
  `pass` varchar(200) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `token_exp` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `phone_number`, `picture`, `address`, `pincode`, `dob`, `pass`, `is_verified`, `token`, `token_exp`, `status`, `date_time`) VALUES
(5, 'ZIA UDDIN BABLU', 'test12web2000@gmail.com', '8756452654', 'IMG_53205.jpeg', 'Feni, Bangladesh\r\nBangladesh', 35004, '2025-03-13', '$2y$10$FXQhy4SyGuCNvTgsB27yB.HFG1uJ8E5czHRojo7RUq1lR8mTldR0i', 1, NULL, NULL, 1, '2025-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts_det`
--
ALTER TABLE `contacts_det`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room-facilities`
--
ALTER TABLE `room-facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facilities-id` (`facilities_id`),
  ADD KEY `room-id-2` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room-id` (`room_id`),
  ADD KEY `feature-id` (`feature_id`);

--
-- Indexes for table `room_image`
--
ALTER TABLE `room_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts_det`
--
ALTER TABLE `contacts_det`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `room-facilities`
--
ALTER TABLE `room-facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `room_image`
--
ALTER TABLE `room_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
