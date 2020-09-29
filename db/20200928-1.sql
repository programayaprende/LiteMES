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

 Date: 28/09/2020 22:07:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for lnk_roles_permissions
-- ----------------------------
DROP TABLE IF EXISTS `lnk_roles_permissions`;
CREATE TABLE `lnk_roles_permissions`  (
  `id_role` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`, `id_permission`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lnk_roles_permissions
-- ----------------------------
INSERT INTO `lnk_roles_permissions` VALUES (1, 10001, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (1, 10002, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (1, 10003, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (1, 10004, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (1, 10005, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (1, 10006, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (2, 10001, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (2, 10002, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (2, 10003, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (2, 10004, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (2, 10005, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (2, 10006, 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (3, 10001, 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (3, 10002, 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (3, 10003, 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (3, 10004, 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (3, 10005, 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES (3, 10006, 'DENY', '2020-01-01 00:00:00');

-- ----------------------------
-- Table structure for lnk_users_roles
-- ----------------------------
DROP TABLE IF EXISTS `lnk_users_roles`;
CREATE TABLE `lnk_users_roles`  (
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`user_name`, `id_role`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lnk_users_roles
-- ----------------------------
INSERT INTO `lnk_users_roles` VALUES ('andrew', 3, '2020-01-01 00:00:00');
INSERT INTO `lnk_users_roles` VALUES ('j.araiza', 1, '2020-01-01 00:00:00');

-- ----------------------------
-- Table structure for ma_permissions
-- ----------------------------
DROP TABLE IF EXISTS `ma_permissions`;
CREATE TABLE `ma_permissions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `action` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `default` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'DENY',
  `description_location` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10007 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ma_permissions
-- ----------------------------
INSERT INTO `ma_permissions` VALUES (10001, 'Users', 'GetUsers', 'View list of users', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES (10002, 'Users', 'Approve', 'Approve new users accounts', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES (10003, 'Users', 'Lock', 'Lock users, lock users can not login into the system', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES (10004, 'Users', 'GetUserData', 'View individual user account info', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES (10005, 'Users', 'Edit', 'Update user account info', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES (10006, 'Users', 'New', 'Create new user accounts', 'DENY', 'LOCATION_PENDING');

-- ----------------------------
-- Table structure for ma_roles
-- ----------------------------
DROP TABLE IF EXISTS `ma_roles`;
CREATE TABLE `ma_roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `protected` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ma_roles
-- ----------------------------
INSERT INTO `ma_roles` VALUES (1, 'Admin', 'System Admin', '2020-01-01 00:00:00', '2020-01-01 00:00:00', 1);
INSERT INTO `ma_roles` VALUES (2, 'System', 'System', '2020-01-01 00:00:00', '2020-01-01 00:00:00', 1);
INSERT INTO `ma_roles` VALUES (3, 'User', 'Basic User Role', '2020-01-01 00:00:00', '2020-01-01 00:00:00', 1);

-- ----------------------------
-- Table structure for ma_users
-- ----------------------------
DROP TABLE IF EXISTS `ma_users`;
CREATE TABLE `ma_users`  (
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
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
  `job_description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ma_users
-- ----------------------------
INSERT INTO `ma_users` VALUES ('andrew', 'hijo@hijo.com', 'Andrew', 'Araiza', 'jonathan', 0, 1, NULL, 0, '2020-03-25 00:00:00', NULL, 'Warehouse Support', '6643284226');
INSERT INTO `ma_users` VALUES ('aron', 'aron@aron.com', 'Aron', 'aron', 'jonathan', 0, 1, NULL, 0, '2020-01-25 00:00:00', NULL, 'Production Manager', '6643284226');
INSERT INTO `ma_users` VALUES ('j.araiza', 'jaraiza1983@gmail.com', 'Jonathan', 'Araiza', 'jonathan', 0, 1, NULL, 0, '2020-06-25 00:00:00', NULL, 'App Developer', '6643284226');
INSERT INTO `ma_users` VALUES ('jose', 'jose@jose.com', 'jose', 'jose', 'jonathan', 1, 1, NULL, 0, '2020-09-25 00:00:00', NULL, 'Warehouse Support', '6643284226');
INSERT INTO `ma_users` VALUES ('juan', 'juan@juan.com', 'juan', 'juan', 'jonathan', 1, 1, NULL, 0, '2020-09-25 00:00:00', NULL, 'Warehouse Support', '6643284226');
INSERT INTO `ma_users` VALUES ('mama', 'mama@mama.com', 'mama', 'mama', 'jonathan', 1, 1, NULL, 0, '2020-09-25 00:00:00', NULL, 'Accounting Support', 'mamamama');
INSERT INTO `ma_users` VALUES ('papa', 'papa@papa.com', 'papa', 'papa', 'DRAGONBALL', 1, 1, NULL, 0, '2020-09-25 00:00:00', NULL, 'Quality Manager', 'papapapa');
INSERT INTO `ma_users` VALUES ('pepe', 'pepe@pepe.com', 'pepe', 'pepe', 'jonathan', 1, 1, NULL, 0, '2020-09-25 00:00:00', NULL, 'Quality Support', '6643284226');
INSERT INTO `ma_users` VALUES ('raul', 'raul@raul.com', 'raul', 'raul', 'jonathan', 1, 1, NULL, 0, '2020-09-25 00:00:00', NULL, 'Shipping Support', '6643284226');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '20200917080200', 'App\\Database\\Migrations\\m20200917080200', 'default', 'App', 1600398857, 1);
INSERT INTO `migrations` VALUES (2, '2020-09-18-233137', 'App\\Database\\Migrations\\AddColumnsToUsers', 'default', 'App', 1600568354, 2);

-- ----------------------------
-- Table structure for testing
-- ----------------------------
DROP TABLE IF EXISTS `testing`;
CREATE TABLE `testing`  (
  `user_name` int(50) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of testing
-- ----------------------------
INSERT INTO `testing` VALUES (1, 'Anna', 'Krox');
INSERT INTO `testing` VALUES (2, 'Anna', 'Krox');
INSERT INTO `testing` VALUES (3, 'Anna', 'Krox');

SET FOREIGN_KEY_CHECKS = 1;
