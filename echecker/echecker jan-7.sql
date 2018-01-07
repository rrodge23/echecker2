-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2018 at 04:47 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `echecker`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_informationtbl`
--

CREATE TABLE `admin_informationtbl` (
  `idadmin` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `firstname` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_informationtbl`
--

INSERT INTO `admin_informationtbl` (`idadmin`, `id`, `firstname`) VALUES
(1, 1, 'fritz');

-- --------------------------------------------------------

--
-- Table structure for table `answertbl`
--

CREATE TABLE `answertbl` (
  `idanswer` int(11) NOT NULL,
  `answertitle` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bulletintbl`
--

CREATE TABLE `bulletintbl` (
  `id` int(11) NOT NULL,
  `message` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulletintbl`
--

INSERT INTO `bulletintbl` (`id`, `message`) VALUES
(1, '<p style=\"text-align: left;\"><em><strong>HELLO ALBA !</strong></em></p>');

-- --------------------------------------------------------

--
-- Table structure for table `classtbl`
--

CREATE TABLE `classtbl` (
  `idclass` int(11) NOT NULL,
  `class_name` varchar(225) NOT NULL,
  `class_description` varchar(225) NOT NULL,
  `room_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classtbl`
--

INSERT INTO `classtbl` (`idclass`, `class_name`, `class_description`, `room_name`) VALUES
(1, 'class 101', 'afternoon english class', '311');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjecttbl`
--

CREATE TABLE `class_subjecttbl` (
  `idclass_subject` int(11) NOT NULL,
  `idclass` int(11) NOT NULL,
  `idsubject` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coursetbl`
--

CREATE TABLE `coursetbl` (
  `idcourse` int(11) NOT NULL,
  `course_name` varchar(225) NOT NULL,
  `course_description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursetbl`
--

INSERT INTO `coursetbl` (`idcourse`, `course_name`, `course_description`) VALUES
(1, 'bsit', 'bachelor of science in information of technology'),
(2, 'aw', 'bsba');

-- --------------------------------------------------------

--
-- Table structure for table `departmenttbl`
--

CREATE TABLE `departmenttbl` (
  `iddepartment` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departmenttbl`
--

INSERT INTO `departmenttbl` (`iddepartment`, `department_name`, `description`) VALUES
(1, 'IT dept', 'AITES');

-- --------------------------------------------------------

--
-- Table structure for table `questionairetbl`
--

CREATE TABLE `questionairetbl` (
  `idquestionaire` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `questionaire_title` varchar(225) NOT NULL,
  `questionaire_description` varchar(225) NOT NULL,
  `questionaire_status` varchar(225) NOT NULL,
  `approved_user` varchar(225) NOT NULL,
  `approved_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `questionaire_score` varchar(225) NOT NULL,
  `questionaire_total_score` varchar(225) NOT NULL,
  `questionaire_duration` varchar(225) NOT NULL,
  `questionaire_remarks` varchar(225) NOT NULL,
  `questionaire_day` varchar(225) NOT NULL,
  `questionaire_time` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questionaire_typetbl`
--

CREATE TABLE `questionaire_typetbl` (
  `idquestiontype` int(11) NOT NULL,
  `questionaire_type_title` varchar(225) NOT NULL,
  `questionare_type` varchar(225) NOT NULL,
  `questionaire_type_total_score` varchar(225) NOT NULL,
  `questionaire_type_score` varchar(225) NOT NULL,
  `idquestionaire_type_questions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questiontbl`
--

CREATE TABLE `questiontbl` (
  `idquestion` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question_title` varchar(225) NOT NULL,
  `idquestion_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question_answerlisttbl`
--

CREATE TABLE `question_answerlisttbl` (
  `idquestion_answerlist` int(11) NOT NULL,
  `question_answer_id` int(11) NOT NULL,
  `question_answer_description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_informationtbl`
--

CREATE TABLE `student_informationtbl` (
  `idstudent` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `middlename` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `subjects_enrolled` int(11) NOT NULL,
  `course` varchar(225) NOT NULL,
  `year_level` int(11) NOT NULL,
  `department` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_informationtbl`
--

INSERT INTO `student_informationtbl` (`idstudent`, `id`, `firstname`, `middlename`, `lastname`, `subjects_enrolled`, `course`, `year_level`, `department`) VALUES
(23, 30, 'sdf', 'sdf', 'sdf', 0, '', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `subjecttbl`
--

CREATE TABLE `subjecttbl` (
  `idsubject` int(11) NOT NULL,
  `subject_code` varchar(225) NOT NULL,
  `subject_description` varchar(225) NOT NULL,
  `schedule` int(11) NOT NULL,
  `units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjecttbl`
--

INSERT INTO `subjecttbl` (`idsubject`, `subject_code`, `subject_description`, `schedule`, `units`) VALUES
(4, '23', 'ASdf', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subject_scheduletbl`
--

CREATE TABLE `subject_scheduletbl` (
  `idschedule` int(11) NOT NULL,
  `schedule_code` varchar(225) NOT NULL,
  `day` text NOT NULL,
  `time_start` varchar(225) NOT NULL,
  `time_end` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_scheduletbl`
--

INSERT INTO `subject_scheduletbl` (`idschedule`, `schedule_code`, `day`, `time_start`, `time_end`, `status`) VALUES
(3, 'IT 343 - afternoon', 'Monday,Tuesday,Wednesday', '17:10', '20:10', 'unavailable'),
(4, 'monday it122', 'Monday,Wednesday,Friday', '17:46', '19:46', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_informationtbl`
--

CREATE TABLE `teacher_informationtbl` (
  `idteacher` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `middlename` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `subjects_handled` int(11) NOT NULL,
  `position` varchar(225) NOT NULL,
  `email` varchar(225) DEFAULT NULL,
  `contact_no` varchar(225) DEFAULT NULL,
  `department` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_informationtbl`
--

INSERT INTO `teacher_informationtbl` (`idteacher`, `id`, `firstname`, `middlename`, `lastname`, `subjects_handled`, `position`, `email`, `contact_no`, `department`) VALUES
(1, 6, 'ff', 'dd', 'gg', 0, 'it prog head', NULL, NULL, ''),
(2, 29, 'dfg', 'dfg', 'dfg', 0, 'dfg', NULL, NULL, ''),
(3, 32, 'sdf', 'df', 'sdf', 0, 'sdfs', NULL, NULL, ''),
(4, 33, 'rodgie', 'edig', 'barnuevo', 0, 'program head', NULL, NULL, ''),
(5, 34, 'fritz', 'fritz', 'fritz', 0, 'fritz', NULL, NULL, ''),
(6, 35, 'test', 'test', 'test', 0, 'test', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `code` varchar(225) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `user_level` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `code`, `user`, `pass`, `user_level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'asdf', 'asdf', 99, 'active', '2018-01-05 08:15:57', '0000-00-00 00:00:00'),
(6, '1122', 'aaaa', '1122', 2, 'inactive', '2018-01-05 08:50:05', '0000-00-00 00:00:00'),
(29, '1122', 'asdff', '1122', 2, 'inactive', '2018-01-05 09:49:39', '0000-00-00 00:00:00'),
(30, '44', 'sdfs', '44', 1, 'inactive', '2018-01-05 10:03:31', '0000-00-00 00:00:00'),
(32, '515', 'wdfsdf', '515', 2, 'inactive', '2018-01-05 10:05:20', '0000-00-00 00:00:00'),
(33, 'test-teacher', 'fritz', 'test-teacher', 2, 'inactive', '2018-01-06 05:03:14', '0000-00-00 00:00:00'),
(34, '111', 'fritz', '111', 2, 'inactive', '2018-01-06 05:06:40', '0000-00-00 00:00:00'),
(35, '111111', 'test', 'asdf', 2, 'active', '2018-01-06 05:55:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_classtbl`
--

CREATE TABLE `user_classtbl` (
  `iduser_class` int(11) NOT NULL,
  `idclass` int(11) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_coursetbl`
--

CREATE TABLE `user_coursetbl` (
  `usercourse_id` int(11) NOT NULL,
  `iduser_course` int(11) NOT NULL,
  `idcourse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_coursetbl`
--

INSERT INTO `user_coursetbl` (`usercourse_id`, `iduser_course`, `idcourse`) VALUES
(23, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_departmenttbl`
--

CREATE TABLE `user_departmenttbl` (
  `iduser_department` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `iddepartment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_departmenttbl`
--

INSERT INTO `user_departmenttbl` (`iduser_department`, `UID`, `iddepartment`) VALUES
(1, 6, 1),
(24, 29, 1),
(25, 30, 1),
(27, 32, 1),
(28, 33, 1),
(29, 34, 1),
(30, 35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_leveltbl`
--

CREATE TABLE `user_leveltbl` (
  `iduser_level` int(11) NOT NULL,
  `user_level` int(11) NOT NULL,
  `userlevel_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_leveltbl`
--

INSERT INTO `user_leveltbl` (`iduser_level`, `user_level`, `userlevel_name`) VALUES
(1, 99, 'admin'),
(2, 1, 'student'),
(3, 2, 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `user_subjecttbl`
--

CREATE TABLE `user_subjecttbl` (
  `iduser_subject` int(11) NOT NULL,
  `idsubject` int(11) NOT NULL,
  `UID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_informationtbl`
--
ALTER TABLE `admin_informationtbl`
  ADD PRIMARY KEY (`idadmin`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `answertbl`
--
ALTER TABLE `answertbl`
  ADD PRIMARY KEY (`idanswer`);

--
-- Indexes for table `bulletintbl`
--
ALTER TABLE `bulletintbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classtbl`
--
ALTER TABLE `classtbl`
  ADD PRIMARY KEY (`idclass`);

--
-- Indexes for table `class_subjecttbl`
--
ALTER TABLE `class_subjecttbl`
  ADD PRIMARY KEY (`idclass_subject`),
  ADD KEY `idsubject` (`idsubject`),
  ADD KEY `idclass` (`idclass`);

--
-- Indexes for table `coursetbl`
--
ALTER TABLE `coursetbl`
  ADD PRIMARY KEY (`idcourse`);

--
-- Indexes for table `departmenttbl`
--
ALTER TABLE `departmenttbl`
  ADD PRIMARY KEY (`iddepartment`);

--
-- Indexes for table `questionairetbl`
--
ALTER TABLE `questionairetbl`
  ADD PRIMARY KEY (`idquestionaire`);

--
-- Indexes for table `questionaire_typetbl`
--
ALTER TABLE `questionaire_typetbl`
  ADD PRIMARY KEY (`idquestiontype`);

--
-- Indexes for table `questiontbl`
--
ALTER TABLE `questiontbl`
  ADD PRIMARY KEY (`idquestion`);

--
-- Indexes for table `question_answerlisttbl`
--
ALTER TABLE `question_answerlisttbl`
  ADD PRIMARY KEY (`idquestion_answerlist`);

--
-- Indexes for table `student_informationtbl`
--
ALTER TABLE `student_informationtbl`
  ADD PRIMARY KEY (`idstudent`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `subjecttbl`
--
ALTER TABLE `subjecttbl`
  ADD PRIMARY KEY (`idsubject`),
  ADD UNIQUE KEY `schedule` (`schedule`);

--
-- Indexes for table `subject_scheduletbl`
--
ALTER TABLE `subject_scheduletbl`
  ADD PRIMARY KEY (`idschedule`);

--
-- Indexes for table `teacher_informationtbl`
--
ALTER TABLE `teacher_informationtbl`
  ADD PRIMARY KEY (`idteacher`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_classtbl`
--
ALTER TABLE `user_classtbl`
  ADD PRIMARY KEY (`iduser_class`),
  ADD UNIQUE KEY `idclass` (`idclass`),
  ADD UNIQUE KEY `iduser` (`iduser`);

--
-- Indexes for table `user_coursetbl`
--
ALTER TABLE `user_coursetbl`
  ADD PRIMARY KEY (`usercourse_id`),
  ADD UNIQUE KEY `iduser_course` (`iduser_course`),
  ADD KEY `idcourse` (`idcourse`);

--
-- Indexes for table `user_departmenttbl`
--
ALTER TABLE `user_departmenttbl`
  ADD PRIMARY KEY (`iduser_department`),
  ADD KEY `iddepartment` (`iddepartment`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `user_leveltbl`
--
ALTER TABLE `user_leveltbl`
  ADD PRIMARY KEY (`iduser_level`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_subjecttbl`
--
ALTER TABLE `user_subjecttbl`
  ADD PRIMARY KEY (`iduser_subject`),
  ADD KEY `idsubject` (`idsubject`),
  ADD KEY `UID` (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_informationtbl`
--
ALTER TABLE `admin_informationtbl`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answertbl`
--
ALTER TABLE `answertbl`
  MODIFY `idanswer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bulletintbl`
--
ALTER TABLE `bulletintbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classtbl`
--
ALTER TABLE `classtbl`
  MODIFY `idclass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_subjecttbl`
--
ALTER TABLE `class_subjecttbl`
  MODIFY `idclass_subject` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coursetbl`
--
ALTER TABLE `coursetbl`
  MODIFY `idcourse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departmenttbl`
--
ALTER TABLE `departmenttbl`
  MODIFY `iddepartment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questionairetbl`
--
ALTER TABLE `questionairetbl`
  MODIFY `idquestionaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionaire_typetbl`
--
ALTER TABLE `questionaire_typetbl`
  MODIFY `idquestiontype` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questiontbl`
--
ALTER TABLE `questiontbl`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_answerlisttbl`
--
ALTER TABLE `question_answerlisttbl`
  MODIFY `idquestion_answerlist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_informationtbl`
--
ALTER TABLE `student_informationtbl`
  MODIFY `idstudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subjecttbl`
--
ALTER TABLE `subjecttbl`
  MODIFY `idsubject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_scheduletbl`
--
ALTER TABLE `subject_scheduletbl`
  MODIFY `idschedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_informationtbl`
--
ALTER TABLE `teacher_informationtbl`
  MODIFY `idteacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_classtbl`
--
ALTER TABLE `user_classtbl`
  MODIFY `iduser_class` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_coursetbl`
--
ALTER TABLE `user_coursetbl`
  MODIFY `usercourse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_departmenttbl`
--
ALTER TABLE `user_departmenttbl`
  MODIFY `iduser_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_leveltbl`
--
ALTER TABLE `user_leveltbl`
  MODIFY `iduser_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_subjecttbl`
--
ALTER TABLE `user_subjecttbl`
  MODIFY `iduser_subject` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_informationtbl`
--
ALTER TABLE `admin_informationtbl`
  ADD CONSTRAINT `admin_informationtbl_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`idusers`);

--
-- Constraints for table `class_subjecttbl`
--
ALTER TABLE `class_subjecttbl`
  ADD CONSTRAINT `class_subjecttbl_ibfk_1` FOREIGN KEY (`idsubject`) REFERENCES `subjecttbl` (`idsubject`),
  ADD CONSTRAINT `class_subjecttbl_ibfk_2` FOREIGN KEY (`idclass`) REFERENCES `classtbl` (`idclass`);

--
-- Constraints for table `student_informationtbl`
--
ALTER TABLE `student_informationtbl`
  ADD CONSTRAINT `student_informationtbl_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`idusers`);

--
-- Constraints for table `subjecttbl`
--
ALTER TABLE `subjecttbl`
  ADD CONSTRAINT `subjecttbl_ibfk_1` FOREIGN KEY (`schedule`) REFERENCES `subject_scheduletbl` (`idschedule`);

--
-- Constraints for table `teacher_informationtbl`
--
ALTER TABLE `teacher_informationtbl`
  ADD CONSTRAINT `teacher_informationtbl_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`idusers`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`user_level`) REFERENCES `user_leveltbl` (`user_level`);

--
-- Constraints for table `user_classtbl`
--
ALTER TABLE `user_classtbl`
  ADD CONSTRAINT `user_classtbl_ibfk_2` FOREIGN KEY (`idclass`) REFERENCES `classtbl` (`idclass`),
  ADD CONSTRAINT `user_classtbl_ibfk_3` FOREIGN KEY (`iduser`) REFERENCES `users` (`idusers`);

--
-- Constraints for table `user_coursetbl`
--
ALTER TABLE `user_coursetbl`
  ADD CONSTRAINT `user_coursetbl_ibfk_2` FOREIGN KEY (`idcourse`) REFERENCES `coursetbl` (`idcourse`),
  ADD CONSTRAINT `user_coursetbl_ibfk_3` FOREIGN KEY (`iduser_course`) REFERENCES `users` (`idusers`);

--
-- Constraints for table `user_departmenttbl`
--
ALTER TABLE `user_departmenttbl`
  ADD CONSTRAINT `user_departmenttbl_ibfk_2` FOREIGN KEY (`iddepartment`) REFERENCES `departmenttbl` (`iddepartment`),
  ADD CONSTRAINT `user_departmenttbl_ibfk_3` FOREIGN KEY (`UID`) REFERENCES `users` (`idusers`);

--
-- Constraints for table `user_subjecttbl`
--
ALTER TABLE `user_subjecttbl`
  ADD CONSTRAINT `user_subjecttbl_ibfk_2` FOREIGN KEY (`idsubject`) REFERENCES `subjecttbl` (`idsubject`),
  ADD CONSTRAINT `user_subjecttbl_ibfk_3` FOREIGN KEY (`UID`) REFERENCES `users` (`idusers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
