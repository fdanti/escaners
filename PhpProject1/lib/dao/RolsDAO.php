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
       
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Rol */
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               $rol[$i] = new Rol($row[CTRols::NAME_COL_ID], $row[CTRols::NAME_COL_LDAPNAME],
                       $row[CTRols::NAME_COL_SHOWNAME], $row[CTRols::NAME_COL_ISGROUP], $row[CTRols::NAME_COL_ISADMIN]);
           }
           return $rol;
       }
       return null;
   }
   
    /*
     * Donat un objecte de tipus Rol, l'afegeix a la taula corresponent de la DB
     */
    public function save(&$vo) {
        /* Generem la query usant constants */
        $sql = "INSERT INTO ".CTRol::NAME_TABLE.
            " (".CTRols::NAME_COL_LDAPNAME.", ".
                CTRols::NAME_COL_SHOWNAME.", ".
                CTRols::NAME_COL_ISADMIN.", ".
                CTRols::NAME_COL_ISGROUP.")".
            " VALUES (".$vo->getLdapName().", ".$vo->getShowName().
                ", ".$vo->getIsAdmin().", ".$vo->getIsGroup().")";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
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
        $sql = "SELECT * FROM " + CTRols::NAME_TABLE +
                " WHERE " + CTRols::NAME_COL_ID + "= $id";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }
    
    /*
     * Donat un ldapname, retorna -si existeix la DB- un objecte de tipus Rol
     */
    public function getByLDAPname($name) {
        /* Generem la query usant constants */
        $sql = "SELECT * FROM " + CTRols::NAME_TABLE +
                " WHERE " + CTRols::NAME_COL_LDAPNAME + "= $name";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }
    
    public function getAll(){
        $sql = "SELECT * FROM ".CTRols::NAME_TABLE;
        return $this->execute($sql);
    }
    
    public function getLast(){
        $sql = "SELECT * FROM ".CTRols::NAME_TABLE." ORDER BY ".CTRols::NAME_COL_ID." DESC LIMIT 1";
        $result = mysql_query($sql, $this->conn) 
                or die (mysql_error());
        
       if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_assoc($result);
            echo $row[CTRols::NAME_COL_ID];
            return $row[CTRols::NAME_COL_ID];
       }else{
            return null;
       }
    }
}
