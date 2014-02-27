<?php
require_once '../lib/Constants.php';
require_once 'consultes/configDB.php';
require_once '../lib/dao/RepositorisDAO.php';
require_once '../lib/model/Repositori.php';

if(isset($_GET['idRepo'])){
    $idRepo=$_GET['idRepo'];
}

$con_repo = new repositorisDAO();
$repositori = $con_repo->get($idRepo);


?>

<div align="center" class='desplegable'>
    <div align="right"><img src="../img/arrow.gif" height='20' onclick="buidaDiv('#users<?php echo $idRepo?>');" style="cursor: pointer;" /></div>
    <h2>Editar escàner</h2>
    <?php if($repositori){?>
    <div id="helpedit" class="help"><p style="padding: 0px; margin:5px;">Introdueix a continuació les dades de l'escàner:</p></div>
    <form id="form1" name="form1" method="POST"  onsubmit="return submitForm('editrepo.php','#helpedit',false);">
        <table border="0">
            <tr>
                <td align="right" style="padding-right: 30px;">Direcció ip de l'escàner:</td>
                <td><input type="text" id='ip' name='ip' size="15" maxlength="15" value="<?php echo $repositori->getIpScan();?>" /></td>
            </tr>
            <tr>
                <td align="right" style="padding-right: 30px;">Nom per a mostrar:</td>
                <td><input type="text" id='nom' name='nom' size="32" maxlength="32" value="<?php echo $repositori->getNom();?>" /></td>
            </tr>
            <tr>
                <td align="right" style="padding-right: 30px;">Notes addicionals:</td>
                <td><textarea cols="32" rows="6" id='notes' name='notes' ><?php echo $repositori->getNotes();?></textarea></td>
            </tr>
            <tr>
                <td align="right" style="padding-right: 30px;">Llistat d'usuaris a crear/afegir <span style="font-size: 70%; font-weight: bolder; color: #FF0000;">(separats per coma)</span>:</td>
                <td><input type="text" id='usuaris' name='usuaris' size="32" maxlength="32" /></td>
            </tr>
        </table>
        <input type="hidden" id="idRepo" name="idRepo" value="<?php echo $idRepo;?>" />
        <input id="submit" name="submit" type="submit" value="Modificar" style="margin-top:20px; margin-left:200px;" />
    </form>

    <?php }else{?>
    <div id="helpedit" class="help"><p style="padding: 0px; margin:5px;">Error en carregar la informació de l'escàner.</p></div>
    <?php }?>
</div>