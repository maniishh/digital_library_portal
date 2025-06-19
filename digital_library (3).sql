-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 06:43 PM
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
-- Database: `digital_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_admins`
--

CREATE TABLE `table_admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_admins`
--

INSERT INTO `table_admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'ram', 'ab@gmail.com', '$2y$10$s77F4AKYEMvEEjhnol99Vu8ufL3pEy2iP7IkA.DjsWxKt/0BlZ6dC', '2025-06-18 06:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `table_bookings`
--

CREATE TABLE `table_bookings` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `till_date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `shift` varchar(50) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `fees_type` enum('daily','monthly') DEFAULT 'daily',
  `id_proof` varchar(255) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_bookings`
--

INSERT INTO `table_bookings` (`id`, `student_id`, `seat_id`, `date`, `till_date`, `start_time`, `end_time`, `created_at`, `shift`, `purpose`, `fees_type`, `id_proof`, `approval_status`, `status`) VALUES
(19, 3, 17, '2025-06-18', NULL, '09:48:00', '12:48:00', '2025-06-19 04:18:20', NULL, NULL, 'daily', NULL, 'rejected', 'pending'),
(20, 3, 17, '2025-06-18', NULL, '10:48:00', '15:48:00', '2025-06-19 04:18:58', NULL, NULL, 'daily', NULL, 'rejected', 'pending'),
(21, 3, 14, '2025-06-04', NULL, '03:10:00', '15:10:00', '2025-06-19 04:40:31', NULL, NULL, 'daily', NULL, 'rejected', 'pending'),
(22, 4, 17, '2025-06-18', NULL, '11:15:00', '23:15:00', '2025-06-19 04:45:53', NULL, NULL, 'daily', NULL, 'rejected', 'pending'),
(23, 1, 14, '2025-06-17', NULL, '04:29:00', '17:29:00', '2025-06-19 06:01:52', NULL, NULL, 'daily', NULL, 'rejected', 'pending'),
(25, 1, 14, '2025-06-11', '2025-06-12', '08:18:00', '03:18:00', '2025-06-19 06:50:36', 'morning', 'self study', 'daily', '6853b33cc35ee.jpg', 'rejected', 'pending'),
(30, 1, 17, '2025-06-04', '2025-06-30', '07:44:00', '09:44:00', '2025-06-19 08:15:25', 'evening', 'hgf', 'daily', '6853c71db8bda.jpg', 'rejected', 'pending'),
(33, 1, 17, '2025-06-19', '2025-07-19', '09:12:00', '04:12:00', '2025-06-19 08:42:36', 'evening', 'ghg', 'daily', '6853cd7cb424c.jpg', 'pending', 'pending'),
(34, 1, 18, '2025-06-17', '2025-06-22', '08:47:00', '05:47:00', '2025-06-19 09:18:08', 'evening', 'd', 'daily', '6853d5d04e4bf.jpg', 'approved', 'pending'),
(36, 1, 17, '2025-06-18', '2025-06-22', '10:06:00', '10:06:00', '2025-06-19 09:36:48', 'morning', 'gh', 'daily', '6853da3083bbf.jpeg', 'approved', 'pending'),
(37, 1, 18, '2025-06-19', '2025-06-21', '17:16:00', '21:16:00', '2025-06-19 15:47:14', 'afternoon', 'self study', 'daily', '685431023f697.jpg', 'approved', 'pending'),
(38, 8, 14, '2025-06-19', '2025-07-19', '21:55:00', '07:01:00', '2025-06-19 16:25:35', 'morning', 'sssx', 'daily', '685439ff8c3e0.jpeg', 'approved', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `table_feedback`
--

CREATE TABLE `table_feedback` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_feedback`
--

