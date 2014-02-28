<?php

/**
 * Classe que conté la informació d'un usuari FTP
 * Relacionada amb la taula ftpRol
 *
 * @author fdanti
 */

class FtpRol {  //TODO: aquesta classe extends Rol. Potser usar-ho ens estalviaria feina.
    private $Uid;       //Autoincrement
    private $User;      //Unique
    private $Password;
    private $status;
    private $Gid;
    private $Dir;
    private $ULBandwidth;
    private $DLBandwidth;
    private $comment;
    private $ipaccess;
    private $QuotaSize;
    private $QuotaFiles;  
    
    /* Constructor de la classe */
    function __construct($User, $Password, $ipaccess, $Dir) {
        $this->User = $User;
        $this->Password = $Password;
        $this->ipaccess = $ipaccess;
        $this->Dir = $Dir;
    }

    /* Getters auto-generats */
    public function getUser() {
        return $this->User;
    }

    public function getStatus() {
        return $this->status;
    }
    
    public function getDir() {
        return $this->Dir;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function getUid() {
        return $this->Uid;
    }

    public function getGid() {
        return $this->Gid;
    }

    public function getULBandwidth() {
        return $this->ULBandwidth;
    }

    public function getDLBandwidth() {
        return $this->DLBandwidth;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getIpaccess() {
        return $this->ipaccess;
    }

    public function getQuotaSize() {
        return $this->QuotaSize;
    }

    public function getQuotaFiles() {
        return $this->QuotaFiles;
    }

    /* Setters auto-generats */
    public function setPassword($Password) {
        $this->Password = $Password;
    }

    public function setULBandwidth($ULBandwidth) {
        $this->ULBandwidth = $ULBandwidth;
    }

    public function setDLBandwidth($DLBandwidth) {
        $this->DLBandwidth = $DLBandwidth;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function setIpaccess($ipaccess) {
        $this->ipaccess = $ipaccess;
    }

    public function setQuotaSize($QuotaSize) {
        $this->QuotaSize = $QuotaSize;
    }

    public function setQuotaFiles($QuotaFiles) {
        $this->QuotaFiles = $QuotaFiles;
    }

}

