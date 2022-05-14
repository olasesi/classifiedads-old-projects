-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 12:24 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshoptwo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_banner`
--

CREATE TABLE `ad_banner` (
  `ad_banner_id` int(11) NOT NULL,
  `ad_position` int(11) NOT NULL,
  `ad_name` varchar(20) NOT NULL,
  `ad_link` varchar(255) NOT NULL,
  `ad_banner_image` varchar(255) NOT NULL,
  `ad_banner_timestamp` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ad_header`
--

CREATE TABLE `ad_header` (
  `ad_header_id` int(11) NOT NULL,
  `username_header` varchar(18) NOT NULL,
  `header` varchar(255) NOT NULL,
  `header_timestamp` varchar(10) NOT NULL,
  `header_time_elapse` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ad_header_slide`
--

CREATE TABLE `ad_header_slide` (
  `id_header_slide` int(11) NOT NULL,
  `ad_username_slide` varchar(18) NOT NULL,
  `ad_goods_slide` varchar(20) NOT NULL,
  `ad_price_slide` varchar(10) NOT NULL,
  `ad_description` varchar(255) NOT NULL,
  `ad_phone` varchar(11) NOT NULL,
  `ad_categories` varchar(20) NOT NULL,
  `ad_local_area` varchar(20) NOT NULL,
  `ad_bonus` int(1) NOT NULL DEFAULT 0,
  `ad_images` varchar(255) NOT NULL,
  `ad_timestamp` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `goods_id` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `goods_name` varchar(20) NOT NULL,
  `goods_price` varchar(10) NOT NULL,
  `file_name_goods` varchar(255) NOT NULL DEFAULT 'goods_serv_pix.jpg',
  `description` varchar(255) NOT NULL,
  `categories` varchar(20) NOT NULL,
  `goods_phone_number` varchar(11) NOT NULL,
  `bonus_fee` int(1) NOT NULL DEFAULT 0,
  `local_area_id` varchar(20) NOT NULL,
  `goods_timestamp` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`goods_id`, `UID`, `goods_name`, `goods_price`, `file_name_goods`, `description`, `categories`, `goods_phone_number`, `bonus_fee`, `local_area_id`, `goods_timestamp`) VALUES
(1, 1, 'seeess', '2323', '4367fdfe381770dd5fa5b7284dc25f7043f8ef45.jpg', '', 'Food and Drinks', '08045676543', 0, 'Ado Ekiti', '1632126840');

-- --------------------------------------------------------

--
-- Table structure for table `goods_comment`
--

CREATE TABLE `goods_comment` (
  `id_goods_comment` int(11) NOT NULL,
  `UID_of_goods_in_comment_table` int(11) NOT NULL,
  `user_id_of_commenter` text NOT NULL,
  `comment_on_goods` varchar(255) NOT NULL,
  `ip_address_goods_commenter` text NOT NULL,
  `time_goods_commenter` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `local_area`
--

CREATE TABLE `local_area` (
  `local_area_id` int(11) NOT NULL,
  `area` varchar(20) NOT NULL,
  `state_id` int(15) NOT NULL,
  `state_name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `local_area`
--

INSERT INTO `local_area` (`local_area_id`, `area`, `state_id`, `state_name`) VALUES
(1, 'Aba North', 1, 'Abia'),
(2, 'Aba South', 1, 'Abia'),
(3, 'Arochukwu', 1, 'Abia'),
(4, 'Bende', 1, 'Abia'),
(5, 'Ikwuano', 1, 'Abia'),
(6, 'Isiala Ngwa North', 1, 'Abia'),
(7, 'Isiala Ngwa South', 1, 'Abia'),
(8, 'Isiukwuato', 1, 'Abia'),
(9, 'Obi Ngwa', 1, 'Abia'),
(10, 'Ohafia', 1, 'Abia'),
(11, 'Osisioma Ngwa', 1, 'Abia'),
(12, 'Ugwunagbo', 1, 'Abia'),
(13, 'Ukwa East', 1, 'Abia'),
(14, 'Ukwa West', 1, 'Abia'),
(15, 'Umuahia North', 1, 'Abia'),
(16, 'Umuahia South', 1, 'Abia'),
(17, 'Umunneochi', 1, 'Abia'),
(18, 'Demsa', 2, 'Adamawa'),
(19, 'Fufore', 2, 'Adamawa'),
(20, 'Ganaye', 2, 'Adamawa'),
(21, 'Gireri', 2, 'Adamawa'),
(22, 'Gombi', 2, 'Adamawa'),
(23, 'Guyuk', 2, 'Adamawa'),
(24, 'Honk', 2, 'Adamawa'),
(25, 'Jada', 2, 'Adamawa'),
(26, 'Lamurde', 2, 'Adamawa'),
(27, 'Madagali', 2, 'Adamawa'),
(28, 'Maiha', 2, 'Adamawa'),
(29, 'Mayo Belwa', 2, 'Adamawa'),
(30, 'Michika', 2, 'Adamawa'),
(31, 'Mubi North', 2, 'Adamawa'),
(32, 'Mubi South', 2, 'Adamawa'),
(33, 'Numan', 2, 'Adamawa'),
(34, 'Shelleng', 2, 'Adamawa'),
(35, 'Song', 2, 'Adamawa'),
(36, 'Toungo', 2, 'Adamawa'),
(37, 'Yola North', 2, 'Adamawa'),
(38, 'Yola South', 2, 'Adamawa'),
(39, 'Abak', 3, 'Akwa Ibom'),
(40, 'Eastern Obolo', 3, 'Akwa Ibom'),
(41, 'Eket', 3, 'Akwa Ibom'),
(42, 'Esit Eket', 3, 'Akwa Ibom'),
(43, 'Essien Udim', 3, 'Akwa Ibom'),
(44, 'Etim Ekpo', 3, 'Akwa Ibom'),
(45, 'Etinan', 3, 'Akwa Ibom'),
(46, 'Ibeno', 3, 'Akwa Ibom'),
(47, 'Ibesikpo Asutan', 3, 'Akwa Ibom'),
(48, 'Ibiona Ibom', 3, 'Akwa Ibom'),
(49, 'Ika', 3, 'Akwa Ibom'),
(50, 'Ikono', 3, 'Akwa Ibom'),
(51, 'Ikot Abasi', 3, 'Akwa Ibom'),
(52, 'Ikot Ekpene', 3, 'Akwa Ibom'),
(53, 'Ini', 3, 'Akwa Ibom'),
(54, 'Itu', 3, 'Akwa Ibom'),
(55, 'Mbo', 3, 'Akwa Ibom'),
(56, 'Mkpat Enin', 3, 'Akwa Ibom'),
(57, 'Nsit Atai', 3, 'Akwa Ibom'),
(58, 'Nsit Ibom', 3, 'Akwa Ibom'),
(59, 'Nsit Ubium', 3, 'Akwa Ibom'),
(60, 'Obot Akara', 3, 'Akwa Ibom'),
(61, 'Okobo', 3, 'Akwa Ibom'),
(62, 'Onna', 3, 'Akwa Ibom'),
(63, 'Oron', 3, 'Akwa Ibom'),
(64, 'Oruk Anam', 3, 'Akwa Ibom'),
(65, 'Udung Uko', 3, 'Akwa Ibom'),
(66, 'Ukanafun', 3, 'Akwa Ibom'),
(67, 'Uruan', 3, 'Akwa Ibom'),
(68, 'Urue Offong Oruko', 3, 'Akwa Ibom'),
(69, 'Uyo', 3, 'Akwa Ibom'),
(70, 'Aguata', 4, 'Anambra'),
(71, 'Anambra East', 4, 'Anambra'),
(72, 'Anambra West', 4, 'Anambra'),
(73, 'Anaocha', 4, 'Anambra'),
(74, 'Anyamelum', 4, 'Anambra'),
(75, 'Awka North', 4, 'Anambra'),
(76, 'Awka South', 4, 'Anambra'),
(77, 'Dunukofia', 4, 'Anambra'),
(78, 'Ekwusigo', 4, 'Anambra'),
(79, 'Idemili North', 4, 'Anambra'),
(80, 'Idemili South', 4, 'Anambra'),
(81, 'Ihiala', 4, 'Anambra'),
(82, 'Njikoka', 4, 'Anambra'),
(83, 'Nnewi North', 4, 'Anambra'),
(84, 'Nnewi South', 4, 'Anambra'),
(85, 'Ogbaru', 4, 'Anambra'),
(86, 'Onitsha North', 4, 'Anambra'),
(87, 'Onitsha South', 4, 'Anambra'),
(88, 'Orumba North', 4, 'Anambra'),
(89, 'Orumba South', 4, 'Anambra'),
(90, 'Oyi', 4, 'Anambra'),
(91, 'Alkareli', 5, 'Bauchi'),
(92, 'Bauchi', 5, 'Bauchi'),
(93, 'Bogoro', 5, 'Bauchi'),
(94, 'Damban', 5, 'Bauchi'),
(95, 'Darazo', 5, 'Bauchi'),
(96, 'Dass', 5, 'Bauchi'),
(97, 'Gamawa', 5, 'Bauchi'),
(98, 'Ganjuwa', 5, 'Bauchi'),
(99, 'Giade', 5, 'Bauchi'),
(100, 'Itas Gadau', 5, 'Bauchi'),
(101, 'Jamaare', 5, 'Bauchi'),
(102, 'Katagum', 5, 'Bauchi'),
(103, 'kirfi', 5, 'Bauchi'),
(104, 'Misau', 5, 'Bauchi'),
(105, 'Ningi', 5, 'Bauchi'),
(106, 'Shira', 5, 'Bauchi'),
(107, 'Tafawa Balewa', 5, 'Bauchi'),
(108, 'Toro', 5, 'Bauchi'),
(109, 'Warji', 5, 'Bauchi'),
(110, 'Zaki', 5, 'Bauchi'),
(111, 'Brass', 6, 'Bayelsa'),
(112, 'Ekeremor', 6, 'Bayelsa'),
(113, 'Kolokumo Opokumor', 6, 'Bayelsa'),
(114, 'Nembe', 6, 'Bayelsa'),
(115, 'Ogbia', 6, 'Bayelsa'),
(116, 'Sagbama', 6, 'Bayelsa'),
(117, 'Southern Ijaw', 6, 'Bayelsa'),
(118, 'Yenagoa', 6, 'Bayelsa'),
(119, 'Ado', 7, 'Benue'),
(120, 'Agatu', 7, 'Benue'),
(121, 'Apa', 7, 'Benue'),
(122, 'Buruku', 7, 'Benue'),
(123, 'Gboko', 7, 'Benue'),
(124, 'Guma', 7, 'Benue'),
(125, 'Gwer East', 7, 'Benue'),
(126, 'Gwer West', 7, 'Benue'),
(127, 'Kastina Ala', 7, 'Benue'),
(128, 'Konshisha', 7, 'Benue'),
(129, 'Kwande', 7, 'Benue'),
(130, 'Logo', 7, 'Benue'),
(131, 'Makurdi', 7, 'Benue'),
(132, 'Obi BE', 7, 'Benue'),
(133, 'Ogbadibo', 7, 'Benue'),
(134, 'Ohimini', 7, 'Benue'),
(135, 'Oju', 7, 'Benue'),
(136, 'Okpokwu', 7, 'Benue'),
(137, 'Oturkpo', 7, 'Benue'),
(138, 'Tarka', 7, 'Benue'),
(139, 'Ukum', 7, 'Benue'),
(140, 'Ushongo', 7, 'Benue'),
(141, 'Vandeikya', 7, 'Benue'),
(142, 'Abadam', 8, 'Borno'),
(143, 'Askira Uba', 8, 'Borno'),
(144, 'Bama', 8, 'Borno'),
(145, 'Bayo', 8, 'Borno'),
(146, 'Biu', 8, 'Borno'),
(147, 'Chibok', 8, 'Borno'),
(148, 'Damboa', 8, 'Borno'),
(149, 'Dikwa', 8, 'Borno'),
(150, 'Gubio', 8, 'Borno'),
(151, 'Guzamala', 8, 'Borno'),
(152, 'Gwoza', 8, 'Borno'),
(153, 'Hawul', 8, 'Borno'),
(154, 'Jere', 8, 'Borno'),
(155, 'Kaga', 8, 'Borno'),
(156, 'Kala Balge', 8, 'Borno'),
(157, 'Konduga', 8, 'Borno'),
(158, 'Kukawa', 8, 'Borno'),
(159, 'Kwaya Kusar', 8, 'Borno'),
(160, 'Mafa', 8, 'Borno'),
(161, 'Magumeri', 8, 'Borno'),
(162, 'Maiduguri', 8, 'Borno'),
(163, 'Marte', 8, 'Borno'),
(164, 'Mobbar', 8, 'Borno'),
(165, 'Monguno', 8, 'Borno'),
(166, 'Ngala', 8, 'Borno'),
(167, 'Nganzai', 8, 'Borno'),
(168, 'Shani', 8, 'Borno'),
(169, 'Abi', 9, 'Cross River'),
(170, 'Akamkpa', 9, 'Cross River'),
(171, 'Akpabuyo', 9, 'Cross River'),
(172, 'Bakassi', 9, 'Cross River'),
(173, 'Bekwara', 9, 'Cross River'),
(174, 'Biase', 9, 'Cross River'),
(175, 'Boki', 9, 'Cross River'),
(176, 'Calabar Municipality', 9, 'Cross River'),
(177, 'Calabar South', 9, 'Cross River'),
(178, 'Etung', 9, 'Cross River'),
(179, 'Ikom', 9, 'Cross River'),
(180, 'Obanliku', 9, 'Cross River'),
(181, 'Obubra', 9, 'Cross River'),
(182, 'Obudu', 9, 'Cross River'),
(183, 'Odukpani', 9, 'Cross River'),
(184, 'Ogoja', 9, 'Cross River'),
(185, 'Yakuur', 9, 'Cross River'),
(186, 'Yala', 9, 'Cross River'),
(187, 'Aniocha North', 10, 'Delta'),
(188, 'Aniocha South', 10, 'Delta'),
(189, 'Bomadi', 10, 'Delta'),
(190, 'Burutu', 10, 'Delta'),
(191, 'Ethiope East', 10, 'Delta'),
(192, 'Ethiope West', 10, 'Delta'),
(193, 'Ika North East', 10, 'Delta'),
(194, 'Ika South', 10, 'Delta'),
(195, 'Isoko North', 10, 'Delta'),
(196, 'Isoko South', 10, 'Delta'),
(197, 'Ndokwa East', 10, 'Delta'),
(198, 'Ndokwa West', 10, 'Delta'),
(199, 'Okpe', 10, 'Delta'),
(200, 'Oshimili North', 10, 'Delta'),
(201, 'Oshimili South', 10, 'Delta'),
(202, 'Patani', 10, 'Delta'),
(203, 'Sapele', 10, 'Delta'),
(204, 'Udu', 10, 'Delta'),
(205, 'Ughelli North', 10, 'Delta'),
(206, 'Ughelli South', 10, 'Delta'),
(207, 'Ukwani', 10, 'Delta'),
(208, 'Uvwie', 10, 'Delta'),
(209, 'Warri North', 10, 'Delta'),
(210, 'Warri South', 10, 'Delta'),
(211, 'Warri South West', 10, 'Delta'),
(212, 'Abakaliki', 11, 'Ebonyi'),
(213, 'Afikpo North', 11, 'Ebonyi'),
(214, 'Afikpo South', 11, 'Ebonyi'),
(215, 'Ebonyi', 11, 'Ebonyi'),
(216, 'Ezza North', 11, 'Ebonyi'),
(217, 'Ezza South', 11, 'Ebonyi'),
(218, 'Ikwo', 11, 'Ebonyi'),
(219, 'Ishielu', 11, 'Ebonyi'),
(220, 'Ivo', 11, 'Ebonyi'),
(221, 'Izzi', 11, 'Ebonyi'),
(222, 'Ohaozara', 11, 'Ebonyi'),
(223, 'Ohaukwu', 11, 'Ebonyi'),
(224, 'Onicha', 11, 'Ebonyi'),
(225, 'Akoko Edo', 12, 'Edo'),
(226, 'Egor', 12, 'Edo'),
(227, 'Esan Central', 12, 'Edo'),
(228, 'Esan North East', 12, 'Edo'),
(229, 'Esan South East', 12, 'Edo'),
(230, 'Esan West', 12, 'Edo'),
(231, 'Etsako Central', 12, 'Edo'),
(232, 'Etsako East', 12, 'Edo'),
(233, 'Etsako West', 12, 'Edo'),
(234, 'Igueben', 12, 'Edo'),
(235, 'Ikpoba Okha', 12, 'Edo'),
(236, 'Oredo', 12, 'Edo'),
(237, 'Orhionwon', 12, 'Edo'),
(238, 'Ovia North East', 12, 'Edo'),
(239, 'Ovia South West', 12, 'Edo'),
(240, 'Owan East', 12, 'Edo'),
(241, 'Owan West', 12, 'Edo'),
(242, 'Uhunmwonde', 12, 'Edo'),
(243, 'Ado Ekiti', 13, 'Ekiti'),
(244, 'Ekiti East', 13, 'Ekiti'),
(245, 'Ekiti South West', 13, 'Ekiti'),
(246, 'Ekiti West', 13, 'Ekiti'),
(247, 'Emure', 13, 'Ekiti'),
(248, 'Ikare', 13, 'Ekiti'),
(249, 'Irepodun EK', 13, 'Ekiti'),
(250, 'Ijero', 13, 'Ekiti'),
(251, 'Ido Osi', 13, 'Ekiti'),
(252, 'Oye', 13, 'Ekiti'),
(253, 'Ikole', 13, 'Ekiti'),
(254, 'Moba', 13, 'Ekiti'),
(255, 'Gbonyin', 13, 'Ekiti'),
(256, 'Efon', 13, 'Ekiti'),
(257, 'Ise Orun', 13, 'Ekiti'),
(258, 'Ilejemeje', 13, 'Ekiti'),
(259, 'Aninri', 14, 'Enugu'),
(260, 'Enugu East', 14, 'Enugu'),
(261, 'Enugu North', 14, 'Enugu'),
(262, 'Enugu South', 14, 'Enugu'),
(263, 'Ezeagu', 14, 'Enugu'),
(264, 'Igbo Etiti', 14, 'Enugu'),
(265, 'Igbo Eze North', 14, 'Enugu'),
(266, 'Igbo Eze South', 14, 'Enugu'),
(267, 'Isi Uzo', 14, 'Enugu'),
(268, 'Nkanu East', 14, 'Enugu'),
(269, 'Nkanu West', 14, 'Enugu'),
(270, 'Nsukka', 14, 'Enugu'),
(271, 'Oji River', 14, 'Enugu'),
(272, 'Udenu', 14, 'Enugu'),
(273, 'Udi', 14, 'Enugu'),
(274, 'Uzo Uwani', 14, 'Enugu'),
(275, 'Akko', 15, 'Gombe'),
(276, 'Balanga', 15, 'Gombe'),
(277, 'Billiri', 15, 'Gombe'),
(278, 'Dukku', 15, 'Gombe'),
(279, 'Kaltungo', 15, 'Gombe'),
(280, 'Kwami', 15, 'Gombe'),
(281, 'Shongom', 15, 'Gombe'),
(282, 'Funakaye Bajoga', 15, 'Gombe'),
(283, 'Gombe', 15, 'Gombe'),
(284, 'Nafada', 15, 'Gombe'),
(285, 'Yamaltu Deba', 15, 'Gombe'),
(286, 'Aboh Mbaise', 16, 'Imo'),
(287, 'Ahiazu Mbaise', 16, 'Imo'),
(288, 'Ehime Mbano', 16, 'Imo'),
(289, 'Ezinihitte', 16, 'Imo'),
(290, 'Ideato North', 16, 'Imo'),
(291, 'Ideato South', 16, 'Imo'),
(292, 'Ihitte Uboma', 16, 'Imo'),
(293, 'Ikeduru', 16, 'Imo'),
(294, 'Isiala Mbano', 16, 'Imo'),
(295, 'Isu', 16, 'Imo'),
(296, 'Mbaitoli', 16, 'Imo'),
(297, 'Ngor Okpala', 16, 'Imo'),
(298, 'Njaba', 16, 'Imo'),
(299, 'Nkwerre', 16, 'Imo'),
(300, 'Nwangele', 16, 'Imo'),
(301, 'Obowo', 16, 'Imo'),
(302, 'Oguta', 16, 'Imo'),
(303, 'Ohaji Egbema', 16, 'Imo'),
(304, 'Okigwe', 16, 'Imo'),
(305, 'Onuimo', 16, 'Imo'),
(306, 'Orlu', 16, 'Imo'),
(307, 'Orsu', 16, 'Imo'),
(308, 'Oru East', 16, 'Imo'),
(309, 'Oru West', 16, 'Imo'),
(310, 'Owerri Municipal', 16, 'Imo'),
(311, 'Owerri North', 16, 'Imo'),
(312, 'Owerri West', 16, 'Imo'),
(313, 'Auyo', 17, 'Jigawa'),
(314, 'Babura', 17, 'Jigawa'),
(315, 'Birni Kudu', 17, 'Jigawa'),
(316, 'Biriniwa', 17, 'Jigawa'),
(317, 'Buji', 17, 'Jigawa'),
(318, 'Dutse', 17, 'Jigawa'),
(319, 'Gagarawa', 17, 'Jigawa'),
(320, 'Garki', 17, 'Jigawa'),
(321, 'Gumel', 17, 'Jigawa'),
(322, 'Guri', 17, 'Jigawa'),
(323, 'Gwaram', 17, 'Jigawa'),
(324, 'Gwiwa', 17, 'Jigawa'),
(325, 'Hadejia', 17, 'Jigawa'),
(326, 'Jahun', 17, 'Jigawa'),
(327, 'Kafin Hausa', 17, 'Jigawa'),
(328, 'Kaugama', 17, 'Jigawa'),
(329, 'Kazaure', 17, 'Jigawa'),
(330, 'Kiri Kasamma', 17, 'Jigawa'),
(331, 'Kiyawa', 17, 'Jigawa'),
(332, 'Maigatari', 17, 'Jigawa'),
(333, 'Malam Madori', 17, 'Jigawa'),
(334, 'Miga', 17, 'Jigawa'),
(335, 'Ringim', 17, 'Jigawa'),
(336, 'Roni', 17, 'Jigawa'),
(337, 'Sule Tankarkar', 17, 'Jigawa'),
(338, 'Taura', 17, 'Jigawa'),
(339, 'Yankwashi', 17, 'Jigawa'),
(340, 'Birni Gwari', 18, 'Kaduna'),
(341, 'Chikun', 18, 'Kaduna'),
(342, 'Giwa', 18, 'Kaduna'),
(343, 'Igabi', 18, 'Kaduna'),
(344, 'Ikara', 18, 'Kaduna'),
(345, 'Jaba', 18, 'Kaduna'),
(346, 'Jemaa', 18, 'Kaduna'),
(347, 'Kachia', 18, 'Kaduna'),
(348, 'Kaduna North', 18, 'Kaduna'),
(349, 'Kaduna South', 18, 'Kaduna'),
(350, 'Kagarko', 18, 'Kaduna'),
(351, 'Kajuru', 18, 'Kaduna'),
(352, 'Kaura KD', 18, 'Kaduna'),
(353, 'Kauru', 18, 'Kaduna'),
(354, 'Kubau', 18, 'Kaduna'),
(355, 'Kudan', 18, 'Kaduna'),
(356, 'Lere', 18, 'Kaduna'),
(357, 'Makarfi', 18, 'Kaduna'),
(358, 'Sabon Gari', 18, 'Kaduna'),
(359, 'Sanga', 18, 'Kaduna'),
(360, 'Soba', 18, 'Kaduna'),
(361, 'Zango Kataf', 18, 'Kaduna'),
(362, 'Zaria', 18, 'Kaduna'),
(363, 'Ajingi', 19, 'Kano'),
(364, 'Albasu', 19, 'Kano'),
(365, 'Bagwai', 19, 'Kano'),
(366, 'Bebeji', 19, 'Kano'),
(367, 'Bichi', 19, 'Kano'),
(368, 'Bunkure', 19, 'Kano'),
(369, 'Dala', 19, 'Kano'),
(370, 'Dambatta', 19, 'Kano'),
(371, 'Dawakin Kudu', 19, 'Kano'),
(372, 'Dawakin Tofa', 19, 'Kano'),
(373, 'Doguwa', 19, 'Kano'),
(374, 'Fagge', 19, 'Kano'),
(375, 'Gabasawa', 19, 'Kano'),
(376, 'Garko', 19, 'Kano'),
(377, 'Garum Mallam', 19, 'Kano'),
(378, 'Gaya', 19, 'Kano'),
(379, 'Gezawa', 19, 'Kano'),
(380, 'Gwale', 19, 'Kano'),
(381, 'Gwarzo', 19, 'Kano'),
(382, 'Kabo', 19, 'Kano'),
(383, 'Kano Municipal', 19, 'Kano'),
(384, 'Karaye', 19, 'Kano'),
(385, 'Kibiya', 19, 'Kano'),
(386, 'Kiru', 19, 'Kano'),
(387, 'Kumbotso', 19, 'Kano'),
(388, 'Kunchi', 19, 'Kano'),
(389, 'Kura', 19, 'Kano'),
(390, 'Madobi', 19, 'Kano'),
(391, 'Makoda', 19, 'Kano'),
(392, 'Minjibir', 19, 'Kano'),
(393, 'Nasarawa KN', 19, 'Kano'),
(394, 'Rano', 19, 'Kano'),
(395, 'Rimin Gado', 19, 'Kano'),
(396, 'Rogo', 19, 'Kano'),
(397, 'Shanono', 19, 'Kano'),
(398, 'Sumaila', 19, 'Kano'),
(399, 'Takali', 19, 'Kano'),
(400, 'Tarauni', 19, 'Kano'),
(401, 'Tofa', 19, 'Kano'),
(402, 'Tsanyawa', 19, 'Kano'),
(403, 'Tudun Wada', 19, 'Kano'),
(404, 'Ungogo', 19, 'Kano'),
(405, 'Warawa', 19, 'Kano'),
(406, 'Wudil', 19, 'Kano'),
(407, 'Bakori', 20, 'Katsina'),
(408, 'Batagarawa', 20, 'Katsina'),
(409, 'Batsari', 20, 'Katsina'),
(410, 'Baure', 20, 'Katsina'),
(411, 'Bindawa', 20, 'Katsina'),
(412, 'Charanchi', 20, 'Katsina'),
(413, 'Dandume', 20, 'Katsina'),
(414, 'Danja', 20, 'Katsina'),
(415, 'Dan Musa', 20, 'Katsina'),
(416, 'Daura', 20, 'Katsina'),
(417, 'Dutsi', 20, 'Katsina'),
(418, 'Dutsin Ma', 20, 'Katsina'),
(419, 'Faskari', 20, 'Katsina'),
(420, 'Funtua', 20, 'Katsina'),
(421, 'Ingawa', 20, 'Katsina'),
(422, 'Jibia', 20, 'Katsina'),
(423, 'Kafur', 20, 'Katsina'),
(424, 'Kaita', 20, 'Katsina'),
(425, 'Kankara', 20, 'Katsina'),
(426, 'Kankia', 20, 'Katsina'),
(427, 'Katsina', 20, 'Katsina'),
(428, 'Kurfi', 20, 'Katsina'),
(429, 'Kusada', 20, 'Katsina'),
(430, 'Mai Adua', 20, 'Katsina'),
(431, 'Malumfashi', 20, 'Katsina'),
(432, 'Mani', 20, 'Katsina'),
(433, 'Mashi', 20, 'Katsina'),
(434, 'Matazuu', 20, 'Katsina'),
(435, 'Musawa', 20, 'Katsina'),
(436, 'Rimi', 20, 'Katsina'),
(437, 'Sabuwa', 20, 'Katsina'),
(438, 'Safana', 20, 'Katsina'),
(439, 'Sandamu', 20, 'Katsina'),
(440, 'Zango', 20, 'Katsina'),
(441, 'Aleiro', 21, 'Kebbi'),
(442, 'Arewa Dandi', 21, 'Kebbi'),
(443, 'Argungu', 21, 'Kebbi'),
(444, 'Augie', 21, 'Kebbi'),
(445, 'Bagudo', 21, 'Kebbi'),
(446, 'Birnin Kebbi', 21, 'Kebbi'),
(447, 'Bunza', 21, 'Kebbi'),
(448, 'Dandi', 21, 'Kebbi'),
(449, 'Fakai', 21, 'Kebbi'),
(450, 'Gwandu', 21, 'Kebbi'),
(451, 'Jega', 21, 'Kebbi'),
(452, 'Kalgo', 21, 'Kebbi'),
(453, 'Koko Besse', 21, 'Kebbi'),
(454, 'Maiyama', 21, 'Kebbi'),
(455, 'Ngaski', 21, 'Kebbi'),
(456, 'Sakaba', 21, 'Kebbi'),
(457, 'Shanga', 21, 'Kebbi'),
(458, 'Suru', 21, 'Kebbi'),
(459, 'Wasagu Danko', 21, 'Kebbi'),
(460, 'Yauri', 21, 'Kebbi'),
(461, 'Zuru', 21, 'Kebbi'),
(462, 'Adavi', 22, 'Kogi'),
(463, 'Ajaokuta', 22, 'Kogi'),
(464, 'Ankpa', 22, 'Kogi'),
(465, 'Bassa KO', 22, 'Kogi'),
(466, 'Dekina', 22, 'Kogi'),
(467, 'Ibaji', 22, 'Kogi'),
(468, 'Idah', 22, 'Kogi'),
(469, 'Igalamela Odolu', 22, 'Kogi'),
(470, 'Ijumu', 22, 'Kogi'),
(471, 'Kabba Bunu', 22, 'Kogi'),
(472, 'Koton Karfe', 22, 'Kogi'),
(473, 'Lokoja', 22, 'Kogi'),
(474, 'Mopa Muro', 22, 'Kogi'),
(475, 'Ofu', 22, 'Kogi'),
(476, 'Ogori Mangongo', 22, 'Kogi'),
(477, 'Okehi', 22, 'Kogi'),
(478, 'Okene', 22, 'Kogi'),
(479, 'Olamabolo', 22, 'Kogi'),
(480, 'Omala', 22, 'Kogi'),
(481, 'Yagba East', 22, 'Kogi'),
(482, 'Yagba West', 22, 'Kogi'),
(483, 'Asa', 23, 'Kwara'),
(484, 'Baruten', 23, 'Kwara'),
(485, 'Edu', 23, 'Kwara'),
(486, 'Ekiti', 23, 'Kwara'),
(487, 'Ifelodun KW', 23, 'Kwara'),
(488, 'Ilorin East', 23, 'Kwara'),
(489, 'Ilorin South', 23, 'Kwara'),
(490, 'Ilorin West', 23, 'Kwara'),
(491, 'Irepodun KW', 23, 'Kwara'),
(492, 'Isin', 23, 'Kwara'),
(493, 'Kaiama', 23, 'Kwara'),
(494, 'Moro', 23, 'Kwara'),
(495, 'Offa', 23, 'Kwara'),
(496, 'Oke Ero', 23, 'Kwara'),
(497, 'Oyun', 23, 'Kwara'),
(498, 'Pategi', 23, 'Kwara'),
(499, 'Agege', 24, 'Lagos'),
(500, 'Ajeromi Ifelodun', 24, 'Lagos'),
(501, 'Alimosho', 24, 'Lagos'),
(502, 'Amuwo Odofin', 24, 'Lagos'),
(503, 'Apapa', 24, 'Lagos'),
(504, 'Badagry', 24, 'Lagos'),
(505, 'Epe', 24, 'Lagos'),
(506, 'Eti Osa', 24, 'Lagos'),
(507, 'Ibeju Lekki', 24, 'Lagos'),
(508, 'Ifako Ijaye', 24, 'Lagos'),
(509, 'Ikeja', 24, 'Lagos'),
(510, 'Ikorodu', 24, 'Lagos'),
(511, 'Kosofe', 24, 'Lagos'),
(512, 'Lagos Island', 24, 'Lagos'),
(513, 'Lagos Mainland', 24, 'Lagos'),
(514, 'Mushin', 24, 'Lagos'),
(515, 'Ojo', 24, 'Lagos'),
(516, 'Oshodi Isolo', 24, 'Lagos'),
(517, 'Shomolu', 24, 'Lagos'),
(518, 'Surulere LA', 24, 'Lagos'),
(519, 'Akwanga', 25, 'Nasarawa'),
(520, 'Awe', 25, 'Nasarawa'),
(521, 'Doma', 25, 'Nasarawa'),
(522, 'Karu', 25, 'Nasarawa'),
(523, 'Keana', 25, 'Nasarawa'),
(524, 'Keffi', 25, 'Nasarawa'),
(525, 'Kokona', 25, 'Nasarawa'),
(526, 'Lafia', 25, 'Nasarawa'),
(527, 'Nasarawa NA', 25, 'Nasarawa'),
(528, 'Nasarawa Eggon', 25, 'Nasarawa'),
(529, 'Obi NA', 25, 'Nasarawa'),
(530, 'Toto', 25, 'Nasarawa'),
(531, 'Wamba', 25, 'Nasarawa'),
(532, 'Agaie', 26, 'Niger'),
(533, 'Agwara', 26, 'Niger'),
(534, 'Bida', 26, 'Niger'),
(535, 'Borgu', 26, 'Niger'),
(536, 'Bosso', 26, 'Niger'),
(537, 'Chanchaga', 26, 'Niger'),
(538, 'Edati', 26, 'Niger'),
(539, 'Gbako', 26, 'Niger'),
(540, 'Gurara', 26, 'Niger'),
(541, 'Katcha', 26, 'Niger'),
(542, 'Kontagora', 26, 'Niger'),
(543, 'Lapai', 26, 'Niger'),
(544, 'Lavun', 26, 'Niger'),
(545, 'Magama', 26, 'Niger'),
(546, 'Mariga', 26, 'Niger'),
(547, 'Mashegu', 26, 'Niger'),
(548, 'Mokwa', 26, 'Niger'),
(549, 'Muya', 26, 'Niger'),
(550, 'Pailoro', 26, 'Niger'),
(551, 'Rafi', 26, 'Niger'),
(552, 'Rijau', 26, 'Niger'),
(553, 'Shiroro', 26, 'Niger'),
(554, 'Suleja', 26, 'Niger'),
(555, 'Tafa', 26, 'Niger'),
(556, 'Wushishi', 26, 'Niger'),
(557, 'Abeokuta North', 27, 'Ogun'),
(558, 'Abeokuta South', 27, 'Ogun'),
(559, 'Ado Odo Ota', 27, 'Ogun'),
(560, 'Egbado North', 27, 'Ogun'),
(561, 'Egbado South', 27, 'Ogun'),
(562, 'Ewekoro', 27, 'Ogun'),
(563, 'Ifo', 27, 'Ogun'),
(564, 'Ijebu East', 27, 'Ogun'),
(565, 'Ijebu North', 27, 'Ogun'),
(566, 'Ijebu North East', 27, 'Ogun'),
(567, 'Ijebu Ode', 27, 'Ogun'),
(568, 'Ikenne', 27, 'Ogun'),
(569, 'Imeko Afon', 27, 'Ogun'),
(570, 'Ipokia', 27, 'Ogun'),
(571, 'Obafemi Owode', 27, 'Ogun'),
(572, 'Odeda', 27, 'Ogun'),
(573, 'Odogbolu', 27, 'Ogun'),
(574, 'Ogun Waterside', 27, 'Ogun'),
(575, 'Remo North', 27, 'Ogun'),
(576, 'Shagamu', 27, 'Ogun'),
(577, 'Akoko North East', 28, 'Ondo'),
(578, 'Akoko North West', 28, 'Ondo'),
(579, 'Akoko South East', 28, 'Ondo'),
(580, 'Akoko South West', 28, 'Ondo'),
(581, 'Akure North', 28, 'Ondo'),
(582, 'Akure South', 28, 'Ondo'),
(583, 'Ese Odo', 28, 'Ondo'),
(584, 'Idanre', 28, 'Ondo'),
(585, 'Ifedore', 28, 'Ondo'),
(586, 'Ilaje', 28, 'Ondo'),
(587, 'Ile Oluji Okeigbo', 28, 'Ondo'),
(588, 'Irele', 28, 'Ondo'),
(589, 'Odigbo', 28, 'Ondo'),
(590, 'Okitipupa', 28, 'Ondo'),
(591, 'Ondo East', 28, 'Ondo'),
(592, 'Ondo West', 28, 'Ondo'),
(593, 'Ose', 28, 'Ondo'),
(594, 'Owo', 28, 'Ondo'),
(595, 'Aiyedade', 29, 'Osun'),
(596, 'Aiyedire', 29, 'Osun'),
(597, 'Atakumosa East', 29, 'Osun'),
(598, 'Atakumosa West', 29, 'Osun'),
(599, 'Boluwaduro', 29, 'Osun'),
(600, 'Boripe', 29, 'Osun'),
(601, 'Ede North', 29, 'Osun'),
(602, 'Ede South', 29, 'Osun'),
(603, 'Egbedore', 29, 'Osun'),
(604, 'Ejigbo', 29, 'Osun'),
(605, 'Ife Central', 29, 'Osun'),
(606, 'Ife East', 29, 'Osun'),
(607, 'Ife North', 29, 'Osun'),
(608, 'Ife South', 29, 'Osun'),
(609, 'Ifedayo', 29, 'Osun'),
(610, 'Ifelodun OS', 29, 'Osun'),
(611, 'Ila', 29, 'Osun'),
(612, 'Ilesha East', 29, 'Osun'),
(613, 'Ilesha West', 29, 'Osun'),
(614, 'Irepodun OS', 29, 'Osun'),
(615, 'Irewole', 29, 'Osun'),
(616, 'Isokan', 29, 'Osun'),
(617, 'Iwo', 29, 'Osun'),
(618, 'Obokun', 29, 'Osun'),
(619, 'Odo Otin', 29, 'Osun'),
(620, 'Ola Oluwa', 29, 'Osun'),
(621, 'Olorunda', 29, 'Osun'),
(622, 'Oriade', 29, 'Osun'),
(623, 'Orolu', 29, 'Osun'),
(624, 'Oshogbo', 29, 'Osun'),
(625, 'Afijio', 30, 'Oyo'),
(626, 'Akinyele', 30, 'Oyo'),
(627, 'Atiba', 30, 'Oyo'),
(628, 'Atigbo', 30, 'Oyo'),
(629, 'Egbeda', 30, 'Oyo'),
(630, 'Ibadan North', 30, 'Oyo'),
(631, 'Ibadan North East', 30, 'Oyo'),
(632, 'Ibadan North West', 30, 'Oyo'),
(633, 'Ibadan South East', 30, 'Oyo'),
(634, 'Ibadan South West', 30, 'Oyo'),
(635, 'Ibarapa Central', 30, 'Oyo'),
(636, 'Ibarapa East', 30, 'Oyo'),
(637, 'Ibarapa North', 30, 'Oyo'),
(638, 'Ido', 30, 'Oyo'),
(639, 'Irepo', 30, 'Oyo'),
(640, 'Iseyin', 30, 'Oyo'),
(641, 'Itesiwaju', 30, 'Oyo'),
(642, 'Iwajowa', 30, 'Oyo'),
(643, 'Kajola', 30, 'Oyo'),
(644, 'Lagelu', 30, 'Oyo'),
(645, 'Ogbomosho North', 30, 'Oyo'),
(646, 'Ogbomosho South', 30, 'Oyo'),
(647, 'Ogo Oluwa', 30, 'Oyo'),
(648, 'Olorunsogo', 30, 'Oyo'),
(649, 'Oluyole', 30, 'Oyo'),
(650, 'Ona Ara', 30, 'Oyo'),
(651, 'Orelope', 30, 'Oyo'),
(652, 'Ori Ire', 30, 'Oyo'),
(653, 'Oyo East', 30, 'Oyo'),
(654, 'Oyo West', 30, 'Oyo'),
(655, 'Saki East', 30, 'Oyo'),
(656, 'Saki West', 30, 'Oyo'),
(657, 'Surulere OY', 30, 'Oyo'),
(658, 'Barikin Ladi', 31, 'Plateau'),
(659, 'Bassa PL', 31, 'Plateau'),
(660, 'Bokkos', 31, 'Plateau'),
(661, 'Jos East', 31, 'Plateau'),
(662, 'Jos North', 31, 'Plateau'),
(663, 'Jos South', 31, 'Plateau'),
(664, 'Kanam', 31, 'Plateau'),
(665, 'Kanke', 31, 'Plateau'),
(666, 'Langtang North', 31, 'Plateau'),
(667, 'Langtang South', 31, 'Plateau'),
(668, 'Mangu', 31, 'Plateau'),
(669, 'Mikang', 31, 'Plateau'),
(670, 'Pankshin', 31, 'Plateau'),
(671, 'Quaan Pan', 31, 'Plateau'),
(672, 'Riyom', 31, 'Plateau'),
(673, 'Shendam', 31, 'Plateau'),
(674, 'Wase', 31, 'Plateau'),
(675, 'Abua Odual', 32, 'Rivers'),
(676, 'Ahoada East', 32, 'Rivers'),
(677, 'Ahoada West', 32, 'Rivers'),
(678, 'Akuku Toru', 32, 'Rivers'),
(679, 'Andoni', 32, 'Rivers'),
(680, 'Asari Toru', 32, 'Rivers'),
(681, 'Bonny', 32, 'Rivers'),
(682, 'Degema', 32, 'Rivers'),
(683, 'Emohua', 32, 'Rivers'),
(684, 'Eleme', 32, 'Rivers'),
(685, 'Etche', 32, 'Rivers'),
(686, 'Gokana', 32, 'Rivers'),
(687, 'Ikwerre', 32, 'Rivers'),
(688, 'Khana', 32, 'Rivers'),
(689, 'Obia Akpor', 32, 'Rivers'),
(690, 'Ogba Egbema Ndoni', 32, 'Rivers'),
(691, 'Ogu Bolo', 32, 'Rivers'),
(692, 'Okrika', 32, 'Rivers'),
(693, 'Omumma', 32, 'Rivers'),
(694, 'Opobo Nkoro', 32, 'Rivers'),
(695, 'Oyigbo', 32, 'Rivers'),
(696, 'Port Harcourt', 32, 'Rivers'),
(697, 'Tai', 32, 'Rivers'),
(698, 'Binji', 33, 'Sokoto'),
(699, 'Bodinga', 33, 'Sokoto'),
(700, 'Dange shusi', 33, 'Sokoto'),
(701, 'Gada', 33, 'Sokoto'),
(702, 'Goronyo', 33, 'Sokoto'),
(703, 'Gawabawa', 33, 'Sokoto'),
(704, 'Gudu', 33, 'Sokoto'),
(705, 'Illela', 33, 'Sokoto'),
(706, 'Isa', 33, 'Sokoto'),
(707, 'kebbe', 33, 'Sokoto'),
(708, 'Kware', 33, 'Sokoto'),
(709, 'Rabah', 33, 'Sokoto'),
(710, 'Sabon birni', 33, 'Sokoto'),
(711, 'Shagari', 33, 'Sokoto'),
(712, 'Silame', 33, 'Sokoto'),
(713, 'Sokoto North', 33, 'Sokoto'),
(714, 'Sokoto South', 33, 'Sokoto'),
(715, 'Tambuwal', 33, 'Sokoto'),
(716, 'Tangaza', 33, 'Sokoto'),
(717, 'Tureta', 33, 'Sokoto'),
(718, 'Wamako', 33, 'Sokoto'),
(719, 'Wurno', 33, 'Sokoto'),
(720, 'Yabo', 33, 'Sokoto'),
(721, 'Ardo kola', 34, 'Taraba'),
(722, 'Bali', 34, 'Taraba'),
(723, 'Donga', 34, 'Taraba'),
(724, 'Gashaka', 34, 'Taraba'),
(725, 'Cassol', 34, 'Taraba'),
(726, 'Ibi', 34, 'Taraba'),
(727, 'Jalingo', 34, 'Taraba'),
(728, 'Karin Lamido', 34, 'Taraba'),
(729, 'Kurmi', 34, 'Taraba'),
(730, 'Lau', 34, 'Taraba'),
(731, 'Sardauna', 34, 'Taraba'),
(732, 'Takum', 34, 'Taraba'),
(733, 'Ussa', 34, 'Taraba'),
(734, 'Wukari', 34, 'Taraba'),
(735, 'Yorro', 34, 'Taraba'),
(736, 'Zing', 34, 'Taraba'),
(737, 'Bade', 35, 'Yobe'),
(738, 'Bursari', 35, 'Yobe'),
(739, 'Damaturu', 35, 'Yobe'),
(740, 'Fika', 35, 'Yobe'),
(741, 'Fune', 35, 'Yobe'),
(742, 'Geidam', 35, 'Yobe'),
(743, 'Gujba', 35, 'Yobe'),
(744, 'Gulani', 35, 'Yobe'),
(745, 'Jakusko', 35, 'Yobe'),
(746, 'Karasuwa', 35, 'Yobe'),
(747, 'Karawa', 35, 'Yobe'),
(748, 'Machina', 35, 'Yobe'),
(749, 'Nangere', 35, 'Yobe'),
(750, 'Nguru Potiskum', 35, 'Yobe'),
(751, 'Tarmua', 35, 'Yobe'),
(752, 'Yunusari', 35, 'Yobe'),
(753, 'Yusufari', 35, 'Yobe'),
(754, 'Anka', 36, 'Zamfara'),
(755, 'Bakura', 36, 'Zamfara'),
(756, 'Birnin Magaji', 36, 'Zamfara'),
(757, 'Bukkuyum', 36, 'Zamfara'),
(758, 'Bungudu', 36, 'Zamfara'),
(759, 'Gummi', 36, 'Zamfara'),
(760, 'Gusau', 36, 'Zamfara'),
(761, 'Kaura ZA', 36, 'Zamfara'),
(762, 'Namoda', 36, 'Zamfara'),
(763, 'Maradun', 36, 'Zamfara'),
(764, 'Maru', 36, 'Zamfara'),
(765, 'Shinkafi', 36, 'Zamfara'),
(766, 'Talata Mafara', 36, 'Zamfara'),
(767, 'Tsafe', 36, 'Zamfara'),
(768, 'Zurmi', 36, 'Zamfara'),
(769, 'Abaji', 37, 'FCT'),
(770, 'Abuja', 37, 'FCT'),
(771, 'Bwari', 37, 'FCT'),
(772, 'Gwagwalada', 37, 'FCT'),
(773, 'Kuje', 37, 'FCT'),
(774, 'Kwali', 37, 'FCT');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` bigint(20) NOT NULL,
  `user_id_post` int(11) NOT NULL,
  `post_city` varchar(20) NOT NULL,
  `post_state_id` varchar(15) NOT NULL,
  `posts` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `php_timestamp` varchar(11) NOT NULL,
  `post_category` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id_post`, `post_city`, `post_state_id`, `posts`, `phone`, `php_timestamp`, `post_category`) VALUES
