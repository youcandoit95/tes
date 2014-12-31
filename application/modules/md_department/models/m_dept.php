<?php

class M_dept extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','default'=>'group'));
	}

	public function dept_showrecord()
	{
		$sql = "SELECT DEPT_NO, DEPT_NAME, DEPT_MGR_NAME, DEPT_EMAIL, DEPT_PHONE, DEPT_ACTIVE FROM TBL_DEPT WHERE DEPT_ACTIVE=1 AND DEPT_DELETED=99 AND DEPT_NO <> 888";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function insert_dept($p_deptName,$p_deptMgrName,$p_deptEmail,$p_deptPhone)
	{
		$sql = "INSERT INTO TBL_DEPT (
					  DEPT_NO,
                      DEPT_NAME,
                      DEPT_MGR_NAME,
                      DEPT_EMAIL,
                      DEPT_PHONE)
					VALUES (
						SEQ_DEPT.NEXTVAL, 
						'$p_deptName',
						'$p_deptMgrName',
						'$p_deptEmail',
						'$p_deptPhone') ";
		$insert = $this->db->Execute($sql);
		if ($insert)
		{
			return true;
		}
	}
	
	public function cek_exist($p_deptName)
	{
		$sql = "SELECT COUNT(DEPT_NAME) AS CEK FROM TBL_DEPT WHERE DEPT_NAME='$p_deptName' AND DEPT_DELETED = 99";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['CEK'];
		}
	}
	
	public function go_fed($id)
	{
		$sql = "SELECT DEPT_NO, DEPT_NAME, DEPT_MGR_NAME, DEPT_EMAIL, DEPT_PHONE FROM TBL_DEPT WHERE DEPT_NO=$id";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function update_dept($p_deptNo,$p_deptName, $p_deptMgrName, $p_deptEmail, $p_deptPhone)
	{
		$sql = "UPDATE TBL_DEPT SET DEPT_NAME='$p_deptName', DEPT_MGR_NAME='$p_deptMgrName', DEPT_EMAIL='$p_deptEmail', DEPT_PHONE='$p_deptPhone' WHERE DEPT_NO=$p_deptNo ";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function delete_dept($id)
	{
		$sql = "UPDATE TBL_DEPT SET DEPT_DELETED=1 WHERE DEPT_NO=$id ";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function activate_dept_ajax($id)
	{
		$sql_cek_activate = "SELECT DEPT_ACTIVE FROM TBL_DEPT WHERE DEPT_NO='$id' ";
		$query_cek_activate = $this->db->GetArray($sql_cek_activate);
		foreach ($query_cek_activate as $qca)
		{
			$current = $qca['DEPT_ACTIVE'];
		}
		
		$sql_cek_used = "SELECT COUNT(DEPT_NO) AS USED FROM TBL_USER WHERE DEPT_NO=$id";
		$query_cek_used = $this->db->GetArray($sql_cek_used);
		foreach ($query_cek_used as $qcu)
		{
			$used = $qcu['USED'];
		}
		
		if ($current==1&&$used==0)
		{
			$sql_activate = "UPDATE TBL_DEPT SET DEPT_ACTIVE=99 WHERE DEPT_NO='$id' ";
			$activate = $this->db->Execute($sql_activate);
			if ($activate)
			{return false;}
		}
		else
		{
			$sql_activate = "UPDATE TBL_DEPT SET DEPT_ACTIVE=1 WHERE DEPT_NO='$id' ";
			$activate = $this->db->Execute($sql_activate);
			if ($activate)
			{return true;}
		}
	}
}

?>