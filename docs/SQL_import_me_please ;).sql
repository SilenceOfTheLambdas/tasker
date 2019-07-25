-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2019 at 08:32 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasker`
--
CREATE DATABASE IF NOT EXISTS `tasker` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tasker`;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projectID` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectID`, `project_name`, `user_id`) VALUES
(2, 'Website Development', 17),
(3, 'A test project', 17),
(4, 'testuser01Project', 18);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `projectID` int(11) DEFAULT NULL,
  `task_id` int(11) NOT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_date` date NOT NULL,
  `task_time` time DEFAULT NULL,
  `task_state` enum('To Do','In Progress','Completed') NOT NULL,
  `task_priority` enum('High','Medium','Low') NOT NULL,
  `task_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`projectID`, `task_id`, `task_title`, `task_date`, `task_time`, `task_state`, `task_priority`, `task_desc`) VALUES
(2, 32, 'Implement task editing', '2019-02-20', '00:00:00', 'To Do', 'High', 'Allow tasks to be edited using the new HTML modal box.'),
(2, 33, 'Memes', '2019-02-25', '00:00:00', 'To Do', 'High', 'Yeah!!!!!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(240) NOT NULL,
  `email` varchar(240) NOT NULL,
  `password` varchar(240) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_project` int(11) DEFAULT NULL,
  `hash` varchar(240) NOT NULL,
  `verfied` bool DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `date`, `last_project`,`hash`, `verfied`) VALUES
(17, 'Callum', 'cs18804@essex.ac.uk', '$2y$10$NI5rN.da8kno2YbYqZpXL.Kbyg/TMPVhBprUJXqkN.iQQ5LrZFJPO', '2019-02-11 07:52:58', 2, 'b1f4f9a523e36fd969f4573e25af4540', TRUE),
(18, 'testuser01', 'testuser01@test.com', '$2y$10$nsYdD4l9uoAaYU46FeM53OlvCnpmdzhtLr7q/ab3pAbgXMDdz/AiO', '2019-02-16 19:14:34', 4, 'aa7bf8cef376706b06c3a2c997ebe836', TRUE);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projectID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `projectID` (`projectID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`projectID`) REFERENCES `projects` (`projectID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
