<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_hcis_absent_report extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hcis/m_hcis_absent_report');
		$this->load->model('md_karyawan/m_md_karyawan');
	}
	
	public function index_your_absent()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=4) // dari manager kebawah
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','report_your_absen');
			
			$p_nik = $this->session->userdata('karyawan_nik');
			
			$data['p_nik'] = $p_nik;
			
			$data['title_content'] = "Report Your Absent";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_absent_report_your';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function generate_your_absent()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=4) // dari manager kebawah
		{	
			$this->form_validation->set_rules('generate','secret param','required|xss_clean');
			$this->form_validation->set_rules('date_from','Date From','required|xss_clean');
			$this->form_validation->set_rules('date_thru','Date Thru','required|xss_clean');
			if ($this->form_validation->run()==true)
			{
				$p_nik = $this->session->userdata('karyawan_nik');
				$p_date_from = $this->input->post('date_from');
				$p_date_thru = $this->input->post('date_thru');
				
				$data['p_date_from'] = $p_date_from;
				$data['p_date_thru'] = $p_date_thru;
				$data['data_absent'] = $this->m_hcis_absent_report->data_your_absent($p_nik, $p_date_from, $p_date_thru);
				
				$data['title_content'] = "Report Your Absent";
				$data['width_content'] = "12";
				$data['content'] = 'hcis/v_hcis_absent_report_your';
				$this->load->view('template_system',$data);
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function index_team_absent()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');
		if ($sess_login_level<=4) // dari manager kebawah
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','report_team_absen');
			
			$p_nik = $this->session->userdata('karyawan_nik');
			$p_jabatan = $this->session->userdata('karyawan_jabatan_no');
			$p_div_no = $this->session->userdata('karyawan_div_no');
			$p_div_name = $this->session->userdata('karyawan_div_name');
			$p_dept_no = $this->session->userdata('karyawan_dept_no');
			$p_dept_name = $this->session->userdata('karyawan_dept_name');
			$p_bagian_no = $this->session->userdata('karyawan_bagian_no');
			$p_bagian_name = $this->session->userdata('karyawan_bagian_name');
			
			$data['karyawan_hrd'] = $sess_karyawan_hrd;
			$data['p_nik'] = $p_nik;
			$data['p_jabatan'] = $p_jabatan;
			$data['p_div_no'] = $p_div_no;
			$data['p_div_name'] = $p_div_name;
			$data['p_dept_no'] = $p_dept_no;
			$data['p_dept_name'] = $p_dept_name;
			$data['p_bagian_no'] = $p_bagian_no;
			$data['p_bagian_name'] = $p_bagian_name;
			if ($p_jabatan==1 || $p_jabatan==2 || $p_jabatan==3) // top , director , gm
			{
				$data['md_dept'] = $this->m_md_karyawan->md_dept($p_div_no);
			}
			
			if ($p_jabatan==4)
			{
				$data['md_bagian'] = $this->m_md_karyawan->md_bagian($p_div_no, $p_dept_no);
			}
			$data['md_division'] = $this->m_md_karyawan->md_division();
			
			$data['title_content'] = "Report Team Absent";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_absent_report_team';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function generate_team_absent()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');
		if ($sess_login_level<=4) // dari manager kebawah
		{	
			$this->form_validation->set_rules('generate','secret param','required|xss_clean');
			$this->form_validation->set_rules('date_from','Date From','required|xss_clean');
			$this->form_validation->set_rules('date_thru','Date Thru','required|xss_clean');
			$this->form_validation->set_rules('cmb_karyawan_div_no','Division','required|xss_clean');
			$this->form_validation->set_rules('cmb_karyawan_dept_no','Departement','required|xss_clean');
			$this->form_validation->set_rules('cmb_karyawan_bagian_no','Bagian','required|xss_clean');
			if ($this->form_validation->run()==true)
			{
				$p_nik = $this->session->userdata('karyawan_nik');
				$p_date_from = $this->input->post('date_from');
				$p_date_thru = $this->input->post('date_thru');
				$p_div_no = $this->input->post('cmb_karyawan_div_no');
				$p_dept_no = $this->input->post('cmb_karyawan_dept_no');
				$p_bagian_no = $this->input->post('cmb_karyawan_bagian_no');
				
				$data['p_date_from'] = $p_date_from;
				$data['p_date_thru'] = $p_date_thru;
				$data['post_generate'] = "Y";
				$data['post_div_no'] = $p_div_no;
				$data['post_div_name'] = $this->m_hcis_absent_report->translate_div_name($p_div_no);
				$data['post_dept_no'] = $p_dept_no;
				$data['post_dept_name'] = $this->m_hcis_absent_report->translate_dept_name($p_dept_no);
				$data['post_bagian_no'] = $p_bagian_no;
				$data['post_bagian_name'] = $this->m_hcis_absent_report->translate_bagian_name($p_bagian_no);
				$data['data_absent'] = $this->m_hcis_absent_report->data_team_absent($p_date_from, $p_date_thru, $p_div_no, $p_dept_no, $p_bagian_no);
				
				$p_nik = $this->session->userdata('karyawan_nik');
				$p_jabatan = $this->session->userdata('karyawan_jabatan_no');
				$p_div_no = $this->session->userdata('karyawan_div_no');
				$p_div_name = $this->session->userdata('karyawan_div_name');
				$p_dept_no = $this->session->userdata('karyawan_dept_no');
				$p_dept_name = $this->session->userdata('karyawan_dept_name');
				$p_bagian_no = $this->session->userdata('karyawan_bagian_no');
				$p_bagian_name = $this->session->userdata('karyawan_bagian_name');
				
				$data['karyawan_hrd'] = $sess_karyawan_hrd;
				$data['p_nik'] = $p_nik;
				$data['p_jabatan'] = $p_jabatan;
				$data['p_div_no'] = $p_div_no;
				$data['p_div_name'] = $p_div_name;
				$data['p_dept_no'] = $p_dept_no;
				$data['p_dept_name'] = $p_dept_name;
				$data['p_bagian_no'] = $p_bagian_no;
				$data['p_bagian_name'] = $p_bagian_name;
				if ($p_jabatan==1 || $p_jabatan==2 || $p_jabatan==3) // top , director , gm
				{
					$data['md_dept'] = $this->m_md_karyawan->md_dept($p_div_no);
				}
				
				if ($p_jabatan==4)
				{
					$data['md_bagian'] = $this->m_md_karyawan->md_bagian($p_div_no, $p_dept_no);
				}
				$data['md_division'] = $this->m_md_karyawan->md_division();
				
				$data['title_content'] = "Report Team Absent";
				$data['width_content'] = "12";
				$data['content'] = 'hcis/v_hcis_absent_report_team';
				$this->load->view('template_system',$data);
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}