-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 01:29 PM
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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ID`, `Name`, `CountryCode`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Australia', '+61', '2021-03-02 15:09:48', 2, '2021-03-02 15:09:48', NULL, b'1'),
(2, 'Bangladesh', '+880', '2021-03-02 15:09:48', 2, '2021-03-02 15:09:48', NULL, b'0'),
(3, 'Canada', '+1', '2021-03-02 15:14:41', 2, '2021-03-02 15:14:41', NULL, b'1'),
(4, 'Egypt', '+20', '2021-03-02 15:14:41', 2, '2021-03-02 15:14:41', NULL, b'1'),
(5, 'France', '+33', '2021-03-02 15:14:41', 2, '2021-03-02 15:14:41', NULL, b'1'),
(6, 'India', '+91', '2021-03-02 15:14:41', 2, '2021-03-02 15:14:41', NULL, b'1'),
(7, 'Iran', '+98', '2021-03-02 15:14:41', 2, '2021-03-02 15:14:41', NULL, b'1'),
(8, 'Iraq', '+964', '2021-03-02 15:14:41', 2, '2021-03-02 15:14:41', NULL, b'1'),
(9, 'Italy', '+39', '2021-03-02 15:14:41', 2, '2021-03-02 15:14:41', NULL, b'1');

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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`ID`, `NoteID`, `Seller`, `Downloader`, `IsSellerHasAllowedDownload`, `AttachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 11, 103, 102, b'0', '../upload/ (63).JPG', b'0', NULL, b'1', '85', 'Resume', 'Civil', '2021-03-04 16:03:08', NULL, '2021-03-04 16:03:08', NULL),
(2, 11, 103, 102, b'0', '../upload/ (64).JPG', b'0', NULL, b'1', '85', 'Resume', 'Civil', '2021-03-04 16:03:08', NULL, '2021-03-04 16:03:08', NULL),
(4, 12, 102, 103, b'0', '../upload/ (14).JPG', b'0', NULL, b'1', '500', 'Resume', 'IT', '2021-03-04 16:07:35', NULL, '2021-03-04 16:07:35', NULL),
(5, 12, 102, 103, b'0', '../upload/ (15).JPG', b'0', NULL, b'1', '500', 'Resume', 'IT', '2021-03-04 16:12:28', NULL, '2021-03-04 16:12:28', NULL),
(6, 13, 103, 102, b'0', '../upload/IMG20200816115907.jpg', b'0', NULL, b'1', '856', 'Resume', 'MBA', '2021-03-04 16:12:28', NULL, '2021-03-04 16:12:28', NULL),
(7, 13, 103, 102, b'0', '../upload/IMG20200816115910.jpg', b'0', NULL, b'1', '856', 'Resume', 'MBA', '2021-03-04 16:15:12', NULL, '2021-03-04 16:15:12', NULL),
(8, 14, 102, 103, b'0', '../upload/IMG20200816111545.jpg', b'0', NULL, b'1', '85', 'Resume', 'IT', '2021-03-04 16:15:12', NULL, '2021-03-04 16:15:12', NULL),
(9, 14, 102, 103, b'0', '../upload/IMG20200816115028.jpg', b'0', NULL, b'1', '85', 'Resume', 'IT', '2021-03-04 16:18:12', NULL, '2021-03-04 16:18:12', NULL),
(10, 15, 103, 102, b'0', '../upload/IMG20200816151003.jpg', b'0', NULL, b'1', '74', 'bhhoot', 'CS', '2021-03-04 16:18:12', NULL, '2021-03-04 16:18:12', NULL),
(11, 15, 103, 102, b'0', '../upload/IMG20200816151016.jpg', b'0', NULL, b'1', '74', 'Bhhoot', 'CS', '2021-03-04 16:21:57', NULL, '2021-03-04 16:21:57', NULL),
(12, 17, 102, 103, b'0', '../upload/IMG_20181220_151016.jpg', b'0', NULL, b'1', '1000', 'ENGINEERING OF MANAGEMENT', 'MBA', '2021-03-04 16:21:57', NULL, '2021-03-04 16:21:57', NULL),
(13, 17, 102, 103, b'0', '../upload/IMG_20181220_151021.jpg', b'0', NULL, b'1', '1000', 'ENGINEERING OF MANAGEMENT', 'MBA', '2021-03-04 16:29:08', NULL, '2021-03-04 16:29:08', NULL),
(14, 19, 103, 102, b'0', '../upload/IMG_20181223_110700.jpg', b'0', NULL, b'1', '6300', 'ENGINEERING OF civil', 'Civil', '2021-03-04 16:29:08', NULL, '2021-03-04 16:29:08', NULL),
(15, 19, 103, 102, b'1', '../upload/IMG_20181223_110722.jpg', b'0', NULL, b'1', '6300', 'ENGINEERING OF civil', 'Civil', '2021-03-04 16:32:08', NULL, '2021-03-04 16:32:08', NULL),
(16, 20, 102, 103, b'0', '../upload/IMG_20181222_095832_001_COVER.jpg', b'0', NULL, b'1', '2590', 'Android', 'CS', '2021-03-04 16:32:08', NULL, '2021-03-04 16:32:08', NULL),
(17, 20, 102, 103, b'1', '../upload/IMG_20181222_095846.jpg', b'0', NULL, b'1', '2590', 'Android', 'CS', '2021-03-04 16:34:26', NULL, '2021-03-04 16:34:26', NULL),
(18, 17, 102, 103, b'0', '../upload/IMG_20181220_151021.jpg', b'0', NULL, b'1', '1000', 'ENGINEERING OF MANAGEMENT', 'MBA', '2021-03-04 16:29:08', NULL, '2021-03-04 16:29:08', NULL),
(19, 19, 103, 102, b'0', '../upload/IMG_20181223_110700.jpg', b'0', NULL, b'1', '6300', 'ENGINEERING OF civil', 'Civil', '2021-03-04 16:29:08', NULL, '2021-03-04 16:29:08', NULL),
(20, 19, 103, 102, b'0', '../upload/IMG_20181223_110722.jpg', b'0', NULL, b'1', '6300', 'ENGINEERING OF civil', 'Civil', '2021-03-04 16:32:08', NULL, '2021-03-04 16:32:08', NULL),
(21, 12, 102, 103, b'0', '../upload/ (15).JPG', b'0', NULL, b'1', '500', 'Resume', 'IT', '2021-03-04 16:12:28', NULL, '2021-03-04 16:12:28', NULL),
(22, 13, 103, 102, b'0', '../upload/IMG20200816115907.jpg', b'0', NULL, b'1', '856', 'Resume', 'MBA', '2021-03-04 16:12:28', NULL, '2021-03-04 16:12:28', NULL);

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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note_categories`
--

INSERT INTO `note_categories` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'IT', 'Information technology (IT) is the use of computers to store, retrieve, transmit, and manipulate data or information.', '2021-03-02 15:47:09', 2, '2021-03-02 15:47:09', NULL, b'1'),
(2, 'CA', 'A Chartered Accountant, also known as a Certified Public Accountant or CPA, is a professional accountant qualified to work with a spectrum of accountancy related activities.', '2021-03-02 15:47:09', 2, '2021-03-02 15:47:09', NULL, b'1'),
(3, 'CS', 'Some of their core duties include: Developing new, and improving existing, computer-based technologies, systems, and solutions. Working with computer programmers.', '2021-03-02 15:47:09', 2, '2021-03-02 15:47:09', NULL, b'1'),
(4, 'MBA', 'A master of business administration (MBA) is a graduate degree that provides theoretical and practical training for business or investment management.', '2021-03-02 15:47:09', 2, '2021-03-02 15:47:09', NULL, b'1'),
(5, 'Mechanical', 'Mechanical engineers design power-producing machines, such as electric generators, internal combustion engines, and steam and gas turbines, as well as power-using machines, such as refrigeration and air-conditioning systems.', '2021-03-02 15:50:01', 2, '2021-03-02 15:50:01', NULL, b'1'),
(6, 'Civil', 'Civil engineers create, improve and protect the environment in which we live. They plan, design and oversee construction and maintenance of building structures and infrastructure, such as roads, railways, airports, bridges, harbours, dams, irrigation projects, power plants, and water and sewerage systems.', '2021-03-02 15:50:01', 2, '2021-03-02 15:50:01', NULL, b'1'),
(7, 'Electrical', 'Electrical engineers design, develop, and test electrical devices and equipment, including communications systems, power generators, motors and navigation systems, and electrical systems for automobiles and aircraft.', '2021-03-02 15:50:01', 2, '2021-03-02 15:50:01', NULL, b'1');

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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note_types`
--

