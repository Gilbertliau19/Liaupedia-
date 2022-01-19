-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2021 at 01:22 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transaksi_xitkj`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbbaner`
--

CREATE TABLE `tbbaner` (
  `id` int(5) NOT NULL,
  `src` text NOT NULL,
  `deskripsi` text NOT NULL,
  `aktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbbaner`
--

INSERT INTO `tbbaner` (`id`, `src`, `deskripsi`, `aktif`) VALUES
(1, 'img/ban1.png', '1', 'Y'),
(2, 'img/ban2.png', '2', 'Y'),
(3, 'img/ban3.png', '3', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbbarang`
--

CREATE TABLE `tbbarang` (
  `kodebarang` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `jlh_stok` int(5) NOT NULL,
  `hargajual` double NOT NULL,
  `hargabeli` double NOT NULL,
  `ket` text NOT NULL,
  `image` text NOT NULL,
  `disc` text NOT NULL,
  `trending` enum('Y','N') NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbbarang`
--

INSERT INTO `tbbarang` (`kodebarang`, `nama`, `jenis`, `merk`, `satuan`, `jlh_stok`, `hargajual`, `hargabeli`, `ket`, `image`, `disc`, `trending`, `deskripsi`) VALUES
('barang1', 'Laptop gaming Asus Rog G14', 'Laptop Gaming', 'Asus', 'pcs', 50, 7000000, 5000000, '1', 'img/1a.png', '50000', 'Y', 'Laptop yang kuat untuk main game , dan bisa sekaligus editing'),
('barang10', 'Kursi Gaming ', 'Kursi', 'Gaming ', 'set', 20, 2000000, 1500000, '2', 'img/2a.png', '40000', 'Y', 'Kursi dengan kualitas tertinggi dengan design yang modern'),
('barang2', 'Casing Nintendo Switch', 'Casing', 'DOHE', 'pcs', 100, 80000, 60000, '10', 'img/1b.png', '1000', 'Y', 'Dapat memproteksi nintendo switch kesayangan mu'),
('barang3', 'Hp Xiaomi M1 2020', 'HP', 'Xiaomi', 'pcs', 100, 1200000, 1000000, '3', 'img/2b.png', '2500', 'N', 'HP dengan kapasitas 64 gb dan mampu untuk berain game apa saja tanpa kendala'),
('barang4', 'Earphone bluetooth Baseus', 'Earphone', 'Baseus', 'pcs', 60, 200000, 175000, '4', 'img/3a.png', '900', 'Y', 'Gampang untuk dibawa kemana saja tanpa harus kesulitan dengan kabel'),
('barang5', 'Ram komputer 4 gb Hyperx', 'Ram', 'Hyperx', 'pcs', 100, 250000, 200000, '5', 'img/4a.png', '1000', 'Y', 'Ram ini memiliki kemampuan memproses data dengan cepat.'),
('barang6', 'Desk Lamp Philips ', 'Lamp', 'Philips', 'pcs', 80, 350000, 285000, '6', 'img/5a.png', '100', 'N', 'Menerangi ruangnan yang gelap tanpa banyak mengeluarkan listrik'),
('barang7', 'HP Infinix 2017 ', 'HP', 'Infinix', 'set', 92, 950000, 900000, '7', 'img/4b.png', '92', 'Y', 'HP dengan layar amoled'),
('barang8', 'Ecle charger 5v 2.1A', 'Charger', 'Ecle', 'pcs', 200, 150000, 90000, '8', 'img/6a.png', '25', 'Y', 'Charger yang tahan dan bisa mengecas Tablet atau HP dengan kecepatan tinggi'),
('barang9', 'GPU MSI Rtx 2070', 'GPU', 'MSI', 'pcs', 175, 4000000, 3900000, '9', 'img/3b.png', '19000', 'Y', 'RTX 2070 mampu untuk bermain game yang berat dengan spesifikasi ultra HD');

-- --------------------------------------------------------

--
-- Table structure for table `tbbeli`
--

CREATE TABLE `tbbeli` (
  `no` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `kodesup` varchar(20) NOT NULL,
  `kodeuser` varchar(20) NOT NULL,
  `subtotal` double NOT NULL,
  `disc` double NOT NULL,
  `pajak` double NOT NULL,
  `grandtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbbelidetil`
--

CREATE TABLE `tbbelidetil` (
  `no` varchar(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `jlh` int(5) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbhistory`
--

CREATE TABLE `tbhistory` (
  `id` int(5) NOT NULL,
  `kodeuser` varchar(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbhistory`
--

INSERT INTO `tbhistory` (`id`, `kodeuser`, `kodebarang`, `created_at`, `updated_at`) VALUES
(0, 'user1', 'barang1', '2021-01-26 13:38:04', '2021-01-26 13:39:16'),
(0, 'user1', 'barang2', '2021-01-26 14:08:30', '2021-01-26 19:10:05'),
(0, 'user2', 'barang10', '2021-01-26 18:24:33', '2021-01-26 18:24:33'),
(0, 'user2', 'barang4', '2021-01-26 18:25:28', '2021-01-26 18:25:28'),
(0, 'user2', 'barang1', '2021-01-26 18:25:56', '2021-01-26 18:25:56'),
(0, 'user3', 'barang7', '2021-01-26 19:12:27', '2021-01-26 19:12:27'),
(0, 'user3', 'barang1', '2021-01-26 19:13:17', '2021-01-26 19:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbjual`
--

CREATE TABLE `tbjual` (
  `no` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `kodepel` varchar(20) NOT NULL,
  `kodeuser` varchar(20) NOT NULL,
  `subtotal` double NOT NULL,
  `disc` double NOT NULL,
  `pajak` double NOT NULL,
  `grandtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbjual`
--

INSERT INTO `tbjual` (`no`, `tgl`, `kodepel`, `kodeuser`, `subtotal`, `disc`, `pajak`, `grandtotal`) VALUES
('J-1', '2021-01-26', '', 'user1', 28000000, 200000, 0, 27800000),
('J-2', '2021-01-26', '', 'user1', 7000000, 50000, 0, 6950000),
('J-3', '2021-01-26', '', 'user1', 160000, 2000, 0, 158000),
('J-4', '2021-01-26', '', 'user2', 21600000, 152700, 0, 21447300),
('J-5', '2021-01-26', '', 'user3', 16850000, 100276, 0, 16749724);

-- --------------------------------------------------------

--
-- Table structure for table `tbjualdetil`
--

CREATE TABLE `tbjualdetil` (
  `no` varchar(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `jlh` int(5) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbjualdetil`
--

INSERT INTO `tbjualdetil` (`no`, `kodebarang`, `jlh`, `harga`, `total`) VALUES
('J-1', 'barang1', 4, 6950000, 27800000),
('J-2', 'barang1', 1, 6950000, 6950000),
('J-3', 'barang2', 2, 79000, 158000),
('J-4', 'barang4', 3, 199100, 597300),
('J-4', 'barang1', 3, 6950000, 20850000),
('J-5', 'barang7', 3, 949908, 2849724),
('J-5', 'barang1', 2, 6950000, 13900000);

-- --------------------------------------------------------

--
-- Table structure for table `tbpelanggan`
--

CREATE TABLE `tbpelanggan` (
  `kodepel` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbpembayaran`
--

CREATE TABLE `tbpembayaran` (
  `notransaksi` varchar(20) NOT NULL,
  `kodeuser` varchar(20) NOT NULL,
  `metode` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpembayaran`
--

INSERT INTO `tbpembayaran` (`notransaksi`, `kodeuser`, `metode`, `status`, `total`) VALUES
('J-1', 'user1', 'transfer', 'Belum Lunas', '27800000'),
('J-2', 'user1', 'cod', 'Lunas', '6950000'),
('J-3', 'user1', 'transfer', 'Lunas', '158000'),
('J-4', 'user2', 'transfer', 'Lunas', '21447300'),
('J-5', 'user3', 'transfer', 'Lunas', '16749724');

-- --------------------------------------------------------

--
-- Table structure for table `tbsales`
--

CREATE TABLE `tbsales` (
  `kodesales` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbsupplier`
--

CREATE TABLE `tbsupplier` (
  `kodesup` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `kodeuser` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`kodeuser`, `nama`, `status`, `pass`, `ket`, `telp`, `alamat`) VALUES
('user1', 'gilbert', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '', '08966143225', 'JL Ayani No 2'),
('user2', 'lionel', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '', '089132411', 'jl serdam'),
('user3', 'jonathan', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '', '089241', 'jl serdam');

-- --------------------------------------------------------

--
-- Table structure for table `tempbelidetil`
--

CREATE TABLE `tempbelidetil` (
  `notemp` int(5) NOT NULL,
  `no` varchar(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `jlh` int(5) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tempjualdetil`
--

CREATE TABLE `tempjualdetil` (
  `notemp` int(5) NOT NULL,
  `no` varchar(20) NOT NULL,
  `kodeuser` varchar(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `jlh` int(5) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbpembayaran`
--
ALTER TABLE `tbpembayaran`
  ADD PRIMARY KEY (`notransaksi`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`kodeuser`);

--
-- Indexes for table `tempjualdetil`
--
ALTER TABLE `tempjualdetil`
  ADD PRIMARY KEY (`notemp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tempjualdetil`
--
ALTER TABLE `tempjualdetil`
  MODIFY `notemp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
