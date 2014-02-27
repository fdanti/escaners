<?php

/* 
 * inclourà els includes bàsics per tots els PHP del projecte
 */

require_once 'lib/Constants.php';

//require_once 'lib/dao/FilesDAO.php';
require_once 'lib/dao/PermisosDAO.php';
require_once 'lib/dao/RepositorisDAO.php';
require_once 'lib/dao/RolsDAO.php';
require_once 'lib/logic/EscanersLogic.php';
//require_once 'lib/model/File.php';
require_once 'lib/model/Permis.php';
require_once 'lib/model/Repositori.php';
require_once 'lib/model/Rol.php';


/* 
 * Contindrà les dades de DB, tipus de DB, etc.
 *  Exemple en: http://www.achievo.org/wiki/Achievo/Manual/Installation/Configuration/config.inc.php
 */

// -----------------------------
//      DATABASE CONFIGURATION
// -----------------------------
class ConfigDB {
     const HOST     = "localhost";
     const DB       = "escaners";
     const USER     = "user1";
     const PWD      = "secret";
     const CHARSET  = "utf8";
}


// -----------------------------
//    FILE CONFIGURATION
// -----------------------------
class ConfigFS {
    const PATH      = "/serveis/ftp/data/";             //PATH a l'arrel dels escanejos
    const SCRIPT_FTP    =  "/serveis/ftp/createFTP.sh"; //TODO: crear aquest script
}

?>