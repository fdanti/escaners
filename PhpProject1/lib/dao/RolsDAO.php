<?php

/**
 * DAO de la taula rols
 *
 * @author fdanti
 */
class RolsDAO {
    protected $conn;
    protected $db;
    
    /* Constructor. Crea la connexió */
    public function __construct() {
        //TODO: connexió persistent o no? Estudiar-ho
        $this->conn = mysql_connect(ConfigDB::HOST, ConfigDB::USER,
               ConfigDB::PWD, ConfigDB::DB );
        $this->db = mysql_select_db(ConfigDB::DB);
   }

    /* Executa la SQLquery i retorna un array associatiu amb els resultats */
    protected function execute($sql) {
       $result = mysql_query($sql, $this->conn) 
               or die (mysql_error());
       
       return $result;
   }
   
    /*
     * Donat un objecte de tipus Rol, l'afegeix a la taula corresponent de la DB
     */
    public function save(&$vo) {
        /* Generem la query usant constants */
        $sql = "INSERT INTO ".CTRols::NAME_TABLE.
            " (".CTRols::NAME_COL_LDAPNAME.", ".
                CTRols::NAME_COL_SHOWNAME.", ".
                CTRols::NAME_COL_ISADMIN.", ".
                CTRols::NAME_COL_ISGROUP.")".
            " VALUES (\"".$vo->getLdapName()."\", \"".$vo->getShownName().
                "\", ".$vo->getIsAdmin().", ".$vo->getIsGroup().") ".
            "ON DUPLICATE KEY UPDATE ".CTRols::NAME_COL_LDAPNAME."=\"".$vo->getLdapName()."\", ".
            CTRols::NAME_COL_SHOWNAME."=\"".$vo->getShownName()."\", ".
            CTRols::NAME_COL_ISADMIN."=".(int)$vo->getIsAdmin().", ".
            CTRols::NAME_COL_ISGROUP."=".(int)$vo->getIsGroup();
        /* Executem la query i retornem el resultat */

        $result=$this->execute($sql);
        return  $result;
    }
    
    public function saveLdap(&$vo) {
        /* Generem la query usant constants */
        $sql = "INSERT IGNORE INTO ".CTRols::NAME_TABLE.
            " (".CTRols::NAME_COL_LDAPNAME.")".
            " VALUES (\"".$vo->getLdapName()."\")";

        /* Executem la query i retornem el resultat */
        $result = mysql_query($sql, $this->conn) 
        or die (mysql_error());
        return $result;
    }

    /*
     * Donat un id, retorna -si existeix la DB- un objecte de tipus Rol
     */
    public function getByID($id) {
        /* Generem la query usant constants */
        $sql = "SELECT * FROM ".CTRols::NAME_TABLE.
                " WHERE ".CTRols::NAME_COL_ID."= $id";

        /* Executem la query i retornem el resultat */
        $result=$this->execute($sql);
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Rol */
       if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_assoc($result);
            $rol = new Rol($row[CTRols::NAME_COL_ID], $row[CTRols::NAME_COL_LDAPNAME],
                 $row[CTRols::NAME_COL_SHOWNAME], $row[CTRols::NAME_COL_ISGROUP], $row[CTRols::NAME_COL_ISADMIN]);
           return $rol;
       }

       return false;
    }
    
    /*
     * Donat un ldapname, retorna -si existeix la DB- un objecte de tipus Rol
     */
    public function getByLDAPname($name) {
        /* Generem la query usant constants */
        $sql = "SELECT * FROM ".CTRols::NAME_TABLE.
                " WHERE ".CTRols::NAME_COL_LDAPNAME."=\"".$name."\"";

        /* Executem la query i retornem el resultat */
        $result=$this->execute($sql);
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Rol */
       if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_assoc($result);
            $rol = new Rol($row[CTRols::NAME_COL_ID], $row[CTRols::NAME_COL_LDAPNAME],
                 $row[CTRols::NAME_COL_SHOWNAME], $row[CTRols::NAME_COL_ISGROUP], $row[CTRols::NAME_COL_ISADMIN]);
           return $rol;
       }
        return false;

    }
    
    public function getAll(){
        $sql = "SELECT * FROM ".CTRols::NAME_TABLE;
        $result=$this->execute($sql);
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Rol */
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               $rol[$i] = new Rol($row[CTRols::NAME_COL_ID], $row[CTRols::NAME_COL_LDAPNAME],
                       $row[CTRols::NAME_COL_SHOWNAME], $row[CTRols::NAME_COL_ISGROUP], $row[CTRols::NAME_COL_ISADMIN]);
           }
           return $rol;
       }
       return false;
    }
    
    public function getLast(){
        $sql = "SELECT * FROM ".CTRols::NAME_TABLE." ORDER BY ".CTRols::NAME_COL_ID." DESC LIMIT 1";
        $result = mysql_query($sql, $this->conn) 
                or die (mysql_error());
        
       if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_assoc($result);
            return $row[CTRols::NAME_COL_ID];
       }
       
       return false;
    }

    
    public function getAdmins(){
        $sql = "SELECT * FROM ".CTRols::NAME_TABLE." WHERE ".CTRols::NAME_COL_ISADMIN."=1";
        $result= $this->execute($sql);
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               $rol[$i] = new Rol($row[CTRols::NAME_COL_ID], $row[CTRols::NAME_COL_LDAPNAME],
                       $row[CTRols::NAME_COL_SHOWNAME], $row[CTRols::NAME_COL_ISGROUP], $row[CTRols::NAME_COL_ISADMIN]);
           }
           return $rol;
       }
       
       return false;
    }
    
    //Remove a record form DB
    public function delete(&$vo) {
        /* Generem la query usant constants */

        $sql = "DELETE FROM ".CTRols::NAME_TABLE." WHERE ".CTRols::NAME_COL_ID."=".$vo->getId();

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }
}
