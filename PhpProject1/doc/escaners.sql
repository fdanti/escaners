CREATE DATABASE `escaners` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `escaners`;
CREATE TABLE `respositori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipscan` varchar(15) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `observacions` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isGroup` bit(1) NOT NULL DEFAULT b'0',
  `ldapname` varchar(16) NOT NULL,
  `showname` varchar(32) DEFAULT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ldapname_UNIQUE` (`ldapname`,`isGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `respositori_has_rol` (
  `respositori_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`respositori_id`,`rol_id`),
  KEY `fk_respositori_has_rol_rol1_idx` (`rol_id`),
  KEY `fk_respositori_has_rol_respositori_idx` (`respositori_id`),
  CONSTRAINT `fk_respositori_has_rol_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_respositori_has_rol_respositori` FOREIGN KEY (`respositori_id`) REFERENCES `respositori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
