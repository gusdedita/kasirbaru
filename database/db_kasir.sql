/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100136
 Source Host           : localhost:3306
 Source Schema         : db_kasir

 Target Server Type    : MySQL
 Target Server Version : 100136
 File Encoding         : 65001

 Date: 27/11/2018 21:47:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bank
-- ----------------------------
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(200) DEFAULT NULL,
  `no_rekening` varchar(20) DEFAULT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `status` set('Active','Tidak Active') DEFAULT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bank
-- ----------------------------
BEGIN;
INSERT INTO `bank` VALUES (1, 'Mandiri', '123456789', 'Ida Bagus Gede Anandita', 'Active');
INSERT INTO `bank` VALUES (2, 'BCA', '987654321', 'Ida Ayu Udiyani', 'Active');
INSERT INTO `bank` VALUES (3, 'BRI', '569874321', 'Ida Ayu Udiyani', 'Active');
INSERT INTO `bank` VALUES (4, 'BPD', '369258147', 'Ida Bagus Gede Anandita', 'Tidak Active');
COMMIT;

-- ----------------------------
-- Table structure for cabang
-- ----------------------------
DROP TABLE IF EXISTS `cabang`;
CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cabang` varchar(50) DEFAULT NULL,
  `statusdel` set('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id_cabang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cabang
-- ----------------------------
BEGIN;
INSERT INTO `cabang` VALUES (1, 'Singapadu', 'N');
INSERT INTO `cabang` VALUES (2, 'Klungkung', 'N');
INSERT INTO `cabang` VALUES (3, 'Denpasar', 'N');
COMMIT;

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(255) DEFAULT NULL,
  `alamat` text,
  `nohp` varchar(13) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `statusdel` set('Y','N') DEFAULT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `datecreated` date DEFAULT NULL,
  `dateupdated` date DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer
-- ----------------------------
BEGIN;
INSERT INTO `customer` VALUES (1, 'Customer 1', 'Jl. Raya Testing, Kecamatan Testing, Kab. Testing', '081888999444', 'testing@gmail.com', 'IG : @testing\r\nLINE : tetsing', 'N', '1', '2018-02-05', '2018-02-05');
INSERT INTO `customer` VALUES (2, 'Customer 2', 'Jl. Customer 2, Kec. Customer 2, Kab. Customer 2', '9999999999', 'customer2@gmail.com', 'IG : customer 2\r\nline : customer 2', 'N', '1', '2018-02-05', NULL);
COMMIT;

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `id_penjualan` varchar(100) NOT NULL,
  `total` bigint(20) DEFAULT NULL,
  `bayar` bigint(20) DEFAULT NULL,
  `sisa_bayar` bigint(20) DEFAULT NULL,
  `jenis_bayar` set('Cash','Transfer') DEFAULT NULL,
  `id_bank` varchar(10) DEFAULT NULL,
  `id_customer` varchar(10) DEFAULT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `keterangan` text,
  `statusdel` set('Y','N') DEFAULT NULL,
  `datecreated` date DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
BEGIN;
INSERT INTO `penjualan` VALUES ('1-041118-1', 420000, 50000, -370000, 'Cash', NULL, '', '1', '-', 'N', '2018-11-04');
INSERT INTO `penjualan` VALUES ('1-041118-2', 470000, 500000, 30000, 'Cash', NULL, '', '1', '-', 'N', '2018-11-04');
INSERT INTO `penjualan` VALUES ('1-13112018-1', 1080000, 1100000, 20000, 'Transfer', '3', '', '1', '-', 'N', '2018-11-13');
INSERT INTO `penjualan` VALUES ('1-180212-1', 220000, NULL, 30000, 'Cash', NULL, '1', '1', '-', 'N', '2018-02-12');
INSERT INTO `penjualan` VALUES ('2-13112018-2', 590000, 6000000, 5410000, 'Cash', '', '', '2', '-', 'N', '2018-11-13');
COMMIT;

-- ----------------------------
-- Table structure for penjualan_detail
-- ----------------------------
DROP TABLE IF EXISTS `penjualan_detail`;
CREATE TABLE `penjualan_detail` (
  `id_penjualan` varchar(100) DEFAULT NULL,
  `id_produk` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `harga_jual` bigint(20) DEFAULT NULL,
  `tot_harga` bigint(20) DEFAULT NULL,
  `id_user` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penjualan_detail
-- ----------------------------
BEGIN;
INSERT INTO `penjualan_detail` VALUES ('1-180212-1', 'DA-1', 1, 220000, 220000, NULL);
INSERT INTO `penjualan_detail` VALUES ('1-041118-1', 'DA-3', 1, 170000, 170000, NULL);
INSERT INTO `penjualan_detail` VALUES ('1-041118-1', 'DA-2', 1, 250000, 250000, NULL);
INSERT INTO `penjualan_detail` VALUES ('1-041118-2', 'DA-1', 1, 220000, 220000, NULL);
INSERT INTO `penjualan_detail` VALUES ('1-041118-2', 'DA-2', 1, 250000, 250000, NULL);
INSERT INTO `penjualan_detail` VALUES ('1-13112018-1', 'DA-3', 1, 170000, 170000, '1');
INSERT INTO `penjualan_detail` VALUES ('1-13112018-1', 'DA-2', 1, 250000, 250000, '1');
INSERT INTO `penjualan_detail` VALUES ('2-13112018-2', 'DA-2', 1, 250000, 250000, '2');
INSERT INTO `penjualan_detail` VALUES ('2-13112018-2', 'DA-3', 2, 170000, 340000, '2');
COMMIT;

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `harga_beli` bigint(20) DEFAULT NULL,
  `harga_jual` bigint(20) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `picture` text,
  `keterangan` text,
  `id_kategori` varchar(10) DEFAULT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `statusdel` set('Y','N') DEFAULT NULL,
  `datecreated` date DEFAULT NULL,
  `dateupdated` date DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of produk
-- ----------------------------
BEGIN;
INSERT INTO `produk` VALUES ('DA-1', 'Testing Produk 1', 110000, 220000, 10, 'brossads2.png', 'ini testing add produk ', '1', '1', 'N', '2018-02-04', '2018-02-04');
INSERT INTO `produk` VALUES ('DA-2', 'Testing Produk 2', 180000, 250000, 9, 'bros2.PNG', 'testing add produk kedua', '2', '1', 'N', '2018-02-04', '2018-02-04');
INSERT INTO `produk` VALUES ('DA-3', 'Testing produk 3', 140000, 170000, 8, 'Capture.PNG', 'testing id user', '3', '1', 'N', '2018-02-04', '2018-02-04');
INSERT INTO `produk` VALUES ('DA-4', 'Testing Produk 4 Edit', 100000, 200000, 27, '8111f339fe508b529357ae843f370215.jpg', 'Testing input produk edit', '4', '1', 'N', '2018-11-26', '2018-11-26');
COMMIT;

-- ----------------------------
-- Table structure for produk_kategori
-- ----------------------------
DROP TABLE IF EXISTS `produk_kategori`;
CREATE TABLE `produk_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) DEFAULT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `statusdel` set('Y','N') DEFAULT NULL,
  `datecreated` date DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of produk_kategori
