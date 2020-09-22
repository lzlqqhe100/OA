/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 80018
Source Host           : localhost:3306
Source Database       : oa_db

Target Server Type    : MYSQL
Target Server Version : 80018
File Encoding         : 65001

Date: 2020-09-22 08:05:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for oa_admin
-- ----------------------------
DROP TABLE IF EXISTS `oa_admin`;
CREATE TABLE `oa_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '用户名',
  `password` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '密码',
  `sex` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '性别',
  `age` int(4) DEFAULT NULL COMMENT '年龄',
  `nation` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '民族',
  `company` varchar(50) DEFAULT NULL COMMENT '单位',
  `depart` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '部门',
  `position` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '职位',
  `outlook` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '政治面貌',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '手机',
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oa_admin
-- ----------------------------
INSERT INTO `oa_admin` VALUES ('5', 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '男', '18', '汉族', 'nicai', 'nicai', '1', '团员', '110', '110@qq.com');
INSERT INTO `oa_admin` VALUES ('6', 'admin1', 'c3284d0f94606de1fd2af172aba15bf3', '男', '123', '汉族', '123', '123', '2', '团员', '123', '123@qq.com');

-- ----------------------------
-- Table structure for oa_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `oa_auth_group`;
CREATE TABLE `oa_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `rules` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id， 多个规则","隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oa_auth_group
-- ----------------------------
INSERT INTO `oa_auth_group` VALUES ('1', '超级管理员', '1', '');
INSERT INTO `oa_auth_group` VALUES ('2', '管理员', '1', '1');

-- ----------------------------
-- Table structure for oa_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `oa_auth_group_access`;
CREATE TABLE `oa_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oa_auth_group_access
-- ----------------------------
INSERT INTO `oa_auth_group_access` VALUES ('5', '1');
INSERT INTO `oa_auth_group_access` VALUES ('6', '2');

-- ----------------------------
-- Table structure for oa_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `oa_auth_rule`;
CREATE TABLE `oa_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `condition` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oa_auth_rule
-- ----------------------------
INSERT INTO `oa_auth_rule` VALUES ('1', 'admin/Mymes/index', '个人信息维护', '1', '1', '');
INSERT INTO `oa_auth_rule` VALUES ('2', 'admin/Admin/index', '管理员管理', '1', '1', '');
INSERT INTO `oa_auth_rule` VALUES ('3', 'admin/AuthGroup/index', '管理员权限组', '1', '1', '');
INSERT INTO `oa_auth_rule` VALUES ('4', 'admin/AuthRule/index', '管理员规则', '1', '1', '');

-- ----------------------------
-- Table structure for oa_book01
-- ----------------------------
DROP TABLE IF EXISTS `oa_book01`;
CREATE TABLE `oa_book01` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `lei` varchar(200) NOT NULL COMMENT '右上角XX类',
  `hao` int(200) NOT NULL COMMENT '右上角XX号',
  `ti_jie` varchar(255) DEFAULT NULL COMMENT 'XX届',
  `ti_ci` int(65) DEFAULT NULL COMMENT 'XX次',
  `ti_hao` int(65) DEFAULT NULL COMMENT 'XX号',
  `tian_type` enum('3','2','1') DEFAULT '1' COMMENT '提案类型',
  `tian_anyou` varchar(255) DEFAULT NULL COMMENT '案由',
  `tian_ren` varchar(10) DEFAULT NULL COMMENT '第一提案人',
  `tian_ming` varchar(255) DEFAULT NULL COMMENT '名次',
  `tian_dang` varchar(20) DEFAULT NULL COMMENT '党派',
  `tian_zheng` int(65) DEFAULT NULL COMMENT '委员证号',
  `tian_youzheng` varchar(255) DEFAULT NULL COMMENT '邮政编号',
  `tian_phone` int(65) DEFAULT NULL COMMENT '联系电话',
  `tian_dan` varchar(50) DEFAULT NULL COMMENT '单位及职务',
  `tian_mail` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `tian_dizhi` varchar(100) DEFAULT '' COMMENT '通讯地址',
  `tian_wenjian` varchar(255) DEFAULT NULL COMMENT '主题词文件',
  `tian_content` varchar(255) DEFAULT NULL COMMENT '提案内容',
  `tian_fujian` varchar(255) DEFAULT NULL COMMENT '附件',
  `tian_posttime` datetime(6) DEFAULT NULL COMMENT '提交时间',
  `tian_xiang` enum('2','1') DEFAULT '1' COMMENT '相关情况',
  `lian_ming` varchar(255) DEFAULT NULL COMMENT '提案联系人姓名',
  `lian_dan` varchar(255) DEFAULT NULL COMMENT '提案联系人单位',
  `lian_ren` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='插件表';

-- ----------------------------
-- Records of oa_book01
-- ----------------------------
