<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_uh_wr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_uh_wr');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==2 || $sess_login_level==4)
		{
			$sess_nickname = $sess_login_level==4 ? "ALL PIC" : $this->session->userdata('user_nickname');
			
			$this->session->set_userdata('menu_active','waiting_respond');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $this->session->userdata('user_no');
			$data['data_table'] = $this->m_uh_wr->data_waiting_respond_request($user_no);
			
			$data['title_content'] = "Waiting Respond Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "uh_wr/v_uh_wr";
			$this->load->view('template_system',$data);
		}
	}
}
	
?>