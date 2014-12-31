<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_bug_report extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('bug_report/m_bug_report');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level>0)
		{	
			$this->session->set_userdata('menu_active','bug_report');
			
			$data['title_content'] = "Form Bug Report";
			$data['width_content'] = "12";
			$data['content'] = 'bug_report/v_bug_report';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function send_bug_report()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level>=0)
		{	
			$this->form_validation->set_rules('bug_desc','Bug Description','required|xss_clean');
			if ($this->form_validation->run()==true)
			{
				$p_bug_desc = $this->input->post('bug_desc');
				
				$send_bug_report = $this->m_bug_report->send_bug_report($p_bug_desc, $sess_nik);
				if ($send_bug_report==true)
				{
					$this->session->set_flashdata('text_alert_sukses','Thank you for your report ');
					redirect('	bug_report/c_bug_report/');	
				}
				else
				{
					$this->session->set_flashdata('text_alert_danger','send bug report');
					redirect('bug_report/c_hcis_lembur/');	
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}