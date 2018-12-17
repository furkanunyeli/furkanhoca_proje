<?php
require ("ayar.php");
//$action = ($_POST['action']);
if (isset($_POST["action"])){

    
    $action = ($_POST['action']);
    
//$data=implode(",",$action);
foreach($action as $secilenid){
    
mysqli_query($baglan,"delete from kullanicilar where id=".$secilenid);
echo "oldu";}
}else{echo "olmadı";}
//    echo $action;*/

?>