INSERT INTO `table_feedback` (`id`, `student_id`, `message`, `submitted_at`) VALUES
(6, 1, 'gfhg', '2025-06-19 04:51:38'),
(7, 1, 'fghgjgh', '2025-06-19 04:51:58'),
(8, 1, 'hhv', '2025-06-19 05:46:04'),
(9, 1, 'hbv', '2025-06-19 05:46:10'),
(10, 1, 'mnjn', '2025-06-19 05:54:42'),
(11, 1, 'hello sir this library is very better for self study....', '2025-06-19 12:16:15'),
(12, 1, 'hello sr', '2025-06-19 15:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `table_messages`
--

CREATE TABLE `table_messages` (
  `id` int(11) NOT NULL,
  `feedback_id` int(11) NOT NULL,
  `response` text DEFAULT NULL,
  `responded_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_notifications`
--

CREATE TABLE `table_notifications` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_notifications`
--

INSERT INTO `table_notifications` (`id`, `student_id`, `title`, `message`, `is_read`, `created_at`) VALUES
(1, NULL, 'New Booking', 'Student <strong></strong> booked Seat No <strong></strong> on <strong></strong> for <strong></strong> shift.', 1, '2025-06-19 13:27:27'),
(2, NULL, 'New Seat Booking', '👨‍🎓 <strong></strong> booked Seat <strong></strong> on <strong></strong> for <strong></strong> shift.', 1, '2025-06-19 13:29:27'),
(3, NULL, 'New Seat Booking', '👨‍🎓 <strong>agv</strong> booked Seat <strong></strong> on <strong>2025-06-11</strong> for <strong>evening</strong> shift.', 1, '2025-06-19 13:30:14'),
(4, NULL, 'New Seat Booking', '👨‍🎓 <strong>asdf</strong> booked Seat <strong></strong> on <strong>2025-06-10</strong> for <strong>evening</strong> shift.', 1, '2025-06-19 13:42:08'),
(5, NULL, 'New Seat Booking', '👨‍🎓 <strong>agf</strong> booked Seat <strong></strong> on <strong>2025-06-04</strong> for <strong>evening</strong> shift.', 1, '2025-06-19 13:45:25'),
(6, NULL, 'New Seat Booking', '👨‍🎓 <strong>agf</strong> booked seat <strong>20A</strong> from <strong>2025-06-04</strong> to <strong>2025-06-30</strong>.', 1, '2025-06-19 14:10:51'),
(7, NULL, 'New Seat Booking', '👨‍🎓 <strong>a</strong> booked seat <strong>20</strong> from <strong>2025-06-19</strong> to <strong>2025-06-20</strong>.', 1, '2025-06-19 14:11:34'),
(8, NULL, 'New Seat Booking', '👨‍🎓 <strong>a</strong> booked seat <strong>20A</strong> from <strong>2025-06-19</strong> to <strong>2025-07-19</strong>.', 1, '2025-06-19 14:12:36'),
(9, NULL, 'New Seat Booking', '\\ud83d\\udc68\\u200d\\ud83c\\udf93 <strong>a</strong> booked seat <strong>30</strong> from <strong>2025-06-17</strong> to <strong>2025-06-22</strong>.', 1, '2025-06-19 14:48:08'),
(10, NULL, 'New Payment Received', '\\ud83d\\udcb8 <strong>a</strong> paid \\u20b9<strong>0.00</strong> via <strong>Cash</strong>.', 1, '2025-06-19 14:48:08'),
(11, NULL, 'New Seat Booking', '\\ud83d\\udc68\\u200d\\ud83c\\udf93 <strong>a</strong> booked seat <strong>20A</strong> from <strong>2025-06-25</strong> to <strong>2025-06-21</strong>.', 1, '2025-06-19 14:51:36'),
(12, NULL, 'New Payment Received', '\\ud83d\\udcb8 <strong>a</strong> paid \\u20b9<strong>0.00</strong> via <strong>Cash</strong>.', 1, '2025-06-19 14:51:36'),
(13, NULL, 'New Seat Booking', '\\ud83d\\udc68\\u200d\\ud83c\\udf93 <strong>a</strong> booked seat <strong>20A</strong> from <strong>2025-06-18</strong> to <strong>2025-06-22</strong>.', 1, '2025-06-19 15:06:48'),
(14, NULL, 'New Payment Received', '\\ud83d\\udcb8 <strong>a</strong> paid \\u20b9<strong>0.00</strong> via <strong>Card</strong>.', 1, '2025-06-19 15:06:48'),
(15, 1, 'Booking Approved', '✅ Your seat booking (ID #36) has been approved.', 1, '2025-06-19 15:23:46'),
(16, 1, 'Booking Approved', '✅ Your seat booking (ID #36) has been approved.', 1, '2025-06-19 15:25:08'),
(17, 1, 'Booking Approved', '✅ Your seat booking (ID #35) has been approved.', 1, '2025-06-19 15:25:16'),
(18, 1, 'Booking Approved', '✅ Your seat booking (ID #35) has been approved.', 1, '2025-06-19 15:25:17'),
(19, 1, 'Booking Approved', '✅ Your seat booking (ID #36) has been approved.', 1, '2025-06-19 15:25:50'),
(20, 1, 'Booking Approved', '✅ Your seat booking (ID #36) has been approved.', 1, '2025-06-19 15:26:02'),
(21, 1, 'Booking Approved', '✅ Your seat booking (ID #36) has been approved.', 1, '2025-06-19 15:26:11'),
(22, 1, 'Booking Approved', '✅ Your seat booking (ID #36) has been approved.', 1, '2025-06-19 15:38:37'),
(23, 1, 'Booking Approved', '✅ Your seat booking (ID #36) has been approved.', 1, '2025-06-19 15:44:26'),
(24, 1, 'Booking Approved', '✅ Your seat booking (ID #36) has been approved.', 1, '2025-06-19 16:07:02'),
(25, 1, 'Booking Rejected', '❌ Your seat booking (ID #35) was rejected.', 1, '2025-06-19 16:07:12'),
(26, 1, 'Booking Approved', '✅ Your seat booking (ID #36) has been approved.', 1, '2025-06-19 16:37:25'),
(27, NULL, 'New Seat Booking', '\\ud83d\\udc68\\u200d\\ud83c\\udf93 <strong>a</strong> booked seat <strong>30</strong> from <strong>2025-06-19</strong> to <strong>2025-06-21</strong>.', 1, '2025-06-19 21:17:14'),
(28, NULL, 'New Payment Received', '\\ud83d\\udcb8 <strong>a</strong> paid \\u20b9<strong>0.00</strong> via <strong>Cash</strong>.', 1, '2025-06-19 21:17:14'),
(29, 1, 'Booking Approved', '✅ Your seat booking (ID #37) has been approved.', 1, '2025-06-19 21:18:10'),
(30, NULL, 'New Seat Booking', '\\ud83d\\udc68\\u200d\\ud83c\\udf93 <strong>raj</strong> booked seat <strong>20</strong> from <strong>2025-06-19</strong> to <strong>2025-07-19</strong>.', 0, '2025-06-19 21:55:35'),
(31, NULL, 'New Payment Received', '\\ud83d\\udcb8 <strong>raj</strong> paid \\u20b9<strong>1,000.00</strong> via <strong>Cash</strong>.', 0, '2025-06-19 21:55:35'),
(32, 8, 'Booking Approved', '✅ Your seat booking (ID #38) has been approved.', 0, '2025-06-19 21:57:26'),
(33, 8, 'Booking Approved', '✅ Your seat booking (ID #38) has been approved.', 0, '2025-06-19 21:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `table_parents`
--

CREATE TABLE `table_parents` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_payments`
--

CREATE TABLE `table_payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','failed') DEFAULT 'pending',
  `method` varchar(50) DEFAULT NULL,
  `payment_date` datetime DEFAULT current_timestamp(),
  `booking_id` int(11) NOT NULL,
  `payment_type` enum('daily','monthly') DEFAULT 'daily'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_payments`
--

INSERT INTO `table_payments` (`id`, `student_id`, `amount`, `status`, `method`, `payment_date`, `booking_id`, `payment_type`) VALUES
(16, 1, 0.00, 'pending', 'offline', '2025-06-19 13:45:25', 30, 'daily'),
(19, 1, 0.00, 'pending', 'offline', '2025-06-19 14:12:36', 33, 'daily'),
(23, 1, 600.00, 'completed', 'Card', '2025-06-19 15:06:48', 36, 'daily'),
(24, 1, 500.00, '', 'Cash', '2025-06-19 21:17:14', 37, 'daily'),
(25, 8, 1000.00, '', 'Cash', '2025-06-19 21:55:35', 38, 'daily');

-- --------------------------------------------------------

--
-- Table structure for table `table_profile_photos`
--

CREATE TABLE `table_profile_photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_reports`
--

CREATE TABLE `table_reports` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` enum('pdf','csv') DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_seats`
--

CREATE TABLE `table_seats` (
  `seat_id` int(11) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `daily_fee` decimal(10,2) DEFAULT 0.00,
  `monthly_fee` decimal(10,2) DEFAULT 0.00,
  `half_month_fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_seats`
--

INSERT INTO `table_seats` (`seat_id`, `seat_number`, `is_active`, `daily_fee`, `monthly_fee`, `half_month_fee`) VALUES
(14, '20', 0, 50.00, 500.00, 0.00),
(17, '20A', 0, 0.00, 0.00, 0.00),
(18, '30', 0, 0.00, 0.00, 0.00),
(21, '12', 0, 0.00, 0.00, 0.00),
(22, '20B', 1, 0.00, 0.00, 0.00),
(23, '23', 1, 0.00, 0.00, 0.00),
(24, '3', 1, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `table_students`
--

CREATE TABLE `table_students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_students`
--

INSERT INTO `table_students` (`id`, `name`, `email`, `phone`, `password`, `profile_photo`, `created_at`) VALUES
(1, 'a', 'a@gmail.com', '54545545454', '$2y$10$mqxRdhaVznLRKm9sO2HP0uKqkldCBs7R9qzzwXwWeNeMNJi1Vto5W', 'uploads/profile_photos/685250f4f00e1_1708877665295.jpeg', '2025-06-18 05:39:01'),
(2, 'sa', 'az@gmail.com', '124563245', '$2y$10$cXU4q1RbT.RXFE1jMHxUCu1qWma8WBR1p5EkF.0.qnVz8LXjfmQzm', 'uploads/profile_photos/68527f3d1d30a_1708877665295.jpeg', '2025-06-18 08:56:29'),
(3, 'vcx', 'q@gmail.com', '123455555', '$2y$10$Sid85ZHSuKpxEFRpOrPM2Ovbd4OldCz/dful2MgDpi4l3/HI9GJ5u', 'uploads/profile_photos/68538ca625399_IMG_20230310_062837 (1).jpg', '2025-06-19 04:05:58'),
(4, 'gjjkxcv', 'w@gmail.com', '1234567890', '$2y$10$6MsqjpqJ6jBN5ODbjcd6W.izhYD0imTtKHW4DxmvsT1uKMPzjGlAC', 'uploads/profile_photos/685395ebe9b87_1708877665295.jpeg', '2025-06-19 04:45:31'),
(5, 'satish yadav', 'sa@gmail.com', '1234567890', '$2y$10$m9H5GHK47qYJExRvPIfAguVUrMaLoQletNZxYCJObDg9Ztse16Vnu', 'uploads/profile_photos/6853ffccef043_SAVE_20250411_205133.png', '2025-06-19 12:17:16'),
(6, 'mann', 'mn@gmail.com', '9477279070', '$2y$10$SQYH4z7N/uDDyX69/SUjCusatEuLNYLSaBC3HvDAeL3gM41y/vXCO', '', '2025-06-19 15:36:34'),
(8, 'raj', 'wq@gmail.com', '12344556566', '$2y$10$woYkArOecAbjaK7j554JmuG2bgVa3wqVrydXk9IoDnnQDhmXmXsTq', 'uploads/profile_photos/685439a1c1dcf_WhatsApp Image 2025-06-19 at 12.24.44 PM.jpeg', '2025-06-19 16:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `table_study_logs`
--

CREATE TABLE `table_study_logs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_s_notifications`
--

CREATE TABLE `table_s_notifications` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_time_logs`
--

CREATE TABLE `table_time_logs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_admins`
--
ALTER TABLE `table_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `table_bookings`
--
ALTER TABLE `table_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student_id` (`student_id`),
  ADD KEY `fk_seat_id` (`seat_id`);

--
-- Indexes for table `table_feedback`
--
ALTER TABLE `table_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_feedback_student` (`student_id`);

--
-- Indexes for table `table_messages`
--
ALTER TABLE `table_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_id` (`feedback_id`);

--
-- Indexes for table `table_notifications`
--
ALTER TABLE `table_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_parents`
--
ALTER TABLE `table_parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `child_id` (`child_id`);

--
-- Indexes for table `table_payments`
--
ALTER TABLE `table_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_booking` (`booking_id`),
  ADD KEY `fk_payment_student` (`student_id`);

--
-- Indexes for table `table_profile_photos`
--
ALTER TABLE `table_profile_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `table_reports`
--
ALTER TABLE `table_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `table_seats`
--
ALTER TABLE `table_seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD UNIQUE KEY `seat_number` (`seat_number`);

--
-- Indexes for table `table_students`
--
ALTER TABLE `table_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `table_study_logs`
--
ALTER TABLE `table_study_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `table_s_notifications`
--
ALTER TABLE `table_s_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_time_logs`
--
ALTER TABLE `table_time_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_admins`
--
ALTER TABLE `table_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_bookings`
--
ALTER TABLE `table_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `table_feedback`
--
ALTER TABLE `table_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `table_messages`
--
ALTER TABLE `table_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_notifications`
--
ALTER TABLE `table_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `table_parents`
--
ALTER TABLE `table_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_payments`
--
ALTER TABLE `table_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `table_profile_photos`
--
ALTER TABLE `table_profile_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_reports`
--
ALTER TABLE `table_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_seats`
--
ALTER TABLE `table_seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `table_students`
--
ALTER TABLE `table_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `table_study_logs`
--
ALTER TABLE `table_study_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_s_notifications`
--
ALTER TABLE `table_s_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_time_logs`
--
ALTER TABLE `table_time_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_bookings`
--
ALTER TABLE `table_bookings`
  ADD CONSTRAINT `fk_seat_id` FOREIGN KEY (`seat_id`) REFERENCES `table_seats` (`seat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_id`) REFERENCES `table_students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `table_bookings_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `table_seats` (`seat_id`) ON DELETE CASCADE;

--
-- Constraints for table `table_feedback`
--
ALTER TABLE `table_feedback`
  ADD CONSTRAINT `fk_feedback_student` FOREIGN KEY (`student_id`) REFERENCES `table_students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `table_messages`
--
ALTER TABLE `table_messages`
  ADD CONSTRAINT `table_messages_ibfk_1` FOREIGN KEY (`feedback_id`) REFERENCES `table_feedback` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `table_parents`
--
ALTER TABLE `table_parents`
  ADD CONSTRAINT `table_parents_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `table_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `table_payments`
--
ALTER TABLE `table_payments`
  ADD CONSTRAINT `fk_booking` FOREIGN KEY (`booking_id`) REFERENCES `table_bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payment_booking` FOREIGN KEY (`booking_id`) REFERENCES `table_bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payment_student` FOREIGN KEY (`student_id`) REFERENCES `table_students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payments_booking` FOREIGN KEY (`booking_id`) REFERENCES `table_bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payments_student` FOREIGN KEY (`student_id`) REFERENCES `table_students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `table_profile_photos`
--
ALTER TABLE `table_profile_photos`
  ADD CONSTRAINT `table_profile_photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `table_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `table_reports`
--
ALTER TABLE `table_reports`
  ADD CONSTRAINT `table_reports_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `table_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `table_study_logs`
--
ALTER TABLE `table_study_logs`
  ADD CONSTRAINT `table_study_logs_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `table_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `table_time_logs`
--
ALTER TABLE `table_time_logs`
  ADD CONSTRAINT `table_time_logs_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `table_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
