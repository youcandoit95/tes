<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_hcis_cuti extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hcis/m_hcis_cuti');
	}

	public function index()
	{
		$sess_nik = $this->session->userdata('karyawan_nik');
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=3 && $sess_login_level<=6) // manager ke bawah
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','cuti');
			
			$data['info_sisa_cuti'] = $this->m_hcis_cuti->info_sisa_cuti($sess_nik, "1");
			$data['data_ambil_cuti_no_action'] = $this->m_hcis_cuti->data_ambil_cuti_no_action($sess_nik);
			
			$data['title_content'] = "Pengajuan Cuti";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_pengajuan_cuti';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function ambil_cuti()
	{
		$sess_nik = $this->session->userdata('karyawan_nik');
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=3 && $sess_login_level<=6) // general manager ke bawah
		{	
			$this->form_validation->set_rules('date_from','date_from','required|xss_clean');
			$this->form_validation->set_rules('date_thru','date_thru','required|xss_clean');
			$this->form_validation->set_rules('cmb_periode_cuti','Periode','required|xss_clean');
			$this->form_validation->set_rules('lama_cuti','Lama Cuti','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $sess_nik;
				$p_campuran = explode(":",$this->input->post('cmb_periode_cuti'));		
				$p_mcuti_no = $p_campuran[1];
				$p_date_from = $this->input->post('date_from');
				$p_date_thru = $this->input->post('date_thru');				
				$p_lama_cuti = $this->input->post('lama_cuti');
				$p_alasan = $this->input->post('txt_alasan');
				
				$sisa_cuti = $this->m_hcis_cuti->sisa_cuti($p_mcuti_no);
				
				// $p_date_from_convert = date('Y-m-d', strtotime($p_date_from));
				// $p_date_thru_convert = date('Y-m-d', strtotime($p_date_thru));
				// $cuti_date_from = date_create($p_date_from_convert);
				// $cuti_date_thru = date_create($p_date_thru_convert);
				// $diff_lama_cuti = date_diff($cuti_date_from, $cuti_date_thru);
				// $lama_cuti = $diff_lama_cuti->format("%a"); // 2
				// $lama_cuti = intval($lama_cuti) + 1;
				
				// echo $sisa_cuti." ".$p_lama_cuti;
				// exit();
				
				if ($p_lama_cuti > $sisa_cuti)
				{
					$this->session->set_flashdata('text_alert_warning','Sisa cuti tidak mencukupi');
					redirect('hcis/c_hcis_cuti/');	
				}
				else
				{
					$ambil_cuti = $this->m_hcis_cuti->ambil_cuti($p_nik, $p_mcuti_no, $p_date_from, $p_date_thru, $p_lama_cuti, $p_alasan);
					if ($ambil_cuti==TRUE)
					{
						$this->session->set_flashdata('text_alert_sukses','Sukses melakukan pengajuan cuti');
						redirect('hcis/c_hcis_cuti/');	
					}
					else
					{
						$this->session->set_flashdata('text_alert_danger','Gagal melakukan pengajuan cuti');
						redirect('hcis/c_hcis_cuti/');	
					}
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function cancel_cuti()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=3 && $sess_login_level<=6) // general manager ke bawah
		{
			$this->form_validation->set_rules('rcuti_no','secret','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_rcuti_no = $this->input->post('rcuti_no');
				$cancel_cuti = $this->m_hcis_cuti->cancel_cuti($p_rcuti_no);
				if ($cancel_cuti==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Berhasil cancel cuti');
					redirect('hcis/c_hcis_cuti/');	
				}
				else
				{
					$this->session->set_flashdata('text_alert_danger','Gagal cancel cuti');
					redirect('hcis/c_hcis_cuti/');	
				}
			}
		}
		else
		{
			redirect('logins/c_login');
		}
	}
	
	public function data_cuti()
	{
		$sess_nik = $this->session->userdata('karyawan_nik');
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=3 && $sess_login_level<=6) // general manager ke bawah
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','data_cuti');
			
			$data['info_sisa_cuti'] = $this->m_hcis_cuti->info_sisa_cuti($sess_nik, "1");
			$data['data_ambil_cuti'] = $this->m_hcis_cuti->data_ambil_cuti($sess_nik);
			
			$data['title_content'] = "Annual Leave";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_data_cuti';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}