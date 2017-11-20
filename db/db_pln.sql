-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2017 at 05:11 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pln`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bbm`
--

CREATE TABLE `tb_bbm` (
  `no_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `no_kendaraan` varchar(9) NOT NULL,
  `volume` decimal(10,2) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `stand_km` int(10) NOT NULL,
  `sopir` varchar(50) NOT NULL,
  `jenis_bbm` varchar(50) NOT NULL,
  `lokasi_beli` varchar(50) NOT NULL,
  `tgl_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `no_pol` varchar(9) NOT NULL,
  `merk` char(50) DEFAULT NULL,
  `tipe` text,
  `warna` char(15) DEFAULT NULL,
  `peruntukkan` char(50) DEFAULT NULL,
  `lokasi` char(50) DEFAULT NULL,
  `hrg_sewa` int(11) DEFAULT NULL,
  `no_rangka` text,
  `no_mesin` text,
  `bahan_bakar` text,
  `kapasitas_tangki` int(50) DEFAULT NULL,
  `tahun_kendaraan` text,
  `foto` text,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`no_pol`, `merk`, `tipe`, `warna`, `peruntukkan`, `lokasi`, `hrg_sewa`, `no_rangka`, `no_mesin`, `bahan_bakar`, `kapasitas_tangki`, `tahun_kendaraan`, `foto`, `status`) VALUES
