<? 
/* *******************************************************************************************************
MODUL NAME 			: E LEARNING
FILE NAME 			: 
AUTHOR				: 
VERSION				: 1.0
MODIFICATION DOC	:
DESCRIPTION			: 
***************************************************************************************************** */

  /***
  * Entity-base class untuk mengimplementasikan tabel KontakPegawai.
  * 
  ***/
  include_once(APPPATH.'/models/Entity.php');
  
  class Pegawai extends Entity{ 

	var $query;
    /**
    * Class constructor.
    **/
    function Pegawai()
	{
      $this->Entity(); 
    }

        function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PEGAWAI")); 

     	$str = "
			INSERT INTO validasi.PEGAWAI (
				PEGAWAI_ID, SATUAN_KERJA_ID, NIP_LAMA, NIP_BARU, NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				JENIS_KELAMIN, KEDUDUKAN, SUKU_BANGSA, GOLONGAN_DARAH, ALAMAT, RT, RW,TELEPON, HP, 
				TELEPON_KANTOR, FACEBOOK, TWITTER, WHATSAPP, TELEGRAM, KARTU_PEGAWAI, NPWP, NIK, NO_REKENING, 
				SK_KONVERSI_NIP, NO_URUT, NO_KK, NO_RAK_BERKAS, 
				BANK_ID, AGAMA_ID, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, DESA_ID, KETERANGAN_1, KETERANGAN_2
				, JENIS_PEGAWAI_ID, BPJS, BPJS_TANGGAL, NPWP_TANGGAL, ALAMAT_KETERANGAN
				, EMAIL_KANTOR, REKENING_NAMA, GAJI_POKOK, TUNJANGAN, TUNJANGAN_KELUARGA
				, GAJI_BERSIH, STATUS_MUTASI, TMT_MUTASI
				, LAST_USER, LAST_DATE, LAST_LEVEL, USER_LOGIN_ID, USER_LOGIN_PEGAWAI_ID,STATUS_PEGAWAI_ID,PEGAWAI_STATUS_ID
				, TEMP_VALIDASI_ID

				) 

			VALUES (
				 ".$this->getField("PEGAWAI_ID").",
				 ".$this->getField("SATUAN_KERJA_ID").",
				 '".$this->getField("NIP_LAMA")."',
				 '".$this->getField("NIP_BARU")."',
				 '".$this->getField("NAMA")."',
				 '".$this->getField("TEMPAT_LAHIR")."',
				 ".$this->getField("TANGGAL_LAHIR").",
				 '".$this->getField("JENIS_KELAMIN")."',
				 '".$this->getField("KEDUDUKAN")."',
				 '".$this->getField("SUKU_BANGSA")."',
				 '".$this->getField("GOLONGAN_DARAH")."',
				 '".$this->getField("ALAMAT")."',
				 '".$this->getField("RT")."',
				 '".$this->getField("RW")."',
				
				 '".$this->getField("TELEPON")."',
				 '".$this->getField("HP")."',
				 '".$this->getField("TELEPON_KANTOR")."',
				 '".$this->getField("FACEBOOK")."',
				 '".$this->getField("TWITTER")."',
				 '".$this->getField("WHATSAPP")."',
				 '".$this->getField("TELEGRAM")."',
				 '".$this->getField("KARTU_PEGAWAI")."',
			    
			     '".$this->getField("NPWP")."',
			     '".$this->getField("NIK")."',
			     '".$this->getField("NO_REKENING")."',
			     '".$this->getField("SK_KONVERSI_NIP")."',
			     '".$this->getField("NO_URUT")."',
			     '".$this->getField("NO_KK")."',
			     '".$this->getField("NO_RAK_BERKAS")."',
				 ".$this->getField("BANK_ID").",
				 ".$this->getField("AGAMA_ID").",
				 ".$this->getField("PROPINSI_ID").",
				 ".$this->getField("KABUPATEN_ID").",
				 ".$this->getField("KECAMATAN_ID").",
				 ".$this->getField("DESA_ID").",
				 '".$this->getField("KETERANGAN_1")."',
				 '".$this->getField("KETERANGAN_2")."',
				 ".$this->getField("JENIS_PEGAWAI_ID").",
				 '".$this->getField("BPJS")."',
				 ".$this->getField("BPJS_TANGGAL").",
				 ".$this->getField("NPWP_TANGGAL").",
				 '".$this->getField("ALAMAT_KETERANGAN")."',
				 '".$this->getField("EMAIL_KANTOR")."',
				 '".$this->getField("REKENING_NAMA")."',
				 ".$this->getField("GAJI_POKOK").",
				 ".$this->getField("TUNJANGAN").",
				 ".$this->getField("TUNJANGAN_KELUARGA").",
				 ".$this->getField("GAJI_BERSIH").",
				 ".$this->getField("STATUS_MUTASI").",
				 ".$this->getField("TMT_MUTASI").",
			
				 '".$this->getField("LAST_USER")."',
				 ".$this->getField("LAST_DATE").",
				 ".$this->getField("LAST_LEVEL").",
				 ".$this->getField("USER_LOGIN_ID").",
				 ".$this->getField("USER_LOGIN_PEGAWAI_ID").",
				 ".$this->getField("STATUS_PEGAWAI_ID").",
				 ".$this->getField("PEGAWAI_STATUS_ID").",
				 ".$this->getField("TEMP_VALIDASI_ID")."
			)
		"; 	
		$this->id = $this->getField("TEMP_VALIDASI_ID");
		$this->query = $str;
		// echo $str;
		return $this->execQuery($str);
    }
    function insert_bak()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PEGAWAI")); 

     	$str = "
			INSERT INTO validasi.PEGAWAI (
				PEGAWAI_ID, SATUAN_KERJA_ID, NIP_LAMA, NIP_BARU, NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				JENIS_KELAMIN, KEDUDUKAN, SUKU_BANGSA, GOLONGAN_DARAH, ALAMAT, RT, RW, KODEPOS, TELEPON, HP, 
				TELEPON_KANTOR, FACEBOOK, TWITTER, WHATSAPP, TELEGRAM, KARTU_PEGAWAI, ASKES, TASPEN, NPWP, NIK, NO_REKENING, 
				SK_KONVERSI_NIP, NO_URUT, NO_KK, NO_RAK_BERKAS, 
				BANK_ID, AGAMA_ID, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, DESA_ID, KETERANGAN_1, KETERANGAN_2
				, JENIS_PEGAWAI_ID, BPJS, BPJS_TANGGAL, NPWP_TANGGAL, ALAMAT_KETERANGAN
				, EMAIL_KANTOR, REKENING_NAMA, GAJI_POKOK, TUNJANGAN, TUNJANGAN_KELUARGA
				, GAJI_BERSIH, STATUS_MUTASI, TMT_MUTASI, INSTANSI_SEBELUM
				, LAST_USER, LAST_DATE, LAST_LEVEL, USER_LOGIN_ID, USER_LOGIN_PEGAWAI_ID,STATUS_PEGAWAI_ID,PEGAWAI_STATUS_ID
				, TEMP_VALIDASI_ID

				) 

			VALUES (
				 ".$this->getField("PEGAWAI_ID").",
				 ".$this->getField("SATUAN_KERJA_ID").",
				 '".$this->getField("NIP_LAMA")."',
				 '".$this->getField("NIP_BARU")."',
				 '".$this->getField("NAMA")."',
				 '".$this->getField("TEMPAT_LAHIR")."',
				 ".$this->getField("TANGGAL_LAHIR").",
				 '".$this->getField("JENIS_KELAMIN")."',
				 '".$this->getField("KEDUDUKAN")."',
				 '".$this->getField("SUKU_BANGSA")."',
				 '".$this->getField("GOLONGAN_DARAH")."',
				 '".$this->getField("ALAMAT")."',
				 '".$this->getField("RT")."',
				 '".$this->getField("RW")."',
				 '".$this->getField("KODEPOS")."',
				 '".$this->getField("TELEPON")."',
				 '".$this->getField("HP")."',
				 '".$this->getField("TELEPON_KANTOR")."',
				 '".$this->getField("FACEBOOK")."',
				 '".$this->getField("TWITTER")."',
				 '".$this->getField("WHATSAPP")."',
				 '".$this->getField("TELEGRAM")."',
				 '".$this->getField("KARTU_PEGAWAI")."',
			     '".$this->getField("ASKES")."',
			     '".$this->getField("TASPEN")."',
			     '".$this->getField("NPWP")."',
			     '".$this->getField("NIK")."',
			     '".$this->getField("NO_REKENING")."',
			     '".$this->getField("SK_KONVERSI_NIP")."',
			     '".$this->getField("NO_URUT")."',
			     '".$this->getField("NO_KK")."',
			     '".$this->getField("NO_RAK_BERKAS")."',
				 ".$this->getField("BANK_ID").",
				 ".$this->getField("AGAMA_ID").",
				 ".$this->getField("PROPINSI_ID").",
				 ".$this->getField("KABUPATEN_ID").",
				 ".$this->getField("KECAMATAN_ID").",
				 ".$this->getField("DESA_ID").",
				 '".$this->getField("KETERANGAN_1")."',
				 '".$this->getField("KETERANGAN_2")."',
				 ".$this->getField("JENIS_PEGAWAI_ID").",
				 '".$this->getField("BPJS")."',
				 ".$this->getField("BPJS_TANGGAL").",
				 ".$this->getField("NPWP_TANGGAL").",
				 '".$this->getField("ALAMAT_KETERANGAN")."',
				 '".$this->getField("EMAIL_KANTOR")."',
				 '".$this->getField("REKENING_NAMA")."',
				 ".$this->getField("GAJI_POKOK").",
				 ".$this->getField("TUNJANGAN").",
				 ".$this->getField("TUNJANGAN_KELUARGA").",
				 ".$this->getField("GAJI_BERSIH").",
				 ".$this->getField("STATUS_MUTASI").",
				 ".$this->getField("TMT_MUTASI").",
				 '".$this->getField("INSTANSI_SEBELUM")."',
				 '".$this->getField("LAST_USER")."',
				 ".$this->getField("LAST_DATE").",
				 ".$this->getField("LAST_LEVEL").",
				 ".$this->getField("USER_LOGIN_ID").",
				 ".$this->getField("USER_LOGIN_PEGAWAI_ID").",
				 ".$this->getField("STATUS_PEGAWAI_ID").",
				 ".$this->getField("PEGAWAI_STATUS_ID").",
				 ".$this->getField("TEMP_VALIDASI_ID")."
			)
		"; 	
		$this->id = $this->getField("TEMP_VALIDASI_ID");
		$this->query = $str;
		// echo $str;
		return $this->execQuery($str);
    }

     function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "		
				UPDATE validasi.PEGAWAI
				SET    
				 	NIP_LAMA= '".$this->getField("NIP_LAMA")."',
				 	NIP_BARU= '".$this->getField("NIP_BARU")."',
				 	SATUAN_KERJA_ID= ".$this->getField("SATUAN_KERJA_ID").",
				 	NAMA= '".$this->getField("NAMA")."',
				 	TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
				 	TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
				 	JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
				 	KEDUDUKAN= '".$this->getField("KEDUDUKAN")."',
				 	SUKU_BANGSA= '".$this->getField("SUKU_BANGSA")."',
				 	GOLONGAN_DARAH= '".$this->getField("GOLONGAN_DARAH")."',
				 	ALAMAT= '".$this->getField("ALAMAT")."',
				 	RT= '".$this->getField("RT")."',
				 	RW= '".$this->getField("RW")."',
				 	TELEPON= '".$this->getField("TELEPON")."',
				 	HP= '".$this->getField("HP")."',
				 	TELEPON_KANTOR= '".$this->getField("TELEPON_KANTOR")."',
				 	FACEBOOK= '".$this->getField("FACEBOOK")."',
				 	TWITTER= '".$this->getField("TWITTER")."',
				 	WHATSAPP= '".$this->getField("WHATSAPP")."',
				 	TELEGRAM= '".$this->getField("TELEGRAM")."',
					KARTU_PEGAWAI= '".$this->getField("KARTU_PEGAWAI")."',
				 	NPWP= '".$this->getField("NPWP")."',
				 	NIK= '".$this->getField("NIK")."',
				 	NO_REKENING= '".$this->getField("NO_REKENING")."',
				 	SK_KONVERSI_NIP= '".$this->getField("SK_KONVERSI_NIP")."',
				 	NO_URUT= '".$this->getField("NO_URUT")."',
				 	NO_KK= '".$this->getField("NO_KK")."',
				 	NO_RAK_BERKAS= '".$this->getField("NO_RAK_BERKAS")."',
				 	BANK_ID= ".$this->getField("BANK_ID").",
				 	AGAMA_ID= ".$this->getField("AGAMA_ID").",
				 	PROPINSI_ID= ".$this->getField("PROPINSI_ID").",
				 	KABUPATEN_ID= ".$this->getField("KABUPATEN_ID").",
				 	KECAMATAN_ID= ".$this->getField("KECAMATAN_ID").",
				 	DESA_ID= ".$this->getField("DESA_ID").",
				 	KETERANGAN_1= '".$this->getField("KETERANGAN_1")."',
				 	KETERANGAN_2= '".$this->getField("KETERANGAN_2")."',
				 	JENIS_PEGAWAI_ID= ".$this->getField("JENIS_PEGAWAI_ID").",
				 	BPJS= '".$this->getField("BPJS")."',
				 	BPJS_TANGGAL= ".$this->getField("BPJS_TANGGAL").",
				 	NPWP_TANGGAL= ".$this->getField("NPWP_TANGGAL").",
				 	ALAMAT_KETERANGAN= '".$this->getField("ALAMAT_KETERANGAN")."',
				 	EMAIL= '".$this->getField("EMAIL")."',
				 	EMAIL_KANTOR= '".$this->getField("EMAIL_KANTOR")."',
				 	REKENING_NAMA= '".$this->getField("REKENING_NAMA")."',
				 	GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
				 	TUNJANGAN= ".$this->getField("TUNJANGAN").",
				 	TUNJANGAN_KELUARGA= ".$this->getField("TUNJANGAN_KELUARGA").",
				 	GAJI_BERSIH= ".$this->getField("GAJI_BERSIH").",
				 	STATUS_MUTASI= ".$this->getField("STATUS_MUTASI").",
				 	TMT_MUTASI= ".$this->getField("TMT_MUTASI").",
				
				 	LAST_USER= '".$this->getField("LAST_USER")."',
				 	LAST_DATE= ".$this->getField("LAST_DATE").",
				 	USER_LOGIN_ID= ".$this->getField("USER_LOGIN_ID").",
				 	USER_LOGIN_PEGAWAI_ID= ".$this->getField("USER_LOGIN_PEGAWAI_ID").",
				    LAST_LEVEL= ".$this->getField("LAST_LEVEL")."
				WHERE  TEMP_VALIDASI_ID = ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }


    function update_bak()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "		
				UPDATE validasi.PEGAWAI
				SET    
				 	NIP_LAMA= '".$this->getField("NIP_LAMA")."',
				 	NIP_BARU= '".$this->getField("NIP_BARU")."',
				 	SATUAN_KERJA_ID= ".$this->getField("SATUAN_KERJA_ID").",
				 	NAMA= '".$this->getField("NAMA")."',
				 	TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
				 	TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
				 	JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
				 	KEDUDUKAN= '".$this->getField("KEDUDUKAN")."',
				 	SUKU_BANGSA= '".$this->getField("SUKU_BANGSA")."',
				 	GOLONGAN_DARAH= '".$this->getField("GOLONGAN_DARAH")."',
				 	ALAMAT= '".$this->getField("ALAMAT")."',
				 	RT= '".$this->getField("RT")."',
				 	RW= '".$this->getField("RW")."',
				 	KODEPOS= '".$this->getField("KODEPOS")."',
				 	TELEPON= '".$this->getField("TELEPON")."',
				 	HP= '".$this->getField("HP")."',
				 	TELEPON_KANTOR= '".$this->getField("TELEPON_KANTOR")."',
				 	FACEBOOK= '".$this->getField("FACEBOOK")."',
				 	TWITTER= '".$this->getField("TWITTER")."',
				 	WHATSAPP= '".$this->getField("WHATSAPP")."',
				 	TELEGRAM= '".$this->getField("TELEGRAM")."',
					KARTU_PEGAWAI= '".$this->getField("KARTU_PEGAWAI")."',
				 	ASKES= '".$this->getField("ASKES")."',
				 	TASPEN= '".$this->getField("TASPEN")."',
				 	NPWP= '".$this->getField("NPWP")."',
				 	NIK= '".$this->getField("NIK")."',
				 	NO_REKENING= '".$this->getField("NO_REKENING")."',
				 	SK_KONVERSI_NIP= '".$this->getField("SK_KONVERSI_NIP")."',
				 	NO_URUT= '".$this->getField("NO_URUT")."',
				 	NO_KK= '".$this->getField("NO_KK")."',
				 	NO_RAK_BERKAS= '".$this->getField("NO_RAK_BERKAS")."',
				 	BANK_ID= ".$this->getField("BANK_ID").",
				 	AGAMA_ID= ".$this->getField("AGAMA_ID").",
				 	PROPINSI_ID= ".$this->getField("PROPINSI_ID").",
				 	KABUPATEN_ID= ".$this->getField("KABUPATEN_ID").",
				 	KECAMATAN_ID= ".$this->getField("KECAMATAN_ID").",
				 	DESA_ID= ".$this->getField("DESA_ID").",
				 	KETERANGAN_1= '".$this->getField("KETERANGAN_1")."',
				 	KETERANGAN_2= '".$this->getField("KETERANGAN_2")."',
				 	JENIS_PEGAWAI_ID= ".$this->getField("JENIS_PEGAWAI_ID").",
				 	BPJS= '".$this->getField("BPJS")."',
				 	BPJS_TANGGAL= ".$this->getField("BPJS_TANGGAL").",
				 	NPWP_TANGGAL= ".$this->getField("NPWP_TANGGAL").",
				 	ALAMAT_KETERANGAN= '".$this->getField("ALAMAT_KETERANGAN")."',
				 	EMAIL= '".$this->getField("EMAIL")."',
				 	EMAIL_KANTOR= '".$this->getField("EMAIL_KANTOR")."',
				 	REKENING_NAMA= '".$this->getField("REKENING_NAMA")."',
				 	GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
				 	TUNJANGAN= ".$this->getField("TUNJANGAN").",
				 	TUNJANGAN_KELUARGA= ".$this->getField("TUNJANGAN_KELUARGA").",
				 	GAJI_BERSIH= ".$this->getField("GAJI_BERSIH").",
				 	STATUS_MUTASI= ".$this->getField("STATUS_MUTASI").",
				 	TMT_MUTASI= ".$this->getField("TMT_MUTASI").",
				 	INSTANSI_SEBELUM= '".$this->getField("INSTANSI_SEBELUM")."',
				 	LAST_USER= '".$this->getField("LAST_USER")."',
				 	LAST_DATE= ".$this->getField("LAST_DATE").",
				 	USER_LOGIN_ID= ".$this->getField("USER_LOGIN_ID").",
				 	USER_LOGIN_PEGAWAI_ID= ".$this->getField("USER_LOGIN_PEGAWAI_ID").",
				    LAST_LEVEL= ".$this->getField("LAST_LEVEL")."
				WHERE  TEMP_VALIDASI_ID = ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }
	
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $order='ORDER BY A.PEGAWAI_ID ASC')
	{
		$str = "
			SELECT
			A.PEGAWAI_ID, A.PEGAWAI_ID_SAPK, A.STATUS, A.SATUAN_KERJA_ID, A.JABATAN_RIWAYAT_ID, A.PENDIDIKAN_RIWAYAT_ID, 
			A.GAJI_RIWAYAT_ID, A.PANGKAT_RIWAYAT_ID, A.JENIS_PEGAWAI_ID, A.KEDUDUKAN, A.TIPE_PEGAWAI_ID, A.PEGAWAI_STATUS_ID, PS.PEGAWAI_STATUS_NAMA,
			PS.PEGAWAI_KEDUDUKAN_TMT, PS.PEGAWAI_KEDUDUKAN_NAMA,
			A.STATUS_PEGAWAI_ID, A.NIP_LAMA, A.NIP_BARU, A.NAMA, A.GELAR_DEPAN, A.GELAR_BELAKANG, A.TEMPAT_LAHIR, A.TANGGAL_LAHIR, 
			A.JENIS_KELAMIN, A.STATUS_KAWIN, A.SUKU_BANGSA, A.GOLONGAN_DARAH, A.EMAIL, A.ALAMAT, A.RT, A.RW, A.KODEPOS, A.TELEPON, A.HP, 
			A.TELEPON_KANTOR, A.FACEBOOK, A.TWITTER, A.WHATSAPP, A.TELEGRAM, A.KARTU_PEGAWAI, A.ASKES, A.TASPEN, A.NPWP, A.NIK, A.NO_REKENING, 
			A.SK_KONVERSI_NIP, A.NO_URUT, A.NO_KK, A.NO_RAK_BERKAS, 
			A.BANK_ID, A.AGAMA_ID
			, A.KETERANGAN_1, A.KETERANGAN_2, A.LAST_USER, A.LAST_DATE, A.JENIS_PENGADAAN_ID
			, AMBIL_SATKER_NAMA_DYNAMIC(A.SATUAN_KERJA_ID) SATUAN_KERJA_NAMA_DETIL
			, (CASE WHEN COALESCE(NULLIF(A.GELAR_DEPAN,'') , NULL ) IS NULL THEN '' ELSE A.GELAR_DEPAN || ' ' END) || A.NAMA || (CASE WHEN COALESCE(NULLIF(A.GELAR_BELAKANG,'') , NULL ) IS NULL THEN '' ELSE '' || A.GELAR_BELAKANG END) NAMA_LENGKAP
			, A.PROPINSI_ID, P1.PROPINSI_NAMA, A.KABUPATEN_ID, P1.KABUPATEN_NAMA, A.KECAMATAN_ID, P1.KECAMATAN_NAMA, A.DESA_ID, P1.DESA_NAMA
			FROM PEGAWAI A
			LEFT JOIN
			(
				SELECT A.PEGAWAI_STATUS_ID, A.PEGAWAI_ID, A.STATUS_PEGAWAI_ID, B.NAMA PEGAWAI_STATUS_NAMA
				, A.TMT PEGAWAI_KEDUDUKAN_TMT, C.NAMA PEGAWAI_KEDUDUKAN_NAMA
				FROM PEGAWAI_STATUS A
				INNER JOIN STATUS_PEGAWAI B ON A.STATUS_PEGAWAI_ID = B.STATUS_PEGAWAI_ID
				INNER JOIN STATUS_PEGAWAI_KEDUDUKAN C ON A.STATUS_PEGAWAI_KEDUDUKAN_ID = C.STATUS_PEGAWAI_KEDUDUKAN_ID
			) PS ON A.PEGAWAI_STATUS_ID = PS.PEGAWAI_STATUS_ID
			LEFT JOIN (
				SELECT A.PEGAWAI_ID
				, A.PROPINSI_ID, PROP.NAMA PROPINSI_NAMA, A.KABUPATEN_ID, KAB.NAMA KABUPATEN_NAMA, A.KECAMATAN_ID, KEC.NAMA KECAMATAN_NAMA, A.DESA_ID, KEL.NAMA DESA_NAMA
				FROM PEGAWAI A
				LEFT JOIN (SELECT PROPINSI_ID, NAMA FROM PROPINSI) PROP ON PROP.PROPINSI_ID = A.PROPINSI_ID
				LEFT JOIN (SELECT PROPINSI_ID, KABUPATEN_ID, NAMA FROM KABUPATEN) KAB ON KAB.PROPINSI_ID = A.PROPINSI_ID AND KAB.KABUPATEN_ID = A.KABUPATEN_ID
				LEFT JOIN (SELECT PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, NAMA FROM KECAMATAN) KEC ON KEC.PROPINSI_ID = A.PROPINSI_ID AND KEC.KABUPATEN_ID = A.KABUPATEN_ID AND KEC.KECAMATAN_ID = A.KECAMATAN_ID
				LEFT JOIN (SELECT PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID, NAMA FROM KELURAHAN) KEL ON KEL.PROPINSI_ID = A.PROPINSI_ID AND KEL.KABUPATEN_ID = A.KABUPATEN_ID AND KEL.KECAMATAN_ID = A.KECAMATAN_ID AND KEL.KELURAHAN_ID = A.DESA_ID
				WHERE 1 = 1
			) P1 ON P1.PEGAWAI_ID = A.PEGAWAI_ID
			WHERE 1 = 1
		"; 

		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
			
		$str .= $statement."  ".$order;
		$this->query = $str;

		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
		
    }
	 
    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "SELECT COUNT(A.BAHASA_ID) AS ROWCOUNT 
				FROM BAHASA A
				WHERE 1 = 1 ".$statement; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }

    function selectByParamsInfoTpp($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY JAB_RIW.ESELON_ID ASC, PANG_RIW.PANGKAT_ID DESC, PANG_RIW.TMT_PANGKAT ASC')
	{
		$now= date("Y-m-d");
		$str = "
		SELECT
		A.PEGAWAI_ID, A.NIP_BARU, A.NAMA, A.GELAR_DEPAN, A.GELAR_BELAKANG
		, PANG_RIW.KODE PANGKAT_RIWAYAT_KODE
		, JAB_RIW.JENIS_JABATAN_NAMA JABATAN_RIWAYAT_JENIS_JABATAN_NAMA, JAB_RIW.JABATAN_NAMA JABATAN_RIWAYAT_JABATAN_NAMA
		, JAB_RIW.TMT_JABATAN JABATAN_RIWAYAT_TMT_JABATAN
		, A.SATUAN_KERJA_ID, AMBIL_SATKER_NAMA(A.SATUAN_KERJA_ID) SATUAN_KERJA_NAMA
		, AMBIL_SATKER_ID_INDUK(A.SATUAN_KERJA_ID) SATUAN_KERJA_INDUK_ID
		, AMBIL_SATKER_INDUK(A.SATUAN_KERJA_ID) SATUAN_KERJA_INDUK
		, PS.PEGAWAI_STATUS_NAMA STATUS_PEGAWAI, PS.PEGAWAI_KEDUDUKAN_NAMA
		, (CASE WHEN COALESCE(NULLIF(A.GELAR_DEPAN,'') , NULL ) IS NULL THEN '' ELSE A.GELAR_DEPAN || ' ' END) || A.NAMA || (CASE WHEN COALESCE(NULLIF(A.GELAR_BELAKANG,'') , NULL ) IS NULL THEN '' ELSE '' || A.GELAR_BELAKANG END) NAMA_LENGKAP
		FROM PEGAWAI A
		LEFT JOIN
		(
			SELECT
			A.PEGAWAI_ID, A.PANGKAT_RIWAYAT_ID, B.KODE, A.TMT_PANGKAT, A.PANGKAT_ID
			FROM PANGKAT_RIWAYAT A
			INNER JOIN(SELECT * FROM SAIKI_PANGKAT('".$now."')) YYY ON A.PEGAWAI_ID = YYY.PG_ID AND A.TMT_PANGKAT = YYY.TMT
			LEFT JOIN PANGKAT B ON A.PANGKAT_ID = B.PANGKAT_ID
			WHERE 1=1 AND (COALESCE(NULLIF(A.STATUS, ''), NULL) IS NULL OR A.STATUS = '2')
		) PANG_RIW ON A.PEGAWAI_ID = PANG_RIW.PEGAWAI_ID
		LEFT JOIN
		(
			SELECT
			A.PEGAWAI_ID, A.JABATAN_RIWAYAT_ID, COALESCE(A.ESELON_ID,99) ESELON_ID, B.NAMA ESELON_NAMA, A.TMT_JABATAN, A.NAMA JABATAN_NAMA
			, A.JENIS_JABATAN_ID
			, CASE A.JENIS_JABATAN_ID WHEN '1' THEN 'Struktural' WHEN '2' THEN 'JFU' WHEN '3' THEN 'JFT' END JENIS_JABATAN_NAMA
			FROM JABATAN_RIWAYAT A
			INNER JOIN(SELECT * FROM SAIKI_JABATAN('".$now."')) YYY ON A.PEGAWAI_ID = YYY.PG_ID AND A.TMT_JABATAN = YYY.TMT
			LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
			WHERE 1=1 AND (COALESCE(NULLIF(A.STATUS, ''), NULL) IS NULL OR A.STATUS = '2')
		) JAB_RIW ON A.PEGAWAI_ID = JAB_RIW.PEGAWAI_ID
		LEFT JOIN
		(
			SELECT A.PEGAWAI_STATUS_ID, A.PEGAWAI_ID, A.STATUS_PEGAWAI_ID, B.NAMA PEGAWAI_STATUS_NAMA
			, A.TMT PEGAWAI_KEDUDUKAN_TMT, C.NAMA PEGAWAI_KEDUDUKAN_NAMA
			FROM PEGAWAI_STATUS A
			INNER JOIN STATUS_PEGAWAI B ON A.STATUS_PEGAWAI_ID = B.STATUS_PEGAWAI_ID
			INNER JOIN STATUS_PEGAWAI_KEDUDUKAN C ON A.STATUS_PEGAWAI_KEDUDUKAN_ID = C.STATUS_PEGAWAI_KEDUDUKAN_ID
		) PS ON A.PEGAWAI_STATUS_ID = PS.PEGAWAI_STATUS_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsInfoEoffice($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY JABATAN_RIWAYAT.ESELON_ID ASC, PANGKAT_RIWAYAT.PANGKAT_ID DESC, PANGKAT_RIWAYAT.TMT_PANGKAT ASC')
	{
		$now= date("Y-m-d");
		$str = "
		SELECT
			pegawai.pegawai_id,
			pegawai.nip_baru AS nip,
			( CASE WHEN COALESCE ( NULLIF ( pegawai.gelar_depan, '' ), NULL ) IS NULL THEN '' ELSE pegawai.gelar_depan || ' ' END ) || pegawai.nama || ( CASE WHEN COALESCE ( NULLIF ( pegawai.gelar_belakang, '' ), NULL ) IS NULL THEN '' ELSE'' || pegawai.gelar_belakang END ) AS nama_lengkap,
			pegawai.tempat_lahir AS temlahir,
			TO_CHAR(pegawai.tanggal_lahir, 'dd-mm-yyyy') AS tgllahir,
			EXTRACT(YEAR FROM pendidikan_riwayat.tanggal_sttb) AS lulus,
			pendidikan_riwayat.jurusan,
			pendidikan_riwayat.nama AS lembaga
			, COALESCE(TO_CHAR(pangkat_riwayat.tmt_pangkat, 'dd-mm-yyyy'), TO_CHAR(PPPK_RIW.TMT_PPPK, 'dd-mm-yyyy')) tmtpang
			, TO_CHAR(sk_cpns.tmt_cpns, 'dd-mm-yyyy') AS tmtcpns
			, TO_CHAR(sk_pns.tmt_pns, 'dd-mm-yyyy') tmtpns
			, COALESCE(TO_CHAR(jabatan_riwayat.tmt_jabatan, 'dd-mm-yyyy'), TO_CHAR(PPPK_RIW.TMT_PPPK, 'dd-mm-yyyy')) tmtjab
			,
			( CASE WHEN COALESCE ( NULLIF ( pegawai.nip_baru, '' ), NULL ) IS NULL THEN '' ELSE'' END ) AS nss,
			ambil_satker_nama ( ambil_satker_id_induk(satuan_kerja.satuan_kerja_id) ) AS unit,
			( CASE WHEN COALESCE ( NULLIF ( pegawai.nip_baru, '' ), NULL ) IS NULL THEN '' ELSE'' END ) AS dudukpeg,
			EXTRACT ( YEAR FROM AGE( pegawai.tanggal_lahir ) ) AS usia,
			(pangkat_riwayat.masa_kerja_tahun || ' Tahun ' || pangkat_riwayat.masa_kerja_bulan || ' Bulan') AS masakerja,
			(CASE jabatan_riwayat.jenis_jabatan_id WHEN '1' THEN 'Struktural' WHEN '2' THEN 'Pelaksana' WHEN '3' THEN 'JFT' END ) AS jenis_jabatan,
			eselon.nama AS nama_eselon,
			agama.nama AS agama,
			pegawai.status_kawin AS kawin,
			( CASE WHEN COALESCE ( NULLIF ( pegawai.nip_baru, '' ), NULL ) IS NULL THEN '' ELSE'' END ) AS tingkat,
			pegawai.jenis_kelamin AS kelamin,
			pendidikan.nama AS pendidikan
			, COALESCE(pangkat.kode, PPPK_RIW.KODE) gol
			, ( CASE WHEN COALESCE ( NULLIF ( pegawai.nip_baru, '' ), NULL ) IS NULL THEN '' ELSE'' END ) AS nama_dukpeg
			, COALESCE(pangkat.nama, PPPK_RIW.NAMA) pangkat
			, COALESCE(jabatan_riwayat.nama, PPPK_RIW.JABATAN_TUGAS) nama_jabatan
			, status_pegawai.nama AS nama_statuspeg
			, ambil_satker_nama ( satuan_kerja.satuan_kerja_id ) AS unitkerja
			, CASE WHEN pegawai.TANGGAL_LAHIR IS NULL THEN NULL
			ELSE
				CASE WHEN TO_CHAR(pegawai.TANGGAL_LAHIR, 'MM') = '12' THEN
					CASE WHEN pegawai.SK_PPPK_ID IS NOT NULL THEN
						TO_DATE(CONCAT('01-01-', CAST(CAST(TO_CHAR(pegawai.TANGGAL_LAHIR, 'YYYY') AS NUMERIC) + 1 + COALESCE(PPPK_BUP, 0) AS TEXT)), 'DD-MM-YYYY')
					ELSE
						TO_DATE(CONCAT('01-01-', CAST(CAST(TO_CHAR(pegawai.TANGGAL_LAHIR, 'YYYY') AS NUMERIC) + 1 + COALESCE(jabatan_riwayat.USIA_BUP, 0) AS TEXT)), 'DD-MM-YYYY')
					END
				ELSE
					CASE WHEN pegawai.SK_PPPK_ID IS NOT NULL THEN
						TO_DATE(CONCAT('01-', CAST(TO_CHAR(pegawai.TANGGAL_LAHIR, 'MM') AS NUMERIC) + 1, '-', CAST(CAST(TO_CHAR(pegawai.TANGGAL_LAHIR, 'YYYY') AS NUMERIC) + COALESCE(PPPK_BUP, 0) AS TEXT)), 'DD-MM-YYYY')
					ELSE
						TO_DATE(CONCAT('01-', CAST(TO_CHAR(pegawai.TANGGAL_LAHIR, 'MM') AS NUMERIC) + 1, '-', CAST(CAST(TO_CHAR(pegawai.TANGGAL_LAHIR, 'YYYY') AS NUMERIC) + COALESCE(jabatan_riwayat.USIA_BUP, 0) AS TEXT)), 'DD-MM-YYYY')
					END
				END
			END TMT_PENSIUN
		FROM pegawai
		LEFT JOIN status_pegawai ON pegawai.status_pegawai_id = status_pegawai.status_pegawai_id
		LEFT JOIN agama ON pegawai.agama_id = agama.agama_id
		LEFT JOIN sk_cpns ON pegawai.pegawai_id = sk_cpns.pegawai_id
		LEFT JOIN sk_pns ON pegawai.pegawai_id = sk_pns.pegawai_id
		LEFT JOIN pangkat_riwayat ON pegawai.pangkat_riwayat_id = pangkat_riwayat.pangkat_riwayat_id
		LEFT JOIN pangkat ON pangkat.pangkat_id = pangkat_riwayat.pangkat_id
		LEFT JOIN
		(
			SELECT
			COALESCE(ED.USIA_BUP, JFU.USIA_BUP, JFT.USIA_BUP) USIA_BUP, B.NAMA ESELON_NAMA
			, A.*
			FROM JABATAN_RIWAYAT A
			LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
			LEFT JOIN ESELON_DETIL ED ON ED.ESELON_ID = A.ESELON_ID AND ED.TANGGAL_AWAL <= CURRENT_DATE AND COALESCE(ED.TANGGAL_AKHIR, CURRENT_DATE) >= CURRENT_DATE
			LEFT JOIN JABATAN_FU_DETIL JFU ON JFU.JABATAN_FU_ID = A.JABATAN_FU_ID AND JFU.TANGGAL_AWAL <= CURRENT_DATE AND COALESCE(JFU.TANGGAL_AKHIR, CURRENT_DATE) >= CURRENT_DATE
			LEFT JOIN JABATAN_FT_DETIL JFT ON JFT.JABATAN_FT_ID = A.JABATAN_FT_ID AND JFT.TANGGAL_AWAL <= CURRENT_DATE AND COALESCE(JFT.TANGGAL_AKHIR, CURRENT_DATE) >= CURRENT_DATE
		) jabatan_riwayat ON pegawai.jabatan_riwayat_id = jabatan_riwayat.jabatan_riwayat_id
		LEFT JOIN eselon ON jabatan_riwayat.eselon_id = eselon.eselon_id
		LEFT JOIN pendidikan_riwayat ON pegawai.pendidikan_riwayat_id = pendidikan_riwayat.pendidikan_riwayat_id
		LEFT JOIN pendidikan ON pendidikan_riwayat.pendidikan_id = pendidikan.pendidikan_id
		LEFT JOIN satuan_kerja ON pegawai.satuan_kerja_id = satuan_kerja.satuan_kerja_id
		LEFT JOIN
		(
			SELECT
			A.SK_PPPK_ID, B.KODE, B.NAMA, A.TMT_PPPK, A.GOLONGAN_PPPK_ID
			, A.JABATAN_TUGAS, PPPK_TIPE_PEGAWAI, BUP PPPK_BUP
			FROM SK_PPPK A
			LEFT JOIN GOLONGAN_PPPK B ON A.GOLONGAN_PPPK_ID = B.GOLONGAN_PPPK_ID
			LEFT JOIN
			(
				SELECT
				A.*
				, CASE JENIS_JABATAN_FT_PPPK_ID
				WHEN '1' THEN 'Pendidikan'
				WHEN '2' then 'Kesehatan'
				WHEN '3' then 'Lainnya'
				ELSE '' END PPPK_TIPE_PEGAWAI
				from JABATAN_FT_PPPK A
			) JJ ON A.JABATAN_FT_ID = JJ.JABATAN_FT_PPPK_ID
		) PPPK_RIW ON pegawai.SK_PPPK_ID = PPPK_RIW.SK_PPPK_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectparampensiun($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY A1.TMT DESC')
	{
		$now= date("Y-m-d");
		$str = "
		SELECT
		A.NIP_BARU
		, ( CASE WHEN COALESCE ( NULLIF ( A.GELAR_DEPAN, '' ), NULL ) IS NULL THEN '' ELSE A.GELAR_DEPAN || ' ' END ) || A.NAMA || ( CASE WHEN COALESCE ( NULLIF ( A.GELAR_BELAKANG, '' ), NULL ) IS NULL THEN '' ELSE'' || A.GELAR_BELAKANG END ) AS NAMA
		, A2.NAMA STATUS_PEGAWAI, A1.TMT
		FROM pegawai A
		LEFT JOIN pegawai_status A1 ON A.PEGAWAI_STATUS_ID = A1.PEGAWAI_STATUS_ID
		LEFT JOIN status_pegawai A2 ON A1.STATUS_PEGAWAI_ID = A2.STATUS_PEGAWAI_ID
		LEFT JOIN status_pegawai_kedudukan A3 ON A1.STATUS_PEGAWAI_KEDUDUKAN_ID = A3.STATUS_PEGAWAI_KEDUDUKAN_ID
		LEFT JOIN pensiun A4 ON A4.PEGAWAI_ID = A.PEGAWAI_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsSimple($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY A.ESELON_ID ASC, A.PANGKAT_ID DESC, A.TMT_PANGKAT ASC')
	{
		$str = "
		SELECT A.*
		FROM
		(
		SELECT 
			A.PEGAWAI_ID, A.NIP_LAMA, A.NIP_BARU
			, A.NAMA NAMA_LENGKAP
			, PANG_RIW.KODE PANGKAT_RIWAYAT_KODE, PANG_RIW.TMT_PANGKAT PANGKAT_RIWAYAT_TMT
			, JAB_RIW.JABATAN_NAMA JABATAN_RIWAYAT_NAMA, JAB_RIW.ESELON_NAMA JABATAN_RIWAYAT_ESELON, JAB_RIW.TMT_JABATAN JABATAN_RIWAYAT_TMT
			, JAB_RIW.ESELON_ID, PANG_RIW.PANGKAT_ID, PANG_RIW.TMT_PANGKAT, A.SATUAN_KERJA_ID
			, AMBIL_SATKER_NAMA(AMBIL_SATKER_ID_INDUK ( A.SATUAN_KERJA_ID )) AS OPD_INDUK
			, CASE
			WHEN CURRENT_DATE <= G.TANGGAL_AKHIR AND CURRENT_DATE >= G.TANGGAL_MULAI
			THEN 1
			WHEN G.PEGAWAI_ID IS NOT NULL THEN 2
			ELSE 0
			END STATUS_BERLAKU
		FROM PEGAWAI A
		LEFT JOIN
		(
			SELECT A.PANGKAT_RIWAYAT_ID, B.KODE, A.TMT_PANGKAT, A.PANGKAT_ID
			FROM PANGKAT_RIWAYAT A
			LEFT JOIN PANGKAT B ON A.PANGKAT_ID = B.PANGKAT_ID
		) PANG_RIW ON A.PANGKAT_RIWAYAT_ID = PANG_RIW.PANGKAT_RIWAYAT_ID
		LEFT JOIN
		(
			SELECT A.JABATAN_RIWAYAT_ID, COALESCE(A.ESELON_ID,99) ESELON_ID, B.NAMA ESELON_NAMA, A.TMT_JABATAN, A.NAMA JABATAN_NAMA
			FROM JABATAN_RIWAYAT A
			LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
		) JAB_RIW ON A.JABATAN_RIWAYAT_ID = JAB_RIW.JABATAN_RIWAYAT_ID
		LEFT JOIN SATUAN_KERJA SK ON SK.SATUAN_KERJA_ID = A.SATUAN_KERJA_ID
		LEFT JOIN (SELECT PEGAWAI_ID, TANGGAL_MULAI, TANGGAL_AKHIR FROM HUKUMAN_TERAKHIR X) G ON A.PEGAWAI_ID = G.PEGAWAI_ID
		WHERE 1 = 1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." 
		) A
		WHERE 1=1 ".$order;
		$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByPersonal($paramsArray=array(),$limit=-1,$from=-1, $pegawaiid, $id="", $rowid="", $statement='', $order='ORDER BY A.PEGAWAI_ID ASC')
	{

		$str = "
		SELECT
			A.PEGAWAI_ID, A.PEGAWAI_ID_SAPK, A.SATUAN_KERJA_ID, A.JABATAN_RIWAYAT_ID, A.PENDIDIKAN_RIWAYAT_ID, 
			A.GAJI_RIWAYAT_ID, A.PANGKAT_RIWAYAT_ID, A.JENIS_PEGAWAI_ID, A.KEDUDUKAN, A.TIPE_PEGAWAI_ID, A.PEGAWAI_STATUS_ID, PS.PEGAWAI_STATUS_NAMA,
			PS.PEGAWAI_KEDUDUKAN_TMT, PS.PEGAWAI_KEDUDUKAN_NAMA,
			A.STATUS_PEGAWAI_ID, A.NIP_LAMA, A.NIP_BARU, A.NAMA, A.GELAR_DEPAN, A.GELAR_BELAKANG, A.TEMPAT_LAHIR, A.TANGGAL_LAHIR, 
			A.JENIS_KELAMIN, A.STATUS_KAWIN, A.SUKU_BANGSA, A.GOLONGAN_DARAH, A.EMAIL, A.ALAMAT, A.RT, A.RW, A.KODEPOS, A.TELEPON, A.HP, 
			A.TELEPON_KANTOR, A.FACEBOOK, A.TWITTER, A.WHATSAPP, A.TELEGRAM, A.KARTU_PEGAWAI, A.ASKES, A.TASPEN, A.NPWP, A.NIK, A.NO_REKENING, 
			A.SK_KONVERSI_NIP, A.NO_URUT, A.NO_KK, A.NO_RAK_BERKAS, 
			A.BANK_ID, A.AGAMA_ID
			, A.KETERANGAN_1, A.KETERANGAN_2,   A.JENIS_PENGADAAN_ID
			, AMBIL_SATKER_NAMA_DYNAMIC(A.SATUAN_KERJA_ID) SATUAN_KERJA_NAMA_DETIL
			, (CASE WHEN COALESCE(NULLIF(A.GELAR_DEPAN,'') , NULL ) IS NULL THEN '' ELSE A.GELAR_DEPAN || ' ' END) || A.NAMA || (CASE WHEN COALESCE(NULLIF(A.GELAR_BELAKANG,'') , NULL ) IS NULL THEN '' ELSE '' || A.GELAR_BELAKANG END) NAMA_LENGKAP
			, A.PROPINSI_ID, P1.PROPINSI_NAMA, A.KABUPATEN_ID, P1.KABUPATEN_NAMA, A.KECAMATAN_ID, P1.KECAMATAN_NAMA, A.DESA_ID, P1.DESA_NAMA
			, JENIS_PEGAWAI_NAMA, A.BPJS, A.BPJS_TANGGAL, A.NPWP_TANGGAL, A.ALAMAT_KETERANGAN
			, A.EMAIL_KANTOR, A.REKENING_NAMA, A.GAJI_POKOK, A.TUNJANGAN, A.TUNJANGAN_KELUARGA, A.GAJI_BERSIH
			, A.STATUS_MUTASI, A.TMT_MUTASI, A.INSTANSI_SEBELUM
			, TEMP_VALIDASI_ID, TEMP_VALIDASI_HAPUS_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA
			, TANGGAL_VALIDASI
			, PF.PATH
		FROM (select * from validasi.validasi_pegawai('".$pegawaiid."', '".$id."', '".$rowid."')) A
		LEFT JOIN
			(
				SELECT JENIS_PEGAWAI_ID JPID, ID_SAPK JPIDSAPK, NAMA JENIS_PEGAWAI_NAMA FROM JENIS_PEGAWAI
			) JP ON JENIS_PEGAWAI_ID = JPID
			LEFT JOIN
			(
				SELECT A.PEGAWAI_STATUS_ID, A.PEGAWAI_ID, A.STATUS_PEGAWAI_ID, B.NAMA PEGAWAI_STATUS_NAMA
				, A.TMT PEGAWAI_KEDUDUKAN_TMT, C.NAMA PEGAWAI_KEDUDUKAN_NAMA
				FROM PEGAWAI_STATUS A
				INNER JOIN STATUS_PEGAWAI B ON A.STATUS_PEGAWAI_ID = B.STATUS_PEGAWAI_ID
				INNER JOIN STATUS_PEGAWAI_KEDUDUKAN C ON A.STATUS_PEGAWAI_KEDUDUKAN_ID = C.STATUS_PEGAWAI_KEDUDUKAN_ID
			) PS ON A.PEGAWAI_STATUS_ID = PS.PEGAWAI_STATUS_ID
			LEFT JOIN (
				SELECT A.PEGAWAI_ID
				, A.PROPINSI_ID, PROP.NAMA PROPINSI_NAMA, A.KABUPATEN_ID, KAB.NAMA KABUPATEN_NAMA, A.KECAMATAN_ID, KEC.NAMA KECAMATAN_NAMA, A.DESA_ID, KEL.NAMA DESA_NAMA
				FROM PEGAWAI A
				LEFT JOIN (SELECT PROPINSI_ID, NAMA FROM PROPINSI) PROP ON PROP.PROPINSI_ID = A.PROPINSI_ID
				LEFT JOIN (SELECT PROPINSI_ID, KABUPATEN_ID, NAMA FROM KABUPATEN) KAB ON KAB.PROPINSI_ID = A.PROPINSI_ID AND KAB.KABUPATEN_ID = A.KABUPATEN_ID
				LEFT JOIN (SELECT PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, NAMA FROM KECAMATAN) KEC ON KEC.PROPINSI_ID = A.PROPINSI_ID AND KEC.KABUPATEN_ID = A.KABUPATEN_ID AND KEC.KECAMATAN_ID = A.KECAMATAN_ID
				LEFT JOIN (SELECT PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID, NAMA FROM KELURAHAN) KEL ON KEL.PROPINSI_ID = A.PROPINSI_ID AND KEL.KABUPATEN_ID = A.KABUPATEN_ID AND KEL.KECAMATAN_ID = A.KECAMATAN_ID AND KEL.KELURAHAN_ID = A.DESA_ID
				WHERE 1 = 1
			) P1 ON P1.PEGAWAI_ID = A.PEGAWAI_ID
			LEFT JOIN 
			(
				SELECT PEGAWAI_ID, PATH FROM PEGAWAI_FILE_DATA WHERE RIWAYAT_TABLE = 'PEGAWAI' AND RIWAYAT_ID = 1
			) PF ON PF.PEGAWAI_ID = A.PEGAWAI_ID
			WHERE 1 = 1
		"; 

		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
			
		$str .= $statement."  ".$order;
		$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
		
    }

    function selectPresensi($paramsArray=array(),$limit=-1,$from=-1, $statement='', $statementdetil='', $order='ORDER BY A.ESELON_ID ASC, A.PANGKAT_ID DESC, A.TMT_PANGKAT ASC, JAM')
	{
		$str = "
		SELECT
			A.*
			, PRS.TANGGAL_INFO, PRS.JAM_INFO, PRS.TIPE_ABSEN, PRS.TIPE_ABSEN_INFO
		FROM
		(
			SELECT 
				A.PEGAWAI_ID, A.NIP_LAMA, A.NIP_BARU, A.STATUS_PEGAWAI_ID
				, (CASE WHEN COALESCE(NULLIF(A.GELAR_DEPAN,'') , NULL ) IS NULL THEN '' ELSE A.GELAR_DEPAN || ' ' END) || A.NAMA || (CASE WHEN COALESCE(NULLIF(A.GELAR_BELAKANG,'') , NULL ) IS NULL THEN '' ELSE '' || A.GELAR_BELAKANG END) NAMA_LENGKAP
				, PANG_RIW.KODE PANGKAT_RIWAYAT_KODE, PANG_RIW.TMT_PANGKAT PANGKAT_RIWAYAT_TMT
				, JAB_RIW.JABATAN_NAMA JABATAN_RIWAYAT_NAMA, JAB_RIW.ESELON_NAMA JABATAN_RIWAYAT_ESELON, JAB_RIW.TMT_JABATAN JABATAN_RIWAYAT_TMT
				, JAB_RIW.ESELON_ID, PANG_RIW.PANGKAT_ID, PANG_RIW.TMT_PANGKAT, A.SATUAN_KERJA_ID
				, CASE
				WHEN CURRENT_DATE <= G.TANGGAL_AKHIR AND CURRENT_DATE >= G.TANGGAL_MULAI
				THEN 1
				WHEN G.PEGAWAI_ID IS NOT NULL THEN 2
				ELSE 0
				END STATUS_BERLAKU
			FROM PEGAWAI A
			LEFT JOIN
			(
				SELECT A.PANGKAT_RIWAYAT_ID, B.KODE, A.TMT_PANGKAT, A.PANGKAT_ID
				FROM PANGKAT_RIWAYAT A
				LEFT JOIN PANGKAT B ON A.PANGKAT_ID = B.PANGKAT_ID
			) PANG_RIW ON A.PANGKAT_RIWAYAT_ID = PANG_RIW.PANGKAT_RIWAYAT_ID
			LEFT JOIN
			(
				SELECT A.JABATAN_RIWAYAT_ID, COALESCE(A.ESELON_ID,99) ESELON_ID, B.NAMA ESELON_NAMA, A.TMT_JABATAN, A.NAMA JABATAN_NAMA
				FROM JABATAN_RIWAYAT A
				LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
			) JAB_RIW ON A.JABATAN_RIWAYAT_ID = JAB_RIW.JABATAN_RIWAYAT_ID
			LEFT JOIN SATUAN_KERJA SK ON SK.SATUAN_KERJA_ID = A.SATUAN_KERJA_ID
			LEFT JOIN (SELECT PEGAWAI_ID, TANGGAL_MULAI, TANGGAL_AKHIR FROM HUKUMAN_TERAKHIR X) G ON A.PEGAWAI_ID = G.PEGAWAI_ID
			WHERE 1 = 1
		) A
		LEFT JOIN
		(
			SELECT
			PEGAWAI_ID::NUMERIC PEGAWAI_ID, JAM
			, TO_CHAR(JAM, 'YYYY-MM-DD') TANGGAL_INFO, TO_CHAR(JAM, 'HH24:MI:SS') JAM_INFO, TIPE_ABSEN
			, CASE TIPE_ABSEN WHEN '0' THEN 'Masuk' WHEN '1' THEN 'Pulang' WHEN '2' THEN 'ASKD' ELSE 'Info belum di tentukan' END TIPE_ABSEN_INFO
			FROM presensi.ABSENSI
			WHERE 1=1 
			--AND VALIDASI = 1
			".$statementdetil."
			ORDER BY JAM
		) PRS ON PRS.PEGAWAI_ID = A.PEGAWAI_ID
		WHERE 1=1
		AND A.STATUS_PEGAWAI_ID IN (1,2)
		"; 

		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
			
		$str .= $statement."  ".$order;
		$this->query = $str;

		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
		
    }

  } 
?>