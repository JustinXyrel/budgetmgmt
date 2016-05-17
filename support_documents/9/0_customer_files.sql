/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50613
Source Host           : localhost:3306
Source Database       : mgc_bir

Target Server Type    : MYSQL
Target Server Version : 50613
File Encoding         : 65001

Date: 2016-04-27 08:59:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `0_customer_files`
-- ----------------------------
DROP TABLE IF EXISTS `0_customer_files`;
CREATE TABLE `0_customer_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `file_path` varchar(250) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `file_name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of 0_customer_files
-- ----------------------------
