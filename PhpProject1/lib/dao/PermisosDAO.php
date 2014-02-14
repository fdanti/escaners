<?php

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
       //TODO
   }

   //Get a record from de DB
   function get($idRepo,$idRol) {
       //TODO
   }

   //Remove a record form DB
   function delete(&$vo) {
        //TODO
   }

}
