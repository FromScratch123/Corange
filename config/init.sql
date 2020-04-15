-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 13, 2020 at 09:40 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

grant all on Corange.* to CorangeAdminUser@localhost identified by 'CorangeAdminUserPass';
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Corange`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `create_date`, `modified_date`, `delete_flg`) VALUES
(1, '映像', '2020-03-30 04:40:10', '2020-03-30 04:40:10', 0),
(2, '写真', '2020-03-30 04:40:10', '2020-03-30 04:40:10', 0),
(3, '音楽', '2020-03-30 04:40:10', '2020-03-30 04:40:10', 0),
(4, 'デザイン', '2020-03-30 04:40:10', '2020-03-30 04:40:10', 0),
(5, 'WEBサイト', '2020-03-30 04:40:10', '2020-03-30 04:40:10', 0),
(6, 'アプリ', '2020-03-30 04:40:10', '2020-03-30 04:40:10', 0),
(7, 'イラスト', '2020-04-03 14:18:07', '2020-04-03 14:18:07', 0),
(8, 'その他', '2020-04-03 14:18:42', '2020-04-03 14:18:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `post_user` int(11) NOT NULL,
  `open_flg` tinyint(1) NOT NULL DEFAULT '0',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `work_id`, `comment`, `post_user`, `open_flg`, `modified_date`, `create_date`, `delete_flg`) VALUES
(1, 11, '素晴らしいですね！', 6, 1, '2020-04-07 08:05:10', '2020-04-06 03:48:37', 0),
(2, 11, 'いい写真ですね！', 6, 1, '2020-04-07 08:05:10', '2020-04-06 03:59:26', 0),
(3, 11, 'どこで撮ったんですか？', 6, 1, '2020-04-07 08:05:10', '2020-04-06 04:46:09', 0),
(4, 11, 'どこで撮ったんですか？', 6, 1, '2020-04-07 08:05:10', '2020-04-06 04:49:35', 0),
(5, 11, '夕焼けが綺麗ですね', 6, 1, '2020-04-07 08:05:10', '2020-04-06 04:49:50', 0),
(6, 10, 'いい景色ですね！', 2, 1, '2020-04-07 11:13:22', '2020-04-06 08:09:45', 0),
(7, 15, '綺麗ですね！どこで撮ったんですか？', 6, 1, '2020-04-07 04:26:10', '2020-04-07 03:01:01', 0),
(8, 15, '素敵な写真ですね♪', 4, 1, '2020-04-07 04:29:57', '2020-04-07 04:29:18', 0),
(9, 17, 'NY素敵ですね♬', 11, 1, '2020-04-08 11:58:59', '2020-04-08 11:53:09', 0),
(10, 19, 'おしゃれなサイトですね！', 6, 1, '2020-04-09 16:06:52', '2020-04-09 16:03:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `favorite_id` int(11) NOT NULL,
  `register_user` int(10) UNSIGNED NOT NULL,
  `open_flg` tinyint(1) NOT NULL DEFAULT '0',
  `create_user` int(10) UNSIGNED NOT NULL,
  `work_id` int(10) UNSIGNED NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`favorite_id`, `register_user`, `open_flg`, `create_user`, `work_id`, `create_date`, `modified_date`) VALUES
(25, 2, 1, 4, 11, '2020-04-07 07:34:39', '2020-04-07 17:25:07'),
(28, 6, 1, 4, 11, '2020-04-07 08:00:33', '2020-04-07 17:25:07'),
(29, 4, 1, 2, 15, '2020-04-07 10:42:25', '2020-04-07 19:58:32'),
(30, 3, 1, 4, 11, '2020-04-07 11:17:44', '2020-04-07 20:19:11'),
(32, 11, 1, 6, 17, '2020-04-08 11:52:47', '2020-04-08 20:58:59'),
(33, 6, 1, 3, 10, '2020-04-08 12:51:53', '2020-04-08 21:53:04'),
(34, 3, 1, 6, 30, '2020-04-08 12:53:30', '2020-04-08 21:53:48'),
(35, 12, 1, 3, 10, '2020-04-09 06:08:34', '2020-04-09 16:40:24'),
(36, 11, 0, 12, 36, '2020-04-09 15:27:24', '2020-04-10 00:27:24'),
(37, 11, 1, 6, 30, '2020-04-09 15:27:34', '2020-04-10 00:54:54'),
(38, 6, 0, 1, 37, '2020-04-09 16:02:33', '2020-04-10 01:02:33'),
(39, 6, 0, 12, 36, '2020-04-09 16:02:36', '2020-04-10 01:02:36'),
(40, 5, 1, 6, 30, '2020-04-09 16:15:31', '2020-04-10 01:25:15'),
(41, 5, 1, 6, 17, '2020-04-09 16:15:34', '2020-04-10 01:25:15'),
(42, 6, 1, 11, 19, '2020-04-09 16:27:16', '2020-04-10 01:29:16'),
(43, 6, 0, 11, 24, '2020-04-10 12:54:01', '2020-04-10 21:54:01'),
(44, 6, 0, 11, 23, '2020-04-10 12:54:05', '2020-04-10 21:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `belonged_folder` int(10) UNSIGNED NOT NULL,
  `img` varchar(255) NOT NULL,
  `create_user` int(10) UNSIGNED NOT NULL,
  `favorite_flg` tinyint(1) DEFAULT '0',
  `share_flg` tinyint(1) NOT NULL DEFAULT '0',
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `id` int(10) UNSIGNED NOT NULL,
  `folder_name` varchar(255) NOT NULL,
  `create_user` int(10) UNSIGNED NOT NULL,
  `favorite_flg` tinyint(1) NOT NULL DEFAULT '0',
  `share_flg` tinyint(1) NOT NULL DEFAULT '0',
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `id` int(11) NOT NULL,
  `follow_user` int(10) UNSIGNED NOT NULL,
  `followed_user` int(10) UNSIGNED NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `accept_flg` tinyint(1) NOT NULL DEFAULT '0',
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id`, `follow_user`, `followed_user`, `create_date`, `modified_date`, `accept_flg`, `delete_flg`) VALUES
(15, 3, 2, '2020-03-24 03:41:23', '2020-03-24 12:41:30', 1, 0),
(18, 5, 2, '2020-03-26 10:35:50', '2020-03-26 19:37:20', 1, 0),
(19, 5, 1, '2020-03-26 10:36:22', '2020-04-10 00:25:21', 1, 0),
(21, 2, 4, '2020-03-28 00:31:36', '2020-03-28 12:58:14', 1, 0),
(25, 4, 3, '2020-03-28 05:52:52', '2020-03-28 14:56:49', 1, 0),
(27, 3, 6, '2020-03-28 06:32:16', '2020-03-28 15:32:23', 1, 0),
(28, 2, 6, '2020-03-28 06:36:22', '2020-03-28 15:42:14', 1, 0),
(29, 4, 6, '2020-03-29 04:56:18', '2020-03-29 13:57:06', 1, 0),
(30, 12, 3, '2020-04-09 06:15:11', '2020-04-09 17:05:53', 1, 0),
(52, 6, 12, '2020-04-09 07:33:12', '2020-04-10 01:20:47', 1, 0),
(53, 6, 11, '2020-04-09 07:33:26', '2020-04-09 17:03:02', 1, 0),
(54, 6, 5, '2020-04-09 07:33:31', '2020-04-10 00:03:20', 1, 0),
(55, 6, 1, '2020-04-09 07:33:36', '2020-04-10 00:25:24', 1, 0),
(56, 11, 12, '2020-04-09 14:57:34', '2020-04-09 23:57:34', 0, 0),
(57, 11, 3, '2020-04-09 14:57:42', '2020-04-09 23:57:42', 0, 0),
(58, 11, 2, '2020-04-09 14:57:48', '2020-04-09 23:57:48', 0, 0),
(59, 16, 6, '2020-04-09 16:19:29', '2020-04-10 01:25:26', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `from_user` int(10) UNSIGNED NOT NULL,
  `to_user` int(10) UNSIGNED NOT NULL,
  `msg` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `open_flg` tinyint(1) NOT NULL DEFAULT '0',
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `room_id`, `from_user`, `to_user`, `msg`, `create_date`, `modified_date`, `open_flg`, `delete_flg`) VALUES
(54, 12, 3, 2, 'こんにちは。よろしくお願いします。', '2020-03-24 03:42:12', '2020-03-27 20:34:08', 1, 0),
(55, 12, 2, 3, 'こちらこそよろしくお願いします。', '2020-03-24 03:42:36', '2020-03-27 20:33:40', 1, 0),
(56, 12, 2, 3, '今日はいい天気ですね。', '2020-03-24 03:52:06', '2020-03-27 20:33:40', 1, 0),
(57, 12, 3, 2, 'そうですね', '2020-03-24 03:52:51', '2020-03-27 20:34:05', 1, 0),
(59, 12, 3, 2, 'こんにちは。', '2020-03-24 08:19:09', '2020-03-27 20:32:31', 1, 0),
(60, 13, 3, 4, '初めまして。よろしくお願いします。', '2020-03-24 15:54:11', '2020-03-27 21:07:39', 1, 0),
(61, 13, 4, 3, '初めまして。よろしくです。', '2020-03-24 15:57:02', '2020-03-27 21:05:03', 1, 0),
(62, 14, 2, 5, '友達申請ありがとうございます！\r\nよろしくお願いします。', '2020-03-26 10:37:44', '2020-03-27 20:30:51', 1, 0),
(63, 14, 5, 2, '承認ありがとうございます！\r\nこちらこそよろしくお願いします。', '2020-03-26 10:43:31', '2020-03-27 20:28:52', 1, 0),
(64, 14, 5, 2, 'デザインの勉強を最近始めたのですが、\r\nオススメの書籍などありますか？', '2020-03-26 10:51:33', '2020-03-27 20:28:52', 1, 0),
(70, 14, 5, 2, '既読機能をつけました', '2020-03-27 09:36:53', '2020-03-27 20:28:52', 1, 0),
(71, 14, 5, 2, 'これでどうでしょうか？', '2020-03-27 09:45:23', '2020-03-27 20:28:52', 1, 0),
(72, 13, 3, 4, '静岡県に住んでるんですね！', '2020-03-27 12:09:33', '2020-03-27 21:13:41', 1, 0),
(73, 13, 3, 4, '静岡県に住んでるんですね！', '2020-03-27 12:12:20', '2020-03-27 21:13:17', 1, 0),
(74, 13, 4, 3, 'そうなんです！志津香さんはどこ住みですか？', '2020-03-27 12:16:49', '2020-03-27 21:17:11', 1, 0),
(75, 13, 3, 4, ' 私は高知県です！\r\n桂浜があるところです(^ ^)', '2020-03-27 12:18:18', '2020-03-27 21:19:29', 1, 0),
(76, 13, 4, 3, '高知県行ったことないです...行く機会あれば連絡しますね！', '2020-03-27 12:30:41', '2020-03-27 21:31:18', 1, 0),
(77, 13, 3, 4, '是非！案内しますよー', '2020-03-28 02:57:22', '2020-03-28 12:56:42', 1, 0),
(78, 13, 4, 3, '静岡来た際には是非声かけてくださいね！', '2020-03-28 04:25:22', '2020-03-28 13:28:05', 1, 0),
(79, 15, 3, 6, 'こんにちは。', '2020-03-28 06:32:46', '2020-03-28 15:33:54', 1, 0),
(80, 15, 6, 3, 'こんにちは。', '2020-03-28 06:33:32', '2020-03-28 15:34:34', 1, 0),
(81, 15, 3, 6, 'よろしくお願いします。', '2020-03-28 06:33:49', '2020-03-28 15:33:54', 1, 0),
(82, 15, 6, 3, 'こちらこそよろしくお願いします。', '2020-03-28 06:34:29', '2020-03-28 15:34:34', 1, 0),
(83, 15, 3, 6, 'お元気ですか？', '2020-03-28 06:35:28', '2020-03-28 15:40:05', 1, 0),
(84, 16, 6, 2, '初めまして。', '2020-03-28 06:46:18', '2020-03-28 20:02:02', 1, 0),
(85, 16, 2, 6, '初めまして', '2020-03-28 06:54:24', '2020-03-28 20:02:10', 1, 0),
(86, 17, 4, 6, '承認ありがとうございます！\r\nよろしくお願いします。', '2020-03-29 04:57:34', '2020-03-29 13:58:11', 1, 0),
(87, 17, 6, 4, 'こちらこそよろしくお願いします( ^ω^ )', '2020-03-29 04:58:50', '2020-03-29 14:00:09', 1, 0),
(88, 17, 6, 4, 'ロゴのデザインをしてくださる方を探しているのですが、可能でしょうか？', '2020-04-04 04:29:39', '2020-04-04 14:31:12', 1, 0),
(89, 16, 6, 2, 'よろしくお願いします', '2020-04-06 06:28:22', '2020-04-06 17:03:02', 1, 0),
(90, 18, 4, 2, 'こんにちは。', '2020-04-07 10:45:47', '2020-04-07 19:45:47', 0, 0),
(91, 13, 3, 4, 'さくらさんの作品素敵ですね！', '2020-04-07 11:17:16', '2020-04-09 23:25:23', 1, 0),
(92, 13, 4, 3, 'ありがとうございます！\r\nもっと勉強しないといけないですけどね', '2020-04-07 11:23:50', '2020-04-09 23:04:19', 1, 0),
(93, 13, 3, 4, '私も勉強しないとです汗', '2020-04-09 14:18:38', '2020-04-09 23:21:12', 1, 0),
(94, 13, 4, 3, '今度一緒に勉強しましょう♬', '2020-04-09 14:26:54', '2020-04-09 23:27:01', 1, 0),
(95, 13, 3, 4, 'ぜひ！\r\nオンラインで一緒に勉強とか面白そうですね！', '2020-04-09 14:29:02', '2020-04-09 23:55:18', 1, 0),
(96, 17, 4, 6, 'はい。もう少し詳しく聞かせていただけますか？\r\n', '2020-04-09 14:55:04', '2020-04-10 00:55:19', 1, 0),
(97, 19, 6, 11, 'こんにちは。よろしくお願いします。', '2020-04-09 16:05:54', '2020-04-10 01:05:54', 0, 0),
(98, 19, 11, 6, 'こんにちは。こちらこそよろしくお願いします。', '2020-04-09 16:07:13', '2020-04-10 01:10:01', 1, 0),
(99, 20, 12, 6, '友達申請ありがとうございます！よろしくお願いします(^^)', '2020-04-09 16:21:39', '2020-04-10 01:21:39', 0, 0),
(100, 21, 6, 16, '友達申請ありがとうございます！よろしくお願いします！', '2020-04-09 16:25:52', '2020-04-10 01:25:52', 0, 0),
(101, 20, 6, 12, 'こちらこそ承認ありがとうございます！よろしくお願いします。', '2020-04-09 16:26:19', '2020-04-10 01:26:19', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(10) UNSIGNED NOT NULL,
  `host_user` int(11) UNSIGNED NOT NULL,
  `invited_user` int(11) UNSIGNED NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `host_user`, `invited_user`, `create_date`, `modified_date`, `delete_flg`) VALUES
