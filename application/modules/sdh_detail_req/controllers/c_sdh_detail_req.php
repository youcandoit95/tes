<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_sdh_detail_req extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sdh_detail_req/m_sdh_detail_req');
		$this->load->model('md/m_md_developer');
		$this->load->model('sdh_hr/m_sdh_hr');
		$this->load->model('sdh_rr/m_sdh_rr');
	}
	
	public function detail_request()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1 || $sess_login_level==3)
		{
			$this->form_validation->set_rules('req_no','Secret Param','required');
			$this->form_validation->set_rules('view_content','Secret Param 2','required');
			if ($this->form_validation->run()==TRUE)
			{
				$menu_active = $this->input->post('menu_active');
				$p_req_no = $this->input->post('req_no');
				$p_view_content = $this->input->post('view_content');
				$p_view_sub_content = $this->input->post('view_sub_content');
				$user_no = $this->session->userdata('user_no');
				
				$this->session->set_userdata('menu_active',$menu_active);
				
				$data['user_no'] = $user_no;
				$data['menu_active'] = $menu_active;
				$data['detail_request'] = $this->m_sdh_detail_req->detail_request($p_req_no);
				
				$data['title_content'] = "Detail Request";
				$data['width_content'] = "12";
				$data['content'] = "sdh_detail_req/".$p_view_content;
				
				if ($sess_login_level!=3)
				{
					if (!empty($p_view_sub_content))
					{
						if ($menu_active=="on_process")
						{
							$data['req_priority'] = $this->m_md_developer->data_request_priority();
							$data['data_req_status'] = $this->m_md_developer->data_status();
						}
						else if ($menu_active=="new_req")
						{
							$data['req_priority'] = $this->m_md_developer->data_request_priority();
						}
						else if ($menu_active=="hold")
						{
							$data['data_req_status'] = $this->m_sdh_hr->data_status();
						}
						else if ($menu_active=="revision")
						{
							$data['data_req_status'] = $this->m_sdh_rr->data_status();
						}
						$data['req_no'] = $p_req_no;
						$data['title_sub_content'] = "Action";
						$data['width_sub_content'] = "12";
						$data['sub_content'] = "sdh_detail_req/".$p_view_sub_content;
					}
				}
				
				$this->load->view('template_system',$data);
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