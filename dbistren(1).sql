-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Okt 2020 pada 07.40
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbistren`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`admin`@`localhost` FUNCTION `getcountstshadir` (`idkaryawan` INT, `tglawal` DATE, `tglakhir` DATE, `idstshadir` TEXT) RETURNS INT(11) BEGIN
	DECLARE jumlahabsen INT;
	SELECT count(id_absen_karyawan) AS jumlahabsen INTO jumlahabsen FROM absen_karyawan 
	WHERE id_karyawan = idkaryawan
	and   tgl_absen >= tglawal
	AND   tgl_absen	<= tglakhir
	and   id_sts_hadir = idstshadir;
	RETURN jumlahabsen;
 END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getketabsen` (`idabsen` TEXT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE ketabsen TEXT;
	SELECT ket_absen AS ket_absen INTO ketabsen FROM status_absen WHERE kd_absen = idabsen;
	RETURN ketabsen;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getketshift` (`idshift` TEXT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE ketshift TEXT;
	SELECT nama_shift AS ketshift INTO ketshift FROM absen_shift WHERE kode_shift = idshift;
	RETURN ketshift;
    END$$

CREATE DEFINER=`admin`@`localhost` FUNCTION `getmenitkeluar` (`idkaryawan` INT, `tglawal` DATE, `tglakhir` DATE) RETURNS INT(11) BEGIN
	DECLARE jmlmenitkeluar INT;
	SELECT SUM(IFNULL(menit_lebih_keluar,0)) AS jmlmenitkeluar INTO jmlmenitkeluar FROM absen_karyawan 
	WHERE id_karyawan = idkaryawan
	and   tgl_absen >= tglawal
	AND   tgl_absen	<= tglakhir;
	RETURN jmlmenitkeluar;
 END$$

CREATE DEFINER=`admin`@`localhost` FUNCTION `getmenitmasuk` (`idkaryawan` INT, `tglawal` DATE, `tglakhir` DATE) RETURNS INT(11) BEGIN
	DECLARE jmlmenitmasuk INT;
	SELECT SUM(IFNULL(menit_lebih_masuk,0)) AS jmlmenitmasuk INTO jmlmenitmasuk FROM absen_karyawan 
	WHERE id_karyawan = idkaryawan
	and   tgl_absen >= tglawal
	AND   tgl_absen	<= tglakhir;
	RETURN jmlmenitmasuk;
 END$$

CREATE DEFINER=`admin`@`localhost` FUNCTION `getnamadepartemen` (`iddepartemen` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namadepartemen TEXT;
	SELECT nama_departemen AS namadepartemen INTO namadepartemen FROM departemen WHERE id_departemen = iddepartemen;
	RETURN namadepartemen;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getnamahubungan` (`idhubungan` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namahubungan TEXT;
	SELECT nama_hubungan AS namahubungan INTO namahubungan FROM jenis_hubungan WHERE id_hubungan = idhubungan;
	RETURN namahubungan;
    END$$

CREATE DEFINER=`admin`@`localhost` FUNCTION `getnamajabatan` (`idjabatan` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namajabatan TEXT;
	SELECT nama_jabatan AS namajabatan INTO namajabatan FROM jenis_jabatan WHERE id_jabatan = idjabatan;
	RETURN namajabatan;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getnamakelas` (`idkelas` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namakelas TEXT;
	SELECT nama_kelas AS namakelas INTO namakelas FROM para_kelas WHERE id_kelas = dikelas;
	RETURN namakelas;
    END$$

CREATE DEFINER=`admin`@`localhost` FUNCTION `getnamalembaga` (`idlembaga` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namalembaga TEXT;
	SELECT nama_lembaga AS namalembaga INTO namalembaga FROM lembaga WHERE id_lembaga = idlembaga;
	RETURN namalembaga;
    END$$

CREATE DEFINER=`admin`@`localhost` FUNCTION `getnamamenu` (`idmenu` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namamenu TEXT;
	SELECT nama_menu AS namamenu INTO namamenu FROM menu WHERE id = idmenu;
	RETURN namamenu;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getnamapekerjaan` (`idpekerjaan` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namapekerjaan TEXT;
	SELECT nama_pekerjaan AS namapekerjaan INTO namapekerjaan FROM jenis_pekerjaan WHERE id_kerja = idpekerjaan;
	RETURN namapekerjaan;
    END$$

CREATE DEFINER=`admin`@`localhost` FUNCTION `getnamapendidikan` (`idpendidikan` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namapendidikan TEXT;
	SELECT nama_pendidikan AS namapendidikan INTO namapendidikan FROM jenis_pendidikan WHERE id_pendidikan = idpendidikan;
	RETURN namapendidikan;
    END$$

CREATE DEFINER=`admin`@`localhost` FUNCTION `getnamarole` (`idrole` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namarole TEXT;
	SELECT nama_menu_role AS namarole INTO namarole FROM menu_role WHERE id_menu_role = idrole;
	RETURN namarole;
    END$$

CREATE DEFINER=`admin`@`localhost` FUNCTION `getnamaunitkerja` (`idunitkerja` INT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE namaunitkerja TEXT;
	SELECT nama_unit_kerja AS namaunitkerja INTO namaunitkerja FROM unit_kerja WHERE id_unit_kerja = idunitkerja;
	RETURN namaunitkerja;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_karyawan`
--

CREATE TABLE `absen_karyawan` (
  `id_absen_karyawan` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `tgl_absen` date DEFAULT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `menit_lebih_masuk` int(11) DEFAULT NULL,
  `jam_keluar` datetime DEFAULT NULL,
  `menit_lebih_keluar` int(11) DEFAULT NULL,
  `kode_shift` varchar(4) COLLATE utf8_unicode_ci DEFAULT 'U',
  `id_sts_hadir` char(3) COLLATE utf8_unicode_ci DEFAULT 'H',
  `ket_hadir` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ket_pulang` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jam_izin_keluar` datetime DEFAULT NULL,
  `jam_izin_kembali` datetime DEFAULT NULL,
  `keterangan_izin` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `absen_karyawan`
--

INSERT INTO `absen_karyawan` (`id_absen_karyawan`, `id_karyawan`, `tgl_absen`, `jam_masuk`, `menit_lebih_masuk`, `jam_keluar`, `menit_lebih_keluar`, `kode_shift`, `id_sts_hadir`, `ket_hadir`, `ket_pulang`, `jam_izin_keluar`, `jam_izin_kembali`, `keterangan_izin`) VALUES
(72, 69, '2020-06-26', '2020-06-26 07:58:00', 53, NULL, NULL, 'U', 'HT', 'sdasd', NULL, NULL, NULL, NULL),
(73, 69, '2020-06-27', '2020-06-27 08:18:00', 73, '2020-06-27 08:19:00', -401, 'U', 'HT', 'sdasd', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_kegiatan_karyawan`
--

CREATE TABLE `absen_kegiatan_karyawan` (
  `id_absen_karyawan` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `tgl_absen` date DEFAULT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `id_sts_hadir` char(3) COLLATE utf8_unicode_ci DEFAULT 'H',
  `keterangan_izin` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_shift`
--

CREATE TABLE `absen_shift` (
  `id_shift` int(11) NOT NULL,
  `kode_shift` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nama_shift` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `toleransi_lambat` int(11) DEFAULT 0,
  `bc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `absen_shift`
--

INSERT INTO `absen_shift` (`id_shift`, `kode_shift`, `nama_shift`, `jam_masuk`, `jam_keluar`, `toleransi_lambat`, `bc`) VALUES
(3, 'SPT1', 'SATPAM SHIFT1', '07:00:00', '19:00:00', 5, '#01ff70'),
(4, 'SPT2', 'SATPAM SHIFT2', '19:00:00', '07:00:00', 5, '#00c0ef'),
(5, 'DPR1', 'DAPUR SHIFT1', '07:00:00', '21:00:00', 5, '#f39c12 '),
(6, 'DPR2', 'DAPUR SHIFT2', '12:00:00', '19:00:00', 5, '#f012be '),
(8, 'URT1', 'URT SHIFT1', '06:00:00', '14:00:00', 0, '#00a65a '),
(9, 'LBR', 'LIBUR', '00:00:00', '00:00:00', 0, '#dd4b39 ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_shift_karyawan`
--

CREATE TABLE `absen_shift_karyawan` (
  `id_shift_karyawan` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_shift` decimal(10,0) DEFAULT NULL,
  `tgl_absen` date DEFAULT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `jam_keluar` datetime DEFAULT NULL,
  `test` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `absen_shift_karyawan`
--

INSERT INTO `absen_shift_karyawan` (`id_shift_karyawan`, `id_karyawan`, `id_shift`, `tgl_absen`, `jam_masuk`, `jam_keluar`, `test`) VALUES
(7687, 1, '5', '2020-07-06', NULL, NULL, NULL),
(7688, 1, '6', '2020-07-06', NULL, NULL, NULL),
(7689, 1, '6', '2020-07-07', NULL, NULL, NULL),
(7690, 1, '6', '2020-07-08', NULL, NULL, NULL),
(7691, 1, '6', '2020-07-09', NULL, NULL, NULL),
(7692, 1, '6', '2020-07-10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_umum`
--

CREATE TABLE `absen_umum` (
  `id_absen_umum` int(11) NOT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `toleransi_lambat` int(11) DEFAULT NULL,
  `konversi_lambat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `absen_umum`
--

INSERT INTO `absen_umum` (`id_absen_umum`, `id_lembaga`, `jam_masuk`, `jam_keluar`, `toleransi_lambat`, `konversi_lambat`) VALUES
(1, 1, NULL, NULL, 0, NULL),
(3, 2, '07:00:00', '15:00:00', 5, 30),
(6, 3, '07:00:00', '15:00:00', 5, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_wajib`
--

CREATE TABLE `absen_wajib` (
  `id_absen_karyawan` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_acara` int(11) DEFAULT NULL,
  `tgl_absen` date DEFAULT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `id_sts_hadir` char(3) COLLATE utf8_unicode_ci DEFAULT 'H',
  `keterangan_izin` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `angkatan`
--

CREATE TABLE `angkatan` (
  `id_angkatan` int(11) NOT NULL,
  `id_lembaga` int(1) DEFAULT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `nama_angkatan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ket_angkatan` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_ubah` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_ubah` timestamp NOT NULL DEFAULT current_timestamp(),
  `sts_aktif` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `angkatan`
--

INSERT INTO `angkatan` (`id_angkatan`, `id_lembaga`, `id_departemen`, `nama_angkatan`, `ket_angkatan`, `user_ubah`, `tgl_ubah`, `sts_aktif`) VALUES
(20, 1, 1, '08', 'Siswa yang masuk pada tahun ajaran 2011-2012', NULL, '2019-05-04 04:35:22', 1),
(21, 1, 1, '09', 'Siswa yang masuk pada tahun ajaran 2012-2013', NULL, '2019-05-04 04:35:22', 1),
(22, 1, 1, '10', 'Siswa yang masuk pada tahun ajaran 2013-2014', NULL, '2019-05-04 04:35:22', 1),
(23, 1, 1, '11', 'Siswa yang masuk pada tahun ajaran 2014-2015', NULL, '2019-05-04 04:35:22', 1),
(24, 1, 1, '12', 'Siswa yang masuk pada tahun ajaran 2015-2016', NULL, '2019-05-04 04:35:22', 1),
(25, 1, 1, '13', 'Siswa yang masuk pada tahun ajaran 2016-2017', NULL, '2019-05-04 04:35:22', 1),
(26, 1, 1, '14', 'Siswa yang masuk pada tahun ajaran 2017-2018', NULL, '2019-05-04 04:35:22', 1),
(27, 1, 2, '11', 'Angkatan 11, Siswa yang masuk pada tahun ajaran 2017-2018', NULL, '2019-05-04 04:36:22', 1),
(28, 1, 2, '10', 'Angkatan 10, Siswa yang masuk pada tahun ajaran 2016-2017', NULL, '2019-05-04 04:36:22', 1),
(29, 1, 2, '09', 'Angkatan 09, Siswa yang masuk pada tahun ajaran 2015-2016', NULL, '2019-05-04 04:36:22', 1),
(30, 4, 7, '01', 'Angkatan 1, Siswa yang masuk pada tahun ajaran 2015-2016', NULL, '2019-05-04 04:50:08', 1),
(31, 4, 7, '02', 'Angkatan 2, Siswa yang masuk pada tahun ajaran 2016-2017', NULL, '2019-05-04 04:50:08', 1),
(32, 4, 7, '03', 'Angkatan 3, Siswa yang masuk pada tahun ajaran 2014-2015', NULL, '2019-05-04 04:50:08', 1),
(33, 3, 5, '01', 'Angkatan 1, Siswa yang masuk pada tahun ajaran 2015-2016', NULL, '2019-05-04 04:49:51', 1),
(34, 3, 5, '02', 'Angkatan 2, Siswa yang masuk pada tahun ajaran 2016-2017', NULL, '2019-05-04 04:49:51', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id_tamu` int(11) NOT NULL,
  `nama_tamu` varchar(125) NOT NULL,
  `no_hp_tamu` varchar(100) NOT NULL,
  `instansi_tamu` varchar(125) NOT NULL,
  `alamat_tamu` text NOT NULL,
  `tujuan_tamu` text NOT NULL,
  `image` text NOT NULL,
  `tanda_tangan` text NOT NULL,
  `tgl_bertamu` timestamp NULL DEFAULT current_timestamp(),
  `id_karyawan` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku_tamu`
--

INSERT INTO `buku_tamu` (`id_tamu`, `nama_tamu`, `no_hp_tamu`, `instansi_tamu`, `alamat_tamu`, `tujuan_tamu`, `image`, `tanda_tangan`, `tgl_bertamu`, `id_karyawan`) VALUES
(43, 'Akmalludin2', '82124283526', 'AL MATUQ', 'Parakansalak', 'memebahas PSB', 'data:image/jpeg;base64,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', 'data:image/png;base64,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', '2019-09-15 02:57:38', '400');
INSERT INTO `buku_tamu` (`id_tamu`, `nama_tamu`, `no_hp_tamu`, `instansi_tamu`, `alamat_tamu`, `tujuan_tamu`, `image`, `tanda_tangan`, `tgl_bertamu`, `id_karyawan`) VALUES
(54, 'Onyon', '8212323232322', 'Al-basam', 'asndkakdsa', 'asdsad', 'data:image/jpeg;base64,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', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABFIAAAEVCAYAAADD38F5AAAU9klEQVR4nO3da5CkV33f8QZUlMAmDgQhMDfHJg5htJfn/M6zw7AJbpdlg7kkFafkkmwDNqaMsbnEclDAxBUK7HIw5YJCIdwSJFmAZaJwMQrIGIMNxhhLSCBWXokVktBKIJBUIFbX1WXzgkFpPZ7Z3dmdmTPT/flUzRt2p/vb3aKrzn/Pc57RCAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACA0ajWOi6lnJtkd5J39n3ft24CAAAA2JBKKR9OcmDwc2+Sm5Ncl+SdrRsBAAAANoTF3SjDQcrw5/LWnQAAAADNLV7a8+EkNyS5dXE3ylLDlDNatwKMRqNRkrfaLQcAAGwYfd/3SV6d5LbBMOXU1m3AbEvyzonvpKtb9wAAANwnyROS3Dk5TOn7/sTWXcDsWjy7aXLA+zetmwAAAO5Taz15sGi5cfv27f+0dRcwmxYPwr7fpYe11v/dugsAAOA+Sd41uWgppXyidRMwm5Y7x6mU8qbWbQAAAPdJsnuwaHll6yZgtiye3zS8TfvkQOXXWzcCAACMRqPRqNZ6QpK7B8OUtO4CZsfiIdjf/w66ueu6bUnumvjf7knyr1t3AgAAjEaj0ajW+quDf/39SusmYHbUWr8x8f3zzdFoNCql/OLge2lf13XHtW4FAAAYjUajUa31/wx2pZzeugmYfknmBwOTMyf+7PWDP9vbMBUAAOD/O+mkkx6U5OuDYcpTW3cB0y3JVye+d+5Y4s/fNximfKFFJwAAwD/S9/3TBguW61o3AdOr1vrawXfO7y7195J8ZnBb5A+vdysAAMCSSilvGCxYzmndBEyf+fn5xyXZP/F9c+XB/n6SPYPvJrdFBgAANoYkF08uWPq+f27rJmC6JPnLwaWE/+Zgf388Hh9Ta73JbZEBAIANZ8uWLQ9PctvEYuWW1k3A9Ki1njIYovzF4fxeKeVfJblz4nfv6vv+aWvdCwAAcEhJfmOw0Pli6yZg85ubm/vBJMOdJT92uL+/OIS5d+J3vzs3N/fgtWwGAAA4LEl2Dc4keFbrJmBzK6X88WCI8saVPkaS1w0e45q1aAUAAFixJLdPLFaub90DbF611p8dDECuHY1GDzySx1ritsgXrnIuAADAyg0v8UlyZusmYHNKcu3gksFnHOXjfWbweG6LDAAAtFdK+fuJxcq9SZ7cugnYXJKcORh6vH2VHnfPYNj7ltV4XAAAgCOW5KFJ9k8sVL7SugnYPPq+P3Ew7Ni7ig//gCUOr335Kj4+AADAyiX5g8FC5Q9aNwGbQ5LvTnx33FNr7Vbz8Wut/zLJHZPP0ff9iav5HAAAACs22EK/P8kjWzcBG1uSrw3u/nXaWjxP3/c/N7gt8m193z9+LZ4LAADgsHRd95TBguiC1k3AxpXk84OdbLvW8vlqrb8zeL4b1vL5AAAADinJWYNhyktbNwEbT5JPD4YaX1+n533n4FDbb67H8wIAACwryTcnFiq3jMfjY1s3ARtHko8PhihXrvPznzd4/mvW8/kBAADup+/75w4WKX/eugnYGJJ8ZPD9cN14PD6mQccVg50pX1zvBgAAgPsk+fPBIuWZrZuAtkop5w6GKDd2XXdcq55a695Bz0WtWgAAgBmX5KFJbl3v8w+AjSnJewdDi307duz48Q3Q9Q+DrgtbNwEAADMqyamDBcpbWjcB66/W+u7Bd8H+JPOtu74vyWWGKQAAwIZQa901sTi5e35+/vjWTcD6SfK2wZBiQ17ql+Qrg86LWzcBAAAzaPv27f9isDj5fOsmYH0keetwiJLkF1p3LWeJYcolrZsAAIAZlOTMweLkBa2bgLW11BCllPKbrbsOJcnuQfelrZsAAIAZlOSGiYXJTa17gLWzzE6U/9K663AluXTQvrt1EwAAMGNqrScPFibvad0ErL5lhih/1LprpZJcMngNX2ndBAAAzJhSymcnFiX3llKe1LoJWD1LDVFqre9u3XWkklw8eD1XtG4CAABmSJKHJrnT2QMwfZbZifLB1l1HK8mFg3NermrdBAAAzJAkbxwsSk5r3QQcnWV2ovzVeDw+pnXbaiil/P3g9V3ZugkAAJghSa6eWJDc2boHOHLL7ET5XNd1x7VuW01J/m7wGve0bgIAAGZE13VPHyxIvtC6CVi5ZYYon9myZcvDW7ethSWGKZe1bgIAAGZEki9NHjw7bf96DdNumSHKp3bu3Pmw1m1rqdZ6weA1X9u6CQAAmBFJ7ppYjPxN6x7g8CwzRPn4wsLCQ1q3rYcl7uZjZwoAALD2SinvGCxG5ls3AQe31BCllPLRaTlY9nAluWbwPrytdRMAADADktzsdsiwOSxzd54/a93VSpKbBu/F81s3AQAAU66U8l8HC5GTWzcB/1iSdy1xOc8HWne1NDc39+gkt0/szLkjyWNadwEAAFMuyTcmFmZ7W/cA91drPWeJnSjvaN21EXRd9zyHzwIAAOuq1vqrg4XIqa2bgO9Jct4SQ5TXtO7aSJL8j8F75PBsAABgbSXZM7EIuaF1DzAa1Vr/eomDZX+pdddGlOQzg2HT21s3AQAAUyzJswcLtte1boJZluSqwf8n93Vd9/TWXRtZkr2D9+wFrZsAAIApluSSiQXIza17YBaVUn4+ya2DgcA3tm/f/iOt2za6rVu3Pmry8Nkkd3Rd98OtuwAAgCk1Pz//1MHi7c2tm2BWzM3NPTjJ/13izjzXj0ajB7Tu2yxKKb/k8FkAAGDdJPn8xALkttY9MAsWd6HcvMQQ5ZLWbZuRw2cBAIB1s7Cw8KTBAuSM1k0wrfq+f3yS85cYoNzS9/2vtO7bzJY4fPZtrZsAAIApleSTEwuQ/QsLCw9p3QTTJsnLkuxf4q48n52bm/vB1n3TYHj4bNd1z2/dBAAATKHFAxvvnViAfKh1E0yLvu/7pW5rvPjz2637pskJJ5xw/ODw2dvn5uYe3boLAACYQqWUD08sPu7dtm3bY1s3wWZXa/39ZQYou2utXeu+adR13fMG7/VNrZsAAIAptHPnzocluWti8fHJ1k2wWZVSnpPk0qWGKLXWN7Xum3ZLHD57w3g8PrZ1FwAAMGVKKWcPFnwntG6CzSTJI5P8z2V2oXynlPLzrRtnRZLLB+//vq7rTmzdBQAATJHxeHxMkjsmFh4Xtm6CzSLJi5LcuMwQ5bwkT2jdOGtKKXsGn8M9SV7VugsAAJgitdbTB3cUeUbrJtjI+r6fWxyULDVAOZDkP7VunGXDnXaL32tnt+4CAACmSJKbJxYdV7bugY2q1vqa5QYotdaP9X0/17qR0SjJqxZ3o0x+RntadwEAAFOi1nraYMHxitZNsJF0XfdTtdYLlhmi3Jnk5a0bub+u605Msm/wWZ3RugsAAJgSSb7m9qFwf0keWko5fZkByoEkHyqlPKl1J0sbj8fH1lpvs+MOAABYdYu3b51cIL6ldRO0lOQXkuxdZoCyr9b64taNHFop5d0Tn9ve1j0AAMAUGVy6cFfrHmih7/sfTfL+g+xCeb878mweSd44cejsvtY9AADAFEnyhCT3Tiw6Lm3dBOspyalJ9i8zQLmxlPIrrRtZmSR/NPEZ3ty6BwAAmDJJLhosHh2iydTbsWPHQpJPH+SOPGf3ff/o1p2sXCnlTROf5bdb9wAAAFMoyS0TC487FhYWHtG6CdbIA0opbzjIZTwXl1Ke2zqSI1dKeevE5/mt1j0AAMAUKqU8Y/Cv8btaN8FqK6X8+ySXLzNA2Z/kVa0bOXqllP818ble07oHAACYUknOGgxT/nvrJlgNSR4z/O97eBnP9u3bf6R1J6sjyXsmPt89rXsAAIApVmu9cnKB2XXd01s3wdFI8pJa63eXGaJclOTZrRtZXaWUcyc+4y+37gEAAKZYkidP3sUnyQ3j8fjY1l2wUn3fb09y/jIDlDtrrae1bmRtJDlv4k5kF7TuAQAAplyt9fcGi87zWzfBStRaX3uQw2TP6rruia0bWTtJvjzxeV/WugcAAJgBS9wS+SWtm+BQSinPTHLVMgOUC2utz2rdyNpLcunEjpRLW/cAAAAzoO/7H01y1+RCtJSS1l2wlCQ/lOSDywxQrq+1vrh1I+snyacmPv9Pte4BAABmRCnl1wYL0q+2boKhUsork9y2xADlriS/e9JJJz2odSPryyAFAABoppTyicHi9E9bN8FoNBolKUkuX2YXyhlJHtO6kTYMUgAAgGbm5+f/SZKvDxapL2rdxewaj8fHJrlkqQFKrfVvu67b1rqRtgxSAACApmqtOwa3RL47yZNbdzFb+r6fK6X81eC/xe//7K21/mzrRjaGWuspE8O1k1v3AAAAM6jW+sLBwvXq1k3Mhlrrv6217lrmEp79SV7fupGNp9Z6Sq31lNYdAADADKu1/vFgEfuR1k1Mp507dz4syalJrl9mgHJ3kotbdwIAAMBBDc+mKKWc1rqJ6dH3/fYkbx3eenvi59Ykb2vdCQAAAIdlcafAzYNbzDovhaNSa/0PSc5fZnhyIMl3kryudScAAACsWNd1PzVY5H67dRObz8LCwiNqracl+epBBig3dF33statAAAAcFRKKX84uO3s3tZNbA593/e11nckuecgA5TrkvxG61YAAABYNUl2Dxa/u1s3sXHVWk+utX7iIMOTA0muSvKS1q0AAACwJpLsHSyE9ywsLDykdRcbw/z8/PG11tcsDkiWHaDUWv+21vr81r0AAACw5pJ8abAwvnrr1q2Pat1FO33fP63W+u5D7D45UEo5t9b60617AQAAYF0tMUz5einlSa27WF+11ufVWv/6EAOUu0opp/d9P9e6FwAAAJpJcslgwXxjrbVr3cXamp+ff1yt9bVJrj3EAOVrSV69sLDwiNbNAAAAsBE8MMmXB4vnfX3f/0TrMFZf3/c/UWs9+1CX7yT5XCnll1v3AgAAwIazdevWH0hy6WAhfXcp5Tmt21gdtdYXJvncYQxQ3pPkZ1r3AgAAwIa2Y8eOf5bksiXuzHJK6zaOzI4dO/55rfX3k9x0iOHJrlLKK+fn549v3QwAAACbRt/3j07yhSWGKS9u3cbh6/v+xCQfOIzdJ++1+wQAAACOzgNLKR9bYtH9+tZhLO+kk056UK31xUmuONjwpNZ6Wa31NLtPAAAAYBUlOWOJRfg5rbu4vx07dvx4KeVPktxxiN0n7yulPKN1LwAAAEytJK9bYkH+1fF4fGzrtllXSvm1JP9wiOHJxUletnXr1ke17gUAAICZUGt9VpLbBgv0e5J8sOu6p7TumyVJnp3kokPsPvlWkv/W9/1c614AAACYSYuH0C5355dPJnl268ZpMzc39+Ba67iUcvri3ZTuPsjwZH8p5fwkP9m6GwAAAFhUa70gyb3LLOavqLW+1GU/RybJI2ut/66U8oYklxzGHXcOJNmT5LdbtwMAAADL2LZt22OTfPwgi/s7krzLZT8Hl+THaq3PL6W8Pcnlhzk4OZDkO0k+vW3btse2fg0AAADAYaq1jg8xUDmwuLPiBa1bN4Ikpdb60sU77Fy3gsHJ/iSfS3Jqkh9q/ToAAACAo1Br7WqtZx1sGFBrvb2U8sUkL+/7/vGtm9fa9883qbW+ptb60ST7VjA4OVBrvTHJmaWU57R+LQAAAMAaWFhYeESSF5VSLjiMYcFdi7sy/rKU8ntJfmZ+fv5xrV/DkRqcb3LxSoYmiz+3lFI+kuTUUkpavx4AAABgHXVdd1yt9bVJrl7hQOG2JLuSnFFK+Y8bdcCyeL7Jb5VSPprkG0cwOLl98Xf/cynlqa1fDwAAALBBdF33xFrrx2qt1y8OSlY6dDiQ5NYku2qt55RSfmuVBiwP2Lp16w90XXdc13VP7LruKV3X1a7rnl5KeWat9YWllN9J8uYk76217kpyfb53mO5K+6+otZ6d5BW11p2r8sYCAAAA02/r1q2PSvKCJO9JsruUciSDicmDWL+V5Jokl9daP5vk80kuyvcOut2d5IokX1vcOXJjku8mufMonvNQP99Kcl6SV9daf3rLli0Pb/2eAwAAAFOk67qnlFJ+OclZtdaV3Aq45c+dSa5K8qG+71+R5Cfn5+ePb/1eAgAAADNmPB4fm2RLKeXnaq2nJXlfki8l+c46DkruSPLtUsq1iztb9iS5MMlLuq774dbvEQAAAMDheGCSx/R9v72U8ou11j9cvJTn0iQfr7V+LMl5pZQ/S/KhJB8opZyb5P2llD+ttZ5Ta/2TxeHMmxcvwXlhrfVZpZRs27btsePx+JjWLxIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABo7/8BFV2PVBrnVQIAAAAASUVORK5CYII=', '2020-10-14 20:18:28', '397');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int(3) NOT NULL,
  `id_lembaga` int(3) DEFAULT NULL,
  `nama_departemen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan_departemen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kepala_departemen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat_departemen` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notlp_departemen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notlp_departemen2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_departemen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_departemen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_departemen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon_departemen` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `sts_aktif` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `id_lembaga`, `nama_departemen`, `keterangan_departemen`, `kepala_departemen`, `alamat_departemen`, `notlp_departemen`, `notlp_departemen2`, `fax_departemen`, `email_departemen`, `web_departemen`, `icon_departemen`, `urutan`, `sts_aktif`) VALUES
(1, 1, 'MTS Al-Ma`tuq', 'MTS Al-Ma`tuq', 'handy', 'MTS Al-Ma`tuq', '123', '123456', '456', 'handy@', 'www', NULL, 0, 1),
(2, 1, 'MA AL-Ma`tuq', 'MA Al-Ma`tuq', 'handy', 'Jalan Cikaroya', '123', '123456', '456', 'handy@gmail.com', 'www', '3b6e1976b28dce161ad2cf15909cca74.jpg', 1, 1),
(3, 2, 'MTS AL-Zamil', 'MTS AL-Zamil', 'handy', 'Jalan Cikaroya', '123', '123456', '456', 'handy@gmail.com', 'www', '3b6e1976b28dce161ad2cf15909cca74.jpg', 2, 1),
(4, 2, 'MA AL-Zamil', 'MA AL-Zamil', 'handy', 'Jalan Cikaroya', '123', '123456', '456', 'handy@gmail.com', 'www', '3b6e1976b28dce161ad2cf15909cca74.jpg', 3, 1),
(5, 3, 'MTS AL-Bassam', 'MTS AL-Bassam', 'handy', 'cikaroya', '123', '123456', '1', '', '', NULL, 4, 1),
(6, 3, 'MA AL-Bassam', 'MA AL-Bassam', 'handy', 'MA AL-Bassam', '123', '123456', '1', '', '', NULL, 5, 1),
(7, 4, 'SD AL-`Unaizy', 'SD AL-`Unaizy', 'handy', 'SD AL-`Unaizy', '123', '123456', '1', '', '', NULL, 6, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_berkas_karyawan`
--

CREATE TABLE `file_berkas_karyawan` (
  `id_berkas_foto` int(11) NOT NULL,
  `id_karyawan` varchar(250) NOT NULL,
  `nama_foto` varchar(250) NOT NULL,
  `id_type_berkas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `file_berkas_karyawan`
--

INSERT INTO `file_berkas_karyawan` (`id_berkas_foto`, `id_karyawan`, `nama_foto`, `id_type_berkas`) VALUES
(26, '163', '16354bd073aaddcdda2494f7b15eaa65.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gol_darah`
--

CREATE TABLE `gol_darah` (
  `id` int(11) NOT NULL,
  `goldarah` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `gol_darah`
--

INSERT INTO `gol_darah` (`id`, `goldarah`) VALUES
(2, 'A'),
(3, 'A+'),
(4, 'A-'),
(5, 'O'),
(6, 'O+'),
(7, 'O-'),
(8, 'AB'),
(9, 'AB+'),
(10, 'AB-'),
(1, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari_libur`
--

CREATE TABLE `hari_libur` (
  `id_kalender` int(11) NOT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `tgl_kalender` date NOT NULL,
  `ket_kalender` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_hubungan`
--

CREATE TABLE `jenis_hubungan` (
  `id_hubungan` int(10) UNSIGNED NOT NULL,
  `nama_hubungan` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `jenis_hubungan`
--

INSERT INTO `jenis_hubungan` (`id_hubungan`, `nama_hubungan`) VALUES
(1, 'Suami'),
(2, 'Istri'),
(3, 'Anak'),
(4, 'Orang Tua'),
(5, 'Saudara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_jabatan`
--

CREATE TABLE `jenis_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `jenis_jabatan`
--

INSERT INTO `jenis_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Kepala'),
(2, 'Wakil Kepala'),
(3, 'Koordinator'),
(4, 'Staff'),
(6, 'ok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pekerjaan`
--

CREATE TABLE `jenis_pekerjaan` (
  `id_kerja` int(11) UNSIGNED NOT NULL,
  `nama_pekerjaan` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `jenis_pekerjaan`
--

INSERT INTO `jenis_pekerjaan` (`id_kerja`, `nama_pekerjaan`) VALUES
(1, 'Belum / Tidak Bekerja'),
(2, 'Mengurus Rumah Tangga'),
(3, 'Pelajar / Mahasiswa'),
(4, 'Pensiunan'),
(5, 'Pegawai Negeri Sipil'),
(6, 'TNI'),
(7, 'Polri'),
(8, 'Perdagangan'),
(9, 'Petani/Pekebun'),
(10, 'Peternak'),
(11, 'Nelayan/Perikanan'),
(12, 'Industri'),
(32, 'Kontruksi'),
(35, 'Transportasi'),
(36, 'Karyawan Swasta'),
(37, 'Karyawan BUMN'),
(44, 'Karyawan BUMD'),
(57, 'Karyawan Honorer'),
(58, 'Buruh Harian Lepas'),
(60, 'Buruh Tani/ Perkebunan'),
(61, 'Buruh Nelayan / Perikanan'),
(65, 'Buruh Peternakan'),
(67, 'Tukang Cukur'),
(71, 'Tukang Listrik'),
(74, 'Tukang Batu'),
(88, 'Tukang Kayu'),
(89, 'Tukang Sol Sepatu'),
(90, 'Tukang Las / Pandai Besi'),
(92, 'Tukang Jahit'),
(93, 'Penata Rambut'),
(95, 'Penata Rias'),
(96, 'Perancang Busana'),
(98, 'Penterjemah'),
(99, 'Imam Masjid'),
(100, 'Ustadz / Mubaligh'),
(101, 'Juru Masak'),
(102, 'Promotor Acara'),
(103, 'Anggota DPR-RI'),
(104, 'Anggota DPD'),
(105, 'Anggota BPK\r\n'),
(106, 'Presiden'),
(107, 'Wakil Presiden'),
(108, 'Anggota Mahkamah Konstitusi'),
(109, 'Anggota Kabinet / Kementerian'),
(110, 'Duta Besar'),
(111, 'Gubernur'),
(112, 'Wakil Gubernur\r\n'),
(113, 'Bupati'),
(114, 'Wakil Bupati'),
(115, 'Walikota'),
(116, 'Wakil Walikota'),
(117, 'Anggota DPRD Propinsi'),
(118, 'Anggota DPRD Kabupaten / Kota'),
(119, 'Dosen'),
(120, 'Guru'),
(121, 'Pilot'),
(122, 'Pengacara'),
(123, 'Notaris'),
(124, 'Arsitek'),
(125, 'Akuntan'),
(126, 'Programmer'),
(127, 'Dokter'),
(128, 'Bidan'),
(129, 'Perawat'),
(130, 'Wiraswasta'),
(131, 'Pedagang'),
(132, 'Kepala Desa'),
(133, 'Sopir'),
(134, 'Penyiar Radio'),
(135, 'Penyiar Televisi'),
(136, 'Psikiater / Psikolog'),
(137, 'Apoteker'),
(138, 'Konsultan'),
(139, 'Ibu Rumah Tangga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pendapatan`
--

CREATE TABLE `jenis_pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `nama_pendapatan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `kd_nominal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `jenis_pendapatan`
--

INSERT INTO `jenis_pendapatan` (`id_pendapatan`, `nama_pendapatan`, `urutan`, `kd_nominal`) VALUES
(1, 'Gaji Pokok', 0, NULL),
(2, 'Tj Struktural', 1, NULL),
(3, 'Tunj. Wali Kelas', 2, NULL),
(4, 'Tunj. Istri', 0, NULL),
(5, 'Tunj. Anak', 0, NULL),
(6, 'Tunj. BQ /TQ', 0, NULL),
(7, 'Tunj. Transport', 0, NULL),
(8, 'Tunj. KJK/Lembur', 0, NULL),
(9, 'Tunj. Dispensasi', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pendidikan`
--

CREATE TABLE `jenis_pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `nama_pendidikan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `jenis_pendidikan`
--

INSERT INTO `jenis_pendidikan` (`id_pendidikan`, `nama_pendidikan`) VALUES
(0, 'BELUM SEKOLAH'),
(1, 'TK/PAUD'),
(2, 'SD'),
(3, 'SMP'),
(4, 'SMA'),
(7, 'D1'),
(8, 'D2'),
(9, 'D3'),
(10, 'S1'),
(11, 'S2'),
(12, 'S3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nip_karyawan` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nik_karyawan` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_kk` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nrp_karyawan` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nuptk_karyawan` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `panggilan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gelar_awal` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gelar_akhir` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Islam',
  `jenis_kelamin` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `golongan_darah` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_pernikahan` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_sts_karyawan` int(11) DEFAULT NULL,
  `alamat_karyawan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kel_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kec_karyawan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kota_karyawan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provinsi_karyawan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `sts_akademik` int(2) DEFAULT NULL,
  `tgl_berkerja` date DEFAULT NULL,
  `tgl_resign` date DEFAULT NULL,
  `photo_profile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sidik_jari` longblob DEFAULT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin` int(6) DEFAULT NULL,
  `nfc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_level_pengguna` int(3) DEFAULT NULL,
  `id_level_aplikasi` int(3) DEFAULT NULL,
  `akses_antar_lembaga` char(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `akses_antar_departemen` char(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `sts_user` int(1) DEFAULT 1,
  `id_tinggal` int(1) DEFAULT 0,
  `id_sts_aktif` int(1) DEFAULT NULL,
  `ts` timestamp NULL DEFAULT current_timestamp(),
  `sts_data` int(11) DEFAULT 0,
  `user_hapus` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT NULL,
  `flag_absen` char(1) COLLATE utf8_unicode_ci DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nip_karyawan`, `nik_karyawan`, `no_kk`, `nrp_karyawan`, `nuptk_karyawan`, `nama_karyawan`, `nama_ibu`, `panggilan`, `gelar_awal`, `gelar_akhir`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `golongan_darah`, `status_pernikahan`, `id_sts_karyawan`, `alamat_karyawan`, `kel_karyawan`, `kec_karyawan`, `kota_karyawan`, `provinsi_karyawan`, `no_hp`, `email`, `id_lembaga`, `id_departemen`, `id_unit_kerja`, `sts_akademik`, `tgl_berkerja`, `tgl_resign`, `photo_profile`, `user_name`, `sidik_jari`, `pass`, `pin`, `nfc`, `id_level_pengguna`, `id_level_aplikasi`, `akses_antar_lembaga`, `akses_antar_departemen`, `sts_user`, `id_tinggal`, `id_sts_aktif`, `ts`, `sts_data`, `user_hapus`, `tgl_hapus`, `flag_absen`) VALUES
(1, '0119970601001', NULL, NULL, NULL, NULL, 'DR. Ade Hermansyah, Lc.,M.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '1997-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(2, '0119980701001', NULL, NULL, NULL, NULL, 'Ujang Ridwan,S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '1998-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(3, '0119990301001', NULL, NULL, NULL, NULL, 'Buldan Taufik, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '1999-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(4, '0119990701001', NULL, NULL, NULL, NULL, 'Denie Fauzie Ridwan S.Pi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '1999-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(5, '0120040801001', NULL, NULL, NULL, NULL, 'Irwansyah Ramdani, S.S., M.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 8, NULL, '2004-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(6, '0120080714001', NULL, NULL, NULL, NULL, 'Muh. Gaus, S.Kom., M.M', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 8, NULL, '2008-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(7, '0120090719001', NULL, NULL, NULL, NULL, 'Muhammad Wahyudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2009-07-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(8, '0120090801001', NULL, NULL, NULL, NULL, 'Ryan Andrian Firdausa, S.Si', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2009-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(9, '0120100526001', NULL, NULL, NULL, NULL, 'Nana Supriatna', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2010-05-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(10, '0120100701001', NULL, NULL, NULL, NULL, 'Yahya Muhammad, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2010-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(11, '0120100801001', NULL, NULL, NULL, NULL, 'Daman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2010-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(12, '0120100901001', NULL, NULL, NULL, NULL, 'Suhaiban, S.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2010-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(13, '0120110119001', NULL, NULL, NULL, NULL, 'Uus Hanan Alusman, S.Si', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-01-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(14, '0120110319001', NULL, NULL, NULL, NULL, 'Nurdin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-03-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(15, '0120110501001', NULL, NULL, NULL, NULL, 'Cecep Rudi Kelana', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(16, '0120110502002', NULL, NULL, NULL, NULL, 'Sihabudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(17, '0120110701001', NULL, NULL, NULL, NULL, 'Bruri Dana Saputra, S.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(18, '0120110701002', NULL, NULL, NULL, NULL, 'Luqman Nul Hakim, S.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(19, '0120110801001', NULL, NULL, NULL, NULL, 'Ujang Sobandi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(20, '0120110812003', NULL, NULL, NULL, NULL, 'Lalan suparlan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-08-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(21, '0120110917002', NULL, NULL, NULL, NULL, 'Muslim Kuswardi, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-09-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(22, '0120120501001', NULL, NULL, NULL, NULL, 'Deri Pardono', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2012-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(23, '0120120601001', NULL, NULL, NULL, NULL, 'Muhammad Zaenudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2012-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(24, '0120120701002', NULL, NULL, NULL, NULL, 'Ujang Rahmat Solih Ginanjar, Lc., M.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(25, '0120130701002', NULL, NULL, NULL, NULL, 'Anfalullah, Lc., M.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(26, '0120130701003', NULL, NULL, NULL, NULL, 'Cecen, S.Ag', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(27, '0120130701004', NULL, NULL, NULL, NULL, 'Hardi Suhendra', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(28, '0120130701005', NULL, NULL, NULL, NULL, 'Heri Supriatna', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(29, '0120130901001', NULL, NULL, NULL, NULL, 'Daud Firdaus, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2013-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(30, '0120131007001', NULL, NULL, NULL, NULL, 'Abdurahman Zaelani', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2013-10-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(31, '0120140215001', NULL, NULL, NULL, NULL, 'Fahrudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2014-02-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(32, '0120140901001', NULL, NULL, NULL, NULL, 'Sumpena, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2014-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(33, '0120140901002', NULL, NULL, NULL, NULL, 'Supriyana Rijal', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2014-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(34, '0120141201001', NULL, NULL, NULL, NULL, 'Hasan Asy\'ari Hamzah, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2014-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(35, '0120150202002', NULL, NULL, NULL, NULL, 'Luthfi Junaedi Abdillah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2015-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(36, '0120150316001', NULL, NULL, NULL, NULL, 'Udi Samhudi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2015-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(37, '0120150624001', NULL, NULL, NULL, NULL, 'Ali Muchtar, S.Sos', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2015-06-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(38, '0120150723002', NULL, NULL, NULL, NULL, 'Iyan Sofyan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(39, '0120150803002', NULL, NULL, NULL, NULL, 'Didi Sumanto', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2015-08-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(40, '0120150903001', NULL, NULL, NULL, NULL, 'Asep Saepul Kamil', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2015-09-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(41, '0120151031002', NULL, NULL, NULL, NULL, 'Agung Irfan Rachman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2015-10-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(42, '0120160225002', NULL, NULL, NULL, NULL, 'Jajang Abdullatief', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-02-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(43, '0120160401001', NULL, NULL, NULL, NULL, 'Azis Mustofa', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(44, '0120160531001', NULL, NULL, NULL, NULL, 'Muhammad Zubair', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(45, '0120160716004', NULL, NULL, NULL, NULL, 'Fitri Bin Dede, Lc.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(46, '0120160716005', NULL, NULL, NULL, NULL, 'Harpin Firmansyah, A.Md.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(47, '0120160716006', NULL, NULL, NULL, NULL, 'Muhammad Ali, Lc., M.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(48, '0120160716007', NULL, NULL, NULL, NULL, 'Tono Martono, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(49, '0120160719015', NULL, NULL, NULL, NULL, 'Asep Rival Munawar, Lc.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-07-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(50, '0120160803006', NULL, NULL, NULL, NULL, 'Hayatul Maqi, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-08-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(51, '0120161122002', NULL, NULL, NULL, NULL, 'Ilham Elsipa. S.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-11-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(52, '0120170316001', NULL, NULL, NULL, NULL, 'Zamzam Zamhur Munawwar', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(53, '0120170409001', NULL, NULL, NULL, NULL, 'Nursiwan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-04-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(54, '0120170426002', NULL, NULL, NULL, NULL, 'Mochamad Yusuf Hikmah, S.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(55, '0120170515002', NULL, NULL, NULL, NULL, 'Muhammad Rusli Agustian, S.IP', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(56, '0120170713004', NULL, NULL, NULL, NULL, 'Alen Aliandi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(57, '0120170713005', NULL, NULL, NULL, NULL, 'Fauzan Zaelani, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(58, '0120170713006', NULL, NULL, NULL, NULL, 'Muhammad Ichsan, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(59, '0120170713007', NULL, NULL, NULL, NULL, 'Saepulloh, S.Sos', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(60, '0120170713008', NULL, NULL, NULL, NULL, 'Zaeni Abdillah, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(61, '0120170816004', NULL, NULL, NULL, NULL, 'Patuh Abdillah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-08-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(62, '0120170912003', NULL, NULL, NULL, NULL, 'Taslim Koli, S.Kep.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(63, '0120170916006', NULL, NULL, NULL, NULL, 'Suwandi Taryana', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(64, '0120171101001', NULL, NULL, NULL, NULL, 'Abdullah Aleng, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(65, '0120180220002', NULL, NULL, NULL, NULL, 'Cecep Irman. A.Md.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(66, '0120180306003', NULL, NULL, NULL, NULL, 'Yadi Suryadi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-03-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(67, '0120180412003', NULL, NULL, NULL, NULL, 'Andri Gumanti', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-04-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(68, '0120180511001', NULL, NULL, NULL, NULL, 'Nanang Setiawan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-05-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(69, '0120180710011', '123123123', NULL, NULL, NULL, 'Handy Sadikin, SE', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085624261010', 'sadikinhandy84@gmail', 1, 1, 1, NULL, '2018-07-10', NULL, NULL, NULL, NULL, NULL, 123123, 'AC2CFB19', NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(70, '0120180712012', NULL, NULL, NULL, NULL, 'Drs.Deden Trenggana', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(71, '0120180712013', NULL, NULL, NULL, NULL, 'Hasanudin, A.Md. Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(72, '0120180712014', NULL, NULL, NULL, NULL, 'Mochammad Restu Fauzi, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(73, '0120180712015', NULL, NULL, NULL, NULL, 'Muhammad Khobir, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(74, '0120180712016', NULL, NULL, NULL, NULL, 'Nurhuda, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(75, '0120180712017', NULL, NULL, NULL, NULL, 'Robi Saepurohman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(76, '0120180730030', NULL, NULL, NULL, NULL, 'Miftahu Rohman, S.Psi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-07-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(77, '0120180730031', NULL, NULL, NULL, NULL, 'Munaji Habibullah, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-07-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(78, '0120180813001', NULL, NULL, NULL, NULL, 'Sudrajat, S.E', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-08-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(79, '0120180903004', NULL, NULL, NULL, NULL, 'Ridwan Sakti, A.Md.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-09-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(80, '0120180915006', NULL, NULL, NULL, NULL, 'Mahfudz, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-09-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(81, '0120181006001', NULL, NULL, NULL, NULL, 'Arif Murdani, A.Md. Kep', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-10-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(82, '0120190115012', NULL, NULL, NULL, NULL, 'Doni Rivandi, S.E', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-01-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(83, '0120190124015', NULL, NULL, NULL, NULL, 'Reza Rivo Firdaus, S.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-01-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(84, '0120190128016', NULL, NULL, NULL, NULL, 'Moh. Haerurahman, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-01-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(85, '0120190211004', NULL, NULL, NULL, NULL, 'Ahmad Salim, S.H.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-02-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(86, '0120190218005', NULL, NULL, NULL, NULL, 'Syaifullah Irfan, S.T', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-02-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(87, '0120190302001', NULL, NULL, NULL, NULL, 'Suyandi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(88, '0120190402002', NULL, NULL, NULL, NULL, 'Ruby Ismail', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-04-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(89, '0120190617015', NULL, NULL, NULL, NULL, 'Abdul Rohman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(90, '0120190617016', NULL, NULL, NULL, NULL, 'Abdul Sadad, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(91, '0120190617017', NULL, NULL, NULL, NULL, 'Acep Makmun Muharom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(92, '0120190617018', NULL, NULL, NULL, NULL, 'Ade Ridwan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(93, '0120190617019', NULL, NULL, NULL, NULL, 'Ahmad Fadhil', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(94, '0120190617020', NULL, NULL, NULL, NULL, 'Ahmad Rizal Khoiri', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(95, '0120190617021', NULL, NULL, NULL, NULL, 'Akhid Putrayana', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(96, '0120190617022', NULL, NULL, NULL, NULL, 'Ali Abdillah Rifa\'i', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(97, '0120190617023', NULL, NULL, NULL, NULL, 'Alvan Maulana', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(98, '0120190617024', NULL, NULL, NULL, NULL, 'Andaya Maula Abada Putra', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(99, '0120190617025', NULL, NULL, NULL, NULL, 'Arif Ramadhan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(100, '0120190617026', NULL, NULL, NULL, NULL, 'Aris Setiawan, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(101, '0120190617027', NULL, NULL, NULL, NULL, 'Aulia Akbar', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(102, '0120190617028', NULL, NULL, NULL, NULL, 'Azra Ibnu Hasan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(103, '0120190617029', NULL, NULL, NULL, NULL, 'Daffa Agussandy Ikhsan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(104, '0120190617030', NULL, NULL, NULL, NULL, 'Dimas Denisa', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(105, '0120190617031', NULL, NULL, NULL, NULL, 'Dzakwan Haidar Ar Ramadhan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(106, '0120190617032', NULL, NULL, NULL, NULL, 'Farhan Al Badri', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(107, '0120190617033', NULL, NULL, NULL, NULL, 'Fauzan Rizky Aditya', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(108, '0120190617034', NULL, NULL, NULL, NULL, 'Ghazy Ahmad Filando', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(109, '0120190617035', NULL, NULL, NULL, NULL, 'Hanif Eka Yudha', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(110, '0120190617036', NULL, NULL, NULL, NULL, 'Iskan Iskariman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(111, '0120190617037', NULL, NULL, NULL, NULL, 'Jihad Naufal Fakhrullah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(112, '0120190617038', NULL, NULL, NULL, NULL, 'Kahfi Rizqia Sugiana', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(113, '0120190617039', NULL, NULL, NULL, NULL, 'M. Ruhul Falach', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(114, '0120190617040', NULL, NULL, NULL, NULL, 'Malik Abdul Jabbar', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(115, '0120190617041', NULL, NULL, NULL, NULL, 'Maulana Malik Ibrahim', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(116, '0120190617042', NULL, NULL, NULL, NULL, 'Muhamad Abdul Aziz', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(117, '0120190617043', NULL, NULL, NULL, NULL, 'Muhamad Farhan Zulfa Khutomi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(118, '0120190617044', NULL, NULL, NULL, NULL, 'Muhammad Fadhil', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(119, '0120190617045', NULL, NULL, NULL, NULL, 'Muhammad Fajar Ilhami', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(120, '0120190617046', NULL, NULL, NULL, NULL, 'Muhammad Isham Supriatna', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(121, '0120190617047', NULL, NULL, NULL, NULL, 'Muhammad Naufal Abdullah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(122, '0120190617048', NULL, NULL, NULL, NULL, 'Muhammad Nurdin, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(123, '0120190617049', NULL, NULL, NULL, NULL, 'Muhammad Qudwatul Ibad', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(124, '0120190617050', NULL, NULL, NULL, NULL, 'Muhammad Rakan Harids', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(125, '0120190617051', NULL, NULL, NULL, NULL, 'Mumuh, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(126, '0120190617052', NULL, NULL, NULL, NULL, 'Mushtafainal Akhyaar', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(127, '0120190617053', NULL, NULL, NULL, NULL, 'Nur Muhammad Rifqi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(128, '0120190617054', NULL, NULL, NULL, NULL, 'Paishal Dawwas Sidki', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(129, '0120190617055', NULL, NULL, NULL, NULL, 'Rachmad Akbar Maulana ', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(130, '0120190617056', NULL, NULL, NULL, NULL, 'Raihan Azkiya', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(131, '0120190617057', NULL, NULL, NULL, NULL, 'Riyas Pebriansyah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(132, '0120190617058', NULL, NULL, NULL, NULL, 'Rizky Andrean Sefa', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(133, '0120190617059', NULL, NULL, NULL, NULL, 'Satria Jatnika', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(134, '0120190617060', NULL, NULL, NULL, NULL, 'Sayid Muhammad Heykal', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(135, '0120190617061', NULL, NULL, NULL, NULL, 'Sulaiman Abel', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(136, '0120190617062', NULL, NULL, NULL, NULL, 'Syaddad Abdurrasyid Fillah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(137, '0120190617063', NULL, NULL, NULL, NULL, 'Syahril Amir', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(138, '1,2019061706e+011', NULL, NULL, NULL, NULL, 'Syahrul Hidayat', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(139, '0120190617065', NULL, NULL, NULL, NULL, 'Yasir Musni Halim', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(140, '0120190617066', NULL, NULL, NULL, NULL, 'Yudhit Wimbinurfalah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(141, '0120190709003', NULL, NULL, NULL, NULL, 'Muhammad Awaludin Faizal Fadli', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-07-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(142, '0120190716005', NULL, NULL, NULL, NULL, 'Advan Dhiariga Adfat, S.Ip', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(143, '0120190716006', NULL, NULL, NULL, NULL, 'Andri Darmanto, S.Ak', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(144, '0120190725008', NULL, NULL, NULL, NULL, 'Yoref, SE', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(145, '0120190901001', NULL, NULL, NULL, NULL, 'Muhammad Rifqy Waliyuddin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(146, '0120190923005', NULL, NULL, NULL, NULL, 'Asep Saepurrohman, A.Ma', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-09-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(147, '0120191016002', NULL, NULL, NULL, NULL, 'Randi Sumantri', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-10-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(148, '0120191123002', NULL, NULL, NULL, NULL, 'Muhamad Rayyan Arief Syah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-11-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T');
INSERT INTO `karyawan` (`id_karyawan`, `nip_karyawan`, `nik_karyawan`, `no_kk`, `nrp_karyawan`, `nuptk_karyawan`, `nama_karyawan`, `nama_ibu`, `panggilan`, `gelar_awal`, `gelar_akhir`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `golongan_darah`, `status_pernikahan`, `id_sts_karyawan`, `alamat_karyawan`, `kel_karyawan`, `kec_karyawan`, `kota_karyawan`, `provinsi_karyawan`, `no_hp`, `email`, `id_lembaga`, `id_departemen`, `id_unit_kerja`, `sts_akademik`, `tgl_berkerja`, `tgl_resign`, `photo_profile`, `user_name`, `sidik_jari`, `pass`, `pin`, `nfc`, `id_level_pengguna`, `id_level_aplikasi`, `akses_antar_lembaga`, `akses_antar_departemen`, `sts_user`, `id_tinggal`, `id_sts_aktif`, `ts`, `sts_data`, `user_hapus`, `tgl_hapus`, `flag_absen`) VALUES
(149, '0120200103001', NULL, NULL, NULL, NULL, 'Agus Salim', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(150, '0120200103002', NULL, NULL, NULL, NULL, 'Ali Topan Ramadhan, S.S', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(151, '0120200103003', NULL, NULL, NULL, NULL, 'Bayu Aprianto, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(152, '0120200103004', NULL, NULL, NULL, NULL, 'M. Fakhrul Syafaat, A.Md.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(153, '0120200103005', NULL, NULL, NULL, NULL, 'Zaenal Hahir S.Ip', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(154, '0120200113008', NULL, NULL, NULL, NULL, 'Riansyah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(155, '0119960101001', '', NULL, NULL, NULL, 'Uuk', NULL, '', '', '', '', '0000-00-00', 'Islam', 'p', '-', '0', 1, 'testhjhjjhg', NULL, NULL, NULL, NULL, '0120180710011', '', 1, NULL, 1, NULL, '1996-01-01', NULL, '153027e933d4d4e793ecda7929d08a3f.jpg', NULL, NULL, NULL, NULL, '2htasdasdas', NULL, NULL, 'T', 'T', 1, 0, 1, '2020-02-03 07:38:33', 1, 'handy', '2020-08-05 02:25:20', 'T'),
(156, '0120100406001', NULL, NULL, NULL, NULL, 'Mimin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2010-04-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(157, '0120110719007', NULL, NULL, NULL, NULL, 'Munaesih BT Majid (Mumun)', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-07-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(158, '0120110906001', NULL, NULL, NULL, NULL, 'Nyinyin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2011-09-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(159, '0120120701001', NULL, NULL, NULL, NULL, 'Neng Sri Mulyati', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(160, '0120130701001', NULL, NULL, NULL, NULL, 'Alih', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(161, '0120191023003', NULL, NULL, NULL, NULL, 'Ratni Sri Maryati', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-10-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(162, '0120191024004', NULL, NULL, NULL, NULL, 'Oneng Maryati', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(163, '0119960101002', NULL, NULL, NULL, NULL, 'Hafidzi Napidi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '1996-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(164, '0120081101001', NULL, NULL, NULL, NULL, 'Yunan Al Manaf, S.Sos.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2008-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(165, '0120110701005', NULL, NULL, NULL, NULL, 'Ali Budiar, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(166, '0120120701004', NULL, NULL, NULL, NULL, 'Moch. Syaepul Bahtiar, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(167, '0120130610001', NULL, NULL, NULL, NULL, 'Mumuh', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2013-06-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(168, '0120130701009', NULL, NULL, NULL, NULL, 'Asep Zaenudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(169, '0120140623001', NULL, NULL, NULL, NULL, 'Asep Fahrudin, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2014-06-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(170, '0120150918003', NULL, NULL, NULL, NULL, 'Syam Alfiansyah, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2015-09-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(171, '0120160101002', NULL, NULL, NULL, NULL, 'Latif Maulana, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(172, '0120160717013', NULL, NULL, NULL, NULL, 'Elan Dahlan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(173, '0120160802005', NULL, NULL, NULL, NULL, 'Atang', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-08-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(174, '0120161125004', NULL, NULL, NULL, NULL, 'Badrudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-11-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(175, '0120170706003', NULL, NULL, NULL, NULL, 'Dapit Suherman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-07-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(176, '0120170914004', NULL, NULL, NULL, NULL, 'Encang Abdul Wahid', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-09-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(177, '0120171121002', NULL, NULL, NULL, NULL, 'Ihsan Said', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(178, '0120180107002', NULL, NULL, NULL, NULL, 'Junaidin, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-01-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(179, '0120180712024', NULL, NULL, NULL, NULL, 'Deden Dimyati, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(180, '0120180712025', NULL, NULL, NULL, NULL, 'Didik Gelar Permana, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(181, '0120190108005', NULL, NULL, NULL, NULL, 'Budi Hermawan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(182, '0120190224006', NULL, NULL, NULL, NULL, 'Rizky Solehudin Muharom, S.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-02-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(183, '0120190227007', NULL, NULL, NULL, NULL, 'Fardiansyah Putra, SE', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-02-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(184, '0120190401001', NULL, NULL, NULL, NULL, 'Maulana Panji Saputra, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(185, '0120190424003', NULL, NULL, NULL, NULL, 'Dede Iskandar, SE', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-04-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(186, '0120110701003', NULL, NULL, NULL, NULL, 'Mimma Muthmainnah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(187, '0120110701004', NULL, NULL, NULL, NULL, 'Sumiati', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(188, '0120110801002', NULL, NULL, NULL, NULL, 'Nina Marlina', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2011-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(189, '0120111001001', NULL, NULL, NULL, NULL, 'Nining Maryani', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2011-10-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(190, '0120120701003', NULL, NULL, NULL, NULL, 'Sofi Dewi Yuniarti, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(191, '0120130701006', NULL, NULL, NULL, NULL, 'Cicih', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(192, '0120130701007', NULL, NULL, NULL, NULL, 'Meri Permatahati, S.S.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(193, '0120130701008', NULL, NULL, NULL, NULL, 'Nunuy Nursidah, Amd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(194, '0120130901002', NULL, NULL, NULL, NULL, 'Dewi Sekarningsih', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2013-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(195, '0120130911003', NULL, NULL, NULL, NULL, 'Fenny Pebriani, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2013-09-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(196, '0120140701001', NULL, NULL, NULL, NULL, 'Eulis Elah Hayani S.Pt', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2014-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(197, '0120150102002', NULL, NULL, NULL, NULL, 'Ai Siti Aisyah (Ummu Haitsam)', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2015-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(198, '0120150723003', NULL, NULL, NULL, NULL, 'Dewi Lestari, S.T', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(199, '0120150723004', NULL, NULL, NULL, NULL, 'Elyza Sovyana, SP,S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(200, '0120150723005', NULL, NULL, NULL, NULL, 'Riana Rahayu', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(201, '0120150731006', NULL, NULL, NULL, NULL, 'Nur Asiah Jamil', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2015-07-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(202, '0120150731007', NULL, NULL, NULL, NULL, 'Yani Suryani', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2015-07-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(203, '0120150907002', NULL, NULL, NULL, NULL, 'Arini\'l Haq, S.Pd.I, S.Psi.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2015-09-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(204, '0120151008001', NULL, NULL, NULL, NULL, 'Wati Sopyati', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2015-10-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(205, '0120160101001', NULL, NULL, NULL, NULL, 'Teti Endarti, Amkb', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(206, '0120160716008', NULL, NULL, NULL, NULL, 'Annisa Delis', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(207, '0120160716009', NULL, NULL, NULL, NULL, 'Haifa Afro Amatullah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(208, '0120160716010', NULL, NULL, NULL, NULL, 'Hilsa Kalintan, ST', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(209, '0120160716011', NULL, NULL, NULL, NULL, 'Yeti Ratnasari, S.Kom.I.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(210, '0120160803007', NULL, NULL, NULL, NULL, 'Qoyum Hanifah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2016-08-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(211, '0120170218002', NULL, NULL, NULL, NULL, 'Dede Suryati', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-02-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(212, '0120170713009', NULL, NULL, NULL, NULL, 'Almas Mujahidah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(213, '0120170713010', NULL, NULL, NULL, NULL, 'Senja Dewi Novianti, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(214, '0120170713011', NULL, NULL, NULL, NULL, 'Yuliana', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(215, '0120170714012', NULL, NULL, NULL, NULL, 'Winda Musthifani', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(216, '0120170717013', NULL, NULL, NULL, NULL, 'Dwi Intan Syadiah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(217, '0120170717014', NULL, NULL, NULL, NULL, 'Nurhalimah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(218, '0120170717015', NULL, NULL, NULL, NULL, 'Salma Maulida Oktora Padila', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(219, '0120170918008', NULL, NULL, NULL, NULL, 'Sopiatul Ummah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2017-09-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(220, '0120180105001', NULL, NULL, NULL, NULL, 'Esih Sukaesih, S.Si', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(221, '0120180308004', NULL, NULL, NULL, NULL, 'Ninah Yulianah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-03-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(222, '0120180329005', NULL, NULL, NULL, NULL, 'Aam Afriani', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-03-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(223, '0120180712018', NULL, NULL, NULL, NULL, 'Annisa Meyrizka Kusumo Putri, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(224, '0120180712019', NULL, NULL, NULL, NULL, 'Eneng Fitriani', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(225, '0120180712020', NULL, NULL, NULL, NULL, 'Leni Sulasmini', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(226, '0120180712021', NULL, NULL, NULL, NULL, 'Rani Maryani, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(227, '0120180712022', NULL, NULL, NULL, NULL, 'Siti Zulmaidita Aulia ', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(228, '0120180712023', NULL, NULL, NULL, NULL, 'Wila Rahmatillah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(229, '0120180722027', NULL, NULL, NULL, NULL, 'Yetty Suminar', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-07-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(230, '0120181018002', NULL, NULL, NULL, NULL, 'Ipit Pitriani', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-10-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(231, '0120190617067', NULL, NULL, NULL, NULL, 'Azzahra Nurul Wudda', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(232, '0120190617068', NULL, NULL, NULL, NULL, 'Karnilah, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(233, '0120190617069', NULL, NULL, NULL, NULL, 'Laela Nursalamah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(234, '0120190617070', NULL, NULL, NULL, NULL, 'Lia Yulianti, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(235, '0120190617071', NULL, NULL, NULL, NULL, 'Lilim Nurhalimah, Amd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(236, '0120190617072', NULL, NULL, NULL, NULL, 'Nabella Oktafiana Mustaqorina, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(237, '0120190617073', NULL, NULL, NULL, NULL, 'Sa\'diyyah Fissilmi Dakhila Juanda, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(238, '0120190617074', NULL, NULL, NULL, NULL, 'Siti Rahayu Vanesa', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(239, '0120190617075', NULL, NULL, NULL, NULL, 'Umu Atiyah, A.Ma', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(240, '0120190617076', NULL, NULL, NULL, NULL, 'Via Setia Hasli, S.Sos', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(241, '0120190921004', NULL, NULL, NULL, NULL, 'Phia Purwati', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-09-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(242, '0120191114001', NULL, NULL, NULL, NULL, 'Noneh', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2019-11-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(243, '0120200103006', NULL, NULL, NULL, NULL, 'Resti Rismayanti, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2020-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(244, '0120200103007', NULL, NULL, NULL, NULL, 'Senja Truwita Dewi, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2020-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(245, '0120200113009', NULL, NULL, NULL, NULL, 'Yuniar Hendrawati, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2020-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(246, '0120200813001', NULL, NULL, NULL, NULL, 'Ani Sumarni', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2020-08-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(247, '0120150801001', NULL, NULL, NULL, NULL, 'Zainal Arifin, Lc., M.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2015-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(248, '0120151201001', NULL, NULL, NULL, NULL, 'Upang Bahrudin, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2015-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(249, '0120160130003', NULL, NULL, NULL, NULL, 'Tarudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2016-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(250, '0120160221001', NULL, NULL, NULL, NULL, 'Misbahuddin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2016-02-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(251, '0120160306001', NULL, NULL, NULL, NULL, 'Asep Ruhiyat', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2016-03-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(252, '0120160401002', NULL, NULL, NULL, NULL, 'Agung Wais Al-Qornie, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2016-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(253, '0120160401003', NULL, NULL, NULL, NULL, 'Daud Muttaqin, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2016-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(254, '0120160421006', NULL, NULL, NULL, NULL, 'Cecem', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2016-04-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(255, '0120160718014', NULL, NULL, NULL, NULL, 'Sandi Sudirman, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2016-07-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(256, '0120161123003', NULL, NULL, NULL, NULL, 'Dedy Eko Wahyudi, SE', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1, NULL, '2016-11-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(257, '0120161215001', NULL, NULL, NULL, NULL, 'Muhammad Jalaluddin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1, NULL, '2016-12-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(258, '0120170201001', NULL, NULL, NULL, NULL, 'Ravin Gustiansyah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1, NULL, '2017-02-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(259, '0120170701001', NULL, NULL, NULL, NULL, 'Giri Muria Shaleh, S.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(260, '0120170701002', NULL, NULL, NULL, NULL, 'Wildan Faroz, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(261, '0120170914005', NULL, NULL, NULL, NULL, 'Iyus Yusuf', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1, NULL, '2017-09-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(262, '0120170920009', NULL, NULL, NULL, NULL, 'Odang', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2017-09-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(263, '0120170926010', NULL, NULL, NULL, NULL, 'Mochamad Nurmansyah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2017-09-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(264, '0120180701001', NULL, NULL, NULL, NULL, 'Adi Aprian', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(265, '0120180701002', NULL, NULL, NULL, NULL, 'Nurudin Amar', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(266, '0120180702003', NULL, NULL, NULL, NULL, 'Fadlan Ahmad Firdaus', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(267, '0120180702004', NULL, NULL, NULL, NULL, 'Luqmanul Hakim Munif', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(268, '0120180702005', NULL, NULL, NULL, NULL, 'Muhammad Farhan Ridho', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(269, '0120180725028', NULL, NULL, NULL, NULL, 'Randi Abdul Rohman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(270, '0120180727029', NULL, NULL, NULL, NULL, 'Didin, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-07-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(271, '0120180901001', NULL, NULL, NULL, NULL, 'Abdul Hamid Arrazi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(272, '0120180901002', NULL, NULL, NULL, NULL, 'Atma Wijaya', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(273, '0120180909005', NULL, NULL, NULL, NULL, 'Sulaiman Musthofa', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-09-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(274, '0120180925007', NULL, NULL, NULL, NULL, 'Beni Sahir', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-09-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(275, '0120190104004', NULL, NULL, NULL, NULL, 'Diki Sopyan Sidiq, S.Sos', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(276, '0120190108006', NULL, NULL, NULL, NULL, 'Fikri Awaluddin Malik', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(277, '0120190114007', NULL, NULL, NULL, NULL, 'Ikhsan Abdul Aziz', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(278, '0120190114008', NULL, NULL, NULL, NULL, 'Kisan Rahmatulloh', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(279, '0120190115013', NULL, NULL, NULL, NULL, 'Fauzi Ahmad Kamil, S.Kom', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(280, '0120190129017', NULL, NULL, NULL, NULL, 'Angga Cahya Rukmana', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-01-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(281, '0120190617077', NULL, NULL, NULL, NULL, 'Abiyyu Ahmad Mahari', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(282, '0120190617078', NULL, NULL, NULL, NULL, 'Eva Tiarga', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(283, '0120190617079', NULL, NULL, NULL, NULL, 'Nurdin Gare, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(284, '0120190617080', NULL, NULL, NULL, NULL, 'Ripan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(285, '0120190617081', NULL, NULL, NULL, NULL, 'Sa\'ad Idris, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(286, '0120190624083', NULL, NULL, NULL, NULL, 'Sa\'dulloh, Lc', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-06-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(287, '0120190627086', NULL, NULL, NULL, NULL, 'Muhammad Nabil al Baihaqi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-06-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(288, '0120190627087', NULL, NULL, NULL, NULL, 'Muhammad Syauqi Labib', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-06-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(289, '0120190702001', NULL, NULL, NULL, NULL, 'Syarifudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(290, '0120190703002', NULL, NULL, NULL, NULL, 'Acep Zaini Irfansyah, S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-07-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(291, '0120190711004', NULL, NULL, NULL, NULL, 'Abdul Haerudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-07-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(292, '0120190716007', NULL, NULL, NULL, NULL, 'Muhammad Luthfi, S.Sy., S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(293, '0120190729009', NULL, NULL, NULL, NULL, 'Rusdiansyah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-07-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(294, '0120190823002', NULL, NULL, NULL, NULL, 'Aden Supyandi, A.Md. Kep., S.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-08-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(295, '0120190906002', NULL, NULL, NULL, NULL, 'Encep Yunus', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-09-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(296, '0120190914003', NULL, NULL, NULL, NULL, 'Ujang Dudih', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2019-09-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T');
INSERT INTO `karyawan` (`id_karyawan`, `nip_karyawan`, `nik_karyawan`, `no_kk`, `nrp_karyawan`, `nuptk_karyawan`, `nama_karyawan`, `nama_ibu`, `panggilan`, `gelar_awal`, `gelar_akhir`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `golongan_darah`, `status_pernikahan`, `id_sts_karyawan`, `alamat_karyawan`, `kel_karyawan`, `kec_karyawan`, `kota_karyawan`, `provinsi_karyawan`, `no_hp`, `email`, `id_lembaga`, `id_departemen`, `id_unit_kerja`, `sts_akademik`, `tgl_berkerja`, `tgl_resign`, `photo_profile`, `user_name`, `sidik_jari`, `pass`, `pin`, `nfc`, `id_level_pengguna`, `id_level_aplikasi`, `akses_antar_lembaga`, `akses_antar_departemen`, `sts_user`, `id_tinggal`, `id_sts_aktif`, `ts`, `sts_data`, `user_hapus`, `tgl_hapus`, `flag_absen`) VALUES
(297, '0120201118001', NULL, NULL, NULL, NULL, 'Muhammad Faishal Zundi Albirro, S.Kep', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2020-11-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(298, '0120201210001', NULL, NULL, NULL, NULL, 'Pradika Kunto Aji, S.E.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2020-12-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(299, '0120160716012', NULL, NULL, NULL, NULL, 'Nina Ronasiah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(300, '0120180714026', NULL, NULL, NULL, NULL, 'Esih Sukaesih', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2018-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(301, '0120201125002', NULL, NULL, NULL, NULL, 'Rani Riyanti, A.Md. Keb', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2020-11-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(302, '0120130701010', NULL, NULL, NULL, NULL, 'Hamdan Yuapi, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(303, '0120141201002', NULL, NULL, NULL, NULL, 'Diwansyah Pamungkas', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2014-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(304, '0120160714002', NULL, NULL, NULL, NULL, 'Alit Sadarisman, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2016-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(305, '0120160714003', NULL, NULL, NULL, NULL, 'Prama Nurgama, S.P.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2016-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(306, '0120161120001', NULL, NULL, NULL, NULL, 'Nuryaman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2016-11-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(307, '0120170101003', NULL, NULL, NULL, NULL, 'Agus Santosa ', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2017-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(308, '0120170717017', NULL, NULL, NULL, NULL, 'Ihsan Firmansyah M.F', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2017-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(309, '0120170717018', NULL, NULL, NULL, NULL, 'Irwan Desiharto, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2017-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(310, '0120170801002', NULL, NULL, NULL, NULL, 'Mahdi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2017-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(311, '0120170802003', NULL, NULL, NULL, NULL, 'Ujang Nalan Husaeni', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2017-08-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(312, '0120180402002', NULL, NULL, NULL, NULL, 'Deni Irfansyah, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2018-04-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(313, '0120181210001', NULL, NULL, NULL, NULL, 'Edi Hermawan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2018-12-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(314, '0120181217002', NULL, NULL, NULL, NULL, 'Fiat Supriatna', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2018-12-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(315, '0120190103002', NULL, NULL, NULL, NULL, 'Ahmad Sayuti, S.E.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(316, '0120190103003', NULL, NULL, NULL, NULL, 'Olih Solihin MLF, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(317, '0120190114011', NULL, NULL, NULL, NULL, 'Hamzah Mubarak', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(318, '0120190116014', NULL, NULL, NULL, NULL, 'Oyon', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(319, '0120190201001', NULL, NULL, NULL, NULL, 'Yogi Agustira', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-02-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(320, '0120190616010', NULL, NULL, NULL, NULL, 'Drs. Iman Budiman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(321, '0120190616011', NULL, NULL, NULL, NULL, 'Hendrik', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(322, '0120190616012', NULL, NULL, NULL, NULL, 'Kiki Kosasih, S.E.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(323, '0120190616013', NULL, NULL, NULL, NULL, 'Surya Ilman Sukmawi, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(324, '0120190616014', NULL, NULL, NULL, NULL, 'Tri Aji Pangestu', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(325, '0120190813001', NULL, NULL, NULL, NULL, 'Rheza Rhamdany', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-08-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(326, '0120190826003', NULL, NULL, NULL, NULL, 'Dede Maulana Malik, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-08-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(327, '0120150701001', NULL, NULL, NULL, NULL, 'Nisa Jahidah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2015-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(328, '0120160714001', NULL, NULL, NULL, NULL, 'Eti Nurjannah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2016-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(329, '0120170717016', NULL, NULL, NULL, NULL, 'Yusifa Amelia', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2017-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(330, '0120180707006', NULL, NULL, NULL, NULL, 'Denti Agustina Sri', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2018-07-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(331, '0120180707007', NULL, NULL, NULL, NULL, 'Desi Sulastri, S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2018-07-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(332, '0120180707008', NULL, NULL, NULL, NULL, 'E.Rinrin Ermiyati S.Pd.I', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2018-07-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(333, '0120180707009', NULL, NULL, NULL, NULL, 'Rahayu Syarief KR, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2018-07-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(334, '0120180707010', NULL, NULL, NULL, NULL, 'Vera Verizal Rahmat, S.T.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2018-07-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(335, '0120190114009', NULL, NULL, NULL, NULL, 'Intan Iskandar', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(336, '0120190114010', NULL, NULL, NULL, NULL, 'Nanda Wulandari', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(337, '0120190616001', NULL, NULL, NULL, NULL, 'Asma Azzahra', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(338, '0120190616002', NULL, NULL, NULL, NULL, 'Ayi Sajida, S.Pd.I.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(339, '0120190616003', NULL, NULL, NULL, NULL, 'Bunga Lestari', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(340, '0120190616004', NULL, NULL, NULL, NULL, 'Dyar Anggraeni, A.Md.Kep.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(341, '0120190616005', NULL, NULL, NULL, NULL, 'Iyul Yulianti', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(342, '0120190616006', NULL, NULL, NULL, NULL, 'Novi Ariyanti, S.Pd.', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(343, '0120190616007', NULL, NULL, NULL, NULL, 'Ratu Amalia Nurhikmah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(344, '0120190616008', NULL, NULL, NULL, NULL, 'Rika Rahmawati', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(345, '0120190616009', NULL, NULL, NULL, NULL, 'Rory Novita', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2019-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(346, '0120200116010', NULL, NULL, NULL, NULL, 'Della Awaliyah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2020-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(347, '0120090720002', NULL, NULL, NULL, NULL, 'Herwan Hermawandi, SE, M.Pd', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2009-07-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(348, '0120100715002', NULL, NULL, NULL, NULL, 'Atib', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2010-07-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(349, '0120110710006', NULL, NULL, NULL, NULL, 'Dzikri Fauzi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2011-07-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(350, '0120111201001', NULL, NULL, NULL, NULL, 'Endang Setiawan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2011-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(351, '0120120521002', NULL, NULL, NULL, NULL, 'Suparman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2012-05-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(352, '0120120727005', NULL, NULL, NULL, NULL, 'Amirudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2012-07-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(353, '0120121112001', NULL, NULL, NULL, NULL, 'Mukgarno', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2012-11-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(354, '0120130818002', NULL, NULL, NULL, NULL, 'Singgih Setiono', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2013-08-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(355, '0120140101001', NULL, NULL, NULL, NULL, 'Iman Taufik', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2014-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(356, '0120140901003', NULL, NULL, NULL, NULL, 'Dedih Budi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2014-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(357, '0120141008001', NULL, NULL, NULL, NULL, 'Abdul Salam', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2014-10-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(358, '0120150101001', NULL, NULL, NULL, NULL, 'Imam  Syihabudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2015-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(359, '0120150201001', NULL, NULL, NULL, NULL, 'Ujang Mulyadi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2015-02-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(360, '0120150405001', NULL, NULL, NULL, NULL, 'Dedi Supriatna', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2015-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(361, '0120160407004', NULL, NULL, NULL, NULL, 'Budi M Ihsan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2016-04-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(362, '0120160407005', NULL, NULL, NULL, NULL, 'Riyan Sugiman', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2016-04-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(363, '0120160801004', NULL, NULL, NULL, NULL, 'Ujang Ahmad S', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2016-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(364, '0120170501001', NULL, NULL, NULL, NULL, 'Ardiansyah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2017-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(365, '0120170801001', NULL, NULL, NULL, NULL, 'M. Sanny Al-Jauhari', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2017-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(366, '0120170901001', NULL, NULL, NULL, NULL, 'Adi Ashari', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2017-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(367, '0120170901002', NULL, NULL, NULL, NULL, 'Zaenuddin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2017-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(368, '0120170916007', NULL, NULL, NULL, NULL, 'Muhammad Ripan Awaludin, S.Tr.Akun', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2017-09-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(369, '0120180202001', NULL, NULL, NULL, NULL, 'Yogi', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2018-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(370, '0120180301002', NULL, NULL, NULL, NULL, 'Ryan Hidayatullah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2018-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(371, '0120190101001', NULL, NULL, NULL, NULL, 'Bayu Agustian', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2019-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(372, '0120190201002', NULL, NULL, NULL, NULL, 'Yulhan', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2019-02-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(373, '0120190206003', NULL, NULL, NULL, NULL, 'Shofyan Ariantho', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2019-02-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(374, '0120190617082', NULL, NULL, NULL, NULL, 'Muhammad Iqbal Fajrudin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2019-06-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(375, '0120190626085', NULL, NULL, NULL, NULL, 'Fahri', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2019-06-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(376, '0120191010001', NULL, NULL, NULL, NULL, 'M Kalfi Rizki', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2019-10-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(377, '0120191201001', NULL, NULL, NULL, NULL, 'Syamsul Anwar', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2019-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(378, '0120060801001', NULL, NULL, NULL, NULL, 'Rini Aryani', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2006-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(379, '0120120301001', NULL, NULL, NULL, NULL, 'Etin Supriatin', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2012-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(380, '0120130808001', NULL, NULL, NULL, NULL, 'Winda Fadilaturrohmah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2013-08-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(381, '0120131201001', NULL, NULL, NULL, NULL, 'Sinta Sumiati', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2013-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(382, '0120160801001', NULL, NULL, NULL, NULL, 'Edoh', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2016-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(383, '0120160801002', NULL, NULL, NULL, NULL, 'Pipih', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2016-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(384, '0120160801003', NULL, NULL, NULL, NULL, 'Isoh', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2016-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(385, '0120170101001', NULL, NULL, NULL, NULL, 'Nanih', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2017-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(386, '0120170101002', NULL, NULL, NULL, NULL, 'Nuraeni', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2017-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(387, '0120170515003', NULL, NULL, NULL, NULL, 'Ihot', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2017-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(388, '0120170515004', NULL, NULL, NULL, NULL, 'Leni', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2017-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(389, '0120180301001', NULL, NULL, NULL, NULL, 'Nida Khairunisa', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2018-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(390, '0120180401001', NULL, NULL, NULL, NULL, 'Atikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2018-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(391, '0120180901003', NULL, NULL, NULL, NULL, 'Yayah', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2018-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(392, '0120190626084', NULL, NULL, NULL, NULL, 'Wulan Oktapiani', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2019-06-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2020-02-03 07:38:33', 0, NULL, NULL, 'T'),
(393, '0120200720001', '121', NULL, NULL, NULL, 'asd', NULL, 'asdd', 'asd', '', '1asdsa', '2020-07-08', 'Islam', 'l', 'A+', '1', 1, 'asdasd', NULL, NULL, NULL, NULL, '232', 'dsd@gmail.com', 2, NULL, 1, NULL, '2020-07-20', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 2, 1, '2020-07-08 18:34:41', 0, NULL, NULL, 'Y'),
(394, '0120200719001', '32323', NULL, NULL, NULL, 'adsada', NULL, 'sdfsdf', 'd3', '', 'dsfdsf', '2020-07-22', 'Islam', 'l', 'A', '1', 1, 'sfsfs', NULL, NULL, NULL, NULL, '34343', 'dsd@gmail.com', 1, NULL, 1, NULL, '2020-07-19', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 1, 1, '2020-07-21 20:56:08', 0, NULL, NULL, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_asli`
--

CREATE TABLE `karyawan_asli` (
  `id_karyawan` int(11) NOT NULL,
  `nip_karyawan` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nik_karyawan` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_kk` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nrp_karyawan` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nuptk_karyawan` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `panggilan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gelar_awal` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gelar_akhir` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Islam',
  `jenis_kelamin` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `golongan_darah` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_pernikahan` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_sts_karyawan` int(11) DEFAULT NULL,
  `alamat_karyawan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kel_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kec_karyawan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kota_karyawan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provinsi_karyawan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `sts_akademik` int(2) DEFAULT NULL,
  `tgl_berkerja` date DEFAULT NULL,
  `tgl_resign` date DEFAULT NULL,
  `photo_profile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sidik_jari` longblob DEFAULT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin` int(6) DEFAULT NULL,
  `nfc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_level_pengguna` int(3) DEFAULT NULL,
  `id_level_aplikasi` int(3) DEFAULT NULL,
  `akses_antar_lembaga` char(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `akses_antar_departemen` char(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `sts_user` int(1) DEFAULT 1,
  `id_tinggal` int(1) DEFAULT 0,
  `id_sts_aktif` int(1) DEFAULT NULL,
  `ts` timestamp NULL DEFAULT current_timestamp(),
  `sts_data` int(11) DEFAULT 0,
  `user_hapus` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `karyawan_asli`
--

INSERT INTO `karyawan_asli` (`id_karyawan`, `nip_karyawan`, `nik_karyawan`, `no_kk`, `nrp_karyawan`, `nuptk_karyawan`, `nama_karyawan`, `nama_ibu`, `panggilan`, `gelar_awal`, `gelar_akhir`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `golongan_darah`, `status_pernikahan`, `id_sts_karyawan`, `alamat_karyawan`, `kel_karyawan`, `kec_karyawan`, `kota_karyawan`, `provinsi_karyawan`, `no_hp`, `email`, `id_lembaga`, `id_departemen`, `id_unit_kerja`, `sts_akademik`, `tgl_berkerja`, `tgl_resign`, `photo_profile`, `user_name`, `sidik_jari`, `pass`, `pin`, `nfc`, `id_level_pengguna`, `id_level_aplikasi`, `akses_antar_lembaga`, `akses_antar_departemen`, `sts_user`, `id_tinggal`, `id_sts_aktif`, `ts`, `sts_data`, `user_hapus`, `tgl_hapus`) VALUES
(24, '20161122001', '3604052603740001', '', '', '', 'Ilham Elsipa', 'Eem Mulyani', 'Abu Akmal', '', 'S.Kom', 'Garut', '1974-03-26', 'Islam', 'l', '-', '1', 3, 'Perum Gunungjaya Permai Jl. Cempaka No. 32 Desa Gunungjaya Kec. Cisaat Kab. Sukabumi                                ', NULL, NULL, NULL, NULL, '087771117205', 'ilham.elsipa@gmail.c', 1, 1, 1, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 1, '1', NULL),
(25, '20110701003', '3202052603840004', '3202051201150004', '', '', 'Luqman Nul Hakim', 'Ny. Halimah', 'Luqman', '', 'S.Kom', 'Sukabumi', '1984-03-26', 'Islam', 'l', '-', '1', 1, 'Kp. Rambay tengah RT.30/09 Ds. Sukamantri Kec. Cisaat Sukabumi Propinsi Jawa Barat 43366        ', NULL, NULL, NULL, NULL, '085871806661', 'luqmanhakim2603@gmai', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(30, '19970601001', '3202291109720001', '3202290808070401', '', '7441750652200033', 'Ade Hermansyah', 'Euis Hasanah', 'Ust. Ade', 'DR.', 'Lc.,M.Pd.I', 'Sukabumi', '1972-09-11', 'Islam', 'l', '-', '1', 1, 'Kp. Cikaroya  RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085846916611', 'adehermansyah25@gmai', 1, NULL, NULL, NULL, '1997-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(31, '19980701001', '3202291410620002', '3202291910100017', '', '4346740642200023', 'Ujang Ridwan', 'Hj. Masroah', 'Ust. Ujang', '', 'S.Pd.I', 'Sukabumi', '1962-10-14', 'Islam', 'l', '-', '1', 1, 'Kp. Selajambe RT.13 RW.5 Kel.Selajambe Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085759062531', '', 1, NULL, NULL, NULL, '1998-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(32, '19990301001', '3202291201810006', '3202291607120012', '', '1533759659200003', 'Buldan Taufik', 'E. Fatimah', 'Ust. Buldan', '', 'S.Pd.I', 'Garut', '1981-01-12', 'Islam', 'l', '-', '1', 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '081212364442', 'abihaitsam@gmail.com', 1, NULL, NULL, NULL, '1999-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(33, '19990701001', '3202290411720003', '3202291005080032', '', '7743750654200002', 'Denie Fauzie Ridwan', 'Fatimah', 'Ust. Deni', '', 'S.Pi', 'Sukabumi', '1972-11-04', 'Islam', 'l', '-', '1', 1, 'Kp. Cimahi RT.26 RW.6 Kel.Cibolang kaler Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '081563734413', '', 1, NULL, NULL, NULL, '1999-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(34, '20040801001', '3202292508770007', '3202291809080031', '', '01577565720003', 'Irwansyah Ramdani', 'Hj. Cicich', 'Ust. Irwansyah', '', 'S.S', 'Sukabumi', '1977-08-25', 'Islam', 'l', '-', '1', 1, 'Jl. Veteran RT.19 RW.5 Kel.Cisaat Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085860781977', '', 1, NULL, NULL, NULL, '2004-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(35, '20080714001', '3202290512870012', '3202293008120022', '', '', 'Muh. Gaus', 'Warunga', 'Ust. Gaus', '', 'S.Kom', 'Sikka', '1987-12-05', 'Islam', 'l', '-', '1', 3, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085798413140', 'ulan.zacky@gmail.com', 1, NULL, NULL, NULL, '2008-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(36, '20081101001', '3202292304840007', '3202291304120064', '', '', 'Yunan Al Manaf', 'Ikah Mastikah', 'Ust. Yunan', '', 'S.Sos.I', 'Garut', '1984-04-23', 'Islam', 'l', '-', '1', 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085322412037', '', 1, NULL, NULL, NULL, '2008-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(37, '20090720001', '3202290805770012', '3202291109120027', '', '5137755627200043', 'Herwan Hermawandi', 'Hj. Acum', 'Ust. Herwan', '', 'SE,M.Pd', 'Sukabumi', '1977-05-08', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '081322899116', 'herwan.hermawandi@ya', 1, NULL, NULL, NULL, '2009-07-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(38, '20090801001', '3202112111820001', '3202111208090004', '', '7453760663200013', 'Ryan Andrian Firdausa', 'Lasminiwati', 'Ust. Riyan', '', 'S.Si', 'Sukabumi', '1982-11-21', 'Islam', 'l', '-', NULL, 2, 'Kp. Sukajadi Rt. 02/10 RT. RW. Kel.Cibadak Kec.Cibadak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085793404545', '', 1, NULL, NULL, NULL, '2009-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(39, '20100701001', '3202290302880003', '3202290107150011', '', '', 'Yahya Muhammad', 'Fatma Terry', 'Ust. Yahya', '', 'S.Pd.I', 'Mau mere', '1988-02-03', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085863365130', '', 1, NULL, NULL, NULL, '2010-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(40, '20100901001', '3202292805890011', '3202290909130003', '', '', 'Suhaiban', 'Mujiyati', 'Ust. Suhaiban', '', 'S.Kom', 'Eka Sapta', '1989-05-28', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '082311160923', 'ebn.burhan@gmail.com', 1, NULL, NULL, NULL, '2010-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(41, '20110119001', '3202292507830001', '3202292507120010', '', '', 'Uus Hanan Alusman', 'Aoh Maesaroh', 'Ust. Uus', '', 'S.Si', 'Sukabumi', '1983-07-26', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085216297614', '', 1, NULL, NULL, NULL, '2011-01-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(42, '20110701001', '3272042501620001', '3272041208100003', '', '', 'Ali Budiar', 'Emi Suhaemi', 'Ust. Ali', '', 'S.Pd.I', 'Sukabumi', '1982-01-25', 'Islam', 'l', '-', NULL, 1, 'Jl. Pabuaran  RT.2 RW.5 Kel.Dayeuhluhur Kec.Warudoyong Kab.Kota Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085659998374', '', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(43, '20110701002', '3202292502730003', '3202291912110028', '', '', 'Bruri Dana Saputra', 'Naiman', 'Abu Salma', '', 'S.Kom', 'Bogor', '1973-02-25', 'Islam', 'l', '-', NULL, 3, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085723241148', 'abusalma753@yahoo.co', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(44, '20110701004', '', '', '', '', 'Heryani', '', '', '', 'S.Pi.', 'Ciamis', '1975-04-14', 'Islam', 'p', '-', NULL, 2, 'Kp. Cimahi RT.26 RW.6 Kel.Cibolang Kaler Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085722025103', '', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(45, '20110701005', '3202016609770002', '3202011807120021', '', '', 'Hindun Fauziah', 'Mimin A', 'Usth. Hinsun', '', 'S.Pd.i', 'Sukabumi', '1977-09-26', 'Islam', 'p', '-', NULL, 2, 'Kp. Tangsi RT.1 RW.26 Kel.Palabuhanratu Kec.Palabuhanratu Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085863495714', '', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(46, '20110701006', '', '', '', '', 'Sumiati', '', '', '', '', 'Kendal', '1975-11-05', 'Islam', 'p', '-', NULL, 2, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081510487315', '', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(47, '20110701007', NULL, NULL, NULL, NULL, 'Mimma Muthmainnah', NULL, NULL, NULL, NULL, 'Ciamis', '1992-09-18', 'Islam', 'p', '-', '1', 2, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '082310939862', NULL, 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(48, '20110917001', '32030720118305362', '32030709020712964', '', '', 'Muslim Kuswardi', 'Iyam Mariyam', 'Ust. Muslim', '', 'Amd', 'Bogor', '1983-11-20', 'Islam', 'l', '-', NULL, 1, 'Kota Batu RT.1 RW.15 Kel.Kota Batu Kec.Ciomas Kab.Bogor  Prov.Jawa barat', NULL, NULL, NULL, NULL, '085695358085', '', 1, NULL, NULL, NULL, '2011-09-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(49, '20120701001', '3203052608860005', '3203052805120012', '', '', 'Mochamad Saepul Bahtiar', 'Hariningsih', 'Ust. Syaepul', '', 'S.Pd.I', 'Cianjur', '1986-08-26', 'Islam', 'l', '-', NULL, 1, 'Kp. Pasir Jengkol RT.1 RW.3 Kel.Nanggala Mekar Kec.Ciranjang Kab.Cianjur Prov.Jawa barat', NULL, NULL, NULL, NULL, '082188580611', '', 1, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(50, '20120701002', '3202242110860002', '3202290302170012', '', '', 'Ujang Rahmat Solih Ginanjar', 'Elom', 'Ust. Ujang', '', 'Lc', 'Sukabumi', '1986-10-21', 'Islam', 'l', '-', NULL, 1, 'Kp. Cibungur RT.6 RW.6 Kel.Pasir It is Kec.Surade Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '081517547132', '', 1, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(51, '20120701003', NULL, NULL, NULL, NULL, 'Sofi Dewi Yuniarti', NULL, NULL, NULL, 'S.Pd.', 'Sukabumi', '1989-06-14', 'Islam', 'p', '-', '1', 2, 'Kp. Gunug Jaya  RT.9 RW.2 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085860015200', NULL, 1, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(52, '20130701001', '3202111702820006', '3202112009120004', '', '', 'Anfalullah', 'Maesaroh', 'Ust. Anfal', '', 'Lc', 'Sukabumi', '1982-02-17', 'Islam', 'l', '-', NULL, 1, 'Kp. Gunung karang RT.1 RW.6 Kel.Warna Jati Kec.Cibadak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085863544445', '', 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(53, '20130701002', '3216212409940003', '3216212111102240', '', '', 'Suhendri', 'Encih', 'Ust. Suhendri', '', '', 'Bogor', '1994-09-24', 'Islam', 'l', '-', NULL, 3, 'Kp. Campaka Rt. 04/02 RT. RW. Kel.Nagacipta Kec.Serang Baru Kab.Bekasi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '087820806325', '', 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(54, '20130701003', '3272010603130002', '3272010603130002', '', '', 'Hardi Suhendra', 'Cacah Holisah', 'Ust. Hardi', '', '', 'Bogor', '1993-05-30', 'Islam', 'l', '-', NULL, 3, 'Ciseureuh Talang  RT.2 RW.13 Kel.Karang Tengah Kec.Gunung Puyuh Kab.Bogor  Prov.Jawa barat', NULL, NULL, NULL, NULL, '085695396772', 'hardi.suhendra30@gma', 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(55, '20130701004', '3202292606750007', '32020208326', '021535952001', '6958753656200012', 'Cecen', 'Marwiyah', 'Cecen', '', 'S.Ag', 'Sukabumi', '1975-06-26', 'Islam', 'l', '-', NULL, 2, 'Kp. Gunung Jaya RT.15 RW.3 Kel.Gunungjaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085624274432', 'chechenisk@gmail.com', 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(56, '20130701005', NULL, NULL, NULL, NULL, 'Meri Permatahati', NULL, NULL, NULL, 'S.S.', 'Sukabumi', '1984-09-30', 'Islam', 'p', '-', '1', 2, 'Kp. Cibatu Nagrak RT.3 RW.1 Kel.Nagrak Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081321953454', NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(57, '20130701006', NULL, NULL, NULL, NULL, 'Siti Rahmawati', NULL, NULL, NULL, NULL, 'Garut', '1992-12-30', 'Islam', 'p', '-', '1', 2, 'Kp. Nangewer RT.3 RW.7 Kel.Sukamurni Kec.Cilawu Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '087741381897', NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(58, '20130701007', NULL, NULL, NULL, NULL, 'Nunuy Nursidah', NULL, NULL, NULL, 'Amd', 'Sukabumi', '1980-12-07', 'Islam', 'p', '-', '1', 3, 'Kp. Cibangban  RT.1 RW.1 Kel.Pasir Baru  Kec.Cisolok Kab.Sukabumi Prov.Jawabarat', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(59, '20130901001', '3272040607930001', '3272042603060022', '', '', 'Daud Firdaus', 'Imas Masruroh', 'Ust. Daud', '', '', 'Sukabumi', '1993-07-06', 'Islam', 'l', '-', NULL, 1, 'Jl. Sukakarya No. 14 RT.2 RW.12 Kel.Sukakarya Kec.Warudoyong Kab.kota Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085700006720', '', 1, NULL, NULL, NULL, '2013-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(61, '20131007001', '3202291812940006', '3202291008074242', '', '', 'Abdurahman Jaelani', 'Pipih Sopiah', 'Ust. Jaelani', '', '', 'Sukabumi', '1994-12-18', 'Islam', 'l', '-', '1', 3, 'Kp. Selajambe RT.21 RW.8 Kel.Selajambe Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085723209026', '', 1, NULL, NULL, NULL, '2013-10-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(62, '20131101001', '3205085504950003', '3205083012070303', '', '', 'Wildatun Kasifah', 'Aesin Kuraesin', 'Usth. Wilda', '', '', 'Garut', '1995-04-15', 'Islam', 'p', '-', NULL, 3, 'Kp. Neglasari RT.4 RW.7 Kel.Pada Asih Kec.Pasir wangi Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2013-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(63, '20140623001', '3272052312830002', '3272050104110003', '', '', 'Asep Fahrudin', 'Siti Hodijah', 'Ust. Asep', '', 'S.Pd.I', 'Sukabumi', '1983-12-23', 'Islam', 'l', '-', NULL, 1, 'Cicadas Girang RT.3 RW.3 Kel.Jaya Mekar Kec.baros Kab.kota Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081222213288', 'asepfahrudin83@gmail', 1, NULL, NULL, NULL, '2014-06-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(64, '20140701001', NULL, NULL, NULL, NULL, 'Eulis Elah Hayani', NULL, NULL, NULL, 'S.Pt.', 'Sukabumi', '1988-01-29', 'Islam', 'p', '-', '1', 2, 'Kp. Cidolog RT. RW. Kel. Kec. Kab. Prov.', NULL, NULL, NULL, NULL, '085722299550', NULL, 1, NULL, NULL, NULL, '2014-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(65, '20140901001', '3205222406940001', '3205222001090016', '', '', 'Sumpena', 'Emar', 'Ust. Sumpena', '', '', 'Garut ', '1994-06-24', 'Islam', 'l', '-', NULL, 1, 'Simpang RT.4 RW.2 Kel.Simpang Kec.Cikajang  Kab.Garut  Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085722437176', '', 1, NULL, NULL, NULL, '2014-09-01', NULL, NULL, 'handy', NULL, '$2y$10$T5Q1rcc.EOg0WzbSvxTxL.pqy2y.flpQ6lrN1BDFCwRNXwFW5e93a', NULL, NULL, 2, 2, 'Y', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(66, '20140901002', '3202302509940001', '3202301512080012', '', '', 'Supriyana Rijal', 'Ihat Solihat', 'Ust. Supriana', '', '', 'Sukabumi', '1994-09-25', 'Islam', 'l', '-', NULL, 3, 'Kp. Cibunar RT.9 RW.3 Kel.Gede Pangrango Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085797853213', 'supriyanarijal@gmail', 1, NULL, NULL, NULL, '2014-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(67, '20141201001', '1275042904850001', '3272041210150002', '', '', 'Hasan Asyari Hamzah', 'Butet Sembiring', 'Ust. Hasan', '', 'Lc', 'Binjai', '1985-04-29', 'Islam', 'l', '-', NULL, 1, 'Jl. IR. H. Juanda No. 181 Blok VI Rt. 02/12 RT. RW. Kel.Mencirim Kec.Binjai timur Kab.Kota Binjai Prov.Sumatera Utara', NULL, NULL, NULL, NULL, '082365077643', '', 1, NULL, NULL, NULL, '2014-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(68, '20150102001', NULL, NULL, NULL, NULL, 'Ai Siti Aisyah', NULL, NULL, NULL, NULL, 'Garut', '1984-09-15', 'Islam', 'p', '-', '1', 2, 'Kp. Gunungjaya RT.16 RW.3 Kel.Gunungjaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085810303510', NULL, 1, NULL, NULL, NULL, '2015-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(69, '20150202001', '3202290101940016', '320229090807073003', '', '', 'Lutfi Junaedi Abdillah', 'Titin Kartini', 'Ust. lutfi', '', '', 'Sukabumi', '1994-01-01', 'Islam', 'l', '-', NULL, 1, 'Kp. Cibatu Caringin RT.28 RW.5 Kel.Nagrak Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085723158043', '', 1, NULL, NULL, NULL, '2015-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(70, '20150323001', '3201280208850002', '3201292602140003', '-', '-', 'Abdullah Adangton', 'Umia Bahrun', 'Ust. Abdullah', 'Dr', 'Lc', 'Aloindonu', '1988-08-01', 'Islam', 'l', 'A', '1', 1, 'Gg. Teguh Kota Batu No. 25 RT.2 RW.15 Kel.Kota Batu Kec.Ciomas Kab.Bogor Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081213242030', 'asdasdada@yahoo.com', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 1, 1, '2019-06-27 03:32:36', 0, NULL, NULL),
(71, '20150615001', NULL, NULL, NULL, NULL, 'Mislahul Jannah', NULL, NULL, NULL, NULL, 'Lombok', '1995-06-13', 'Islam', 'p', '-', '2', 3, 'Bayan  RT. RW. Kel.Gerunung Kec.Praya Kab.Lombok tengah Prov.', NULL, NULL, NULL, NULL, '085779405259', NULL, 1, NULL, NULL, NULL, '2015-06-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(72, '20150624001', '3202291908860003', '3202292010160004', '', '', 'Ali Muchtar', 'Surati', 'Ust. Ali', '', 'S.Sos', 'Nganjuk', '1986-08-19', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya Rt. 016/03 RT.016 RW.006 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085863087605', '', 1, NULL, NULL, NULL, '2015-06-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(73, '20150723001', NULL, NULL, NULL, NULL, 'Iyan Sofyan', NULL, NULL, NULL, NULL, 'Sukabumi', '1992-02-11', 'Islam', 'l', '-', '2', 1, 'Kp. Cipari Rt. 01/06 RT. RW. Kel.Bojong Sawah Kec.Kebonpedes Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '089637386135\r\n', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(74, '20150723002', '', '', '', '', 'Hj. Ade Rohayati', '', '', '', 'S.Ag,M.Pd', 'Bekasi', '1972-10-16', 'Islam', 'p', '-', NULL, 4, 'Jl.Raya Kadudampit KM. 04 RT.012 RW.003 Kel.Kadudampit Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085782335222', '', 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(75, '20150723003', NULL, NULL, NULL, NULL, 'Dewi Lestari', NULL, NULL, NULL, 'S.T', 'Sukabumi', '1989-07-03', 'Islam', 'p', '-', '2', 2, 'Jl. Situ Gunung RT.005 RW.001 Kel.Kadudampit Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085222998159', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(76, '20150723004', NULL, NULL, NULL, NULL, 'Restiana Sari', NULL, NULL, NULL, NULL, 'Sukabumi', '1996-11-21', 'Islam', 'p', '-', '2', 1, 'Kp. Cimanggu Jl. Cireundeu RT.002 RW.006 Kel.Ciheulang Tonggoh Kec.Cibadak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085720819372', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(77, '20150723005', NULL, NULL, NULL, NULL, 'Riana Rahayu', NULL, NULL, NULL, NULL, 'Sukabumi', '1994-05-25', 'Islam', 'p', '-', '2', 2, 'Jl. Pemandian Cigunung KM.3 RT.18 RW.09 Kel.Sukaresmi Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085720686209', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(78, '20150723006', NULL, NULL, NULL, NULL, 'Elyza Sovyana', NULL, NULL, NULL, 'SP,S.Pd', 'Jakarta', '1975-01-02', 'Islam', 'p', '-', '1', 2, 'Jl. H.Saiman No. 8 RT.003 RW.001 Kel.Pondok Pinang Kec.Kebayoran Lama Kab.Jakarta Prov.DKI', NULL, NULL, NULL, NULL, '085782647870', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(79, '20150725001', NULL, NULL, NULL, NULL, 'Farihah', NULL, NULL, NULL, NULL, 'Sukabumi', '1990-10-08', 'Islam', 'p', '-', '1', 4, 'Kp. Gunung Karang  RT.1 RW.6 Kel.Warnajati Kec.Cibadak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2015-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(80, '20150731001', NULL, NULL, NULL, NULL, 'Nur Asiah Jamil', NULL, NULL, NULL, NULL, 'Sukabumi', '1993-04-09', 'Islam', 'p', '-', '1', 2, 'Kp. Mangkalaya RT.4 RW.5 Kel.Cibolang Kec.Gunung guruh Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085871526357', NULL, 1, NULL, NULL, NULL, '2015-07-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(81, '20150907001', NULL, NULL, NULL, NULL, 'Arinil Haq', NULL, '', '', 'S.Pd.I,S.Psi', 'Pemalang', '1989-04-30', 'Islam', 'p', '-', '1', 2, 'Dusun Sikuang RT.7 RW.2 Kel.Kendalsari Kec.Petarukan  Kab.Pemalang  Prov.Jawa Tengah        ', NULL, NULL, NULL, NULL, '08562675702', '', 1, NULL, NULL, NULL, '2015-09-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(82, '20150918001', '3275042704830018', '3275041408090019', '', '', 'Syam Alfiansyah', 'Neneng Masripah', 'ust. Syam', '', 's.Pd.', 'Sukabumi', '1983-04-27', 'Islam', 'l', '-', NULL, 1, 'Jln. Mujair No. 46 RT.3 RW.4 Kel.Kayuringinjaya Kec.Bekasi Selatan Kab.Bekasi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '08815448035', '', 1, NULL, NULL, NULL, '2015-09-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(83, '20151031001', '3202141105950005', '3202141008070281', '', '', 'Agung Irfan Rachman', 'Ai Heni Hamidah', 'Ust. Agung', '', '', 'Sukabumi', '1995-03-11', 'Islam', 'l', '-', '1', 1, 'Kp. Kalapacarang  RT.19 RW.4 Kel. Kec. Kab. Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085871290937', '', 1, NULL, NULL, NULL, '2015-10-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(84, '20151109001', '', '', '', '', 'Zainal Arifin ', '', '', '', 'Lc', 'Jakarta', '1983-03-28', 'Islam', 'l', '-', NULL, 1, 'Cimanglid GG. H. Milo No. 38 RT.3 RW.12 Kel.Sirnagalih Kec.Tamansari Kab.Bogor Prov.Jawa barat', NULL, NULL, NULL, NULL, '085716593304', '', 3, NULL, NULL, NULL, '2015-11-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(85, '20160101001', '3202100401900005', '3202291706160001', '', '', 'Latif Maulana', 'Ikoh', 'Latif', '', 'Lc', 'Sukabumi', '1990-01-04', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya rt. 017 rw. 003 Des. Gunungjaya Kec. Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081564851335', 'latifmaulana432@gmai', 1, NULL, NULL, NULL, '2016-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(86, '20160101002', NULL, NULL, NULL, NULL, 'Upang', NULL, NULL, NULL, 'Lc', 'Garut', '1988-01-27', 'Islam', 'l', '-', '1', 1, 'Kp.Carakan  RT.5 RW.1 Kel.Padamulya Kec.Pasir wangi Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '082111829004', NULL, 3, NULL, NULL, NULL, '2016-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(87, '20160108001', '3202241402900008', '3202240809120003', '', '', 'Dede Ardi Kurniadi', 'Anah Sukanah', 'Ust. Dede Ardi', '', '', 'Sukabumi', '1990-02-14', 'Islam', 'l', '-', NULL, 3, 'Kp. Cisaat Mekar RT.09 RW.1 Kel.Gunung Sungging Kec.Surade Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085797250509', '', 1, NULL, NULL, NULL, '2016-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(88, '20160401001', '', '', '', '', 'Azis Mustofa', '', '', '', '', 'Ende', '1988-12-23', 'Islam', 'l', '-', NULL, 3, 'Jl. Ikan Paus RT.01 RW.2 Kel.Paupanda Kec.Ende Selatan Kab. Prov.', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2016-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(89, '20160401002', NULL, NULL, NULL, NULL, 'Daud Muttaqin', NULL, NULL, NULL, 'Lc', 'Bandung', '1990-02-02', 'Islam', 'l', '-', '1', 1, 'Jl. Aup No. 17 RT.4 RW.10 Kel.Pasar Minggu Kec.Pasar Minggu Kab.Jakarta Selatan Prov.DKI Jakarta', NULL, NULL, NULL, NULL, '085210892623', NULL, 3, NULL, NULL, NULL, '2016-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(90, '20160401003', NULL, NULL, NULL, NULL, 'Agung Wais Al-Qorni', NULL, NULL, NULL, 'Lc', 'Garut', '1989-07-17', 'Islam', 'l', '-', '1', 1, 'Kp. Bebedahan  RT.3 RW.1 Kel.Wanamekar Kec.Wanaraja Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '082126960102', NULL, 3, NULL, NULL, NULL, '2016-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(91, '20160716001', '3272060304840900', '3202332110140010', '', '', 'Iyus Rumasnyah', 'Rosmiati', 'Ust. Iyus', '', 'S.Kom', 'Sukabumi', '1984-04-03', 'Islam', 'l', '-', NULL, 2, 'Perum Bumi Paninengan Indah Blok E Rt. 03/02 RT.3 RW.22 Kel.Sukaraja Kec.Sukaraja Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085759190231', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(92, '20160716002', '3202341411640001', '3202340608090001', '', '', 'Tono Martono', 'Mamah', 'Ust. Tono', '', 'S.Pd.', 'Sumedang', '1963-04-01', 'Islam', 'l', '-', NULL, 2, 'Kampung Cangkorah RT.8 RW.4 Kel.Cikaret Kec.Keon Pedes Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085215044076', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(93, '20160716003', '3202050104680012', '3202052502100029', '', '', 'Mumuh Syamsul Bahri', 'Uberiah', '', '', '', 'Sukabumi', '1968-04-01', 'Islam', 'l', '-', NULL, 1, 'Kp. Cipawenang  RT.2 RW.7 Kel.Cisolok Kec.Cisolok Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085793576793', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(94, '20160716004', '3202301109800001', '3202301702090003', '', '', 'Harpin Firmansyah', 'Nani', 'Ust. Harpin', '', 'Amd.Komp', 'Sukabumi', '1980-09-11', 'Islam', 'l', '-', NULL, 3, 'Kp. Kadudampit RT.13 RW.3 Kel.Kadudampit Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085723369119', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(95, '20160716005', '3272011710740042', '3272012801080003', '', '', 'Beni Safitra', 'Komariah', 'Ust. Beni', '', 'S.Pd.', 'Sukabumi', '1974-10-17', 'Islam', 'l', '-', NULL, 2, 'Perum Assyfa Blok F No.11 RT.6 RW.8 Kel.Karang Tengah  Kec.Gunungguruh Kab.Kota Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '08164624374', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(96, '20160716006', '3278010404900005', '3278011810160019', '', '', 'Fitri Bin Dede', 'Cicih', 'Ust. Fitri', '', 'Lc.', 'Taskmalaya', '1990-04-04', 'Islam', 'l', '-', NULL, 1, 'Jl. Paseh GG. Cigareja II Rt. 09/02 RT. RW. Kel.Tuguraja Kec.Cihideung Kab.Tasikmalaya Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081572778802', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(97, '20160716007', '3202302206950002', '3202302407120003', '', '', 'Muhammad Firdaus', 'Ecin Kuraesin', 'Ust. Firdaus', '', '', 'Sukabumi', '1995-06-22', 'Islam', 'l', '-', NULL, 2, 'Kp. Neglasari RT.18 RW.5 Kel.Cikahuripan Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085759659621', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(98, '20160716008', '3202331101910009', '', '', '', 'Muhammad Ali', '', 'Ust. Ali', '', 'Lc', 'Sukabumi', '1991-01-11', 'Islam', 'l', '-', NULL, 1, 'Jl. Siliwangi RT.16 RW.4 Kel.Cibatu Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081297734701', 'alhe.0209@gmail.com', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(99, '20160716009', NULL, NULL, NULL, NULL, 'Hera Septy Gandini', NULL, NULL, NULL, 's.Pd.', 'Sukabumi', '1993-09-26', 'Islam', 'p', '-', '2', 2, 'Jl. Cemerlang 72  RT.1 RW.3 Kel.Sukakarya Kec.Warudoyong Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085721222900', NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(100, '20160716010', NULL, NULL, NULL, NULL, 'Hilsa Kalintan', NULL, NULL, NULL, 'ST', 'Banjarbaru', '1989-07-29', 'Islam', 'p', '-', '2', 3, 'Jl. Badak Putih RT.1 RW.12 Kel.Palabuhanratu Kec.Palabuhanratu Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085711315237', NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(101, '20160716011', NULL, NULL, NULL, NULL, 'Haifa Afro Amatullah', NULL, NULL, NULL, NULL, 'Garut', '1994-06-10', 'Islam', 'p', '-', '2', 3, 'Kp. Neglasari RT.04 RW.7 Kel.Padaasih Kec.Pasirwangi Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(102, '20160716012', NULL, NULL, NULL, NULL, 'Yeti Ratnasari', NULL, NULL, NULL, 'S.Kom.I.', 'Garut', '1992-10-28', 'Islam', 'p', '-', '1', 2, 'Jl. H. Abdurahman No. 44 Kp. Tanggulan RT.1 RW.1 Kel.Tanggulun Kec.Kadungora Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085218890657', NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(103, '20160716013', NULL, NULL, NULL, NULL, 'Annisa Delis', NULL, NULL, NULL, NULL, 'Sukabumi', '1996-06-01', 'Islam', 'p', '-', '2', 2, 'Kp. Lebak Siuh 01 RT.22 RW.8 Kel.Sukamaju Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085863333841', NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(104, '20160717001', NULL, NULL, NULL, NULL, 'Sopia Ulfah', NULL, NULL, NULL, NULL, 'Garut', '1994-10-03', 'Islam', 'p', '-', '2', 1, 'Ranca Panjang RT.1 RW.2 Kel.Neglasari Kec.Bale Limbang Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085872639782', NULL, 1, NULL, NULL, NULL, '2016-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(105, '20160719001', '3202170209890005', '3202171804080002', '', '', 'Asep Rival Munawar', 'Isoh Masitoh', 'Ust. Asep ', '', 'Lc.', 'Sukabumi', '1989-09-02', 'Islam', 'l', '-', NULL, 2, 'Kp. Babakan Pari RT.6 RW.2 Kel.Tangkil Kec.Cidahu  Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085861408508', '', 1, NULL, NULL, NULL, '2016-07-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(106, '20160725001', '3202302901890002', '3202300103170003', '', '', 'Sandi Sudirman', 'Dedeh', 'Ust. Sandi', '', 'Lc.', 'Sukabumi', '1989-01-29', 'Islam', 'l', '-', NULL, 1, 'Kp. Cimenteng Rt. 17/03 RT. RW. Kel.Citamiang Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085697442729', '', 1, NULL, NULL, NULL, '2016-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(107, '20160803001', '3311120101840008', '3518152907160004', '', '', 'Hayatul Maqi', 'Surati', 'Ust. Maqi', '', '', 'Nganjuk', '1984-01-01', 'Islam', 'l', '-', NULL, 1, 'Mangarejo Macon RT.4 RW.2 Kel.Wilangan Kec.Nganjuk Kab.Jawa Timur Prov.Jawa Timur', NULL, NULL, NULL, NULL, '089651637227', '', 1, NULL, NULL, NULL, '2016-08-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(108, '20160803002', NULL, NULL, NULL, NULL, 'Qoyum Hanifah', NULL, NULL, NULL, NULL, 'Nganjuk', '1990-07-10', 'Islam', 'p', '-', '1', 2, 'Mangarejo Macon RT.4 RW.2 Kel.Wilangan Kec.Nganjuk Kab.Jawa Timur Prov.Jawa Timur', NULL, NULL, NULL, NULL, '089651637227', NULL, 1, NULL, NULL, NULL, '2016-08-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(109, '20170104001', '', '', '', '', 'Randi Fidayanto', '', '', '', 'Lc', 'Malang', '1972-11-09', 'Islam', 'l', '-', NULL, 2, 'Kaliwinasuh RT.02 RW.2 Kel.Kaliwinasuh Kec.Purwareja Klampok Kab.Banjar Negara Prov.Jawa Tengah', NULL, NULL, NULL, NULL, '085329663342', '', 1, NULL, NULL, NULL, '2017-01-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(110, '20170104002', '', '', '', '', 'Dea Mafitra', '', '', '', '', 'Surabaya', '1996-07-04', 'Islam', 'l', '-', NULL, 3, 'Jl. Cisarua No. 18 Rt. 04/01 RT.04 RW.01 Kel.Kadudampit Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-01-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(111, '20170216001', '', '', '', '', 'Jalalaludin', '', '', '', '', 'Sukabumi', '1996-11-15', 'Islam', 'l', '-', NULL, 3, 'Kp. Mangkalaya RT.4 RW.5 Kel.Cibolang Kec.Gunungguruh Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '', '', 3, NULL, NULL, NULL, '2017-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(112, '20170316001', '3205082009960004', '', '', '', 'Zamzam Zamhur', '', 'Ust. Zamzam', '', '', 'Garut', '1996-09-20', 'Islam', 'l', '-', NULL, 2, 'Kp. Garogol Rt. 02/09 RT. RW. Kel.Padaasih Kec.Pasirwangi Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085864640348', '', 1, NULL, NULL, NULL, '2017-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(113, '20170409001', '3202352507780002', '3202351905080002', '', '', 'Nursirwan', 'Yeniwati', 'Ust. Nursirwan', '', '', 'Jakarta', '1978-07-25', 'Islam', 'l', '-', NULL, 3, 'Kp. Cikupa RT.1 RW.3 Kel.Cireunghas Kec.Cireunghas Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '08156929545', 'awang.bear25@gmail.c', 1, NULL, NULL, NULL, '2017-04-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(114, '20170426001', '', '', '', '', 'Mochamad Yusuf Hikmah', '', 'Yusuf', '', '', 'Sukabumi', '1987-01-07', 'Islam', 'l', '-', NULL, 3, 'Kp. Kabandungan Rt. 03/10 RT.3 RW.10 Kel.Parungseah Kec.Sukabumi Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085720537082', 'yusufhikmah87@gmail.', 1, NULL, NULL, NULL, '2017-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(115, '20170515001', '3202290608810008', '3202292702080049', '', '', 'Muhammad Rusli Agustian', 'Masitoh', 'Ust. Rusli ', '', 'S.IP', 'Sukabumi', '1981-08-06', 'Islam', 'l', '-', NULL, 3, 'Jl. Raya Kadudampit No. 02 Rt. 07/03 Cijambu RT. RW. Kel.Sukasari Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081283401542', 'ruslirusliagustian@g', 1, NULL, NULL, NULL, '2017-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(116, '20170713001', '3276012404920010', '', '', '', 'Muhammad Ichsan', 'Sri Puspawati', 'Ust. Ichsan', '', 'Lc', 'Surabaya', '1992-02-24', 'Islam', 'l', '-', NULL, 1, 'Pesona Depok Blok S No. 14 Rt. 05/22 RT. RW. Kel.Depok Kec.Pancoran Mas Kab.Kota Depok Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081322655031', 'ichsan.1992@gmail.co', 1, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(117, '20170713002', '3207261112860003', '', '', '', 'Avev Ahmad Muasir', '', 'Ust. Avev', '', 'S.Pd.', 'Parigi', '1986-12-11', 'Islam', 'l', '-', NULL, 2, 'Gading kencana asri blok A7 No. 04 Rt. 08/15 RT. RW. Kel.Karang tengah Kec.Gunung puyuh Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085711755746', '', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(118, '20170713003', '3272052908900001', '', '', '', 'Zaeni Abdillah', '', 'Ust. Zaeni', '', 'S.Pd', 'Sukabumi', '1990-08-29', 'Islam', 'l', '-', NULL, 2, 'Jl. Genteng No. 34 Rt. 02/02 RT. RW. Kel.Baros Kec.Baros Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '089653465068', 'zaeniabdillah@gmail.', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(119, '20170713004', '', '', '', '', 'Saepulloh', '', 'Ust. Saepulloh', '', 'S.Sos', 'Sukabumi', '1968-07-24', 'Islam', 'l', '-', NULL, 2, 'Ciawitali Rt. 02/06 RT. RW. Kel.Darmareja Kec.Nagrak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085846830854', '', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(120, '20170713005', NULL, NULL, NULL, NULL, 'Alen Aliandi', NULL, NULL, NULL, NULL, NULL, '1899-12-30', 'Islam', 'l', '-', '2', 2, NULL, NULL, NULL, NULL, NULL, '08981919246\r\n', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(121, '20170713006', '3202360504900004', '', '', '', 'Fauzan Zaelani', 'Ai Fatimah', 'Ust. Fauzan', '', 'Lc', 'Bogor', '1890-04-05', 'Islam', 'l', '-', NULL, 2, '', NULL, NULL, NULL, NULL, '085793112834', '', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(122, '20170713007', NULL, NULL, NULL, NULL, 'Senja Dewi Novianti', NULL, NULL, NULL, 'S.Pd', 'Sukabumi', '1994-11-14', 'Islam', 'p', '-', '2', 2, 'Kp. Gunungjaya Rt. 09/02 RT. RW. Kel.Gunungjaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '08561809882', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(123, '20170713008', NULL, NULL, NULL, NULL, 'Resa Kartika', NULL, NULL, NULL, 'S.Pd', 'Sukabumi', '1989-08-23', 'Islam', 'p', '-', '2', 2, 'Jl. Kabandungan Rt. 05/06 RT. RW. Kel.Selabatu Kec.Cikole Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085624859923', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(124, '20170713009', NULL, NULL, NULL, NULL, 'Nanda Wulandari', NULL, NULL, NULL, NULL, 'Sukabumi', '1998-08-09', 'Islam', 'p', '-', '2', 3, 'Kp. Lebak Muncang Rt. 39/19 RT. RW. Kel.Cikujang Kec.Gunung guruh Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085794773376', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(125, '20170713010', NULL, NULL, NULL, NULL, 'Irsa Meilawati', NULL, NULL, NULL, 'M.Pd', 'Sukabumi', '1987-05-08', 'Islam', 'p', '-', '1', 2, 'Jln. Ciandam Sundajaya Rt. 03/04 RT. RW. Kel.Cibeureum hilir Kec.Cibeureum  Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085624914151', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(126, '20170713011', NULL, NULL, NULL, NULL, 'Yuliana', NULL, NULL, NULL, NULL, 'Bandung', '1994-12-18', 'Islam', 'p', '-', '1', 2, NULL, NULL, NULL, NULL, NULL, '081322655030', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(127, '20170713012', '3604054506780007', '', '', '', 'Siti Hawa Nurhikmawati', NULL, 'Ummu Akmal', '', 'S.Kom', 'Cilegon', '1978-06-05', 'Islam', 'p', '-', '1', 2, 'Perum Gunungjaya Permai Jl. Cempaka Blok 8/10 Kec. Cisaat Kab. Sukabumi', NULL, NULL, NULL, NULL, '087771117206', '', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(128, '20170713013', NULL, NULL, NULL, NULL, 'Isykarimah', NULL, NULL, NULL, NULL, 'Serang', '1999-11-08', 'Islam', 'p', '-', '2', 1, 'Jl. Raya Cibeber Rt. 01/02 RT. RW. Kel.Sirnagalih Kec.Cilaku Kab.Cianjur Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085876620802', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(129, '20170713014', NULL, NULL, NULL, NULL, 'Asa Fidianti', NULL, NULL, NULL, NULL, 'Purwakarta', '1996-01-12', 'Islam', 'p', '-', '2', 4, 'Jl. Raya Cibeber Rt. 01/03 RT. RW. Kel.Sirnagalih Kec.Cilaku Kab.Cianjur Prov.Jawa Barat', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(130, '20170713015', NULL, NULL, NULL, NULL, 'Almas Mujahidah', NULL, NULL, NULL, NULL, 'Jakarta', '1997-12-21', 'Islam', 'p', '-', '2', 4, 'Jl. Terusan paseh BCA cigaraja II Rt. 02/09 RT. RW. Kel.Tuguraja Kec.Cihideng Kab.Tasikmalaya Prov.Jawa Barat', NULL, NULL, NULL, NULL, '082319811183', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(131, '20170714001', NULL, NULL, NULL, NULL, 'Winda Musthifani', NULL, NULL, NULL, NULL, 'Surabaya', '1996-04-14', 'Islam', 'p', '-', '2', 3, 'Taman Griya Kencana Blok A.1/11 Rt. 07/08 RT. RW. Kel.Kencana Kec.Tanah sareal Kab.Bogor Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085746211108', NULL, 1, NULL, NULL, NULL, '2017-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(132, '20170724001', '', '', '', '', 'Rizki', NULL, '', '', 'Lc', '-', '1899-12-30', 'Islam', 'l', '-', '1', 2, '', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-07-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(133, '20170724002', '', '', '', '', 'Surya Luqmannul Hakim', '', '', '', 'Lc', 'Bogor', '1899-12-30', 'Islam', 'l', '-', NULL, 1, '        ', NULL, NULL, NULL, NULL, '081912415499', '', 1, NULL, NULL, NULL, '2017-07-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(157, '20130701108', '', '', '', '', 'Hamdan Yuapi', NULL, 'Ust. Hamdan', '', '', 'Sukabumi', '1982-07-07', 'Islam', 'l', '-', '1', 1, 'Kp. Cikukulu Rt/Rw. 007/002 Desa. Cisande Kec. Cicantayan Kab.Sukabumi Prov. Jawa barat', NULL, NULL, NULL, NULL, '085703040855', '', 4, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(158, '20130906001', '3202015802820001', '3202282908120007', '', '', 'Fenny Pebriani', 'Yanah', 'Usth. Fenny', '', 'S.Pd', 'Sukabumi', '1982-02-18', 'Islam', 'p', '-', NULL, 1, 'Kp. Cikukulu Rt/Rw. 007/002 Desa. Cisande Kec. Cicantayan Kab.Sukabumi Prov. Jawa barat', NULL, NULL, NULL, NULL, '085864558185', '', 4, NULL, NULL, NULL, '2013-09-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(159, '20150701001', '', '', '', '', 'Nisa Jahidah', '', 'Usth. Nisa', '', '', 'Bandung', '1995-02-04', 'Islam', 'p', '-', NULL, 1, 'Dusun Ci Kuda Rt/Rw. 004/002 Desa. Sidang Barang Kec. Panumbangan Prop Jawabarat-Indonesia', NULL, NULL, NULL, NULL, '085718753440', 'unaitsah.alhanin@gma', 4, NULL, NULL, NULL, '2015-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(160, '20150701002', '', '', '', '', 'Nursolihat', '', 'Ummu Aqila', '', '', 'Sukabumi', '1976-06-21', 'Islam', 'p', '-', NULL, 1, 'Jl. Cikaroya Gunung Jaya Desa. Gunung Jaya Kec. Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085624225861', '', 4, NULL, NULL, NULL, '2015-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(161, '20160324111', NULL, NULL, NULL, NULL, 'Awang Ruswandi', NULL, 'Pak.Awang', NULL, 'S.E.,', 'Sukabumi', '1990-10-05', 'Islam', 'l', '-', '1', 1, 'Kp.Slaawi Rt/Rw. 005/002 Desa.Caringin Kulon Kec.Caringin Kab.Sukabumi', NULL, NULL, NULL, NULL, '085794282253', NULL, 4, NULL, NULL, NULL, '2016-03-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(162, '20160701001', NULL, NULL, NULL, NULL, 'Alit Sadarisman', NULL, 'Ust. Alit', NULL, NULL, 'Garut', '1991-05-10', 'Islam', 'l', '-', '1', 1, 'Kp.Nangewer Rt/Rw.001/007 Desa.Sukamurni Kec.Cilawu Kab.Garut', NULL, NULL, NULL, NULL, '081564919490', 'alitsadarisman2@gmai', 4, NULL, NULL, NULL, '2016-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(163, '20160701002', '', '', '', '', 'Prama Nurgama', '', 'Ust. Prama', '', 'S.P.,', 'Sukabumi', '1989-07-01', 'Islam', 'l', '-', NULL, 1, 'Kp.Gunung Guruh Rt/Rw. 011/005 Desa.Cibentang Kec.Gunung Guruh Kab.Sukabumi', NULL, NULL, NULL, NULL, '085624822987', 'prama.nurgama@gmail.', 4, NULL, NULL, NULL, '2016-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL);
INSERT INTO `karyawan_asli` (`id_karyawan`, `nip_karyawan`, `nik_karyawan`, `no_kk`, `nrp_karyawan`, `nuptk_karyawan`, `nama_karyawan`, `nama_ibu`, `panggilan`, `gelar_awal`, `gelar_akhir`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `golongan_darah`, `status_pernikahan`, `id_sts_karyawan`, `alamat_karyawan`, `kel_karyawan`, `kec_karyawan`, `kota_karyawan`, `provinsi_karyawan`, `no_hp`, `email`, `id_lembaga`, `id_departemen`, `id_unit_kerja`, `sts_akademik`, `tgl_berkerja`, `tgl_resign`, `photo_profile`, `user_name`, `sidik_jari`, `pass`, `pin`, `nfc`, `id_level_pengguna`, `id_level_aplikasi`, `akses_antar_lembaga`, `akses_antar_departemen`, `sts_user`, `id_tinggal`, `id_sts_aktif`, `ts`, `sts_data`, `user_hapus`, `tgl_hapus`) VALUES
(164, '20160716014', NULL, NULL, NULL, NULL, 'Evi Supriani', NULL, 'Usth. Evi', NULL, 'Spdi.,', 'Sukabumi', '1993-11-17', 'Islam', 'p', '-', '2', 1, 'Kp. Ciroyom Rt/Rw. 033/008 Desa. PadaAsih Kec. Cisaat Kab. Sukabumi Prov. Jawabarat', NULL, NULL, NULL, NULL, '085759483043', NULL, 4, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(165, '20160716015', NULL, NULL, NULL, NULL, 'Eti Nurjannah', NULL, 'usth. Eti', NULL, NULL, 'Cianjur', '1991-06-25', 'Islam', 'p', '-', '1', 1, 'Kp. Nangewer Rt/Rw: 001/007 Kel/Desa : Sukamurni Kec : Cilawu Garut Jawa Barat', NULL, NULL, NULL, NULL, '082317817874', NULL, 4, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(166, '20161116001', NULL, NULL, NULL, NULL, 'Darmadi', NULL, 'Pak. Darmadi', NULL, NULL, 'Pandeglang', '1969-07-09', 'Islam', 'l', '-', '1', 3, 'Kp. Maja Tengah Rt/Rw. 002/002 Desa. Sukaratu Kec.Majasari Kab.Banten', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2016-11-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(167, '20161120001', '', '', '', '', 'Nuryaman', '', 'Pak.Nuryaman', '', '', 'Sukabumi', '1985-07-20', 'Islam', 'l', '-', NULL, 3, 'Kp. Kadudampit Rt/Rw. 009/002 Desa. Kadudampit Kec. Kadudmpit Kab.Sukabumi', NULL, NULL, NULL, NULL, '08991987974', '', 4, NULL, NULL, NULL, '2016-11-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(168, '20170116001', NULL, NULL, NULL, NULL, 'Muhammad Agus Santosa', NULL, 'Ust. Agus', NULL, NULL, 'Sukabumi', '1983-08-06', 'Islam', 'l', '-', '1', 1, 'KP.Sukajadi Rt/Rw. 003/010 Desa. Cibadak Kec. Cibadak Kab. Sukabumi Prop. Jawabarat', NULL, NULL, NULL, NULL, '085793833344', NULL, 4, NULL, NULL, NULL, '2017-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(169, '20170116002', '', '', '', '', 'Muhammad Jalaludin', '', 'Ust.Jalal', '', '', 'Sukabumi', '1996-11-15', 'Islam', 'l', '-', NULL, 1, 'Kp.Mangkalaya Rt/Rw. 004/005 Desa. Cibolang Kec. Gunung Guruh Kab.Sukabumi Prop. Jawa Barat -Indonesia', NULL, NULL, NULL, NULL, '085862925633', '', 3, NULL, NULL, NULL, '2017-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(170, '20170701001', NULL, NULL, NULL, NULL, 'Ihsan Firmansyah M.F', NULL, 'Abu Akyas', NULL, NULL, 'Garut', '1993-02-12', 'Islam', 'l', '-', '1', 1, 'Jln. Raya Warung Peuteuy No.37 Kp. Salagedang RT 03/RW 07 Ds. Sukaraja Kec. Banyuresmi Kab. Garut Kodepos 44151', NULL, NULL, NULL, NULL, '089638924914', 'ihsan.assundawy@gmai', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(171, '20170701002', NULL, NULL, NULL, NULL, 'Edih', NULL, 'ust Edih', NULL, 'S.pd.I', 'Sukabumi', '1983-07-16', 'Islam', 'l', '-', '1', 1, 'Kp.Pasir Angin Rt/Rw. 003/006 Desa. Sukamaju Kec.Nyalindung Kab.Sukabumi', NULL, NULL, NULL, NULL, '085721343802', 'edihsyahdan@gmail.co', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(172, '20170701003', '', '', '', '', 'Untung Surapati', '', 'Ust. Untung', '', '', 'Serang', '1993-10-03', 'Islam', 'l', '-', NULL, 1, 'Kp.Cangehgar Rt/Rw.002/003 Des. Pelabuhan Ratu Kec. Pelabuhan Ratu Kab.Sukabumi Prop.Jawa Barat -Indonesia', NULL, NULL, NULL, NULL, '085380963873', 'abu811631@gmail.com', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(173, '20170701004', NULL, NULL, '', '', 'Irwan Desiharto', NULL, 'Ust. Irwan', '', 'S.pd.I', 'Jakarta', '1984-12-17', 'Islam', 'l', '-', '1', 1, 'Jl.Pakuon Rt/Rw. 004/019 Desa.Sunda Wenang Kec.Parungkuda Kab.Sukabumi Prop.Jawa Barat', NULL, NULL, NULL, NULL, '08568887879', 'Ironemumtaz@gmail.co', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(174, '20170701005', '', '', '', '', 'Yusifa Amelia', '', 'Usth Yusifa', '', '', 'Garut', '1994-03-03', 'Islam', 'p', '-', NULL, 1, 'Jl.Kadudampit Km.03 Kp.Ci karoya Rt. 017 Rw. 003 Des. Gunung Jaya Kec. Cisaat Kab.Sukabumi 43152', NULL, NULL, NULL, NULL, '085759931886', '', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(175, '20170801003', NULL, NULL, NULL, NULL, 'Mahdi', NULL, 'Kang Mahdi', NULL, NULL, 'Lebak', '1996-04-01', 'Islam', 'l', '-', '2', 3, 'kp. Ci Sujen Rt/Rw. 003/001 Kode Pos. 42393 Desa. Sawarna Kec. Bayah Kab.Lebak Prop.Banten', NULL, NULL, NULL, NULL, '085319010124', NULL, 4, NULL, NULL, NULL, '2017-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(176, '20170801004', '', '', '', '', 'Ujang Nalan Husaeni', '', 'Pak Ujang', '', '', 'Sukabumi', '1978-01-17', 'Islam', 'l', '-', NULL, 3, 'Jl.Kadudampit Kp.Cikaroya Rt/Rw.024/004 Desa.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prop.Jawa Barat - Indonesia', NULL, NULL, NULL, NULL, '', '', 4, NULL, NULL, NULL, '2017-08-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(177, '20170816001', '3202290201970011', '3202292710090022', '', '', 'Patuh Abdillah', 'Pipin Abas', 'Ust. Patuh', '', '', 'Sukabumi', '1997-01-02', 'Islam', 'l', '-', NULL, 3, '', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-08-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(178, '20170912001', '5305090610910001', '', '', '', 'Taslim Koli', '', 'ust. Taslim', '', 'S.Kep', 'Pulau Kura', '1991-10-06', 'Islam', 'l', '-', NULL, 4, '', NULL, NULL, NULL, NULL, '', 'tachcall@gmail.com', 1, NULL, NULL, NULL, '2017-09-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(179, '20171005001', '1811020807910001', '', '', '', 'Alek Sandra', '', 'Ust. Alek', '', 'S.Kep', 'Bandar jaya', '1991-07-08', 'Islam', 'l', '-', NULL, 4, '', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-10-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(180, '20160225001', '3202303110730003', '3202301306080003', '', '', 'Jajang Abdullatief', 'Rohilah', 'Ust. Jajang', '', '', 'Sukabumi', '1973-10-30', 'Islam', 'l', '-', NULL, 3, '', NULL, NULL, NULL, NULL, '085846930619', '', 1, NULL, NULL, NULL, '2016-02-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(181, '20171101001', '3601130507900003', '3601130312160002', '', '', 'Abdullah Aleng', 'Sarifah', 'Ust. Abdullah', '', 'Lc', 'Aloin Danu', '1990-07-05', 'Islam', 'l', '-', '1', 1, 'test', NULL, NULL, NULL, NULL, '081291229449', '', 1, NULL, 1, NULL, '2017-11-01', NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, 'T', 'T', 1, 0, 1, '2019-06-27 03:32:36', 0, NULL, NULL),
(182, '20180107001', NULL, NULL, NULL, NULL, 'Junaidin', NULL, NULL, NULL, NULL, 'Ende ', '1991-02-12', 'Islam', 'l', '-', '1', 1, NULL, NULL, NULL, NULL, NULL, '081284740010', NULL, 1, NULL, NULL, NULL, '2018-01-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(183, '20170916001', '3202111710930001', '3273063110130012', '', '', 'Muhammad Ripan Awaludin', 'Ai Aisyah', 'Ust. Rivan', '', 'S.Tr.Akun', 'Sukabumi', '1993-10-17', 'Islam', 'l', '-', NULL, 1, '', NULL, NULL, NULL, NULL, '081220637118', '', 1, NULL, NULL, NULL, '2017-09-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(184, '20180220001', '3202292107810007', '3202291110110005', '', '', 'Cecep Irman', 'Romidah', 'Ust. Cecep ', '', 'AMd.Pn', 'Bandung', '1981-07-21', 'Islam', 'l', '-', NULL, 4, '', NULL, NULL, NULL, NULL, '08572201524', 'cecep.irman81@gmail.', 1, NULL, NULL, NULL, '2018-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(185, '20170918001', NULL, NULL, NULL, NULL, 'Sofiatul Ummah', NULL, NULL, NULL, NULL, 'Sukabumi', '1997-06-27', 'Islam', 'p', '-', '2', 2, 'Ciwaringin Rt. 02/06', NULL, NULL, NULL, NULL, '081546881755', NULL, 1, NULL, NULL, NULL, '2017-09-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(186, '20180105001', NULL, NULL, NULL, NULL, 'Nahriah Zamil', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', '-', '1', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(187, '20180105002', '', '', '', '', 'Fajrin Nurul Adha', '', '', '', '', 'Bandung', '1991-06-23', 'Islam', 'p', '-', NULL, 2, 'Kp. Salagombong girang Rt. 03/03', NULL, NULL, NULL, NULL, '085724299453', '', 1, NULL, NULL, NULL, '2018-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(188, '20180105003', NULL, NULL, NULL, NULL, 'Esih Sukaesih', NULL, NULL, NULL, 'S.Si', 'Pandeglang', '1992-02-11', 'Islam', 'p', '-', '1', 2, 'Kp. Daku Pandak Rt. 03/03', NULL, NULL, NULL, NULL, '083808070685', NULL, 1, NULL, NULL, NULL, '2018-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(220, '20170713016', '3202291910920004', '3202291910920004', '', '', 'Giri Muria Shaleh', 'Syarifah', 'Giri', '', 'S.Kom', 'Sukabumi', '1992-10-19', 'Islam', 'l', '-', NULL, 3, 'Cikaroya Desa Gunungjaya RT. 23/04 Kec. Cisaat Kab. Sukabumi, Jawa Barat        ', NULL, NULL, NULL, NULL, '085663303889', 'girimuria92@gmail.co', 3, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(221, '20170706001', '3202012811820002', '3202013101090001', '', '', 'Dapit Suherman', 'Enes', 'Ust. Abu Faiz', '', '', 'Sukabumi', '1982-11-28', NULL, 'l', '-', NULL, 3, 'Jl. Pabuaran Gg. Taruna 2 RT/RW. 05/02, Desa Dayeuh Luhur Kec. Waru Doyong, Kota Sukabumi', NULL, NULL, NULL, NULL, '089626176249', 'suhermandapit123@gma', 1, NULL, NULL, NULL, '2017-07-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(223, '20171201001', '3202010704970004', '3202011803110008', '', '', 'Deni Duniardi', 'Nyi Halimah', 'Ust. Deni', '', '', 'Sukabumi', '1997-04-07', NULL, 'l', '-', NULL, 1, '', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(224, '20180501001', '', '', '', '', 'Muhammad Hashfi', '', 'Hashfi', '', '', 'Jakarta', '2000-05-30', 'Islam', 'l', '-', NULL, 4, 'Cibitung Bekasi', NULL, NULL, NULL, NULL, '081296481430', 'muhashfi3005@gmail.c', 1, NULL, NULL, NULL, '2018-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(225, '20180501002', '', '', '', '', 'Yusril Tamim Falahi', 'Nining Sumiyati', 'Yusril', '', '', 'Sukabumi', '2000-02-03', NULL, 'l', '-', NULL, 4, 'Gunungjaya RT. 008/002 Kec. Cisaat, Kab. Sukabumi', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2018-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(231, '20180627001', '123123', NULL, NULL, NULL, '12312', NULL, 'HANDY', 'Dr', '12312', 'Sukabumi', '2019-01-29', 'Islam', 'l', '-', NULL, 1, 'asdas', NULL, NULL, NULL, NULL, 'asdasd', 'asd', 1, NULL, 1, NULL, '2018-06-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, 0, '2019-06-27 04:03:28', 1, NULL, NULL),
(236, '20180627002', '123123123', NULL, NULL, NULL, 'handy', NULL, 'HANDY', 'Dr', 'handy', 'Sukabumi', '2019-01-29', 'Islam', 'l', '-', NULL, 1, 'asdasdasd', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, 0, '2019-06-27 04:50:31', 1, 'handy', '2019-06-27 11:59:40'),
(237, '20180627003', '123123', NULL, NULL, NULL, 're', NULL, 're', 'Dr', 'Dr', '', '0000-00-00', 'Islam', 'l', '-', '0', 1, '1312312', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, 1, '2019-07-03 04:46:22', 1, 'handy', '2019-11-29 08:05:23'),
(238, '20180627004', '123456789', NULL, NULL, NULL, 'handy', NULL, '', 'Dr', 'lc', '', '0000-00-00', 'Islam', 'l', 'A', '1', 1, 'dsadasdd', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 1, 1, '2019-07-03 04:47:25', 1, 'handy', '2019-07-03 11:47:58'),
(239, '20180627005', '123123', NULL, NULL, NULL, 'handy absen', NULL, '', 'Dr', 'lc', '', '0000-00-00', 'Islam', 'l', 'A', '1', 1, 'fgdgdfg', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, 123456, '92403F50', NULL, NULL, 'T', 'T', 1, 1, 1, '2019-07-03 04:48:40', 0, NULL, NULL),
(240, '01800001', '12313', NULL, NULL, NULL, 'asdasdasd', NULL, 'adad', '', '', '', '0000-00-00', 'Islam', 'l', '-', '0', 1, 'asdasd', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, 'T', 'T', 1, 0, 1, '2019-11-29 01:04:47', 0, NULL, NULL),
(241, '01500001', '123', NULL, NULL, NULL, 'haha', NULL, '', '', '', '', '0000-00-00', 'Islam', 'l', '-', '0', 1, '122121', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2015-03-23', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, 1, '2019-11-29 01:08:07', 1, 'handy', '2019-11-29 08:08:18'),
(242, NULL, '1213', NULL, NULL, NULL, 'rezaaaaa', NULL, '1', '', '', '', '0000-00-00', 'Islam', 'l', '-', '0', 1, 'asad', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, 1, '2019-11-29 01:14:44', 1, 'handy', '2019-11-29 08:16:11'),
(243, NULL, '1213', NULL, NULL, NULL, 'rezaaaaa', NULL, '1', '', '', '', '0000-00-00', 'Islam', 'l', '-', '0', 1, 'asad', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, 1, '2019-11-29 01:15:03', 1, 'handy', '2019-11-29 08:16:18'),
(244, '0120200101001', '123', NULL, NULL, NULL, 'testsdd', NULL, 'asd', 'Dr', 'it', 'Aloindonu', '0000-00-00', 'Islam', 'l', 'A', '0', 1, 'sd', NULL, NULL, NULL, NULL, 'sdfsdf', '', 1, NULL, 1, NULL, '2020-01-01', NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, 'T', 'T', 1, 0, 1, '2020-01-28 14:26:46', 1, 'handy', '2020-01-28 09:36:52'),
(246, '0120200101002', '12312', NULL, NULL, NULL, 's', NULL, 'asd', 'Dr', 'Dr', '', '0000-00-00', 'Islam', 'l', '-', '0', 1, 'sadasda', NULL, NULL, NULL, NULL, 'asdash', 'asd@asda.com', 1, NULL, 1, NULL, '2020-01-01', NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, 'T', 'T', 1, 0, 1, '2020-01-28 14:49:58', 1, 'handy', '2020-01-28 09:51:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_copy`
--

CREATE TABLE `karyawan_copy` (
  `id_karyawan` int(11) NOT NULL,
  `nip_karyawan` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nik_karyawan` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_kk` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nrp_karyawan` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nuptk_karyawan` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `panggilan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gelar_awal` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gelar_akhir` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Islam',
  `jenis_kelamin` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `golongan_darah` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_pernikahan` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_sts_karyawan` int(11) DEFAULT NULL,
  `alamat_karyawan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kel_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kec_karyawan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kota_karyawan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provinsi_karyawan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `sts_akademik` int(2) DEFAULT NULL,
  `tgl_berkerja` date DEFAULT NULL,
  `tgl_resign` date DEFAULT NULL,
  `photo_profile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sidik_jari` longblob DEFAULT NULL,
  `pass` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin` int(6) DEFAULT NULL,
  `nfc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_level_pengguna` int(3) DEFAULT NULL,
  `id_level_aplikasi` int(3) DEFAULT NULL,
  `akses_antar_lembaga` char(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `akses_antar_departemen` char(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `sts_user` int(1) DEFAULT 1,
  `id_tinggal` int(1) DEFAULT 0,
  `id_sts_aktif` int(1) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp(),
  `sts_data` int(11) DEFAULT 0,
  `user_hapus` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `karyawan_copy`
--

INSERT INTO `karyawan_copy` (`id_karyawan`, `nip_karyawan`, `nik_karyawan`, `no_kk`, `nrp_karyawan`, `nuptk_karyawan`, `nama_karyawan`, `nama_ibu`, `panggilan`, `gelar_awal`, `gelar_akhir`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `golongan_darah`, `status_pernikahan`, `id_sts_karyawan`, `alamat_karyawan`, `kel_karyawan`, `kec_karyawan`, `kota_karyawan`, `provinsi_karyawan`, `no_hp`, `email`, `id_lembaga`, `id_departemen`, `id_unit_kerja`, `sts_akademik`, `tgl_berkerja`, `tgl_resign`, `photo_profile`, `user_name`, `sidik_jari`, `pass`, `pin`, `nfc`, `id_level_pengguna`, `id_level_aplikasi`, `akses_antar_lembaga`, `akses_antar_departemen`, `sts_user`, `id_tinggal`, `id_sts_aktif`, `ts`, `sts_data`, `user_hapus`, `tgl_hapus`) VALUES
(24, '20161122081', '3604052603740001', '', '', '', 'Ilham Elsipa', 'Eem Mulyani', 'Abu Akmal', '', 'S.Kom', 'Garut', '1974-03-26', 'Islam', 'l', '-', '1', 3, 'Perum Gunungjaya Permai Jl. Cempaka No. 32 Desa Gunungjaya Kec. Cisaat Kab. Sukabumi                                ', NULL, NULL, NULL, NULL, '087771117205', 'ilham.elsipa@gmail.c', 1, 1, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 1, '1', NULL),
(25, '20110701015', '3202052603840004', '3202051201150004', '', '', 'Luqman Nul Hakim', 'Ny. Halimah', 'Luqman', '', 'S.Kom', 'Sukabumi', '1984-03-26', 'Islam', 'l', '-', '1', 1, 'Kp. Rambay tengah RT.30/09 Ds. Sukamantri Kec. Cisaat Sukabumi Propinsi Jawa Barat 43366        ', NULL, NULL, NULL, NULL, '085871806661', 'luqmanhakim2603@gmai', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(30, '19970601001', '3202291109720001', '3202290808070401', '', '7441750652200033', 'Ade Hermansyah', 'Euis Hasanah', 'Ust. Ade', 'DR.', 'Lc.,M.Pd.I', 'Sukabumi', '1972-09-11', 'Islam', 'l', '-', '1', 1, 'Kp. Cikaroya  RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085846916611', 'adehermansyah25@gmai', 1, NULL, NULL, NULL, '1997-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(31, '19980701002', '3202291410620002', '3202291910100017', '', '4346740642200023', 'Ujang Ridwan', 'Hj. Masroah', 'Ust. Ujang', '', 'S.Pd.I', 'Sukabumi', '1962-10-14', 'Islam', 'l', '-', '1', 1, 'Kp. Selajambe RT.13 RW.5 Kel.Selajambe Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085759062531', '', 1, NULL, NULL, NULL, '1998-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(32, '19990301003', '3202291201810006', '3202291607120012', '', '1533759659200003', 'Buldan Taufik', 'E. Fatimah', 'Ust. Buldan', '', 'S.Pd.I', 'Garut', '1981-01-12', 'Islam', 'l', '-', '1', 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '081212364442', 'abihaitsam@gmail.com', 1, NULL, NULL, NULL, '1999-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(33, '19990701004', '3202290411720003', '3202291005080032', '', '7743750654200002', 'Denie Fauzie Ridwan', 'Fatimah', 'Ust. Deni', '', 'S.Pi', 'Sukabumi', '1972-11-04', 'Islam', 'l', '-', '1', 1, 'Kp. Cimahi RT.26 RW.6 Kel.Cibolang kaler Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '081563734413', '', 1, NULL, NULL, NULL, '1999-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(34, '20040801005', '3202292508770007', '3202291809080031', '', '01577565720003', 'Irwansyah Ramdani', 'Hj. Cicich', 'Ust. Irwansyah', '', 'S.S', 'Sukabumi', '1977-08-25', 'Islam', 'l', '-', '1', 1, 'Jl. Veteran RT.19 RW.5 Kel.Cisaat Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085860781977', '', 1, NULL, NULL, NULL, '2004-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(35, '20080714006', '3202290512870012', '3202293008120022', '', '', 'Muh. Gaus', 'Warunga', 'Ust. Gaus', '', 'S.Kom', 'Sikka', '1987-12-05', 'Islam', 'l', '-', '1', 3, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085798413140', 'ulan.zacky@gmail.com', 1, NULL, NULL, NULL, '2008-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(36, '20081101007', '3202292304840007', '3202291304120064', '', '', 'Yunan Al Manaf', 'Ikah Mastikah', 'Ust. Yunan', '', 'S.Sos.I', 'Garut', '1984-04-23', 'Islam', 'l', '-', '1', 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085322412037', '', 1, NULL, NULL, NULL, '2008-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(37, '20090720008', '3202290805770012', '3202291109120027', '', '5137755627200043', 'Herwan Hermawandi', 'Hj. Acum', 'Ust. Herwan', '', 'SE,M.Pd', 'Sukabumi', '1977-05-08', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '081322899116', 'herwan.hermawandi@ya', 1, NULL, NULL, NULL, '2009-07-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(38, '20090801009', '3202112111820001', '3202111208090004', '', '7453760663200013', 'Ryan Andrian Firdausa', 'Lasminiwati', 'Ust. Riyan', '', 'S.Si', 'Sukabumi', '1982-11-21', 'Islam', 'l', '-', NULL, 2, 'Kp. Sukajadi Rt. 02/10 RT. RW. Kel.Cibadak Kec.Cibadak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085793404545', '', 1, NULL, NULL, NULL, '2009-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(39, '20100701010', '3202290302880003', '3202290107150011', '', '', 'Yahya Muhammad', 'Fatma Terry', 'Ust. Yahya', '', 'S.Pd.I', 'Mau mere', '1988-02-03', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085863365130', '', 1, NULL, NULL, NULL, '2010-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(40, '20100901011', '3202292805890011', '3202290909130003', '', '', 'Suhaiban', 'Mujiyati', 'Ust. Suhaiban', '', 'S.Kom', 'Eka Sapta', '1989-05-28', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '082311160923', 'ebn.burhan@gmail.com', 1, NULL, NULL, NULL, '2010-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(41, '20110119012', '3202292507830001', '3202292507120010', '', '', 'Uus Hanan Alusman', 'Aoh Maesaroh', 'Ust. Uus', '', 'S.Si', 'Sukabumi', '1983-07-26', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085216297614', '', 1, NULL, NULL, NULL, '2011-01-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(42, '20110701013', '3272042501620001', '3272041208100003', '', '', 'Ali Budiar', 'Emi Suhaemi', 'Ust. Ali', '', 'S.Pd.I', 'Sukabumi', '1982-01-25', 'Islam', 'l', '-', NULL, 1, 'Jl. Pabuaran  RT.2 RW.5 Kel.Dayeuhluhur Kec.Warudoyong Kab.Kota Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085659998374', '', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(43, '20110701014', '3202292502730003', '3202291912110028', '', '', 'Bruri Dana Saputra', 'Naiman', 'Abu Salma', '', 'S.Kom', 'Bogor', '1973-02-25', 'Islam', 'l', '-', NULL, 3, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085723241148', 'abusalma753@yahoo.co', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(44, '20110701016', '', '', '', '', 'Heryani', '', '', '', 'S.Pi.', 'Ciamis', '1975-04-14', 'Islam', 'p', '-', NULL, 2, 'Kp. Cimahi RT.26 RW.6 Kel.Cibolang Kaler Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085722025103', '', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(45, '20110701017', '3202016609770002', '3202011807120021', '', '', 'Hindun Fauziah', 'Mimin A', 'Usth. Hinsun', '', 'S.Pd.i', 'Sukabumi', '1977-09-26', 'Islam', 'p', '-', NULL, 2, 'Kp. Tangsi RT.1 RW.26 Kel.Palabuhanratu Kec.Palabuhanratu Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085863495714', '', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(46, '20110701018', '', '', '', '', 'Sumiati', '', '', '', '', 'Kendal', '1975-11-05', 'Islam', 'p', '-', NULL, 2, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081510487315', '', 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(47, '20110701019', NULL, NULL, NULL, NULL, 'Mimma Muthmainnah', NULL, NULL, NULL, NULL, 'Ciamis', '1992-09-18', 'Islam', 'p', '-', '1', 2, 'Kp. Cikaroya RT.16 RW.3 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '082310939862', NULL, 1, NULL, NULL, NULL, '2011-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(48, '20110917020', '32030720118305362', '32030709020712964', '', '', 'Muslim Kuswardi', 'Iyam Mariyam', 'Ust. Muslim', '', 'Amd', 'Bogor', '1983-11-20', 'Islam', 'l', '-', NULL, 1, 'Kota Batu RT.1 RW.15 Kel.Kota Batu Kec.Ciomas Kab.Bogor  Prov.Jawa barat', NULL, NULL, NULL, NULL, '085695358085', '', 1, NULL, NULL, NULL, '2011-09-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(49, '20120701021', '3203052608860005', '3203052805120012', '', '', 'Mochamad Saepul Bahtiar', 'Hariningsih', 'Ust. Syaepul', '', 'S.Pd.I', 'Cianjur', '1986-08-26', 'Islam', 'l', '-', NULL, 1, 'Kp. Pasir Jengkol RT.1 RW.3 Kel.Nanggala Mekar Kec.Ciranjang Kab.Cianjur Prov.Jawa barat', NULL, NULL, NULL, NULL, '082188580611', '', 1, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(50, '20120701022', '3202242110860002', '3202290302170012', '', '', 'Ujang Rahmat Solih Ginanjar', 'Elom', 'Ust. Ujang', '', 'Lc', 'Sukabumi', '1986-10-21', 'Islam', 'l', '-', NULL, 1, 'Kp. Cibungur RT.6 RW.6 Kel.Pasir It is Kec.Surade Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '081517547132', '', 1, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(51, '20120701023', NULL, NULL, NULL, NULL, 'Sofi Dewi Yuniarti', NULL, NULL, NULL, 'S.Pd.', 'Sukabumi', '1989-06-14', 'Islam', 'p', '-', '1', 2, 'Kp. Gunug Jaya  RT.9 RW.2 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085860015200', NULL, 1, NULL, NULL, NULL, '2012-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(52, '20130701024', '3202111702820006', '3202112009120004', '', '', 'Anfalullah', 'Maesaroh', 'Ust. Anfal', '', 'Lc', 'Sukabumi', '1982-02-17', 'Islam', 'l', '-', NULL, 1, 'Kp. Gunung karang RT.1 RW.6 Kel.Warna Jati Kec.Cibadak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085863544445', '', 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(53, '20130701025', '3216212409940003', '3216212111102240', '', '', 'Suhendri', 'Encih', 'Ust. Suhendri', '', '', 'Bogor', '1994-09-24', 'Islam', 'l', '-', NULL, 3, 'Kp. Campaka Rt. 04/02 RT. RW. Kel.Nagacipta Kec.Serang Baru Kab.Bekasi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '087820806325', '', 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(54, '20130701026', '3272010603130002', '3272010603130002', '', '', 'Hardi Suhendra', 'Cacah Holisah', 'Ust. Hardi', '', '', 'Bogor', '1993-05-30', 'Islam', 'l', '-', NULL, 3, 'Ciseureuh Talang  RT.2 RW.13 Kel.Karang Tengah Kec.Gunung Puyuh Kab.Bogor  Prov.Jawa barat', NULL, NULL, NULL, NULL, '085695396772', 'hardi.suhendra30@gma', 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(55, '20130701027', '3202292606750007', '32020208326', '021535952001', '6958753656200012', 'Cecen', 'Marwiyah', 'Cecen', '', 'S.Ag', 'Sukabumi', '1975-06-26', 'Islam', 'l', '-', NULL, 2, 'Kp. Gunung Jaya RT.15 RW.3 Kel.Gunungjaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085624274432', 'chechenisk@gmail.com', 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(56, '20130701028', NULL, NULL, NULL, NULL, 'Meri Permatahati', NULL, NULL, NULL, 'S.S.', 'Sukabumi', '1984-09-30', 'Islam', 'p', '-', '1', 2, 'Kp. Cibatu Nagrak RT.3 RW.1 Kel.Nagrak Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081321953454', NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(57, '20130701029', NULL, NULL, NULL, NULL, 'Siti Rahmawati', NULL, NULL, NULL, NULL, 'Garut', '1992-12-30', 'Islam', 'p', '-', '1', 2, 'Kp. Nangewer RT.3 RW.7 Kel.Sukamurni Kec.Cilawu Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '087741381897', NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(58, '20130701030', NULL, NULL, NULL, NULL, 'Nunuy Nursidah', NULL, NULL, NULL, 'Amd', 'Sukabumi', '1980-12-07', 'Islam', 'p', '-', '1', 3, 'Kp. Cibangban  RT.1 RW.1 Kel.Pasir Baru  Kec.Cisolok Kab.Sukabumi Prov.Jawabarat', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(59, '20130901031', '3272040607930001', '3272042603060022', '', '', 'Daud Firdaus', 'Imas Masruroh', 'Ust. Daud', '', '', 'Sukabumi', '1993-07-06', 'Islam', 'l', '-', NULL, 1, 'Jl. Sukakarya No. 14 RT.2 RW.12 Kel.Sukakarya Kec.Warudoyong Kab.kota Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085700006720', '', 1, NULL, NULL, NULL, '2013-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(61, '20131007033', '3202291812940006', '3202291008074242', '', '', 'Abdurahman Jaelani', 'Pipih Sopiah', 'Ust. Jaelani', '', '', 'Sukabumi', '1994-12-18', 'Islam', 'l', '-', '1', 3, 'Kp. Selajambe RT.21 RW.8 Kel.Selajambe Kec.Cisaat Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085723209026', '', 1, NULL, NULL, NULL, '2013-10-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(62, '20131101034', '3205085504950003', '3205083012070303', '', '', 'Wildatun Kasifah', 'Aesin Kuraesin', 'Usth. Wilda', '', '', 'Garut', '1995-04-15', 'Islam', 'p', '-', NULL, 3, 'Kp. Neglasari RT.4 RW.7 Kel.Pada Asih Kec.Pasir wangi Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2013-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(63, '20140623035', '3272052312830002', '3272050104110003', '', '', 'Asep Fahrudin', 'Siti Hodijah', 'Ust. Asep', '', 'S.Pd.I', 'Sukabumi', '1983-12-23', 'Islam', 'l', '-', NULL, 1, 'Cicadas Girang RT.3 RW.3 Kel.Jaya Mekar Kec.baros Kab.kota Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081222213288', 'asepfahrudin83@gmail', 1, NULL, NULL, NULL, '2014-06-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(64, '20140701036', NULL, NULL, NULL, NULL, 'Eulis Elah Hayani', NULL, NULL, NULL, 'S.Pt.', 'Sukabumi', '1988-01-29', 'Islam', 'p', '-', '1', 2, 'Kp. Cidolog RT. RW. Kel. Kec. Kab. Prov.', NULL, NULL, NULL, NULL, '085722299550', NULL, 1, NULL, NULL, NULL, '2014-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(65, '20140901037', '3205222406940001', '3205222001090016', '', '', 'Sumpena', 'Emar', 'Ust. Sumpena', '', '', 'Garut ', '1994-06-24', 'Islam', 'l', '-', NULL, 1, 'Simpang RT.4 RW.2 Kel.Simpang Kec.Cikajang  Kab.Garut  Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085722437176', '', 1, NULL, NULL, NULL, '2014-09-01', NULL, NULL, 'handy', NULL, '$2y$10$T5Q1rcc.EOg0WzbSvxTxL.pqy2y.flpQ6lrN1BDFCwRNXwFW5e93a', NULL, NULL, 2, 2, 'Y', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(66, '20140901038', '3202302509940001', '3202301512080012', '', '', 'Supriyana Rijal', 'Ihat Solihat', 'Ust. Supriana', '', '', 'Sukabumi', '1994-09-25', 'Islam', 'l', '-', NULL, 3, 'Kp. Cibunar RT.9 RW.3 Kel.Gede Pangrango Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085797853213', 'supriyanarijal@gmail', 1, NULL, NULL, NULL, '2014-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(67, '20141201039', '1275042904850001', '3272041210150002', '', '', 'Hasan Asyari Hamzah', 'Butet Sembiring', 'Ust. Hasan', '', 'Lc', 'Binjai', '1985-04-29', 'Islam', 'l', '-', NULL, 1, 'Jl. IR. H. Juanda No. 181 Blok VI Rt. 02/12 RT. RW. Kel.Mencirim Kec.Binjai timur Kab.Kota Binjai Prov.Sumatera Utara', NULL, NULL, NULL, NULL, '082365077643', '', 1, NULL, NULL, NULL, '2014-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(68, '20150102040', NULL, NULL, NULL, NULL, 'Ai Siti Aisyah', NULL, NULL, NULL, NULL, 'Garut', '1984-09-15', 'Islam', 'p', '-', '1', 2, 'Kp. Gunungjaya RT.16 RW.3 Kel.Gunungjaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085810303510', NULL, 1, NULL, NULL, NULL, '2015-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(69, '20150202041', '3202290101940016', '320229090807073003', '', '', 'Lutfi Junaedi Abdillah', 'Titin Kartini', 'Ust. lutfi', '', '', 'Sukabumi', '1994-01-01', 'Islam', 'l', '-', NULL, 1, 'Kp. Cibatu Caringin RT.28 RW.5 Kel.Nagrak Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085723158043', '', 1, NULL, NULL, NULL, '2015-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(70, '20150323042', '3201280208850002', '3201292602140003', '-', '-', 'Abdullah Adangton', 'Umia Bahrun', 'Ust. Abdullah', 'Dr', 'Lc', 'Aloindonu', '1988-08-01', 'Islam', 'l', 'A', '1', 1, 'Gg. Teguh Kota Batu No. 25 RT.2 RW.15 Kel.Kota Batu Kec.Ciomas Kab.Bogor Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081213242030', 'asdasdada@yahoo.com', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 1, 1, '2019-06-27 03:32:36', 0, NULL, NULL),
(71, '20150615043', NULL, NULL, NULL, NULL, 'Mislahul Jannah', NULL, NULL, NULL, NULL, 'Lombok', '1995-06-13', 'Islam', 'p', '-', '2', 3, 'Bayan  RT. RW. Kel.Gerunung Kec.Praya Kab.Lombok tengah Prov.', NULL, NULL, NULL, NULL, '085779405259', NULL, 1, NULL, NULL, NULL, '2015-06-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(72, '20150624044', '3202291908860003', '3202292010160004', '', '', 'Ali Muchtar', 'Surati', 'Ust. Ali', '', 'S.Sos', 'Nganjuk', '1986-08-19', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya Rt. 016/03 RT.016 RW.006 Kel.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085863087605', '', 1, NULL, NULL, NULL, '2015-06-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(73, '20150723045', NULL, NULL, NULL, NULL, 'Iyan Sofyan', NULL, NULL, NULL, NULL, 'Sukabumi', '1992-02-11', 'Islam', 'l', '-', '2', 1, 'Kp. Cipari Rt. 01/06 RT. RW. Kel.Bojong Sawah Kec.Kebonpedes Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '089637386135\r\n', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(74, '20150723046', '', '', '', '', 'Hj. Ade Rohayati', '', '', '', 'S.Ag,M.Pd', 'Bekasi', '1972-10-16', 'Islam', 'p', '-', NULL, 4, 'Jl.Raya Kadudampit KM. 04 RT.012 RW.003 Kel.Kadudampit Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085782335222', '', 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(75, '20150723047', NULL, NULL, NULL, NULL, 'Dewi Lestari', NULL, NULL, NULL, 'S.T', 'Sukabumi', '1989-07-03', 'Islam', 'p', '-', '2', 2, 'Jl. Situ Gunung RT.005 RW.001 Kel.Kadudampit Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085222998159', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(76, '20150723048', NULL, NULL, NULL, NULL, 'Restiana Sari', NULL, NULL, NULL, NULL, 'Sukabumi', '1996-11-21', 'Islam', 'p', '-', '2', 1, 'Kp. Cimanggu Jl. Cireundeu RT.002 RW.006 Kel.Ciheulang Tonggoh Kec.Cibadak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085720819372', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(77, '20150723049', NULL, NULL, NULL, NULL, 'Riana Rahayu', NULL, NULL, NULL, NULL, 'Sukabumi', '1994-05-25', 'Islam', 'p', '-', '2', 2, 'Jl. Pemandian Cigunung KM.3 RT.18 RW.09 Kel.Sukaresmi Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085720686209', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(78, '20150723050', NULL, NULL, NULL, NULL, 'Elyza Sovyana', NULL, NULL, NULL, 'SP,S.Pd', 'Jakarta', '1975-01-02', 'Islam', 'p', '-', '1', 2, 'Jl. H.Saiman No. 8 RT.003 RW.001 Kel.Pondok Pinang Kec.Kebayoran Lama Kab.Jakarta Prov.DKI', NULL, NULL, NULL, NULL, '085782647870', NULL, 1, NULL, NULL, NULL, '2015-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(79, '20150725051', NULL, NULL, NULL, NULL, 'Farihah', NULL, NULL, NULL, NULL, 'Sukabumi', '1990-10-08', 'Islam', 'p', '-', '1', 4, 'Kp. Gunung Karang  RT.1 RW.6 Kel.Warnajati Kec.Cibadak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2015-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(80, '20150731052', NULL, NULL, NULL, NULL, 'Nur Asiah Jamil', NULL, NULL, NULL, NULL, 'Sukabumi', '1993-04-09', 'Islam', 'p', '-', '1', 2, 'Kp. Mangkalaya RT.4 RW.5 Kel.Cibolang Kec.Gunung guruh Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085871526357', NULL, 1, NULL, NULL, NULL, '2015-07-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(81, '20150907053', NULL, NULL, NULL, NULL, 'Arinil Haq', NULL, '', '', 'S.Pd.I,S.Psi', 'Pemalang', '1989-04-30', 'Islam', 'p', '-', '1', 2, 'Dusun Sikuang RT.7 RW.2 Kel.Kendalsari Kec.Petarukan  Kab.Pemalang  Prov.Jawa Tengah        ', NULL, NULL, NULL, NULL, '08562675702', '', 1, NULL, NULL, NULL, '2015-09-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(82, '20150918054', '3275042704830018', '3275041408090019', '', '', 'Syam Alfiansyah', 'Neneng Masripah', 'ust. Syam', '', 's.Pd.', 'Sukabumi', '1983-04-27', 'Islam', 'l', '-', NULL, 1, 'Jln. Mujair No. 46 RT.3 RW.4 Kel.Kayuringinjaya Kec.Bekasi Selatan Kab.Bekasi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '08815448035', '', 1, NULL, NULL, NULL, '2015-09-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(83, '20151031055', '3202141105950005', '3202141008070281', '', '', 'Agung Irfan Rachman', 'Ai Heni Hamidah', 'Ust. Agung', '', '', 'Sukabumi', '1995-03-11', 'Islam', 'l', '-', '1', 1, 'Kp. Kalapacarang  RT.19 RW.4 Kel. Kec. Kab. Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085871290937', '', 1, NULL, NULL, NULL, '2015-10-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(84, '20151109056', '', '', '', '', 'Zainal Arifin ', '', '', '', 'Lc', 'Jakarta', '1983-03-28', 'Islam', 'l', '-', NULL, 1, 'Cimanglid GG. H. Milo No. 38 RT.3 RW.12 Kel.Sirnagalih Kec.Tamansari Kab.Bogor Prov.Jawa barat', NULL, NULL, NULL, NULL, '085716593304', '', 3, NULL, NULL, NULL, '2015-11-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(85, '20160101057', '3202100401900005', '3202291706160001', '', '', 'Latif Maulana', 'Ikoh', 'Latif', '', 'Lc', 'Sukabumi', '1990-01-04', 'Islam', 'l', '-', NULL, 1, 'Kp. Cikaroya rt. 017 rw. 003 Des. Gunungjaya Kec. Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081564851335', 'latifmaulana432@gmai', 1, NULL, NULL, NULL, '2016-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(86, '20160101058', NULL, NULL, NULL, NULL, 'Upang', NULL, NULL, NULL, 'Lc', 'Garut', '1988-01-27', 'Islam', 'l', '-', '1', 1, 'Kp.Carakan  RT.5 RW.1 Kel.Padamulya Kec.Pasir wangi Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '082111829004', NULL, 3, NULL, NULL, NULL, '2016-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(87, '20160108059', '3202241402900008', '3202240809120003', '', '', 'Dede Ardi Kurniadi', 'Anah Sukanah', 'Ust. Dede Ardi', '', '', 'Sukabumi', '1990-02-14', 'Islam', 'l', '-', NULL, 3, 'Kp. Cisaat Mekar RT.09 RW.1 Kel.Gunung Sungging Kec.Surade Kab.Sukabumi Prov.Jawa barat', NULL, NULL, NULL, NULL, '085797250509', '', 1, NULL, NULL, NULL, '2016-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(88, '20160401060', '', '', '', '', 'Azis Mustofa', '', '', '', '', 'Ende', '1988-12-23', 'Islam', 'l', '-', NULL, 3, 'Jl. Ikan Paus RT.01 RW.2 Kel.Paupanda Kec.Ende Selatan Kab. Prov.', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2016-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(89, '20160401061', NULL, NULL, NULL, NULL, 'Daud Muttaqin', NULL, NULL, NULL, 'Lc', 'Bandung', '1990-02-02', 'Islam', 'l', '-', '1', 1, 'Jl. Aup No. 17 RT.4 RW.10 Kel.Pasar Minggu Kec.Pasar Minggu Kab.Jakarta Selatan Prov.DKI Jakarta', NULL, NULL, NULL, NULL, '085210892623', NULL, 3, NULL, NULL, NULL, '2016-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(90, '20160401062', NULL, NULL, NULL, NULL, 'Agung Wais Al-Qorni', NULL, NULL, NULL, 'Lc', 'Garut', '1989-07-17', 'Islam', 'l', '-', '1', 1, 'Kp. Bebedahan  RT.3 RW.1 Kel.Wanamekar Kec.Wanaraja Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '082126960102', NULL, 3, NULL, NULL, NULL, '2016-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(91, '20160716063', '3272060304840900', '3202332110140010', '', '', 'Iyus Rumasnyah', 'Rosmiati', 'Ust. Iyus', '', 'S.Kom', 'Sukabumi', '1984-04-03', 'Islam', 'l', '-', NULL, 2, 'Perum Bumi Paninengan Indah Blok E Rt. 03/02 RT.3 RW.22 Kel.Sukaraja Kec.Sukaraja Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085759190231', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(92, '20160716064', '3202341411640001', '3202340608090001', '', '', 'Tono Martono', 'Mamah', 'Ust. Tono', '', 'S.Pd.', 'Sumedang', '1963-04-01', 'Islam', 'l', '-', NULL, 2, 'Kampung Cangkorah RT.8 RW.4 Kel.Cikaret Kec.Keon Pedes Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085215044076', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(93, '20160716065', '3202050104680012', '3202052502100029', '', '', 'Mumuh Syamsul Bahri', 'Uberiah', '', '', '', 'Sukabumi', '1968-04-01', 'Islam', 'l', '-', NULL, 1, 'Kp. Cipawenang  RT.2 RW.7 Kel.Cisolok Kec.Cisolok Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085793576793', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(94, '20160716066', '3202301109800001', '3202301702090003', '', '', 'Harpin Firmansyah', 'Nani', 'Ust. Harpin', '', 'Amd.Komp', 'Sukabumi', '1980-09-11', 'Islam', 'l', '-', NULL, 3, 'Kp. Kadudampit RT.13 RW.3 Kel.Kadudampit Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085723369119', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(95, '20160716067', '3272011710740042', '3272012801080003', '', '', 'Beni Safitra', 'Komariah', 'Ust. Beni', '', 'S.Pd.', 'Sukabumi', '1974-10-17', 'Islam', 'l', '-', NULL, 2, 'Perum Assyfa Blok F No.11 RT.6 RW.8 Kel.Karang Tengah  Kec.Gunungguruh Kab.Kota Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '08164624374', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(96, '20160716068', '3278010404900005', '3278011810160019', '', '', 'Fitri Bin Dede', 'Cicih', 'Ust. Fitri', '', 'Lc.', 'Taskmalaya', '1990-04-04', 'Islam', 'l', '-', NULL, 1, 'Jl. Paseh GG. Cigareja II Rt. 09/02 RT. RW. Kel.Tuguraja Kec.Cihideung Kab.Tasikmalaya Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081572778802', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(97, '20160716069', '3202302206950002', '3202302407120003', '', '', 'Muhammad Firdaus', 'Ecin Kuraesin', 'Ust. Firdaus', '', '', 'Sukabumi', '1995-06-22', 'Islam', 'l', '-', NULL, 2, 'Kp. Neglasari RT.18 RW.5 Kel.Cikahuripan Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085759659621', '', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(98, '20160716070', '3202331101910009', '', '', '', 'Muhammad Ali', '', 'Ust. Ali', '', 'Lc', 'Sukabumi', '1991-01-11', 'Islam', 'l', '-', NULL, 1, 'Jl. Siliwangi RT.16 RW.4 Kel.Cibatu Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081297734701', 'alhe.0209@gmail.com', 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(99, '20160716071', NULL, NULL, NULL, NULL, 'Hera Septy Gandini', NULL, NULL, NULL, 's.Pd.', 'Sukabumi', '1993-09-26', 'Islam', 'p', '-', '2', 2, 'Jl. Cemerlang 72  RT.1 RW.3 Kel.Sukakarya Kec.Warudoyong Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085721222900', NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(100, '20160716072', NULL, NULL, NULL, NULL, 'Hilsa Kalintan', NULL, NULL, NULL, 'ST', 'Banjarbaru', '1989-07-29', 'Islam', 'p', '-', '2', 3, 'Jl. Badak Putih RT.1 RW.12 Kel.Palabuhanratu Kec.Palabuhanratu Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085711315237', NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(101, '20160716073', NULL, NULL, NULL, NULL, 'Haifa Afro Amatullah', NULL, NULL, NULL, NULL, 'Garut', '1994-06-10', 'Islam', 'p', '-', '2', 3, 'Kp. Neglasari RT.04 RW.7 Kel.Padaasih Kec.Pasirwangi Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(102, '20160716074', NULL, NULL, NULL, NULL, 'Yeti Ratnasari', NULL, NULL, NULL, 'S.Kom.I.', 'Garut', '1992-10-28', 'Islam', 'p', '-', '1', 2, 'Jl. H. Abdurahman No. 44 Kp. Tanggulan RT.1 RW.1 Kel.Tanggulun Kec.Kadungora Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085218890657', NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(103, '20160716075', NULL, NULL, NULL, NULL, 'Annisa Delis', NULL, NULL, NULL, NULL, 'Sukabumi', '1996-06-01', 'Islam', 'p', '-', '2', 2, 'Kp. Lebak Siuh 01 RT.22 RW.8 Kel.Sukamaju Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085863333841', NULL, 1, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(104, '20160717076', NULL, NULL, NULL, NULL, 'Sopia Ulfah', NULL, NULL, NULL, NULL, 'Garut', '1994-10-03', 'Islam', 'p', '-', '2', 1, 'Ranca Panjang RT.1 RW.2 Kel.Neglasari Kec.Bale Limbang Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085872639782', NULL, 1, NULL, NULL, NULL, '2016-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(105, '20160719077', '3202170209890005', '3202171804080002', '', '', 'Asep Rival Munawar', 'Isoh Masitoh', 'Ust. Asep ', '', 'Lc.', 'Sukabumi', '1989-09-02', 'Islam', 'l', '-', NULL, 2, 'Kp. Babakan Pari RT.6 RW.2 Kel.Tangkil Kec.Cidahu  Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085861408508', '', 1, NULL, NULL, NULL, '2016-07-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(106, '201607251078', '3202302901890002', '3202300103170003', '', '', 'Sandi Sudirman', 'Dedeh', 'Ust. Sandi', '', 'Lc.', 'Sukabumi', '1989-01-29', 'Islam', 'l', '-', NULL, 1, 'Kp. Cimenteng Rt. 17/03 RT. RW. Kel.Citamiang Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085697442729', '', 1, NULL, NULL, NULL, '2016-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(107, '201608031079', '3311120101840008', '3518152907160004', '', '', 'Hayatul Maqi', 'Surati', 'Ust. Maqi', '', '', 'Nganjuk', '1984-01-01', 'Islam', 'l', '-', NULL, 1, 'Mangarejo Macon RT.4 RW.2 Kel.Wilangan Kec.Nganjuk Kab.Jawa Timur Prov.Jawa Timur', NULL, NULL, NULL, NULL, '089651637227', '', 1, NULL, NULL, NULL, '2016-08-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(108, '201608032080', NULL, NULL, NULL, NULL, 'Qoyum Hanifah', NULL, NULL, NULL, NULL, 'Nganjuk', '1990-07-10', 'Islam', 'p', '-', '1', 2, 'Mangarejo Macon RT.4 RW.2 Kel.Wilangan Kec.Nganjuk Kab.Jawa Timur Prov.Jawa Timur', NULL, NULL, NULL, NULL, '089651637227', NULL, 1, NULL, NULL, NULL, '2016-08-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(109, '201701041082', '', '', '', '', 'Randi Fidayanto', '', '', '', 'Lc', 'Malang', '1972-11-09', 'Islam', 'l', '-', NULL, 2, 'Kaliwinasuh RT.02 RW.2 Kel.Kaliwinasuh Kec.Purwareja Klampok Kab.Banjar Negara Prov.Jawa Tengah', NULL, NULL, NULL, NULL, '085329663342', '', 1, NULL, NULL, NULL, '2017-01-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(110, '201701041083', '', '', '', '', 'Dea Mafitra', '', '', '', '', 'Surabaya', '1996-07-04', 'Islam', 'l', '-', NULL, 3, 'Jl. Cisarua No. 18 Rt. 04/01 RT.04 RW.01 Kel.Kadudampit Kec.Kadudampit Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-01-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(111, '201702161084', '', '', '', '', 'Jalalaludin', '', '', '', '', 'Sukabumi', '1996-11-15', 'Islam', 'l', '-', NULL, 3, 'Kp. Mangkalaya RT.4 RW.5 Kel.Cibolang Kec.Gunungguruh Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '', '', 3, NULL, NULL, NULL, '2017-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(112, '201703161085', '3205082009960004', '', '', '', 'Zamzam Zamhur', '', 'Ust. Zamzam', '', '', 'Garut', '1996-09-20', 'Islam', 'l', '-', NULL, 2, 'Kp. Garogol Rt. 02/09 RT. RW. Kel.Padaasih Kec.Pasirwangi Kab.Garut Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085864640348', '', 1, NULL, NULL, NULL, '2017-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(113, '201704091086', '3202352507780002', '3202351905080002', '', '', 'Nursirwan', 'Yeniwati', 'Ust. Nursirwan', '', '', 'Jakarta', '1978-07-25', 'Islam', 'l', '-', NULL, 3, 'Kp. Cikupa RT.1 RW.3 Kel.Cireunghas Kec.Cireunghas Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '08156929545', 'awang.bear25@gmail.c', 1, NULL, NULL, NULL, '2017-04-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(114, '201704261087', '', '', '', '', 'Mochamad Yusuf Hikmah', '', 'Yusuf', '', '', 'Sukabumi', '1987-01-07', 'Islam', 'l', '-', NULL, 3, 'Kp. Kabandungan Rt. 03/10 RT.3 RW.10 Kel.Parungseah Kec.Sukabumi Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085720537082', 'yusufhikmah87@gmail.', 1, NULL, NULL, NULL, '2017-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(115, '201705151088', '3202290608810008', '3202292702080049', '', '', 'Muhammad Rusli Agustian', 'Masitoh', 'Ust. Rusli ', '', 'S.IP', 'Sukabumi', '1981-08-06', 'Islam', 'l', '-', NULL, 3, 'Jl. Raya Kadudampit No. 02 Rt. 07/03 Cijambu RT. RW. Kel.Sukasari Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081283401542', 'ruslirusliagustian@g', 1, NULL, NULL, NULL, '2017-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(116, '201707131089', '3276012404920010', '', '', '', 'Muhammad Ichsan', 'Sri Puspawati', 'Ust. Ichsan', '', 'Lc', 'Surabaya', '1992-02-24', 'Islam', 'l', '-', NULL, 1, 'Pesona Depok Blok S No. 14 Rt. 05/22 RT. RW. Kel.Depok Kec.Pancoran Mas Kab.Kota Depok Prov.Jawa Barat', NULL, NULL, NULL, NULL, '081322655031', 'ichsan.1992@gmail.co', 1, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(117, '201707131090', '3207261112860003', '', '', '', 'Avev Ahmad Muasir', '', 'Ust. Avev', '', 'S.Pd.', 'Parigi', '1986-12-11', 'Islam', 'l', '-', NULL, 2, 'Gading kencana asri blok A7 No. 04 Rt. 08/15 RT. RW. Kel.Karang tengah Kec.Gunung puyuh Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085711755746', '', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(118, '201707131091', '3272052908900001', '', '', '', 'Zaeni Abdillah', '', 'Ust. Zaeni', '', 'S.Pd', 'Sukabumi', '1990-08-29', 'Islam', 'l', '-', NULL, 2, 'Jl. Genteng No. 34 Rt. 02/02 RT. RW. Kel.Baros Kec.Baros Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '089653465068', 'zaeniabdillah@gmail.', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(119, '201707131092', '', '', '', '', 'Saepulloh', '', 'Ust. Saepulloh', '', 'S.Sos', 'Sukabumi', '1968-07-24', 'Islam', 'l', '-', NULL, 2, 'Ciawitali Rt. 02/06 RT. RW. Kel.Darmareja Kec.Nagrak Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085846830854', '', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(120, '201707131093', NULL, NULL, NULL, NULL, 'Alen Aliandi', NULL, NULL, NULL, NULL, NULL, '1899-12-30', 'Islam', 'l', '-', '2', 2, NULL, NULL, NULL, NULL, NULL, '08981919246\r\n', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(121, '201707131094', '3202360504900004', '', '', '', 'Fauzan Zaelani', 'Ai Fatimah', 'Ust. Fauzan', '', 'Lc', 'Bogor', '1890-04-05', 'Islam', 'l', '-', NULL, 2, '', NULL, NULL, NULL, NULL, '085793112834', '', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(122, '201707132095', NULL, NULL, NULL, NULL, 'Senja Dewi Novianti', NULL, NULL, NULL, 'S.Pd', 'Sukabumi', '1994-11-14', 'Islam', 'p', '-', '2', 2, 'Kp. Gunungjaya Rt. 09/02 RT. RW. Kel.Gunungjaya Kec.Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '08561809882', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(123, '201707132096', NULL, NULL, NULL, NULL, 'Resa Kartika', NULL, NULL, NULL, 'S.Pd', 'Sukabumi', '1989-08-23', 'Islam', 'p', '-', '2', 2, 'Jl. Kabandungan Rt. 05/06 RT. RW. Kel.Selabatu Kec.Cikole Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085624859923', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(124, '201707132097', NULL, NULL, NULL, NULL, 'Nanda Wulandari', NULL, NULL, NULL, NULL, 'Sukabumi', '1998-08-09', 'Islam', 'p', '-', '2', 3, 'Kp. Lebak Muncang Rt. 39/19 RT. RW. Kel.Cikujang Kec.Gunung guruh Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085794773376', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(125, '201707132098', NULL, NULL, NULL, NULL, 'Irsa Meilawati', NULL, NULL, NULL, 'M.Pd', 'Sukabumi', '1987-05-08', 'Islam', 'p', '-', '1', 2, 'Jln. Ciandam Sundajaya Rt. 03/04 RT. RW. Kel.Cibeureum hilir Kec.Cibeureum  Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085624914151', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(126, '201707132099', NULL, NULL, NULL, NULL, 'Yuliana', NULL, NULL, NULL, NULL, 'Bandung', '1994-12-18', 'Islam', 'p', '-', '1', 2, NULL, NULL, NULL, NULL, NULL, '081322655030', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(127, '201707132100', '3604054506780007', '', '', '', 'Siti Hawa Nurhikmawati', NULL, 'Ummu Akmal', '', 'S.Kom', 'Cilegon', '1978-06-05', 'Islam', 'p', '-', '1', 2, 'Perum Gunungjaya Permai Jl. Cempaka Blok 8/10 Kec. Cisaat Kab. Sukabumi', NULL, NULL, NULL, NULL, '087771117206', '', 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(128, '201707132101', NULL, NULL, NULL, NULL, 'Isykarimah', NULL, NULL, NULL, NULL, 'Serang', '1999-11-08', 'Islam', 'p', '-', '2', 1, 'Jl. Raya Cibeber Rt. 01/02 RT. RW. Kel.Sirnagalih Kec.Cilaku Kab.Cianjur Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085876620802', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(129, '201707132102', NULL, NULL, NULL, NULL, 'Asa Fidianti', NULL, NULL, NULL, NULL, 'Purwakarta', '1996-01-12', 'Islam', 'p', '-', '2', 4, 'Jl. Raya Cibeber Rt. 01/03 RT. RW. Kel.Sirnagalih Kec.Cilaku Kab.Cianjur Prov.Jawa Barat', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(130, '201707132103', NULL, NULL, NULL, NULL, 'Almas Mujahidah', NULL, NULL, NULL, NULL, 'Jakarta', '1997-12-21', 'Islam', 'p', '-', '2', 4, 'Jl. Terusan paseh BCA cigaraja II Rt. 02/09 RT. RW. Kel.Tuguraja Kec.Cihideng Kab.Tasikmalaya Prov.Jawa Barat', NULL, NULL, NULL, NULL, '082319811183', NULL, 1, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(131, '201707142104', NULL, NULL, NULL, NULL, 'Winda Musthifani', NULL, NULL, NULL, NULL, 'Surabaya', '1996-04-14', 'Islam', 'p', '-', '2', 3, 'Taman Griya Kencana Blok A.1/11 Rt. 07/08 RT. RW. Kel.Kencana Kec.Tanah sareal Kab.Bogor Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085746211108', NULL, 1, NULL, NULL, NULL, '2017-07-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(132, '201707241105', '', '', '', '', 'Rizki', NULL, '', '', 'Lc', '-', '1899-12-30', 'Islam', 'l', '-', '1', 2, '', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-07-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(133, '201707241106', '', '', '', '', 'Surya Luqmannul Hakim', '', '', '', 'Lc', 'Bogor', '1899-12-30', 'Islam', 'l', '-', NULL, 1, '        ', NULL, NULL, NULL, NULL, '081912415499', '', 1, NULL, NULL, NULL, '2017-07-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(157, '201307012107', '', '', '', '', 'Hamdan Yuapi', NULL, 'Ust. Hamdan', '', '', 'Sukabumi', '1982-07-07', 'Islam', 'l', '-', '1', 1, 'Kp. Cikukulu Rt/Rw. 007/002 Desa. Cisande Kec. Cicantayan Kab.Sukabumi Prov. Jawa barat', NULL, NULL, NULL, NULL, '085703040855', '', 4, NULL, NULL, NULL, '2013-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(158, '201309062108', '3202015802820001', '3202282908120007', '', '', 'Fenny Pebriani', 'Yanah', 'Usth. Fenny', '', 'S.Pd', 'Sukabumi', '1982-02-18', 'Islam', 'p', '-', NULL, 1, 'Kp. Cikukulu Rt/Rw. 007/002 Desa. Cisande Kec. Cicantayan Kab.Sukabumi Prov. Jawa barat', NULL, NULL, NULL, NULL, '085864558185', '', 4, NULL, NULL, NULL, '2013-09-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(159, '201507012109', '', '', '', '', 'Nisa Jahidah', '', 'Usth. Nisa', '', '', 'Bandung', '1995-02-04', 'Islam', 'p', '-', NULL, 1, 'Dusun Ci Kuda Rt/Rw. 004/002 Desa. Sidang Barang Kec. Panumbangan Prop Jawabarat-Indonesia', NULL, NULL, NULL, NULL, '085718753440', 'unaitsah.alhanin@gma', 4, NULL, NULL, NULL, '2015-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(160, '201507012110', '', '', '', '', 'Nursolihat', '', 'Ummu Aqila', '', '', 'Sukabumi', '1976-06-21', 'Islam', 'p', '-', NULL, 1, 'Jl. Cikaroya Gunung Jaya Desa. Gunung Jaya Kec. Cisaat Kab.Sukabumi Prov.Jawa Barat', NULL, NULL, NULL, NULL, '085624225861', '', 4, NULL, NULL, NULL, '2015-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(161, '201603242111', NULL, NULL, NULL, NULL, 'Awang Ruswandi', NULL, 'Pak.Awang', NULL, 'S.E.,', 'Sukabumi', '1990-10-05', 'Islam', 'l', '-', '1', 1, 'Kp.Slaawi Rt/Rw. 005/002 Desa.Caringin Kulon Kec.Caringin Kab.Sukabumi', NULL, NULL, NULL, NULL, '085794282253', NULL, 4, NULL, NULL, NULL, '2016-03-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(162, '201607012112', NULL, NULL, NULL, NULL, 'Alit Sadarisman', NULL, 'Ust. Alit', NULL, NULL, 'Garut', '1991-05-10', 'Islam', 'l', '-', '1', 1, 'Kp.Nangewer Rt/Rw.001/007 Desa.Sukamurni Kec.Cilawu Kab.Garut', NULL, NULL, NULL, NULL, '081564919490', 'alitsadarisman2@gmai', 4, NULL, NULL, NULL, '2016-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL);
INSERT INTO `karyawan_copy` (`id_karyawan`, `nip_karyawan`, `nik_karyawan`, `no_kk`, `nrp_karyawan`, `nuptk_karyawan`, `nama_karyawan`, `nama_ibu`, `panggilan`, `gelar_awal`, `gelar_akhir`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `golongan_darah`, `status_pernikahan`, `id_sts_karyawan`, `alamat_karyawan`, `kel_karyawan`, `kec_karyawan`, `kota_karyawan`, `provinsi_karyawan`, `no_hp`, `email`, `id_lembaga`, `id_departemen`, `id_unit_kerja`, `sts_akademik`, `tgl_berkerja`, `tgl_resign`, `photo_profile`, `user_name`, `sidik_jari`, `pass`, `pin`, `nfc`, `id_level_pengguna`, `id_level_aplikasi`, `akses_antar_lembaga`, `akses_antar_departemen`, `sts_user`, `id_tinggal`, `id_sts_aktif`, `ts`, `sts_data`, `user_hapus`, `tgl_hapus`) VALUES
(163, '201607012113', '', '', '', '', 'Prama Nurgama', '', 'Ust. Prama', '', 'S.P.,', 'Sukabumi', '1989-07-01', 'Islam', 'l', '-', NULL, 1, 'Kp.Gunung Guruh Rt/Rw. 011/005 Desa.Cibentang Kec.Gunung Guruh Kab.Sukabumi', NULL, NULL, NULL, NULL, '085624822987', 'prama.nurgama@gmail.', 4, NULL, NULL, NULL, '2016-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(164, '201607162114', NULL, NULL, NULL, NULL, 'Evi Supriani', NULL, 'Usth. Evi', NULL, 'Spdi.,', 'Sukabumi', '1993-11-17', 'Islam', 'p', '-', '2', 1, 'Kp. Ciroyom Rt/Rw. 033/008 Desa. PadaAsih Kec. Cisaat Kab. Sukabumi Prov. Jawabarat', NULL, NULL, NULL, NULL, '085759483043', NULL, 4, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(165, '201607162115', NULL, NULL, NULL, NULL, 'Eti Nurjannah', NULL, 'usth. Eti', NULL, NULL, 'Cianjur', '1991-06-25', 'Islam', 'p', '-', '1', 1, 'Kp. Nangewer Rt/Rw: 001/007 Kel/Desa : Sukamurni Kec : Cilawu Garut Jawa Barat', NULL, NULL, NULL, NULL, '082317817874', NULL, 4, NULL, NULL, NULL, '2016-07-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(166, '201611162116', NULL, NULL, NULL, NULL, 'Darmadi', NULL, 'Pak. Darmadi', NULL, NULL, 'Pandeglang', '1969-07-09', 'Islam', 'l', '-', '1', 3, 'Kp. Maja Tengah Rt/Rw. 002/002 Desa. Sukaratu Kec.Majasari Kab.Banten', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2016-11-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(167, '201611202117', '', '', '', '', 'Nuryaman', '', 'Pak.Nuryaman', '', '', 'Sukabumi', '1985-07-20', 'Islam', 'l', '-', NULL, 3, 'Kp. Kadudampit Rt/Rw. 009/002 Desa. Kadudampit Kec. Kadudmpit Kab.Sukabumi', NULL, NULL, NULL, NULL, '08991987974', '', 4, NULL, NULL, NULL, '2016-11-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(168, '201701162118', NULL, NULL, NULL, NULL, 'Muhammad Agus Santosa', NULL, 'Ust. Agus', NULL, NULL, 'Sukabumi', '1983-08-06', 'Islam', 'l', '-', '1', 1, 'KP.Sukajadi Rt/Rw. 003/010 Desa. Cibadak Kec. Cibadak Kab. Sukabumi Prop. Jawabarat', NULL, NULL, NULL, NULL, '085793833344', NULL, 4, NULL, NULL, NULL, '2017-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(169, '201701162119', '', '', '', '', 'Muhammad Jalaludin', '', 'Ust.Jalal', '', '', 'Sukabumi', '1996-11-15', 'Islam', 'l', '-', NULL, 1, 'Kp.Mangkalaya Rt/Rw. 004/005 Desa. Cibolang Kec. Gunung Guruh Kab.Sukabumi Prop. Jawa Barat -Indonesia', NULL, NULL, NULL, NULL, '085862925633', '', 3, NULL, NULL, NULL, '2017-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(170, '201707012120', NULL, NULL, NULL, NULL, 'Ihsan Firmansyah M.F', NULL, 'Abu Akyas', NULL, NULL, 'Garut', '1993-02-12', 'Islam', 'l', '-', '1', 1, 'Jln. Raya Warung Peuteuy No.37 Kp. Salagedang RT 03/RW 07 Ds. Sukaraja Kec. Banyuresmi Kab. Garut Kodepos 44151', NULL, NULL, NULL, NULL, '089638924914', 'ihsan.assundawy@gmai', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(171, '201707012121', NULL, NULL, NULL, NULL, 'Edih', NULL, 'ust Edih', NULL, 'S.pd.I', 'Sukabumi', '1983-07-16', 'Islam', 'l', '-', '1', 1, 'Kp.Pasir Angin Rt/Rw. 003/006 Desa. Sukamaju Kec.Nyalindung Kab.Sukabumi', NULL, NULL, NULL, NULL, '085721343802', 'edihsyahdan@gmail.co', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(172, '201707012122', '', '', '', '', 'Untung Surapati', '', 'Ust. Untung', '', '', 'Serang', '1993-10-03', 'Islam', 'l', '-', NULL, 1, 'Kp.Cangehgar Rt/Rw.002/003 Des. Pelabuhan Ratu Kec. Pelabuhan Ratu Kab.Sukabumi Prop.Jawa Barat -Indonesia', NULL, NULL, NULL, NULL, '085380963873', 'abu811631@gmail.com', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(173, '201707012123', NULL, NULL, '', '', 'Irwan Desiharto', NULL, 'Ust. Irwan', '', 'S.pd.I', 'Jakarta', '1984-12-17', 'Islam', 'l', '-', '1', 1, 'Jl.Pakuon Rt/Rw. 004/019 Desa.Sunda Wenang Kec.Parungkuda Kab.Sukabumi Prop.Jawa Barat', NULL, NULL, NULL, NULL, '08568887879', 'Ironemumtaz@gmail.co', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(174, '201707012124', '', '', '', '', 'Yusifa Amelia', '', 'Usth Yusifa', '', '', 'Garut', '1994-03-03', 'Islam', 'p', '-', NULL, 1, 'Jl.Kadudampit Km.03 Kp.Ci karoya Rt. 017 Rw. 003 Des. Gunung Jaya Kec. Cisaat Kab.Sukabumi 43152', NULL, NULL, NULL, NULL, '085759931886', '', 4, NULL, NULL, NULL, '2017-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(175, '201708012125', NULL, NULL, NULL, NULL, 'Mahdi', NULL, 'Kang Mahdi', NULL, NULL, 'Lebak', '1996-04-01', 'Islam', 'l', '-', '2', 3, 'kp. Ci Sujen Rt/Rw. 003/001 Kode Pos. 42393 Desa. Sawarna Kec. Bayah Kab.Lebak Prop.Banten', NULL, NULL, NULL, NULL, '085319010124', NULL, 4, NULL, NULL, NULL, '2017-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(176, '201708022126', '', '', '', '', 'Ujang Nalan Husaeni', '', 'Pak Ujang', '', '', 'Sukabumi', '1978-01-17', 'Islam', 'l', '-', NULL, 3, 'Jl.Kadudampit Kp.Cikaroya Rt/Rw.024/004 Desa.Gunung Jaya Kec.Cisaat Kab.Sukabumi Prop.Jawa Barat - Indonesia', NULL, NULL, NULL, NULL, '', '', 4, NULL, NULL, NULL, '2017-08-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(177, '201708161127', '3202290201970011', '3202292710090022', '', '', 'Patuh Abdillah', 'Pipin Abas', 'Ust. Patuh', '', '', 'Sukabumi', '1997-01-02', 'Islam', 'l', '-', NULL, 3, '', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-08-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(178, '201709121128', '5305090610910001', '', '', '', 'Taslim Koli', '', 'ust. Taslim', '', 'S.Kep', 'Pulau Kura', '1991-10-06', 'Islam', 'l', '-', NULL, 4, '', NULL, NULL, NULL, NULL, '', 'tachcall@gmail.com', 1, NULL, NULL, NULL, '2017-09-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(179, '201710051129', '1811020807910001', '', '', '', 'Alek Sandra', '', 'Ust. Alek', '', 'S.Kep', 'Bandar jaya', '1991-07-08', 'Islam', 'l', '-', NULL, 4, '', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-10-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(180, '201602251130', '3202303110730003', '3202301306080003', '', '', 'Jajang Abdullatief', 'Rohilah', 'Ust. Jajang', '', '', 'Sukabumi', '1973-10-30', 'Islam', 'l', '-', NULL, 3, '', NULL, NULL, NULL, NULL, '085846930619', '', 1, NULL, NULL, NULL, '2016-02-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(181, '201711011131', '3601130507900003', '3601130312160002', '', '', 'Abdullah Aleng', 'Sarifah', 'Ust. Abdullah', '', 'Lc', 'Aloin Danu', '1990-07-05', 'Islam', 'l', '-', '1', 1, '', NULL, NULL, NULL, NULL, '081291229449', '', 1, NULL, NULL, NULL, '2017-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(182, '201801071132', NULL, NULL, NULL, NULL, 'Junaidin', NULL, NULL, NULL, NULL, 'Ende ', '1991-02-12', 'Islam', 'l', '-', '1', 1, NULL, NULL, NULL, NULL, NULL, '081284740010', NULL, 1, NULL, NULL, NULL, '2018-01-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(183, '201709161133', '3202111710930001', '3273063110130012', '', '', 'Muhammad Ripan Awaludin', 'Ai Aisyah', 'Ust. Rivan', '', 'S.Tr.Akun', 'Sukabumi', '1993-10-17', 'Islam', 'l', '-', NULL, 1, '', NULL, NULL, NULL, NULL, '081220637118', '', 1, NULL, NULL, NULL, '2017-09-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(184, '201802201134', '3202292107810007', '3202291110110005', '', '', 'Cecep Irman', 'Romidah', 'Ust. Cecep ', '', 'AMd.Pn', 'Bandung', '1981-07-21', 'Islam', 'l', '-', NULL, 4, '', NULL, NULL, NULL, NULL, '08572201524', 'cecep.irman81@gmail.', 1, NULL, NULL, NULL, '2018-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(185, '201709181135', NULL, NULL, NULL, NULL, 'Sofiatul Ummah', NULL, NULL, NULL, NULL, 'Sukabumi', '1997-06-27', 'Islam', 'p', '-', '2', 2, 'Ciwaringin Rt. 02/06', NULL, NULL, NULL, NULL, '081546881755', NULL, 1, NULL, NULL, NULL, '2017-09-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(186, '201801051136', NULL, NULL, NULL, NULL, 'Nahriah Zamil', NULL, NULL, NULL, NULL, NULL, NULL, 'Islam', 'p', '-', '1', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2018-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(187, '201801051137', '', '', '', '', 'Fajrin Nurul Adha', '', '', '', '', 'Bandung', '1991-06-23', 'Islam', 'p', '-', NULL, 2, 'Kp. Salagombong girang Rt. 03/03', NULL, NULL, NULL, NULL, '085724299453', '', 1, NULL, NULL, NULL, '2018-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(188, '201801051138', NULL, NULL, NULL, NULL, 'Esih Sukaesih', NULL, NULL, NULL, 'S.Si', 'Pandeglang', '1992-02-11', 'Islam', 'p', '-', '1', 2, 'Kp. Daku Pandak Rt. 03/03', NULL, NULL, NULL, NULL, '083808070685', NULL, 1, NULL, NULL, NULL, '2018-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(220, '20170713139', '3202291910920004', '3202291910920004', '', '', 'Giri Muria Shaleh', 'Syarifah', 'Giri', '', 'S.Kom', 'Sukabumi', '1992-10-19', 'Islam', 'l', '-', NULL, 3, 'Cikaroya Desa Gunungjaya RT. 23/04 Kec. Cisaat Kab. Sukabumi, Jawa Barat        ', NULL, NULL, NULL, NULL, '085663303889', 'girimuria92@gmail.co', 3, NULL, NULL, NULL, '2017-07-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(221, '20170706200', '3202012811820002', '3202013101090001', '', '', 'Dapit Suherman', 'Enes', 'Ust. Abu Faiz', '', '', 'Sukabumi', '1982-11-28', NULL, 'l', '-', NULL, 3, 'Jl. Pabuaran Gg. Taruna 2 RT/RW. 05/02, Desa Dayeuh Luhur Kec. Waru Doyong, Kota Sukabumi', NULL, NULL, NULL, NULL, '089626176249', 'suhermandapit123@gma', 1, NULL, NULL, NULL, '2017-07-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(223, '20171201070', '3202010704970004', '3202011803110008', '', '', 'Deni Duniardi', 'Nyi Halimah', 'Ust. Deni', '', '', 'Sukabumi', '1997-04-07', NULL, 'l', '-', NULL, 1, '', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2017-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(224, '20180501801', '', '', '', '', 'Muhammad Hashfi', '', 'Hashfi', '', '', 'Jakarta', '2000-05-30', 'Islam', 'l', '-', NULL, 4, 'Cibitung Bekasi', NULL, NULL, NULL, NULL, '081296481430', 'muhashfi3005@gmail.c', 1, NULL, NULL, NULL, '2018-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(225, '20180501802', '', '', '', '', 'Yusril Tamim Falahi', 'Nining Sumiyati', 'Yusril', '', '', 'Sukabumi', '2000-02-03', NULL, 'l', '-', NULL, 4, 'Gunungjaya RT. 008/002 Kec. Cisaat, Kab. Sukabumi', NULL, NULL, NULL, NULL, '', '', 1, NULL, NULL, NULL, '2018-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, NULL, '2019-06-27 03:32:36', 0, NULL, NULL),
(231, '20180627001', '123123', NULL, NULL, NULL, '12312', NULL, 'HANDY', 'Dr', '12312', 'Sukabumi', '2019-01-29', 'Islam', 'l', '-', NULL, 1, 'asdas', NULL, NULL, NULL, NULL, 'asdasd', 'asd', 1, NULL, 1, NULL, '2018-06-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, 0, '2019-06-27 04:03:28', 1, NULL, NULL),
(236, '20180627002', '123123123', NULL, NULL, NULL, 'handy', NULL, 'HANDY', 'Dr', 'handy', 'Sukabumi', '2019-01-29', 'Islam', 'l', '-', NULL, 1, 'asdasdasd', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, 0, '2019-06-27 04:50:31', 1, 'handy', '2019-06-27 11:59:40'),
(237, '20180627003', '123123', NULL, NULL, NULL, 're', NULL, 're', 'Dr', 'Dr', '', '0000-00-00', 'Islam', 'l', '-', '0', 1, '1312312', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 0, 1, '2019-07-03 04:46:22', 0, NULL, NULL),
(238, '20180627004', '123456789', NULL, NULL, NULL, 'handy', NULL, '', 'Dr', 'lc', '', '0000-00-00', 'Islam', 'l', 'A', '1', 1, 'dsadasdd', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T', 'T', 1, 1, 1, '2019-07-03 04:47:25', 1, 'handy', '2019-07-03 11:47:58'),
(239, '20180627005', '123123', NULL, NULL, NULL, 'handy absen', NULL, '', 'Dr', 'lc', '', '0000-00-00', 'Islam', 'l', 'A', '1', 1, 'fgdgdfg', NULL, NULL, NULL, NULL, '', '', 1, NULL, 1, NULL, '2018-06-27', NULL, '', NULL, NULL, NULL, 123456, '92403F50', NULL, NULL, 'T', 'T', 1, 1, 1, '2019-07-03 04:48:40', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_diklat`
--

CREATE TABLE `karyawan_diklat` (
  `id_diklat` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `nip_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_diklat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `penyelenggara_diklat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempat_diklat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tahun_diklat` int(4) DEFAULT NULL,
  `url_sertifikat` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `karyawan_diklat`
--

INSERT INTO `karyawan_diklat` (`id_diklat`, `id_karyawan`, `nip_karyawan`, `nama_diklat`, `penyelenggara_diklat`, `tempat_diklat`, `tahun_diklat`, `url_sertifikat`) VALUES
(4, 155, '0119960101001', 'sdfghjhgf', 'ASDFG', 'gfdsdfgh', 12345, NULL),
(5, 155, '0119960101001', 'dfghjhg', 'ASDFGHJM', 'gfdsdfgh', 123456, '972d7aa1109d67f8032268aee1494f07.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_jabatan`
--

CREATE TABLE `karyawan_jabatan` (
  `id_jabatan_karyawan` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `nip_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_unitkerja` int(11) DEFAULT NULL,
  `no_sk` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_sk` date DEFAULT NULL,
  `tmt_jabatan` date DEFAULT NULL,
  `url_sk` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_keluarga`
--

CREATE TABLE `karyawan_keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `nip_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nik_hubungan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_hubungan` int(11) DEFAULT NULL,
  `nama_keluarga` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `id_pendidikan` int(11) DEFAULT NULL,
  `id_pekerjaan` int(11) DEFAULT NULL,
  `foto_kk` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_kerja`
--

CREATE TABLE `karyawan_kerja` (
  `id_kerja` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `nip_karyawan` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tahun_awal` int(4) DEFAULT NULL,
  `tahun_akhir` int(4) DEFAULT NULL,
  `nama_perusahaan` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `jabatan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gaji` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_penghargaan`
--

CREATE TABLE `karyawan_penghargaan` (
  `id_penghargaan` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `nip_karyawan` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tahun_penghargaan` int(4) DEFAULT NULL,
  `instansi_pemberi` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_sekolah`
--

CREATE TABLE `karyawan_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `nip_karyawan` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_pendidikan` int(3) DEFAULT NULL,
  `jurusan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_sekolah` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tahun_masuk` int(11) DEFAULT NULL,
  `tahun_lulus` int(11) DEFAULT NULL,
  `keterangan_sekolah` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_ijazah` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_seminar`
--

CREATE TABLE `karyawan_seminar` (
  `id_seminar` int(11) NOT NULL,
  `id_karyawan` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nip_karyawan` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_seminar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempat_seminar` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `penyelenggara` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_awal_seminar` date DEFAULT NULL,
  `tgl_akhir_seminar` date DEFAULT NULL,
  `url_sertifikat` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_karyawan`
--

CREATE TABLE `kegiatan_karyawan` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan_kegiatan` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_kegiatan` date DEFAULT NULL,
  `jam_awal` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `jumlah_peserta` int(11) DEFAULT NULL,
  `url_gambar` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan_karyawan`
--

INSERT INTO `kegiatan_karyawan` (`id_kegiatan`, `nama_kegiatan`, `keterangan_kegiatan`, `tgl_kegiatan`, `jam_awal`, `jam_akhir`, `jumlah_peserta`, `url_gambar`) VALUES
(1, NULL, NULL, '2019-08-02', '07:00:00', '09:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_lembaga` int(1) DEFAULT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `id_tahun_ajaran` int(11) DEFAULT NULL,
  `id_tingkat` int(11) DEFAULT NULL,
  `nama_kelas` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ket_kelas` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_wali_kelas` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_ubah` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_ubah` timestamp NOT NULL DEFAULT current_timestamp(),
  `sts_aktif` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok_karyawan`
--

CREATE TABLE `kelompok_karyawan` (
  `id_kelompok_pegawai` int(11) NOT NULL,
  `nama_kelompok_pegawai` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kelompok_karyawan`
--

INSERT INTO `kelompok_karyawan` (`id_kelompok_pegawai`, `nama_kelompok_pegawai`) VALUES
(1, 'Akademik'),
(2, 'Non Akademik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'bismillah', 1, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembaga`
--

CREATE TABLE `lembaga` (
  `id_lembaga` int(11) NOT NULL,
  `nama_lembaga` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `jam_absen_masuk` time DEFAULT NULL,
  `jam_absen_keluar` time DEFAULT NULL,
  `toleransi_terlambat` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `lembaga`
--

INSERT INTO `lembaga` (`id_lembaga`, `nama_lembaga`, `urutan`, `jam_absen_masuk`, `jam_absen_keluar`, `toleransi_terlambat`) VALUES
(1, 'AL-MA\'TUQ', 2, '12:12:00', NULL, NULL),
(2, 'AL-ZAMIL', 3, NULL, NULL, NULL),
(3, 'AL-BASSAM', 4, NULL, NULL, NULL),
(4, 'AL-`UNAIZY', 1, NULL, NULL, NULL),
(5, 'AL-BARKAH', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES
(1, 'Karyawan/ijin', 'post', 'a:15:{s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"bce99780-4605-4f5c-9d07-6d8d184720cb\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"104\";s:3:\"nip\";s:2:\"69\";s:3:\"sts\";s:1:\"I\";s:7:\"tglawal\";s:10:\"2020-03-10\";s:8:\"tglakhir\";s:10:\"2020-03-13\";s:10:\"keterangan\";s:18:\"keperluan keluarga\";s:10:\"ISTREN-KEY\";s:9:\"bismillah\";}', 'bismillah', '::1', 1587441797, 1587440000, '1', 400);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_user`
--

CREATE TABLE `log_user` (
  `log_id` int(11) NOT NULL,
  `log_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_tipe` int(11) DEFAULT NULL,
  `log_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_app` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_os` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `log_user`
--

INSERT INTO `log_user` (`log_id`, `log_time`, `log_user`, `log_tipe`, `log_desc`, `log_app`, `log_os`, `log_ip`) VALUES
(9, '2019-02-16 06:39:43', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(10, '2019-02-16 06:47:14', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(11, '2019-02-16 06:48:03', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(12, '2019-02-16 06:48:08', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(13, '2019-02-16 06:48:47', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(14, '2019-02-16 06:49:16', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(15, '2019-02-16 06:55:47', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(16, '2019-02-16 06:56:26', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(17, '2019-02-16 06:56:37', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(18, '2019-02-16 06:57:10', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(19, '2019-02-16 06:57:33', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(20, '2019-02-16 06:58:12', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(21, '2019-02-16 06:58:18', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(22, '2019-02-16 06:58:36', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(23, '2019-02-16 06:58:40', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(24, '2019-02-16 06:58:43', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(25, '2019-02-16 07:00:44', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(26, '2019-02-16 07:00:47', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(27, '2019-02-16 07:00:52', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(28, '2019-02-16 07:01:04', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(29, '2019-02-16 07:13:14', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(30, '2019-02-16 07:13:37', NULL, 2, 'menambahkan data', NULL, NULL, NULL),
(31, '2019-02-16 07:33:02', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(32, '2019-02-16 07:33:13', 'handy', 0, 'Login Gagal', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(33, '2019-02-16 07:33:18', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(34, '2019-02-16 07:34:20', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(35, '2019-02-16 07:34:58', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(36, '2019-02-16 07:37:25', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(37, '2019-02-16 07:42:10', 'handy', 0, 'Login Gagal', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(38, '2019-02-16 07:42:16', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(39, '2019-02-16 07:48:01', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(40, '2019-02-16 07:48:31', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(41, '2019-02-16 07:48:44', 'handy', 0, 'Login Gagal', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(42, '2019-02-16 07:48:52', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(43, '2019-02-16 07:52:22', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(44, '2019-02-16 07:52:50', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(45, '2019-02-16 07:54:40', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(46, '2019-02-16 07:56:43', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(47, '2019-02-18 02:42:20', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(48, '2019-02-18 02:43:17', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(49, '2019-02-18 02:54:00', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(50, '2019-02-18 02:56:57', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(51, '2019-02-18 03:16:27', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(52, '2019-02-18 03:35:29', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(53, '2019-02-18 07:12:03', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(54, '2019-02-18 07:26:04', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(55, '2019-02-18 07:45:41', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(56, '2019-02-19 02:42:20', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(57, '2019-02-20 03:17:43', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(58, '2019-02-20 07:14:06', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(59, '2019-02-20 07:16:20', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(60, '2019-02-21 01:28:05', 'handy', 0, 'Login Gagal', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(61, '2019-02-21 01:28:16', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(62, '2019-02-21 01:28:28', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(63, '2019-02-21 01:38:08', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(64, '2019-02-21 02:26:51', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(65, '2019-02-21 02:38:07', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(66, '2019-02-21 04:12:54', 'handy', 0, 'Login Gagal', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(67, '2019-02-21 04:13:05', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(68, '2019-02-21 04:22:32', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(69, '2019-02-21 04:25:33', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(70, '2019-02-21 04:43:53', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(71, '2019-02-21 04:48:13', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(72, '2019-02-21 06:46:39', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(73, '2019-02-21 06:50:33', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(74, '2019-02-21 07:30:55', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(75, '2019-02-21 07:45:59', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(76, '2019-02-21 07:49:03', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(77, '2019-02-21 13:39:11', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(78, '2019-02-22 02:46:30', 'handy', 0, 'Login Gagal', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(79, '2019-02-22 02:46:34', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(80, '2019-02-23 04:55:23', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(81, '2019-02-23 06:41:26', 'handy', 0, 'Login Berhasil', 'Chrome 70.0.3538.80', 'Android', '192.168.1.242'),
(82, '2019-02-23 06:44:57', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(83, '2019-02-23 07:00:57', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(84, '2019-02-23 07:02:51', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(85, '2019-02-25 00:43:11', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(86, '2019-02-25 00:52:19', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(87, '2019-02-25 01:52:48', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(88, '2019-02-25 01:54:40', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(89, '2019-02-25 04:43:41', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(90, '2019-02-25 04:44:15', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(91, '2019-02-25 05:02:56', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(92, '2019-02-25 06:02:06', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(93, '2019-02-26 01:12:49', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(94, '2019-02-26 01:44:17', 'handy', 0, 'Login Gagal', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(95, '2019-02-26 01:44:21', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(96, '2019-02-26 02:08:34', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(97, '2019-02-26 02:58:16', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.109', 'Windows 10', '::1'),
(98, '2019-02-27 14:06:32', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.119', 'Windows 10', '::1'),
(99, '2019-02-28 03:22:52', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.119', 'Windows 10', '::1'),
(100, '2019-02-28 03:24:57', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.119', 'Windows 10', '::1'),
(101, '2019-02-28 06:17:35', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.119', 'Windows 10', '::1'),
(102, '2019-02-28 06:37:06', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.119', 'Windows 10', '::1'),
(103, '2019-03-06 07:52:29', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.121', 'Windows 10', '::1'),
(104, '2019-03-06 07:56:34', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.121', 'Windows 10', '::1'),
(105, '2019-03-06 08:05:16', 'handy', 0, 'Login Berhasil', 'Chrome 72.0.3626.105', 'Android', '192.168.26.154'),
(106, '2019-04-11 07:11:55', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(107, '2019-04-11 07:12:22', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(108, '2019-04-11 07:12:36', 'handy', 0, 'Login Gagal', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(109, '2019-04-11 07:12:41', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(110, '2019-04-25 01:53:29', 'handy', 0, 'Login Gagal', 'Safari 604.1', 'iOS', '::1'),
(111, '2019-04-25 01:53:34', 'handy', 0, 'Login Berhasil', 'Safari 604.1', 'iOS', '::1'),
(112, '2019-04-25 01:54:11', 'handy', 0, 'Login Gagal', 'Safari 537.10', 'Unknown Platform', '::1'),
(113, '2019-04-25 01:54:17', 'handy', 0, 'Login Berhasil', 'Safari 537.10', 'Unknown Platform', '::1'),
(114, '2019-04-25 01:58:42', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(115, '2019-04-25 01:59:03', 'handy', 0, 'Login Gagal', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(116, '2019-04-25 01:59:10', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(117, '2019-04-27 06:49:20', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(118, '2019-04-27 06:50:51', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(119, '2019-04-29 03:39:13', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(120, '2019-04-29 03:56:45', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(121, '2019-04-29 07:59:34', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(122, '2019-04-30 03:26:01', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(123, '2019-04-30 03:31:13', 'handy', 0, 'Login Gagal', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(124, '2019-04-30 03:31:17', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(125, '2019-04-30 04:27:15', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(126, '2019-04-30 04:33:15', 'handy', 0, 'Login Gagal', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(127, '2019-04-30 04:33:22', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(128, '2019-05-01 02:49:06', 'handy', 0, 'Login Gagal', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(129, '2019-05-01 02:49:24', 'handy', 0, 'Login Gagal', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(130, '2019-05-01 02:49:29', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(131, '2019-05-01 06:51:27', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(132, '2019-05-03 06:03:36', 'handy', 0, 'Login Gagal', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(133, '2019-05-03 06:03:44', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(134, '2019-05-03 06:38:06', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(135, '2019-05-03 06:38:56', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(136, '2019-05-03 08:00:04', 'handy', 0, 'Login Gagal', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(137, '2019-05-03 08:00:14', 'handy', 0, 'Login Berhasil', 'Chrome 73.0.3683.103', 'Windows 10', '::1'),
(138, '2019-05-04 01:01:57', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(139, '2019-05-04 01:06:19', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(140, '2019-05-04 01:11:42', 'HANDY', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(141, '2019-05-04 03:45:23', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(142, '2019-05-06 03:05:56', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(143, '2019-05-07 01:38:32', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(144, '2019-05-07 01:38:37', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(145, '2019-05-07 01:38:44', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(146, '2019-05-07 01:38:52', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(147, '2019-05-07 01:38:57', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(148, '2019-05-07 01:39:02', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(149, '2019-05-07 01:49:36', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(150, '2019-05-07 01:49:46', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(151, '2019-05-07 01:49:50', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(152, '2019-05-07 01:49:55', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(153, '2019-05-07 01:50:02', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(154, '2019-05-07 01:50:08', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(155, '2019-05-07 01:51:18', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(156, '2019-05-07 01:51:25', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(157, '2019-05-07 01:51:30', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(158, '2019-05-07 01:55:00', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(159, '2019-05-07 02:25:46', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(160, '2019-05-07 03:18:53', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(161, '2019-05-07 03:36:57', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(162, '2019-05-07 03:39:08', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(163, '2019-05-07 03:39:16', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(164, '2019-05-07 03:39:28', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(165, '2019-05-07 03:39:51', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(166, '2019-05-07 07:18:22', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(167, '2019-05-07 07:19:46', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(168, '2019-05-07 07:36:40', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(169, '2019-05-07 07:36:45', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(170, '2019-05-07 07:36:53', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(171, '2019-05-07 07:36:58', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(172, '2019-05-07 07:37:30', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(173, '2019-05-07 07:41:03', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(174, '2019-05-07 07:44:10', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(175, '2019-05-08 01:39:40', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(176, '2019-05-08 02:33:21', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(177, '2019-05-13 04:54:15', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(178, '2019-05-13 04:54:19', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(179, '2019-05-14 03:07:17', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(180, '2019-05-14 06:44:44', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(181, '2019-05-15 01:08:45', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(182, '2019-05-15 01:31:03', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(183, '2019-05-15 01:31:21', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(184, '2019-05-15 01:31:26', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(185, '2019-05-15 06:23:30', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(186, '2019-05-15 06:23:35', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(187, '2019-05-15 06:27:52', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(188, '2019-05-15 06:28:58', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(189, '2019-05-16 01:41:22', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(190, '2019-05-16 02:46:49', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(191, '2019-05-16 02:46:58', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(192, '2019-05-16 02:46:58', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(193, '2019-05-16 07:07:35', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(194, '2019-05-17 00:56:55', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(195, '2019-05-17 00:57:01', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.131', 'Windows 10', '::1'),
(196, '2019-05-17 02:12:57', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(197, '2019-05-17 08:01:51', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(198, '2019-05-18 02:04:01', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(199, '2019-05-18 02:42:30', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(200, '2019-05-18 04:28:13', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(201, '2019-05-20 00:38:22', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(202, '2019-05-20 04:38:15', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(203, '2019-05-20 04:48:18', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(204, '2019-05-20 06:33:49', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(205, '2019-05-20 07:03:30', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(206, '2019-05-20 07:03:35', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(207, '2019-05-24 13:41:29', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.157', 'Windows 10', '::1'),
(208, '2019-06-06 13:29:56', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(209, '2019-06-09 14:08:36', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(210, '2019-06-10 06:41:08', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(211, '2019-06-10 11:56:17', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(212, '2019-06-10 23:00:08', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(213, '2019-06-10 23:00:16', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(214, '2019-06-11 06:33:13', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(215, '2019-06-11 06:33:17', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(216, '2019-06-11 07:20:24', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(217, '2019-06-11 07:25:05', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(218, '2019-06-11 08:44:00', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(219, '2019-06-11 12:26:57', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(220, '2019-06-12 03:59:44', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(221, '2019-06-12 05:54:30', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(222, '2019-06-12 05:54:54', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(223, '2019-06-12 05:58:17', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(224, '2019-06-12 05:59:15', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(225, '2019-06-12 06:01:49', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(226, '2019-06-12 06:09:32', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(227, '2019-06-12 06:25:44', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(228, '2019-06-12 06:35:29', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(229, '2019-06-12 07:15:31', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(230, '2019-06-12 07:15:37', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(231, '2019-06-12 07:19:39', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(232, '2019-06-12 07:21:33', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(233, '2019-06-12 07:26:03', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(234, '2019-06-12 07:30:30', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(235, '2019-06-12 07:31:28', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(236, '2019-06-12 07:31:37', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(237, '2019-06-12 07:33:24', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(238, '2019-06-12 07:33:30', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(239, '2019-06-12 07:33:36', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(240, '2019-06-12 07:34:47', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(241, '2019-06-12 07:35:22', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(242, '2019-06-12 07:35:26', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(243, '2019-06-12 07:35:43', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(244, '2019-06-12 07:36:31', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(245, '2019-06-12 07:39:24', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(246, '2019-06-12 07:39:30', 'handy', 0, 'Login Gagal', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(247, '2019-06-12 07:39:51', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(248, '2019-06-12 07:40:01', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(249, '2019-06-12 07:40:09', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(250, '2019-06-12 07:41:45', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(251, '2019-06-12 14:07:35', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(252, '2019-06-12 14:08:01', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(253, '2019-06-12 14:12:48', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(254, '2019-06-12 14:13:03', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(255, '2019-06-15 02:22:52', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(256, '2019-06-15 04:26:43', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(257, '2019-06-15 04:46:42', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(258, '2019-06-15 05:18:46', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(259, '2019-06-15 05:18:54', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(260, '2019-06-15 05:21:00', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(261, '2019-06-15 09:18:22', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(262, '2019-06-15 09:39:49', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(263, '2019-06-15 09:41:11', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(264, '2019-06-15 09:41:16', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(265, '2019-06-15 13:29:37', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(266, '2019-06-17 06:15:05', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(267, '2019-06-17 06:15:19', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(268, '2019-06-19 02:10:19', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(269, '2019-06-19 03:36:05', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(270, '2019-06-19 13:39:00', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(271, '2019-06-19 13:40:17', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(272, '2019-06-19 13:41:58', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(273, '2019-06-19 13:42:03', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(274, '2019-06-19 13:47:48', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(275, '2019-06-19 13:53:40', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(276, '2019-06-19 13:56:42', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(277, '2019-06-19 13:58:49', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(278, '2019-06-19 14:01:06', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(279, '2019-06-19 14:01:12', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(280, '2019-06-19 14:03:10', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(281, '2019-06-19 14:04:35', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(282, '2019-06-19 14:04:40', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(283, '2019-06-19 14:05:58', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(284, '2019-06-19 14:07:41', 'handy', 0, 'Login Berhasil', 'Chrome 74.0.3729.169', 'Windows 10', '::1'),
(285, '2019-06-20 09:46:33', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(286, '2019-06-20 09:54:01', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(287, '2019-06-20 09:55:04', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(288, '2019-06-20 09:56:31', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(289, '2019-06-20 10:01:39', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(290, '2019-06-20 10:03:51', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(291, '2019-06-20 10:08:17', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(292, '2019-06-20 10:08:24', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(293, '2019-06-20 10:41:42', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(294, '2019-06-21 01:43:04', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(295, '2019-06-21 01:43:13', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(296, '2019-06-21 04:10:26', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(297, '2019-06-21 04:12:52', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(298, '2019-06-21 06:25:41', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(299, '2019-06-21 06:25:46', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(300, '2019-06-21 07:08:06', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(301, '2019-06-21 07:08:13', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(302, '2019-06-21 08:07:00', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(303, '2019-06-22 02:20:01', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(304, '2019-06-22 02:20:07', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(305, '2019-06-22 02:44:07', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(306, '2019-06-22 03:28:05', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(307, '2019-06-22 04:27:14', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(308, '2019-06-22 05:59:19', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(309, '2019-06-22 05:59:23', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(310, '2019-06-22 06:18:01', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(311, '2019-06-22 06:56:18', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(312, '2019-06-24 01:12:54', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(313, '2019-06-24 01:13:00', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(314, '2019-06-24 01:13:06', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(315, '2019-06-24 01:53:41', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(316, '2019-06-24 02:24:54', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(317, '2019-06-24 02:30:41', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(318, '2019-06-24 03:02:04', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(319, '2019-06-24 03:12:48', 'handysadikin', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(320, '2019-06-24 03:13:19', 'handysadikin', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(321, '2019-06-24 03:49:21', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(322, '2019-06-24 03:53:42', 'handysadikin', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(323, '2019-06-24 03:55:12', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(324, '2019-06-24 04:01:09', 'handysadikin', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(325, '2019-06-24 04:38:54', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(326, '2019-06-24 05:40:35', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(327, '2019-06-24 05:40:43', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(328, '2019-06-24 05:53:48', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(329, '2019-06-24 06:11:07', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(330, '2019-06-24 06:18:55', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(331, '2019-06-24 06:19:03', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(332, '2019-06-24 07:03:56', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(333, '2019-06-24 07:21:26', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(334, '2019-06-24 07:21:33', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(335, '2019-06-24 07:21:37', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(336, '2019-06-24 07:49:05', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(337, '2019-06-24 07:54:44', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(338, '2019-06-24 09:15:48', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(339, '2019-06-24 09:21:11', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(340, '2019-06-24 09:33:59', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(341, '2019-06-24 09:41:43', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(342, '2019-06-24 09:42:13', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(343, '2019-06-24 09:42:21', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(344, '2019-06-24 09:42:29', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(345, '2019-06-24 09:42:40', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(346, '2019-06-24 09:43:45', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(347, '2019-06-24 09:50:11', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(348, '2019-06-24 09:50:17', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(349, '2019-06-24 09:52:09', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(350, '2019-06-24 12:57:38', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(351, '2019-06-24 12:57:43', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(352, '2019-06-24 12:57:48', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(353, '2019-06-24 12:57:53', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(354, '2019-06-24 12:58:01', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(355, '2019-06-24 12:58:22', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(356, '2019-06-24 13:15:18', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(357, '2019-06-24 13:28:04', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(358, '2019-06-25 00:57:09', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(359, '2019-06-25 01:21:50', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(360, '2019-06-25 01:21:55', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(361, '2019-06-25 01:35:27', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(362, '2019-06-25 02:23:37', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(363, '2019-06-25 02:58:59', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(364, '2019-06-25 03:41:08', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(365, '2019-06-25 04:03:19', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(366, '2019-06-25 04:58:22', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(367, '2019-06-25 06:03:27', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(368, '2019-06-25 06:03:31', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(369, '2019-06-25 06:24:09', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(370, '2019-06-25 07:19:56', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(371, '2019-06-25 07:23:44', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(372, '2019-06-26 02:12:52', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(373, '2019-06-26 02:51:01', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(374, '2019-06-26 06:39:52', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(375, '2019-06-26 06:50:08', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(376, '2019-06-26 13:14:40', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(377, '2019-06-26 13:15:36', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(378, '2019-06-26 13:16:40', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(379, '2019-06-26 13:27:31', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(380, '2019-06-27 03:06:15', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(381, '2019-06-27 03:27:59', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(382, '2019-06-27 04:57:52', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(383, '2019-06-27 05:32:29', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(384, '2019-06-27 05:35:18', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(385, '2019-06-27 06:26:28', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(386, '2019-06-27 06:26:34', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(387, '2019-06-27 06:55:02', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(388, '2019-06-27 06:55:14', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(389, '2019-06-27 06:55:35', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(390, '2019-06-27 07:08:56', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(391, '2019-06-27 07:19:30', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(392, '2019-06-27 13:53:11', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(393, '2019-06-27 13:53:17', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(394, '2019-06-27 14:12:15', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(395, '2019-06-29 02:27:03', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(396, '2019-06-29 02:41:04', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(397, '2019-06-29 03:09:59', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(398, '2019-06-29 03:50:22', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(399, '2019-06-29 04:47:22', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(400, '2019-06-29 05:49:20', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(401, '2019-07-01 00:28:12', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(402, '2019-07-01 00:48:32', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(403, '2019-07-01 01:27:04', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(404, '2019-07-01 06:34:36', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(405, '2019-07-01 14:13:41', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(406, '2019-07-01 14:42:33', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(407, '2019-07-02 02:14:54', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(408, '2019-07-02 02:25:33', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(409, '2019-07-02 02:38:40', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(410, '2019-07-02 02:49:28', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(411, '2019-07-02 03:18:25', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(412, '2019-07-02 04:24:58', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(413, '2019-07-02 04:46:41', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(414, '2019-07-03 01:27:13', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(415, '2019-07-03 02:18:17', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(416, '2019-07-03 02:47:51', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(417, '2019-07-03 03:02:42', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(418, '2019-07-03 03:30:09', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(419, '2019-07-03 03:55:58', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(420, '2019-07-03 04:14:03', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(421, '2019-07-03 04:37:11', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(422, '2019-07-03 07:18:03', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(423, '2019-07-03 07:30:00', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(424, '2019-07-03 08:17:23', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(425, '2019-07-04 10:14:17', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(426, '2019-07-04 10:14:19', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(427, '2019-07-04 12:13:36', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(428, '2019-07-04 13:17:37', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(429, '2019-07-04 13:29:16', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(430, '2019-07-04 13:42:13', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(431, '2019-07-08 13:36:47', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(432, '2019-07-09 01:34:19', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(433, '2019-07-09 02:14:40', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(434, '2019-07-09 02:35:17', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(435, '2019-07-09 03:22:08', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(436, '2019-07-09 04:26:20', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(437, '2019-07-09 07:15:42', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(438, '2019-07-09 07:26:41', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(439, '2019-07-09 07:47:13', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(440, '2019-07-09 14:29:44', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(441, '2019-07-10 00:50:54', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(442, '2019-07-10 01:46:02', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(443, '2019-07-10 02:22:46', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(444, '2019-07-12 02:08:49', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.100', 'Windows 10', '::1'),
(445, '2019-08-02 04:03:39', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(446, '2019-08-02 04:03:44', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(447, '2019-08-02 04:03:48', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(448, '2019-08-02 04:12:19', 'ajat', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(449, '2019-08-02 04:14:10', 'ilham', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(450, '2019-08-02 05:56:26', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(451, '2019-08-02 06:10:09', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(452, '2019-08-02 06:20:12', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(453, '2019-08-02 06:27:19', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(454, '2019-08-02 06:27:25', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(455, '2019-08-02 06:27:30', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(456, '2019-08-02 06:28:19', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(457, '2019-08-02 06:30:14', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(458, '2019-08-02 06:58:58', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(459, '2019-08-10 04:29:21', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(460, '2019-08-10 04:29:42', 'handy', 0, 'Login Berhasil', 'Chrome 75.0.3770.142', 'Windows 10', '::1'),
(461, '2019-08-10 06:09:06', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(462, '2019-08-10 06:43:06', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(463, '2019-08-10 07:11:02', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(464, '2019-08-10 07:23:31', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(465, '2019-08-10 08:00:00', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(466, '2019-08-10 08:00:08', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(467, '2019-08-10 08:51:02', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(468, '2019-08-10 10:26:44', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(469, '2019-08-10 10:55:46', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(470, '2019-08-10 10:55:50', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(471, '2019-08-12 00:46:53', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(472, '2019-08-12 00:46:58', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(473, '2019-08-12 01:49:40', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(474, '2019-08-12 03:08:20', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(475, '2019-08-12 06:22:25', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(476, '2019-08-12 06:22:32', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(477, '2019-08-12 06:22:39', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(478, '2019-08-12 06:22:47', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(479, '2019-08-12 06:22:55', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(480, '2019-08-12 06:23:00', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(481, '2019-08-12 06:47:25', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(482, '2019-08-12 07:12:39', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(483, '2019-08-14 01:31:35', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(484, '2019-08-14 02:51:29', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(485, '2019-08-14 03:31:34', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(486, '2019-08-14 03:42:36', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(487, '2019-08-14 03:53:55', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(488, '2019-08-14 05:03:14', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(489, '2019-08-14 07:52:36', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(490, '2019-08-15 07:05:20', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(491, '2019-08-15 12:59:50', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(492, '2019-08-16 01:12:22', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(493, '2019-08-16 01:54:52', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(494, '2019-08-16 03:14:00', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(495, '2019-08-18 13:39:13', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(496, '2019-08-19 01:39:06', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(497, '2019-08-19 02:16:49', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(498, '2019-08-19 02:46:18', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(499, '2019-08-19 03:13:56', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(500, '2019-08-19 06:10:26', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(501, '2019-08-19 06:11:55', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(502, '2019-08-19 06:12:02', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(503, '2019-08-19 06:12:26', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(504, '2019-08-19 06:12:33', 'ilham', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(505, '2019-08-19 06:19:24', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(506, '2019-08-19 06:20:27', 'ilham', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(507, '2019-08-19 06:50:17', 'ilham', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(508, '2019-08-19 06:53:01', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(509, '2019-08-19 06:55:15', 'ilham', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(510, '2019-08-19 06:57:30', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(511, '2019-08-19 08:06:03', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(512, '2019-08-20 01:21:09', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(513, '2019-08-20 03:23:25', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(514, '2019-08-20 04:14:37', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1');
INSERT INTO `log_user` (`log_id`, `log_time`, `log_user`, `log_tipe`, `log_desc`, `log_app`, `log_os`, `log_ip`) VALUES
(515, '2019-08-27 13:09:54', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(516, '2019-08-27 14:18:58', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(517, '2019-08-28 03:14:06', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(518, '2019-08-28 04:59:40', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(519, '2019-08-28 04:59:45', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(520, '2019-08-28 07:27:48', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(521, '2019-08-28 07:27:52', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.100', 'Windows 10', '::1'),
(522, '2019-08-28 13:46:27', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(523, '2019-08-28 13:46:35', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(524, '2019-08-29 00:41:03', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(525, '2019-08-29 01:46:08', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(526, '2019-08-29 01:46:14', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(527, '2019-08-29 02:08:43', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(528, '2019-08-29 02:08:48', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(529, '2019-08-29 02:59:23', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(530, '2019-08-29 03:27:53', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(531, '2019-08-29 05:54:28', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(532, '2019-08-29 05:54:33', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(533, '2019-08-29 09:40:33', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(534, '2019-08-29 09:40:39', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(535, '2019-08-29 09:46:47', 'handy', 0, 'Login Gagal', NULL, NULL, NULL),
(536, '2019-08-29 09:51:37', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(537, '2019-08-29 10:00:40', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(538, '2019-08-29 15:42:58', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(539, '2019-08-29 15:43:03', 'handy', 0, 'Login Berhasil', 'Chrome 76.0.3809.132', 'Windows 10', '::1'),
(540, '2019-09-16 06:26:42', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(541, '2019-09-16 06:26:46', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(542, '2019-09-16 06:26:49', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(543, '2019-09-16 06:26:55', 'handy', 0, 'Login Berhasil', 'Chrome 77.0.3865.75', 'Windows 10', '::1'),
(544, '2019-09-16 07:11:45', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(545, '2019-09-16 07:11:49', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(546, '2019-09-16 07:11:55', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(547, '2019-09-16 07:12:00', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(548, '2019-09-16 07:12:06', 'handy', 0, 'Login Berhasil', 'Chrome 77.0.3865.75', 'Windows 10', '::1'),
(549, '2019-09-23 05:56:52', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(550, '2019-09-23 05:56:56', 'handy', 0, 'Login Berhasil', 'Chrome 77.0.3865.90', 'Windows 10', '::1'),
(551, '2019-10-05 23:11:06', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(552, '2019-10-05 23:11:14', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(553, '2019-10-05 23:11:19', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(554, '2019-10-05 23:11:25', 'handy', 0, 'Login Berhasil', 'Chrome 77.0.3865.90', 'Windows 10', '::1'),
(555, '2019-10-06 00:16:47', 'handy', 0, 'Login Berhasil', 'Chrome 77.0.3865.90', 'Windows 10', '::1'),
(556, '2019-10-06 01:02:56', 'handy', 0, 'Login Berhasil', 'Chrome 77.0.3865.90', 'Windows 10', '::1'),
(557, '2019-10-14 12:59:09', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(558, '2019-10-14 12:59:14', 'handy', 0, 'Login Berhasil', 'Chrome 77.0.3865.90', 'Windows 10', '::1'),
(559, '2019-10-16 04:21:02', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(560, '2019-10-16 04:21:07', 'handy', 0, 'Login Berhasil', 'Chrome 77.0.3865.120', 'Windows 10', '::1'),
(561, '2019-10-16 04:23:39', 'handy', 0, 'Login Berhasil', 'Chrome 77.0.3865.120', 'Windows 10', '::1'),
(562, '2019-11-06 14:08:41', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.87', 'Windows 10', '::1'),
(563, '2019-11-08 07:18:41', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.87', 'Windows 10', '::1'),
(564, '2019-11-08 07:22:30', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.87', 'Windows 10', '::1'),
(565, '2019-11-16 01:54:03', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.97', 'Windows 10', '::1'),
(566, '2019-11-16 01:54:45', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.97', 'Windows 10', '::1'),
(567, '2019-11-19 14:47:04', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.97', 'Windows 10', '::1'),
(568, '2019-11-23 03:53:18', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.108', 'Windows 10', '::1'),
(569, '2019-11-23 06:26:14', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.108', 'Windows 10', '::1'),
(570, '2019-11-23 07:04:58', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.108', 'Windows 10', '::1'),
(571, '2019-11-29 01:04:14', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(572, '2019-11-29 01:04:18', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.108', 'Windows 10', '::1'),
(573, '2019-11-29 01:29:12', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.108', 'Windows 10', '::1'),
(574, '2019-12-17 07:39:15', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.108', 'Windows 10', '::1'),
(575, '2019-12-17 09:30:21', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(576, '2019-12-17 09:30:26', 'handy', 0, 'Login Berhasil', 'Chrome 78.0.3904.108', 'Windows 10', '::1'),
(577, '2019-12-25 05:39:15', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.88', 'Windows 10', '::1'),
(578, '2020-01-06 01:22:07', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.88', 'Windows 10', '::1'),
(579, '2020-01-09 01:08:55', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.88', 'Windows 10', '::1'),
(580, '2020-01-09 02:08:13', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.88', 'Windows 10', '::1'),
(581, '2020-01-11 05:02:01', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(582, '2020-01-11 05:02:12', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(583, '2020-01-11 05:02:28', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(584, '2020-01-11 05:04:56', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(585, '2020-01-11 05:05:03', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(586, '2020-01-11 05:06:55', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(587, '2020-01-11 05:12:48', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(588, '2020-01-11 05:12:55', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(589, '2020-01-11 05:13:11', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(590, '2020-01-11 05:14:53', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(591, '2020-01-11 05:14:56', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(592, '2020-01-11 05:40:00', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(593, '2020-01-11 05:40:25', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(594, '2020-01-11 05:40:50', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(595, '2020-01-11 05:40:54', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(596, '2020-01-11 06:51:14', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(597, '2020-01-11 07:05:46', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(598, '2020-01-13 01:03:50', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(599, '2020-01-13 01:07:28', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(600, '2020-01-13 01:07:32', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(601, '2020-01-13 01:10:22', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(602, '2020-01-13 02:04:55', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(603, '2020-01-13 02:06:43', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(604, '2020-01-13 02:27:01', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(605, '2020-01-13 02:30:05', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(606, '2020-01-13 03:34:41', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(607, '2020-01-13 03:36:07', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(608, '2020-01-13 03:39:24', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(609, '2020-01-13 03:46:33', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(610, '2020-01-13 03:47:37', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(611, '2020-01-13 04:39:43', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(612, '2020-01-13 04:41:52', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(613, '2020-01-13 04:46:12', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(614, '2020-01-13 07:23:53', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(615, '2020-01-13 07:24:23', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(616, '2020-01-14 06:05:50', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(617, '2020-01-14 07:34:35', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(618, '2020-01-15 02:30:13', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(619, '2020-01-15 07:50:54', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(620, '2020-01-16 01:02:26', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(621, '2020-01-16 01:08:24', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(622, '2020-01-16 01:42:03', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(623, '2020-01-16 01:42:43', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(624, '2020-01-16 01:55:18', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(625, '2020-01-16 01:57:38', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(626, '2020-01-16 01:57:59', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(627, '2020-01-16 02:00:26', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(628, '2020-01-16 02:01:20', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(629, '2020-01-16 02:05:42', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(630, '2020-01-16 02:23:57', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(631, '2020-01-16 02:34:34', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(632, '2020-01-16 02:47:20', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(633, '2020-01-16 03:17:49', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(634, '2020-01-16 03:34:56', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(635, '2020-01-16 03:39:12', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(636, '2020-01-16 04:18:12', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(637, '2020-01-16 05:00:16', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(638, '2020-01-16 05:01:34', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(639, '2020-01-16 05:36:29', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(640, '2020-01-17 00:51:17', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(641, '2020-01-17 02:27:06', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(642, '2020-01-17 02:49:54', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(643, '2020-01-17 03:40:52', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(644, '2020-01-17 03:40:57', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(645, '2020-01-17 03:50:31', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(646, '2020-01-17 04:26:18', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(647, '2020-01-17 07:24:20', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(648, '2020-01-17 07:28:43', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(649, '2020-01-18 01:24:58', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(650, '2020-01-18 02:07:11', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(651, '2020-01-21 02:40:14', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(652, '2020-01-21 05:03:30', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(653, '2020-01-21 06:29:13', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(654, '2020-01-22 02:58:50', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(655, '2020-01-22 03:16:11', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(656, '2020-01-22 03:37:06', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(657, '2020-01-22 07:41:23', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.117', 'Windows 10', '::1'),
(658, '2020-01-23 01:41:49', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(659, '2020-01-23 01:46:38', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(660, '2020-01-23 01:51:02', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(661, '2020-01-23 01:54:55', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(662, '2020-01-24 03:51:47', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(663, '2020-01-24 08:06:21', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(664, '2020-01-24 08:09:52', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(665, '2020-01-24 14:30:54', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(666, '2020-01-25 00:50:16', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(667, '2020-01-25 04:36:37', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(668, '2020-01-25 09:17:05', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(669, '2020-01-25 11:20:46', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(670, '2020-01-25 11:22:14', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(671, '2020-01-27 01:38:07', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(672, '2020-01-27 02:00:47', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(673, '2020-01-27 04:24:54', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(674, '2020-01-27 05:11:25', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(675, '2020-01-27 13:10:43', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(676, '2020-01-27 13:10:49', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(677, '2020-01-28 14:14:38', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(678, '2020-01-29 01:50:11', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(679, '2020-01-29 06:27:20', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(680, '2020-01-30 01:07:29', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(681, '2020-01-30 06:33:16', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(682, '2020-01-30 07:21:51', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(683, '2020-01-31 00:56:38', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(684, '2020-01-31 06:23:56', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(685, '2020-01-31 07:04:46', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(686, '2020-02-01 01:57:25', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(687, '2020-02-03 13:44:28', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(688, '2020-02-03 14:29:51', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(689, '2020-02-03 14:41:55', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(690, '2020-02-04 07:39:08', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(691, '2020-02-04 07:44:36', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(692, '2020-02-05 00:50:02', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(693, '2020-02-05 03:32:25', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(694, '2020-02-05 04:30:28', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(695, '2020-02-05 04:54:20', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(696, '2020-02-05 06:24:58', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(697, '2020-02-06 02:12:48', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(698, '2020-02-06 04:19:04', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(699, '2020-02-06 05:37:51', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(700, '2020-02-07 00:53:21', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(701, '2020-02-07 04:04:42', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(702, '2020-02-07 06:19:22', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(703, '2020-02-07 06:40:23', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(704, '2020-02-07 06:43:39', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(705, '2020-02-07 07:10:41', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(706, '2020-02-07 07:57:52', 'handy', 0, 'Login Berhasil', 'Chrome 79.0.3945.130', 'Windows 10', '::1'),
(707, '2020-02-08 00:54:47', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(708, '2020-02-08 01:03:48', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(709, '2020-02-08 02:30:33', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(710, '2020-02-08 03:08:49', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(711, '2020-02-10 02:24:19', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(712, '2020-02-10 02:24:25', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(713, '2020-02-10 03:30:26', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(714, '2020-02-11 01:48:37', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(715, '2020-02-12 01:34:58', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(716, '2020-02-12 05:45:45', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(717, '2020-02-12 06:30:26', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(718, '2020-02-12 10:15:26', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(719, '2020-02-12 13:42:37', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(720, '2020-02-12 13:42:50', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(721, '2020-02-12 13:42:56', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(722, '2020-02-12 14:28:54', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(723, '2020-02-12 14:59:01', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(724, '2020-02-13 01:28:42', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(725, '2020-02-13 02:39:56', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(726, '2020-02-13 03:14:16', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(727, '2020-02-13 05:00:04', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(728, '2020-02-13 06:35:02', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(729, '2020-02-13 07:13:04', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(730, '2020-02-13 10:09:43', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.100', 'Windows 10', '::1'),
(731, '2020-02-14 04:10:11', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(732, '2020-02-14 13:40:49', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(733, '2020-02-15 01:47:47', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(734, '2020-02-15 02:59:26', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(735, '2020-02-15 04:45:19', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(736, '2020-02-15 05:42:04', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(737, '2020-02-15 07:37:35', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(738, '2020-02-17 00:38:00', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(739, '2020-02-17 02:59:48', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(740, '2020-02-17 03:16:14', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(741, '2020-02-17 05:02:57', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(742, '2020-02-17 05:40:00', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(743, '2020-02-17 06:45:15', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(744, '2020-02-17 09:35:54', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(745, '2020-02-17 10:57:44', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(746, '2020-02-17 13:30:55', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(747, '2020-02-18 00:36:15', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(748, '2020-02-18 00:36:20', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(749, '2020-02-18 01:11:51', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(750, '2020-02-18 01:40:35', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(751, '2020-02-19 05:47:54', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.106', 'Windows 10', '::1'),
(752, '2020-02-20 01:31:05', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(753, '2020-02-20 02:14:42', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(754, '2020-02-20 03:49:26', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(755, '2020-02-20 04:55:31', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(756, '2020-02-20 06:47:28', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(757, '2020-02-21 01:51:29', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(758, '2020-02-21 02:12:38', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(759, '2020-02-21 06:05:07', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(760, '2020-02-21 06:05:19', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(761, '2020-02-21 06:45:34', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(762, '2020-02-22 01:15:09', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(763, '2020-02-22 01:36:51', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(764, '2020-02-23 05:46:51', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(765, '2020-02-24 01:20:20', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(766, '2020-02-24 01:52:06', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(767, '2020-02-24 02:07:41', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(768, '2020-02-24 03:06:52', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(769, '2020-02-24 05:46:16', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(770, '2020-02-24 07:43:00', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(771, '2020-02-25 02:12:27', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(772, '2020-02-25 04:48:44', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(773, '2020-02-25 05:37:15', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.116', 'Windows 10', '::1'),
(774, '2020-02-26 02:54:33', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(775, '2020-02-26 03:26:39', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(776, '2020-02-26 05:08:05', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(777, '2020-02-26 05:37:13', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(778, '2020-02-26 06:42:13', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(779, '2020-02-27 01:30:13', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(780, '2020-02-27 03:27:32', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(781, '2020-02-27 04:55:34', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(782, '2020-02-27 05:37:53', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(783, '2020-02-27 06:51:41', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(784, '2020-02-27 07:20:40', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(785, '2020-02-27 07:50:26', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(786, '2020-02-28 01:41:50', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(787, '2020-02-28 02:07:24', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(788, '2020-02-28 03:22:05', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(789, '2020-02-28 04:10:18', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(790, '2020-02-28 06:14:36', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(791, '2020-02-28 07:17:57', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(792, '2020-03-02 01:04:18', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(793, '2020-03-02 02:56:52', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(794, '2020-03-02 05:12:31', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(795, '2020-03-02 06:59:25', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(796, '2020-03-02 07:36:16', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(797, '2020-03-02 13:34:38', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(798, '2020-03-03 00:56:40', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(799, '2020-03-03 01:45:22', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(800, '2020-03-03 03:19:53', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(801, '2020-03-03 03:56:32', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(802, '2020-03-03 05:39:50', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(803, '2020-03-03 06:18:50', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(804, '2020-03-03 07:28:57', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(805, '2020-03-03 07:53:06', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(806, '2020-03-04 00:40:32', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(807, '2020-03-04 01:02:54', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(808, '2020-03-04 02:13:18', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(809, '2020-03-04 02:58:56', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(810, '2020-03-04 04:06:04', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(811, '2020-03-04 04:23:25', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(812, '2020-03-04 04:59:53', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(813, '2020-03-04 06:22:42', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(814, '2020-03-04 07:46:26', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.122', 'Windows 10', '::1'),
(815, '2020-03-11 02:06:20', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.132', 'Windows 10', '::1'),
(816, '2020-03-11 03:42:54', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.132', 'Windows 10', '::1'),
(817, '2020-03-11 04:41:02', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.132', 'Windows 10', '::1'),
(818, '2020-03-28 08:07:27', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(819, '2020-03-28 08:07:41', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(820, '2020-03-28 08:07:50', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.149', 'Windows 10', '::1'),
(821, '2020-04-03 08:10:36', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.149', 'Windows 10', '::1'),
(822, '2020-05-04 04:54:35', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(823, '2020-05-04 04:54:39', 'handy', 0, 'Login Berhasil', 'Chrome 81.0.4044.129', 'Windows 10', '::1'),
(824, '2020-05-29 10:05:12', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(825, '2020-05-29 10:05:25', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(826, '2020-05-29 10:05:29', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(827, '2020-05-29 10:05:34', 'handy', 0, 'Login Berhasil', 'Chrome 81.0.4044.138', 'Windows 10', '::1'),
(828, '2020-05-30 13:47:27', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.61', 'Windows 10', '::1'),
(829, '2020-06-12 01:01:16', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.97', 'Windows 10', '::1'),
(830, '2020-06-16 02:15:24', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.97', 'Windows 10', '::1'),
(831, '2020-06-16 03:00:30', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.97', 'Windows 10', '::1'),
(832, '2020-06-16 03:43:30', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.97', 'Windows 10', '::1'),
(833, '2020-06-19 07:50:23', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.106', 'Windows 10', '::1'),
(834, '2020-06-22 07:10:21', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.106', 'Windows 10', '::1'),
(835, '2020-06-22 07:16:42', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.106', 'Windows 10', '::1'),
(836, '2020-06-27 01:30:20', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(837, '2020-06-27 01:33:10', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(838, '2020-06-27 04:08:56', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(839, '2020-06-27 07:13:10', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(840, '2020-06-27 07:51:29', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(841, '2020-06-27 07:57:37', 'handy', 0, 'Login Gagal', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(842, '2020-06-27 08:01:05', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(843, '2020-06-27 08:02:07', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(844, '2020-06-27 08:06:55', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(845, '2020-06-29 02:29:27', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(846, '2020-06-29 02:30:14', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(847, '2020-06-29 03:29:22', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(848, '2020-06-29 03:30:14', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(849, '2020-06-29 03:30:38', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(850, '2020-06-29 03:32:42', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(851, '2020-06-29 03:32:59', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(852, '2020-06-29 03:42:19', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(853, '2020-06-29 03:45:38', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(854, '2020-06-29 04:02:45', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(855, '2020-06-29 04:03:43', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(856, '2020-06-29 05:04:51', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(857, '2020-06-29 05:05:48', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(858, '2020-06-29 05:06:30', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(859, '2020-06-29 05:08:43', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(860, '2020-06-29 06:03:45', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(861, '2020-06-29 06:04:36', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(862, '2020-06-29 06:05:03', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(863, '2020-06-29 06:21:29', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(864, '2020-06-29 07:06:01', 'yusuf', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(865, '2020-06-29 07:06:28', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(866, '2020-06-29 07:07:38', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(867, '2020-06-29 07:08:03', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(868, '2020-06-29 07:08:18', 'yusuf', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(869, '2020-06-29 07:08:42', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(870, '2020-06-29 07:08:49', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(871, '2020-06-29 07:19:15', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(872, '2020-06-29 07:20:48', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(873, '2020-06-29 07:21:26', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(874, '2020-06-29 07:41:23', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(875, '2020-06-29 07:41:58', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(876, '2020-06-29 07:47:36', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(877, '2020-06-29 07:59:16', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(878, '2020-06-29 13:38:19', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(879, '2020-06-30 00:55:17', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(880, '2020-06-30 01:12:54', '0120180710011', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(881, '2020-06-30 01:14:28', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(882, '2020-06-30 06:27:36', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(883, '2020-06-30 08:17:48', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(884, '2020-06-30 08:27:36', 'handy', 2, 'menambahkan userok', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(885, '2020-06-30 13:52:10', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(886, '2020-06-30 14:31:22', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(887, '2020-07-01 00:52:01', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(888, '2020-07-01 01:35:19', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(889, '2020-07-01 06:43:55', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(890, '2020-07-01 07:15:13', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(891, '2020-07-01 07:23:10', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(892, '2020-07-01 07:32:02', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(893, '2020-07-01 07:38:08', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(894, '2020-07-01 07:39:01', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(895, '2020-07-02 02:12:33', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(896, '2020-07-02 03:10:31', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(897, '2020-07-02 03:21:51', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(898, '2020-07-02 03:21:52', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(899, '2020-07-02 03:22:32', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(900, '2020-07-02 03:22:39', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(901, '2020-07-02 03:47:56', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(902, '2020-07-02 03:48:00', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(903, '2020-07-02 03:48:09', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(904, '2020-07-02 07:30:29', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(905, '2020-07-02 07:30:36', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(906, '2020-07-03 02:18:21', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(907, '2020-07-03 02:18:30', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(908, '2020-07-03 03:37:59', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(909, '2020-07-03 03:59:55', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(910, '2020-07-03 04:23:59', 'handy', 2, 'menambahkan kalender kerja 09-07-2020', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(911, '2020-07-03 04:46:17', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(912, '2020-07-03 04:46:24', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(913, '2020-07-03 06:12:39', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(914, '2020-07-03 06:38:06', 'handy', 3, 'merubah kalender kerja Input kaleces', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(915, '2020-07-03 06:42:01', 'handy', 3, 'merubah kalender kerja Input kaleces', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(916, '2020-07-03 06:43:29', 'handy', 3, 'merubah kalender kerja Input kalecexd', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(917, '2020-07-03 06:43:38', 'handy', 3, 'merubah kalender kerja Input kalecexssss', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(918, '2020-07-03 07:17:39', 'handy', 2, 'menambahkan kalender kerja 09-07-2020', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(919, '2020-07-03 07:18:37', 'handy', 3, 'merubah kalender kerja dcsdfsdsgg', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(920, '2020-07-03 08:13:43', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(921, '2020-07-03 08:13:49', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(922, '2020-07-03 08:20:13', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(923, '2020-07-04 06:28:30', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(924, '2020-07-06 02:40:55', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(925, '2020-07-06 06:57:51', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(926, '2020-07-06 06:57:57', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(927, '2020-07-06 06:58:03', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(928, '2020-07-06 07:27:15', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(929, '2020-07-06 07:27:21', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(930, '2020-07-08 04:31:07', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(931, '2020-07-08 04:31:14', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(932, '2020-07-08 04:31:23', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(933, '2020-07-08 04:32:36', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(934, '2020-07-08 04:32:47', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(935, '2020-07-08 04:33:00', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(936, '2020-07-08 04:59:34', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(937, '2020-07-08 06:09:11', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(938, '2020-07-09 00:43:34', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(939, '2020-07-09 01:33:18', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(940, '2020-07-09 03:07:05', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(941, '2020-07-09 03:46:34', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(942, '2020-07-09 06:02:40', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(943, '2020-07-10 00:36:32', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(944, '2020-07-10 03:11:50', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(945, '2020-07-10 07:09:01', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(946, '2020-07-10 08:05:33', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(947, '2020-07-11 01:01:25', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(948, '2020-07-11 06:11:22', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(949, '2020-07-13 00:36:17', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(950, '2020-07-13 02:01:54', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(951, '2020-07-13 02:39:01', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(952, '2020-07-13 06:30:31', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(953, '2020-07-14 00:42:52', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(954, '2020-07-14 03:32:00', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(955, '2020-07-14 03:53:44', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(956, '2020-07-14 05:02:20', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(957, '2020-07-14 06:32:41', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(958, '2020-07-14 07:45:07', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(959, '2020-07-15 00:53:15', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(960, '2020-07-15 01:48:39', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(961, '2020-07-15 02:54:33', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(962, '2020-07-15 06:18:24', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(963, '2020-07-16 00:38:49', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(964, '2020-07-16 02:11:28', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(965, '2020-07-16 04:19:15', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(966, '2020-07-16 06:44:11', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(967, '2020-07-16 07:45:30', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(968, '2020-07-17 00:56:09', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(969, '2020-07-17 01:56:59', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(970, '2020-07-17 03:17:38', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(971, '2020-07-17 04:30:32', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(972, '2020-07-17 07:01:37', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(973, '2020-07-18 00:57:14', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(974, '2020-07-18 03:26:15', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(975, '2020-07-18 03:26:35', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(976, '2020-07-18 05:05:24', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(977, '2020-07-18 07:12:38', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(978, '2020-07-18 07:55:19', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(979, '2020-07-20 00:41:25', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(980, '2020-07-20 00:56:59', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(981, '2020-07-20 00:57:07', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(982, '2020-07-20 00:57:23', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(983, '2020-07-20 00:57:39', 'handy', 0, 'Login Berhasil', 'Chrome 83.0.4103.116', 'Windows 10', '::1'),
(984, '2020-07-20 01:39:45', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(985, '2020-07-20 03:30:53', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(986, '2020-07-20 06:50:56', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(987, '2020-07-21 00:48:17', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(988, '2020-07-21 02:00:52', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(989, '2020-07-21 03:31:39', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(990, '2020-07-21 06:29:22', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(991, '2020-07-22 00:41:48', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(992, '2020-07-22 02:10:38', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(993, '2020-07-22 04:58:23', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(994, '2020-07-22 06:19:02', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(995, '2020-07-23 01:04:59', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(996, '2020-07-23 04:21:32', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(997, '2020-07-23 06:26:07', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(998, '2020-07-23 06:52:30', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(999, '2020-07-24 00:40:09', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1000, '2020-07-24 02:34:25', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1001, '2020-07-27 00:40:33', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(1002, '2020-07-27 03:25:27', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '127.0.0.1'),
(1003, '2020-07-27 04:17:05', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1004, '2020-07-27 04:49:40', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1005, '2020-07-27 07:16:20', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1006, '2020-07-27 07:50:16', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1007, '2020-07-28 03:19:35', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1008, '2020-07-28 06:06:33', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1009, '2020-07-29 00:35:44', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1010, '2020-07-29 03:27:06', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1011, '2020-07-29 03:52:54', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1012, '2020-07-29 05:54:18', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1013, '2020-07-29 07:30:16', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1014, '2020-07-30 00:45:42', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1015, '2020-07-30 01:59:53', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1016, '2020-07-30 04:43:05', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1017, '2020-07-30 06:13:18', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1018, '2020-07-30 07:58:38', 'handy', 0, 'Login Berhasil', 'Firefox 79.0', 'Windows 10', '::1'),
(1019, '2020-08-04 00:44:05', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1020, '2020-08-04 01:52:17', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1021, '2020-08-04 02:21:29', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1022, '2020-08-04 03:53:28', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1023, '2020-08-04 04:20:13', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1024, '2020-08-04 06:22:08', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1025, '2020-08-05 01:11:15', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1');
INSERT INTO `log_user` (`log_id`, `log_time`, `log_user`, `log_tipe`, `log_desc`, `log_app`, `log_os`, `log_ip`) VALUES
(1026, '2020-08-05 01:49:47', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1027, '2020-08-05 02:10:24', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1028, '2020-08-05 08:53:51', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1029, '2020-08-06 00:44:16', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1030, '2020-08-06 02:12:05', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1031, '2020-08-06 02:48:51', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1032, '2020-08-06 04:31:09', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1033, '2020-08-06 07:08:04', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1034, '2020-08-06 08:20:55', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1035, '2020-08-06 09:02:52', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1036, '2020-08-07 01:13:48', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1037, '2020-08-07 03:24:44', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1038, '2020-08-07 04:16:17', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1039, '2020-08-07 06:40:49', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1040, '2020-08-07 07:21:05', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1041, '2020-08-08 00:49:09', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1042, '2020-08-08 01:39:41', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1043, '2020-08-08 01:39:44', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1044, '2020-08-08 01:39:52', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1045, '2020-08-08 01:39:59', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1046, '2020-08-08 03:57:10', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1047, '2020-08-10 00:33:42', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1048, '2020-08-11 01:04:19', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1049, '2020-08-11 01:24:07', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1050, '2020-08-11 03:29:36', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1051, '2020-08-11 03:29:41', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1052, '2020-08-11 05:09:16', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1053, '2020-08-11 05:09:24', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1054, '2020-08-11 06:20:16', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1055, '2020-08-11 06:20:21', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1056, '2020-08-11 07:32:43', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1057, '2020-08-12 04:57:28', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1058, '2020-08-12 06:36:54', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1059, '2020-08-12 07:26:16', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1060, '2020-08-13 01:06:06', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1061, '2020-08-13 01:36:32', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1062, '2020-08-13 02:32:59', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1063, '2020-08-13 03:47:20', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1064, '2020-08-13 05:03:51', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1065, '2020-08-15 00:51:08', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1066, '2020-08-15 01:24:41', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1067, '2020-08-15 07:05:02', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1068, '2020-08-17 01:12:06', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1069, '2020-08-17 01:40:10', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1070, '2020-08-17 04:25:06', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1071, '2020-08-17 06:10:12', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1072, '2020-08-17 08:57:45', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1073, '2020-08-18 03:08:55', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1074, '2020-08-18 04:35:27', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1075, '2020-08-18 04:59:01', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1076, '2020-08-18 07:53:19', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1077, '2020-08-18 07:53:23', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1078, '2020-08-19 00:55:56', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1079, '2020-08-19 01:53:53', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1080, '2020-08-19 03:15:00', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1081, '2020-08-19 06:49:57', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1082, '2020-08-19 07:25:20', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1083, '2020-08-19 07:25:26', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1084, '2020-08-19 07:25:34', 'handy', 0, 'Login Berhasil', 'Chrome 84.0.4147.125', 'Windows 10', '172.18.2.55'),
(1085, '2020-08-20 01:11:04', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1086, '2020-08-20 06:26:49', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1087, '2020-08-20 07:27:40', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1088, '2020-08-20 07:53:21', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1089, '2020-08-21 01:00:54', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1090, '2020-08-21 01:37:44', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(1091, '2020-08-21 03:49:37', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(1092, '2020-08-21 04:00:27', 'handy', 0, 'Login Berhasil', 'Chrome 84.0.4147.125', 'Windows 10', '::1'),
(1093, '2020-08-21 06:15:26', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1094, '2020-08-24 00:43:34', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1095, '2020-08-24 01:38:56', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1096, '2020-08-24 02:20:12', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1097, '2020-08-24 04:09:43', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1098, '2020-08-24 05:00:46', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1099, '2020-08-24 06:12:54', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1100, '2020-08-24 06:44:35', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1101, '2020-08-24 08:20:12', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '127.0.0.1'),
(1102, '2020-08-25 01:10:52', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1103, '2020-08-25 01:36:23', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1104, '2020-08-25 03:15:54', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1105, '2020-08-25 05:14:44', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1106, '2020-08-25 06:33:16', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1107, '2020-08-26 00:59:10', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1108, '2020-08-26 02:34:59', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1109, '2020-08-26 07:51:09', 'handy', 0, 'Login Berhasil', 'Firefox 80.0', 'Windows 10', '::1'),
(1110, '2020-08-27 00:46:48', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1111, '2020-08-27 01:19:56', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1112, '2020-08-27 01:55:16', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1113, '2020-08-27 03:21:38', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1114, '2020-08-27 04:19:54', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1115, '2020-08-27 05:01:29', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1116, '2020-08-27 06:35:33', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1117, '2020-08-27 07:39:46', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1118, '2020-08-28 00:52:51', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1119, '2020-08-28 01:46:48', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1120, '2020-08-28 02:53:19', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1121, '2020-08-28 03:59:52', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '127.0.0.1'),
(1122, '2020-08-28 04:00:37', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '127.0.0.1'),
(1123, '2020-08-28 06:19:18', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1124, '2020-08-28 07:54:10', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '127.0.0.1'),
(1125, '2020-08-29 00:54:02', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1126, '2020-08-29 01:44:50', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1127, '2020-08-29 02:28:20', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1128, '2020-08-29 02:48:30', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1129, '2020-08-29 07:07:52', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1130, '2020-08-31 00:22:41', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1131, '2020-08-31 00:52:16', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1132, '2020-08-31 03:11:48', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1133, '2020-08-31 03:43:58', 'handy', 0, 'Login Berhasil', 'Chrome 84.0.4147.135', 'Windows 10', '172.18.1.188'),
(1134, '2020-08-31 06:20:29', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1135, '2020-08-31 07:38:36', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1136, '2020-09-01 00:51:30', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1137, '2020-09-01 02:41:59', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1138, '2020-09-01 05:56:11', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1139, '2020-09-01 07:21:38', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1140, '2020-09-02 01:04:03', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1141, '2020-09-02 02:59:55', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1142, '2020-09-02 06:59:58', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1143, '2020-09-03 00:59:19', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1144, '2020-09-03 03:31:31', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1145, '2020-09-03 03:56:53', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1146, '2020-09-03 05:52:52', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1147, '2020-09-03 06:48:03', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1148, '2020-09-03 07:32:07', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1149, '2020-09-03 07:52:46', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1150, '2020-09-04 00:49:52', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1151, '2020-09-04 02:22:49', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1152, '2020-09-04 03:35:22', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1153, '2020-09-04 06:37:11', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1154, '2020-09-04 07:16:38', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1155, '2020-09-05 00:50:48', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1156, '2020-09-05 02:24:02', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1157, '2020-09-05 06:05:49', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1158, '2020-09-05 07:01:17', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1159, '2020-09-08 00:37:37', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1160, '2020-09-08 02:27:16', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1161, '2020-09-08 03:04:45', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1162, '2020-09-08 04:58:14', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1163, '2020-09-08 05:44:50', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1164, '2020-09-08 06:39:24', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1165, '2020-09-08 07:18:58', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1166, '2020-09-09 01:07:27', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1167, '2020-09-09 01:48:43', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1168, '2020-09-09 03:20:38', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1169, '2020-09-09 06:20:45', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1170, '2020-09-10 00:44:35', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1171, '2020-09-10 01:18:33', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1172, '2020-09-10 02:57:39', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1173, '2020-09-10 04:00:44', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1174, '2020-09-10 06:35:17', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1175, '2020-09-10 07:07:43', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1176, '2020-09-11 00:59:07', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1177, '2020-09-11 02:54:05', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1178, '2020-09-11 03:36:57', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1179, '2020-09-11 07:07:03', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1180, '2020-09-11 07:42:44', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1181, '2020-09-12 01:19:21', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1182, '2020-09-12 01:52:53', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1183, '2020-09-12 02:32:08', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1184, '2020-09-12 03:33:16', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1185, '2020-09-12 04:00:40', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1186, '2020-09-12 06:01:47', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1187, '2020-09-12 06:28:20', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1188, '2020-09-14 01:05:46', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1189, '2020-09-14 01:44:15', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1190, '2020-09-14 02:18:38', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1191, '2020-09-14 02:49:17', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1192, '2020-09-14 03:53:39', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1193, '2020-09-14 06:24:03', 'handy', 0, 'Login Berhasil', 'Chrome 67.0.3396.87', 'Android', '::1'),
(1194, '2020-09-15 00:21:30', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1195, '2020-09-15 00:25:41', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1196, '2020-09-15 00:26:12', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.102', 'Windows 10', '172.18.1.1'),
(1197, '2020-09-15 00:33:36', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.102', 'Windows 10', '172.18.2.54'),
(1198, '2020-09-15 00:40:53', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1199, '2020-09-15 00:40:58', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(1200, '2020-09-15 00:52:54', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1201, '2020-09-15 01:26:29', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1202, '2020-09-15 01:26:37', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1203, '2020-09-15 01:28:57', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(1204, '2020-09-15 01:33:33', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.102', 'Windows 10', '172.18.2.1'),
(1205, '2020-09-15 02:01:58', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.102', 'Windows 10', '172.18.2.1'),
(1206, '2020-09-15 03:25:32', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1207, '2020-09-15 03:35:20', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.102', 'Windows 10', '172.18.2.1'),
(1208, '2020-09-15 04:00:37', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.101', 'Android', '172.18.2.1'),
(1209, '2020-09-15 04:12:43', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1210, '2020-09-15 04:21:57', 'handy', 0, 'Login Berhasil', 'Firefox 72.0', 'Windows 10', '172.18.2.1'),
(1211, '2020-09-15 04:39:47', 'handy', 0, 'Login Berhasil', 'Chrome 80.0.3987.87', 'Windows 10', '::1'),
(1212, '2020-09-15 04:42:22', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.101', 'Android', '172.18.2.1'),
(1213, '2020-09-15 04:47:49', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.102', 'Windows 10', '172.18.2.1'),
(1214, '2020-09-15 04:54:01', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '172.18.2.74'),
(1215, '2020-09-15 07:13:39', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1216, '2020-09-15 07:26:24', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '172.18.2.82'),
(1217, '2020-09-15 07:29:53', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.101', 'Android', '172.18.2.1'),
(1218, '2020-09-15 07:47:30', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1219, '2020-09-15 07:48:30', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.102', 'Windows 10', '172.18.2.108'),
(1220, '2020-09-16 01:17:33', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1221, '2020-09-16 02:13:14', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1222, '2020-09-16 03:08:46', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1223, '2020-09-16 04:51:25', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1224, '2020-09-18 00:57:59', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1225, '2020-09-18 00:58:08', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1226, '2020-09-18 00:58:22', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1227, '2020-09-18 01:59:22', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1228, '2020-09-18 02:42:59', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1229, '2020-09-22 07:01:54', 'handy', 0, 'Login Berhasil', 'Firefox 81.0', 'Windows 10', '::1'),
(1230, '2020-09-24 02:25:43', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '127.0.0.1'),
(1231, '2020-09-28 17:55:36', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1232, '2020-09-28 19:14:44', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1233, '2020-10-03 02:12:46', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1234, '2020-10-04 17:29:59', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1235, '2020-10-04 17:31:31', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1236, '2020-10-04 23:54:42', 'handy', 0, 'Login Berhasil', 'Chrome 85.0.4183.127', 'Android', '172.17.2.1'),
(1237, '2020-10-06 00:41:45', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1238, '2020-10-06 07:18:22', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1239, '2020-10-07 00:55:24', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1240, '2020-10-09 00:44:45', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1241, '2020-10-09 01:07:37', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1242, '2020-10-09 01:21:45', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1243, '2020-10-09 01:30:09', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1244, '2020-10-10 00:45:22', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1245, '2020-10-10 03:21:51', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1246, '2020-10-10 08:48:21', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1247, '2020-10-13 06:57:35', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1248, '2020-10-14 01:20:27', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1249, '2020-10-14 06:20:47', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1250, '2020-10-14 06:22:10', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1251, '2020-10-14 06:22:16', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1252, '2020-10-14 06:22:34', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1253, '2020-10-17 07:46:58', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1254, '2020-10-19 18:18:45', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1255, '2020-10-19 18:33:01', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1256, '2020-10-19 19:51:49', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '127.0.0.1'),
(1257, '2020-10-20 03:32:22', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '127.0.0.1'),
(1258, '2020-10-20 18:49:50', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1259, '2020-10-21 07:37:28', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1260, '2020-10-21 08:03:55', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1261, '2020-10-21 08:29:08', 'handy', 0, 'Login Berhasil', 'Firefox 82.0', 'Windows 10', '::1'),
(1262, '2020-10-22 01:26:56', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1263, '2020-10-22 06:14:28', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1264, '2020-10-23 01:36:28', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1265, '2020-10-23 02:16:02', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1266, '2020-10-23 02:56:39', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1267, '2020-10-23 03:21:07', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1268, '2020-10-23 06:03:08', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1269, '2020-10-23 07:41:13', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1270, '2020-10-24 01:46:58', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1271, '2020-10-24 03:09:31', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1272, '2020-10-24 04:45:43', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1273, '2020-10-24 06:20:06', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1274, '2020-10-24 07:54:09', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1275, '2020-10-24 08:21:13', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '127.0.0.1'),
(1276, '2020-10-26 00:25:04', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1277, '2020-10-26 01:04:35', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1278, '2020-10-26 01:35:59', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1279, '2020-10-27 01:09:08', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1280, '2020-10-27 01:32:09', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1281, '2020-10-27 03:55:07', NULL, 0, 'Login Gagal', NULL, NULL, NULL),
(1282, '2020-10-27 03:55:23', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1'),
(1283, '2020-10-27 06:13:40', 'handy', 0, 'Login Berhasil', 'Firefox 83.0', 'Windows 10', '::1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(3) UNSIGNED NOT NULL,
  `parent_id` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `nama_menu` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` int(1) DEFAULT 1,
  `icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `nama_menu`, `url`, `menu_order`, `status`, `icon`, `keterangan`) VALUES
(1, 0, 'Dashboard', '/all/admin_page', 0, 1, 'fa fa-dashboard', NULL),
(2, 3, 'Lembaga', '/all/lembaga', 1, 1, 'fa fa-circle-o', NULL),
(3, 0, 'Data Master', '#', 2, 1, 'fa fa-sitemap', NULL),
(4, 0, 'Kepegawaian', '/kepegawaian/karyawan', 3, 1, 'fa fa-plus-square', NULL),
(5, 0, 'Administrator', '#', 10, 1, 'fa fa-shield', NULL),
(6, 5, 'Hak Akses', '/all/menurole', 1, 1, 'fa fa-circle-o', NULL),
(33, 0, 'Laporan', '#', 6, 1, 'fa fa-bar-chart-o', NULL),
(34, 3, 'Departemen', '/all/departemen', 2, 1, 'fa fa-circle-o', NULL),
(35, 5, 'Menu', '/all/menu', 3, 1, 'fa fa-circle-o', NULL),
(38, 3, 'Unit Kerja', '/all/unitkerja', 4, 1, 'fa fa-circle-o', NULL),
(42, 3, 'Jabatan', '/all/jabatan', 3, 1, 'fa fa-circle-o', NULL),
(47, 5, 'Hak Akses Menu', '/all/menuakses', 2, 1, 'fa fa-circle-o', NULL),
(48, 5, 'Log User', '#', 4, 1, 'fa fa-circle-o', NULL),
(49, 33, 'Rekap Absensi Per Unit Kerja', '/kepegawaian/LaporanAbsen/RekapAbsenPerDep', 1, 1, 'fa fa-circle-o', NULL),
(52, 33, 'Rekap Absensi Per Karyawan', '/kepegawaian/laporanabsen', 2, 1, 'fa fa-circle-o', NULL),
(53, 0, 'Keuangan', '/all/backup', 5, 1, 'fa fa-dashboard', NULL),
(54, 0, 'Akademik', '/akademik/', 1, 1, 'fa fa-dashboard', NULL),
(56, 54, 'Data Siswa', '/akademik/datasiswa', 52, 1, 'fa fa-circle-o', NULL),
(57, 4, 'Data Karyawan', '/kepegawaian/karyawan', 0, 1, 'fa fa-circle-o', NULL),
(58, 5, 'User Pengguna', '/all/pengguna', 5, 1, 'fa fa-circle-o', NULL),
(59, 3, 'Absen Umum', '/all/absen', 0, 1, 'fa fa-circle-o', NULL),
(61, 3, 'Absen Shift', '/all/absen_pola', 0, 1, 'fa fa-circle-o', NULL),
(64, 4, 'Pengaturan Absen Shift', '/kepegawaian/Absen_shift', 2, 1, 'fa fa-circle-o', NULL),
(67, 0, 'Payroll', '/kepegawaian/payroll', 5, 1, 'fa fa-money', NULL),
(68, 53, 'Data Mukafaah Karyawan', '', 0, 1, 'fa fa-circle-o', NULL),
(69, 4, 'Data Absen', '', 0, 1, 'fa fa-circle-o', NULL),
(70, 4, 'Data Lembur', '', 0, 1, 'fa fa-circle-o', NULL),
(71, 3, 'Hari Libur', '/all/kalenderkerja', 0, 1, 'fa fa-circle-o', NULL),
(72, 67, 'Periode Penggajian', '/kepegawaian/Payroll/periode_penggajian', 0, 1, 'fa fa-circle-o', NULL),
(73, 67, 'Kategori', '/kepegawaian/payroll/kategori', 0, 1, 'fa fa-circle-o', NULL),
(74, 67, 'Teamplate Gaji', '/kepegawaian/payroll/teamplate_gaji/', 0, 1, 'fa fa-circle-o', NULL),
(76, 67, 'Gaji', '/kepegawaian/payroll/gaji/', 0, 1, 'fa fa-circle-o', NULL),
(77, 67, 'Kategori Komponen', '/kepegawaian/payroll/kategori_komponen/v_kategori_komponen', 0, 1, 'fa fa-circle-o', NULL),
(78, 4, 'Status Karyawan', 'all/statuskaryawan/', 0, 1, 'fa fa-circle-o', NULL),
(79, 4, 'Status Aktif Pegawai', 'all/statusaktifpegawai/', 0, 1, 'fa fa-circle-o', NULL),
(80, 3, 'Pendidikan', '/all/pendidikan', 0, 1, 'fa fa-circle-o', NULL),
(81, 3, 'Status Absen', 'all/statusabsen/', 0, 1, 'fa fa-circle-o', NULL),
(82, 33, 'Rekap Gaji', '/kepegawaian/LaporanGaji/', 0, 1, 'fa fa-circle-o', NULL),
(83, 4, 'Type Berkas', '/kepegawaian/typeberkas', 0, 1, 'fa fa-circle-o', NULL),
(84, 0, 'Buku Tamu', '/umum/Bukutamu', 0, 1, 'fa fa-book', NULL),
(85, 84, 'Daftar Tamu', '/umum/Daftartamu', 0, 1, 'fa fa-circle-o', NULL),
(86, 84, 'Formilir Pendaftaran Tamu', '/umum/Formulir', 0, 1, 'fa fa-circle-o', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_akses`
--

CREATE TABLE `menu_akses` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_menu` int(3) UNSIGNED NOT NULL,
  `parent_id` int(3) UNSIGNED NOT NULL,
  `id_role` int(3) UNSIGNED NOT NULL,
  `flag_lihat` int(1) DEFAULT 1,
  `flag_tambah` int(1) DEFAULT 1,
  `flag_ubah` int(1) DEFAULT 1,
  `flag_hapus` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `menu_akses`
--

INSERT INTO `menu_akses` (`id`, `id_menu`, `parent_id`, `id_role`, `flag_lihat`, `flag_tambah`, `flag_ubah`, `flag_hapus`) VALUES
(11, 5, 0, 1, 0, 0, 0, 0),
(12, 33, 0, 1, 0, 0, 0, 0),
(13, 53, 0, 1, 0, 0, 0, 0),
(14, 54, 0, 1, 0, 0, 0, 0),
(15, 2, 3, 1, 0, 0, 0, 0),
(16, 34, 3, 1, 0, 0, 0, 0),
(17, 38, 3, 1, 0, 0, 0, 0),
(18, 6, 5, 1, 0, 0, 0, 0),
(19, 42, 3, 1, 0, 0, 0, 0),
(20, 35, 5, 1, 0, 0, 0, 0),
(21, 47, 5, 1, 0, 0, 0, 0),
(53, 4, 0, 1, 0, 0, 0, 0),
(62, 3, 0, 1, 0, 0, 0, 0),
(77, 52, 33, 1, 1, 1, 1, 1),
(82, 1, 0, 1, 1, 1, 1, 1),
(85, 56, 54, 1, 1, 1, 1, 1),
(86, 1, 0, 2, 1, 1, 1, 1),
(87, 4, 0, 2, 1, 1, 1, 1),
(88, 3, 0, 2, 1, 1, 1, 1),
(89, 49, 33, 1, 1, 1, 1, 1),
(90, 57, 4, 1, 1, 1, 1, 1),
(96, 5, 0, 2, 1, 1, 1, 1),
(101, 48, 5, 1, 1, 1, 1, 1),
(105, 58, 5, 1, 1, 1, 1, 1),
(106, 59, 3, 1, 1, 1, 1, 1),
(116, 1, 0, 3, 1, 1, 1, 1),
(117, 4, 0, 3, 1, 1, 1, 1),
(118, 3, 0, 3, 1, 1, 1, 1),
(119, 33, 0, 3, 1, 1, 1, 1),
(120, 59, 3, 3, 1, 1, 1, 1),
(121, 57, 4, 3, 1, 1, 1, 1),
(123, 58, 5, 3, 1, 1, 1, 1),
(124, 49, 33, 3, 1, 1, 1, 1),
(125, 52, 33, 3, 1, 1, 1, 1),
(129, 64, 4, 1, 1, 1, 1, 1),
(132, 61, 3, 1, 1, 1, 1, 1),
(134, 67, 0, 1, 1, 1, 1, 1),
(135, 68, 53, 1, 1, 1, 1, 1),
(136, 69, 4, 1, 1, 1, 1, 1),
(137, 70, 4, 1, 1, 1, 1, 1),
(138, 71, 3, 1, 1, 1, 1, 1),
(139, 72, 67, 1, 1, 1, 1, 1),
(140, 73, 67, 1, 1, 1, 1, 1),
(141, 74, 67, 1, 1, 1, 1, 1),
(143, 76, 67, 1, 1, 1, 1, 1),
(144, 77, 67, 1, 1, 1, 1, 1),
(145, 78, 4, 1, 1, 1, 1, 1),
(146, 79, 4, 1, 1, 1, 1, 1),
(147, 80, 3, 1, 1, 1, 1, 1),
(148, 81, 3, 1, 1, 1, 1, 1),
(149, 82, 33, 1, 1, 1, 1, 1),
(150, 83, 4, 1, 1, 1, 1, 1),
(152, 84, 0, 1, 1, 1, 1, 1),
(153, 85, 84, 1, 1, 1, 1, 1),
(154, 86, 84, 1, 1, 1, 1, 1),
(155, 84, 0, 4, 1, 1, 1, 1),
(156, 84, 0, 5, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_aplikasi`
--

CREATE TABLE `menu_aplikasi` (
  `id` int(3) UNSIGNED NOT NULL,
  `parent_id` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `nama_menu` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` int(1) DEFAULT 1,
  `level` int(1) DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keterangan` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `menu_aplikasi`
--

INSERT INTO `menu_aplikasi` (`id`, `parent_id`, `nama_menu`, `url`, `menu_order`, `status`, `level`, `icon`, `keterangan`) VALUES
(1, 0, 'Dashboard', '/all/admin_page', 0, 1, 0, 'fa fa-dashboard', NULL),
(2, 3, 'Lembaga', '/all/lembaga', 1, 1, 0, 'fa fa-circle-o', NULL),
(3, 0, 'Data Master', '#', 2, 1, 0, 'fa fa-sitemap', NULL),
(4, 0, 'Data Karyawan', '/all/karyawan', 2, 1, 0, 'fa fa-plus-square', NULL),
(5, 0, 'Administrator', '#', 6, 1, 0, 'fa fa-shield', NULL),
(6, 5, 'Hak Akses', '/all/menurole/menu_role', 1, 1, 0, 'fa fa-circle-o', NULL),
(33, 0, 'Laporan', '#', 4, 1, 0, 'fa fa-bar-chart-o', NULL),
(34, 3, 'Departemen', '/all/departemen', 2, 1, 0, 'fa fa-circle-o', NULL),
(35, 5, 'Menu', '/all/menu', 3, 1, 0, 'fa fa-circle-o', NULL),
(38, 3, 'Unit Kerja', '/all/unitkerja', 4, 1, 0, 'fa fa-circle-o', NULL),
(42, 3, 'Jabatan', '/all/jabatan', 3, 1, 0, 'fa fa-circle-o', NULL),
(47, 5, 'Hak Akses Menu', '/all/menuakses', 2, 1, 0, 'fa fa-circle-o', NULL),
(48, 5, 'Log User', '#', 4, 1, 0, 'fa fa-circle-o', NULL),
(49, 33, 'Data Karyawan', '#', 1, 1, 0, 'fa fa-circle-o', NULL),
(52, 33, 'Presensi', '#', 2, 1, 0, 'fa fa-circle-o', NULL),
(53, 0, 'Keuangan', '/all/backup', 50, 1, 0, 'fa fa-dashboard', NULL),
(54, 0, 'Akademik', '/akademik/', 51, 1, 0, 'fa fa-dashboard', NULL),
(56, 54, 'Data Siswa', '/akademik/datasiswa', 52, 1, 0, 'fa fa-circle-o', NULL),
(57, 6, 'Hak Aksesdd', '/all/menurole/menu_role', 2, 1, 0, 'fa fa-circle-o', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_role`
--

CREATE TABLE `menu_role` (
  `id_menu_role` int(3) UNSIGNED NOT NULL,
  `nama_menu_role` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `menu_role`
--

INSERT INTO `menu_role` (`id_menu_role`, `nama_menu_role`) VALUES
(1, 'Admin'),
(2, 'IT'),
(3, 'Sekretaris'),
(4, 'Administrasi'),
(5, 'Tamu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `para_nominal`
--

CREATE TABLE `para_nominal` (
  `kd_nominal` int(11) NOT NULL,
  `ket_nominal` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `x_nominal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll_detail_template`
--

CREATE TABLE `payroll_detail_template` (
  `id_detail_template` int(11) NOT NULL,
  `id_teamplate` varchar(250) NOT NULL,
  `id_group_kategori_komponen` text NOT NULL,
  `type` varchar(125) NOT NULL,
  `id_komponen_gaji` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll_detail_template`
--

INSERT INTO `payroll_detail_template` (`id_detail_template`, `id_teamplate`, `id_group_kategori_komponen`, `type`, `id_komponen_gaji`) VALUES
(854, '78', '16', 'Penambahan', '27'),
(855, '78', '16', 'penambahan', '30'),
(856, '78', '16', 'penambahan', '31'),
(857, '78', '16', 'penambahan', '32'),
(858, '78', '16', 'penambahan', '33'),
(859, '78', '16', 'penambahan', '34'),
(860, '78', '16', 'penambahan', '39'),
(861, '78', '16', 'penambahan', '40'),
(862, '78', '16', 'penambahan', '41'),
(863, '78', '16', 'penambahan', '42'),
(864, '78', '16', 'penambahan', '43'),
(865, '78', '16', 'penambahan', '44'),
(866, '78', '17', 'pengurangan', '45'),
(867, '78', '17', 'pengurangan', '46'),
(868, '78', '17', 'pengurangan', '47'),
(869, '78', '17', 'pengurangan', '48'),
(870, '78', '17', 'pengurangan', '49'),
(871, '78', '18', 'perusahaan', '50'),
(872, '78', '18', 'perusahaan', '51'),
(973, '79', '16', 'Penambahan', '27'),
(974, '79', '16', 'Penambahan', '30'),
(975, '79', '17', 'pengurangan', '45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll_detail_transaksi`
--

CREATE TABLE `payroll_detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` varchar(125) NOT NULL,
  `jml_gaji` int(100) NOT NULL,
  `id_detail_template` int(11) NOT NULL,
  `id_group_kategori_komponen` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `id_komponen_gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll_detail_transaksi`
--

INSERT INTO `payroll_detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `jml_gaji`, `id_detail_template`, `id_group_kategori_komponen`, `type`, `id_komponen_gaji`) VALUES
(599, '1129', 948864, 854, 16, 'Penambahan', 27),
(600, '1129', 189733, 855, 16, 'penambahan', 30),
(601, '1129', 0, 856, 16, 'penambahan', 31),
(602, '1129', 0, 857, 16, 'penambahan', 32),
(603, '1129', 0, 858, 16, 'penambahan', 33),
(604, '1129', 0, 859, 16, 'penambahan', 34),
(605, '1129', 0, 860, 16, 'penambahan', 39),
(606, '1129', 0, 861, 16, 'penambahan', 40),
(607, '1129', 0, 862, 16, 'penambahan', 41),
(608, '1129', 78150, 863, 16, 'penambahan', 42),
(609, '1129', 250000, 864, 16, 'penambahan', 43),
(610, '1129', 0, 865, 16, 'penambahan', 44),
(611, '1129', 0, 866, 17, 'pengurangan', 45),
(612, '1129', 0, 867, 17, 'pengurangan', 46),
(613, '1129', 100, 868, 17, 'pengurangan', 47),
(614, '1129', 0, 869, 17, 'pengurangan', 48),
(615, '1129', 0, 870, 17, 'pengurangan', 49),
(616, '1129', 0, 871, 18, 'perusahaan', 50),
(617, '1129', 0, 872, 18, 'perusahaan', 51),
(624, '1131', 1500000, 854, 16, 'Penambahan', 27),
(625, '1131', 0, 855, 16, 'penambahan', 30),
(626, '1131', 0, 856, 16, 'penambahan', 31),
(627, '1131', 0, 857, 16, 'penambahan', 32),
(628, '1131', 0, 858, 16, 'penambahan', 33),
(629, '1131', 0, 859, 16, 'penambahan', 34),
(630, '1131', 0, 860, 16, 'penambahan', 39),
(631, '1131', 0, 861, 16, 'penambahan', 40),
(632, '1131', 0, 862, 16, 'penambahan', 41),
(633, '1131', 0, 863, 16, 'penambahan', 42),
(634, '1131', 0, 864, 16, 'penambahan', 43),
(635, '1131', 0, 865, 16, 'penambahan', 44),
(636, '1131', 10000, 866, 17, 'pengurangan', 45),
(637, '1131', 0, 867, 17, 'pengurangan', 46),
(638, '1131', 0, 868, 17, 'pengurangan', 47),
(639, '1131', 0, 869, 17, 'pengurangan', 48),
(640, '1131', 0, 870, 17, 'pengurangan', 49),
(641, '1131', 0, 871, 18, 'perusahaan', 50),
(642, '1131', 0, 872, 18, 'perusahaan', 51),
(662, '1133', 10000, 854, 16, 'Penambahan', 27),
(663, '1133', 0, 855, 16, 'penambahan', 30),
(664, '1133', 0, 856, 16, 'penambahan', 31),
(665, '1133', 0, 857, 16, 'penambahan', 32),
(666, '1133', 0, 858, 16, 'penambahan', 33),
(667, '1133', 0, 859, 16, 'penambahan', 34),
(668, '1133', 0, 860, 16, 'penambahan', 39),
(669, '1133', 0, 861, 16, 'penambahan', 40),
(670, '1133', 0, 862, 16, 'penambahan', 41),
(671, '1133', 0, 863, 16, 'penambahan', 42),
(672, '1133', 0, 864, 16, 'penambahan', 43),
(673, '1133', 0, 865, 16, 'penambahan', 44),
(674, '1133', 0, 866, 17, 'pengurangan', 45),
(675, '1133', 0, 867, 17, 'pengurangan', 46),
(676, '1133', 0, 868, 17, 'pengurangan', 47),
(677, '1133', 0, 869, 17, 'pengurangan', 48),
(678, '1133', 0, 870, 17, 'pengurangan', 49),
(679, '1133', 0, 871, 18, 'perusahaan', 50),
(680, '1133', 0, 872, 18, 'perusahaan', 51);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll_group_kategori_komponen`
--

CREATE TABLE `payroll_group_kategori_komponen` (
  `id_group_kategori_komponen` int(11) NOT NULL,
  `nama_kategori` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll_group_kategori_komponen`
--

INSERT INTO `payroll_group_kategori_komponen` (`id_group_kategori_komponen`, `nama_kategori`) VALUES
(16, 'Pendapatan'),
(17, 'Potongan'),
(18, 'Informsi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll_komponen_gaji`
--

CREATE TABLE `payroll_komponen_gaji` (
  `id_komponen_gaji` int(11) NOT NULL,
  `nama_kategori_komponen` varchar(250) NOT NULL,
  `id_group_kategori_komponen` varchar(250) NOT NULL,
  `create_at` varchar(250) NOT NULL,
  `update_at` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll_komponen_gaji`
--

INSERT INTO `payroll_komponen_gaji` (`id_komponen_gaji`, `nama_kategori_komponen`, `id_group_kategori_komponen`, `create_at`, `update_at`) VALUES
(23, 'Gaji Pokok', '13', '2020-08-21', ''),
(24, 'Pinjaman', '14', '2020-08-21', ''),
(25, 'BPJS', '15', '2020-08-24', ''),
(26, 'Potongan Absen', '14', '2020-08-31', ''),
(27, 'Gaji Pokok', '16', '2020-10-20', ''),
(30, 'Tj.Struktural', '16', '2020-10-23', ''),
(31, 'Tj.Wali Kelas', '16', '2020-10-23', ''),
(32, 'Tj.BQ/TQ', '16', '2020-10-23', ''),
(33, 'Tj.Istri', '16', '2020-10-23', ''),
(34, 'Tj.Anak', '16', '2020-10-23', ''),
(35, 'a', 'Pilih Kategori', '2020-10-23', ''),
(36, 'adsa', 'Pilih Kategori', '2020-10-23', ''),
(37, 'ww', 'Pilih Kategori', '2020-10-23', ''),
(38, 'ads', 'Pilih Kategori', '2020-10-23', ''),
(39, 'Tj.Dispensasi 2 Hari', '16', '2020-10-23', ''),
(40, 'Tj.Fungsional', '16', '2020-10-23', ''),
(41, 'Tj.Transport', '16', '2020-10-23', ''),
(42, 'Tj.Kjk/Lembur', '16', '2020-10-23', ''),
(43, 'Kekurangan Transportasi', '16', '2020-10-23', ''),
(44, 'Lain-Lain...', '16', '2020-10-23', ''),
(45, 'Absensi Mengantor', '17', '2020-10-23', ''),
(46, 'Absensi Mengajar', '17', '2020-10-23', ''),
(47, 'Infak (3 Angka Terakhir)', '17', '2020-10-23', ''),
(48, 'Biaya Transfer Antar Bank', '17', '2020-10-23', ''),
(49, 'Pinjaman Ke Pondok', '17', '2020-10-23', ''),
(50, 'Jml Pinjaman Bulan Lalu', '18', '2020-10-23', ''),
(51, 'Sisa Pinjaman Bulan Ini', '18', '2020-10-23', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll_periode_gaji`
--

CREATE TABLE `payroll_periode_gaji` (
  `id_periode` int(11) NOT NULL,
  `nama_periode` varchar(125) NOT NULL,
  `bulan` varchar(125) NOT NULL,
  `tahun` int(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll_periode_gaji`
--

INSERT INTO `payroll_periode_gaji` (`id_periode`, `nama_periode`, `bulan`, `tahun`) VALUES
(28, 'Oktober 2020', '10', 2020);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll_teamplate`
--

CREATE TABLE `payroll_teamplate` (
  `id_teamplate` int(11) NOT NULL,
  `nama_teamplate` varchar(125) NOT NULL,
  `scan_tanda_tangan` text NOT NULL,
  `tgl` varchar(250) NOT NULL,
  `id_unit_kerja` varchar(125) NOT NULL,
  `nip_karyawan` varchar(125) NOT NULL,
  `id_lembaga` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll_teamplate`
--

INSERT INTO `payroll_teamplate` (`id_teamplate`, `nama_teamplate`, `scan_tanda_tangan`, `tgl`, `id_unit_kerja`, `nip_karyawan`, `id_lembaga`) VALUES
(78, 'Template Gaji 2020', '', '2020-10-23', '1', '1', '1'),
(79, 'Tem21', '', '2020-10-27', '1', '0119970601001', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll_transaksi`
--

CREATE TABLE `payroll_transaksi` (
  `id_karyawan` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_teamplate` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` text NOT NULL,
  `id_transaksi` int(111) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payroll_transaksi`
--

INSERT INTO `payroll_transaksi` (`id_karyawan`, `id_periode`, `id_teamplate`, `create_at`, `update_at`, `id_transaksi`, `status`) VALUES
(1, 28, 78, '2020-10-22 17:00:00', '', 1129, 1),
(2, 28, 78, '2020-10-25 17:00:00', '', 1131, 1),
(5, 28, 78, '2020-10-26 17:00:00', '', 1133, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `nama_pendidikan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(11) NOT NULL,
  `id_lembaga` int(1) DEFAULT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `nama_semester` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ket_semester` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_ubah` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_ubah` timestamp NOT NULL DEFAULT current_timestamp(),
  `sts_aktif` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shift_presensi`
--

CREATE TABLE `shift_presensi` (
  `id_shift_presensi` int(11) NOT NULL,
  `id_lembaga` int(3) DEFAULT NULL,
  `id_unitkerja` int(3) DEFAULT NULL,
  `nama_shift` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `menit_toleransi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `shift_presensi`
--

INSERT INTO `shift_presensi` (`id_shift_presensi`, `id_lembaga`, `id_unitkerja`, `nama_shift`, `jam_masuk`, `jam_pulang`, `menit_toleransi`) VALUES
(1, 1, 1, 'Regular', '07:00:00', '15:00:00', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_absen`
--

CREATE TABLE `status_absen` (
  `id_absen` int(11) NOT NULL,
  `kd_absen` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ket_absen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `bc` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `status_absen`
--

INSERT INTO `status_absen` (`id_absen`, `kd_absen`, `ket_absen`, `urutan`, `bc`) VALUES
(1, 'H', 'Hadir', 0, '#00a65a '),
(2, 'HT', 'Hadir Terlambat', 1, '#f39c12 '),
(3, 'A', 'Alpha/Bolos', 2, '#dd4b39 '),
(4, 'C', 'Cuti', 3, '#f012be '),
(5, 'I', 'Ijin', 4, '#00c0ef'),
(7, 'S', 'Sakit', 6, '#01ff70'),
(8, 'T', 'Tugas', 7, '#f39c12 ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_aktif_karyawan`
--

CREATE TABLE `status_aktif_karyawan` (
  `id_sts_karyaaktif` int(11) NOT NULL,
  `ket_sts_karyaaktif` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `status_aktif_karyawan`
--

INSERT INTO `status_aktif_karyawan` (`id_sts_karyaaktif`, `ket_sts_karyaaktif`) VALUES
(2, 'Pensiun'),
(3, 'Mengundurkan Diri'),
(6, 'asa2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_karyawan`
--

CREATE TABLE `status_karyawan` (
  `id_sts_karyawan` int(11) NOT NULL,
  `ket_sts_karyawan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `status_karyawan`
--

INSERT INTO `status_karyawan` (`id_sts_karyawan`, `ket_sts_karyawan`) VALUES
(1, 'Guru Tetap Yayasan'),
(2, 'Guru Tidak Tetap'),
(3, 'Staff Tetap Yayasan'),
(4, 'Staff Tidak Tetap'),
(5, 'Karyawan Tetap Yayasan'),
(6, 'Karyawan Tidak Tetap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_nikah`
--

CREATE TABLE `status_nikah` (
  `id_sts_nikah` int(11) NOT NULL,
  `ket_sts_nikah` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `status_nikah`
--

INSERT INTO `status_nikah` (`id_sts_nikah`, `ket_sts_nikah`, `urutan`) VALUES
(0, '-', 0),
(1, 'Nikah', 1),
(2, 'Belum Nikah', 2),
(3, 'Cerai Hidup', 3),
(4, 'Cerai Mati', 4),
(5, 'jomblo', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_tinggal`
--

CREATE TABLE `status_tinggal` (
  `id_sts_tinggal` int(2) NOT NULL,
  `ket_sts_tinggal` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `status_tinggal`
--

INSERT INTO `status_tinggal` (`id_sts_tinggal`, `ket_sts_tinggal`) VALUES
(0, '-'),
(1, 'Dalam Ma`had'),
(2, 'Luar Ma`had');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `tahun_ajaran` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ket_ajaran` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `user_ubah` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_ubah` timestamp NOT NULL DEFAULT current_timestamp(),
  `sts_aktif` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tingkat_pendidikan`
--

CREATE TABLE `tingkat_pendidikan` (
  `id_tingkat` int(11) NOT NULL,
  `ket_tingkat` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `user_update` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tingkat_pendidikan`
--

INSERT INTO `tingkat_pendidikan` (`id_tingkat`, `ket_tingkat`, `update_date`, `user_update`) VALUES
(1, 'SD', NULL, NULL),
(2, 'MI', NULL, NULL),
(3, 'SMP', NULL, NULL),
(4, 'MTS', NULL, NULL),
(5, 'SMA', NULL, NULL),
(6, 'MA', NULL, NULL),
(7, 'STM', NULL, NULL),
(8, 'SMEA', NULL, NULL),
(9, 'SMK', NULL, NULL),
(10, 'D1', NULL, NULL),
(11, 'D2', NULL, NULL),
(12, 'D3', NULL, NULL),
(13, 'D4', NULL, NULL),
(14, 'S1', NULL, NULL),
(15, 'S2', NULL, NULL),
(16, 'S3', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tingkat_siswa`
--

CREATE TABLE `tingkat_siswa` (
  `id_tingkat` int(11) NOT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `tingkat` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ket_tingkat` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_ubah` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_ubah` timestamp NOT NULL DEFAULT current_timestamp(),
  `sts_aktif` int(1) DEFAULT 1,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tingkat_siswa`
--

INSERT INTO `tingkat_siswa` (`id_tingkat`, `id_departemen`, `id_lembaga`, `tingkat`, `ket_tingkat`, `user_ubah`, `tgl_ubah`, `sts_aktif`, `urutan`) VALUES
(29, 1, 1, 'VII', 'Tingkat 7 (MTs Kelas 1)', NULL, '2019-05-04 05:31:18', 1, 1),
(30, 1, 1, 'VIII', 'Tingkat 8 (MTs Kelas 2)', NULL, '2019-05-04 05:31:18', 1, 2),
(31, 1, 1, 'IX', 'Tingkat 9 (MTs Kelas 3)', NULL, '2019-05-04 05:31:18', 1, 3),
(35, 2, 1, 'X', 'Tingkat 10 (MA Kelas 1)', NULL, '2019-05-04 05:32:32', 1, 1),
(36, 2, 1, 'XI', 'Tingkat 11 (MA Kelas 2)', NULL, '2019-05-04 05:32:32', 1, 2),
(37, 2, 1, 'XII', 'Tingkat 12 (MA Kelas 3)', NULL, '2019-05-04 05:32:32', 1, 3),
(42, 5, 3, 'VII', 'Tingkat 7 (MTs Kelas 1)', NULL, '2019-05-04 05:33:41', 1, 1),
(43, 5, 3, 'VIII', 'Tingkat 8 (MTs Kelas 2)', NULL, '2019-05-04 05:33:41', 1, 2),
(44, 5, 3, 'IX', 'Tingkat 9 (MTs Kelas 3)', NULL, '2019-05-04 05:33:41', 1, 3),
(45, 7, 4, 'I', 'Tingkat 1 (SD/MI Kelas 1)', NULL, '2019-05-04 05:34:16', 1, 1),
(46, 7, 4, 'II', 'Tingkat 2 (SD/MI Kelas 2)', NULL, '2019-05-04 05:34:16', 1, 2),
(49, 7, 4, 'III', 'Tingkat 3 (SD/MI Kelas 3)', NULL, '2019-05-04 05:34:16', 1, 3),
(50, 7, 4, 'IV', 'Tingkat 4 (SD/MI Kelas 4)', NULL, '2019-05-04 05:34:16', 1, 4),
(51, 7, 4, 'V', 'Tingkat 5 (SD/MI Kelas 5)', NULL, '2019-05-04 05:34:16', 1, 5),
(52, 7, 4, 'VI', 'Tingkat 6 (SD/MI Kelas 6)', NULL, '2019-05-04 05:34:16', 1, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `type_berkas`
--

CREATE TABLE `type_berkas` (
  `id_type_berkas` int(11) NOT NULL,
  `nama_type_berkas` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `type_berkas`
--

INSERT INTO `type_berkas` (`id_type_berkas`, `nama_type_berkas`) VALUES
(2, 'KARTU KELUARGA'),
(3, 'KTP'),
(4, 'IJAZAH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id_unit_kerja` int(3) NOT NULL,
  `nama_unit_kerja` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit_kerja`, `nama_unit_kerja`) VALUES
(1, 'Administrasi'),
(2, 'Dakwah'),
(3, 'Kesantrian'),
(4, 'Pendidikan'),
(5, 'URT'),
(6, 'Keuangan'),
(7, 'Inventaris'),
(8, 'IT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_admin`
--

CREATE TABLE `user_admin` (
  `id_pengguna` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `nip_karyawan` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `user_name` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_role` int(3) DEFAULT NULL,
  `status_user` char(1) COLLATE utf8_unicode_ci DEFAULT 'Y',
  `akses_antar_lembaga` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `akses_antar_departemen` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'T',
  `pin` double DEFAULT NULL,
  `sts_data` int(1) DEFAULT 0,
  `user_hapus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `user_admin`
--

INSERT INTO `user_admin` (`id_pengguna`, `id_karyawan`, `nip_karyawan`, `id_lembaga`, `user_name`, `pass`, `id_role`, `status_user`, `akses_antar_lembaga`, `akses_antar_departemen`, `pin`, `sts_data`, `user_hapus`, `tgl_hapus`) VALUES
(1, 69, NULL, 1, 'handy', '$2y$10$otpN8lRjBYCyDkfDGcTGvOiegzL4VSL.lSvAIpZnx0sxDQ3Ve7vbG', 1, 'Y', 'Y', 'T', 11223344, 0, NULL, NULL),
(11, 54, NULL, 1, 'yusuf', '$2y$10$vYaye2YtzQAqNAFXavw77uznRvwD2J7HuT9b4mV5t1anAIX6H/EWm', 3, 'Y', NULL, 'T', 123456, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen_karyawan`
--
ALTER TABLE `absen_karyawan`
  ADD PRIMARY KEY (`id_absen_karyawan`);

--
-- Indeks untuk tabel `absen_kegiatan_karyawan`
--
ALTER TABLE `absen_kegiatan_karyawan`
  ADD PRIMARY KEY (`id_absen_karyawan`);

--
-- Indeks untuk tabel `absen_shift`
--
ALTER TABLE `absen_shift`
  ADD PRIMARY KEY (`id_shift`,`kode_shift`);

--
-- Indeks untuk tabel `absen_shift_karyawan`
--
ALTER TABLE `absen_shift_karyawan`
  ADD PRIMARY KEY (`id_shift_karyawan`),
  ADD UNIQUE KEY `UNIQUE` (`id_karyawan`,`id_shift`,`tgl_absen`);

--
-- Indeks untuk tabel `absen_umum`
--
ALTER TABLE `absen_umum`
  ADD PRIMARY KEY (`id_absen_umum`),
  ADD UNIQUE KEY `id_lembaga` (`id_lembaga`);

--
-- Indeks untuk tabel `absen_wajib`
--
ALTER TABLE `absen_wajib`
  ADD PRIMARY KEY (`id_absen_karyawan`),
  ADD UNIQUE KEY `id_karyawan` (`id_karyawan`,`tgl_absen`);

--
-- Indeks untuk tabel `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id_angkatan`),
  ADD KEY `id_departemen` (`id_departemen`),
  ADD KEY `id_lembaga` (`id_lembaga`);

--
-- Indeks untuk tabel `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indeks untuk tabel `file_berkas_karyawan`
--
ALTER TABLE `file_berkas_karyawan`
  ADD PRIMARY KEY (`id_berkas_foto`);

--
-- Indeks untuk tabel `gol_darah`
--
ALTER TABLE `gol_darah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `goldarah` (`goldarah`);

--
-- Indeks untuk tabel `hari_libur`
--
ALTER TABLE `hari_libur`
  ADD PRIMARY KEY (`id_kalender`),
  ADD UNIQUE KEY `id_lembaga` (`id_lembaga`,`id_kalender`);

--
-- Indeks untuk tabel `jenis_hubungan`
--
ALTER TABLE `jenis_hubungan`
  ADD PRIMARY KEY (`nama_hubungan`),
  ADD UNIQUE KEY `UX_jenishubungan` (`id_hubungan`);

--
-- Indeks untuk tabel `jenis_jabatan`
--
ALTER TABLE `jenis_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `jenis_pekerjaan`
--
ALTER TABLE `jenis_pekerjaan`
  ADD PRIMARY KEY (`id_kerja`);

--
-- Indeks untuk tabel `jenis_pendapatan`
--
ALTER TABLE `jenis_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indeks untuk tabel `jenis_pendidikan`
--
ALTER TABLE `jenis_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`,`nip_karyawan`),
  ADD UNIQUE KEY `nip_karyawan` (`nip_karyawan`);

--
-- Indeks untuk tabel `karyawan_asli`
--
ALTER TABLE `karyawan_asli`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `nip_karyawan` (`nip_karyawan`);

--
-- Indeks untuk tabel `karyawan_copy`
--
ALTER TABLE `karyawan_copy`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `nip_karyawan` (`nip_karyawan`),
  ADD KEY `karyawan_ibfk_1` (`id_sts_karyawan`),
  ADD KEY `karyawan_ibfk_2` (`id_lembaga`),
  ADD KEY `karyawan_ibfk_3` (`id_departemen`),
  ADD KEY `karyawan_ibfk_4` (`id_unit_kerja`);

--
-- Indeks untuk tabel `karyawan_diklat`
--
ALTER TABLE `karyawan_diklat`
  ADD PRIMARY KEY (`id_diklat`),
  ADD KEY `nip` (`nip_karyawan`);

--
-- Indeks untuk tabel `karyawan_jabatan`
--
ALTER TABLE `karyawan_jabatan`
  ADD PRIMARY KEY (`id_jabatan_karyawan`),
  ADD KEY `nip` (`nip_karyawan`);

--
-- Indeks untuk tabel `karyawan_keluarga`
--
ALTER TABLE `karyawan_keluarga`
  ADD PRIMARY KEY (`id_keluarga`),
  ADD KEY `id_pendidikan` (`id_pendidikan`),
  ADD KEY `nip_karyawan` (`nip_karyawan`);

--
-- Indeks untuk tabel `karyawan_kerja`
--
ALTER TABLE `karyawan_kerja`
  ADD PRIMARY KEY (`id_kerja`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `nip_karyawan` (`nip_karyawan`);

--
-- Indeks untuk tabel `karyawan_penghargaan`
--
ALTER TABLE `karyawan_penghargaan`
  ADD PRIMARY KEY (`id_penghargaan`),
  ADD KEY `id_karywan` (`id_karyawan`),
  ADD KEY `nip_karyawan` (`nip_karyawan`);

--
-- Indeks untuk tabel `karyawan_sekolah`
--
ALTER TABLE `karyawan_sekolah`
  ADD PRIMARY KEY (`id_sekolah`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_pendidikan` (`id_pendidikan`),
  ADD KEY `nip_karyawan` (`nip_karyawan`);

--
-- Indeks untuk tabel `karyawan_seminar`
--
ALTER TABLE `karyawan_seminar`
  ADD PRIMARY KEY (`id_seminar`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `nip_karyawan` (`nip_karyawan`);

--
-- Indeks untuk tabel `kegiatan_karyawan`
--
ALTER TABLE `kegiatan_karyawan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_departemen` (`id_departemen`),
  ADD KEY `id_lembaga` (`id_lembaga`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `kelompok_karyawan`
--
ALTER TABLE `kelompok_karyawan`
  ADD PRIMARY KEY (`id_kelompok_pegawai`);

--
-- Indeks untuk tabel `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lembaga`
--
ALTER TABLE `lembaga`
  ADD PRIMARY KEY (`id_lembaga`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`log_id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_akses`
--
ALTER TABLE `menu_akses`
  ADD PRIMARY KEY (`id`,`id_menu`,`id_role`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `menu_aplikasi`
--
ALTER TABLE `menu_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`id_menu_role`);

--
-- Indeks untuk tabel `para_nominal`
--
ALTER TABLE `para_nominal`
  ADD PRIMARY KEY (`kd_nominal`);

--
-- Indeks untuk tabel `payroll_detail_template`
--
ALTER TABLE `payroll_detail_template`
  ADD PRIMARY KEY (`id_detail_template`);

--
-- Indeks untuk tabel `payroll_detail_transaksi`
--
ALTER TABLE `payroll_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indeks untuk tabel `payroll_group_kategori_komponen`
--
ALTER TABLE `payroll_group_kategori_komponen`
  ADD PRIMARY KEY (`id_group_kategori_komponen`);

--
-- Indeks untuk tabel `payroll_komponen_gaji`
--
ALTER TABLE `payroll_komponen_gaji`
  ADD PRIMARY KEY (`id_komponen_gaji`);

--
-- Indeks untuk tabel `payroll_periode_gaji`
--
ALTER TABLE `payroll_periode_gaji`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `payroll_teamplate`
--
ALTER TABLE `payroll_teamplate`
  ADD PRIMARY KEY (`id_teamplate`);

--
-- Indeks untuk tabel `payroll_transaksi`
--
ALTER TABLE `payroll_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indeks untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`),
  ADD KEY `id_departemen` (`id_departemen`),
  ADD KEY `id_lembaga` (`id_lembaga`);

--
-- Indeks untuk tabel `shift_presensi`
--
ALTER TABLE `shift_presensi`
  ADD PRIMARY KEY (`id_shift_presensi`),
  ADD KEY `id_lembaga` (`id_lembaga`),
  ADD KEY `id_unitkerja` (`id_unitkerja`);

--
-- Indeks untuk tabel `status_absen`
--
ALTER TABLE `status_absen`
  ADD PRIMARY KEY (`id_absen`,`kd_absen`);

--
-- Indeks untuk tabel `status_aktif_karyawan`
--
ALTER TABLE `status_aktif_karyawan`
  ADD PRIMARY KEY (`id_sts_karyaaktif`);

--
-- Indeks untuk tabel `status_karyawan`
--
ALTER TABLE `status_karyawan`
  ADD PRIMARY KEY (`id_sts_karyawan`);

--
-- Indeks untuk tabel `status_nikah`
--
ALTER TABLE `status_nikah`
  ADD PRIMARY KEY (`id_sts_nikah`);

--
-- Indeks untuk tabel `status_tinggal`
--
ALTER TABLE `status_tinggal`
  ADD PRIMARY KEY (`id_sts_tinggal`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`),
  ADD UNIQUE KEY `tahun_ajaran` (`tahun_ajaran`),
  ADD KEY `id_lembaga` (`id_lembaga`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indeks untuk tabel `tingkat_pendidikan`
--
ALTER TABLE `tingkat_pendidikan`
  ADD PRIMARY KEY (`id_tingkat`);

--
-- Indeks untuk tabel `tingkat_siswa`
--
ALTER TABLE `tingkat_siswa`
  ADD PRIMARY KEY (`id_tingkat`),
  ADD KEY `id_lembaga` (`id_lembaga`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indeks untuk tabel `type_berkas`
--
ALTER TABLE `type_berkas`
  ADD PRIMARY KEY (`id_type_berkas`);

--
-- Indeks untuk tabel `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id_unit_kerja`);

--
-- Indeks untuk tabel `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `nik_karyawan` (`nip_karyawan`),
  ADD UNIQUE KEY `user_pengguna` (`user_name`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen_karyawan`
--
ALTER TABLE `absen_karyawan`
  MODIFY `id_absen_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `absen_kegiatan_karyawan`
--
ALTER TABLE `absen_kegiatan_karyawan`
  MODIFY `id_absen_karyawan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `absen_shift`
--
ALTER TABLE `absen_shift`
  MODIFY `id_shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `absen_shift_karyawan`
--
ALTER TABLE `absen_shift_karyawan`
  MODIFY `id_shift_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7693;

--
-- AUTO_INCREMENT untuk tabel `absen_umum`
--
ALTER TABLE `absen_umum`
  MODIFY `id_absen_umum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `absen_wajib`
--
ALTER TABLE `absen_wajib`
  MODIFY `id_absen_karyawan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id_angkatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `file_berkas_karyawan`
--
ALTER TABLE `file_berkas_karyawan`
  MODIFY `id_berkas_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `gol_darah`
--
ALTER TABLE `gol_darah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `hari_libur`
--
ALTER TABLE `hari_libur`
  MODIFY `id_kalender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_hubungan`
--
ALTER TABLE `jenis_hubungan`
  MODIFY `id_hubungan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jenis_jabatan`
--
ALTER TABLE `jenis_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jenis_pekerjaan`
--
ALTER TABLE `jenis_pekerjaan`
  MODIFY `id_kerja` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `jenis_pendapatan`
--
ALTER TABLE `jenis_pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jenis_pendidikan`
--
ALTER TABLE `jenis_pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT untuk tabel `karyawan_asli`
--
ALTER TABLE `karyawan_asli`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT untuk tabel `karyawan_copy`
--
ALTER TABLE `karyawan_copy`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT untuk tabel `karyawan_diklat`
--
ALTER TABLE `karyawan_diklat`
  MODIFY `id_diklat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `karyawan_jabatan`
--
ALTER TABLE `karyawan_jabatan`
  MODIFY `id_jabatan_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `karyawan_keluarga`
--
ALTER TABLE `karyawan_keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `karyawan_kerja`
--
ALTER TABLE `karyawan_kerja`
  MODIFY `id_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `karyawan_penghargaan`
--
ALTER TABLE `karyawan_penghargaan`
  MODIFY `id_penghargaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawan_sekolah`
--
ALTER TABLE `karyawan_sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `karyawan_seminar`
--
ALTER TABLE `karyawan_seminar`
  MODIFY `id_seminar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_karyawan`
--
ALTER TABLE `kegiatan_karyawan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelompok_karyawan`
--
ALTER TABLE `kelompok_karyawan`
  MODIFY `id_kelompok_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `lembaga`
--
ALTER TABLE `lembaga`
  MODIFY `id_lembaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `log_user`
--
ALTER TABLE `log_user`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1284;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `menu_akses`
--
ALTER TABLE `menu_akses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT untuk tabel `menu_aplikasi`
--
ALTER TABLE `menu_aplikasi`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `id_menu_role` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `para_nominal`
--
ALTER TABLE `para_nominal`
  MODIFY `kd_nominal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `payroll_detail_template`
--
ALTER TABLE `payroll_detail_template`
  MODIFY `id_detail_template` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=976;

--
-- AUTO_INCREMENT untuk tabel `payroll_detail_transaksi`
--
ALTER TABLE `payroll_detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

--
-- AUTO_INCREMENT untuk tabel `payroll_group_kategori_komponen`
--
ALTER TABLE `payroll_group_kategori_komponen`
  MODIFY `id_group_kategori_komponen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `payroll_komponen_gaji`
--
ALTER TABLE `payroll_komponen_gaji`
  MODIFY `id_komponen_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `payroll_periode_gaji`
--
ALTER TABLE `payroll_periode_gaji`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `payroll_teamplate`
--
ALTER TABLE `payroll_teamplate`
  MODIFY `id_teamplate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `payroll_transaksi`
--
ALTER TABLE `payroll_transaksi`
  MODIFY `id_transaksi` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1134;

--
-- AUTO_INCREMENT untuk tabel `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `shift_presensi`
--
ALTER TABLE `shift_presensi`
  MODIFY `id_shift_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `status_absen`
--
ALTER TABLE `status_absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `status_aktif_karyawan`
--
ALTER TABLE `status_aktif_karyawan`
  MODIFY `id_sts_karyaaktif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `status_karyawan`
--
ALTER TABLE `status_karyawan`
  MODIFY `id_sts_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `status_nikah`
--
ALTER TABLE `status_nikah`
  MODIFY `id_sts_nikah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `status_tinggal`
--
ALTER TABLE `status_tinggal`
  MODIFY `id_sts_tinggal` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tingkat_pendidikan`
--
ALTER TABLE `tingkat_pendidikan`
  MODIFY `id_tingkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tingkat_siswa`
--
ALTER TABLE `tingkat_siswa`
  MODIFY `id_tingkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `type_berkas`
--
ALTER TABLE `type_berkas`
  MODIFY `id_type_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id_unit_kerja` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absen_umum`
--
ALTER TABLE `absen_umum`
  ADD CONSTRAINT `absen_umum_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id_lembaga`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `angkatan`
--
ALTER TABLE `angkatan`
  ADD CONSTRAINT `angkatan_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `angkatan_ibfk_3` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id_lembaga`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan_jabatan`
--
ALTER TABLE `karyawan_jabatan`
  ADD CONSTRAINT `karyawan_jabatan_ibfk_1` FOREIGN KEY (`nip_karyawan`) REFERENCES `karyawan` (`nip_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan_keluarga`
--
ALTER TABLE `karyawan_keluarga`
  ADD CONSTRAINT `karyawan_keluarga_ibfk_1` FOREIGN KEY (`nip_karyawan`) REFERENCES `karyawan` (`nip_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan_kerja`
--
ALTER TABLE `karyawan_kerja`
  ADD CONSTRAINT `karyawan_kerja_ibfk_1` FOREIGN KEY (`nip_karyawan`) REFERENCES `karyawan` (`nip_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan_penghargaan`
--
ALTER TABLE `karyawan_penghargaan`
  ADD CONSTRAINT `karyawan_penghargaan_ibfk_1` FOREIGN KEY (`nip_karyawan`) REFERENCES `karyawan` (`nip_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan_sekolah`
--
ALTER TABLE `karyawan_sekolah`
  ADD CONSTRAINT `karyawan_sekolah_ibfk_1` FOREIGN KEY (`nip_karyawan`) REFERENCES `karyawan` (`nip_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan_seminar`
--
ALTER TABLE `karyawan_seminar`
  ADD CONSTRAINT `karyawan_seminar_ibfk_1` FOREIGN KEY (`nip_karyawan`) REFERENCES `karyawan` (`nip_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_ibfk_3` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id_lembaga`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menu_akses`
--
ALTER TABLE `menu_akses`
  ADD CONSTRAINT `menu_akses_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_akses_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `menu_role` (`id_menu_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `semester_ibfk_3` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id_lembaga`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `shift_presensi`
--
ALTER TABLE `shift_presensi`
  ADD CONSTRAINT `shift_presensi_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id_lembaga`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shift_presensi_ibfk_2` FOREIGN KEY (`id_unitkerja`) REFERENCES `unit_kerja` (`id_unit_kerja`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD CONSTRAINT `tahun_ajaran_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id_lembaga`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tahun_ajaran_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tingkat_siswa`
--
ALTER TABLE `tingkat_siswa`
  ADD CONSTRAINT `tingkat_siswa_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id_lembaga`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tingkat_siswa_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
