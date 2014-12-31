<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_md_followup_request extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function set_waiting_done($p_req_no,$user_no,$p_req_done_note_pic)
	{
		$sql = "UPDATE TBL_REQUEST 
					SET
						 REQ_LSTATUS=5,
						 REQ_NOTIF_READ=5,
						 REQ_NOTIF_READ_DEV=5,
						 REQ_LSTATUS_REASON='',
						 REQ_LUPDATED=SYSDATE,
						 REQ_DONE_NOTE_PIC = '$p_req_done_note_pic'
					WHERE 
						REQ_NO='$p_req_no'
						AND REQ_PIC=$user_no";
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
			
			// create history
			$sql = "INSERT INTO TBL_REQUEST_HISTORY
							(HISTORY_NO, REQ_NO, REQ_STATUS, HISTORY_BY)
						VALUES 
							('$p_history_no','$p_req_no',5,'$user_no')";
			$query = $this->db->Execute($sql);
			if ($query)
			{			
				return true;
			}
		}
		else
		{
			echo $sql;
		}
	}
	
	public function set_hold($p_req_no,$user_no,$p_req_reason)
	{
		$sql = "UPDATE TBL_REQUEST 
					SET
						 REQ_LSTATUS=2,
						 REQ_NOTIF_READ=2,
						 REQ_NOTIF_READ_DEV=2,
						 REQ_LSTATUS_REASON='$p_req_reason',
						 REQ_LUPDATED=SYSDATE
					WHERE 
						REQ_NO='$p_req_no'
						AND REQ_PIC=$user_no";
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
							(HISTORY_NO, REQ_NO, REQ_STATUS, REQ_STATUS_REASON, HISTORY_BY)
						VALUES 
							('$p_history_no','$p_req_no',2,'$p_req_reason','$user_no')";
			$query = $this->db->Execute($sql);
			if ($query)
			{			
				return true;
			}
		}
	}
}

?>