<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_dept_mgr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('md_department_mgr/m_dept_mgr');
		$this->load->model('md_department/m_dept');
	}

	public function dept_mgr_index()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','dept_mgr');
			$data['title'] = "Management Data Department - ";
			$data['dept_mgr_data'] = $this->m_dept_mgr->dept_mgr_showrecord();
			$data['dept_data'] = $this->m_dept->dept_showrecord();
			$data['content_admin'] = 'md_department_mgr/v_dept_mgr';
			$this->load->view('template_admin',$data);
		}
	}
	
	public function dept_mgr_new()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','dept_mgr');
			$this->form_validation->set_rules('dept_id','Dept. Name','required|xss_clean|is_unique[tbl_dept_mgr.dept_id]');
			$this->form_validation->set_rules('new_mgr_name','Mgr. Name','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$dept_id = $this->input->post('dept_id');
				$mgr_name = $this->input->post('new_mgr_name');
				$insert = $this->m_dept_mgr->insert_dept_mgr($dept_id,$mgr_name);
				if ($insert==TRUE)
				{
					$this->session->set_flashdata('status_dml_dept','Y');
					$this->session->set_flashdata('msg_status_dml_dept','Taraaa! You has been created new department');
					redirect('md_department_mgr/c_dept_mgr/dept_mgr_index');
				}
			}
			else
			{
				$this->session->set_userdata('menu_active','dept_mgr');
				$this->session->set_flashdata('status_dml_dept','N');
				$data['title'] = "Management Data Department - ";
				$data['dept_data'] = $this->m_dept_mgr->dept_mgr_showrecord();
				$data['content_admin'] = 'md_department_mgr/v_dept_mgr';
				$this->load->view('template_admin',$data);
			}
		}
	}
	
	public function GO_FED_mgr()
	{
		$this->session->set_userdata('menu_active','dept_mgr');
		$id = $this->input->post('FED_id');
		$data['go_fed'] = $this->m_dept_mgr->go_fed_mgr($id);
		foreach($data['go_fed'] as $d)
		{
			echo $d->data;
		}
	}
	
	public function dept_mgr_update()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$id = $this->input->post('FED_mgr_id');
			$new_mgr = $this->input->post('FED_new_mgr_name');
			$this->session->set_userdata('menu_active','dept');
			$this->form_validation->set_rules('FED_new_mgr_name','New Mgr. Dept. Name','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$update = $this->m_dept_mgr->update_dept_mgr($id,$new_mgr);
				if ($update==TRUE)
				{
					$this->session->set_flashdata('status_dml_dept','Y');
					$this->session->set_flashdata('msg_status_dml_dept','Yiiippy! You has been updated data Mgr. department');
					redirect('md_department_mgr/c_dept_mgr/dept_mgr_index');
				}
			}
			else
			{
				$this->session->set_userdata('menu_active','dept_mgr');
				$data['title'] = "Management Data Department - ";
				$data['dept_data'] = $this->m_dept_mgr->dept_mgr_showrecord();
				$data['dept_name_now'] = $dept_name_c;
				$data['dept_id_now'] = $id;
				$data['content_admin'] = 'md_department_mgr/v_dept_mgr_FED';
				$this->load->view('template_admin',$data);
			}
		}
	}
	
	public function dept_mgr_activate($id)
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$activate = $this->m_dept_mgr->activate_dept_mgr($id);
			if ($activate==TRUE)
			{
				redirect('md_department_mgr/c_dept_mgr/dept_mgr_index');
			}
		}
	}
	
	public function dept_mgr_activate_ajax($id)
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$activate = $this->m_dept_mgr->activate_dept_mgr_ajax($id);
			if ($activate==TRUE)
			{
				echo 'N';
			}
			else
			{
				echo 'Y';
			}
		}
	}
	
	public function dept_mgr_delete()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','dept');
			$id = $this->input->post('DEL_id');
			$delete = $this->m_dept_mgr->delete_dept_mgr($id);
			if ($delete==TRUE)
			{
				echo '1';
			}
		}
	}
}

?>