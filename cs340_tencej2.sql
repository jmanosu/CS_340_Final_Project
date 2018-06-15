-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: Jun 14, 2018 at 10:26 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_tencej`
--

-- --------------------------------------------------------

--
-- Table structure for table `Arena`
--

CREATE TABLE `Arena` (
  `name` varchar(30) NOT NULL,
  `weather` varchar(20) DEFAULT NULL,
  `numChampions` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Arena`
--

INSERT INTO `Arena` (`name`, `weather`, `numChampions`) VALUES
('Black Hole of Doom', 'Cloudy', 5),
('Final Destination', 'Cloudy', 2),
('Fire Mountain', 'Snowy', 2),
('Thunder Dome', 'Sunny', 1),
('Water World', 'Rainy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Champions`
--

CREATE TABLE `Champions` (
  `cID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `arena` varchar(30) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL DEFAULT '0',
  `power` int(11) NOT NULL DEFAULT '1',
  `intelligence` int(11) NOT NULL DEFAULT '1',
  `endurance` int(11) NOT NULL DEFAULT '1',
  `alive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Champions`
--

INSERT INTO `Champions` (`cID`, `name`, `username`, `arena`, `level`, `exp`, `power`, `intelligence`, `endurance`, `alive`) VALUES
(1, 'Spongebob', NULL, NULL, 1, 1, 1, 1, 1, 0),
(2, 'Bob the Builder', NULL, NULL, 1, 1, 1, 1, 1, 0),
(3, 'time bender', NULL, NULL, 2, 234, 234, 234, 234, 0),
(4, 'Larry The Lobster', 'test', 'Fire Mountain', 4, 4, 4, 4, 4, 1),
(5, 'Patrick Star', 'test', 'Fire Mountain', 3, 3, 3, 3, 3, 1),
(6, 'Super Ninja', 'test', 'Thunder Dome', 6, 6, 6, 6, 6, 1),
(7, 'seven man', 'test', 'Black Hole of Doom', 7, 7, 7, 7, 7, 1),
(8, 'The Mountain', 'Super Ice Lord', 'Final Destination', 1, 11, 1, 1, 1, 1),
(9, 'Flash', 'test', 'Black Hole of Doom', 1, 1, 11, 1, 1, 1),
(10, 'Hulk', 'test', 'Final Destination', 999, 999, 999, 999, 999, 1),
(11, 'Zombie Man', 'test', 'Black Hole of Doom', 1, 0, 2, 2, 3, 1),
(12, 'Cool Guy', 'test', 'Black Hole of Doom', 1, 0, 9, 5, 9, 1),
(13, 'Superman', 'test', 'Black Hole of Doom', 1, 0, 9, 7, 5, 0);

--
-- Triggers `Champions`
--
DELIMITER $$
CREATE TRIGGER `ChampionTriggerOnInsert` AFTER INSERT ON `Champions` FOR EACH ROW BEGIN
if new.username IS NOT NULL THEN
	UPDATE Sponsors S
    SET S.cNum = S.cNum + 1,
	S.credits = S.credits - FLOOR((new.power + new.intelligence + new.endurance)/10)
    WHERE S.username = new.username;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ChampionTriggerOnUpdate` AFTER UPDATE ON `Champions` FOR EACH ROW BEGIN
IF new.alive = 0 AND old.alive = 1 THEN
	INSERT INTO `Graveyard` (`cID`,`arena`) VALUES (new.cid,new.arena);
    UPDATE Sponsors S SET S.cNum = S.cNum - 1 WHERE old.username = S.username;
END IF;
IF old.arena IS NOT NULL THEN
	UPDATE Arena A
    SET A.numChampions = A.numChampions - 1
    WHERE A.name = old.arena;
END IF;

	UPDATE Arena A SET A.numChampions = A.numChampions + 1 WHERE A.name = new.arena;
    UPDATE Arena A SET A.numChampions = A.numChampions - 1 WHERE A.name = old.arena;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `eID` varchar(10) NOT NULL,
  `arena` varchar(30) NOT NULL,
  `cID` int(11) NOT NULL,
  `description` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`eID`, `arena`, `cID`, `description`) VALUES
('1', 'Fire Mountain', 1, '0'),
('1', 'Thunder Dome', 1, 'Spongebob ran away'),
('2', 'Thunder Dome', 1, 'Spongebob won the Arena');

-- --------------------------------------------------------

--
-- Table structure for table `Graveyard`
--

CREATE TABLE `Graveyard` (
  `cID` int(11) NOT NULL,
  `arena` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Graveyard`
--

INSERT INTO `Graveyard` (`cID`, `arena`) VALUES
(13, 'Black Hole of Doom'),
(9, 'Final Destination'),
(1, 'Fire Mountain'),
(3, 'Fire Mountain'),
(10, 'Fire Mountain'),
(2, 'Thunder Dome');

-- --------------------------------------------------------

--
-- Table structure for table `HW1`
--

CREATE TABLE `HW1` (
  `username` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `emailAddress` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `age` int(11) NOT NULL,
  `salt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `HW1`
--

INSERT INTO `HW1` (`username`, `firstname`, `lastname`, `emailAddress`, `password`, `age`, `salt`) VALUES
('Benny16', 'Ben', 'Beaver', 'benny@osu.edu', 'a7f0a2668c6f148a02df9ec8f3301477', 20, 'mtxVMRKw7qe/lGwM'),
('jboy', 'billy', 'bob', 'was@new.com', '2ac9cb7dc02b3c0083eb70898e549b63', 1, '746cc4eb7decd1de03ea'),
('lea', 'Amy', 'Le', 'lee@osu.edu', '61bd60c60d9fb60cc8fc7767669d40a1', 20, '746cc4eb7decd1de03ea'),
('test2', 't', 't', 't', 'a5dd1a8a6f38a991392072f8cecb208e', 1, '746cc4eb7decd1de03ea'),
('tmanredDog', 'Bob', 'Joe', 'farmer@corn.com', '854d6fae5ee42911677c739ee1734486', 123, '202cb962ac59075b964b');

-- --------------------------------------------------------

--
-- Table structure for table `Sponsors`
--

CREATE TABLE `Sponsors` (
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `wins` int(11) NOT NULL DEFAULT '0',
  `credits` int(11) NOT NULL DEFAULT '20',
  `cNum` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Sponsors`
--

INSERT INTO `Sponsors` (`username`, `email`, `salt`, `password`, `wins`, `credits`, `cNum`) VALUES
('Fire Wizard', 'flame@gmail.com', 'asdf', 'password', 1, 20, 0),
('Frog', 'water@gmail.com', 'asdf', 'password', 5, 20, 0),
('Gandalf', 'greywizard@gmail.com', 'asdf', 'password', 0, 20, 0),
('God', 'holy@gmail.com', 'asdf', 'password', 2, 20, 0),
('Jimm12', 'jim@gmail.com', 'asdfasdfsadfasd', 'asdfsadfasdfasdf', 0, 20, 0),
('Major Lazer', 'laz@gmail.com', 'asdf', 'password', 0, 20, 0),
('Super Ice Lord', 'snow@gmail.com', 'asdf', 'password', 1, 30, 1),
('test', 'test@gmail.com', 'VWTmNAE5M80Q', '20b0d574460cff45f9209cb7e07904ff', 0, 16, 9);

-- --------------------------------------------------------

--
-- Table structure for table `Winners`
--

CREATE TABLE `Winners` (
  `wID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `cID` int(11) NOT NULL,
  `arena` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Winners`
--

INSERT INTO `Winners` (`wID`, `username`, `cID`, `arena`) VALUES
(1, 'Super Ice Lord', 8, 'Black Hole of Doom');

--
-- Triggers `Winners`
--
DELIMITER $$
CREATE TRIGGER `updateSponsor` AFTER INSERT ON `Winners` FOR EACH ROW BEGIN
IF new.username IS NOT NULL THEN
	UPDATE Sponsors S
    SET S.wins = S.wins + 1, S.credits = S.credits + 10
    WHERE S.username = new.username;
END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Arena`
--
ALTER TABLE `Arena`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `Champions`
--
ALTER TABLE `Champions`
  ADD PRIMARY KEY (`cID`),
  ADD KEY `username` (`username`),
  ADD KEY `arena` (`arena`);

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`eID`,`arena`),
  ADD KEY `cID` (`cID`),
  ADD KEY `arena` (`arena`);

--
-- Indexes for table `Graveyard`
--
ALTER TABLE `Graveyard`
  ADD PRIMARY KEY (`cID`),
  ADD KEY `arena` (`arena`);

--
-- Indexes for table `HW1`
--
ALTER TABLE `HW1`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `Sponsors`
--
ALTER TABLE `Sponsors`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `Winners`
--
ALTER TABLE `Winners`
  ADD PRIMARY KEY (`wID`),
  ADD KEY `username` (`username`),
  ADD KEY `cID` (`cID`),
  ADD KEY `arena` (`arena`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Champions`
--
ALTER TABLE `Champions`
  ADD CONSTRAINT `Champions_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Sponsors` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Champions_ibfk_2` FOREIGN KEY (`arena`) REFERENCES `Arena` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `Events`
--
ALTER TABLE `Events`
  ADD CONSTRAINT `Events_ibfk_1` FOREIGN KEY (`cID`) REFERENCES `Champions` (`cID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Events_ibfk_2` FOREIGN KEY (`arena`) REFERENCES `Arena` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Graveyard`
--
ALTER TABLE `Graveyard`
  ADD CONSTRAINT `Graveyard_ibfk_1` FOREIGN KEY (`arena`) REFERENCES `Arena` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Graveyard_ibfk_2` FOREIGN KEY (`cID`) REFERENCES `Champions` (`cID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Winners`
--
ALTER TABLE `Winners`
  ADD CONSTRAINT `Winners_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Sponsors` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Winners_ibfk_2` FOREIGN KEY (`cID`) REFERENCES `Champions` (`cID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Winners_ibfk_3` FOREIGN KEY (`arena`) REFERENCES `Arena` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
