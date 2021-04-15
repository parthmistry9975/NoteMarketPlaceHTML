-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2021 at 03:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes_market_place`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CountryCode` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ID`, `Name`, `CountryCode`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Australia', '+61', '2021-03-02 15:09:48', 99, '2021-04-09 21:34:55', 105, b'1'),
(2, 'Bangladesh', '+880', '2021-03-02 15:09:48', 105, NULL, NULL, b'1'),
(3, 'Canada', '+1', '2021-03-02 15:14:41', 99, NULL, NULL, b'1'),
(4, 'Egypt', '+20', '2021-03-02 15:14:41', 105, NULL, NULL, b'1'),
(5, 'France', '+33', '2021-03-02 15:14:41', 99, NULL, NULL, b'1'),
(6, 'India', '+91', '2021-03-02 15:14:41', 105, NULL, NULL, b'1'),
(7, 'Iran', '+98', '2021-03-02 15:14:41', 99, NULL, NULL, b'1'),
(8, 'Iraq', '+964', '2021-03-02 15:14:41', 105, NULL, NULL, b'1'),
(9, 'Italy', '+39', '2021-03-02 15:14:41', 99, NULL, NULL, b'1'),
(10, 'JAmaika', '+5326', '2021-04-09 20:54:04', 105, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `Seller` int(11) NOT NULL,
  `Downloader` int(11) NOT NULL,
  `IsSellerHasAllowedDownload` bit(1) NOT NULL,
  `AttachmentPath` varchar(800) DEFAULT NULL,
  `IsAttachmentDownloaded` bit(1) NOT NULL,
  `AttachmentDownloadedDate` datetime DEFAULT NULL,
  `IsPaid` bit(1) NOT NULL,
  `PurchasedPrice` decimal(10,0) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`ID`, `NoteID`, `Seller`, `Downloader`, `IsSellerHasAllowedDownload`, `AttachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(239, 97, 102, 103, b'1', '../upload/102/97/Attachment/Attachment_[0]_140421084924.pdf', b'1', '2021-04-15 15:04:44', b'0', '0', 'Environmental Studies', 'Civil', '2021-04-15 12:48:26', 103, '2021-04-15 15:04:44', 103),
