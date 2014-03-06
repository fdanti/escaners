<?php

/* 
 * Contindrà les constants del Projecte
 */
class CTGlobals { 
    
    
}

/*
 * Constants (ctt) de la taula permisos
 */
class CTPermisos {  
    const NAME_TABLE        = "permisos"; //Nom de la Taula de Permisos
    const NAME_COL_IDREPO   = "repositori_id";     //Columna idRepo
    const NAME_COL_IDROL    = "rol_id";      //Columna idRol
}

/*
 * Constants (ctt) de la taula rols
 */
class CTRols {
    const NAME_TABLE        = "rol";       //Nom de la Taula de Rols
    const NAME_COL_ID    = "idRol";         //Columna idRol
    const NAME_COL_ISGROUP  = "isGroup";
    const NAME_COL_LDAPNAME = "ldapname";
    const NAME_COL_SHOWNAME = "showname";
    const NAME_COL_ISADMIN  = "isAdmin";
}

/*
 * Constants (ctt) de la taula rolsFtp
 */
class CTRolsFtp {
    const NAME_TABLE        = "rolftp";       //Nom de la Taula de RolsFTP
    const NAME_COL_ID       = "Uid";
    const NAME_COL_USER     = "User";
    const NAME_COL_PASSWORD = "Password";
    const NAME_COL_STATUS   = "status";
    const NAME_COL_GID      = "Gid";
    const NAME_COL_DIR      = "Dir";
    const NAME_COL_ULBANDWIDTH  = "ULBandwidth";
    const NAME_COL_DLBANDWIDTH  = "DLBandwidth";
    const NAME_COL_COMMENT      = "comment";
    const NAME_COL_IPACCESS     = "ipaccess";
    const NAME_COL_QUOTASIZE    = "QuotaSize";
    const NAME_COL_QUOTAFILES   = "QuotaFiles";
}

/*
 * Constants (ctt) de la taula Repositoris
 */
class CTRepos {
    const NAME_TABLE        = "repositori"; //Nom de la Taula de Repositoris
    const NAME_COL_ID       = "idRepo";
    const NAME_COL_PSW      = "password";
    const NAME_COL_IPSCAN   = "ipscan";
    const NAME_COL_NOM      = "nom";
    const NAME_COL_NOTES    = "observacions";
}

/*
 * Constants (ctt) de la taula fitxers
 */
class CTFile {
    const NAME_TABLE        = "files";      //Nom taula de fitxers
    const NAME_COL_ID       = "id";
    const NAME_COL_NAME     = "name";
    const NAME_COL_IDREPO   = "idRepo";
    const NAME_COL_DATE     = "creationDate";
}
