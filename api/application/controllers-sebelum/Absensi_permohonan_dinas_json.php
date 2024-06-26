<?php
 
require APPPATH . '/libraries/REST_Controller.php';
include_once("functions/string.func.php");
include_once("functions/date.func.php");
 
class Absensi_permohonan_dinas_json extends REST_Controller {
 
    function __construct() {
        parent::__construct();

        // $this->db->query("alter session set nls_date_format='DD-MM-YYYY'"); 
        
    }
 
    // show data entitas
	function index_get() {
        $this->load->model('UserLoginLog');
        $this->load->model('base/Absensi');

        $user_login_log= new UserLoginLog;
        
        $reqToken = $this->input->get("reqToken");
        $reqPeriode = $this->input->get("reqPeriode");
        // $reqPeriode= "122019";
        $reqMode = $this->input->get("reqMode");

        //CEK PEGAWAI ID DARI TOKEN
        $user_login_log = new UserLoginLog();
        $reqPegawaiId = $user_login_log->getTokenPegawaiId(array("TOKEN" => $reqToken, "STATUS" => '1'));
        // echo $user_login_log->query;exit();

        if($reqPegawaiId == "")
        {
            $this->response(array('status' => 'fail', 'message' => 'Anda tidak berhak untuk mendapatkan info personal pegawai.', 'code' => 502));
        }
        else
        {
            // buat parstisi
            $this->setpartisi($reqPeriode);

            $set = new Absensi;
            $aColumns = array("NIP_BARU_NAMA_LENGKAP", "SATUAN_KERJA_NAMA", "TANGGAL", "TANGGAL_AWAL", "TANGGAL_AKHIR", "KETERANGAN", "STATUS", "PERMOHONAN_CUTI_ID");
            
            $statement= " AND A.PEGAWAI_ID = '".$reqPegawaiId."'";
            $statement.= " AND P.NAMA_PERMOHONAN = 'PERMOHONAN_LAMBAT_PC'";

            if(!empty($reqPeriode))
            {
                $statement.= " AND TO_CHAR(P.TANGGAL, 'MMYYYY') = '".$reqPeriode."'";
            }

            // $statement= " AND A.HARI = '".$reqHariTampil."'";
            $set->selectByParamsPermohonan(array(), -1, -1, $statement);
            // echo $set->query;exit();
            
            $total = 0;
            while($set->nextRow())
            {
                $row = array();
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    $tempValue= $set->getField(trim($aColumns[$i]));
                    if(empty($tempValue)) $tempValue= "";
                    
                    $row[trim($aColumns[$i])] = $tempValue;
                }
                $result[] = $row;

                $total++;
            }
            
            if($total == 0)
            {
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    $row[trim($aColumns[$i])] = "";
                }
                $result[] = $row;
            }
            
