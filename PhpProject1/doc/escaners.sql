CREATE DATABASE `escaners` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `escaners`;
CREATE TABLE `repositori` (
  `idRepo` int(11) NOT NULL AUTO_INCREMENT,
  `ipscan` varchar(15) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `observacions` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`idRepo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `isGroup` bit(1) NOT NULL DEFAULT b'0',
  `ldapname` varchar(16) NOT NULL,
  `showname` varchar(32) DEFAULT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`idRol`),
  UNIQUE KEY `ldapname_UNIQUE` (`ldapname`,`isGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `permisos` (
  `repositori_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`repositori_id`,`rol_id`),
  KEY `fk_permisos_rol1_idx` (`rol_id`),
  KEY `fk_permisos_repositori_idx` (`repositori_id`),
  CONSTRAINT `fk_permisos_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_permisos_repositori` FOREIGN KEY (`repositori_id`) REFERENCES `repositori` (`idRepo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Afegit per fdanti el 17/2/14 per desar les dades de fitxers */
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `idRepo` int(11) NOT NULL,
  `creationDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_files_repositori` FOREIGN KEY (`idRepo`) REFERENCES `repositori` (`idRepo`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;