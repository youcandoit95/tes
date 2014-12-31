<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_ajax_data_karyawan extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ajax/m_ajax_data_karyawan');
	}
	
	public function index()
	{
		$this->form_validation->set_rules('nik','Secret Param','required|xss_clean');
		if ($this->form_validation->run()==TRUE)
		{
			$p_nik = $this->input->post('nik');
			$data = $this->m_ajax_data_karyawan->data_karyawan($p_nik);
			if (!empty($data))
			{
				foreach ($data as $d)
				{
					$row['karyawan_nik'] = $d['karyawan_nik'];
					$row['karyawan_div_no'] = $d['karyawan_div_no'];
					$row['karyawan_div_name'] = $d['karyawan_div_name'];
					$row['karyawan_dept_no'] = $d['karyawan_dept_no'];
					$row['karyawan_dept_name'] = $d['karyawan_dept_name'];
					$row['karyawan_bagian_no'] = $d['karyawan_bagian_no'];
					$row['karyawan_bagian_name'] = $d['karyawan_bagian_name'];
					$row['karyawan_jabatan_no'] = $d['karyawan_jabatan_no'];
					$row['karyawan_jabatan_name'] = $d['karyawan_jabatan_name'];
					$row['karyawan_fullname'] = $d['karyawan_fullname'];
					$row['karyawan_address'] = $d['karyawan_address'];
					$row['karyawan_phone1'] = $d['karyawan_phone1'];
					$row['karyawan_phone2'] = $d['karyawan_phone2'];
					$row['karyawan_email'] = $d['karyawan_email'];
				}
				
				echo json_encode($row);
			}
		}
	}
}