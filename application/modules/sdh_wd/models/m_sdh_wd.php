<?php if (!defined('BASEPATH')) exit ('No direct script allowed access');

class M_sdh_wd extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function data_waiting_done_request($user_no)
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
						F.FILE_DOC_SUPPORT, F.FILE_UAT,
						R.REQ_NOTIF_READ_DEV
					FROM TBL_REQUEST R, TBL_REQUEST_TYPE T, TBL_REQUEST_CATEGORY C, TBL_STATUS S, TBL_USER U, TBL_REQUEST_FILE F
					WHERE
						R.TYPE_NO = T.TYPE_NO
						AND R.CATEGORY_NO = C.CATEGORY_NO
						AND R.REQ_LSTATUS = S.STATUS_NO
						AND R.REQ_PIC = U.USER_NO
						AND R.REQ_NO = F.REQ_NO
						".$filter_pic."
						AND R.REQ_CANCEL=99
						AND R.REQ_LSTATUS=5
					ORDER BY R.REQ_NO DESC";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function recent_update_waiting_done_request($user_no)
	{
		$sql = "SELECT
						REQ_NO 
					FROM TBL_REQUEST 
					WHERE 
						REQ_PIC=$user_no
						AND REQ_LSTATUS=5
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ_DEV='5'
					 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function flag_read_notif_waiting_done($user_no)
	{
		$sql = "SELECT 
						REQ_NO 
					FROM TBL_REQUEST 
					WHERE 
						REQ_PIC=$user_no
						AND REQ_LSTATUS=5
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ_DEV='5' ";
		$query = $this->db->GetArray($sql);
		if (!empty($query))
		{
			foreach ($query as $q)
			{
				$sql_flag = "UPDATE TBL_REQUEST
										SET REQ_NOTIF_READ_DEV='5-READ'
									WHERE REQ_NO='".$q['REQ_NO']."' 
										AND REQ_PIC=$user_no
										AND REQ_LSTATUS=5
										AND REQ_CANCEL=99
										AND REQ_NOTIF_READ_DEV='5' ";
				$query_flag = $this->db->Execute($sql_flag);
			}
			return true;
		}
	}
}

?>