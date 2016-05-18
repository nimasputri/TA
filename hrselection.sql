-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2016 at 02:42 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hrselection`
--
CREATE DATABASE IF NOT EXISTS `hrselection` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hrselection`;

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE IF NOT EXISTS `kandidat` (
  `id_kandidat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kandidat` varchar(30) NOT NULL,
  `alamat` varchar(70) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `username_twitter` varchar(20) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `pendidikan` varchar(70) NOT NULL,
  `ipk` float NOT NULL,
  `pengalaman_organisasi` varchar(100) DEFAULT NULL,
  `pengalaman_kerja` varchar(100) DEFAULT NULL,
  `pelatihan_sertifikasi` varchar(100) DEFAULT NULL,
  `tes_awal` varchar(100) NOT NULL,
  `psikotest` varchar(100) NOT NULL,
  `tes_simulasi` varchar(100) NOT NULL,
  `wawancara` varchar(100) NOT NULL,
  `jumlah_sentimen_pos` int(11) NOT NULL,
  `jumlah_sentimen_neg` int(11) NOT NULL,
  `jumlah_sentimen_net` int(11) NOT NULL,
  `extraversion` float NOT NULL,
  `agreeableness` float NOT NULL,
  `conscientiousness` float NOT NULL,
  `neuroticism` float NOT NULL,
  `openness` float NOT NULL,
  PRIMARY KEY (`id_kandidat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `nama_kandidat`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `email`, `username_twitter`, `telepon`, `pendidikan`, `ipk`, `pengalaman_organisasi`, `pengalaman_kerja`, `pelatihan_sertifikasi`, `tes_awal`, `psikotest`, `tes_simulasi`, `wawancara`, `jumlah_sentimen_pos`, `jumlah_sentimen_neg`, `jumlah_sentimen_net`, `extraversion`, `agreeableness`, `conscientiousness`, `neuroticism`, `openness`) VALUES
(1, 'Untari Zaeca Warjani', '', '', '0000-00-00', '', 'untari', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 1, 1.5, 5, 2.4, 4.5, 3.5),
(2, 'Taufik Akbar Abdullah', '', '', '0000-00-00', '', 'taufikakbarA', '', '', 0, NULL, NULL, NULL, '', '', '', '', 14, 8, 179, 1.83333, 4.5, 3.6, 4.25, 3.25),
(3, 'Khairina Putri Iskandar', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Monika Sembiring', '', '', '0000-00-00', '', 'MonikaSembiring', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 2.5, 3.5, 3.6, 4.25, 3),
(5, 'Dennis Jonathan', '', '', '0000-00-00', '', 'DennisEuy', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 2.5, 3, 3.2, 4.5, 3.25),
(6, 'Nadhira Afriani', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'Muhammad Ibnu Qoyim', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'Eric Ongkowijoyo', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'Taufiq Akbar Rosyadi', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(10, 'Dilla Anindita', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'Nimas Putri Asriningtyas', 'Jl. Ciheulang No. 233 Tubagus Ismail No. 233, Bandung', 'Tegal', '1994-07-28', 'asriningtyas.nimas@gmail.com', 'nimasputrii', '08973020280', 'S1 Sistem dan Teknologi Informasi ITB', 3, 'HMIF, KPA', 'Mata Prima Universal Intership - System Analyst', 'seven habits', '', '', '', '', 0, 0, 1, 2, 5, 2.6, 3.75, 3.5),
(12, 'Tiara Dwiputri', '', '', '0000-00-00', '', 'tiaradwiputri', '', '', 0, NULL, NULL, NULL, '', '', '', '', 18, 18, 180, 2.5, 3, 3, 4, 2.5),
(13, 'Bella Claudia Nur Azizah', '', '', '0000-00-00', '', 'bellaclaudiaaaa', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 1, 1.83333, 5, 2.6, 4, 3.5),
(14, 'Andhina Amalia Ratnaputri', '', '', '0000-00-00', '', 'andhinaar', '', '', 0, NULL, NULL, NULL, '', '', '', '', 22, 17, 162, 2.33333, 3, 3.2, 4.25, 3),
(15, 'Sheila Hana Fitriani', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(16, 'Fitri Indah Cahyani', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(17, 'Noor Afifah Huwaidah', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(18, 'Felix Riady Tanamas', '', '', '0000-00-00', '', 'felix_tanamas', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(19, 'Bintang Subuh Puntodewo', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(20, 'Arum Adhiningtyas', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(21, 'Erlangga', '', '', '0000-00-00', '', 'erlanggawulung', '', '', 0, NULL, NULL, NULL, '', '', '', '', 34, 13, 158, 3, 3, 3.8, 3.75, 2.75),
(22, 'Muhammad Haris Maulana', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(23, 'Azfina Putri Anindita', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(24, '', '', '', '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `melamar`
--

CREATE TABLE IF NOT EXISTS `melamar` (
  `id_lamaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_kandidat` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `skor_kriteria1` float NOT NULL DEFAULT '0',
  `skor_kriteria2` float NOT NULL DEFAULT '0',
  `skor_kriteria3` float NOT NULL DEFAULT '0',
  `skor_kriteria4` float NOT NULL DEFAULT '0',
  `skor_kriteria5` float NOT NULL DEFAULT '0',
  `skor_kriteria6` float NOT NULL DEFAULT '0',
  `skor_kriteria7` float NOT NULL DEFAULT '0',
  `skor_kriteria8` float NOT NULL DEFAULT '0',
  `skor_kriteria9` float NOT NULL DEFAULT '0',
  `skor_kriteria10` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_lamaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `melamar`
--

INSERT INTO `melamar` (`id_lamaran`, `id_kandidat`, `id_jabatan`, `skor_kriteria1`, `skor_kriteria2`, `skor_kriteria3`, `skor_kriteria4`, `skor_kriteria5`, `skor_kriteria6`, `skor_kriteria7`, `skor_kriteria8`, `skor_kriteria9`, `skor_kriteria10`) VALUES
(1, 1, 1, 0.225135, 0.1762, 0.12729, 0.142857, 0.0791171, 0, 0, 0, 0, 0),
(2, 2, 1, 0.125039, 0.172467, 0.327961, 0.142857, 0.189484, 0, 0, 0, 0, 0),
(3, 3, 1, 0.120113, 0.148658, 0.116793, 0.142857, 0.652282, 0, 0, 0, 0, 0),
(4, 4, 1, 0.125039, 0.148658, 0.159339, 0.142857, 0.0791171, 0, 0, 0, 0, 0),
(5, 5, 2, 0.222222, 0, 0.0764893, 0.0929001, 0.138889, 0, 0.0833333, 0, 0, 0),
(6, 6, 2, 0.111111, 0, 0.391375, 0.0929001, 0.138889, 0, 0.0833333, 0, 0, 0),
(7, 7, 2, 0.111111, 0, 0.149689, 0.0929001, 0.138889, 0, 0.0833333, 0, 0, 0),
(8, 8, 2, 0.111111, 0, 0.0764893, 0.524474, 0.138889, 0, 0.0833333, 0, 0, 0),
(9, 9, 2, 0.111111, 0, 0.0764893, 0.0492063, 0.138889, 0, 0.0833333, 0, 0, 0),
(10, 10, 2, 0.111111, 0, 0.0764893, 0.0492063, 0.138889, 0, 0.416667, 0, 0, 0),
(11, 11, 2, 0.111111, 0, 0.0764893, 0.0492063, 0.138889, 0, 0.0833333, 0, 0, 0),
(12, 21, 1, 0.125039, 0.10292, 0.129322, 0.142857, 0, 0, 0, 0, 0, 0),
(13, 13, 2, 0.111111, 0, 0.0764893, 0.0492063, 0.0277778, 0, 0.0833333, 0, 0, 0),
(14, 12, 1, 0.139817, 0.119246, 0.0522067, 0.142857, 0, 0, 0, 0, 0, 0),
(15, 14, 1, 0.139817, 0.131851, 0.0870887, 0.142857, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_bobot`
--

CREATE TABLE IF NOT EXISTS `perbandingan_bobot` (
  `id_perbandingan_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(11) NOT NULL,
  `k1_2` float DEFAULT NULL,
  `k1_3` float DEFAULT NULL,
  `k1_4` float DEFAULT NULL,
  `k1_5` float DEFAULT NULL,
  `k1_6` float DEFAULT NULL,
  `k1_7` float DEFAULT NULL,
  `k1_8` float DEFAULT NULL,
  `k1_9` float DEFAULT NULL,
  `k1_10` float DEFAULT NULL,
  `k2_3` float DEFAULT NULL,
  `k2_4` float DEFAULT NULL,
  `k2_5` float DEFAULT NULL,
  `k2_6` float DEFAULT NULL,
  `k2_7` float DEFAULT NULL,
  `k2_8` float DEFAULT NULL,
  `k2_9` float DEFAULT NULL,
  `k2_10` float DEFAULT NULL,
  `k3_4` float DEFAULT NULL,
  `k3_5` float DEFAULT NULL,
  `k3_6` float DEFAULT NULL,
  `k3_7` float DEFAULT NULL,
  `k3_8` float DEFAULT NULL,
  `k3_9` float DEFAULT NULL,
  `k3_10` float DEFAULT NULL,
  `k4_5` float DEFAULT NULL,
  `k4_6` float DEFAULT NULL,
  `k4_7` float DEFAULT NULL,
  `k4_8` float DEFAULT NULL,
  `k4_9` float DEFAULT NULL,
  `k4_10` float DEFAULT NULL,
  `k5_6` float DEFAULT NULL,
  `k5_7` float DEFAULT NULL,
  `k5_8` float DEFAULT NULL,
  `k5_9` float DEFAULT NULL,
  `k5_10` float DEFAULT NULL,
  `k6_7` float DEFAULT NULL,
  `k6_8` float DEFAULT NULL,
  `k6_9` float DEFAULT NULL,
  `k6_10` float DEFAULT NULL,
  `k7_8` float DEFAULT NULL,
  `k7_9` float DEFAULT NULL,
  `k7_10` float DEFAULT NULL,
  `k8_9` float DEFAULT NULL,
  `k8_10` float DEFAULT NULL,
  `k9_10` float DEFAULT NULL,
  PRIMARY KEY (`id_perbandingan_bobot`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `perbandingan_bobot`
--

INSERT INTO `perbandingan_bobot` (`id_perbandingan_bobot`, `id_jabatan`, `k1_2`, `k1_3`, `k1_4`, `k1_5`, `k1_6`, `k1_7`, `k1_8`, `k1_9`, `k1_10`, `k2_3`, `k2_4`, `k2_5`, `k2_6`, `k2_7`, `k2_8`, `k2_9`, `k2_10`, `k3_4`, `k3_5`, `k3_6`, `k3_7`, `k3_8`, `k3_9`, `k3_10`, `k4_5`, `k4_6`, `k4_7`, `k4_8`, `k4_9`, `k4_10`, `k5_6`, `k5_7`, `k5_8`, `k5_9`, `k5_10`, `k6_7`, `k6_8`, `k6_9`, `k6_10`, `k7_8`, `k7_9`, `k7_10`, `k8_9`, `k8_10`, `k9_10`) VALUES
(40, 1, 4, 2, 3, 3, NULL, NULL, NULL, NULL, NULL, 0.5, 0.5, 2, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 2, NULL, 0.5, 3, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, 2, NULL, NULL, NULL, 0.5, NULL, 0.3, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_skor`
--

CREATE TABLE IF NOT EXISTS `perbandingan_skor` (
  `id_perbandingan_skor` int(11) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(11) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL,
  `kandidat1_2` float DEFAULT NULL,
  `kandidat1_3` float DEFAULT NULL,
  `kandidat1_4` float DEFAULT NULL,
  `kandidat1_5` float DEFAULT NULL,
  `kandidat1_6` float DEFAULT NULL,
  `kandidat1_7` float DEFAULT NULL,
  `kandidat1_8` float DEFAULT NULL,
  `kandidat1_9` float DEFAULT NULL,
  `kandidat1_10` float DEFAULT NULL,
  `kandidat1_11` float DEFAULT NULL,
  `kandidat1_12` float DEFAULT NULL,
  `kandidat1_13` float DEFAULT NULL,
  `kandidat1_14` float DEFAULT NULL,
  `kandidat1_15` float DEFAULT NULL,
  `kandidat1_16` float DEFAULT NULL,
  `kandidat1_17` float DEFAULT NULL,
  `kandidat1_18` float DEFAULT NULL,
  `kandidat1_19` float DEFAULT NULL,
  `kandidat1_20` float DEFAULT NULL,
  `kandidat2_3` float DEFAULT NULL,
  `kandidat2_4` float DEFAULT NULL,
  `kandidat2_5` float DEFAULT NULL,
  `kandidat2_6` float DEFAULT NULL,
  `kandidat2_7` float DEFAULT NULL,
  `kandidat2_8` float DEFAULT NULL,
  `kandidat2_9` float DEFAULT NULL,
  `kandidat2_10` float DEFAULT NULL,
  `kandidat2_11` float DEFAULT NULL,
  `kandidat2_12` float DEFAULT NULL,
  `kandidat2_13` float DEFAULT NULL,
  `kandidat2_14` float DEFAULT NULL,
  `kandidat2_15` float DEFAULT NULL,
  `kandidat2_16` float DEFAULT NULL,
  `kandidat2_17` float DEFAULT NULL,
  `kandidat2_18` float DEFAULT NULL,
  `kandidat2_19` float DEFAULT NULL,
  `kandidat2_20` float DEFAULT NULL,
  `kandidat3_4` float DEFAULT NULL,
  `kandidat3_5` float DEFAULT NULL,
  `kandidat3_6` float DEFAULT NULL,
  `kandidat3_7` float DEFAULT NULL,
  `kandidat3_8` float DEFAULT NULL,
  `kandidat3_9` float DEFAULT NULL,
  `kandidat3_10` float DEFAULT NULL,
  `kandidat3_11` float DEFAULT NULL,
  `kandidat3_12` float DEFAULT NULL,
  `kandidat3_13` float DEFAULT NULL,
  `kandidat3_14` float DEFAULT NULL,
  `kandidat3_15` float DEFAULT NULL,
  `kandidat3_16` float DEFAULT NULL,
  `kandidat3_17` float DEFAULT NULL,
  `kandidat3_18` float DEFAULT NULL,
  `kandidat3_19` float DEFAULT NULL,
  `kandidat3_20` float DEFAULT NULL,
  `kandidat4_5` float DEFAULT NULL,
  `kandidat4_6` float DEFAULT NULL,
  `kandidat4_7` float DEFAULT NULL,
  `kandidat4_8` float DEFAULT NULL,
  `kandidat4_9` float DEFAULT NULL,
  `kandidat4_10` float DEFAULT NULL,
  `kandidat4_11` float DEFAULT NULL,
  `kandidat4_12` float DEFAULT NULL,
  `kandidat4_13` float DEFAULT NULL,
  `kandidat4_14` float DEFAULT NULL,
  `kandidat4_15` float DEFAULT NULL,
  `kandidat4_16` float DEFAULT NULL,
  `kandidat4_17` float DEFAULT NULL,
  `kandidat4_18` float DEFAULT NULL,
  `kandidat4_19` float DEFAULT NULL,
  `kandidat4_20` float DEFAULT NULL,
  `kandidat5_6` float DEFAULT NULL,
  `kandidat5_7` float DEFAULT NULL,
  `kandidat5_8` float DEFAULT NULL,
  `kandidat5_9` float DEFAULT NULL,
  `kandidat5_10` float DEFAULT NULL,
  `kandidat5_11` float DEFAULT NULL,
  `kandidat5_12` float DEFAULT NULL,
  `kandidat5_13` float DEFAULT NULL,
  `kandidat5_14` float DEFAULT NULL,
  `kandidat5_15` float DEFAULT NULL,
  `kandidat5_16` float DEFAULT NULL,
  `kandidat5_17` float DEFAULT NULL,
  `kandidat5_18` float DEFAULT NULL,
  `kandidat5_19` float DEFAULT NULL,
  `kandidat5_20` float DEFAULT NULL,
  `kandidat6_7` float DEFAULT NULL,
  `kandidat6_8` float DEFAULT NULL,
  `kandidat6_9` float DEFAULT NULL,
  `kandidat6_10` float DEFAULT NULL,
  `kandidat6_11` float DEFAULT NULL,
  `kandidat6_12` float DEFAULT NULL,
  `kandidat6_13` float DEFAULT NULL,
  `kandidat6_14` float DEFAULT NULL,
  `kandidat6_15` float DEFAULT NULL,
  `kandidat6_16` float DEFAULT NULL,
  `kandidat6_17` float DEFAULT NULL,
  `kandidat6_18` float DEFAULT NULL,
  `kandidat6_19` float DEFAULT NULL,
  `kandidat6_20` float DEFAULT NULL,
  `kandidat7_8` float DEFAULT NULL,
  `kandidat7_9` float DEFAULT NULL,
  `kandidat7_10` float DEFAULT NULL,
  `kandidat7_11` float DEFAULT NULL,
  `kandidat7_12` float DEFAULT NULL,
  `kandidat7_13` float DEFAULT NULL,
  `kandidat7_14` float DEFAULT NULL,
  `kandidat7_15` float DEFAULT NULL,
  `kandidat7_16` float DEFAULT NULL,
  `kandidat7_17` float DEFAULT NULL,
  `kandidat7_18` float DEFAULT NULL,
  `kandidat7_19` float DEFAULT NULL,
  `kandidat7_20` float DEFAULT NULL,
  `kandidat8_9` float DEFAULT NULL,
  `kandidat8_10` float DEFAULT NULL,
  `kandidat8_11` float DEFAULT NULL,
  `kandidat8_12` float DEFAULT NULL,
  `kandidat8_13` float DEFAULT NULL,
  `kandidat8_14` float DEFAULT NULL,
  `kandidat8_15` float DEFAULT NULL,
  `kandidat8_16` float DEFAULT NULL,
  `kandidat8_17` float DEFAULT NULL,
  `kandidat8_18` float DEFAULT NULL,
  `kandidat8_19` float DEFAULT NULL,
  `kandidat8_20` float DEFAULT NULL,
  `kandidat9_10` float DEFAULT NULL,
  `kandidat9_11` float DEFAULT NULL,
  `kandidat9_12` float DEFAULT NULL,
  `kandidat9_13` float DEFAULT NULL,
  `kandidat9_14` float DEFAULT NULL,
  `kandidat9_15` float DEFAULT NULL,
  `kandidat9_16` float DEFAULT NULL,
  `kandidat9_17` float DEFAULT NULL,
  `kandidat9_18` float DEFAULT NULL,
  `kandidat9_19` float DEFAULT NULL,
  `kandidat9_20` float DEFAULT NULL,
  `kandidat10_11` float DEFAULT NULL,
  `kandidat10_12` float DEFAULT NULL,
  `kandidat10_13` float DEFAULT NULL,
  `kandidat10_14` float DEFAULT NULL,
  `kandidat10_15` float DEFAULT NULL,
  `kandidat10_16` float DEFAULT NULL,
  `kandidat10_17` float DEFAULT NULL,
  `kandidat10_18` float DEFAULT NULL,
  `kandidat10_19` float DEFAULT NULL,
  `kandidat10_20` float DEFAULT NULL,
  `kandidat11_12` float DEFAULT NULL,
  `kandidat11_13` float DEFAULT NULL,
  `kandidat11_14` float DEFAULT NULL,
  `kandidat11_15` float DEFAULT NULL,
  `kandidat11_16` float DEFAULT NULL,
  `kandidat11_17` float DEFAULT NULL,
  `kandidat11_18` float DEFAULT NULL,
  `kandidat11_19` float DEFAULT NULL,
  `kandidat11_20` float DEFAULT NULL,
  `kandidat12_13` float DEFAULT NULL,
  `kandidat12_14` float DEFAULT NULL,
  `kandidat12_15` float DEFAULT NULL,
  `kandidat12_16` float DEFAULT NULL,
  `kandidat12_17` float DEFAULT NULL,
  `kandidat12_18` float DEFAULT NULL,
  `kandidat12_19` float DEFAULT NULL,
  `kandidat12_20` float DEFAULT NULL,
  `kandidat13_14` float DEFAULT NULL,
  `kandidat13_15` float DEFAULT NULL,
  `kandidat13_16` float DEFAULT NULL,
  `kandidat13_17` float DEFAULT NULL,
  `kandidat13_18` float DEFAULT NULL,
  `kandidat13_19` float DEFAULT NULL,
  `kandidat13_20` float DEFAULT NULL,
  `kandidat14_15` float DEFAULT NULL,
  `kandidat14_16` float DEFAULT NULL,
  `kandidat14_17` float DEFAULT NULL,
  `kandidat14_18` float DEFAULT NULL,
  `kandidat14_19` float DEFAULT NULL,
  `kandidat14_20` float DEFAULT NULL,
  `kandidat15_16` float DEFAULT NULL,
  `kandidat15_17` float DEFAULT NULL,
  `kandidat15_18` float DEFAULT NULL,
  `kandidat15_19` float DEFAULT NULL,
  `kandidat15_20` float DEFAULT NULL,
  `kandidat16_17` float DEFAULT NULL,
  `kandidat16_18` float DEFAULT NULL,
  `kandidat16_19` float DEFAULT NULL,
  `kandidat16_20` float DEFAULT NULL,
  `kandidat17_18` float DEFAULT NULL,
  `kandidat17_19` float DEFAULT NULL,
  `kandidat17_20` float DEFAULT NULL,
  `kandidat18_19` float DEFAULT NULL,
  `kandidat18_20` float DEFAULT NULL,
  `kandidat19_20` float DEFAULT NULL,
  PRIMARY KEY (`id_perbandingan_skor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=188 ;

--
-- Dumping data for table `perbandingan_skor`
--

INSERT INTO `perbandingan_skor` (`id_perbandingan_skor`, `id_jabatan`, `nama_kriteria`, `kandidat1_2`, `kandidat1_3`, `kandidat1_4`, `kandidat1_5`, `kandidat1_6`, `kandidat1_7`, `kandidat1_8`, `kandidat1_9`, `kandidat1_10`, `kandidat1_11`, `kandidat1_12`, `kandidat1_13`, `kandidat1_14`, `kandidat1_15`, `kandidat1_16`, `kandidat1_17`, `kandidat1_18`, `kandidat1_19`, `kandidat1_20`, `kandidat2_3`, `kandidat2_4`, `kandidat2_5`, `kandidat2_6`, `kandidat2_7`, `kandidat2_8`, `kandidat2_9`, `kandidat2_10`, `kandidat2_11`, `kandidat2_12`, `kandidat2_13`, `kandidat2_14`, `kandidat2_15`, `kandidat2_16`, `kandidat2_17`, `kandidat2_18`, `kandidat2_19`, `kandidat2_20`, `kandidat3_4`, `kandidat3_5`, `kandidat3_6`, `kandidat3_7`, `kandidat3_8`, `kandidat3_9`, `kandidat3_10`, `kandidat3_11`, `kandidat3_12`, `kandidat3_13`, `kandidat3_14`, `kandidat3_15`, `kandidat3_16`, `kandidat3_17`, `kandidat3_18`, `kandidat3_19`, `kandidat3_20`, `kandidat4_5`, `kandidat4_6`, `kandidat4_7`, `kandidat4_8`, `kandidat4_9`, `kandidat4_10`, `kandidat4_11`, `kandidat4_12`, `kandidat4_13`, `kandidat4_14`, `kandidat4_15`, `kandidat4_16`, `kandidat4_17`, `kandidat4_18`, `kandidat4_19`, `kandidat4_20`, `kandidat5_6`, `kandidat5_7`, `kandidat5_8`, `kandidat5_9`, `kandidat5_10`, `kandidat5_11`, `kandidat5_12`, `kandidat5_13`, `kandidat5_14`, `kandidat5_15`, `kandidat5_16`, `kandidat5_17`, `kandidat5_18`, `kandidat5_19`, `kandidat5_20`, `kandidat6_7`, `kandidat6_8`, `kandidat6_9`, `kandidat6_10`, `kandidat6_11`, `kandidat6_12`, `kandidat6_13`, `kandidat6_14`, `kandidat6_15`, `kandidat6_16`, `kandidat6_17`, `kandidat6_18`, `kandidat6_19`, `kandidat6_20`, `kandidat7_8`, `kandidat7_9`, `kandidat7_10`, `kandidat7_11`, `kandidat7_12`, `kandidat7_13`, `kandidat7_14`, `kandidat7_15`, `kandidat7_16`, `kandidat7_17`, `kandidat7_18`, `kandidat7_19`, `kandidat7_20`, `kandidat8_9`, `kandidat8_10`, `kandidat8_11`, `kandidat8_12`, `kandidat8_13`, `kandidat8_14`, `kandidat8_15`, `kandidat8_16`, `kandidat8_17`, `kandidat8_18`, `kandidat8_19`, `kandidat8_20`, `kandidat9_10`, `kandidat9_11`, `kandidat9_12`, `kandidat9_13`, `kandidat9_14`, `kandidat9_15`, `kandidat9_16`, `kandidat9_17`, `kandidat9_18`, `kandidat9_19`, `kandidat9_20`, `kandidat10_11`, `kandidat10_12`, `kandidat10_13`, `kandidat10_14`, `kandidat10_15`, `kandidat10_16`, `kandidat10_17`, `kandidat10_18`, `kandidat10_19`, `kandidat10_20`, `kandidat11_12`, `kandidat11_13`, `kandidat11_14`, `kandidat11_15`, `kandidat11_16`, `kandidat11_17`, `kandidat11_18`, `kandidat11_19`, `kandidat11_20`, `kandidat12_13`, `kandidat12_14`, `kandidat12_15`, `kandidat12_16`, `kandidat12_17`, `kandidat12_18`, `kandidat12_19`, `kandidat12_20`, `kandidat13_14`, `kandidat13_15`, `kandidat13_16`, `kandidat13_17`, `kandidat13_18`, `kandidat13_19`, `kandidat13_20`, `kandidat14_15`, `kandidat14_16`, `kandidat14_17`, `kandidat14_18`, `kandidat14_19`, `kandidat14_20`, `kandidat15_16`, `kandidat15_17`, `kandidat15_18`, `kandidat15_19`, `kandidat15_20`, `kandidat16_17`, `kandidat16_18`, `kandidat16_19`, `kandidat16_20`, `kandidat17_18`, `kandidat17_19`, `kandidat17_20`, `kandidat18_19`, `kandidat18_20`, `kandidat19_20`) VALUES
(62, 2, 'nama_kriteria1', 2, 2, 2, 2, 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 2, 'nama_kriteria3', 0.2, 0.5, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 5, 5, 5, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 2, 'nama_kriteria4', 1, 1, 0.14, 2, 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0.14, 2, 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.14, 2, 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, 9, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 2, 'nama_kriteria7', 1, 1, 1, 1, 0.2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0.2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0.2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0.2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 1, 'nama_kriteria1', 2, 3, 2, 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(183, 1, 'nama_kriteria2', 0.5, 0.5, 0.5, 4, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 3, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(184, 1, 'nama_kriteria3', 1, 0.5, 0.2, 2, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 5, 8, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0.5, 0.7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.6, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(186, 1, 'nama_kriteria4', 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 2, 'nama_kriteria5', 1, 1, 1, 1, 1, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posisi_pekerjaan`
--

CREATE TABLE IF NOT EXISTS `posisi_pekerjaan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL,
  `keterangan_jabatan` varchar(50) NOT NULL,
  `nama_kriteria1` varchar(20) DEFAULT NULL,
  `bobot_kriteria1` float NOT NULL DEFAULT '0',
  `nama_kriteria2` varchar(20) DEFAULT NULL,
  `bobot_kriteria2` float NOT NULL DEFAULT '0',
  `nama_kriteria3` varchar(20) DEFAULT NULL,
  `bobot_kriteria3` float NOT NULL DEFAULT '0',
  `nama_kriteria4` varchar(20) DEFAULT NULL,
  `bobot_kriteria4` float NOT NULL DEFAULT '0',
  `nama_kriteria5` varchar(20) DEFAULT NULL,
  `bobot_kriteria5` float NOT NULL DEFAULT '0',
  `nama_kriteria6` varchar(20) DEFAULT NULL,
  `bobot_kriteria6` float NOT NULL DEFAULT '0',
  `nama_kriteria7` varchar(20) DEFAULT NULL,
  `bobot_kriteria7` float NOT NULL DEFAULT '0',
  `nama_kriteria8` varchar(20) DEFAULT NULL,
  `bobot_kriteria8` float NOT NULL DEFAULT '0',
  `nama_kriteria9` varchar(20) DEFAULT NULL,
  `bobot_kriteria9` float NOT NULL DEFAULT '0',
  `nama_kriteria10` varchar(20) DEFAULT NULL,
  `bobot_kriteria10` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posisi_pekerjaan`
--

INSERT INTO `posisi_pekerjaan` (`id_jabatan`, `nama_jabatan`, `keterangan_jabatan`, `nama_kriteria1`, `bobot_kriteria1`, `nama_kriteria2`, `bobot_kriteria2`, `nama_kriteria3`, `bobot_kriteria3`, `nama_kriteria4`, `bobot_kriteria4`, `nama_kriteria5`, `bobot_kriteria5`, `nama_kriteria6`, `bobot_kriteria6`, `nama_kriteria7`, `bobot_kriteria7`, `nama_kriteria8`, `bobot_kriteria8`, `nama_kriteria9`, `bobot_kriteria9`, `nama_kriteria10`, `bobot_kriteria10`) VALUES
(1, 'Posisi Pekerjaan 1', 'Ini deskripsi pekerjaan', 'kriteria 1', 0.471496, 'kriteria 2', 0.108259, 'kriteria 3', 0.254979, 'kriteria 4', 0.165267, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0),
(2, 'percobaan 2', 'deskripsi 2', 'Knowledge', 0.190497, '', 0, 'Technical Skill', 0.36704, 'Experience', 0.0707709, 'Personality', 0.176544, '', 0, 'Communication Skill', 0.195148, '', 0, '', 0, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
