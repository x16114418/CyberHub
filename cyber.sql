-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2020 at 10:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyber`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(17, 'Try out the social engineering quiz its great!', 'andrew_kelly', 'brian_kelly', '2020-05-09 19:32:07', 'no', 58),
(18, 'Welcome! Im doing great, how are you?', 'andrew_kelly', 'brian_kelly', '2020-05-09 19:32:43', 'no', 57),
(20, 'this is a comment XSS attack attempt scriptalerthelloscript', 'brian_kelly', 'brian_kelly', '2020-05-09 21:06:30', 'no', 65),
(21, 'hi', 'brian_kelly', 'brian_kelly', '2020-05-10 18:10:05', 'no', 72),
(22, 'hi', 'brian_kelly', 'brian_kelly', '2020-05-10 18:22:38', 'no', 81),
(23, 'hi', 'brian_kelly', 'brian_kelly', '2020-05-10 18:28:18', 'no', 81),
(24, 'hi', 'brian_kelly', 'brian_kelly', '2020-05-10 18:32:11', 'no', 81),
(25, 'hi', 'brian_kelly', 'brian_kelly', '2020-05-10 18:32:28', 'no', 81),
(26, 'hi', 'emer_kelly', 'brian_kelly', '2020-05-10 18:34:45', 'no', 81),
(27, 'hi', 'emer_kelly', 'brian_kelly', '2020-05-10 18:57:42', 'no', 81),
(28, 'scriptalerthiscript', 'emer_kelly', 'brian_kelly', '2020-05-10 18:58:36', 'no', 81);

-- --------------------------------------------------------

--
-- Table structure for table `connection_requests`
--

CREATE TABLE `connection_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(25) NOT NULL,
  `user_from` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(38, 'andrew_kelly', 58),
