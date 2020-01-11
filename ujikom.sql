-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 14. Februari 2017 jam 10:56
-- Versi Server: 5.1.37
-- Versi PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toko_buku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(10) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) DEFAULT NULL,
  `noisbn` varchar(50) DEFAULT NULL,
  `penulis` varchar(50) DEFAULT NULL,
  `penerbit` varchar(50) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `stok` varchar(20) DEFAULT NULL,
  `harga_pokok` varchar(30) DEFAULT NULL,
  `harga_jual` varchar(30) DEFAULT NULL,
  `ppn` varchar(5) DEFAULT NULL,
  `diskon` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `noisbn`, `penulis`, `penerbit`, `tahun`, `stok`, `harga_pokok`, `harga_jual`, `ppn`, `diskon`) VALUES
(89, 'php book', '1242628988', 'usup koswara', 'caca sukmara', 2017, '60', '30000', '30300', '1%', '0%'),
(93, 'Belajar Menanam', '12828286', 'arya S.AG', 'Pt.sinar kamari', 2017, '5', '30000', '30600', '2%', '0%');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `id_penjualan` varchar(50) DEFAULT NULL,
  `id_buku` int(10) DEFAULT NULL,
  `id_kasir` int(10) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `jumlah` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `laba` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor`
--

CREATE TABLE IF NOT EXISTS `distributor` (
  `id_distributor` int(10) NOT NULL AUTO_INCREMENT,
  `nama_distributor` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id_distributor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `distributor`
--

INSERT INTO `distributor` (`id_distributor`, `nama_distributor`, `alamat`, `telepon`) VALUES
(1, 'Pt.karya cipta', 'sumadang,cisitu', '089763456721');

-- --------------------------------------------------------

--
-- Stand-in structure for view `harga_jual`
--
CREATE TABLE IF NOT EXISTS `harga_jual` (
`id_buku` int(10)
,`judul` varchar(50)
,`noisbn` varchar(50)
,`penulis` varchar(50)
,`penerbit` varchar(50)
,`tahun` year(4)
,`stok` varchar(20)
,`harga_pokok` varchar(30)
,`ppn` varchar(5)
,`diskon` varchar(5)
,`harga_jual` double
);
-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE IF NOT EXISTS `kasir` (
  `id_kasir` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `acces` varchar(50) DEFAULT NULL,
  `foto` text,
  PRIMARY KEY (`id_kasir`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `nama`, `alamat`, `telepon`, `status`, `username`, `password`, `acces`, `foto`) VALUES
(1, 'ujang', 'cisema', '087658654675', 'Menikah', 'kasir', 'kasir', 'kasir', 'Desain-Base-Hybrid-Clash-Of-Clans-Town-Hall-9-Update-Terbaru.jpg'),
(2, 'sukma', 'citeureup', '087658654675', 'Jones', 'admin', 'admin', 'admin', 'foto-lucu-unik-gokil-rossi-7.jpg'),
(3, 'muhamad rizky nurdin', 'cisema', '09887777', 'manikah', 'qwerty', '123456', 'kasir', '51809db023f22_51809db02501e.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `lap_pembelian`
--
CREATE TABLE IF NOT EXISTS `lap_pembelian` (
`id_pasok` int(10)
,`id_distributor` int(10)
,`id_buku` int(10)
,`id_kasir` int(10)
,`nama` varchar(50)
,`nama_distributor` varchar(50)
,`judul` varchar(50)
,`noisbn` varchar(50)
,`harga` varchar(50)
,`jumlah` varchar(10)
,`total` varchar(50)
,`tanggal` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `lap_penjualan`
--
CREATE TABLE IF NOT EXISTS `lap_penjualan` (
`id_penjualan` varchar(50)
,`id_buku` int(10)
,`nama` varchar(50)
,`judul` varchar(100)
,`ppn` varchar(5)
,`diskon` varchar(5)
,`harga` varchar(50)
,`jumlah` varchar(50)
,`total` varchar(50)
,`tanggal` date
);
-- --------------------------------------------------------

--
-- Struktur dari tabel `pasok`
--

CREATE TABLE IF NOT EXISTS `pasok` (
  `id_pasok` int(10) NOT NULL AUTO_INCREMENT,
  `id_kasir` int(10) DEFAULT NULL,
  `id_distributor` int(10) DEFAULT NULL,
  `id_buku` int(10) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `jumlah` varchar(10) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_pasok`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Triggers `pasok`