INSERT INTO `note_types` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Handwritten notes', 'this type of notes usually a scanned copy of handwritten content.', '2021-03-02 15:52:47', 2, '2021-03-02 15:52:47', NULL, b'1'),
(2, 'University notes', 'this type of notes is made by perticular university in digital form.', '2021-03-02 15:57:57', 2, '2021-03-02 15:57:57', NULL, b'1'),
(3, 'Novel', 'A novel is a relatively long work of narrative fiction, normally written in prose form, and which is typically published as a book.', '2021-03-02 15:57:57', 2, '2021-03-02 15:57:57', NULL, b'1'),
(4, 'Story book', 'A book containing a collection of stories, usually for children. adj. Occurring in or resembling the style or content of a storybook: storybook characters; a storybook romance.', '2021-03-02 15:57:57', 2, '2021-03-02 15:57:57', NULL, b'1');

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
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reference_data`
--

INSERT INTO `reference_data` (`ID`, `Value`, `DataValue`, `RefCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Male', 'M', 'Gender', '2021-02-25 21:39:47', 1, '2021-02-25 21:39:47', 1, b'1'),
(2, 'Female', 'Fe', 'Gender', '2021-02-25 21:40:44', 1, '2021-02-25 21:40:44', 1, b'1'),
(3, 'Unknown', 'U', 'Gender', '2021-02-25 21:41:23', 1, '2021-02-25 21:41:23', 1, b'0'),
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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_notes`
--

INSERT INTO `seller_notes` (`ID`, `SellerID`, `Status`, `ActionedBy`, `AdminRemarks`, `PublishedDate`, `Title`, `Category`, `DisplayPicture`, `NoteType`, `NumberofPages`, `Description`, `UniversityName`, `Country`, `Course`, `CourseCode`, `Professor`, `IsPaid`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(35, 102, 7, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_040321112240.jpg', 2, 1423, '1st description', 'IIT', 6, 'Diploma', '7852', 'L M PATEL', b'0', '0', 'preview_040321112240.pdf', '2021-03-05 03:52:40', 102, '2021-03-05 03:52:40', 102, b'0'),
(36, 102, 7, 102, NULL, NULL, 'mecatronics', 5, 'bp_050321112358.jpg', 1, 699, 'Mechatronics', 'NIT', 2, 'ELEMENTS OF MECHATRONICS', '85754', 'PARTH MISTRY Ok', b'1', '963', 'preview_050321112358.pdf', '2021-03-05 15:53:58', 102, '2021-03-05 15:53:58', 102, b'0'),
(37, 102, 6, 102, NULL, NULL, 'Economics', 4, 'bp_050321113256.jpg', 3, 123, 'economics', 'koc', 3, 'Diploma', '7852', 'LOUIS JACKSON', b'0', '0', 'preview_050321113256.pdf', '2021-03-05 16:02:56', 102, '2021-03-05 16:02:56', 102, b'0'),
(38, 102, 6, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_050321011510.jpg', 2, 523, 'dcdxcfddc', 'AMD', 3, 'Diploma', '7455', 'LOUIS JACKSON', b'1', '54', 'preview_050321011510.pdf', '2021-03-05 17:45:10', 102, '2021-03-05 17:45:10', 102, b'0'),
(39, 102, 6, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_050321011529.jpg', 2, 523, 'dcdxcfddc', 'AMD', 3, 'Diploma', '7455', 'LOUIS JACKSON', b'1', '54', 'preview_050321011529.pdf', '2021-03-05 17:45:29', 102, '2021-03-05 17:45:29', 102, b'0'),
(40, 102, 6, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_050321011555.jpg', 2, 523, 'dcdxcfddc', 'AMD', 3, 'Diploma', '7455', 'LOUIS JACKSON', b'1', '54', 'preview_050321011555.pdf', '2021-03-05 17:45:55', 102, '2021-03-05 17:45:55', 102, b'0'),
(41, 102, 6, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_050321011601.jpg', 2, 523, 'dcdxcfddc', 'AMD', 3, 'Diploma', '7455', 'LOUIS JACKSON', b'1', '54', 'preview_050321011601.pdf', '2021-03-05 17:46:01', 102, '2021-03-05 17:46:01', 102, b'0'),
(42, 102, 6, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_050321011606.jpg', 2, 523, 'dcdxcfddc', 'AMD', 3, 'Diploma', '7455', 'LOUIS JACKSON', b'1', '54', 'preview_050321011606.pdf', '2021-03-05 17:46:06', 102, '2021-03-05 17:46:06', 102, b'0'),
(43, 102, 6, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_050321011610.jpg', 2, 523, 'dcdxcfddc', 'AMD', 3, 'Diploma', '7455', 'LOUIS JACKSON', b'1', '54', 'preview_050321011610.pdf', '2021-03-05 17:46:10', 102, '2021-03-05 17:46:10', 102, b'0'),
(44, 102, 6, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_050321011615.jpg', 2, 523, 'dcdxcfddc', 'AMD', 3, 'Diploma', '7455', 'LOUIS JACKSON', b'1', '54', 'preview_050321011615.pdf', '2021-03-05 17:46:15', 102, '2021-03-05 17:46:15', 102, b'0'),
(45, 102, 6, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_050321011620.jpg', 2, 523, 'dcdxcfddc', 'AMD', 3, 'Diploma', '7455', 'LOUIS JACKSON', b'1', '54', 'preview_050321011620.pdf', '2021-03-05 17:46:20', 102, '2021-03-05 17:46:20', 102, b'0'),
(46, 102, 6, 102, NULL, NULL, 'ENGINEERING OF MANAGEMENT', 4, 'bp_050321011625.jpg', 2, 523, 'dcdxcfddc', 'AMD', 3, 'Diploma', '7455', 'LOUIS JACKSON', b'1', '54', 'preview_050321011625.pdf', '2021-03-05 17:46:25', 102, '2021-03-05 17:46:25', 102, b'0'),
(47, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011755.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011755.pdf', '2021-03-05 17:47:55', 102, '2021-03-05 17:47:55', 102, b'0'),
(48, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011800.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011800.pdf', '2021-03-05 17:48:00', 102, '2021-03-05 17:48:00', 102, b'0'),
(49, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011804.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011804.pdf', '2021-03-05 17:48:04', 102, '2021-03-05 17:48:04', 102, b'0'),
(50, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011808.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011808.pdf', '2021-03-05 17:48:08', 102, '2021-03-05 17:48:08', 102, b'0'),
(51, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011811.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011811.pdf', '2021-03-05 17:48:11', 102, '2021-03-05 17:48:11', 102, b'0'),
(52, 102, 9, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011816.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011816.pdf', '2021-03-05 17:48:16', 102, '2021-03-05 17:48:16', 102, b'0'),
(53, 102, 9, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011831.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011831.pdf', '2021-03-05 17:48:31', 102, '2021-03-05 17:48:31', 102, b'0'),
(54, 102, 9, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011835.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011835.pdf', '2021-03-05 17:48:35', 102, '2021-03-05 17:48:35', 102, b'0'),
(55, 102, 9, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011838.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011838.pdf', '2021-03-05 17:48:38', 102, '2021-03-05 17:48:38', 102, b'0'),
(56, 102, 9, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011842.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011842.pdf', '2021-03-05 17:48:42', 102, '2021-03-05 17:48:42', 102, b'0'),
(57, 102, 9, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011849.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011849.pdf', '2021-03-05 17:48:49', 102, '2021-03-05 17:48:49', 102, b'0'),
(58, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011853.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011853.pdf', '2021-03-05 17:48:53', 102, '2021-03-05 17:48:53', 102, b'0'),
(59, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011856.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011856.pdf', '2021-03-05 17:48:56', 102, '2021-03-05 17:48:56', 102, b'0'),
(60, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011902.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011902.pdf', '2021-03-05 17:49:02', 102, '2021-03-05 17:49:02', 102, b'0'),
(61, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011913.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011913.pdf', '2021-03-05 17:49:13', 102, '2021-03-05 17:49:13', 102, b'0'),
(62, 102, 6, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011917.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011917.pdf', '2021-03-05 17:49:17', 102, '2021-03-05 17:49:17', 102, b'0'),
(63, 102, 7, 102, NULL, NULL, 'ENGINEERING OF civil', 6, 'bp_050321011920.jpg', 2, 89, 'civil basics', 'koc', 2, 'PRofessional', '966', 'L M PATEL', b'0', '0', 'preview_050321011920.pdf', '2021-03-05 17:49:20', 102, '2021-03-05 17:49:20', 102, b'0');

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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_notes_attachements`
--

