<?php
require_once '../../lib/Constants.php';
require_once './configDB.php';
require_once '../../lib/dao/PermisosDAO.php';
require_once '../../lib/model/Permis.php';

ini_set('display_errors', 1);

$con_permis = new PermisosDAO();

$error="";
$ok=0;

if(isset($_GET['idRepo']) && isset($_GET['idRol'])){

    $idRepo=$_GET['idRepo'];
    $idRol=$_GET['idRol'];

    $permis = new Permis($idRepo,$idRol);

    if(!($resultat=$con_permis->delete($permis))){
            echo "<p style=\"color:#662222\">ERROR: ".$resultat."</p";
    }else{
            echo "<p>Element eliminat correctament.</p>";
            $ok=1;
    }
	
}else{
    $error="ERROR: No s'ha rebut la id de l'usuari o el dispositiu.";
    echo "<p style=\"color:#662222\">".$error."</p>";
}

?>
<script language="JavaScript">ok=<?php echo $ok?></script>