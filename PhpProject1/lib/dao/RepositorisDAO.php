<?php

/**
 * DAO de la taula Repositoris 
 *
 * @author fdanti
 */
class RepositorisDAO {
  var $conn;

   function RepositorisDAO(&$conn) {
     $this->conn =& $conn;
   }

   //Insert or update a record into the DB
   function save(&$vo) {
   
   }

   //Get a record from de DB
   function get($id) {
   
   }

   //Remove a record form DB
   function delete(&$vo) {
   
   }

}
