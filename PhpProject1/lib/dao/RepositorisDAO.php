<?php

/**
 * DAO de la taula Repositoris 
 *
 * @author fdanti
 */
class RepositorisDAO {
    protected $conn;
    protected $db;
    
    /* Constructor. Crea la connexió */
    public function RepositorisDAO() {
        //TODO: repassa constructor
        //TODO: connexió persistent o no? Estudiar-ho
        $this->conn = mysql_connect(ConfigDB::HOST, ConfigDB::USER,
               ConfigDB::PWD, ConfigDB::DB );
        $this->db = mysq_select_db();
   }

    /* Executa la SQLquery i retorna un array associatiu amb els resultats */
    protected function execute($sql) {
       $result = mysql_query($sql, $this->conn) 
               or die (myql_error());
       
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Repositori */
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               $repositori[$i] = new Repositori($row[ipScan], $row[nom], $row[notes]);
           }
       }
       return $repositori;
   }
   
    /*
     * Donat un objecte de tipus Repositori, l'afegeix a la taula corresponent de la DB
     */
    public function save(&$vo) {
        // TODO: provar
        /* Generem la query usant constants */
        $sql = "INSERT INTO " + CTRepos::NAME_TABLE +
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
        $sql = "SELECT * FROM " + CTPermisos::NAME_T_PERMISOS +
                " WHERE " + CTPermisos::NAME_COL_IDREPO + "= $idRepo" +
                " AND " + CTPermisos::NAME_COL_IDROL + " = $idRol";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }

    //Remove a record form DB
    //public function delete(&$vo) {
    // // TODO: implementar PermisosDAO.delete()
    //}

}
