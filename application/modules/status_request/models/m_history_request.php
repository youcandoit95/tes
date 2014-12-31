<?php
Class M_history_request extends CI_Model
{
	public function cancel($reqid,$idlog,$reason,$sekarang)
	{
		$sql_log = "INSERT INTO tbl_request_history (request_id, event, event_reason, by_user, history_created)
							VALUES ('$reqid','cancel request','$reason','$idlog','$sekarang')";
		$insert_log = $this->db->query($sql_log);
	}
	
	public function hold($reqid,$idlog,$reason,$sekarang)
	{
		$sql_log = "INSERT INTO tbl_request_history (request_id, event, event_reason, by_user, history_created)
							VALUES ('$reqid','hold request','$reason','$idlog','$sekarang')";
		$insert_log = $this->db->query($sql_log);
	}
	
	public function sent_done($reqid,$idlog,$sekarang)
	{
		$sql_log = "INSERT INTO tbl_request_history (request_id, event, by_user, history_created)
							VALUES ('$reqid','sent done request','$idlog','$sekarang')";
		$insert_log = $this->db->query($sql_log);
	}
	
	public function done($reqid,$idlog,$sekarang)
	{
		$sql_log = "INSERT INTO tbl_request_history (request_id, event, by_user, history_created)
							VALUES ('$reqid','done request','$idlog','$sekarang')";
		$insert_log = $this->db->query($sql_log);
	}
	
	public function on_process($reqid,$idlog,$sekarang)
	{
		$sql_log = "INSERT INTO tbl_request_history (request_id, event, by_user, history_created)
							VALUES ('$reqid','on process request','$idlog','$sekarang')";
		$insert_log = $this->db->query($sql_log);
	}
	
	public function sent_revision($reqid,$idlog,$reason,$sekarang)
	{
		$sql_log = "INSERT INTO tbl_request_history (request_id, event, event_reason, by_user, history_created)
							VALUES ('$reqid','sent revision request','$reason','$idlog','$sekarang')";
		$insert_log = $this->db->query($sql_log);
	}
}
?>