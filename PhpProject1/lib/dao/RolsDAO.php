<?php
require_once '../base.inc.php';
require_once '../config.inc.php';

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
        $this->db = mysq_select_db();
   }

    /* Executa la SQLquery i retorna un array associatiu amb els resultats */
    protected function execute($sql) {
       $result = mysql_query($sql, $this->conn) 
               or die (myql_error());
       
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Rol */
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               $rol[$i] = new Rol($row[CTRols::NAME_COL_ID], $row[CTRols::NAME_COL_LDAPNAME],
                       $row[CTRols::NAME_COL_SHOWNAME], $row[CTRols::NAME_COL_ISGROUP], $row[CTRols::NAME_COL_ISADMIN]);
           }
       }
       return $rol;
   }
   
    /*
     * Donat un objecte de tipus Rol, l'afegeix a la taula corresponent de la DB
     */
    public function save(&$vo) {
        /* Generem la query usant constants */
        $sql = "INSERT INTO " + CTRol::NAME_TABLE +
            " (" + CTRols::NAME_COL_LDAPNAME + ", " +
                CTRols::NAME_COL_SHOWNAME + ", " +
                CTRols::NAME_COL_ISADMIN + ", " +
                CTRols::NAME_COL_ISGROUP + ")" +
            " VALUES (" + $vo->getLdapName() + ", " + $vo->getShowName() +
                ", " + $vo->getIsAdmin() + ", " + $vo->getIsGroup() + ")";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }

    /*
     * Donat un id, retorna -si existeix la DB- un objecte de tipus Rol
     */
    public function get($id) {
        /* Generem la query usant constants */
        $sql = "SELECT * FROM " + CTRols::NAME_TABLE +
                " WHERE " + CTRols::NAME_COL_ID + "= $id";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }
}
