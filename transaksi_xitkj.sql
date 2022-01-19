-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jan 2021 pada 17.48
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.26

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
-- Struktur dari tabel `tbbaner`
--

CREATE TABLE `tbbaner` (
  `id` int(5) NOT NULL,
  `src` text NOT NULL,
  `deskripsi` text NOT NULL,
  `aktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbbaner`
--

INSERT INTO `tbbaner` (`id`, `src`, `deskripsi`, `aktif`) VALUES
(1, 'img/ban1.png', '1', 'Y'),
(2, 'img/ban2.png', '2', 'Y'),
(3, 'img/ban3.png', '3', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbbarang`
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
-- Dumping data untuk tabel `tbbarang`
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
-- Struktur dari tabel `tbbeli`
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
-- Struktur dari tabel `tbbelidetil`
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
-- Struktur dari tabel `tbhistory`
--

CREATE TABLE `tbhistory` (
  `id` int(5) NOT NULL,
  `kodeuser` varchar(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbjual`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbjualdetil`
--

CREATE TABLE `tbjualdetil` (
  `no` varchar(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `jlh` int(5) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpelanggan`
--

CREATE TABLE `tbpelanggan` (
  `kodepel` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpembayaran`
--

CREATE TABLE `tbpembayaran` (
  `notransaksi` varchar(20) NOT NULL,
  `kodeuser` varchar(20) NOT NULL,
  `metode` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbsales`
--

CREATE TABLE `tbsales` (
  `kodesales` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbsupplier`
--

CREATE TABLE `tbsupplier` (
  `kodesup` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbuser`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempbelidetil`
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
-- Struktur dari tabel `tempjualdetil`
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
-- Indeks untuk tabel `tbpembayaran`
--
ALTER TABLE `tbpembayaran`
  ADD PRIMARY KEY (`notransaksi`);

--
-- Indeks untuk tabel `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`kodeuser`);

--
-- Indeks untuk tabel `tempjualdetil`
--
ALTER TABLE `tempjualdetil`
  ADD PRIMARY KEY (`notemp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tempjualdetil`
--
ALTER TABLE `tempjualdetil`
  MODIFY `notemp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
