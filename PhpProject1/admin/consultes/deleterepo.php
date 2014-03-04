<?php
require_once '../../lib/Constants.php';
require_once './configDB.php';
require_once '../../lib/dao/RepositorisDAO.php';
require_once '../../lib/model/Repositori.php';

ini_set('display_errors', 1);

$con_repos = new RepositorisDAO();

$error="";
$ok=0;

if(isset($_GET['id'])){

    $id=$_GET['id'];

    $repositori = new Repositori($id,"",0,0,"");

    if(!($resultat=$con_repos->delete($repositori))){
            echo "<p style=\"color:#662222\">ERROR: ".$resultat."</p";
    }else{
            echo "<p>Element eliminat correctament.</p>";
            $ok=1;
    }
	
}else{
    $error="ERROR: No s'ha rebut la id del dispositiu.";
    echo "<p style=\"color:#662222\">".$error."</p>";
}

?>
<script language="JavaScript">ok=<?php echo $ok?></script>