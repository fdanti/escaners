<?php

/**
 * Classe que conté la informació d'un repositori
 *
 * @author fdanti
 */
class Repositori {
    private $id;        //Autoincrement, PRI_KEY
    private $pwd;
    private $ipScan;
    private $nom;
    private $notes;     //Opcional
    
    /* Constructor de la classe */
    function __construct($id = "", $pwd="", $ipScan, $nom, $notes = "") {
        $this->id = $id;
        $this->pwd = $pwd;
        $this->ipScan = $ipScan;
        $this->nom = $nom;
        $this->notes = $notes;
    }
    
    /* Getters auto-generats */
    public function getId() {
        return $this->id;
    }
    
    public function getPwd() {
        return $this->pwd;
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
    
    public function setId($id){
        $this->id=$id;
    }

    public function generaPassword(){
        $rand = substr(md5(microtime()),rand(0,26),8);
        $this->pwd=$rand;
    }
    
    
    
    

    
}
