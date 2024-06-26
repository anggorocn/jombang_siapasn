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
  
  class Mertua extends Entity{ 

	var $query;
    /**
    * Class constructor.
    **/
    function Mertua()
	{
      $this->Entity(); 
    }

        function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.MERTUA")); 

		$str = "
			INSERT INTO validasi.MERTUA (
				MERTUA_ID, PEGAWAI_ID, JENIS_KELAMIN, NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, PEKERJAAN, ALAMAT, KODEPOS, TELEPON, PROPINSI_ID, 
				KABUPATEN_ID, KELURAHAN_ID, KECAMATAN_ID, LAST_USER, LAST_DATE, LAST_LEVEL, USER_LOGIN_ID, USER_LOGIN_PEGAWAI_ID,
				TEMP_VALIDASI_ID
			) 
			VALUES (
				 ".$this->getField("MERTUA_ID").",
				 ".$this->getField("PEGAWAI_ID").",
				 '".$this->getField("JENIS_KELAMIN")."',
				 '".$this->getField("NAMA")."',
				 '".$this->getField("TEMPAT_LAHIR")."',
				 ".$this->getField("TANGGAL_LAHIR").",
				 '".$this->getField("PEKERJAAN")."',
				 '".$this->getField("ALAMAT")."',
				 '".$this->getField("KODEPOS")."',
				 '".$this->getField("TELEPON")."',
				 ".$this->getField("PROPINSI_ID").",
				 ".$this->getField("KABUPATEN_ID").",
				 ".$this->getField("KELURAHAN_ID").",
				 ".$this->getField("KECAMATAN_ID").",
				 '".$this->getField("LAST_USER")."',
				 ".$this->getField("LAST_DATE").",
				 ".$this->getField("LAST_LEVEL").",
				 ".$this->getField("USER_LOGIN_ID").",
				 ".$this->getField("USER_LOGIN_PEGAWAI_ID").",
				 ".$this->getField("TEMP_VALIDASI_ID")."
			)
		"; 	
		$this->id = $this->getField("MERTUA_ID");
		$this->query = $str;
		return $this->execQuery($str);
    }


    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "		
				UPDATE validasi.MERTUA
				SET    
				 	MERTUA_ID= ".$this->getField("MERTUA_ID").",
				 	PEGAWAI_ID= ".$this->getField("PEGAWAI_ID").",
				 	JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
				 	NAMA= '".$this->getField("NAMA")."',
				 	TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
				 	TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
				 	PEKERJAAN= '".$this->getField("PEKERJAAN")."',
				 	ALAMAT= '".$this->getField("ALAMAT")."',
				 	KODEPOS= '".$this->getField("KODEPOS")."',
				 	TELEPON= '".$this->getField("TELEPON")."',
				 	PROPINSI_ID= ".$this->getField("PROPINSI_ID").",
				 	KABUPATEN_ID= ".$this->getField("KABUPATEN_ID").",
				 	KELURAHAN_ID= ".$this->getField("KELURAHAN_ID").",
				 	KECAMATAN_ID= ".$this->getField("KECAMATAN_ID").",
				 	LAST_USER= '".$this->getField("LAST_USER")."',
				 	LAST_DATE= ".$this->getField("LAST_DATE").",
				 	USER_LOGIN_ID= ".$this->getField("USER_LOGIN_PEGAWAI_ID").",
				 	USER_LOGIN_PEGAWAI_ID= ".$this->getField("USER_LOGIN_ID").",
				 	LAST_LEVEL= ".$this->getField("LAST_LEVEL")."
				WHERE  TEMP_VALIDASI_ID = ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }
	
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $order='ORDER BY A.MERTUA_ID ASC')
	{
		$str = "
		SELECT A.MERTUA_ID, A.PEGAWAI_ID, A.JENIS_KELAMIN, A.NAMA, A.TEMPAT_LAHIR, A.TANGGAL_LAHIR, A.PEKERJAAN, A.ALAMAT, A.KODEPOS, A.TELEPON
		, A.LAST_DATE, A.LAST_LEVEL
		, A.PROPINSI_ID, PROP.NAMA PROPINSI_NAMA, A.KABUPATEN_ID, KAB.NAMA KABUPATEN_NAMA, A.KECAMATAN_ID, KEC.NAMA KECAMATAN_NAMA, A.KELURAHAN_ID DESA_ID, KEL.NAMA DESA_NAMA
		FROM MERTUA A
		LEFT JOIN PROPINSI PROP ON PROP.PROPINSI_ID = A.PROPINSI_ID
		LEFT JOIN KABUPATEN KAB ON KAB.KABUPATEN_ID = A.KABUPATEN_ID
		LEFT JOIN KECAMATAN KEC ON KEC.KECAMATAN_ID = A.KECAMATAN_ID
		LEFT JOIN KELURAHAN KEL ON KEL.KECAMATAN_ID = A.KECAMATAN_ID AND KEL.KELURAHAN_ID = A.KELURAHAN_ID
		WHERE 1 = 1 
		"; 

		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
			
		$str .= $statement."  ".$order;
		// echo $str;exit();
		return $this->selectLimit($str,$limit,$from); 
		
    }

    function selectByPersonal($paramsArray=array(),$limit=-1,$from=-1, $pegawaiid, $id="", $rowid="", $statement='', $order='ORDER BY A.MERTUA_ID ASC')
	{
		$str = "
		SELECT A.MERTUA_ID, A.PEGAWAI_ID, A.JENIS_KELAMIN, A.NAMA, A.TEMPAT_LAHIR, A.TANGGAL_LAHIR, A.PEKERJAAN, A.ALAMAT, A.KODEPOS, A.TELEPON
		, A.PROPINSI_ID, PROP.NAMA PROPINSI_NAMA, A.KABUPATEN_ID, KAB.NAMA KABUPATEN_NAMA, A.KECAMATAN_ID, KEC.NAMA KECAMATAN_NAMA, A.KELURAHAN_ID DESA_ID, KEL.NAMA DESA_NAMA, TEMP_VALIDASI_ID, TEMP_VALIDASI_HAPUS_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		FROM (select * from validasi.validasi_pegawai_mertua('".$pegawaiid."', '".$rowid."')) A
		LEFT JOIN PROPINSI PROP ON PROP.PROPINSI_ID = A.PROPINSI_ID
		LEFT JOIN KABUPATEN KAB ON KAB.KABUPATEN_ID = A.KABUPATEN_ID
		LEFT JOIN KECAMATAN KEC ON KEC.KECAMATAN_ID = A.KECAMATAN_ID
		LEFT JOIN KELURAHAN KEL ON KEL.KECAMATAN_ID = A.KECAMATAN_ID AND KEL.KELURAHAN_ID = A.KELURAHAN_ID
		WHERE 1 = 1 
		"; 

		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
			
		$str .= $statement."  ".$order;
		// echo $str;exit();
		return $this->selectLimit($str,$limit,$from); 
		
    }
	 
    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "SELECT COUNT(A.MERTUA_ID) AS ROWCOUNT 
				FROM MERTUA A
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

  } 
?>