<?php
require_once '../base.inc.php';
require_once '../config.inc.php';

/**
 * DAO de la taula fitxers
 *
 * @author fdanti
 */
class FilesDAO {
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
       
       /* Si obtenim resultats de la query, posem-los en un VO de tipus File */
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               $file[$i] = new File($row[CTFile::NAME_COL_ID], $row[CTFile::NAME_COL_NAME],
                       $row[CTFile::NAME_COL_IDREPO], $row[CTFile::NAME_COL_DATE]);
           }
       }
       return $file;
   }
   
    /*
     * Donat un objecte de tipus File, l'afegeix a la taula corresponent de la DB
     */
    public function save(&$vo) {
        /* Generem la query usant constants */
        $sql = "INSERT INTO " + CTFile::NAME_TABLE +
            " (" + CTFile::NAME_COL_NAME + ", " +
                CTFile::NAME_COL_IDREPO + ", " +
                CTFile::NAME_COL_DATE + ")" +
            " VALUES (" + $vo->getName() + ", " + $vo->getIdRepo() +
                ", " + $vo->getDate() + ")";
        
        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }

    /*
     * Donat un id, retorna -si existeix la DB- un objecte de tipus File
     */
    public function get($id) {
        /* Generem la query usant constants */
        $sql = "SELECT * FROM " + CTFile::NAME_TABLE +
                " WHERE " + CTFile::NAME_COL_ID + "= $id";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }
}
