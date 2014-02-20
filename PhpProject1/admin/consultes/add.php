<?php
require_once '../../lib/Constants.php';
require_once './configDB.php';
require_once '../../lib/dao/RepositorisDAO.php';
require_once '../../lib/model/Repositori.php';

ini_set('display_errors', 1);

$con_repos = new RepositorisDAO();

$error="";
$numerrors=0;
$ok=0;

if(isset($_POST['ip'])){
	$ip=$_POST['ip'];
	if($ip==NULL || $ip==""){
		$error.="ERROR: No s'ha introduït la ip.<br>";
		$numerrors++;
	}
}else{
	$error.="ERROR: No s'ha introduït la ip.<br>";
	$numerrors++;
}
if(isset($_POST['nom'])){
	$nom=$_POST['nom'];
	if($nom==NULL || $nom==""){
		$error.="ERROR: No s'ha introduït el nom de l'escàner.<br>";
		$numerrors++;
	}
}else{
	$error.="ERROR: No s'ha introduït el nom de l'escàner.<br>";
	$numerrors++;
}

if(isset($_POST['notes'])){
    $notes=$_POST['notes'];
}else{
    $notes="";
}

if($numerrors==0){
    
        $repositori = new Repositori("", $ip, $nom, $notes);
	   
	if(!($resultat=$con_repos->save($repositori))){
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