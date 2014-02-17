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

CREATE TABLE `permisos` (
  `respositori_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`respositori_id`,`rol_id`),
  KEY `fk_permisos_rol1_idx` (`rol_id`),
  KEY `fk_permisos_respositori_idx` (`respositori_id`),
  CONSTRAINT `fk_permisos_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_permisos_respositori` FOREIGN KEY (`respositori_id`) REFERENCES `respositori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Afegit per fdanti el 17/2/14 per desar les dades de fitxers */
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `idRepo` int(11) NOT NULL,
  `creationDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_files_repositori` FOREIGN KEY (`idRepo`) REFERENCES `repositori` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;