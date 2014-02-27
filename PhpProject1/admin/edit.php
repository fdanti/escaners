<?php
    require_once '../lib/Constants.php';
    require_once './consultes/configDB.php';
    require_once '../lib/dao/RepositorisDAO.php';
    require_once '../lib/model/Repositori.php';
    
    $con_repos = new RepositorisDAO();
    $repositoris = $con_repos->getAll();
?>
<div align="center">
    <h2>Edició d'escàners i permisos</h2>
    <?php if($repositoris){?>
        <div id="help"><p style="padding: 0px; margin:5px;">Escàners disponibles:</p></div>
        <div>
            <table width='90%' cellpadding='0' cellspacing='0' border='2'>
                <tr>
                    <td width="30%" style="font-weight: bold; padding:5px;">Nom de l'escàner:</td>
                    <td width="20%" style="font-weight: bold; padding:5px;">Direcció ip:</td>
                    <td width="30%" style="font-weight: bold; padding:5px;">Notes:</td>
                    <td width="20%" style="font-weight: bold; padding:5px;">Opcions:</td>
                </tr>
            </table>
        <?php
        foreach($repositoris as $repositori){?>
            <table id='llista<?php echo $repositori->getId();?>' name='llista<?php echo $repositori->getId();?>' class="llista" width='90%' cellpadding='0' cellspacing='0' border='0'>
                <tr>
                    <td width="30%" style="padding:5px;"><?php echo $repositori->getNom();?></td>
                    <td width="20%" style="padding:5px;"><?php echo $repositori->getIpScan();?></td>
                    <td width="30%" style="padding:5px;"><?php echo $repositori->getNotes()?></td>
                    <td width="20%" style="padding:5px;"><img src="../img/edit.png" height="25" onclick="carregaDiv('#users<?php echo $repositori->getId();?>', './admin/editrepo.php?idRepo=<?php echo $repositori->getId();?>');" /><img src="../img/user.gif" height="25" onclick="carregaDiv('#users<?php echo $repositori->getId();?>', './admin/users.php?idRepo=<?php echo $repositori->getId();?>');" /><img src="../img/delete.png" height="25" onclick="carregaDivDelete('#help', './admin/consultes/deleterepo.php?id=<?php echo $repositori->getId();?>','llista<?php echo $repositori->getId();?>')" /></td>
                </tr>
            </table>
            <div id="users<?php echo $repositori->getId();?>" name="users<?php echo $repositori->getId();?>"></div>
        <?php
        }
        ?>
        </div>
        <?php
    }else{?>
        <div id="help"><p style="padding: 0px; margin:5px;">Actualment no hi ha cap escàner disponible.</p></div>
    <?php 
    }
    ?>
</div>