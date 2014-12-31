<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_hcis_lembur extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hcis/m_hcis_lembur');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level>=4) // dari manager kebawah
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','lembur');
			
			$data['title_content'] = "Over Time";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_lembur';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function insert_lembur()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level>=4) // dari manager kebawah
		{	
			$this->form_validation->set_rules('lembur_time_in','Over Time In','required|xss_clean');
			$this->form_validation->set_rules('lembur_time_out','Over Time Out','required|xss_clean');
			$this->form_validation->set_rules('lembur_reason','Reason','required|xss_clean');
			if ($this->form_validation->run()==true)
			{
				$p_lembur_time_in = $this->input->post('lembur_time_in');
				$p_lembur_time_out = $this->input->post('lembur_time_out');
				$p_lembur_reason = $this->input->post('lembur_reason');
				
				$insert_lembur = $this->m_hcis_lembur->insert_lembur($p_lembur_time_in, $p_lembur_time_out, $p_lembur_reason, $sess_nik);
				if ($insert_lembur==true)
				{
					$this->session->set_flashdata('text_alert_sukses','Sukses mengisi form over time ');
					redirect('hcis/c_hcis_lembur/');	
				}
				else
				{
					$this->session->set_flashdata('text_alert_danger','Gagal mengisi form over time');
						redirect('hcis/c_hcis_lembur/');	
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function data_lembur()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level>=4) // dari manager kebawah
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','data_lembur');
			
			$data['data_lembur'] = $this->m_hcis_lembur->data_lembur($sess_nik);
			
			$data['title_content'] = "Over Time";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_lembur_data';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function cancel_lembur()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level>=4) // dari manager kebawah
		{	
			$this->form_validation->set_rules('lembur_no','secret','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_lembur_no = $this->input->post('lembur_no');
				$cancel_lembur = $this->m_hcis_lembur->cancel_lembur($p_lembur_no);
				if ($cancel_lembur==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Berhasil cancel over time');
					redirect('hcis/c_hcis_lembur/data_lembur');	
				}
				else
				{
					$this->session->set_flashdata('text_alert_danger','Gagal cancel over time');
					redirect('hcis/c_hcis_lembur/data_lembur');	
				}
			}
		}
		else
		{
			redirect('logins/c_login');
		}
	}
	
}