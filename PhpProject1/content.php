
<?php
require_once './lib/base.inc.php';

if(!isset($_GET['idrepo'])){
    $idrepo=0;
}else{
    $idrepo=$_GET['idrepo'];
}

$con_repos = new RepositorisDAO();

$repositori=$con_repos->get($idrepo);
        
//$path = './files/id'.$repositori->getId().'/';
$dir = opendir(ConfigFS::PATH.$repositori->getNom());
while($file=readdir($dir)){
    if(!is_dir($file) && $file[0]!='.'){
        $data[] = array($file, date("Y-m-d H:i:s",filemtime($path.'/'.$file)));
        $files[] = $file;
        $dates[] = date("Y-m-d H:i:s",filemtime($path.'/'.$file));
    }
}
closedir($dir);
if(isset($data)){
    array_multisort($dates, SORT_DESC, $data);
    ?>
                <div align="center">
                    <table width="90%" cellspacing="0" border="1">
    <?php
    foreach($data as $fitxer){?>
                        <tr>
                            <td width="70%"><a href="<?php echo ConfigFS::PATH.$repositori->getNom()."/";?><?php echo $fitxer[0];?>" target="_blank"><?php echo $fitxer[0];?></a></td>
                            <td width="30%"><?php echo $fitxer[1]?></td>
                        </tr>
    <?php }?>
                    </table>
                </div>
<?php }else{?>
<p>Aquest repositori no conté cap fitxer</p>
<?php } ?>
