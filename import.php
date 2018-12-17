<?php
require ("ayar.php"); 
include '../Classes/PHPExcel/IOFactory.php';
$ds          = DIRECTORY_SEPARATOR;  //1
$storeFolder = '../uploads';   //2

if (!empty($_FILES)) 
{
$tempFile = $_FILES['file']['tmp_name'];          //3             
$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
$targetFile =  $targetPath. $_FILES['file']['name'];  //5
move_uploaded_file($tempFile,$targetFile);
$inputFileName = $targetFile;
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
$excelSutunlar = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$i=0;
$eklenen=0;
$eklenemeyen=0;
    $sablonhata=0;
foreach($excelSutunlar as $excelSutun)
{
	$i++;
	$usern = $excelSutun['A'];
	$passn = $excelSutun['B'];
	$tcn = $excelSutun['C'];
	$isimn = $excelSutun['D'];
	$teln = $excelSutun['E'];
	$yetkin = $excelSutun['F'];
	if ($i==1){
		if ($usern != "Kullanıcı Adı" || $passn != "Şifre" || $tcn != "T.C. Kimlik No" || $isimn != "Adı Soyadı" || $teln != "Telefonu" ||	$yetkin != "Yetkisi")
		{
			
			
            $sablonhata=1;
			break;
		} 
	}
	if ($i>1)
	{
		$userRegex='/.{3,}/';
		$passRegex='/.{1,}/';
		$tcRegex='/\d{11}/';
		$isimRegex='/^[\w\sıüçğöÜİÇĞÖ]*$/';
		$telRegex='/^[5][0][5-7][0-9]{6}|^[5][3][0-9]{7}|^[5][4][0-9]{7}/';
		if(preg_match($userRegex, $usern))
			{  $usern=md5($usern);
				if(preg_match($passRegex, $passn))
					{ $passn=md5($usern);

						if(preg_match($tcRegex, $tcn))
						{

							if(preg_match($isimRegex, $isimn))
							{
								if(!empty($teln))
								{
									if(preg_match($telRegex, $teln))
									{
										if(($yetkin=="admin")||($yetkin=="Admin"))
										{
											$yetkin="Admin";

											$sql="select tc from kullanicilar WHERE tc='$tcn'";
											$sonuc1= mysqli_query($baglan,$sql);
											$satirsay=mysqli_num_rows($sonuc1);
											if ($satirsay>0)
											{
												$eklenemeyen++;
											} 
											else
											{
												$sql2="select username from kullanicilar WHERE username='$usern'";
												$sonuc2= mysqli_query($baglan,$sql2);
												$satirsay2=mysqli_num_rows($sonuc2);
												if ($satirsay2>0)
												{
													$eklenemeyen++;
												}
												else
												{
													mysqli_query($baglan,"insert into kullanicilar (username,password,tc,isimsoyad,tel,yetki) VALUES('".$usern."','".$passn."','".$tcn."','".$isimn."','".$teln."','".$yetkin."')");
													$eklenen++;
												}
											}
										}
										if(($yetkin=="user")||($yetkin=="User"))
										{
											$yetkin="User";
											$sql="select tc from kullanicilar WHERE tc='$tcn'";
											$sonuc1= mysqli_query($baglan,$sql);
											$satirsay=mysqli_num_rows($sonuc1);
											if ($satirsay>0)
											{
												$eklenemeyen++;
											} 
											else
											{
												$sql2="select username from kullanicilar WHERE username='$usern'";
												$sonuc2= mysqli_query($baglan,$sql2);
												$satirsay2=mysqli_num_rows($sonuc2);
												if ($satirsay2>0)
												{
													$eklenemeyen++;
												}
												else
												{
													mysqli_query($baglan,"insert into kullanicilar (username,password,tc,isimsoyad,tel,yetki) VALUES('".$usern."','".$passn."','".$tcn."','".$isimn."','".$teln."','".$yetkin."')");
													$eklenen++;
												}
											}
										}else{$eklenemeyen++;}
									}else{$eklenemeyen++;}
								}
								else
								{
									if(($yetkin=="admin")||($yetkin=="Admin"))
									{
										$yetkin="Admin";
										$sql="select tc from kullanicilar WHERE tc='$tcn'";
										$sonuc1= mysqli_query($baglan,$sql);
										$satirsay=mysqli_num_rows($sonuc1);
										if ($satirsay>0)
											{$eklenemeyen++;} else{
												$sql2="select username from kullanicilar WHERE username='$usern'";
												$sonuc2= mysqli_query($baglan,$sql2);
												$satirsay2=mysqli_num_rows($sonuc2);
												if ($satirsay2>0)
													{$eklenemeyen++;}else{
														mysqli_query($baglan,"insert into kullanicilar (username,password,tc,isimsoyad,tel,yetki) VALUES('".$usern."','".$passn."','".$tcn."','".$isimn."','".$teln."','".$yetkin."')");
														$eklenen++;
													}
												}
											}
											
											if(($yetkin=="user")||($yetkin=="User"))
											{
												$yetkin="User";
												$sql="select tc from kullanicilar WHERE tc='$tcn'";
												$sonuc1= mysqli_query($baglan,$sql);
												$satirsay=mysqli_num_rows($sonuc1);
												if ($satirsay>0)
												{
													$eklenemeyen++;
												}
												else
												{
													$sql2="select username from kullanicilar WHERE username='$usern'";
													$sonuc2= mysqli_query($baglan,$sql2);
													$satirsay2=mysqli_num_rows($sonuc2);
													if ($satirsay2>0)
													{
														$eklenemeyen++;
													}
													else
													{
														mysqli_query($baglan,"insert into kullanicilar (username,password,tc,isimsoyad,tel,yetki) VALUES('".$usern."','".$passn."','".$tcn."','".$isimn."','".$teln."','".$yetkin."')");
														$eklenen++;
													}
												}
											}
											else
											{
												$eklenemeyen++;
											}
										}
									}else{$eklenemeyen++;}
								}else{$eklenemeyen++;}
							}else{$eklenemeyen++;}
						}
						
										}


}
					unlink($inputFileName);
    if($sablonhata!=1){
					echo $eklenen." Adet Kayıt Başarıyla Eklendi. \n".$eklenemeyen." Adet Kayıt Eklenemedi.";
				}else {echo "Şablon Hatalı";}}
?>