<?php
#require_once '../base.inc.php';
#require_once '../config.inc.php';

/**
 * DAO de la taula Repositoris 
 *
 * @author fdanti
 */
class RepositorisDAO {
    protected $conn;
    protected $db;
    
    /* Constructor. Crea la connexió */
    public function __construct() {
        //TODO: repassa constructor
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
     * Donat un objecte de tipus Repositori, l'afegeix a la taula corresponent de la DB
     */
    public function save(&$vo) {
        // TODO: provar
        /* Generem la query usant constants */
        $sql = "INSERT INTO " + CTRepos::NAME_TABLE +
                " (" + CTRepos::NAME_COL_IPSCAN + ", " + CTRepos::NAME_COL_NOM + ", " + CTRepos::NAME_COL_NOTES + ")" +
                " VALUES (" + $vo->getIPscan() + ", " + $vo->getName() +", " + $vo->getNotes() +")";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }

    /*
     * Donat un id, retorna -si existeix la DB- un objecte de tipus Repositori
     */
    public function get($id) {
        // TODO: provar
        /* Generem la query usant constants */
        $sql = "SELECT * FROM ".CTRepos::NAME_TABLE." WHERE ".CTRepos::NAME_COL_ID."= $id";
        $result=$this->execute($sql);
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Repositori */
       if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_assoc($result);
            $repositori = new Repositori($row[CTRepos::NAME_COL_ID], 
                         $row[CTRepos::NAME_COL_IPSCAN],
                         $row[CTRepos::NAME_COL_NOM],
                         $row[CTRepos::NAME_COL_NOTES]);
       }
       
       return $repositori;
    }

    //Remove a record form DB
    //public function delete(&$vo) {
    // // TODO: implementar 
    //}

}