('DA5718MG', 'KAWASAKI', 'KLX', 'HIJAU', 'POOL PALANGKARAYA', 'TRAGI PALANGKARAYA', 0, 'MH4LX150CHJP24552', 'LX150CEPL4362', '', 7, '2015', NULL, 'available'),
('DA7033PH', 'TOYOTA', 'RUSH', 'SILVER', 'POOL', 'AP2B', 6858000, 'DDW9818', 'MHFE2CJ2JDK040020', '', 45, '2014', NULL, 'available'),
('DA7044PH', 'TOYOTA', 'RUSH', 'SILVER', 'POOL', 'AP2B', 6858000, 'DE2320', 'MHFE2CJ2JDK042235', '', 45, '2014', NULL, 'available'),
('DA7136PJ', 'TOYOTA', 'AVANZA', 'HITAM', 'MANAJER', 'TRAGI BARABAI', 5512900, 'MHKM1BA3JEK219258', 'K3MF20372', '', 45, '2015', NULL, 'available'),
('DA7495TBA', 'SUZUKI', 'APV', 'HITAM', 'POOL BANDARMASIH', 'TRAGI BANDARMASIH', 0, '0', '0', 'BENSIN', 46, '2013 AKHIR', NULL, 'available'),
('DA7497TBA', 'SUZUKI', 'APV', 'HITAM', 'POOL BANJAR', 'TRAGI BANJAR', 0, 'MHYG0N41V0J310554', 'GISAID295719', 'BENSIN', 46, '2013 AKHIR', NULL, 'available'),
('DA7593TBA', 'SUZUKI', 'APV', 'HITAM', 'POOL BARABAI', 'TRAGI BARABAI', 4800000, '0', '0', 'BENSIN', 46, '2013 AKHIR', NULL, 'available'),
('DA7604PC', 'TOYOTA', 'AVANZA', 'HITAM', 'ASMAN SCADA', 'AP2B', 0, 'MHKM1BA3JCK103064', 'MA08164', '', 45, '2012 AKHIR', NULL, 'available'),
('DA7817PJ', 'TOYOTA', 'INNOVA', 'PUTIH', 'MANAJER AP2B', 'AP2B', 9551250, '0', '0', '', 55, '2015 AWAL', NULL, 'available'),
('DA7947PJ', 'TOYOTA', 'AVANZA', 'ABU-ABU', 'ASMAN PENYALURAN', 'AP2B', 5663500, 'MHKM1BA3JFK222610', 'K3MF49587', '', 45, '2015', NULL, 'available'),
('DA8123MB', 'TOYOTA', 'AVANZA', 'HITAM', 'MANAJER', 'TRAGI BANJAR', 5512900, 'MHKM1BA3JEJO91255', 'ME61124', '', 45, '2015', NULL, 'available'),
('DA8395PJ', 'TOYOTA', 'AVANZA', 'PUTIH', 'MANAJER', 'TRAGI BANDARMASIH', 5663500, 'MHKM1BA3JFK221007', 'KK3MF42642', '', 45, '2015', NULL, 'available'),
('DA8550PH', 'TOYOTA', 'AVANZA', 'HITAM', 'OPSIS', 'AP2B', 0, '0', '0', '', 45, '', NULL, 'available'),
('DA8938AY', 'TOYOTA', 'AVANZA', 'PUTIH', 'ASMAN SDM', 'AP2B', 5663500, 'MHKM1BA3JFK223177', 'K3MF53256', '', 45, '2015', NULL, 'available'),
('DA9027YY', 'SUZUKI', 'ERTIGA', 'HITAM', 'ASMAN', 'AP2B', 0, '0', '0', '', 45, '', NULL, 'available'),
('DA9098PH', 'TOYOTA', 'HILUX SC', 'HITAM', 'POOL BANJAR', 'TRAGI BANJAR', 0, 'MROAW12G5E00043518', '1TR7708814', '', 65, '2014', NULL, 'available'),
('DA9099PH', 'TOYOTA', 'HILUX SC', 'HITAM', 'POOL BANDARMASIH', 'TRAGI BANDARMASIH', 0, 'MR0AW12G3E0043274', '1TR7702311', '', 65, '2014', NULL, 'available'),
('DA9755BQ', 'TOYOTA', 'HILUX DC', 'SILVER METALIC', 'POOL', 'AP2B', 10623000, '2KDES332562', '2KD-S332G5E0776185', '', 80, '2014', NULL, 'available'),
('DA9769BQ', 'TOYOTA', 'HILUX DC', 'SILVER METALIC', 'POOL', 'AP2B', 10623000, 'MROFR22G4E0775920', '2KDS334214', '', 80, '2014', NULL, 'available'),
('DA9883PE', 'TOYOTA', 'HILUX SC', 'GREY', 'POOL BARABAI', 'TRAGI BARABAI', 0, 'MROW12G9E0046535', '1TR7838714', '', 65, '2015', NULL, 'available'),
('DA9985PH', 'TOYOTA', 'HILUX DC', 'PUTIH', 'POOL', 'AP2B', 10623000, 'MROFR22G8E0774964', '2KD-S325761', '', 80, '2015', NULL, 'available'),
('KH1319BP', 'TOYOTA', 'AVANZA', 'PUTIH', 'POOL PALANGKARAYA', 'TRAGI PALANGKARAYA', 0, 'MHKM1BA3JF1044164', 'KMF43787', '', 45, '2015', NULL, 'available'),
('KH1329BP', 'SUZUKI', 'APV', NULL, 'POOL PALANGKARAYA', 'TRAGI PALANGKARAYA', NULL, 'MHYGDN42VFJ400183', 'G15AJD347909', NULL, 46, '2015', NULL, 'available'),
('KH8550BP', 'TOYOTA', 'AVANZA', '', 'ASMAN OPSIS', 'AP2B', 0, '', '', '', 45, '2015', NULL, 'available'),
('KH8553BP', 'TOYOTA', 'HILUX SC', 'ABU-ABU', 'POOL PALANGKARAYA', 'TRAGI PALANGKARAYA', 4811000, 'MROAW12G7F0048673', '1TR7972237', '', 65, '2015', NULL, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id_user` int(11) NOT NULL,
  `username` char(20) NOT NULL,
  `password` int(8) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `foto` text NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id_user`, `username`, `password`, `nama`, `foto`, `role`) VALUES
