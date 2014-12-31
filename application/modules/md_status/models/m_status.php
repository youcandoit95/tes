<?php

class M_status extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','default'=>'group'));
	}

	public function data_status()
	{
		$sql = "SELECT STATUS_NO, STATUS_NAME, STATUS_ACTIVE, STATUS_DELETED, STATUS_CREATED FROM TBL_STATUS WHERE STATUS_DELETED=99 AND STATUS_NO <> 99 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function insert_status($p_statusName)
	{
		$sql = "INSERT INTO TBL_STATUS (
					  STATUS_NO,
                      STATUS_NAME)
					VALUES (
						SEQ_STATUS.NEXTVAL, 
						'$p_statusName'
						) ";
		$insert = $this->db->Execute($sql);
		if ($insert)
		{
			return true;
		}
	}
	
	public function cek_exist($p_statusName)
	{
		$sql = "SELECT COUNT(STATUS_NAME) AS CEK FROM TBL_STATUS WHERE STATUS_NAME='$p_statusName' AND STATUS_DELETED = 99";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['CEK'];
		}
	}
	
	public function go_fed($id)
	{
		$sql = "SELECT STATUS_NO, STATUS_NAME, STATUS_ACTIVE FROM TBL_STATUS WHERE STATUS_NO=$id ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function update_dept($p_statusNo,$p_statusName)
	{
		$sql = "UPDATE TBL_STATUS SET STATUS_NAME='$p_statusName' WHERE STATUS_NO=$p_statusNo ";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return true;
		}
	}
	
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
	
	public function activate_status_ajax($id)
	{
		$sql_cek_activate = "SELECT STATUS_ACTIVE FROM TBL_STATUS WHERE STATUS_NO=$id ";
		$query_cek_activate = $this->db->GetArray($sql_cek_activate);
		foreach ($query_cek_activate as $qca)
		{
			$current = $qca['STATUS_ACTIVE'];
		}
		
		/*
		$sql_cek_used = "SELECT COUNT(STATUS_NO) AS USED FROM TBL_STATUS WHERE STATUS_NO=$id ";
		$query_cek_used = $this->db->GetArray($sql_cek_used);
		foreach ($query_cek_used as $qcu)
		{
			$used = $qcu['USED'];
		}*/
		
		
		if ($current==1)
		{
			$sql_activate = "UPDATE TBL_STATUS SET STATUS_ACTIVE=99 WHERE STATUS_NO='$id' ";
			$activate = $this->db->Execute($sql_activate);
			if ($activate)
			{return false;}
		}
		else
		{
			$sql_activate = "UPDATE TBL_STATUS SET STATUS_ACTIVE=1 WHERE STATUS_NO='$id' ";
			$activate = $this->db->Execute($sql_activate);
			if ($activate)
			{return true;}
		}
	}
}

?>