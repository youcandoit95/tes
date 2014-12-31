<?php

class M_ajax_data_karyawan extends CI_Model
{		
	public function data_karyawan($p_nik)
	{
		$sql = " SELECT
					  k.karyawan_nik,
					  k.karyawan_div_no, d.div_name as karyawan_div_name,
					  k.karyawan_dept_no, dp.dept_name as karyawan_dept_name,
					  k.karyawan_bagian_no, b.bagian_name as karyawan_bagian_name,
					  k.karyawan_jabatan_no, j.jabatan_name as karyawan_jabatan_name,
					  k.karyawan_fullname, 
					  k.karyawan_address, k.karyawan_phone1, k.karyawan_phone2, k.karyawan_email
					FROM hcis_md_karyawan k left outer join hcis_md_bagian b on k.karyawan_bagian_no = b.bagian_no,
						hcis_md_div d, hcis_md_dept dp, hcis_md_jabatan j
					WHERE
					  k.karyawan_nik = '$p_nik'
					  AND d.div_no = k.karyawan_div_no
					  AND dp.dept_no = k.karyawan_dept_no
					  AND j.jabatan_no = k.karyawan_jabatan_no ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}