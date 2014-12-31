<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_hcis_cuti_approval extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('global_function');
	}
	
	public function data_annual_leave()
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
						r.rcuti_no,
						r.mcuti_no,
						k.karyawan_nik, k.karyawan_fullname, 
						m.mcuti_period_year,
						r.rcuti_lama_hari,
						DATE_FORMAT(r.rcuti_date_from, '%d-%m-%Y') as rcuti_date_from,
						DATE_FORMAT(r.rcuti_date_thru, '%d-%m-%Y') as rcuti_date_thru,
						r.rcuti_reason,
						DATE_FORMAT(r.rcuti_created_date, '%d-%m-%Y %H:%m:%s') as rcuti_created_date
					FROM hcis_trx_rcuti r, hcis_trx_mcuti m, hcis_md_karyawan k
					WHERE
						r.mcuti_no = m.mcuti_no
						AND m.mcuti_karyawan_nik = k.karyawan_nik
						AND k.karyawan_div_no = '$p_div_no'
						".$filter_dept."
						".$filter_bawahan."
						AND r.rcuti_lstatus = 99
						AND r.rcuti_cancel = 99 ";
		
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}
	
	public function approve_annual_leave($p_rcuti_no)
	{
		$sess_nik = $this->session->userdata('karyawan_nik');
	
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
		
			$sql = " UPDATE hcis_trx_rcuti
						SET rcuti_lstatus = '3',
							   rcuti_approve_up_level = 1,
							   approve_up_level_date = now(),
							   approve_up_level_by = '$sess_nik',
							   rcuti_approve_hrd = '3'
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
				// cuti history status 2 = approve cuti up level
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
																		  '2',
																		  '$period_year',
																		  'approve up level',
																		  '$p_lama_cuti',
																		  $cuti_available,
																		  '$sess_nik') ";
				$query = $this->db->query($sql);
				if ($query)
				{
					return true;
				}
			}
		}
	}
	
	public function reject_annual_leave($p_rcuti_no, $p_reject_reason)
	{
		$sess_nik = $this->session->userdata('karyawan_nik');
	
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
	
			$sql = " UPDATE hcis_trx_rcuti
						SET
							rcuti_lstatus = 4,
							rcuti_approve_up_level = '2',
							approve_up_level_date = now(),
							approve_up_level_by = '$sess_nik',
							reject_up_level_reason = '$p_reject_reason'
						WHERE
						   rcuti_no = '$p_rcuti_no' ";
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
				// cuti history status 3 = reject cuti up level
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
																		  '3',
																		  '$period_year',
																		  '$p_reject_reason',
																		  '$p_lama_cuti',
																		  $cuti_available,
																		  '$sess_nik') ";
				$query = $this->db->query($sql);
				if ($query)
				{
					return true;
				}
			}
		}
	}
	
	public function data_annual_leave_2nd_level()
	{
		$sql = " SELECT 
						r.rcuti_no,
						r.mcuti_no,
						k.karyawan_nik, k.karyawan_fullname, 
						m.mcuti_period_year,
						r.rcuti_lama_hari,
						DATE_FORMAT(r.rcuti_date_from, '%d-%m-%Y') as rcuti_date_from,
						DATE_FORMAT(r.rcuti_date_thru, '%d-%m-%Y') as rcuti_date_thru,
						r.rcuti_reason,
						DATE_FORMAT(r.rcuti_created_date, '%d-%m-%Y %H:%m:%s') as rcuti_created_date
					FROM hcis_trx_rcuti r, hcis_trx_mcuti m, hcis_md_karyawan k
					WHERE
						r.mcuti_no = m.mcuti_no
						AND m.mcuti_karyawan_nik = k.karyawan_nik
						AND r.rcuti_lstatus = 3
						AND r.rcuti_cancel = 99 
						AND r.rcuti_approve_hrd = '3' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}
	
	public function cek_masih_ada_cuti($p_rcuti_no,$p_mcuti_no)
	{
		$sql = " SELECT
						mcuti_available
					FROM hcis_trx_mcuti
					WHERE
						mcuti_no = '$p_mcuti_no' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			foreach ($query->result_array() as $q)
			{
				$sisa_cuti = $q['mcuti_available'];
			}	
			
			$sql = " SELECT
							rcuti_lama_hari
						FROM hcis_trx_rcuti
						WHERE rcuti_no = '$p_rcuti_no' ";
			$query = $this->db->query($sql);
			if ($query)
			{
				foreach ($query->result_array() as $q)
				{
					$lama_cuti = $q['rcuti_lama_hari'];
				}	
				
				// cek sisa cuti tidak mencukupi
				if ($lama_cuti > $sisa_cuti)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
		}
	}
	
	public function approve_annual_leave_2nd_level($p_rcuti_no, $p_mcuti_no)
	{
		$sess_nik = $this->session->userdata('karyawan_nik');
		
		$sql = " SELECT
						m.mcuti_no,
						m.mcuti_karyawan_nik,
						m.mcuti_period_year,
						m.mcuti_available,
						r.rcuti_lama_hari, 
						DATE_FORMAT(r.rcuti_date_from, '%Y-%m-%d') as rcuti_date_from,
						DATE_FORMAT(r.rcuti_date_thru, '%Y-%m-%d') as rcuti_date_thru
					FROM hcis_trx_rcuti r, hcis_trx_mcuti m
					WHERE 
						r.mcuti_no = m.mcuti_no
						AND r.rcuti_no = '$p_rcuti_no' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			foreach ($query->result_array() as $a)
			{
				$p_nik = $a['mcuti_karyawan_nik'];
				$p_lama_cuti = $a['rcuti_lama_hari'];
				$period_year = $a['mcuti_period_year'];
				$cuti_available = $a['mcuti_available'];
				$rcuti_lama_hari = $a['rcuti_lama_hari'];
				$rcuti_date_from = $a['rcuti_date_from'];
				$rcuti_date_thru = $a['rcuti_date_thru'];
			}
			
			$sql = " SELECT
							mcuti_karyawan_nik,
							mcuti_available
						FROM hcis_trx_mcuti
						WHERE
							mcuti_no = '$p_mcuti_no' ";
			$query = $this->db->query($sql);
			if ($query)
			{
				foreach ($query->result_array() as $a)
				{
					$p_absen_karyawan_nik = $a['mcuti_karyawan_nik'];
					$sisa_cuti = $a['mcuti_available'];
				}
			
				$p_cuti_date = $rcuti_date_from;
				$sukses = 0;
				for ($i=0;$i<$rcuti_lama_hari;$i++)
				{
					$sql = " UPDATE hcis_trx_absen
								SET
									absen_status = '3',
									absen_rcuti_no = '$p_rcuti_no'
								WHERE
									DATE_FORMAT(absen_date, '%Y-%m-%d') = '$p_cuti_date'
									AND absen_karyawan_nik = '$p_absen_karyawan_nik' ";
					$query = $this->db->query($sql);
					if ($query)
					{
						$sukses++;
					}
					$p_cuti_date = date('Y-m-d', strtotime('+1 day', strtotime($p_cuti_date)));
				}
				
				if ($rcuti_lama_hari==$sukses)
				{
					$sql = " UPDATE hcis_trx_rcuti
								SET
									rcuti_lstatus = '1',
									rcuti_approve_hrd = '1',
									approve_hrd_date = now(),
									approve_hrd_by = '$sess_nik'
								WHERE
								   rcuti_no = '$p_rcuti_no' ";
					$query = $this->db->query($sql);
					if ($query)
					{
						$sisa_cuti_baru = intval($sisa_cuti) - intval($rcuti_lama_hari);
						
						$sql = " UPDATE hcis_trx_mcuti
									SET
										mcuti_available = '$sisa_cuti_baru',
										mcuti_change_md = 99
									WHERE
									  mcuti_no = '$p_mcuti_no' ";
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
							// cuti history status 4 = approve cuti hrd
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
																					  '4',
																					  '$period_year',
																					  'approve cuti hrd',
																					  '$p_lama_cuti',
																					  $sisa_cuti_baru,
																					  '$sess_nik') ";
							$query = $this->db->query($sql);
							if ($query)
							{
								return true;
							}
						}
					}
				}
			}
		}
	}
	
	public function reject_annual_leave_2nd_level($p_rcuti_no, $p_reject_reason)
	{
		$sess_nik = $this->session->userdata('karyawan_nik');
		
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
		
			$sql = " UPDATE hcis_trx_rcuti
						SET
							rcuti_lstatus = 2,
							rcuti_approve_hrd = '2',
							approve_hrd_date = now(),
							approve_hrd_by = '$sess_nik',
							reject_hrd_reason = '$p_reject_reason'
						WHERE
						   rcuti_no = '$p_rcuti_no' ";
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
				// cuti history status 5 = reject cuti hrd
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
																		  '5',
																		  '$period_year',
																		  '$p_reject_reason',
																		  '$p_lama_cuti',
																		  $cuti_available,
																		  '$sess_nik') ";
				$query = $this->db->query($sql);
				if ($query)
				{
					return true;
				}
			}
		}
	}
}