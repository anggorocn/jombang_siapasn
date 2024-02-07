<?
include_once("functions/string.func.php");
include_once("functions/date.func.php");

$CI =& get_instance();
$CI->checkUserLogin();

$reqId = $this->input->get("reqId");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="msapplication-tap-highlight" content="no">
	<meta name="description" content="Simpeg Jombang">
	<meta name="keywords" content="Simpeg Jombang">
	<title>Simpeg Jombang</title>
	<base href="<?=base_url()?>" />

	<link rel="stylesheet" type="text/css" href="lib/easyui/themes/default/easyui.css">
	<script type="text/javascript" src="lib/easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="lib/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="lib/easyui/kalender-easyui.js"></script>
	<script type="text/javascript" src="lib/easyui/globalfunction.js"></script>

	<!-- AUTO KOMPLIT -->
	<link rel="stylesheet" href="lib/autokomplit/jquery-ui.css">
	<script src="lib/autokomplit/jquery-ui.js"></script>

	<script type="text/javascript">	
		$(function(){
			$('#ff').form({
				url:'user_login_json/reset_password',
				onSubmit:function(){
					return $(this).form('validate');
				},
				success:function(data){
				  //alert(data);return false;
					data = data.split("-");
					rowid= data[0];
					infodata= data[1];
         			//$.messager.alert('Info', infodata, 'info');

         			if(rowid == "xxx")
         			{
         				mbox.alert(infodata, {open_speed: 0});
         			}
         			else
         			{
         				mbox.alert(infodata, {open_speed: 500}, interval = window.setInterval(function() 
         				{
							clearInterval(interval);
         					mbox.close();

         					document.location.href= "app/loadUrl/app/user_login_reset/?reqId=<?=$reqId?>";
         				}, 1000));
						$(".mbox > .right-align").css({"display": "none"});
         			}
				}
			});

			setKategoriSatuanKerja();
			$('#reqKategoriSatuanKerja').bind('change', function(ev) {
				setKategoriSatuanKerja();
			});

		});

	</script>


	<!-- CORE CSS-->    
	<link href="lib/materializetemplate/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="lib/materializetemplate/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
	<!-- CSS style Horizontal Nav-->    
	<link href="lib/materializetemplate/css/layouts/style-horizontal.css" type="text/css" rel="stylesheet" media="screen,projection">
	<!-- Custome CSS-->    
	<link href="lib/materializetemplate/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
	<style>
		span.combo
		{
			width:50% !important
		}
		
		.combo-label
		{
			top:-2rem !important;
		}
		
		@media screen and (max-width:767px) {
			span.combo
			{
				width:100% !important
			}
		}
	</style>
    
    <link href="lib/mbox/mbox.css" rel="stylesheet">
  	<script src="lib/mbox/mbox.js"></script>
    <link href="lib/mbox/mbox-modif.css" rel="stylesheet">
    <script src="lib/ckeditor-simple/ckeditor.js"></script>
</head>

<body>
	<div class="container-fluid full-height">
		<div class="row full-height">
			<div class="col-md-12 area-form full-height">

				<div class="ubah-color-warna white-text" style="padding: 1em;">Ubah Password</div>

				<div id="area-form-inner" style="margin-top: 5px">
					<form id="ff" method="post"  novalidate enctype="multipart/form-data">
						<div class="row">
							<label for="reqPaswordBaru" class="col s12 m2 label-control">Masukan Password Baru</label>
							<div class="input-field col s12 m4">
								<input name="reqPaswordBaru" id="reqPaswordBaru" class="" type="password" required />
							</div>
						</div>
                        
						<div class="row">
							<div class="input-field col s12 m12 offset-m1">
								<!-- <button class="btn orange waves-effect waves-light" style="font-size:9pt" type="button" id="kembali">Kembali
			                      <i class="mdi-navigation-arrow-back left hide-on-small-only"></i>
			                    </button> -->
			                    <input type="hidden" name="reqId" value="<?=$reqId?>" />
								<input type="submit" name="reqSubmit" class="btn green" value="Simpan" />
							</div>
						</div>

						<script type="text/javascript">
	                      $("#kembali").click(function() { 
	                      	document.location.href= "app/loadUrl/app/user_login";
	                        // top.location= "app/index";
	                      });
	                    </script>

					</form>
				</div>
			</div>
		</div>
	</div>
	<!--materialize js-->
	<script type="text/javascript" src="lib/materializetemplate/js/my-materialize.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
		});

		CKEDITOR.replace( 'reqPesan',
		{
			height: '80px',
		} );

		$('.materialize-textarea').trigger('autoresize');

	</script>
    
	<link rel="stylesheet" href="lib/AdminLTE-2.4.0-rc/dist/css/skins/ubah-skin.css">
	<script src="lib/AdminLTE-2.4.0-rc/dist/js/ubah-skin.js"></script>
</body>
</html>