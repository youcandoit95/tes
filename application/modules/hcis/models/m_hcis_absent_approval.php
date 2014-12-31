<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_hcis_absent_approval extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function data_early_punch_out()
	{
		$p_div_no = $this->session->userdata('karyawan_div_no');
		$p_dept_no = $this->session->userdata('karyawan_dept_no');
		$p_jabatan = $this->session->userdata('karyawan_jabatan_no');
		
		if ($p_jabatan==4) // manager
		{
			$filter_dept = "AND k.karyawan_dept_no = '$p_dept_no' ";
			$filter_bawahan = "AND k.karyawan_jabatan_no > '$p_jabatan' ";
		}
		else if ($p_jabatan<=3) // gm keatas
		{
			$p_jabatan = intval($p_jabatan) + 1;
			$filter_dept = "";
			$filter_bawahan = "AND k.karyawan_jabatan_no = '$p_jabatan' ";
		}
		
		$sql = " SELECT 
					  a.absen_no, 
					  k.karyawan_nik, k.karyawan_fullname, 
					  DATE_FORMAT(a.po_early_time, '%d-%m-%Y %H:%i:%s') as absen_punch_out_time,
					  a.po_early_reason
					FROM hcis_trx_absen a , hcis_md_karyawan k
					WHERE
					  a.absen_karyawan_nik = k.karyawan_nik
					  AND k.karyawan_div_no = '$p_div_no'
					  ".$filter_dept."
					  ".$filter_bawahan."
					  AND a.po_early_flag = '1'
					  AND a.po_early_approve_up_level = '3' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}
	
	public function approve_po_early($p_nik, $p_absen_no)
	{
		$sql = " UPDATE hcis_trx_absen
					SET
					   po_early_approve_up_level = '1',
					   approve_up_level_date = now(),
					   approve_up_level_by = '$p_nik',
					   po_early_approve_hrd = '3'
					WHERE
					   absen_no = '$p_absen_no' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function reject_po_early($p_nik, $p_absen_no, $p_reject_reason)
	{
		$sql = " UPDATE hcis_trx_absen
					SET
						absen_status = 2,
						absen_punch_out_time = null,
						po_early_flag = 2,
					   po_early_approve_up_level = '2',
					   approve_up_level_date = now(),
					   approve_up_level_by = '$p_nik',
					   reject_up_level_reason = '$p_reject_reason'
					WHERE
					   absen_no = '$p_absen_no' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function data_early_punch_out_2nd_level()
	{
		$p_div_no = $this->session->userdata('karyawan_div_no');
		$p_dept_no = $this->session->userdata('karyawan_dept_no');
		$p_jabatan = $this->session->userdata('karyawan_jabatan_no');
		
		$sql = " SELECT 
					  a.absen_no, 
					  k.karyawan_nik, k.karyawan_fullname, 
					  DATE_FORMAT(a.po_early_time, '%d-%m-%Y %H:%i:%s') as absen_punch_out_time,
					  a.po_early_reason
					FROM hcis_trx_absen a , hcis_md_karyawan k
					WHERE
					  a.absen_karyawan_nik = k.karyawan_nik
					  AND a.po_early_flag = '1'
					  AND a.po_early_approve_hrd = '3' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}
	
	public function approve_po_early_2nd_level($p_nik, $p_absen_no)
	{
		$sql = " UPDATE hcis_trx_absen
					SET
					   po_early_approve_hrd = '1',
					   approve_hrd_date = now(),
					   approve_hrd_by = '$p_nik',
					   absen_punch_out_time = po_early_time
					WHERE
					   absen_no = '$p_absen_no' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function reject_po_early_2nd_level($p_nik, $p_absen_no, $p_reject_reason)
	{
		$sql = " UPDATE hcis_trx_absen
					SET
						absen_status = 2,
						absen_punch_out_time = null,
						po_early_flag = 2,
					   po_early_approve_hrd = '2',
					   approve_hrd_date = now(),
					   approve_hrd_by = '$p_nik',
					   reject_hrd_reason = '$p_reject_reason'
					WHERE
					   absen_no = '$p_absen_no' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
}