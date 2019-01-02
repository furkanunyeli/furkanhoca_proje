<?php
require ("ayar.php");
if (isset($_POST)){
$tc=$_POST["uptc"];
$gelenid=$_POST["upid"];
$isim=$_POST["upns"];
$tel=$_POST["uptel"];
$yetki=$_POST["upyetki"];
$sql="select * from kullanicilar WHERE tc='$tc'";
 
$sonuc1= mysqli_query($baglan,$sql);
$satirsay=mysqli_num_rows($sonuc1);
 
if ($satirsay>0)
{
$sql="select * from kullanicilar WHERE id='$gelenid'";
$sonuc1= mysqli_fetch_array(mysqli_query($baglan,$sql),MYSQLI_ASSOC); 
if ($sonuc1["tc"]==$tc){
	
$sorgu="update kullanicilar set tc='".$tc."',isimsoyad='".$isim."',tel='".$tel."',yetki='".$yetki."' where id='".$gelenid."'";  
if(mysqli_query($baglan,$sorgu)){echo "oldu";}
}else{echo "Bu TC Kimlik No daha önce kaydedilmiş";}}else{
    $sorgu="update kullanicilar set tc='".$tc."',isimsoyad='".$isim."',tel='".$tel."',yetki='".$yetki."' where id='".$gelenid."'";  
if(mysqli_query($baglan,$sorgu)){echo "oldu";}
 }}


?>