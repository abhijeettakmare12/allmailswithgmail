-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2016 at 03:31 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thepromo_all_mail_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `ama_host_list`
--

CREATE TABLE IF NOT EXISTS `ama_host_list` (
`id` int(10) unsigned NOT NULL,
  `host_name` varchar(45) NOT NULL,
  `imap_url` varchar(255) NOT NULL,
  `active_status` int(10) unsigned NOT NULL COMMENT '0= Inactive, 1=Active'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ama_host_list`
--

INSERT INTO `ama_host_list` (`id`, `host_name`, `imap_url`, `active_status`) VALUES
(1, 'Gmail', 'imap.gmail.com:993/imap/ssl/novalidate-cert', 1),
(2, 'Yahoo', 'imap.mail.yahoo.com:993/imap/ssl/novalidate-cert', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ama_mail_type`
--

CREATE TABLE IF NOT EXISTS `ama_mail_type` (
`id` int(10) unsigned NOT NULL,
  `mail_type_name` varchar(45) NOT NULL,
  `param_val` varchar(45) NOT NULL,
  `active_status` int(10) unsigned NOT NULL COMMENT '0=Inactive, 1= Active',
  `list_order` int(10) unsigned NOT NULL,
  `host_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ama_mail_type`
--

INSERT INTO `ama_mail_type` (`id`, `mail_type_name`, `param_val`, `active_status`, `list_order`, `host_id`) VALUES
(2, 'Inbox', 'Inbox', 1, 2, 1),
(3, 'Trash', '[Gmail]/Trash', 1, 6, 1),
(4, 'Spam', '[Gmail]/Spam', 1, 5, 1),
(5, 'Draft', '[Gmail]/Drafts', 1, 4, 1),
(6, 'All', '[Gmail]/All Mail', 1, 1, 1),
(7, 'Sent Mails', '[Gmail]/Sent Mail', 1, 3, 1),
(8, 'Inbox', 'Inbox', 1, 2, 2),
(9, 'Sent Mails', 'Sent', 1, 3, 2),
(10, 'Trash', 'Trash', 1, 6, 2),
(11, 'Draft', 'Draft', 1, 4, 2),
(12, 'Spam', 'Bulk Mail', 1, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ama_options`
--

CREATE TABLE IF NOT EXISTS `ama_options` (
`id` int(10) unsigned NOT NULL,
  `option_key` varchar(45) NOT NULL,
  `option_val` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ama_user_mapped_accounts`
--

CREATE TABLE IF NOT EXISTS `ama_user_mapped_accounts` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `host_id` int(10) unsigned NOT NULL,
  `n_account_email` varchar(55) NOT NULL,
  `n_account_password` varchar(255) NOT NULL,
  `account_status` int(10) unsigned NOT NULL COMMENT '0=Inactive, 1=Active',
  `isPrimary` int(10) unsigned NOT NULL COMMENT '1= Yes'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ama_user_mapped_accounts`
--

INSERT INTO `ama_user_mapped_accounts` (`id`, `user_id`, `host_id`, `n_account_email`, `n_account_password`, `account_status`, `isPrimary`) VALUES
(1, 5, 1, 'abhijeettakmare97@gmail.com', 'abhi@123', 1, 1),
(2, 5, 2, 'pratap782016@yahoo.com', 'pr@t@p@78', 1, 0),
(3, 5, 1, 'pratap872016@gmail.com', 'pratap@78', 1, 0),
(5, 7, 1, 'vaibhavrajevashi@gmail.com', 'Vaibhava1122', 1, 1),
(6, 8, 1, 'abhinewtestacc1212@gmail.com', 'aqswdefr', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `amp_users`
--

CREATE TABLE IF NOT EXISTS `amp_users` (
`id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `user_status` int(10) unsigned NOT NULL COMMENT '0 = InActive, 1 = Active',
  `user_registered_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amp_users`
--

INSERT INTO `amp_users` (`id`, `first_name`, `user_status`, `user_registered_date`) VALUES
(5, 'Abhijeet', 1, '2016-07-12 09:33:24'),
(7, 'Vaibhav', 1, '2016-07-12 16:07:02'),
(8, 'Test Reg', 1, '2016-07-12 16:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `amp_users_information`
--

CREATE TABLE IF NOT EXISTS `amp_users_information` (
`user_id` int(10) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_registered_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amp_users_information`
--

INSERT INTO `amp_users_information` (`user_id`, `user_firstname`, `user_email`, `user_password`, `user_registered_date`) VALUES
(1, 'test', 'test@gmail.com', 'test', '2016-07-18 10:26:44'),
(2, 'test', 'a@gmail.com', 'aa', '2016-07-18 12:11:32'),
(3, 'test', 'abhijeettakmare97@gmail.com', 'aa', '2016-07-18 12:12:02'),
(4, 'b', 'b@gmail.com', 'b', '2016-07-18 12:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `users_gmail_accountinfo`
--

CREATE TABLE IF NOT EXISTS `users_gmail_accountinfo` (
`user_gmailacc_id` int(6) unsigned NOT NULL,
  `user_gmail_id` int(80) NOT NULL,
  `user_gmail_email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_gmail_accountinfo`
--

INSERT INTO `users_gmail_accountinfo` (`user_gmailacc_id`, `user_gmail_id`, `user_gmail_email`) VALUES
(1, 2147483647, 'abhijeettakmare97@gmail.com'),
(2, 2147483647, 'abhi1572016@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ama_host_list`
--
ALTER TABLE `ama_host_list`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ama_mail_type`
--
ALTER TABLE `ama_mail_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ama_options`
--
ALTER TABLE `ama_options`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ama_user_mapped_accounts`
--
ALTER TABLE `ama_user_mapped_accounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amp_users`
--
ALTER TABLE `amp_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amp_users_information`
--
ALTER TABLE `amp_users_information`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_gmail_accountinfo`
--
ALTER TABLE `users_gmail_accountinfo`
 ADD PRIMARY KEY (`user_gmailacc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ama_host_list`
--
ALTER TABLE `ama_host_list`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ama_mail_type`
--
ALTER TABLE `ama_mail_type`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ama_options`
--
ALTER TABLE `ama_options`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ama_user_mapped_accounts`
--
ALTER TABLE `ama_user_mapped_accounts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `amp_users`
--
ALTER TABLE `amp_users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `amp_users_information`
--
ALTER TABLE `amp_users_information`
MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_gmail_accountinfo`
--
ALTER TABLE `users_gmail_accountinfo`
MODIFY `user_gmailacc_id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
