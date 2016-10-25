-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 25, 2016 at 01:22 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospitality`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE IF NOT EXISTS `amenities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `type` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `addedby` int(11) NOT NULL,
  `xdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `type`, `status`, `addedby`, `xdate`) VALUES
(1, 'Free Internet', 2, 0, 0, '2015-08-16 08:43:48'),
(2, 'Audio System', 0, 0, 0, '2015-08-16 08:44:07'),
(6, 'Airport Taxi', 1, 0, 0, '2015-08-25 22:39:29'),
(4, 'Complementary Breakfast', 0, 0, 0, '2015-08-18 09:37:31'),
(7, 'Kitchen', 0, 0, 0, '2015-08-25 22:43:11'),
(8, 'Cable Television', 0, 0, 0, '2015-09-16 23:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_nm` text NOT NULL,
  `thmub_nm` text NOT NULL,
  `logo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `img_nm`, `thmub_nm`, `logo`) VALUES
(24, '18092015144257439812.jpg', '18092015144257439812.jpg', 1),
(2, '12092015144207690510.jpg', '12092015144207690510.jpg', 0),
(25, '1909201514426635802.jpg', '1909201514426635802.jpg', 0),
(26, '19092015144266359217.jpg', '19092015144266359217.jpg', 0),
(27, '1909201514426636069.jpg', '1909201514426636069.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fulname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `mobile_no` varchar(25) NOT NULL,
  `user_role` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `xdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `fulname`, `username`, `password`, `mobile_no`, `user_role`, `status`, `xdate`) VALUES