            $this->response(array('status' => 'success', 'message' => 'success', 'code' => 200, 'count' => count($aColumns) ,'result' => $result));
        }
    }

    function setpartisi($reqPeriode)
    {
        $this->load->model('base/Absensi');

        if(!empty($reqPeriode))
        {
            $tahun= getTahunPeriode($reqPeriode);
            // $tahun= $reqPeriode;
            for($i= 1; $i <= 12; $i++)
            {
                $reqPeriode= generateZeroDate($i,2).$tahun;
                // echo $reqPeriode."<br/>";exit();

                $set= new Absensi();
                $set->setPartisiTablePeriode($reqPeriode);
                // echo $set->query;exit();
            }
            // exit();
        }
    }
	
    // insert new data to entitas
    function index_post() {
        $this->load->model('UserLoginLog');
        $this->load->model('base/Absensi');

        // print_r($data);exit();

        $user_login_log= new UserLoginLog;

        $reqToken = $this->input->post("reqToken");
        // $this->response(array('reqToken' => $reqToken));exit();

        //CEK PEGAWAI ID DARI TOKEN
        $user_login_log = new UserLoginLog();
        $reqPegawaiId = $user_login_log->getTokenPegawaiId(array("TOKEN" => $reqToken, "STATUS" => '1'));
        // echo $user_login_log->query;exit();
        // echo $reqPegawaiId;exit();
        // $reqPegawaiId = '9014140KP';

        if($reqPegawaiId == "")
        {
            $this->response(array('status' => 'fail', 'message' => 'Anda tidak berhak untuk mendapatkan info personal pegawai.', 'code' => 502));
        }
        else
        {
            $reqId = $this->input->post('reqId');
            $reqJenis = $this->input->post('reqJenis');
            $reqTanggal = $this->input->post('reqTanggal');
            $reqPeriode= getMonth($reqTanggal).getDay($reqTanggal);
            $reqKeperluan = "";//$this->input->post('reqKeperluan');
            $reqKeterangan = $this->input->post('reqKeterangan');
            $reqTanggalAwal = $this->input->post('reqTanggalAwal');
            $reqTanggalAkhir = $this->input->post('reqTanggalAkhir');
            $reqLokasi = $this->input->post('reqLokasi');
            $namaLinkFile = $this->input->post('namaLinkFile');
            $reqMode = $this->input->post("reqMode");
            $reqLastCreateUser = $this->input->post("reqLastCreateUser");

            // $this->response(array('status' => 'success', 'namaLinkFile' => $namaLinkFile, 'reqPeriode' => $reqPeriode));exit();

            // buat parstisi
            $this->setpartisi($reqPeriode);

            // set waktu
            /*$namahari= mktime(0, 0, 0, getMonth($reqTanggalAwal), getYear($reqTanggalAwal), getDay($reqTanggalAwal));
            $namahari= strtoupper(date("l", $namahari));

            $statementjam= " AND A.JAM_KERJA_JENIS_ID = 1 AND A.STATUS = '1'";

            if($namahari == "FRIDAY")
                $statementjam.= " AND A.JAM_KERJA_ID IN (99)";
            else
                $statementjam.= " AND A.JAM_KERJA_ID NOT IN (99)";

            $jamkerja= new Absensi();
            $jamkerja->selectByParamsJamKerja(array(), -1,-1, $statementjam);
            $jamkerja->firstRow();
            $jamawal= $jamkerja->getField("TERLAMBAT_AWAL");

            // ====================================================================================================
            $namahari= mktime(0, 0, 0, getMonth($reqTanggalAkhir), getYear($reqTanggalAkhir), getDay($reqTanggalAkhir));
            $namahari= strtoupper(date("l", $namahari));

            $statementjam= " AND A.JAM_KERJA_JENIS_ID = 1 AND A.STATUS = '1'";

            if($namahari == "FRIDAY")
                $statementjam.= " AND A.JAM_KERJA_ID IN (99)";
            else
                $statementjam.= " AND A.JAM_KERJA_ID NOT IN (99)";

            $jamkerja= new Absensi();
            $jamkerja->selectByParamsJamKerja(array(), -1,-1, $statementjam);
            $jamkerja->firstRow();
            $jamakhir= $jamkerja->getField("TERLAMBAT_AKHIR");*/
            // echo $jamkerja->query;exit;
            // echo $jamawal."--".$jamakhir;exit();
            // set waktu

            if($reqMode == "insert")
            {
                $set = new Absensi();
                $set->setField("PERMOHONAN_LAMBAT_PC_ID", $reqId);
                $set->setField("PEGAWAI_ID", $reqPegawaiId);
                $set->setField("TAHUN", date('Y'));
                $set->setField("TANGGAL", dateToDBCheck($reqTanggal));
                $set->setField("TANGGAL_IJIN", dateToDBCheck($reqTanggalIjin));
                $set->setField("TANGGAL_AWAL", dateToDBCheck($reqTanggalAwal));
                $set->setField("TANGGAL_AKHIR", dateToDBCheck($reqTanggalAkhir));
                $set->setField("JAM_DATANG", $jamawal);
                $set->setField("JAM_PULANG", $jamakhir);
                $set->setField("LOKASI", $reqLokasi);
                $set->setField("LAMPIRAN", $namaLinkFile);
                if($reqJenis == "SPPD")
                {}
                else
                {
                    $set->setField("KEPERLUAN", $reqKeperluan);
                }
                $set->setField("KETERANGAN", $reqKeterangan);
                
                $set->setField("LAST_CREATE_DATE", "CURRENT_DATE");
                $set->setField("LAST_CREATE_USER", $reqLastCreateUser);

                if($set->insertPermohonanDinas())
                {
                    $reqId= $set->id;
                }

            }

            if(!empty($reqId))
            {
                $this->response(array('status' => 'success', 'id' => $reqId));
            }
            else
            {
                $this->response(array('status' => 'fail', 'code' => 502));
            }

        }
    }
 
    // update data entitas
    function index_put() {
    }
 
    // delete entitas
    function index_delete() {
    }
 
}