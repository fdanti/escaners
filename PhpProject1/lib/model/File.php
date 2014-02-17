<?php

/**
 * Classe que conte la informació d'un fitxer d'un repositori concret
 *
 * @author fdanti
 */
class File {
    private $id;            //Autoincrement, PRI_KEY
    private $name;  
    private $idRepo;        //id del repositori al que pertany el fitxer
    private $creationDate;
    
    /* Constructor de la classe */
    function __construct($name, $idRepo, $creationDate) {
        $this->name = $name;
        $this->idRepo = $idRepo;
        $this->creationDate = $creationDate;
    }
    
    /* Getters auto-generats */
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getIdRepo() {
        return $this->idRepo;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }



    
}
