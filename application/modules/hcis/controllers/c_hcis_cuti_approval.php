<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_hcis_cuti_approval extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hcis/m_hcis_cuti_approval');
	}
	
	public function annual_leave()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level == 3 || $sess_login_level == 4) // manager dan gm
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','annual_leave');
			
			$data['data_annual_leave'] = $this->m_hcis_cuti_approval->data_annual_leave();
			
			$data['title_content'] = "Approval Annual Leave";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_approval_annual_leave';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function approve_annual_leave()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level < 5) // selain staff dan leader
		{	
			$this->form_validation->set_rules('rcuti_no','Secret Param','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_rcuti_no = $this->input->post('rcuti_no');
				
				$approve_annual_leave = $this->m_hcis_cuti_approval->approve_annual_leave($p_rcuti_no);
				if ($approve_annual_leave==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Sukses melakukan approve cuti');
					redirect('hcis/c_hcis_cuti_approval/annual_leave');	
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function reject_annual_leave()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level < 5) // selain staff dan leader
		{	
			$this->form_validation->set_rules('rcuti_no','Secret Param','required|xss_clean');
			$this->form_validation->set_rules('reject_reason','Reject Reason','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_rcuti_no = $this->input->post('rcuti_no');
				$p_reject_reason = $this->input->post('reject_reason');
				
				$reject_annual_leave = $this->m_hcis_cuti_approval->reject_annual_leave($p_rcuti_no, $p_reject_reason);
				if ($reject_annual_leave==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Sukses melakukan reject cuti');
					redirect('hcis/c_hcis_cuti_approval/annual_leave');	
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function annual_leave_2nd_level()
	{
		$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level < 5 && $sess_karyawan_hrd == 1) // selain staff dan leader
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','annual_leave_2nd_level');
			
			$data['data_annual_leave'] = $this->m_hcis_cuti_approval->data_annual_leave_2nd_level();
			
			$data['title_content'] = "Approval Annual Leave 2nd Level - HRD";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_approval_annual_leave_2nd_level';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function approve_annual_leave_2nd_level()
	{	
		$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level < 5 && $sess_karyawan_hrd == 1) // selain staff dan leader
		{	
			$this->form_validation->set_rules('rcuti_no','Secret Param','required|xss_clean');
			$this->form_validation->set_rules('mcuti_no','Secret Param','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_rcuti_no = $this->input->post('rcuti_no');
				$p_mcuti_no = $this->input->post('mcuti_no');
				
				$cek_masih_ada_cuti = $this->m_hcis_cuti_approval->cek_masih_ada_cuti($p_rcuti_no,$p_mcuti_no);
				if ($cek_masih_ada_cuti==false)
				{
					$this->session->set_flashdata('text_alert_warning','Sisa cuti sudah tidak tersedia , harap me-reject cuti tersebut ');
					redirect('hcis/c_hcis_cuti_approval/annual_leave_2nd_level');	
				}
				else
				{
					$approve_annual_leave_2nd_level = $this->m_hcis_cuti_approval->approve_annual_leave_2nd_level($p_rcuti_no, $p_mcuti_no);
					if ($approve_annual_leave_2nd_level==TRUE)
					{
						$this->session->set_flashdata('text_alert_sukses','Sukses melakukan approve cuti 2nd level - HRD ');
						redirect('hcis/c_hcis_cuti_approval/annual_leave_2nd_level');	
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
	
	public function reject_annual_leave_2nd_level()
	{
		$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_nik = $this->session->userdata('karyawan_nik');
		if ($sess_login_level < 5 && $sess_karyawan_hrd == 1) // selain staff dan leader
		{	
			$this->form_validation->set_rules('rcuti_no','Secret Param','required|xss_clean');
			$this->form_validation->set_rules('reject_reason','Reject Reason','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_rcuti_no = $this->input->post('rcuti_no');
				$p_reject_reason = $this->input->post('reject_reason');
				
				$reject_annual_leave_2nd_level = $this->m_hcis_cuti_approval->reject_annual_leave_2nd_level($p_rcuti_no, $p_reject_reason);
				if ($reject_annual_leave_2nd_level==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Sukses melakukan reject cuti 2nd level - HRD');
					redirect('hcis/c_hcis_cuti_approval/annual_leave_2nd_level');	
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