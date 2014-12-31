<?php

class M_request_type extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','default'=>'group'));
	}

	public function data_request_type()
	{
		$sql = "SELECT TYPE_NO, TYPE_NAME, TYPE_ACTIVE FROM TBL_REQUEST_TYPE WHERE TYPE_DELETED = 99 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function insert_request_type($p_reqType_name)
	{
		$sql = "INSERT INTO TBL_REQUEST_TYPE (TYPE_NO,TYPE_NAME) VALUES (SEQ_REQ_TYPE.NEXTVAL, '$p_reqType_name') ";
		$insert = $this->db->Execute($sql);
		if ($insert)
		{
			return true;
		}
	}
	
	public function cek_exist($p_reqType_name)
	{
		$sql = "SELECT COUNT(TYPE_NAME) AS CEK FROM TBL_REQUEST_TYPE WHERE TYPE_NAME='$p_reqType_name' AND TYPE_DELETED = 99";
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
		$sql = "SELECT TYPE_NO, TYPE_NAME FROM TBL_REQUEST_TYPE WHERE TYPE_NO=$id ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function update_request_type($p_reqType_no,$p_reqType_name)
	{
		$sql = "UPDATE TBL_REQUEST_TYPE SET TYPE_NAME='$p_reqType_name' WHERE TYPE_NO=$p_reqType_no ";
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
		$sql_cek_activate = "SELECT TYPE_ACTIVE FROM TBL_REQUEST_TYPE WHERE TYPE_NO=$id ";
		$query_cek_activate = $this->db->GetArray($sql_cek_activate);
		foreach ($query_cek_activate as $qca)
		{
			$current = $qca['TYPE_ACTIVE'];
		}
		
		$sql_cek_used = "SELECT COUNT(TYPE_NO) AS USED FROM TBL_REQUEST WHERE TYPE_NO=$id ";
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
			$sql_activate = "UPDATE TBL_REQUEST_TYPE SET TYPE_ACTIVE=1 WHERE TYPE_NO='$id' ";
			$activate = $this->db->Execute($sql_activate);
			if ($activate)
			{return true;}
		}
		else
		{
			if ($current==1)
			{
				$sql_activate = "UPDATE TBL_REQUEST_TYPE SET TYPE_ACTIVE=99 WHERE TYPE_NO='$id' ";
				$activate = $this->db->Execute($sql_activate);
				if ($activate)
				{return false;}
			}
			else
			{
				$sql_activate = "UPDATE TBL_REQUEST_TYPE SET TYPE_ACTIVE=1 WHERE TYPE_NO='$id' ";
				$activate = $this->db->Execute($sql_activate);
				if ($activate)
				{return true;}
			}
		}
	}
}

?>