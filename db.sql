-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 09:38 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmer`
--
CREATE DATABASE IF NOT EXISTS `filmer` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `filmer`;

-- --------------------------------------------------------

--
-- Table structure for table `likedmovies`
--

DROP TABLE IF EXISTS `likedmovies`;
CREATE TABLE `likedmovies` (
  `idUporabnik` int(11) NOT NULL,
  `idMovie` int(11) NOT NULL,
  `CHK_Key` varchar(200) DEFAULT NULL,
  `AddDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likedmovies`
--

INSERT INTO `likedmovies` (`idUporabnik`, `idMovie`, `CHK_Key`, `AddDate`) VALUES
(37, 238, '559992bj59', '2023-05-17 12:52:47'),
(37, 429, '559992bj59', '2023-05-17 12:52:48'),
(37, 372058, '559992bj59', '2023-05-17 12:52:49'),
(37, 934433, 'c4i7e7gc5i', '2023-05-17 16:24:16'),
(37, 447365, 'c4i7e7gc5i', '2023-05-17 16:24:16'),
(37, 868759, 'c4i7e7gc5i', '2023-05-17 16:24:17'),
(37, 785759, 'c4i7e7gc5i', '2023-05-17 16:24:17'),
(37, 640146, 'c4i7e7gc5i', '2023-05-17 16:24:17'),
(37, 603692, 'c4i7e7gc5i', '2023-05-17 16:24:26'),
(37, 677179, 'c4i7e7gc5i', '2023-05-17 16:24:27'),
(37, 1111140, 'c4i7e7gc5i', '2023-05-17 16:24:27'),
(37, 727340, 'c4i7e7gc5i', '2023-05-17 16:24:28'),
(37, 76600, 'c4i7e7gc5i', '2023-05-17 16:24:28'),
(37, 315162, 'c4i7e7gc5i', '2023-05-17 16:24:29'),
(37, 713704, 'c4i7e7gc5i', '2023-05-17 16:24:30'),
(37, 948713, 'c4i7e7gc5i', '2023-05-17 16:24:30'),
(37, 758323, 'c4i7e7gc5i', '2023-05-17 16:24:30'),
(37, 1102776, 'c4i7e7gc5i', '2023-05-17 16:24:30'),
(37, 594767, 'c4i7e7gc5i', '2023-05-17 16:24:30'),
(37, 420808, 'c4i7e7gc5i', '2023-05-17 16:24:34'),
(37, 283995, 'c4i7e7gc5i', '2023-05-17 16:24:36'),
(37, 502356, 'c4i7e7gc5i', '2023-05-17 16:24:36'),
(37, 385687, 'c4i7e7gc5i', '2023-05-17 16:24:38'),
(37, 1085103, 'c4i7e7gc5i', '2023-05-17 16:26:27'),
(37, 876969, 'c4i7e7gc5i', '2023-05-17 16:26:28'),
(37, 493529, 'c4i7e7gc5i', '2023-05-17 16:26:29'),
(37, 816904, 'c4i7e7gc5i', '2023-05-17 16:26:30'),
(37, 946310, 'c4i7e7gc5i', '2023-05-17 16:26:31'),
(37, 1048300, 'c4i7e7gc5i', '2023-05-17 16:28:53'),
(38, 649609, 'cg6c2e2faa', '2023-05-21 10:38:33'),
(38, 640146, 'cg6c2e2faa', '2023-05-21 10:38:35'),
(38, 713704, 'cg6c2e2faa', '2023-05-21 10:38:36'),
(38, 758323, 'cg6c2e2faa', '2023-05-21 10:38:37'),
(38, 552688, 'cg6c2e2faa', '2023-05-21 10:38:38'),
(38, 502356, 'cg6c2e2faa', '2023-05-21 10:38:38'),
(38, 840326, 'cg6c2e2faa', '2023-05-21 10:38:38'),
(38, 603692, 'cg6c2e2faa', '2023-05-21 10:38:38'),
(38, 882569, 'cg6c2e2faa', '2023-05-21 10:38:38'),
(38, 447365, 'cg6c2e2faa', '2023-05-21 10:38:39'),
(38, 1037644, 'cg6c2e2faa', '2023-05-21 10:38:39'),
(38, 934433, 'cg6c2e2faa', '2023-05-21 10:38:39'),
(38, 654374, 'cg6c2e2faa', '2023-05-21 10:38:40'),
(38, 1102776, 'cg6c2e2faa', '2023-05-21 10:38:41'),
(38, 842675, 'cg6c2e2faa', '2023-05-21 10:38:41'),
(38, 507250, 'cg6c2e2faa', '2023-05-21 10:38:42'),
(38, 67308, 'cg6c2e2faa', '2023-05-21 10:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `matchedmovies`
--

DROP TABLE IF EXISTS `matchedmovies`;
CREATE TABLE `matchedmovies` (
  `idUporabnik` int(11) NOT NULL,
  `idMovie` int(11) NOT NULL,
  `CHK_Key` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matchedmovies`
