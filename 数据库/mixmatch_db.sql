-- /*
-- Navicat MySQL Data Transfer

-- Source Server         : localhost_3306
-- Source Server Version : 50129
-- Source Host           : localhost:3306
-- Source Database       : phpsystem_db

-- Target Server Type    : MYSQL
-- Target Server Version : 50129
-- File Encoding         : 65001

-- Date: 2016-10-24 20:59
-- */
-- use mixmatch;
-- SET FOREIGN_KEY_CHECKS=0;

-- -- -- ----------------------------
-- -- -- Table structure for `t_admin`
-- -- -- ----------------------------
-- -- DROP TABLE IF EXISTS `t_admin`;
-- -- CREATE TABLE `t_admin` (
-- --   `username` varchar(20) NOT NULL DEFAULT '',
-- --   `password` varchar(32) DEFAULT NULL,
-- --   PRIMARY KEY (`username`)
-- -- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- -- ----------------------------
-- -- -- Records of t_admin
-- -- -- ----------------------------
-- -- INSERT INTO `t_admin` VALUES ('admin2', '123');

-- -- ----------------------------
-- -- Table structure for `t_sku`
-- -- ----------------------------
-- DROP TABLE IF EXISTS `t_sku`;
-- CREATE TABLE `t_sku` (
--   `barcode` int(11) NOT NULL AUTO_INCREMENT,
--   -- `barcode` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'barcode',
--   `skuName` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '单品名称',
--   `skuType` int(11) NOT NULL COMMENT '单品所在类别',
--   `skuStatus` int(11) NOT NULL COMMENT '单品状态',
--   -- 1canuse2cantuse3canbuy4lookfor5droped
--   `price` float NOT NULL COMMENT '单品价格',
--   -- `count` int(11) NOT NULL COMMENT '库存',
--   `channel` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '购买渠道',
--   `brand` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '品牌',
--   `size` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '尺码',
--   `purchaseDate` datetime DEFAULT NULL,
--   `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '单品照片',
--   -- PRIMARY KEY (`barcode`,`count`),
--   PRIMARY KEY (`barcode`),
--   KEY `skuType` (`skuType`),
--   CONSTRAINT `t_sku_ibfk_1` FOREIGN KEY (`skuType`) REFERENCES `t_skuclass` (`skuClassId`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- ----------------------------
-- -- Records of t_sku
-- -- ----------------------------
-- INSERT INTO `t_sku` VALUES ('1', '冬款小公主加厚保暖印花中筒袜', '4', '1', '17.00', '淘宝戴维贝拉旗舰店', '戴维贝拉davebella','9cm','2017-10-25 20:58:19', './upload/2013/07/20074100.jpg');
-- INSERT INTO `t_sku` VALUES ('2', '冬款加厚保暖条纹印花中筒袜', '4', '1', '17.00', '淘宝戴维贝拉旗舰店', '戴维贝拉davebella','9cm','2017-10-25 20:58:19', './upload/2013/07/20074100.jpg');
-- INSERT INTO `t_sku` VALUES ('3', '婴儿马甲粉小熊', '1', '1', '59.00', '老豆商城七天无理由退换货', '无','86cm(12-18月)','2017-10-21 18:51:08', './upload/2013/07/20074100.jpg');

-- -- ----------------------------
-- -- Table structure for `t_skuMix`
-- -- ----------------------------
-- DROP TABLE IF EXISTS `t_skuMix`;
-- CREATE TABLE `t_skuMix` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `skuMixName` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '组合名称',
--   `skuMix` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '组合',
--   `skuMixType` int(11) NOT NULL COMMENT '组合所在类别',
--   `skuMixStatus` int(11) NOT NULL COMMENT '组合状态',
--   -- 1canuse2cantuse3canbuy4lookfor5droped
--   `price` float NOT NULL COMMENT '组合价格',
--   `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '组合自拍照片',
--   `photoModel` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '组合模板照片',
--   -- PRIMARY KEY (`barcode`,`count`),
--   PRIMARY KEY (`id`)
--   -- KEY `skuType` (`skuMType`),
--   -- CONSTRAINT `t_sku_ibfk_1` FOREIGN KEY (`skuType`) REFERENCES `t_skuclass` (`skuClassId`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- -- ----------------------------
-- -- -- Records of t_sku
-- -- -- ----------------------------
-- INSERT INTO `t_skuMix` VALUES ('1','最美组合','2,3', '4', '1', '17.00', '../upload/2013/07/20074100.jpg', '../upload/2017/10/79273500.jpg');

-- -- -- ----------------------------
-- -- -- Table structure for `t_skuclass`
-- -- -- ----------------------------
-- -- DROP TABLE IF EXISTS `t_skuclass`;
-- -- CREATE TABLE `t_skuclass` (
-- --   `skuClassId` int(11) NOT NULL AUTO_INCREMENT,
-- --   `skuClassName` varchar(50) DEFAULT NULL,
-- --   PRIMARY KEY (`skuClassId`)
-- -- ) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- -- -- ----------------------------
-- -- -- Records of t_skuclass
-- -- -- ----------------------------
-- -- INSERT INTO `t_skuclass` VALUES ('1', '外套');
-- -- INSERT INTO `t_skuclass` VALUES ('2', '裤子');
-- -- INSERT INTO `t_skuclass` VALUES ('3', '内衣');
-- -- INSERT INTO `t_skuclass` VALUES ('4', '配件');

