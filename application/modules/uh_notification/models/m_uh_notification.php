<?PHP IF (!DEFINED('BASEPATH')) EXIT ('NO DIRECT SCRIPT ACCESS ALLOWED');

class M_uh_notification extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function on_process_request($user_no)
	{
		$sql = "SELECT 
						COUNT(REQ_NO) AS TOTAL
					FROM TBL_REQUEST
					WHERE REQ_BY=$user_no
						AND REQ_LSTATUS=4
						AND REQ_TAKEN=1
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ='4' ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TOTAL'];
		}
	}
	
	public function request_detail($p_req_no,$user_no)
	{
		$sql = "SELECT 
                        R.REQ_NO, 
                        R.REQ_NAME, 
						R.TYPE_NO,
                        (SELECT TY.TYPE_NAME FROM TBL_REQUEST_TYPE TY WHERE TY.TYPE_NO=R.TYPE_NO) AS TYPE_NAME,
                        (SELECT C.CATEGORY_NAME FROM TBL_REQUEST_CATEGORY C WHERE C.CATEGORY_NO=R.CATEGORY_NO) AS CATEGORY_NAME,
                        NVL(R.REF_NO,'N/A') AS REF_NO,
						(SELECT P.PRIORITY_NAME FROM TBL_REQUEST_PRIORITY P WHERE P.PRIORITY_NO=R.PRIORITY_NO) AS PRIORITY_NAME,
						R.PRIORITY_REASON,
						NVL((SELECT USR.USER_FNAME FROM TBL_USER USR WHERE USR.USER_NO=R.REQ_PIC),'N/A') AS PIC_FNAME,
						NVL((SELECT S.STATUS_NAME FROM TBL_STATUS S WHERE S.STATUS_NO=R.REQ_LSTATUS),'N/A') AS STATUS,
						NVL(R.REQ_LSTATUS_REASON,'N/A') AS STATUS_REASON,
						DECODE(R.REQ_EST_TIME,NULL,'N/A',TO_CHAR(R.REQ_EST_TIME, 'DD-MM-RRRR HH24:MI:SS')) AS REQ_EST_TIME,
						(SELECT F.FILE_DOC_SUPPORT FROM TBL_REQUEST_FILE F WHERE F.REQ_NO = R.REQ_NO) AS F_DOC_SUPPORT,
                        R.REQ_REASON, 
                        NVL(R.REQ_NOTE, 'N/A') AS REQ_NOTE
                    FROM TBL_REQUEST R
                    WHERE R.REQ_NO = '$p_req_no' 
						AND R.REQ_BY=$user_no";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function waiting_done_confirmation($user_no)
	{
		$sql = "SELECT 
						COUNT(REQ_NO) AS TOTAL
					FROM TBL_REQUEST
					WHERE REQ_BY=$user_no
						AND REQ_LSTATUS=5
						AND REQ_TAKEN=1
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ='5' ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TOTAL'];
		}
	}
	
	public function hold_request($user_no)
	{
		$sql = "SELECT 
						COUNT(REQ_NO) AS TOTAL
					FROM TBL_REQUEST
					WHERE REQ_BY=$user_no
						AND REQ_LSTATUS=2
						AND REQ_TAKEN=1
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ='2' ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TOTAL'];
		}
	}
}