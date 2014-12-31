<?PHP if (!defined('BASEPATH')) exit ('No direct script access allowed');

/** Model user request(UR) / form request 
 * Created April 2013 - Mohamad Yansen Riadi
 * RC = Request Case , UR = User Request , DTL = Detail, WR = Waiting Respond
 *
 *
 *
 */
 
class M_user_request extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}	
	
	public function req_type($user_no)
	{
		$sql = "SELECT
						A.TYPE_NO, T.TYPE_NAME
					FROM TBL_ACC_USER_ISD_REQ A, TBL_REQUEST_TYPE T
					WHERE
						A.TYPE_NO = T.TYPE_NO
						AND A.USER_NO = $user_no
						AND A.ACC_ACTIVE = 1 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function req_category()
	{
		$sql = "SELECT CATEGORY_NO, CATEGORY_NAME FROM TBL_REQUEST_CATEGORY WHERE CATEGORY_ACTIVE = 1 AND CATEGORY_DELETED = 99";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function req_priority()
	{
		$sql = "SELECT PRIORITY_NO, PRIORITY_NAME FROM TBL_REQUEST_PRIORITY WHERE PRIORITY_ACTIVE = 1 AND PRIORITY_DELETED = 99";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function get_sequence()
	{
		$sql_seq = "SELECT TO_CHAR(SEQ_REQUEST.NEXTVAL, '00000000') AS SEQ FROM DUAL";
		$query_seq = $this->db->GetArray($sql_seq);
		foreach ($query_seq as $qs)
		{
			return $qs['SEQ'];
		}
	}
	
	public function ifexist_ref_no($p_ref_no)
	{
		$sql = "SELECT COUNT(REF_NO) AS CEK FROM TBL_REQUEST WHERE REF_NO = '$p_ref_no' ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			echo $q['CEK'];
		}
	}
	
	public function new_request($p_req_no,$p_req_name,$p_req_type,$p_req_category,$p_req_reason,$p_req_note,$p_req_refNo,$p_req_by)
	{
		// create master request
		$sql = "INSERT INTO TBL_REQUEST (REQ_NO, REQ_NAME, TYPE_NO, CATEGORY_NO, REF_NO, REQ_REASON, REQ_NOTE, REQ_BY) VALUES
					('$p_req_no', '$p_req_name', '$p_req_type', '$p_req_category', '$p_req_refNo', '$p_req_reason', '$p_req_note', '$p_req_by')";
		$query = $this->db->Execute($sql);
		if ($query)
		{			
			// get sequence history
			$sql = "SELECT SEQ_REQ_HISTORY.NEXTVAL AS SEQ_REQ_HISTORY FROM DUAL";
			$query = $this->db->GetArray($sql);
			foreach ($query as $q)
			{
				$seq_req_his = $q['SEQ_REQ_HISTORY'];
			}
			$tahun = date('Y');
			$bulan = date('m');
			$p_history_no = $seq_req_his."/".$bulan."/".$tahun; // create history number
			
			// create history created request
			$sql = "INSERT INTO TBL_REQUEST_HISTORY
							(HISTORY_NO, REQ_NO, REQ_STATUS, HISTORY_BY)
						VALUES 
							('$p_history_no','$p_req_no',7,'$p_req_by')";
			$query = $this->db->Execute($sql);
			if ($query)
			{			
				return true;
			}
		}
	}
	
	public function new_request_file($file_upload,$p_req_no,$p_DS_form_req_dev,$p_DS_bisnis_proses,$p_DS_regulasi,$p_DS_master_data,$p_DS_fungsi_utama_app,
																												$p_DS_karakteristik_pengguna,$p_DS_prototype,$p_DS_RAS)
	{
		$sql = "INSERT INTO TBL_REQUEST_FILE (REQ_NO,
                              FILE_DOC_SUPPORT,
                              FILE_FORM_REQ_DEV,
                              FILE_BISNIS_PROSES,
                              FILE_REGULASI,
                              FILE_MASTER_DATA,
                              FILE_FUNGSI_UTAMA_APP,
                              FILE_KARAKTERISTIK_PENGGUNA,
                              FILE_PROTOTYPE,
                              FILE_RAS)
					VALUES ('$p_req_no',
									'$file_upload',
									'$p_DS_form_req_dev',
									'$p_DS_bisnis_proses',
									'$p_DS_regulasi',
									'$p_DS_master_data',
									'$p_DS_fungsi_utama_app',
									'$p_DS_karakteristik_pengguna',
									'$p_DS_prototype',
									'$p_DS_RAS')";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return true;
		}
	}
	
	/*
	public function get_sequence()
	{
		$q_seq = $this->db->query(" SELECT * FROM seq_request "); 
		foreach ($q_seq->result() as $q_s)
		{
			$seq = $q_s->seq_request;		
		}
		
			if (!empty($seq))
			{
				if (strlen($seq) == 1)
				{
					$new_seq = "000000".$seq;
				}
				
				elseif (strlen($seq) == 2) 
				{
					$new_seq = "00000".$seq;
				}

				elseif (strlen($seq) == 3) 
				{
					$new_seq = "0000".$seq;
				}
				
				elseif (strlen($seq) == 4) 
				{
					$new_seq = "000".$seq;
				}
				
				elseif (strlen($seq) == 5) 
				{
					$new_seq = "00".$seq;
				}
				
				elseif (strlen($seq) == 6) 
				{
					$new_seq = "0".$seq;
				}
				
				else 
				{
					$new_seq = $seq;
				}
			}
			$tahunbulan = date('m-y');
			$seqNew = $seq+1;
			$seqCurrent = $seq;
			$id = "REQ/".$tahunbulan."/".$new_seq;
			$feedback = $id."+".$seqNew."+".$seqCurrent;
			return $feedback;
	}
	
	public function insert_UR($seq,$newSeq,$currentSeq,$b,$t,$c,$m,$d,$r,$idlog,$fullname,$email)
	{
		$sekarang = date('Y-m-d h:i:s');
		$sql_log = "INSERT INTO tbl_request_history (request_id, event, by_user, history_created)
							VALUES ('$seq','new request','$idlog','$sekarang')";
		$insert_log = $this->db->query($sql_log);
			$insert = $this->db->query(" INSERT INTO tbl_request (request_id,request_based,request_type,request_case,request_modul,request_desc,request_reason,request_dateCreated,request_userIdRequested,request_userFullNameRequested,request_userEmailRequested,request_status,request_notification) VALUES 
																('$seq','$b','$t','$c','$m','$d','$r','$sekarang','$idlog','$fullname','$email','Waiting_respond','Y')
															");
			if ($insert)
			{
				$query_update_seq = $this->db->query("UPDATE seq_request SET seq_request='$newSeq' WHERE seq_request='$currentSeq'");
				return true;
			}
	}
	
	public function insert_file_maintenance($seq,$type_file,$file_maintenance)
	{
		$sql = "INSERT INTO tbl_file_request 
					(F_Req_id,F_Req_type,F_Maintenance) values
					('$seq','$type_file','$file_maintenance')
					";
		$query = $this->db->query($sql);
		return true;
	}
	
	public function insert_file_project($seq,$type_file,$imp_file_documentation)
	{
		$file_project = explode("|",$imp_file_documentation);
		$sql = "INSERT INTO tbl_file_request
					(F_Req_id,F_Req_type,F_Form_req_dev,F_Bisnis_proses,F_Regulasi,F_Master_data,F_Fungsi_utamaApp,F_Karakteristik_pengguna,F_Prototype,F_RAS,F_UAT) values
					('$seq','$type_file','".$file_project[0]."','".$file_project[1]."','".$file_project[2]."','".$file_project[3]."','".$file_project[4]."','".$file_project[5]."','".$file_project[6]."','".$file_project[7]."','".$file_project[8]."')
				";
		$query = $this->db->query($sql);
		return true;
	}
	
	public function DTL_WR_UR()
	{
		$id_user = $this->session->userdata('login_id');
		$DTL_WR_UR = $this->db->query(" SELECT request_id,request_based,
       (SELECT requestType_name FROM tbl_requesttype WHERE requestType_id=req.request_type) AS request_type,
       (SELECT requestCase_name FROM tbl_requestcase WHERE requestCase_id=req.request_case) AS request_case,
       request_modul,request_desc,request_reason,DATE_FORMAT(request_dateCreated, '%d-%m-%Y %h:%i:%s') AS request_dateCreated,request_status
		FROM tbl_request req WHERE request_userIdRequested='$id_user' AND request_cancel IS NULL AND request_PIC IS NULL AND request_estimateTime IS NULL AND request_status='Waiting_respond'  "); 
		return $DTL_WR_UR->result();
	}
	
	public function FCD_UR($id)
	{
		$id_user = $this->session->userdata('login_id');
		$FCD = $this->db->query(" SELECT CONCAT_WS(';',request_id,request_based,
       (SELECT requestType_name FROM tbl_requesttype WHERE requestType_id=req.request_type),
       (SELECT requestCase_name FROM tbl_requestcase WHERE requestCase_id=req.request_case),
       request_modul,request_desc,request_reason,DATE_FORMAT(request_dateCreated, '%d-%m-%Y %h:%i:%s'),request_status,request_PIC) AS DATA
		FROM tbl_request req WHERE request_userIdRequested='$id_user' AND request_id='$id' AND request_cancel IS NULL "); 
		return $FCD->result() ;
	}
	
	public function upload_uat($id,$file_name)
	{
		$sql = "UPDATE tbl_file_request SET F_UAT='$file_name' WHERE F_Req_id='$id' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	*/
}

?>