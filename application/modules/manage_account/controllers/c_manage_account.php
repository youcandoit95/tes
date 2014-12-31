<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_manage_account extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('manage_account/m_manage_account');
		$this->load->model('status_request/m_sr');
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
			$data['title'] = "Manage Account";
			if ($this->session->userdata('user_grid')=='Developer')
			{
				$data['SR_WR'] = $this->m_sr->WR_SDH();
				$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
				$data['SR_AR'] = $this->m_sr->AR_SDH();
				$data['SR_HR'] = $this->m_sr->HR_SDH();
				$data['SR_CR'] = $this->m_sr->CR_SDH();
				$data['SR_WD'] = $this->m_sr->WD_SDH();
				$data['SR_RR'] = $this->m_sr->RR_SDH();
				$data['SR_DR'] = $this->m_sr->DR_SDH();
				$data['side_left'] = "user_side_left/v_sideleft_SDH";
			}
			else
			{
				$sess_id = $this->session->userdata('login_id');
				$data['SR_WR'] = $this->m_sr->WR();
				$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
				$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
				$data['SR_HR'] = $this->m_sr->HR($sess_id);
				$data['SR_CR'] = $this->m_sr->CR($sess_id);
				$data['SR_WD'] = $this->m_sr->WD($sess_id);
				$data['SR_RR'] = $this->m_sr->RR($sess_id);
				$data['SR_DR'] = $this->m_sr->DR($sess_id);
				$data['AR_DATA'] = $this->m_sr->AR_UH_DATA();
				$data['side_left'] = "user_side_left/v_sideleft";
			}
				$data['content_module'] = "manage_account/v_manage_account";
				$this->load->view('template',$data);
		}
	}
	
	public function change_password()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->form_validation->set_rules('old_pass','Old Password','required|xss_clean');
			$this->form_validation->set_rules('new_pass','New Password','required|xss_clean');
			$this->form_validation->set_rules('conf_pass','Conf Password','required|xss_clean|matches[new_pass]');
			if ($this->form_validation->run()==FALSE)
			{
				$data['title'] = "Manage Account";
				if ($this->session->userdata('user_grid')=='Developer')
				{
					$data['SR_WR'] = $this->m_sr->WR_SDH();
					$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
					$data['SR_AR'] = $this->m_sr->AR_SDH();
					$data['SR_HR'] = $this->m_sr->HR_SDH();
					$data['SR_CR'] = $this->m_sr->CR_SDH();
					$data['SR_WD'] = $this->m_sr->WD_SDH();
					$data['SR_RR'] = $this->m_sr->RR_SDH();
					$data['SR_DR'] = $this->m_sr->DR_SDH();
					$data['side_left'] = "user_side_left/v_sideleft_SDH";
				}
				else
				{
					$sess_id = $this->session->userdata('login_id');
					$data['SR_WR'] = $this->m_sr->WR();
					$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
					$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
					$data['SR_HR'] = $this->m_sr->HR($sess_id);
					$data['SR_CR'] = $this->m_sr->CR($sess_id);
					$data['SR_WD'] = $this->m_sr->WD($sess_id);
					$data['SR_RR'] = $this->m_sr->RR($sess_id);
					$data['SR_DR'] = $this->m_sr->DR($sess_id);
					$data['AR_DATA'] = $this->m_sr->AR_UH_DATA();
					$data['side_left'] = "user_side_left/v_sideleft";
				}
				$data['content_module'] = "manage_account/v_manage_account";
				$this->load->view('template',$data);
			}
			else
			{
				$id = $this->session->userdata('login_id');
				$acak = "ASFGWGRGERHY744765*%1SDF@#";
				$old_pass = $this->input->post('old_pass');
				$new_pass = $this->input->post('conf_pass');
				$fix_old_pass = md5($old_pass.$acak.$old_pass.$old_pass.md5($acak.$old_pass.$acak.$old_pass).$old_pass);
				$fix_new_pass = md5($new_pass.$acak.$new_pass.$new_pass.md5($acak.$new_pass.$acak.$new_pass).$new_pass);
				$change_password = $this->m_manage_account->change_pass($id,$fix_old_pass,$fix_new_pass);
				if ($change_password==false)
				{
					$this->session->set_flashdata('type_alert','alert-error');
					$this->session->set_flashdata('message_alert','Wrong old password , please try again with correctly');
					redirect('manage_account/c_manage_account');
				}
				else if ($change_password==true)
				{
					$this->session->set_flashdata('type_alert','alert-success');
					$this->session->set_flashdata('message_alert','Your password has been changed');
					redirect('manage_account/c_manage_account');
				}
			}
		}
	}
}

?>