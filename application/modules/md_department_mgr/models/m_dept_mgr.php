<?php

class M_dept_mgr extends CI_Model
{
	public function dept_mgr_showrecord()
	{
		$query = $this->db->query(" SELECT
														  m.dept_mgr_id,
														  m.dept_id,
														  (SELECT tbl_dept.dept_name FROM tbl_dept WHERE tbl_dept.dept_id=m.dept_id) AS dept_name,
														  m.dept_mgr_name,m.dept_mgr_active
														FROM tbl_dept_mgr m 
														WHERE m.dept_mgr_deleted='N'; ");
		return $query->result();
	}
	
	public function insert_dept_mgr($dept_id,$mgr_name)
	{
		$insert = $this->db->query(" INSERT INTO tbl_dept_mgr (dept_id,dept_mgr_name) VALUES ('$dept_id','$mgr_name') "); 
		if ($insert)
		{
			return true;
		}
	}
	
	public function go_fed_mgr($id)
	{
		$go_fed = $this->db->query(" SELECT CONCAT_WS(':', 
																		dept_mgr_id,
																		(SELECT d.dept_name FROM tbl_dept d WHERE d.dept_id=m.dept_id),
																		m.dept_mgr_name
																		)
																		AS data
														FROM tbl_dept_mgr m 
														WHERE m.dept_mgr_id='$id' AND dept_mgr_deleted='N' ");
		return $go_fed->result();
	}
	
	public function update_dept_mgr($id,$new_mgr)
	{
		$update = $this->db->query(" UPDATE tbl_dept_mgr SET dept_mgr_name='$new_mgr' WHERE dept_mgr_id='$id' ");
		if ($update)
		{
			return true;
		}
	}
	
	public function delete_dept($id)
	{
		$delete = $this->db->query(" UPDATE tbl_dept SET dept_deleted = 'Y' WHERE dept_id ='$id' ");
		if ($delete)
		{
			return true;
		}
	}
	
	public function activate_dept($id)
	{
		$cek_activate = $this->db->query(" SELECT dept_active FROM tbl_dept WHERE dept_id='$id' ");
		foreach ($cek_activate->result() as $c)
		{
			$current = $c->dept_active;
		}
		if ($current=="Y")
		{
			$activate = $this->db->query(" UPDATE tbl_dept SET dept_active='N' WHERE dept_id='$id' ");
			if ($activate)
			{return true;}
		}
		else
		{
			$activate = $this->db->query(" UPDATE tbl_dept SET dept_active='Y' WHERE dept_id='$id' ");
			if ($activate)
			{return true;}
		}
	}
	
	public function activate_dept_mgr_ajax($id)
	{
		$cek_activate = $this->db->query(" SELECT dept_active FROM tbl_dept WHERE dept_id='$id' ");
		foreach ($cek_activate->result() as $c)
		{
			$current = $c->dept_active;
		}
		if ($current=="Y")
		{
			$activate = $this->db->query(" UPDATE tbl_dept SET dept_active='N' WHERE dept_id='$id' ");
			if ($activate)
			{return true;}
		}
		else
		{
			$activate = $this->db->query(" UPDATE tbl_dept SET dept_active='Y' WHERE dept_id='$id' ");
			if ($activate)
			{return false;}
		}
	}
}

?>