<?PHP if (!defined('BASEPATH')) exit ('No direct script access allowed');

/* RC = Request Case */

class C_request_case extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('md_request_case/m_request_case');
	}
	
	public function RC_index()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','request');
			$data['title'] = "Management Data Request Case - ";
			$data['data_rc'] = $this->m_request_case->data_RC();
			$data['data_rt'] = $this->m_request_case->data_RT();
			$data['content_admin'] = "md_request_case/v_request_case";
			$this->load->view('template_admin',$data);
		}
	}
	
	public function RC_new()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','request');
			
			$rc_n = $this->input->post('new_RC_name');
			$rc_t = $this->input->post('new_RC_type');
			$rc_b = $this->input->post('new_RC_based');
			
			$this->form_validation->set_rules('new_RC_name','Request Case Name','required|xss_clean');
			$this->form_validation->set_rules('new_RC_type','Request Case Type','required|xss_clean');
			$this->form_validation->set_rules('new_RC_based','Request Case Based','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$insert = $this->m_request_case->insert_RC($rc_n,$rc_t,$rc_b);
				if ($insert==TRUE)
				{
					$this->session->set_flashdata('status_dml_dept','Y');
					$this->session->set_flashdata('msg_status_dml_dept','Taraaa! You has been created new request case');
					redirect('md_request_case/c_request_case/RC_index');
				}
			}
			else
			{
				$this->session->set_userdata('menu_active','request');
				$this->session->set_flashdata('status_dml_dept','N');
				$data['title'] = "Management Data Request Case - ";
				$data['data_rc'] = $this->m_request_case->data_RC();
				$data['data_rt'] = $this->m_request_case->data_RT();
				$data['content_admin'] = "md_request_case/v_request_case";
				$this->load->view('template_admin',$data);
			}
		}
	}
	
	public function GO_DEL()
	{
		$id = $this->input->post('FED_id');
		$delete = $this->m_request_case->delete_RC($id);
		if ($delete==TRUE)
		{
			echo "1";
		}
	}
	
	public function RC_activate($id)
	{
		$activate = $this->m_request_case->activate_RC($id);
		if ($activate==TRUE)
		{
			echo "Y";
		}
		else if ($activate==FALSE)
		{
			echo "N";
		}
	}
}

?>