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
    public function __construct($idRepo, $idRol) {
        $this->idRepo = $idRepo;
        $this->idRol = $idRol;
    }
    
    /* Getters auto-generats */
    public function getIdRepo() {
        return $this->idRepo;
    }
    
    public function getIdRol() {
        return $this->idRol;
    }    
}
