
<body>
    <!-- Bootstrap -->
    <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
    <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css' media="screen" />
    <!-- Bootstrap -->
    <!-- Bootstrap DatePicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap DatePicker -->
    <script type="text/javascript">
        $(function () {
            $('#reqTanggalLahir').datepicker({
                format: "dd-mm-yyyy"
            });
        });
    </script>
</body>
</html>


<?
include_once("functions/string.func.php");
include_once("functions/date.func.php");

$CI =& get_instance();
$CI->checkUserLogin();

$this->load->model('Anak');
$this->load->model('SuamiIstri');
$this->load->model('Agama');
$this->load->model('Pendidikan');
$this->load->model('Pensiun');
$this->load->model('JenisIdDokumen');
$this->load->model('JenisKawin');
$this->load->model('JenisKelamin');
$this->load->model('KualitasFile');
$this->load->library('globalfilepegawai');

$reqId= $this->input->get("reqId");
$reqRowId= $this->input->get("reqRowId");
$reqMode= $this->input->get("reqMode");

$CI->checkpegawai($reqId);
$tempUserLoginId= $this->USER_LOGIN_ID;
$tempMenuId= "011002";
$tempAksesMenu= $CI->checkmenupegawai($tempUserLoginId, $tempMenuId);

$statement= " AND JENIS_ID = 7 AND A.PEGAWAI_ID = ".$reqId;
$set= new Pensiun();
$tempJumlah= $set->getCountByParamsSuratMasukPegawai(array(), $statement);
// $tempJumlah= 0;

$tanggalsekarang= date("d-m-Y");
// echo $tanggalsekarang;exit;
$set= new Anak();
$pendidikan= new Pendidikan();
$pendidikan->selectByParams(array());

if($reqRowId == "")
{
  $reqMode = "insert";
}
else
{
  $reqMode = "update";
  $statement= " AND A.ANAK_ID = ".$reqRowId;
  $set->selectByParams(array(), -1,-1, $statement);
  $set->firstRow();
  // echo $set->query;exit();

  $reqRowId= $set->getField('ANAK_ID');
  $reqNama= $set->getField('NAMA');
  $reqTempatLahir= $set->getField('TEMPAT_LAHIR');
  $reqTanggalLahir= dateToPageCheck($set->getField('TANGGAL_LAHIR'));
  $reqUsia= $set->getField('USIA');
  $reqJenisKelamin= $set->getField('JENIS_KELAMIN');
  $reqStatusKeluarga= $set->getField('STATUS_KELUARGA');
  $reqStatusAktif= $set->getField('STATUS_AKTIF');

  $reqStatusNikah= $set->getField('STATUS_NIKAH');
  $reqStatusBekerja= $set->getField('STATUS_BEKERJA');

  $reqDapatTunjangan= $set->getField('STATUS_TUNJANGAN');
  $reqPendidikanId= $set->getField('PENDIDIKAN_ID');
  $reqPekerjaan= $set->getField('PEKERJAAN');
  $reqAwalBayar= dateToPageCheck($set->getField('AWAL_BAYAR'));
  $reqAkhirBayar= dateToPageCheck($set->getField('AKHIR_BAYAR'));
  
  $reqSuamiIstriId= $set->getField('SUAMI_ISTRI_ID');
  $reqSuamiIstri= $set->getField('SUAMI_ISTRI_NAMA');
  $reqNoInduk= $set->getField('NOMOR_INDUK');
  $reqTanggalMeninggal= dateToPageCheck($set->getField('TANGGAL_MENINGGAL'));

  $reqGelarDepan= $set->getField('GELAR_DEPAN');
  $reqGelarBelakang= $set->getField('GELAR_BELAKANG');
  $reqAktaKelahiran= dateToPageCheck($set->getField('AKTA_KELAHIRAN'));
  $reqJenisIdDokumen= $set->getField('JENIS_ID_DOKUMEN');
  $reqAgamaId= $set->getField('AGAMA_ID');
  $reqEmail= $set->getField('EMAIL');
  $reqHp= $set->getField('HP');
  $reqTelepon= $set->getField('TELEPON');
  $reqAlamat= $set->getField('ALAMAT');
  $reqBpjsNo= $set->getField('BPJS_NO');
  $reqBpjsTanggal= dateToPageCheck($set->getField('BPJS_TANGGAL'));
  $reqNpwpNo= $set->getField('NPWP_NO');
  $reqNpwpTanggal= dateToPageCheck($set->getField('NPWP_TANGGAL'));
  $reqStatusPns= $set->getField('STATUS_PNS');
  $reqNipPns= $set->getField('NIP_PNS');
  $reqStatusLulus= $set->getField('STATUS_LULUS');
  $reqKematianNo= $set->getField('KEMATIAN_NO');
  $reqKematianTanggal= dateToPageCheck($set->getField('KEMATIAN_TANGGAL'));
  $reqJenisKawinId= $set->getField('JENIS_KAWIN_ID');
  $reqAktaNikahNo= $set->getField('AKTA_NIKAH_NO');
  $reqAktaNikahTanggal= dateToPageCheck($set->getField('AKTA_NIKAH_TANGGAL'));
  $reqNikahTanggal= dateToPageCheck($set->getField('NIKAH_TANGGAL'));
  $reqAktaCeraiNo= $set->getField('AKTA_CERAI_NO');
  $reqAktaCeraiTanggal= dateToPageCheck($set->getField('AKTA_CERAI_TANGGAL'));
  $reqCeraiTanggal= dateToPageCheck($set->getField('CERAI_TANGGAL'));

  $reqPensiunAnakId= $set->getField('PENSIUN_ANAK_ID');
}

$statement= " AND A.PEGAWAI_ID = ".$reqId." AND (COALESCE(NULLIF(A.STATUS, ''), NULL) IS NULL OR A.STATUS = '2')";
$set= new SuamiIstri();
$set->selectByParams(array(), -1, -1, $statement);
// echo $set->query;exit;
$arrsuamiistri=[];
while($set->nextRow())
{
  $arrdata= [];
  $arrdata["ID"]= $set->getField("SUAMI_ISTRI_ID");
  $arrdata["TEXT"]= $set->getField("NAMA");
  array_push($arrsuamiistri, $arrdata);
}
// print_r($arrsuamiistri);exit;

$statement= " AND (COALESCE(NULLIF(A.STATUS, ''), NULL) IS NULL OR A.STATUS = '2')";
$set= new Agama();
$set->selectByParams(array(), -1, -1, $statement);
// echo $set->query;exit;
$arragama=[];
while($set->nextRow())
{
  $arrdata= [];
  $arrdata["ID"]= $set->getField("AGAMA_ID");
  $arrdata["TEXT"]= $set->getField("NAMA");
  array_push($arragama, $arrdata);
}

