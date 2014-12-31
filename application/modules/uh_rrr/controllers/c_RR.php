<?php if (!defined('BASEPATH')) exit ("No direct script access allowed");

class C_RR extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_request/m_user_request');
		$this->load->model('user_side_left/m_sideleft');
		$this->load->model('status_request/m_sr');
	}
	
	public function index()
	{
		$sess_log_username = $this->session->userdata('login_name');
		$sess_id = $this->session->userdata('login_id');
		$this->session->set_userdata('SL_Active','RR');
		$data['title'] = "Revision Request ".$sess_log_username;
		$data['SR_WR'] = $this->m_sr->WR();
		$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
		$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
		$data['SR_HR'] = $this->m_sr->HR($sess_id);
		$data['SR_CR'] = $this->m_sr->CR($sess_id);
		$data['SR_WD'] = $this->m_sr->WD($sess_id);
		$data['SR_RR'] = $this->m_sr->RR($sess_id);
		$data['SR_DR'] = $this->m_sr->DR($sess_id);
		$data['RR'] = $this->m_sr->RR_DATA($sess_id);
		$data['side_left'] = "user_side_left/v_sideleft";
		$data['content_module'] = "UH_RR/v_RR";
		$this->load->view('template',$data);
	}
}

?>