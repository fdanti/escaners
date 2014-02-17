<?php

/* 
 * inclourà els includes bàsics per tots els PHP del projecte
 */

require_once 'config.inc.php';
require_once 'Constants.php';

require_once 'dao/*.php';
require_once 'logic/*.php';
require_once 'model/*.php';


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
    const PATH      = "/tmp/escaners/"; //PATH a l'arrel dels escanejos
    const DEL_TIME  = "600";             //Segons que es guardarà un fitxer al FS
}

?>