-- ----------------------------
BEGIN;
INSERT INTO `produk_kategori` VALUES (1, 'Bros', '1', 'N', '2018-02-04');
INSERT INTO `produk_kategori` VALUES (2, 'Subeng', '1', 'N', '2018-02-04');
INSERT INTO `produk_kategori` VALUES (3, 'Paket Bros', '1', 'N', '2018-02-04');
INSERT INTO `produk_kategori` VALUES (4, 'Cincin', '1', 'N', '2018-02-04');
COMMIT;

-- ----------------------------
-- Table structure for stok_cabang
-- ----------------------------
DROP TABLE IF EXISTS `stok_cabang`;
CREATE TABLE `stok_cabang` (
  `id_cabang` varchar(50) DEFAULT NULL,
  `id_produk` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stok_cabang
-- ----------------------------
BEGIN;
INSERT INTO `stok_cabang` VALUES ('1', 'DA-1', 5);
INSERT INTO `stok_cabang` VALUES ('2', 'DA-1', 3);
INSERT INTO `stok_cabang` VALUES ('3', 'DA-1', 2);
INSERT INTO `stok_cabang` VALUES ('1', 'DA-2', 3);
INSERT INTO `stok_cabang` VALUES ('2', 'DA-2', 2);
INSERT INTO `stok_cabang` VALUES ('3', 'DA-2', 4);
INSERT INTO `stok_cabang` VALUES ('1', 'DA-3', 2);
INSERT INTO `stok_cabang` VALUES ('2', 'DA-3', 5);
INSERT INTO `stok_cabang` VALUES ('3', 'DA-3', 1);
INSERT INTO `stok_cabang` VALUES ('1', 'DA-4', 8);
INSERT INTO `stok_cabang` VALUES ('2', 'DA-4', 9);
INSERT INTO `stok_cabang` VALUES ('3', 'DA-4', 10);
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `picture` text,
  `otoritas` set('Admin','Manager','Owner','Pegawai') DEFAULT NULL,
  `status_del` set('Y','N') DEFAULT NULL,
  `datecreated` date DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, 'Administrator', 'admin', 'admin', 'ida.bagus.anandita@gmail.com', '2147483647', NULL, 'Admin', 'N', '2018-02-03');
INSERT INTO `user` VALUES (2, 'Ida Bagus Gede Anandita', 'gusdita', 'anandita', 'ida.bagus.anandita@gmail.com', '2147483647', 'photo_2016-12-29_19-23-52.jpg', 'Manager', 'N', '2018-02-03');
INSERT INTO `user` VALUES (3, 'Ida Ayu Putu Udiyani', 'udiyani', 'udiyani', 'ida.ayu.udiyani@gmail.com', '2147483647', 'USI_4403-1.jpg', 'Owner', 'N', '2018-11-15');
INSERT INTO `user` VALUES (4, 'Testing Pegawai', 'pegawai edit', 'pegawai', 'pegawai@gmail.com', '81805400', 'gerard-butler-460f146f26b6fbc1f3e3fa42030d25ea.jpg', 'Pegawai', 'N', '2018-11-15');
COMMIT;

-- ----------------------------
-- Table structure for user_cabang
-- ----------------------------
DROP TABLE IF EXISTS `user_cabang`;
CREATE TABLE `user_cabang` (
  `id_cabang` varchar(255) DEFAULT NULL,
  `id_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_cabang
-- ----------------------------
BEGIN;
INSERT INTO `user_cabang` VALUES ('1', '1');
INSERT INTO `user_cabang` VALUES ('2', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