(1, 1, 'Birnin Kebbi', 'Kebbi', 'i need a male shoe', '08074574512', '1632126074', 'Clothings');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `goods_id_to_rate` int(11) NOT NULL,
  `user_id_rating_goods` text NOT NULL,
  `ratings` int(1) NOT NULL,
  `ip_goods_rater` text NOT NULL,
  `time_goods_rating` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shop_comment`
--

CREATE TABLE `shop_comment` (
  `shop_comment_id` int(11) NOT NULL,
  `user_id_comment` int(11) NOT NULL,
  `commenter` text NOT NULL,
  `shop_comment` varchar(100) NOT NULL,
  `comment_ipaddress` text NOT NULL,
  `shop_comment_time` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shop_rating`
--

CREATE TABLE `shop_rating` (
  `shop_rating_id` bigint(20) NOT NULL,
  `shop_id` bigint(20) NOT NULL,
  `rater` text NOT NULL,
  `rate_value` int(1) NOT NULL,
  `ip_address` text NOT NULL,
  `timestamp_rate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` bigint(20) NOT NULL,
  `user_id_slider` int(11) NOT NULL,
  `slide_goods_name` varchar(20) NOT NULL,
  `slide_goods_price` varchar(10) NOT NULL,
  `slide_goods_cat` varchar(20) NOT NULL,
  `slide_goods_number` varchar(11) NOT NULL,
  `slide_goods_desc` varchar(100) NOT NULL,
  `slide_bonus_fee` int(1) NOT NULL DEFAULT 0,
  `slider_image` varchar(255) NOT NULL DEFAULT 'goods_serv_pix.jpg',
  `slide_local_area` varchar(20) NOT NULL,
  `slide_timestamp` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider_topic`
--

CREATE TABLE `slider_topic` (
  `id_topic` int(11) NOT NULL,
  `user_id_topic` int(11) NOT NULL,
  `topic` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(2) UNSIGNED NOT NULL,
  `state_name` varchar(15) NOT NULL,
  `capital` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`, `capital`) VALUES
