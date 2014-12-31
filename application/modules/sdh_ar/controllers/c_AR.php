<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_AR extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('status_request/m_sr');
		$this->load->model('report/m_rep');
	}
	
	public function index()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{	
			$report = $this->m_rep->print_rep('1');
			foreach ($report as $rep)
			{
				$data['rep1'] = $rep->rep_ip;
				$data['rep2'] = $rep->rep_url;
			}
			$sess_log_username = $this->session->userdata('login_name');
			$this->session->set_userdata('SL_Active','AR');
			$data['title'] = "All Request";
			$data['SR_WR'] = $this->m_sr->WR_SDH();
			$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
			$data['SR_AR'] = $this->m_sr->AR_SDH();
			$data['SR_HR'] = $this->m_sr->HR_SDH();
			$data['SR_CR'] = $this->m_sr->CR_SDH();
			$data['SR_WD'] = $this->m_sr->WD_SDH();
			$data['SR_RR'] = $this->m_sr->RR_SDH();
			$data['SR_DR'] = $this->m_sr->DR_SDH();
			$data['SR_AR_SDH_DATA'] = $this->m_sr->AR_SDH_DATA();
			$data['side_left'] = "user_side_left/v_sideleft_SDH";
			$data['content_module'] = "sdh_ar/v_AR";
			$this->load->view('template',$data);
		}
	}
}
	
?>