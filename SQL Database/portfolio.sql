-- Adminer 3.4.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'UTC';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE `portfolio` (
  `name` varchar(20) NOT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `portfolio` (`name`, `quantity`, `price`, `total`) VALUES
('E5H.SI',	'20',	'0.585',	'11.7');

-- 2013-11-23 04:55:28
