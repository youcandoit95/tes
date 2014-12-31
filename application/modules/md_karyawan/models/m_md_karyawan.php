<?php

class M_md_karyawan extends CI_Model
{		
	public function md_jabatan()
	{
		$sql = " SELECT 
					  jabatan_no, jabatan_name
					FROM hcis_md_jabatan
					WHERE jabatan_deleted = 99 
					  AND jabatan_no NOT IN ('88','99') ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function md_division()
	{
		$sql = " SELECT 
					  div_no, div_name
					FROM hcis_md_div
					WHERE
					  div_no NOT IN ('88','99')
					  AND div_active = 1
					  AND div_deleted = 99 ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function md_dept($p_div_no)
	{
		$sql = " SELECT 
					  dept_no, dept_name
					FROM hcis_md_dept
					WHERE dept_div_no = $p_div_no
					  AND dept_active = 1
					  AND dept_deleted = 99
					  AND dept_no NOT IN ('88','99') ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function md_bagian($p_div_no, $p_dept_no)
	{
		$sql = " SELECT
					  bagian_no, bagian_name
					FROM hcis_md_bagian
					WHERE
					  bagian_div_no = $p_div_no
					  AND bagian_dept_no = $p_dept_no
					  AND bagian_active = 1
					  AND bagian_deleted = 99 ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function data_user()
	{
		$sql = " SELECT
					  k.karyawan_nik,
					  k.karyawan_div_no, d.div_name as karyawan_div_name,
					  k.karyawan_dept_no, dp.dept_name as karyawan_dept_name,
					  k.karyawan_bagian_no, b.bagian_name as karyawan_bagian_name,
					  k.karyawan_jabatan_no, j.jabatan_name as karyawan_jabatan_name,
					  k.karyawan_fullname, 
					  k.karyawan_address, k.karyawan_phone1, k.karyawan_phone2, k.karyawan_email,
					  k.karyawan_get_cuti
					FROM hcis_md_karyawan k left outer join hcis_md_bagian b on k.karyawan_bagian_no = b.bagian_no,
						hcis_md_div d, hcis_md_dept dp, hcis_md_jabatan j
					WHERE
					  k.karyawan_deleted = 99
					  AND k.karyawan_jabatan_no <> '88'
					  AND d.div_no = k.karyawan_div_no
					  AND dp.dept_no = k.karyawan_dept_no
					  AND j.jabatan_no = k.karyawan_jabatan_no ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function detail_karyawan($p_nik)
	{
		$sql = " SELECT
					  k.karyawan_nik,
					  k.karyawan_div_no, d.div_name as karyawan_div_name,
					  k.karyawan_dept_no, dp.dept_name as karyawan_dept_name,
					  k.karyawan_bagian_no, b.bagian_name as karyawan_bagian_name,
					  k.karyawan_jabatan_no, j.jabatan_name as karyawan_jabatan_name,
					  k.karyawan_fullname, 
					  k.karyawan_address, k.karyawan_phone1, k.karyawan_phone2, k.karyawan_email,
					  k.karyawan_get_cuti
					FROM hcis_md_karyawan k left outer join hcis_md_bagian b on k.karyawan_bagian_no = b.bagian_no,
						hcis_md_div d, hcis_md_dept dp, hcis_md_jabatan j
					WHERE
					  k.karyawan_deleted = 99
					  AND k.karyawan_nik = '$p_nik'
					  AND d.div_no = k.karyawan_div_no
					  AND dp.dept_no = k.karyawan_dept_no
					  AND j.jabatan_no = k.karyawan_jabatan_no ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function FED_User($id)
	{
		$sql = "SELECT 
						LEVEL_NO,
						USER_ID,
						DEPT_NO,
						CATEGORY_NO,
						USER_FNAME,
						USER_NICKNAME,
						USER_EMAIL,
						USER_PHONE
					FROM TBL_USER
					WHERE USER_NO = $id
					";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function nonAndActivate_user($id)
	{
		$sql = "SELECT USER_ACTIVE FROM TBL_USER WHERE USER_NO='$id'";
		$cek = $this->db->GetArray($sql);
		foreach ($cek as $c)
		{
			$currentActive = $c['USER_ACTIVE'];
		}
		
		$sql_cek_used = "SELECT COUNT(REQ_PIC) AS USED FROM TBL_REQUEST WHERE REQ_PIC=$id AND REQ_LSTATUS <> 1 ";
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
			$sql_activate = "UPDATE TBL_USER SET USER_ACTIVE=1 WHERE USER_NO='$id' ";
			$activate = $this->db->Execute($sql_activate);
			if ($activate)
			{
				return "1";
			}
		}
		else
		{
			if ($currentActive==1)
			{
				$nonAndActivate_user = $this->db->query(" UPDATE TBL_USER SET USER_ACTIVE=99 WHERE USER_NO='$id' ");
				if ($nonAndActivate_user)
				{
					return "99";
				}
			}
			else
			{
				$nonAndActivate_user = $this->db->query(" UPDATE TBL_USER SET USER_ACTIVE=1 WHERE USER_NO='$id' ");
				if ($nonAndActivate_user)
				{
					return "1";
				}
			}
		}
	}
	
	public function update_users($p_user_no, $p_department, $p_user_fname, $p_user_nname, $p_user_email, $p_user_phone, $p_user_level, $p_user_unit)
	{
		$sql = "UPDATE TBL_USER
					   SET DEPT_NO = $p_department,
						   USER_FNAME = '$p_user_fname',
						   USER_NICKNAME = '$p_user_nname',
						   USER_EMAIL = '$p_user_email',
						   USER_PHONE = '$p_user_phone',
						   LEVEL_NO = $p_user_level,
						   CATEGORY_NO = '$p_user_unit'
					 WHERE USER_NO = '$p_user_no' ";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function karyawan_baru($p_karyawan_nik, $p_karyawan_password, $p_karyawan_div_no,$p_karyawan_dept_no, $p_karyawan_bagian_no, $p_karyawan_jabatan_no, $p_karyawan_fullname, $p_tanggal_lahir, $p_karyawan_address, $p_karyawan_phone1, $p_karyawan_phone2, $p_karyawan_email, $p_karyawan_dapat_cuti)
	{
		$sess_karyawan_nik = $this->session->userdata('karyawan_nik');
		
		$p_tanggal_lahir = date('Y-m-d', strtotime($p_tanggal_lahir));
		
		$sql = "	INSERT INTO hcis_md_karyawan (karyawan_nik,
										  karyawan_password,
										  karyawan_div_no,
										  karyawan_dept_no,
										  karyawan_bagian_no,
										  karyawan_jabatan_no,
										  karyawan_fullname,
										  karyawan_tanggal_lahir,
										  karyawan_address,
										  karyawan_phone1,
										  karyawan_phone2,
										  karyawan_email,
										  karyawan_get_cuti,
										  get_cuti_lupdated,
										  karyawan_created_by,
										  karyawan_created_date)
						 VALUES ('$p_karyawan_nik',
								 '$p_karyawan_password',
								 '$p_karyawan_div_no',
								 '$p_karyawan_dept_no',
								 '$p_karyawan_bagian_no',
								 '$p_karyawan_jabatan_no',
								 '$p_karyawan_fullname',
								 '$p_tanggal_lahir',
								 '$p_karyawan_address',
								 '$p_karyawan_phone1',
								 '$p_karyawan_phone2',
								 '$p_karyawan_email',
								 '$p_karyawan_dapat_cuti',
								 'now()',
								 '$sess_karyawan_nik',
								 now()) ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function cek_user_available($p_nik)
	{
		$sql = " SELECT
					  COUNT(1) AS CEK
					FROM hcis_md_karyawan
					WHERE karyawan_nik = '$p_nik' ";
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $c)
		{
			return $c['CEK'];
		}
	}
	
	public function data_category_no()
	{
		$sql = "SELECT
						CATEGORY_NO, CATEGORY_NAME
					FROM TBL_REQUEST_CATEGORY
					WHERE
						CATEGORY_ACTIVE = '1' ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function set_ya_get_cuti($p_nik)
	{
		$sql = " UPDATE hcis_md_karyawan
					SET karyawan_get_cuti = '1' 
					WHERE karyawan_nik = '$p_nik' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function set_tidak_get_cuti($p_nik)
	{
		$sql = " UPDATE hcis_md_karyawan
					SET karyawan_get_cuti = '99'
					WHERE karyawan_nik = '$p_nik' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
}

?>