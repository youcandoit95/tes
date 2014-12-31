-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2014 at 06:46 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_pinet`
--
CREATE DATABASE IF NOT EXISTS `db_pinet` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_pinet`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateSequence`(name VARCHAR(30), inc INT, maxv INT)
BEGIN
     -- Add the new sequence
     INSERT INTO db_pinet.sequence_data
        (sequence_name, sequence_increment, sequence_max_value)
     VALUES
         (name, inc, maxv)
      ;
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DropSequence`(vname VARCHAR(30))
BEGIN
     -- Drop the sequence
     DELETE FROM sequence_data WHERE sequence_name = vname;  
  END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `nextval`(`seq_name` VARCHAR(100)) RETURNS bigint(21)
    MODIFIES SQL DATA
BEGIN
    DECLARE cur_val bigint(21);
 
    
        UPDATE
            sequence_data
        SET
            sequence_cur_value = IF (
                sequence_cur_value = sequence_max_value,
                IF (
                    sequence_cycle = TRUE,
                    sequence_min_value,
                    NULL
                ),
                sequence_cur_value + sequence_increment
            )
        WHERE
            sequence_name = seq_name
        ;
        
        SELECT
            sequence_cur_value INTO cur_val
        FROM
            sequence_data
        WHERE
            sequence_name = seq_name
        ;
    
 
    RETURN cur_val;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bug_report`
--

CREATE TABLE IF NOT EXISTS `bug_report` (
  `bug_id` int(11) NOT NULL AUTO_INCREMENT,
  `karyawan_nik` varchar(25) NOT NULL,
  `bug_desc` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`bug_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bug_report`
--

INSERT INTO `bug_report` (`bug_id`, `karyawan_nik`, `bug_desc`) VALUES
(1, '11.073p', 'tregre'),
(2, '11.073p', 'gfgfdh');

-- --------------------------------------------------------

--
-- Table structure for table `hcis_cuti_history`
--

CREATE TABLE IF NOT EXISTS `hcis_cuti_history` (
  `cuti_history_no` varchar(25) NOT NULL,
  `dcuti_no_ref` varchar(25) DEFAULT NULL,
  `mcuti_no_ref` varchar(25) DEFAULT NULL,
  `cuti_karyawan_nik` varchar(25) NOT NULL,
  `cuti_history_status` int(2) NOT NULL,
  `tambah_cuti_period` date DEFAULT NULL,
  `cuti_period_year` varchar(4) NOT NULL,
  `cuti_history_ket` text CHARACTER SET latin1 NOT NULL,
  `cuti_history_jumlah` int(2) NOT NULL,
  `cuti_available` int(2) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(25) NOT NULL,
  PRIMARY KEY (`cuti_history_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hcis_cuti_history`
--

INSERT INTO `hcis_cuti_history` (`cuti_history_no`, `dcuti_no_ref`, `mcuti_no_ref`, `cuti_karyawan_nik`, `cuti_history_status`, `tambah_cuti_period`, `cuti_period_year`, `cuti_history_ket`, `cuti_history_jumlah`, `cuti_available`, `created_date`, `created_by`) VALUES
('000052221214', '', '00003914', '11.070p', 888, '2014-12-01', '2014', 'tambah cuti berjalan', 1, 1, '2014-12-22 03:07:07', 'SYSTEM'),
('000054221214', '', '00004114', '11.073p', 888, '2014-12-01', '2014', 'tambah cuti berjalan', 1, 1, '2014-12-22 03:07:08', 'SYSTEM'),
('000055221214', '', '00004214', '11.072p', 88, NULL, '2014', 'insert oleh hrd', 11, 11, '2014-12-22 03:08:20', 'SYSADMIN'),
('000056221214', '', '00004314', '11.072p', 88, NULL, '2013', 'insert oleh hrd', 3, 3, '2014-12-22 03:08:26', 'SYSADMIN'),
('000057221214', '', '00004214', '11.072p', 888, '2014-12-01', '2014', 'tambah cuti berjalan', 1, 12, '2014-12-22 03:08:49', 'SYSTEM'),
('000058231214', '', '00004414', '11.060p', 888, '2014-12-01', '2014', 'tambah cuti berjalan', 1, 1, '2014-12-23 07:40:30', 'SYSTEM'),
('000059311214', '00001414', '00004314', '11.072p', 1, NULL, '2013', 'tesss ', 3, 3, '2014-12-31 08:22:06', '11.072p'),
('000060311214', '00001414', '00004314', '11.072p', 6, NULL, '2013', 'cancel by user', 3, 3, '2014-12-31 10:29:57', '11.072p'),
('000061311214', '00001514', '00004314', '11.072p', 1, NULL, '2013', 'testtt', 2, 3, '2014-12-31 10:32:07', '11.072p'),
('000062311214', '00001514', '00004314', '11.072p', 2, NULL, '2013', 'approve up level', 2, 3, '2014-12-31 10:36:15', '11.072p'),
('000063311214', '00001614', '00004214', '11.072p', 1, NULL, '2014', 'sfds', 2, 12, '2014-12-31 10:44:06', '11.072p'),
('000064311214', '00001614', '00004214', '11.072p', 3, NULL, '2014', 'tess reject his', 2, 12, '2014-12-31 10:44:38', '11.060p'),
('000065311214', '00001514', '', '', 4, NULL, '', 'approve cuti hrd', 0, -2, '2014-12-31 17:05:39', '11.070p'),
('000066311214', '00001714', '00004314', '11.072p', 1, NULL, '2013', 'sdafsd', 3, 3, '2014-12-31 17:11:07', '11.072p'),
('000067311214', '00001714', '00004314', '11.072p', 2, NULL, '2013', 'approve up level', 3, 3, '2014-12-31 17:12:44', '11.060p'),
('000068311214', '00001714', '00004314', '11.072p', 4, NULL, '2013', 'approve cuti hrd', 3, 0, '2014-12-31 17:13:46', '11.070p'),
('000069311214', '00001814', '00004214', '11.072p', 1, NULL, '2014', 'gdfhfdh', 3, 12, '2014-12-31 17:39:43', '11.072p'),
('000070311214', '00001814', '00004214', '11.072p', 2, NULL, '2014', 'approve up level', 3, 12, '2014-12-31 17:40:01', '11.060p'),
('000071311214', '00001814', '00004214', '11.072p', 5, NULL, '2014', 'fhgfh', 3, 12, '2014-12-31 17:40:48', '11.070p');

-- --------------------------------------------------------

--
-- Table structure for table `hcis_md_bagian`
--

CREATE TABLE IF NOT EXISTS `hcis_md_bagian` (
  `bagian_no` int(11) NOT NULL AUTO_INCREMENT,
  `bagian_div_no` int(11) NOT NULL,
  `bagian_dept_no` int(11) NOT NULL,
  `bagian_name` varchar(45) NOT NULL,
  `bagian_active` int(2) NOT NULL DEFAULT '1',
  `bagian_deleted` int(2) NOT NULL DEFAULT '99',
  PRIMARY KEY (`bagian_no`),
  KEY `fk_hcis_md_bagian_hcis_md_div1_idx` (`bagian_div_no`),
  KEY `fk_hcis_md_bagian_hcis_md_dept1_idx` (`bagian_dept_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `hcis_md_bagian`
