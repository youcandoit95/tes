<?php
class M_bug_report extends CI_Model
{	
	public function send_bug_report($p_bug_desc, $sess_nik)
	{
		$sql = " INSERT INTO bug_report(karyawan_nik, bug_desc)
										VALUES ('$sess_nik', '$p_bug_desc') ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
}