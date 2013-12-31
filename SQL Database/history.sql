-- Adminer 3.4.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'UTC';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `username` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `cash` varchar(255) DEFAULT NULL,
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `history` (`username`, `name`, `quantity`, `price`, `total`, `cash`, `id`) VALUES
('Tan Junwei',	'Ezra, 5DN.SI',	'10',	'1.415',	'14.15',	'9945.85',	1),
('Harry Peter John Mary',	'LionGold, A78.SI',	'10',	'0.178',	'1.78',	'500',	2),
('Andy Ang Yong Kiat',	'Blumont, A33.SI',	'1000',	'0.102',	'102',	'1009858',	6),
('Ni Hao',	'Genting SP, G13.SI',	'100',	'1.455',	'145.5',	'1000',	7),
('Tan Junwei',	'Ezra, 5DN.SI',	'10',	'1.415',	'14.05',	'9919.9',	11),
('Tan Junwei',	'Singtel, Z74.SI',	'20',	'3.61',	'72.2',	'9807.7',	12),
('Tan Junwei',	'Singtel, Z74.SI',	'20',	'3.61',	'0',	'9767.7',	13),
('Andy Ang Yong Kiat',	'Blumont, A33.SI',	'1000',	'0.102',	'0',	'1009818',	14),
('Andy Ang Yong Kiat',	'Blumont, A33.SI',	'10',	'0.081',	'0.81',	'1009777.19',	15),
('Andy Ang Yong Kiat',	'Blumont, A33.SI',	'1',	'0.081',	'0.081',	'1009737.271',	16),
('Andy Ang Yong Kiat',	'Blumont, A33.SI',	'100',	'0.085',	'8.5',	'1009688.771',	17),
('Dave Amgaidcdcjce Wongberg',	'Blumont, A33.SI',	'100',	'0.085',	'8.5',	'9951.5',	18),
('Tan Junwei',	'Singtel, Z74.SI',	'20',	'3.52',	'70.4',	'9657.3',	19),
('Dorothy Amgjhbchagaf Letuchysky',	'LionGold, A78.SI',	'10',	'0.178',	'1.7',	'9919.92',	20),
('Tan Junwei',	'Ezra, 5DN.SI',	'10',	'1.38',	'13.8',	'9603.5',	21),
('YunShian MakeYou HighHigh',	'Singtel, Z74.SI',	'10',	'3.60',	'36',	'9924',	22),
('Simon Kretowicz',	'Blumont, A33.SI',	'50',	'0.086',	'4.3',	'9955.7',	23),
('Simon Kretowicz',	'Blumont, A33.SI',	'50',	'0.086',	'4.3',	'9920',	24);

-- 2013-12-31 07:26:03
