-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 07:58 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coda`
--

-- --------------------------------------------------------

--
-- Table structure for table `coda_data`
--

CREATE TABLE `coda_data` (
  `id` int(11) NOT NULL,
  `c_date` date DEFAULT NULL,
  `timezone_type` varchar(255) DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bic` varchar(255) DEFAULT NULL,
  `comp_id_no` int(25) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `initial_balance` double DEFAULT NULL,
  `new_balance` double DEFAULT NULL,
  `info_msg` text DEFAULT NULL,
  `transaction_details` text NOT NULL,
  `uploaded_at` date NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coda_data`
--

INSERT INTO `coda_data` (`id`, `c_date`, `timezone_type`, `timezone`, `name`, `bic`, `comp_id_no`, `mobile_no`, `currency_code`, `country_code`, `amount`, `initial_balance`, `new_balance`, `info_msg`, `transaction_details`, `uploaded_at`, `status`) VALUES
(1, '2021-02-15', NULL, NULL, 'FERIRE PASCAL', 'KREDBEBBXXX', NULL, 'BE92734038743223', 'EUR', NULL, 100, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(2, '2021-02-15', NULL, NULL, 'DHR. ERNEST EDWARDS', 'NICABEBB', NULL, 'BE49850887217871', 'EUR', NULL, 100, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(3, '2021-02-15', NULL, NULL, 'MME MARIETTE PESSER', 'NICABEBB', NULL, 'BE69850847661978', 'EUR', NULL, 50, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(4, '2021-02-15', NULL, NULL, 'M EDOUARD NIFFLE', 'BBRUBEBB', NULL, 'BE11363137469248', 'EUR', NULL, 20, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(5, '2021-02-15', NULL, NULL, 'DOUTREWE JEAN', 'GEBABEBB', NULL, 'BE12240057316492', 'EUR', NULL, 20, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(6, '2021-02-15', NULL, NULL, 'DE SMEDT-STAS', 'GEBABEBB', NULL, 'BE44001142179545', 'EUR', NULL, 15, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(7, '2021-02-15', NULL, NULL, 'MME ADELE LARSILLE', 'GEBABEBB', NULL, 'BE41210012023810', 'EUR', NULL, 5, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(8, '2021-02-15', NULL, NULL, 'MME ROSANE BULLMAN', 'BBRUBEBB', NULL, 'BE07310082283166', 'EUR', NULL, 3.5, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(9, '2021-02-15', NULL, NULL, 'FERIRE PASCAL', 'KREDBEBBXXX', NULL, 'BE92734038743223', 'EUR', NULL, 100, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(10, '2021-02-15', NULL, NULL, 'DHR. ERNEST EDWARDS', 'NICABEBB', NULL, 'BE49850887217871', 'EUR', NULL, 100, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(11, '2021-02-15', NULL, NULL, 'MME MARIETTE PESSER', 'NICABEBB', NULL, 'BE69850847661978', 'EUR', NULL, 50, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(12, '2021-02-15', NULL, NULL, 'M EDOUARD NIFFLE', 'BBRUBEBB', NULL, 'BE11363137469248', 'EUR', NULL, 20, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(13, '2021-02-15', NULL, NULL, 'DOUTREWE JEAN', 'GEBABEBB', NULL, 'BE12240057316492', 'EUR', NULL, 20, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(14, '2021-02-15', NULL, NULL, 'DE SMEDT-STAS', 'GEBABEBB', NULL, 'BE44001142179545', 'EUR', NULL, 15, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(15, '2021-02-15', NULL, NULL, 'MME ADELE LARSILLE', 'GEBABEBB', NULL, 'BE41210012023810', 'EUR', NULL, 5, 139142.22, 139455.72, NULL, '', '2021-09-08', '1'),
(16, '2021-02-15', NULL, NULL, 'MME ROSANE BULLMAN', 'BBRUBEBB', NULL, 'BE07310082283166', 'EUR', NULL, 3.5, 139142.22, 139455.72, NULL, '', '2021-09-08', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coda_data`
--
ALTER TABLE `coda_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coda_data`
--
ALTER TABLE `coda_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