--

INSERT INTO `matchedmovies` (`idUporabnik`, `idMovie`, `CHK_Key`) VALUES
(21, 817451, '7a6i45233a'),
(33, 817451, '7a6i45233a'),
(21, 520763, '7a6i45233a'),
(33, 520763, '7a6i45233a'),
(37, 594767, '559992bj59'),
(21, 594767, '559992bj59'),
(21, 1102776, '559992bj59'),
(37, 1102776, '559992bj59'),
(21, 315162, '559992bj59'),
(37, 315162, '559992bj59'),
(21, 713704, '559992bj59'),
(37, 713704, '559992bj59'),
(21, 677179, '559992bj59'),
(37, 677179, '559992bj59'),
(37, 727340, '559992bj59'),
(21, 727340, '559992bj59'),
(37, 868759, '559992bj59'),
(21, 868759, '559992bj59'),
(37, 420808, '559992bj59'),
(21, 420808, '559992bj59'),
(21, 948713, '559992bj59'),
(37, 948713, '559992bj59'),
(21, 76600, '559992bj59'),
(37, 76600, '559992bj59'),
(21, 640146, '559992bj59'),
(37, 640146, '559992bj59'),
(37, 1111140, '559992bj59'),
(21, 1111140, '559992bj59'),
(37, 934433, '559992bj59'),
(21, 934433, '559992bj59'),
(37, 603692, '559992bj59'),
(21, 603692, '559992bj59'),
(37, 447365, '559992bj59'),
(21, 447365, '559992bj59'),
(37, 758323, '559992bj59'),
(21, 758323, '559992bj59'),
(21, 769, '559992bj59'),
(37, 769, '559992bj59'),
(37, 240, '559992bj59'),
(21, 240, '559992bj59'),
(38, 385687, 'cg6c2e2faa'),
(38, 385687, 'cg6c2e2faa'),
(38, 594767, 'cg6c2e2faa'),
(38, 594767, 'cg6c2e2faa'),
(38, 594767, 'cg6c2e2faa'),
(38, 677179, 'cg6c2e2faa'),
(38, 677179, 'cg6c2e2faa'),
(38, 677179, 'cg6c2e2faa'),
(38, 677179, 'cg6c2e2faa'),
(38, 868759, 'cg6c2e2faa'),
(38, 868759, 'cg6c2e2faa');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `idMovie` int(11) NOT NULL,
  `MovieTitle` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`idMovie`, `MovieTitle`) VALUES