--
DROP TRIGGER IF EXISTS `toko_buku`.`tambh_stok`;
DELIMITER //
CREATE TRIGGER `toko_buku`.`tambh_stok` AFTER INSERT ON `toko_buku`.`pasok`
 FOR EACH ROW BEGIN
INSERT INTO buku
SET id_buku = NEW.id_buku,
stok = New.jumlah ON DUPLICATE KEY UPDATE stok = stok + New.jumlah;
    END
//
DELIMITER ;

--
-- Dumping data untuk tabel `pasok`
--

INSERT INTO `pasok` (`id_pasok`, `id_kasir`, `id_distributor`, `id_buku`, `harga`, `jumlah`, `total`, `tanggal`) VALUES
(34, 1, 1, 89, '30300', '6', '181800', '2017-02-11'),
(35, 1, 1, 89, '30300', '40', '1212000', '2017-02-14'),
(36, 1, 1, 89, '30000', '90', '2700000', '2017-02-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` char(50) NOT NULL,
  `id_kasir` int(10) DEFAULT NULL,
  `jumlah` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `bayar` varchar(50) DEFAULT NULL,
  `kembalian` varchar(50) DEFAULT NULL,
  `laba` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sementara_penjualan`
--

CREATE TABLE IF NOT EXISTS `tbl_sementara_penjualan` (
  `id_penjualan` char(50) DEFAULT NULL,
  `id_buku` int(10) DEFAULT NULL,
  `id_kasir` int(10) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `jumlah` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `laba` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sementara_penjualan`
--


-- --------------------------------------------------------

--
-- Structure for view `harga_jual`
--
DROP TABLE IF EXISTS `harga_jual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harga_jual` AS (select `buku`.`id_buku` AS `id_buku`,`buku`.`judul` AS `judul`,`buku`.`noisbn` AS `noisbn`,`buku`.`penulis` AS `penulis`,`buku`.`penerbit` AS `penerbit`,`buku`.`tahun` AS `tahun`,`buku`.`stok` AS `stok`,`buku`.`harga_pokok` AS `harga_pokok`,`buku`.`ppn` AS `ppn`,`buku`.`diskon` AS `diskon`,((`buku`.`harga_pokok` + ((`buku`.`harga_pokok` * `buku`.`ppn`) / 100)) - ((`buku`.`harga_pokok` * `buku`.`diskon`) / 100)) AS `harga_jual` from `buku`);

-- --------------------------------------------------------

--
-- Structure for view `lap_pembelian`
--
DROP TABLE IF EXISTS `lap_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lap_pembelian` AS (select `pasok`.`id_pasok` AS `id_pasok`,`distributor`.`id_distributor` AS `id_distributor`,`buku`.`id_buku` AS `id_buku`,`kasir`.`id_kasir` AS `id_kasir`,`kasir`.`nama` AS `nama`,`distributor`.`nama_distributor` AS `nama_distributor`,`buku`.`judul` AS `judul`,`buku`.`noisbn` AS `noisbn`,`pasok`.`harga` AS `harga`,`pasok`.`jumlah` AS `jumlah`,`pasok`.`total` AS `total`,`pasok`.`tanggal` AS `tanggal` from (((`pasok` join `distributor`) join `kasir`) join `buku`) where ((`pasok`.`id_buku` = `buku`.`id_buku`) and (`pasok`.`id_kasir` = `kasir`.`id_kasir`) and (`pasok`.`id_distributor` = `distributor`.`id_distributor`)) group by `pasok`.`id_pasok`);

-- --------------------------------------------------------

--
-- Structure for view `lap_penjualan`
--
DROP TABLE IF EXISTS `lap_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lap_penjualan` AS (select `detail_penjualan`.`id_penjualan` AS `id_penjualan`,`detail_penjualan`.`id_buku` AS `id_buku`,`kasir`.`nama` AS `nama`,`detail_penjualan`.`judul` AS `judul`,`buku`.`ppn` AS `ppn`,`buku`.`diskon` AS `diskon`,`detail_penjualan`.`harga` AS `harga`,`detail_penjualan`.`jumlah` AS `jumlah`,`detail_penjualan`.`total` AS `total`,`detail_penjualan`.`tanggal` AS `tanggal` from ((`buku` join `detail_penjualan`) join `kasir`) where ((`detail_penjualan`.`id_buku` = `buku`.`id_buku`) and (`detail_penjualan`.`id_kasir` = `kasir`.`id_kasir`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