(39, 'andrew_kelly', 57),
(40, 'andrew_kelly', 62),
(44, 'emer_kelly', 82);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` int(3) NOT NULL,
  `deleted` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(81, 'andrew_kelly', 'brian_kelly', 'hi', '2020-05-09 19:28:57', 'no', 0, 0),
(82, 'brian_kelly', 'andrew_kelly', 'Hi Brian How are you?', '2020-05-09 19:33:41', 'no', 0, 0),
(83, 'andrew_kelly', 'brian_kelly', 'Im doing good! How are you?', '2020-05-09 19:34:22', 'no', 0, 0),
(84, 'brian_kelly', 'andrew_kelly', 'Great!', '2020-05-09 19:34:52', 'no', 0, 0),
(86, 'andrew_kelly', 'brian_kelly', 'scriptalerthelloscript check out this cool script COPY AND PASTE TO YOUR CONNECTIONS', '2020-05-09 21:13:52', 'no', 0, 0),
(87, 'andrew_kelly', 'brian_kelly', 'hi', '2020-05-10 17:00:25', 'no', 0, 0),
(88, 'andrew_kelly', 'brian_kelly', 'XSS scripts dont work here ', '2020-05-10 17:00:55', 'no', 0, 0),
(89, 'andrew_kelly', 'brian_kelly', 'hi', '2020-05-10 17:07:17', 'no', 0, 0),
(90, 'andrew_kelly', 'brian_kelly', 'hi', '2020-05-10 17:07:24', 'no', 0, 0),
(91, 'andrew_kelly', 'brian_kelly', 'hi', '2020-05-10 17:07:44', 'no', 0, 0),
(92, 'andrew_kelly', 'brian_kelly', 'hi', '2020-05-10 17:07:50', 'no', 0, 0),
(93, 'andrew_kelly', 'brian_kelly', 'hi', '2020-05-10 17:09:20', 'no', 0, 0),
(94, 'andrew_kelly', 'brian_kelly', 'respond', '2020-05-10 17:09:30', 'no', 0, 0),
(95, 'emer_kelly', 'brian_kelly', 'hi', '2020-05-10 17:09:40', 'no', 0, 0),
(96, 'andrew_kelly', 'brian_kelly', 'Hi', '2020-05-10 17:14:16', 'no', 0, 0),
(97, 'emer_kelly', 'brian_kelly', 'hi', '2020-05-10 17:16:13', 'no', 0, 0),
(98, 'brian_kelly', 'emer_kelly', 'hi', '2020-05-10 17:16:34', 'no', 0, 0),
(99, 'brian_kelly', 'emer_kelly', 'hi', '2020-05-10 19:20:23', 'no', 0, 0),
(100, 'emer_kelly', 'brian_kelly', 'hi', '2020-05-10 19:20:44', 'no', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`) VALUES
(57, 'This is my first post on CyberHub! how is everyone?', 'brian_kelly', 'none', '2020-05-09 19:29:34', 'no', 'yes', 1),
(58, 'I dont know what course to take but i have an interest in cyber security. What course would you guys recommend for a first timer?', 'brian_kelly', 'none', '2020-05-09 19:30:25', 'no', 'yes', 1),
(59, 'Hey Guys!', 'andrew_kelly', 'none', '2020-05-09 19:37:06', 'no', 'yes', 0),
(60, 'Wow this site is great!', 'andrew_kelly', 'none', '2020-05-09 19:37:19', 'no', 'no', 0),
(61, 'Thanks for your connection! Welcome to my network!', 'andrew_kelly', 'brian_kelly', '2020-05-09 19:37:54', 'no', 'no', 0),
(62, 'How is everyone?', 'andrew_kelly', 'none', '2020-05-09 19:42:29', 'no', 'no', 1),
(63, 'I just did the social engineering Quiz!', 'andrew_kelly', 'none', '2020-05-09 19:42:46', 'no', 'no', 0),
(64, 'I got an email with my result and certification of completion!', 'andrew_kelly', 'none', '2020-05-09 19:43:16', 'no', 'no', 0),
(65, 'alerthello This is an XSS attack attempt', 'brian_kelly', 'none', '2020-05-09 21:02:12', 'no', 'no', 0),
(66, 'alerthi', 'brian_kelly', 'andrew_kelly', '2020-05-09 21:25:48', 'no', 'no', 0),
(67, 'Hi guys', 'brian_kelly', 'none', '2020-05-10 16:43:56', 'no', 'yes', 0),
(68, 'hi', 'brian_kelly', 'none', '2020-05-10 17:20:28', 'no', 'yes', 0),
(69, 'hi', 'brian_kelly', 'none', '2020-05-10 17:20:34', 'no', 'yes', 0),
(70, 'hi', 'brian_kelly', 'none', '2020-05-10 17:20:39', 'no', 'yes', 0),
(71, 'hi', 'brian_kelly', 'none', '2020-05-10 18:06:28', 'no', 'yes', 0),
(72, 'hi', 'brian_kelly', 'andrew_kelly', '2020-05-10 18:07:26', 'no', 'yes', 0),
(73, 'hi', 'brian_kelly', 'none', '2020-05-10 18:12:26', 'no', 'yes', 0),
(74, 'hi', 'brian_kelly', 'none', '2020-05-10 18:12:30', 'no', 'yes', 0),
(75, 'hi', 'brian_kelly', 'none', '2020-05-10 18:12:38', 'no', 'yes', 0),
(76, 'hi', 'brian_kelly', 'none', '2020-05-10 18:15:38', 'no', 'yes', 0),
(77, 'hi', 'brian_kelly', 'none', '2020-05-10 18:15:45', 'no', 'yes', 0),
(78, 'hi', 'brian_kelly', 'none', '2020-05-10 18:15:55', 'no', 'yes', 0),
(79, 'hi', 'brian_kelly', 'none', '2020-05-10 18:18:59', 'no', 'yes', 0),
(80, 'hi', 'brian_kelly', 'none', '2020-05-10 18:19:05', 'no', 'yes', 0),
(81, 'hi', 'brian_kelly', 'none', '2020-05-10 18:22:32', 'no', 'no', 0),
(82, 'hi', 'emer_kelly', 'none', '2020-05-10 19:10:55', 'no', 'no', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(28, 'Brian', 'Kelly', 'brian_kelly', 'Brian@gmail.com', '6cb75f652a9b52798eb6cf2201057c73', '2020-05-09', 'assets/images/profile_pics/brian_kelly7e9da1e98fad87c6325586473568c5d1n.jpeg', 19, 2, 'no', ',andrew_kelly,kevin_kelly,emer_kelly,'),
(29, 'Andrew', 'Kelly', 'andrew_kelly', 'Andrew@gmail.com', '7c6a180b36896a0a8c02787eeafb0e4c', '2020-05-09', 'assets/images/profile_pics/andrew_kelly88e1141291e1bd860b322a98f7498cb7n.jpeg', 6, 1, 'no', ',brian_kelly,'),
(30, 'Kevin', 'Kelly', 'kevin_kelly', 'Kevin@gmail.com', '7c6a180b36896a0a8c02787eeafb0e4c', '2020-05-09', 'assets/images/profile_pics/defaults/default2.png', 0, 0, 'no', ',brian_kelly,'),
(31, 'Emer', 'Kelly', 'emer_kelly', 'Emer@gmail.com', '7c6a180b36896a0a8c02787eeafb0e4c', '2020-05-09', 'assets/images/profile_pics/defaults/default.png', 1, 1, 'no', ',brian_kelly,'),
(32, 'John', 'Kelly', 'john_kelly', 'John@gmail.com', '7c6a180b36896a0a8c02787eeafb0e4c', '2020-05-09', 'assets/images/profile_pics/defaults/default2.png', 0, 0, 'no', ','),
(34, 'Peter', 'Cullen', 'peter_cullen', 'Peter@gmail.com', '7c6a180b36896a0a8c02787eeafb0e4c', '2020-05-09', 'assets/images/profile_pics/defaults/default.png', 0, 0, 'no', ','),
(35, 'Zuhu', 'Cullen', 'zuhu_cullen', 'Zuhu@gmail.com', '7c6a180b36896a0a8c02787eeafb0e4c', '2020-05-09', 'assets/images/profile_pics/defaults/default2.png', 0, 0, 'no', ','),
(36, 'Zaid', 'Cullen', 'zaid_cullen', 'Zaid@gmail.com', '7c6a180b36896a0a8c02787eeafb0e4c', '2020-05-09', 'assets/images/profile_pics/defaults/default2.png', 0, 0, 'no', ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `connection_requests`
--
ALTER TABLE `connection_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `connection_requests`
--
ALTER TABLE `connection_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
