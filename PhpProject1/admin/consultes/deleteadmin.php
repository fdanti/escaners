<?php
require_once '../../lib/Constants.php';
require_once './configDB.php';
require_once '../../lib/dao/RolsDAO.php';
require_once '../../lib/model/Rol.php';

ini_set('display_errors', 1);

$con_rols = new RolsDAO();

$error="";
$numerrors=0;
$ok=0;

if(isset($_GET['idRol'])){
	$idRol=$_GET['idRol'];
	if($idRol==NULL || $idRol==""){
		$error.="ERROR: No s'ha introduït la id de l'usuari.<br>";
		$numerrors++;
	}
}else{
	$error.="ERROR: No s'ha introduït la id de l'usuari.<br>";
	$numerrors++;
}

if($numerrors==0){
    
        $rol = $con_rols->getByID($idRol);
        $rol->setAdmin(0);
	   
	if(!($resultat=$con_rols->save($rol))){
		echo "<p style=\"color:#662222\">ERROR: ".$resultat."</p";
	}else{
		echo "<p>Element modificat correctament.</p>";
		$ok=1;
	}
}else{
	echo "<p style=\"color:#662222\">".$error."</p>";
}

?>
<script language="JavaScript">ok=<?php echo $ok?></script>