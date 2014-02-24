<?php
require_once '../lib/Constants.php';
require_once 'consultes/configDB.php';
require_once '../lib/dao/PermisosDAO.php';
require_once '../lib/dao/RolsDAO.php';
require_once '../lib/model/Permis.php';
require_once '../lib/model/Repositori.php';
require_once '../lib/model/Rol.php';

if(isset($_GET['idRepo'])){
    $idRepo=$_GET['idRepo'];
}

$con_permis = new PermisosDAO();

$resultat = $con_permis->getByRepo($idRepo);
if($resultat!=null){
    $permis=$resultat[0];
    $rols=$resultat[1];
}
$con_rols = new RolsDAO();
$tots_rols = $con_rols->getAll();


?>


<div align="center" class='desplegable'>
    <div align="right"><img src="../img/arrow.gif" height='20' onclick="buidaDiv('#users<?php echo $idRepo?>');" style="cursor: pointer;" /></div>
    <h2>Modificar permisos d'usuari:</h2>
    <div id="helpedit" class="help"><p style="padding: 0px; margin:5px;">Llistat d'usuaris amb permís:</p></div>
    <div>
        <?php if($resultat!=null){?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
        <?php
        $i=0;
        foreach($rols as $rol){
        ?>
                <td id='rol<?php echo $rol->getId();?>' border="1" align="center" width="25%"><?php echo $rol->getShownName();?> <img src="../img/delete.png" height="15" onclick="carregaDiv('#helpedit', './admin/consultes/deletepermis.php?idRol=<?php echo $rol->getId();?>&idRepo=<?php echo $idRepo;?>','rol<?php echo $rol->getId();?>')" style='cursor: pointer;' /></td>
        <?php
            if($i%4==0 && $i!=0){
                echo "</tr><tr>";
            }
            $i++;
        }
        if($i%4!=0){
            while($i%4!=0){
                echo '<td>&nbsp;</td>';
                $i++;
            }
            echo "</tr>";
        }
        ?>
        </table>
        <?php }else{ ?>
        <p>Aquest escàner encara no té cap usuari.</p>
        <?php }?>
    </div>
    <p>&nbsp;</p>
    <h2>Afegir permisos d'usuari:</h2>
    <div id="helpadd" class="help"><p style="padding: 0px; margin:5px;">Seleccionar usuari i clickar afegir permís:</p></div>
    <div>
        <form id="form1" name="form1" method="POST"  onsubmit="return submitForm('addpermis.php','#helpadd',false);">
        <p>Usuaris disponibles:
            <select id='idRol' name='idRol'>
            <?php
                foreach($tots_rols as $rol){?>
                <option value='<?php echo $rol->getId();?>'><?php echo $rol->getShownName()?></option>;
            <?php }?>
            </select>
            <input id='idRepo' name="idRepo" type='hidden' value="<?php echo $idRepo;?>">
            <input type="submit" id='submit' name="submit" value="Afegir permís">
            <img src="../img/refresh.gif" height='20' onclick="carregaDiv('#users<?php echo $idRepo;?>', './admin/users.php?idRepo=<?php echo $idRepo;?>');" style="cursor: pointer;" />
        </p>
        </form>
    </div>

</div>