<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_uh_ar extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_uh_ar');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==2 || $sess_login_level==4)
		{
			$sess_nickname = $sess_login_level==4 ? "ALL PIC" : $this->session->userdata('user_nickname');
		
			$this->session->set_userdata('menu_active','all_req');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_uh_ar->data_all_request();;
			
			$data['title_content'] = "All Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "uh_ar/v_uh_ar";
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