<?php

class M_md_developer extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','default'=>'group'));
	}

	public function data_request_priority()
	{
		$sql = "SELECT PRIORITY_NO, PRIORITY_NAME FROM TBL_REQUEST_PRIORITY WHERE PRIORITY_DELETED = 99 AND PRIORITY_ACTIVE=1 ORDER BY PRIORITY_NO ASC";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function data_status()
	{
		$sql = "SELECT
						STATUS_NO, STATUS_NAME
					FROM TBL_STATUS
					WHERE
						STATUS_NO IN (1,2)
					AND STATUS_ACTIVE = 1
					ORDER BY STATUS_NO ASC ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
}

?>