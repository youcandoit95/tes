<?PHP if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_request_case extends CI_Model
{
	public function data_RC_default()
	{
		$query = $this->db->query(" SELECT * FROM tbl_requestcase WHERE requestCase_deleted='N' AND requestCase_active='Y' ");
		return $query->result();
	}

	public function data_RC()
	{
		$query = $this->db->query(" SELECT requestCase_id,requestCase_name,
			(SELECT tbl_requesttype.requestType_name from tbl_requesttype WHERE tbl_requesttype.requestType_id = tbl_requestcase.requestCase_type) as requestCase_type,
			requestCase_based,
			requestCase_active,
			requestCase_deleted
			FROM tbl_requestcase WHERE requestCase_deleted='N' ");
		return $query->result();
	}
	
	public function data_RT()
	{
		$query = $this->db->query(" SELECT * FROM tbl_requesttype WHERE requestType_deleted='N' AND requestType_active='Y' ");
		return $query->result();
	}
	
	public function insert_RC($rc_n,$rc_t,$rc_b)
	{
		$insert = $this->db->query(" INSERT INTO tbl_requestcase (requestCase_name,requestCase_type,requestCase_based) VALUES ('$rc_n','$rc_t','$rc_b') ");
		if ($insert)
		{return true;}
	}
	
	public function delete_RC($id)
	{
		$delete = $this->db->query(" UPDATE tbl_requestcase SET requestCase_deleted='Y' WHERE requestCase_id='$id' ");
		if ($delete)
		{return true;}
	}
	
	public function activate_RC($id)
	{
		$cek = $this->db->query(" SELECT requestCase_active,requestCase_type FROM tbl_requestcase WHERE requestCase_id='$id' ");
		foreach ($cek->result() as $c)
		{
			$current = $c->requestCase_active;
			$current_reqType = $c->requestCase_type;
		}
		if ($current=="Y")
		{
			$activate = $this->db->query(" UPDATE tbl_requestcase SET requestCase_active='N' WHERE requestCase_id='$id' ");
			if ($activate)
			{
				return false;
			}
		}
		else if ($current=="N")
		{
			$activate = $this->db->query(" UPDATE tbl_requestcase SET requestCase_active='Y' WHERE requestCase_id='$id' ");
			if ($activate)
			{
				$this->db->query(" UPDATE tbl_requesttype SET requestType_active='Y' WHERE requestType_id='$current_reqType' ");
				return true;
			}
		}
	}
}

?>