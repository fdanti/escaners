<?php
    require_once '../lib/Constants.php';
    require_once './consultes/configDB.php';
    require_once '../lib/dao/RolsDAO.php';
    require_once '../lib/model/Rol.php';
    
    $con_rols = new RolsDAO();
    $admins = $con_rols->getAdmins();
    $users = $con_rols->getAll();
?>
<div align="center">
    <h2>Edició d'administradors</h2>
    <?php if($admins){?>
        <div id="help"><p style="padding: 0px; margin:5px;">Administradors actuals:</p></div>
        <div>
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
            <?php
            $i=0;
            foreach($admins as $rol){
            ?>
                    <td id='rol<?php echo $rol->getId();?>' border="1" align="center" width="25%">
                        <?php if ($rol->getShownName()!="" && $rol->getShownName()!=null){
                            echo $rol->getShownName();
                        }else{
                            echo $rol->getLdapName();
                        };?>
                        <img src="../img/delete.png" height="15" onclick="carregaDivDelete('#helpedit', './admin/consultes/deletepermis.php?idRol=<?php echo $rol->getId();?>&idRepo=<?php echo $idRepo;?>','rol<?php echo $rol->getId();?>')" style='cursor: pointer;' /></td>
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
        </div>
        <?php
    }else{?>
    <div id="help"><p style="padding: 0px; margin:5px;">Actualment no hi ha cap usuari administrador.</p></div>
    <?php 
    }
    ?>
    <h2>Afegir nou administrador:</h2>
    <div id="helpadd" class="help"><p style="padding: 0px; margin:5px;">Seleccionar usuari i clickar afegir:</p></div>
    <div>
        <form id="form1" name="form1" method="POST"  onsubmit="return submitForm('addadmin.php','#helpadd',false);">
        <p>Usuaris disponibles:
            <select id='idRol' name='idRol'>
            <?php
                foreach($users as $user){?>
                <option value='<?php echo $user->getId();?>'><?php 
                if($user->getShownName()=="" || $user->getShownName()==null){
                    echo $user->getLdapName();
                }else{
                    echo $user->getShownName();
                }?>
                </option>
            <?php }?>
            </select>
            <input type="submit" id='submit' name="submit" value="Afegir administrador">
            <img src="../img/refresh.gif" height='20' onclick="admin(3);" style="cursor: pointer;" />
        </p>
        </form>
    </div>
</div>