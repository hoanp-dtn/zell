/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50521
Source Host           : localhost:3306
Source Database       : utt

Target Server Type    : MYSQL
Target Server Version : 50521
File Encoding         : 65001

Date: 2015-11-22 21:39:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `utt_examiner`
-- ----------------------------
DROP TABLE IF EXISTS `utt_examiner`;
CREATE TABLE `utt_examiner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_code` varchar(15) DEFAULT NULL,
  `course_code` varchar(15) DEFAULT NULL,
  `subject_name` text,
  `exam_form` int(2) DEFAULT '1' COMMENT '1: Viết\r\n2: Thực hành\r\n3: Vấn đáp',
  `time` int(11) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `day_assignment` date DEFAULT NULL,
  `expected_return_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `del_flg` int(11) NOT NULL DEFAULT '0',
  `user_update` int(11) DEFAULT NULL,
  `user_del` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
