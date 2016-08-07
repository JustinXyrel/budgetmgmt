-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2016 at 01:54 PM
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

CREATE TABLE `tbl_announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_budget_request`
--

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
  `is_reimbursement` tinyint(4) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_budget_request`
--

INSERT INTO `tbl_budget_request` (`id`, `project_leader`, `project_id`, `sponsor_id`, `grant_id`, `cost`, `line_item`, `remarks`, `is_granted`, `is_reimbursement`, `create_date`) VALUES
(1, 9, 2, 1, 2, '16', '1', 'test', 3, 1, '2016-06-12 09:31:30'),
(2, 9, 2, 1, 2, '18', '1', 'test', 3, 0, '2016-06-12 09:39:18'),
(3, 9, 2, 1, 2, '18', '1', 'test', 3, 0, '2016-06-12 09:41:05'),
(4, 9, 2, 1, 2, '18', '1', '', 1, 0, '2016-06-12 09:43:24'),
(5, 9, 2, 1, 2, '18', '1', '', 1, 0, '2016-06-12 09:46:05'),
(6, 9, 2, 1, 2, '18', '1', '', 1, 0, '2016-06-12 09:48:32'),
(7, 9, 2, 1, 2, '18', '1', '', 1, 0, '2016-06-12 09:58:10'),
(8, 9, 2, 1, 2, '18', '1', '', 3, 0, '2016-06-12 10:09:26'),
(9, 10, 1, 1, 2, '50', '1', 'test', 1, 0, '2016-06-12 10:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents`
--

CREATE TABLE `tbl_documents` (
  `id` int(11) NOT NULL,
  `budget_request_id` int(11) DEFAULT NULL,
  `filename` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grants`
--

CREATE TABLE `tbl_grants` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grants`
--

INSERT INTO `tbl_grants` (`id`, `name`, `sponsor_id`, `create_date`) VALUES
(1, 'Johnny Jones', 1, '2016-06-12 04:39:04'),
(2, 'Kelly Smith', 1, '2016-06-12 04:40:42'),
(3, 'Kaye Thompson', 2, '2016-06-12 04:40:53'),
(4, 'Love Chi', 2, '2016-06-12 04:41:03'),
(5, 'Jenny Liang', 3, '2016-06-12 04:41:15'),
(6, 'Chun Chi', 3, '2016-06-12 04:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_line_items`
--

CREATE TABLE `tbl_line_items` (
  `id` int(11) NOT NULL,
  `line_item` varchar(256) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_line_items`
--

INSERT INTO `tbl_line_items` (`id`, `line_item`, `create_date`) VALUES
(1, 'Transportation Allowance', '2016-06-12 04:37:52'),
(3, 'Project Bonus', '2016-06-12 04:37:59'),
(4, 'Food Allowance', '2016-06-12 04:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manage`
--

CREATE TABLE `tbl_manage` (
  `id` int(12) NOT NULL,
  `project_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `user_role` int(12) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_manage`
--

INSERT INTO `tbl_manage` (`id`, `project_id`, `user_id`, `user_role`, `create_date`) VALUES
(1, 1, 9, 2, '2016-06-12 04:41:55'),
(2, 1, 10, 2, '2016-06-12 04:41:55'),
(3, 1, 11, 3, '2016-06-12 04:41:55'),
(4, 2, 9, 2, '2016-06-12 04:42:05'),
(5, 2, 11, 3, '2016-06-12 04:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE `tbl_projects` (
  `id` int(15) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`id`, `name`, `create_date`) VALUES
(1, 'Support System', '2016-06-12 04:35:53'),
(2, 'Bugs Management', '2016-06-12 04:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(12) NOT NULL,
  `role` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Project Leader'),
(3, 'Project Member');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sponsors`
--

CREATE TABLE `tbl_sponsors` (
  `id` int(12) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sponsors`
--

INSERT INTO `tbl_sponsors` (`id`, `name`, `create_date`) VALUES
(1, 'Koala Technologies Inc.', '2016-06-12 04:38:27'),
(2, 'Miranda Group of Companies', '2016-06-12 04:38:39'),
(3, 'Shoe Castle', '2016-06-12 04:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans`
--

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
  `status` int(2) DEFAULT '1',
  `trans_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trans`
--

INSERT INTO `tbl_trans` (`id`, `project_id`, `project_leader`, `sponsor_id`, `grant_id`, `line_item`, `type`, `cost`, `remarks`, `status`, `trans_date`) VALUES
(10, 2, NULL, 1, 2, '1', 'Debit', 20, 'test koala', 1, '2016-06-12 08:10:08'),
(11, 2, NULL, 3, 5, '3', 'Debit', 400, 'test bugs', 1, '2016-06-12 08:10:08'),
(12, 1, NULL, 1, 2, '1', 'Debit', 200, 'tets koala', 1, '2016-06-12 08:10:08'),
(13, 1, NULL, 2, 3, '1', 'Debit', 200, 'test miaranda', 1, '2016-06-12 08:10:08'),
(15, 1, NULL, 2, 3, '1', 'Credit', 200, 'test', 1, '2016-06-12 08:59:49'),
(16, 2, NULL, 1, 2, '1', 'Credit', 1, 'test', 1, '2016-06-12 08:59:49'),
(17, 1, NULL, 2, 3, '1', 'Credit', 20, 'test', 2, '2016-06-12 08:59:49'),
(18, 1, NULL, 2, 3, '1', 'Credit', 200, 'test', 2, '2016-06-12 09:00:59'),
(19, 2, NULL, 1, 2, '1', 'Credit', 1, 'test', 1, '2016-06-12 09:00:59'),
(20, 1, NULL, 2, 3, '1', 'Credit', 20, 'test', 2, '2016-06-12 09:00:59'),
(21, 2, 9, 1, NULL, '1', 'Credit', 18, NULL, 1, '2016-06-11 10:04:42'),
(22, 2, 9, 1, NULL, '1', 'Credit', 18, NULL, 1, '2016-06-12 10:04:47'),
(23, 2, 9, 1, NULL, '1', 'Credit', 18, NULL, 1, '2016-06-13 10:05:31'),
(24, 2, 9, 1, 2, '1', 'Credit', 18, NULL, 1, '2016-06-12 10:10:10'),
(25, 1, 10, 1, 2, '1', 'Credit', 50, NULL, 1, '2016-06-12 11:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

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
(1, 'Admin', 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1, '2016-03-01 13:18:35'),
(9, 'Justin Developer', 'justin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 2, '2016-06-12 04:32:18'),
(10, 'Jell Developer', 'jell', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 2, '2016-06-12 04:33:20'),
(11, 'Kenny Logs', 'kenny', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 3, '2016-06-12 04:34:01');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_budget_request`
--
ALTER TABLE `tbl_budget_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_grants`
--
ALTER TABLE `tbl_grants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_line_items`
--
ALTER TABLE `tbl_line_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_manage`
--
ALTER TABLE `tbl_manage`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_sponsors`
--
ALTER TABLE `tbl_sponsors`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_trans`
--
ALTER TABLE `tbl_trans`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