(238, 'The Godfather'),
(240, 'The Godfather: Part II'),
(278, 'The Shawshank Redemption'),
(389, '12 Angry Men'),
(429, 'The Good, the Bad and the Ugly'),
(497, 'The Green Mile'),
(769, 'GoodFellas'),
(19404, 'Dilwale Dulhania Le Jayenge'),
(20982, 'Naruto Shippuden the Movie'),
(38700, 'Bad Boys for Life'),
(67308, '3-D Sex and Zen: Extreme Ecstasy'),
(76600, 'Avatar: The Way of Water'),
(124905, 'Godzilla'),
(138843, 'The Conjuring'),
(181812, 'Star Wars: The Rise of Skywalker'),
(259693, 'The Conjuring 2'),
(283995, 'Guardians of the Galaxy Vol. 2'),
(293167, 'Kong: Skull Island'),
(299536, 'Avengers: Infinity War'),
(299537, 'Captain Marvel'),
(315162, 'Puss in Boots: The Last Wish'),
(335983, 'Venom'),
(337401, 'Mulan'),
(337404, 'Cruella'),
(338762, 'Bloodshot'),
(340102, 'The New Mutants'),
(372058, 'Your Name.'),
(373571, 'Godzilla: King of the Monsters'),
(384018, 'Fast &amp; Furious Presents: Hobbs &amp; Shaw'),
(385687, 'Fast &amp; Furious 10'),
(399566, 'Godzilla vs. Kong'),
(400160, 'The SpongeBob Movie: Sponge on the Run'),
(420808, 'Peter Pan &amp; Wendy'),
(423108, 'The Conjuring: The Devil Made Me Do It'),
(429617, 'Spider-Man: Far from Home'),
(436270, 'Black Adam'),
(443791, 'Underwater'),
(447332, 'A Quiet Place'),
(447362, 'Life in a Year'),
(447365, 'Guardians of the Galaxy Vol. 3'),
(458156, 'John Wick: Chapter 3 - Parabellum'),
(458220, 'Palmer'),
(458576, 'Monster Hunter'),
(460465, 'Mortal Kombat'),
(461130, 'Code 8'),
(464052, 'Wonder Woman 1984'),
(475557, 'Joker'),
(489245, 'The Kill Team'),
(493529, 'Dungeons &amp; Dragons: Honor Among Thieves'),
(495764, 'Birds of Prey (and the Fantabulous Emancipati'),
(496243, 'Parasite'),
(502356, 'The Super Mario Bros. Movie'),
(503736, 'Army of the Dead'),
(503929, 'Fixed'),
(507250, 'Dead Shot'),
(508442, 'Soul'),
(509635, 'Alone'),
(509967, '6 Underground'),
(512200, 'Jumanji: The Next Level'),
(520763, 'A Quiet Place Part II'),
(520946, '100% Wolf'),
(522444, 'Black Water: Abyss'),
(524047, 'Greenland'),
(527774, 'Raya and the Last Dragon'),
(529203, 'The Croods: A New Age'),
(531499, 'The Tax Collector'),
(539885, 'Ava'),
(544401, 'Cherry'),
(545609, 'Extraction'),
(552688, 'The Mother'),
(553604, 'Honest Thief'),
(560144, 'Skylines'),
(565743, 'The Vast of Night'),
(567189, 'Tom Clancys Without Remorse\r\n'),
(571785, 'Time to Hunt'),
(573680, 'The Banishing'),
(575088, 'Baba Yaga: Terror of the Dark Forest'),
(577922, 'Tenet'),
(578701, 'Those Who Wish Me Dead'),
(581387, 'Ashfall'),
(581389, 'Space Sweepers'),
(581392, 'Peninsula'),
(581600, 'Spenser Confidential'),
(582306, 'Assassin 33 A.D.'),
(586047, 'Seobok'),
(587496, 'The Rental'),
(587807, 'Tom &amp; Jerry'),
(587996, 'Below Zero'),
(590706, 'Jiu Jitsu'),
(592350, 'My Hero Academia: Heroes Rising'),
(594718, 'Sputnik'),
(594767, 'Shazam! Fury of the Gods'),
(595813, 'Barb and Star Go to Vista Del Mar'),
(596247, 'Pacto de Fuga'),
(599281, 'Fear of Rain'),
(602269, 'The Little Things'),
(602734, 'Spiral: From the Book of Saw'),
(603692, 'John Wick: Chapter 4'),
(604822, 'Vanguard'),
(607383, 'Aquaslash'),
(611914, 'The Courier'),
(613504, 'After We Collided'),
(614409, 'To All the Boys: Always and Forever'),
(615457, 'Nobody'),
(615677, 'We Can Be Heroes'),
(615678, 'Thunder Force'),
(630586, 'Wrong Turn'),
(632357, 'The Unholy'),
(634528, 'The Marksman'),
(635302, 'Demon Slayer: Infinity Train'),
(637649, 'Wrath of Man'),
(638597, 'Yes Day'),
(640146, 'Ant-Man and the Wasp: Quantumania'),
(647302, 'Benny Loves You'),
(649087, 'Red Dot'),
(649609, 'Renfield'),
(651571, 'Breach'),
(654374, 'The Youngest Sister-in-law'),
(655431, 'Psycho-Pass 3: First Inspector'),
(659067, 'Earth and Blood'),
(659986, 'The Owners'),
(662334, 'Chaco'),
(663558, 'New Gods: Nezha Reborn'),
(666750, 'Dragonheart: Vengeance'),
(669444, 'Les chevaliers du fiel dynamitent 2019'),
(676842, 'Instructions for Su'),
(677179, 'Creed III'),
(681260, 'Maya the Bee: The Golden Orb'),
(686487, 'King Kong vs. Godzilla'),
(687149, 'Toxic'),
(700995, 'Devoto, la invasión silenciosa'),
(704264, 'Primal: Tales of Savagery'),
(713704, 'Evil Dead Rise'),
(717192, 'Ferry'),
(723072, 'Host'),
(726429, 'Xtreme'),
(726684, 'Miraculous World: Shanghai – The Legend of La'),
(727340, 'Hunt'),
(732450, 'Batman: Soul of the Dragon'),
(737568, 'The Doorman'),
(741074, 'Once Upon a Snowman'),
(755812, 'Miraculous World: New York, United HeroeZ'),
(758323, 'The Pope\'s Exorcist'),
(761270, 'Dancing Queens'),
(767304, 'Redemption Day'),
(772515, 'Huesera: The Bone Woman'),
(775996, 'Outside the Wire'),
(784500, 'Pretty Guardian Sailor Moon Eternal The Movie'),
(785759, 'Two Witches'),
(786300, 'Tentacles'),
(791373, 'Zack Snyders Justice League'),
(791910, 'Rise of the Mummy'),
(793723, 'Sentinelle'),
(804150, 'Cocaine Bear'),
(804435, 'Vanquish'),
(808023, 'The Virtuoso'),
(811367, '22 vs. Earth'),
(813258, 'Monster Pets: A Hotel Transylvania Short'),
(816904, 'Mummies'),
(817451, 'Endangered Species'),
(823855, 'I Am All Girls'),
(825597, 'Maggie Simpson in The Force Awakens from Its '),
(840326, 'Sisu'),
(842675, 'The Wandering Earth II'),
(868759, 'Ghosted'),
(868985, '¡Que Viva México!'),
(876969, 'Assassin Club'),
(882569, 'Guy Ritchie\\\'s The Covenant'),
(934433, 'Scream VI'),
(946310, 'Pirates Down the Street II: The Ninjas from A'),
(948713, 'The Last Kingdom: Seven Kings Must Die'),
(995133, 'The Boy, the Mole, the Fox and the Horse'),
(1037644, 'Battle for Saipan'),
(1048300, 'Adrenaline'),
(1085103, 'Clock'),
(1094319, 'The Best Man'),
(1102776, 'AKA'),
(1111140, 'Two Sinners and a Mule');

