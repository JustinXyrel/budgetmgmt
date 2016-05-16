-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2016 at 02:25 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_assets`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcements`
--

DROP TABLE IF EXISTS `tbl_announcements`;
CREATE TABLE `tbl_announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_announcements`
--

INSERT INTO `tbl_announcements` (`id`, `title`, `description`, `create_date`, `update_date`) VALUES
(1, 'Justin', 'This is a test announcement', '2016-04-11 01:28:53', NULL),
(2, 'Custome Link Text, hover when chosen to check.', ' You can also choose to show the title or not, and where. Add to any news item the following code and viola!: ', '2016-04-11 08:00:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_budget_request`
--

DROP TABLE IF EXISTS `tbl_budget_request`;
CREATE TABLE `tbl_budget_request` (
  `id` int(11) NOT NULL,
  `project_leader` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `grant_id` int(11) DEFAULT NULL,
  `cost` varchar(10) DEFAULT NULL,
  `line_item` varchar(256) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `is_granted` tinyint(4) NOT NULL DEFAULT '0',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents`
--

DROP TABLE IF EXISTS `tbl_documents`;
CREATE TABLE `tbl_documents` (
  `id` int(11) NOT NULL,
  `budget_request_id` int(11) DEFAULT NULL,
  `filename` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grants`
--

DROP TABLE IF EXISTS `tbl_grants`;
CREATE TABLE `tbl_grants` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_line_items`
--

DROP TABLE IF EXISTS `tbl_line_items`;
CREATE TABLE `tbl_line_items` (
  `id` int(11) NOT NULL,
  `line_item` varchar(256) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manage`
--

DROP TABLE IF EXISTS `tbl_manage`;
CREATE TABLE `tbl_manage` (
  `id` int(12) NOT NULL,
  `project_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `user_role` int(12) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

DROP TABLE IF EXISTS `tbl_projects`;
CREATE TABLE `tbl_projects` (
  `id` int(15) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE `tbl_roles` (
  `id` int(12) NOT NULL,
  `role` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sponsors`
--

DROP TABLE IF EXISTS `tbl_sponsors`;
CREATE TABLE `tbl_sponsors` (
  `id` int(12) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans`
--

DROP TABLE IF EXISTS `tbl_trans`;
CREATE TABLE `tbl_trans` (
  `id` int(12) NOT NULL,
  `project_id` int(12) DEFAULT NULL,
  `project_leader` int(12) DEFAULT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `grant_id` int(1) DEFAULT NULL,
  `line_item` varchar(256) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `trans_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(12) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role` int(2) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `password`, `role`, `create_date`) VALUES
(1, 'Admin', 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1, '2016-03-01 13:18:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_budget_request`
--
ALTER TABLE `tbl_budget_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_grants`
--
ALTER TABLE `tbl_grants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_line_items`
--
ALTER TABLE `tbl_line_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manage`
--
ALTER TABLE `tbl_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sponsors`
--
ALTER TABLE `tbl_sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_trans`
--
ALTER TABLE `tbl_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_budget_request`
--
ALTER TABLE `tbl_budget_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_grants`
--
ALTER TABLE `tbl_grants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_line_items`
--
ALTER TABLE `tbl_line_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_manage`
--
ALTER TABLE `tbl_manage`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sponsors`
--
ALTER TABLE `tbl_sponsors`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_trans`
--
ALTER TABLE `tbl_trans`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
