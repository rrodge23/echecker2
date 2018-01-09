-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2018 at 04:46 PM
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
(1, '<p>Good <strong>Niggas</strong> :)</p>');

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
(3, 'BSIT', 'BS Information Tech'),
(5, 'BSSW', 'BS Social Work');

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
(2, 'CITE DEPT', 'Information Technology Com Sci'),
(3, 'SW DEPT', 'Social Work Dept');

-- --------------------------------------------------------

--
-- Table structure for table `questionairetbl`
--

CREATE TABLE `questionairetbl` (
  `idquestionaire` int(11) NOT NULL,
  `idclass` int(11) NOT NULL,
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
  `questionaire_time` varchar(225) NOT NULL,
  `questionaire_type_id` int(11) NOT NULL
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
  `question_points` varchar(225) NOT NULL,
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
(38, 69, 'test-student', 'test-student', 'test-student', 0, '', 2, ''),
(39, 70, 'test2', 'test2', 'test2', 0, '', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `subjecttbl`
--

CREATE TABLE `subjecttbl` (
  `idsubject` int(11) NOT NULL,
  `subject_code` varchar(225) NOT NULL,
  `subject_description` varchar(225) NOT NULL,
  `schedule` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjecttbl`
--

INSERT INTO `subjecttbl` (`idsubject`, `subject_code`, `subject_description`, `schedule`, `units`, `status`) VALUES
(10, 'IT -222', 'Capstone Project', 11, 3, ''),
(11, 'IT -121', 'WEB DEV', 13, 2, '');

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
(11, 'MWF MORNING', 'Monday,Thursday,Saturday', '11:21', '12:21', 'unavailable'),
(13, 'WEEKEND CLS AFTERNOON', 'Saturday,Sunday', '14:22', '17:22', 'unavailable');

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
(25, 65, 'test-firstname', 'test-middlename', 'test-lastname', 0, 'test-position', NULL, NULL, '');

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
(65, 'test', 'test', 'test', 2, 'inactive', '2018-01-09 15:35:17', '0000-00-00 00:00:00'),
(69, 'test1', 'test1', 'test1', 1, 'inactive', '2018-01-09 15:36:58', '0000-00-00 00:00:00'),
(70, 'test2', 'test2', 'test2', 1, 'inactive', '2018-01-09 15:38:25', '0000-00-00 00:00:00');

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
(35, 69, 3),
(36, 70, 3);

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
(58, 65, 3),
(59, 69, 2),
(60, 70, 2);

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
-- Dumping data for table `user_subjecttbl`
--

INSERT INTO `user_subjecttbl` (`iduser_subject`, `idsubject`, `UID`) VALUES
(14, 11, 65),
(18, 10, 69),
(19, 11, 69),
(20, 11, 70);

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
  ADD PRIMARY KEY (`idquestionaire`),
  ADD KEY `idclass` (`idclass`),
  ADD KEY `questionaire_type_id` (`questionaire_type_id`);

--
-- Indexes for table `questionaire_typetbl`
--
ALTER TABLE `questionaire_typetbl`
  ADD PRIMARY KEY (`idquestiontype`),
  ADD KEY `idquestionaire_type_questions` (`idquestionaire_type_questions`);

--
-- Indexes for table `questiontbl`
--
ALTER TABLE `questiontbl`
  ADD PRIMARY KEY (`idquestion`),
  ADD KEY `idquestion_answer` (`idquestion_answer`);

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
  MODIFY `idanswer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bulletintbl`
--
ALTER TABLE `bulletintbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classtbl`
--
ALTER TABLE `classtbl`
  MODIFY `idclass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_subjecttbl`
--
ALTER TABLE `class_subjecttbl`
  MODIFY `idclass_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coursetbl`
--
ALTER TABLE `coursetbl`
  MODIFY `idcourse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departmenttbl`
--
ALTER TABLE `departmenttbl`
  MODIFY `iddepartment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questionairetbl`
--
ALTER TABLE `questionairetbl`
  MODIFY `idquestionaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionaire_typetbl`
--
ALTER TABLE `questionaire_typetbl`
  MODIFY `idquestiontype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questiontbl`
--
ALTER TABLE `questiontbl`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `question_answerlisttbl`
--
ALTER TABLE `question_answerlisttbl`
  MODIFY `idquestion_answerlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_informationtbl`
--
ALTER TABLE `student_informationtbl`
  MODIFY `idstudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `subjecttbl`
--
ALTER TABLE `subjecttbl`
  MODIFY `idsubject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subject_scheduletbl`
--
ALTER TABLE `subject_scheduletbl`
  MODIFY `idschedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teacher_informationtbl`
--
ALTER TABLE `teacher_informationtbl`
  MODIFY `idteacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `user_classtbl`
--
ALTER TABLE `user_classtbl`
  MODIFY `iduser_class` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_coursetbl`
--
ALTER TABLE `user_coursetbl`
  MODIFY `usercourse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_departmenttbl`
--
ALTER TABLE `user_departmenttbl`
  MODIFY `iduser_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_leveltbl`
--
ALTER TABLE `user_leveltbl`
  MODIFY `iduser_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_subjecttbl`
--
ALTER TABLE `user_subjecttbl`
  MODIFY `iduser_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- Constraints for table `questionairetbl`
--
ALTER TABLE `questionairetbl`
  ADD CONSTRAINT `questionairetbl_ibfk_1` FOREIGN KEY (`idclass`) REFERENCES `classtbl` (`idclass`),
  ADD CONSTRAINT `questionairetbl_ibfk_2` FOREIGN KEY (`questionaire_type_id`) REFERENCES `questionaire_typetbl` (`idquestiontype`);

--
-- Constraints for table `questionaire_typetbl`
--
ALTER TABLE `questionaire_typetbl`
  ADD CONSTRAINT `questionaire_typetbl_ibfk_1` FOREIGN KEY (`idquestionaire_type_questions`) REFERENCES `questiontbl` (`idquestion`);

--
-- Constraints for table `questiontbl`
--
ALTER TABLE `questiontbl`
  ADD CONSTRAINT `questiontbl_ibfk_1` FOREIGN KEY (`idquestion_answer`) REFERENCES `question_answerlisttbl` (`idquestion_answerlist`);

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
  ADD CONSTRAINT `user_classtbl_ibfk_3` FOREIGN KEY (`iduser`) REFERENCES `users` (`idusers`),
  ADD CONSTRAINT `user_classtbl_ibfk_4` FOREIGN KEY (`idclass`) REFERENCES `classtbl` (`idclass`);

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
