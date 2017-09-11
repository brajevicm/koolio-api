-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2017 at 02:43 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `flag_id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `flag_id`, `text`, `timestamp`) VALUES
(1, 1, 1, 1, 'test', '2017-05-31 23:55:14'),
(2, 1, 1, 1, 'tes', '2017-06-01 13:07:10'),
(3, 1, 2, 2, ' mm', '2017-06-04 15:13:36'),
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
(14, 1, 2, 1, 'sdadadsad', '2017-06-11 13:40:16'),
(15, 30, 26, 1, 'bla bla bla', '2017-06-12 11:03:59'),
(16, 1, 25, 1, 'kasmdkamdkamd', '2017-06-12 13:54:04'),
(17, 1, 9, 1, 'This is cool!', '2017-06-13 12:54:37'),
(18, 35, 9, 1, 'Looks freeeezing, jeez.', '2017-06-13 12:57:26'),
(19, 36, 9, 1, 'What a wonderful view for my eyes!', '2017-06-13 12:59:04'),
(20, 1, 16, 1, 'koliko je lepa!\n', '2017-06-25 21:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flag_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `flag_id`, `title`, `image`, `timestamp`) VALUES
(1, 1, 1, 'Horseshoe Bend Sunset', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/d67a9494f0f5cad3928f122806e085b7.jpg', '2017-06-13 12:21:00'),
(2, 1, 1, 'Jonas Nilsson Lee', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/ace856ca61f3d70fbfdfc2332b14e230.jpg', '2017-06-13 12:21:35'),
(3, 1, 1, 'Lake Tahoe Colors', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/89f4ba15211462f9f678f1dbedf54ef0.jpg', '2017-06-13 12:21:50'),
(4, 1, 1, 'Leaves', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/c7c053c9e55c97a338734dad0f2d6688.jpg', '2017-06-13 12:22:02'),
(5, 1, 1, 'Living Stones', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/b2b768b078d2cd1738b8ff1240c3f790.jpg', '2017-06-13 12:22:17'),
(6, 1, 1, 'Mr. Lee', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/5b8b43b7205def97648f1cd3885633bf.jpg', '2017-06-13 12:22:52'),
(7, 1, 1, 'Pablo Garcia Saldana', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/e0e1915cde04dd8d1c02211e823b9ae3.jpg', '2017-06-13 12:23:07'),
(8, 1, 1, 'Photo by SpaceX', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/9a6fc9e097047175db330a7b1058194e.jpg', '2017-06-13 12:23:20'),
(9, 1, 1, 'Ryan Schroeder', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/89df515b0afadcc7d8da3bccfc2a7940.jpg', '2017-06-13 12:24:30'),
(10, 1, 1, 'The Coast', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/bf15eb91bc57b86104397570dc2bbe22.jpg', '2017-06-13 12:24:46'),
(11, 1, 1, 'Tunnel', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/e8a7c77412b29eb2c3da01bf9372d08c.jpg', '2017-06-13 12:25:02'),
(12, 1, 1, 'Urban Dream', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/0d16267919834f1e7ba3c0b1e1835349.jpg', '2017-06-13 12:25:16'),
(13, 1, 1, 'Water Lily', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/8f7fb33802be93dbfd6aedbbe41c7faa.jpg', '2017-06-13 12:25:33'),
(14, 1, 1, 'Wild Night', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/4aed678af7fa40ce6b563d88b6ba3382.jpg', '2017-06-13 12:25:46'),
(15, 35, 1, 'That feeling when you are finished', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/8d2653967db39482a868735e8aba412a.gif', '2017-06-13 17:30:24'),
(16, 1, 1, 'Moja ljubav', 'http://127.0.0.1:80/koolio-api/api/posts/uploads/04d68190b12687a2ae916f685e306715.jpg', '2017-06-25 21:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `reported_comments`
--

CREATE TABLE `reported_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reported_comments`
--

INSERT INTO `reported_comments` (`id`, `user_id`, `comment_id`, `timestamp`) VALUES
(1, 1, 14, '2017-06-11 14:28:52'),
(2, 1, 13, '2017-06-11 15:25:13'),
(3, 1, 8, '2017-06-11 15:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `reported_posts`
--

CREATE TABLE `reported_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reported_posts`
--

INSERT INTO `reported_posts` (`id`, `user_id`, `post_id`, `timestamp`) VALUES
(1, 1, 1, '2017-06-10 14:43:39'),
(2, 8, 1, '2017-06-10 14:44:50'),
(3, 1, 2, '2017-06-10 19:49:34'),
(4, 1, 2, '2017-06-10 19:54:16'),
(5, 1, 23, '2017-06-11 14:16:02'),
(6, 30, 26, '2017-06-12 13:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(11, 25, 4, '2017-06-10 23:33:03'),
(12, 1, 14, '2017-06-11 14:21:42'),
(13, 1, 16, '2017-06-13 11:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `upvoted_posts`
--

CREATE TABLE `upvoted_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `upvoted_posts`
--

