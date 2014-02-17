<?php

/* 
 * Contindrà les constants del Projecte
 */
class OtherConstants {
    
}

/*
 * Constants (ctt) de la taula permisos
 */
class CTPermisos {  
    const NAME_TABLE        = "permisos"; //Nom de la Taula de Permisos
    const NAME_COL_IDREPO   = "idRepo";     //Columna idRepo
    const NAME_COL_IDROL    = "idRol";      //Columna idRol
}

/*
 * Constants (ctt) de la taula rols
 */
class CTRols {
    const NAME_TABLE        = "rols";       //Nom de la Taula de Rols
    const NAME_COL_ID    = "id";         //Columna idRol
    const NAME_COL_ISGROUP  = "isGroup";
    const NAME_COL_LDAPNAME = "ldapname";
    const NAME_COL_SHOWNAME = "showname";
    const NAME_COL_ISADMIN  = "isAdmin";
}

/*
 * Constants (ctt) de la taula Repositoris
 */
class CTRepos {
    const NAME_TABLE        = "repositoris"; //Nom de la Taula de Repositoris
    const NAME_COL_ID       = "id";
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
