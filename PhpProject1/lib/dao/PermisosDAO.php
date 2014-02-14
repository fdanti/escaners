<?php
require_once '../base.inc.php';

/**
 * DAO de la taula permisos
 *
 * @author fdanti
 */
class PermisosDAO {
    protected $conn;
    protected $db;
    
    function PermisosDAO(&$conn) {
        //TODO
     $this->conn =& $conn;
   }

   /* Executa la SQLquery i retorna un array associatiu amb els resultats */
   protected function execute($sql) {
       $result = mysql_query($sql, $this->conn) 
               or die (myql_error());
       
       /* Si obtenim resultats de la query, posem-los en un VO de tipus Permisos */
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               $permis[$i] = new Permis($row[idRepo], $row[idRol]);
           }
       }
       return $permis;
   }
   
    //Insert or update a record into the DB
   function save(&$vo) {
       // TODO:
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
   function delete(&$vo) {
        // TODO:
   }

}
