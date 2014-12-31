<?php

class M_request_category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','default'=>'group'));
	}

	public function data_request_category()
	{
		$sql = "SELECT CATEGORY_NO, CATEGORY_NAME, CATEGORY_ACTIVE FROM TBL_REQUEST_CATEGORY WHERE CATEGORY_DELETED = 99 ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function insert_request_category($p_reqCat_name)
	{
		$sql = "INSERT INTO TBL_REQUEST_CATEGORY (CATEGORY_NO,CATEGORY_NAME) VALUES (SEQ_REQ_CATEGORY.NEXTVAL, '$p_reqCat_name') ";
		$insert = $this->db->Execute($sql);
		if ($insert)
		{
			return true;
		}
	}
	
	public function cek_exist($p_reqCat_name)
	{
		$sql = "SELECT COUNT(CATEGORY_NAME) AS CEK FROM TBL_REQUEST_CATEGORY WHERE CATEGORY_NAME='$p_reqCat_name' AND CATEGORY_DELETED = 99";
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
		$sql = "SELECT CATEGORY_NO, CATEGORY_NAME FROM TBL_REQUEST_CATEGORY WHERE CATEGORY_NO=$id ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function update_request_category($p_reqCat_no,$p_reqCat_name)
	{
		$sql = "UPDATE TBL_REQUEST_CATEGORY SET CATEGORY_NAME='$p_reqCat_name' WHERE CATEGORY_NO=$p_reqCat_no ";
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
		$sql_cek_activate = "SELECT CATEGORY_ACTIVE FROM TBL_REQUEST_CATEGORY WHERE CATEGORY_NO=$id ";
		$query_cek_activate = $this->db->GetArray($sql_cek_activate);
		foreach ($query_cek_activate as $qca)
		{
			$current = $qca['CATEGORY_ACTIVE'];
		}
		
		$sql_cek_used = "SELECT COUNT(CATEGORY_NO) AS USED FROM TBL_REQUEST WHERE CATEGORY_NO=$id ";
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
			$sql_activate = "UPDATE TBL_REQUEST_CATEGORY SET CATEGORY_ACTIVE=1 WHERE CATEGORY_NO='$id' ";
			$activate = $this->db->Execute($sql_activate);
			if ($activate)
			{return true;}
		}
		else
		{
			if ($current==1)
			{
				$sql_activate = "UPDATE TBL_REQUEST_CATEGORY SET CATEGORY_ACTIVE=99 WHERE CATEGORY_NO='$id' ";
				$activate = $this->db->Execute($sql_activate);
				if ($activate)
				{return false;}
			}
			else
			{
				$sql_activate = "UPDATE TBL_REQUEST_CATEGORY SET CATEGORY_ACTIVE=1 WHERE CATEGORY_NO='$id' ";
				$activate = $this->db->Execute($sql_activate);
				if ($activate)
				{return true;}
			}
		}
	}
}

?>