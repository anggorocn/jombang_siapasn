<?php
include_once("functions/string.func.php");
include_once("functions/default.func.php");
include_once("functions/date.func.php");

$reqBreadCrum= $this->input->get("reqBreadCrum");

$tinggi = 156;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <title>Diklat</title>
    <base href="<?=base_url()?>" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/media/images/favicon.ico">
    <!--<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">-->
    <link href="css/admin.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="lib/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="lib/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="lib/easyui/demo/demo.css">

    <script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="lib/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="lib/easyui/kalender-easyui.js"></script>

    <script type="text/javascript" src="lib/easyui/breadcrum.js"></script>

    <link href="css/bluetabs.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/dropdowntabs.js"></script>

    <!-- CORE CSS-->    
    <link href="lib/materializetemplate/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="lib/materializetemplate/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- CSS style Horizontal Nav-->    
    <link href="lib/materializetemplate/css/layouts/style-horizontal.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="lib/materializetemplate/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- <link rel="stylesheet" type="text/css" href="lib/DataTables-1.10.7/media/css/dataTables.materialize.css"> -->
    <?php /*?><link rel="stylesheet" type="text/css" href="lib/DataTables-1.10.7/media/css/dataTables.material.min.css"><?php */?>

    <link rel="stylesheet" type="text/css" href="css/gaya.css">

    <link href="lib/treeTable2/doc/stylesheets/master.css" rel="stylesheet" type="text/css" />
    <link href="lib/treeTable2/src/stylesheets/jquery.treeTable.css" rel="stylesheet" type="text/css" />

</head>
<body style="background: #eaeaea">
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">
            <!-- START CONTENT -->
            <section id="content-full">



                <div class="row">
                    <div class="col s12 m12">
                        <form id="ff" method="post" enctype="multipart/form-data">
                            <div class="card white">
                                <div class="card-content black-text" style="padding: 8px !important">
                                    <div class="row">
                                        <div class="input-field col s10 m11">
                                            <input type="text" id="reqJudulInformasi" placeholder="Cari judul informasi" class="search-btn" />
                                        </div>
                                        <div class="input-field col s2 m1">
                                            <i class="material-icons">search</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m8" style="padding: 0">
                      <div class="row">

                        <div class="col s12 m12">
                            <div class="card white">
                                <div class="card-content black-text">
                                    <span class="card-title">Judul Informasi</span> 
                                    <p class="tgl-informasi">31 Januari 2018</p>
                                    <p>I am a very simple card. I am good at containing small bits of information.
                                    I am convenient because I require little markup to use effectively.</p>
                                </div>
                                <div class="card-action">
                                    <a href="app/loadUrl/app/informasi_detil">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m12">
                            <div class="card white">
                                <div class="card-content black-text">
                                    <span class="card-title">Judul Informasi</span>
                                    <p class="tgl-informasi">31 Januari 2018</p>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        I am a very simple card. I am good at containing small bits of information.
                                        I am convenient because I require little markup to use effectively.
                                    </p>
                                </div>
                                <div class="card-action">
                                    <a href="app/loadUrl/app/informasi_detil">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m12">
                            <div class="card white">
                                <div class="card-content black-text">
                                    <span class="card-title">Judul Informasi</span>
                                    <p class="tgl-informasi">31 Januari 2018</p>
                                    <p>I am a very simple card. I am good at containing small bits of information.
                                    I am convenient because I require little markup to use effectively.</p>
                                </div>
                                <div class="card-action">
                                    <a href="app/loadUrl/app/informasi_detil">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m12">
                            <div class="card white">
                                <div class="card-content black-text">
                                    <span class="card-title">Judul Informasi</span>
                                    <p class="tgl-informasi">31 Januari 2018</p>
                                    <p>I am a very simple card. I am good at containing small bits of information.
                                    I am convenient because I require little markup to use effectively.</p>
                                </div>
                                <div class="card-action">
                                    <a href="app/loadUrl/app/informasi_detil">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="col s12 m4" style="padding: 0">
                    <div class="col s12 m12">
                        <div class="card white">
                            <div class="card-content black-text">
                                <span class="card-title">Sorting Informasi</span>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select id="reqKategori" name="reqKategori" class="form-control" style="height: 33px;">
                                            <option value="">Semua Kategori</option>
                                            <option value="">Kategori 1</option>
                                            <option value="">Kategori 2</option>
                                            <option value="">Kategori 3</option>
                                        </select>
                                        <label for="reqKategori">Kategori</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="reqTanggalMulai">Tanggal Mulai</label>
                                        <input data-options="validType:'dateValidPicker'" type="text" name="reqTanggalMulai" id="reqTanggalMulai"  onKeyDown="return format_date(event,'reqTanggalMulai');"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="reqTanggalAkhir">Tanggal Akhir</label>
                                        <input data-options="validType:'dateValidPicker'" type="text" name="reqTanggalAkhir" id="reqTanggalAkhir"  onKeyDown="return format_date(event,'reqTanggalAkhir');"/>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="submit" name="reqSubmit"  class="btn green" value="Submit" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<script type="text/javascript" src="lib/materializetemplate/js/plugins/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="lib/materializetemplate/js/my-materialize.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select').material_select();
        $('.scrollspy').scrollSpy();
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: false // Close upon selecting a date,
        });
    });

    $('.materialize-textarea').trigger('autoresize');
</script>
</body>
</html>