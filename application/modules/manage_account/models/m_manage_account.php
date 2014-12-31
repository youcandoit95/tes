<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_manage_account extends CI_Model
{
	public function change_pass($id,$old_pass,$new_pass)
	{
		$sql_cekcurrent = " SELECT user_pass FROM tbl_user WHERE user_pass='$old_pass' ";
		$query_cekcurrent = $this->db->query($sql_cekcurrent);
		$result_cekcurrent = $query_cekcurrent->num_rows();
		if ($result_cekcurrent<=0)
		{
			return false;
		}
		else
		{
			$sql_changepass = " UPDATE tbl_user SET user_pass='$new_pass' WHERE user_id='$id' ";
			$query_changepass = $this->db->query($sql_changepass);
			if ($query_changepass)
			{
				return true;
			}
		}
	}
}

?>