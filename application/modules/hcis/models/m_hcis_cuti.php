<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_hcis_cuti extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('global_function');
	}
	
	public function data_ambil_cuti_no_action($p_nik)
	{
		$sql = " SELECT 
						r.rcuti_no,
						r.mcuti_no,
						m.mcuti_period_year,
						r.rcuti_lama_hari,
						DATE_FORMAT(r.rcuti_date_from, '%d-%m-%Y') as rcuti_date_from,
						DATE_FORMAT(r.rcuti_date_thru, '%d-%m-%Y') as rcuti_date_thru,
						r.rcuti_reason,
						DATE_FORMAT(r.rcuti_created_date, '%d-%m-%Y %H:%m:%s') as rcuti_created_date
					FROM hcis_trx_rcuti r, hcis_trx_mcuti m
					WHERE
						r.mcuti_no = m.mcuti_no
						AND m.mcuti_karyawan_nik = '$p_nik'
						AND r.rcuti_lstatus = 99
						AND r.rcuti_cancel = 99 ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}
	
	public function info_sisa_cuti($p_nik, $mode)
	{
		$periode_tahun_skrng = date("Y");
		$periode_tahun_sebelumnya = intval($periode_tahun_skrng) - 1;
		
		$sql = " SELECT
						mcuti_no,
						mcuti_available,
						mcuti_period_year
					FROM hcis_trx_mcuti
					WHERE
						mcuti_karyawan_nik = '$p_nik'
						AND mcuti_period_year IN ('$periode_tahun_sebelumnya','$periode_tahun_skrng')
						AND mcuti_available > 0 ";
		$query = $this->db->query($sql);
		if ($query)
		{
			if ($mode==1)
			{
				return $query->result_array();
			}
			else
			{
				$total_cuti = 0;
				foreach ($query->result_array() as $a)
				{
					$total_cuti = intval($total_cuti) + $a['mcuti_available'];
				}
				return $total_cuti;
			}
		}
	}
	
	public function sisa_cuti($p_mcuti_no)
	{
		$sql = " SELECT 
						mcuti_available
					FROM hcis_trx_mcuti
					WHERE 
						mcuti_no = '$p_mcuti_no' ";
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $q)
		{
			return $q['mcuti_available'];
		}
	}
	
	public function ambil_cuti($p_nik, $p_mcuti_no, $p_date_from, $p_date_thru, $p_lama_cuti, $p_alasan)
	{
		$additional_column = "";
		$additional_value = "";
	
		$sess_jabatan = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_jabatan==2 || $sess_jabatan==1)
		{
			$additional_column = "rcuti_lstatus, rcuti_approve_up_level, approve_up_level_date, rcuti_approve_hrd";
			$additional_value = " '3', '1', now(), '3' ";
		}
	
		// get seq rcuti
		$sql_seq = " SELECT nextval('seq_rcuti') as seq FROM dual ";
		$query_seq = $this->db->query($sql_seq);
		foreach ($query_seq->result_array() as $d)
		{
			$seq_rcuti = $d['seq'];
		}
		$seq_rcuti = $this->global_function->create_digit($seq_rcuti).date('y');
		
		$p_date_from_convert = date('Y-m-d', strtotime($p_date_from));
		$p_date_thru_convert = date('Y-m-d', strtotime($p_date_thru));
		
		$sql = " SELECT 
						mcuti_available,
						mcuti_period_year
					FROM hcis_trx_mcuti
					WHERE 
						mcuti_no = '$p_mcuti_no' ";
		$query = $this->db->query($sql);
		$query = $query->result_array();
		if (!empty($query))
		{
			foreach ($query as $q)
			{
				$cuti_available = $q['mcuti_available'];
				$period_year = $q['mcuti_period_year'];
			}
			
			$sql = " INSERT INTO hcis_trx_rcuti(rcuti_no,
																   mcuti_no,
																   rcuti_lama_hari,
																   rcuti_date_from,
																   rcuti_date_thru,
																   rcuti_reason,
																   ".$additional_column."
																   rcuti_created_date)
													VALUES ('$seq_rcuti',
																	'$p_mcuti_no',
																	'$p_lama_cuti',
																	'$p_date_from_convert',
																	'$p_date_thru_convert',
																	'$p_alasan',
																	".$additional_value."
																	now()) ";
			$query = $this->db->query($sql);
			if ($query)
			{
				$sql_seq = " SELECT nextval('seq_hcuti') as seq FROM dual "; // sql get seq absen
				$query_seq = $this->db->query($sql_seq);
				foreach ($query_seq->result_array() as $d)
				{
					$seq = $d['seq'];
				}
				
				$dmy = date("dmy");
				
				$seq_hcuti = $this->global_function->create_digit($seq).$dmy; // buat seq absen , seq+bulantahun
				// cuti history status 1 = ambil cuti
				$sql = " INSERT INTO hcis_cuti_history(cuti_history_no,
																		   dcuti_no_ref,
																		   mcuti_no_ref,
																		   cuti_karyawan_nik,
																		   cuti_history_status,
																		   cuti_period_year,
																		   cuti_history_ket,
																		   cuti_history_jumlah,
																		   cuti_available,
																		   created_by)
																  VALUES ('$seq_hcuti',
																		  '$seq_rcuti',
																		  '$p_mcuti_no',
																		  '$p_nik',
																		  '1',
																		  '$period_year',
																		  '$p_alasan',
																		  $p_lama_cuti,
																		  $cuti_available,
																		  '$p_nik') ";
				$query = $this->db->query($sql);
				if ($query)
				{
					return true;
				}
			}
		}
	}
	
	public function cancel_cuti($p_rcuti_no)
	{
		$sql = " SELECT 
						m.mcuti_no,
						m.mcuti_karyawan_nik,
						m.mcuti_period_year,
						m.mcuti_available,
						r.rcuti_lama_hari
					FROM hcis_trx_rcuti r, hcis_trx_mcuti m
					WHERE 
						r.mcuti_no = m.mcuti_no
						AND r.rcuti_no = '$p_rcuti_no' ";
		$query = $this->db->query($sql);
		$query = $query->result_array();
		if (!empty($query))
		{
			foreach ($query as $q)
			{
				$p_mcuti_no = $q['mcuti_no'];
				$p_nik = $q['mcuti_karyawan_nik'];
				$p_lama_cuti = $q['rcuti_lama_hari'];
				$period_year = $q['mcuti_period_year'];
				$cuti_available = $q['mcuti_available'];
			}
			
			$sql = " UPDATE  hcis_trx_rcuti
						SET rcuti_cancel = '1'
						WHERE rcuti_no = '$p_rcuti_no' ";
			$query = $this->db->query($sql);
			if ($query)
			{
				$sql_seq = " SELECT nextval('seq_hcuti') as seq FROM dual "; // sql get seq absen
				$query_seq = $this->db->query($sql_seq);
				foreach ($query_seq->result_array() as $d)
				{
					$seq = $d['seq'];
				}
				
				$dmy = date("dmy");
				
				$seq_hcuti = $this->global_function->create_digit($seq).$dmy; // buat seq absen , seq+bulantahun
				// cuti history status 6 = cancel cuti
				$sql = " INSERT INTO hcis_cuti_history(cuti_history_no,
																		   dcuti_no_ref,
																		   mcuti_no_ref,
																		   cuti_karyawan_nik,
																		   cuti_history_status,
																		   cuti_period_year,
																		   cuti_history_ket,
																		   cuti_history_jumlah,
																		   cuti_available,
																		   created_by)
																  VALUES ('$seq_hcuti',
																		  '$p_rcuti_no',
																		  '$p_mcuti_no',
																		  '$p_nik',
																		  '6',
																		  '$period_year',
																		  'cancel by user',
																		  '$p_lama_cuti',
																		  $cuti_available,
																		  '$p_nik') ";
				$query = $this->db->query($sql);
				if ($query)
				{
					return true;
				}
			}
		}
	}
	
	public function data_ambil_cuti($sess_nik)
	{
		$sql = " SELECT 
						r.rcuti_no,
						r.mcuti_no,
						r.rcuti_lstatus,
						cs.name as rcuti_lstatus_name,
						r.rcuti_cancel,
						k.karyawan_nik, k.karyawan_fullname, 
						m.mcuti_period_year,
						r.rcuti_lama_hari,
						DATE_FORMAT(r.rcuti_date_from, '%d-%m-%Y') as rcuti_date_from,
						DATE_FORMAT(r.rcuti_date_thru, '%d-%m-%Y') as rcuti_date_thru,
						r.rcuti_reason,
						DATE_FORMAT(r.rcuti_created_date, '%d-%m-%Y %H:%m:%s') as rcuti_created_date,
						r.rcuti_approve_up_level, r.reject_up_level_reason, 
						DATE_FORMAT(r.approve_up_level_date, '%d-%m-%Y %H:%m:%s') as approve_up_level_date,
						r.rcuti_approve_hrd, r.reject_hrd_reason, 
						DATE_FORMAT(r.approve_hrd_date, '%d-%m-%Y %H:%m:%s') as approve_hrd_date
					FROM hcis_trx_rcuti r, hcis_trx_mcuti m, hcis_md_karyawan k, hc_cuti_status cs
					WHERE
						r.mcuti_no = m.mcuti_no
						AND m.mcuti_karyawan_nik = k.karyawan_nik
						AND r.rcuti_lstatus = cs.kode
						AND r.rcuti_cancel = 99
						AND m.mcuti_karyawan_nik = '$sess_nik'
					ORDER BY 1 ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}
}