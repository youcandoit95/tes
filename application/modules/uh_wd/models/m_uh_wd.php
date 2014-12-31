<?php if (!defined('BASEPATH')) exit ('No direct script allowed access');

class M_uh_wd extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function data_waiting_done_request($user_no)
	{
		$sess_login_level = $this->session->userdata('user_level');
		$filter_pic = $sess_login_level==4 ? "" : "AND R.REQ_BY = ".$this->session->userdata('user_no')."";
	
		$sql = "SELECT
						R.REQ_NO,
						R.REQ_NAME,
						T.TYPE_NAME,
						C.CATEGORY_NAME,
						R.REF_NO,
						U.USER_ID AS REQ_PIC,
						U2.USER_ID AS REQ_BY,
						R.REQ_LSTATUS,
						S.STATUS_NAME,
						S.CLASS_TABLE AS NOTIF,
						TO_CHAR(R.REQ_CREATED, 'DD-MM-RRRR') AS REQ_CREATED,
						F.FILE_DOC_SUPPORT,
						R.REQ_NOTIF_READ
					FROM TBL_REQUEST R, TBL_REQUEST_TYPE T, TBL_REQUEST_CATEGORY C, TBL_STATUS S, TBL_USER U, TBL_USER U2, TBL_REQUEST_FILE F
					WHERE
						R.TYPE_NO = T.TYPE_NO
						AND R.CATEGORY_NO = C.CATEGORY_NO
						AND R.REQ_LSTATUS = S.STATUS_NO
						AND R.REQ_PIC = U.USER_NO
						AND R.REQ_BY = U2.USER_NO
						AND R.REQ_NO = F.REQ_NO
						".$filter_pic."
						AND R.REQ_CANCEL=99
						AND R.REQ_LSTATUS=5
					ORDER BY R.REQ_NO DESC";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function recent_update_waiting_done($user_no)
	{
		$sql = "SELECT
						REQ_NO 
					FROM TBL_REQUEST 
					WHERE 
						REQ_BY=$user_no
						AND REQ_LSTATUS=5
						AND REQ_CANCEL=99
						AND REQ_NOTIF_READ='5'
					 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function flag_read_notif_waiting_done($user_no)
	{
		$sql_flag = "UPDATE TBL_REQUEST
								SET REQ_NOTIF_READ='5-READ'
							WHERE
								REQ_BY=$user_no
								AND REQ_LSTATUS=5
								AND REQ_CANCEL=99
								AND REQ_NOTIF_READ='5' ";
		$query_flag = $this->db->Execute($sql_flag);
		if ($query_flag)
		{
			return true;
		}
	}
	
	public function md_status_followUp_request()
	{
		$sql = "SELECT
						STATUS_NO, STATUS_NAME
					FROM TBL_STATUS
					WHERE
						STATUS_NO IN (1,6)
					   AND STATUS_ACTIVE = 1
					ORDER BY STATUS_NO ASC
					 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function set_done($p_req_no,$p_req_status,$user_no)
	{
		$sql = "UPDATE TBL_REQUEST 
						SET REQ_LSTATUS=$p_req_status,
							   REQ_NOTIF_READ=$p_req_status,
							   REQ_NOTIF_READ_DEV=$p_req_status,
							   REQ_LUPDATED=SYSDATE
					WHERE REQ_NO = '$p_req_no'
					";
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
							(HISTORY_NO, REQ_NO, REQ_STATUS, HISTORY_BY)
						VALUES 
							('$p_history_no','$p_req_no',$p_req_status,'$user_no')";
			$query = $this->db->Execute($sql);
			if ($query)
			{			
				return true;
			}
		}
	}
	
	public function set_done_w_uat($p_req_no,$p_req_status,$user_no,$file_upload)
	{
		$sql = "UPDATE TBL_REQUEST 
						SET REQ_LSTATUS=$p_req_status,
							   REQ_NOTIF_READ=$p_req_status,
							   REQ_NOTIF_READ_DEV=$p_req_status,
							   REQ_LUPDATED=SYSDATE
					WHERE REQ_NO = '$p_req_no'
					";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			// update request file - UAT
			$sql = "UPDATE
							TBL_REQUEST_FILE
						SET FILE_UAT='$file_upload'
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
								(HISTORY_NO, REQ_NO, REQ_STATUS, HISTORY_BY)
							VALUES 
								('$p_history_no','$p_req_no',$p_req_status,'$user_no')";
				$query = $this->db->Execute($sql);
				if ($query)
				{			
					return true;
				}
			}
		}
	}
	
	public function set_revision($p_req_no,$p_req_status,$p_req_reason,$user_no)
	{
		$sql = "UPDATE TBL_REQUEST 
						SET REQ_LSTATUS=$p_req_status,
							   REQ_LSTATUS_REASON='$p_req_reason',
							   REQ_NOTIF_READ=$p_req_status,
							   REQ_NOTIF_READ_DEV=$p_req_status,
							   REQ_LUPDATED=SYSDATE
					WHERE REQ_NO = '$p_req_no'
					";
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
							('$p_history_no','$p_req_no',$p_req_status,'$p_req_reason','$user_no')";
			$query = $this->db->Execute($sql);
			if ($query)
			{			
				return true;
			}
		}
	}
	
	public function get_req_type($p_req_no)
	{
		$sql = "SELECT TYPE_NO FROM TBL_REQUEST WHERE REQ_NO = '$p_req_no' ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TYPE_NO'];
		}
	}
}

?>