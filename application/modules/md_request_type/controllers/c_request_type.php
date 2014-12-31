<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_request_type extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_request_type');
	}

	public function index()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','request');
			$data['title'] = "Management Request Type - ";
			$data['data'] = $this->m_request_type->data_request_type();
			$data['content_admin'] = 'md_request_type/v_request_type';
			$this->load->view('template_admin',$data);
		}
	}
	
	public function request_type_new()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','request');
			$this->form_validation->set_rules('reqType_name','Req. Type Name','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_reqType_name = strtoupper($this->input->post('reqType_name'));
				
				$cek_exist = $this->m_request_type->cek_exist($p_reqType_name);
				// exist
				if ($cek_exist>0)
				{
					$this->session->set_userdata('menu_active','request');
					$data['error_msg'] = "Req. Type Name ".$p_reqType_name." already exist";
					$data['title'] = "Management Request Type - ";
					$data['data'] = $this->m_request_type->data_request_type();
					$data['content_admin'] = 'md_request_type/v_request_type';
					$this->load->view('template_admin',$data);
				}
				// not exist
				else
				{
					$insert = $this->m_request_type->insert_request_type($p_reqType_name);
					if ($insert==TRUE)
					{
						$this->session->set_flashdata('status_dml_dept','Y');
						$this->session->set_flashdata('msg_status_dml_dept','Taraaa! You has been created new Req. Type');
						redirect('md_request_type/c_request_type/');
					}
				}
			}
			else
			{
				$this->session->set_flashdata('status_dml','N');
				$this->session->set_userdata('menu_active','request');
				$data['title'] = "Management Request Type - ";
				$data['data'] = $this->m_request_type->data_request_type();
				$data['content_admin'] = 'md_request_type/v_request_type';
				$this->load->view('template_admin',$data);
			}
		}
	}
	
	public function GO_FED()
	{
		$id = $this->input->post('FED_id');
		$data = $this->m_request_type->go_fed($id);
		foreach ($data as $d)
		{
			$row['TYPE_NO'] = $d['TYPE_NO'];
			$row['TYPE_NAME'] = $d['TYPE_NAME'];
		}
		echo json_encode($row);
	}
	
	public function request_type_update()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','request');
			$this->form_validation->set_rules('reqType_no','Secret Key','required|xss_clean');
			$this->form_validation->set_rules('reqType_name','Req.Type Name','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_reqType_no = $this->input->post('reqType_no');
				$p_reqType_name = $this->input->post('reqType_name');
			
				$cek_exist = $this->m_request_type->cek_exist($p_reqType_name);
				// exist
				if ($cek_exist>0)
				{
					$this->session->set_userdata('menu_active','request');
					$data['error_msg_edit'] = "Req. Type Name ".$p_reqType_name." already exist";
					$data['title'] = "Management Request Type - ";
					$data['data'] = $this->m_request_type->data_request_type();
					$data['content_admin'] = 'md_request_type/v_request_type';
					$this->load->view('template_admin',$data);
				}
				else
				{
					$update = $this->m_request_type->update_request_type($p_reqType_no,$p_reqType_name);
					if ($update==TRUE)
					{
						$this->session->set_flashdata('status_dml_dept','Y');
						$this->session->set_flashdata('msg_status_dml_dept','Yiiippy! You has been updated data request type');
						redirect('md_request_type/c_request_type/');
					}
				}
			}
			else
			{
				$this->session->set_userdata('menu_active','request');
				$data['title'] = "Management Request Type - ";
				$data['data'] = $this->m_request_type->data_request_type();
				$data['content_admin'] = 'md_request_type/v_request_type';
				$this->load->view('template_admin',$data);
			}
		}
	}
	 
	public function status_activate_ajax($id)
	{
		$activate = $this->m_request_type->activate_status_ajax($id);
		if ($activate==TRUE)
		{
			echo 'Y';
		}
		else
		{
			echo 'N';
		}
	}
	/*
	public function status_delete($id)
	{
		if ($this->session->userdata('auth')!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','status');
			//$id = $this->input->post('DEL_id');
			
			//cek if it used or not
			$cek_used = $this->m_status->cek_used($id);
			if ($cek_used>0)
			{
				$this->session->set_userdata('menu_active','status');
				$this->session->set_flashdata('error_msg',"That status is being used. You can't delete it.");
				redirect('md_status/c_status/');
			}
			else
			{
				$delete = $this->m_status->delete_status($id);
				if ($delete==TRUE)
				{
					$this->session->set_flashdata('status_dml_dept','Y');
					$this->session->set_flashdata('msg_status_dml_dept','Success delete master data status.');
					redirect('md_status/c_status/');
				}
			}
		}
	}
	*/
}

?>