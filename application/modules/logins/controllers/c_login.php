<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_login extends MX_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('logins/login_model');
        $this->load->model('procedure/m_proc_schd_job');
    }
	
	public function index()
	{
		$bulan = date("m");
		
		if ($bulan==4)
		{
			$expired_cuti_per_april = $this->m_proc_schd_job->expired_cuti_per_april(); // procedure expired cuti
		}
		$tambah_cuti_berjalan = $this->m_proc_schd_job->tambah_cuti_berjalan(); // procedure tambah cuti berhalan
		
		
		$this->load->view('logins/v_login');
	}
	
	public function login()
	{
		$this->form_validation->set_rules('username','Username','required|xss_clean');
		$this->form_validation->set_rules('password','password','required|xss_clean');
		if ($this->form_validation->run()==TRUE)
		{
			$u = $this->input->post('username');
			$p = strtoupper($this->input->post('password'));
			$acak = "4ut1sm95";
			$real_pass = md5($p.$acak.$p.$p.md5($acak.$p.$acak.$p).$p);
			$login = $this->login_model->log_in($u,$real_pass);
			
			// log in sukses
			if ($login!=999)
			{
				$data_user = $this->login_model->data_user($u,$real_pass);
				foreach ($data_user as $du)
				{
					$p_karyawan_nik = $du['karyawan_nik'];
					$p_karyawan_jabatan_no = $du['karyawan_jabatan_no'];
					$this->session->set_userdata('karyawan_nik', $u);
					$this->session->set_userdata('karyawan_div_no',$du['karyawan_div_no']);
					$this->session->set_userdata('karyawan_div_name',$du['karyawan_div_name']);
					$this->session->set_userdata('karyawan_dept_no',$du['karyawan_dept_no']);
					$this->session->set_userdata('karyawan_dept_name',$du['karyawan_dept_name']);
					if ($du['karyawan_dept_no']==9)
					{
						$this->session->set_userdata('karyawan_hrd','1');
					}
					else
					{
						$this->session->set_userdata('karyawan_hrd','99');
					}
					$this->session->set_userdata('karyawan_bagian_no',$du['karyawan_bagian_no']);
					$this->session->set_userdata('karyawan_bagian_name',$du['karyawan_bagian_name']);
					$this->session->set_userdata('karyawan_fullname',$du['karyawan_fullname']);
					$this->session->set_userdata('karyawan_jabatan_no',$du['karyawan_jabatan_no']);
					$this->session->set_userdata('karyawan_jabatan_name',$du['karyawan_jabatan_name']);
					$this->session->set_userdata('karyawan_address',$du['karyawan_address']);
					$this->session->set_userdata('karyawan_phone1',$du['karyawan_phone1']);
					$this->session->set_userdata('karyawan_phone2',$du['karyawan_phone2']);
					$this->session->set_userdata('karyawan_email',$du['karyawan_email']);
				}
				
				if ($login==88) // superuser
				{
					redirect('md/c_md/');
				}
				else if ($login>=1 && $login<=6)
				{
					if ($login>=2 && $login<=6)
					{
						$this->m_proc_schd_job->generate_absen_karyawan($p_karyawan_nik, $p_karyawan_jabatan_no);
					}
					redirect('welcome_page/c_welcome_page/');
				}
			}
			else
			{
				//salah user / pass
				$this->session->set_flashdata('info','Invalid Username or Password');
				$this->session->set_flashdata('class_alert','danger');
				redirect('logins/c_login');
			}
		}
		// form validation run false
		else
		{
			$data['main_view'] = 'logins/login_view';
			$this->load->view('template/template',$data);
		}
	}
	
	public function logOut()
	{
		$this->session->sess_destroy();
		redirect('logins/c_login');
	}
}
?>