<?php
session_start();
require ("asset/admin/ayar.php"); 
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
			$adminid= $sonuc["id"];
		}
		if($yetkili=="User"){redirect("user.php");}
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
			}if($yetkili=="User"){redirect("user.php");}

		}} }

		?> 
		<!DOCTYPE html>
		<html lang="tr">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Admin Sayfası</title>
			<link href="asset/css/bootstrap.min.css" rel="stylesheet">
			<link href="asset/css/dropzone.css" rel="stylesheet">
			<link href="asset/css/bootstrap-table.css" rel="stylesheet">
			<link href="asset/css/bootstrap-editable.css" rel="stylesheet" >
			<link href="asset/css/font-awesome.min.css" rel="stylesheet">
			<link href="asset/css/86618a522dcd0b92cc9a34866e45fa9e.css" rel="stylesheet"> 
			<script src="asset/js/jquery-3.2.1.min.js"></script>
			<script src="asset/js/bootstrap.min.js"></script>
			<script src="asset/js/dropzone.js"></script>
			<script src="asset/js/bootstrap-table.js"></script>
			<script src="asset/js/bootstrap-table-export.js"></script>
			<script src="asset/js/bootstrap-table-tr-TR.js"></script>
			<script src="asset/js/40aab700698a291c5ce712a44ec8bc34.js"></script>
			<script src="asset/js/0e8ece31c98757dd3816d14f69a14d98.js"></script> 
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
								<a href="user.php">Müşteri Paneli</a>
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
						<button data-toggle="modal" data-target="#loginModal"class="btn btn-success" >
							<i class="glyphicon glyphicon-plus"></i> Kayıt Ekle</button> 
							<button data-toggle="modal" data-target="#uploadfile"class="btn btn-primary" >
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
								data-url="asset/admin/tableuser.php"
								data-click-to-select="true"
								data-show-export="true">
								<thead>
									<tr>
										<th data-valign="middle"  data-field="state" data-checkbox="true" ></th>
										<th data-valign="middle" data-formatter="runningFormatter">SIRA NO</th>
										<th data-valign="middle" data-field="tc" data-align="center" >TC KİMLİK NO</th>
										<th data-valign="middle" data-field="username" data-align="center" >Kullanıcı adı</th>
										<th data-valign="middle" data-field="isimsoyad" data-align="center">AD SOYAD</th>
										<th data-valign="middle" data-field="tel" data-align="center">TELEFON</th>
										<th data-valign="middle" data-field="yetki" data-align="center">YETKİ</th>
										<th data-valign="middle" data-click-to-select="false" data-events="operateEvents" data-formatter="operateFormatter" data-field="operate" data-align="center">KAYIT DÜZENLE<br />ŞİFRE DEĞİŞTİR<br />SİL</th>
									</tr>
								</thead>
							</table> 
						</div> 
					</div>
					<div class="col-md-12">
						<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true"> 
							<div class="modal-dialog"> 
								<div class="modal-content">
									<div class="modal-header"> 
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span> 
										</button> 
										<h5 id="modalHeader" class="modal-title">Kullanıcı Kayıt Forumu</h5> 
									</div> 
									<div class="modal-body"> <!-- The form is placed inside the body of modal --> 
										<form id="loginForm" method="post" class="form-horizontal"> 
											<div class="form-group"> 
												<label class="col-xs-3 control-label">T.C. Kimlik No</label> 
												<div class="col-xs-6">
													<input class="form-control" name="tc" type="text" id="tc" placeholder="11 Haneli TCK No Giriniz" maxlength="11" />
												</div> 
											</div> 
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Adı Soyadı</label> 
												<div class="col-xs-6"> 
													<input class="form-control" name="adsoyad" type="text" id="adsoyad" placeholder="İsim Soyisim Giriniz" />
												</div>
											</div> 
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Telefonu</label> 
												<div class="col-xs-6">
													<input class="form-control" name="tel" type="text" id="tel" placeholder="Örn.:5XXXXXXXXX" maxlength="10" />
												</div> 
											</div>
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Kullanıcı Adı</label> 
												<div class="col-xs-6">
													<input class="form-control" name="user" type="text" placeholder="Kullanıcı Adı Giriniz"  id="user" />
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Şifresi</label> 
												<div class="col-xs-6">
													<input class="form-control" name="pass" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679"  id="pass"  />
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Yetki</label> 
												<div class="col-xs-6">
													<select class="form-control" name="yetki"  id="yetki" >
														<option value="">Yetki Seçiniz</option>
														<option value="Admin">Admin</option>
														<option value="User">User</option>
													</select>
												</div>
											</div>
											<div class="form-group"> 
												<div class="col-xs-6 col-xs-offset-4">
													<button id="kayit" type="submit" class="btn btn-primary">Kaydet</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button> 
												</div> 
											</div> 
										</form> 
									</div>
								</div> 
							</div> 
						</div> 
						<div class="modal fade" id="updModal" tabindex="-1" role="dialog" aria-labelledby="Update" aria-hidden="true"> 
							<div class="modal-dialog"> 
								<div class="modal-content">
									<div class="modal-header"> 
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span> 
										</button> 
										<h5 id="modalHeader" class="modal-title">Kullanıcı Güncelleme Forumu</h5> 
									</div> 
									<div class="modal-body"> <!-- The form is placed inside the body of modal --> 
										<form id="UpdateForm" method="post" class="form-horizontal"> 
											<div class="form-group"> 
												<label class="col-xs-3 control-label">T.C. Kimlik No</label> 
												<div class="col-xs-6">
													<input type="hidden" name="upid" id="upid" />
													<input class="form-control" name="uptc" type="text" id="uptc" placeholder="11 Haneli TCK No Giriniz" maxlength="11" />
												</div> 
											</div> 
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Adı Soyadı</label> 
												<div class="col-xs-6"> 
													<input class="form-control" name="upns" type="text" id="upns" placeholder="İsim Soyisim Giriniz" />
												</div>
											</div> 
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Telefonu</label> 
												<div class="col-xs-6">
													<input class="form-control" name="uptel" type="text" id="uptel" placeholder="Örn.:5XXXXXXXXX" maxlength="10" />
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Yetki</label> 
												<div class="col-xs-6">
													<select class="form-control" name="upyetki"  id="upyetki" >
														<option value="">Yetki Seçiniz</option>
														<option value="Admin">Admin</option>
														<option value="User">User</option>
													</select>
												</div>
											</div>
											<div class="form-group"> 
												<div class="col-xs-6 col-xs-offset-4">
													<button id="update" type="submit" class="btn btn-primary">Güncelle</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button> 
												</div> 
											</div> 
										</form> 
									</div>
								</div> 
							</div> 
						</div>  
						<div class="modal fade" id="userpassModal" tabindex="-1" role="dialog" aria-labelledby="Update" aria-hidden="true"> 
							<div class="modal-dialog"> 
								<div class="modal-content">
									<div class="modal-header"> 
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span> 
										</button> 
										<h5 id="modalHeader" class="modal-title">Şifre Güncelleme Forumu</h5> 
									</div> 
									<div class="modal-body"> <!-- The form is placed inside the body of modal --> 
										<form id="userpassForm" method="post" class="form-horizontal"> 
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Şire</label> 
												<div class="col-xs-6">
													<input class="form-control" name="uppass1" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679"  id="uppass1" />
													<input type="hidden" name="upuserid" id="upuserid" />
												</div>
											</div>
											<div class="form-group"> 
												<label class="col-xs-3 control-label">Şifre Tekrarı</label> 
												<div class="col-xs-6">
													<input class="form-control" name="uppass2" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679"  id="uppass2"  />
												</div> 
											</div> 
											<div class="form-group"> 
												<div class="col-xs-6 col-xs-offset-4">
													<button id="updateuserpass" type="submit" class="btn btn-primary">Güncelle</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button> 
												</div> 
											</div> 
										</form> 
									</div>
								</div> 
							</div> 
						</div> 
						<div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="Update" aria-hidden="true"> 
							<div class="modal-dialog"> 
								<div class="modal-content">
									<div class="modal-header"> 
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span> 
										</button> 
										<h5 id="modalHeader" class="modal-title">Excelden Liste Yükleme Formu</h5> 
									</div> 
									<div class="modal-body"> 
										<div class="form-group"style="overflow: auto"> 
											<div class="dropzone" id="uploadDrop">
												<center> <a href="asset/files/SablonUsers.xlsx" > <img src="asset/images/sablon_exel.png" width="120" height="120" /></a></center>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<div class="form-group"> 
											<div class="col-xs-6 col-xs-offset-2">
												<button name="yukle" id="yukle" type="button" class="btn btn-primary">Yükle</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>

											</div> 
										</div> 
									</div>
								</div>
							</div>
						</div>
					</div>
					<script>
						
						Dropzone.autoDiscover = false;
						var myDropzone = new Dropzone('div#uploadDrop', { acceptedMimeTypes:'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel', url: "asset/admin/import.php", maxFiles:1,
							init: function() {
								this.on('addedfile', function(file) {
									if (this.files.length > 1) {
										alert("sadece bir dosya yükleyebilirsin");
										this.removeFile(this.files[1]);
									}
								});
							}, autoProcessQueue: false, addRemoveLinks: true });
						$('#yukle').on('click' , function()
						{
                       
							myDropzone.processQueue();
							myDropzone.on("success", function (file, cevap) {
                            
                               alert(cevap);
                                this.removeAllFiles();
								$('#table').bootstrapTable('refresh');
								$("#uploadfile").modal('hide');
                                 
							});   
						});   
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
							if (row.id!=<?php echo $adminid; ?>){
							return [
							'<a class="like" href="javascript:void(0)" title="Kullanıcı Bilgileri Güncelle">',
							'<i class="glyphicon glyphicon-edit" />',
							'</a> ',
							'<a class="update" href="javascript:void(0)" title="Şifre Değiştir">',
							'<i class="glyphicon glyphicon-search" />',
							'</a>     ',
							'<a class="remove" href="javascript:void(0)" title="Kullanıcıyı Sil">',
							'<i class="glyphicon glyphicon-remove"> </i>',
							'</a> ' 
							].join('');}
						else{return [
							'<a class="like" href="javascript:void(0)" title="Kullanıcı Bilgileri Güncelle">',
							'<i class="glyphicon glyphicon-edit" />',
							'</a> ',
							'<a class="update" href="javascript:void(0)" title="Şifre Değiştir">',
							'<i class="glyphicon glyphicon-search" />',
							'</a>     '							 
							].join('');
							
						}
						}
						window.operateEvents = {
							'click .like': function (e, value, row, index) {
								$("#updModal").modal('show');
								$("#uptc").val(row.tc);
								$("#upns").val(row.isimsoyad);
								$("#uptel").val(row.tel);
								$("#upyetki").val(row.yetki);
								$("#upid").val(row.id);
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
							$("#userpassModal").modal('show');
							$("#upuserid").val(row.id);
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
				$(document).ready(function() { 



					$('#loginForm').formValidation({ 
						framework: 'bootstrap', 
						excluded: ':disabled', 
						icon: { 
							valid: 'glyphicon glyphicon-ok', 
							invalid: 'glyphicon glyphicon-remove', 
							validating: 'glyphicon glyphicon-refresh' },
							fields: { 
								tc: { 
									validators: { 
										notEmpty: { 
											message: 'Bu Alan Zorunludur!' }, 
											regexp: {
												regexp: /\d{11}/,
												message: 'TCK No Hatali Girdiniz!'
											}
										}
									},
									adsoyad: { 
										validators: { 
											notEmpty: { 
												message: 'Bu Alan Zorunludur!' }, 
												regexp: {
													regexp:  /^[\w\sıüçğöÜİÇĞÖ]*$/,
													message: 'İsim Soyisim Dogru Girdiniz!'
												}
											}
										},
										tel: { 
											validators: { 
												regexp: {
													regexp: /^[5][0][5-7][0-9]{6}|^[5][3][0-9]{7}|^[5][4][0-9]{7}/,
													message: 'Telefonu Doğru Yazınız!'
												}
											}
										},
										user: { 
											validators: { 
												notEmpty: { 
													message: 'Bu Alan Zorunludur!' },
													regexp: {
														regexp: /.{3,}/,
														message: 'Kullanıcı Adı en az 3 Karakter Olmalıdır!'
													}
												}
											},
											pass: { 
												validators: { 
													notEmpty: { 
														message: 'Bu Alan Zorunludur.' },
														regexp: {
															regexp: /.{1,}/,
															message: 'Şifreniz en az 1 Karakter Olmalıdır!'
														}
													}
												},
												yetki: { 
													validators: {
														notEmpty:{
															message: 'Yetki Seçiniz!',
														}               
													}
												}
											}
										}) 
					.on('success.form.fv', function(e) {
						e.preventDefault();
						var $form = $(e.target),
						fv    = $form.data('formValidation');
						$.ajax({
							url: "asset/admin/kayitekle.php",
							type: 'POST',
							data: $form.serialize(),
							success: function(sonuc) { if (sonuc=='oldu'){
								$('#table').bootstrapTable('refresh');
								$("#loginModal") .modal('hide');
								fv.resetForm(true);        
								fv.disableSubmitButtons(true);
								alert("Kayıt Başarılı");
							}else{alert(sonuc);
							}
						}
					}); 
					}) 
					.end();
					$('#UpdateForm').formValidation({ 
						framework: 'bootstrap', 
						excluded: ':disabled', 
						icon: { 
							valid: 'glyphicon glyphicon-ok', 
							invalid: 'glyphicon glyphicon-remove', 
							validating: 'glyphicon glyphicon-refresh' },
							fields: { 
								uptc: { 
									validators: { 
										notEmpty: { 
											message: 'Bu Alan Zorunludur!' }, 
											regexp: {
												regexp: /\d{11}/,
												message: 'TCK No Hatali Girdiniz!'
											}
										}
									},
									upns: { 
										validators: { 
											notEmpty: { 
												message: 'Bu Alan Zorunludur!' }, 
												regexp: {
													regexp:  /^[\w\sıüçğöÜİÇĞÖ]*$/,
													message: 'İsim Soyisim Dogru Girdiniz!'
												}
											}
										},
										uptel: { 
											validators: { 
												regexp: {
													regexp: /^[5][0][5-7][0-9]{6}|^[5][3][0-9]{7}|^[5][4][0-9]{7}/,
													message: 'Telefonu Doğru Yazınız!'
												}
											}
										},
										upyetki: { 
											validators: {
												notEmpty:{
													message: 'Yetki Seçiniz!',

												}               
											}
										}
									}
								})
					.on('success.form.fv', function(e) {
						e.preventDefault();
						var $form = $(e.target),
						fv    = $form.data('formValidation');
						$.ajax({
							url: "asset/admin/update.php",
							type: 'POST',
							data: $form.serialize(),
							success: function(sonuc) { if (sonuc=='oldu'){
								$('#table').bootstrapTable('refresh');
								$("#updModal") .modal('hide');
								fv.resetForm(true);        
								fv.disableSubmitButtons(true);
								alert("Güncelleme Başarılı");
							}
							else {alert(sonuc);
							}
						}
					}); 
					}) 
					.end();
					$('#userpassForm').formValidation({ 
						framework: 'bootstrap', 
						excluded: ':disabled', 
						icon: { 
							valid: 'glyphicon glyphicon-ok', 
							invalid: 'glyphicon glyphicon-remove', 
							validating: 'glyphicon glyphicon-refresh' },
							fields: { 
								uppass1: { 
									validators: { 
										notEmpty: { 
											message: 'Bu Alan Zorunludur!' },
											regexp: {
												regexp: /.{1,}/,
												message: 'Şifreniz en az 1 Karakter Olmalıdır!'
											}
										}
									},
									uppass2: { 
										validators: { 
											notEmpty: { 
												message: 'Bu Alan Zorunludur.' },
												regexp: {
													regexp: /.{1,}/,
													message: 'Şifreniz en az 1 Karakter Olmalıdır!'
												},
												identical: {
													field: 'uppass1',
													message: 'Şifreler Uyuşmuyor'
												}
											}
										}
									}
								}) 
					.on('success.form.fv', function(e) {
						e.preventDefault();
						var $form = $(e.target),
						fv    = $form.data('formValidation');
						$.ajax({
							url: "asset/admin/updateuser.php",
							type: 'POST',
							data: $form.serialize(),
							success: function(sonuc) { if (sonuc=='oldu'){
								$('#table').bootstrapTable('refresh');
								$("#userpassModal") .modal('hide');
								fv.resetForm(true);        
								fv.disableSubmitButtons(true);
								alert("Güncelleme Başarılı");
							}
							else {alert(sonuc);
							}
						}
					});
					}) 
					.end();
				});
			</script>
		</body>
		</html>