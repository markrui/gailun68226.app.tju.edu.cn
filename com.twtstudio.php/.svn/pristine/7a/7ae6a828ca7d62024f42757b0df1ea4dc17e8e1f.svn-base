SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `twt_authmap`
-- ----------------------------
DROP TABLE IF EXISTS `twt_authmap`;
CREATE TABLE `twt_authmap` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `ownertype` char(10) NOT NULL,
  `ownerid` bigint(20) NOT NULL,
  `domain` char(25) NOT NULL,
  `did` int(11) NOT NULL,
  `auth` char(25) NOT NULL,
  `grantby` bigint(20) NOT NULL,
  `grantat` datetime NOT NULL,
  `level` tinyint(4) NOT NULL,
  `iscancel` int(11) NOT NULL,
  PRIMARY KEY (`aid`),
  UNIQUE KEY `mkey` (`ownertype`,`ownerid`,`domain`,`did`,`auth`),
  KEY `owner` (`ownertype`,`ownerid`),
  KEY `domain` (`domain`,`did`),
  KEY `auth` (`auth`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of twt_authmap
-- ----------------------------
INSERT INTO `twt_authmap` VALUES ('1', 'user', '83607', 'manage', '0', 'ADMIN', '83607', '2012-11-22 21:14:21', '1', '0');
INSERT INTO `twt_authmap` VALUES ('2', 'user', '83607', 'manage', '0', 'ADMIN_AUTH', '83607', '2012-11-25 16:16:17', '1', '0');
INSERT INTO `twt_authmap` VALUES ('3', 'user', '83607', 'manage', '0', 'ADMIN_METHOD1', '83607', '2012-11-25 16:16:17', '1', '0');

-- ----------------------------
-- Table structure for `twt_news`
-- ----------------------------
DROP TABLE IF EXISTS `twt_news`;
CREATE TABLE `twt_news` (
  `index` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject` char(255) NOT NULL,
  `content` text NOT NULL,
  `istop` tinyint(4) NOT NULL,
  `isdelete` tinyint(4) NOT NULL,
  `ishide` tinyint(4) NOT NULL,
  `addat` datetime NOT NULL,
  `addby` bigint(20) NOT NULL,
  `addbyname` char(100) NOT NULL,
  `visitcount` bigint(20) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of twt_news
-- ----------------------------
INSERT INTO `twt_news` VALUES ('1', '测试新闻1', '  人山人海！', '0', '0', '0', '2012-11-29 23:59:03', '83607', '天外天新闻中心', '0');
INSERT INTO `twt_news` VALUES ('2', '测试新闻2', '<p style=\"text-align: center\">\r\n  <img alt=\"\" src=\"/fqfh2/upload/Image/3(30).jpg\"></p>', '0', '0', '0', '2012-11-29 23:59:03', '83607', '天外天新闻中心', '0');
INSERT INTO `twt_news` VALUES ('3', '测试新闻3', '2013届毕业生大型双选会的现场绝对可以用人满为患来形容。应届毕业生们拿着自己的简历，夹杂在拥挤的人流中，不停地寻找着自己心仪的企业，而在场外还未入场的同学们则从新体育馆西门一直延伸到了体育场门前，这让错估现场“形势”而晚到的同学懊恼不已。', '0', '0', '0', '2012-11-29 23:59:03', '83607', '天外天新闻中心', '0');
INSERT INTO `twt_news` VALUES ('4', '测试新闻4', '2013届毕业生大型双选会的现场绝对可以用人满为患来形容。应届毕业生们拿着自己的简历，夹杂在拥挤的人流中，不停地寻找着自己心仪的企业，而在场外还未入场的同学们则从新体育馆西门一直延伸到了体育场门前，这让错估现场“形势”而晚到的同学懊恼不已。', '0', '0', '0', '2012-11-29 23:59:03', '83607', '天外天新闻中心', '0');
INSERT INTO `twt_news` VALUES ('5', '测试新闻5', '  人山人海！', '0', '0', '0', '2012-11-29 23:59:03', '83607', '天外天新闻中心', '0');
INSERT INTO `twt_news` VALUES ('6', '新增新闻1', '<h3 style=\"margin: 10px 0px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-weight: bold; line-height: 40px; text-rendering: optimizelegibility; font-size: 24.5px;\">Dismiss buttons</h3>\r\n\r\n<p style=\"margin: 0px 0px 10px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\">Mobile Safari and Mobile Opera browsers, in addition to the&nbsp;<code style=\"padding: 2px 4px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 12px; color: rgb(221, 17, 68); border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232);\">data-dismiss=&quot;alert&quot;</code>&nbsp;attribute, require an&nbsp;<code style=\"padding: 2px 4px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 12px; color: rgb(221, 17, 68); border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232);\">href=&quot;#&quot;</code>&nbsp;for the dismissal of alerts when using an&nbsp;<code style=\"padding: 2px 4px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 12px; color: rgb(221, 17, 68); border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232);\">&lt;a&gt;</code>&nbsp;tag.</p>\r\n\r\n<pre class=\"prettyprint linenums\" style=\"padding: 8px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 13px; border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px; margin-top: 0px; margin-bottom: 20px; line-height: 20px; word-break: break-all; word-wrap: break-word; white-space: pre-wrap; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232); -webkit-box-shadow: rgb(251, 251, 252) 40px 0px 0px inset, rgb(236, 236, 240) 41px 0px 0px inset; box-shadow: rgb(251, 251, 252) 40px 0px 0px inset, rgb(236, 236, 240) 41px 0px 0px inset;\">\r\n\r\n&nbsp;</pre>\r\n\r\n<ol class=\"linenums\" style=\"padding-right: 0px; padding-left: 0px; margin: 0px 0px 0px 33px;\">\r\n  <li class=\"L0\" style=\"padding-left: 12px; color: rgb(190, 190, 197); text-shadow: rgb(255, 255, 255) 0px 1px 0px;\"><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&lt;a</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\"> </span><span class=\"atn\" style=\"color: teal;\">href</span><span class=\"pun\" style=\"color: rgb(147, 161, 161);\">=</span><span class=\"atv\" style=\"color: rgb(221, 17, 68);\">&quot;#&quot;</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\"> </span><span class=\"atn\" style=\"color: teal;\">class</span><span class=\"pun\" style=\"color: rgb(147, 161, 161);\">=</span><span class=\"atv\" style=\"color: rgb(221, 17, 68);\">&quot;close&quot;</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\"> </span><span class=\"atn\" style=\"color: teal;\">data-dismiss</span><span class=\"pun\" style=\"color: rgb(147, 161, 161);\">=</span><span class=\"atv\" style=\"color: rgb(221, 17, 68);\">&quot;alert&quot;</span><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&gt;</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\">&times;</span><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&lt;/a&gt;</span></li>\r\n</ol>\r\n\r\n<p style=\"margin: 0px 0px 10px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\">Alternatively, you may use a&nbsp;<code style=\"padding: 2px 4px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 12px; color: rgb(221, 17, 68); border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232);\">&lt;button&gt;</code>&nbsp;element with the data attribute, which we have opted to do for our docs. When using&nbsp;<code style=\"padding: 2px 4px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 12px; color: rgb(221, 17, 68); border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232);\">&lt;button&gt;</code>, you must include&nbsp;<code style=\"padding: 2px 4px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 12px; color: rgb(221, 17, 68); border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232);\">type=&quot;button&quot;</code>&nbsp;or your forms may not submit.</p>\r\n\r\n<pre class=\"prettyprint linenums\" style=\"padding: 8px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 13px; border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px; margin-top: 0px; margin-bottom: 20px; line-height: 20px; word-break: break-all; word-wrap: break-word; white-space: pre-wrap; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232); -webkit-box-shadow: rgb(251, 251, 252) 40px 0px 0px inset, rgb(236, 236, 240) 41px 0px 0px inset; box-shadow: rgb(251, 251, 252) 40px 0px 0px inset, rgb(236, 236, 240) 41px 0px 0px inset;\">\r\n\r\n&nbsp;</pre>\r\n\r\n<ol class=\"linenums\" style=\"padding-right: 0px; padding-left: 0px; margin: 0px 0px 0px 33px;\">\r\n  <li class=\"L0\" style=\"padding-left: 12px; color: rgb(190, 190, 197); text-shadow: rgb(255, 255, 255) 0px 1px 0px;\"><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&lt;button</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\"> </span><span class=\"atn\" style=\"color: teal;\">type</span><span class=\"pun\" style=\"color: rgb(147, 161, 161);\">=</span><span class=\"atv\" style=\"color: rgb(221, 17, 68);\">&quot;button&quot;</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\"> </span><span class=\"atn\" style=\"color: teal;\">class</span><span class=\"pun\" style=\"color: rgb(147, 161, 161);\">=</span><span class=\"atv\" style=\"color: rgb(221, 17, 68);\">&quot;close&quot;</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\"> </span><span class=\"atn\" style=\"color: teal;\">data-dismiss</span><span class=\"pun\" style=\"color: rgb(147, 161, 161);\">=</span><span class=\"atv\" style=\"color: rgb(221, 17, 68);\">&quot;alert&quot;</span><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&gt;</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\">&times;</span><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&lt;/button&gt;</span></li>\r\n</ol>', '1', '0', '0', '0000-00-00 00:00:00', '83607', '', '0');
INSERT INTO `twt_news` VALUES ('7', '编辑新闻1', '<section id=\"typography\" style=\"padding-top: 30px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\">\r\n<h2 style=\"margin: 10px 0px; font-family: inherit; font-weight: bold; line-height: 40px; color: inherit; text-rendering: optimizelegibility; font-size: 31.5px;\">Page header</h2>\r\n\r\n<p style=\"margin: 0px 0px 10px;\">A simple shell for an&nbsp;<code style=\"padding: 2px 4px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 12px; color: rgb(221, 17, 68); border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232);\">h1</code>&nbsp;to appropriately space out and segment sections of content on a page. It can utilize the&nbsp;<code style=\"padding: 2px 4px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 12px; color: rgb(221, 17, 68); border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232);\">h1</code>&#39;s default&nbsp;<code style=\"padding: 2px 4px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 12px; color: rgb(221, 17, 68); border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232);\">small</code>, element as well most other components (with additional styles).</p>\r\n\r\n<div class=\"bs-docs-example\" style=\"position: relative; margin: 15px 0px; padding: 39px 19px 14px; border: 1px solid rgb(221, 221, 221); border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px;\">\r\n<div class=\"page-header\" style=\"padding-bottom: 9px; margin: 20px 0px 30px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238);\">\r\n<h1 style=\"margin: 10px 0px; font-family: inherit; font-weight: bold; line-height: 40px; color: inherit; text-rendering: optimizelegibility; font-size: 38.5px;\">Example page header&nbsp;<small style=\"font-size: 24.5px; font-weight: normal; line-height: 1; color: rgb(153, 153, 153);\">Subtext for header</small></h1>\r\n</div>\r\n</div>\r\n\r\n<pre class=\"prettyprint linenums\" style=\"padding: 15px 8px 8px; font-family: Monaco, Menlo, Consolas, \'Courier New\', monospace; font-size: 13px; border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px; margin-top: -20px; margin-bottom: 20px; word-break: break-all; word-wrap: break-word; white-space: pre-wrap; background-color: rgb(247, 247, 249); border: 1px solid rgb(225, 225, 232); -webkit-box-shadow: rgb(251, 251, 252) 40px 0px 0px inset, rgb(236, 236, 240) 41px 0px 0px inset; box-shadow: rgb(251, 251, 252) 40px 0px 0px inset, rgb(236, 236, 240) 41px 0px 0px inset;\">\r\n\r\n&nbsp;</pre>\r\n\r\n<ol class=\"linenums\" style=\"padding-right: 0px; padding-left: 0px; margin: 0px 0px 0px 33px;\">\r\n <li class=\"L0\" style=\"padding-left: 12px; color: rgb(190, 190, 197); text-shadow: rgb(255, 255, 255) 0px 1px 0px;\"><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&lt;div</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\"> </span><span class=\"atn\" style=\"color: teal;\">class</span><span class=\"pun\" style=\"color: rgb(147, 161, 161);\">=</span><span class=\"atv\" style=\"color: rgb(221, 17, 68);\">&quot;page-header&quot;</span><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&gt;</span></li>\r\n  <li class=\"L1\" style=\"padding-left: 12px; color: rgb(190, 190, 197); text-shadow: rgb(255, 255, 255) 0px 1px 0px;\"><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&lt;h1&gt;</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\">Example page header </span><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&lt;small&gt;</span><span class=\"pln\" style=\"color: rgb(72, 72, 76);\">Subtext for header</span><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&lt;/small&gt;&lt;/h1&gt;</span></li>\r\n  <li class=\"L2\" style=\"padding-left: 12px; color: rgb(190, 190, 197); text-shadow: rgb(255, 255, 255) 0px 1px 0px;\"><span class=\"tag\" style=\"color: rgb(30, 52, 123);\">&lt;/div&gt;</span></li>\r\n</ol>\r\n</section>\r\n\r\n<section id=\"thumbnails\" style=\"padding-top: 30px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;\">\r\n<div class=\"page-header\" style=\"padding-bottom: 9px; margin: 20px 0px 30px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238); color: rgb(90, 90, 90);\">\r\n<h1 style=\"margin: 10px 0px; font-family: inherit; font-weight: bold; line-height: 40px; color: inherit; text-rendering: optimizelegibility; font-size: 38.5px;\">Thumbnails&nbsp;<small style=\"font-size: 24.5px; font-weight: normal; line-height: 1; color: rgb(153, 153, 153);\">Grids of images, videos, text, and more</small></h1>\r\n</div>\r\n</section>', '1', '0', '0', '0000-00-00 00:00:00', '83607', 'bootstrap doc', '0');

-- ----------------------------
-- Table structure for `twt_user`
-- ----------------------------
DROP TABLE IF EXISTS `twt_user`;
CREATE TABLE `twt_user` (
  `uid` int(11) NOT NULL,
  `type` char(25) NOT NULL,
  `username` char(50) NOT NULL,
  `realname` char(20) NOT NULL,
  `password` char(50) DEFAULT NULL,
  `salt` char(25) DEFAULT NULL,
  `isforbidden` int(11) NOT NULL,
  `gid` int(11) DEFAULT NULL,
  `loginat` datetime NOT NULL,
  `loginip` char(25) NOT NULL,
  `session` char(25) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of twt_user
-- ----------------------------
INSERT INTO `twt_user` VALUES ('83607', 'twt', 'ororal123', '陈章磊', null, null, '0', null, '2012-11-07 21:56:15', '::1', null);
