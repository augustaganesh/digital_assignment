-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 06:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `addsubject`
--

CREATE TABLE `addsubject` (
  `sub_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `subjectname` varchar(255) DEFAULT NULL,
  `tid` int(11) NOT NULL,
  `subjectcode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addsubject`
--

INSERT INTO `addsubject` (`sub_id`, `semester`, `subjectname`, `tid`, `subjectcode`) VALUES
(33, 6, 'Maths', 0, 'CACS2'),
(34, 8, 'Maths-II', 0, 'CACS3'),
(35, 8, 'Mobile Programming', 0, '70248'),
(36, 8, '.Net', 0, 'CACS 6676'),
(37, 6, 'English', 0, 'CACS4'),
(38, 7, 'English II', 0, 'cacs1111'),
(39, 7, 'Network Programming', 0, 'cacs111'),
(40, 6, 'C Programming', 0, 'cacs 101'),
(41, 10, 'Machine Learning', 0, '3445234'),
(42, 9, 'Computer Networking', 0, '344234');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `status`) VALUES
(5, '4th', 1),
(6, '1st', 1),
(7, '2nd', 1),
(8, '3rd', 1),
(9, '5th', 1),
(10, '7th', 1),
(11, '8th', 1),
(12, '6th', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `aid` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `email` varchar(233) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`aid`, `username`, `email`, `password`) VALUES
(50, 'Admin', 'admin@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_create_assignment`
--

CREATE TABLE `tbl_create_assignment` (
  `id` int(11) NOT NULL,
  `title` varchar(233) DEFAULT NULL,
  `description` varchar(230) NOT NULL,
  `semester` int(11) NOT NULL,
  `subject` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `file` varchar(233) DEFAULT NULL,
  `posted_by` varchar(233) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_create_assignment`
--

INSERT INTO `tbl_create_assignment` (`id`, `title`, `description`, `semester`, `subject`, `created_date`, `deadline`, `file`, `posted_by`) VALUES
(112, 'Newton Raphson', '<p>All questions are compulsary</p>\r\n', 7, 38, '2022-06-26', '2022-06-30', '5.jpg', 'Teaacher1'),
(113, 'Essay writing', '<p>Essay on Student Discipline in 200 words.</p>\r\n', 7, 39, '2022-06-26', '2022-06-28', '4.jpg', 'Stark'),
(114, 'How to be hero?', '<p>Explain it in brief.</p>\r\n', 6, 40, '2022-07-02', '2022-07-04', 'Screenshot (8).png', 'Montana Chavez');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `sid` int(11) NOT NULL,
  `sname` varchar(233) DEFAULT NULL,
  `email` varchar(233) DEFAULT NULL,
  `semester` int(11) NOT NULL,
  `roll_no` int(11) DEFAULT NULL,
  `saddress` varchar(233) DEFAULT NULL,
  `sphone` varchar(233) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`sid`, `sname`, `email`, `semester`, `roll_no`, `saddress`, `sphone`, `status`) VALUES
(68, 'Macy Quinn', 'gavyhy@mailinator.com', 5, 50, 'In molestias velit ', '1111111111', 1),
(69, 'Roanna Good', 'toxepymoc@mailinator.com', 5, 59, 'Tempore consequatur', '1111111112', 1),
(70, 'Roanna Good', 'byjapuhu@mailinator.com', 7, 65, 'Est cupidatat ration', '1111111118', 1),
(71, 'Nyssa Padilla', 'nyssa@gmail.com', 6, 81, 'Incidunt consequatu', '7855555555', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_login`
--

CREATE TABLE `tbl_student_login` (
  `sid` int(11) NOT NULL,
  `username` varchar(233) DEFAULT NULL,
  `email` varchar(233) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `student` int(11) DEFAULT NULL,
  `password` varchar(233) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student_login`
--

INSERT INTO `tbl_student_login` (`sid`, `username`, `email`, `avatar`, `student`, `password`) VALUES
(77, 'Cathleen Reese', 'student1@gmail.com', '', NULL, '827ccb0eea8a706c4c34a16891f84e7b'),
(81, 'Macy Quinn', 'gavyhy@mailinator.com', 'Screenshot (13).png', NULL, '81dc9bdb52d04dc20036dbd8313ed055'),
(83, 'Nyssa Padilla', 'nyssa@gmail.com', 'Screenshot (11).png', 71, '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submit_assignment`
--

CREATE TABLE `tbl_submit_assignment` (
  `id` int(11) NOT NULL,
  `assignment` int(11) DEFAULT NULL,
  `submitted_date` date DEFAULT NULL,
  `file` varchar(233) DEFAULT NULL,
  `submitted_by` varchar(233) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `grade` text NOT NULL,
  `suggestion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_submit_assignment`
--

INSERT INTO `tbl_submit_assignment` (`id`, `assignment`, `submitted_date`, `file`, `submitted_by`, `status`, `grade`, `suggestion`) VALUES
(140, 113, '2022-06-26', 'teacher.jpg', 'Cathleen Reese', 1, 'Bad! Needs lot of improvization', 'Do again Nicely.\r\n'),
(141, 114, '2022-06-26', 'a3.jpg', 'Cathleen Reese', 1, 'Very bad ! Not accepted', 'just do it'),
(150, 114, '2022-07-02', 'Screenshot (8).png', 'Nyssa Padilla', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `tid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tname` varchar(233) DEFAULT NULL,
  `temail` varchar(222) DEFAULT NULL,
  `taddress` varchar(233) DEFAULT NULL,
  `tphone` varchar(233) DEFAULT NULL,
  `tsemester` int(11) DEFAULT NULL,
  `tsubject` int(11) DEFAULT 0,
  `teacher_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `isAssigned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`tid`, `sid`, `tname`, `temail`, `taddress`, `tphone`, `tsemester`, `tsubject`, `teacher_id`, `status`, `isAssigned`) VALUES
(166, 0, 'Stark', 'Stark@gmail.com', '26898 Schmeler Squares', '551', 8, 36, 0, 1, 0),
(172, 0, 'Teaacher1', 'teacher1@gmail.com', 'Damak-1', '9819871981', 6, 37, 0, 1, 0),
(173, 0, 'Teaacher1', 'teacher1@gmail.com', 'Damak-1', '9819871981', 8, 36, 0, 1, 0),
(178, 0, 'test222', 'montana@gmail.com', 'Natus excepturi sit ', '8888888888888888', 6, 40, 0, 1, 0),
(182, 0, 'Davis Meadows', 'nymazim@mailinator.com', 'Do illo rerum in in', '9878787878', 7, 38, 181, 1, 0),
(183, 0, 'Davis Meadows', 'nymazim@mailinator.com', 'Do illo rerum in in', '9878787878', 10, 41, 182, 1, 0),
(184, 0, 'test222', 'montana@gmail.com', 'Natus excepturi sit ', '8888888888888888', 9, 42, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher_login`
--

CREATE TABLE `tbl_teacher_login` (
  `tid` int(11) NOT NULL,
  `username` varchar(233) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(233) DEFAULT NULL,
  `teacher` int(11) DEFAULT NULL,
  `password` varchar(233) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher_login`
--

INSERT INTO `tbl_teacher_login` (`tid`, `username`, `avatar`, `email`, `teacher`, `password`) VALUES
(142, 'Teaacher1', 'a11.jpg', 'teacher1@gmail.com', 172, '827ccb0eea8a706c4c34a16891f84e7b'),
(143, 'Stark', 'student.jpg', 'Stark@gmail.com', 166, '827ccb0eea8a706c4c34a16891f84e7b'),
(144, 'Melissa Tran', 'a.jpg', 'melissa@gmail.com', 178, '81dc9bdb52d04dc20036dbd8313ed055'),
(145, 'Davis Meadows', 'Screenshot (10).png', 'nymazim@mailinator.com', 182, '81dc9bdb52d04dc20036dbd8313ed055'),
(146, 'Montana Chavez', 'Screenshot (8).png', 'montana@gmail.com', 178, '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addsubject`
--
ALTER TABLE `addsubject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tbl_create_assignment`
--
ALTER TABLE `tbl_create_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester` (`semester`),
  ADD KEY `tbl_create_assignment_ibfk_1` (`subject`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `tbl_student_login`
--
ALTER TABLE `tbl_student_login`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `tbl_submit_assignment`
--
ALTER TABLE `tbl_submit_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment` (`assignment`),
  ADD KEY `assignment_3` (`assignment`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `tsemester` (`tsemester`),
  ADD KEY `tsubject` (`tsubject`);

--
-- Indexes for table `tbl_teacher_login`
--
ALTER TABLE `tbl_teacher_login`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `teacher` (`teacher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addsubject`
--
ALTER TABLE `addsubject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_create_assignment`
--
ALTER TABLE `tbl_create_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tbl_student_login`
--
ALTER TABLE `tbl_student_login`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbl_submit_assignment`
--
ALTER TABLE `tbl_submit_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `tbl_teacher_login`
--
ALTER TABLE `tbl_teacher_login`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_create_assignment`
--
ALTER TABLE `tbl_create_assignment`
  ADD CONSTRAINT `tbl_create_assignment_ibfk_2` FOREIGN KEY (`semester`) REFERENCES `semesters` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student_login`
--
ALTER TABLE `tbl_student_login`
  ADD CONSTRAINT `tbl_student_login_ibfk_1` FOREIGN KEY (`student`) REFERENCES `tbl_student` (`sid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_student_login_ibfk_2` FOREIGN KEY (`student`) REFERENCES `tbl_student` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_submit_assignment`
--
ALTER TABLE `tbl_submit_assignment`
  ADD CONSTRAINT `tbl_submit_assignment_ibfk_1` FOREIGN KEY (`assignment`) REFERENCES `tbl_create_assignment` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD CONSTRAINT `tbl_teacher_ibfk_1` FOREIGN KEY (`tsemester`) REFERENCES `semesters` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_teacher_login`
--
ALTER TABLE `tbl_teacher_login`
  ADD CONSTRAINT `tbl_teacher_login_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `tbl_teacher` (`tid`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
