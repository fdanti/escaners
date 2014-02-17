<!DOCTYPE html>

<?php
    require_once './lib/base.inc.php';
    $con_permis = new PermisosDAO();
    $permisos=$con_permis.getByRol(1);
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
            <form>
                <table>
                    <tr>
                        <td>Unitats a les que tens accés: </td>
                        <td>
                            <select>
                                
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
