<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_personal_message extends CI_Model
{
	public function json($key,$response)
	{
		$sql = "SELECT tbl_user.user_id,
					   tbl_user.user_name,
					   tbl_user.user_email,
					   tbl_user.user_fullName,
					   (SELECT tbl_dept.dept_name FROM tbl_dept WHERE tbl_dept.dept_id=tbl_user.user_dept) as user_dept,
					   tbl_user.user_phonePersonal
				  FROM tbl_user
				  WHERE (tbl_user.user_name LIKE '%$key%'
					OR tbl_user.user_email LIKE '%$key%'
					OR tbl_user.user_fullName LIKE '%$key%'
					OR tbl_user.user_phoneOffice LIKE '%$key%')
					AND tbl_user.user_active <> 'N'";
		$query = $this->db->query($sql);
		if ($response=="data")
		{
			return $query->result();
		}
		else if ($response=="row")
		{
			return $query->num_rows();
		}
	}

	/*
	public function new_conversation($sender_id,$receiver_id,$subject,$message)
	{
		$waktu = date('Y-m-d h:i:s');
		$sql_insert_master = "INSERT INTO tbl_personal_message (
										PM_SENDER_ID
										,PM_RECEIVER_ID
										,PM_SUBJECT
										,PM_CREATED
									) VALUES (
										$sender_id
										,$receiver_id
										,'$subject'
										,'$waktu'
									)";
		$query_insert_master = $this->db->query($sql_insert_master);
		if ($query_insert_master)
		{
			$sql_getmaster = "SELECT PM_ID	
										FROM tbl_personal_message				
										WHERE PM_SENDER_ID='$sender_id'
										ORDER BY PM_ID DESC";
			$query_getmaster = $this->db->query($sql_getmaster);
			if ($query_getmaster)
			{
				foreach ($query_getmaster as $)
				$sql_insert_detail = "INSERT INTO tbl_detail_personal_message (
											   PM_ID
											  ,PM_SENDER_ID
											  ,PM_RECEIVER_ID
											  ,PM_MESSAGE
											  ,PM_SEND_DATE
											  ,PM_RECEIV_DATE
											  ,PM_DELETED
											) VALUES (
											   $  
											  ,0   -- PM_MID - IN bigint(20)
											  ,0   -- PM_SENDER_ID - IN int(11)
											  ,0   -- PM_RECEIVER_ID - IN int(11)
											  ,''  -- PM_MESSAGE - IN text
											  ,''  -- PM_SEND_DATE - IN date
											  ,''  -- PM_RECEIV_DATE - IN date
											  ,0   -- PM_DELETED - IN int(11)
											)";
			}
		}
	}*/
}

?>