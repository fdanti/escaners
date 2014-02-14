<?php

/* 
 * Contindrà les dades de DB, tipus de DB, etc.
 *  Exemple en: http://www.achievo.org/wiki/Achievo/Manual/Installation/Configuration/config.inc.php
 */

//NOTA: constants accessibles via Constants::HOST

// -----------------------------
//      DATABASE CONFIGURATION
// -----------------------------
$config_db["HOST"]      = "localhost";
$config_db["DB"]        = "escaners";
$config_db["USER"]      = "user1";
$config_db["PWD"]       = "secret";
$config_db["CHARSET"]   = "utf8";

// -----------------------------
//    FILE CONFIGURATION
// -----------------------------
$config_fs["PATH"]      = "/tmp/escaners/"; //PATH a l'arrel dels escanejos
$config_fs["DEL_TIME"]  = "30";             //Minuts que es guardarà un fitxer al FS
