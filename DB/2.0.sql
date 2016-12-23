-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 23 Décembre 2016 à 14:04
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `beezymanager`
--

-- --------------------------------------------------------

--
-- Structure de la table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `branch`
--

INSERT INTO `branch` (`id`, `name`, `createdAt`) VALUES
(3, 'BATA', '2016-12-15 17:18:15'),
(4, 'VALLEY', '2016-12-15 17:18:15');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `createdAt`) VALUES
(5, 'CONSOMABLE INFORMATIQUE', '2016-12-17 16:58:23'),
(6, 'SECRETARIAT', '2016-12-19 15:17:20'),
(7, 'UNCATEGORIZED', '2016-12-19 19:25:21');

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `expenditure`
--

CREATE TABLE `expenditure` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unitPrice` double NOT NULL,
  `WholeSalePrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `category_id`, `updated`, `image`, `name`, `barcode`, `unitPrice`, `WholeSalePrice`) VALUES
(73, 6, '2016-12-23 10:58:33', NULL, 'Agenda grand', '2005390332005', 700, 700),
(74, 6, '2016-12-23 10:58:33', NULL, 'Agenda petit', '2004748510706', 0, 0),
(75, 6, '2016-12-23 10:58:33', NULL, 'Agrafe grand', '2002318391700', 0, 0),
(76, 5, '2016-12-23 10:58:33', NULL, 'Clé USB 4G', '2000334020703', 4000, 0),
(77, 5, '2016-12-23 10:58:33', NULL, 'Clé USB 8Go', '2004006201704', 0, 0),
(78, 6, '2016-12-23 10:58:33', NULL, 'Agrafeuse', '2001886243305', 0, 0),
(79, 6, '2016-12-23 10:58:33', NULL, 'Agrafe bebe', '2003248054208', 0, 0),
(80, 5, '2016-12-23 10:58:33', NULL, 'Clé USB  16 Go', '2002347515207', 0, 0),
(81, 5, '2016-12-23 10:58:33', NULL, 'Clé Bluetooth', '2003197476700', 0, 0),
(82, 6, '2016-12-23 10:58:33', NULL, 'Clé  internet', '2007928174200', 0, 0),
(83, 7, '2016-12-23 10:58:33', NULL, 'Antenne 700', '2003851821204', 700, 0),
(84, 6, '2016-12-23 10:58:33', NULL, 'Clavier  option', '2003450427104', 0, 0),
(85, 6, '2016-12-23 10:58:33', NULL, 'Clavier  Occasion', '2007950437502', 0, 0),
(86, 6, '2016-12-23 10:58:33', NULL, 'Clips  petit', '2003518250903', 0, 0),
(87, 6, '2016-12-23 10:58:33', NULL, 'Clips  grand', '2003818535700', 0, 0),
(88, 6, '2016-12-23 10:58:33', NULL, 'Corrector', '2004358710701', 0, 0),
(89, 6, '2016-12-23 10:58:33', NULL, 'corrector  en  tube', '2008632106105', 0, 0),
(90, 5, '2016-12-23 10:58:33', NULL, 'Clé  memo  blanche', '2008297849706', 0, 0),
(91, 6, '2016-12-23 10:58:33', NULL, 'Colle  en  tube  grand', '2008145212508', 0, 0),
(92, 6, '2016-12-23 10:58:33', NULL, 'Colle  grande', '2007070250906', 0, 0),
(93, 6, '2016-12-23 10:58:33', 'jpeg', 'Baffle   d      ordinateur', '2009884118106', 0, 0),
(94, 6, '2016-12-23 10:58:33', NULL, 'Colle  moyenne', '2007945197206', 0, 0),
(95, 6, '2016-12-23 10:58:33', NULL, 'Colle  plus  petit', '2000773719909', 0, 0),
(96, 6, '2016-12-23 10:58:33', NULL, 'Courier  A&D', '2001735944001', 0, 0),
(97, 6, '2016-12-23 10:58:33', NULL, 'bande scotch', '2003925622904', 0, 0),
(98, 6, '2016-12-23 10:58:33', NULL, 'Connecteur', '2004269959305', 0, 0),
(99, 6, '2016-12-23 10:58:33', NULL, 'Corde', '2007996053308', 0, 0),
(100, 6, '2016-12-23 10:58:33', NULL, 'Crayon  spécial', '2004139878101', 0, 0),
(101, 6, '2016-12-23 10:58:33', NULL, 'Crayon  simple', '2004475139904', 0, 0),
(102, 6, '2016-12-23 10:58:33', NULL, 'Crayon  de  couleur', '2002997675504', 0, 0),
(103, 5, '2016-12-23 10:58:33', NULL, 'Barrette de rame 128 mo', '2002214217005', 0, 0),
(104, 6, '2016-12-23 10:58:33', NULL, 'Craie  blanche', '2003573595902', 0, 0),
(105, 6, '2016-12-23 10:58:33', NULL, 'Craie  de  couleur', '2008774834201', 0, 0),
(106, 6, '2016-12-23 10:58:33', NULL, 'Barrette de rame 256 mo', '2005431227802', 0, 0),
(107, 6, '2016-12-23 10:58:33', NULL, 'Barette de ram 512', '2003765040104', 0, 0),
(108, 5, '2016-12-23 10:58:33', NULL, 'Disque  dur  IDE 80  mix', '2004162214907', 0, 0),
(109, 6, '2016-12-23 10:58:33', NULL, 'barrette 1Go', '2000249599301', 0, 0),
(110, 6, '2016-12-23 10:58:33', NULL, 'Barrette de rame2Go', '2003439581803', 0, 0),
(111, 6, '2016-12-23 10:58:33', NULL, 'Barrette de rame 4Go', '2004696161708', 0, 0),
(112, 5, '2016-12-23 10:58:33', NULL, 'Disque  dur  160g', '2009808779000', 0, 0),
(113, 5, '2016-12-23 10:58:33', NULL, 'Disque  dur  inter  iDE 20g', '2009088930900', 0, 0),
(114, 5, '2016-12-23 10:58:33', NULL, 'DVD  simple', '2001832041801', 200, 0),
(115, 5, '2016-12-23 10:58:33', NULL, 'DVD  imprimable', '2003050227203', 0, 0),
(116, 6, '2016-12-23 10:58:33', NULL, 'Barrette d e rame laptop251', '2002302979600', 0, 0),
(117, 5, '2016-12-23 10:58:33', NULL, 'Disque  dur   320/250', '2006072329405', 0, 0),
(118, 5, '2016-12-23 10:58:33', NULL, 'Disque  dur  inter IDE  40g', '2004142377400', 0, 0),
(119, 6, '2016-12-23 10:58:33', NULL, 'Barrette de rame 1G', '2006062328005', 0, 0),
(120, 6, '2016-12-23 10:58:33', NULL, 'Ecouteur  simple  2000', '2000473491204', 2000, 0),
(121, 6, '2016-12-23 10:58:33', NULL, 'Ecouteur  MP3 Micro', '2008641290901', 5000, 0),
(122, 6, '2016-12-23 10:58:33', NULL, 'Enveloppe A3', '2005613974302', 0, 0),
(123, 6, '2016-12-23 10:58:33', NULL, 'Barrette de rame laptop 2G', '2005534449903', 0, 0),
(124, 6, '2016-12-23 10:58:33', NULL, 'Enveloppe  A4', '2008979702503', 0, 0),
(125, 6, '2016-12-23 10:58:33', NULL, 'Enveloppe A5', '2001488428902', 0, 0),
(126, 6, '2016-12-23 10:58:33', NULL, 'Enveloppe  de  50f', '2003137997807', 0, 0),
(127, 5, '2016-12-23 10:58:33', NULL, 'Encrier', '2004419057905', 0, 0),
(128, 5, '2016-12-23 10:58:33', NULL, 'Encre  pour  encrier', '2001863859703', 0, 0),
(129, 6, '2016-12-23 10:58:33', NULL, 'Barrette de  rame laptop4G', '2005136860106', 0, 0),
(130, 6, '2016-12-23 10:58:33', NULL, 'Emballage  CD', '2001127829206', 0, 0),
(131, 6, '2016-12-23 10:58:33', NULL, 'Epingle', '2004887022405', 0, 0),
(132, 6, '2016-12-23 10:58:33', NULL, 'Fronde', '2005297752906', 0, 0),
(133, 5, '2016-12-23 10:58:33', NULL, 'batterie laptop', '2003864931600', 0, 0),
(134, 6, '2016-12-23 10:58:33', NULL, 'Format  couleur', '2002552126106', 0, 0),
(135, 6, '2016-12-23 10:58:33', NULL, 'Grande  pochette', '2000702289305', 0, 0),
(136, 5, '2016-12-23 10:58:33', NULL, 'LECT', '2006208848701', 2500, 0),
(137, 5, '2016-12-23 10:58:33', NULL, 'cable son', '2003704893303', 0, 0),
(138, 5, '2016-12-23 10:58:33', NULL, 'Lecteur  Carte  500', '2008893136200', 500, 0),
(139, 5, '2016-12-23 10:58:33', NULL, 'Lecteur  carte  1000', '2006022936004', 1000, 0),
(140, 5, '2016-12-23 10:58:33', NULL, 'Cable video', '2007579523907', 0, 0),
(141, 5, '2016-12-23 10:58:33', NULL, 'Lecteur  graveur  DVD', '2005354197909', 0, 0),
(142, 5, '2016-12-23 10:58:33', NULL, 'Lecteur  simple  DVD', '2002905964102', 0, 0),
(143, 5, '2016-12-23 10:58:33', NULL, 'Lecteur  CD  simple', '2009891982202', 0, 0),
(144, 5, '2016-12-23 10:58:33', NULL, 'Lecteur baladeur  MP3', '2001782945709', 0, 0),
(145, 5, '2016-12-23 10:58:33', NULL, 'Lecteur  baladeur  MP4', '2008218982208', 0, 0),
(146, 5, '2016-12-23 10:58:33', NULL, 'Multiplicateur  USB', '2000252158502', 0, 0),
(147, 5, '2016-12-23 12:51:37', 'jpeg', 'Manette  USB  4500f', '2004725402208', 4500, 0),
(148, 5, '2016-12-23 10:58:33', NULL, 'Manette  USB  de  6000f', '2005946838401', 6000, 0),
(149, 6, '2016-12-23 10:58:33', NULL, 'Marqueur  blanc', '2009111553106', 0, 0),
(150, 6, '2016-12-23 10:58:33', NULL, 'Adaptateur  Multi  prise', '2009022755408', 350, 0),
(151, 5, '2016-12-23 10:58:33', NULL, 'Micro', '2003433838507', 0, 0),
(152, 5, '2016-12-23 10:58:33', NULL, 'Nettoyeur  VCD & DVD', '2000274195608', 0, 0),
(153, 6, '2016-12-23 10:58:33', NULL, 'Porte  badge  grand  mix', '2003494842000', 0, 0),
(154, 6, '2016-12-23 10:58:33', NULL, 'Porte  badge  petit  Mix', '2006757330207', 0, 0),
(155, 6, '2016-12-23 10:58:33', NULL, 'Pile  rechargeable', '2009766678100', 0, 0),
(156, 6, '2016-12-23 10:58:33', NULL, 'Pile  Kodak  petit', '2003712067406', 0, 0),
(157, 6, '2016-12-23 10:58:33', NULL, 'pile  kodak  moyenne  100', '2008655673806', 0, 0),
(158, 6, '2016-12-23 10:58:33', NULL, 'Pile  gold  store', '2003834899602', 0, 0),
(159, 6, '2016-12-23 10:58:33', NULL, 'Pile  tuceba', '2002905795409', 0, 0),
(160, 6, '2016-12-23 10:58:34', NULL, 'Pile  vinic  grand', '2006572450708', 0, 0),
(161, 5, '2016-12-23 10:58:34', NULL, 'Pile  d''ordinateur', '2007023646107', 0, 0),
(162, 6, '2016-12-23 10:58:34', NULL, 'Papier  carton', '2001943066809', 100, 0),
(163, 6, '2016-12-23 10:58:34', NULL, 'Paragraphe 12', '2007967224409', 0, 0),
(164, 6, '2016-12-23 10:58:34', NULL, 'Pochette  cassable', '2007558959406', 0, 0),
(165, 6, '2016-12-23 10:58:34', NULL, 'Pochette  plastique', '2003443400008', 0, 0),
(166, 6, '2016-12-23 10:58:34', NULL, 'Plastique  pour  format', '2007466617504', 0, 0),
(167, 6, '2016-12-23 10:58:34', NULL, 'Pendule', '2005886414703', 0, 0),
(168, 6, '2016-12-23 10:58:34', NULL, 'Rame  de  papier', '2006619729507', 0, 0),
(169, 6, '2016-12-23 10:58:34', NULL, 'Registre  600p', '2000038745308', 0, 0),
(170, 6, '2016-12-23 10:58:34', NULL, 'Registre  400p', '2007757035109', 0, 0),
(171, 6, '2016-12-23 10:58:34', NULL, 'Registre  300p', '2007385850303', 0, 0),
(172, 6, '2016-12-23 10:58:34', NULL, 'Registre  200p', '2005122758509', 0, 0),
(173, 6, '2016-12-23 10:58:34', NULL, 'Registre  de  transmission', '2005479769104', 0, 0),
(174, 6, '2016-12-23 10:58:34', NULL, 'Sac  pour  CD', '2004730139601', 0, 0),
(175, 6, '2016-12-23 10:58:34', NULL, 'Stylo', '2007217669806', 0, 0),
(176, 6, '2016-12-23 10:58:34', NULL, 'Scotch  à  prix', '2005765315800', 0, 0),
(177, 6, '2016-12-23 10:58:34', NULL, 'scotch  Grand', '2004804664404', 0, 0),
(178, 6, '2016-12-23 10:58:34', NULL, 'scotch  petit', '2005622741704', 0, 0),
(179, 6, '2016-12-23 10:58:34', NULL, 'scotch  plus  petit', '2003616565305', 0, 0),
(180, 6, '2016-12-23 10:58:34', NULL, 'Stiples', '2001776230606', 0, 0),
(181, 6, '2016-12-23 10:58:34', NULL, 'Spiral (100)', '2002467885105', 100, 0),
(182, 6, '2016-12-23 10:58:34', NULL, 'Spiral (200)', '2002251569709', 200, 0),
(183, 6, '2016-12-23 10:58:34', NULL, 'Signature  book', '2009805688602', 0, 0),
(184, 6, '2016-12-23 10:58:34', NULL, 'Super  glue', '2005818335205', 0, 0),
(185, 5, '2016-12-23 10:58:34', NULL, 'Souris  Mix', '2006374336507', 0, 0),
(186, 5, '2016-12-23 10:58:34', NULL, 'Souris  Bluetooth', '2003049140407', 5000, 0),
(187, 5, '2016-12-23 10:58:34', NULL, 'Disque  dur  laptop', '2003812690603', 0, 0),
(188, 6, '2016-12-23 10:58:34', NULL, 'Serre  dos (100)', '2004991666502', 100, 0),
(189, 6, '2016-12-23 10:58:34', NULL, 'Serre  dos (200)', '2008826633806', 200, 0),
(190, 6, '2016-12-23 10:58:34', NULL, 'Sim  reconduct.  Mtn', '2003515291206', 0, 0),
(191, 6, '2016-12-23 10:58:34', NULL, 'SIm  reconduct  Orange', '2005483707406', 0, 0),
(192, 6, '2016-12-23 10:58:34', NULL, 'Sim  Mtn', '2008235510705', 0, 0),
(193, 6, '2016-12-23 10:58:34', NULL, 'Sim  Orange', '2007394605109', 0, 0),
(194, 6, '2016-12-23 10:58:34', NULL, 'Sim  nextell', '2002257722405', 0, 0),
(195, 6, '2016-12-23 10:58:34', NULL, 'Transparent', '2003488621307', 100, 0),
(196, 6, '2016-12-23 10:58:34', NULL, 'Téléphone', '2005818795306', 0, 0),
(197, 6, '2016-12-23 10:58:34', NULL, 'Trombone', '2007099720909', 0, 0),
(198, 6, '2016-12-23 10:58:34', NULL, 'Batterie  rechargeable', '2008872986703', 0, 0),
(199, 5, '2016-12-23 10:58:34', NULL, 'Webcam  4500', '2007883318503', 0, 0),
(200, 6, '2016-12-23 10:58:34', NULL, 'ecouteur si,ple', '2000167633705', 1000, 0),
(201, 6, '2016-12-23 10:58:34', NULL, 'Bloc  note  A5', '2001513133801', 0, 0),
(202, 6, '2016-12-23 10:58:34', NULL, 'Bloc  note  4A', '2000905863807', 0, 0),
(203, 6, '2016-12-23 10:58:34', NULL, 'Carnet  10  recus', '2000681640104', 0, 0),
(204, 6, '2016-12-23 10:58:34', NULL, 'Carnet  50  recus', '2008671761907', 0, 0),
(205, 6, '2016-12-23 10:58:34', NULL, 'Sac  app.  photo', '2008597618101', 0, 0),
(206, 6, '2016-12-23 10:58:34', NULL, 'Facturier  A4', '2005461016605', 0, 0),
(207, 6, '2016-12-23 10:58:34', NULL, 'Pile  hyniat', '2001384110000', 0, 0),
(208, 5, '2016-12-23 10:58:34', NULL, 'Encre  impriman', '2005400035209', 0, 0),
(209, 6, '2016-12-23 10:58:34', NULL, 'Encre  imprimant  grand', '2000090710207', 0, 0),
(210, 5, '2016-12-23 10:58:34', NULL, 'Encre  imprimant  en  sache', '2006934543604', 0, 0),
(211, 5, '2016-12-23 10:58:34', NULL, 'Routeur', '2000570440709', 0, 0),
(212, 5, '2016-12-23 10:58:34', NULL, 'Routeur  wifi', '2002639947709', 0, 0),
(213, 5, '2016-12-23 10:58:34', NULL, 'Alimentation  ordi', '2000491509202', 0, 0),
(214, 6, '2016-12-23 10:58:34', NULL, 'Câble  réseau', '2000084721806', 0, 0),
(215, 6, '2016-12-23 10:58:34', NULL, 'Adaptateur  sata', '2008349587105', 0, 0),
(216, 6, '2016-12-23 10:58:34', NULL, 'Adaptateur  IDE/SATA', '2004485791802', 0, 0),
(217, 6, '2016-12-23 10:58:34', NULL, 'Carte  graphique', '2006208690706', 0, 0),
(218, 6, '2016-12-23 10:58:34', NULL, 'Carte  son', '2008188666405', 0, 0),
(219, 6, '2016-12-23 10:58:34', NULL, 'Porte  clé', '2004385510800', 0, 0),
(220, 6, '2016-12-23 10:58:34', NULL, 'Keyboard  layer', '2005077083602', 0, 0),
(221, 6, '2016-12-23 10:58:34', NULL, 'Ecouteur  simple (1000)', '2009455160800', 1000, 0),
(222, 6, '2016-12-23 10:58:34', NULL, 'Chargeur  tel  simple', '2004662038805', 1000, 0),
(223, 6, '2016-12-23 10:58:34', NULL, 'Trombone  petit  pk', '2005309595101', 0, 0),
(224, 6, '2016-12-23 10:58:34', NULL, 'Chargeur  unversel', '2002605089501', 0, 0),
(225, 6, '2016-12-23 10:58:34', NULL, 'règle', '2008562100501', 0, 0),
(226, 6, '2016-12-23 10:58:34', NULL, 'Boitier  simple', '2000648203403', 500, 0),
(227, 6, '2016-12-23 10:58:34', NULL, 'Chargeur  d''origine  te', '2001524745208', 0, 0),
(228, 6, '2016-12-23 10:58:34', NULL, 'Boitier  d''origine', '2009240642306', 2000, 0),
(229, 6, '2016-12-23 10:58:34', NULL, 'Batterie  simple  tel', '2003735689302', 0, 0),
(230, 6, '2016-12-23 10:58:34', NULL, 'Batterie  d''origine  tel', '2002256910209', 0, 0),
(231, 6, '2016-12-23 10:58:34', NULL, 'cordon  d''origine', '2003925050509', 0, 0),
(232, 6, '2016-12-23 10:58:34', NULL, 'Cordon  simple', '2002909132101', 0, 0),
(233, 5, '2016-12-23 10:58:34', NULL, 'Disque  laptop  160Go', '2006152959805', 0, 0),
(234, 6, '2016-12-23 10:58:34', NULL, 'Chargeur  tablette', '2004126664403', 0, 0),
(235, 6, '2016-12-23 10:58:34', NULL, 'Régulateur  de  la  tension', '2003697450606', 0, 0),
(236, 6, '2016-12-23 10:58:34', NULL, 'Papier à  plstification', '2009018181402', 0, 0),
(237, 6, '2016-12-23 10:58:34', NULL, 'Papier  calque', '2008494568608', 0, 0),
(238, 6, '2016-12-23 10:58:34', NULL, 'Trombone  plus  grand', '2002770045906', 0, 0),
(239, 5, '2016-12-23 10:58:34', NULL, 'Clé wifi', '2008764256402', 0, 0),
(240, 6, '2016-12-23 10:58:34', NULL, 'mp3', '2004234093607', 0, 0),
(241, 6, '2016-12-23 10:58:34', NULL, 'mp4', '2001262361500', 0, 0),
(242, 6, '2016-12-23 10:58:34', NULL, 'Casque  simple', '2005962876609', 0, 0),
(243, 6, '2016-12-23 10:58:34', NULL, 'Chargeur  i  phone', '2009400557204', 0, 0),
(245, 6, '2016-12-23 10:58:34', NULL, 'rallonge', '2008216561405', 0, 0),
(246, 5, '2016-12-23 10:58:34', NULL, 'Clé  USB 120Go', '2008623562002', 0, 0),
(247, 6, '2016-12-23 10:58:34', NULL, 'tablettes', '2006651806105', 0, 0),
(248, 5, '2016-12-23 10:58:34', NULL, 'Disque  laptop 120Go', '2003494928803', 0, 0),
(249, 6, '2016-12-23 10:58:34', NULL, 'Adaptateur  DVI', '2003560817000', 0, 0),
(250, 5, '2016-12-23 10:58:34', NULL, 'Disque  laptop  320Go', '2006856274105', 0, 0),
(251, 6, '2016-12-23 10:58:34', NULL, 'Boite  de  tournevis', '2001036436205', 0, 0),
(252, 6, '2016-12-23 10:58:34', NULL, 'Câble  d''alim (1000)', '2006986513907', 0, 0),
(253, 6, '2016-12-23 10:58:34', NULL, 'Câble  d''alimentation', '2001158792807', 0, 0),
(254, 5, '2016-12-23 10:58:34', NULL, 'Câble  USB  pour  imprimante', '2004452504800', 0, 0),
(255, 5, '2016-12-23 10:58:34', NULL, 'Câble  USB - USB', '2007608162503', 0, 0),
(256, 6, '2016-12-23 10:58:34', NULL, 'Cable  VGA', '2007749330502', 0, 0),
(257, 6, '2016-12-23 10:58:34', NULL, 'Cahier', '2008967790604', 0, 0),
(258, 6, '2016-12-23 10:58:34', NULL, 'Calculatrice  scientifique', '2001449341004', 0, 0),
(259, 6, '2016-12-23 10:58:34', NULL, 'Calculatrice  grande', '2002358864707', 0, 0),
(260, 6, '2016-12-23 10:58:34', NULL, 'Calculatrice  moyenne', '2002480981204', 0, 0),
(261, 6, '2016-12-23 10:58:34', NULL, 'Calculatrice  petit', '2003098132507', 0, 0),
(262, 6, '2016-12-23 10:58:34', NULL, 'Carnet  plus  petit (800)', '2008363126700', 0, 0),
(263, 6, '2016-12-23 10:58:34', NULL, 'Carnet  petit  de  reçu (100p)', '2000928756704', 0, 0),
(264, 6, '2016-12-23 10:58:34', NULL, 'Carnet  plus  petit (50 p)', '2004716989206', 0, 0),
(265, 6, '2016-12-23 10:58:34', NULL, 'carnet  avec  carbone', '2007519453806', 0, 0),
(266, 6, '2016-12-23 10:58:34', NULL, 'carnet 1/3 manifold', '2003400755707', 0, 0),
(267, 6, '2016-12-23 10:58:34', NULL, 'Carte  app  photo  2Go', '2003492792208', 0, 0),
(268, 6, '2016-12-23 10:58:34', NULL, 'Carte  app  photo  4G', '2005994317002', 0, 0),
(269, 6, '2016-12-23 10:58:34', NULL, 'Carte  app  photo 8Go', '2000785397409', 0, 0),
(270, 6, '2016-12-23 10:58:34', NULL, 'Carte  mémoire  1Go', '2001656068701', 0, 0),
(271, 6, '2016-12-23 10:58:34', NULL, 'Carte  mémoire  2Go', '2003833582901', 0, 0),
(272, 6, '2016-12-23 10:58:34', NULL, 'Carte  mémoire  4Go', '2004161617105', 0, 0),
(273, 6, '2016-12-23 10:58:34', NULL, 'Carte  mémoire  8G', '2005089612807', 0, 0),
(274, 6, '2016-12-23 10:58:34', NULL, 'Carte  mémoire 16G', '2001252613404', 0, 0),
(275, 6, '2016-12-23 10:58:34', NULL, 'Carte  mémoire 32G', '2004188842306', 0, 0),
(276, 6, '2016-12-23 10:58:34', NULL, 'Carte  mémoire  SONY', '2007945823402', 0, 0),
(277, 6, '2016-12-23 10:58:34', NULL, 'Carbone', '2000719702804', 0, 0),
(278, 6, '2016-12-23 10:58:34', NULL, 'Carte TV', '2001842817403', 0, 0),
(279, 6, '2016-12-23 10:58:34', NULL, 'Casque', '2009300182902', 0, 0),
(280, 6, '2016-12-23 10:58:34', NULL, 'Casque  Mp3', '2009637866407', 5000, 0),
(281, 6, '2016-12-23 10:58:34', NULL, 'Casque  Bluetooth', '2001122358701', 0, 0),
(282, 5, '2016-12-23 10:58:34', NULL, 'CD Simple', '2009439480504', 150, 0),
(283, 5, '2016-12-23 10:58:34', NULL, 'CD  avec  Etui', '2005820392708', 0, 0),
(284, 6, '2016-12-23 10:58:34', NULL, 'chargeur  multi  tete', '2007504651309', 0, 0),
(285, 6, '2016-12-23 10:58:34', NULL, 'chargeur  app  numérique', '2004459003801', 0, 0),
(286, 6, '2016-12-23 10:58:34', NULL, 'Chargeur  pile  rechargeable', '2002653798301', 0, 0),
(287, 5, '2016-12-23 10:58:34', NULL, 'Chargeur  de  laptop', '2005345243400', 0, 0),
(288, 6, '2016-12-23 10:58:34', NULL, 'Chemise  cartonné', '2004388872806', 0, 0),
(289, 6, '2016-12-23 10:58:34', NULL, 'Classeur  plastique  1500', '2002477275705', 0, 0),
(290, 6, '2016-12-23 10:58:34', NULL, 'Classeur  plastique  2500', '2002311618101', 0, 0),
(291, 6, '2016-12-23 10:58:34', NULL, 'Clé  USB 32Go', '2005537202307', 0, 0),
(293, NULL, '2016-12-23 10:58:34', NULL, 'Clé USB 2Go', '2007253493908', 2500, 0),
(294, NULL, '2016-12-23 10:58:34', NULL, 'Clavier neuf', '2001600303100', 5000, 0),
(295, NULL, '2016-12-23 10:58:34', NULL, 'Souris simple', '2003232411901', 2000, 0),
(296, NULL, '2016-12-23 10:58:34', NULL, 'Pile micro', '2004859474607', 0, 0),
(297, NULL, '2016-12-23 10:58:34', NULL, 'TEST', '2008942755802', 0, 0),
(298, 7, '2016-12-23 10:58:34', NULL, 'antenne', '2000283607307', 1000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `p_transaction`
--

CREATE TABLE `p_transaction` (
  `id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `stransaction_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `profit` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` int(11) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `branch_id`, `name`, `value`, `createdAt`) VALUES
(20, 83, 3, NULL, 0, '2016-12-19 19:36:03'),
(21, 137, 3, NULL, 0, '2016-12-19 19:36:34'),
(22, 252, 3, NULL, 0, '2016-12-19 19:36:59'),
(23, 255, 3, NULL, 0, '2016-12-19 19:37:46'),
(24, 280, 3, NULL, 0, '2016-12-19 19:39:44'),
(25, 282, 3, NULL, 0, '2016-12-19 19:42:36'),
(26, 293, 3, NULL, 0, '2016-12-19 19:53:32'),
(27, 76, 3, NULL, 0, '2016-12-19 19:54:31'),
(28, 114, 3, NULL, 0, '2016-12-19 19:58:18'),
(29, 120, 3, NULL, 0, '2016-12-19 19:59:10'),
(30, 121, 3, NULL, 0, '2016-12-19 19:59:41'),
(31, 136, 3, NULL, 0, '2016-12-19 20:00:04'),
(32, 138, 3, NULL, 0, '2016-12-19 20:00:19'),
(33, 139, 3, NULL, 0, '2016-12-19 20:00:50'),
(34, 146, 3, NULL, 0, '2016-12-19 20:01:06'),
(35, 147, 3, NULL, 0, '2016-12-19 20:01:30'),
(36, 148, 3, NULL, 0, '2016-12-19 20:01:56'),
(37, 150, 3, NULL, 0, '2016-12-19 20:04:33'),
(38, 162, 3, NULL, 0, '2016-12-19 20:04:56'),
(39, 181, 3, NULL, 0, '2016-12-19 20:05:28'),
(40, 182, 3, NULL, 0, '2016-12-19 20:06:21'),
(41, 186, 3, NULL, 0, '2016-12-19 20:06:55'),
(42, 188, 3, NULL, 0, '2016-12-19 20:08:22'),
(43, 189, 3, NULL, 0, '2016-12-19 20:08:36'),
(44, 195, 3, NULL, 0, '2016-12-19 20:09:07'),
(45, 296, 3, NULL, 0, '2016-12-19 20:11:16'),
(46, 221, 3, NULL, 0, '2016-12-19 20:13:46'),
(47, 222, 3, NULL, 0, '2016-12-19 20:14:05'),
(48, 226, 3, NULL, 0, '2016-12-19 20:14:38'),
(49, 227, 3, NULL, 0, '2016-12-19 20:15:27'),
(50, 228, 3, NULL, 0, '2016-12-19 20:15:48'),
(51, 229, 3, NULL, 0, '2016-12-19 20:16:42'),
(52, 230, 3, NULL, 0, '2016-12-19 20:17:03'),
(53, 231, 3, NULL, 0, '2016-12-19 20:17:25'),
(54, 242, 3, NULL, 0, '2016-12-19 20:17:44'),
(55, 245, 3, NULL, 0, '2016-12-19 20:18:05');

-- --------------------------------------------------------

--
-- Structure de la table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `s_transaction`
--

CREATE TABLE `s_transaction` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `totalAmount` double NOT NULL,
  `profit` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `s_transaction`
--

INSERT INTO `s_transaction` (`id`, `branch_id`, `createdAt`, `totalAmount`, `profit`) VALUES
(59, 3, '2016-12-19 16:32:26', 0, NULL),
(60, 3, '2016-12-19 16:32:41', 700, NULL),
(61, 3, '2016-12-19 16:34:26', 8400, NULL),
(62, 3, '2016-12-19 16:50:46', 700, NULL),
(63, 3, '2016-12-19 17:07:00', 0, NULL),
(64, 3, '2016-12-19 19:29:46', 0, NULL),
(65, 3, '2016-12-19 19:29:56', 0, NULL),
(66, 3, '2016-12-19 19:32:17', 0, NULL),
(67, 3, '2016-12-19 19:33:49', 0, NULL),
(68, 3, '2016-12-19 20:19:54', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `transaction_cost`
--

CREATE TABLE `transaction_cost` (
  `id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `branch_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `name`, `language`) VALUES
(1, 3, 'super-admin', 'super-admin', 'super-admin@domain.com', 'super-admin@domain.com', 1, NULL, '$2y$13$mu8o550JtuH2cZgmdJx15uf5iEzYFI4z.gmGIt4.Z9vrhf92oVAai', '2016-12-23 10:51:34', 'xjbrYpt0_jyU4nMR6M1y3RptJjKc7bMK719i0qGQsS8', '2016-12-17 17:21:45', 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', NULL, 'en_GB'),
(2, 4, 'admin', 'admin', 'admin@domain.com', 'admin@domain.com', 1, NULL, '$2y$13$4.iccPJYIiqtxlLwcI5DoeTB6QsRaGienkFCF0xcXgaob8maaRO7y', '2016-12-23 11:09:53', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', NULL, 'fr'),
(3, 3, 'saint-cyr', 'saint-cyr', 'mapoukacyr@yahoo.fr', 'mapoukacyr@yahoo.fr', 1, NULL, '$2y$13$dyms5koeDddNQ21mM5sbiObwFfr9YS9.D0JNKHtAmTyVNGYik4j6W', '2016-12-19 16:16:51', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', NULL, 'en_GB'),
(4, 3, 'charles', 'charles', 'charles@yahoofr', 'charles@yahoofr', 1, NULL, '$2y$13$JSHSKga6n5AJbDWCm5zRsOBGms8aRbYWCA/1r3GqzeGdIuBHkdjCG', '2016-12-22 13:38:06', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 'issiene', 'fr');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_64C19C15E237E06` (`name`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_81398E09C53D045F` (`image`);

--
-- Index pour la table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8D4A5FEBDCD6CC49` (`branch_id`);

--
-- Index pour la table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D34A04AD5E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_D34A04AD97AE0266` (`barcode`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- Index pour la table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `p_transaction`
--
ALTER TABLE `p_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E54BC0053E8901FA` (`stransaction_id`),
  ADD KEY `IDX_E54BC0054584665A` (`product_id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B3656604584665A` (`product_id`),
  ADD KEY `IDX_4B365660DCD6CC49` (`branch_id`);

--
-- Index pour la table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `s_transaction`
--
ALTER TABLE `s_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5F152788DCD6CC49` (`branch_id`);

--
-- Index pour la table `transaction_cost`
--
ALTER TABLE `transaction_cost`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`),
  ADD KEY `IDX_8D93D649DCD6CC49` (`branch_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;
--
-- AUTO_INCREMENT pour la table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `p_transaction`
--
ALTER TABLE `p_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT pour la table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `s_transaction`
--
ALTER TABLE `s_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT pour la table `transaction_cost`
--
ALTER TABLE `transaction_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `expenditure`
--
ALTER TABLE `expenditure`
  ADD CONSTRAINT `FK_8D4A5FEBDCD6CC49` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `FK_E54BC0053E8901FA` FOREIGN KEY (`stransaction_id`) REFERENCES `s_transaction` (`id`),
  ADD CONSTRAINT `FK_E54BC0054584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_4B3656604584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_4B365660DCD6CC49` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`);

--
-- Contraintes pour la table `s_transaction`
--
ALTER TABLE `s_transaction`
  ADD CONSTRAINT `FK_5F152788DCD6CC49` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649DCD6CC49` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
