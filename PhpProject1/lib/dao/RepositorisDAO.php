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
        /* Generem la query usant constants */
        if($vo->getId()==""){
            $sql = "INSERT INTO ".CTRepos::NAME_TABLE.
                    " (".CTRepos::NAME_COL_IPSCAN.", ".CTRepos::NAME_COL_NOM.", ".CTRepos::NAME_COL_NOTES.")".
                    " VALUES (\"".$vo->getIPscan()."\", \"".$vo->getNom()."\", \"".$vo->getNotes()."\")";
        }else{
            $sql = "UPDATE ".CTRepos::NAME_TABLE." ".
            "SET ".CTRepos::NAME_COL_IPSCAN."=\"".$vo->getIPscan()."\", ".
            CTRepos::NAME_COL_NOM."=\"".$vo->getNom()."\", ".
            CTRepos::NAME_COL_NOTES."=\"".$vo->getNotes()."\" ".
            "WHERE ".CTRepos::NAME_COL_ID."=".$vo->getId();
        }

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
    
    public function getAll() {
        /* Generem la query usant constants */
        $sql = "SELECT * FROM ".CTRepos::NAME_TABLE;
        $result=$this->execute($sql);
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Repositori */
        
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               $repositori[$i] = new Repositori($row[CTRepos::NAME_COL_ID], 
                         $row[CTRepos::NAME_COL_IPSCAN],
                         $row[CTRepos::NAME_COL_NOM],
                         $row[CTRepos::NAME_COL_NOTES]);
           }
           return $repositori;
       }
       
       return false;
       
    }
    
    public function getLast() {
        /* Generem la query usant constants */
        $sql = "SELECT * FROM ".CTRepos::NAME_TABLE." ORDER BY ".CTRepos::NAME_COL_ID." DESC LIMIT 1";
        $result=$this->execute($sql);
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Repositori */
        
       if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_assoc($result);
            return $row[CTRepos::NAME_COL_ID];
       }else{
            return false;
       }
    }

    //Remove a record form DB
    public function delete(&$vo) {
        /* Generem la query usant constants */

        $sql = "DELETE FROM ".CTRepos::NAME_TABLE." WHERE idRepo=".$vo->getId();

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }

}