--

INSERT INTO `hcis_md_bagian` (`bagian_no`, `bagian_div_no`, `bagian_dept_no`, `bagian_name`, `bagian_active`, `bagian_deleted`) VALUES
(1, 1, 1, 'SYSTEM', 1, 99),
(2, 1, 1, 'ORACLE DATABASE', 1, 99),
(3, 1, 1, 'SYSTEM SAP', 1, 99),
(4, 1, 1, 'SUPPORT', 1, 99),
(88, 88, 88, 'SYSTEM ADMINISTRATOR', 1, 99),
(99, 99, 99, 'N/A', 1, 99);

-- --------------------------------------------------------

--
-- Table structure for table `hcis_md_cuti_type`
--

CREATE TABLE IF NOT EXISTS `hcis_md_cuti_type` (
  `cuti_type_no` int(11) NOT NULL AUTO_INCREMENT,
  `cuti_type_name` varchar(45) NOT NULL,
  `cuti_type_desc` text NOT NULL,
  `cuti_lupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cuti_lupdated_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cuti_type_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hcis_md_cuti_type`
--

INSERT INTO `hcis_md_cuti_type` (`cuti_type_no`, `cuti_type_name`, `cuti_type_desc`, `cuti_lupdated`, `cuti_lupdated_by`) VALUES
(1, 'Sakit', 'Sakit tanpa surat dokter selama 2 hari', '2014-12-09 06:25:59', NULL),
(2, 'Alpha', 'Tanpa Keterangan', '2014-12-09 06:26:10', NULL),
(3, 'Izin', 'Keperluan Pribadi', '2014-12-09 06:26:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hcis_md_dept`
--

CREATE TABLE IF NOT EXISTS `hcis_md_dept` (
  `dept_no` int(11) NOT NULL AUTO_INCREMENT,
  `dept_div_no` int(11) NOT NULL,
  `dept_name` varchar(45) NOT NULL,
  `dept_active` int(2) NOT NULL DEFAULT '1',
  `dept_deleted` int(2) NOT NULL DEFAULT '99',
  PRIMARY KEY (`dept_no`),
  KEY `fk_hcis_md_dept_hcis_md_div1_idx` (`dept_div_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `hcis_md_dept`
--

INSERT INTO `hcis_md_dept` (`dept_no`, `dept_div_no`, `dept_name`, `dept_active`, `dept_deleted`) VALUES
(1, 1, 'TECHNOLOGY', 1, 99),
(2, 1, 'BUSINESS DEVELOPMENT', 1, 99),
(3, 1, 'PROJECT MANAGER', 1, 99),
(4, 2, 'COMMERCIAL SALES', 1, 99),
(5, 2, 'ENTERPRISE SALES', 1, 99),
(6, 2, 'EARTH RESOURCES SALES', 1, 99),
(7, 3, 'FINANCE & ACCOUNTING', 1, 99),
(8, 3, 'HELPDESK & WAREHOUSE', 1, 99),
(9, 3, 'HR & GA', 1, 99),
(88, 88, 'SYSTEM ADMINISTRATOR', 1, 99),
(99, 99, 'N/A', 1, 99);

-- --------------------------------------------------------

--
-- Table structure for table `hcis_md_div`
--

CREATE TABLE IF NOT EXISTS `hcis_md_div` (
  `div_no` int(11) NOT NULL AUTO_INCREMENT,
  `div_name` varchar(20) NOT NULL,
  `div_active` int(2) NOT NULL DEFAULT '1',
  `div_deleted` int(2) NOT NULL DEFAULT '99',
  PRIMARY KEY (`div_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `hcis_md_div`
--

INSERT INTO `hcis_md_div` (`div_no`, `div_name`, `div_active`, `div_deleted`) VALUES
(1, 'TECHNICAL', 1, 99),
(2, 'SALES', 1, 99),
(3, 'OPERATIONAL', 1, 99),
(88, 'SYSADMIN', 1, 99),
(99, 'N/A', 1, 99);

-- --------------------------------------------------------

--
-- Table structure for table `hcis_md_jabatan`
--

CREATE TABLE IF NOT EXISTS `hcis_md_jabatan` (
  `jabatan_no` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan_name` varchar(45) NOT NULL,
  `jabatan_job_desc` text,
  `jabatan_kpi` text,
  `jabatan_lupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jabatan_lupdated_by` varchar(20) NOT NULL,
  `jabatan_deleted` int(2) NOT NULL DEFAULT '99',
  PRIMARY KEY (`jabatan_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `hcis_md_jabatan`
--

INSERT INTO `hcis_md_jabatan` (`jabatan_no`, `jabatan_name`, `jabatan_job_desc`, `jabatan_kpi`, `jabatan_lupdated`, `jabatan_lupdated_by`, `jabatan_deleted`) VALUES
(1, 'TOP_DIRECTOR', NULL, NULL, '2014-12-09 06:50:14', '', 99),
(2, 'DIRECTOR', NULL, NULL, '2014-12-09 06:50:17', '', 99),
(3, 'GENERAL MANAGER', NULL, NULL, '2014-12-09 06:50:20', '', 99),
(4, 'MANAGER', NULL, NULL, '2014-12-09 06:50:22', '', 99),
(5, 'LEADER', NULL, NULL, '2014-12-09 06:50:24', '', 99),
(6, 'STAFF', NULL, NULL, '2014-12-09 06:50:26', '', 99),
(88, 'SYSADMIN', 'SYSTEM ADMINISTRATOR', NULL, '2014-12-09 06:49:12', '', 99);

-- --------------------------------------------------------

--
-- Table structure for table `hcis_md_karyawan`
--

CREATE TABLE IF NOT EXISTS `hcis_md_karyawan` (
  `karyawan_nik` varchar(20) NOT NULL,
  `karyawan_password` varchar(45) NOT NULL,
  `karyawan_div_no` int(11) NOT NULL,
  `karyawan_dept_no` int(11) NOT NULL DEFAULT '99',
  `karyawan_bagian_no` int(11) NOT NULL DEFAULT '99',
  `karyawan_fullname` varchar(45) NOT NULL,
  `karyawan_tanggal_lahir` date DEFAULT NULL,
  `karyawan_jabatan_no` int(11) NOT NULL,
  `karyawan_address` text NOT NULL,
  `karyawan_phone1` varchar(20) NOT NULL,
  `karyawan_phone2` varchar(20) DEFAULT NULL,
  `karyawan_email` varchar(45) NOT NULL,
  `karyawan_get_cuti` int(2) NOT NULL DEFAULT '99',
  `karyawan_created_by` varchar(20) DEFAULT NULL,
  `karyawan_created_date` datetime NOT NULL,
  `karyawan_deleted` int(2) NOT NULL DEFAULT '99',
  `karyawan_lupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `karyawan_lupdated_by` varchar(20) DEFAULT NULL,
  `get_cuti_lupdated` datetime NOT NULL,
  PRIMARY KEY (`karyawan_nik`),
  KEY `fk_md_karyawan_md_jabatan_idx` (`karyawan_jabatan_no`),
  KEY `fk_hcis_md_karyawan_hcis_md_div1_idx` (`karyawan_div_no`),
  KEY `fk_hcis_md_karyawan_hcis_md_dept1_idx` (`karyawan_dept_no`),
  KEY `fk_hcis_md_karyawan_hcis_md_bagian1_idx` (`karyawan_bagian_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hcis_md_karyawan`
--

INSERT INTO `hcis_md_karyawan` (`karyawan_nik`, `karyawan_password`, `karyawan_div_no`, `karyawan_dept_no`, `karyawan_bagian_no`, `karyawan_fullname`, `karyawan_tanggal_lahir`, `karyawan_jabatan_no`, `karyawan_address`, `karyawan_phone1`, `karyawan_phone2`, `karyawan_email`, `karyawan_get_cuti`, `karyawan_created_by`, `karyawan_created_date`, `karyawan_deleted`, `karyawan_lupdated`, `karyawan_lupdated_by`, `get_cuti_lupdated`) VALUES
('11.060p', '55f6eb3e3aadac68ae5d466ee81b3c50', 1, 99, 99, 'Elven', '2014-12-23', 3, 'jl aaaa', '43464576587', '', 'dfgfd@mail.com', 1, 'SYSADMIN', '2014-12-23 14:39:54', 99, '2014-12-23 07:40:12', NULL, '0000-00-00 00:00:00'),
('11.070p', '55f6eb3e3aadac68ae5d466ee81b3c50', 3, 9, 0, 'Selvi', '2014-12-21', 4, 'fsdfdsgfd', '34543654', '', 'gfhgfh@mail.com', 1, 'SYSADMIN', '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35', NULL, '0000-00-00 00:00:00'),
('11.072p', 'b239cbf229470510d61cba41a5a39239', 1, 1, 0, 'Arselan', '2014-12-21', 4, 'gdfgdfhd', '45476657658', '', 'fggdg@mail.com', 1, 'SYSADMIN', '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58', NULL, '0000-00-00 00:00:00'),
('11.073p', 'b239cbf229470510d61cba41a5a39239', 1, 1, 4, 'yansen', '2014-12-21', 6, 'gfgfdg', '53645657', '', 'fghf@mail.com', 1, 'SYSADMIN', '2014-12-21 17:18:36', 99, '2014-12-21 10:18:53', NULL, '0000-00-00 00:00:00'),
('11.074p', '39f56d4c0672953c477702fc69fb6bbf', 1, 1, 2, 'Bojong', '2014-12-22', 6, 'fdsggfdg', '434535465476', '', 'fdgd@gmail.com', 99, 'SYSADMIN', '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16', NULL, '0000-00-00 00:00:00'),
('11.080p', '6aec04c2b32f6e46e9a4d9fc3f49c947', 3, 99, 99, 'Jefrrey GM', '2014-12-24', 3, 'tesss', '787565654', '', 'jjgh@mail.com', 99, 'SYSADMIN', '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22', NULL, '0000-00-00 00:00:00'),
('SYSADMIN', '55f6eb3e3aadac68ae5d466ee81b3c50', 88, 88, 88, 'SYSTEM ADMINISTRATOR', NULL, 88, 'INTILAND TOWER', '577998877', NULL, 'admin@prima-integrasi.co.id', 99, 'SYSADMIN', '2014-12-09 13:35:34', 99, '2014-12-09 07:07:43', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hcis_trx_absen`
--

CREATE TABLE IF NOT EXISTS `hcis_trx_absen` (
  `absen_no` varchar(25) NOT NULL,
  `absen_date` date NOT NULL,
  `absen_karyawan_nik` varchar(20) NOT NULL,
  `absen_status` int(2) NOT NULL DEFAULT '99',
  `absen_rcuti_no` varchar(25) DEFAULT NULL,
  `absen_punch_in_time` datetime DEFAULT NULL,
  `pi_late_flag` int(2) NOT NULL DEFAULT '99',
  `pi_late_reason` text,
  `pi_late_read_up_level` datetime DEFAULT NULL,
  `late_read_up_level_by` varchar(20) DEFAULT NULL,
  `absen_punch_out_time` datetime DEFAULT NULL,
  `po_early_flag` int(2) NOT NULL DEFAULT '99',
  `po_early_time` datetime DEFAULT NULL,
  `po_early_reason` text,
  `po_early_read_up_level` datetime DEFAULT NULL,
  `early_read_up_level_by` varchar(20) DEFAULT NULL,
  `po_early_approve_up_level` int(2) DEFAULT '99',
  `reject_up_level_reason` text NOT NULL,
  `approve_up_level_date` datetime DEFAULT NULL,
  `approve_up_level_by` varchar(20) DEFAULT NULL,
  `po_early_read_hrd` datetime DEFAULT NULL,
  `early_read_hrd_by` varchar(20) DEFAULT NULL,
  `po_early_approve_hrd` int(2) DEFAULT '99',
  `reject_hrd_reason` text NOT NULL,
  `approve_hrd_date` datetime DEFAULT NULL,
  `approve_hrd_by` varchar(20) DEFAULT NULL,
  `absen_created_date` datetime NOT NULL,
  `absen_deleted` int(2) DEFAULT '99',
  `absen_lupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`absen_date`,`absen_karyawan_nik`),
  UNIQUE KEY `absen_no` (`absen_no`),
  KEY `fk_trx_absen_md_karyawan1_idx` (`absen_karyawan_nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hcis_trx_absen`
--

INSERT INTO `hcis_trx_absen` (`absen_no`, `absen_date`, `absen_karyawan_nik`, `absen_status`, `absen_rcuti_no`, `absen_punch_in_time`, `pi_late_flag`, `pi_late_reason`, `pi_late_read_up_level`, `late_read_up_level_by`, `absen_punch_out_time`, `po_early_flag`, `po_early_time`, `po_early_reason`, `po_early_read_up_level`, `early_read_up_level_by`, `po_early_approve_up_level`, `reject_up_level_reason`, `approve_up_level_date`, `approve_up_level_by`, `po_early_read_hrd`, `early_read_hrd_by`, `po_early_approve_hrd`, `reject_hrd_reason`, `approve_hrd_date`, `approve_hrd_by`, `absen_created_date`, `absen_deleted`, `absen_lupdated`) VALUES
('00135720141201', '2014-12-01', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00126420141201', '2014-12-01', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00123320141201', '2014-12-01', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00129520141201', '2014-12-01', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00132620141201', '2014-12-01', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00138820141201', '2014-12-01', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00135820141202', '2014-12-02', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00126520141202', '2014-12-02', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00123420141202', '2014-12-02', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00129620141202', '2014-12-02', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00132720141202', '2014-12-02', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00138920141202', '2014-12-02', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00135920141203', '2014-12-03', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00126620141203', '2014-12-03', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00123520141203', '2014-12-03', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00129720141203', '2014-12-03', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00132820141203', '2014-12-03', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139020141203', '2014-12-03', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136020141204', '2014-12-04', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00126720141204', '2014-12-04', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00123620141204', '2014-12-04', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00129820141204', '2014-12-04', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00132920141204', '2014-12-04', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139120141204', '2014-12-04', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136120141205', '2014-12-05', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00126820141205', '2014-12-05', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00123720141205', '2014-12-05', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00129920141205', '2014-12-05', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133020141205', '2014-12-05', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139220141205', '2014-12-05', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136220141206', '2014-12-06', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00126920141206', '2014-12-06', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00123820141206', '2014-12-06', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130020141206', '2014-12-06', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133120141206', '2014-12-06', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139320141206', '2014-12-06', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136320141207', '2014-12-07', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127020141207', '2014-12-07', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00123920141207', '2014-12-07', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130120141207', '2014-12-07', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133220141207', '2014-12-07', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139420141207', '2014-12-07', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136420141208', '2014-12-08', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127120141208', '2014-12-08', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124020141208', '2014-12-08', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130220141208', '2014-12-08', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133320141208', '2014-12-08', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139520141208', '2014-12-08', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136520141209', '2014-12-09', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127220141209', '2014-12-09', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124120141209', '2014-12-09', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130320141209', '2014-12-09', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133420141209', '2014-12-09', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139620141209', '2014-12-09', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136620141210', '2014-12-10', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127320141210', '2014-12-10', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124220141210', '2014-12-10', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130420141210', '2014-12-10', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133520141210', '2014-12-10', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139720141210', '2014-12-10', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136720141211', '2014-12-11', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127420141211', '2014-12-11', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124320141211', '2014-12-11', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130520141211', '2014-12-11', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133620141211', '2014-12-11', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139820141211', '2014-12-11', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136820141212', '2014-12-12', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127520141212', '2014-12-12', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124420141212', '2014-12-12', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130620141212', '2014-12-12', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133720141212', '2014-12-12', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00139920141212', '2014-12-12', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00136920141213', '2014-12-13', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127620141213', '2014-12-13', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124520141213', '2014-12-13', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130720141213', '2014-12-13', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133820141213', '2014-12-13', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140020141213', '2014-12-13', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137020141214', '2014-12-14', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127720141214', '2014-12-14', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124620141214', '2014-12-14', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130820141214', '2014-12-14', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00133920141214', '2014-12-14', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140120141214', '2014-12-14', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137120141215', '2014-12-15', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127820141215', '2014-12-15', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124720141215', '2014-12-15', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00130920141215', '2014-12-15', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00134020141215', '2014-12-15', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140220141215', '2014-12-15', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137220141216', '2014-12-16', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00127920141216', '2014-12-16', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124820141216', '2014-12-16', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00131020141216', '2014-12-16', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00134120141216', '2014-12-16', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140320141216', '2014-12-16', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137320141217', '2014-12-17', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128020141217', '2014-12-17', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00124920141217', '2014-12-17', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00131120141217', '2014-12-17', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00134220141217', '2014-12-17', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140420141217', '2014-12-17', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137420141218', '2014-12-18', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128120141218', '2014-12-18', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00125020141218', '2014-12-18', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00131220141218', '2014-12-18', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00134320141218', '2014-12-18', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140520141218', '2014-12-18', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137520141219', '2014-12-19', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128220141219', '2014-12-19', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00125120141219', '2014-12-19', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00131320141219', '2014-12-19', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00134420141219', '2014-12-19', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140620141219', '2014-12-19', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137620141220', '2014-12-20', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128320141220', '2014-12-20', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00125220141220', '2014-12-20', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00131420141220', '2014-12-20', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00134520141220', '2014-12-20', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140720141220', '2014-12-20', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137720141221', '2014-12-21', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128420141221', '2014-12-21', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00125320141221', '2014-12-21', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00131520141221', '2014-12-21', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00134620141221', '2014-12-21', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140820141221', '2014-12-21', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137820141222', '2014-12-22', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128520141222', '2014-12-22', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00125420141222', '2014-12-22', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00131620141222', '2014-12-22', '11.073p', 1, NULL, '2014-12-22 11:46:25', 1, 'HGGFH', NULL, NULL, '2014-12-22 13:37:38', 1, '2014-12-22 13:37:38', 'gfdgfdhg', NULL, '', 1, '', '2014-12-22 13:38:05', '11.072p', NULL, '', 1, '', '2014-12-22 13:41:00', '11.070p', '2014-12-21 17:18:36', 99, '2014-12-22 06:41:00'),
('00134720141222', '2014-12-22', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00140920141222', '2014-12-22', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00137920141223', '2014-12-23', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128620141223', '2014-12-23', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00125520141223', '2014-12-23', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00131720141223', '2014-12-23', '11.073p', 1, NULL, '2014-12-23 14:28:00', 1, 'ambil raport', NULL, NULL, '2014-12-23 18:56:32', 99, '2014-12-23 17:53:06', 'Kebelet ee', NULL, '', 3, '', NULL, '', NULL, '', 99, '', NULL, '', '2014-12-21 17:18:36', 99, '2014-12-23 11:56:32'),
('00134820141223', '2014-12-23', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00141020141223', '2014-12-23', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00138020141224', '2014-12-24', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128720141224', '2014-12-24', '11.070p', 1, NULL, '2014-12-24 20:46:45', 1, 'ggfdg', NULL, NULL, '2014-12-24 22:52:49', 99, '2014-12-24 17:50:37', 'gfdgfdg', NULL, '', 1, '', '2014-12-24 20:59:56', '11.080p', NULL, '', 1, '', '2014-12-24 21:00:12', '11.070p', '2014-12-21 15:48:35', 99, '2014-12-24 15:52:49'),
('00125620141224', '2014-12-24', '11.072p', 1, NULL, '2014-12-24 18:18:01', 1, 'TESTT', NULL, NULL, '2014-12-24 18:18:04', 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-24 11:18:04'),
('00131820141224', '2014-12-24', '11.073p', 3, '00000614', NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-23 04:00:33'),
('00134920141224', '2014-12-24', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00141120141224', '2014-12-24', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00138120141225', '2014-12-25', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128820141225', '2014-12-25', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00125720141225', '2014-12-25', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00131920141225', '2014-12-25', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00135020141225', '2014-12-25', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00141220141225', '2014-12-25', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00138220141226', '2014-12-26', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00128920141226', '2014-12-26', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00125820141226', '2014-12-26', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00132020141226', '2014-12-26', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00135120141226', '2014-12-26', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00141320141226', '2014-12-26', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00138320141227', '2014-12-27', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00129020141227', '2014-12-27', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00125920141227', '2014-12-27', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00132120141227', '2014-12-27', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00135220141227', '2014-12-27', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00141420141227', '2014-12-27', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00138420141228', '2014-12-28', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00129120141228', '2014-12-28', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00126020141228', '2014-12-28', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00132220141228', '2014-12-28', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00135320141228', '2014-12-28', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00141520141228', '2014-12-28', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00138520141229', '2014-12-29', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00129220141229', '2014-12-29', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00126120141229', '2014-12-29', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00132320141229', '2014-12-29', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00135420141229', '2014-12-29', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00141620141229', '2014-12-29', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00138620141230', '2014-12-30', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00129320141230', '2014-12-30', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00126220141230', '2014-12-30', '11.072p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:47:58', 99, '2014-12-21 08:47:58'),
('00132420141230', '2014-12-30', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00135520141230', '2014-12-30', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00141720141230', '2014-12-30', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22'),
('00138720141231', '2014-12-31', '11.060p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-23 14:39:54', 99, '2014-12-23 07:39:54'),
('00129420141231', '2014-12-31', '11.070p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 15:48:35', 99, '2014-12-21 08:48:35'),
('00126320141231', '2014-12-31', '11.072p', 1, NULL, '2014-12-31 15:04:38', 1, 'Libur', NULL, NULL, NULL, 1, '2014-12-31 15:04:56', 'Ayo', NULL, '', 1, '', '2015-01-01 00:12:17', '11.060p', NULL, '', 3, '', NULL, '', '2014-12-21 15:47:58', 99, '2014-12-31 17:12:17'),
('00132520141231', '2014-12-31', '11.073p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-21 17:18:36', 99, '2014-12-21 10:18:36'),
('00135620141231', '2014-12-31', '11.074p', 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-22 10:15:16', 99, '2014-12-22 03:15:16'),
('00141820141231', '2014-12-31', '11.080p', 88, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, 99, '', NULL, NULL, NULL, NULL, 99, '', NULL, NULL, '2014-12-24 20:59:22', 99, '2014-12-24 13:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `hcis_trx_dcuti`
--

CREATE TABLE IF NOT EXISTS `hcis_trx_dcuti` (
  `nmr_data` varchar(25) NOT NULL,
  `dcuti_no` varchar(25) NOT NULL,
  `mcuti_no` varchar(25) NOT NULL,
  `dcuti_date` date NOT NULL,
  `dcuti_type_no` int(11) NOT NULL,
  `dcuti_reason` text NOT NULL,
  `dcuti_read_up_level` datetime DEFAULT NULL,
  `read_up_level_by` varchar(20) DEFAULT NULL,
  `dcuti_approve_up_level` int(2) NOT NULL DEFAULT '99',
  `approve_up_level_date` datetime DEFAULT NULL,
  `approve_up_level_by` varchar(20) DEFAULT NULL,
  `dcuti_read_hrd` datetime DEFAULT NULL,
  `read_hrd_by` varchar(20) DEFAULT NULL,
  `dcuti_approve_hrd` int(2) DEFAULT '99',
  `approve_hrd_date` datetime DEFAULT NULL,
  `approve_hrd_by` varchar(20) DEFAULT NULL,
  `dcuti_created_date` datetime NOT NULL,
  `dcuti_lupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`nmr_data`),
  KEY `fk_trx_dcuti_trx_mcuti1_idx` (`mcuti_no`),
  KEY `fk_trx_dcuti_md_cuti_type1_idx` (`dcuti_type_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hcis_trx_lembur`
--

CREATE TABLE IF NOT EXISTS `hcis_trx_lembur` (
  `lembur_no` varchar(25) NOT NULL,
  `lembur_karyawan_nik` varchar(20) NOT NULL,
  `lembur_time_in` datetime NOT NULL,
  `lembur_time_out` datetime NOT NULL,
  `lembur_reason` text NOT NULL,
  `lembur_read_up_level` datetime DEFAULT NULL,
  `read_up_level_by` varchar(20) DEFAULT NULL,
  `lembur_approve_up_level` int(2) NOT NULL DEFAULT '99',
  `approve_up_level_date` datetime DEFAULT NULL,
  `approve_up_level_by` varchar(20) DEFAULT NULL,
  `lembur_read_hrd` datetime DEFAULT NULL,
  `read_hrd_by` varchar(20) DEFAULT NULL,
  `lembur_approve_hrd` int(2) DEFAULT '99',
  `approve_hrd_date` datetime DEFAULT NULL,
  `approve_hrd_by` varchar(20) DEFAULT NULL,
  `lembur_created_date` datetime NOT NULL,
  `lembur_cancel` int(2) NOT NULL DEFAULT '99',
  `lembur_cancel_date` datetime DEFAULT NULL,
  `lembur_lupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`lembur_no`),
  KEY `fk_trx_lembur_md_karyawan1_idx` (`lembur_karyawan_nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hcis_trx_lembur`
--

INSERT INTO `hcis_trx_lembur` (`lembur_no`, `lembur_karyawan_nik`, `lembur_time_in`, `lembur_time_out`, `lembur_reason`, `lembur_read_up_level`, `read_up_level_by`, `lembur_approve_up_level`, `approve_up_level_date`, `approve_up_level_by`, `lembur_read_hrd`, `read_hrd_by`, `lembur_approve_hrd`, `approve_hrd_date`, `approve_hrd_by`, `lembur_created_date`, `lembur_cancel`, `lembur_cancel_date`, `lembur_lupdated`) VALUES
('0000041214', '11.073p', '2014-12-23 19:05:00', '2014-12-23 21:37:00', 'testt lemburrr', NULL, NULL, 3, NULL, NULL, NULL, NULL, 99, NULL, NULL, '2014-12-23 14:02:54', 1, '2014-12-23 14:04:20', '2014-12-23 07:04:20'),
('0000051214', '11.073p', '2014-12-23 18:00:00', '2014-12-23 19:20:00', 'testtt', NULL, NULL, 3, NULL, NULL, NULL, NULL, 99, NULL, NULL, '2014-12-23 14:09:28', 99, NULL, '2014-12-23 07:09:28'),
('0000061214', '11.072p', '2014-12-23 18:09:00', '2014-12-23 20:59:00', 'tesss atasana lemburr', NULL, NULL, 3, NULL, NULL, NULL, NULL, 99, NULL, NULL, '2014-12-23 14:37:57', 1, '2014-12-24 18:18:35', '2014-12-24 11:18:35'),
('0000071214', '11.073p', '2014-12-25 09:43:34', '2015-01-31 00:00:01', 'Ada deh', NULL, NULL, 3, NULL, NULL, NULL, NULL, 99, NULL, NULL, '2014-12-24 09:43:16', 1, '2014-12-24 09:43:49', '2014-12-24 02:43:49'),
('0000081214', '11.070p', '2014-12-24 23:00:47', '2014-12-24 23:35:50', 'hjkhkj', NULL, NULL, 3, NULL, NULL, NULL, NULL, 99, NULL, NULL, '2014-12-24 23:00:58', 99, NULL, '2014-12-24 16:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `hcis_trx_mcuti`
--

CREATE TABLE IF NOT EXISTS `hcis_trx_mcuti` (
  `mcuti_no` varchar(25) NOT NULL,
  `mcuti_karyawan_nik` varchar(20) NOT NULL,
  `mcuti_period_year` varchar(4) NOT NULL,
  `mcuti_available` int(2) NOT NULL,
  `mcuti_change_md` int(2) NOT NULL DEFAULT '1',
  `mcuti_created_date` datetime NOT NULL,
  `mcuti_lupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mcuti_lupdated_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mcuti_karyawan_nik`,`mcuti_period_year`),
  UNIQUE KEY `mcuti_no` (`mcuti_no`),
  KEY `fk_trx_mcuti_md_karyawan1_idx` (`mcuti_karyawan_nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hcis_trx_mcuti`
--

INSERT INTO `hcis_trx_mcuti` (`mcuti_no`, `mcuti_karyawan_nik`, `mcuti_period_year`, `mcuti_available`, `mcuti_change_md`, `mcuti_created_date`, `mcuti_lupdated`, `mcuti_lupdated_by`) VALUES
('00004414', '11.060p', '2014', 1, 1, '2014-12-23 14:40:30', '2014-12-23 07:40:30', 'SYSTEM'),
('00003914', '11.070p', '2014', 1, 1, '2014-12-22 10:07:07', '2014-12-22 03:07:07', 'SYSTEM'),
('00004314', '11.072p', '2013', 0, 99, '2014-12-22 10:08:26', '2014-12-31 17:13:46', 'SYSADMIN'),
('00004214', '11.072p', '2014', 12, 1, '2014-12-22 10:08:20', '2014-12-22 03:08:49', 'SYSADMIN'),
('00004114', '11.073p', '2014', 0, 99, '2014-12-22 10:07:08', '2014-12-23 04:21:53', 'SYSTEM');

-- --------------------------------------------------------

--
-- Table structure for table `hcis_trx_rcuti`
--

CREATE TABLE IF NOT EXISTS `hcis_trx_rcuti` (
  `rcuti_no` varchar(20) NOT NULL,
  `mcuti_no` varchar(20) NOT NULL,
  `rcuti_lama_hari` int(2) NOT NULL,
  `rcuti_date_from` date NOT NULL,
  `rcuti_date_thru` date NOT NULL,
  `rcuti_reason` text CHARACTER SET latin1 NOT NULL,
  `rcuti_lstatus` int(2) NOT NULL DEFAULT '99',
  `rcuti_cancel` int(2) NOT NULL DEFAULT '99',
  `rcuti_read_up_level` datetime DEFAULT NULL,
  `read_up_level_by` varchar(20) DEFAULT NULL,
  `rcuti_approve_up_level` int(2) NOT NULL DEFAULT '99',
  `reject_up_level_reason` text CHARACTER SET latin1,
  `approve_up_level_date` datetime DEFAULT NULL,
  `approve_up_level_by` varchar(20) DEFAULT NULL,
  `rcuti_read_hrd` datetime DEFAULT NULL,
  `read_hrd_by` varchar(20) DEFAULT NULL,
  `rcuti_approve_hrd` int(2) DEFAULT '99',
  `reject_hrd_reason` text CHARACTER SET latin1,
  `approve_hrd_date` datetime DEFAULT NULL,
  `approve_hrd_by` varchar(20) DEFAULT NULL,
  `rcuti_created_date` datetime NOT NULL,
  `rcuti_lupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rcuti_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hcis_trx_rcuti`
--

INSERT INTO `hcis_trx_rcuti` (`rcuti_no`, `mcuti_no`, `rcuti_lama_hari`, `rcuti_date_from`, `rcuti_date_thru`, `rcuti_reason`, `rcuti_lstatus`, `rcuti_cancel`, `rcuti_read_up_level`, `read_up_level_by`, `rcuti_approve_up_level`, `reject_up_level_reason`, `approve_up_level_date`, `approve_up_level_by`, `rcuti_read_hrd`, `read_hrd_by`, `rcuti_approve_hrd`, `reject_hrd_reason`, `approve_hrd_date`, `approve_hrd_by`, `rcuti_created_date`, `rcuti_lupdated`) VALUES
('00000314', '00004114', 1, '2014-12-22', '2014-12-23', 'gfhgf', 99, 1, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, '2014-12-22 15:15:58', '2014-12-22 09:16:31'),
('00000414', '00004114', 1, '2014-12-22', '2014-12-23', 'dsvsdgf', 4, 99, NULL, NULL, 2, 'ggggg', '2014-12-23 00:09:08', '11.072p', NULL, NULL, 99, NULL, NULL, NULL, '2014-12-22 17:39:03', '2014-12-22 17:09:08'),
('00000514', '00004114', 1, '2014-12-23', '2014-12-24', 'gggg', 2, 99, NULL, NULL, 1, 'ggggg', '2014-12-23 00:38:58', '11.072p', NULL, NULL, 2, 'tes hrd reject', '2014-12-23 01:55:25', '', '2014-12-23 00:11:24', '2014-12-22 18:55:25'),
('00000614', '00004114', 1, '2014-12-24', '2014-12-25', 'testt', 1, 99, NULL, NULL, 1, NULL, '2014-12-23 10:37:53', '11.072p', NULL, NULL, 1, NULL, '2014-12-23 11:21:53', '11.070p', '2014-12-23 10:26:31', '2014-12-23 04:21:53'),
('00000714', '00004314', 3, '2014-12-24', '2014-12-27', 'mau liburan', 4, 99, NULL, NULL, 2, 'ntrr ahh', '2014-12-23 14:41:24', '11.060p', NULL, NULL, 99, NULL, NULL, NULL, '2014-12-23 14:38:42', '2014-12-23 07:41:24'),
('00000814', '00004314', 1, '2014-12-24', '2014-12-25', 'tessttt', 2, 99, NULL, NULL, 1, NULL, '2014-12-23 15:10:43', '11.060p', NULL, NULL, 2, 'hgfhgfh', '2014-12-23 15:11:33', '11.070p', '2014-12-23 15:10:14', '2014-12-23 08:11:33'),
('00000914', '00004314', 2, '2014-12-23', '2014-12-25', 'safdsg', 4, 99, NULL, NULL, 2, 'gfdgfdghhgd', '2014-12-23 15:12:48', '11.060p', NULL, NULL, 99, NULL, NULL, NULL, '2014-12-23 15:12:39', '2014-12-23 08:12:48'),
('00001014', '00004314', 2, '2014-12-24', '2014-12-26', 'gfdgfd', 99, 1, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, '2014-12-23 19:14:35', '2014-12-31 08:20:52'),
('00001114', '00003914', 1, '2014-12-25', '2014-12-26', 'ggk', 99, 1, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, '2014-12-24 21:01:19', '2014-12-24 15:51:07'),
('00001214', '00003914', 1, '2014-12-25', '2014-12-26', 'testtt', 99, 99, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, '2014-12-24 22:51:18', '2014-12-24 15:51:18'),
('00001314', '00004314', 2, '2015-01-01', '2015-01-03', 'Tes', 99, 1, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, '2014-12-31 15:09:27', '2014-12-31 08:21:37'),
('00001414', '00004314', 3, '2015-01-01', '2015-01-04', 'tesss ', 99, 1, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, '2014-12-31 15:22:06', '2014-12-31 10:29:57'),
('00001514', '00004314', 2, '2015-01-04', '2015-01-06', 'testtt', 1, 99, NULL, NULL, 1, NULL, '2014-12-31 17:36:15', '11.060p', NULL, NULL, 1, NULL, '2015-01-01 00:05:39', '11.070p', '2014-12-31 17:32:07', '2014-12-31 17:05:39'),
('00001614', '00004214', 2, '2015-02-10', '2015-02-12', 'sfds', 4, 99, NULL, NULL, 2, 'tess reject his', '2014-12-31 17:44:38', '11.060p', NULL, NULL, 99, NULL, NULL, NULL, '2014-12-31 17:44:06', '2014-12-31 10:44:38'),
('00001714', '00004314', 3, '2015-01-07', '2015-01-10', 'sdafsd', 1, 99, NULL, NULL, 1, NULL, '2015-01-01 00:12:44', '11.060p', NULL, NULL, 1, NULL, '2015-01-01 00:13:46', '11.070p', '2015-01-01 00:11:07', '2014-12-31 17:13:46'),
('00001814', '00004214', 3, '2015-01-27', '2015-01-30', 'gdfhfdh', 2, 99, NULL, NULL, 1, NULL, '2015-01-01 00:40:01', '11.060p', NULL, NULL, 2, 'fhgfh', '2015-01-01 00:40:48', '11.070p', '2015-01-01 00:39:43', '2014-12-31 17:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `hc_cuti_history_status`
--

CREATE TABLE IF NOT EXISTS `hc_cuti_history_status` (
  `kode` int(11) NOT NULL,
  `name` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hc_cuti_history_status`
--

INSERT INTO `hc_cuti_history_status` (`kode`, `name`) VALUES
(1, 'ambil cuti'),
(2, 'approve cuti up level'),
(3, 'reject cuti up level'),
(4, 'approve cuti hrd'),
(5, 'reject cuti hrd'),
(6, 'cancel cuti'),
(66, 'expired cuti tahun lalu'),
(77, 'ubah master data cuti'),
(88, 'insert master data cuti'),
(888, 'tambah cuti berjalan');

-- --------------------------------------------------------

--
-- Table structure for table `hc_cuti_status`
--

CREATE TABLE IF NOT EXISTS `hc_cuti_status` (
  `kode` int(11) NOT NULL,
  `name` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hc_cuti_status`
--

INSERT INTO `hc_cuti_status` (`kode`, `name`) VALUES
(1, 'approve hrd'),
(2, 'reject hrd'),
(3, 'approve up level'),
(4, 'reject up level'),
(99, 'mengajukan cuti');

-- --------------------------------------------------------

--
-- Table structure for table `hc_hcis_absen_status`
--

CREATE TABLE IF NOT EXISTS `hc_hcis_absen_status` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `hc_hcis_absen_status`
--

INSERT INTO `hc_hcis_absen_status` (`kode`, `name`) VALUES
(1, 'full absen'),
(2, 'only punch in'),
(3, 'cuti'),
(88, 'tidak disuruh absen'),
(99, 'tidak absen');

-- --------------------------------------------------------

--
-- Table structure for table `hc_status_approval`
--

CREATE TABLE IF NOT EXISTS `hc_status_approval` (
  `kode` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hc_status_approval`
--

INSERT INTO `hc_status_approval` (`kode`, `status`) VALUES
(1, 'approved'),
(2, 'rejected'),
(3, 'waiting approval'),
(99, 'no action , tidak me');

-- --------------------------------------------------------

--
-- Table structure for table `sequence_data`
--

CREATE TABLE IF NOT EXISTS `sequence_data` (
  `sequence_name` varchar(100) NOT NULL,
  `sequence_increment` int(11) unsigned NOT NULL DEFAULT '1',
  `sequence_min_value` int(11) unsigned NOT NULL DEFAULT '1',
  `sequence_max_value` bigint(20) unsigned NOT NULL DEFAULT '18446744073709551615',
  `sequence_cur_value` bigint(20) unsigned DEFAULT '1',
  `sequence_cycle` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sequence_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sequence_data`
--

INSERT INTO `sequence_data` (`sequence_name`, `sequence_increment`, `sequence_min_value`, `sequence_max_value`, `sequence_cur_value`, `sequence_cycle`) VALUES
('seq_absen', 1, 1, 999999, 1418, 1),
('seq_mcuti', 1, 1, 999999, 44, 1),
('seq_dcuti', 1, 1, 999999, 10, 1),
('seq_hcuti', 1, 1, 999999, 71, 1),
('seq_rcuti', 1, 1, 999999, 18, 1),
('seq_lembur', 1, 1, 999999, 8, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hcis_md_bagian`
--
ALTER TABLE `hcis_md_bagian`
  ADD CONSTRAINT `fk_hcis_md_bagian_hcis_md_dept1` FOREIGN KEY (`bagian_dept_no`) REFERENCES `hcis_md_dept` (`dept_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hcis_md_bagian_hcis_md_div1` FOREIGN KEY (`bagian_div_no`) REFERENCES `hcis_md_div` (`div_no`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `hcis_md_dept`
--
ALTER TABLE `hcis_md_dept`
  ADD CONSTRAINT `fk_hcis_md_dept_hcis_md_div1` FOREIGN KEY (`dept_div_no`) REFERENCES `hcis_md_div` (`div_no`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `hcis_md_karyawan`
--
ALTER TABLE `hcis_md_karyawan`
  ADD CONSTRAINT `fk_hcis_md_karyawan_hcis_md_dept1` FOREIGN KEY (`karyawan_dept_no`) REFERENCES `hcis_md_dept` (`dept_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hcis_md_karyawan_hcis_md_div1` FOREIGN KEY (`karyawan_div_no`) REFERENCES `hcis_md_div` (`div_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_md_karyawan_md_jabatan` FOREIGN KEY (`karyawan_jabatan_no`) REFERENCES `hcis_md_jabatan` (`jabatan_no`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `hcis_trx_absen`
--
ALTER TABLE `hcis_trx_absen`
  ADD CONSTRAINT `fk_trx_absen_md_karyawan1` FOREIGN KEY (`absen_karyawan_nik`) REFERENCES `hcis_md_karyawan` (`karyawan_nik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hcis_trx_dcuti`
--
ALTER TABLE `hcis_trx_dcuti`
  ADD CONSTRAINT `fk_trx_dcuti_md_cuti_type1` FOREIGN KEY (`dcuti_type_no`) REFERENCES `hcis_md_cuti_type` (`cuti_type_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_trx_dcuti_trx_mcuti1` FOREIGN KEY (`mcuti_no`) REFERENCES `hcis_trx_mcuti` (`mcuti_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hcis_trx_lembur`
--
ALTER TABLE `hcis_trx_lembur`
  ADD CONSTRAINT `fk_trx_lembur_md_karyawan1` FOREIGN KEY (`lembur_karyawan_nik`) REFERENCES `hcis_md_karyawan` (`karyawan_nik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
