<?php

/**
 * DAO de la taula rolsFtp
 *
 * @author fdanti
 */
class RolsFtpDAO {
    protected $conn;
    protected $db;
    
    /* Constructor. Crea la connexió */
    public function __construct() {
        //TODO: connexió persistent o no? Estudiar-ho
        $this->conn = mysql_connect(ConfigDB::HOST, ConfigDB::USER,
               ConfigDB::PWD, ConfigDB::DB );
        $this->db = mysql_select_db(ConfigDB::DB);
   }
    /* Executa la SQLquery i retorna un array associatiu amb els resultats */
    protected function execute($sql) {
       $result = mysql_query($sql, $this->conn) or die (mysql_error());
       
       /* Si obtenim resultats de la query, posem-los en un VO de tipus RolFtp */
       if (mysql_num_rows($result) > 0) {
           for ($i = 0; $i < mysql_num_rows($result); $i++) {
               $row = mysql_fetch_assoc($result);
               
               //Creem un objecte de tipus RolFtp amb les dades de la DB
               $rolFtp[$i] = new RolFtp($row[CTRolsFtp::NAME_COL_USER], $row[CTRolsFtp::NAME_COL_PASSWORD],
                       $row[CTRolsFtp::NAME_COL_IPACCESS], $row[CTRolsfTP::NAME_COL_DIR], $row[CTRolsFtp::NAME_COL_UID], $row[CTRolsFtp::STATUS], $row[CTRolsFtp::NAME_COL_GID],
                       $row[CTRolsFtp::NAME_COL_ULBANDWIDTH], $row[CTRolsFtp::NAME_COL_DLBANDWIDTH], $row[CTRolsFtp::NAME_COL_COMMENT], $row[CTRolsFtp::NAME_COL_QUOTASIZE], $row[CTRolsFtp::NAME_COL_QUOTAFILES]);
           }
       }
       return $rolFtp;
   }
   
    /*
     * Donat un objecte de tipus RolFtp, l'afegeix a la taula corresponent de la DB
     */
    public function save(&$vo) {
        /* Generem la query usant constants */
        $sql = "INSERT INTO " . CTRolsFtp::NAME_TABLE . " ("
                . CTRolsFtp::NAME_COL_USER . ", "
                . CTRolsFtp::NAME_COL_COMMENT . ", "
                . CTRolsFtp::NAME_COL_DIR . ", "
                . CTRolsFtp::NAME_COL_DLBANDWIDTH . ", "
                . CTRolsFtp::NAME_COL_ULBANDWIDTH . ", "
                . CTRolsFtp::NAME_COL_GID . ", "
                . CTRolsFtp::NAME_COL_ID . ", "
                . CTRolsFtp::NAME_COL_IPACCESS . ", "
                . CTRolsFtp::NAME_COL_PASSWORD . ", "
                . CTRolsFtp::NAME_COL_QUOTAFILES . ", "
                . CTRolsFtp::NAME_COL_QUOTASIZE . ", "
                . CTRolsFtp::NAME_COL_STATUS
            . ") VALUES ("
                . $vo->getUser() . ", "
                . $vo->getComment() . ", "
                . $vo->getDLBandwidth() . ", "
                . $vo->getULBandwidth() . ", "
                . $vo->getGid() . ", "
                . $vo->getId() . ", "
                . $vo->getIpaccess() . ", "
                . $vo->getPassword() . ", "
                . $vo->getQuotaFiles() . ", "
                . $vo->getQuotaSize() . ", "
                . $vo->getStatus()
            . ")";

        /* */
        
        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }

    
    /*
     * Donat un id, retorna -si existeix la DB- un objecte de tipus RolFtp
     */
    public function getByID($id) {
        /* Generem la query usant constants */
        $sql = "SELECT * FROM " . CTRolsFtp::NAME_TABLE
                . " WHERE " . CTRolsFtp::NAME_COL_ID . "= $id";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }
    
    /*
     * Donat un User, retorna -si existeix la DB- un objecte de tipus RolFtp
     */
    public function getByUser($name) {
        /* Generem la query usant constants */
        $sql = "SELECT * FROM " . CTRolsFtp::NAME_TABLE
                . " WHERE " . CTRolsFtp::NAME_COL_User . "= $name";

        /* Executem la query i retornem el resultat */
        return $this->execute($sql);
    }
    
    public function getAll(){
        $sql = "SELECT * FROM " . CTRolsFtp::NAME_TABLE;
        return $this->execute($sql);
    }
}

