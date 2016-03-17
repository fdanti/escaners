<!DOCTYPE html>

<?php
    require_once './lib/base.inc.php';

    if(!isset($_GET['idrepo'])){
        $idrepo=0;
    }else{
        $idrepo=$_GET['idrepo'];
    }
    
    $con_repos = new RepositorisDAO();
    
    $repositori=$con_repos->get($idrepo);
?>
            <table>
                <tr>
                    <td style="font-weight: bold;">Direcció ip del repositori:</td>
                    <td><?php echo $repositori->getIpScan();?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Notes del repositori:</td>
                    <td><?php echo $repositori->getNotes();?></td>
                </tr>
            </table>