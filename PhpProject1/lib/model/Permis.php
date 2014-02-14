<?php

/**
 * Entitat que relaciona 1.N-1.N entre rol i repositoris
 *
 * @author fdanti
 */
class Permis {
    protected $idRepo;  //Foreign key a Repositori.id
    protected $idRol;  //Foreign key a Rol.id
    
    /* Constructor de la classe */
    public function Permis($idRepo, $idRol) {
        $this->idRepo = $idRepo;
        $this->idRol = $idRol;
    }
    
    /* innecessaris si usem constructor 
        public function setIdRepo($id) {
            $this->idRepo = $id;
        }

        public function setIdRol($id) {
            $this->idRol = $id;
        }    
    */
    
    public function getIdRepo() {
        return $this->idRepo;
    }
    
    public function getIdRol() {
        return $this->idRol;
    }    
}
