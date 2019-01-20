/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : eng

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 20/01/2019 20:18:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for block
-- ----------------------------
DROP TABLE IF EXISTS `block`;
CREATE TABLE `block`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of block
-- ----------------------------
INSERT INTO `block` VALUES (1, 'first_block', 0);
INSERT INTO `block` VALUES (2, 'second_block', 0);
INSERT INTO `block` VALUES (3, 'third_block', 0);

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rus` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `eng` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT NULL,
  `block_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 272 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES (171, 'много', 'much', 1, 1);
INSERT INTO `item` VALUES (172, 'поощрять / воодушевлять', 'encourage', 1, 1);
INSERT INTO `item` VALUES (173, 'порядочный', 'decent', 1, 1);
INSERT INTO `item` VALUES (174, 'живая природа', 'wildlife', 0, 1);
INSERT INTO `item` VALUES (175, 'в целом', 'overall', 0, 1);
INSERT INTO `item` VALUES (176, 'что-то / нечто', 'something', 1, 2);
INSERT INTO `item` VALUES (177, 'упомянутый', 'mentioned', 1, 2);
INSERT INTO `item` VALUES (178, 'окруженный', 'surrounded', 0, 2);
INSERT INTO `item` VALUES (179, 'определенный', 'certain', 0, 2);
INSERT INTO `item` VALUES (180, 'кто-нибудь', 'anyone', 0, 2);
INSERT INTO `item` VALUES (181, 'иногда / время от времени', 'occasionally', 1, 2);
INSERT INTO `item` VALUES (182, 'очевидно', 'obviosly', 1, 2);
INSERT INTO `item` VALUES (183, 'график', 'schedule', 0, 2);
INSERT INTO `item` VALUES (185, 'как угодно', 'like anything', 0, 2);
INSERT INTO `item` VALUES (186, 'должен попробовать', 'should try out', 0, 3);
INSERT INTO `item` VALUES (187, 'возможность', 'opportinutie', 0, 3);
INSERT INTO `item` VALUES (188, 'свежий', 'fiest', 0, 3);
INSERT INTO `item` VALUES (189, 'вкусные', 'delecious', 0, 3);
INSERT INTO `item` VALUES (190, 'прямо', 'straight', 0, 3);
INSERT INTO `item` VALUES (191, 'особенно', 'especially', 0, 3);
INSERT INTO `item` VALUES (192, 'узнать', 'learn', 0, 3);
INSERT INTO `item` VALUES (193, 'независимо от того', 'no metter', 0, 3);
INSERT INTO `item` VALUES (194, 'приблизительно', 'roughly', 0, 3);
INSERT INTO `item` VALUES (195, 'обычно / вообщем-то', 'generaly', 0, 3);
INSERT INTO `item` VALUES (196, 'письменный стол', 'desk', 0, 3);
INSERT INTO `item` VALUES (197, 'кто-нибудь / любой', 'anyone', 0, 3);
INSERT INTO `item` VALUES (198, 'имеет значение', 'metter', 0, 3);

SET FOREIGN_KEY_CHECKS = 1;