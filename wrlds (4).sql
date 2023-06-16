-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 07:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wrlds`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id_album` varchar(255) NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `rilis` date NOT NULL,
  `cover` varchar(255) NOT NULL,
  `id_artis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `Judul`, `rilis`, `cover`, `id_artis`) VALUES
('b1', 'A Head Full of Dreams', '2015-12-04', 'cover_a_head_full_of_dreams.jpg', 'a5'),
('b2', 'Divide', '2017-03-03', 'cover_divide.jpg', 'a1'),
('b3', 'Red Pill Blues', '2017-11-03', 'cover_red_pill_blues.jpg', 'a4'),
('b4', 'Lover', '2019-08-23', '\'cover_lover.jpg', 'a2'),
('b5', 'Positions', '2020-10-30', 'cover_positions.jpg', 'a3');

-- --------------------------------------------------------

--
-- Table structure for table `artis`
--

CREATE TABLE `artis` (
  `id_artis` varchar(11) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `Debut` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artis`
--

INSERT INTO `artis` (`id_artis`, `Nama`, `Debut`) VALUES
('a1', 'Ed Sheeran', '2005-01-01'),
('a2', 'Taylor Swift', '2006-01-01'),
('a3', 'Ariana Grande', '2008-01-01'),
('a4', 'Maroon 5', '1994-01-01'),
('a5', 'Coldplay', '1996-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id_lagu` varchar(11) NOT NULL,
  `id_artis` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lagu`
--

CREATE TABLE `lagu` (
  `id_lagu` varchar(11) NOT NULL,
  `judul_lagu` varchar(255) DEFAULT NULL,
  `durasi` time DEFAULT NULL,
  `jumlahPemutaran` int(11) DEFAULT NULL,
  `id_artis` varchar(11) DEFAULT NULL,
  `id_album` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lagu`
--

INSERT INTO `lagu` (`id_lagu`, `judul_lagu`, `durasi`, `jumlahPemutaran`, `id_artis`, `id_album`) VALUES
('dummy', 'dummy', '00:01:05', 1, 'a1', 'b2'),
('Positions.m', 'Positions', '00:02:52', 800000, 'a3', 'b5'),
('s2', 'Blank Space', '00:03:51', 950000, 'a2', 'b4'),
('s4', 'Sugar', '00:03:55', 900000, 'a4', 'b3'),
('s5', 'Adventure of a Lifetime', '00:04:23', 850000, 'a5', 'b1'),
('Shapeofyou.', 'Shape of You', '00:03:54', 1000000, 'a1', 'b2');

-- --------------------------------------------------------

--
-- Table structure for table `lagu_playlist`
--

CREATE TABLE `lagu_playlist` (
  `id_lagu` varchar(255) NOT NULL,
  `id_playlist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id_playlist` varchar(255) NOT NULL,
  `namaplay` varchar(255) NOT NULL,
  `id_lagu` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id_playlist`, `namaplay`, `id_lagu`, `username`) VALUES
('', 'sad', 'dummy', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id_queue` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `id_lagu` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', '$2y$10$ohj0YvJgmv7b3U7u6vTQTO28mOrl8rsw/Le90S6GUq2MzZ5toUn2y'),
('mayclean', '$2y$10$7jGaRSBbagcOanlMMpjMbuRHsaEHi0v1./U.DrV/w9j6yjEuHbFGe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `album_id_artis` (`id_artis`);

--
-- Indexes for table `artis`
--
ALTER TABLE `artis`
  ADD PRIMARY KEY (`id_artis`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD KEY `genre_id_lagu` (`id_lagu`),
  ADD KEY `genre_id_artis` (`id_artis`);

--
-- Indexes for table `lagu`
--
ALTER TABLE `lagu`
  ADD PRIMARY KEY (`id_lagu`),
  ADD KEY `lagu_id_artis` (`id_artis`),
  ADD KEY `lagu_id_album` (`id_album`);

--
-- Indexes for table `lagu_playlist`
--
ALTER TABLE `lagu_playlist`
  ADD KEY `lp_id_lagu` (`id_lagu`),
  ADD KEY `lp_id_playlist` (`id_playlist`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id_playlist`),
  ADD KEY `playlist_id_lagu` (`id_lagu`),
  ADD KEY `playlist_id_user` (`username`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id_queue`),
  ADD KEY `queue_id_lagu` (`id_lagu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_id_artis` FOREIGN KEY (`id_artis`) REFERENCES `artis` (`id_artis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_id_artis` FOREIGN KEY (`id_artis`) REFERENCES `artis` (`id_artis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genre_id_lagu` FOREIGN KEY (`id_lagu`) REFERENCES `lagu` (`id_lagu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lagu`
--
ALTER TABLE `lagu`
  ADD CONSTRAINT `lagu_id_album` FOREIGN KEY (`id_album`) REFERENCES `album` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lagu_id_artis` FOREIGN KEY (`id_artis`) REFERENCES `artis` (`id_artis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lagu_playlist`
--
ALTER TABLE `lagu_playlist`
  ADD CONSTRAINT `lp_id_lagu` FOREIGN KEY (`id_lagu`) REFERENCES `lagu` (`id_lagu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lp_id_playlist` FOREIGN KEY (`id_playlist`) REFERENCES `playlist` (`id_playlist`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_id_lagu` FOREIGN KEY (`id_lagu`) REFERENCES `lagu` (`id_lagu`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `playlist_id_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `queue`
--
ALTER TABLE `queue`
  ADD CONSTRAINT `queue_id_lagu` FOREIGN KEY (`id_lagu`) REFERENCES `lagu` (`id_lagu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