$set= new JenisIdDokumen();
$set->selectbyparams(array());
// echo $set->query;exit;
$arrjenisiddokumen=[];
while($set->nextRow())
{
  $arrdata= [];
  $arrdata["ID"]= $set->getField("ID");
  $arrdata["TEXT"]= $set->getField("KODE");
  array_push($arrjenisiddokumen, $arrdata);
}

$set= new JenisKawin();
$set->selectbyparams(array());
// echo $set->query;exit;
$arrjeniskawin=[];
while($set->nextRow())
{
  $arrdata= [];
  $arrdata["ID"]= $set->getField("ID");
  $arrdata["TEXT"]= $set->getField("NAMA");
  array_push($arrjeniskawin, $arrdata);
}

$set= new JenisKelamin();
$set->selectbyparams(array());
// echo $set->query;exit;
$arrjeniskelamin=[];
while($set->nextRow())
{
  $arrdata= [];
  $arrdata["ID"]= $set->getField("KODE");
  $arrdata["TEXT"]= $set->getField("NAMA");
  array_push($arrjeniskelamin, $arrdata);
}

// untuk kondisi file
$vfpeg= new globalfilepegawai();
$arrpilihfiledokumen= $vfpeg->pilihfiledokumen();
// print_r($arrpilihfiledokumen);exit;

$riwayattable= "ANAK";
$reqDokumenKategoriFileId= "16"; // ambil dari table KATEGORI_FILE, cek sesuai mode
$arrsetriwayatfield= $vfpeg->setriwayatfield($riwayattable);
// print_r($arrsetriwayatfield);exit;

$arrlistriwayatfilepegawai= $vfpeg->listpilihfilepegawai($reqId, $riwayattable, $reqRowId);
$arrlistpilihfile= $arrlistriwayatfilepegawai["pilihfile"];
// print_r($arrlistpilihfile);exit;
$arrlistriwayat= $arrlistriwayatfilepegawai["riwayat"];

// $keymode= $riwayattable.";".$reqRowId.";foto";

$arrlistpilihfilefield= [];
$reqDokumenPilih= [];
foreach ($arrsetriwayatfield as $key => $value)
{
  $keymode= $value["riwayatfield"];
  $arrlistpilihfilefield[$keymode]= [];

  if(!empty($arrlistpilihfile))
  {
    $arrlistpilihfilefield[$keymode]= $vfpeg->ambilfilemode($arrlistpilihfile, $keymode);

    $reqDokumenPilih[$keymode]= "";
    $infocari= "selected";
    $arraycari= in_array_column($infocari, "selected", $arrlistpilihfilefield[$keymode]);
    // print_r($arraycari);exit;
    if(!empty($arraycari))
    {
      $reqDokumenPilih[$keymode]= 2;
    }
  }
}
// print_r($reqDokumenPilih);exit;
// print_r($arrlistpilihfilefield);exit;

$set= new KualitasFile();
$set->selectByParams(array());
// echo $set->query;exit;
$arrkualitasfile=[];
while($set->nextRow())
{
  $arrdata= [];
  $arrdata["ID"]= $set->getField("KUALITAS_FILE_ID");
  $arrdata["TEXT"]= $set->getField("NAMA");
  array_push($arrkualitasfile, $arrdata);
}
?>
<html>
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
  <!-- <script type="text/javascript" src="lib/easyui/jquery-1.8.0.min.js"></script> -->
  <script type="text/javascript" src="lib/easyui/jquery.easyui.min.js"></script>
  <script type="text/javascript" src="lib/easyui/kalender-easyui.js"></script>
  <script type="text/javascript" src="lib/easyui/globalfunction.js"></script>
  
  <!-- AUTO KOMPLIT -->
  <link rel="stylesheet" href="lib/autokomplit/jquery-ui.css">
  <script src="lib/autokomplit/jquery-ui.js"></script>

  <script type="text/javascript"> 
  $(function(){
      $('#ff').form({
        url:'anak_json/add',
        onSubmit:function(){
          reqValidasiNoInduk= $("#reqValidasiNoInduk").val();
          if(reqValidasiNoInduk == ""){}
          else
          {
            mbox.alert(reqValidasiNoInduk, {open_speed: 0});
            return false;
          }

          if($(this).form('validate')){}
          else
          {
            $.messager.alert('Info', "Lengkapi data terlebih dahulu", 'info');
            return false;
          }
        },
        success:function(data){
          // console.log(data);return false;
          data = data.split("-");
          rowid= data[0];
          infodata= data[1];

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
              document.location.href= "app/loadUrl/app/pegawai_add_anak_data/?reqId=<?=$reqId?>&reqRowId="+rowid;
            }, 1000));
            $(".mbox > .right-align").css({"display": "none"});
          }

        }
      });

      /*$('input[id^="reqSuamiIstri"]').each(function(){
        $(this).autocomplete({
          source:function(request, response){
            var id= this.element.attr('id');
            var replaceAnakId= replaceAnak= urlAjax= "";
      
            if (id.indexOf('reqSuamiIstri') !== -1)
            {
              var element= id.split('reqSuamiIstri');
              var indexId= "reqSuamiIstriId"+element[1];
              urlAjax= "suami_istri_json/combo?reqId=<?=$reqId?>";
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
                    return {desc: element['desc'], id: element['id'], label: element['label']};
                  });
                  response(array);
                }
              }
            })
          },
          focus: function (event, ui) 
          { 
            var id= $(this).attr('id');
            if (id.indexOf('reqSuamiIstri') !== -1)
            {
              var element= id.split('reqSuamiIstri');
              var indexId= "reqSuamiIstriId"+element[1];
            }

              $("#"+indexId).val(ui.item.id).trigger('change');
            },
            autoFocus: true
          })
          .autocomplete( "instance" )._renderItem = function( ul, item ) {
          return $( "<li>" )
          .append( "<a>" + item.desc  + "</a>" )
          .appendTo( ul );
        };
      });*/

  });
  </script>

  <!-- CORE CSS-->    
  <link href="lib/materializetemplate/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="lib/materializetemplate/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- CSS style Horizontal Nav-->    
  <link href="lib/materializetemplate/css/layouts/style-horizontal.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="lib/materializetemplate/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  
  <link href="lib/mbox/mbox.css" rel="stylesheet">
  <script src="lib/mbox/mbox.js"></script>
  <link href="lib/mbox/mbox-modif.css" rel="stylesheet">

</head>