(1, 'Anyadike Iheanyi', 'nkacy', 'mybliss', '08064342060', 'administrator', 0, '2015-08-24 18:36:12'),
(2, 'Obidike Nneoma', 'nene41luv', '1234', '08037480474', 'frontdesk', 0, '2015-08-24 20:00:17'),
(4, 'John Nnanna', 'john', 'nnanna', '08064342062', 'content_mgr', 0, '2015-09-05 22:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `property_setting`
--

CREATE TABLE IF NOT EXISTS `property_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `settings` varchar(15) NOT NULL,
  `site_title` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `analytics_id` text NOT NULL,
  `adword_std` text NOT NULL,
  `adword_conv` text NOT NULL,
  `widget` text NOT NULL,
  `slide_title` tinyint(1) NOT NULL DEFAULT '0',
  `about_menu` tinyint(1) NOT NULL DEFAULT '0',
  `rev_em` text NOT NULL,
  `res_em_alert` tinyint(1) NOT NULL DEFAULT '0',
  `guest_em_alert` tinyint(1) NOT NULL DEFAULT '0',
  `sms_domain` text NOT NULL,
  `api` text NOT NULL,
  `base_em` text NOT NULL,
  `subac` text NOT NULL,
  `sub_pw` text NOT NULL,
  `sender_id` text NOT NULL,
  `res_sms_alert` tinyint(1) NOT NULL DEFAULT '0',
  `respt_sms_no` text NOT NULL,
  `guest_sms_alert` tinyint(1) NOT NULL DEFAULT '0',
  `master` tinyint(1) NOT NULL DEFAULT '0',
  `visa` tinyint(1) NOT NULL DEFAULT '0',
  `verve` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `promo_rate` tinyint(1) NOT NULL DEFAULT '0',
  `xdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `property_setting`
--

INSERT INTO `property_setting` (`id`, `settings`, `site_title`, `meta_title`, `meta_desc`, `meta_keyword`, `analytics_id`, `adword_std`, `adword_conv`, `widget`, `slide_title`, `about_menu`, `rev_em`, `res_em_alert`, `guest_em_alert`, `sms_domain`, `api`, `base_em`, `subac`, `sub_pw`, `sender_id`, `res_sms_alert`, `respt_sms_no`, `guest_sms_alert`, `master`, `visa`, `verve`, `disabled`, `promo_rate`, `xdate`) VALUES
(1, 'settings', 'Explore Luxury Apartments', 'Explore Luxury Apartments ', 'Explore Luxury Apartments for you', 'Hotel booking, Best hotel price, Hotel reservation', 'Google Analytics id', 'Google Adwords standard code', 'Google Adwords Conversion code', '<div id="TA_cdswritereviewnew686" class="TA_cdswritereviewnew">\r\n<ul id="BAQQHPNCZc2j" class="TA_links 8rUuiMCvKyC">\r\n<li id="vG2kEdT" class="zoECvBw">\r\n<a target="_blank" href="http://www.tripadvisor.com/"><img src="http://www.tripadvisor.com/img/cdsi/img2/branding/medium-logo-29834-2.png" alt="TripAdvisor"/></a>\r\n</li>\r\n</ul>\r\n</div>\r\n<script src="http://www.jscache.com/wejs?wtype=cdswritereviewnew&uniq=686&locationId=4379539&lang=en_US&border=true&display_version=2"></script>', 0, 0, 'reservation@aesluxury.com', 1, 1, 'smsluxury.com', 'http://www.smsluxury.com/api/index.php?', 'nkacy2001@yahoo.co.uk', 'hotelexplorer', '123456', 'HotelXplore', 1, '08172127295', 1, 1, 1, 1, 1, 1, '2015-08-20 15:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_setup`
--

CREATE TABLE IF NOT EXISTS `property_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rec_type` text NOT NULL,
  `property_nm` text NOT NULL,
  `pn` text NOT NULL,
  `fax` text NOT NULL,
  `rev_pn` text NOT NULL,
  `em` text NOT NULL,
  `property_type` text NOT NULL,
  `website` text NOT NULL,
  `property_grade` text NOT NULL,
  `fb_link` text NOT NULL,
  `yt_link` text NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zipcode` text NOT NULL,
  `country` text NOT NULL,
  `book_condition` text NOT NULL,
  `checkin_policy` text NOT NULL,
  `can_policy` text NOT NULL,
  `hotel_policy` text NOT NULL,
  `hotel_desc` text NOT NULL,
  `parking_policy` text NOT NULL,
  `confirm_msg` text NOT NULL,
  `xdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `property_setup`
--

INSERT INTO `property_setup` (`id`, `rec_type`, `property_nm`, `pn`, `fax`, `rev_pn`, `em`, `property_type`, `website`, `property_grade`, `fb_link`, `yt_link`, `address1`, `address2`, `city`, `state`, `zipcode`, `country`, `book_condition`, `checkin_policy`, `can_policy`, `hotel_policy`, `hotel_desc`, `parking_policy`, `confirm_msg`, `xdate`) VALUES
(1, 'setup', 'AES Luxury Apartments', '+2348064342060', '+2348064342061', '+2348052031697', 'it@aesluxury.com', 'Hotel', 'http://aesluxuryapartment.com', '5 stars', 'https://www.facebook.com/wantsnip', 'https://www.youtube.com/watch?v=AG7v8jJKAOk', 'Plot 1118, Daki Biu District, Along Jabi Airport Road, ', 'Opposite Citec Estate,', 'FCT', 'ABUJA', '011999', 'Nigeria', '<p>Booking Conditions</p>\r\n', '<p>Florist, Laundry, Television, Hair Dryer, Telephone, Car Rental, Air-conditioning, Non-smoking rooms, Mini bar / Fridge, In-House Movies, Security key card, Safe Deposit Box, Foreign Exchange, Business Services, Cable/Satellite TV, 24 hour Room Service, Complimentary snacks, Free Wi Fi Internet Access, Complimentary newspaper, Housekeeping Service daily, Complimentary Car Parking<br />\r\nComplimentary tea &amp; coffee.</p>\r\n', '<p>Cancellation Policy</p>\r\n', '<p>Hotel Policy</p>\r\n', '<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>The hotel has limited parking available in its premises for its hotel guests. However, ample street parking is available.</p>\r\n', '<p>Tour and Reward Membership is a package designed to encourage people go on tours and still earn constantly increasing rewards at each level once registered as a member. There are 12 levels. One begins going on a tour from level 5 which is within Nigeria, then West Africa, Middle East, Asia, Europe and finally America.</p>\r\n', '2015-08-03 22:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_no` text NOT NULL,
  `title` text NOT NULL,
  `guest_nm` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `addr` text NOT NULL,
  `arr` text NOT NULL,
  `dept` text NOT NULL,
  `nights` int(11) NOT NULL,
  `pax` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `no_of_rm` int(11) NOT NULL,
  `source` text NOT NULL,
  `rate` double NOT NULL,
  `vou` text NOT NULL,
  `vou_rate` double NOT NULL,
  `extra` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `void` tinyint(1) NOT NULL DEFAULT '0',
  `cancel` tinyint(1) NOT NULL DEFAULT '0',
  `ip` text NOT NULL,
  `rev_date` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL,
  `xdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `res_no`, `title`, `guest_nm`, `phone`, `email`, `addr`, `arr`, `dept`, `nights`, `pax`, `adult`, `child`, `room`, `no_of_rm`, `source`, `rate`, `vou`, `vou_rate`, `extra`, `status`, `void`, `cancel`, `ip`, `rev_date`, `month`, `year`, `xdate`) VALUES
(1, 'ZNHE1Y', 'Mr.', 'Nnenna Ndukwe', '09098873002', 'nnenna@yahoo.com', 'No. 122 Kurudu Area, Ajaye Lagos State', '09/20/2015', '09/25/2015', 5, 1, 1, 0, 6, 1, '', 600000, '', 0, 0, 0, 1, 0, '', '09/17/2015', '09', '2015', '2015-09-17 13:28:40'),
(2, 'VL8JWQ', 'Mr.', 'Prince Anyadike', '09098873000', 'exploreteq@gmail.com', '131 Bauchi Road', '09/17/2015', '09/19/2015', 2, 1, 1, 0, 6, 1, '', 240000, '', 0, 0, 0, 0, 0, '', '09/17/2015', '09', '2015', '2015-09-17 18:08:34'),
(3, 'FLXPOO', 'Mr.', 'Prince Anyadike', '09098873000', 'exploreteq@gmail.com', '131 Bauchi Road', '09/17/2015', '09/27/2015', 10, 2, 2, 0, 3, 1, '', 305000, '', 0, 0, 0, 0, 0, '', '09/17/2015', '09', '2015', '2015-09-17 18:17:45'),
(4, '1157VT', 'Mr.', 'Prince Anyadike', '08064342060', 'exploreteq@gmail.com', 'Plot 131B Bauchi Road,\r\nKubwa, FCT Abuja.', '09/17/2015', '09/18/2015', 1, 1, 1, 0, 4, 1, '', 70000, '', 0, 0, 0, 0, 0, '', '09/17/2015', '09', '2015', '2015-09-17 23:48:23'),
(5, 'YFXVEV', 'Mr.', 'Prince Anyadike', '08064342060', 'exploreteq@gmail.com', 'Plot 131B Bauchi Road,\r\nKubwa, FCT Abuja.', '09/17/2015', '09/18/2015', 1, 1, 1, 0, 3, 1, '', 30500, '', 0, 0, 0, 0, 0, '', '09/17/2015', '09', '2015', '2015-09-17 23:59:14'),
(6, 'JKZIRX', 'Mr.', 'Prince Anyadike', '08064342060', 'exploreteq@gmail.com', 'Plot 131B Bauchi Road,\r\nKubwa, FCT Abuja.', '09/18/2015', '09/19/2015', 1, 1, 1, 0, 3, 1, '', 30500, '', 0, 0, 1, 0, 0, '', '09/18/2015', '09', '2015', '2015-09-18 09:24:30'),
(7, 'SJXCPK', 'Mr.', 'Anyadike Iheanyi', '08064342060', 'ask4pina@hotmail.com', '1118 Daki Biu Jabi Airport Road, FCT Abuja', '09/19/2015', '09/20/2015', 1, 1, 1, 0, 4, 1, '', 70000, '', 0, 0, 0, 0, 0, '', '09/18/2015', '09', '2015', '2015-09-18 09:28:12'),
(8, 'YJU6QU', 'Mr.', 'Dahiru Daniel', '08064342060', 'daniel@gmail.com', '131 Bauchi Road ', '09/18/2015', '09/19/2015', 1, 1, 1, 0, 6, 1, '', 120000, '', 0, 0, 1, 0, 0, '', '09/18/2015', '09', '2015', '2015-09-18 09:29:54'),
(9, 'GFC2UZ', 'Mr.', 'Nnenna Ndukwe', '09098873000', 'nkacy2001@yahoo.co.uk', '', '09/18/2015', '09/19/2015', 1, 1, 1, 0, 6, 1, '', 120000, '', 0, 0, 1, 0, 0, '', '09/18/2015', '09', '2015', '2015-09-18 10:23:00'),
(10, 'ZV8NWB', 'Mr', 'Prince Anyadike', '08064342060', 'exploreteq@gmail.com', '', '10/07/2015', '10/08/2015', 1, 1, 1, 0, 3, 1, '', 30000, '', 0, 0, 0, 0, 0, '', '10/07/2015', '10', '2015', '2015-10-07 16:05:37'),
(11, 'VF\r6TP', 'Mr', 'Prince Anyadike', '+2348064342060', 'exploreteq@gmail.com', '131 Bauchi Road', '12/03/2015', '12/04/2015', 1, 1, 1, 0, 3, 1, '', 30000, '', 0, 0, 0, 0, 0, '', '12/03/2015', '12', '2015', '2015-12-03 15:10:01'),
(12, 'GWOXIY', 'Mr', 'Prince Anyadike', '+2348064342060', 'nkacy2001@yahoo.co.uk', '131 Bauchi Road', '12/03/2015', '12/04/2015', 1, 1, 1, 0, 4, 1, '', 70000, '', 0, 0, 0, 0, 0, '', '12/03/2015', '12', '2015', '2015-12-03 15:25:29'),
(13, 'K6WHKF', 'Mr', 'Prince Anyadike', '+2348064342060', 'nkacy2001@yahoo.co.uk', '131 Bauchi Road', '12/03/2015', '12/04/2015', 1, 1, 1, 0, 4, 1, '', 70000, '', 0, 0, 0, 0, 0, '', '12/03/2015', '12', '2015', '2015-12-03 17:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `rmtype_imgs`
--

CREATE TABLE IF NOT EXISTS `rmtype_imgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rmtype_id` int(11) NOT NULL,
  `img_nm` text NOT NULL,
  `thmub_nm` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `xdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `rmtype_imgs`
--

INSERT INTO `rmtype_imgs` (`id`, `rmtype_id`, `img_nm`, `thmub_nm`, `status`, `xdate`) VALUES
(1, 3, '20150912144207701825.jpg', '20150912144207701825.jpg', 0, '2015-09-12 18:56:42'),
(2, 3, '20150912144207705114.jpg', '20150912144207705114.jpg', 0, '2015-09-12 18:57:14'),
(3, 4, '2015091214420779056.jpg', '2015091214420779056.jpg', 0, '2015-09-12 19:11:28'),
(4, 4, '20150912144207794013.jpg', '20150912144207794013.jpg', 0, '2015-09-12 19:12:03'),
(8, 6, '20150912144208861415.jpg', '20150912144208861415.jpg', 0, '2015-09-12 22:09:58'),
(6, 6, '2015091214420779979.jpg', '2015091214420779979.jpg', 0, '2015-09-12 19:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE IF NOT EXISTS `room_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_nm` text NOT NULL,
  `m_adult` int(11) NOT NULL,
  `m_child` int(11) NOT NULL,
  `amenities` text NOT NULL,
  `descr` text NOT NULL,
  `rack_rate` double NOT NULL,
  `promo_rate` double NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `xdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `type_nm`, `m_adult`, `m_child`, `amenities`, `descr`, `rack_rate`, `promo_rate`, `featured`, `status`, `sort`, `xdate`) VALUES
(3, 'Standard King', 2, 1, '2, 8, 4, 1', 'When you look at how aggressive men are towards sex you may think that what a man needs from a woman is sex. Of course, if he has not married you yet or he does not really intend to marry you what he will need from you is here', 30000, 151, 1, 0, 1, '2015-08-16 15:02:31'),
(4, 'Deluxe Apartment', 2, 1, '2, 8, 4, 1, 7', 'But if he really intends to marry you or if you guys are already married sex is never what he needs from you - maybe let me say it better;', 70000, 44000, 1, 0, 2, '2015-08-16 21:13:50'),
(6, 'Executive Apartment', 2, 2, '2, 8, 4, 1, 7', '. A creative, rock solid, responsive template for your business and to showcase your portfolios. This premimum template comes with many features and 24x7 support.', 120000, 0, 1, 0, 3, '2015-09-09 23:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `descr` text NOT NULL,
  `img_nm` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `descr`, `img_nm`, `status`) VALUES
(9, 'Swimming Pool', 'Whatever area of the travel industry you''re in, this elegant newsletter template has been specifically designed for you. With a drag & drop builder interface and 30 optional modules to choose from, you can quickly create and send a professional newsletter to your many eager travel subscribers in no time.', '20150913144214260323.jpg', 0),
(8, 'Elegant Travel Newsletter', 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.', '20150913144214255325.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `img_nm` text NOT NULL,
  `pg_cover` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `img_nm`, `pg_cover`, `status`) VALUES
(12, '', '20150910144187034013.jpg', 0, 0),
(11, '', '20150910144187033015.jpg', 0, 0),
(10, 'Welcome to AES Luxury Apartments', '2015091014418703172.jpg', 0, 0),
(13, '', '20150910144187034820.jpg', 0, 0),
(14, '', '2015091014418703545.jpg', 0, 0),
(15, '', '2015091014418703601.jpg', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