(1, 'Abia', 'Umuahia'),
(2, 'Adamawa', 'Yola'),
(3, 'Akwa Ibom', 'Uyo'),
(4, 'Anambra', 'Awka'),
(5, 'Bauchi', 'Bauchi'),
(6, 'Bayelsa', 'Yenagoa'),
(7, 'Benue', 'Makurdi'),
(8, 'Borno', 'Maiduguri'),
(9, 'Cross River', 'Calabar'),
(10, 'Delta', 'Asaba'),
(11, 'Ebonyi', 'Abakaliki'),
(12, 'Edo', 'Benin City'),
(13, 'Ekiti', 'Ado Ekiti'),
(14, 'Enugu', 'Enugu'),
(15, 'Gombe', 'Gombe'),
(16, 'Imo', 'Owerri'),
(17, 'Jigawa', 'Dutse'),
(18, 'Kaduna', 'Kaduna'),
(19, 'Kano', 'Kano'),
(20, 'Katsina', 'Katsina'),
(21, 'Kebbi', 'Birni Kebbi'),
(22, 'Kogi', 'Lokoja'),
(23, 'Kwara', 'Ilorin'),
(24, 'Lagos', 'Ikeja'),
(25, 'Nasarawa', 'Lafia'),
(26, 'Niger', 'Minna'),
(27, 'Ogun', 'Abeokuta'),
(28, 'Ondo', 'Akure'),
(29, 'Osun', 'Oshogbo'),
(30, 'Oyo', 'Ibadan'),
(31, 'Plateau', 'Jos'),
(32, 'Rivers', 'Port Harcout'),
(33, 'Sokoto', 'Sokoto'),
(34, 'Taraba', 'Jalingo'),
(35, 'Yobe', 'Damaturu'),
(36, 'Zamfara', 'Gusau'),
(37, 'FCT', 'Abuja');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(6) NOT NULL DEFAULT 'member',
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(18) NOT NULL,
  `brand_username_name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `r_email` varchar(255) NOT NULL,
  `local_area` varchar(20) NOT NULL,
  `state_local_area` varchar(20) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone1` varchar(11) NOT NULL,
  `phone2` varchar(11) NOT NULL,
  `bus_email` varchar(255) NOT NULL,
  `bus_description` varchar(150) NOT NULL,
  `headline` varchar(100) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `instagram_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `hash_num` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `payment` int(1) NOT NULL DEFAULT 0,
  `forgot_password` varchar(32) NOT NULL,
  `cookie_sessions` varchar(32) NOT NULL,
  `time_registered` varchar(10) NOT NULL,
  `forget_link_expiry` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `type`, `firstname`, `lastname`, `username`, `brand_username_name`, `password`, `r_email`, `local_area`, `state_local_area`, `address`, `phone1`, `phone2`, `bus_email`, `bus_description`, `headline`, `facebook_link`, `instagram_link`, `twitter_link`, `hash_num`, `active`, `payment`, `forgot_password`, `cookie_sessions`, `time_registered`, `forget_link_expiry`) VALUES
(1, 'member', 'Ahmed', 'Olusesi', 'myshoptwo', 'Designs by Blocks', '5f4dcc3b5aa765d61d8327deb882cf99', 'ola.sesi@yahoo.com', 'Ikeja', 'Lagos', '7, oremeji street, Dallas plaza, suite E2 Computer Village, ', '08074574512', '09061937121', 'info@pimpers.com.ng', 'Visit us to see all our products and services. They are all of high quality and are affordable. Click now to explore.', '', '', '', '', 'a516a87cfcaef229b342c437fe2b95f7', 1, 1, '', 'e7a9b61c0ba3f5708b7e28626b0f1597', '1632123799', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_banner`
--
ALTER TABLE `ad_banner`
  ADD PRIMARY KEY (`ad_banner_id`);

