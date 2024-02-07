<?php
include_once("functions/string.func.php");
include_once("functions/default.func.php");
include_once("functions/date.func.php");

$CI =& get_instance();
$CI->checkUserLogin();
$tempLoginLevel= $this->LOGIN_LEVEL;

$this->load->model('Pegawai');

$reqBreadCrum= $this->input->get("reqBreadCrum");

$reqTahun= date("Y");
$reqBulan= date("m");


$tinggi = 156;
$reqSatuanKerjaNama= "Semua Satuan Kerja";

$arrData= array("NIP BARU", "NAMA", "NO HP", "EMAIL", "NAMA SATUAN KERJA UPT", "NAMA SATUAN KERJA");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
	<title>Cek Data Rekon Email</title>
	<base href="<?=base_url()?>" />
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/media/images/favicon.ico">
	<!--<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">-->

	<style type="text/css" media="screen">
		@import "lib/media/css/site_jui.css";
		@import "lib/media/css/demo_table_jui.css";
		@import "lib/media/css/themes/base/jquery-ui.css";
	</style>

	<link rel="stylesheet" type="text/css" href="lib/DataTables-1.10.7/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="lib/DataTables-1.10.7/extensions/Responsive/css/dataTables.responsive.css">
	<link rel="stylesheet" type="text/css" href="lib/DataTables-1.10.7/examples/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="lib/DataTables-1.10.7/examples/resources/demo.css">
	<style type="text/css" class="init">

		div.container { max-width: 100%;}
		
		.select-wrapper{width:8vw !important}
	</style>
	<script type="text/javascript" language="javascript" src="lib/DataTables-1.10.7/media/js/jquery.js"></script>

    <?php /*?><link rel="stylesheet" type="text/css" href="lib/easyui/themes/default/easyui.css">
	<script type="text/javascript" src="lib/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="lib/easyui/kalender-easyui.js"></script><?php */?>

	<link rel="stylesheet" type="text/css" href="lib/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="lib/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="lib/easyui/demo/demo.css">

	<script type="text/javascript" src="lib/easyui/jquery-easyui-1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="lib/easyui/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>

	<script type="text/javascript" language="javascript" src="lib/DataTables-1.10.7/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="lib/DataTables-1.10.7/extensions/Responsive/js/dataTables.responsive.js"></script>
	<script type="text/javascript" language="javascript" src="lib/DataTables-1.10.7/examples/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="lib/DataTables-1.10.7/examples/resources/demo.js"></script>
    
    <script type="text/javascript" src="lib/easyui/breadcrum.js"></script>
	<script type="text/javascript" charset="utf-8">
		var oTable;
		$(document).ready( function () {
		<?
		if($reqBreadCrum == ""){}
		else
		{
		?>
		setinfobreacrum("<?=$reqBreadCrum?>", "setBreacrum");
		<?
		}
		?>

        var id = -1;//simulation of id
        $(window).resize(function() {
        	console.log($(window).height());
        	$('.dataTables_scrollBody').css('height', ($(window).height() - <?=$tinggi?>));
        });
        oTable = $('#example').dataTable({ bJQueryUI: true,"iDisplayLength": 25,
        	/* UNTUK MENGHIDE KOLOM ID */
        	"aoColumns": [ 
			 <?
			for($i=0; $i < count($arrData); $i++)
			{
				if($i == 0){}
				else
				{
			?>
				,
			<?
				}
			?>
			null
			<?
			}
			?>
        	],
        	"lengthMenu": [[25, 100, 500, -1], [25, 100, 500, "All"]],
        	"bSort": true,
        	"bFilter": false,
        	"bLengthChange": true,
        	"bProcessing": true,
        	"bServerSide": true,
        	"sAjaxSource": "cek_data_rekon_email_json/json?reqSatuanKerjaId=<?=$reqSatuanKerjaId?>&reqTipePegawaiId=<?=$reqTipePegawaiId?>",
        	"sScrollX": "100%",								  
        	"sScrollXInner": "100%",
        	"sPaginationType": "full_numbers"
        });
        /* Click event handler */

        /* RIGHT CLICK EVENT */
        var anSelectedData = '';
        var anSelectedId = '';
        var anSelectedDownload = '';
        var anSelectedPosition = '';	

        function fnGetSelected( oTableLocal )
        {
        	var aReturn = new Array();
        	var aTrs = oTableLocal.fnGetNodes();
        	for ( var i=0 ; i<aTrs.length ; i++ )
        	{
        		if ( $(aTrs[i]).hasClass('row_selected') )
        		{
        			aReturn.push( aTrs[i] );
        			anSelectedPosition = i;
        		}
        	}
        	return aReturn;
        }

        $("#example tbody").click(function(event) {
        	$(oTable.fnSettings().aoData).each(function (){
        		$(this.nTr).removeClass('row_selected');
        	});
        	$(event.target.parentNode).addClass('row_selected');
					  //
					  var anSelected = fnGetSelected(oTable);													
					  anSelectedData = String(oTable.fnGetData(anSelected[0]));
					  var element = anSelectedData.split(','); 
					  anSelectedId = element[element.length-1];
					});
		
		$('#example tbody').on( 'dblclick', 'tr', function () {
			$("#btnEdit").click();	
		});
		  
		var tempindextab=0;
		
		//;btnCetak
		

		$('#btnCetak').on('click', function () {
			  var reqSatuanKerjaId= reqCariFilter= reqTipePegawaiId= reqPangkatId= reqBulan= reqTahun= "";
			  reqSatuanKerjaId= $("#reqSatuanKerjaId").val();
			  reqCariFilter= $("#reqCariFilter").val();
			  reqTipePegawaiId= $("#reqTipePegawaiId").val();
			  reqPangkatId= $("#reqPangkatId").val();
			  reqBulan= $("#reqBulan").val();
			  reqTahun= $("#reqTahun").val();

		   	  opUrl= "app/loadUrl/app/skp_pegawai_excel?reqSatuanKerjaId="+reqSatuanKerjaId+"&reqTipePegawaiId="+reqTipePegawaiId+"&reqPangkatId="+reqPangkatId+"&reqBulan="+reqBulan+"&reqTahun="+reqTahun+"&sSearch="+reqCariFilter;

		   	  newWindow = window.open(opUrl, 'download'+Math.floor(Math.random()*999999));
		   	  newWindow.focus();
		});

		$("#btnCari").on("click", function () {
			var reqSatuanKerjaId= reqCariFilter= reqTipePegawaiId= reqPangkatId= reqBulan= reqTahun= "";
			reqSatuanKerjaId= $("#reqSatuanKerjaId").val();
			reqCariFilter= $("#reqCariFilter").val();
			reqTipePegawaiId= $("#reqTipePegawaiId").val();

			
			oTable.fnReloadAjax("cek_data_rekon_pns_json/json?reqSatuanKerjaId="+reqSatuanKerjaId+"&reqTipePegawaiId="+reqTipePegawaiId+"&sSearch="+reqCariFilter);
		});
		
		$("#reqTipePegawaiId,#reqPangkatId,#reqBulan,#reqTahun").change(function() { 
			setCariInfo();
		});
		  
		$("#reqCariFilter").keyup(function(e) {
			var code = e.which;
			if(code==13)
			{
				setCariInfo();
			}
		});
		
        $('#btnCetakCekDataRekonEmail').on('click', function () {

        	var reqSatuanKerjaId= reqStatusPegawaiId= reqCariFilter= "";
			reqSatuanKerjaId= $("#reqSatuanKerjaId").val();
			reqCariFilter= $("#reqCariFilter").val();
			reqStatusPegawaiId= $("#reqStatusPegawaiId").val();

        	newWindow = window.open("app/loadUrl/app/cek_data_rekon_email_cetak_excel?reqBulan=<?=date('m')?>&reqTahun=<?=date('Y')?>&reqStatusPegawaiId=12&reqSatuanKerjaId="+reqSatuanKerjaId+"&sSearch="+reqCariFilter, 'Cetak');
			newWindow.focus();

        });

        $('#btnCetakCekDataRekonEmailDinas').on('click', function () {

        	var reqSatuanKerjaId= reqStatusPegawaiId= reqCariFilter= "";
			reqSatuanKerjaId= $("#reqSatuanKerjaId").val();
			reqCariFilter= $("#reqCariFilter").val();
			reqStatusPegawaiId= $("#reqStatusPegawaiId").val();

        	newWindow = window.open("app/loadUrl/app/cek_data_rekon_email_cetak_excel?reqModeDinas=1&reqBulan=<?=date('m')?>&reqTahun=<?=date('Y')?>&reqStatusPegawaiId=12&reqSatuanKerjaId="+reqSatuanKerjaId+"&sSearch="+reqCariFilter, 'Cetak');
			newWindow.focus();

        });


        $('#btnLog').on('click', function () {
        	window.parent.openPopup("app/loadUrl/app/pegawai_log");

        	// tutup flex dropdown => untuk versi mobile
        	$('div.flexmenumobile').hide()
        	$('div.flexoverlay').css('display', 'none')
        });

    });

