CREATE TABLE comments
(
  id      INT AUTO_INCREMENT
    PRIMARY KEY,
  user_id INT          NOT NULL,
  post_id INT          NOT NULL,
  text    VARCHAR(255) NOT NULL,
  upvotes INT -- phpMyAdmin SQL Dump
    -- version 4.5.4.1deb2ubuntu2
    -- http://www.phpmyadmin.net
    --
    -- Host: localhost
    -- Generation Time: Jun 02, 2017 at 01:13 PM
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
  `upvotes`   INT(11)          NOT NULL,
  `timestamp` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `flag_id`, `text`, `upvotes`, `timestamp`) VALUES
  (1, 1, 1, 0, 'test', 1, '2017-05-31 23:55:14'),
  (2, 1, 1, 0, 'tes', 0, '2017-06-01 13:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id`        INT(11)          NOT NULL,
  `flag_name` VARCHAR(255)
              COLLATE utf8_bin NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

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
  `timestamp` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upvotes`   INT(11)          NOT NULL,
  `comments`  INT(11)          NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `flag_id`, `title`, `image`, `timestamp`, `upvotes`, `comments`) VALUES
  (1, 1, 0, 'test', 'image', '2017-06-01 10:19:57', 1, 0),
  (2, 1, 0, 'tes', 'tead', '2017-06-01 12:59:03', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id`        INT(11)          NOT NULL,
  `role_name` VARCHAR(15)
              COLLATE utf8_bin NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

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
  `token`     VARCHAR(255)
              COLLATE utf8_bin DEFAULT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `flag_id`, `role_id`, `username`, `password`, `firstname`, `lastname`, `token`) VALUES
  (1, 0, 0, 'admin', '0192023a7bbd73250516f069df18b500', 'Milos', 'Brajevic',
   'a1ffee45887035e514654c666531411d95619bc9');

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
NOT NULL,
TIMESTAMP TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
CONSTRAINT comments_id_uindex
UNIQUE (id)
);

CREATE TABLE posts
(
  id        INT AUTO_INCREMENT
    PRIMARY KEY,
  user_id   INT                                 NOT NULL,
  title     VARCHAR(255)                        NOT NULL,
  image     VARCHAR(255)                        NOT NULL,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  upvotes   INT                                 NOT NULL,
  comments  INT                                 NOT NULL,
  CONSTRAINT posts_id_uindex
  UNIQUE (id),
  CONSTRAINT posts_timestamp_uindex
  UNIQUE (timestamp)
);

CREATE TABLE users
(
  id        INT AUTO_INCREMENT
    PRIMARY KEY,
  username  VARCHAR(255) NOT NULL,
  password  VARCHAR(255) NOT NULL,
  firstname VARCHAR(255) NOT NULL,
  lastname  VARCHAR(255) NOT NULL,
  token     VARCHAR(255) NULL,
  CONSTRAINT users_id_uindex
  UNIQUE (id),
  CONSTRAINT users_username_uindex
  UNIQUE (username)
);

