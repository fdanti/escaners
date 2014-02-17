<!DOCTYPE html>

<?php
    require_once './lib/base.inc.php';
    $con_permis = new PermisosDAO();
    $con_repos = new RepositorisDAO();
    
    $permisos=$con_permis->getByRol(1);
    
    $i=0;
    foreach($permisos as $permis){
        $repositoris[$i]=$con_repos->get($permis->getIdRepo());
        $i++;
    }
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <title>Servidor d'escaneig de la UB</title>
    </head>
    <body>
        <div id="head" name=""head>
            <h1>Servidor d'escaneig de la UB</h1>
            <h2>Benvingut, pepito.</h2>
            <table>
                <tr>
                    <td style="font-weight: bold;">Unitats a les que tens accés: </td>
                    <td>
                        <?php
                        if(sizeof($repositoris)>0){?>
                            <select>
                            <?php
                            foreach($repositoris as $repositori){
                            ?>
                            <option><?php echo $repositori[0]->getNom();?></option>
                            <?php    
                            }
                            ?>
                            </select>
                        <?php }else{?>
                        Actualment no tens accés a cap repositori.
                        <?php }?>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="content" name="content">
            
        </div>
    </body>
</html>
