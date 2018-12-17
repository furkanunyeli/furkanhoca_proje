<?php
require ("ayar.php");

if (isset($_POST)){
	$tc=$_POST["tc"];
	$isim=$_POST["adsoyad"];
	$tel=$_POST["tel"];
	$user=md5($_POST["user"]);
	$pass=md5($_POST["pass"]);
	$yetki=$_POST["yetki"];
	$sql="select tc from kullanicilar WHERE tc='$tc'";

	$sonuc1= mysqli_query($baglan,$sql);
	$satirsay=mysqli_num_rows($sonuc1);

	if ($satirsay>0)
	{
		echo "Bu TC Kimlik No daha önce kaydedilmiş";

	} else{
		$sql2="select username from kullanicilar WHERE username='$user'";

		$sonuc2= mysqli_query($baglan,$sql2);
		$satirsay2=mysqli_num_rows($sonuc2);

		if ($satirsay2>0)
			{ echo "Bu Kullanıcı adı daha önce kaydedilmiş";}else{   
				$sorgu="INSERT INTO kullanicilar (username, password, tc, isimsoyad, tel, yetki) VALUES ('".$user."','".$pass."','".$tc."','".$isim."','".$tel."','".$yetki."')";    
				mysqli_query($baglan,$sorgu);
				echo "oldu";}

			}}

			?>