(1, 'admin', 123, 'Admin', 'logo_pln.jpg', 'admin'),
(2, 'manager', 123, 'Manager', 'logo_pln.jpg', 'manager'),
(3, 'danasatari', 123, 'Dana Intansatari', 'dana.png', 'karyawan'),
(4, 'darmaindra', 123, 'Darma Indragiri', 'darma.png', 'karyawan'),
(5, 'driver', 123, 'Driver', 'logo_pln.jpg', 'driver'),
(6, 'vendoradmin', 123, 'Vendor ADmin', 'logo_pln.jpg', 'vendoradmin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permohonan`
--

CREATE TABLE `tb_permohonan` (
  `no_permohonan` int(5) NOT NULL,
  `nama` char(50) DEFAULT NULL,
  `bagian` char(50) DEFAULT NULL,
  `jumlah_penumpang` int(11) DEFAULT NULL,
  `hari_tgl` char(50) DEFAULT NULL,
  `hari_tglakhir` char(50) DEFAULT NULL,
  `jam_awal` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `tujuan` char(50) DEFAULT NULL,
  `keperluan` char(75) DEFAULT NULL,
  `tglcetak_permohonan` date DEFAULT NULL,
  `menyetujui` char(50) DEFAULT NULL,
  `mengetahui` char(50) DEFAULT NULL,
  `pemohon` char(50) DEFAULT NULL,
  `no_pol` varchar(9) DEFAULT NULL,
  `driver` char(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `type2` varchar(10) NOT NULL,
  `end` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_permohonan`
--

INSERT INTO `tb_permohonan` (`no_permohonan`, `nama`, `bagian`, `jumlah_penumpang`, `hari_tgl`, `hari_tglakhir`, `jam_awal`, `jam_akhir`, `tujuan`, `keperluan`, `tglcetak_permohonan`, `menyetujui`, `mengetahui`, `pemohon`, `no_pol`, `driver`, `status`, `type`, `type2`, `end`) VALUES
(1, 'Dana Intansatari', 'NV', 3, 'Jumat, 10 November 2017', 'Sabtu, 18 November 2017', '13:03:17', '19:18:17', 'HKHJ', 'LKJL', '0000-00-00', '', '', '', '', '', 'approved', '', '', 0),
(2, 'Dana Intansatari', 'DSDFSDf', 333, 'Jumat, 17 November 2017', 'Jumat, 10 November 2017', '15:28:07', '09:07:06', '324324', '324324', '0000-00-00', '', '', '', '', '', 'pending', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sewa`
--

CREATE TABLE `tb_sewa` (
  `id_sewa` int(11) NOT NULL,
  `nama_sopir` varchar(50) NOT NULL,
  `no_pol` varchar(100) NOT NULL,
  `no_permohonan` int(11) NOT NULL,
  `tanggal_awal` char(50) NOT NULL,
  `tanggal_akhir` char(50) NOT NULL,
  `jumlah_hari` int(2) NOT NULL,
  `biaya_harian` double NOT NULL,
  `biaya_penginapan` double NOT NULL,
  `total_biaya` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sopir`
--

CREATE TABLE `tb_sopir` (
  `nama_sopir` char(50) NOT NULL,
  `ttl` varchar(50) DEFAULT NULL,
  `jk` char(50) DEFAULT NULL,
  `jabatan` char(50) DEFAULT NULL,
  `no_hp` varchar(12) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `gaji_diterima` int(10) DEFAULT NULL,
  `Foto` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sopir`
--

INSERT INTO `tb_sopir` (`nama_sopir`, `ttl`, `jk`, `jabatan`, `no_hp`, `alamat`, `gaji_diterima`, `Foto`, `username`, `password`, `status`) VALUES
('AHMAD RAMDHANI', NULL, 'LAKI-LAKI', NULL, '', NULL, NULL, '', 'ahmad', '123', 'available'),
('ALI NURJAMAN', 'BANDUNG, 01-01-1983', 'LAKI-LAKI', 'DRIVER FULL', '081312443479', 'KOMP.GRAHA PERMATA INDAH7 KAV. 26 RT 040 / RW 011 KEL. CEMPAKA KEC. CEMPAKA KOTA BANJARBARU', 2494560, 'alinur.jpg', 'alinur', '123', 'available'),
('GANI RAHMAN', 'ALUAN BESAR, 25-07-1983', 'LAKI-LAKI', 'DRIVER FULL', '085346552599', 'Kop. Mustika griya permai. RT?RW, 022/001, Kel Sungaisipai Kec, Martapura Kota Banjar.\r\n', 2504835, 'rahman.jpg', 'rahman', '123', 'available'),
('H. AWANG CHANDRA ADITYA WIBISANA', 'BARABAI, 01-09-1979', 'LAKI-LAKI', 'DRIVER FULL', '082159603989', 'KOMPLEK CITRA MEGAH RAYA I NO. 21 RT. 007 / RW. 002 KEL. LOKTABAT UTARA, KEC. BANJARBARU UTARA', 2504835, 'awang.jpg', 'awang', '123', 'available'),
('HERU DHYAN SAPUTRO', 'MADIUN, 16-04-1985', 'LAKI-LAKI', 'DRIVER FULL', '082149650353', 'KOMP. MUSTIKA GRIYA PERMAI Blok G. No. 54G  RT. 20 / RW. 01. MARTAPURA KAB. BANJAR\r\n', 2504835, 'heru.jpg', 'heru', '123', 'available'),
('JOKO PURWANTO', 'BANJARBARU, 17-02-1974', 'LAKI-LAKI', 'DRIVER FULL', '085349751940', 'CEMPAKA BARU RT. 030 RW. 010 KEL. CEMPAKA, KEC. CEMPAKA', 2504835, 'joko.jpg', 'joko', '123', 'in use'),
('M. SALPUDDIN', 'BANJARMASIN, 10-05-1975', 'LAKI-LAKI', 'DRIVER FULL', '081351007711', 'KOMP. MUSTIKA GRIYA PERMAI BLOK B NO. 156 RT. 010 / RW. 001 KEL. CINDAI ALUS, KEC. MARTAPURA', 2504835, 'salapuddin.jpg', 'salapuddin', '123', 'in use'),
('MUHAMMAD ALI', 'BENUA RAYA, 15-12-1979', 'LAKI-LAKI', 'DRIVER FULL', '082153619779', 'KOMP. CITRA PB.2 NO. 15 C RT. 003 / RW. 004 KEL. SEKUMPUL, KEC. MARTAPURA KOTA, KAB. BANJAR\r\n', 2504835, 'm.ali.jpg', 'mali', '123', 'available'),
('MUHAMMAD RIJANI', 'GN.KUPANG, 14-04-1971', 'LAKI-LAKI', 'DRIVER FULL', '085251898158', 'GUNUNG BAROMBAK RT. 002 / RW. 011 KEL. CEMPAKA, KEC. CEMPAKA \r\n', 2504835, 'rijani.jpg', 'rijani', '123', 'available'),
('UNTUNG WASKITO', 'BANJARBARU , 27-02-1976', 'LAKI-LAKI', 'SUPIR MANAJER', '081348452399', 'JL. INTAN SARI  RT. 022 / RW. 004 KEL.SUNGAI BESAR KEC. BANJARBARU SELATAN', 2607003, 'untung.jpg', 'untung', '123', 'available'),
('YUDHI PRAYITNO', 'GUNTUNG PAYUNG, 03-08-1987', 'LAKI-LAKI', 'DRIVER FULL', '085348303188', 'JL. SIDOREJO NO. 29 RT 011 / RW002 GUNTUNG MANGGIS KEC. LANDASAN ULIN KOTA BANJARBARU\n', 2473560, 'yudhi.jpg', 'yudhi', '123', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sppd`
--

CREATE TABLE `tb_sppd` (
  `id_sppd` int(11) NOT NULL,
  `nama_sopir` varchar(50) NOT NULL,
  `no_pol` varchar(100) NOT NULL,
  `no_permohonan` int(11) NOT NULL,
  `tanggal_awal` char(50) NOT NULL,
  `tanggal_akhir` char(50) NOT NULL,
  `jumlah_hari` int(2) DEFAULT NULL,
  `biaya_harian` double NOT NULL,
  `biaya_penginapan` double NOT NULL,
  `total_biaya` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id`, `status`) VALUES
(1, 'approved'),
(2, 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bbm`
--
ALTER TABLE `tb_bbm`
  ADD KEY `no_kendaraan` (`no_kendaraan`),
  ADD KEY `sopir` (`sopir`);

--
-- Indexes for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`no_pol`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_permohonan`
--
ALTER TABLE `tb_permohonan`
  ADD PRIMARY KEY (`no_permohonan`);

--
-- Indexes for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `nama_sopir` (`nama_sopir`);

--
-- Indexes for table `tb_sopir`
--
ALTER TABLE `tb_sopir`
  ADD PRIMARY KEY (`nama_sopir`),
  ADD KEY `nama` (`nama_sopir`),
  ADD KEY `nama_sopir` (`nama_sopir`);

--
-- Indexes for table `tb_sppd`
--
ALTER TABLE `tb_sppd`
  ADD PRIMARY KEY (`id_sppd`),
  ADD KEY `nama_sopir` (`nama_sopir`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_permohonan`
--
ALTER TABLE `tb_permohonan`
  MODIFY `no_permohonan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_sppd`
--
ALTER TABLE `tb_sppd`
  MODIFY `id_sppd` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_bbm`
--
ALTER TABLE `tb_bbm`
  ADD CONSTRAINT `tb_bbm_ibfk_1` FOREIGN KEY (`no_kendaraan`) REFERENCES `tb_kendaraan` (`no_pol`),
  ADD CONSTRAINT `tb_bbm_ibfk_2` FOREIGN KEY (`sopir`) REFERENCES `tb_sopir` (`nama_sopir`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
