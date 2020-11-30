/*
 Navicat Premium Data Transfer

 Source Server         : Mysql-localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : db_kemenhub

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 23/11/2020 07:11:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jenis_sk
-- ----------------------------
DROP TABLE IF EXISTS `jenis_sk`;
CREATE TABLE `jenis_sk`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_sk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of jenis_sk
-- ----------------------------
INSERT INTO `jenis_sk` VALUES (1, 'pengembangan');
INSERT INTO `jenis_sk` VALUES (2, 'Pengoperasian');
INSERT INTO `jenis_sk` VALUES (3, 'Perpajangan / Pembangunan / Pengembangan');
INSERT INTO `jenis_sk` VALUES (4, 'Perpanjangan Pengoperasian');
INSERT INTO `jenis_sk` VALUES (5, 'Penyesuaian');
INSERT INTO `jenis_sk` VALUES (6, 'Pendaftaran');

SET FOREIGN_KEY_CHECKS = 1;
