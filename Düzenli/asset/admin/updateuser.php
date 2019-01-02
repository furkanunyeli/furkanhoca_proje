<?php
require ("ayar.php");
if (isset($_POST)){
$pass=md5($_POST["uppass1"]);
$gelenid=$_POST["upuserid"];

$sorgu="update kullanicilar set password='".$pass."' where id='".$gelenid."'";  
if(mysqli_query($baglan,$sorgu)){echo "oldu";}
 }


?>