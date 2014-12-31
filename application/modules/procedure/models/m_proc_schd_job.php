<?php
class M_proc_schd_job extends CI_Model
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('global_function');
	}

	public function generate_absen()
	{
		$total_day_in_month = intval(date("t"));
		$bulan_tahun = date('m-Y'); 

		$sql_nik = "SELECT 
							  karyawan_nik, karyawan_jabatan_no
							FROM hcis_md_karyawan
							WHERE karyawan_deleted = 99
							  AND karyawan_jabatan_no <> 88 ";
		$query_nik = $this->db->query($sql_nik);
		foreach ($query_nik->result_array() as $n) // loop nik
		{
			$i = 0; // reset counter insert
			$p_nik = $n['karyawan_nik'];
			$p_jabatan_no = $n['karyawan_jabatan_no'];
			
			if ($p_jabatan_no<=3)
			{
				$additional_column_tidak_absen = "absen_status, ";
				$additional_value_tidak_absen = " '88', ";
			}
			else
			{
				$additional_column_tidak_absen = "";
				$additional_value_tidak_absen = "";
			}
		
			while ($i++ < $total_day_in_month) // start loop total hari 
			{
				$tgl = $i."-".$bulan_tahun; // tanggal absen
				$tgl = date('Y-m-d',strtotime($tgl)); // hasil convert tanggal absen
				$tgl_seq = str_replace("-","",$tgl);
				
				$sql_cek_exist = " SELECT 
												COUNT(1) AS cek
											FROM hcis_trx_absen 
											WHERE 
												absen_date = '$tgl'
												AND absen_karyawan_nik = '$p_nik' ";
				$query_cek_exist = $this->db->query($sql_cek_exist);
				$query_cek_exist = $query_cek_exist->result_array();
				if (!empty($query_cek_exist))
				{
					foreach ($query_cek_exist as $q)
					{
						$exist = $q['cek'];
					}
					
					if ($exist==0) // exist
					{
						$sql_seq = " SELECT nextval('seq_absen') as seq FROM dual "; // sql get seq absen
						$query_seq = $this->db->query($sql_seq);
						foreach ($query_seq->result_array() as $d)
						{
							$seq_absen = $d['seq'];
						}
						
						$seq_absen = $this->global_function->create_digit($seq_absen).$tgl_seq; // buat seq absen , seq+bulantahun
						
						$sql = " INSERT INTO hcis_trx_absen(absen_no,
													absen_date,
													absen_karyawan_nik,
													".$additional_column_tidak_absen."
													absen_created_date)
												VALUES ('$seq_absen',
													'$tgl',
													'$p_nik',
													".$additional_value_tidak_absen."
													now()
												) ";
						$query = $this->db->query($sql);
					}
				}
			} // end loop total hari
		}
		
		echo "sukses";
	}
	
	public function generate_absen_karyawan($p_nik, $p_jabatan_no)
	{
		$total_day_in_month = intval(date("t"));
		$bulan_tahun = date('m-Y'); 

		if ($p_jabatan_no<=3)
		{
			$additional_column_tidak_absen = "absen_status, ";
			$additional_value_tidak_absen = " '88', ";
		}
		else
		{
			$additional_column_tidak_absen = "";
			$additional_value_tidak_absen = "";
		}
		
			$i = 0; // reset counter insert
			$s = 1;
			while ($i++ < $total_day_in_month) // start loop total hari 
			{
				$tgl = $i."-".$bulan_tahun; // tanggal absen
				$tgl = date('Y-m-d',strtotime($tgl)); // hasil convert tanggal absen
				$tgl_seq = str_replace("-","",$tgl);
				
				$sql_cek_exist = " SELECT 
												COUNT(1) AS cek
											FROM hcis_trx_absen 
											WHERE 
												absen_date = '$tgl'
												AND absen_karyawan_nik = '$p_nik' ";
				$query_cek_exist = $this->db->query($sql_cek_exist);
				$query_cek_exist = $query_cek_exist->result_array();
				if (!empty($query_cek_exist))
				{
					foreach ($query_cek_exist as $q)
					{
						$exist = $q['cek'];
					}
					
					if ($exist==0) // exist
					{
						$sql_seq = " SELECT nextval('seq_absen') as seq FROM dual "; // sql get seq absen
						$query_seq = $this->db->query($sql_seq);
						foreach ($query_seq->result_array() as $d)
						{
							$seq_absen = $d['seq'];
						}
						
						$seq_absen = $this->global_function->create_digit($seq_absen).$tgl_seq; // buat seq absen , seq+bulantahun
						
						$sql = " INSERT INTO hcis_trx_absen(absen_no,
													absen_date,
													absen_karyawan_nik,
													".$additional_column_tidak_absen."
													absen_created_date)
												VALUES ('$seq_absen',
													'$tgl',
													'$p_nik',
													".$additional_value_tidak_absen."
													now()
												) ";
						$query = $this->db->query($sql);
						if ($query)
						{
							$s++;
						}
					}
				}
			} // end loop total hari
		
		if ($i==$s)
		{
			return true;
		}
	}
	
	public function expired_cuti_per_april() // expired cuti tahun lalu per april
	{
		$tahun_lalu = intval(date("Y")) - 1;
		
		$sql_cek = " SELECT
								COUNT(1) as cek
							FROM hcis_trx_mcuti
							WHERE
								mcuti_period_year = '$tahun_lalu'
								AND mcuti_available > 0 ";
		$query_cek = $this->db->query($sql_cek);
		foreach ($query_cek->result_array() as $q)
		{
			if ($q['cek']>0) // kalo ada data cuti tahun lalu yang lebih dari 0 cutinya
			{
				$sql = " SELECT
								mcuti_no, mcuti_karyawan_nik
							FROM hcis_trx_mcuti
							WHERE
								mcuti_period_year = '$tahun_lalu' 
								AND mcuti_available > 0 ";
				$query = $this->db->query($sql);
				$query = $query->result_array();
				if (!empty($query))
				{
					foreach ($query as $d)
					{
						$p_mcuti_no = $d['mcuti_no'];
						$p_nik = $d['mcuti_karyawan_nik'];
					
						$sql = " UPDATE hcis_trx_mcuti
									SET mcuti_available = '0',
										mcuti_change_md = '99'
									WHERE mcuti_no = '$p_mcuti_no' ";
						$query = $this->db->query($sql);
						if ($query==true)
						{
							$sql_seq = " SELECT nextval('seq_hcuti') as seq FROM dual "; // sql get seq absen
							$query_seq = $this->db->query($sql_seq);
							foreach ($query_seq->result_array() as $d)
							{
								$seq = $d['seq'];
							}
							
							$dmy = date("dmy");
							
							$seq_hcuti = $this->global_function->create_digit($seq).$dmy; // buat seq
							// cuti history status 66 = expired cuti tahun lalu
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
																					  '$p_mcuti_no',
																					  '$p_nik',
																					  '66',
																					  '$tahun_lalu',
																					  'expired cuti tahun lalu',
																					  '0',
																					  '0',
																					  'SYSTEM') ";
							$query = $this->db->query($sql);
						}
					}
				}
			}
		}
		
		return true;
	}
	
	public function tambah_cuti_berjalan()
	{
		$sql_nik = "SELECT 
							karyawan_nik
						FROM hcis_md_karyawan
						WHERE karyawan_deleted = 99
							AND karyawan_jabatan_no <> 88 
							AND karyawan_get_cuti = 1 ";
		$query_nik = $this->db->query($sql_nik);
		foreach ($query_nik->result_array() as $n) // loop nik
		{
			$p_nik = $n['karyawan_nik'];
			$period_bulan_tahun_sekarang = date("m-Y");
			$period_year = date("Y");
			
			// select di history , cek kalo udah ada data insert tambah cuti berjalan (cuti history status = 888) berdasarkan nik dan periode bulan-tahun
			$sql_cek = " SELECT
									COUNT(1) AS cek
								FROM hcis_cuti_history
								WHERE
									cuti_karyawan_nik = '$p_nik'
									AND DATE_FORMAT(tambah_cuti_period, '%m-%Y') = '$period_bulan_tahun_sekarang' ";
			$query_cek = $this->db->query($sql_cek);
			foreach ($query_cek->result_array() as $d)
			{
				// if kalo gak ada datanya (cek==0)
				if ($d['cek']==0)
				{	
					// select cek data di hcis_trx_mcuti berdasarkan nik dan periode tahun
					$sql = " SELECT
									mcuti_no,
									mcuti_available
								FROM hcis_trx_mcuti
								WHERE
									mcuti_karyawan_nik = '$p_nik'
									AND mcuti_period_year = '$period_year' ";
					$query = $this->db->query($sql);
					$query = $query->result_array();
					
					// if (cek>0) atau ada datanya
					if (!empty($query))
					{
						foreach ($query as $d)
						{
							$p_mcuti_no = $d['mcuti_no'];
							$sisa_cuti_skrng = $d['mcuti_available'];
						}
						
						$sisa_cuti_skrng = intval($sisa_cuti_skrng) + 1; // tambah cuti berjalan
						// update data nambah cuti +1 berdasarkan nik dan periode tahun
						$sql = " UPDATE hcis_trx_mcuti
									SET mcuti_available = '$sisa_cuti_skrng' 
									WHERE mcuti_no = '$p_mcuti_no' ";
						$query = $this->db->query($sql);
						
						if ($query)
						{
							// insert ke cuti history
							$sql_seq = " SELECT nextval('seq_hcuti') as seq FROM dual "; // sql get seq absen
							$query_seq = $this->db->query($sql_seq);
							foreach ($query_seq->result_array() as $d)
							{
								$seq = $d['seq'];
							}
							
							$dmy = date("dmy");
							$tambah_cuti_period = date('Y-m-01');
							
							$seq_hcuti = $this->global_function->create_digit($seq).$dmy; // buat seq
							// cuti history status 888 = tambah cuti berjalan
							$sql = " INSERT INTO hcis_cuti_history(cuti_history_no,
																					   dcuti_no_ref,
																					   mcuti_no_ref,
																					   cuti_karyawan_nik,
																					   cuti_history_status,
																					   tambah_cuti_period,
																					   cuti_period_year,
																					   cuti_history_ket,
																					   cuti_history_jumlah,
																					   cuti_available,
																					   created_by)
																			  VALUES ('$seq_hcuti',
																					  '',
																					  '$p_mcuti_no',
																					  '$p_nik',
																					  '888',
																					  '$tambah_cuti_period',
																					  '$period_year',
																					  'tambah cuti berjalan',
																					  '1',
																					  '$sisa_cuti_skrng',
																					  'SYSTEM') ";
							$query = $this->db->query($sql);
						}
					}
					// else
					else
					{
						// echo "b";
						// exit();
						// dia insert dengan value cuti available = 1 berdasarkan nik dan periode tahun
						// insert ke cuti history
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
																				'$period_year',
																				'1',
																				now(),
																				'SYSTEM') ";
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
							$tambah_cuti_period = date('Y-m-01');
							
							$seq_hcuti = $this->global_function->create_digit($seq).$dmy; // buat seq absen , seq+bulantahun
							// cuti history status 888 = tambah cuti berjalan
							$sql = " INSERT INTO hcis_cuti_history(cuti_history_no,
																					   dcuti_no_ref,
																					   mcuti_no_ref,
																					   cuti_karyawan_nik,
																					   cuti_history_status,
																					   tambah_cuti_period,
																					   cuti_period_year,
																					   cuti_history_ket,
																					   cuti_history_jumlah,
																					   cuti_available,
																					   created_by)
																			  VALUES ('$seq_hcuti',
																					  '',
																					  '$seq_mcuti',
																					  '$p_nik',
																					  '888',
																					  '$tambah_cuti_period',
																					  '$period_year',
																					  'tambah cuti berjalan',
																					  '1',
																					  '1',
																					  'SYSTEM') ";
							$query = $this->db->query($sql);
						}
					}
				}
			}
		}
	}
}
?>