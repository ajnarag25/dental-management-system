-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 07:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ismiledentalcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_duration` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `exp_con` varchar(3) NOT NULL,
  `exp_inv` varchar(3) NOT NULL,
  `exp_mon` varchar(3) NOT NULL,
  `fever` varchar(3) NOT NULL,
  `sore_throat` varchar(3) NOT NULL,
  `runny_nose` varchar(3) NOT NULL,
  `cough` varchar(3) NOT NULL,
  `diff_breath` varchar(3) NOT NULL,
  `nausea` varchar(3) NOT NULL,
  `body_ache` varchar(3) NOT NULL,
  `diarrhea` varchar(3) NOT NULL,
  `loss_smell` varchar(3) NOT NULL,
  `loss_taste` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `patient`, `appointment_date`, `start_time`, `end_time`, `service_name`, `service_duration`, `description`, `status`, `exp_con`, `exp_inv`, `exp_mon`, `fever`, `sore_throat`, `runny_nose`, `cough`, `diff_breath`, `nausea`, `body_ache`, `diarrhea`, `loss_smell`, `loss_taste`) VALUES
(1, 7, '', '2023-04-12', '23:00:00', '23:30:00', 'Fillings', 30, 'sample', 'concluded', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 22, '', '2023-04-19', '23:09:00', '23:39:00', 'Fillings', 30, 'asdasdf', 'reject', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 16, '', '2023-04-12', '23:08:00', '00:08:00', 'Jacket Crown', 60, 'asdasdasd', 'concluded', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 7, '', '2023-04-12', '23:12:00', '00:12:00', 'Check-up', 60, 'asdsdf', 'concluded', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 7, '', '2023-05-10', '20:21:00', '20:51:00', 'Check-up', 30, 'asas', 'reject', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'),
(6, 7, '', '2023-04-07', '00:52:00', '01:22:00', 'Check-up', 30, 'asasas', 'concluded', 'no', 'yes', 'no', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no'),
(7, 7, '', '2023-05-01', '09:30:00', '10:00:00', 'Check-up', 30, 'sasasasqwq', 'concluded', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no'),
(8, 7, '', '2023-05-12', '09:30:00', '10:00:00', 'Sealant', 30, 'ahhaahahah', 'concluded', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no'),
(10, 31, '', '2023-05-12', '10:00:00', '10:30:00', 'Check-up', 30, 'Fever', 'concluded', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no'),
(11, 31, '', '2023-05-12', '11:00:00', '11:45:00', 'Pulpotomy', 45, 'Fever', 'approved', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'),
(12, 32, '', '2023-05-11', '09:45:00', '10:15:00', 'Check-up', 30, 'Fever', 'pending', 'yes', 'yes', 'yes', 'yes', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'),
(15, 32, 'Juan Dela Cruz', '2023-05-10', '09:15:00', '09:45:00', 'Fillings', 30, 'asdawqe', 'approved', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no'),
(16, 16, 'Jasonsss Emman Magtibay', '2023-05-13', '09:30:00', '10:00:00', 'Check-up', 30, 'qwe123', 'approved', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'),
(17, 7, 'Dannah Kathreens Domingo', '2023-05-12', '09:00:00', '09:30:00', 'Check-up', 30, 'aa', 'pending', 'yes', 'yes', 'no', 'yes', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'),
(18, 7, 'Dannah Kathreens Domingo', '2023-05-13', '09:00:00', '09:30:00', 'Check-up', 30, 'asdawqe', 'approved', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `procedure_id` varchar(10) NOT NULL,
  `procedure_name` varchar(50) NOT NULL,
  `procedure_legend` varchar(50) NOT NULL,
  `procedure_duration` int(11) NOT NULL DEFAULT 0,
  `procedure_price` double(8,2) NOT NULL,
  `procedure_desc` varchar(155) NOT NULL,
  `procedure_activeness` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`procedure_id`, `procedure_name`, `procedure_legend`, `procedure_duration`, `procedure_price`, `procedure_desc`, `procedure_activeness`) VALUES
('CHE', 'Check-up', '#9c3a3a', 30, 500.00, 'A routine dental examination to identify any issues or concerns with oral health', 'active'),
('FIL', 'Fillings', '#940000', 30, 1000.00, 'Filling the Crown', 'active'),
('JAC', 'Jacket Crown', '#dff53d', 60, 7000.00, 'Also known as a full-coverage crown, it is a dental restoration that covers the entire visible surface of a tooth.', 'inactive'),
('ORP', 'Oral Prophylaxis', '#c689c8', 30, 1000.00, 'A teeth cleaning procedure that involves removing plaque, tartar, and stains froA teeth cleaning procedure that involves removing plaque, tartar, and stain', 'inactive'),
('PUL', 'Pulpotomy', '#77f434', 45, 4000.00, 'N/A', 'active'),
('RCT', 'Root Canal Therapy', '#ff5252', 90, 7000.00, 'A dental procedure that involves removing the infected or damaged pulp from a tooth and filling the resulting space with a material to restore its function', 'inactive'),
('SEA', 'Sealant', '#a9dbe5', 60, 500.00, 'A thin, protective coating applied to the chewing surfaces of the back teeth to prevent cavities.', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profilepicture` varchar(150) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactno` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `activation_code` varchar(250) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profilepicture`, `firstname`, `middlename`, `lastname`, `birthday`, `gender`, `occupation`, `email`, `contactno`, `province`, `address`, `password`, `role`, `active`, `activation_code`, `state`) VALUES
(7, '7.jpg', 'Dannah', 'Kathreens', 'Domingo', '2017-03-02', 'Female', 'NONE', 'andreadomingo@gmail.com', '09123456789', 'Metro Manila', 'Pasig Cityyyy', 'd0d1e74e6cd427f94226726f272b6e2a5844049a', 'patient', 1, '97d33bc2d655ef3d60e1b44cd363bbff8d6d01ac', 'active'),
(15, '15.jpg', 'Simon', 'John', ' Baquiran', '2023-03-23', 'Male', 'None', 'simonbaquiran@gmail.com', '09123456789', 'Metro Manila', 'Manila City', '317ff6b62ffded94f9ebcd7aedb29efb9fbed043', 'assistant', 1, '97d33bc2d655ef3d60e1b44cd363bbff8d6d01ac', 'active'),
(16, '16.jpg', 'Jasonsss', 'Emman', 'Magtibay', '2001-06-13', 'Male', 'None', 'jasonmagtibay@gmail.com', '09455776246', 'Metro Manila', 'Bernal Street', '6462815e0c25104da8f50bf4ca5100892298b8e7', 'patient', 1, '97d33bc2d655ef3d60e1b44cd363bbff8d6d01ac', 'active'),
(17, '17.jpg', 'Charmss', 'Charizard', 'Charot', '2023-03-02', 'Female', 'None', 'wonderts2022@gmail.com', '09121741231', 'Sta Maria', 'Metro Manila', '6462815e0c25104da8f50bf4ca5100892298b8e7', 'admin', 1, '3a7674b3aff1f9c7564b452d9f14a7645d3dd690', 'active'),
(22, '22.jpg', 'oscar', 'oscar', 'oscar', '2023-04-01', 'Male', 'oscar', 'oscar@gmail.com', '12121212121212', 'oscar', 'oscar', '9bc41f0334da263e4e2be710f91f5cbc718418a5', 'patient', 1, '8eb48c9464cfd77c4424c911754ead22f88e3ffe', 'active'),
(28, NULL, 'jose', 'jose', 'jose', '2013-02-28', 'Male', 'secret', 'josejose@gmail.com', '09123713812', 'taguig', 'Philippines', '2b37c0e561a2f7792dc38177d86504793501d0cf', 'patient', 0, 'd966dfbf467a6540abe330b965ec40b504155906', 'active'),
(29, '29.png', 'emman', 'emman', 'emman', '2013-03-30', 'Male', 'IT', 'emman@gmail.com', '09217892172', 'Cebu', 'Philippines', '0b68d8fb5479402e4371ef02b241b7ee66aa781a', 'patient', 0, 'af0ecbc8f35d273b3bf29a5478d76b01f3b2a33f', 'active'),
(30, NULL, 'joejoe', 'joejoe', 'joejoe', '2019-07-10', 'Male', 'N/A', 'joejoe@gmail.com', '09125647281', 'Bulacan', '19210 Joe Street', '517df3d2ad1ea1bbf0f6d5a12d131c77acf9e4c8', 'patient', 0, 'fac53546ce35b9e847c0cdf20dc4fc59a60808a5', 'active'),
(31, NULL, 'example', 'example', 'example', '2023-05-03', 'Male', 'example', 'example@gmail.com', '12121212111', 'example', 'example', 'aac88818609b6a90df7d1955eb81e368c6994145', 'patient', 0, '5d59f22ef88d9b6351d529e5c2c23156fdf3ba45', 'active'),
(32, NULL, 'Juan', 'Dela', 'Cruz', '1999-08-25', 'Male', 'Engineer', 'juandelacruz@gmail.com', '09089637505', 'Cavite', 'Cavite, 1109, Bacoor Molino', '79b44418bbc5066f56d0084e5df823465cdaea86', 'patient', 1, 'ba431e459d979cb6a2efea261c43f536d839dcc6', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`procedure_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
