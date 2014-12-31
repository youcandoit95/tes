<?php

class M_request_priority extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','default'=>'group'));
	}

	public function data_request_priority()
	{
		$sql = "SELECT PRIORITY_NO, PRIORITY_NAME, PRIORITY_ACTIVE FROM TBL_REQUEST_PRIORITY WHERE PRIORITY_DELETED = 99 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function insert_request_priority($p_reqPrior_name)
	{
		$sql = "INSERT INTO TBL_REQUEST_PRIORITY (PRIORITY_NO,PRIORITY_NAME) VALUES (SEQ_REQ_PRIORITY.NEXTVAL, '$p_reqPrior_name') ";
		$insert = $this->db->Execute($sql);
		if ($insert)
		{
			return true;
		}
	}
	
	public function cek_exist($p_reqPrior_name)
	{
		$sql = "SELECT COUNT(PRIORITY_NAME) AS CEK FROM TBL_REQUEST_PRIORITY WHERE PRIORITY_NAME='$p_reqPrior_name' AND PRIORITY_DELETED = 99";
		$query = $this->db->GetArray($sql);
		if (empty($query))
		{
			return 0;
		}
		else
		{
			foreach ($query as $q)
			{
				return $q['CEK'];
			}
		}
	}
	
	public function go_fed($id)
	{
		$sql = "SELECT PRIORITY_NO, PRIORITY_NAME FROM TBL_REQUEST_PRIORITY WHERE PRIORITY_NO=$id ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function update_request_priority($p_reqPrior_no,$p_reqPrior_name)
	{
		$sql = "UPDATE TBL_REQUEST_PRIORITY SET PRIORITY_NAME='$p_reqPrior_name' WHERE PRIORITY_NO=$p_reqPrior_no ";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return true;
		}
	}
	/*
	public function delete_status($id)
	{
		$sql = "UPDATE TBL_STATUS SET STATUS_DELETED=1 WHERE STATUS_NO=$id ";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function cek_used($p_statusNo)
	{
		$sql = "SELECT 
						SUM(
						(SELECT COUNT(R.REQ_LSTATUS) FROM TBL_REQUEST R WHERE R.REQ_LSTATUS=1)+ --AS REQUEST,
						(SELECT COUNT(H.REQ_STATUS) FROM TBL_REQUEST_HISTORY H WHERE H.REQ_STATUS=1) ) --AS HISTORY
						AS CEK_USED_STATUS
					 FROM DUAL ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['CEK_USED_STATUS'];
		}
	}
	*/
	public function activate_status_ajax($id)
	{
		$sql_cek_activate = "SELECT PRIORITY_ACTIVE FROM TBL_REQUEST_PRIORITY WHERE PRIORITY_NO=$id ";
		$query_cek_activate = $this->db->GetArray($sql_cek_activate);
		foreach ($query_cek_activate as $qca)
		{
			$current = $qca['PRIORITY_ACTIVE'];
		}
		
		$sql_cek_used = "SELECT COUNT(PRIORITY_NO) AS USED FROM TBL_REQUEST WHERE PRIORITY_NO=$id ";
		$query_cek_used = $this->db->GetArray($sql_cek_used);
		if (empty($query_cek_used))
		{
			$used = 0;
		}
		else
		{
			foreach ($query_cek_used as $qcu)
			{
				$used = $qcu['USED'];
			}
		}
		
		if ($used > 0)
		{
			$sql_activate = "UPDATE TBL_REQUEST_PRIORITY SET PRIORITY_ACTIVE=1 WHERE PRIORITY_NO='$id' ";
			$activate = $this->db->Execute($sql_activate);
			if ($activate)
			{return true;}
		}
		else
		{
			if ($current==1)
			{
				$sql_activate = "UPDATE TBL_REQUEST_PRIORITY SET PRIORITY_ACTIVE=99 WHERE PRIORITY_NO='$id' ";
				$activate = $this->db->Execute($sql_activate);
				if ($activate)
				{return false;}
			}
			else
			{
				$sql_activate = "UPDATE TBL_REQUEST_PRIORITY SET PRIORITY_ACTIVE=1 WHERE PRIORITY_NO='$id' ";
				$activate = $this->db->Execute($sql_activate);
				if ($activate)
				{return true;}
			}
		}
	}
}

?>