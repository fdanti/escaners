<?php
//// -----------------------------
//      DATABASE CONFIGURATION
// -----------------------------
class ConfigDB {
     const HOST     = "localhost";
     const DB       = "escaners";
     const USER     = "user1";
     const PWD      = "secret";
     const CHARSET  = "utf8";
}
class ConfigFS {
    const PATH      = "/serveis/ftp/data/";             //PATH a l'arrel dels escanejos
    const SCRIPT_FTP        =  "/serveis/ftp/createFTP.sh"; //Script que genera les carpetes amb els permisos adequats
    const SCRIPT_FIREWALL   = "/serveis/ftp/iptablesFTP.sh";//Script que fa la excepció al firewall per les IP de la taula
}
?>