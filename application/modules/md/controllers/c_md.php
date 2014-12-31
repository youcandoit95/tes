<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_md extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level==88)
		{	
			$data['user_no'] = $this->session->userdata('user_no');
			$data['title_content'] = 'Sign In Succeed !';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}

?>