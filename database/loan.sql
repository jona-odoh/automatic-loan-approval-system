-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 09:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `state` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `loan_status` varchar(50) NOT NULL,
  `photo` varchar(700) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `firstname`, `lastname`, `email`, `phone`, `state`, `username`, `password`, `address`, `role`, `status`, `national_id`, `dob`, `loan_status`, `photo`, `color`) VALUES
(10, 1, 'Jonathan', 'Odoh', 'jonathan@gmail.com', '09063633140', 'Abuja', 'admin', 'admin', 'FCT', 'administrator', '', '', '', '', 'admin6441661d327d2a7e6999eed36e40b142.jpeg', 0),
(30, 2, 'Jonathant', 'Odoh', 'jonathanodoh3140@gmail.com', '09063633140', 'Abuja Federal Capital Territory', '', '12345', 'Azhata', 'user', '', '8776786877', '2023-10-09', 'cleared', 'admina2bd6254d39e5b506d24a21a673376c4.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ref_no` int(11) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `national_id` varchar(100) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `job_status` varchar(20) NOT NULL,
  `employer` varchar(100) NOT NULL,
  `job` varchar(100) NOT NULL,
  `income` varchar(100) NOT NULL,
  `e_duration` varchar(100) NOT NULL,
  `expenses` varchar(100) NOT NULL,
  `loan_type` varchar(100) NOT NULL,
  `loan_tenure` varchar(100) NOT NULL,
  `interest` varchar(500) NOT NULL,
  `exLoan` int(11) NOT NULL,
  `loan_plan` varchar(100) NOT NULL,
  `desired_amount` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `guarantor_name` varchar(20) NOT NULL,
  `guarantor_no` varchar(100) NOT NULL,
  `guarantor_national_id` varchar(100) NOT NULL,
  `purpose` text NOT NULL,
  `up_national_id` text NOT NULL,
  `bank_statement` text NOT NULL,
  `gurantor_pic` text NOT NULL,
  `acct_no` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `bvn` varchar(100) NOT NULL,
  `acct_name` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `approval_status` varchar(100) NOT NULL,
  `emi` varchar(500) NOT NULL,
  `date_applied` date NOT NULL DEFAULT current_timestamp(),
  `loan_expiry_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`id`, `user_id`, `ref_no`, `fullname`, `dob`, `email`, `contact_no`, `national_id`, `tax_id`, `job_status`, `employer`, `job`, `income`, `e_duration`, `expenses`, `loan_type`, `loan_tenure`, `interest`, `exLoan`, `loan_plan`, `desired_amount`, `balance`, `guarantor_name`, `guarantor_no`, `guarantor_national_id`, `purpose`, `up_national_id`, `bank_statement`, `gurantor_pic`, `acct_no`, `bank`, `bvn`, `acct_name`, `payment_status`, `status`, `approval_status`, `emi`, `date_applied`, `loan_expiry_date`) VALUES
(40, 30, 36778850, 'Jonathan Odoh', '', 'jonathanodoh3140@gmail.com', ' 09064528790', '', '', 'employed', '', '', '', '', '', '', '', '', 0, '', 0, 0, '', '', '', '', '../uploads/national-id87cec586aa48c199f839f42dd68d8d46_387856366_285627214300174_2793740497681920829_n.jpg', '', '', '', '', '', '', 'cleared', 'Not Approved', 'paid', '0', '2023-10-30', ''),
(44, 30, 99008410, 'Jonathant Odoh', '1996-01-17', 'jonathanodoh3140@gmail.com', '+2349037283385', '8776786877', '00908799', 'employed', 'MTN', 'Marketer', '1000', '6', '500', 'Car', '2', '10', 10, '', 100, 0, 'John', '+2349037283385', '44665534545', 'I want to buy a car', 'national-ide30e877c8fc94253a5e566e467c20607_387856366_285627214300174_2793740497681920829_n.jpg', '../uploads/bank-statment22d83f60b0bbf9824110b8871d22ccdf_Otika - Admin Dashboard Template.pdf', '../uploads/gurantor-pica765872474b171058ef6f93494f52133_emergency7f0eee7589282ab13fa5571eff4bff30.jpeg', '565820390224', 'Zenith Bank', '909879826764789', '287868496769', 'Not paid', 'Approved', 'paid', '4.62', '2023-10-31', ''),
(45, 30, 52099700, 'Jonathant Odoh', '1996-01-01', 'jonathanodoh3140@gmail.com', '+2349037283385', '8776786877', '00908799', 'employed', 'MTN', 'Marketer', '100', '6', '500', 'Car', '1', '10', 10, '', 10000, 0, 'John', '+2349037283385', '09765677', 'car', '../uploads/national-idd6e1f54dcf9d38e0ac14a2b3d9d859f2__PUTME 2023_1694696225400.docx', '../uploads/bank-statment4f40e80e0ca7d62fa29f4d05ef67f024__PUTME 2023_1694696225400.docx', '../uploads/gurantor-pic5dbbf7fff4630d777acafeee30dcff9c__PUTME 2023_1694696225400.docx', '235433434', 'Zenith Bank', '188787767687', '8789698677', 'Not paid', 'Not Approved', '', '35.96', '2023-11-12', ''),
(46, 30, 39370670, 'Jonathant Odoh', '1998-01-06', 'jonathanodoh3140@gmail.com', '+2349037283385', '8776786877', '00908799', 'employed', 'MTN', 'Marketer', '1000', '6', '500', '10', '2', '10', 10, '', 100, 0, 'John', '+2349037283385', '09765677', 'gjg', '', '', '', '4554', 'Zenith Bank', '1747258', '57888888884', 'Not paid', 'Approved', '', '4.62', '2023-11-16', ''),
(47, 30, 83416127, 'Jonathant Odoh', '1989-03-02', 'jonathanodoh3140@gmail.com', '+2349037283385', '', '', 'employed', 'MTN', 'Marketer', '1000', '6', '500', 'Car', '2', '10', 10, '', 100, 0, 'John', '+2349037283385', '09765677', 'yuu8', '../uploads/national-idbf2856396443460981bd93d2453fcf18_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/bank-statment4c43dda450c6b655fcac0aa4e4c7caa2_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/gurantor-pic04cc3444248e305e802dda6e54f93826_314362198_185637717313135_9085194297383051207_n.jpg', '7857', 'Zenith Bank', '7686698689', '789987', 'Not paid', 'Approved', '', '4.62', '2023-11-16', '2023-11-30'),
(48, 30, 14736998, 'Jonathant Odoh', '1996-02-06', 'jonathanodoh3140@gmail.com', '+2349037283385', '8776786877', '00908799', 'employed', '', 'Marketer', '1000', '6', '500', 'Car', '2', '10', 10, '', 100, 0, 'John', '+2349037283385', '09765677', 'fg', '../uploads/national-id49341f843cc9476ed9bb5a82788dc388_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/bank-statment0ca7b425579d26b7a2cf0ce5f2129dfa_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/gurantor-pic8683865b6d959ee9676dc740f5e079b1_314362198_185637717313135_9085194297383051207_n.jpg', '56756', 'Zenith Bank', '57657899', '8666', 'Not paid', 'Approved', '', '4.62', '2023-11-16', '2024-01-15'),
(49, 30, 100, 'Jonathant Odoh', '1998-06-16', 'jonathanodoh3140@gmail.com', '+2349037283385', '8776786877', '00908799', 'employed', 'MTN', 'Marketer', '1000', '6', '500', 'Car', '2', '10', 10, '', 100, 7117117, 'John', '+2349037283385', '09765677', 'uihjivu', '../uploads/national-iddaed09f8af37a60488ba32cc91083d03_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/bank-statment7070ab6a0c1f542de83134fcae4df834_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/gurantor-picdf23aecf02f7f49184b3ae154de89fe7_314362198_185637717313135_9085194297383051207_n.jpg', '59864565', 'Zenith Bank', '668979', '646334', 'Not paid', 'Approved', '', '4.62', '2023-11-16', ''),
(50, 30, 100, 'Jonathant Odoh', '1999-01-12', 'jonathanodoh3140@gmail.com', '+2349037283385', '8776786877', '00908799', 'employed', 'MTN', 'Marketer', '1000', '6', '500', 'Car', '2', '10', 10, '', 100, 77516238, 'John', '+2349037283385', '44665534545', 'thtr', '../uploads/national-idfd5658b08f8b4478f453d5149b814ee4_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/bank-statmentefcc555c8212c9d0d1a16cc31b00d2c2_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/gurantor-pic28705f45bb104208e3cf3971f11fd085_314362198_185637717313135_9085194297383051207_n.jpg', '78688', 'Zenith Bank', '9787779', '723555', 'Not paid', 'Approved', '', '4.62', '2023-11-16', ''),
(51, 30, 100, 'Jonathant Odoh', '1998-06-09', 'jonathanodoh3140@gmail.com', '+2349037283385', '8776786877', '00908799', 'employed', 'MTN', 'Marketer', '1000', '6', '500', 'Car', '2', '10', 10, '', 100, 32101609, 'John', '+2349037283385', '44665534545', 'hnjgyfn', '../uploads/national-ideacab3967ce32ee301aae51db40af268_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/bank-statment87f4668493970a63a2fea90d7b0ec683_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/gurantor-pic226c1dd89d05ac8ed8767d657b065025_314362198_185637717313135_9085194297383051207_n.jpg', '68298', '', '989876989', '689689', 'Not paid', 'Approved', '', '4.62', '2023-11-16', ''),
(52, 30, 20500870, 'Jonathant Odoh', '1997-07-09', 'jonathanodoh3140@gmail.com', '+2349037283385', '8776786877', '00908799', 'employed', 'MTN', 'Marketer', '1000', '6', '500', 'Car', '2', '10', 10, '', 100, 100, 'John', '+2349037283385', '09765677', 'gfbhtg', '../uploads/national-id260b0e0e717b5b6e24b4fbc33314cd3c_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/bank-statment730dc7a2754cfe9faa761a4806c4a6ff_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/gurantor-pic85b0af104009864a90903a0094964dc5_314362198_185637717313135_9085194297383051207_n.jpg', '64665', 'Zenith Bank', '465776878', '4677667', 'Not paid', 'Approved', '', '4.62', '2023-11-16', '2024-01-15'),
(53, 30, 10544810, 'Jonathant Odoh', '1998-02-16', 'jonathanodoh3140@gmail.com', '+2349037283385', '8776786877', '00908799', 'employed', 'MTN', 'Marketer', '100', '6', '500', 'Car', '1', '10', 10, '', 10000, 0, 'John', '+2349037283385', '44665534545', 'yiifu', '../uploads/national-iddd0ed6daac5af26a74c0f388f6c81c1c_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/bank-statmentbf37dfd81392a29feab2df58cfceebea_314362198_185637717313135_9085194297383051207_n.jpg', '../uploads/gurantor-pic843f82f0719f3febcc54f990a97e955a_314362198_185637717313135_9085194297383051207_n.jpg', '54090809', 'Zenith Bank', '455545454', '54665687', 'Not paid', 'Not Approved', '', '35.96', '2023-11-16', '');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `ltype_id` int(30) NOT NULL,
  `borrower_id` int(30) NOT NULL,
  `purpose` text NOT NULL,
  `amount` double NOT NULL,
  `lplan_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=request, 1=confirmed, 2=released, 3=completed, 4=denied',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_plan`
--

CREATE TABLE `loan_plan` (
  `id` int(11) NOT NULL,
  `lplan_month` int(11) NOT NULL,
  `lplan_interest` float NOT NULL,
  `lplan_penalty` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loan_plan`
--

INSERT INTO `loan_plan` (`id`, `lplan_month`, `lplan_interest`, `lplan_penalty`, `status`) VALUES
(10, 0, 5, 0, 'Not Active');

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedule`
--

CREATE TABLE `loan_schedule` (
  `loan_sched_id` int(50) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `id` int(11) NOT NULL,
  `ltype_name` text NOT NULL,
  `interest` varchar(100) NOT NULL,
  `ltype_desc` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`id`, `ltype_name`, `interest`, `ltype_desc`, `status`) VALUES
(12, 'Car', 'fvf', '', 'Active'),
(13, 'Personal Loan', '', '', 'Active'),
(14, 'Business Loan ', '', '', 'Active'),
(15, 'Educational Loan', '', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `payee` text NOT NULL,
  `pay_amount` float NOT NULL,
  `penalty` float NOT NULL,
  `overdue` tinyint(1) NOT NULL COMMENT '0=no, 1=yes',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `title`, `email`, `contact_no`, `state`, `address`, `photo`) VALUES
(1, 'Loan Management System', 'Loan', 'jonathanodoh3140@gmail.com', '+2349037283385', 'Abuja Federal Capital Territory', 'Azhata', 'settings419ba4e56bfa672a2799e4f8363296f1.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `national_id` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `firstname`, `lastname`, `email`, `contact_no`, `national_id`, `dob`, `status`, `photo`) VALUES
(2, 'admin', 'Jonathan\n', 'Odoh', 'jonathanodoh3140@gmail.com', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` int(11) NOT NULL,
  `lastname` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `national_id` int(11) NOT NULL,
  `dob` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `loan_plan`
--
ALTER TABLE `loan_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  ADD PRIMARY KEY (`loan_sched_id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_plan`
--
ALTER TABLE `loan_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  MODIFY `loan_sched_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
