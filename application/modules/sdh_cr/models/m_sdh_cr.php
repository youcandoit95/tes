<?php if (!defined('BASEPATH')) exit ('No direct script allowed access');

class M_sdh_cr extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function data_cancel_request($user_no)
	{
		$sql = "SELECT 
						R.REQ_NO, 
						R.REQ_NAME, 
						(SELECT TY.TYPE_NAME FROM TBL_REQUEST_TYPE TY WHERE TY.TYPE_NO=R.TYPE_NO) AS TYPE_NAME,
						(SELECT C.CATEGORY_NAME FROM TBL_REQUEST_CATEGORY C WHERE C.CATEGORY_NO=R.CATEGORY_NO) AS CATEGORY_NAME,
						NVL(R.REF_NO,'N/A') AS REF_NO,
						R.REQ_REASON, 
						R.REQ_NOTE,
						NVL((SELECT USR.USER_FNAME FROM TBL_USER USR WHERE USR.USER_NO=R.REQ_PIC),'N/A') AS PIC_FNAME,
						NVL((SELECT S.STATUS_NAME FROM TBL_STATUS S WHERE S.STATUS_NO=R.REQ_LSTATUS),'N/A') AS STATUS,
						NVL(R.REQ_LSTATUS_REASON,'N/A') AS STATUS_REASON,
						DECODE(TO_CHAR(REQ_EST_TIME,'DD-MM-RRRR HH24:MI:SS'),NULL,'N/A',TO_CHAR(REQ_EST_TIME,'DD-MM-RRRR HH24:MI:SS')) AS REQ_EST_TIME,
						(SELECT F.FILE_DOC_SUPPORT FROM TBL_REQUEST_FILE F WHERE F.REQ_NO = R.REQ_NO) AS F_DOC_SUPPORT
					FROM TBL_REQUEST R
					WHERE R.REQ_PIC=$user_no 
						AND R.REQ_CANCEL=1
						AND R.REQ_LSTATUS=3
					ORDER BY R.REQ_NO DESC";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function recent_update_cancel_request($user_no)
	{
		$sql = "SELECT
						REQ_NO 
					FROM TBL_REQUEST 
					WHERE 
						REQ_PIC=$user_no
						AND REQ_LSTATUS=3
						AND REQ_CANCEL=1
						AND REQ_NOTIF_READ_DEV='3'
					 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function flag_read_notif_cancel($user_no)
	{
		$sql = "SELECT 
						REQ_NO 
					FROM TBL_REQUEST 
					WHERE 
						REQ_PIC=$user_no
						AND REQ_LSTATUS=3
						AND REQ_CANCEL=1
						AND REQ_NOTIF_READ_DEV='3' "; 
		$query = $this->db->GetArray($sql);
		if (!empty($query))
		{
			foreach ($query as $q)
			{
				$sql_flag = "UPDATE TBL_REQUEST
										SET REQ_NOTIF_READ_DEV='3-READ'
									WHERE REQ_NO='".$q['REQ_NO']."' 
										AND REQ_PIC=$user_no
										AND REQ_LSTATUS=3
										AND REQ_CANCEL=1
										AND REQ_NOTIF_READ_DEV='3' ";
				$query_flag = $this->db->Execute($sql_flag);
			}
			return true;
		}
	}
}

?>