-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2015 at 03:01 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alvisai`
--

CREATE DATABASE alvisai;

-- --------------------------------------------------------

--
-- Table structure for table `app_contactus`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`app_contactus` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `contacted_by` bigint(255) NOT NULL,
  `contact_reason` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contacted_by` (`contacted_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ALL CONTEACT REQUEST' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `app_contactus`
--



-- --------------------------------------------------------

--
-- Table structure for table `app_feedbacks`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`app_feedbacks` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `feedback_by` bigint(255) NOT NULL,
  `feedback_topic` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `feedback_by` (`feedback_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT=' All feedbacks by users' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `app_feedbacks`
--



-- --------------------------------------------------------

--
-- Table structure for table `app_jobs`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`app_jobs` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `job_request_from` bigint(255) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `person_ideals` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_request_from` (`job_request_from`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='all request for jobs' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `app_jobs`
--



-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`users` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `login_no` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date NULL,
  `join_day` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` enum('M','F') NULL,
  `country` varchar(2) NOT NULL,
  `language` varchar(50) DEFAULT 'English',
  `time_zone` varchar(50) DEFAULT NULL,
  `security_question` varchar(100) NOT NULL,
  `security_answer` varchar(20) NOT NULL,
  `hometown` varchar(255) DEFAULT NULL,
  `hobby` varchar(50) DEFAULT NULL,
  `about` text,
  `web` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `cover_pic` varchar(100) DEFAULT NULL,
  `bg_color` varchar(6) DEFAULT NULL,
  `bg_img` varchar(100) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `views` bigint(255) NOT NULL DEFAULT '0',
  `score` bigint(255) NOT NULL DEFAULT '0',
  `question_title` varchar(50) DEFAULT NULL,
  `allow_anonymous_ask` enum('0','1') NOT NULL DEFAULT '1',
  `who_can_ask` enum('a','b') NOT NULL DEFAULT 'a',
  `account_active` enum('0','1') NOT NULL DEFAULT '1',
  `online` enum('0','1') NOT NULL DEFAULT '0',
  `last_login`  datetime DEFAULT NULL,
  `sad` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ALL THE INFORMATION OF USERS' AUTO_INCREMENT=41 ;

--
-- Dumping data for table `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_comments`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`users_comments` (
  `no` bigint(255) NOT NULL AUTO_INCREMENT,
  `target` enum('a','b') NOT NULL,
  `target_no` bigint(255) NOT NULL,
  `commenter_id` bigint(255) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ALL THE COMMENTS BY USERS' AUTO_INCREMENT=77 ;

--
-- Dumping data for table `users_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `users_friends`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`users_friends` (
  `no` bigint(255) NOT NULL AUTO_INCREMENT,
  `follower_id` bigint(255) NOT NULL,
  `following_id` bigint(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ALL FOLLOWERS AND FOLLOWING OF USERS' AUTO_INCREMENT=181 ;

--
-- Dumping data for table `users_friends`
--


-- --------------------------------------------------------

--
-- Table structure for table `users_likes`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`users_likes` (
  `no` bigint(255) NOT NULL AUTO_INCREMENT,
  `target` enum('a','b') NOT NULL,
  `target_no` bigint(255) NOT NULL,
  `liker_id` bigint(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ALL THE LIKES BY USERS' AUTO_INCREMENT=161 ;

--
-- Dumping data for table `users_likes`
--



-- --------------------------------------------------------

--
-- Table structure for table `users_notifications`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`users_notifications` (
  `no` bigint(255) NOT NULL AUTO_INCREMENT,
  `from` bigint(255) NOT NULL,
  `to` bigint(255) NOT NULL,
  `link_no` bigint(20) NOT NULL,
  `link_type` varchar(30) NOT NULL,
  `seen` enum('0','1') NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ALL THE NOTIFICATIONS' AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users_notifications`
--



-- --------------------------------------------------------

--
-- Table structure for table `users_questions`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`users_questions` (
  `no` bigint(255) NOT NULL AUTO_INCREMENT,
  `anonymously` enum('0','1') NOT NULL DEFAULT '0',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `asker_id` bigint(255) NOT NULL,
  `asked_to` bigint(255) NOT NULL,
  `question` varchar(300) NOT NULL,
  `answer` text NOT NULL,
  `attachments` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ALL anonymously ASKED QUESTION/ANSWERS' AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users_questions`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_updates`
--

CREATE TABLE IF NOT EXISTS `alvisai`.`users_updates` (
  `no` bigint(255) NOT NULL AUTO_INCREMENT,
  `anonymously` enum('0','1') NOT NULL DEFAULT '0',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL,
  `feeling` varchar(50) NOT NULL,
  `updater_id` bigint(255) NOT NULL,
  `update` text NOT NULL,
  `attachments` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ALL THE UPDATES BY THE USERS' AUTO_INCREMENT=117 ;

--
-- Dumping data for table `users_updates`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
