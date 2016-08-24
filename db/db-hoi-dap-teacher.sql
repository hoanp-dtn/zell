-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2015 at 05:03 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `utt`
--

-- --------------------------------------------------------

--
-- Table structure for table `utt_qa`
--

CREATE TABLE IF NOT EXISTS `utt_qa` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `time_create` varchar(20) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'null/0 : unreply ; 1:replied',
  `user_type` int(11) NOT NULL COMMENT 'null/0: anonymus; 1:logged',
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utt_qa`
--

INSERT INTO `utt_qa` (`id`, `name`, `email`, `value`, `time_create`, `teacher_id`, `status`, `user_type`, `parent_id`) VALUES
(1, 'Anh', 'myheavenhh3@gmail.com', 'Đây là câu hỏi test thử thôi =))', '1441378884', 8, 1, 0, 0),
(2, '', '', 'Vâng! Tôi biết :3', '1441378977', 8, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `utt_qa`
--
ALTER TABLE `utt_qa`
 ADD PRIMARY KEY (`id`), ADD KEY `email` (`email`), ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utt_qa`
--
ALTER TABLE `utt_qa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
