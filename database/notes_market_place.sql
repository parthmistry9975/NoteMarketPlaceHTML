-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2021 at 03:44 PM
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
  `IsActive` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `RoleID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(24) NOT NULL,
  `IsEmailVerified` bit(1) NOT NULL DEFAULT b'0',
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `NoteID` (`NoteID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note_categories`
--
ALTER TABLE `note_categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note_types`
--
ALTER TABLE `note_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reference_data`
--
ALTER TABLE `reference_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_notes`
--
ALTER TABLE `seller_notes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_notes_attachements`
--
ALTER TABLE `seller_notes_attachements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller_notes` (`ID`),
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
  ADD CONSTRAINT `seller_notes_attachements_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller_notes` (`ID`);

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