INSERT INTO `upvoted_posts` (`id`, `user_id`, `post_id`, `timestamp`) VALUES
(1, 2, 1, '2017-06-04 21:56:36'),
(2, 1, 2, '2017-06-06 01:13:00'),
(35, 1, 1, '2017-06-09 14:09:57'),
(36, 1, 8, '2017-06-09 22:22:09'),
(37, 1, 3, '2017-06-09 23:04:28'),
(38, 25, 9, '2017-06-10 18:23:20'),
(39, 30, 26, '2017-06-12 11:04:02'),
(40, 1, 25, '2017-06-12 13:53:58'),
(41, 1, 14, '2017-06-13 12:52:11'),
(42, 35, 15, '2017-06-13 17:40:49'),
(43, 1, 16, '2017-06-25 21:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `flag_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `token` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `flag_id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `image`, `token`) VALUES
(1, 1, 2, 'miloss', '0192023a7bbd73250516f069df18b500', 'Milos', 'Brajevic', 'https://scontent.fbeg1-1.fna.fbcdn.net/v/t1.0-9/11217964_10205117518199540_2565989827669045482_n.jpg?oh=ea6f71b2fda11fe140defba615ab06ac&oe=59AD9D24', 'd71e52b2a5d80689033cbce3b403213cb2ab3a03'),
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
(23, 1, 1, 'xxas', '152f7c279613e7e707a3f3f4cb7a6d92', 'dasd', 'dasd', 'da', '2ba3231cbaea77eec386d44d107b588854907144'),
(24, 1, 1, 'milossaszxa', '0192023a7bbd73250516f069df18b500', 'sadad', 'dasda', 'asda', 'e6a190ec794d3976a735d0e079ab5c08e176b2c0'),
(25, 1, 2, 'milos', 'b82753180960205a4a62feff9c0f93f5', 'milos', 'milos', 'milos.jpg', '39de19fd7d49fe0949ed27f3e26687273b8d312f'),
(26, 1, 1, 'milossazza', '0192023a7bbd73250516f069df18b500', 'dsa', 'sadasd', 'http://127.0.0.1:80/koolio-api/api/users/uploads/75d36ad408a25afc7ac3203fd72cc6ce.jpg', 'f942a98dc9cbabca5f974e5d8a2f95ccfaf8d5b4'),
(27, 1, 1, '13125152124', '0192023a7bbd73250516f069df18b500', 'adsad', 'ddsad', 'http://127.0.0.1:80/koolio-api/api/users/uploads/25f075d66d4d530ff794e6806143fbd4.jpg', '2e0918407a319ae6a8b5f8308adbb24f644c6701'),
(28, 1, 1, 'addasdsad', '0192023a7bbd73250516f069df18b500', 'asdsadas', 'dadasda', 'http://127.0.0.1:80/koolio-api/api/users/uploads/d318e6fb46aa0e0fa3c1216dbdadcac4.jpg', '56150c20e6091f02a073087a44ae995f7adcc2a0'),
(29, 1, 1, 'dadasdsadasd1', 'e38ca2ae054c6f66e723c285890cb96b', 'asdasdasd', 'dadsadsad', 'http://127.0.0.1:80/koolio-api/api/users/uploads/0046f77a31f51fb43110e05bf137dab7.jpg', 'b886b52b9c39b32cfa7940d28606576a9569fd43'),
(30, 1, 1, 'goMet', 'abc2e2f32e486fc2e1072003cc88149a', 'srdjan', 'stevanovic', 'http://127.0.0.1:80/koolio-api/api/users/uploads/cb1a24fe95829576a3941fb3ba4520aa.jpg', '9ef56224c700218776c7c9258099e2bcf92e83c7'),
(31, 1, 1, 'adasdad', '52e92dbf5ca9d98e25a000437f6081dd', 'DFQJFJ', 'amdakmfkamfk', 'http://127.0.0.1:80/koolio-api/api/users/uploads/528906fda2904c0d4732bac0992da0b3.jpg', '63cc6847a17a2ec5b907e337313f62d2c3c89b97'),
(32, 1, 1, 'milosss', '0192023a7bbd73250516f069df18b500', 'dasdasdladl', ',ld,asld,l', 'http://127.0.0.1:80/koolio-api/api/users/uploads/c3cc88fc8b7123f379ca3990a97abf60.jpg', 'ed179c1277a4c3eeaeb01b02bddf39046b2b622a'),
(33, 1, 1, 'milossaaaaaaaaaaa', '0192023a7bbd73250516f069df18b500', ',adoakdo', 'kdokasokdsoadko', 'http://127.0.0.1:80/koolio-api/api/users/uploads/18032c39825d9f773a907b12b6844e2a.jpg', '1b5dbc074e2554bc9fdbfb6ac905dc943431a509'),
(34, 1, 1, 'kodksodkaodk', '8b2c289a745253a028efab6d06f83cef', 'doakd', 'dokasdoaksdo', 'http://127.0.0.1:80/koolio-api/api/users/uploads/5b5b01e29c1860a0085b0849d05cd693.jpg', '1da617465cd4a867e01144844329d6b8255a3061'),
(35, 1, 1, 'ncage', '0192023a7bbd73250516f069df18b500', 'Nicholas', 'Cage', 'http://127.0.0.1:80/koolio-api/api/users/uploads/52c5bc4bcb28c440493591b4970e6cc6.jpg', 'c35cb470bc461613a57e8e14471cf57cea04997d'),
(36, 1, 1, 'jadams13', '0192023a7bbd73250516f069df18b500', 'John', 'Adams', 'http://127.0.0.1:80/koolio-api/api/users/uploads/5e0505f8321a607e61ffbfb19c9dd443.jpg', '438264694390664f2b61560b1f35a746194138a9');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `reported_comments`
--
ALTER TABLE `reported_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reported_posts`
--
ALTER TABLE `reported_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `upvoted_comments`
--
ALTER TABLE `upvoted_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `upvoted_posts`
--
ALTER TABLE `upvoted_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
