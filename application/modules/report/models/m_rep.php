<?php

CLASS M_rep EXTENDS CI_Model
{
	public function print_rep($id)
	{
		$sql = "SELECT * FROM tbl_report WHERE id=$id";
		$query = $this->db->query($sql);
		return $query->result();
	}
}

?>