<?php

/**
 * Classe que conté la informació d'un repositori
 *
 * @author fdanti
 */
class Repositori {
    private $id;        //Autoincrement, PRI_KEY
    private $ipScan;
    private $nom;
    private $notes;     //Opcional
    
    /* Constructor de la classe */
    function __construct($id = "", $ipScan, $nom, $notes = "") {
        $this->id = $id;
        $this->ipScan = $ipScan;
        $this->nom = $nom;
        $this->notes = $notes;
    }
    
    /* Getters auto-generats */
    public function getId() {
        return $this->id;
    }

    public function getIpScan() {
        return $this->ipScan;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getNotes() {
        return $this->notes;
    }


    
    
    
    

    
}