INSERT INTO `seller_notes_attachements` (`ID`, `NoteID`, `FileName`, `FilePath`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(41, 35, 'Attachment_[0]_040321112240.pdf', '../upload/102/35/Attachment/Attachment_[0]_040321112240.pdf', '2021-03-05 03:52:40', 102, '2021-03-05 03:52:40', 102, b'1'),
(42, 36, 'Attachment_[0]_050321112358.pdf', '../upload/102/36/Attachment/Attachment_[0]_050321112358.pdf', '2021-03-05 15:53:58', 102, '2021-03-05 15:53:58', 102, b'1'),
(43, 37, 'Attachment_[0]_050321113256.pdf', '../upload/102/37/Attachment/Attachment_[0]_050321113256.pdf', '2021-03-05 16:02:56', 102, '2021-03-05 16:02:56', 102, b'1'),
(44, 38, 'Attachment_[0]_050321011510.pdf', '../upload/102/38/Attachment/Attachment_[0]_050321011510.pdf', '2021-03-05 17:45:10', 102, '2021-03-05 17:45:10', 102, b'1'),
(45, 39, 'Attachment_[0]_050321011529.pdf', '../upload/102/39/Attachment/Attachment_[0]_050321011529.pdf', '2021-03-05 17:45:29', 102, '2021-03-05 17:45:29', 102, b'1'),
(46, 40, 'Attachment_[0]_050321011556.pdf', '../upload/102/40/Attachment/Attachment_[0]_050321011556.pdf', '2021-03-05 17:45:56', 102, '2021-03-05 17:45:56', 102, b'1'),
(47, 41, 'Attachment_[0]_050321011601.pdf', '../upload/102/41/Attachment/Attachment_[0]_050321011601.pdf', '2021-03-05 17:46:01', 102, '2021-03-05 17:46:01', 102, b'1'),
(48, 42, 'Attachment_[0]_050321011606.pdf', '../upload/102/42/Attachment/Attachment_[0]_050321011606.pdf', '2021-03-05 17:46:06', 102, '2021-03-05 17:46:06', 102, b'1'),
(49, 43, 'Attachment_[0]_050321011610.pdf', '../upload/102/43/Attachment/Attachment_[0]_050321011610.pdf', '2021-03-05 17:46:10', 102, '2021-03-05 17:46:10', 102, b'1'),
(50, 44, 'Attachment_[0]_050321011615.pdf', '../upload/102/44/Attachment/Attachment_[0]_050321011615.pdf', '2021-03-05 17:46:15', 102, '2021-03-05 17:46:15', 102, b'1'),
(51, 45, 'Attachment_[0]_050321011620.pdf', '../upload/102/45/Attachment/Attachment_[0]_050321011620.pdf', '2021-03-05 17:46:20', 102, '2021-03-05 17:46:20', 102, b'1'),
(52, 46, 'Attachment_[0]_050321011625.pdf', '../upload/102/46/Attachment/Attachment_[0]_050321011625.pdf', '2021-03-05 17:46:25', 102, '2021-03-05 17:46:25', 102, b'1'),
(53, 47, 'Attachment_[0]_050321011755.pdf', '../upload/102/47/Attachment/Attachment_[0]_050321011755.pdf', '2021-03-05 17:47:55', 102, '2021-03-05 17:47:55', 102, b'1'),
(54, 48, 'Attachment_[0]_050321011800.pdf', '../upload/102/48/Attachment/Attachment_[0]_050321011800.pdf', '2021-03-05 17:48:00', 102, '2021-03-05 17:48:00', 102, b'1'),
(55, 49, 'Attachment_[0]_050321011804.pdf', '../upload/102/49/Attachment/Attachment_[0]_050321011804.pdf', '2021-03-05 17:48:04', 102, '2021-03-05 17:48:04', 102, b'1'),
(56, 50, 'Attachment_[0]_050321011808.pdf', '../upload/102/50/Attachment/Attachment_[0]_050321011808.pdf', '2021-03-05 17:48:08', 102, '2021-03-05 17:48:08', 102, b'1'),
(57, 51, 'Attachment_[0]_050321011811.pdf', '../upload/102/51/Attachment/Attachment_[0]_050321011811.pdf', '2021-03-05 17:48:11', 102, '2021-03-05 17:48:11', 102, b'1'),
(58, 52, 'Attachment_[0]_050321011816.pdf', '../upload/102/52/Attachment/Attachment_[0]_050321011816.pdf', '2021-03-05 17:48:16', 102, '2021-03-05 17:48:16', 102, b'1'),
(59, 53, 'Attachment_[0]_050321011831.pdf', '../upload/102/53/Attachment/Attachment_[0]_050321011831.pdf', '2021-03-05 17:48:31', 102, '2021-03-05 17:48:31', 102, b'1'),
(60, 54, 'Attachment_[0]_050321011835.pdf', '../upload/102/54/Attachment/Attachment_[0]_050321011835.pdf', '2021-03-05 17:48:35', 102, '2021-03-05 17:48:35', 102, b'1'),
(61, 55, 'Attachment_[0]_050321011838.pdf', '../upload/102/55/Attachment/Attachment_[0]_050321011838.pdf', '2021-03-05 17:48:38', 102, '2021-03-05 17:48:38', 102, b'1'),
(62, 56, 'Attachment_[0]_050321011842.pdf', '../upload/102/56/Attachment/Attachment_[0]_050321011842.pdf', '2021-03-05 17:48:42', 102, '2021-03-05 17:48:42', 102, b'1'),
(63, 57, 'Attachment_[0]_050321011849.pdf', '../upload/102/57/Attachment/Attachment_[0]_050321011849.pdf', '2021-03-05 17:48:49', 102, '2021-03-05 17:48:49', 102, b'1'),
(64, 58, 'Attachment_[0]_050321011853.pdf', '../upload/102/58/Attachment/Attachment_[0]_050321011853.pdf', '2021-03-05 17:48:53', 102, '2021-03-05 17:48:53', 102, b'1'),
(65, 59, 'Attachment_[0]_050321011856.pdf', '../upload/102/59/Attachment/Attachment_[0]_050321011856.pdf', '2021-03-05 17:48:56', 102, '2021-03-05 17:48:56', 102, b'1'),
(66, 60, 'Attachment_[0]_050321011902.pdf', '../upload/102/60/Attachment/Attachment_[0]_050321011902.pdf', '2021-03-05 17:49:02', 102, '2021-03-05 17:49:02', 102, b'1'),
(67, 61, 'Attachment_[0]_050321011913.pdf', '../upload/102/61/Attachment/Attachment_[0]_050321011913.pdf', '2021-03-05 17:49:13', 102, '2021-03-05 17:49:13', 102, b'1'),
(68, 62, 'Attachment_[0]_050321011917.pdf', '../upload/102/62/Attachment/Attachment_[0]_050321011917.pdf', '2021-03-05 17:49:17', 102, '2021-03-05 17:49:17', 102, b'1'),
(69, 63, 'Attachment_[0]_050321011920.pdf', '../upload/102/63/Attachment/Attachment_[0]_050321011920.pdf', '2021-03-05 17:49:20', 102, '2021-03-05 17:49:20', 102, b'1');

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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(99, 2, 'Rajesh', 'Mistry', '170320116025.it.parth@gmail.com', '$2y$10$2YIrCty5omLrsbMUg5nra.EpgM37xHznHFKzm3433Rirsdn.BOGzC', b'1', '2021-03-01 12:27:35', 1, '2021-03-01 12:27:35', NULL, b'1'),
(102, 3, 'parth', 'mistry', 'parthmistry7227843533@gmail.com', '$2y$10$eKFfbExrtXeJhSzFUt3speSGyzGHlLFLruUpudJCBiCSHWufCEM.2', b'1', '2021-03-02 21:42:37', NULL, '2021-03-02 21:42:37', NULL, b'1'),
(103, 3, 'heena', 'mistry', 'mistryheena35@gmail.com', '$2y$10$B90dGAm1FtyDSztS4lO4LOIlxrYSK55B1sF7pmktMhfV8BRYwjoQi', b'1', '2021-03-04 15:31:07', NULL, '2021-03-04 15:31:07', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DOB` datetime DEFAULT NULL,
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
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `note_categories`
--
ALTER TABLE `note_categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `note_types`
--
ALTER TABLE `note_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reference_data`
--
ALTER TABLE `reference_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seller_notes`
--
ALTER TABLE `seller_notes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `seller_notes_attachements`
--
ALTER TABLE `seller_notes_attachements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `seller_notes_reported_issues`
--
ALTER TABLE `seller_notes_reported_issues`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_notes_reviews`
--
ALTER TABLE `seller_notes_reviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_configurations`
--
ALTER TABLE `system_configurations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
