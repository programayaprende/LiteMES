/*
 Navicat MariaDB Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : litemes

 Target Server Type    : MariaDB
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 14/09/2020 21:52:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ma_users
-- ----------------------------
DROP TABLE IF EXISTS `ma_users`;
CREATE TABLE `ma_users`  (
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `locked` int(11) NULL DEFAULT 0,
  `approved` int(11) NULL DEFAULT 0,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `login_attempts` int(11) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ma_users
-- ----------------------------
INSERT INTO `ma_users` VALUES ('jaraiza1983@gmail.com', 'Jonathan', 'Araiza Gonzalez', 'jonathan', 0, 1, NULL, 0, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