--
-- Indexes for table `ad_header`
--
ALTER TABLE `ad_header`
  ADD PRIMARY KEY (`ad_header_id`);

--
-- Indexes for table `ad_header_slide`
--
ALTER TABLE `ad_header_slide`
  ADD PRIMARY KEY (`id_header_slide`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goods_id`);

--
-- Indexes for table `goods_comment`
--
ALTER TABLE `goods_comment`
  ADD PRIMARY KEY (`id_goods_comment`);

--
-- Indexes for table `local_area`
--
ALTER TABLE `local_area`
  ADD PRIMARY KEY (`local_area_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `shop_comment`
--
ALTER TABLE `shop_comment`
  ADD PRIMARY KEY (`shop_comment_id`);

--
-- Indexes for table `shop_rating`
--
ALTER TABLE `shop_rating`
  ADD PRIMARY KEY (`shop_rating_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `slider_topic`
--
ALTER TABLE `slider_topic`
  ADD PRIMARY KEY (`id_topic`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`),
  ADD UNIQUE KEY `state_id` (`state_id`),
  ADD KEY `state_id_2` (`state_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_banner`
--
ALTER TABLE `ad_banner`
  MODIFY `ad_banner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ad_header`
--
ALTER TABLE `ad_header`
  MODIFY `ad_header_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ad_header_slide`
--
ALTER TABLE `ad_header_slide`
  MODIFY `id_header_slide` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `goods_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `goods_comment`
--
ALTER TABLE `goods_comment`
  MODIFY `id_goods_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_area`
--
ALTER TABLE `local_area`
  MODIFY `local_area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=775;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_comment`
--
ALTER TABLE `shop_comment`
  MODIFY `shop_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_rating`
--
ALTER TABLE `shop_rating`
  MODIFY `shop_rating_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider_topic`
--
ALTER TABLE `slider_topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
