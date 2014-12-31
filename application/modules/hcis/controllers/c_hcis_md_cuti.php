<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_hcis_md_cuti extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hcis/m_hcis_md_cuti');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');
		//if ($sess_login_level==4 && $sess_karyawan_hrd==1)
		if ($sess_login_level==88)
		{
			$this->session->set_userdata('menu_active','hcis');
			$this->session->set_userdata('sub_menu_active','md_cuti');
			
			$p_nik = $this->session->userdata('karyawan_nik');
			
			$data['p_nik'] = $p_nik;
			$data['periode_tahun'] = date("Y");
			$data['data_karyawan'] = $this->m_hcis_md_cuti->data_karyawan();
			$data['data_mcuti'] = $this->m_hcis_md_cuti->data_mcuti();
			
			$data['title_content'] = "Master Data Cuti";
			$data['width_content'] = "12";
			$data['content'] = 'hcis/v_hcis_md_cuti';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function md_cuti_baru()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');
		//if ($sess_login_level==4 && $sess_karyawan_hrd==1)
		if ($sess_login_level==88)
		{
			$this->form_validation->set_rules('cmb_nik','NIK','required|xss_clean');
			$this->form_validation->set_rules('txt_jumlah_cuti','Jumlah Cuti','required|xss_clean');
			$this->form_validation->set_rules('cmb_periode_tahun','Periode','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $this->input->post('cmb_nik');
				$p_jumlah_cuti = $this->input->post('txt_jumlah_cuti');
				$p_period_year = $this->input->post('cmb_periode_tahun');
				
				if ($this->m_hcis_md_cuti->check_exist($p_nik, $p_period_year)==1)
				{
					$this->session->set_flashdata('text_alert_warning','Data tersebut sudah pernah dibuat , silahkan cek di tab data');
					redirect('hcis/c_hcis_md_cuti/');
				}
				else
				{
					$md_cuti_baru = $this->m_hcis_md_cuti->md_cuti_baru($p_nik, $p_jumlah_cuti, $p_period_year);
					if ($md_cuti_baru==TRUE)
					{
						$this->session->set_flashdata('text_alert_sukses','Master data cuti berhasil di buat');
						redirect('hcis/c_hcis_md_cuti/');
					}
					else
					{
						$this->session->set_flashdata('text_alert_danger','Master data cuti gagal di buat');
						redirect('hcis/c_hcis_md_cuti/');
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
	
	public function md_cuti_ubah()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		$sess_karyawan_hrd = $this->session->userdata('karyawan_hrd');
		//if ($sess_login_level==4 && $sess_karyawan_hrd==1)
		if ($sess_login_level==88)
		{
			$this->form_validation->set_rules('mcuti_no','secret','required|xss_clean');
			$this->form_validation->set_rules('txt_jumlah_cuti','Jumlah Cuti','required|xss_clean');
			$this->form_validation->set_rules('karyawan_nik','secret 2','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_mcuti_no = $this->input->post('mcuti_no');
				$p_jumlah_cuti = $this->input->post('txt_jumlah_cuti');
				$p_karyawan_nik = $this->input->post('karyawan_nik');
				
				$md_cuti_ubah = $this->m_hcis_md_cuti->md_cuti_ubah($p_mcuti_no, $p_jumlah_cuti, $p_karyawan_nik);
				if ($md_cuti_ubah==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Master data cuti berhasil di ubah');
					redirect('hcis/c_hcis_md_cuti/');
				}
				else
				{
					$this->session->set_flashdata('text_alert_danger','Master data cuti gagal di ubah');
					redirect('hcis/c_hcis_md_cuti/');
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