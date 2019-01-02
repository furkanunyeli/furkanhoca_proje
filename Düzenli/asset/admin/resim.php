<?php
require ("ayar.php");
if (isset($_POST)){
$data = $_POST['resim'];
    if ($data!="asset/images/foto.png"){
//removing the "data:image/png;base64," part
$uri =  substr($data,strpos($data,",")+1);
    $filename=date("YmdHis").".png";
    $pathfile="../photos/".$filename;
file_put_contents($pathfile, base64_decode($uri));
$resimyol=$filename;

}else{
        $resimyol="foto.png";
    }


$adsoy=$_POST["adsoyad"];
$unvan=$_POST["Unvan"];
$sirket=$_POST["isyeri"];
$gsm1=$_POST["gsm1"];
$gsm2=$_POST["gsm2"];
$eposta=$_POST["eposta"];
$istel=$_POST["eitel"];
$isadres=$_POST["evadres"];
$resim=$resimyol;
$kisinot=$_POST["not"];    
    
$sorgu="INSERT INTO musteriler(adsoy, unvan, sirket, eposta, gsm1, gsm2, istel, isadres, kisinot, resim) VALUES ('".$adsoy."','".$unvan."','".$sirket."','".$eposta."','".$gsm1."','".$gsm2."','".$istel."','".$isadres."','".$kisinot."','".$resim."')";
    if (mysqli_query($baglan,$sorgu)){
		
	
    echo "oldu";
}}
?>