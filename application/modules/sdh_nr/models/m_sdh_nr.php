<?PHP IF (!DEFINED('BASEPATH')) EXIT ('NO DIRECT SCRIPT ACCESS ALLOWED');

class M_sdh_nr extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function data_new_request($user_no)
	{
		$user_unit = $this->session->userdata('user_unit');
		$sess_login_level = $this->session->userdata('user_level');
		
		if ($sess_login_level==3)
		{
			$user_unit = "";
		}
	
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
						AND R.REQ_PIC=99 
						AND R.REQ_CANCEL=99 
						AND R.CATEGORY_NO LIKE '%$user_unit%' ";
						
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function take_request($p_req_no,$p_req_est_time,$p_req_priority,$p_req_priority_reason)
	{
		$user_no = $this->session->userdata('user_no');
		$sql = "UPDATE TBL_REQUEST SET 
						PRIORITY_NO='$p_req_priority',
						PRIORITY_REASON='$p_req_priority_reason',
						REQ_LSTATUS=4,
						REQ_NOTIF_READ=4,
						REQ_TAKEN=1,
						REQ_PIC='$user_no',
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
							(HISTORY_NO, REQ_NO, REQ_STATUS, HISTORY_BY, REQ_EST_TIME)
						VALUES 
							('$p_history_no','$p_req_no',4,'$user_no',TO_DATE('$p_req_est_time','DD-MM-RRRR HH24:MI:SS'))";
			$query = $this->db->Execute($sql);
			if ($query)
			{			
				return true;
			}
		}
		else
		{
			echo "1";
		}
	}
}