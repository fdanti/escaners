<?php
require_once '../base.inc.php';

/* 
 * Aquest fitxer farà de controlador de la aplicació
 */

//FIX: Testing
$ldapName = "test"; //TODO: això has de capturar-ho de les variables de la sessió


/* Operatoria d'usuari */
    //Creem un objecte de tipus RolsDAO
    $rolDAO = new RolsDAO();

    //Consultem si l'usuari que entra està donat d'alta a la DB i en creem el objecte
    $user = $rolDAO.getByLDAPname($ldapName);

    /* Si el ROL no existeix, mostra un error */
    if ( empty($user->getLdapName()) ) {
        $errorMsg = "Usuari sense autorització al portal";
        $errorAllowed = 1;
    } else {
        /* Si el ROL és admin, fem el include de la part de admins */
        if ( $user->getIsAdmin() ) {
             include '../view/admin_view.php';
        }
    }

    /* */
    




