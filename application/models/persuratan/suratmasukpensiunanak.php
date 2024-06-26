<? 
/* *******************************************************************************************************
MODUL NAME 			: MTSN LAWANG
FILE NAME 			: 
AUTHOR				: 
VERSION				: 1.0
MODIFICATION DOC	:
DESCRIPTION			: 
***************************************************************************************************** */

  /***
  * Entity-base class untuk mengimplementasikan tabel kategori.
  * 
  ***/
  // include_once('Entity.php');
  include_once(APPPATH.'/models/Entity.php');
  
  class SuratMasukPensiunAnak extends Entity{ 

	 var $query;
  	var $id;
    /**
    * Class constructor.
    **/
    function SuratMasukPensiunAnak()
	{
      $this->Entity(); 
    }

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("SURAT_MASUK_PENSIUN_ANAK_ID", $this->getNextId("SURAT_MASUK_PENSIUN_ANAK_ID","PERSURATAN.SURAT_MASUK_PENSIUN_ANAK")); 

     	$str = "
			INSERT INTO PERSURATAN.SURAT_MASUK_PENSIUN_ANAK (
				SURAT_MASUK_PENSIUN_ANAK_ID, SURAT_MASUK_PEGAWAI_ID, JENIS_ID, KATEGORI, SURAT_MASUK_BKD_ID,
				SURAT_MASUK_UPT_ID, PEGAWAI_ID, ANAK_ID
				)
			VALUES (
				 ".$this->getField("SURAT_MASUK_PENSIUN_ANAK_ID").",
				 ".$this->getField("SURAT_MASUK_PEGAWAI_ID").",
				 ".$this->getField("JENIS_ID").",
				 '".$this->getField("KATEGORI")."',
				 ".$this->getField("SURAT_MASUK_BKD_ID").",
				 ".$this->getField("SURAT_MASUK_UPT_ID").",
				 ".$this->getField("PEGAWAI_ID").",
				 ".$this->getField("ANAK_ID")."
			)
		"; 	
		$this->id = $this->getField("SURAT_MASUK_PENSIUN_ANAK_ID");
		$this->query = $str;
		//echo $str;exit;
		return $this->execQuery($str);
    }

	function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "		
				UPDATE PERSURATAN.SURAT_MASUK_PENSIUN_ANAK
				SET
					KATEGORI= '".$this->getField("KATEGORI")."',
					SURAT_MASUK_BKD_ID= '".$this->getField("SURAT_MASUK_BKD_ID")."'
				WHERE SURAT_MASUK_PENSIUN_ANAK_ID = ".$this->getField("SURAT_MASUK_PENSIUN_ANAK_ID")."
				"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "
				UPDATE PERSURATAN.URAT_MASUK SET
					STATUS = '1',
					LAST_USER = '".$this->getField("LAST_USER")."',
					LAST_DATE = ".$this->getField("LAST_DATE")."
				WHERE SURAT_MASUK_PENSIUN_ANAK_ID = ".$this->getField("SURAT_MASUK_PENSIUN_ANAK_ID")."
				";
		$this->query = $str;
		return $this->execQuery($str);
    }

    /** 
    * Cari record berdasarkan array parameter dan limit tampilan 
    * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","MASTER_KATEGORI_METODE_EVALUASI_ID"=>"yyy") 
    * @param int limit Jumlah maksimal record yang akan diambil 
    * @param int from Awal record yang diambil 
    * @return boolean True jika sukses, false jika tidak 
    **/ 
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY A.SURAT_MASUK_PENSIUN_ANAK_ID ASC')
	{
		$str = "
		SELECT
			A.SURAT_MASUK_PENSIUN_ANAK_ID, A.SURAT_MASUK_PEGAWAI_ID, A.JENIS_ID, A.KATEGORI, A.SURAT_MASUK_BKD_ID, 
			A.SURAT_MASUK_UPT_ID, A.PEGAWAI_ID, A.ANAK_ID
		FROM PERSURATAN.SURAT_MASUK_PENSIUN_ANAK A
		WHERE 1 = 1
		"; 
		
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
		
    }
	
    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
				SELECT COUNT(1) AS ROWCOUNT 
				FROM PERSURATAN.SURAT_MASUK_PENSIUN_ANAK A
				WHERE 1 = 1 ".$statement; 
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0;  
    }
	
  } 
?>