(240, 97, 102, 103, b'1', '../upload/102/97/Attachment/Attachment_[1]_140421084924.pdf', b'1', '2021-04-15 15:04:44', b'0', '0', 'Environmental Studies', 'Civil', '2021-04-15 12:48:26', 103, '2021-04-15 15:04:44', 103),
(241, 129, 120, 103, b'1', '../upload/120/129/Attachment/Attachment_[0]_150421102219.pdf', b'1', '2021-04-15 15:16:20', b'0', '0', 'machine learning', 'IT', '2021-04-15 14:55:21', 103, '2021-04-15 15:16:20', 103),
(242, 127, 120, 103, b'1', '../upload/120/127/Attachment/Attachment_[0]_150421101747.pdf', b'0', NULL, b'1', '110', 'Indoor games', 'Sports', '2021-04-15 14:55:37', 103, NULL, NULL),
(243, 127, 120, 103, b'1', '../upload/120/127/Attachment/Attachment_[1]_150421101747.pdf', b'0', NULL, b'1', '110', 'Indoor games', 'Sports', '2021-04-15 14:55:37', 103, NULL, NULL),
(244, 125, 120, 103, b'0', NULL, b'0', NULL, b'1', '980', 'management of resources', 'MBA', '2021-04-15 14:58:29', 103, NULL, NULL),
(245, 124, 120, 103, b'1', '../upload/120/124/Attachment/Attachment_[0]_150421100713.pdf', b'1', '2021-04-15 14:59:02', b'0', '0', 'data analyics', 'CS', '2021-04-15 14:59:02', 103, NULL, NULL),
(246, 121, 120, 103, b'0', NULL, b'0', NULL, b'1', '450', 'TRADINGANALYSIS', 'CA', '2021-04-15 14:59:28', 103, NULL, NULL),
(247, 120, 120, 103, b'1', '../upload/120/120/Attachment/Attachment_[0]_150421094852.pdf', b'0', NULL, b'1', '675', 'Environmental Studies', 'Civil', '2021-04-15 14:59:56', 103, NULL, NULL),
(248, 106, 102, 103, b'1', '../upload/102/106/Attachment/Attachment_[0]_150421080150.pdf', b'0', NULL, b'1', '999', 'web devlopment', 'CS', '2021-04-15 15:00:28', 103, NULL, NULL),
(249, 106, 102, 103, b'1', '../upload/102/106/Attachment/Attachment_[1]_150421080150.pdf', b'0', NULL, b'1', '999', 'web devlopment', 'CS', '2021-04-15 15:00:28', 103, NULL, NULL),
(250, 105, 102, 103, b'1', '../upload/102/105/Attachment/Attachment_[0]_150421075901.pdf', b'1', '2021-04-15 15:01:26', b'0', '0', 'Python Flask Framework', 'CS', '2021-04-15 15:01:26', 103, NULL, NULL),
(251, 105, 102, 103, b'1', '../upload/102/105/Attachment/Attachment_[1]_150421075902.pdf', b'1', '2021-04-15 15:01:26', b'0', '0', 'Python Flask Framework', 'CS', '2021-04-15 15:01:26', 103, NULL, NULL),
(252, 101, 102, 103, b'1', '../upload/102/101/Attachment/Attachment_[0]_150421074623.pdf', b'1', '2021-04-15 15:02:24', b'0', '0', 'Android studio', 'IT', '2021-04-15 15:02:24', 103, NULL, NULL),
(253, 101, 102, 103, b'1', '../upload/102/101/Attachment/Attachment_[1]_150421074623.pdf', b'1', '2021-04-15 15:02:24', b'0', '0', 'Android studio', 'IT', '2021-04-15 15:02:24', 103, NULL, NULL),
(254, 103, 102, 103, b'1', '../upload/102/103/Attachment/Attachment_[0]_150421075429.pdf', b'1', '2021-04-15 15:03:11', b'0', '0', 'Python', 'IT', '2021-04-15 15:03:11', 103, NULL, NULL),
(255, 100, 102, 103, b'0', NULL, b'0', NULL, b'1', '256', 'Elements of CIVIL Engineering', 'Civil', '2021-04-15 15:03:18', 103, NULL, NULL),
(256, 99, 102, 103, b'1', '../upload/102/99/Attachment/Attachment_[0]_140421090029.pdf', b'1', '2021-04-15 15:03:51', b'0', '0', 'Elements of Mechanical Engineering', 'Mechanical', '2021-04-15 15:03:51', 103, NULL, NULL),
(257, 99, 102, 103, b'1', '../upload/102/99/Attachment/Attachment_[1]_140421090029.pdf', b'1', '2021-04-15 15:03:51', b'0', '0', 'Elements of Mechanical Engineering', 'Mechanical', '2021-04-15 15:03:51', 103, NULL, NULL),
(258, 98, 102, 103, b'0', NULL, b'0', NULL, b'1', '125', 'TRADING ANALYSIS', 'CA', '2021-04-15 15:04:05', 103, NULL, NULL),
(259, 129, 120, 102, b'1', '../upload/120/129/Attachment/Attachment_[0]_150421102219.pdf', b'1', '2021-04-15 15:06:23', b'0', '0', 'machine learning', 'IT', '2021-04-15 15:06:23', 102, NULL, NULL),
(260, 127, 120, 102, b'1', '../upload/120/127/Attachment/Attachment_[0]_150421101747.pdf', b'0', '2021-04-15 15:28:08', b'1', '110', 'Indoor games', 'Sports', '2021-04-15 15:06:31', 102, '2021-04-15 15:28:08', 102),
(261, 127, 120, 102, b'1', '../upload/120/127/Attachment/Attachment_[1]_150421101747.pdf', b'0', '2021-04-15 15:28:08', b'1', '110', 'Indoor games', 'Sports', '2021-04-15 15:06:31', 102, '2021-04-15 15:28:08', 102),
(262, 125, 120, 102, b'1', '../upload/120/125/Attachment/Attachment_[0]_150421100935.pdf', b'0', NULL, b'1', '980', 'management of resources', 'MBA', '2021-04-15 15:06:58', 102, NULL, NULL),
(263, 124, 120, 102, b'1', '../upload/120/124/Attachment/Attachment_[0]_150421100713.pdf', b'1', '2021-04-15 15:09:40', b'0', '0', 'data analyics', 'CS', '2021-04-15 15:09:40', 102, NULL, NULL),
(264, 121, 120, 102, b'1', '../upload/120/121/Attachment/Attachment_[0]_150421095545.pdf', b'0', NULL, b'1', '450', 'TRADINGANALYSIS', 'CA', '2021-04-15 15:09:48', 102, NULL, NULL),
(265, 120, 120, 102, b'0', NULL, b'0', NULL, b'1', '675', 'Environmental Studies', 'Civil', '2021-04-15 15:10:22', 102, NULL, NULL),
(266, 112, 103, 102, b'1', '../upload/103/112/Attachment/Attachment_[0]_150421083321.pdf', b'1', '2021-04-15 15:10:55', b'0', '0', 'data science', 'CS', '2021-04-15 15:10:55', 102, NULL, NULL),
(267, 112, 103, 102, b'1', '../upload/103/112/Attachment/Attachment_[1]_150421083321.pdf', b'1', '2021-04-15 15:10:55', b'0', '0', 'data science', 'CS', '2021-04-15 15:10:55', 102, NULL, NULL),
(268, 118, 103, 102, b'1', '../upload/103/118/Attachment/Attachment_[0]_150421084741.pdf', b'1', '2021-04-15 15:11:23', b'0', '0', 'road engineering', 'Civil', '2021-04-15 15:11:23', 102, NULL, NULL),
(269, 118, 103, 102, b'1', '../upload/103/118/Attachment/Attachment_[1]_150421084741.pdf', b'1', '2021-04-15 15:11:23', b'0', '0', 'road engineering', 'Civil', '2021-04-15 15:11:23', 102, NULL, NULL),
(270, 111, 103, 102, b'0', NULL, b'0', NULL, b'1', '653', 'Android studio lite', 'IT', '2021-04-15 15:11:43', 102, NULL, NULL),
(271, 111, 103, 102, b'0', NULL, b'0', NULL, b'1', '653', 'Android studio lite', 'IT', '2021-04-15 15:11:43', 102, NULL, NULL),
(272, 110, 103, 102, b'1', '../upload/103/110/Attachment/Attachment_[0]_150421082502.pdf', b'1', '2021-04-15 15:12:18', b'0', '0', 'TRADINGANALYSIS', 'CA', '2021-04-15 15:12:07', 102, '2021-04-15 15:12:18', 102),
(273, 110, 103, 102, b'1', '../upload/103/110/Attachment/Attachment_[1]_150421082503.pdf', b'1', '2021-04-15 15:12:18', b'0', '0', 'TRADINGANALYSIS', 'CA', '2021-04-15 15:12:07', 102, '2021-04-15 15:12:18', 102),
(274, 109, 103, 102, b'0', NULL, b'0', NULL, b'1', '550', 'Elements of Electrical Engineering', 'Electrical', '2021-04-15 15:12:44', 102, NULL, NULL),
(275, 109, 103, 102, b'0', NULL, b'0', NULL, b'1', '550', 'Elements of Electrical Engineering', 'Electrical', '2021-04-15 15:12:44', 102, NULL, NULL),
(276, 108, 103, 102, b'1', '../upload/103/108/Attachment/Attachment_[0]_150421081642.pdf', b'1', '2021-04-15 15:13:03', b'0', '0', 'Environmental Studies', 'Civil', '2021-04-15 15:13:03', 102, NULL, NULL),
(277, 112, 103, 120, b'1', '../upload/103/112/Attachment/Attachment_[0]_150421083321.pdf', b'1', '2021-04-15 15:20:25', b'0', '0', 'data science', 'CS', '2021-04-15 15:20:25', 120, NULL, NULL),
(278, 112, 103, 120, b'1', '../upload/103/112/Attachment/Attachment_[1]_150421083321.pdf', b'1', '2021-04-15 15:20:25', b'0', '0', 'data science', 'CS', '2021-04-15 15:20:25', 120, NULL, NULL),
(279, 118, 103, 120, b'1', '../upload/103/118/Attachment/Attachment_[0]_150421084741.pdf', b'1', '2021-04-15 15:20:34', b'0', '0', 'road engineering', 'Civil', '2021-04-15 15:20:34', 120, NULL, NULL),
(280, 118, 103, 120, b'1', '../upload/103/118/Attachment/Attachment_[1]_150421084741.pdf', b'1', '2021-04-15 15:20:34', b'0', '0', 'road engineering', 'Civil', '2021-04-15 15:20:34', 120, NULL, NULL),
(281, 111, 103, 120, b'0', NULL, b'0', NULL, b'1', '653', 'Android studio lite', 'IT', '2021-04-15 15:20:41', 120, NULL, NULL),
(282, 111, 103, 120, b'0', NULL, b'0', NULL, b'1', '653', 'Android studio lite', 'IT', '2021-04-15 15:20:41', 120, NULL, NULL),
(283, 110, 103, 120, b'1', '../upload/103/110/Attachment/Attachment_[0]_150421082502.pdf', b'1', '2021-04-15 15:21:25', b'0', '0', 'TRADINGANALYSIS', 'CA', '2021-04-15 15:21:25', 120, NULL, NULL),
(284, 110, 103, 120, b'1', '../upload/103/110/Attachment/Attachment_[1]_150421082503.pdf', b'1', '2021-04-15 15:21:25', b'0', '0', 'TRADINGANALYSIS', 'CA', '2021-04-15 15:21:25', 120, NULL, NULL),
(285, 109, 103, 120, b'1', '../upload/103/109/Attachment/Attachment_[0]_150421081843.pdf', b'0', NULL, b'1', '550', 'Elements of Electrical Engineering', 'Electrical', '2021-04-15 15:21:34', 120, NULL, NULL),
(286, 109, 103, 120, b'1', '../upload/103/109/Attachment/Attachment_[1]_150421081843.pdf', b'0', NULL, b'1', '550', 'Elements of Electrical Engineering', 'Electrical', '2021-04-15 15:21:34', 120, NULL, NULL),
(287, 106, 102, 120, b'1', '../upload/102/106/Attachment/Attachment_[0]_150421080150.pdf', b'0', NULL, b'1', '999', 'web devlopment', 'CS', '2021-04-15 15:22:15', 120, NULL, NULL),
(288, 106, 102, 120, b'1', '../upload/102/106/Attachment/Attachment_[1]_150421080150.pdf', b'0', NULL, b'1', '999', 'web devlopment', 'CS', '2021-04-15 15:22:15', 120, NULL, NULL),
(289, 105, 102, 120, b'1', '../upload/102/105/Attachment/Attachment_[0]_150421075901.pdf', b'1', '2021-04-15 15:22:49', b'0', '0', 'Python Flask Framework', 'CS', '2021-04-15 15:22:49', 120, NULL, NULL),
(290, 105, 102, 120, b'1', '../upload/102/105/Attachment/Attachment_[1]_150421075902.pdf', b'1', '2021-04-15 15:22:49', b'0', '0', 'Python Flask Framework', 'CS', '2021-04-15 15:22:49', 120, NULL, NULL),
(291, 101, 102, 120, b'1', '../upload/102/101/Attachment/Attachment_[0]_150421074623.pdf', b'1', '2021-04-15 15:23:05', b'0', '0', 'Android studio', 'IT', '2021-04-15 15:23:05', 120, NULL, NULL),
(292, 101, 102, 120, b'1', '../upload/102/101/Attachment/Attachment_[1]_150421074623.pdf', b'1', '2021-04-15 15:23:05', b'0', '0', 'Android studio', 'IT', '2021-04-15 15:23:05', 120, NULL, NULL),
(293, 108, 103, 120, b'1', '../upload/103/108/Attachment/Attachment_[0]_150421081642.pdf', b'1', '2021-04-15 15:23:16', b'0', '0', 'Environmental Studies', 'Civil', '2021-04-15 15:23:16', 120, NULL, NULL),
(294, 103, 102, 120, b'1', '../upload/102/103/Attachment/Attachment_[0]_150421075429.pdf', b'1', '2021-04-15 15:23:33', b'0', '0', 'Python', 'IT', '2021-04-15 15:23:33', 120, NULL, NULL),
(295, 100, 102, 120, b'0', NULL, b'0', NULL, b'1', '256', 'Elements of CIVIL Engineering', 'Civil', '2021-04-15 15:23:41', 120, NULL, NULL),
(296, 99, 102, 120, b'1', '../upload/102/99/Attachment/Attachment_[0]_140421090029.pdf', b'1', '2021-04-15 15:24:14', b'0', '0', 'Elements of Mechanical Engineering', 'Mechanical', '2021-04-15 15:24:14', 120, NULL, NULL),
(297, 99, 102, 120, b'1', '../upload/102/99/Attachment/Attachment_[1]_140421090029.pdf', b'1', '2021-04-15 15:24:14', b'0', '0', 'Elements of Mechanical Engineering', 'Mechanical', '2021-04-15 15:24:14', 120, NULL, NULL),
(298, 98, 102, 120, b'0', NULL, b'0', NULL, b'1', '125', 'TRADING ANALYSIS', 'CA', '2021-04-15 15:24:31', 120, NULL, NULL),
(299, 97, 102, 120, b'1', '../upload/102/97/Attachment/Attachment_[0]_140421084924.pdf', b'1', '2021-04-15 15:24:58', b'0', '0', 'Environmental Studies', 'Civil', '2021-04-15 15:24:58', 120, NULL, NULL),
(300, 97, 102, 120, b'1', '../upload/102/97/Attachment/Attachment_[1]_140421084924.pdf', b'1', '2021-04-15 15:24:58', b'0', '0', 'Environmental Studies', 'Civil', '2021-04-15 15:24:58', 120, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `note_categories`
--

CREATE TABLE `note_categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(800) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note_categories`
--

INSERT INTO `note_categories` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'IT', 'Information technology (IT)', '2021-03-02 15:47:09', 99, '2021-04-14 19:33:04', 105, b'1'),
(2, 'CA', 'Chartered Accountant', '2021-03-02 15:47:09', 99, NULL, NULL, b'1'),
(3, 'CS', 'computer science', '2021-03-02 15:47:09', 99, NULL, NULL, b'1'),
(4, 'MBA', 'masters of business administration', '2021-03-02 15:47:09', 99, NULL, NULL, b'1'),
(5, 'Mechanical', 'Mechanical ', '2021-03-02 15:50:01', 99, NULL, NULL, b'1'),
(6, 'Civil', 'Civil ', '2021-03-02 15:50:01', 99, NULL, NULL, b'1'),
(7, 'Electrical', 'Electrical ', '2021-03-02 15:50:01', 105, NULL, NULL, b'1'),
(8, 'Sports', 'sports \r\n', '2021-04-09 18:51:33', 105, '2021-04-14 19:33:22', 105, b'1'),
(9, 'default', 'default', '2021-04-12 18:33:01', 105, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `note_types`
--

CREATE TABLE `note_types` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(800) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note_types`
--

INSERT INTO `note_types` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Handwritten', 'handwritten content.', '2021-03-02 15:52:47', 99, '2021-04-14 20:31:36', 105, b'1'),
(2, 'University notes', 'University Published', '2021-03-02 15:57:57', 105, NULL, NULL, b'1'),
(3, 'Novel', 'Novel By writter', '2021-03-02 15:57:57', 105, NULL, NULL, b'1'),
(4, 'Story book', 'story book', '2021-03-02 15:57:57', 105, NULL, NULL, b'1'),
(5, 'printed notes', 'printed note', '2021-04-09 22:25:03', 105, NULL, NULL, b'1'),
(6, 'default', 'default', '2021-04-12 18:32:35', 99, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `reference_data`
--

CREATE TABLE `reference_data` (
  `ID` int(11) NOT NULL,
  `Value` varchar(100) NOT NULL,
  `DataValue` varchar(100) NOT NULL,
  `RefCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reference_data`
--

INSERT INTO `reference_data` (`ID`, `Value`, `DataValue`, `RefCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Male', 'M', 'Gender', '2021-02-25 21:39:47', 1, '2021-02-25 21:39:47', 1, b'1'),
(2, 'Female', 'Fe', 'Gender', '2021-02-25 21:40:44', 1, '2021-02-25 21:40:44', 1, b'1'),
(3, 'Unknown', 'U', 'Gender', '2021-02-25 21:41:23', 1, '2021-02-25 21:41:23', 1, b'1'),
(4, 'Paid', 'P', 'Selling Mode', '2021-02-25 21:42:24', 1, '2021-02-25 21:42:24', 1, b'1'),
(5, 'Free', 'F', 'Selling Mode', '2021-02-25 21:43:21', 1, '2021-02-25 21:43:21', 1, b'1'),
(6, 'Draft\r\n', 'Draft\r\n', 'Notes Status\r\n', '2021-02-25 21:44:46', 1, '2021-02-25 21:44:46', 1, b'1'),
(7, 'Submitted For Review\r\n', 'Submitted For Review\r\n', 'Notes Status\r\n', '2021-02-25 21:44:46', 1, '2021-02-25 21:44:46', 1, b'1'),
(8, 'In Review \r\n', 'In Review \r\n', 'Notes Status\r\n', '2021-02-25 21:48:08', 1, '2021-02-25 21:48:08', 1, b'1'),
(9, 'Published \r\n', 'Approved\r\n', 'Notes Status\r\n', '2021-02-25 21:48:08', 1, '2021-02-25 21:48:08', 1, b'1'),
(10, 'Rejected\r\n', 'Rejected\r\n', 'Notes Status\r\n', '2021-02-25 21:50:11', 1, '2021-02-25 21:50:11', 1, b'1'),
(11, 'Removed \r\n', 'Removed \r\n', 'Notes Status\r\n', '2021-02-25 22:11:21', 1, '2021-02-25 22:11:21', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `seller_notes`
--

CREATE TABLE `seller_notes` (
  `ID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `ActionedBy` int(11) DEFAULT NULL,
  `AdminRemarks` varchar(500) DEFAULT NULL,
  `PublishedDate` datetime DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `Category` int(11) NOT NULL,
  `DisplayPicture` varchar(500) DEFAULT NULL,
  `NoteType` int(11) DEFAULT NULL,
  `NumberofPages` int(11) DEFAULT NULL,
  `Description` varchar(500) NOT NULL,
  `UniversityName` varchar(200) DEFAULT NULL,
  `Country` int(11) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `CourseCode` varchar(100) DEFAULT NULL,
  `Professor` varchar(100) DEFAULT NULL,
  `IsPaid` bit(1) NOT NULL,
  `SellingPrice` decimal(10,0) DEFAULT NULL,
  `NotesPreview` varchar(500) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_notes`
--

INSERT INTO `seller_notes` (`ID`, `SellerID`, `Status`, `ActionedBy`, `AdminRemarks`, `PublishedDate`, `Title`, `Category`, `DisplayPicture`, `NoteType`, `NumberofPages`, `Description`, `UniversityName`, `Country`, `Course`, `CourseCode`, `Professor`, `IsPaid`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(97, 102, 9, 105, NULL, '2021-04-15 00:37:01', 'Environmental Studies', 6, 'bp_140421084923.jpg', 2, 1235, 'about natural patterns', 'LJIET', 4, 'BE', '51515', 'L P JIMMY', b'0', '0', 'preview_140421084923.pdf', '2021-04-15 00:19:23', 102, '2021-04-15 00:37:01', 105, b'1'),
(98, 102, 9, 105, NULL, '2021-04-15 00:37:12', 'TRADING ANALYSIS', 2, 'bp_140421085546.png', 1, 12112, 'about analysis', 'LJIET', 6, 'ME', '54512', 'J p punjabi', b'1', '125', 'preview_140421085546.pdf', '2021-04-15 00:25:46', 102, '2021-04-15 00:37:12', 105, b'1'),
(99, 102, 9, 105, NULL, '2021-04-15 00:37:18', 'Elements of Mechanical Engineering', 5, 'bp_140421090029.jpg', 2, 2364, 'about fundamentals of mechancial department', 'UNI OF TORONTO', 3, 'PGD', '45454', 'P J LIUES', b'0', '0', 'preview_140421090029.pdf', '2021-04-15 00:30:29', 102, '2021-04-15 00:37:18', 105, b'1'),
(100, 102, 9, 105, NULL, '2021-04-15 00:38:21', 'Elements of CIVIL Engineering', 6, 'bp_140421090245.jpg', 5, 543, 'about civil fundamentals', 'LAMBTON', 2, 'DIPLOMA', '85955', 'L K AGRAWAL', b'1', '256', 'preview_140421090245.pdf', '2021-04-15 00:32:45', 102, '2021-04-15 00:38:21', 105, b'1'),
(101, 102, 9, 105, NULL, '2021-04-15 12:21:21', 'Android studio', 1, 'bp_150421074622.jpg', 5, 65626, 'About Android Studio detailed understanding and learning', 'Uni Of Windsor', 6, 'BE', '85955', 'K S PAtel', b'0', '0', 'preview_150421074622.pdf', '2021-04-15 11:16:22', 102, '2021-04-15 12:21:21', 105, b'1'),
(102, 102, 8, 105, NULL, NULL, 'PHP Basic', 3, 'bp_150421075231.png', 2, 12112, 'about basic structure and patterns of php', 'LAMBTON College', 3, 'ME', '123566', 'P J LIUES', b'1', '2653', 'preview_150421075231.pdf', '2021-04-15 11:22:31', 102, '2021-04-15 11:39:05', 105, b'1'),
(103, 102, 9, 105, NULL, '2021-04-15 11:39:18', 'Python', 1, 'bp_150421075429.jpg', 2, 4555, 'about python basics ', 'Uni Of Windsor', 4, 'DIPLOMA', '51515', 'L P JIMMY', b'0', '0', 'preview_150421075429.pdf', '2021-04-15 11:24:29', 102, '2021-04-15 11:39:18', 105, b'1'),
(104, 102, 10, 99, 'not proper', NULL, 'Elements of Electrical Engineering', 7, 'bp_150421075625.png', 2, 2364, 'about bsics of electrical', 'UNI OF TORONTO', 4, 'ME', '5656', 'P J LIUES', b'1', '650', 'preview_150421075625.pdf', '2021-04-15 11:26:25', 102, '2021-04-15 16:21:42', 99, b'1'),
(105, 102, 9, 105, NULL, '2021-04-15 12:21:29', 'Python Flask Framework', 3, 'bp_150421075901.png', 3, 2364, 'ABOUT FLASK STURUCTURE AND FUNCTIONALITY', 'LAMBTON', 7, 'BE', '5656', 'P J LIUES', b'0', '0', 'preview_150421075901.pdf', '2021-04-15 11:29:01', 102, '2021-04-15 12:21:29', 105, b'1'),
(106, 102, 9, 105, NULL, '2021-04-15 12:21:35', 'web devlopment', 3, 'bp_150421080150.png', 1, 12112, 'about web devlopment', 'Uni Of Windsor', 5, 'PGD', '85955', 'J p punjabi', b'1', '999', 'preview_150421080150.pdf', '2021-04-15 11:31:50', 102, '2021-04-15 12:21:35', 105, b'1'),
(107, 102, 7, 102, NULL, NULL, 'java devlopment', 3, 'bp_150421080429.png', 2, 2364, 'about java devlopment', 'UNI OF TORONTO', 3, 'DIPLOMA', '54512', 'J p punjabi', b'0', '0', 'preview_150421080429.pdf', '2021-04-15 11:34:29', 102, NULL, 102, b'1'),
(108, 103, 9, 105, NULL, '2021-04-15 12:21:12', 'Environmental Studies', 6, 'bp_150421081642.jpg', 1, 2364, 'about nature patterns', 'LAMBTON College', 6, 'BE', '85955', 'L P JIMMY', b'0', '0', 'preview_150421081642.pdf', '2021-04-15 11:46:42', 103, '2021-04-15 12:21:12', 105, b'1'),
(109, 103, 9, 105, NULL, '2021-04-15 12:22:21', 'Elements of Electrical Engineering', 7, '', 4, 543, 'about electrical studies', 'LAMBTON College', 6, 'BE', '54512', 'J p punjabi', b'1', '550', 'preview_150421081843.pdf', '2021-04-15 11:48:43', 103, '2021-04-15 12:22:21', 105, b'1'),
(110, 103, 9, 105, NULL, '2021-04-15 12:22:59', 'TRADINGANALYSIS', 2, 'bp_150421082502.jpg', 1, 12112, 'about analysis', 'UNI OF TORONTO', 3, 'PGD', '54512', 'L P JIMMY', b'0', '0', 'preview_150421082502.pdf', '2021-04-15 11:55:02', 103, '2021-04-15 12:22:59', 105, b'1'),
(111, 103, 11, 99, 'not proper', '2021-04-15 12:23:09', 'Android studio lite', 1, 'bp_150421082818.jpg', 5, 5444, 'about whole android studio', 'uni of iran', 7, 'BE', '85955', 'L P JIMMY', b'1', '653', 'preview_150421082818.pdf', '2021-04-15 11:58:18', 103, '2021-04-15 19:10:47', 99, b'1'),
(112, 103, 9, 105, NULL, '2021-04-15 12:23:58', 'data science', 3, 'bp_150421083321.jpg', 1, 123, 'about data science basics', 'UNI OF TORONTO', 1, 'PGD', '85955', 'J p punjabi', b'0', '0', 'preview_150421083321.pdf', '2021-04-15 12:03:21', 103, '2021-04-15 12:23:58', 105, b'1'),
(113, 103, 7, 103, NULL, NULL, 'Elements of CIVIL Engineering', 6, '', 2, 1235, 'about civil infrasturucture', 'LAMBTON', 3, 'BE', '5656', 'L P JIMMY', b'1', '542', 'preview_150421083610.pdf', '2021-04-15 12:06:10', 103, NULL, 103, b'1'),
(114, 103, 10, 99, 'not proper', NULL, 'Elements of Mechanical ', 5, 'bp_150421083908.png', 2, 2364, 'about mechanical basics', 'UNI OF TORONTO', 3, '', '51515', 'L P JIMMY', b'0', '0', 'preview_150421083908.pdf', '2021-04-15 12:09:08', 103, '2021-04-15 16:22:25', 99, b'1'),
(115, 103, 7, 103, NULL, NULL, 'python', 1, '', 1, 543, 'about python basics', 'uni of iran', 7, 'PGD', '85955', 'P J LIUES', b'1', '459', 'preview_150421084110.pdf', '2021-04-15 12:11:10', 103, NULL, 103, b'1'),
(116, 103, 10, 99, 'not proper', NULL, 'Auto Engine', 5, 'bp_150421084344.png', 2, 12112, 'about engine of different kind', 'uni of iran', 7, 'ME', '51515', 'L P JIMMY', b'0', '0', 'preview_150421084344.pdf', '2021-04-15 12:13:44', 103, '2021-04-15 16:22:10', 99, b'1'),
(117, 103, 7, 103, NULL, NULL, '.net architecture', 3, '', 2, 1235, 'about .net structure', 'LAMBTON', 7, 'PGD', '85955', 'J p punjabi', b'1', '850', 'preview_150421084527.pdf', '2021-04-15 12:15:27', 103, NULL, 103, b'1'),
(118, 103, 9, 105, NULL, '2021-04-15 12:23:25', 'road engineering', 6, 'bp_150421084741.png', 3, 2364, 'about road structure', 'LAMBTON College', 4, 'PGD', '51515', 'J p punjabi', b'0', '0', 'preview_150421084741.pdf', '2021-04-15 12:17:41', 103, '2021-04-15 12:23:25', 105, b'1'),
(119, 103, 6, 103, NULL, NULL, 'artificial intellegence', 3, 'bp_150421085028.png', 2, 543, 'about basics of artificial intellegence', 'IIT,Bombay', 6, 'ME', '54512', 'J p punjabi', b'1', '5500', 'preview_150421085028.pdf', '2021-04-15 12:20:28', 103, NULL, 103, b'1'),
(120, 120, 9, 99, NULL, '2021-04-15 14:03:12', 'Environmental Studies', 6, '', 1, 1235, 'about environment patterns', 'LAMBTON', 4, 'DIPLOMA', '52326', 'P J LIUES', b'1', '675', 'preview_150421094852.pdf', '2021-04-15 13:18:52', 120, '2021-04-15 14:03:12', 99, b'1'),
(121, 120, 9, 99, NULL, '2021-04-15 14:03:33', 'TRADINGANALYSIS', 2, 'bp_150421095545.jpg', 2, 2364, 'about technical analysis of stock market', 'LJIET', 2, 'DIPLOMA', '85955', 'L P JIMMY', b'1', '450', 'preview_150421095545.pdf', '2021-04-15 13:25:45', 120, '2021-04-15 14:03:33', 99, b'1'),
(124, 120, 9, 99, NULL, '2021-04-15 14:04:03', 'data analyics', 3, 'bp_150421100713.jpg', 1, 1235, 'about data visulization , data processing ,and many libraries like PANDAS , MATPLOTLIB etc.', 'Uni Of Windsor', 5, 'BE', '54512', 'P J LIUES', b'0', '0', 'preview_150421100713.pdf', '2021-04-15 13:37:13', 120, '2021-04-15 14:04:03', 99, b'1'),
(125, 120, 9, 99, NULL, '2021-04-15 14:04:18', 'management of resources', 4, 'bp_150421100935.png', 1, 1235, 'about management of resources', 'NIT', 6, 'BE', '5656', 'P J LIUES', b'1', '980', 'preview_150421100935.pdf', '2021-04-15 13:39:35', 120, '2021-04-15 14:04:18', 99, b'1'),
(126, 120, 6, 120, NULL, NULL, 'Elements of CIVIL', 6, '', 1, 2364, 'about civil elements', 'UNI OF TORONTO', 6, 'PGD', '5656', 'P J LIUES', b'0', '0', 'preview_150421101518.pdf', '2021-04-15 13:45:18', 120, NULL, 120, b'1'),
(127, 120, 9, 99, NULL, '2021-04-15 14:04:40', 'Indoor games', 8, 'bp_150421101747.png', 1, 1235, 'about games that can be play in side house and tricks', 'LJIET', 3, '', '', 'P J LIUES', b'1', '110', 'preview_150421101747.pdf', '2021-04-15 13:47:47', 120, '2021-04-15 14:04:40', 99, b'1'),
(128, 120, 10, 99, 'not proper', NULL, 'Elements of Electrical', 7, 'bp_150421102008.png', 2, 2364, 'about electrical components like transister , circuits and basics about them', 'uni of iran', 4, 'PGD', '54512', 'L P JIMMY', b'1', '1235', 'preview_150421102008.pdf', '2021-04-15 13:50:08', 120, '2021-04-15 16:20:44', 99, b'1'),
(129, 120, 9, 99, NULL, '2021-04-15 14:04:51', 'machine learning', 1, 'bp_150421102219.jpg', 2, 1235, 'about machine learning basics', 'UNI OF TORONTO', 3, 'PGD', '123', 'J p punjabi', b'0', '0', 'preview_150421102219.pdf', '2021-04-15 13:52:19', 120, '2021-04-15 14:04:51', 99, b'1'),
(130, 120, 10, 99, 'not proper', NULL, 'GST', 2, 'bp_150421102442.png', 2, 2364, 'about GST structure', 'uni of bangladesh', 2, 'PGD', '51515', 'j k  abrahim', b'1', '950', 'preview_150421102442.pdf', '2021-04-15 13:54:42', 120, '2021-04-15 16:20:19', 99, b'1'),
(131, 120, 8, 99, NULL, NULL, 'web devlopment with jS node', 1, 'bp_150421102639.png', 2, 12112, 'about js node frame work', 'UNI OF TORONTO', 4, 'BE', '51515', 'L P JIMMY', b'0', '0', 'preview_150421102639.pdf', '2021-04-15 13:56:39', 120, '2021-04-15 14:07:34', 99, b'1'),
(132, 120, 10, 99, 'not proper', NULL, 'python django', 1, '', 1, 1235, 'about django framework', 'IIT,Bombay', 6, 'BE', '85955', 'P J LIUES', b'1', '1560', 'preview_150421102840.pdf', '2021-04-15 13:58:40', 120, '2021-04-15 16:21:22', 99, b'1'),
(133, 120, 7, 120, NULL, NULL, 'Elements of Management', 4, 'bp_150421103053.jpg', 2, 2364, 'about elements of management', 'uni of iran', 4, 'BE', '51515', 'J p punjabi', b'0', '0', 'preview_150421103053.pdf', '2021-04-15 14:00:53', 120, NULL, 120, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `seller_notes_attachements`
--

CREATE TABLE `seller_notes_attachements` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  `FilePath` varchar(500) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_notes_attachements`
--

INSERT INTO `seller_notes_attachements` (`ID`, `NoteID`, `FileName`, `FilePath`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(113, 97, 'Attachment_[0]_140421084924.pdf', '../upload/102/97/Attachment/Attachment_[0]_140421084924.pdf', '2021-04-15 00:19:24', 102, NULL, 102, b'1'),
(114, 97, 'Attachment_[1]_140421084924.pdf', '../upload/102/97/Attachment/Attachment_[1]_140421084924.pdf', '2021-04-15 00:19:24', 102, NULL, 102, b'1'),
(115, 98, 'Attachment_[0]_140421085546.pdf', '../upload/102/98/Attachment/Attachment_[0]_140421085546.pdf', '2021-04-15 00:25:46', 102, NULL, 102, b'1'),
(116, 99, 'Attachment_[0]_140421090029.pdf', '../upload/102/99/Attachment/Attachment_[0]_140421090029.pdf', '2021-04-15 00:30:29', 102, NULL, 102, b'1'),
(117, 99, 'Attachment_[1]_140421090029.pdf', '../upload/102/99/Attachment/Attachment_[1]_140421090029.pdf', '2021-04-15 00:30:29', 102, NULL, 102, b'1'),
(118, 100, 'Attachment_[0]_140421090245.pdf', '../upload/102/100/Attachment/Attachment_[0]_140421090245.pdf', '2021-04-15 00:32:45', 102, NULL, 102, b'1'),
(119, 101, 'Attachment_[0]_150421074623.pdf', '../upload/102/101/Attachment/Attachment_[0]_150421074623.pdf', '2021-04-15 11:16:23', 102, NULL, 102, b'1'),
(120, 101, 'Attachment_[1]_150421074623.pdf', '../upload/102/101/Attachment/Attachment_[1]_150421074623.pdf', '2021-04-15 11:16:23', 102, NULL, 102, b'1'),
(121, 102, 'Attachment_[0]_150421075231.pdf', '../upload/102/102/Attachment/Attachment_[0]_150421075231.pdf', '2021-04-15 11:22:31', 102, NULL, 102, b'1'),
(122, 102, 'Attachment_[1]_150421075231.pdf', '../upload/102/102/Attachment/Attachment_[1]_150421075231.pdf', '2021-04-15 11:22:31', 102, NULL, 102, b'1'),
(123, 103, 'Attachment_[0]_150421075429.pdf', '../upload/102/103/Attachment/Attachment_[0]_150421075429.pdf', '2021-04-15 11:24:29', 102, NULL, 102, b'1'),
(124, 104, 'Attachment_[0]_150421075625.pdf', '../upload/102/104/Attachment/Attachment_[0]_150421075625.pdf', '2021-04-15 11:26:25', 102, NULL, 102, b'1'),
(125, 104, 'Attachment_[1]_150421075625.pdf', '../upload/102/104/Attachment/Attachment_[1]_150421075625.pdf', '2021-04-15 11:26:25', 102, NULL, 102, b'1'),
(126, 105, 'Attachment_[0]_150421075901.pdf', '../upload/102/105/Attachment/Attachment_[0]_150421075901.pdf', '2021-04-15 11:29:02', 102, NULL, 102, b'1'),
(127, 105, 'Attachment_[1]_150421075902.pdf', '../upload/102/105/Attachment/Attachment_[1]_150421075902.pdf', '2021-04-15 11:29:02', 102, NULL, 102, b'1'),
(128, 106, 'Attachment_[0]_150421080150.pdf', '../upload/102/106/Attachment/Attachment_[0]_150421080150.pdf', '2021-04-15 11:31:50', 102, NULL, 102, b'1'),
(129, 106, 'Attachment_[1]_150421080150.pdf', '../upload/102/106/Attachment/Attachment_[1]_150421080150.pdf', '2021-04-15 11:31:50', 102, NULL, 102, b'1'),
(130, 107, 'Attachment_[0]_150421080429.pdf', '../upload/102/107/Attachment/Attachment_[0]_150421080429.pdf', '2021-04-15 11:34:29', 102, NULL, 102, b'1'),
(131, 107, 'Attachment_[1]_150421080429.pdf', '../upload/102/107/Attachment/Attachment_[1]_150421080429.pdf', '2021-04-15 11:34:29', 102, NULL, 102, b'1'),
(132, 108, 'Attachment_[0]_150421081642.pdf', '../upload/103/108/Attachment/Attachment_[0]_150421081642.pdf', '2021-04-15 11:46:42', 103, NULL, 103, b'1'),
(133, 109, 'Attachment_[0]_150421081843.pdf', '../upload/103/109/Attachment/Attachment_[0]_150421081843.pdf', '2021-04-15 11:48:43', 103, NULL, 103, b'1'),
(134, 109, 'Attachment_[1]_150421081843.pdf', '../upload/103/109/Attachment/Attachment_[1]_150421081843.pdf', '2021-04-15 11:48:43', 103, NULL, 103, b'1'),
(135, 110, 'Attachment_[0]_150421082502.pdf', '../upload/103/110/Attachment/Attachment_[0]_150421082502.pdf', '2021-04-15 11:55:02', 103, NULL, 103, b'1'),
(136, 110, 'Attachment_[1]_150421082503.pdf', '../upload/103/110/Attachment/Attachment_[1]_150421082503.pdf', '2021-04-15 11:55:03', 103, NULL, 103, b'1'),
(137, 111, 'Attachment_[0]_150421082818.pdf', '../upload/103/111/Attachment/Attachment_[0]_150421082818.pdf', '2021-04-15 11:58:18', 103, NULL, 103, b'1'),
(138, 111, 'Attachment_[1]_150421082818.pdf', '../upload/103/111/Attachment/Attachment_[1]_150421082818.pdf', '2021-04-15 11:58:18', 103, NULL, 103, b'1'),
(139, 112, 'Attachment_[0]_150421083321.pdf', '../upload/103/112/Attachment/Attachment_[0]_150421083321.pdf', '2021-04-15 12:03:21', 103, NULL, 103, b'1'),
(140, 112, 'Attachment_[1]_150421083321.pdf', '../upload/103/112/Attachment/Attachment_[1]_150421083321.pdf', '2021-04-15 12:03:21', 103, NULL, 103, b'1'),
(141, 113, 'Attachment_[0]_150421083610.pdf', '../upload/103/113/Attachment/Attachment_[0]_150421083610.pdf', '2021-04-15 12:06:10', 103, NULL, 103, b'1'),
(142, 114, 'Attachment_[0]_150421083908.pdf', '../upload/103/114/Attachment/Attachment_[0]_150421083908.pdf', '2021-04-15 12:09:08', 103, NULL, 103, b'1'),
(143, 114, 'Attachment_[1]_150421083908.pdf', '../upload/103/114/Attachment/Attachment_[1]_150421083908.pdf', '2021-04-15 12:09:08', 103, NULL, 103, b'1'),
(144, 115, 'Attachment_[0]_150421084110.pdf', '../upload/103/115/Attachment/Attachment_[0]_150421084110.pdf', '2021-04-15 12:11:10', 103, NULL, 103, b'1'),
(145, 115, 'Attachment_[1]_150421084110.pdf', '../upload/103/115/Attachment/Attachment_[1]_150421084110.pdf', '2021-04-15 12:11:10', 103, NULL, 103, b'1'),
(146, 116, 'Attachment_[0]_150421084344.pdf', '../upload/103/116/Attachment/Attachment_[0]_150421084344.pdf', '2021-04-15 12:13:44', 103, NULL, 103, b'1'),
(147, 116, 'Attachment_[1]_150421084344.pdf', '../upload/103/116/Attachment/Attachment_[1]_150421084344.pdf', '2021-04-15 12:13:44', 103, NULL, 103, b'1'),
(148, 117, 'Attachment_[0]_150421084527.pdf', '../upload/103/117/Attachment/Attachment_[0]_150421084527.pdf', '2021-04-15 12:15:27', 103, NULL, 103, b'1'),
(149, 117, 'Attachment_[1]_150421084527.pdf', '../upload/103/117/Attachment/Attachment_[1]_150421084527.pdf', '2021-04-15 12:15:27', 103, NULL, 103, b'1'),
(150, 117, 'Attachment_[2]_150421084527.pdf', '../upload/103/117/Attachment/Attachment_[2]_150421084527.pdf', '2021-04-15 12:15:27', 103, NULL, 103, b'1'),
(151, 118, 'Attachment_[0]_150421084741.pdf', '../upload/103/118/Attachment/Attachment_[0]_150421084741.pdf', '2021-04-15 12:17:41', 103, NULL, 103, b'1'),
(152, 118, 'Attachment_[1]_150421084741.pdf', '../upload/103/118/Attachment/Attachment_[1]_150421084741.pdf', '2021-04-15 12:17:41', 103, NULL, 103, b'1'),
(153, 119, 'Attachment_[0]_150421085028.pdf', '../upload/103/119/Attachment/Attachment_[0]_150421085028.pdf', '2021-04-15 12:20:28', 103, NULL, 103, b'1'),
(154, 120, 'Attachment_[0]_150421094852.pdf', '../upload/120/120/Attachment/Attachment_[0]_150421094852.pdf', '2021-04-15 13:18:52', 120, NULL, 120, b'1'),
(155, 121, 'Attachment_[0]_150421095545.pdf', '../upload/120/121/Attachment/Attachment_[0]_150421095545.pdf', '2021-04-15 13:25:45', 120, NULL, 120, b'1'),
(158, 124, 'Attachment_[0]_150421100713.pdf', '../upload/120/124/Attachment/Attachment_[0]_150421100713.pdf', '2021-04-15 13:37:13', 120, NULL, 120, b'1'),
(159, 125, 'Attachment_[0]_150421100935.pdf', '../upload/120/125/Attachment/Attachment_[0]_150421100935.pdf', '2021-04-15 13:39:35', 120, NULL, 120, b'1'),
(160, 126, 'Attachment_[0]_150421101518.pdf', '../upload/120/126/Attachment/Attachment_[0]_150421101518.pdf', '2021-04-15 13:45:18', 120, NULL, 120, b'1'),
(161, 126, 'Attachment_[1]_150421101518.pdf', '../upload/120/126/Attachment/Attachment_[1]_150421101518.pdf', '2021-04-15 13:45:18', 120, NULL, 120, b'1'),
(162, 127, 'Attachment_[0]_150421101747.pdf', '../upload/120/127/Attachment/Attachment_[0]_150421101747.pdf', '2021-04-15 13:47:47', 120, NULL, 120, b'1'),
(163, 127, 'Attachment_[1]_150421101747.pdf', '../upload/120/127/Attachment/Attachment_[1]_150421101747.pdf', '2021-04-15 13:47:47', 120, NULL, 120, b'1'),
(164, 128, 'Attachment_[0]_150421102008.pdf', '../upload/120/128/Attachment/Attachment_[0]_150421102008.pdf', '2021-04-15 13:50:08', 120, NULL, 120, b'1'),
(165, 128, 'Attachment_[1]_150421102008.pdf', '../upload/120/128/Attachment/Attachment_[1]_150421102008.pdf', '2021-04-15 13:50:08', 120, NULL, 120, b'1'),
(166, 129, 'Attachment_[0]_150421102219.pdf', '../upload/120/129/Attachment/Attachment_[0]_150421102219.pdf', '2021-04-15 13:52:19', 120, NULL, 120, b'1'),
(167, 130, 'Attachment_[0]_150421102442.pdf', '../upload/120/130/Attachment/Attachment_[0]_150421102442.pdf', '2021-04-15 13:54:42', 120, NULL, 120, b'1'),
(168, 131, 'Attachment_[0]_150421102639.pdf', '../upload/120/131/Attachment/Attachment_[0]_150421102639.pdf', '2021-04-15 13:56:39', 120, NULL, 120, b'1'),
(169, 132, 'Attachment_[0]_150421102840.pdf', '../upload/120/132/Attachment/Attachment_[0]_150421102840.pdf', '2021-04-15 13:58:40', 120, NULL, 120, b'1'),
(170, 132, 'Attachment_[1]_150421102840.pdf', '../upload/120/132/Attachment/Attachment_[1]_150421102840.pdf', '2021-04-15 13:58:40', 120, NULL, 120, b'1'),
(171, 133, 'Attachment_[0]_150421103053.pdf', '../upload/120/133/Attachment/Attachment_[0]_150421103053.pdf', '2021-04-15 14:00:53', 120, NULL, 120, b'1'),
(172, 133, 'Attachment_[1]_150421103053.pdf', '../upload/120/133/Attachment/Attachment_[1]_150421103053.pdf', '2021-04-15 14:00:53', 120, NULL, 120, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `seller_notes_reported_issues`
--

CREATE TABLE `seller_notes_reported_issues` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReportedBYID` int(11) NOT NULL,
  `AgainstDownloadID` int(11) NOT NULL,
  `Remarks` varchar(800) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_notes_reported_issues`
--

INSERT INTO `seller_notes_reported_issues` (`ID`, `NoteID`, `ReportedBYID`, `AgainstDownloadID`, `Remarks`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(13, 99, 103, 256, 'not proper', '2021-04-15 15:38:03', 103, NULL, NULL),
(14, 127, 102, 260, 'not proper', '2021-04-15 15:49:32', 102, NULL, NULL),
(15, 110, 102, 272, 'can be proper', '2021-04-15 15:51:35', 102, NULL, NULL),
(16, 99, 120, 296, 'not proper', '2021-04-15 19:05:53', 120, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller_notes_reviews`
--

CREATE TABLE `seller_notes_reviews` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReviewedByID` int(11) NOT NULL,
  `AgainstDownloadsID` int(11) NOT NULL,
  `Ratings` decimal(10,0) NOT NULL,
  `Comments` varchar(800) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_notes_reviews`
--

INSERT INTO `seller_notes_reviews` (`ID`, `NoteID`, `ReviewedByID`, `AgainstDownloadsID`, `Ratings`, `Comments`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(37, 97, 103, 239, '4', 'good', '2021-04-15 12:48:51', 103, NULL, NULL, b'1'),
(38, 129, 103, 241, '4', 'nice', '2021-04-15 15:33:44', 103, NULL, NULL, b'1'),
(39, 97, 103, 239, '5', 'good', '2021-04-15 15:34:01', 103, NULL, NULL, b'1'),
(40, 99, 103, 256, '2', 'not that good', '2021-04-15 15:34:17', 103, NULL, NULL, b'1'),
(41, 103, 103, 254, '3', 'average', '2021-04-15 15:34:33', 103, NULL, NULL, b'1'),
(42, 105, 103, 250, '4', 'Awesome', '2021-04-15 15:36:28', 103, NULL, NULL, b'1'),
(43, 106, 103, 248, '4', 'nicce', '2021-04-15 15:36:45', 103, NULL, NULL, b'1'),
(44, 120, 103, 247, '4', 'good', '2021-04-15 15:37:05', 103, NULL, NULL, b'1'),
(45, 124, 103, 245, '4', 'nice material for begineers\r\n', '2021-04-15 15:39:34', 103, NULL, NULL, b'1'),
(46, 127, 103, 242, '3', 'average', '2021-04-15 15:41:05', 103, NULL, NULL, b'1'),
(47, 101, 103, 252, '4', 'nice', '2021-04-15 15:42:28', 103, NULL, NULL, b'1'),
(48, 127, 102, 260, '2', 'bad', '2021-04-15 15:48:56', 102, NULL, NULL, b'1'),
(49, 108, 102, 276, '3', 'average', '2021-04-15 15:49:58', 102, NULL, NULL, b'1'),
(50, 110, 102, 272, '2', 'not good old patterns', '2021-04-15 15:51:07', 102, NULL, NULL, b'1'),
(51, 118, 102, 268, '4', 'nice', '2021-04-15 15:51:49', 102, NULL, NULL, b'1'),
(52, 112, 102, 266, '5', 'great for beginners', '2021-04-15 15:52:30', 102, NULL, NULL, b'1'),
(53, 124, 102, 263, '4', 'very helpful', '2021-04-15 15:53:16', 102, NULL, NULL, b'1'),
(54, 129, 102, 259, '4', 'nice', '2021-04-15 15:53:42', 102, NULL, NULL, b'1'),
(55, 121, 102, 264, '2', 'average', '2021-04-15 15:54:08', 102, NULL, NULL, b'1'),
(56, 97, 120, 299, '2', 'less detailed', '2021-04-15 15:55:47', 120, NULL, NULL, b'1'),
(57, 99, 120, 296, '3', 'average', '2021-04-15 15:56:06', 120, NULL, NULL, b'1'),
(58, 103, 120, 294, '4', 'nice', '2021-04-15 15:56:15', 120, NULL, NULL, b'1'),
(59, 108, 120, 293, '4', 'very detailed', '2021-04-15 15:56:30', 120, NULL, NULL, b'1'),
(60, 101, 120, 291, '5', 'great', '2021-04-15 15:57:03', 120, NULL, NULL, b'1'),
(61, 105, 120, 289, '4', 'good', '2021-04-15 15:58:55', 120, NULL, NULL, b'1'),
(62, 110, 120, 283, '2', 'it should be updated', '2021-04-15 15:59:23', 120, NULL, NULL, b'1'),
(63, 118, 120, 279, '3', 'average', '2021-04-15 16:00:12', 120, NULL, NULL, b'1'),
(64, 112, 120, 277, '4', 'very good', '2021-04-15 16:02:02', 120, NULL, NULL, b'1'),
(65, 109, 120, 285, '4', 'good', '2021-04-15 16:02:48', 120, NULL, NULL, b'1'),
(66, 106, 120, 287, '4', 'good', '2021-04-15 16:03:29', 120, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `system_configurations`
--

CREATE TABLE `system_configurations` (
  `ID` int(11) NOT NULL,
  `Key` varchar(100) NOT NULL,
  `Value` varchar(800) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_configurations`
--

INSERT INTO `system_configurations` (`ID`, `Key`, `Value`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'SupportEmailAddress', '170320116025.it.parth@gmail.com', '2021-04-10 00:40:56', 99, '2021-04-15 16:59:29', 99, b'1'),
(2, 'SupportContactNumber', '6325632687', '2021-04-10 00:40:56', 99, '2021-04-15 16:59:29', 99, b'1'),
(3, 'EmailAddresssesForNotify', 'parthmistry7227843533@gmail.com', '2021-04-10 00:40:56', 99, '2021-04-15 16:59:29', 99, b'1'),
(4, 'DefaultNoteDisplayPicture', '../front/images/default/note/dnp.jpg', '2021-04-10 00:40:56', 99, '2021-04-15 16:59:29', 99, b'1'),
(5, 'DefaultMemberDisplayPicture', '../front/images/default/profile/dp.jpg', '2021-04-10 00:40:56', 99, '2021-04-15 16:59:29', 99, b'1'),
(6, 'FBICON', 'https://www.facebook.com/TatvaSoft/', '2021-04-10 00:40:56', 99, '2021-04-15 16:59:29', 99, b'1'),
(7, 'TWITTERICON', 'https://twitter.com/tatvasoft?s=08', '2021-04-10 00:40:56', 99, '2021-04-15 16:59:29', 99, b'1'),
(8, 'LNICON', 'https://www.tatvasoft.com/', '2021-04-10 00:40:56', 99, '2021-04-15 16:59:29', 99, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL DEFAULT 3,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `IsEmailVerified` bit(1) NOT NULL DEFAULT b'0',
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `RoleID`, `FirstName`, `LastName`, `EmailID`, `Password`, `IsEmailVerified`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(99, 1, 'Rajesh', 'Mistry', '170320116025.it.parth@gmail.com', '$2y$10$8yRrmnFsitJahcFvGHWomuSbAMZy1KI7JmjWg4hbutrejEI71Jgqe', b'1', '2021-03-01 12:27:35', 1, '2021-04-14 22:22:39', 99, b'1'),
(102, 3, 'Parth', 'mistry', 'parthmistry7227843533@gmail.com', '$2y$10$Ow4nAcLr56qPrEGEm.mWyOLq3zPlLjE4/27FHuevtVxfvuCD/4hFy', b'1', '2021-03-02 21:42:37', NULL, '2021-04-08 01:42:52', 99, b'1'),
(103, 3, 'heena', 'mistry', 'mistryheena35@gmail.com', '$2y$10$P78XP3ytsopjRD8AW9PVyOFzTg31aKDTonaHGTYtrE3KPPvc.A8U2', b'1', '2021-03-04 15:31:07', NULL, '2021-04-10 16:05:56', NULL, b'1'),
(105, 2, 'Anila', 'Khajuriwala', 'khajuriwalaanila@gmail.com', '$2y$10$P78XP3ytsopjRD8AW9PVyOFzTg31aKDTonaHGTYtrE3KPPvc.A8U2', b'1', '2021-04-09 15:23:04', 99, '2021-04-14 21:10:41', 99, b'1'),
(120, 3, 'parth', 'gajjar', 'parthgajjar06@gmail.com', '$2y$10$PRXXj2cqFVL4PLMEhOwrcOfSKyjiPP4i7nWF5JvTkvz/Q2wKjcbgS', b'1', '2021-04-12 13:54:52', NULL, '2021-04-12 13:54:52', NULL, b'1'),
(131, 3, 'raju', 'Mistry', 'rmistry608@gmail.com', '$2y$10$2CvK8oJwUTNvt/bZniTeY..N/XaA7Bkox/m55BwemD08ZJ0oGe28m', b'0', '2021-04-15 18:20:36', NULL, '2021-04-15 18:20:36', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` int(11) DEFAULT NULL,
  `SecondaryEmailAddress` varchar(100) DEFAULT NULL,
  `CountryCode` varchar(5) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `ProfilePicture` varchar(500) DEFAULT NULL,
  `AddressLine1` varchar(100) NOT NULL,
  `AddressLine2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `University` varchar(100) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`ID`, `UserID`, `DOB`, `Gender`, `SecondaryEmailAddress`, `CountryCode`, `PhoneNumber`, `ProfilePicture`, `AddressLine1`, `AddressLine2`, `City`, `State`, `ZipCode`, `Country`, `University`, `College`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(12, 105, NULL, NULL, 'anilakhajuriwala@gmail.com', '+91', '9662091253', 'pp_100421101601.jpg', '', '', '', '', '', '', NULL, NULL, '2021-04-09 15:23:04', 99, '2021-04-14 21:10:41', 99),
(13, 99, NULL, NULL, 'rajesh@gmail.com', '+61', '7227380155', 'pp_140421063446.jpg', '', '', '', '', '', '', NULL, NULL, '2021-04-09 17:10:54', NULL, '2021-04-14 22:04:46', 99),
(19, 103, '2021-04-15', 2, NULL, '+91', '5446545646', '../upload/103/profile/pp_100421015946.jpg', 'A-54/641 hariom appartment,', 'navavadaj', 'ahmedabad', 'gujarat', '380013', 'Italy', 'GTU', 'LJIET', '2021-04-10 17:29:46', 103, NULL, NULL),
(24, 102, '2000-08-05', 1, NULL, '+91', '5446545646', '../upload/102/profile/pp_100421094316.jpg', 'A-54/641 hariom appartment,', 'navavadaj', 'ahmedabad', 'gujarat', '380013', 'Egypt', 'GTU', 'LJIET', '2021-04-11 01:13:16', 102, NULL, NULL),
(25, 120, '2000-02-22', 1, NULL, '+91', '8585858585', '../upload/120/profile/pp_130421102638.jpg', 'hariom appartment', 'akhbarnagar', 'ahmedabad', 'gujarat', '380013', 'Iran', 'university of gujarat', 'LKG', '2021-04-12 14:08:49', 120, '2021-04-13 13:56:38', 120);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Super Admin', 'Super Admin is Top Level User.', '2021-02-25 21:33:10', NULL, '2021-02-25 21:33:10', NULL, b'1'),
(2, 'Admin', 'It\'s Middle level user. only Super admin can only add an admin.', '2021-02-25 21:36:08', 1, '2021-02-25 21:36:08', NULL, b'1'),
(3, 'Member', 'Member is normal user', '2021-02-26 00:42:36', NULL, '2021-02-26 00:42:36', NULL, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `Seller` (`Seller`),
  ADD KEY `Downloader` (`Downloader`);

--
-- Indexes for table `note_categories`
--
ALTER TABLE `note_categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `note_types`
--
ALTER TABLE `note_types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reference_data`
--
ALTER TABLE `reference_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `seller_notes`
--
ALTER TABLE `seller_notes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `Status` (`Status`),
  ADD KEY `ActionedBy` (`ActionedBy`),
  ADD KEY `Category` (`Category`),
  ADD KEY `NoteType` (`NoteType`),
  ADD KEY `Country` (`Country`);

--
-- Indexes for table `seller_notes_attachements`
--
ALTER TABLE `seller_notes_attachements`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `seller_notes_attachements_ibfk_1` (`NoteID`);

--
-- Indexes for table `seller_notes_reported_issues`
--
ALTER TABLE `seller_notes_reported_issues`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReportedBYID` (`ReportedBYID`),
  ADD KEY `AgainstDownloadID` (`AgainstDownloadID`);

--
-- Indexes for table `seller_notes_reviews`
--
ALTER TABLE `seller_notes_reviews`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReviewedByID` (`ReviewedByID`),
  ADD KEY `AgainstDownloadsID` (`AgainstDownloadsID`);

--
-- Indexes for table `system_configurations`
--
ALTER TABLE `system_configurations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EmailID` (`EmailID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Gender` (`Gender`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `note_categories`
--
ALTER TABLE `note_categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `note_types`
--
ALTER TABLE `note_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reference_data`
--
ALTER TABLE `reference_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seller_notes`
--
ALTER TABLE `seller_notes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `seller_notes_attachements`
--
ALTER TABLE `seller_notes_attachements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `seller_notes_reported_issues`
--
ALTER TABLE `seller_notes_reported_issues`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `seller_notes_reviews`
--
ALTER TABLE `seller_notes_reviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `system_configurations`
--
ALTER TABLE `system_configurations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`Seller`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`Downloader`) REFERENCES `users` (`ID`);

--
-- Constraints for table `seller_notes`
--
ALTER TABLE `seller_notes`
  ADD CONSTRAINT `seller_notes_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `seller_notes_ibfk_2` FOREIGN KEY (`Status`) REFERENCES `reference_data` (`ID`),
  ADD CONSTRAINT `seller_notes_ibfk_3` FOREIGN KEY (`ActionedBy`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `seller_notes_ibfk_4` FOREIGN KEY (`Category`) REFERENCES `note_categories` (`ID`),
  ADD CONSTRAINT `seller_notes_ibfk_5` FOREIGN KEY (`NoteType`) REFERENCES `note_types` (`ID`),
  ADD CONSTRAINT `seller_notes_ibfk_6` FOREIGN KEY (`Country`) REFERENCES `countries` (`ID`);

--
-- Constraints for table `seller_notes_attachements`
--
ALTER TABLE `seller_notes_attachements`
  ADD CONSTRAINT `seller_notes_attachements_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller_notes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seller_notes_reported_issues`
--
ALTER TABLE `seller_notes_reported_issues`
  ADD CONSTRAINT `seller_notes_reported_issues_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller_notes` (`ID`),
  ADD CONSTRAINT `seller_notes_reported_issues_ibfk_2` FOREIGN KEY (`ReportedBYID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `seller_notes_reported_issues_ibfk_3` FOREIGN KEY (`AgainstDownloadID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `seller_notes_reviews`
--
ALTER TABLE `seller_notes_reviews`
  ADD CONSTRAINT `seller_notes_reviews_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller_notes` (`ID`),
  ADD CONSTRAINT `seller_notes_reviews_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `seller_notes_reviews_ibfk_3` FOREIGN KEY (`AgainstDownloadsID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `user_roles` (`ID`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user_profile_ibfk_2` FOREIGN KEY (`Gender`) REFERENCES `reference_data` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
