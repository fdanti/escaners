<?php
require_once '../../lib/Constants.php';
require_once './configDB.php';
require_once '../../lib/dao/PermisosDAO.php';
require_once '../../lib/model/Permis.php';

ini_set('display_errors', 1);

$con_permis = new PermisosDAO();

$error="";
$numerrors=0;
$ok=0;

if(isset($_POST['idRepo'])){
	$idRepo=$_POST['idRepo'];
	if($idRepo==NULL || $idRepo==""){
		$error.="ERROR: No s'ha introduït la id del repositori.<br>";
		$numerrors++;
	}
}else{
	$error.="ERROR: No s'ha introduït la id del repositori.<br>";
	$numerrors++;
}
if(isset($_POST['idRol'])){
	$idRol=$_POST['idRol'];
	if($idRol==NULL || $idRol==""){
		$error.="ERROR: No s'ha introduït la id de l'usuari.<br>";
		$numerrors++;
	}
}else{
	$error.="ERROR: No s'ha introduït la id de l'usuari.<br>";
	$numerrors++;
}

if($numerrors==0){
    
        $permis = new Permis($idRepo,$idRol);
	   
	if(!($resultat=$con_permis->save($permis))){
		echo "<p style=\"color:#662222\">ERROR: ".$resultat."</p";
	}else{
		echo "<p>Element afegit correctament.</p>";
		$ok=1;
	}
}else{
	echo "<p style=\"color:#662222\">".$error."</p>";
}

?>
<script language="JavaScript">ok=<?php echo $ok?></script>