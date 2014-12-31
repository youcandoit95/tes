<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_hcis_absent_approval extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hcis/m_hcis_absent_approval');
	}
	
	public function early_punch_out()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level == 3 || $sess_login_level == 4) // manager dan gm
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','early_punch_out');
			
			$p_nik = $this->session->userdata('karyawan_nik');
			
			$data['p_nik'] = $p_nik;
			$data['data_early_punch_out'] = $this->m_hcis_absent_approval->data_early_punch_out();
			
			$data['title_content'] = "Approval Early Punch Out";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_absent_approval_early_punch_out';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function approve_po_early()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level < 5) // selain staff dan leader
		{	
			$this->form_validation->set_rules('p_absen_no','Secret Param','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $this->session->userdata('karyawan_nik');
				$p_absen_no = $this->input->post('p_absen_no');
				
				$approve_po_early = $this->m_hcis_absent_approval->approve_po_early($p_nik, $p_absen_no);
				if ($approve_po_early==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Sukses melakukan approve early punch out');
					redirect('hcis/c_hcis_absent_approval/early_punch_out');	
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function reject_po_early()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level < 5) // selain staff dan leader
		{	
			$this->form_validation->set_rules('p_absen_no','Secret Param','required|xss_clean');
			$this->form_validation->set_rules('p_reject_reason','Reject Reason','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $this->session->userdata('karyawan_nik');
				$p_absen_no = $this->input->post('p_absen_no');
				$p_reject_reason = $this->input->post('p_reject_reason');
				
				$reject_po_early = $this->m_hcis_absent_approval->reject_po_early($p_nik, $p_absen_no, $p_reject_reason);
				if ($reject_po_early==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Sukses melakukan reject early punch out');
					redirect('hcis/c_hcis_absent_approval/early_punch_out');	
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function early_punch_out_2nd_level()
	{
		$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level < 5 && $sess_karyawan_hrd = 1) // selain staff dan leader
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','early_punch_out_2nd_level');
			
			$p_nik = $this->session->userdata('karyawan_nik');
			
			$data['p_nik'] = $p_nik;
			$data['data_early_punch_out'] = $this->m_hcis_absent_approval->data_early_punch_out_2nd_level();
			
			$data['title_content'] = "Approval Early Punch Out 2nd Level - HRD";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_absent_approval_early_punch_out_2nd_level';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function approve_po_early_2nd_level()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level < 5) // selain staff dan leader
		{	
			$this->form_validation->set_rules('p_absen_no','Secret Param','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $this->session->userdata('karyawan_nik');
				$p_absen_no = $this->input->post('p_absen_no');
				
				$approve_po_early_2nd_level = $this->m_hcis_absent_approval->approve_po_early_2nd_level($p_nik, $p_absen_no);
				if ($approve_po_early_2nd_level==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Thanks , Success approve early punch out 2nd level');
					redirect('hcis/c_hcis_absent_approval/early_punch_out_2nd_level');	
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function reject_po_early_2nd_level()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level < 5) // selain staff dan leader
		{	
			$this->form_validation->set_rules('p_absen_no','Secret Param','required|xss_clean');
			$this->form_validation->set_rules('p_reject_reason','Reject Reason','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $this->session->userdata('karyawan_nik');
				$p_absen_no = $this->input->post('p_absen_no');
				$p_reject_reason = $this->input->post('p_reject_reason');
				
				$reject_po_early_2nd_level = $this->m_hcis_absent_approval->reject_po_early_2nd_level($p_nik, $p_absen_no, $p_reject_reason);
				if ($reject_po_early_2nd_level==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Thanks , Success reject early punch out 2nd level');
					redirect('hcis/c_hcis_absent_approval/early_punch_out_2nd_level');	
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