var tempinfodetilpencarian="0";
function showIconCari()
{	
	if(tempinfodetilpencarian == "0")
	{
		$("#tabpencarian").show();
		tempinfodetilpencarian= 1;
	}
	else
	{
		$("#tabpencarian").hide();
		tempinfodetilpencarian= 0;
	}
}

function setCariInfo()
{
	$(document).ready( function () {
		$("#btnCari").click();			
	});
}
	
function calltreeid(id, nama)
{
	$("#reqLabelSatuanKerjaNama").text(nama);
	$("#reqSatuanKerjaId").val(id);
	setCariInfo();
}
</script>

<link href="css/bluetabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>

<!-- CORE CSS-->    
<link href="lib/materializetemplate/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
<link href="lib/materializetemplate/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
<!-- CSS style Horizontal Nav-->    
<link href="lib/materializetemplate/css/layouts/style-horizontal.css" type="text/css" rel="stylesheet" media="screen,projection">
<!-- Custome CSS-->    
<link href="lib/materializetemplate/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">

<link rel="stylesheet" type="text/css" href="lib/DataTables-1.10.7/media/css/dataTables.materialize.css">
<?php /*?><link rel="stylesheet" type="text/css" href="lib/DataTables-1.10.7/media/css/dataTables.material.min.css"><?php */?>

