-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2015 at 03:30 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `field_training_management_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `date`, `active`) VALUES
(1, 'تكنولوجيا معلومات', '2015-12-13 00:48:19', 1),
(2, 'محاسبة', '2015-12-12 15:49:25', 1),
(3, 'أدارة', '2015-12-12 15:49:26', 1),
(4, 'محامة', '2015-12-12 15:49:36', 1),
(5, 'صيدلية', '2015-12-12 15:49:33', 1),
(6, 'تمريض', '2015-12-12 15:49:30', 1),
(7, 'هندسة مدنية ', '2015-12-12 15:49:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE IF NOT EXISTS `college` (
  `id` int(11) NOT NULL,
  `id_university` int(11) NOT NULL,
  `name` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `id_university`, `name`, `active`) VALUES
(1, 1, 'Information Technology  ', 1),
(4, 4, 'sadsadsadasdasdasd', 1),
(5, 4, 'محاسبة', 1),
(6, 4, 'محاسبة2', 0),
(7, 4, 'محاسبة222', 0),
(8, 4, 'محاسبة2223', 0),
(9, 4, 'محاسبة222333', 0),
(10, 4, 'محاسبة22233333', 0),
(11, 4, 'محاسبة2223323424333', 0),
(12, 4, '324234324', 0),
(13, 4, '324234324', 0),
(14, 4, '324234324', 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `mobile` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `id_category`, `name`, `description`, `mobile`, `phone`, `address`, `date_in`, `active`) VALUES
(1, 1, 'الصقر للأخشاب', 'شركة الوحدة التجارية للتجارة أخشاب و المكاتب', '0798981496', '798981496', 'الاردن - عمان - طبربور ', '2015-12-12 14:36:48', 1),
(3, 1, 'الصلاحات للبرمجيات', 'برامج , مواقع أنترنت , انظمة حوسبة ,. ألعاب', '0798981496', '0798981496', 'الاردن - عمان - اللويبدة ', '2015-12-12 14:36:25', 1),
(4, 6, '13قص34324', '2234324', '4324234', '5234', '33423432', '2015-12-19 22:05:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE IF NOT EXISTS `degree` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `star_number` int(11) NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`id`, `name`, `star_number`, `date_in`, `active`) VALUES
(1, 'سيء جداً', 1, '2015-12-13 07:20:31', 1),
(2, 'سيء', 2, '2015-12-12 22:21:05', 1),
(3, 'جيد', 3, '2015-12-12 22:21:07', 1),
(4, 'جيد جداً', 4, '2015-12-12 22:21:10', 1),
(5, 'ممتاز', 5, '2015-12-12 22:21:09', 1),
(6, 'تحت المعالجة', 0, '2015-12-20 07:11:35', 0),
(7, 'عمل ساعات اضافية', 0, '2015-12-20 07:13:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL,
  `id_companies` int(11) NOT NULL,
  `name` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `id_companies`, `name`, `date_in`, `active`) VALUES
(1, 1, 'تكنولوجيا المعلومات', '2015-12-12 15:03:26', 1),
(2, 3, 'أدارة المالية', '2015-12-12 16:14:20', 1),
(3, 1, 'أدارة تنفيذية', '2015-12-12 16:14:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE IF NOT EXISTS `models` (
  `id` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_companies` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `id_supervisor` int(11) NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `id_student`, `id_companies`, `id_department`, `id_section`, `id_supervisor`, `date_in`, `active`) VALUES
