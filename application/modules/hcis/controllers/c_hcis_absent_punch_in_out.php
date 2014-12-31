<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_hcis_absent_punch_in_out extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hcis/m_hcis_absent_punch_in_out');
	}

	public function index()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=4 && $sess_login_level<=6) // manager ke bawah
		{	
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','punch_in_out');
			
			$p_nik = $this->session->userdata('karyawan_nik');
			
			$data['p_nik'] = $p_nik;
			
			$cek_hari_ini_cuti = $this->m_hcis_absent_punch_in_out->cek_hari_ini_cuti();
			$data['cek_hari_ini_cuti'] = $cek_hari_ini_cuti;
			if ($cek_hari_ini_cuti>0)
			{
				$data['enabled_punch_in'] = "disabled";
				$data['enabled_punch_out'] = "disabled";
			}
			else
			{
				$data['enabled_punch_in'] = $this->m_hcis_absent_punch_in_out->check_punch_in($p_nik) > 0 ? "disabled" : "";
				$data['enabled_punch_out'] = $this->m_hcis_absent_punch_in_out->check_punch_in($p_nik) > 0 ? "" : "disabled";
			}
			
			$data['data_absen_today'] = $this->m_hcis_absent_punch_in_out->data_absen_today($p_nik);
			
			$data['title_content'] = "Punch In / Out";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_absent_punch_in_out';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function punch_in()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=1 && $sess_login_level<=6)
		{	
			$p_nik = $this->session->userdata('karyawan_nik');
			$punch_in = $this->m_hcis_absent_punch_in_out->punch_in($p_nik);
			if ($punch_in==TRUE)
			{
				$this->session->set_flashdata('text_alert_sukses','Sukses melakukan punch in');
				redirect('hcis/c_hcis_absent_punch_in_out/');
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function punch_out()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=1 && $sess_login_level<=6)
		{	
			$p_nik = $this->session->userdata('karyawan_nik');
			$punch_out = $this->m_hcis_absent_punch_in_out->punch_out($p_nik);
			if ($punch_out==TRUE)
			{
				$this->session->set_flashdata('text_alert_sukses','Sukses melakukan punch out');
				redirect('hcis/c_hcis_absent_punch_in_out/');
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function punch_in_late()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=1 && $sess_login_level<=6)
		{	
			$this->form_validation->set_rules('pi_late_reason','Alasan Datang Terlambat','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $this->session->userdata('karyawan_nik');
				$pi_late_reason = $this->input->post('pi_late_reason');
				$punch_in_late = $this->m_hcis_absent_punch_in_out->punch_in_late($p_nik, $pi_late_reason);
				if ($punch_in_late==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Sukses melakukan punch in');
					redirect('hcis/c_hcis_absent_punch_in_out/');
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function punch_out_early()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level>=1 && $sess_login_level<=6)
		{	
			$this->form_validation->set_rules('po_early_reason','Alasan Pulang Lebih Awal','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $this->session->userdata('karyawan_nik');
				$po_early_reason = $this->input->post('po_early_reason');
				$punch_out_early = $this->m_hcis_absent_punch_in_out->punch_out_early($p_nik, $po_early_reason);
				if ($punch_out_early==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Sukses melakukan punch out');
					redirect('hcis/c_hcis_absent_punch_in_out/');
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