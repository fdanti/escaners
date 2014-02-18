<?php

#require_once '../base.inc.php';
#require_once '../config.inc.php';

/**
 * DAO de la taula permisos
 *
 * @author fdanti
 */
class PermisosDAO {
    protected $conn;
    protected $db;
    
    /* Constructor de PermisosDAO. Crea la connexió */
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
     * Donat un objecte de tipus Permis, l'afegeix a la taula corresponent de la DB
     */
    public function save(&$vo) {
        // TODO: provar
        /* Generem la query usant constants */
        $sql = "INSERT INTO " + CTPermisos::NAME_TABLE  +
                " (" + CTPermisos::NAME_COL_IDREPO + ", " + CTPermisos::NAME_COL_IDROL + ")" +
                " VALUES (" + $vo->getIdRepo() + ", " + $vo->getIdRol() +")";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }

    /*
     * Donat un idRepo i un idRol, retorna -si existeix  la DB- un objecte de tipus Permis
     */
    public function get($idRepo,$idRol) {
        // TODO: provar
        /* Generem la query usant constants */
        $sql = "SELECT * FROM " + CTPermisos::NAME_TABLE  +
                " WHERE " + CTPermisos::NAME_COL_IDREPO + "= $idRepo" +
                " AND " + CTPermisos::NAME_COL_IDROL + " = $idRol";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }
    
    public function getByRol($idRol) {
        // TODO: provar
        /* Generem la query usant constants */
        $sql = "SELECT * FROM ".CTPermisos::NAME_TABLE." INNER JOIN ".  CTRepos::NAME_TABLE." ON ".CTPermisos::NAME_TABLE.".".CTPermisos::NAME_COL_IDREPO."=".CTRepos::NAME_TABLE.".".CTRepos::NAME_COL_ID." WHERE ".CTPermisos::NAME_COL_IDROL." = $idRol";

        /* Executem la query i retornem el resultat */
        $result=$this->execute($sql);
        
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Permisos */
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               $permis[$i] = new Permis($row[CTPermisos::NAME_COL_IDREPO],
                       $row[CTPermisos::NAME_COL_IDROL]);
               $repo[$i] = new Repositori($row[CTRepos::NAME_COL_ID], 
                            $row[CTRepos::NAME_COL_IPSCAN],
                            $row[CTRepos::NAME_COL_NOM],
                            $row[CTRepos::NAME_COL_NOTES]);
           }
       }
       
       $retorn[0]=$permis;
       $retorn[1]=$repo;
       
       return $retorn;
    }

    //Remove a record form DB
    //public function delete(&$vo) {
    // // TODO: implementar PermisosDAO.delete()
    //}

}