(1, 7, 1, 1, 1, 1, '2015-12-26 13:55:56', 1),
(4, 8, 1, 1, 1, 1, '2015-12-26 12:19:26', 1),
(5, 9, 1, 1, 1, 1, '2015-12-26 09:19:42', 0),
(6, 10, 1, 1, 1, 1, '2015-12-26 09:21:44', 1),
(8, 1, 1, 1, 1, 1, '2015-12-26 21:04:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `onus`
--

CREATE TABLE IF NOT EXISTS `onus` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `onus`
--

INSERT INTO `onus` (`id`, `name`, `description`, `date_in`, `active`) VALUES
(1, 'أتصال مع زبائن ', 'أتصال مع زبائن \nوالخدمات', '2015-12-12 08:35:58', 1),
(2, 'أنشاء كود على php 2', 'أنشاء كود على php', '2015-12-12 20:40:53', 1),
(3, 'أدخال بيانات ', 'أدخال بيانات', '2015-12-19 22:10:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `onus_designate`
--

CREATE TABLE IF NOT EXISTS `onus_designate` (
  `id` int(11) NOT NULL,
  `id_onus` int(11) NOT NULL,
  `id_models` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_degree` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `onus_designate`
--

INSERT INTO `onus_designate` (`id`, `id_onus`, `id_models`, `id_student`, `id_degree`, `status`, `date_in`) VALUES
(1, 1, 1, 1, 4, 1, '2015-12-12 22:21:25'),
(2, 2, 1, 1, 1, 1, '2015-12-13 01:55:21'),
(3, 3, 2, 5, 7, 1, '2015-12-19 22:13:26'),
(4, 3, 1, 1, 7, 1, '2015-12-19 22:16:19'),
(5, 1, 1, 10, 3, 0, '2015-12-26 18:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `name` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `id_department`, `name`, `date_in`, `active`) VALUES
(1, 1, 'قسم الشبكات', '2015-12-12 17:07:16', 1),
(2, 2, 'محاسبة', '2015-12-12 16:29:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specialty`
--

CREATE TABLE IF NOT EXISTS `specialty` (
  `id` int(11) NOT NULL,
  `id_college` int(11) NOT NULL,
  `name` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specialty`
--

INSERT INTO `specialty` (`id`, `id_college`, `name`, `date_in`, `active`) VALUES
(1, 1, 'Software Engineering', '2015-12-12 12:48:36', 1),
(2, 2, 'Accounting', '2015-12-12 12:38:58', 1),
(3, 5, 'ادارة', '2015-12-19 22:01:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL,
  `id_university` int(11) NOT NULL,
  `id_specialty` int(11) NOT NULL,
  `id_college` int(11) NOT NULL,
  `id_supervisor` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `id_university`, `id_specialty`, `id_college`, `id_supervisor`, `first_name`, `last_name`, `username`, `email`, `password`, `status`) VALUES
(1, 1, 1, 1, 1, 'محمد', 'صلاحات', 'ahmad', 'ahmad@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(2, 1, 1, 1, 1, 'أحمد', 'صلاحات', 'mohammad', 'ahmad@gmail.com', 'e034fb6b66aacc1d48f445ddfb08da98', 0),
(4, 1, 1, 1, 1, '2', '2', 'sallma', 'ahmad@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', 0),
(7, 1, 1, 1, 1, 'أحمد ', 'سالم', 'ahmad_s', 'ahmad_s@gmail.com', '2788bd83283420383c5c5009786c546c', 1),
(8, 1, 1, 1, 1, '213123', '123123123', '12123', '123@ggomai.comwds', '77ba63f07da6ad5a429f5b771f71d299', 0),
(9, 1, 1, 1, 1, '123123123', '1231231', '2312312312', '3123123', '2788bd83283420383c5c5009786c546c', 0),
(10, 1, 1, 1, 1, 'mohammad', 'ahmad', 'mohammad', 'mohamma@gmail.com', '2788bd83283420383c5c5009786c546c', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE IF NOT EXISTS `supervisor` (
  `id` int(11) NOT NULL,
  `id_university` int(11) NOT NULL,
  `id_college` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id`, `id_university`, `id_college`, `name`, `username`, `password`, `date_in`, `active`) VALUES
(1, 1, 1, 'ahmad super 3', 'super', 'c4ca4238a0b923820dcc509a6f75849b', '2015-12-19 19:27:55', 1),
(3, 4, 2, 'Dr Jas', 'super_', 'c4ca4238a0b923820dcc509a6f75849b', '2015-12-19 19:28:10', 1),
(4, 4, 2, '55555', 'super_3', 'c4ca4238a0b923820dcc509a6f75849b', '2015-12-19 19:28:14', 0),
(5, 4, 5, 'محمود', '', '', '2015-12-19 22:03:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE IF NOT EXISTS `trainer` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `id_companies` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `date_in` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`, `phone`, `address`, `date_in`, `active`) VALUES
(1, 'الجامعة الهاشمية ', '0798981496', 'الأردن - عمان ', '2015-12-20 06:56:05', 1),
(4, 'الجامعة الألمانية', '0798981496', 'الأردن عمان', '2015-12-12 22:35:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_site`
--

CREATE TABLE IF NOT EXISTS `user_site` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `date_in` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_site`
--

INSERT INTO `user_site` (`id`, `username`, `name`, `password`, `date_in`, `status`) VALUES
(1, 'admin', 'admin site', '2788bd83283420383c5c5009786c546c', '2015-12-09 06:18:17', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexes for table `onus`
--
ALTER TABLE `onus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onus_designate`
--
ALTER TABLE `onus_designate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companies` (`id_companies`),
  ADD KEY `id_department` (`id_department`),
  ADD KEY `id_section` (`id_section`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name_university` (`name`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `user_site`
--
ALTER TABLE `user_site`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `onus`
--
ALTER TABLE `onus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `onus_designate`
--
ALTER TABLE `onus_designate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_site`
--
ALTER TABLE `user_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
