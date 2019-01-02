<?php
$ayardns="localhost";
$ayaruser="root";
$ayarpass="1234";
$ayardb="main";
$baglan=mysqli_connect($ayardns,$ayaruser,$ayarpass,$ayardb);
if(mysqli_errno($baglan)>0)
{
echo mysqli_error($baglan);
die();
mysqli_close($baglan);
}
mysqli_set_charset($baglan, "utf8");
function Redirect($url){
if (!headers_sent()){  
        header('Location: '.$url); exit; 
    }else{ 
        echo '<script type="text/javascript">'; 
        echo 'window.location.href="'.$url.'";'; 
        echo '</script>'; 
        echo '<noscript>'; 
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />'; 
        echo '</noscript>'; exit; 
    } }
function giristest($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

$liste	= mysqli_query($baglan,"select * from kullanicilar");
$listecustomer=mysqli_query($baglan,"select * from musteriler");
	
?>