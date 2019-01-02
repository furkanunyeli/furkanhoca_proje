<?php
require ("asset/admin/ayar.php");
session_start();
if (isset($_SESSION["kulid"])){
redirect("user.php");}


if (isset($_COOKIE["rememberuser"]) and isset($_COOKIE["rememberpass"])){
$user = $_COOKIE["rememberuser"];
$pass  = $_COOKIE["rememberpass"];
$query = mysqli_query($baglan,"SELECT * FROM kullanicilar where username='".$user."' and Password='".$pass."'");
$numrows = mysqli_num_rows($query);
if ($numrows > 0) {
while ($kulbul=mysqli_fetch_array($query)){
  $_SESSION["kulid"]=$kulbul["isimsoyad"];}
  
  redirect("user.php");
}}


?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Yönetim Paneli</title>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<META http-equiv="Cache-Control" content="no-cache">
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/login.css">
<script src= "asset/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src= "asset/js/bootstrap-notify.js" type="text/javascript"></script>
    </META></META></head>
<body>


    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="asset/images/2.jpg" />
            <p id="profile-name" class="profile-name-card"></p>

            <form  id="form" class="form-signin" role="form" name="gonder" action="user.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="user" name="user" class="form-control" placeholder="Kullanıcı Adınız" required autofocus>
        <input type="password" id="pass" name="pass" class="form-control" placeholder="Şifreniz" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" id="hatirla" name="remember-me"> Beni  Hatırla
                    </label>
                </div>
<button class="btn btn-lg btn-primary btn-block btn-signin" type="button" id="gbuton">Gönder</button>
            </form><!-- /form --> <noscript><h4>
  Bu sitenin tüm fonksiyonlarının çalışması için JavaScript'i aktif etmeniz gerekmektedir.</h4><h5><br>
  <a href="http://www.enable-javascript.com/tr/" target="_blank">
  JavaScript'i nasıl etkinleştirebileceğinize yönelik talimatlara buradan ulaşabilirsiniz
  </a>.</h5>
</noscript>
        </div><!-- /card-container -->
    </div><!-- /container -->


<script>
	$(document).ready(function(){
    $('#pass').keypress(function(e){
      if(e.keyCode==13)
      $('#gbuton').click();
    });
});
$(document).ready(function(){
    $('#user').keypress(function(e){
      if(e.keyCode==13)
      $('#pass').focus();
    });
});
	
	$(document).ready(function(){$("#gbuton").click(function(){var degerler = $("form").serialize();
                                                       $.post("asset/admin/ajax.php",degerler,function(cevap){
	 if (cevap=='oldu'/* && document.getElementById('hatirla').value==null*/){
	 oldu();setTimeout(function(){document.forms["form"].submit();},6000); }
				else
				{
				olmadi();setTimeout(function(){window.location.href="index.php";},6000);
				}});});});
				
				
 function oldu(){var notify = $.notify('<strong>Kontrol Ediliyor</strong> Lütfen Sayfayı Kapatmayınız', {allow_dismiss: false,showProgressbar: true,placement: {from: "top",align: "center"}});setTimeout(function() {notify.update({'type': 'success', 'message': '<strong>Başarılı</strong> Giriş Yapılıyor', 'progress': 30});}, 3500);};
 function olmadi(){var notify = $.notify('<strong>Kontrol Ediliyor</strong> Lütfen Sayfayı Kapatmayınız', {allow_dismiss: false,showProgressbar: true,placement: {from: "top",align: "center"}});setTimeout(function() {notify.update({'type': 'danger', 'message': '<strong>Hatalı</strong> Giriş Bilgileri', 'progress': 30});}, 3500);};
  
</script>
</body></html>