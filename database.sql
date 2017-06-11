-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2017 at 03:43 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id`        INT(11)          NOT NULL,
  `user_id`   INT(11)          NOT NULL,
  `post_id`   INT(11)          NOT NULL,
  `flag_id`   INT(11)          NOT NULL,
  `text`      VARCHAR(255)
              COLLATE utf8_bin NOT NULL,
  `timestamp` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `flag_id`, `text`, `timestamp`) VALUES
  (1, 1, 1, 1, 'test', '2017-05-31 23:55:14'),
  (2, 1, 1, 1, 'tes', '2017-06-01 13:07:10'),
  (3, 1, 2, 1, ' mm', '2017-06-04 15:13:36'),
  (4, 3, 1, 2, 'asd', '2017-06-04 16:38:48'),
  (5, 1, 1, 2, 'mkk', '2017-06-09 10:04:00'),
  (6, 1, 1, 1, 'dadada', '2017-06-09 10:05:38'),
  (7, 1, 1, 1, 'sada', '2017-06-09 14:19:01'),
  (8, 1, 8, 1, 'hehehe', '2017-06-09 22:22:20'),
  (9, 1, 1, 1, 'undefined', '2017-06-09 22:42:32'),
  (10, 1, 1, 1, 'dasda', '2017-06-10 20:35:09'),
  (11, 1, 2, 1, 'sadad', '2017-06-10 20:35:30'),
  (12, 1, 1, 1, 'dad', '2017-06-10 20:37:52'),
  (13, 1, 2, 1, 'adsad', '2017-06-11 13:35:15'),
  (14, 1, 2, 1, 'sdadadsad', '2017-06-11 13:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id`   INT(11)          NOT NULL,
  `name` VARCHAR(255)
         COLLATE utf8_bin NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `flags`
--

