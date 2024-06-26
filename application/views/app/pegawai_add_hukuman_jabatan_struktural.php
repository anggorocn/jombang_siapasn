<?
include_once("functions/string.func.php");
include_once("functions/date.func.php");

$CI =& get_instance();
$CI->checkUserLogin();

$this->load->model('Eselon');
$eselon= new Eselon();

$reqId= $this->input->get("reqId");
$reqRowId= $this->input->get("reqRowId");
$reqMode= $this->input->get("reqMode");
$reqJenisJabatan= $this->input->get("reqJenisJabatan");

if(empty($reqJenisJabatan))
	$reqJenisJabatan= "1";

$CI->checkpegawai($reqId);
$tempUserLoginId= $this->USER_LOGIN_ID;
$tempMenuId= "1201";
$tempAksesMenu= $CI->checkmenupegawai($tempUserLoginId, $tempMenuId);

$eselon->selectByParams(array());
?>
<div class="row">
	<div class="input-field col s12 m6">
		<select id="reqJenisJabatan" name="reqJenisJabatan">
			<option value="1" <? if($reqJenisJabatan==1) echo 'selected';?>>Jabatan Struktural</option>
			<option value="2" <? if($reqJenisJabatan==2) echo 'selected';?>>Jabatan Fungsional Umum</option>
		</select>
		<label for="reqJenisJabatan">Jenis Jabatan</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s12">
		<input type="checkbox" id="reqJabatanStrukturalIsManual" name="reqJabatanStrukturalIsManual" value="1" <? if($reqJabatanStrukturalIsManual == 1) echo 'checked'?> />
		<label for="reqJabatanStrukturalIsManual"></label>
		*centang jika jabatan luar kab jombang / jabatan sebelum tahun 2012
	</div>
</div>

<div class="row">
	<div class="input-field col s12 m6">
		<label for="reqJabatanStrukturalNama">Nama Jabatan</label>
		<input placeholder="" type="text" id="reqJabatanStrukturalNama"  name="reqJabatanStrukturalNama" <?=$read?> value="<?=$reqJabatanStrukturalNama?>" class="easyui-validatebox" required />
	</div>
	<div class="input-field col s12 m1">
		<input type="checkbox" id="reqJabatanStrukturalCheckTmtWaktuJabatan" name="reqJabatanStrukturalCheckTmtWaktuJabatan" value="1" <? if($reqJabatanStrukturalCheckTmtWaktuJabatan == 1) echo 'checked'?>/>
		<label for="reqJabatanStrukturalCheckTmtWaktuJabatan"></label>
	</div>
	<div class="input-field col s12 m3">
		<label for="reqJabatanStrukturalTmtJabatan">TMT Jabatan</label>
		<input placeholder="" required class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqJabatanStrukturalTmtJabatan" id="reqJabatanStrukturalTmtJabatan"  value="<?=$reqJabatanStrukturalTmtJabatan?>" maxlength="10" onKeyDown="return format_date(event,'reqJabatanStrukturalTmtJabatan');"/>
	</div>
	<div class="input-field col s12 m2" id="reqJabatanStrukturalInfoCheckTmtWaktuJabatan">
		<input placeholder="00:00" id="reqJabatanStrukturalTmtWaktuJabatan" name="reqJabatanStrukturalTmtWaktuJabatan" type="text" class="" value="<?=$reqJabatanStrukturalTmtWaktuJabatan?>" />
		<label for="reqJabatanStrukturalTmtWaktuJabatan">Time</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s12 m12">
		<label for="reqJabatanStrukturalSatker">Satuan Kerja</label>
		<input type="hidden" name="reqJabatanStrukturalSatkerId" id="reqJabatanStrukturalSatkerId" value="<?=$reqJabatanStrukturalSatkerId?>" />
		<input placeholder="" type="text" id="reqJabatanStrukturalSatker" name="reqJabatanStrukturalSatker" <?=$read?> value="<?=$reqJabatanStrukturalSatker?>" class="easyui-validatebox" required readonly />
	</div>
</div>

<div class="row">
	<input type="hidden" name="reqJabatanStrukturalEselonId" id="reqJabatanStrukturalEselonId" value="<?=$reqJabatanStrukturalEselonId?>" />
	<div class="input-field col s12 m6" id="reqJabatanStrukturalinfoeselontext">
	  <label for="reqJabatanStrukturalEselonText">Eselon</label>
	  <input placeholder="" type="text" id="reqJabatanStrukturalEselonText" value="<?=$reqEselonNama?>" disabled />
	</div>

	<div class="input-field col s12 m6" id="reqJabatanStrukturalinfoeselontext">
	  <select id="reqJabatanStrukturalSelectEselonId">
	    <option value=""></option>
	    <?
	    while($eselon->nextRow())
	    {
	    ?>
	        <option value="<?=$eselon->getField("ESELON_ID")?>" <? if($eselon->getField("ESELON_ID") == $reqJabatanStrukturalEselonId) echo "selected"?>><?=$eselon->getField("NAMA")?></option>
	    <?
	    }
	    ?>
	  </select>
	  <label for="reqJabatanStrukturalEselonId">Eselon</label>
	</div>
