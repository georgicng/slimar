SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user` varchar(225) NOT NULL,
  `ip` varchar(225) NOT NULL,
  `message` varchar(225) NOT NULL,
  `time` varchar(225) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `url` varchar(225) NOT NULL,
  `description` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `comments` int(11) NOT NULL DEFAULT '1',
  `view_count` int(11) NOT NULL,
  `type` enum('HTML5','Flash','HTML5-url') NOT NULL,
  `image` longtext NOT NULL,
  `file` longtext NOT NULL,
  `date` varchar(225) NOT NULL,
  `total_votes` int(11) NOT NULL,
  `current_votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games_categories`
--

CREATE TABLE `games_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `min_group` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games_categories`
--

INSERT INTO `games_categories` (`id`, `title`, `status`, `min_group`) VALUES
(1, 'Action', 1, 1),
(2, 'Adventure', 1, 1),
(3, 'Fun', 1, 1),
(4, 'Shooting', 1, 1),
(5, 'Puzzle', 1, 1),
(6, 'Strategy', 1, 1),
(7, 'Sports', 1, 1),
(8, 'Racing', 1, 1),
(9, 'Platformer', 1, 1),
(10, 'Other', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `games_comments`
--

CREATE TABLE `games_comments` (
  `id` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `date` varchar(225) NOT NULL,
  `shown` int(11) NOT NULL DEFAULT '1',
  `sub` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games_played`
--

CREATE TABLE `games_played` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `times_played` int(11) NOT NULL,
  `time` varchar(11) NOT NULL,
  `month_played` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games_rating`
--

CREATE TABLE `games_rating` (
  `rating_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `type` enum('pos','neg','','') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Block, 0 = Unblock'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_notifications`
--

