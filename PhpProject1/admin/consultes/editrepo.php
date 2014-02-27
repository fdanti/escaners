<?php
require_once '../../lib/Constants.php';
require_once './configDB.php';
require_once '../../lib/dao/RepositorisDAO.php';
require_once '../../lib/dao/RolsDAO.php';
require_once '../../lib/dao/PermisosDAO.php';
require_once '../../lib/model/Repositori.php';
require_once '../../lib/model/Rol.php';
require_once '../../lib/model/Permis.php';

ini_set('display_errors', 1);

$con_repos = new RepositorisDAO();
$con_rols = new RolsDAO();
$con_permisos = new PermisosDAO();

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

if(isset($_POST['usuaris'])){
    $usuaris=$_POST['usuaris'];
    if($usuaris==NULL || $usuaris==""){
        $afegir=false;
    }else{
        $afegir=true;
    }
}

if($numerrors==0){
    
        $repositori = new Repositori($idRepo, $ip, $nom, $notes);
	   
	if(!($resultat=$con_repos->save($repositori))){
            echo "<p style=\"color:#662222\">ERROR: ".$resultat."</p";
	}else{
            if($afegir){
                $usuaris=  split(",", $usuaris);
                foreach($usuaris as $usuari){
                    $nouuser = new Rol("",$usuari,"",0,0);
                    if(!$con_rols->saveLdap($nouuser)){
                        echo "<p style=\"color:#662222\">".$error."</p>";
                        $numerrors++;
                    }else{
                        $idRol=$con_rols->getLast();
                        $permis=new Permis($idRepo,$idRol);
                        if(!$con_permisos->save($permis)){
                            $numerrors++;
                            echo "<p>ERROR: Ha succeït un error en l'introducció dels usuaris</p>";
                        }
                    }
                }
                if($numerrors==0){
                    echo "<p>Element afegit correctament.</p>";
                    $ok=1;
                }else{
                    echo "<p>ERROR: Ha succeït un error en l'introducció dels usuaris</p>";
                }
            }else{
                echo "<p>Element modificat correctament.</p>";
                $ok=1;
            }
	}
}else{
	echo "<p style=\"color:#662222\">".$error."</p>";
}

?>
<script language="JavaScript">ok=<?php echo $ok?></script>