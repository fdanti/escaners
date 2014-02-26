<?php

/**
 * Classe que conté la informació d'un usuari o grup d'usuaris
 *  Relacionada amb la taula users
 *
 * @author fdanti
 */
class Rol {
    private $id;            //Autoincrement, Primary key
    private $ldapName;      //Unike key
    private $shownName="";
    private $isGroup=0;
    private $isAdmin=0;
    
    /* Constructor de la classe */
    public function __construct($id = "", $ldapName, $shownName, $isGroup, $isAdmin) {
        $this->id =$id;
        $this->ldapName = $ldapName;
        $this->shownName = $shownName;
        if($this->shownName==null) $this->shownName="";
        $this->isGroup = $isGroup;
        $this->isAdmin = $isAdmin;
    }
    
    /* Getters auto-generats */
    public function getLdapName() {
        return $this->ldapName;
    }
       
    public function getId() {
        return $this->id;
    }

    public function getShownName() {
        return $this->shownName;
    }

    public function getIsGroup() {
        return $this->isGroup;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }
    
    public function setAdmin($num){
        $this->isAdmin=$num;
    }
    
    public function setShownName($nom){
        $this->shownName=$nom;
    }

}
