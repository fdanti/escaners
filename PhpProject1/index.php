<!DOCTYPE html>

<?php
    $isadmin=0;
    ini_set('display_errors', 1);
    if(isset($_SERVER['PHP_AUTH_USER'])){
        $user=$_SERVER['PHP_AUTH_USER'];
    }else{
        $user="avilalta";
    }

    require_once './lib/base.inc.php';
    
    $con_user = new RolsDao();
    $rol=$con_user->getByLDAPname($user);
    if($rol){
        $existeix=true;
        $isadmin=$rol->getIsAdmin();
    }else{
        $existeix=false;
    }

    $con_permis = new PermisosDAO();
    
    if($isadmin){
        $consulta=$con_permis->getAll();
        if($consulta){
            $permisos=$consulta[0];
            $repositoris=$consulta[1];
        }
    }else{
        if($rol){
            $consulta=$con_permis->getByRol($rol->getId());
            if($consulta){
                $permisos=$consulta[0];
                $repositoris=$consulta[1];
            }
        }
    }
    
    if(!isset($_GET['idrepo'])){
        if(isset($repositoris)){
            $idrepo=$repositoris[0]->getId();
        }else{
            $idRepo=0;
        }
    }else{
        $idrepo=$_GET['idrepo'];
    }

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <title>Servidor d'escaneig de la UB</title>
        <script src="./lib/jquery/jquery-1.11.0.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                <?php if(!$isadmin && $consulta){?>
                $("#inforepo").load("./inforepo.php?idrepo=<?php echo $repositoris[0]->getId();?>");
                $("#content").load("./content.php?idrepo=<?php echo $repositoris[0]->getId();?>");
                <?php }else{ ?>
                $("#admin").load("./admin/index.php");
                <?php }?>
            });
            
            function carrega(repo){
                var seleccio = document.getElementById("selectrep");
                var id = seleccio.options[seleccio.selectedIndex].value;
                <?php if(!$isadmin){?>
                $("#inforepo").load("./inforepo.php?idrepo="+id);
                $("#content").load("./content.php?idrepo="+id);
                <?php }else{ ?>
                if(repo){
                    $("#inforepo").load("./inforepo.php?idrepo="+id);
                    $("#contentadmin").load("./content.php?idrepo="+id);
                }else{
                    $("#admin").load("./admin/index.php");
                }
                <?php }?>
            }
            
            function carregaDiv(div,url){
                $(div).load(url);
            }
            
            function buidaDiv(div){
                $(div).html("");
            }
            
            <?php if($isadmin){?>
            function admin(num){
                if(num==1){
                    $("#contentadmin").load("./admin/add.php");
                }else if(num==2){
                    $("#contentadmin").load("./admin/edit.php");
                }else if(num==3){
                    $("#contentadmin").load("./admin/admins.php");
                }else if(num==4){
                    $("#contentadmin").load("./admin/editusers.php");
                }
            }
            
            var ok=0;
            function submitForm(desti,div,amaga) {
                if(typeof(div)==='undefined') div="#help";
                if(typeof(amaga)==='undefined') amaga=true;
                //$('html, body').animate({scrollTop:0}, 'slow');
                $.ajax({type:'POST', url: './admin/consultes/'+desti, data:$('#form1').serialize(), success: function(response) {
                    $(div).html(response);
                    if(amaga){
                        $("#submit").attr("disabled", "disabled");
                        if(ok==1){
                                if(element=document.getElementById("form1")){
                                        pare=element.parentNode;
                                        pare.removeChild(element);
                                }
                        }
                    }
                }});

                return false;
            }
            
            function carregaDivDelete(div,url,referencia){
                //document.getElementById(referencia+"titol").classList.add('seleccioelimina');
                if(confirm("Segur que vols eliminar l'element seleccionat?'")){
                        //$('html, body').animate({scrollTop:0}, 'slow');
                        $(div).load(url);
                        element=document.getElementById(referencia);
                        pare=element.parentNode;
                        pare.removeChild(element);
                }
            }
            <?php }?>
        </script>
    </head>
    <body>
        <div id="head">
            <p style="text-align: right"><img src="./img/ub.jpg" style="height: 80px;" /></p>
            <h1>Servidor d'escaneig de la UB</h1>
            <?php if($existeix){?>
                <h2>Benvingut, <?php
                if($rol->getShownName()!="" && $rol->getShownName()!=null){
                    echo $rol->getShownName();
                }else{
                    echo $rol->getLdapName();
                }
                ?>.</h2>
                <table>
                    <tr>
                        <td style="font-weight: bold;">Unitats a les que tens accés: </td>
                        <td>
                            <?php
                            if(isset($repositoris)){?>
                            <select id="selectrep" name="selectrep" onchange="carrega(<?php echo "true";?>);">
                                <?php
                                if($isadmin){
                                    echo "<option value=\"0\">*</option>";
                                }
                                foreach($repositoris as $repositori){
                                ?>
                                    <option value="<?php echo $repositori->getId();?>"><?php echo $repositori->getNom();?></option>
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
                <div id="inforepo"></div>
            </div>   
    <?php if(!$isadmin){?>
            <div id="content"></div>
    <?php }else{?>   
            </div>
            <div id="opcionsadmin"></div>
            <div id="admin"></div>
    <?php }?>
            <?php }else{ ?>
            <h2>Aquest usuari no està a la base de dades. Contacta amb l'administrador.</h2>
        </div>
            <?php }?>
    </body>
</html>