CREATE TABLE `site_notifications` (
  `id` int(11) NOT NULL,
  `type` varchar(225) NOT NULL,
  `text` varchar(225) NOT NULL,
  `button_link` varchar(225) NOT NULL,
  `button_text` varchar(225) NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1',
  `min_rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_notifications`
--

INSERT INTO `site_notifications` (`id`, `type`, `text`, `button_link`, `button_text`, `enabled`, `min_rank`) VALUES
(1, 'notice', 'Google Chrome has now blocked Flash content by default. You will need to enable flash to play some games on this website', '#', 'Find out how', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `url` varchar(225) NOT NULL,
  `title` varchar(200) NOT NULL,
  `about` longtext NOT NULL,
  `template` varchar(225) NOT NULL,
  `logourl` varchar(225) NOT NULL,
  `footer` varchar(200) NOT NULL,
  `postingcalled` varchar(225) NOT NULL,
  `offline` varchar(25) NOT NULL,
  `registeration` int(11) NOT NULL,
  `loginurl` text NOT NULL,
  `captcha` varchar(225) NOT NULL,
  `captcha_reg` int(11) NOT NULL,
  `verify` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `email_template` int(11) NOT NULL,
  `emailserver` varchar(225) NOT NULL,
  `referral` int(11) NOT NULL,
  `defaultpic` text NOT NULL,
  `welcome_title` text NOT NULL,
  `welcome_message` text NOT NULL,
  `ads_enabled` int(11) NOT NULL,
  `ad_1` longtext NOT NULL,
  `ad_2` longtext NOT NULL,
  `direct_game` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`url`, `title`, `about`, `template`, `logourl`, `footer`, `postingcalled`, `offline`, `registeration`, `loginurl`, `captcha`, `captcha_reg`, `verify`, `email`, `email_template`, `emailserver`, `referral`, `defaultpic`, `welcome_title`, `welcome_message`, `ads_enabled`, `ad_1`, `ad_2`, `direct_game`) VALUES
('http://game.slimar.org', 'SlimarGame', 'SlimarGame is a fun game website, where people of all ages can play a range of games. People will be able to sign up, comment, and rate games!<br><br>  SlimarGame is powered by SlimarGame software.   <br><br> This page can be edited inside the administration panel', 'simple', 'images/logo.png', 'Usersystem 2016', '', '0', 1, 'index.php', '0', 0, 0, 'admin@slimar.org', 2, 'c7s1-4e-syd.hosting-services.net.au', 1, 'https://d3q6qq2zt8nhwv.cloudfront.net/m/1_extra_1aeplf03.jpg', 'Welcome to SlimarGame', 'Hey! Its a pleasure to welcome you to SlimarGame! As you can see, this is a welcome message that is sent to you after you register!', 1, '<img src="http://placehold.it/350x250">', '<img src="http://placehold.it/728x90">', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_statistics`
--

CREATE TABLE `site_statistics` (
  `name` varchar(225) NOT NULL,
  `details` varchar(225) NOT NULL,
  `amount` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_statistics`
--

INSERT INTO `site_statistics` (`name`, `details`, `amount`) VALUES
('pageviews', '0', 2892);

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE `usergroups` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `rank` int(11) NOT NULL,
  `css` longtext NOT NULL,
  `has_admin` int(11) NOT NULL DEFAULT '0',
  `can_editcomment` int(11) NOT NULL DEFAULT '0',
  `can_deletecomment` int(11) NOT NULL DEFAULT '0',
  `edit_any_account` int(11) NOT NULL DEFAULT '0',
  `ban_account` int(11) NOT NULL DEFAULT '0',
  `view_any_profile` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroups`
--

INSERT INTO `usergroups` (`id`, `name`, `rank`, `css`, `has_admin`, `can_editcomment`, `can_deletecomment`, `edit_any_account`, `ban_account`, `view_any_profile`) VALUES
(1, 'Member', 1, '', 0, 0, 0, 0, 0, 0),
(6, 'administrator', 6, 'color:red;background:url(https://devbest.com/bgs/backround6.gif);', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(90) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `usergroup` varchar(90) NOT NULL DEFAULT '1',
  `banned` varchar(225) NOT NULL DEFAULT '0',
  `firstname` varchar(225) NOT NULL,
  `country` varchar(225) NOT NULL,
  `timezone` varchar(225) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(225) NOT NULL,
  `email` varchar(150) NOT NULL,
  `profilepic` varchar(225) NOT NULL DEFAULT 'https://d3q6qq2zt8nhwv.cloudfront.net/m/1_extra_1aeplf03.jpg',
  `gravatar` int(11) NOT NULL,
  `comments` varchar(225) NOT NULL,
  `ip` varchar(90) NOT NULL,
  `joindate` varchar(90) NOT NULL,
  `join_month` varchar(225) NOT NULL,
  `messages` varchar(90) NOT NULL DEFAULT '0',
  `aboutme` longtext NOT NULL,
  `website` varchar(300) NOT NULL,
  `page_visits` varchar(90) NOT NULL DEFAULT '0',
  `verified` int(11) NOT NULL,
  `verified_rand` varchar(225) NOT NULL,
  `lastactive` varchar(225) NOT NULL,
  `hide_offline` int(11) NOT NULL DEFAULT '0',
  `referral` varchar(11) NOT NULL,
  `viewprofile` int(11) NOT NULL DEFAULT '1',
  `oauth_provider` enum('','facebook','google','twitter') NOT NULL,
  `oauth_uid` varchar(100) NOT NULL,
  `newsletter` int(11) NOT NULL DEFAULT '0',
  `forgotid` varchar(225) NOT NULL,
  `games_played` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `usergroup`, `banned`, `firstname`, `country`, `timezone`, `dob`, `gender`, `email`, `profilepic`, `gravatar`, `comments`, `ip`, `joindate`, `join_month`, `messages`, `aboutme`, `website`, `page_visits`, `verified`, `verified_rand`, `lastactive`, `hide_offline`, `referral`, `viewprofile`, `oauth_provider`, `oauth_uid`, `newsletter`, `forgotid`, `games_played`) VALUES
(1, 'Admin', '$2y$10$KrjGF/oKdsTfYTTVeK7SFu1opsD0RHaq.NUtRYayrYA1S8otcPqkO', '6', '0', 'Admin', 'Australia', 'Australia/Brisbane', '1997-08-06', 'Male', 'admin@admin.com', 'https://d3q6qq2zt8nhwv.cloudfront.net/m/1_extra_1aeplf03.jpg', 0, '0', '::1', '1485333017', 'January', '0', 'Welcome to my page :} :}', 'http://yoursite.com', '98', 1, '18300', '1489920493', 1, '0', 1, '', '', 0, '850985704', 78);

-- --------------------------------------------------------

--
-- Table structure for table `users_comments`
--

CREATE TABLE `users_comments` (
  `id` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `date` varchar(225) NOT NULL,
  `shown` int(11) NOT NULL DEFAULT '1',
  `sub` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_favourites`
--

CREATE TABLE `users_favourites` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(225) NOT NULL,
  `ip` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip`) VALUES
(1, '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games_categories`
--
ALTER TABLE `games_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games_comments`
--
ALTER TABLE `games_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games_played`
--
ALTER TABLE `games_played`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games_rating`
--
ALTER TABLE `games_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `site_notifications`
--
ALTER TABLE `site_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`url`);

--
-- Indexes for table `site_statistics`
--
ALTER TABLE `site_statistics`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `usergroups`
--
ALTER TABLE `usergroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_comments`
--
ALTER TABLE `users_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_favourites`
--
ALTER TABLE `users_favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `games_categories`
--
ALTER TABLE `games_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `games_comments`
--
ALTER TABLE `games_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `games_played`
--
ALTER TABLE `games_played`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `games_rating`
--
ALTER TABLE `games_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_notifications`
--
ALTER TABLE `site_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usergroups`
--
ALTER TABLE `usergroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users_comments`
--
ALTER TABLE `users_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_favourites`
--
ALTER TABLE `users_favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
