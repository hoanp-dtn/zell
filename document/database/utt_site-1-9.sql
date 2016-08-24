-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2015 at 11:35 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

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
-- Table structure for table `utt_site`
--

CREATE TABLE IF NOT EXISTS `utt_site` (
  `id` int(11) NOT NULL,
  `template_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `footer_info` text,
  `desc` varchar(500) DEFAULT NULL,
  `keyword` varchar(300) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `name_header_vn` varchar(255) NOT NULL,
  `name_header_en` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utt_site`
--

INSERT INTO `utt_site` (`id`, `template_id`, `name`, `url_name`, `logo`, `banner`, `footer_info`, `desc`, `keyword`, `title`, `department_id`, `name_header_vn`, `name_header_en`) VALUES
(1, 1, 'utt', 'utt', 'logo.png', NULL, '', 'đại học công nghệ gtvt', '', 'Đại Học Công Nghệ Giao Thông Vận Tải', 0, 'trang chu', 'trang chu'),
(2, 1, 'qldt', 'quan-li-dao-tao', NULL, NULL, '', '', '', 'Phòng quản lý đào tạo trường đại học công nghệ giao thông vận tải', 2, 'quan li dao tao', 'quan li dao tao'),
(3, 1, 'sinh-vien', 'Sinh Viên', '14410787211.jpg', NULL, 'no', '', '', 'trang sinh viên trường đại học công nghệ giao thông vận tải', 3, '', ''),
(16, 1, 'cntt', 'http://trungtamcokhi.utt.edu.vn', '14403244181.jpg', '14403244193092011154645282.jpg', 'khoa công nghệ thông tin trường đại học công nghệ giao thông vận tải', 'khoa công nghệ thông tin trường đại học công nghệ giao thông vận tải', '', NULL, 4, '', ''),
(19, 2, 'cnn.utt.edu.vn', 'cntt.utt.edu.vn', NULL, NULL, 'khoa công nghệ thông tin trường đại học công nghệ giao thông vận tải', 'khoa công nghệ thông tin trường đại học công nghệ giao thông vận tải', 'đại học công nghệ gtvt, tuyển sinh đại học, đhcngtvt, đh công nghệ gtvt, tuyển sinh 2015, tuyển sinh liên thông, tư vấn tuyển sinh, đh công nghệ gtvt', 'khoa công nghệ thông tin', 1, '', ''),
(18, 1, 'khoa công nghệ thông tin', 'http://www.cntt.edu.vn', NULL, NULL, 'khoa công nghệ thông tin', 'khoa công nghệ thông tin', 'đại học công nghệ gtvt, tuyển sinh đại học, đhcngtvt, đh công nghệ gtvt, tuyển sinh 2015, tuyển sinh liên thông, tư vấn tuyển sinh, đh công nghệ gtvt', 'khoa công nghệ thông tin', 5, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `utt_site`
--
ALTER TABLE `utt_site`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utt_site`
--
ALTER TABLE `utt_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
