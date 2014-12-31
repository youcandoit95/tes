<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_sdh extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1 || $sess_login_level==3 || $sess_login_level==2 || $sess_login_level==4)
		{	
			$this->session->unset_userdata('menu_active');
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