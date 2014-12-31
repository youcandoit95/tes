<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{	
	public function log_in($p_user,$p_pass)
	{
		$sql = "SELECT
						karyawan_jabatan_no
					FROM hcis_md_karyawan
					WHERE (karyawan_nik = '$p_user' OR karyawan_email = '$p_user')
						AND karyawan_password = '$p_pass' ";
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $q)
		{
			$jabatan = $q['karyawan_jabatan_no'];
		}
		
		if (isset($jabatan))
		{
			return $jabatan;
		}
		else
		{
			return 999;
		}
	}
	
	public function data_user($p_user,$p_pass)
	{
		$sql = " SELECT
					  k.karyawan_nik,
					  k.karyawan_div_no, d.div_name as karyawan_div_name,
					  k.karyawan_dept_no, dp.dept_name as karyawan_dept_name,
					  k.karyawan_bagian_no, b.bagian_name as karyawan_bagian_name,
					  k.karyawan_fullname, 
					  k.karyawan_jabatan_no, j.jabatan_name as karyawan_jabatan_name,
					  k.karyawan_address, k.karyawan_phone1, k.karyawan_phone2, k.karyawan_email
					FROM hcis_md_karyawan k left outer join hcis_md_bagian b on k.karyawan_bagian_no = b.bagian_no,
						hcis_md_div d, hcis_md_dept dp, hcis_md_jabatan j
					WHERE (karyawan_nik = '$p_user' OR karyawan_email = '$p_user')
					  AND karyawan_password = '$p_pass'
					  AND k.karyawan_deleted = 99
					  AND d.div_no = k.karyawan_div_no
					  AND dp.dept_no = k.karyawan_dept_no
					  AND j.jabatan_no = k.karyawan_jabatan_no ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/*
	function check_user($email, $pass2){
		
		$query = $this->db->query("SELECT * FROM jner_users WHERE email ='$email' AND password = '$pass2' AND active = 0");
		return $query->num_rows();
	}
	
	function get_user($email, $pass2){
		$query = $this->db->query("SELECT * FROM jner_users WHERE email ='$email' AND password = '$pass2' AND active = 0");
		return $query->result();
	}
	
	public function data_dept()
	{
		$query = $this->db->query(" SELECT * FROM tbl_dept WHERE dept_deleted='N' AND dept_active='Y' AND dept_SD IS NULL ORDER BY dept_name ASC ");
		return $query->result();
	}
	
	public function login($u,$real_pass)
	{
		$login = $this->db->query(" SELECT * FROM tbl_user WHERE user_name='$u' AND user_pass='$real_pass' AND user_active='Y'");
		return $login->num_rows();
	}
	
	public function user_login($u,$real_pass)
	{
		$data_user = $this->db->query(" SELECT * FROM tbl_user WHERE user_name='$u' AND user_pass='$real_pass' ");
		return $data_user->result();
	}
	
	public function SD_login($dept_login)
	{
		$SD_login = $this->db->query(" SELECT dept_SD FROM tbl_dept WHERE dept_id='$dept_login' ");
		return $SD_login->result();
	}*/
}
?>