<body>    
  <!--Basic Form-->
  <div id="basic-form" class="section">
    <div class="row">
      <div id='main' class="col s12 m12" style="padding-left: 15px;">

        <ul class="collection card">
          <li class="collection-item ubah-color-warna">EDIT ANAK</li>
          <li class="collection-item">
            <div class="row">

              <form id="ff" method="post" enctype="multipart/form-data">

                <div class="row">
                  <div class="input-field col s12 m4" style="text-align:center">
                    <label for="reqKartu">Foto Anak</label>
                    <?
                    if($tempPath == "")
                    {
                      $tempPath= "images/foto-profile.jpg";
                    }
                    ?>
                    <br/><br/>
                    <img id="infoimage" src="<?=base_url().$tempPath?>" style="width:inherit" id="reqKartu" />
                  </div>

                  <div class="input-field col s12 m8">
                    <div class="row">
                      <div class="input-field col s12 m6">
                        <label for="reqNama">Nama</label>
                        <input placeholder="" type="text" class="easyui-validatebox" required name="reqNama" id="reqNama" <?=$read?> value="<?=$reqNama?>" onKeyUp="return setreplacesinglequote(this);" />
                      </div>
                      <div class="input-field col s12 m3">
                        <label for="reqGelarDepan">Gelar Depan</label>
                        <input placeholder="" type="text" class="easyui-validatebox" name="reqGelarDepan" id="reqGelarDepan" value="<?=$reqGelarDepan?>" />
                      </div>
                      <div class="input-field col s12 m3">
                        <label for="reqGelarBelakang">Gelar Belakang</label>
                        <input placeholder="" type="text" class="easyui-validatebox" name="reqGelarBelakang" id="reqGelarBelakang" value="<?=$reqGelarBelakang?>" />
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12 m3" >
                        <label for="reqTempatLahir">Tempat Lahir</label>
                        <input placeholder="" type="text" class="easyui-validatebox" required name="reqTempatLahir" id="reqTempatLahir" <?=$read?> value="<?=$reqTempatLahir?>" />
                      </div>
                      <div class="input-field col s12 m3">
                        <label class="active" for="reqTanggalLahir">Tanggal Lahir</label>
                        <!-- <input placeholder="" required class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqTanggalLahir" id="reqTanggalLahir" value="<?=$reqTanggalLahir?>" maxlength="10" onKeyDown="return format_date(event,'reqTanggalLahir');" /> -->
                        <table>
                          <tr> 
                            <td style="padding: 0px;">
                              <input  placeholder="" required class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" id="reqTanggalLahir" name="reqTanggalLahir" value="<?=$reqTanggalLahir?>"  maxlength="10" onKeyDown="" oninput="this.value = this.value.replace(/[^0-9.]/g, '-').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0'); return format_date(event,'reqTanggalLahir');" />
                              <!-- <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqBpjsTanggal" id="reqBpjsTanggal" value="<?=$reqBpjsTanggal?>" maxlength="10" onKeyDown="return format_date(event,'reqBpjsTanggal');" /> -->
                            </td>
                            <td style="padding: 0px;">
                              <label class="input-group-btn" for="reqTanggalLahir" style="display: inline-block;width: 90%;text-align: right;top: 0px;">
                                <span class="btn btn-default" style="padding: 6 1rem;height: 30px;">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                              </label>
                            </td>
                        </table>
                      </div>
                      <div class="input-field col s12 m3">
                        <label for="reqUsia">Usia</label>
                        <input placeholder="" disabled type="text" class="easyui-validatebox" id="reqUsia" value="<?=$reqUsia?>" />
                      </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12 m6">
                        <select <?=$disabled?> name="reqStatusKeluarga" id="reqStatusKeluarga">
                          <option value="1" <? if($reqStatusKeluarga == 1) echo 'selected';?>>Kandung</option>
                          <option value="2" <? if($reqStatusKeluarga == 2) echo 'selected';?>>Tiri</option>
                          <option value="3" <? if($reqStatusKeluarga == 3) echo 'selected';?>>Angkat</option>
                        </select>
                        <label for="reqStatusKeluarga">Status Keluarga</label>
                      </div>
                      <div class="input-field col s12 m6">
                        <select <?=$disabled?> name="reqSuamiIstriId" id="reqSuamiIstriId">
                          <option value="" selected></option>
                          <?
                          foreach ($arrsuamiistri as $key => $value)
                          {
                            $optionid= $value["ID"];
                            $optiontext= $value["TEXT"];
                            // $optionselected= $value["selected"];
                            $optionselected= "";
                            if($reqSuamiIstriId == $optionid)
                              $optionselected= "selected";
                          ?>
                            <option value="<?=$optionid?>" <?=$optionselected?>><?=$optiontext?></option>
                          <?
                          }
                          ?>
                        </select>
                        <label for="reqSuamiIstriId">Nama Bapak / Ibu</label>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="input-field col s12 m4">
                    <label for="reqAktaKelahiran">Akta Kelahiran</label>
                    <input placeholder="" type="text" class="easyui-validatebox" name="reqAktaKelahiran" id="reqAktaKelahiran" <?=$read?> value="<?=$reqAktaKelahiran?>" />
                  </div>
                  <div class="input-field col s12 m8">
                    <div class="row">

                      <div class="input-field col s12 m2 mtmin">
                        <select <?=$disabled?> name="reqJenisIdDokumen" id="reqJenisIdDokumen">
                          <option value="" selected></option>
                          <?
                          foreach ($arrjenisiddokumen as $key => $value)
                          {
                            $optionid= $value["ID"];
                            $optiontext= $value["TEXT"];
                            $optionselected= "";
                            if($reqJenisIdDokumen == $optionid)
                              $optionselected= "selected";
                          ?>
                            <option value="<?=$optionid?>" <?=$optionselected?>><?=$optiontext?></option>
                          <?
                          }
                          ?>
                        </select>
                        <label for="reqJenisIdDokumen">Jenis Dok</label>
                      </div>
                      <div class="input-field col s12 m4 mtmin">
                        <label for="reqNoInduk">Nomor Identitas</label>
                        <input type="hidden" id="reqValidasiNoInduk" />
                        <input placeholder="" name="reqNoInduk" class="easyui-validatebox" id="reqNoInduk" type="text" value="<?=$reqNoInduk?>" />
                      </div>
                      <div class="input-field col s12 m3 mtmin">
                        <select <?=$disabled?> name="reqJenisKelamin" id="reqJenisKelamin">
                          <option value="" selected></option>
                          <?
                          foreach ($arrjeniskelamin as $key => $value)
                          {
                            $optionid= $value["ID"];
                            $optiontext= $value["TEXT"];
                            $optionselected= "";
                            if($reqJenisKelamin == $optionid)
                              $optionselected= "selected";
                          ?>
                            <option value="<?=$optionid?>" <?=$optionselected?>><?=$optiontext?></option>
                          <?
                          }
                          ?>
                        </select>
                        <label for="reqJenisKelamin">Jenis Kel</label>
                      </div>
                      <div class="input-field col s12 m3 mtmin">
                        <select <?=$disabled?> name="reqAgamaId" id="reqAgamaId">
                          <option value="" selected></option>
                          <?
                          foreach ($arragama as $key => $value)
                          {
                            $optionid= $value["ID"];
                            $optiontext= $value["TEXT"];
                            $optionselected= $value["selected"];
                          ?>
                            <option value="<?=$optionid?>" <?=$optionselected?>><?=$optiontext?></option>
                          <?
                          }
                          ?>
                        </select>
                        <label for="reqAgamaId">Agama</label>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12 m3">
                    <label for="reqEmail">Email</label>
                    <input placeholder name="reqEmail" id="reqEmail" class="easyui-validatebox" data-options="validType:'email'" type="text" value="<?=$reqEmail?>" />
                  </div>
                  <div class="input-field col s12 m3">
                    <label for="reqHp">No HP / WA</label>
                    <input placeholder name="reqHp" id="reqHp" class="easyui-validatebox validasiangka" type="text" value="<?=$reqHp?>" />
                  </div>
                  <div class="input-field col s12 m3">
                    <label for="reqTelepon">No Telp Rumah</label>
                    <input placeholder name="reqTelepon" id="reqTelepon" class="easyui-validatebox validasiangka" type="text" value="<?=$reqTelepon?>" />
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m12">
                    <label for="reqAlamat">Alamat</label>
                    <textarea class="materialize-textarea" name="reqAlamat"><?=$reqAlamat?></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m3">
                    <label for="reqBpjsNo">No BPJS</label>
                    <input placeholder="" type="text" class="easyui-validatebox validasiangka" name="reqBpjsNo" id="reqBpjsNo" <?=$read?> value="<?=$reqBpjsNo?>" />
                  </div>
                  <div class="input-field col s12 m3">
                    <label for="reqBpjsTanggal">Tanggal BPJS</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqBpjsTanggal" id="reqBpjsTanggal" value="<?=$reqBpjsTanggal?>" maxlength="10" onKeyDown="return format_date(event,'reqBpjsTanggal');" />
                  </div>
                  <div class="input-field col s12 m3">
                    <label for="reqNpwpNo">No NPWP</label>
                    <input placeholder="" type="text" class="easyui-validatebox validasiangka" name="reqNpwpNo" id="reqNpwpNo" <?=$read?> value="<?=$reqNpwpNo?>" />
                  </div>
                  <div class="input-field col s12 m3">
                    <label for="reqNpwpTanggal">Tanggal NPWP</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqNpwpTanggal" id="reqNpwpTanggal" value="<?=$reqNpwpTanggal?>" maxlength="10" onKeyDown="return format_date(event,'reqNpwpTanggal');" />
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12 m3">
                    <input type="checkbox" id="reqStatusPns" name="reqStatusPns" value="1" <? if($reqStatusPns == 1) echo 'checked'?> />
                    <label for="reqStatusPns"></label>
                    PNS
                  </div>
                  <div class="input-field col s12 m3" id="reqLabelNipBaru">
                    <label for="reqNipPns">NIP Baru</label>
                    <input placeholder="" class="validasiangka" id="reqNipPns" type="text" name="reqNipPns" value="<?=$reqNipPns?>" />
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12 m3">
                    <select name="reqPendidikanId" id="reqPendidikanId" <?=$disabled?>>
                      <?
                      while($pendidikan->nextRow())
                      {
                      ?>
                        <option value="<?=$pendidikan->getField('PENDIDIKAN_ID')?>" <? if($reqPendidikanId == $pendidikan->getField('PENDIDIKAN_ID')) echo 'selected';?>><?=$pendidikan->getField('NAMA')?></option>
                      <?
                      }
                      ?>
                    </select>
                    <label for="reqPendidikanId">Pendidikan</label>
                  </div>
                  <div class="input-field col s12 m3" id="labelstatuslulus">
                    <input type="checkbox" id="reqStatusLulus" name="reqStatusLulus" value="1" <? if($reqStatusLulus == 1) echo 'checked'?> />
                    <label for="reqStatusLulus"></label>
                    Sudah Lulus
                  </div>
                  <div class="input-field col s12 m2">
                    <select <?=$disabled?> name="reqStatusBekerja" id="reqStatusBekerja">
                      <option value="1" <? if($reqStatusBekerja == 1) echo 'selected';?>>Sudah</option>
                      <option value="" <? if($reqStatusBekerja == "") echo 'selected';?>>Belum</option>
                    </select>
                    <label for="reqStatusBekerja">Status Bekerja</label>
                  </div>
                  <div class="input-field col s12 m4 labelpekerjaan">
                    <label for="reqPekerjaan">Pekerjaan</label>
                    <input placeholder="" type="text" <?=$read?> name="reqPekerjaan" id="reqPekerjaan" value="<?=$reqPekerjaan?>" />
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12 m2">
                    <select <?=$disabled?> name="reqStatusAktif" id="reqStatusAktif">
                      <option value="1" <? if($reqStatusAktif == 1) echo 'selected';?>>Hidup</option>
                      <option value="2" <? if($reqStatusAktif == 2) echo 'selected';?>>Wafat</option>
                    </select>
                    <label for="reqStatusAktif">Status Hidup</label>
                  </div>

                  <div class="input-field col s12 m3 reqLabelTanggalMeninggal">
                    <label for="reqKematianNo">Surat Keterangan Kematian</label>
                    <input placeholder="" type="text" class="easyui-validatebox" name="reqKematianNo" id="reqKematianNo" <?=$read?> value="<?=$reqKematianNo?>" />
                  </div>
                  <div class="input-field col s12 m3 reqLabelTanggalMeninggal">
                    <label for="reqKematianTanggal">Tanggal Surat Kematian</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqKematianTanggal" id="reqKematianTanggal" value="<?=$reqKematianTanggal?>" maxlength="10" onKeyDown="return format_date(event,'reqKematianTanggal');" />
                  </div>

                  <div class="input-field col s12 m3 reqLabelTanggalMeninggal">
                    <label for="reqTanggalMeninggal">Tanggal Meninggal</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqTanggalMeninggal" id="reqTanggalMeninggal" value="<?=$reqTanggalMeninggal?>" maxlength="10" onKeyDown="return format_date(event,'reqTanggalMeninggal');"/>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12 m2">
                    <select <?=$disabled?> name="reqJenisKawinId" id="reqJenisKawinId">
                      <option value=""></option>
                    </select>
                    <label for="reqJenisKawinId">Status Pernikahan</label>
                  </div>

                  <div class="input-field col s12 m3 labelnikah">
                    <label for="reqAktaNikahNo">No Akta Nikah</label>
                    <input placeholder="" type="text" class="easyui-validatebox" name="reqAktaNikahNo" id="reqAktaNikahNo" <?=$read?> value="<?=$reqAktaNikahNo?>" />
                  </div>
                  <div class="input-field col s12 m3 labelnikah">
                    <label for="reqAktaNikahTanggal">Tanggal Akta Nikah</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqAktaNikahTanggal" id="reqAktaNikahTanggal" value="<?=$reqAktaNikahTanggal?>" maxlength="10" onKeyDown="return format_date(event,'reqAktaNikahTanggal');" />
                  </div>
                  <div class="input-field col s12 m3 labelnikah">
                    <label for="reqNikahTanggal">Tanggal Nikah</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqNikahTanggal" id="reqNikahTanggal" value="<?=$reqNikahTanggal?>" maxlength="10" onKeyDown="return format_date(event,'reqNikahTanggal');"/>
                  </div>

                  <div class="input-field col s12 m3 labelcerai">
                    <label for="reqAktaCeraiNo">Surat Pengadilan / Cerai</label>
                    <input placeholder="" type="text" class="easyui-validatebox" name="reqAktaCeraiNo" id="reqAktaCeraiNo" <?=$read?> value="<?=$reqAktaCeraiNo?>" />
                  </div>
                  <div class="input-field col s12 m3 labelcerai">
                    <label for="reqAktaCeraiTanggal">Tanggal Akta Cerai</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqAktaCeraiTanggal" id="reqAktaCeraiTanggal" value="<?=$reqAktaCeraiTanggal?>" maxlength="10" onKeyDown="return format_date(event,'reqAktaCeraiTanggal');" />
                  </div>
                  <div class="input-field col s12 m3 labelcerai">
                    <label for="reqCeraiTanggal">Tanggal Cerai</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqCeraiTanggal" id="reqCeraiTanggal" value="<?=$reqCeraiTanggal?>" maxlength="10" onKeyDown="return format_date(event,'reqCeraiTanggal');"/>
                  </div>

                </div>

                <div class="row">
                  <div class="input-field col s12 m3">
                    <input type="checkbox" id="reqDapatTunjangan" name="reqDapatTunjangan" value="1" <? if($reqDapatTunjangan == 1) echo 'checked'?> />
                    <label for="reqDapatTunjangan">Tunjangan</label>
                  </div>
                  <div class="input-field col s12 m2">
                    <label for="reqAwalBayar">Mulai Dibayar</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqAwalBayar" id="reqAwalBayar" value="<?=$reqAwalBayar?>" maxlength="10" onKeyDown="return format_date(event,'reqAwalBayar');"/>
                  </div>
                  <div class="input-field col s12 m2">
                    <label for="reqAkhirBayar">Akhir Dibayar</label>
                    <input placeholder="" class="easyui-validatebox" data-options="validType:'dateValidPicker'" type="text" name="reqAkhirBayar" id="reqAkhirBayar" value="<?=$reqAkhirBayar?>" maxlength="10" onKeyDown="return format_date(event,'reqAkhirBayar');"/>
                  </div>
                </div>

                <!-- <div class="row">
                  
                  <div class="input-field col s12 m2">
                    <select <?=$disabled?> name="reqStatusNikah" id="reqStatusNikah">
                      <option value="1" <? if($reqStatusNikah == 1) echo 'selected';?>>Sudah</option>
                      <option value="" <? if($reqStatusNikah == "") echo 'selected';?>>Belum</option>
                    </select>
                    <label for="reqStatusNikah">Status Menikah</label>
                  </div>

                </div> -->

                <div class="row">
                  <div class="input-field col s12">
                    <button class="btn orange waves-effect waves-light" style="font-size:9pt" type="button" id="kembali">Kembali
                      <i class="mdi-navigation-arrow-back left hide-on-small-only"></i>
                    </button>

                    <script type="text/javascript">
                      $("#kembali").click(function() { 
                        document.location.href = "app/loadUrl/app/pegawai_add_anak_monitoring?reqId=<?=$reqId?>";
                      });
                    </script>

                    <?
                    if($tempJumlah == 0)
                    {
                      if($reqPensiunAnakId == "")
                      {
                    ?>
                        <input type="hidden" name="reqRowId" value="<?=$reqRowId?>" />
                        <input type="hidden" name="reqId" value="<?=$reqId?>" />
                        <input type="hidden" name="reqMode" value="<?=$reqMode?>" />
                    <?
                        // A;R;D
                        if($tempAksesMenu == "A")
                        {
                      ?>
                      <button class="btn waves-effect waves-light green" style="font-size:9pt" type="submit" name="action">Simpan
                        <i class="mdi-content-save left hide-on-small-only"></i>
                      </button>
                      <?
                        }
                      }
                    }
                    ?>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12 m12">
                  <?
                  // area untuk upload file
                  foreach ($arrsetriwayatfield as $key => $value)
                  {
                    $riwayatfield= $value["riwayatfield"];
                    $riwayatfieldtipe= $value["riwayatfieldtipe"];
                    $riwayatfieldinfo= $value["riwayatfieldinfo"];
                    $riwayatfieldstyle= $value["riwayatfieldstyle"];
                    // echo $riwayatfieldstyle;exit;
                  ?>
                    <button class="btn blue waves-effect waves-light" style="font-size:9pt;<?=$riwayatfieldstyle?>" type="button" id='buttonframepdf<?=$riwayatfield?>'>
                      <input type="hidden" id="labelvpdf<?=$riwayatfield?>" value="<?=$riwayatfieldinfo?>" />
                      <span id="labelframepdf<?=$riwayatfield?>"><?=$riwayatfieldinfo?></span>
                    </button>
                  <?
                  }
                  ?>
                  </div>
                </div>

                <div class="row"><div class="col s12 m12"><br/></div></div>

                <?
                // area untuk upload file
                foreach ($arrsetriwayatfield as $key => $value)
                {
                  $riwayatfield= $value["riwayatfield"];
                  $riwayatfieldtipe= $value["riwayatfieldtipe"];
                  $riwayatfieldinfo= " - ".$value["riwayatfieldinfo"];
                ?>
                <div class="row">
                  <div class="input-field col s12 m4">
                    <input type="hidden" id="reqDokumenFileId<?=$riwayatfield?>" name="reqDokumenFileId[]" />
                    <input type="hidden" id="reqDokumenKategoriFileId<?=$riwayatfield?>" name="reqDokumenKategoriFileId[]" value="<?=$reqDokumenKategoriFileId?>" />
                    <input type="hidden" id="reqDokumenKategoriField<?=$riwayatfield?>" name="reqDokumenKategoriField[]" value="<?=$riwayatfield?>" />
                    <input type="hidden" id="reqDokumenPath<?=$riwayatfield?>" name="reqDokumenPath[]" value="" />
                    <input type="hidden" id="reqDokumenTipe<?=$riwayatfield?>" name="reqDokumenTipe[]" value="<?=$riwayatfieldtipe?>" />

                    <select id="reqDokumenPilih<?=$riwayatfield?>" name="reqDokumenPilih[]">
                      <?
                      foreach ($arrpilihfiledokumen as $key => $value)
                      {
                        $optionid= $value["id"];
                        $optiontext= $value["nama"];
                      ?>
                        <option value="<?=$optionid?>" <? if($reqDokumenPilih[$riwayatfield] == $optionid) echo "selected";?>><?=$optiontext?></option>
                      <?
                      }
                      ?>
                    </select>
                    <label for="reqDokumenPilih<?=$riwayatfield?>">File Dokumen<?=$riwayatfieldinfo?></label>
                  </div>

                  <div class="input-field col s12 m4">
                    <select <?=$disabled?> name="reqDokumenFileKualitasId[]" id="reqDokumenFileKualitasId<?=$riwayatfield?>">
                      <option value=""></option>
                      <?
                      foreach ($arrkualitasfile as $key => $value)
                      {
                        $optionid= $value["ID"];
                        $optiontext= $value["TEXT"];
                        $optionselected= "";
                        if($reqDokumenFileKualitasId == $optionid)
                          $optionselected= "selected";
                      ?>
                        <option value="<?=$optionid?>" <?=$optionselected?>><?=$optiontext?></option>
                      <?
                      }
                      ?>
                    </select>
                    <label for="reqDokumenFileKualitasId<?=$riwayatfield?>">Kualitas Dokumen<?=$riwayatfieldinfo?></label>
                  </div>

                  <div id="labeldokumenfileupload<?=$riwayatfield?>" class="input-field col s12 m4" style="margin-top: -25px; margin-bottom: 10px;">
                    <div class="file_input_div">
                      <div class="file_input input-field col s12 m1">
                        <label class="labelupload">
                          <i class="mdi-file-file-upload" style="font-family: "Roboto",sans-serif,Material-Design-Icons !important; font-size: 14px !important;">Upload</i>
                          <input id="file_input_file" name="reqLinkFile[]" class="none" type="file" />
                        </label>
                      </div>
                      <div id="file_input_text_div" class=" input-field col s12 m11">
                        <input class="file_input_text" type="text" disabled readonly id="file_input_text" />
                        <label for="file_input_text"></label>
                      </div>
                    </div>
                  </div>

                  <div id="labeldokumendarifileupload<?=$riwayatfield?>" class="input-field col s12 m4">
                    <select id="reqDokumenIndexId<?=$riwayatfield?>">
                      <option value="" selected></option>
                      <?
                      $arrlistpilihfilepegawai= $arrlistpilihfilefield[$riwayatfield];
                      foreach ($arrlistpilihfilepegawai as $key => $value)
                      {
                        $optionid= $value["index"];
                        $optiontext= $value["nama"];
                        $optionselected= $value["selected"];
                      ?>
                        <option value="<?=$optionid?>" <?=$optionselected?>><?=$optiontext?></option>
                      <?
                      }
                      ?>
                    </select>
                    <label for="reqDokumenIndexId<?=$riwayatfield?>">Nama e-File</label>
                  </div>

                </div>
                <?
                }
                // area untuk upload file
                ?>

              </form>
            </div>
          </li>
        </ul>
      </div>

      <div id='divframepdf' class="col s12 m6" style="padding-top: 10px;">
        <input type="hidden" id="vnewframe" value="">
        <span id="labelriwayatframepdf"></span>
        <iframe id="infonewframe" style="width: 100%; height: 160%" src=""></iframe>
      </div>

    </div>
