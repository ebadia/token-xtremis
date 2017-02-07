/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50634
 Source Host           : localhost
 Source Database       : ci-example

 Target Server Type    : MySQL
 Target Server Version : 50634
 File Encoding         : utf-8

 Date: 02/07/2017 12:33:53 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `clientes`
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) DEFAULT NULL,
  `apellidos` varchar(128) DEFAULT NULL,
  `sexo` varchar(8) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `movil` varchar(11) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `dni` varchar(11) DEFAULT NULL,
  `alta` date DEFAULT NULL,
  `iban` varchar(34) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `pin` int(6) DEFAULT NULL,
  `tarifa_id` int(11) DEFAULT NULL,
  `centre_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `clientes`
-- ----------------------------
BEGIN;
INSERT INTO `clientes` VALUES ('1', 'David', 'Guetta', 'H', '1970-01-05', 'enric@ideatius.com', '601007366', null, '', '2016-03-27', '', '1', 'ebadia55', '123123', '8', null), ('2', 'Maria', 'Gargallo', 'M', '1967-10-27', 'mariagargallo@hotmail.com', '667578874', null, '', '2016-03-27', '', null, 'salvador00', '123456', null, null), ('3', 'Ana', 'Sobrino', 'M', '0000-00-00', 'director.calallonga@palladiumhotelgroup.com', '609627316', null, null, '2016-04-05', null, null, '', '0', '6', null), ('4', 'Jorge', 'Juan Nieto', 'H', '0000-00-00', 'jorgejuannieto@hotmail.com', '691827435', null, null, '2016-04-05', null, null, '', '0', '1', null), ('5', 'Ana', 'Bigas', 'M', '0000-00-00', '', '', null, '', '2016-04-05', '', null, '', '0', '1', null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