<link rel="stylesheet" type="text/css" href="css/gaya-monitoring.css">

<link href="lib/treeTable2/doc/stylesheets/master.css" rel="stylesheet" type="text/css" />
<link href="lib/treeTable2/src/stylesheets/jquery.treeTable.css" rel="stylesheet" type="text/css" />

<!--<link href="css/normalize.css" rel="stylesheet" type="text/css" />-->
</head>
<body>
	<!-- START MAIN -->
	<div id="main">
		<!-- START WRAPPER -->
		<div class="wrapper">
			<!-- START CONTENT -->
			<section id="content-full">

				<!--breadcrumbs start-->
				<div id="breadcrumbs-wrapper">
					<div class="container">
						<div class="row">
							<div class="col s12 m12 l12">
                            
                            <ol class="breadcrumb right" id="setBreacrum"></ol>
                            
							<h5 class="breadcrumbs-title">Rekap Data Rekon Email dan HP PNS</h5>
								<ol class="breadcrumbs">
									<li class="active">
                                    <input type="hidden" id="reqSatuanKerjaId" value="<?=$reqSatuanKerjaId?>" />
                                    <label id="reqLabelSatuanKerjaNama"><?=$reqSatuanKerjaNama?></label>
                                    </li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<!--breadcrumbs end-->
                
                <div id="bluemenu" class="bluetabs">
                    <ul>
                        <li>
                            <a href="#" id="btnCari" style="display:none" title="Cari">Cari</a>
                    <? if ($tempLoginLevel >= 20) {
                    ?>                            
                    		<a id="btnCetakCekDataRekonEmailDinas" title="Ubah"><img src="images/icon-excel.png" />Cetak Data Reko Email Dinas</a> 
                    <?
                    }
                    ?>
                         	<a id="btnCetakCekDataRekonEmail" title="Ubah"><img src="images/icon-excel.png" />Cetak Data Rekon Email</a>
                            <!--<a id="btnCetak" title="Cetak"><img src="images/icon-cetak.png" /> Cetak</a> -->
                        </li>
                    </ul>
                </div>

				<div class="area-parameter">
                	<div class="kiri">
                       <!--<span style="padding-left:5px">Tipe</span>
                       <select id='reqTipePegawaiId'>
                       		<option value=''>Semua</option>
                            <option value='1'>Struktural</option>
                            <option value='11'>Pejabat</option>
                            <option value='12'>JFU</option>
                            <option value='2'>JFT</option>
                       </select> -->  
                    </div>
					<div class="kanan">
						<span>Search :</span>
						<input type="text" id="reqCariFilter" />
						<button id="clicktoggle">Filter ▾</button>
					</div>
				</div>

				<div class="area-parameter no-marginbottom">

					<div id="settoggle">
						<div class="row">
                        	<div class="col s12">
								<table id="tt" class="easyui-treegrid" style="width:100%; height:250px">
									<thead>
										<tr>
											<th field="NAMA" width="90%">Nama</th>
										</tr>
									</thead>
								</table>
							</div>
                            
						</div>
					</div>

				</div>

				<!--start container-->
				<div class="container" style="clear:both;">
					<div class="section">
						<table id="example" class="display mdl-data-table dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
                                	<?
									for($i=0; $i < count($arrData); $i++)
									{
									?>
									<th><?=$arrData[$i]?></th>
									<?
									}
									?>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<!--end container-->
			</section>
			<!-- END CONTENT -->
		</div>
		<!-- END WRAPPER -->

	</div>
	<!-- END MAIN -->

	<!--materialize js-->
    <script type="text/javascript" src="lib/materializetemplate/js/my-materialize.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
		});

		$('.materialize-textarea').trigger('autoresize');
		
		$(function(){
			var tt = $('#tt').treegrid({
				url: 'satuan_kerja_json/treepilih',
				rownumbers: false,
				pagination: false,
				idField: 'ID',
				treeField: 'NAMA',
				onBeforeLoad: function(row,param){
					if (!row) { // load top level rows
					param.id = 0; // set id=0, indicate to load new page rows
					}
				}
			});
		});
		
		var outer = document.getElementById('settoggle');
		document.getElementById('clicktoggle').addEventListener('click', function(evnt) {
		if (outer.style.maxHeight){
				//alert('a');
				outer.style.maxHeight = null;
				outer.classList.add('settoggle-closed');
			} 
			else {
				//alert('b');
				outer.style.maxHeight = outer.scrollHeight + 'px';
				outer.classList.remove('settoggle-closed');  
			}
		});

		outer.style.maxHeight = outer.scrollHeight + 'px';
		$('#clicktoggle').trigger('click');
	</script>
</body>
</html>