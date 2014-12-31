<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_uh_dr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('uh_dr/m_uh_dr');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==2 || $sess_login_level==4)
		{
			$sess_nickname = $sess_login_level==4 ? "ALL PIC" : $this->session->userdata('user_nickname');
			
			$this->session->set_userdata('menu_active','done_request');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_uh_dr->data_done_request($user_no);			
			
			$data['title_content'] = "Done Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "uh_dr/v_uh_dr";
			$this->load->view('template_system',$data);
			
			$flag = $this->m_uh_dr->flag_read_notif_done($user_no);
		}
	}
}
	
?>