INSERT INTO `flags` (`id`, `name`) VALUES
  (1, 'ok'),
  (2, 'removed');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id`        INT(11)          NOT NULL,
  `user_id`   INT(11)          NOT NULL,
  `flag_id`   INT(11)          NOT NULL,
  `title`     VARCHAR(255)
              COLLATE utf8_bin NOT NULL,
  `image`     VARCHAR(255)
              COLLATE utf8_bin NOT NULL,
  `timestamp` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `flag_id`, `title`, `image`, `timestamp`) VALUES
  (1, 1, 2, 'Not funny tho', 'https://www.wpromote.com/blog/wp-content/uploads/2015/06/morpheus-meme.jpg',
   '2017-06-01 10:19:57'),
  (2, 1, 1, 'LMAO', 'http://images.memes.com/meme/137150', '2017-06-01 12:59:03'),
  (3, 3, 1, '#friends', 'https://s-media-cache-ak0.pinimg.com/736x/3b/f8/39/3bf839473fdec43adaaba5b475832e3a.jpg', '2017-06-05 08:44:51'),
  (8, 1, 1, 'sa', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/3df203fbe53ffe5014f32fa3a46431f3.jpg', '2017-06-09 22:15:14'),
  (9, 1, 1, 'Tets', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/1d6ae67e96940a025c9bfd634e06a19a.jpg', '2017-06-09 22:53:14'),
  (10, 1, 1, 'as', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/bcb7fe1aac4713481c3ede53c88c99c2.jpg', '2017-06-09 22:53:30'),
  (11, 1, 1, 'aszz', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/46bdce37f1dbcf896f66d7f837127d72.jpg', '2017-06-09 22:53:40'),
  (12, 1, 1, 'as', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/ce10faafc5ffd4fec01ed6fc84229ae9.jpg', '2017-06-11 09:33:36'),
  (13, 1, 1, 'as', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/b05fea9fe21f7c70e071b1ab8a5f4a17.jpg', '2017-06-11 09:33:39'),
  (14, 1, 1, 'as', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/a83a58d922cff42c584bb4c1531c5d98.jpg', '2017-06-11 09:34:44'),
  (15, 1, 1, 'undefined', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/d7d9c5fe4702764df822bc11f467f6bb.jpg', '2017-06-11 09:55:27'),
  (16, 1, 1, 'undefined', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/282893201a50eb78342e5def2a4c0935.jpg',
   '2017-06-11 10:02:32'),
  (17, 1, 1, 'dasd', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/ee455ed2eb8462f9e5719c2061fb09eb.jpg',
   '2017-06-11 11:18:05'),
  (18, 1, 1, 'dads', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/fb5bc358810faf3f4016f0b8b8c86fad.jpg',
   '2017-06-11 12:49:47'),
  (19, 1, 1, 'dasdada', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/80c6b6be20c6c8363217e38d89839954.jpg',
   '2017-06-11 12:50:34'),
  (20, 1, 1, 'ad', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/59c0b9724a9fda3dfbfb6e054d730d64.jpg',
   '2017-06-11 12:54:23'),
  (21, 1, 1, 'adsad', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/ae4bf242c332cfc0bf56f0112283bd2b.jpg',
   '2017-06-11 12:55:10'),
  (22, 1, 1, 'sadsada', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/47ecd97ae03e6381ed736435264ece4e.jpg',
   '2017-06-11 12:55:35'),
  (23, 1, 1, 'dsada', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/0a7525328222768ad1996d1013452a4c.jpg',
   '2017-06-11 13:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `reported_comments`
--

CREATE TABLE `reported_comments` (
  `id`         INT(11)   NOT NULL,
  `user_id`    INT(11)   NOT NULL,
  `comment_id` INT(11)   NOT NULL,
  `timestamp`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `reported_posts`
--

CREATE TABLE `reported_posts` (
  `id`        INT(11)   NOT NULL,
  `user_id`   INT(11)   NOT NULL,
  `post_id`   INT(11)   NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `reported_posts`
--

INSERT INTO `reported_posts` (`id`, `user_id`, `post_id`, `timestamp`) VALUES
  (1, 1, 1, '2017-06-10 14:43:39'),
  (2, 8, 1, '2017-06-10 14:44:50'),
  (3, 1, 2, '2017-06-10 19:49:34'),
  (4, 1, 2, '2017-06-10 19:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id`   INT(11)          NOT NULL,
  `name` VARCHAR(15)
         COLLATE utf8_bin NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
  (1, 'user'),
  (2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `upvoted_comments`
--

CREATE TABLE `upvoted_comments` (
  `id`         INT(11)   NOT NULL,
  `user_id`    INT(11)   NOT NULL,
  `comment_id` INT(11)   NOT NULL,
  `timestamp`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `upvoted_comments`
--

INSERT INTO `upvoted_comments` (`id`, `user_id`, `comment_id`, `timestamp`) VALUES
  (1, 3, 1, '2017-06-04 16:42:38'),
  (2, 1, 1, '2017-06-08 13:37:18'),
  (4, 1, 2, '2017-06-09 22:22:53'),
  (5, 1, 6, '2017-06-09 22:33:17'),
  (6, 1, 5, '2017-06-09 22:46:39'),
  (7, 1, 7, '2017-06-09 22:48:09'),
  (8, 25, 9, '2017-06-10 23:29:45'),
  (9, 25, 1, '2017-06-10 23:29:48'),
  (10, 25, 2, '2017-06-10 23:33:00'),
  (11, 25, 4, '2017-06-10 23:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `upvoted_posts`
--

CREATE TABLE `upvoted_posts` (
  `id`        INT(11)   NOT NULL,
  `user_id`   INT(11)   NOT NULL,
  `post_id`   INT(11)   NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `upvoted_posts`
--

INSERT INTO `upvoted_posts` (`id`, `user_id`, `post_id`, `timestamp`) VALUES
  (1, 2, 1, '2017-06-04 21:56:36'),
  (2, 1, 2, '2017-06-06 01:13:00'),
  (35, 1, 1, '2017-06-09 14:09:57'),
  (36, 1, 8, '2017-06-09 22:22:09'),
  (37, 1, 3, '2017-06-09 23:04:28'),
  (38, 25, 9, '2017-06-10 18:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id`        INT(11)          NOT NULL,
  `flag_id`   INT(11)          NOT NULL,
  `role_id`   INT(11)          NOT NULL,
  `username`  VARCHAR(255)
              COLLATE utf8_bin NOT NULL,
  `password`  VARCHAR(255)
              COLLATE utf8_bin NOT NULL,
  `firstname` VARCHAR(255)
              COLLATE utf8_bin NOT NULL,
  `lastname`  VARCHAR(255)
              COLLATE utf8_bin NOT NULL,
  `image`     VARCHAR(255)
              COLLATE utf8_bin NOT NULL,
  `token`     VARCHAR(255)
              COLLATE utf8_bin DEFAULT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `flag_id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `image`, `token`)
VALUES
  (1, 1, 1, 'miloss', '0192023a7bbd73250516f069df18b500', 'Milos', 'Brajevic',
   'https://scontent.fbeg1-1.fna.fbcdn.net/v/t1.0-9/11217964_10205117518199540_2565989827669045482_n.jpg?oh=ea6f71b2fda11fe140defba615ab06ac&oe=59AD9D24',
   '79044f55851b7395a63af132b90b4f2a3659a43a'),
  (2, 1, 1, 'brajevic', '751d98db1458fc3a97c475e0d52f52ab', 'Milos', 'Brajevic', 'image.jpg', '81c700f6b45b3bdd38bf3e5639590d77b875755f'),
  (3, 1, 1, 'adadad', '3188cea6ccdabf0985eb7b42bae6b32a', 'adasdasd', 'asfsafasfafaf', 'asdsadasdadad\n', 'ecda81307c19fce318d29bb5f4fd6a5337ff9fd7'),
  (8, 1, 1, 'adadada', '3188cea6ccdabf0985eb7b42bae6b32a', 'adasdasd', 'asfsafasfafaf', 'asdsadasdadad\n', 'e12099b9be9cdc98bd0f392b50c089c4b303d9f5'),
  (9, 1, 1, 'adadadz', '3188cea6ccdabf0985eb7b42bae6b32a', 'adasdasd', 'asfsafasfafaf', 'asdsadasdadad\n', 'bc175a2213e22de76215c77100d224a0c6b5740c'),
  (11, 1, 1, 'adadadza', '3188cea6ccdabf0985eb7b42bae6b32a', 'adasdasd', 'asfsafasfafaf', 'asdsadasdadad\n', '7f979e5ba8c13d2206b6a254add3c0c2e5696f94'),
  (15, 1, 1, 'adadadzaa', '3188cea6ccdabf0985eb7b42bae6b32a', 'adasdasd', 'asfsafasfafaf', 'asdsadasdadad\n', '5ef5bc079cb4450bd08f27473b016499b7701a4a'),
  (17, 1, 1, 'dasdasdad', 'cff2c4f1b6147fccbde5a1f670202cfd', 'sadadad', 'dasdasdasd', 'dasdasdadad', '30c4e05c862354723dcbe5c2ff5274c9777c543f'),
  (18, 1, 1, 'dassdadad', '88382df54db5f9e6891fcf7aa32a84ec', 'dasdsad', 'asdaddad', 'dasd', '1003bf6abd35299578c2a57da35b4fdbf1e26fe5'),
  (19, 1, 1, 'dasdasd', 'eb399413e9030dee3ef3a9b7c76ec735', 'dad', 'dsad', 'dad', '4bfeaf6008ac6e2be0c43aec2b07ddf06dd9b3ac'),
  (20, 1, 1, 'brj', '751d98db1458fc3a97c475e0d52f52ab', 'milos', 'brajevic', 'mi', '031a4fb11b244e06f399c95b9f811a27d836551c'),
  (21, 1, 1, 'mil', '0192023a7bbd73250516f069df18b500', 'mi', 'mi', 'mil', 'd08c7ffcb7b49f288e8d1fe9bf6b152823b75117'),
  (22, 1, 1, 'mila', '0192023a7bbd73250516f069df18b500', 'mi', 'mi', 'mil', '10b3a02d3e6fd141ec7152f2c8587b17693390a9'),
  (23, 1, 1, 'xxas', '152f7c279613e7e707a3f3f4cb7a6d92', 'dasd', 'dasd', 'da',
   '2ba3231cbaea77eec386d44d107b588854907144'),
  (24, 1, 1, 'milossaszxa', '0192023a7bbd73250516f069df18b500', 'sadad', 'dasda', 'asda',
   'e6a190ec794d3976a735d0e079ab5c08e176b2c0'),
  (25, 1, 2, 'milos', 'b82753180960205a4a62feff9c0f93f5', 'milos', 'milos', 'milos.jpg',
   '4c394b13f2801369a68af960a3bd9d7e3bd4defe'),
  (26, 1, 1, 'milossazza', '0192023a7bbd73250516f069df18b500', 'dsa', 'sadasd',
   'http://127.0.0.1:80/koolio-api/api/users/uploads/75d36ad408a25afc7ac3203fd72cc6ce.jpg',
   'f942a98dc9cbabca5f974e5d8a2f95ccfaf8d5b4'),
  (27, 1, 1, '13125152124', '0192023a7bbd73250516f069df18b500', 'adsad', 'ddsad',
   'http://127.0.0.1:80/koolio-api/api/users/uploads/25f075d66d4d530ff794e6806143fbd4.jpg',
   '2e0918407a319ae6a8b5f8308adbb24f644c6701'),
  (28, 1, 1, 'addasdsad', '0192023a7bbd73250516f069df18b500', 'asdsadas', 'dadasda',
   'http://127.0.0.1:80/koolio-api/api/users/uploads/d318e6fb46aa0e0fa3c1216dbdadcac4.jpg',
   '56150c20e6091f02a073087a44ae995f7adcc2a0'),
  (29, 1, 1, 'dadasdsadasd1', 'e38ca2ae054c6f66e723c285890cb96b', 'asdasdasd', 'dadsadsad',
   'http://127.0.0.1:80/koolio-api/api/users/uploads/0046f77a31f51fb43110e05bf137dab7.jpg',
   'b886b52b9c39b32cfa7940d28606576a9569fd43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comments_id_uindex` (`id`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_id_uindex` (`id`),
  ADD UNIQUE KEY `posts_timestamp_uindex` (`timestamp`);

--
-- Indexes for table `reported_comments`
--
ALTER TABLE `reported_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_posts`
--
ALTER TABLE `reported_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upvoted_comments`
--
ALTER TABLE `upvoted_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upvoted_posts`
--
ALTER TABLE `upvoted_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_uindex` (`id`),
  ADD UNIQUE KEY `users_username_uindex` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 15;
--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 24;
--
-- AUTO_INCREMENT for table `reported_comments`
--
ALTER TABLE `reported_comments`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reported_posts`
--
ALTER TABLE `reported_posts`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `upvoted_comments`
--
ALTER TABLE `upvoted_comments`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 12;
--
-- AUTO_INCREMENT for table `upvoted_posts`
--
ALTER TABLE `upvoted_posts`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 39;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 30;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;