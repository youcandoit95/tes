<?php if (!defined('BASEPATH')) exit ('No direct script allowed access');

class M_sdh_hr extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function data_hold_request($user_no)
	{
		$sess_login_level = $this->session->userdata('user_level');
		$filter_pic = $sess_login_level==3 ? "" : "AND R.REQ_PIC = ".$this->session->userdata('user_no')."";
		
		$sql = "SELECT
						R.REQ_NO,
						R.REQ_NAME,
						T.TYPE_NAME,
						C.CATEGORY_NAME,
						R.REF_NO,
						U.USER_FNAME AS REQ_PIC,
						R.REQ_LSTATUS,
						S.STATUS_NAME,
						S.CLASS_TABLE AS NOTIF,
						TO_CHAR(R.REQ_CREATED, 'DD-MM-RRRR') AS REQ_CREATED,
						F.FILE_DOC_SUPPORT, F.FILE_UAT 
					FROM TBL_REQUEST R, TBL_REQUEST_TYPE T, TBL_REQUEST_CATEGORY C, TBL_STATUS S, TBL_USER U, TBL_REQUEST_FILE F
					WHERE
						R.TYPE_NO = T.TYPE_NO
						AND R.CATEGORY_NO = C.CATEGORY_NO
						AND R.REQ_LSTATUS = S.STATUS_NO
						AND R.REQ_PIC = U.USER_NO
						AND R.REQ_NO = F.REQ_NO
						".$filter_pic."
						AND R.REQ_CANCEL=99 
						AND R.REQ_LSTATUS=2
					ORDER BY R.REQ_CREATED DESC
					 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function data_status()
	{
		$sql = "SELECT
						STATUS_NO, STATUS_NAME
					FROM TBL_STATUS
					WHERE
						STATUS_NO IN (1,4)
					AND STATUS_ACTIVE = 1
					ORDER BY STATUS_NO ASC ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function recent_update_hold_request($user_no)
	{
		$sql = "SELECT
						REQ_NO 
					FROM TBL_REQUEST 
					WHERE 
						REQ_PIC=$user_no
						AND REQ_LSTATUS=2
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ_DEV='2'
					 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function flag_read_hold($user_no)
	{
		$sql = "UPDATE TBL_REQUEST
					SET
						REQ_NOTIF_READ_DEV='2-READ' 
					WHERE
						REQ_PIC=$user_no
						AND REQ_LSTATUS=2
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ_DEV='2' ";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function flag_read_notif_revision($user_no)
	{
		$sql = "SELECT
						REQ_NO 
					FROM TBL_REQUEST 
					WHERE 
						REQ_PIC=$user_no
						AND REQ_LSTATUS=6
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ_DEV='6' "; 
		$query = $this->db->GetArray($sql);
		if (!empty($query))
		{
			foreach ($query as $q)
			{
				$sql_flag = "UPDATE TBL_REQUEST
										SET REQ_NOTIF_READ_DEV='6-READ'
									WHERE REQ_NO='".$q['REQ_NO']."' 
										REQ_PIC=$user_no
										AND REQ_LSTATUS=6
										AND REQ_CANCEL=99
										AND REQ_NOTIF_READ_DEV='6' ";
				$query_flag = $this->db->Execute($sql_flag);
			}
			return true;
		}
	}
	
	public function revision_request($p_req_no,$p_req_est_time,$user_no)
	{
		$sql = "UPDATE TBL_REQUEST SET 
						REQ_LSTATUS=4,
						REQ_NOTIF_READ=4,
						REQ_EST_TIME=TO_DATE('$p_req_est_time','DD-MM-RRRR HH24:MI:SS'),
						REQ_LUPDATED = SYSDATE
					WHERE REQ_NO='$p_req_no' ";
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
			
			// insert history on process request
			$sql = "INSERT INTO TBL_REQUEST_HISTORY
							(HISTORY_NO, REQ_NO, REQ_STATUS, REQ_STATUS_REASON, HISTORY_BY)
						VALUES 
							('$p_history_no','$p_req_no',7,'$p_req_est_time','$user_no')";
			$query = $this->db->Execute($sql);
			if ($query)
			{			
				return true;
			}
		}
	}
}

?>