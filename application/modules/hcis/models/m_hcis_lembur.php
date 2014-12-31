<?php
class M_hcis_lembur extends CI_Model
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('global_function');
	}
	
	public function data_lembur($sess_nik)
	{
		$sql = " SELECT
						l.lembur_no,
						DATE_FORMAT(l.lembur_time_in, '%d-%m-%Y %H:%i:%s') as lembur_time_in,
						DATE_FORMAT(l.lembur_time_out, '%d-%m-%Y %H:%i:%s') as lembur_time_out,
						l.lembur_reason
					FROM hcis_trx_lembur l
					WHERE l.lembur_karyawan_nik = '$sess_nik' 
						AND l.lembur_cancel = 99 ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->result_array();
		}
	}

	public function insert_lembur($p_lembur_time_in, $p_lembur_time_out, $p_lembur_reason, $sess_nik)
	{
		$p_lembur_time_in = date('Y-m-d H:i:s', strtotime($p_lembur_time_in));
		$p_lembur_time_out = date('Y-m-d H:i:s', strtotime($p_lembur_time_out));
		
		$sql_seq_lembur = " SELECT nextval('seq_lembur') as seq FROM dual "; // sql get seq absen
		$query_seq_lembur = $this->db->query($sql_seq_lembur);
		foreach ($query_seq_lembur->result_array() as $d)
		{
			$seq_lembur = $d['seq'];
		}
		
		$seq_lembur = $this->global_function->create_digit($seq_lembur).date("my");

		$sql = " INSERT INTO hcis_trx_lembur(lembur_no,
																lembur_karyawan_nik,
																lembur_time_in,
																lembur_time_out,
																lembur_reason,
																lembur_approve_up_level,
																lembur_created_date)
												VALUES ('$seq_lembur',
																'$sess_nik',
																'$p_lembur_time_in',
																'$p_lembur_time_out',
																'$p_lembur_reason',
																'3',
																now()) ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function cancel_lembur($p_lembur_no)
	{
		$sql = " UPDATE  hcis_trx_lembur
					SET lembur_cancel = '1',
							lembur_cancel_date = now()
					WHERE lembur_no = '$p_lembur_no' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
}
?>