--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `site_url` varchar(85) NOT NULL,
  `site_title` varchar(85) NOT NULL,
  `site_email` varchar(85) NOT NULL,
  `theme` varchar(85) NOT NULL,
  `time_zone` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(35) NOT NULL,
  `a_code` varchar(50) NOT NULL,
  `active` int(1) NOT NULL,
  `level` int(1) NOT NULL,
  `reg_date` varchar(45) NOT NULL,
  `online` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

--
-- Table structure for table `member_sett`
--

CREATE TABLE IF NOT EXISTS `member_sett` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `d_name` varchar(150) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(85) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `city` varchar(155) NOT NULL,
  `country` varchar(155) NOT NULL,
  `thumbnail` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

--
-- Table structure for table `timeline`
--

CREATE TABLE IF NOT EXISTS `timeline` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(140) NOT NULL DEFAULT '',
  `activity` varchar(500) NOT NULL DEFAULT '',
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` int(140) NOT NULL,
  `notice` varchar(500) NOT NULL,
  `time` datetime NOT NULL,
  `seen` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

--
-- Table structure for table `friend_requests`
--

CREATE TABLE IF NOT EXISTS `friend_requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` varchar(255) NOT NULL,
  `to_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM;


--
-- Table structure for table `my_friends`
--

CREATE TABLE IF NOT EXISTS `my_friends` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user1` int(12) NOT NULL,
  `user2` int(12) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

--
-- Table structure for table `pm`
--

CREATE TABLE IF NOT EXISTS `pm` (
  `id` bigint(50) NOT NULL AUTO_INCREMENT,
  `unique_id` bigint(50) NOT NULL,
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;


