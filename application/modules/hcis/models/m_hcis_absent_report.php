<?php
class M_hcis_absent_report extends CI_Model
{	
	public function data_your_absent($p_nik, $p_date_from, $p_date_thru)
	{
		$sql = " SELECT
					  a.absen_no, 
					  DATE_FORMAT(a.absen_date, '%d-%m-%Y') as absen_date,
					  st.name as absen_status,
					  DATE_FORMAT(a.absen_punch_in_time, '%d-%m-%Y %H:%i:%s') as absen_punch_in_time,
					  a.pi_late_flag,
					  a.pi_late_reason,
					  DATE_FORMAT(a.absen_punch_out_time, '%d-%m-%Y %H:%i:%s') as absen_punch_out_time,
					  a.po_early_flag,
					  a.po_early_reason
					FROM hcis_trx_absen a, hc_hcis_absen_status st
					WHERE
						a.absen_status = st.kode
						AND a.absen_karyawan_nik = '$p_nik'
						AND DATE_FORMAT(a.absen_date, '%d-%m-%Y') >= '$p_date_from'
						AND DATE_FORMAT(a.absen_date, '%d-%m-%Y') <= '$p_date_thru'
					ORDER BY a.absen_date ASC ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}
	
	public function data_team_absent($p_date_from, $p_date_thru, $p_div_no, $p_dept_no, $p_bagian_no)
	{
		// echo $p_date_from."-".$p_date_thru."-".$p_div_no."-".$p_dept_no."-".$p_bagian_no;
		// echo $p_dept_no;
		// exit();
		$p_div_no = $p_div_no=="888" ? "" : $p_div_no;
		$p_dept_no = $p_dept_no=="888" ? "" : $p_dept_no;
		$p_bagian_no = $p_bagian_no=="888" ? "" : $p_bagian_no;
		
		$sql = " SELECT
					  a.absen_no, 
					  a.absen_karyawan_nik,
					  k.karyawan_fullname,
					  DATE_FORMAT(a.absen_date, '%d-%m-%Y') as absen_date,
					  st.name as absen_status,
					  DATE_FORMAT(a.absen_punch_in_time, '%d-%m-%Y %H:%i:%s') as absen_punch_in_time,
					  a.pi_late_flag,
					  a.pi_late_reason,
					  DATE_FORMAT(a.absen_punch_out_time, '%d-%m-%Y %H:%i:%s') as absen_punch_out_time,
					  a.po_early_flag,
					  a.po_early_reason
					FROM hcis_trx_absen a, hc_hcis_absen_status st , hcis_md_karyawan k
					WHERE
						a.absen_status <> '88'
						AND a.absen_status = st.kode
						AND a.absen_karyawan_nik = k.karyawan_nik
						AND DATE_FORMAT(a.absen_date, '%d-%m-%Y') >= '$p_date_from'
						AND DATE_FORMAT(a.absen_date, '%d-%m-%Y') <= '$p_date_thru'
						AND k.karyawan_div_no LIKE '%$p_div_no%'
						AND k.karyawan_dept_no LIKE '%$p_dept_no%'
						AND k.karyawan_bagian_no LIKE '%$p_bagian_no%'
					ORDER BY k.karyawan_fullname,a.absen_date ASC ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}
	
	public function translate_div_name($p_div_no)
	{
		if ($p_div_no==888)
		{
			return "Semua Divisi";
		}
		else
		{
			$sql = " SELECT 
						  div_name
						FROM hcis_md_div
						WHERE
						  div_no = '$p_div_no'
						";
			$query = $this->db->query($sql);
			foreach ($query->result_array() as $q)
			{
				return $q['div_name'];
			}
		}
	}
	
	public function translate_dept_name($p_dept_no)
	{
		if ($p_dept_no==888)
		{
			return "Semua Departement";
		}
		else
		{
			$sql = " SELECT 
							dept_name
						FROM hcis_md_dept
						WHERE dept_no = $p_dept_no
					  ";
			$query = $this->db->query($sql);
			foreach ($query->result_array() as $q)
			{
				return $q['dept_name'];
			}
		}
	}
	
	public function translate_bagian_name($p_bagian_no)
	{
		if ($p_bagian_no==888)
		{
			return "Semua Bagian";
		}
		else
		{
			$sql = " SELECT 
							bagian_name
						FROM hcis_md_bagian
						WHERE bagian_no = $p_bagian_no
					  ";
			$query = $this->db->query($sql);
			foreach ($query->result_array() as $q)
			{
				return $q['bagian_name'];
			}
		}
	}
}
?>