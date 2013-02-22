-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2013. febr. 22. 15:13
-- Szerver verzió: 5.5.24-log
-- PHP verzió: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `yiiscrum`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet: `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `bizrule` text COLLATE utf8_hungarian_ci,
  `data` text COLLATE utf8_hungarian_ci,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_hungarian_ci,
  `bizrule` text COLLATE utf8_hungarian_ci,
  `data` text COLLATE utf8_hungarian_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `iteration`
--

CREATE TABLE IF NOT EXISTS `iteration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `team_strength` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `label`
--

CREATE TABLE IF NOT EXISTS `label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=8 ;

--
-- A tábla adatainak kiíratása `label`
--

INSERT INTO `label` (`id`, `label`) VALUES
(1, 'a'),
(2, 'b'),
(6, 'bálna'),
(3, 'cars'),
(4, 'fruits'),
(5, 'kacsa'),
(7, 'torta');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `description` text COLLATE utf8_hungarian_ci,
  `start` date NOT NULL,
  `iteration_length` int(11) NOT NULL DEFAULT '1',
  `initial_velocity` int(11) NOT NULL DEFAULT '10',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=4 ;

--
-- A tábla adatainak kiíratása `project`
--

INSERT INTO `project` (`id`, `title`, `description`, `start`, `iteration_length`, `initial_velocity`, `create_time`) VALUES
(1, '111', '222', '1901-01-10', 2, 10, '2013-02-20 13:14:02'),
(2, 'This is the name of the project', '', '2013-02-14', 1, 10, '2013-02-20 15:18:34'),
(3, 'This is also a project', 'Project descripition here....', '2013-02-25', 1, 10, '2013-02-22 12:30:16');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `project_member`
--

CREATE TABLE IF NOT EXISTS `project_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` enum('OWNER','MEMBER','VIEWER') COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=6 ;

--
-- A tábla adatainak kiíratása `project_member`
--

INSERT INTO `project_member` (`id`, `project_id`, `user_id`, `role`) VALUES
(1, 2, 1, 'OWNER'),
(2, 2, 1, 'MEMBER'),
(3, 2, 4, 'VIEWER'),
(4, 2, 3, 'OWNER'),
(5, 3, 1, 'OWNER');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `story`
--

CREATE TABLE IF NOT EXISTS `story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `description` text COLLATE utf8_hungarian_ci,
  `type` enum('FEATURE','BUG','CHORE','RELEASE') COLLATE utf8_hungarian_ci NOT NULL,
  `points` int(11) NOT NULL,
  `requester` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `labels` varchar(200) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `iteration` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` enum('NOT STARTED','STARTED','FINISHED','DELIVERED','REJECTED','ACCEPTED') COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'NOT STARTED',
  PRIMARY KEY (`id`),
  KEY `requester` (`requester`),
  KEY `owner` (`owner`),
  KEY `iteration` (`iteration`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=4 ;

--
-- A tábla adatainak kiíratása `story`
--

INSERT INTO `story` (`id`, `project_id`, `name`, `description`, `type`, `points`, `requester`, `owner`, `labels`, `iteration`, `position`, `status`) VALUES
(1, 2, 's1', '', 'FEATURE', 1, 1, 1, 'a,b', NULL, NULL, 'NOT STARTED'),
(2, 2, 'It''s a story', '<p>bla bla bla ...</p>', 'BUG', 4, 1, 1, 'b,cars,fruits', NULL, NULL, 'NOT STARTED'),
(3, 2, 'Szaftos sztori', '<p>123123</p>', 'FEATURE', 6, 1, 1, 'kacsa,bálna,torta', NULL, NULL, 'NOT STARTED');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `story_activity`
--

CREATE TABLE IF NOT EXISTS `story_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_user` int(11) NOT NULL,
  `comment` text COLLATE utf8_hungarian_ci,
  PRIMARY KEY (`id`),
  KEY `story_id` (`story_id`),
  KEY `create_user` (`create_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `initial` varchar(6) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`initial`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=5 ;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `username`, `initial`, `password`, `email`, `admin`, `create_time`) VALUES
(1, 'akosk', 'ÁK', 'f27c91d4382892b19fc978244b5e2539af396811c2751ac891fed852b369932a', 'akos.kiszely@gmail.com', 1, '2013-02-20 10:31:34'),
(3, 'zsombi', 'ZSK', 'f27c91d4382892b19fc978244b5e2539af396811c2751ac891fed852b369932a', 'zs@zs.hu', 1, '2013-02-20 10:53:45'),
(4, 'aaa', 'ss', 'f27c91d4382892b19fc978244b5e2539af396811c2751ac891fed852b369932a', 'fds@ff.hu', 0, '2013-02-20 11:16:13');

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `project_member`
--
ALTER TABLE `project_member`
  ADD CONSTRAINT `project_member_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_member_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Megkötések a táblához `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `story_ibfk_1` FOREIGN KEY (`requester`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `story_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `story_ibfk_3` FOREIGN KEY (`iteration`) REFERENCES `iteration` (`id`),
  ADD CONSTRAINT `story_ibfk_4` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `story_activity`
--
ALTER TABLE `story_activity`
  ADD CONSTRAINT `story_activity_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_activity_ibfk_2` FOREIGN KEY (`create_user`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
