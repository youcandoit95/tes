<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_dept extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('md_department/m_dept');
	}

	public function dept_index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==888)
		{
			$this->session->set_userdata('menu_active','dept');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $this->session->userdata('user_no');
			$data['dept_data'] = $this->m_dept->dept_showrecord();
			$data['title_content'] = "MASTER DATA DEPARTMENT";
			$data['width_content'] = "12";
			$data['content'] = 'md_department/v_dept';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function dept_new()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','dept');
			$this->form_validation->set_rules('dept_name','Dept. Name','required|xss_clean');
			$this->form_validation->set_rules('dept_mgr_name','Dept. Manager Name','required|xss_clean');
			$this->form_validation->set_rules('dept_email','Dept. Email','required|xss_clean');
			$this->form_validation->set_rules('dept_phone','Dept. Phone','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_deptName = $this->input->post('dept_name');
				$p_deptMgrName = $this->input->post('dept_mgr_name');
				$p_deptEmail = $this->input->post('dept_email');
				$p_deptPhone = $this->input->post('dept_phone');
				
				$cek_exist = $this->m_dept->cek_exist($p_deptName);
				// exist
				if ($cek_exist>0)
				{
					$this->session->set_flashdata('text_alert_danger','Data department '.$p_deptName.' sudah pernah dibuat');
					redirect('md_department/c_dept/dept_index');
				}
				// not exist
				else
				{
					$insert = $this->m_dept->insert_dept($p_deptName,$p_deptMgrName,$p_deptEmail,$p_deptPhone);
					if ($insert==TRUE)
					{
						$this->session->set_flashdata('text_alert_sukses','Data department berhasil '.$p_deptName.' di input');
						redirect('md_department/c_dept/dept_index');
					}
				}
			}
			else
			{
				$this->session->set_userdata('menu_active','dept');
				$this->session->set_flashdata('status_dml_dept','N');
				$data['title'] = "Management Data Department - ";
				$data['dept_data'] = $this->m_dept->dept_showrecord();
				$data['content_admin'] = 'md_department/v_dept';
				$this->load->view('template_admin',$data);
			}
		}
	}
	
	public function GO_FED()
	{
		$id = $this->input->post('FED_id');
		$data = $this->m_dept->go_fed($id);
		foreach ($data as $d)
		{
			$row['DEPT_NO'] = $d['DEPT_NO'];
			$row['DEPT_NAME'] = $d['DEPT_NAME'];
			$row['DEPT_MGR_NAME'] = $d['DEPT_MGR_NAME'];
			$row['DEPT_EMAIL'] = $d['DEPT_EMAIL'];
			$row['DEPT_PHONE'] = $d['DEPT_PHONE'];
		}
		echo json_encode($row);
	}
	
	public function dept_update()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','dept');
			$this->form_validation->set_rules('dept_name','Dept. Name','required|xss_clean');
			$this->form_validation->set_rules('dept_mgr_name','Dept. Manager Name','required|xss_clean');
			$this->form_validation->set_rules('dept_email','Dept. Email','required|xss_clean');
			$this->form_validation->set_rules('dept_phone','Dept. Phone','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_deptNo = $this->input->post('dept_no');
				$p_deptName = $this->input->post('dept_name');
				$p_deptMgrName = $this->input->post('dept_mgr_name');
				$p_deptEmail = $this->input->post('dept_email');
				$p_deptPhone = $this->input->post('dept_phone');
				
				$cek_exist = $this->m_dept->cek_exist($p_deptName);
				// exist
				if ($cek_exist>0)
				{
					$this->session->set_flashdata('text_alert_danger','Data department '.$p_deptName.' sudah pernah dibuat');
					redirect('md_department/c_dept/dept_index');
				}
				// not exist
				else
				{
					$update = $this->m_dept->update_dept($p_deptNo,$p_deptName, $p_deptMgrName, $p_deptEmail, $p_deptPhone);
					if ($update==TRUE)
					{
						$this->session->set_flashdata('text_alert_sukses','Data department berhasil di ubah');
						redirect('md_department/c_dept/dept_index');
					}
				}
			}
			else
			{
				$this->session->set_userdata('menu_active','dept');
				$data['title'] = "Management Data Department - ";
				$data['dept_data'] = $this->m_dept->dept_showrecord();
				$data['dept_name_now'] = $dept_name_c;
				$data['dept_id_now'] = $id;
				$data['content_admin'] = 'md_department/v_dept_FED';
				$this->load->view('template_admin',$data);
			}
		}
	}
	 
	public function dept_activate_ajax($id)
	{
		$activate = $this->m_dept->activate_dept_ajax($id);
		if ($activate==TRUE)
		{
			echo 'Y';
		}
		else
		{
			echo 'N';
		}
	}
	
	public function dept_delete()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','dept');
			$id = $this->input->post('DEL_id');
			$delete = $this->m_dept->delete_dept($id);
			if ($delete==TRUE)
			{
				$this->session->set_flashdata('text_alert_sukses','Data department berhasil di hapus');
				redirect('md_department/c_dept/dept_index');
			}
		}
	}
}

?>