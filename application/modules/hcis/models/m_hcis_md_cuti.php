<?php

class M_hcis_md_cuti extends CI_Model
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('global_function');
	}

	public function data_karyawan()
	{
		$sql = "SELECT
					   karyawan_nik, karyawan_fullname
					FROM hcis_md_karyawan
					WHERE 
						karyawan_deleted = 99
						AND karyawan_jabatan_no <> 88
						AND karyawan_get_cuti = 1
					ORDER BY karyawan_div_no, karyawan_dept_no, karyawan_bagian_no , karyawan_fullname ASC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function check_exist($p_nik, $p_period_year)
	{
		$sql = " SELECT
					  count(1) as cek
					FROM hcis_trx_mcuti
					WHERE
					  mcuti_karyawan_nik = '$p_nik' 
					  AND mcuti_period_year = '$p_period_year' ";
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $d)
		{
			return $d['cek'];
		}
	}
	
	public function md_cuti_baru($p_nik, $p_jumlah_cuti, $p_period_year)
	{
		$lupdated_by = $this->session->userdata('karyawan_nik');
		
		$sql_seq = " SELECT nextval('seq_mcuti') as seq FROM dual "; // sql get seq absen
		$query_seq = $this->db->query($sql_seq);
		foreach ($query_seq->result_array() as $d)
		{
			$seq = $d['seq'];
		}
		
		$yy = date("y");
		$seq_mcuti = $this->global_function->create_digit($seq).$yy; // buat seq absen , seq+bulantahun
		
		$sql = " INSERT INTO hcis_trx_mcuti(mcuti_no,
																mcuti_karyawan_nik,
																mcuti_period_year,
																mcuti_available,
																mcuti_created_date,
																mcuti_lupdated_by)
														VALUES ('$seq_mcuti',
																'$p_nik',
																'$p_period_year',
																'$p_jumlah_cuti',
																now(),
																'$lupdated_by') ";
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
			// cuti history status 88 = insert master data cuti
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
																	  '',
																	  '$seq_mcuti',
																	  '$p_nik',
																	  '88',
																	  '$p_period_year',
																	  'insert oleh hrd',
																	  $p_jumlah_cuti,
																	  $p_jumlah_cuti,
																	  '$lupdated_by') ";
			$query = $this->db->query($sql);
			if ($query)
			{
				return true;
			}
		}
	}
	
	public function data_mcuti()
	{
		$sql = " SELECT mc.mcuti_no,
						   mc.mcuti_karyawan_nik,
						   k.karyawan_fullname,
						   mc.mcuti_period_year,
						   mc.mcuti_available,
						   mc.mcuti_change_md
					FROM hcis_trx_mcuti mc , hcis_md_karyawan k
					WHERE
						mc.mcuti_karyawan_nik = k.karyawan_nik ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function md_cuti_ubah($p_mcuti_no, $p_jumlah_cuti, $p_karyawan_nik)
	{
		$lupdated_by = $this->session->userdata('karyawan_nik');
		$sql = " UPDATE hcis_trx_mcuti SET mcuti_available = $p_jumlah_cuti WHERE mcuti_no = '$p_mcuti_no' ";
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
			// cuti history status 77 = ubah master data cuti
			$sql = " INSERT INTO hcis_cuti_history(cuti_history_no,
																	   dcuti_no_ref,
																	   mcuti_no_ref,
																	   cuti_karyawan_nik,
																	   cuti_history_status,
																	   cuti_history_ket,
																	   cuti_history_jumlah,
																	   created_by)
															  VALUES ('$seq_hcuti',
																	  '',
																	  '$p_mcuti_no',
																	  '$p_karyawan_nik',
																	  '77',
																	  'ubah oleh hrd',
																	  $p_jumlah_cuti,
																	  '$lupdated_by') ";
			$query = $this->db->query($sql);
			if ($query)
			{
				return true;
			}
		}
	}
}