<?
include_once("functions/string.func.php");
include_once("functions/date.func.php");

/* CHECK USER LOGIN 
$CI =& get_instance();
$CI->checkUserLogin();*/

$this->load->model('Informasi');

$set= new Informasi();

$reqId = $this->input->get("reqId");

if($reqId == ""){
	$reqMode = "insert";
}
else
{
	$reqMode = "update";	
	$set->selectByParams(array("INFORMASI_ID"=>$reqId));
	$set->firstRow();
	$reqNama= $set->getField("NAMA");
	$reqKeterangan= $set->getField("KETERANGAN");
	$reqTanggal= dateToPageCheck($set->getField("TANGGAL"));
	// $reqStatus= $set->getField("STATUS_NAMA");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Untitled Document</title>
	<base href="<?=base_url()?>" />

	<link rel="stylesheet" type="text/css" href="css/gaya.css">
	<link rel="stylesheet" href="css/admin.css" type="text/css">

	<link rel="stylesheet" type="text/css" href="lib/easyui/themes/default/easyui.css">

	<!-- BOOTSTRAP -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--<script src="js/jquery-1.10.2.min.js"></script>-->
	<script src="lib/bootstrap/js/jquery.min.js"></script>
	<script src="lib/bootstrap/js/bootstrap.js"></script>
	<link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="lib/font-awesome-4.7.0/css/font-awesome.css" type="text/css">

	<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="lib/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="lib/easyui/kalender-easyui.js"></script>
	<script type="text/javascript" src="lib/easyui/globalfunction.js"></script>
	<script type="text/javascript">	
		$(function(){
			$('#ff').form({
				url:'informasi_data_json/add',
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
         				mbox.alert(infodata, {open_speed: 500}, window.setInterval(function() 
         				{
         					mbox.close();
         					document.location.href= "app/loadUrl/app/informasi_data_add/?reqId="+rowid;
         				}, 1000));
         			}
					// top.parent.parent.parent.closePopup(data);
					top.frames['mainFrame'].location.reload();
				}
			});

		});
	</script>

	<!-- BOOTSTRAP CORE -->
	<link href="lib/startbootstrap-sb-admin-2-1.0.7/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="lib/startbootstrap-sb-admin-2-1.0.7/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<link href="lib/mbox/mbox.css" rel="stylesheet">
	<script src="lib/mbox/mbox.js"></script>
	<link href="lib/mbox/mbox-modif.css" rel="stylesheet">
	<script src="lib/ckeditor/ckeditor.js"></script>
</head>

<body>

	<div class="container-fluid full-height">
		<div class="row full-height">
			<div class="col-md-12 area-form full-height">

				<div id="judul-popup">Tambah Informasi</div>
				<div id="area-form-inner">
					<form id="ff" method="post"  novalidate enctype="multipart/form-data">

						<div class="form-group">
							<label>Nama</label>
							<input name="reqNama" class="form-control easyui-validatebox" type="text" required value="<?=$reqNama?>" />
						</div>

						<div class="form-group">
							<label>Keterangan</label>
							<textarea name="reqKeterangan" id="reqKeterangan" style="width:100%; height:100%"><?=$reqKeterangan?></textarea>
						</div>

						<div class="form-group">
							<label>Tanggal</label>
                  			<input required class="easyui-validatebox" data-options="validType:'dateValidPicker'" style="width:20%" type="text" name="reqTanggal" id="reqTanggal"  value="<?=$reqTanggal?>" maxlength="10" onKeyDown="return format_date(event,'reqTanggal');"/>
						</div>

						<div class="form-group" >
							<div class="col-md-2">
								<input type="hidden" name="reqId" value="<?=$reqId?>" />
								<input type="hidden" name="reqMode" value="<?=$reqMode?>" />
								<input type="submit" name="reqSubmit"  class="btn btn-primary" value="Submit" />
							</div>
						</div>

					</form>
					<script>
                        // Replace the <textarea id="reqKeterangan"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'reqKeterangan');
                        //config.extraPlugins = 'tab';
                    </script>
				</div>
			</div>
		</div>
	</div>
</body>
</body>
</html>