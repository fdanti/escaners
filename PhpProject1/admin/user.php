<?php
require_once '../lib/Constants.php';
require_once 'consultes/configDB.php';
require_once '../lib/dao/RolsDAO.php';
require_once '../lib/model/Rol.php';

if(isset($_GET['idRol'])){
    $idRol=$_GET['idRol'];
}

$con_rol = new RolsDAO();
$rol = $con_rol->getByID($idRol);


?>


<div align="center" class='desplegable'>
    <div align="right"><img src="../img/arrow.gif" height='20' onclick="buidaDiv('#users<?php echo $idRol?>');" style="cursor: pointer;" /></div>
    <h2>Modificar usuari:</h2>
    <div id="helpedit" class="help"><p style="padding: 0px; margin:5px;">Introdueix les dades de l'usuari:</p></div>
    <div>
        <?php if($rol){?>
        <form id="form1" name="form1" method="POST"  onsubmit="return submitForm('edituser.php','#helpedit',false);">
            <table width="100%" cellpadding="0" cellspacing="10" border="0">
                <tr>
                    <td width="50%" style="font-weight: bold; padding:5px;">Nom:</td>
                    <td width="30%" style="font-weight: bold; padding:5px;">LDAP id:</td>
                    <td width="20%" style="font-weight: bold; padding:5px;">Opcions:</td>
                </tr>
                <tr>
                    <td width="50%"><input id='nom' name='nom' type="text" style="width: 100%;" value='<?php echo $rol->getShownName();?>'></td>
                    <td width="30%"><input id='ldap' name='ldap' type="text" style="width: 100%;" disabled="true" value='<?php echo $rol->getLdapName();?>'></td>
                    <td width="20%"><input id='idRol' name="idRol" type='hidden' value="<?php echo $idRol;?>">
                        <input type="submit" id='submit' name="submit" value="Modificar">
                        <img src="../img/refresh.gif" height='20' onclick="carregaDiv('#contentadmin', './admin/editusers.php');" style="cursor: pointer;" />
                    </td>
                </tr>
            </table>
        </form>
        <?php }else{ ?>
        <p>Error en carregar l'usuari.</p>
        <?php }?>
    </div>
</div>