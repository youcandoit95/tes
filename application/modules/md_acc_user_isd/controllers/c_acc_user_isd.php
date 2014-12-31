<?php if (!defined('BASEPATH'))  exit ('No direct script access allowed');

class C_acc_user_isd extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('md_acc_user_isd/m_acc_user_isd');
	}
	
	public function index()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','acc_user_isd');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $this->session->userdata('user_no');
			
			$data['data_user_isd'] = $this->m_acc_user_isd->data_user_isd();
			$data['req_type'] = $this->m_acc_user_isd->data_req_type();
			$data['data_acc_user_isd'] = $this->m_acc_user_isd->data_acc_user_isd();
			
			$data['title_content'] = "MANAGEMENT ACCESS USER ISD";
			$data['width_content'] = "12";
			$data['content'] = 'md_acc_user_isd/v_acc_user_isd';
			$this->load->view('template_system',$data);
		}
	}
	
	public function insert()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
		else
		{
			$this->form_validation->set_rules('user_isd','User ISD','required');
			$this->form_validation->set_rules('req_type','Request Type','required');
			if ($this->form_validation->run()==FALSE)
			{
				$this->index();
			}
			else
			{
				$p_user_isd = $this->input->post('user_isd');
				$p_req_type  = $this->input->post('req_type');
				
				$insert = $this->m_acc_user_isd->insert($p_user_isd, $p_req_type);
				if ($insert=="1")
				{
					$this->session->set_flashdata('text_alert_sukses','Akses baru untuk USER ISD berhasil ditambahkan');
					redirect('md_acc_user_isd/c_acc_user_isd');
				}
				else if ($insert=="99")
				{
					$this->session->set_flashdata('text_alert_error','Akses sudah pernah dibuat');
					redirect('md_acc_user_isd/c_acc_user_isd');
				}
			}
		}
	}
	
	public function activate()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
		else
		{
			$this->form_validation->set_rules('acc_id','Secret Param','required');
			if ($this->form_validation->run()==FALSE)
			{
				$this->index();
			}
			else
			{
				$p_acc_id = $this->input->post('acc_id');
				
				$activate = $this->m_acc_user_isd->activate($p_acc_id);
				if ($activate=="1")
				{
					$this->session->set_flashdata('text_alert_sukses','Berhasil meng-Aktifkan akses');
					redirect('md_acc_user_isd/c_acc_user_isd');
				}
			}
		}
	}
	
	public function disactivate()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
		else
		{
			$this->form_validation->set_rules('acc_id','Secret Param','required');
			if ($this->form_validation->run()==FALSE)
			{
				$this->index();
			}
			else
			{
				$p_acc_id = $this->input->post('acc_id');
				
				$disactivate = $this->m_acc_user_isd->disactivate($p_acc_id);
				if ($disactivate=="1")
				{
					$this->session->set_flashdata('text_alert_sukses','Berhasil menon-Aktifkan akses');
					redirect('md_acc_user_isd/c_acc_user_isd');
				}
			}
		}
	}
	
}