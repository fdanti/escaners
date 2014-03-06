<?php
require_once '../../lib/Constants.php';
require_once './configDB.php';
require_once '../../lib/dao/RepositorisDAO.php';
require_once '../../lib/model/Repositori.php';

require_once '../../lib/dao/RolsFtpDAO.php';
require_once '../../lib/model/RolFtp.php';

ini_set('display_errors', 1);

$con_repos = new RepositorisDAO();
$con_ftp = new RolsFtpDAO();

$error="";
$ok=0;

if(isset($_GET['id'])){

    $id=$_GET['id'];

    $repositori = $con_repos->get($id);
    $ftp = $con_ftp->getByUser($repositori->getNom());

    if($con_ftp->delete($ftp)){
        if(!($resultat=$con_repos->delete($repositori))){
                echo "<p style=\"color:#662222\">ERROR: ".$resultat."</p";
        }else{
                echo "<p>Element eliminat correctament.</p>";
                $ok=1;
        }
    }else{
        echo "<p style=\"color:#662222\">ERROR: ".$resultat."</p";
    }
	
}else{
    $error="ERROR: No s'ha rebut la id del dispositiu.";
    echo "<p style=\"color:#662222\">".$error."</p>";
}

?>
<script language="JavaScript">ok=<?php echo $ok?></script>