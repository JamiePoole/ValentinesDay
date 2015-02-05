-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2015 at 12:16 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `twitter_romance`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
`eid` int(11) NOT NULL,
  `etime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `code` int(8) DEFAULT NULL COMMENT '$e->code',
  `message` text COMMENT '$e->message',
  `file` text COMMENT '$e->file',
  `line` int(8) DEFAULT NULL COMMENT '$e->line'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tweet_archive`
--

CREATE TABLE IF NOT EXISTS `tweet_archive` (
  `tid` int(11) NOT NULL COMMENT 'ID',
  `dtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Delivery Time (default Now)',
  `duser` text NOT NULL COMMENT 'Delivery Recipient',
  `dmessage` text NOT NULL COMMENT 'Message',
  `dmedia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tweet_queue`
--

CREATE TABLE IF NOT EXISTS `tweet_queue` (
`tid` int(11) NOT NULL COMMENT 'ID',
  `dtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Delivery Time (default Now)',
  `duser` text NOT NULL COMMENT 'Delivery Recipient',
  `dmessage` text NOT NULL COMMENT 'Message'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tweet_recipients`
--

CREATE TABLE IF NOT EXISTS `tweet_recipients` (
`uid` int(11) NOT NULL,
  `tdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sname` varchar(128) NOT NULL,
  `tobject` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tweet_sender`
--

CREATE TABLE IF NOT EXISTS `tweet_sender` (
`id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `recipient` varchar(24) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `agent` text NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `tweet_archive`
--
ALTER TABLE `tweet_archive`
 ADD UNIQUE KEY `tid` (`tid`), ADD KEY `dmedia` (`dmedia`);

--
-- Indexes for table `tweet_queue`
--
ALTER TABLE `tweet_queue`
 ADD PRIMARY KEY (`tid`), ADD KEY `dtime` (`dtime`);

--
-- Indexes for table `tweet_recipients`
--
ALTER TABLE `tweet_recipients`
 ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `uid` (`uid`), ADD UNIQUE KEY `sname` (`sname`);

--
-- Indexes for table `tweet_sender`
--
ALTER TABLE `tweet_sender`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `recipient` (`recipient`), ADD KEY `ip` (`ip`), ADD KEY `tid` (`tid`), ADD KEY `recipient_2` (`recipient`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tweet_queue`
--
ALTER TABLE `tweet_queue`
MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `tweet_recipients`
--
ALTER TABLE `tweet_recipients`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tweet_sender`
--
ALTER TABLE `tweet_sender`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