</div>
<!-- jQuery Library -->
<!-- <script type="text/javascript" src="lib/materializetemplate/js/plugins/jquery-1.11.2.min.js"></script> -->

<!--materialize js-->
<script type="text/javascript" src="lib/materializetemplate/js/my-materialize.min.js"></script>
<style type="text/css">
  .select-dropdown {
    max-height:250px; overflow:auto;
  }
</style>

<!-- tambahan lib cek tanggal -->
<script src="lib/moment/moment-with-locales.js"></script>
<script type="text/javascript">
  getarrjeniskawin= JSON.parse('<?=JSON_encode($arrjeniskawin)?>');

  $(document).ready(function() {
    $('select').material_select();
  });

  tanggalsekarang= "<?=$tanggalsekarang?>";
  $('#reqTanggalLahir').keyup(function() {
    var vold= $('#reqTanggalLahir').val();
    var vnew= tanggalsekarang;

    getparamyearoldnew("reqUsia", vold, vnew);
  });

  setjenisiddokumen("");
  $("#reqJenisIdDokumen").change(function(){
    setjenisiddokumen("data");
  });

  $("#reqNoInduk").keyup(function(){
    setnoinduk("data");
  });

  function setjenisiddokumen(infomode)
  {
    reqJenisIdDokumen= $("#reqJenisIdDokumen").val();
    setnoinduk(infomode);

    // infomode
  }

  function setnoinduk(infomode)
  {
    reqJenisIdDokumen= $("#reqJenisIdDokumen").val();
    reqNoInduk= $("#reqNoInduk").val();
    reqNoIndukLength= reqNoInduk.length;

    $("#reqNoInduk").validatebox({required: false});
    $("#reqNoInduk").removeClass('validatebox-invalid');

    reqValidasiNoInduk= "";
    // 1 KTP
    if(reqJenisIdDokumen == "1")
    {
      // 1111111111111111
      // console.log(reqNoIndukLength);
      if(!$.isNumeric(reqNoInduk) || reqNoIndukLength !== 16)
      {
        reqValidasiNoInduk= "KTP harus 16 digit angka, tanpa spasi dan tanda baca";
      }
    }
    // 2 Pasport
    else if(reqJenisIdDokumen == "2")
    {
      if(reqNoIndukLength < 5 || reqNoIndukLength > 8)
      {
        reqValidasiNoInduk= "Passport minimal 5 char maksimal 8 char, bisa angka dan huruf";
      }
    }
    // 3 SIM
    else if(reqJenisIdDokumen == "3")
    {
      if(!$.isNumeric(reqNoInduk) || reqNoIndukLength !== 12)
      {
        reqValidasiNoInduk= "SIM harus 12 digit angkat, tanpa spasi dan tanda baca";
      }
    }
    else
    {
      reqValidasiNoInduk= "Isikan terlebih dahulu Jenis Dokumen";
      $("#reqNoInduk").validatebox({required: true});
    }

    // console.log(reqValidasiNoInduk);
    $("#reqValidasiNoInduk").val(reqValidasiNoInduk);
    // reqJenisIdDokumen;reqNoInduk
  }

  setpendidikan("");
  $("#reqPendidikanId").change(function () {
    setpendidikan("data");
  });

  function setpendidikan(infomode)
  {
    reqPendidikanId= $("#reqPendidikanId").val();
    $("#labelstatuslulus").show();

    if(infomode == "data")
    {
      $("#reqStatusLulus").prop('checked', false);
    }

    if(reqPendidikanId == 0)
    {
      $("#labelstatuslulus").hide();
      $("#reqStatusLulus").prop('checked', false);
    }
  }

  setcetang();
  $("#reqStatusPns").click(function () {
    setcetang();
  });

  function setcetang()
  {
    if($("#reqStatusPns").prop('checked')) 
    {
      $("#reqLabelNipBaru").show();
    }
    else
    {
      $("#reqNipPns").val("");
      $("#reqLabelNipBaru").hide();
    }
  }

  setstatusbekerja("");
  $("#reqStatusBekerja").change(function() { 
    setstatusbekerja("data");
  });

  function setstatusbekerja(infomode)
  {
    $(".labelpekerjaan").hide();

    if(infomode == "")
      vinfodata= "<?=$reqStatusBekerja?>";
    else
      vinfodata= $("#reqStatusBekerja").val();

    if(vinfodata == "1")
    {
      $(".labelpekerjaan").show();
    }
  }

  setstatusaktif("");
  $("#reqStatusAktif").change(function() { 
    setstatusaktif("data");
  });

  function setstatusaktif(infomode)
  {
    var reqStatusAktif= $("#reqStatusAktif").val();
    $(".reqLabelTanggalMeninggal").hide();

    if(reqStatusAktif == "2")
    {
      $("#reqKematianTanggal, #reqKematianNo, #reqTanggalMeninggal").validatebox({required: true});
      $(".reqLabelTanggalMeninggal").show();
    }
    else
    {
      $("#reqKematianTanggal, #reqKematianNo, #reqTanggalMeninggal").validatebox({required: false});
      $("#reqKematianTanggal, #reqKematianNo, #reqTanggalMeninggal").removeClass('validatebox-invalid');
      $("#reqKematianTanggal, #reqKematianNo, #reqTanggalMeninggal").val("");
    }

    setjeniskawinid(infomode);
  }
  
  setjeniskawinid("");
  $("#reqJenisKawinId").change(function() { 
    setjeniskawinid("data");
  });

  function setjeniskawinid(infomode)
  {
    reqStatusAktif= $("#reqStatusAktif").val();

    if(infomode == "")
      vinfodata= "<?=$reqJenisKawinId?>";
    else
      vinfodata= $("#reqJenisKawinId").val();

    vlabelid= "reqJenisKawinId";
    $("#"+vlabelid+" option").remove();
    $("#"+vlabelid).material_select();
    var voption= "<option value=''></option>";

    if(Array.isArray(getarrjeniskawin) && getarrjeniskawin.length)
    {
      $.each(getarrjeniskawin, function( index, value ) {
        // console.log( index + ": " + value["id"] );
        infoid= value["ID"];
        infotext= value["TEXT"];
        setoption= "1";

        // 1:Hidup
        if(reqStatusAktif == "1")
        {
          // if(infoid == "3")
          // {
          //   setoption= "";
          // }
        }
        // 2:Wafat
        else if(reqStatusAktif == "2")
        {
          // setoption= "";
          if(infoid == "3")
          {
            // setoption= "1";
          }
        }
        else
        {
          // setoption= "";
          if(infoid == "4")
          {
            // setoption= "1";
          } 
        }

        if(setoption == "1")
        {
          vselected= "";
          if(infoid == vinfodata)
          {
            vselected= "selected";
          }

          voption+= "<option value='"+infoid+"' "+vselected+" >"+infotext+"</option>";
        }
      });
    }

    $("#"+vlabelid).html(voption);
    $("#"+vlabelid).material_select();

    if(infomode == ""){}
    else
    {
      $("#reqAktaNikahNo, #reqAktaNikahTanggal, #reqNikahTanggal, #reqAktaCeraiNo, #reqAktaCeraiTanggal, #reqCeraiTanggal").val("");
    }

    $("#reqAktaNikahNo, #reqAktaNikahTanggal, #reqNikahTanggal, #reqAktaCeraiNo, #reqAktaCeraiTanggal, #reqCeraiTanggal").validatebox({required: false});
    $("#reqAktaNikahNo, #reqAktaNikahTanggal, #reqNikahTanggal, #reqAktaCeraiNo, #reqAktaCeraiTanggal, #reqCeraiTanggal").removeClass('validatebox-invalid');
    
    if(reqStatusAktif == "2")
    {
      $(".infohidup").hide();
    }
    else
    {
      $(".infohidup").show();
      $(".labelnikah, .labelcerai").hide();
      if(vinfodata == "1")
      {
        $("#reqAktaNikahNo, #reqAktaNikahTanggal, #reqNikahTanggal").validatebox({required: true});
        $(".labelnikah").show();
      }
      else if(vinfodata == "2" || vinfodata == "3")
      {
        $("#reqAktaNikahNo, #reqAktaNikahTanggal, #reqNikahTanggal, #reqAktaCeraiNo, #reqAktaCeraiTanggal, #reqCeraiTanggal").validatebox({required: true});
        $(".labelnikah, .labelcerai").show();
      }
    }
  }

  $('.materialize-textarea').trigger('autoresize');

  getarrlistpilihfilefield= JSON.parse('<?=JSON_encode($arrlistpilihfilefield)?>');
  // console.log(getarrlistpilihfilefield);
  // console.log(getarrlistpilihfilefield["aktakelahiran"]);

  $("#vnewframe").val("");
  $('#divframepdf').hide();
  $('[id^="buttonframepdf"]').click(function(){
    infoid= $(this).attr('id');
    infoid= infoid.replace("buttonframepdf", "");
    buttonframepdf(infoid);
  });

  function buttonframepdf(infoid) {
    $('[id^="buttonframepdf"]').hide();
    // $('[id^="buttonframepdf"]').each(function(){
    //   vinfoid= $(this).attr('id');
    //   vinfoid= vinfoid.replace("buttonframepdf", "");

    //   labelvpdf= $("#labelvpdf"+vinfoid).val();
    //   $("#labelframepdf"+vinfoid).text(labelvpdf);
    // });

    var element = document.getElementById("main");
    if ($("#divframepdf").css("visibility") == "hidden" || $('#divframepdf').is(':hidden')) {

      reqDokumenIndexId= $("#reqDokumenIndexId"+infoid+" option:selected").val();
      getarrlistpilihfilepegawai= getarrlistpilihfilefield[infoid];
      // console.log(getarrlistpilihfilepegawai);

      if(Array.isArray(getarrlistpilihfilepegawai) && getarrlistpilihfilepegawai.length)
      {
        varrlistpilihfilepegawai= getarrlistpilihfilepegawai.filter(item => item.index === reqDokumenIndexId);
        // console.log(varrlistpilihfilepegawai);

        vurl= varrlistpilihfilepegawai[0]["vurl"];

        element.classList.remove("m12");
        element.classList.add("m6");
        $('#divframepdf').show();
        $("#vnewframe").val(infoid);

        labelvpdf= $("#labelvpdf"+infoid).val();
        $("#labelframepdf"+infoid).text("Tutup " + labelvpdf);
        $("#buttonframepdf"+infoid).show();

        var infonewframe= $('#infonewframe');
        infourl= '<?=base_url()?>/lib/pdfjs/web/viewer.html?file=../../../'+vurl;
        // console.log(infourl);

        vnewframe= $("#vnewframe").val();
        infonewframe.attr("src", infourl);
        if(vnewframe == ""){}
        else
        {
          infonewframe.contentWindow.location.reload();
        }

      }
    }
    else
    {
      labelvpdf= $("#labelvpdf"+infoid).val();
      $("#labelframepdf"+infoid).text(labelvpdf);

      $('[id^="buttonframepdf"]').show();

      element.classList.remove("m6");
      element.classList.add("m12");
      $('#divframepdf').hide();
      $("#vnewframe").val("");
      // $("#labelframepdf"+infoid).text("Lihat");
    }

    // khusus foto saja
    $("#buttonframepdffoto").hide();

  }

  $('[id^="buttonframepdf"]').each(function(){
    vinfoid= $(this).attr('id');
    vinfoid= vinfoid.replace("buttonframepdf", "");

    setdokumenpilih(vinfoid, "");
  });
  
  $('[id^="reqDokumenPilih"]').change(function(){
    vinfoid= $(this).attr('id');
    vinfoid= vinfoid.replace("reqDokumenPilih", "");
    setdokumenpilih(vinfoid, "data");
  });

  $('[id^="reqDokumenIndexId"]').change(function(){
    vinfoid= $(this).attr('id');
    vinfoid= vinfoid.replace("reqDokumenIndexId", "");
    setinfonewframe(vinfoid, "data");
  });

  function setdokumenpilih(vinfoid, infomode)
  {
    reqDokumenPilih= $("#reqDokumenPilih"+vinfoid).val();

    if(infomode == ""){}
    else
    {
      $("#reqDokumenFileKualitasId"+vinfoid).val("");
      $("#reqDokumenFileKualitasId"+vinfoid).material_select();
    }

    $("#buttonframepdf"+vinfoid+", #labeldokumenfileupload"+vinfoid+", #labeldokumendarifileupload"+vinfoid).hide();
    if(reqDokumenPilih == "1")
    {
      $("#reqDokumenFileId"+vinfoid).val("");
      $("#labeldokumenfileupload"+vinfoid).show();

      var element = document.getElementById("main");
      element.classList.remove("m6");
      element.classList.add("m12");
      $('#divframepdf').hide();
      $("#vnewframe").val("");

    }
    else if(reqDokumenPilih == "2")
    {
      $("#labeldokumendarifileupload"+vinfoid).show();

      if(vinfoid == "foto"){}
      else
      $("#buttonframepdf"+vinfoid).show();

      setinfonewframe(vinfoid, infomode);
    }

  }

  function setinfonewframe(vinfoid, infomode)
  {
    reqDokumenIndexId= $("#reqDokumenIndexId"+vinfoid).val();

    infoid= reqDokumenIndexId;
    // console.log(infoid+"-"+vinfoid);

    getarrlistpilihfilepegawai= getarrlistpilihfilefield[vinfoid];
    // console.log(getarrlistpilihfilepegawai);

    if(Array.isArray(getarrlistpilihfilepegawai) && getarrlistpilihfilepegawai.length)
    {
      varrlistpilihfilepegawai= getarrlistpilihfilepegawai.filter(item => item.index === infoid);
      // console.log(varrlistpilihfilepegawai);

      vurl= varrlistpilihfilepegawai[0]["vurl"];
      vext= varrlistpilihfilepegawai[0]["ext"];
      reqDokumenFileId= varrlistpilihfilepegawai[0]["id"];
      reqDokumenFileKualitasId= varrlistpilihfilepegawai[0]["filekualitasid"];
      // console.log(reqDokumenFileId);
      if(vurl == ""){}
      else
      {
        $("#reqDokumenFileId"+vinfoid).val(reqDokumenFileId);
        $("#reqDokumenPath"+vinfoid).val(vurl);
        $("#reqDokumenFileKualitasId"+vinfoid).val(reqDokumenFileKualitasId);
        $("#reqDokumenFileKualitasId"+vinfoid).material_select();

        // console.log(vurl);
        if(vext == "jpg")
        {
          $("#infoimage").attr("src", vurl);
        }
        else
        {
          if(infomode == ""){}
          else
          {
            var infonewframe= $('#infonewframe');
            infourl= '<?=base_url()?>/lib/pdfjs/web/viewer.html?file=../../../'+vurl;
            // console.log(infourl);

            vnewframe= $("#vnewframe").val();
            // khusus mode terpilih
            if(vinfoid == vnewframe)
            {
              infonewframe.attr("src", infourl);
              if(vnewframe == ""){}
              else
              {
                infonewframe.contentWindow.location.reload();
              }
            }

          }
        }

        /*$("#labelriwayatframepdf").text("File Terpilih Nama E-file");

        // console.log(vurl);
        */

      }

    }

  }

</script>

<link rel="stylesheet" href="lib/AdminLTE-2.4.0-rc/dist/css/skins/ubah-skin.css">
<script src="lib/AdminLTE-2.4.0-rc/dist/js/ubah-skin.js"></script>
<style type="text/css">
  .mtmin{
    margin-top: -1px;
  }
</style>

<script type="text/javascript">
     $("#reqTanggalLahir").change(function(){
    // setjenisiddokumen("data");
    tanggal= $("#reqTanggalLahir").val();
    tanggal=tanggal.split("-");
    tanggal=tanggal[2]+'-'+tanggal[1]+'-'+tanggal[0];
    console.log(tanggal);
  });
</script>

</body>
</html>