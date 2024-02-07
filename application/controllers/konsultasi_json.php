<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");

class konsultasi_json extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		//kauth
		if (!$this->kauth->getInstance()->hasIdentity())
		{
			// trow to unauthenticated page!
			//redirect('Login');
		}       
		
		/* GLOBAL VARIABLE */
		$this->LOGIN_USER= $this->kauth->getInstance()->getIdentity()->LOGIN_USER;
		$this->USER_LOGIN_ID= $this->kauth->getInstance()->getIdentity()->USER_LOGIN_ID;
		$this->SATUAN_KERJA_ID= $this->kauth->getInstance()->getIdentity()->SATUAN_KERJA_ID;
		$this->PEGAWAI_ID= $this->kauth->getInstance()->getIdentity()->PEGAWAI_ID;
		$this->LOGIN_ID= $this->kauth->getInstance()->getIdentity()->LOGIN_ID;
		$this->LOGIN_PEGAWAI_ID= $this->kauth->getInstance()->getIdentity()->LOGIN_PEGAWAI_ID;
	}	
	
	function json() 
	{
		$this->load->model('Mailbox');

		$set = new Mailbox();
		
		ini_set("memory_limit","500M");
		ini_set('max_execution_time', 520);
		
		
		$aColumns = array("PEGAWAI_NAMA", "TANGGAL", "SUBYEK", "STATUS_NAMA", "MAILBOX_ID");
		$aColumnsAlias = array("PEGAWAI_NAMA", "TANGGAL", "SUBYEK", "STATUS_NAMA", "MAILBOX_ID");
		
		/*
		 * Ordering
		 */
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = " ORDER BY ";

			//Go over all sorting cols
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				//If need to sort by current col
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					//Add to the order by clause
					$sOrder .= $aColumnsAlias[ intval( $_GET['iSortCol_'.$i] ) ];

					//Determine if it is sorted asc or desc
					if (strcasecmp(( $_GET['sSortDir_'.$i] ), "asc ") == 0)
					{
						$sOrder .=" asc , ";
					}else
					{
						$sOrder .=" desc , ";
					}
				}
			}
			

			//Remove the last space / comma
			$sOrder = substr_replace( $sOrder, "", -2 );
			
			//Check if there is an order by clause
			if ( trim($sOrder) == "ORDER BY NAMA desc" )
			{
				/*
				* If there is no order by clause - ORDER BY INDEX COLUMN!!! DON'T DELETE IT!
				* If there is no order by clause there might be bugs in table display.
				* No order by clause means that the db is not responsible for the data ordering,
				* which means that the same row can be displayed in two pages - while
				* another row will not be displayed at all.
				*/
				$sOrder = " ORDER BY NAMA ASC ";

			}
		}


		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables.
		 */
		$sWhere = "";
		$nWhereGenearalCount = 0;
		if (isset($_GET['sSearch']))
		{
			$sWhereGenearal = $_GET['sSearch'];
		}
		else
		{
			$sWhereGenearal = '';
		}
		
		if ( $_GET['sSearch'] != "" )
		{
			//Set a default where clause in order for the where clause not to fail
			//in cases where there are no searchable cols at all.
			$sWhere = " AND (";
			for ( $i=0 ; $i<count($aColumnsAlias)+1 ; $i++ )
			{
				//If current col has a search param
				if ( $_GET['bSearchable_'.$i] == "true" )
				{
					//Add the search to the where clause
					$sWhere .= $aColumnsAlias[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
					$nWhereGenearalCount += 1;
				}
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}

		/* Individual column filtering */
		$sWhereSpecificArray = array();
		$sWhereSpecificArrayCount = 0;
		for ( $i=0 ; $i<count($aColumnsAlias) ; $i++ )
		{
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				//If there was no where clause
				if ( $sWhere == "" )
				{
					$sWhere = "AND ";
				}
				else
				{
					$sWhere .= " AND ";
				}

				//Add the clause of the specific col to the where clause
				$sWhere .= $aColumnsAlias[$i]." LIKE '%' || :whereSpecificParam".$sWhereSpecificArrayCount." || '%' ";

				//Inc sWhereSpecificArrayCount. It is needed for the bind var.
				//We could just do count($sWhereSpecificArray) - but that would be less efficient.
				$sWhereSpecificArrayCount++;

				//Add current search param to the array for later use (binding).
				$sWhereSpecificArray[] =  $_GET['sSearch_'.$i];

			}
		}

		//If there is still no where clause - set a general - always true where clause
		if ( $sWhere == "" )
		{
			$sWhere = " AND 1=1";
		}
		//Bind variables.
		if ( isset( $_GET['iDisplayStart'] ))
		{
			$dsplyStart = $_GET['iDisplayStart'];
		}
		else{
			$dsplyStart = 0;
		}

		if ( isset( $_GET['iDisplayLength'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$dsplyRange = $_GET['iDisplayLength'];
			if ($dsplyRange > (2147483645 - intval($dsplyStart)))
			{
				$dsplyRange = 2147483645;
			}
			else
			{
				$dsplyRange = intval($dsplyRange);
			}
		}
		else
		{
			$dsplyRange = 2147483645;
		}
		
		$searchJson = "  AND (UPPER(NAMA) LIKE '%".strtoupper($_GET['sSearch'])."%')";
		$allRecord = $set->getCountByParams(array());
		if($_GET['sSearch'] == "")
			$allRecordFilter = $allRecord;
		else	
			$allRecordFilter = $set->getCountByParams(array(), $searchJson);
		
		$set->selectByParams(array(), $dsplyRange, $dsplyStart, $searchJson, $sOrder);     		
		
		/* Output */
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $allRecord,
			"iTotalDisplayRecords" => $allRecordFilter,
			"aaData" => array()
		);
		
		while($set->nextRow())
		{
			$row = array();
			
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if($aColumns[$i] == "TANGGAL")
					$row[] = getFormattedDateTime($set->getField($aColumns[$i]));
				else if($aColumns[$i] == "KETERANGAN")
					$row[] = truncate($set->getField($aColumns[$i]), 5)."...";
				else
					$row[] = $set->getField($aColumns[$i]);
			}
			
			$output['aaData'][] = $row;
		}
		
		echo json_encode( $output );
	}
	
	function add()
	{
		$this->load->model('Mailbox');
		$this->load->model('MailboxDetil');
		// $reqPegawaiId = $this->input->post("reqPegawaiId");
		$reqPesan= $_POST["reqPesan"]; 
		$reqJudul = $this->input->post("reqJudul");
		$reqMailBoxKategoriId = $this->input->post("reqMailBoxKategoriId");
		$reqSatuanKerjaId = $this->input->post("reqSatuanKerjaId");
		$reqTipe = $this->input->post("reqTipe");

		$mailbox= new Mailbox();
		$mailbox->setField('TANGGAL', "CURRENT_TIMESTAMP");
		$mailbox->setField('ISI', $reqPesan);
		$mailbox->setField('SUBYEK', setQuote($reqJudul,1));
		$mailbox->setField('STATUS', ValToNullDB($req));
		$mailbox->setField('TIPE', ValToNullDB($reqTipe));

		$mailbox->setField('MAILBOX_KATEGORI_ID', ValToNullDB($reqMailBoxKategoriId));
		$mailbox->setField('PEGAWAI_ID', ValToNullDB($this->PEGAWAI_ID));
		$mailbox->setField('USER_LOGIN_ID', $this->USER_LOGIN_ID);
		$mailbox->setField('SATUAN_KERJA_TUJUAN_ID', $reqSatuanKerjaId);
		$mailbox->setField('SATUAN_KERJA_ASAL_ID', $this->SATUAN_KERJA_ID);
		$mailbox->setField("LAST_USER", $this->LOGIN_USER);
		$mailbox->setField("USER_LOGIN_ID", $this->LOGIN_ID);
		$mailbox->setField("USER_LOGIN_PEGAWAI_ID",ValToNullDB($this->LOGIN_PEGAWAI_ID));
		$mailbox->setField("LAST_DATE", "NOW()");

		if($mailbox->insert())
		{
			$set= new MailboxDetil();
			$set->setField('TANGGAL', "CURRENT_TIMESTAMP");
			$set->setField('MAILBOX_ID', $mailbox->id);
			$set->setField('ISI', $reqPesan);
			$set->setField('SUBYEK', setQuote($reqJudul,1));
			$set->setField('STATUS', ValToNullDB($req));
			$set->setField('TIPE', ValToNullDB($reqTipe));
			$set->setField('MAILBOX_KATEGORI_ID', ValToNullDB($reqMailBoxKategoriId));
			$set->setField('PEGAWAI_ID', ValToNullDB($this->PEGAWAI_ID));
			$set->setField('USER_LOGIN_ID', $this->USER_LOGIN_ID);
			$set->setField('SATUAN_KERJA_JAWAB_ID', $reqSatuanKerjaId);
			$set->setField("LAST_USER", $this->LOGIN_USER);
			$set->setField("USER_LOGIN_ID", $this->LOGIN_ID);
			$set->setField("USER_LOGIN_PEGAWAI_ID",ValToNullDB($this->LOGIN_PEGAWAI_ID));
			$set->setField("LAST_DATE", "NOW()");
			$set->insert();
			echo "-Data berhasil disimpan.";
		}
		else 
		{
			echo "xxx-Data gagal disimpan.";
		}

	}

	function reloadajax()
	{
		$reqId = $this->input->get("reqId");
		$reqInformasiKategori = $this->input->get("reqInformasiKategori");
		$reqTanggalMulai = $this->input->get("reqTanggalMulai");
		$reqTanggalAkhir = $this->input->get("reqTanggalAkhir");
		
		$this->load->model('Mailbox');
		$this->load->library("Pagination");
		
		$reqPage = $this->input->post("page");
		$reqShow = $this->input->post("show");
		$reqContent = $this->input->post("content");
				
		$mailbox= new Mailbox();
		if(isset($reqPage)){
			
			$dsplyStart = !empty($reqPage)?$reqPage:0;
			$dsplyRange = 20;
			
			// $statement = "AND STATUS IS NULL ";
			
			
			// if($reqTanggalMulai == "" && $reqTanggalAkhir=="")
			// {
			// 	$statement .= " AND 1=1";
			// }
			// else if($reqTanggalMulai=="" && $reqTanggalAkhir!=="")
			// {
			// 	$statement .= " AND TANGGAL_AWAL = TO_DATE('".$reqTanggalMulai."', 'DD-MM-YYYY')";
			// }
			// else if($reqTanggalMulai!=="" && $reqTanggalAkhir=="")
			// {
			// 	$statement .= " AND TANGGAL_AKHIR = TO_DATE('".$reqTanggalMulai."', 'DD-MM-YYYY')";
			// }
			// else if($reqTanggalMulai!=="" && $reqTanggalAkhir!=="")
			// {
			// 	$statement .= " AND TANGGAL_AWAL >= TO_DATE('".$reqTanggalMulai."', 'DD-MM-YYYY') AND TANGGAL_AKHIR <= TO_DATE('".$reqTanggalAkhir."', 'DD-MM-YYYY')";
			// }
			
			// if($reqInformasiKategori==""){}
			// else
			// {
			// 	$statement .= " AND INFORMASI_KATEGORI_ID = ".$reqInformasiKategori;
			// }
			
			//echo $statement;exit;
			
			//get rows
			$rowCount = $mailbox->getCountByParams(array(), $statement);
			//echo $mailbox->query;exit;
			//echo $rowCount;exit;
			$mailbox->selectByParams(array(), $dsplyRange, $dsplyStart, $statement);
			//initialize pagination class
			$pagConfig = array('baseURL'=>'konsultasi_json/reloadajax/?reqInformasiKategori='.$reqInformasiKategori.'&reqTanggalMulai='.$reqTanggalMulai.'&reqTanggalAkhir='.$reqTanggalAkhir, 'showRecord' => $reqShow, 'totalRows'=>$rowCount, 'currentPage'=>$dsplyStart, 'perPage'=>$dsplyRange, 'contentDiv'=>$reqContent);
			$pagination =  new Pagination($pagConfig);
			?>
			<table class="topic-list ember-view" id="ember844">
            <thead>
                <tr>
                    <th data-sort-order="default" class="default">Pertanyaan</th>
                    <th data-sort-order="posts" class="posts num">Jenis Pelayanan</th>
                    <th data-sort-order="category" class="category">Kategori</th>
                    <th data-sort-order="category" class="category">Status</th>
                    <th data-sort-order="activity" class="activity num">Terakhir Update</th>
                </tr>
            </thead>
            <tbody>
            <?
            while($mailbox->nextRow())
            {
            ?>
                <tr style="cursor: pointer;" onclick='document.location="app/loadUrl/app/konsultasi_detil?reqId=<?=$mailbox->getField("MAILBOX_ID")?>"'>
                    <td style="width: 30%"><span><?=$mailbox->getField("SUBYEK")?></span></td>
                    <td><span><?=$mailbox->getField("JENIS_PELAYANAN_NAMA")?></span></td>
                    <td><span><?=$mailbox->getField("MAILBOX_KATEGORI_NAMA")?></span></td>
                    <td><span><?=$mailbox->getField("STATUS_NAMA")?></span></td>
                    <td><span><?=getFormattedDateTime($mailbox->getField("TANGGAL"))?></span></td>
                </tr>
            <?
            }
            ?>
            </tbody>
            </table>
            <?=$pagination->createLinks()?>
		<?
		}
	}

}
?>