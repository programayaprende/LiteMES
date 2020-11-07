/*
Navicat MySQL Data Transfer

Source Server         : locahost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : litemes

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-11-06 17:55:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `lnk_roles_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `lnk_roles_permissions`;
CREATE TABLE `lnk_roles_permissions` (
  `id_role` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_role`,`id_permission`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lnk_roles_permissions
-- ----------------------------
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10001', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10002', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10003', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10004', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10005', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10006', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10007', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10010', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10011', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10012', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10013', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10014', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10015', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10016', 'ALLOW', '2020-10-03 18:39:17');
INSERT INTO `lnk_roles_permissions` VALUES ('1', '10017', 'ALLOW', '2020-10-03 18:39:16');
INSERT INTO `lnk_roles_permissions` VALUES ('2', '10001', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('2', '10002', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('2', '10003', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('2', '10004', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('2', '10005', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('2', '10006', 'ALLOW', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('3', '10001', 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('3', '10002', 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('3', '10003', 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('3', '10004', 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('3', '10005', 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('3', '10006', 'DENY', '2020-01-01 00:00:00');
INSERT INTO `lnk_roles_permissions` VALUES ('6', '10007', 'ALLOW', '2020-10-02 07:09:00');
INSERT INTO `lnk_roles_permissions` VALUES ('6', '10010', 'ALLOW', '2020-10-02 07:09:01');
INSERT INTO `lnk_roles_permissions` VALUES ('6', '10011', 'ALLOW', '2020-10-02 07:09:01');
INSERT INTO `lnk_roles_permissions` VALUES ('6', '10012', 'ALLOW', '2020-10-02 07:09:00');
INSERT INTO `lnk_roles_permissions` VALUES ('6', '10013', 'ALLOW', '2020-10-02 07:09:00');
INSERT INTO `lnk_roles_permissions` VALUES ('6', '10014', 'ALLOW', '2020-10-02 07:09:00');

-- ----------------------------
-- Table structure for `lnk_users_roles`
-- ----------------------------
DROP TABLE IF EXISTS `lnk_users_roles`;
CREATE TABLE `lnk_users_roles` (
  `user_name` varchar(20) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_name`,`id_role`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of lnk_users_roles
-- ----------------------------
INSERT INTO `lnk_users_roles` VALUES ('andrew', '6', '2020-10-03 15:50:59');
INSERT INTO `lnk_users_roles` VALUES ('aron', '6', '2020-10-03 15:51:09');
INSERT INTO `lnk_users_roles` VALUES ('j.araiza', '1', '2020-01-01 00:00:00');
INSERT INTO `lnk_users_roles` VALUES ('j.araiza', '6', '2020-10-03 16:44:08');
INSERT INTO `lnk_users_roles` VALUES ('jose', '6', '2020-10-03 16:44:10');
INSERT INTO `lnk_users_roles` VALUES ('juan', '6', '2020-10-03 17:09:23');
INSERT INTO `lnk_users_roles` VALUES ('mama', '6', '2020-10-03 18:39:43');
INSERT INTO `lnk_users_roles` VALUES ('papa', '3', '2020-01-01 00:00:00');
INSERT INTO `lnk_users_roles` VALUES ('pepe', '3', '2020-01-01 00:00:00');
INSERT INTO `lnk_users_roles` VALUES ('raul', '3', '2020-01-01 00:00:00');

-- ----------------------------
-- Table structure for `ma_fixed_assets`
-- ----------------------------
DROP TABLE IF EXISTS `ma_fixed_assets`;
CREATE TABLE `ma_fixed_assets` (
  `id_fixed asset` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) DEFAULT NULL,
  `part_number` varchar(25) DEFAULT NULL,
  `brand` varchar(25) DEFAULT NULL,
  `model` varchar(25) DEFAULT NULL,
  `serial_no` varchar(30) DEFAULT NULL,
  `import_petition` varchar(50) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `key` varchar(15) DEFAULT NULL,
  `remark` varchar(250) DEFAULT NULL,
  `hash_fixed_asset` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `fixed_assets_status` varchar(10) DEFAULT '',
  PRIMARY KEY (`id_fixed asset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ma_fixed_assets
-- ----------------------------

-- ----------------------------
-- Table structure for `ma_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `ma_permissions`;
CREATE TABLE `ma_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` varchar(15) DEFAULT 'DENY',
  `description_location` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10018 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ma_permissions
-- ----------------------------
INSERT INTO `ma_permissions` VALUES ('10001', 'Users', 'GetUsers', 'View list of users', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10002', 'Users', 'Approve', 'Approve new users accounts', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10003', 'Users', 'Lock', 'Lock users, lock users can not login into the system', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10004', 'Users', 'GetUserData', 'View individual user account info', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10005', 'Users', 'Edit', 'Update user account info', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10006', 'Users', 'New', 'Create new user accounts', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10007', 'Roles', 'GetRoles', 'View list of users', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10010', 'Roles', 'GetRoleData', 'View individual user account info', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10011', 'Roles', 'Edit', 'Update user account info', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10012', 'Roles', 'New', 'Create new user accounts', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10013', 'Roles', 'View', 'View Role permissions and users with each role', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10014', 'Roles', 'List', 'Enter into Query module', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10015', 'Users', 'List', 'Enter into Query module', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10016', 'Roles', 'RemoveUser', 'Remove user from a role list', 'DENY', 'LOCATION_PENDING');
INSERT INTO `ma_permissions` VALUES ('10017', 'Roles', 'AddUser', 'Add user to a role list', 'DENY', 'LOCATION_PENDING');

-- ----------------------------
-- Table structure for `ma_roles`
-- ----------------------------
DROP TABLE IF EXISTS `ma_roles`;
CREATE TABLE `ma_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `protected` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ma_roles
-- ----------------------------
INSERT INTO `ma_roles` VALUES ('1', 'Admin', 'System Admin', '2020-01-01 00:00:00', '2020-01-01 00:00:00', '1');
INSERT INTO `ma_roles` VALUES ('2', 'System', 'System', '2020-01-01 00:00:00', '2020-01-01 00:00:00', '1');
INSERT INTO `ma_roles` VALUES ('3', 'General User', 'Basic User Role', '2020-01-01 00:00:00', '2020-01-01 00:00:00', '1');
INSERT INTO `ma_roles` VALUES ('6', 'Planner', 'Planners', '2020-01-01 00:00:00', '2020-01-01 00:00:00', '0');

-- ----------------------------
-- Table structure for `ma_users`
-- ----------------------------
DROP TABLE IF EXISTS `ma_users`;
CREATE TABLE `ma_users` (
  `user_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `locked` int(11) DEFAULT 0,
  `approved` int(11) DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `login_attempts` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `job_description` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ma_users
-- ----------------------------
INSERT INTO `ma_users` VALUES ('andrew', 'hijo@hijo.com', 'Andrew', 'Araiza', 'jonathan', '0', '1', null, '0', '2020-03-25 00:00:00', null, 'Warehouse Support', '6643284226');
INSERT INTO `ma_users` VALUES ('aron', 'aron@aron.com', 'Aron', 'aron', 'jonathan', '0', '1', null, '0', '2020-01-25 00:00:00', null, 'Production Manager', '6643284226');
INSERT INTO `ma_users` VALUES ('j.araiza', 'jaraiza1983@gmail.com', 'Jonathan', 'Araiza', 'jonathan', '0', '1', null, '0', '2020-06-25 00:00:00', null, 'App Developer', '6643284226');
INSERT INTO `ma_users` VALUES ('jose', 'jose@jose.com', 'jose', 'jose', 'jonathan', '1', '1', null, '0', '2020-09-25 00:00:00', null, 'Warehouse Support', '6643284226');
INSERT INTO `ma_users` VALUES ('juan', 'juan@juan.com', 'juan', 'juan', 'jonathan', '1', '1', null, '0', '2020-09-25 00:00:00', null, 'Warehouse Support', '6643284226');
INSERT INTO `ma_users` VALUES ('mama', 'mama@mama.com', 'mama', 'mama', 'jonathan', '1', '1', null, '0', '2020-09-25 00:00:00', null, 'Accounting Support', 'mamamama');
INSERT INTO `ma_users` VALUES ('papa', 'papa@papa.com', 'papa', 'papa', 'jonathan', '1', '1', null, '0', '2020-09-25 00:00:00', null, 'Quality Manager', 'papapapa');
INSERT INTO `ma_users` VALUES ('pepe', 'pepe@pepe.com', 'pepe', 'pepe', 'jonathan', '1', '1', null, '0', '2020-09-25 00:00:00', null, 'Quality Support', '6643284226');
INSERT INTO `ma_users` VALUES ('raul', 'raul@raul.com', 'raul', 'raul', 'jonathan', '1', '1', null, '0', '2020-09-25 00:00:00', null, 'Shipping Support', '6643284226');
INSERT INTO `ma_users` VALUES ('usuario1', 'usuario1@gmail.com', 'Usuario_1', 'Usuario_1', 'jonathan', '0', '0', null, '0', null, null, 'Accounting Support', '6643284226');
INSERT INTO `ma_users` VALUES ('usuario2', 'usuario2@gmail.com', 'Usuario_2', 'Usuario_2', 'jonathan', '0', '0', null, '0', null, null, 'Sr. App Developer', '6643284226');
INSERT INTO `ma_users` VALUES ('usuario3', 'usuario3@gmail.com', 'Usuario_3', 'Usuario_3', 'jonathan', '0', '0', null, '0', null, null, 'Production Manager', '6643284226');

-- ----------------------------
-- Table structure for `md_approvals`
-- ----------------------------
DROP TABLE IF EXISTS `md_approvals`;
CREATE TABLE `md_approvals` (
  `id_approval` int(11) NOT NULL AUTO_INCREMENT,
  `drafter` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `submit_at` datetime DEFAULT NULL,
  `approval_hash` varchar(100) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT 'P',
  `last_name` varchar(45) DEFAULT 'P',
  `job_description` varchar(100) DEFAULT 'P',
  `finished_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_approval`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of md_approvals
-- ----------------------------
INSERT INTO `md_approvals` VALUES ('147', 'j.araiza', 'Notified', 'Probando solo notificaciones', '<p>Probando solo notificaciones \'hola \"hola</p><p><br></p><p>\'hello\'알림 만 테스트 hello</p>', '2020-11-01 07:56:47', '2020-11-01 08:04:08', '207477b123a86cde32af0f2bbb7a59d3', 'P', 'P', 'P', '2020-11-01 08:04:08');
INSERT INTO `md_approvals` VALUES ('148', 'j.araiza', 'Pending', 'Probando status concent', '<p>Probando notificaciones</p><p>\'hello\'알림 만 테스트 hello</p>', '2020-11-01 08:04:41', '2020-11-01 08:05:10', 'f1b0ea5a70ebc9bcabdec217f3f1c857', 'P', 'P', 'P', null);
INSERT INTO `md_approvals` VALUES ('149', 'j.araiza', 'Draft', null, null, '0000-00-00 00:00:00', null, '17eefdd700b551e6df4766070fa7472b', '2020-11-01 08:49:05', 'Jonathan', 'Araiza', null);
INSERT INTO `md_approvals` VALUES ('150', 'j.araiza', 'Draft', null, null, '2020-11-01 08:49:41', null, 'e5904067a181e8c833adcbe705945e8a', 'Jonathan', 'Araiza', 'App Developer', null);

-- ----------------------------
-- Table structure for `md_approvals_files`
-- ----------------------------
DROP TABLE IF EXISTS `md_approvals_files`;
CREATE TABLE `md_approvals_files` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `id_approval` varchar(50) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `upload_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_file`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of md_approvals_files
-- ----------------------------

-- ----------------------------
-- Table structure for `md_approvals_users`
-- ----------------------------
DROP TABLE IF EXISTS `md_approvals_users`;
CREATE TABLE `md_approvals_users` (
  `id_approval` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `approval_type` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `status_set_at` datetime DEFAULT NULL,
  `receive_at` datetime DEFAULT NULL,
  `comment` varchar(200) DEFAULT '',
  `seq` int(11) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `job_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_approval`,`user_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of md_approvals_users
-- ----------------------------
INSERT INTO `md_approvals_users` VALUES ('147', 'andrew', 'Notification', 'Notified', '2020-11-01 08:04:08', '2020-11-01 08:04:08', '', '2', 'Andrew', 'Araiza', 'Warehouse Support');
INSERT INTO `md_approvals_users` VALUES ('147', 'j.araiza', 'Notification', 'Notified', '2020-11-01 08:04:08', '2020-11-01 08:04:08', '', '3', 'Jonathan', 'Araiza', 'App Developer');
INSERT INTO `md_approvals_users` VALUES ('147', 'mama', 'Notification', 'Notified', '2020-11-01 08:04:08', '2020-11-01 08:04:08', '', '1', 'mama', 'mama', 'Accounting Support');
INSERT INTO `md_approvals_users` VALUES ('148', 'j.araiza', 'Concent', 'Pending', null, '2020-11-01 08:05:10', '', '1', 'Jonathan', 'Araiza', 'App Developer');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '20200917080200', 'App\\Database\\Migrations\\m20200917080200', 'default', 'App', '1600398857', '1');
INSERT INTO `migrations` VALUES ('2', '2020-09-18-233137', 'App\\Database\\Migrations\\AddColumnsToUsers', 'default', 'App', '1600568354', '2');

-- ----------------------------
-- Table structure for `sys_emails`
-- ----------------------------
DROP TABLE IF EXISTS `sys_emails`;
CREATE TABLE `sys_emails` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `email_to` varchar(255) DEFAULT NULL,
  `email_subject` varchar(255) DEFAULT NULL,
  `email_body` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `send_attempts` int(11) DEFAULT 0,
  `sent_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_emails
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_files_upload`
-- ----------------------------
DROP TABLE IF EXISTS `sys_files_upload`;
CREATE TABLE `sys_files_upload` (
  `id` int(11) NOT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_type` varchar(45) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `upload_dt` datetime DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `sys_file_name` varchar(100) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `share_with` text DEFAULT '\'*\'',
  `description` text DEFAULT '\'\'',
  `id_grp` varchar(50) DEFAULT NULL,
  `tags` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_files_upload
-- ----------------------------
INSERT INTO `sys_files_upload` VALUES ('68', 'Template.docx', 'application/vnd.openxmlformats-officedocument', '0', '2020-10-04 21:41:44', 'j.araiza', '1601872902_Template.docx', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\repository\\2020\\10\\68\\1601872902_Template.docx', '*', 'politica medio ambiental', '1601872904', 'politicas');
INSERT INTO `sys_files_upload` VALUES ('69', 'Template.docx', 'application/vnd.openxmlformats-officedocument', '0', '2020-10-04 21:43:11', 'j.araiza', '1601872981_Template.docx', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\repository\\2020\\10\\69\\1601872981_Template.docx', '*', 'politica medio ambiental', '1601872991', 'politicas, ehs');
INSERT INTO `sys_files_upload` VALUES ('70', 'Template Math.xlsx', 'application/vnd.openxmlformats-officedocument', '0', '2020-10-04 21:43:47', 'j.araiza', '1601873026_Template Math.xlsx', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\repository\\2020\\10\\70\\1601873026_Template Math.xlsx', '*', 'manual de operacion SG435', '1601873027', 'manual, SG435, instructivo');

-- ----------------------------
-- Table structure for `sys_files_upload_tmp`
-- ----------------------------
DROP TABLE IF EXISTS `sys_files_upload_tmp`;
CREATE TABLE `sys_files_upload_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(45) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_type` varchar(45) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `upload_dt` datetime DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `sys_file_name` varchar(100) DEFAULT NULL,
  `tmp_file_path` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_files_upload_tmp
-- ----------------------------
INSERT INTO `sys_files_upload_tmp` VALUES ('71', null, 'dedo.skp', 'SKP', '0', '2020-10-10 20:19:18', 'j.araiza', '1602386358_dedo.skp', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\t3q01qk46i78duij1b03b6giuehp9t4i\\1602386358_dedo.skp');
INSERT INTO `sys_files_upload_tmp` VALUES ('72', null, 'dedo.stl', 'application/octet-stream', '0', '2020-10-10 20:19:18', 'j.araiza', '1602386358_dedo.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\t3q01qk46i78duij1b03b6giuehp9t4i\\1602386358_dedo.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('73', null, 'dedo2.stl', 'application/octet-stream', '0', '2020-10-10 20:19:19', 'j.araiza', '1602386359_dedo2.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\t3q01qk46i78duij1b03b6giuehp9t4i\\1602386359_dedo2.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('74', null, 'luna.stl', 'application/octet-stream', '0', '2020-10-10 20:19:19', 'j.araiza', '1602386359_luna.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\t3q01qk46i78duij1b03b6giuehp9t4i\\1602386359_luna.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('75', null, 'dedo.skp', 'SKP', '0', '2020-10-10 20:58:50', 'j.araiza', '1602388730_dedo.skp', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388730_dedo.skp');
INSERT INTO `sys_files_upload_tmp` VALUES ('76', null, 'dedo.skb', 'application/octet-stream', '0', '2020-10-10 20:58:50', 'j.araiza', '1602388730_dedo.skb', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388730_dedo.skb');
INSERT INTO `sys_files_upload_tmp` VALUES ('77', null, 'dedo.stl', 'application/octet-stream', '0', '2020-10-10 20:58:50', 'j.araiza', '1602388730_dedo.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388730_dedo.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('78', null, 'dedo2.stl', 'application/octet-stream', '0', '2020-10-10 20:58:50', 'j.araiza', '1602388730_dedo2.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388730_dedo2.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('79', null, 'dedo.skp', 'SKP', '0', '2020-10-10 20:59:06', 'j.araiza', '1602388746_dedo.skp', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388746_dedo.skp');
INSERT INTO `sys_files_upload_tmp` VALUES ('80', null, 'dedo.skb', 'application/octet-stream', '0', '2020-10-10 20:59:06', 'j.araiza', '1602388746_dedo.skb', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388746_dedo.skb');
INSERT INTO `sys_files_upload_tmp` VALUES ('81', null, 'dedo.stl', 'application/octet-stream', '0', '2020-10-10 20:59:06', 'j.araiza', '1602388746_dedo.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388746_dedo.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('82', null, 'dedo2.stl', 'application/octet-stream', '0', '2020-10-10 20:59:06', 'j.araiza', '1602388746_dedo2.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388746_dedo2.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('83', null, 'dedo.skp', 'SKP', '0', '2020-10-10 20:59:45', 'j.araiza', '1602388785_dedo.skp', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388785_dedo.skp');
INSERT INTO `sys_files_upload_tmp` VALUES ('84', null, 'dedo.skb', 'application/octet-stream', '0', '2020-10-10 20:59:45', 'j.araiza', '1602388785_dedo.skb', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388785_dedo.skb');
INSERT INTO `sys_files_upload_tmp` VALUES ('85', null, 'dedo.stl', 'application/octet-stream', '0', '2020-10-10 20:59:46', 'j.araiza', '1602388786_dedo.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388786_dedo.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('86', null, 'dedo2.stl', 'application/octet-stream', '0', '2020-10-10 20:59:46', 'j.araiza', '1602388786_dedo2.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602388786_dedo2.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('87', null, 'dedo.skb', 'application/octet-stream', '0', '2020-10-10 21:03:24', 'j.araiza', '1602389004_dedo.skb', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602389004_dedo.skb');
INSERT INTO `sys_files_upload_tmp` VALUES ('88', null, 'dedo.skp', 'SKP', '0', '2020-10-10 21:03:25', 'j.araiza', '1602389005_dedo.skp', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602389005_dedo.skp');
INSERT INTO `sys_files_upload_tmp` VALUES ('89', null, 'dedo.stl', 'application/octet-stream', '0', '2020-10-10 21:03:25', 'j.araiza', '1602389005_dedo.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602389005_dedo.stl');
INSERT INTO `sys_files_upload_tmp` VALUES ('90', null, 'dedo2.stl', 'application/octet-stream', '0', '2020-10-10 21:03:25', 'j.araiza', '1602389005_dedo2.stl', 'C:\\xampp\\htdocs\\LiteMES\\writable\\uploads\\s6smq0iicaj95860me3nfocutqvrufnq\\1602389005_dedo2.stl');

-- ----------------------------
-- Table structure for `testing`
-- ----------------------------
DROP TABLE IF EXISTS `testing`;
CREATE TABLE `testing` (
  `user_name` int(50) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of testing
-- ----------------------------
INSERT INTO `testing` VALUES ('1', 'Anna', 'Krox');
INSERT INTO `testing` VALUES ('2', 'Anna', 'Krox');
INSERT INTO `testing` VALUES ('3', 'Anna', 'Krox');
