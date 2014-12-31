<?PHP IF (!DEFINED('BASEPATH')) EXIT ('NO DIRECT SCRIPT ACCESS ALLOWED');

class M_sdh_notification extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function new_request()
	{
		$user_unit = $this->session->userdata('user_unit');
		$sql = "SELECT COUNT (REQ_NO) AS TOTAL_INCOMING_REQUEST
					  FROM TBL_REQUEST
					 WHERE REQ_PIC = 99
						 AND REQ_CANCEL = 99
						 AND CATEGORY_NO = $user_unit ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TOTAL_INCOMING_REQUEST'];
		}
	}
	
	public function new_request_detail($p_req_no)
	{
		$sql = "SELECT 
                        R.REQ_NO, 
                        R.REQ_NAME, 
                        R.TYPE_NO,
                        (SELECT TY.TYPE_NAME FROM TBL_REQUEST_TYPE TY WHERE TY.TYPE_NO=R.TYPE_NO) AS TYPE_NAME,
                        R.CATEGORY_NO,
                        (SELECT C.CATEGORY_NAME FROM TBL_REQUEST_CATEGORY C WHERE C.CATEGORY_NO=R.CATEGORY_NO) AS CATEGORY_NAME,
                        NVL(R.REF_NO,'N/A') AS REF_NO,
                        R.REQ_REASON, 
                        NVL(R.REQ_NOTE, 'N/A') AS REQ_NOTE,
						(SELECT P.PRIORITY_NAME FROM TBL_REQUEST_PRIORITY P WHERE P.PRIORITY_NO=R.PRIORITY_NO) AS PRIORITY_NAME,
						R.PRIORITY_REASON,
						NVL((SELECT S.STATUS_NAME FROM TBL_STATUS S WHERE S.STATUS_NO=R.REQ_LSTATUS),'N/A') AS STATUS,
						NVL(R.REQ_LSTATUS_REASON,'N/A') AS STATUS_REASON,
						U1.USER_FNAME
                    FROM TBL_REQUEST R, TBL_USER U1
                    WHERE R.REQ_NO = '$p_req_no' 
						AND R.REQ_BY = U1.USER_NO ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function cancel_request($user_no)
	{
		$sql = "SELECT 
						COUNT(REQ_NO) AS TOTAL 
					FROM TBL_REQUEST
					WHERE 
						REQ_PIC=$user_no
						AND REQ_LSTATUS=3
						AND REQ_CANCEL=1
						AND REQ_NOTIF_READ_DEV='3' ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TOTAL'];
		}
	}
	
	public function done_request($user_no)
	{
		$sql = "SELECT 
						COUNT(REQ_NO) AS TOTAL 
					FROM TBL_REQUEST
					WHERE 
						REQ_PIC=$user_no
						AND REQ_LSTATUS=1
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ_DEV='1' ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TOTAL'];
		}
	}
	
	public function revision_request($user_no)
	{
		$sql = "SELECT 
						COUNT(REQ_NO) AS TOTAL 
					FROM TBL_REQUEST
					WHERE 
						REQ_PIC=$user_no
						AND REQ_LSTATUS=6
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ_DEV='6' ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TOTAL'];
		}
	}
	
	public function detail_request($p_req_no)
	{
		$sql = "	 SELECT R.REQ_NO,
						 R.REQ_NAME,
						 R.TYPE_NO,
						 RT.TYPE_NAME,
						 R.PRIORITY_NO,
						 NVL (RP.PRIORITY_NAME, 'N/A') PRIORITY_NAME,
						 NVL (R.PRIORITY_REASON, 'N/A') PRIORITY_REASON,
						 R.CATEGORY_NO,
						 RC.CATEGORY_NAME,
						 NVL (R.REF_NO, 'N/A') REF_NO,
						 NVL (R.REQ_REASON, 'N/A') REQ_REASON,
						 NVL(R.REQ_NOTE, 'N/A') REQ_NOTE,
						 R.REQ_BY,
						 U.USER_FNAME AS REQ_BY_USERID,
						 R.REQ_TAKEN,
						 R.REQ_PIC,
						 NVL(UP.USER_FNAME, 'N/A') AS REQ_PIC_USERID,
						 R.REQ_LSTATUS,
						 S.STATUS_NAME,
						 NVL(R.REQ_LSTATUS_REASON, 'N/A') REQ_LSTATUS_REASON,
						 R.REQ_CANCEL,
						 TO_CHAR (R.REQ_CREATED, 'DD-MM-RRRR HH24:MI:SS') REQ_CREATED,
						 TO_CHAR (R.REQ_EST_TIME, 'DD-MM-RRRR HH24:MI:SS') REQ_EST_TIME,
						 TO_CHAR (R.REQ_LUPDATED, 'DD-MM-RRRR HH24:MI:SS') REQ_LUPDATED
					FROM TBL_REQUEST R,
						 (  SELECT TYPE_NO, TYPE_NAME FROM TBL_REQUEST_TYPE) RT,
						 (  SELECT PRIORITY_NO, PRIORITY_NAME FROM TBL_REQUEST_PRIORITY) RP,
						 (  SELECT CATEGORY_NO, CATEGORY_NAME FROM TBL_REQUEST_CATEGORY) RC,
						 (  SELECT USER_NO, USER_ID, USER_FNAME FROM TBL_USER) U,
						 (  SELECT USER_NO, USER_ID, USER_FNAME FROM TBL_USER) UP,
						 (  SELECT STATUS_NO, STATUS_NAME FROM TBL_STATUS) S
				   WHERE     R.TYPE_NO = RT.TYPE_NO
						 AND R.PRIORITY_NO = RP.PRIORITY_NO
						 AND R.CATEGORY_NO = RC.CATEGORY_NO
						 AND R.REQ_BY = U.USER_NO
						 AND R.REQ_PIC = UP.USER_NO
						 AND R.REQ_LSTATUS = S.STATUS_NO
						 AND R.REQ_NO = '$p_req_no' ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
}