(12, 3, 2, '2020-03-24 03:41:58', '2020-03-24 12:41:58', 0),
(13, 3, 4, '2020-03-24 15:53:48', '2020-03-25 00:53:48', 0),
(14, 2, 5, '2020-03-26 10:37:27', '2020-03-26 19:37:27', 0),
(15, 3, 6, '2020-03-28 06:32:38', '2020-03-28 15:32:38', 0),
(16, 6, 2, '2020-03-28 06:46:05', '2020-03-28 15:46:05', 0),
(17, 4, 6, '2020-03-29 04:57:14', '2020-03-29 13:57:14', 0),
(18, 4, 2, '2020-04-07 10:45:08', '2020-04-07 19:45:08', 0),
(19, 6, 11, '2020-04-09 16:05:42', '2020-04-10 01:05:42', 0),
(20, 12, 6, '2020-04-09 16:21:00', '2020-04-10 01:21:00', 0),
(21, 6, 16, '2020-04-09 16:25:37', '2020-04-10 01:25:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE `share` (
  `id` int(10) UNSIGNED NOT NULL,
  `shared_folder` int(10) UNSIGNED NOT NULL,
  `shared_file` int(10) UNSIGNED NOT NULL,
  `share_user` int(10) UNSIGNED NOT NULL,
  `shared_user` int(10) UNSIGNED NOT NULL,
  `authority` int(11) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `surname` varchar(255) NOT NULL,
  `givenname` varchar(255) NOT NULL,
  `age` varchar(3) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `prefecture` varchar(255) DEFAULT NULL,
  `municipalities` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT './../images/default_user_icon.png',
  `banner_img` varchar(255) DEFAULT './../images/default_user_banner.jpg',
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `surname`, `givenname`, `age`, `tel`, `email`, `zip`, `prefecture`, `municipalities`, `address`, `slogan`, `profile`, `password`, `profile_img`, `banner_img`, `delete_flg`, `created_date`, `modified_date`) VALUES
(1, '鈴木', '一郎', '33', NULL, 'ichiro@example.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$9iBKCkytMTp.1pNYD1.teul7vb5QKdseS7YMVsRVSNEVAfIWZE4TC', './../images/userPost/1585214318_1484d8378f8f11c1dcb3ec31cc8d222b49a14706..jpeg', './../images/userPost/1585214318_cff71964603036c5e4dc2553abe59432234d5874..jpeg', 0, '2020-03-18 02:34:48', '2020-03-26 18:18:38'),
(2, '佐藤', '太一', NULL, NULL, 'taichi@example.com', '1200022', '東京都', '足立区柳原', NULL, 'He who moves not forward, goes backward.', '都内でウェブデザイナーをしてます。\r\n\r\n同じ業界の方と繋がりたいです。\r\n\r\nよろしくお願いします。', '$2y$10$jEavpLY5JNA3OOkh6YIu4OBBXCk0UGJcLSMmAzETh4lxnhR0JmZdS', './../images/userPost/1585214408_8db11a22c70ebf8057ba51edf53a6c5eaaece91c..jpeg', './../images/default_user_banner.jpg', 0, '2020-03-20 04:15:29', '2020-03-26 18:20:08'),
(3, '高橋', '志津香', '23', NULL, 'shizuka@example.com', '7800023', '高知県', '高知市東秦泉寺9', NULL, '世界を救える奴は、世界を救おうとした奴だけだ。', '高知県住みの23歳です。最近デザインの勉強を始めました。\r\n同じようにデザイン勉強している方と繋がりたいです。\r\nよろしくお願いします。\r\n', '$2y$10$0hJbXXrWUUvavUNWdvp58ecXytXbPrz3UzCopzxmm2rdCVjtZeyUi', './../images/userPost/1585189463_114693f8f84260029e7918a8c3e92552e9a38a6d..jpeg', './../images/userPost/1585180900_a027e1fea92c47cd204ae5f18336e39f4f77904e..jpeg', 0, '2020-03-22 01:03:17', '2020-03-26 17:17:15'),
(4, '田中', 'さくら', '27', NULL, 'sakura@example.com', '4200021', '静岡県', '静岡市葵区茶町', NULL, '誰かの曇った心にさす虹になりなさい。', '静岡でデザイン事務所を運営しています。顧客に寄り添ったデザインを心がけています。\r\nいつでもご相談ください。', '$2y$10$u/pIEUrlcoC184xJIs8dteX3UmPEWIhqtCSvOiO/EcnrztsGR7T5e', './../images/userPost/1585063505_ea33679326e4283367a3f9ba9ae5eec741434b22..jpeg', './../images/userPost/1585312131_0c2d5604df0f77020379f35baf958f07337cde30..jpeg', 0, '2020-03-24 09:24:34', '2020-03-27 21:28:51'),
(5, '木村', '翔太', NULL, NULL, 'shota@example.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$AFGRMjXmnAxkhNOuwalVqehV867AEwSeqGv2YuovWE3mmmxzCdrom', './../images/userPost/1585216966_fb88eef471c3208097c3346546d2671e0ca229c2..jpeg', './../images/userPost/1585217047_9c0ac3df80dacf4b84e5d0e4f7cd3d203c039139..jpeg', 0, '2020-03-26 09:58:07', '2020-03-26 19:04:07'),
(6, 'From', 'Scratch', '31', NULL, 'fromscratch@example.com', NULL, '兵庫県', NULL, NULL, 'You can start from scratch, anytime, anywhere', 'プログラミング&英語学習中！未経験からエンジニア転職を目指す31歳 \r\n▽2019/10〜プログラミング勉強開始 | 転職活動中 | HTML/css/JavaScript/PHP ▽2014/02〜 英語勉強開始 | Philippines→Canada | TOEIC550→765→880 ', '$2y$10$RDYARvJloAE4leWs.COyRupCW3uowp0KskKQP3DuGW49yojgFubR6', './../images/userPost/1585376466_8528c12d5ec7041c4f46a2e2bb8c75a04681cda3..jpeg', './../images/userPost/1585376936_cbbd119eb2cb6b5ba217d74bb8c3430bfe2e3044..jpeg', 0, '2020-03-28 06:17:46', '2020-04-10 01:13:02'),
(11, '斎藤', '美月', '21', NULL, 'mizuki@example.com', '4600023', '愛知県', '名古屋市中区金山町', NULL, 'まごころを、君に', 'デザインとゲームをこよなく愛する21歳。\r\n16歳でデザインを学び始める | 18歳でWEB製作会社へ就職 | 20歳で独立 | フリーランス2年目\r\nご依頼はお気軽に↓\r\nmizuki@example.com', '$2y$10$2OJJlkUjBqh6q5CnlEhuz.NB6IA4wSi2npc67ew0MfUDRvGzzjIUq', './../images/userPost/1586322646_dbbb04edaf464a5a56ce135ffca357e8253c5b28..jpeg', './../images/userPost/1586346504_cb49c84b239c3d2eb571907297b636bc262286a7..jpeg', 0, '2020-04-08 05:05:13', '2020-04-10 01:30:39'),
(12, '上坂', '雫', NULL, NULL, 'shizuku@example.com', NULL, NULL, NULL, NULL, 'カメラ至上主義', 'カメラ歴12年の女子。女子カメラ旅主催者。', '$2y$10$ce9r85YhUpHGkMRqMQDtP.c3vid31rkob5nIN6E4R60Co.D25oj8i', './../images/userPost/1586412593_351cde0fbbe60af5e911535e4d304101aa0b64b0..jpeg', './../images/userPost/1586413044_024cbe2af06d3941303c441f1b61f2ac47ebaedb..jpeg', 0, '2020-04-09 00:41:04', '2020-04-09 15:17:24'),
(16, '谷崎', '拓巳', '27', NULL, 'takumi@example.com', NULL, '福岡県', NULL, NULL, '被写体に命を吹き込む', 'お花専門フォトグラファー。\r\n九州を中心に活動しています。ご依頼はお気軽に↓\r\ntakumi@example.com', '$2y$10$AvJzYYET0NqwierM6tURgexyDpwpowgsSPc4ueaGshLnBQo69A3XG', './../images/userPost/1586449011_968fd3e6892e1ded83c79b685a3df9bed84bdbba..jpeg', './../images/userPost/1586449129_53893315b16c567107f0c95fd5346a53a8bd4901..jpeg', 0, '2020-04-09 16:16:29', '2020-04-10 01:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `work_id` int(11) NOT NULL,
  `work` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `description` text,
  `create_user` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `work`, `thumbnail`, `title`, `category`, `description`, `create_user`, `modified_date`, `create_date`, `delete_flg`) VALUES
