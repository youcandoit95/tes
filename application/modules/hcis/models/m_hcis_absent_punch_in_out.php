<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_hcis_absent_punch_in_out extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function punch_in($p_nik)
	{
		$sql = " UPDATE hcis_trx_absen
					SET 
					  absen_punch_in_time = now(),
					  pi_late_flag = 99,
					  absen_status = 2
					WHERE
					  absen_date = DATE_FORMAT(now(), '%Y-%m-%d')
					   AND absen_karyawan_nik = '$p_nik' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function punch_out($p_nik)
	{
		$sql = " UPDATE hcis_trx_absen
					SET 
					  absen_punch_out_time = now(),
					  po_early_flag = 99,
					  absen_status = 1
					WHERE
					  absen_date = DATE_FORMAT(now(), '%Y-%m-%d')
					   AND absen_karyawan_nik = '$p_nik' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function punch_in_late($p_nik, $pi_late_reason)
	{
		$sql_cek = " SELECT COUNT(1) AS cek
							FROM hcis_trx_absen
							WHERE 
								absen_date = DATE_FORMAT(now(), '%Y-%m-%d')
							   AND absen_karyawan_nik = '$p_nik' ";
		$query_cek = $this->db->query($sql_cek);
		$query_cek = $query_cek->result_array();
		
		if (!empty($query_cek))
		{
			foreach ($query_cek as $d)
			{	
				$cek = $d['cek'];
			}
			
			if ($cek==1)
			{
				$sql = " UPDATE hcis_trx_absen
							SET 
							  absen_punch_in_time = now(),
							  pi_late_flag = 1,
							  pi_late_reason = '$pi_late_reason',
							  absen_status = 2
							WHERE
							  absen_date = DATE_FORMAT(now(), '%Y-%m-%d')
							   AND absen_karyawan_nik = '$p_nik' ";
				$query = $this->db->query($sql);
				if ($query)
				{
					return true;
				}
			}
		}
	}
	
	public function punch_out_early($p_nik, $po_early_reason)
	{
		$sql_cek = " SELECT COUNT(1) AS cek
							FROM hcis_trx_absen
							WHERE 
								absen_date = DATE_FORMAT(now(), '%Y-%m-%d')
							   AND absen_karyawan_nik = '$p_nik' ";
		$query_cek = $this->db->query($sql_cek);
		$query_cek = $query_cek->result_array();
		
		if (!empty($query_cek))
		{
			foreach ($query_cek as $d)
			{	
				$cek = $d['cek'];
			}
			
			if ($cek==1)
			{
				$sql = " UPDATE hcis_trx_absen
							SET 
							  absen_status = 1,
							  po_early_time = now(),
							  po_early_flag = 1,
							  po_early_reason = '$po_early_reason',
							  po_early_read_up_level = null,
							  early_read_up_level_by = '',
							  po_early_approve_up_level = '3',
							  reject_up_level_reason = '',
							  approve_up_level_date = null,
							  approve_up_level_by = '',
							  po_early_read_hrd = null,
							  early_read_hrd_by = '',
							  po_early_approve_hrd = '99',
							  reject_hrd_reason = '',
							  approve_hrd_date = null,
							  approve_hrd_by = ''
							WHERE
							  absen_date = DATE_FORMAT(now(), '%Y-%m-%d')
							   AND absen_karyawan_nik = '$p_nik' ";
				$query = $this->db->query($sql);
				if ($query)
				{
					return true;
				}
			}
		}
	}
	
	public function check_punch_in($p_nik)
	{
		$sql = " SELECT COUNT(1) AS cek 
					FROM hcis_trx_absen
					WHERE
					  absen_punch_in_time IS NOT NULL
					  AND absen_karyawan_nik = '$p_nik'
					  AND absen_date = DATE_FORMAT(now(), '%Y-%m-%d') ";
		$query = $this->db->query($sql);
		if ($query)
		{
			foreach ($query->result_array() as $q)
			{
				$cek = $q['cek'];
			}
			
			return $cek;
		}
	}
	
	public function data_absen_today($p_nik)
	{
		$sql = " SELECT 
						DATE_FORMAT(a.absen_date, '%d-%m-%Y') as absen_date,
						DATE_FORMAT(a.absen_punch_in_time, '%d-%m-%Y %H:%i:%s') as absen_punch_in_time,
						a.pi_late_flag,
						a.pi_late_reason,
						DATE_FORMAT(a.absen_punch_out_time, '%d-%m-%Y %H:%i:%s') as absen_punch_out_time,
						DATE_FORMAT(a.po_early_time, '%d-%m-%Y %H:%i:%s') as po_early_time,
						a.po_early_flag,
						a.po_early_reason,
						a.po_early_approve_up_level,
						a.reject_up_level_reason,
						DATE_FORMAT(a.approve_up_level_date, '%d-%m-%Y %H:%i:%s') as approve_up_level_date,
						k.karyawan_fullname as nama_atasan_approve,
						a.po_early_approve_hrd,
					    DATE_FORMAT(a.approve_hrd_date, '%d-%m-%Y %H:%i:%s') AS approve_hrd_date,
					    k2.karyawan_fullname AS nama_hrd_approve,
						a.reject_hrd_reason
					FROM hcis_trx_absen a left outer join hcis_md_karyawan k on a.approve_up_level_by = k.karyawan_nik
														left outer join hcis_md_karyawan k2 on a.approve_hrd_by = k2.karyawan_nik
					WHERE
						a.absen_karyawan_nik = '$p_nik'
						AND a.absen_date = DATE_FORMAT(now(), '%Y-%m-%d') ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}
	
	public function cek_hari_ini_cuti()
	{
		$sess_nik = $this->session->userdata('karyawan_nik');
		
		$sql = " SELECT 
						COUNT(1) as cek
					FROM hcis_trx_absen a
					WHERE
						a.absen_karyawan_nik = '$sess_nik'
						AND a.absen_date = DATE_FORMAT(now(), '%Y-%m-%d')
						AND a.absen_status = 3 ";
		$query = $this->db->query($sql);
		if ($query)
		{
			foreach ($query->result_array() as $q)
			{
				return $q['cek'];
			}
		}
	}
}