-- --------------------------------------------------------

--
-- Table structure for table `uporabnik`
--

DROP TABLE IF EXISTS `uporabnik`;
CREATE TABLE `uporabnik` (
  `idUporabnik` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(45) NOT NULL,
  `PASS_HASH` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uporabnik`
--

INSERT INTO `uporabnik` (`idUporabnik`, `username`, `email`, `password`, `PASS_HASH`) VALUES

(21, 'pivk123', 'pivk@gmail.com', 'pivko', '$2y$10$JK1IQ3T1xil3uNtDu/pOau3trZ0bTThcImpm9w56blnrhz3GrsQsC'),
(33, 'donke', 'donke123@gmail.com', 'donke123', '$2y$10$yseaH5J8lftqsDqo9kVureV7ckDgUzscsWS7wpOMKOwpFHJ4Qz4w2'),
(35, 'edinedis', 'edinehi53@gmail.com', 'asdfasd', '$2y$10$ivFPjTBen0Rv1O9eUR1YE.AdPTjbGsdGh8z/Oe8tlVS8sUUbKJ97e'),
(37, 'denis', 'dinehi53@gmail.com', 'asdasdasd', '$2y$10$dSafJr5Yf6nD7077zh44ZOpdG/XVSG4yNY0eLgo8PZ6ueVp6avI7O'),
(38, 'maradona', 'ec@fri.lj.si', 'maradona123', '$2y$10$8Wk4RgOkHbu989Sxo5jGH.kYBIPAPVjMvIkWWsQmwpspKjPzSBynO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likedmovies`
--
ALTER TABLE `likedmovies`
  ADD KEY `idUporabnik` (`idUporabnik`),
  ADD KEY `idMovie` (`idMovie`);

--
-- Indexes for table `matchedmovies`
--
ALTER TABLE `matchedmovies`
  ADD KEY `idUporabnik` (`idUporabnik`),
  ADD KEY `idMovie` (`idMovie`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`idMovie`);

--
-- Indexes for table `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`idUporabnik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `idUporabnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likedmovies`
--
ALTER TABLE `likedmovies`
  ADD CONSTRAINT `likedmovies_ibfk_1` FOREIGN KEY (`idUporabnik`) REFERENCES `uporabnik` (`idUporabnik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likedmovies_ibfk_2` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matchedmovies`
--
ALTER TABLE `matchedmovies`
  ADD CONSTRAINT `matchedmovies_ibfk_1` FOREIGN KEY (`idUporabnik`) REFERENCES `uporabnik` (`idUporabnik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matchedmovies_ibfk_2` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
