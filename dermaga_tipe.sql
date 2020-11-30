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

 Date: 23/11/2020 07:11:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dermaga_tipe
-- ----------------------------
DROP TABLE IF EXISTS `dermaga_tipe`;
CREATE TABLE `dermaga_tipe`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dermaga_tipe
-- ----------------------------
INSERT INTO `dermaga_tipe` VALUES (1, 'JETY DOLPHIN');
INSERT INTO `dermaga_tipe` VALUES (2, 'MARGINAL');
INSERT INTO `dermaga_tipe` VALUES (3, 'FINGER');
INSERT INTO `dermaga_tipe` VALUES (4, 'SLIPAWAY');
INSERT INTO `dermaga_tipe` VALUES (5, 'GRAVING DOCK');
INSERT INTO `dermaga_tipe` VALUES (6, 'FLOATING DOCK');
INSERT INTO `dermaga_tipe` VALUES (7, 'FLOATING');
INSERT INTO `dermaga_tipe` VALUES (8, 'SINGLE POINT MOORING');
INSERT INTO `dermaga_tipe` VALUES (9, 'POINT MOORING');
INSERT INTO `dermaga_tipe` VALUES (10, 'MULTI BOUY MOORING');

SET FOREIGN_KEY_CHECKS = 1;
