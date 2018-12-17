<?php
require ("ayar.php");
session_start();
if($_POST["user"] and ($_POST["pass"])){
	$user = $_POST["user"];
	$pass  = $_POST["pass"];
    if (isset($_POST["remember-me"])){
	$remember=$_POST["remember-me"];}else{
      $remember=null;  
    }
    
	$query = mysqli_query($baglan,"SELECT * FROM kullanicilar where username='".md5($user)."' and Password='".md5($pass)."'");


	$numrows = mysqli_num_rows($query);
	if ($numrows > 0) {
		if ($remember!=null)
		{

			while($bulid=mysqli_fetch_assoc($query)){
				$_SESSION["kulid"] = $bulid["id"];
			}
			
			setcookie("rememberuser", md5($user), time() + (60*60),"/");
			setcookie("rememberpass", md5($pass), time() + (60*60),"/");
//echo "post,cookie yok, , kayıt war, hatırla";
			echo "oldu";
		} else {
			while($bulid=mysqli_fetch_assoc($query)){
				$_SESSION["kulid"] = $bulid["id"];}	
//echo "post, cookie yok, kayıt war";
				echo "oldu";}
			} else { 
//echo "post,cookie yok,kayıt yok";
				echo "olmadi";
			}}else{
				if ((!isset($_COOKIE["rememberuser"]) or !isset($_COOKIE["rememberpass"])) or (!isset($_COOKIE["rememberuser"]) and !isset($_COOKIE["rememberpass"]))){
					redirect("../../index.php");}else{	
						$user=$_COOKIE["rememberuser"];
						$pass=$_COOKIE["rememberpass"];
						$query = mysqli_query($baglan,"SELECT * FROM kullanicilar where username='".$user."' and password='".$pass."'");
						$numrows = mysqli_num_rows($query);
						
						while($bulid=mysqli_fetch_assoc($query)){
							$_SESSION["kulid"] = $bulid["id"];}
							if ($numrows > 0) {redirect(".../../user.php");
						}else{redirect("../../index.php");
					}
				}
			}
			?>