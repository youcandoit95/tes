<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_sdh_nr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_sdh_nr');
		$this->load->model('md/m_md_developer');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1 || $sess_login_level==3)
		{
			/* include header */
			$this->session->set_userdata('menu_active','new_req');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $this->session->userdata('user_no');
			$data['total_data'] = count($this->m_sdh_nr->data_new_request($user_no));
			$data['data_table'] = $this->m_sdh_nr->data_new_request($user_no);
			$data['req_priority'] = $this->m_md_developer->data_request_priority();
			$data['title_content'] = "New Request";
			$data['width_content'] = "12";
			$data['content'] = "sdh_nr/v_sdh_nr";
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function take_request()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1)
		{
			$this->form_validation->set_rules('req_no','Secret Param 1','required|xss_clean');
			$this->form_validation->set_rules('req_est_time','Estimate Time','required|xss_clean');
			$this->form_validation->set_rules('req_priority','Priority','required|xss_clean');
			$this->form_validation->set_rules('req_priority_reason','Priority Reason','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_req_no = $this->input->post('req_no');
				$p_req_est_time = $this->input->post('req_est_time');
				$p_req_priority = $this->input->post('req_priority');
				$p_req_priority_reason = $this->input->post('req_priority_reason');
				$take_request = $this->m_sdh_nr->take_request($p_req_no,$p_req_est_time,$p_req_priority,$p_req_priority_reason);
				if ($take_request==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Anda telah mengambil request baru dengan nomor request <b>"'.$p_req_no.'"</b>');
					redirect('sdh_nr/c_sdh_nr');
				}
				else
				{
					echo "s";
				}
			}
			else
			{
				echo validation_errors();
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}
	
?>