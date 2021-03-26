-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2020 at 10:36 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sweetbakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `lsp_ma` int(11) NOT NULL,
  `lsp_ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lsp_mota` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`lsp_ma`, `lsp_ten`, `lsp_mota`) VALUES
(1, 'cake', 'bánh kem'),
(2, 'cupcake', 'bánh nướng nhỏ'),
(3, 'bread', 'bánh mì'),
(4, 'others', 'Các loại bánh khác');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `sp_ma` int(11) NOT NULL,
  `sp_ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sp_gia` decimal(12,0) NOT NULL,
  `sp_chitiet` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_ngaycapnhat` date NOT NULL,
  `sp_soluong` int(11) NOT NULL,
  `sp_hinhanh` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lsp_ma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`sp_ma`, `sp_ten`, `sp_gia`, `sp_chitiet`, `sp_ngaycapnhat`, `sp_soluong`, `sp_hinhanh`, `lsp_ma`) VALUES
(1, 'Oats bread', '40000', 'Bánh mì yến mạch, hình chữ nhật,dài 20cm', '2020-11-19', 7, 'hinhsanpham/113.jpg', 3),
(2, 'Bánh mì ốc', '20000', 'bánh mì ốc quế, kèm kem tươi ', '2020-11-19', 20, 'hinhsanpham/114.jpg', 3),
(3, 'Pink cake', '30000', 'Bánh kem dâu, kèm mứt dâu', '2020-11-19', 5, 'hinhsanpham/009.jpg', 1),
(4, 'Vani cake', '39000', 'Bánh kem hương vani, kèm dâu tươi', '2020-11-19', 3, 'hinhsanpham/013.jpg', 1),
(5, 'Blue cake', '200000', 'bánh kem màu xanh, kèm cherry và sô cô la', '2020-11-19', 4, 'hinhsanpham/121.jpg', 1),
(6, 'Fruit cake', '300000', 'bánh kem hạnh nhân, kèm trái cây', '2020-11-19', 6, 'hinhsanpham/012.jpg', 1),
(7, 'Doughnut', '19000', 'Bánh donut nhúng sô cô la', '2020-11-19', 11, 'hinhsanpham/015.jpg', 4),
(8, 'Color pies', '40000', 'Bánh quy nhiều màu, nhân kem vani', '2020-11-19', 12, 'hinhsanpham/016.jpg', 4),
(9, 'Heart bread', '12000', 'Bánh mì ngọt hình trái tim', '2020-11-19', 15, 'hinhsanpham/109.jpg', 3),
(10, 'Round bread', '23000', 'Bánh mì tròn, nhân dừa, kèm mè đen', '2020-11-19', 2, 'hinhsanpham/1007.jpg', 3),
(11, 'Pancake', '9000', 'Bánh rán kèm trái cây, mật ong', '2020-11-19', 5, 'hinhsanpham/010.jpg', 4),
(12, 'Tart pies', '15000', 'Bánh tart hương táo,nhân ngọt', '2020-11-19', 10, 'hinhsanpham/1003.jpg', 4),
(13, 'Fruit cupcake', '20000', 'Bánh nướng nhỏ kèm dâu tây và nho', '2020-11-19', 5, 'hinhsanpham/007.jpg', 2),
(14, 'Color cupcake', '20000', 'Bánh nướng nhỏ, kem 7 màu', '2020-11-19', 5, 'hinhsanpham/images (4).jpg', 2),
(15, 'Choco cupcake', '20000', 'Bánh nướng sô cô la, kem vani', '2020-11-19', 5, 'hinhsanpham/101.jpg', 2),
(16, 'Custard', '20000', 'Bánh nướng không kem', '2020-11-19', 5, 'hinhsanpham/images (1).jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `thanhvien`
--

CREATE TABLE `thanhvien` (
  `tv_tendangnhap` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tv_matkhau` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tv_hoten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tv_diachi` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tv_dienthoai` int(20) NOT NULL,
  `tv_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tv_namsinh` date NOT NULL,
  `tv_quantri` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanhvien`
--

INSERT INTO `thanhvien` (`tv_tendangnhap`, `tv_matkhau`, `tv_hoten`, `tv_diachi`, `tv_dienthoai`, `tv_email`, `tv_namsinh`, `tv_quantri`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Thanh Truyen', 'Can Tho', 123456789, 'admin@sweet.com', '1999-05-28', 1),
('truyen123', 'c56fbecb116f654a401c453e6110833b', 'Thanh Truyền', 'Cần Thơ', 9090807, 'abc@gmail.com', '2005-02-08', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`lsp_ma`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`sp_ma`),
  ADD KEY `lsp_ma` (`lsp_ma`);

--
-- Indexes for table `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`tv_tendangnhap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `lsp_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `sp_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`lsp_ma`) REFERENCES `loaisanpham` (`lsp_ma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