(10, './../images/userPost/1585921987_86bc61b527ecaabe33f7fde6e52264660bfd578f..jpeg', './../images/userPost/1585921987_86bc61b527ecaabe33f7fde6e52264660bfd578f..jpeg', 'トロント', 1, 'カナダの都市トロントです。とても綺麗に撮れました。', 3, '2020-04-07 16:07:30', '2020-04-03 13:53:07', 0),
(11, './../images/userPost/1585922035_624e7c9a0357f22f781b5906247c0fa169085a5c..jpeg', './../images/userPost/1585922035_624e7c9a0357f22f781b5906247c0fa169085a5c..jpeg', 'Reluxuriest', 4, 'エステサロンのWEBサイトです。\r\nデザインからコーディングまで全て自身で行っています。\r\nURL→ https://fromscratch123.github.io/Reluxuriest/\r\nGitHub→ https://github.com/FromScratch123/Reluxuriest\r\n\r\n▷デザイン\r\n当該エステサロンのターゲットを比較的経済的に余裕のある大人の女性に設定（想定：30代後半以降）し、テーマカラーに紫を採用することで、高貴で優雅なイメージと芸術性を演出しています。\r\n使用カラーを3色に抑え、シンプルな印象を与えつつも多様な模様の背景によって、芸術的なイメージを表現しています。\r\nまた、予約の導線を常に確保することで、エンゲージメントを高める工夫をしています。\r\n\r\n▷コーディング\r\nHTML、CSS、JavaScriptを使用しています。\r\nCSSのメディアクエリを使用し、レスポンシブ対応にしています。', 4, '2020-04-08 07:34:01', '2020-04-03 13:53:55', 0),
(14, './../images/userPost/1586228312_2f126d80846574b8ad3887fb83181a7f32c29cd3..jpeg', './../images/userPost/1586228312_2f126d80846574b8ad3887fb83181a7f32c29cd3..jpeg', '美しい景色', 2, '素敵な景色に出会った時、全ての意味が繋がる。', 2, '2020-04-07 02:58:32', '2020-04-07 02:58:32', 0),
(16, './../images/userPost/1586267039_3c8be07f1d8ed4c743943a1eb3e5bc19c7ed8483.JPG', './../images/default_work_thumbnail.jpg', 'タイムズスクエア', 2, NULL, 6, '2020-04-08 11:53:56', '2020-04-07 13:43:59', 1),
(17, './../images/userPost/1586275437_f4a80571df862f0a22b2b72960772f891f8b21bf..jpeg', './../images/userPost/1586275437_f4a80571df862f0a22b2b72960772f891f8b21bf..jpeg', 'Times Square', 2, 'NYに訪れた際に撮影したタイムズスクエアの写真です。', 6, '2020-04-07 16:03:57', '2020-04-07 16:03:57', 0),
(18, './../images/userPost/1586324125_d2ca4a4c5dea3d7866f36e4fb41fcf5973cb4ad5..png', './../images/userPost/1586324125_d2ca4a4c5dea3d7866f36e4fb41fcf5973cb4ad5..png', 'Reluxuriest', 4, 'エステサロンのWEBサイトです。\r\nデザインからコーディングまで全て自身で行っています。\r\nURL→ https://fromscratch123.github.io/Reluxuriest/\r\nGitHub→ https://github.com/FromScratch123/Reluxuriest\r\n\r\n▷デザイン\r\n当該エステサロンのターゲットを比較的経済的に余裕のある大人の女性に設定（想定：30代後半以降）し、テーマカラーに紫を採用することで、高貴で優雅なイメージと芸術性を演出しています。\r\n使用カラーを3色に抑え、シンプルな印象を与えつつも多様な模様の背景によって、芸術的なイメージを表現しています。\r\nまた、予約の導線を常に確保することで、エンゲージメントを高める工夫をしています。\r\n\r\n▷コーディング\r\nHTML、CSS、JavaScriptを使用しています。\r\nCSSのメディアクエリを使用し、レスポンシブ対応にしています。', 11, '2020-04-08 08:58:46', '2020-04-08 05:35:25', 1),
(19, './../images/userPost/1586341835_ecfd231b8782a8eb9c9970974e6a46235c111b5f..png', './../images/userPost/1586341835_ecfd231b8782a8eb9c9970974e6a46235c111b5f..png', 'Reluxuriest #01', 5, 'エステサロンのWEBサイトです。\r\nデザインからコーディングまで全て自身で行っています。\r\nURL→ https://fromscratch123.github.io/Reluxuriest/\r\nGitHub→ https://github.com/FromScratch123/Reluxuriest\r\n\r\n▷デザイン\r\n当該エステサロンのターゲットを比較的経済的に余裕のある大人の女性に設定（想定：30代後半以降）し、テーマカラーに紫を採用することで、高貴で優雅なイメージと芸術性を演出しています。\r\n使用カラーを3色に抑え、シンプルな印象を与えつつも多様な模様の背景によって、芸術的なイメージを表現しています。\r\nまた、予約の導線を常に確保することで、エンゲージメントを高める工夫をしています。\r\n\r\n▷コーディング\r\nHTML、CSS、JavaScriptを使用しています。\r\nCSSのメディアクエリを使用し、レスポンシブ対応にしています。\r\n\r\n', 11, '2020-04-08 11:09:53', '2020-04-08 10:30:35', 0),
(20, './../images/userPost/1586344226_c05d7d67188f45132a99c4a3ea802daf82aa2867..png', './../images/userPost/1586344226_c05d7d67188f45132a99c4a3ea802daf82aa2867..png', 'Reluxuriest #02', 5, 'エステサロンのWEBサイトです。\r\nデザインからコーディングまで全て自身で行っています。\r\nURL→ https://fromscratch123.github.io/Reluxuriest/\r\nGitHub→ https://github.com/FromScratch123/Reluxuriest\r\n\r\n▷デザイン\r\n当該エステサロンのターゲットを比較的経済的に余裕のある大人の女性に設定（想定：30代後半以降）し、テーマカラーに紫を採用することで、高貴で優雅なイメージと芸術性を演出しています。\r\n使用カラーを3色に抑え、シンプルな印象を与えつつも多様な模様の背景によって、芸術的なイメージを表現しています。\r\nまた、予約の導線を常に確保することで、エンゲージメントを高める工夫をしています。\r\n\r\n▷コーディング\r\nHTML、CSS、JavaScriptを使用しています。\r\nCSSのメディアクエリを使用し、レスポンシブ対応にしています。\r\n\r\n', 11, '2020-04-08 11:10:39', '2020-04-08 11:10:26', 0),
(21, './../images/userPost/1586344366_511b2b92126f25e0ec9b3e557ee79a60147d32ad..png', './../images/userPost/1586344366_511b2b92126f25e0ec9b3e557ee79a60147d32ad..png', 'Reluxuriest #03', 5, 'エステサロンのWEBサイトです。\r\nデザインからコーディングまで全て自身で行っています。\r\nURL→ https://fromscratch123.github.io/Reluxuriest/\r\nGitHub→ https://github.com/FromScratch123/Reluxuriest\r\n\r\n▷デザイン\r\n当該エステサロンのターゲットを比較的経済的に余裕のある大人の女性に設定（想定：30代後半以降）し、テーマカラーに紫を採用することで、高貴で優雅なイメージと芸術性を演出しています。\r\n使用カラーを3色に抑え、シンプルな印象を与えつつも多様な模様の背景によって、芸術的なイメージを表現しています。\r\nまた、予約の導線を常に確保することで、エンゲージメントを高める工夫をしています。\r\n\r\n▷コーディング\r\nHTML、CSS、JavaScriptを使用しています。\r\nCSSのメディアクエリを使用し、レスポンシブ対応にしています。\r\n\r\n', 11, '2020-04-08 11:12:46', '2020-04-08 11:12:46', 0),
(22, './../images/userPost/1586344446_594ee94f3089b653fcfd31f0b01c23f8ff7d3ef2..jpeg', './../images/userPost/1586344446_594ee94f3089b653fcfd31f0b01c23f8ff7d3ef2..jpeg', 'Orange ', 2, '', 11, '2020-04-08 11:14:06', '2020-04-08 11:14:06', 0),
(23, './../images/userPost/1586344520_c3c8658bf19a45d42b1229670c6c3626a1af95bf..jpeg', './../images/userPost/1586344520_c3c8658bf19a45d42b1229670c6c3626a1af95bf..jpeg', 'Orange #02', 2, '', 11, '2020-04-08 11:15:20', '2020-04-08 11:15:20', 0),
(24, './../images/userPost/1586344582_0414761ed981a6a3f159d1b65d610365c39b2a71..jpeg', './../images/userPost/1586344582_0414761ed981a6a3f159d1b65d610365c39b2a71..jpeg', 'Painting Wall', 4, '', 11, '2020-04-08 11:16:22', '2020-04-08 11:16:22', 0),
(25, './../images/userPost/1586344620_44102dc260472ef150456605a6d47721691d8ac4..jpeg', './../images/userPost/1586344620_44102dc260472ef150456605a6d47721691d8ac4..jpeg', 'colorful pen', 7, '', 11, '2020-04-08 11:17:00', '2020-04-08 11:17:00', 0),
(26, './../images/userPost/1586344730_7e2d2fe0f61c1c969f11d5b18bf6f1ffaf67676e..jpeg', './../images/userPost/1586344730_7e2d2fe0f61c1c969f11d5b18bf6f1ffaf67676e..jpeg', 'light bulb', 2, '', 11, '2020-04-08 11:18:50', '2020-04-08 11:18:50', 0),
(27, './../images/userPost/1586346999_2f1c3fff3db0da2d6714fa536ef68c106c57ccfe..jpeg', './../images/userPost/1586346999_2f1c3fff3db0da2d6714fa536ef68c106c57ccfe..jpeg', 'photographer', 8, '', 6, '2020-04-08 11:56:47', '2020-04-08 11:56:39', 1),
(28, './../images/userPost/1586347111_d819c2d176c4a7432d61fb1ec0b5f874978ca44d..jpeg', './../images/userPost/1586347111_d819c2d176c4a7432d61fb1ec0b5f874978ca44d..jpeg', 'photographer', 8, '', 6, '2020-04-08 11:59:23', '2020-04-08 11:58:31', 1),
(29, './../images/userPost/1586347514_d1011be7a1cd1f9ae47d8b26f8f54d61c6b1fb12..jpeg', './../images/userPost/1586347514_d1011be7a1cd1f9ae47d8b26f8f54d61c6b1fb12..jpeg', 'photographer', 8, '', 6, '2020-04-08 12:05:23', '2020-04-08 12:05:14', 1),
(30, './../images/userPost/1586347657_43fa402664c3138719c69e8b613d7513cc083aeb..jpeg', './../images/userPost/1586347657_43fa402664c3138719c69e8b613d7513cc083aeb..jpeg', 'photographer', 8, '', 6, '2020-04-08 12:07:37', '2020-04-08 12:07:37', 0),
(31, './../images/userPost/1586350280_951fbb7d825b20c52570a10528adebf2fc3fcee3..jpeg', './../images/userPost/1586350280_951fbb7d825b20c52570a10528adebf2fc3fcee3..jpeg', 'Orange', 2, '', 6, '2020-04-08 12:51:20', '2020-04-08 12:51:20', 0),
(32, './../images/userPost/1586398620_54b610e7024cb36788da13e6de5c59ab76967674..jpeg', './../images/userPost/1586398620_54b610e7024cb36788da13e6de5c59ab76967674..jpeg', 'camera ', 2, '', 12, '2020-04-09 02:17:00', '2020-04-09 02:17:00', 0),
(33, './../images/userPost/1586409119_c8c2aaf37b8c94436c2804ed6c83301cba080b11..jpeg', './../images/userPost/1586409119_c8c2aaf37b8c94436c2804ed6c83301cba080b11..jpeg', 'memo', 8, '', 3, '2020-04-09 05:29:59', '2020-04-09 05:11:59', 1),
(34, './../images/userPost/1586445003_0ad30da873fcd6f03e70efe96ddb0b6212d5dbcd..jpeg', './../images/userPost/1586445003_0ad30da873fcd6f03e70efe96ddb0b6212d5dbcd..jpeg', 'microphone', 3, '大阪で音楽活動してます木村翔太です。Funkelnというバンドのボーカル＆ギターやってます。\r\n音楽制作賜ります。\r\n\r\n詳しくはこちらから↓\r\nhttps://funkeln_osaka_japan.com\r\n', 5, '2020-04-09 15:10:03', '2020-04-09 15:10:03', 0),
(35, './../images/userPost/1586445286_ba3d3ccaf5a45b0563c160c05f89bd346815e0d2..jpeg', './../images/userPost/1586445286_ba3d3ccaf5a45b0563c160c05f89bd346815e0d2..jpeg', 'Rose & Woman', 2, '', 1, '2020-04-09 15:14:46', '2020-04-09 15:14:46', 0),
(36, './../images/userPost/1586445419_ee075e3362914670d00d6557d6b0dbf6bb6d66f3..jpeg', './../images/userPost/1586445419_ee075e3362914670d00d6557d6b0dbf6bb6d66f3..jpeg', 'little girl', 2, '可愛い女の子にモデルになって貰いました。\r\n子供を撮るのは大変だけど、とっても楽しいです！', 12, '2020-04-09 15:16:59', '2020-04-09 15:16:59', 0),
(37, './../images/userPost/1586445550_813ec3e2af59a08f0ce85de31618b11efd910ceb..jpeg', './../images/userPost/1586445550_813ec3e2af59a08f0ce85de31618b11efd910ceb..jpeg', 'fall (drone angle)', 1, 'ドローンで撮影しました。\r\nやっぱり俯瞰的なアングルは一気に雰囲気が出ますね！', 1, '2020-04-09 15:19:10', '2020-04-09 15:19:10', 0),
(38, './../images/userPost/1586449731_e19a725ef728c6492d7c26edc198009592569f90..jpeg', './../images/userPost/1586449731_e19a725ef728c6492d7c26edc198009592569f90..jpeg', 'flower', 2, '', 6, '2020-04-09 16:28:51', '2020-04-09 16:28:51', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`favorite_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`email`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folder`
--
ALTER TABLE `folder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `share`
--
ALTER TABLE `share`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
