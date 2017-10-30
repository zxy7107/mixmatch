/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50129
Source Host           : localhost:3306
Source Database       : phpsystem_db

Target Server Type    : MYSQL
Target Server Version : 50129
File Encoding         : 65001

Date: 2016-10-24 20:59
*/
use mixmatch;

SET FOREIGN_KEY_CHECKS=0;


-- -- ----------------------------
-- -- Table structure for `t_admin`
-- -- ----------------------------
-- DROP TABLE IF EXISTS `t_admin`;
-- CREATE TABLE `t_admin` (
--   `username` varchar(20) NOT NULL DEFAULT '',
--   `password` varchar(32) DEFAULT NULL,
--   PRIMARY KEY (`username`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- ----------------------------
-- -- Records of t_admin
-- -- ----------------------------
-- INSERT INTO `t_admin` VALUES ('admin2', '123');

-- ----------------------------
-- Table structure for `t_skuMix`
-- ----------------------------
DROP TABLE IF EXISTS `t_skuMix`;
CREATE TABLE `t_skuMix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skuMixName` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '组合名称',
  `skuMix` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '组合',
  `skuMixType` int(11) NOT NULL COMMENT '组合所在类别',
  `skuMixStatus` int(11) NOT NULL COMMENT '组合状态',
  -- 1canuse2cantuse3canbuy4lookfor5droped
  `price` float NOT NULL COMMENT '组合价格',
  `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '组合自拍照片',
  `photoModel` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '组合模板照片',
  -- PRIMARY KEY (`barcode`,`count`),
  PRIMARY KEY (`id`)
  -- KEY `skuType` (`skuMType`),
  -- CONSTRAINT `t_sku_ibfk_1` FOREIGN KEY (`skuType`) REFERENCES `t_skuclass` (`skuClassId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- ----------------------------
-- -- Records of t_sku
-- -- ----------------------------
INSERT INTO `t_skuMix` VALUES ('1','最美组合','2,3', '4', '1', '17.00', '../upload/2013/07/20074100.jpg', '../upload/2017/10/79273500.jpg');

-- -- ----------------------------
-- -- Table structure for `t_skuclass`
-- -- ----------------------------
-- DROP TABLE IF EXISTS `t_skuclass`;
-- CREATE TABLE `t_skuclass` (
--   `skuClassId` int(11) NOT NULL AUTO_INCREMENT,
--   `skuClassName` varchar(50) DEFAULT NULL,
--   PRIMARY KEY (`skuClassId`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- -- ----------------------------
-- -- Records of t_skuclass
-- -- ----------------------------
-- INSERT INTO `t_skuclass` VALUES ('1', '外套');
-- INSERT INTO `t_skuclass` VALUES ('2', '裤子');
-- INSERT INTO `t_skuclass` VALUES ('3', '内衣');
-- INSERT INTO `t_skuclass` VALUES ('4', '配件');

