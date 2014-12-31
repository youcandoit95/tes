<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_sdh_ar extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_sdh_ar');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1 || $sess_login_level==3)
		{
			$sess_nickname = $sess_login_level==3 ? "ALL PIC" : $this->session->userdata('user_nickname');
		
			$this->session->set_userdata('menu_active','all_req');
			$user_no = $this->session->userdata('user_no');
			$this->session->set_userdata('SL_Active','AR');
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_sdh_ar->data_all_request();
			
			$data['title_content'] = "All Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "sdh_ar/v_sdh_ar";
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