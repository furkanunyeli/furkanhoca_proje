<?php
session_start();
require ("asset/admin/ayar.php");
$goster=""; 
if(isset($_SESSION["kulid"])){
	$query = mysqli_query($baglan,"SELECT * FROM kullanicilar where id='".$_SESSION["kulid"]."'");
	$numrows = mysqli_num_rows($query);
	if (!$numrows > 0) {
		redirect("index.php"); 
	}else{
		while($sonuc=mysqli_fetch_assoc($query))
		{
			$guest=$sonuc["isimsoyad"];
			$yetkili=$sonuc["yetki"];	
		}
		if($yetkili=="Admin"){$goster="Admin";}
	}
}else{
	if ((!isset($_COOKIE["rememberuser"]) or !isset($_COOKIE["rememberpass"])) or (!isset($_COOKIE["rememberuser"]) and !isset($_COOKIE["rememberpass"]))){

		redirect("index.php");
	}else{
		$user=$_COOKIE["rememberuser"];
		$pass=$_COOKIE["rememberpass"];
		$query = mysqli_query($baglan,"SELECT * FROM kullanicilar where username='".$user."' and password='".$pass."'");
		$numrows = mysqli_num_rows($query);
		if (!$numrows > 0) {
			redirect("index.php"); 
		}else{
			while($sonuc=mysqli_fetch_assoc($query))
			{
				$guest=$sonuc["isimsoyad"];
				$yetkili=$sonuc["yetki"];
			}if($yetkili=="Admin"){$goster="Admin";}

		}} }

		?> 
		<!DOCTYPE html>
		<html lang="tr">
		<head>
			<meta charset="utf-8">
			<title>User Sayfası</title>
			<link href="asset/css/bootstrap.min.css" rel="stylesheet">
			<link href="asset/css/dropzone.css" rel="stylesheet">
			<link href="asset/css/bootstrap-table.css" rel="stylesheet">
			<link href="asset/css/bootstrap-editable.css" rel="stylesheet" >
			<link href="asset/css/font-awesome.min.css" rel="stylesheet">
			<link href="asset/css/86618a522dcd0b92cc9a34866e45fa9e.css" rel="stylesheet"> 
			<link rel="stylesheet" type="text/css" href="asset/css/iEdit.css">
			<link rel="stylesheet" href="asset/css/style.css">
			<script src="asset/js/jquery-3.2.1.min.js"></script>
			<script src="asset/js/bootstrap.min.js"></script>
			<script src="asset/js/dropzone.js"></script>
			<script src="asset/js/bootstrap-table.js"></script>
			<script src="asset/js/bootstrap-table-export.js"></script>
			<script src="asset/js/bootstrap-table-tr-TR.js"></script>
			<script src="asset/js/40aab700698a291c5ce712a44ec8bc34.js"></script>
			<script src="asset/js/0e8ece31c98757dd3816d14f69a14d98.js"></script> 
			<script type="text/javascript" src="asset/js/iEdit.js"></script>
			<script type="text/javascript" src="asset/js/script.js"></script>
		</head>

		<body>
			<nav class="navbar navbar-default navbar-inverse" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <span class="navbar-brand">Web Rehber Otomasyonu</span>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						
						<li>
							<a href="<?php if ($goster=="Admin"){ echo $goster.".php";} ?>"><?php if ($goster=="Admin"){echo $goster." Paneli"; }?></a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a><?php echo $guest ?></a>
						</li>
						
						<li>
							<a href="asset/admin/cikis.php">Logout</a>
						</li>
					</ul>
				</div>
			</nav>
			<div class="container">
				<div id="toolbar">
					<button id="remove" class="btn btn-danger" disabled>
						<i class="glyphicon glyphicon-remove"></i> Seçilileri Sil</button> 
						<button data-toggle="modal" data-target="#musteripanel"class="btn btn-success" >
							<i class="glyphicon glyphicon-plus"></i> Kayıt Ekle</button> 
							<button data-toggle="modal" data-target="#musteriupdate" class="btn btn-primary" >
								<i class="glyphicon glyphicon-import"></i> Excelden Yükle</button>
							</div>
							<div class="row-table" >
								<table id="table"  
								class="table table-bordered table-striped"
								data-height="530"
								data-locale="tr-TR"
								data-toggle="table" 
								data-toolbar="#toolbar"
								data-search="true"
								data-show-refresh="true"
								data-show-columns="true"
								data-pagination="true" 
								data-page-list="[25, 50, 100, ALL]"
								data-show-footer="false"
								data-side-pagination="client"
								data-url="asset/admin/tablecustomer.php"
								data-click-to-select="true"
								data-show-export="true">
								<thead>
									<tr>
										<th data-valign="middle"  data-field="state" data-checkbox="true" ></th>
										<th data-valign="middle" data-formatter="runningFormatter">SIRA NO</th>
										<th data-valign="middle" data-field="adsoy" data-align="center">AD SOYAD</th>
										<th data-valign="middle" data-field="sirket" data-align="center">ÜNVANI</th>
										<th data-valign="middle" data-field="gsm1" data-align="center">CEP TELEFONU</th>
										<th data-valign="middle" data-click-to-select="false" data-events="operateEvents" data-formatter="operateFormatter" data-field="operate" data-align="center">KAYIT GÖRÜNTÜLE<br />KAYIT DÜZENLE<br />SİL</th>
									</tr>
								</thead>
							</table> 
						</div> 
					</div> 
					<div class="modal fade"  id="musteripanel" tabindex="-1" role="dialog" aria-labelledby="Update" aria-hidden="true"> 
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content">
								<div class="modal-header"> 
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span> 
									</button> 
									<h5 id="modalHeader" class="modal-title">Müşteri Ekleme Ekranı</h5> 
								</div> 
								<div class="modal-body"> 
									<form id="registerform" name="registerform" method="post" class="form-horizontal">
										<div class="form-group" style="overflow: auto"> 
											<div class="container-fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-8"> 
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Adı Soyadı</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="adsoyad" type="text" placeholder="Ad Soyad Giriniz"  id="adsoyad" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Unvanı</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="Unvan" type="text" placeholder="Kişinin Unvanını Giriniz"  id="unvani" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">İşyeri</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="isyeri" type="text" placeholder="İşyeri Adını Girin"  id="isyeri" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Gsm Numarası </label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="gsm1" type="text" placeholder="05XXXXXXXXX"  id="gsm1" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Gsm2 Numarası</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="gsm2" type="text" placeholder="05XXXXXXXXX"  id="gsm2" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">E-posta Adresi</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="eposta" type="text" placeholder="E-Posta Adresini Giriniz"  id="eposta" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Ev-İş Tel</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="eitel" type="text" placeholder="0XXXXXXXXXX"  id="eitel" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Adres-Ev</label> 
																	<div class="col-xs-6">
																		<textarea style="height:90px; resize: none;" class="form-control" id="textarea" name="evadres" placeholder="Ev Adresi Giriniz"></textarea>
																	</div>
																</div>
																
																
															</div>
															<div class="col-md-3" style="margin-left:-110px;" >
																
																<img id="result"  src="asset/images/foto.png"  class="resim2" alt="" style="margin-left:110px;" />
																<label class="file" style="margin-left:110px;">
																	<input type="file" id="file"   required >
																	<span class="file">
																		<input type="hidden" id="resim" name="resim" />
																		<p>Resim&nbsp;Seç!</p> 
																	</span>
																</label><div class="form-group"> 
																	<label class="col-xs-3 control-label" style="margin-left:-50px;">Açıklama</label> 
																	<div class="col-lg-8">
																		<textarea style="height:220px; width: 300px ;margin-left:20px;; margin-top: 5px; resize: none;" class="form-control" id="not" name="not" ></textarea>
																	</div>
																</div>
																
																
																
																

															</div>
														</div>
													</div>
												</div>
											</div>
										</div></form>
									</div>
									
									
									<div class="modal-footer">
										<div class="form-group"> 
											<div class="col-xs-6 col-xs-offset-2">
												<button name="yukle" id="yukle" type="button" class="btn btn-primary">Kaydet</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>

											</div> 
										</div> 
									</div>
								</div>
							</div>
							
						</div>
						<div class="modal fade" id="updModal" tabindex="-1" role="dialog" aria-labelledby="Update" aria-hidden="true"> 
							<div class="modal-dialog modal-lg"> 
								<div class="modal-content">
									<div class="modal-header"> 
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span> 
										</button> 
										<h5 id="modalHeader" class="modal-title">Müşteri Güncelleme Forumu</h5> 
									</div> 
									<div class="modal-body"> <!-- The form is placed inside the body of modal --> 
										<form id="registerform" name="registerform" method="post" class="form-horizontal">
										<div class="form-group" style="overflow: auto"> 
											<div class="container-fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-8"> 
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Adı Soyadı</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="gadsoyad" type="text" placeholder="Ad Soyad Giriniz"  id="gadsoyad" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Unvanı</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="gUnvan" type="text" placeholder="Kişinin Unvanını Giriniz"  id="gUnvan" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">İşyeri</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="gisyeri" type="text" placeholder="İşyeri Adını Girin"  id="gisyeri" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Gsm Numarası </label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="ggsm1" type="text" placeholder="05XXXXXXXXX"  id="ggsm1" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Gsm2 Numarası</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="ggsm2" type="text" placeholder="05XXXXXXXXX"  id="ggsm2" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">E-posta Adresi</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="geposta" type="text" placeholder="E-Posta Adresini Giriniz"  id="geposta" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Ev-İş Tel</label> 
																	<div class="col-xs-6">
																		<input class="form-control" name="geitel" type="text" placeholder="0XXXXXXXXXX"  id="geitel" />
																	</div>
																</div>
																<div class="form-group"> 
																	<label class="col-xs-3 control-label">Adres-Ev</label> 
																	<div class="col-xs-6">
																		<textarea style="height:90px; resize: none;" class="form-control" id="gevadres" name="gevadres" placeholder="Ev Adresi Giriniz"></textarea>
																	</div>
																</div>
																
																
															</div>
															<div class="col-md-3" style="margin-left:-110px;" >
																
																<img id="gresim2"   name="gresim2" width="120" height="120"  class="gresim2" alt="" style="margin-left:110px;" />
																<label class="file" style="margin-left:110px;">
																	<input type="file" id="ufile"   required >
																	<span class="file">
																		<input type="hidden"  id="gresim" name="gresim">
																		Resim&nbsp;Değiştir
																	</span>
																</label><div class="form-group"> 
																	<label class="col-xs-3 control-label" style="margin-left:-50px;">Açıklama</label> 
																	<div class="col-lg-8">
																		<textarea style="height:220px; width: 300px ;margin-left:20px;; margin-top: 5px; resize: none;" class="form-control" id="gnot" name="gnot" ></textarea>
																	</div>
																</div>
																
																
																
																

															</div>
												
														</div>
														<div class="form-group"> 
												<div class="col-xs-6 col-xs-offset-4">
													<button id="update" type="submit" class="btn btn-primary">Güncelle</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button> 
												</div> 
											</div> 
													</div>
												</div>
											</div>
										</div></form> 
									</div>
								</div> 
							</div> 
						</div>
						<script>
							function runningFormatter(value, row, index) {return index+1;}    
							var $table = $('#table'),
							$remove = $('#remove'),
							selections = [];
							function initTable() {
								$table.bootstrapTable({
									height: getHeight(),
									columns: [

									{
										field: 'state',
										checkbox: true,

										align: 'center',
										valign: 'middle'
									}, {
										title: 'Item ID',
										field: 'id',
										align: 'center',
										valign: 'middle',
										sortable: true,

									},      
									{
										field: 'operate',
										title: 'Item Operate',
										align: 'center',
										events: operateEvents,
										formatter: operateFormatter
									}
									]

								});
								setTimeout(function () {
									$table.bootstrapTable('resetView');
								}, 200);
								$table.on('check.bs.table uncheck.bs.table ' +
									'check-all.bs.table uncheck-all.bs.table', function () {
										$remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
										selections = getIdSelections();
									});
								$table.on('expand-row.bs.table', function (e, index, row, $detail) {
									if (index % 2 == 1) {
										$detail.html('Loading from ajax request...');
										$.get('LICENSE', function (res) {
											$detail.html(res.replace(/\n/g, '<br>'));
										});
									}
								});
								$table.on('all.bs.table', function (e, name, args) {
									console.log(name, args);
								});
								$remove.click(function () {
									var ids = getIdSelections();
									$table.bootstrapTable('remove', {
										field: 'id',
										values: ids
									});{$.ajax({
										url: 'asset/admin/aja.php',
										data: {action: ids},
										type: 'post',
										success: function() { $('#table').bootstrapTable('refresh');
									}
								});}
									$remove.prop('disabled', true);
								});
								$(window).resize(function () {
									$table.bootstrapTable('resetView', {
										height: getHeight()
									});
								});
							}
							var arr;
							function getSelectedRow() {
								var index = $table.find('tr.success').data('index');
								return $table.bootstrapTable('getData')[index];
							}
							function getIdSelections() {
								return $.map($table.bootstrapTable('getSelections'), function (row) {
									return row.id
								});
							}
							function responseHandler(res) {
								$.each(res.rows, function (i, row) {
									row.state = $.inArray(row.id, selections) !== -1;
								});
								return res;
							}
							function detailFormatter(index, row) {
								var html = [];
								$.each(row, function (key, value) {
									html.push('<p><b>' + key + ':</b> ' + value + '</p>');
								});
								return html.join('');
							}
							function operateFormatter(value, row, index) {
								return [
								'<a class="like" href="javascript:void(0)" title="Müşteri Bilgilerini Görüntüle">',
								'<i class="glyphicon glyphicon-search" />',
								'</a> ',
								'<a class="update" href="javascript:void(0)" title="Müşteri Bilgilerini Güncelle">',
								'<i class="glyphicon glyphicon-edit" />',
								'</a>     ',
								'<a class="remove" href="javascript:void(0)" title="Müşteriyi Sil">',
								'<i class="glyphicon glyphicon-remove"> </i>',
								'</a> '
								].join('');
							}
							window.operateEvents = {
								'click .like': function (e, value, row, index) {
									$("#updModal").modal('show');/*
									$("#uptc").val(row.tc);
									$("#upns").val(row.isimsoyad);
									$("#uptel").val(row.tel);
									$("#upyetki").val(row.yetki);
									$("#upid").val(row.id);*/
								},
								'click .remove': function (e, value, row, index) {
									$table.bootstrapTable('remove', {
										field: 'id',
										values: [row.id]
									});{$.ajax({
										url: 'asset/admin/aja.php',
										data: {action: [row.id]},
										type: 'post',
										success: function() { $('#table').bootstrapTable('refresh');
									}
								});
								}
							},
							'click .update': function (e, value, row, index) {
								$("#updModal").modal('show');
								$("#gadsoyad").val(row.adsoy);
								$("#gUnvan").val(row.unvan);
								$("#gisyeri").val(row.sirket);
								$("#ggsm1").val(row.gsm1);
								$("#ggsm2").val(row.gsm2);
								$("#geposta").val(row.eposta);
								$("#geitel").val(row.istel);
								$("#gevadres").val(row.isadres);
								$("#gnot").val(row.kisinot);
								if (row.resim){
								$("#gresim2").attr("src","asset/photos/"+row.resim);}
								else {$("#gresim2").attr("src","asset/images/foto.png");}
								/*
								$("#userpassModal").modal('show');
								$("#upuserid").val(row.id);*/
							}
						};
						function totalTextFormatter(data) {
							return 'Total';
						}
						function totalNameFormatter(data) {
							return data.length;
						}
						function getHeight() {
							return $(window).height() - $('h1').outerHeight(true);
						}
						$(function () {
							var scripts = [
							location.search.substring(1) || 'asset/js/bootstrap-table.js',
							'asset/js/bootstrap-table-export.js',
							'asset/js/tableExport.js'
							],
							eachSeries = function (arr, iterator, callback) {
								callback = callback || function () {};
								if (!arr.length) {
									return callback();
								}
								var completed = 0;
								var iterate = function () {
									iterator(arr[completed], function (err) {
										if (err) {
											callback(err);
											callback = function () {};
										}
										else {
											completed += 1;
											if (completed >= arr.length) {
												callback(null);
											}
											else {
												iterate();
											}
										}
									});
								};
								iterate();
							};
							eachSeries(scripts, getScript, initTable);
						});

						function getScript(url, callback) {
							var head = document.getElementsByTagName('head')[0];
							var script = document.createElement('script');
							script.src = url;
							var done = false;
							script.onload = script.onreadystatechange = function() {
								if (!done && (!this.readyState ||
									this.readyState == 'loaded' || this.readyState == 'complete')) {
									done = true;
								if (callback)
									callback();
								script.onload = script.onreadystatechange = null;
							}
						};
						head.appendChild(script);
						return undefined;
					}
					var onResize = function() {
						$("body").css("padding-top", $(".navbar-fixed-top").height());
					};
					$(window).resize(onResize);
					$(function() {
						onResize();
					});
				</script>
			</body>
			</html>