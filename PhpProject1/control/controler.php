<?php
require_once '../base.inc.php';

/* 
 * Aquest fitxer farà de controlador de la aplicació
 */

//FIX: Testing
$ldapName = "test"; //TODO: això has de capturar-ho de les variables de la sessió


/* Comprovacions sobre l'usuari */
    //Creem un objecte de tipus RolsDAO
    $rolDAO = new RolsDAO();

    //Consultem si l'usuari que entra està donat d'alta a la DB i en creem el objecte
    $user = $rolDAO.getByLDAPname($ldapName);

    /* Si el ROL no existeix, mostra un error */
    if ( empty($user->getLdapName()) ) {
        $errorMsg = "Usuari sense autorització al portal";
        $errorAllowed = 1;
    } else {
        
    }
    
/* Altres comprovacions */    

/* Control dels errors */
    //TODO: implementa control sobre els altres possibles errors
if ( $errorAlolowed ) {
    echo $errorMsg;
    exit;        
}

/* Si no hi ha cap error, mostra la vista que toca */   
    if ( $user->getIsAdmin() ) {    /* ROL és admin */
         include 'admin_controler.php';
    } else {                        /* ROL NO és admin */
         include 'user_controler.php';
    }



