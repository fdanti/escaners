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
  `isGroup` tinyint NOT NULL DEFAULT 0,
  `ldapname` varchar(16) NOT NULL,
  `showname` varchar(32) DEFAULT NULL,
  `isAdmin` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`idRol`),
  UNIQUE KEY `ldapname_UNIQUE` (`ldapname`,`isGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `permisos` (
  `repositori_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`repositori_id`,`rol_id`),
  KEY `fk_permisos_rol1_idx` (`rol_id`),
  KEY `fk_permisos_repositori_idx` (`repositori_id`),
  CONSTRAINT `fk_permisos_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_permisos_repositori` FOREIGN KEY (`repositori_id`) REFERENCES `repositori` (`idRepo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Comentat per fdanti el 25/2/14. De moment no es desen les les dades de fitxers en DB*/
/* CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `idRepo` int(11) NOT NULL,
  `creationDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_files_repositori` FOREIGN KEY (`idRepo`) REFERENCES `repositori` (`idRepo`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

/* Afegit per avilalta el 20/2/14. Altero una taula ja creada. En un futur es pot fer un merge amb la creació i no haver de fer l'alter*/
/*ALTER TABLE `escaners`.`permisos` 
DROP FOREIGN KEY `fk_permisos_repositori`;
ALTER TABLE `escaners`.`permisos` 
ADD CONSTRAINT `fk_permisos_repositori`
  FOREIGN KEY (`repositori_id`)
  REFERENCES `escaners`.`repositori` (`idRepo`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;*/

/* Afegit per fdanti el 25/2/14. Taula que contindrà les dades dels usuaris FTP per pureftp-mysql*/
/*
  CREATE TABLE rolftp (
  `Uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `User` varchar(16) NOT NULL default '',
  `Password` varchar(64) NOT NULL default '',
  `status` enum('0','1') NOT NULL default '1',
  `Gid` varchar(11) NOT NULL default '100',
  `Dir` varchar(128) NOT NULL default '',
  `ULBandwidth` smallint(5) NOT NULL default '500',
  `DLBandwidth` smallint(5) NOT NULL default '500',
  `comment` tinytext,
  `ipaccess` varchar(15) NOT NULL default '161.116.0.0/16',
  `QuotaSize` smallint(5) NOT NULL default '1000',
  `QuotaFiles` int(11) NOT NULL default '1000',
  PRIMARY KEY (Uid),
  UNIQUE KEY Uid (Uid)
  );  
  ALTER TABLE rolftp AUTO_INCREMENT = 2000;
*/

/*Afegit per avilalta el 28/02/2014. Afegeixo camp password al repositori i faig les relacions entre els rols ftp i els repositoris*/
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `escaners`.`repositori` 
CHANGE COLUMN `nom` `nom` VARCHAR(16) NOT NULL ,
ADD COLUMN `password` VARCHAR(64) NOT NULL AFTER `observacions`,
ADD INDEX `nom` (`nom` ASC),
ADD INDEX `password` (`password` ASC);

ALTER TABLE `escaners`.`rolftp` 
ADD INDEX `Password` (`Password` ASC);

ALTER TABLE rolftp
ADD FOREIGN KEY (Password)
REFERENCES repositori(password);

ALTER TABLE rolftp
ADD FOREIGN KEY (User)
REFERENCES repositori(nom);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



