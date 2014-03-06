<?php
require_once '../lib/Constants.php';
require_once 'consultes/configDB.php';
require_once '../lib/dao/RolsFtpDAO.php';
require_once '../lib/model/RolFtp.php';

if(isset($_GET['idFtp'])){
    $idFtp=$_GET['idFtp'];
}

if(isset($_GET['idRepo'])){
    $idRepo=$_GET['idRepo'];
}

$con_ftp = new RolsFtpDAO();
$ftp = $con_ftp->getByUser($idFtp)


?>

<div align="center" class='desplegable'>
    <div align="right"><img src="../img/arrow.gif" height='20' onclick="buidaDiv('#users<?php echo $idRepo?>');" style="cursor: pointer;" /></div>
    <h2>Informació ftp:</h2>
    <?php if($ftp){?>
        <table border="0">
            <tr>
                <td align="right" style="padding-right: 30px;">Usuari:</td>
                <td><?php echo $ftp->getUser();?></td>
            </tr>
            <tr>
                <td align="right" style="padding-right: 30px;">Password:</td>
                <td><?php echo $ftp->getPassword();?></td>
            </tr>
            <tr>
                <td align="right" style="padding-right: 30px;">Carpeta:</td>
                <td><?php echo $ftp->getDir();?></td>
            </tr>
        </table>
    <p>&nbsp;</p>
    <?php }else{?>
    <div id="helpedit" class="help"><p style="padding: 0px; margin:5px;">Error en carregar la informació de l'escàner.</p></div>
    <?php }?>
</div>