</div>

<div class="row">
	<div class="input-field col s12 m6">
		<label for="reqJabatanStrukturalNoPelantikan">No. Pelantikan</label>
		<input placeholder="" type="text" id="reqJabatanStrukturalNoPelantikan" name="reqJabatanStrukturalNoPelantikan" <?=$disabled?> value="<?=$reqJabatanStrukturalNoPelantikan?>" class="easyui-validatebox" required />
	</div>
	<div class="input-field col s12 m6">
		<label for="reqJabatanStrukturalTglPelantikan">Tgl. Pelantikan</label>
		<input placeholder="" class="easyui-validatebox" required data-options="validType:'dateValidPicker'" type="text" name="reqJabatanStrukturalTglPelantikan" id="reqJabatanStrukturalTglPelantikan"  value="<?=$reqJabatanStrukturalTglPelantikan?>" maxlength="10" onKeyDown="return format_date(event,'reqJabatanStrukturalTglPelantikan');" />
	</div>
</div>

<div class="row">
	<div class="input-field col s12 m6">
		<label for="reqJabatanStrukturalTunjangan">Tunjangan</label>
		<input placeholder="" type="text" id="reqJabatanStrukturalTunjangan" name="reqJabatanStrukturalTunjangan" OnFocus="FormatAngka('reqJabatanStrukturalTunjangan')" OnKeyUp="FormatUang('reqJabatanStrukturalTunjangan')" OnBlur="FormatUang('reqJabatanStrukturalTunjangan')" value="<?=numberToIna($reqJabatanStrukturalTunjangan)?>" />
	</div>
	<div class="input-field col s12 m6">
		<label for="reqJabatanStrukturalBlnDibayar">Bln. Dibayar</label>
		<input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqJabatanStrukturalBlnDibayar" id="reqJabatanStrukturalBlnDibayar"  value="<?=$reqJabatanStrukturalBlnDibayar?>" maxlength="10" onKeyDown="return format_date(event,'reqJabatanStrukturalBlnDibayar');"/>
	</div>
</div>

<script type="text/javascript"> 
function settimetmt(info)
{
	$("#reqJabatanStrukturalInfoCheckTmtWaktuJabatan").hide();
	if($("#reqJabatanStrukturalCheckTmtWaktuJabatan").prop('checked')) 
	{
		$("#reqJabatanStrukturalInfoCheckTmtWaktuJabatan").show();
	}
	else
	{
		if(info == 2)
		$("#reqJabatanStrukturalTmtWaktuJabatan").val("");
	}
}

function seinfodatacentang()
{
	$("#reqJabatanStrukturalinfoeselontext,#reqJabatanStrukturalinfoeselontext").hide();
	if($("#reqJabatanStrukturalIsManual").prop('checked')) 
	{
		$("#reqJabatanStrukturalinfoeselontext").show();
		$("#reqJabatanStrukturalSatker").attr("readonly", false);
		$("#reqJabatanStrukturalSelectEselonId").material_select();
	}
	else
	{
		$("#reqJabatanStrukturalSatker").attr("readonly", true);
		$("#reqJabatanStrukturalinfoeselontext").show();
	}
}

function setcetang()
{
	$("#reqJabatanStrukturalinfoeselontext,#reqJabatanStrukturalinfoeselontext").hide();
	if($("#reqJabatanStrukturalIsManual").prop('checked')) 
	{
		$("#reqJabatanStrukturalinfoeselontext").show();
		$("#reqJabatanStrukturalSelectEselonId,#reqJabatanStrukturalEselonId, #reqJabatanStrukturalEselonText, #reqJabatanStrukturalNama, #reqJabatanStrukturalSatker, #reqJabatanStrukturalSatkerId").val("");
		$("#reqJabatanStrukturalSatker").attr("readonly", false);
		$("#reqJabatanStrukturalSelectEselonId").material_select();
		//$("#reqJabatanStrukturalNama,#reqJabatanStrukturalNamaId").val("");
	}
	else
	{
		$("#reqJabatanStrukturalSatker").attr("readonly", true);
		$("#reqJabatanStrukturalEselonId, #reqJabatanStrukturalNama, #reqJabatanStrukturalSatker, #reqJabatanStrukturalSatkerId").val("");
		$("#reqJabatanStrukturalinfoeselontext").show();
	}
}

