<?php
    require_once '../lib/Constants.php';
    require_once './consultes/configDB.php';
    require_once '../lib/dao/RolsDAO.php';
    require_once '../lib/model/Rol.php';
    
    $con_rols = new RolsDAO();
    $usuaris = $con_rols->getAll();
?>
<div align="center">
    <h2>Edició d'usuaris</h2>
    <?php if($usuaris){?>
        <div id="help"><p style="padding: 0px; margin:5px;">Llistat d'usuaris:</p></div>
        <div>
            <table width='90%' cellpadding='0' cellspacing='0' border='2'>
                <tr>
                    <td width="50%" style="font-weight: bold; padding:5px;">Nom:</td>
                    <td width="30%" style="font-weight: bold; padding:5px;">LDAP id:</td>
                    <td width="20%" style="font-weight: bold; padding:5px;">Opcions:</td>
                </tr>
            </table>
        <?php
        foreach($usuaris as $usuari){?>
            <table id='llista<?php echo $usuari->getId();?>' name='llista<?php echo $usuari->getId();?>' class="llista" width='90%' cellpadding='0' cellspacing='0' border='0'>
                <tr>
                    <td width="50%" style="padding:5px;"><?php echo $usuari->getShownName();?></td>
                    <td width="30%" style="padding:5px;"><?php echo $usuari->getLdapName();?></td>
                    <td width="20%" style="padding:5px;"><img src="../img/edit.png" height="25" onclick="carregaDiv('#users<?php echo $usuari->getId();?>', './admin/user.php?idRol=<?php echo $usuari->getId();?>');" /><img src="../img/delete.png" height="25" onclick="carregaDivDelete('#help', './admin/consultes/deleterol.php?id=<?php echo $usuari->getId();?>','llista<?php echo $usuari->getId();?>')" /></td>
                </tr>
            </table>
            <div id="users<?php echo $usuari->getId();?>" name="users<?php echo $usuari->getId();?>"></div>
        <?php
        }
        ?>
        </div>
        <?php
    }else{?>
        <div id="help"><p style="padding: 0px; margin:5px;">Actualment no existeix cap usuari.</p></div>
    <?php 
    }
    ?>
</div>