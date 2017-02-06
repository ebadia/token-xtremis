/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50634
 Source Host           : localhost
 Source Database       : api_auth

 Target Server Type    : MySQL
 Target Server Version : 50634
 File Encoding         : utf-8

 Date: 02/06/2017 21:00:06 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'e@e.com', 'sha256:1024:Nes09mNQ/R+C4LCPvn8rwQbiLlZcrhwb:xC9m2YCsWI6FjQqrUNgXmjoTUhPMRRrJ', 'Enric', 'Badia'), ('7', 'a@a.com', 'sha256:1024:Lhg2UFxyojLLvTgJg1W/1kg73g+fST7k:S/gyr/PDrpB2VUEZ7B2zIBhHS+tEuz1M', 'aa', 'bb'), ('10', 'a@a.com', 'sha256:1024:JjmWiL2g5w2P+4LPdh/C/hPz6A7Jcg4c:uP1LcWZCEpgmXxZE8z9f/Mp7kkClUfbA', null, null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
