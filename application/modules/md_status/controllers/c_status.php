<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_status extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_status');
	}

	public function index()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','status');
			$data['title'] = "Management Status - ";
			$data['data'] = $this->m_status->data_status();
			$data['content_admin'] = 'md_status/v_status';
			$this->load->view('template_admin',$data);
		}
	}
	
	public function status_new()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','status');
			$this->form_validation->set_rules('status_name','Status Name','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_statusName = $this->input->post('status_name');
				
				$cek_exist = $this->m_status->cek_exist($p_statusName);
				// exist
				if ($cek_exist>0)
				{
					$this->session->set_userdata('menu_active','status');
					$data['error_msg'] = "Status Name ".$p_statusName." already exist";
					$data['title'] = "Management Status - ";
					$data['data'] = $this->m_status->data_status();
					$data['content_admin'] = 'md_status/v_status';
					$this->load->view('template_admin',$data);
				}
				// not exist
				else
				{
					$insert = $this->m_status->insert_status($p_statusName);
					if ($insert==TRUE)
					{
						$this->session->set_flashdata('status_dml_dept','Y');
						$this->session->set_flashdata('msg_status_dml_dept','Taraaa! You has been created new status');
						redirect('md_status/c_status/');
					}
				}
			}
			else
			{
				$this->session->set_userdata('menu_active','status');
				$this->session->set_flashdata('status_dml','N');
				$data['title'] = "Management Status - ";
				$data['dept_data'] = $this->m_status->data_status();
				$data['content_admin'] = 'md_status/v_status';
				$this->load->view('template_admin',$data);
			}
		}
	}
	
	public function GO_FED()
	{
		$id = $this->input->post('FED_id');
		$data = $this->m_status->go_fed($id);
		foreach ($data as $d)
		{
			$row['STATUS_NO'] = $d['STATUS_NO'];
			$row['STATUS_NAME'] = $d['STATUS_NAME'];
		}
		echo json_encode($row);
	}
	
	public function status_update()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','status');
			$this->form_validation->set_rules('status_name','Status Name','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_statusNo = $this->input->post('status_no');
				$p_statusName = $this->input->post('status_name');
				
				$cek_exist = $this->m_status->cek_exist($p_statusName);
				// exist
				if ($cek_exist>0)
				{
					$this->session->set_userdata('menu_active','status');
					$this->session->set_flashdata('error_msg',"Status Name ".$p_statusName." already exist");
					redirect('md_status/c_status/');
				}
				else
				{
					$update = $this->m_status->update_dept($p_statusNo,$p_statusName);
					if ($update==TRUE)
					{
						$this->session->set_flashdata('status_dml_dept','Y');
						$this->session->set_flashdata('msg_status_dml_dept','Yiiippy! You has been updated data status');
						redirect('md_status/c_status/');
					}
				}
			}
			else
			{
				$this->session->set_userdata('menu_active','status');
				$data['title'] = "Management Data Status - ";
				$data['dept_data'] = $this->m_dept->dept_showrecord();
				$data['dept_name_now'] = $dept_name_c;
				$data['dept_id_now'] = $id;
				$data['content_admin'] = 'md_department/v_dept_FED';
				$this->load->view('template_admin',$data);
			}
		}
	}
	 
	public function status_activate_ajax($id)
	{
		$activate = $this->m_status->activate_status_ajax($id);
		if ($activate==TRUE)
		{
			echo 'Y';
		}
		else
		{
			echo 'N';
		}
	}
	
	public function status_delete($id)
	{
		if ($this->session->userdata('auth')!="superuser")
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
}

?>