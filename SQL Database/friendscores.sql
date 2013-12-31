-- Adminer 3.4.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'UTC';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `friendscores`;
CREATE TABLE `friendscores` (
  `username` varchar(255) DEFAULT NULL,
  `friendsusername` varchar(255) DEFAULT NULL,
  `cash` int(255) unsigned DEFAULT NULL,
  `friendsid` varchar(255) DEFAULT '',
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `friendscores` (`username`, `friendsusername`, `cash`, `friendsid`) VALUES
('Dave Amgaidcdcjce Wongberg',	'Dave Amgaidcdcjce Wongberg',	9951,	'100007194343035'),
('Andy Ang Yong Kiat',	'Tan Junwei',	9603,	'1630825616'),
('Andy Ang Yong Kiat',	'Harry Peter John Mary',	500,	'100003261904425'),
('Andy Ang Yong Kiat',	'Ni Hao',	1000,	'100005940485423'),
('Andy Ang Yong Kiat',	'Andy Ang Yong Kiat',	1009688,	'1038065991'),
('Tan Junwei',	'Andy Ang Yong Kiat',	1009688,	'1038065991'),
('Tan Junwei',	'Harry Peter John Mary',	500,	'100003261904425'),
('Tan Junwei',	'Ni Hao',	1000,	'100005940485423'),
('Tan Junwei',	'Tan Junwei',	9657,	'1630825616'),
('Open Graph Test User',	'Open Graph Test User',	10000,	'100006985149311'),
('Tom Amgbhggfaija Schrockman',	'Dave Amgaidcdcjce Wongberg',	9951,	'100007194343035'),
('Tom Amgbhggfaija Schrockman',	'Tom Amgbhggfaija Schrockman',	10000,	'100007287761901'),
('Linda Amgdjabdjfji McDonaldescu',	'Dave Amgaidcdcjce Wongberg',	9951,	'100007194343035'),
('Linda Amgdjabdjfji McDonaldescu',	'Linda Amgdjabdjfji McDonaldescu',	10000,	'100007401240609'),
('Dorothy Amgjhbchagaf Letuchysky',	'Dave Amgaidcdcjce Wongberg',	9951,	'100007194343035'),
('Dorothy Amgjhbchagaf Letuchysky',	'Dorothy Amgjhbchagaf Letuchysky',	10000,	'100007082381716'),
('Ni Hao',	'Andy Ang Yong Kiat',	1009688,	'1038065991'),
('Ni Hao',	'Tan Junwei',	9657,	'1630825616'),
('Ni Hao',	'Harry Peter John Mary',	500,	'100003261904425'),
('Ni Hao',	'Ni Hao',	1000,	'100005940485423'),
('Peter Woo',	'Andy Ang Yong Kiat',	1009688,	'1038065991'),
('Peter Woo',	'Tan Junwei',	9657,	'1630825616'),
('Peter Woo',	'Peter Woo',	10000,	'100001034851730'),
('Andy Ang Yong Kiat',	'Tan Junwei',	9603,	'1630825616'),
('YunShian MakeYou HighHigh',	'Andy Ang Yong Kiat',	1009688,	'1038065991'),
('YunShian MakeYou HighHigh',	'Tan Junwei',	9603,	'1630825616'),
('YunShian MakeYou HighHigh',	'YunShian MakeYou HighHigh',	10000,	'1118613109'),
('Andy Ang Yong Kiat',	'YunShian MakeYou HighHigh',	9924,	'1118613109'),
('Rachael Chan',	'Andy Ang Yong Kiat',	1009688,	'1038065991'),
('Rachael Chan',	'YunShian MakeYou HighHigh',	9924,	'1118613109'),
('Rachael Chan',	'Tan Junwei',	9603,	'1630825616'),
('Rachael Chan',	'Rachael Chan',	10000,	'1153385864'),
('Simon Kretowicz',	'Simon Kretowicz',	9955,	'1650747961'),
('Simon Kretowicz',	'Simon Kretowicz',	9955,	'1650747961');

-- 2013-12-31 07:25:53
