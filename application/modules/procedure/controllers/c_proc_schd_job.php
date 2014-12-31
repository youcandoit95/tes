<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_proc_schd_job extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('procedure/m_proc_schd_job');
	}

	public function index()
	{
		$this->m_proc_schd_job->generate_absen();
		// $sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		// if ($sess_login_level>=1 && $sess_login_level<=6)
		// {	
			// $this->session->set_userdata('menu_active','hcis');
			// $data['title_content'] = 'Sign In Succeed !';
			// $this->load->view('template_system',$data);
		// }
		// else
		// {
			// $this->session->sess_destroy();
			// redirect('logins/c_login');
		// }
	}
}

?>