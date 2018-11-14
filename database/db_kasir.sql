/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.1.13-MariaDB : Database - db_kasir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_kasir` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_kasir`;

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(200) DEFAULT NULL,
  `no_rekening` varchar(20) DEFAULT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `status` set('Active','Tidak Active') DEFAULT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bank` */

insert  into `bank`(`id_bank`,`nama_bank`,`no_rekening`,`atas_nama`,`status`) values (1,'Mandiri','123456789','Ida Bagus Gede Anandita','Active'),(2,'BCA','987654321','Ida Ayu Udiyani','Active'),(3,'BRI','569874321','Ida Ayu Udiyani','Active'),(4,'BPD','369258147','Ida Bagus Gede Anandita','Tidak Active');

/*Table structure for table `customer` */

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

/*Data for the table `customer` */

insert  into `customer`(`id_customer`,`nama_customer`,`alamat`,`nohp`,`email`,`keterangan`,`statusdel`,`id_user`,`datecreated`,`dateupdated`) values (1,'Customer 1','Jl. Raya Testing, Kecamatan Testing, Kab. Testing','081888999444','testing@gmail.com','IG : @testing\r\nLINE : tetsing','N','1','2018-02-05','2018-02-05'),(2,'Customer 2','Jl. Customer 2, Kec. Customer 2, Kab. Customer 2','9999999999','customer2@gmail.com','IG : customer 2\r\nline : customer 2','N','1','2018-02-05',NULL);

/*Table structure for table `penjualan` */

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

/*Data for the table `penjualan` */

insert  into `penjualan`(`id_penjualan`,`total`,`bayar`,`sisa_bayar`,`jenis_bayar`,`id_bank`,`id_customer`,`id_user`,`keterangan`,`statusdel`,`datecreated`) values ('1-041118-1',420000,50000,-370000,'Cash',NULL,'','1','-','N','2018-11-04'),('1-041118-2',470000,500000,30000,'Cash',NULL,'','1','-','N','2018-11-04'),('1-13112018-1',1080000,1100000,20000,'Transfer','3','','1','-','N','2018-11-13'),('1-180212-1',220000,NULL,30000,'Cash',NULL,'1','1','-','N','2018-02-12'),('2-13112018-2',590000,6000000,5410000,'Cash','','','2','-','N','2018-11-13');

/*Table structure for table `penjualan_detail` */

DROP TABLE IF EXISTS `penjualan_detail`;

CREATE TABLE `penjualan_detail` (
  `id_penjualan` varchar(100) DEFAULT NULL,
  `id_produk` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `harga_jual` bigint(20) DEFAULT NULL,
  `tot_harga` bigint(20) DEFAULT NULL,
  `id_user` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penjualan_detail` */

insert  into `penjualan_detail`(`id_penjualan`,`id_produk`,`quantity`,`harga_jual`,`tot_harga`,`id_user`) values ('1-180212-1','DA-1',1,220000,220000,NULL),('1-041118-1','DA-3',1,170000,170000,NULL),('1-041118-1','DA-2',1,250000,250000,NULL),('1-041118-2','DA-1',1,220000,220000,NULL),('1-041118-2','DA-2',1,250000,250000,NULL),('1-13112018-1','DA-3',1,170000,170000,'1'),('1-13112018-1','DA-2',1,250000,250000,'1'),('2-13112018-2','DA-2',1,250000,250000,'2'),('2-13112018-2','DA-3',2,170000,340000,'2');

/*Table structure for table `produk` */

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

/*Data for the table `produk` */

insert  into `produk`(`id_produk`,`nama_produk`,`harga_beli`,`harga_jual`,`stok`,`picture`,`keterangan`,`id_kategori`,`id_user`,`statusdel`,`datecreated`,`dateupdated`) values ('DA-1','Testing Produk 1',110000,220000,10,'brossads2.png','ini testing add produk ','1','1','N','2018-02-04','2018-02-04'),('DA-2','Testing Produk 2',180000,250000,9,'bros2.PNG','testing add produk kedua','2','1','N','2018-02-04',NULL),('DA-3','Testing produk 3',140000,170000,8,'Capture.PNG','testing id user','3','1','N','2018-02-04',NULL);

/*Table structure for table `produk_kategori` */

DROP TABLE IF EXISTS `produk_kategori`;

CREATE TABLE `produk_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) DEFAULT NULL,
  `id_user` varchar(10) DEFAULT NULL,
  `statusdel` set('Y','N') DEFAULT NULL,
  `datecreated` date DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `produk_kategori` */

insert  into `produk_kategori`(`id_kategori`,`kategori`,`id_user`,`statusdel`,`datecreated`) values (1,'Bros','1','N','2018-02-04'),(2,'Subeng','1','N','2018-02-04'),(3,'Paket Bros','1','N','2018-02-04'),(4,'Cincin','1','N','2018-02-04');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nohp` int(11) DEFAULT NULL,
  `picture` text,
  `otoritas` set('Admin','Manager','Pegawai') DEFAULT NULL,
  `status_del` set('Y','N') DEFAULT NULL,
  `datecreated` date DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama`,`username`,`password`,`email`,`nohp`,`picture`,`otoritas`,`status_del`,`datecreated`) values (1,'Administrator','admin','admin','ida.bagus.anandita@gmail.com',2147483647,NULL,'Admin','N','2018-02-03'),(2,'Ida Bagus Gede Anandita','gusdita','anandita','ida.bagus.anandita@gmail.com',2147483647,NULL,'Manager','N','2018-02-03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
