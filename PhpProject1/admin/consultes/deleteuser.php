<?php
require_once '../../lib/Constants.php';
require_once './configDB.php';
require_once '../../lib/dao/RolsDAO.php';
require_once '../../lib/model/Rol.php';

ini_set('display_errors', 1);

$con_rols = new RolsDAO();
$error="";
$ok=0;

if(isset($_GET['id'])){

    $id=$_GET['id'];

    $rol = $con_rols->getByID($id);

    if(!($resultat=$con_rols->delete($rol))){
            echo "<p style=\"color:#662222\">ERROR: ".$resultat."</p";
    }else{
            echo "<p>Element eliminat correctament.</p>";
            $ok=1;
    }
	
}else{
    $error="ERROR: No s'ha rebut la id de l'usuari.";
    echo "<p style=\"color:#662222\">".$error."</p>";
}

?>
<script language="JavaScript">ok=<?php echo $ok?></script>