$(function(){
 settimetmt(1);
 setcetang();

 $("#reqJabatanStrukturalCheckTmtWaktuJabatan").click(function () {
	 settimetmt(2);
 });
 
 $("#reqJabatanStrukturalIsManual").click(function () {
	setcetang();
 });
 
 $('#reqJabatanStrukturalSelectEselonId').bind('change', function(ev) {
   $("#reqJabatanStrukturalEselonId").val($(this).val());
 });
 
 $('input[id^="reqJabatanStrukturalNama"]').autocomplete({
  source:function(request, response){
	var id= this.element.attr('id');
	var replaceAnakId= replaceAnak= urlAjax= "";

	if (id.indexOf('reqJabatanStrukturalNama') !== -1 || id.indexOf('reqJabatanStrukturalSatker') !== -1)
	{
		if($("#reqJabatanStrukturalIsManual").prop('checked')) 
		{
			return false;
		}
	}
	
	if (id.indexOf('reqPejabatPenetap') !== -1)
	{
	  var element= id.split('reqPejabatPenetap');
	  var indexId= "reqPejabatPenetapId"+element[1];
	  urlAjax= "pejabat_penetap_json/combo";
	}
	else if (id.indexOf('reqJabatanStrukturalNama') !== -1)
	{
	  var element= id.split('reqJabatanStrukturalNama');
	  var indexId= "reqJabatanStrukturalNamaId"+element[1];
	  urlAjax= "satuan_kerja_json/namajabatan";
	}
	else if (id.indexOf('reqJabatanStrukturalSatker') !== -1)
	{
	  var element= id.split('reqJabatanStrukturalSatker');
	  var indexId= "reqJabatanStrukturalSatkerId"+element[1];
	  urlAjax= "satuan_kerja_json/auto";
	}
	
	$.ajax({
	  url: urlAjax,
	  type: "GET",
	  dataType: "json",
	  data: { term: request.term },
	  success: function(responseData){
		if(responseData == null)
		{
		  response(null);
		}
		else
		{
		  var array = responseData.map(function(element) {
			return {desc: element['desc'], id: element['id'], label: element['label'], satuan_kerja: element['satuan_kerja'], eselon_id: element['eselon_id'], eselon_nama: element['eselon_nama']};
		  });
		  response(array);
		}
	  }
	})
  },
  focus: function (event, ui) 
  { 
	var id= $(this).attr('id');
	if (id.indexOf('reqPejabatPenetap') !== -1)
	{
	  var element= id.split('reqPejabatPenetap');
	  var indexId= "reqPejabatPenetapId"+element[1];
	}
	else if (id.indexOf('reqJabatanStrukturalNama') !== -1)
	{
	  var element= id.split('reqJabatanStrukturalNama');
	  var indexId= "reqJabatanStrukturalSatkerId"+element[1];
	  $("#reqJabatanStrukturalSatker").val(ui.item.satuan_kerja).trigger('change');
	  $("#reqJabatanStrukturalEselonId").val(ui.item.eselon_id).trigger('change');
	  $("#reqJabatanStrukturalEselonText").val(ui.item.eselon_nama).trigger('change');
	}
	else if (id.indexOf('reqJabatanStrukturalSatker') !== -1)
	{
	  var element= id.split('reqJabatanStrukturalSatker');
	  var indexId= "reqJabatanStrukturalSatkerId"+element[1];
	  $("#reqJabatanStrukturalNama").val("").trigger('change');
	}

	var statusht= "";
		//statusht= ui.item.statusht;
		$("#"+indexId).val(ui.item.id).trigger('change');
	  },
	  //minLength:3,
	  autoFocus: true
	}).autocomplete( "instance" )._renderItem = function( ul, item ) {
	//return
	return $( "<li>" )
	.append( "<a>" + item.desc + "</a>" )
	.appendTo( ul );
  };
});

$('#reqJabatanStrukturalTmtWaktuJabatan').formatter({
'pattern': '{{99}}:{{99}}',
});
</script>

<script type="text/javascript" src="lib/materializetemplate/js/my-materialize.min.js"></script>
<script type="text/javascript" src="lib/materializetemplate/js/plugins/formatter/jquery.formatter.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('select').material_select();

		$("#reqJenisJabatan").change(function() { 
			var jenis_jabatan = $("#reqJenisJabatan").val();

			$('#labeldetilinfo').empty();

			if(jenis_jabatan==1)
			{
				infodetil= "pegawai_add_hukuman_jabatan_struktural";
			}
			else if(jenis_jabatan==2)
			{
				infodetil= "pegawai_add_hukuman_jabatan_fungsional";
			}

			$.ajax({'url': "app/loadUrl/app/"+infodetil+"/?reqId=<?=$reqId?>&reqRowId=<?=$reqRowId?>&reqMode=<?=$reqMode?>&reqJenisJabatan="+jenis_jabatan,'success': function(datahtml) {
				$('#labeldetilinfo').append(datahtml);
			}});

		});
	});
</script>