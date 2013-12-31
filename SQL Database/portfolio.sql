-- Adminer 3.4.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'UTC';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE `portfolio` (
  `username` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `cash` varchar(255) DEFAULT NULL,
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `order` varchar(255) DEFAULT NULL,
  `orderprice` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `portfolio` (`username`, `name`, `quantity`, `price`, `total`, `cash`, `id`, `order`, `orderprice`) VALUES
('Andy Ang Yong Kiat',	'Blumont, A33.SI',	'9',	'0.081',	'0.81',	'1009777.19',	10,	'Stop Loss',	'0.07'),
('Andy Ang Yong Kiat',	'Blumont, A33.SI',	'100',	'0.085',	'8.5',	'1009688.771',	11,	'Market',	'0.085'),
('Dave Amgaidcdcjce Wongberg',	'Blumont, A33.SI',	'100',	'0.085',	'8.5',	'9951.5',	12,	'Stop Loss',	'0.001'),
('Tan Junwei',	'Singtel, Z74.SI',	'20',	'3.52',	'70.4',	'9657.3',	13,	'Stop Loss',	'3.45'),
('Tan Junwei',	'Ezra, 5DN.SI',	'10',	'1.38',	'13.8',	'9603.5',	14,	'Market',	'1.38'),
('YunShian MakeYou HighHigh',	'Singtel, Z74.SI',	'10',	'3.60',	'36',	'9924',	15,	'Stop Loss',	'2.5');

-- 2013-12-31 07:26:14
