-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:51111
-- Generation Time: Nov 04, 2020 at 11:29 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `recipeID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `RecipeName` varchar(50) NOT NULL,
  `Images` blob NOT NULL,
  `Servings` int(11) DEFAULT NULL,
  `PreparationTime` int(11) DEFAULT NULL,
  `Ratings` int(11) DEFAULT NULL,
  `Ingredients` varchar(200) NOT NULL,
  `Instructions` text NOT NULL,
  `DateAdded` date DEFAULT NULL,
  `TimeAdded` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipeID`, `userID`, `RecipeName`, `Images`, `Servings`, `PreparationTime`, `Ratings`, `Ingredients`, `Instructions`, `DateAdded`, `TimeAdded`) VALUES
(1, NULL, 'Green smoothie', '', 2, 5, 4, '1 green apple, 2 kiwis, handful of fresh baby spinach, water', 'Mix everything in blender and enjoy!', '2020-11-04', '17:44:44'),
(2, NULL, 'Berry smoothie', '', 2, 5, 4, 'Berries, 1 banana, oat milk', 'Mix everything in blender and enjoy!', '2020-11-04', '17:47:39'),
(3, NULL, 'Caipirinha', '', 1, 4, 5, 'Pitu, ice cubes, brown sugar, lime', 'Smash lime and sugar in a glass. Add ice cubes and pitu. Enjoy!', '2020-11-04', '18:08:04'),
(4, NULL, 'Latte', '', 1, 10, 4, 'espresso coffee, milk', 'Make the espresso. Heat the milk. Put the hot milk in a cup and add the espresso.', '2020-11-04', '18:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `Username` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `JoiningDate` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `Username`, `Password`, `JoiningDate`) VALUES
(7, 'admin', '$2y$10$vvpgrsESGo21Mh8rF5vcN.WiHbJJ.blVJ5UjXDcQDzniIw1mBu/tq', '2020-11-04 00:00:00'),
(8, 'Laura', '$2y$10$s7RvsdKsDRc3F5E/JAYUx.NiOcjCpBIIZqypQUL1XBwbASyw2BTCS', '2020-11-04 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipeID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
