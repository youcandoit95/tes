<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_personal_message extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('personal_message/m_personal_message');
		$this->load->model('status_request/m_sr');
	}
	
	public function process_new_conversation()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{	
			$this->form_validation->set_rules('id_tujuan','Secret Param','required|xss_clean');
			$this->form_validation->set_rules('tujuan','To','required|xss_clean');
			$this->form_validation->set_rules('subject','Subject','required|xss_clean');
			$this->form_validation->set_rules('message','Message','required|xss_clean');
			if ($this->form_validation->run()==FALSE)
			{
				$data['title'] = "New Conversation";
				if ($this->session->userdata('user_grid')=='Developer')
				{
					$this->session->set_userdata('SL_Active','PM');
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
					$this->session->set_userdata('SL_Active','PM');
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
				$data['content_module'] = "personal_message/v_personal_message";
				$this->load->view('template',$data);
			}
			else
			{
				$sender_id = $this->session->userdata('login_id');
				$receiver_id = $this->input->post('id_tujuan');
				$subject = $this->input->post('subject');
				$message = $this->input->post('message');
				$insert = $this->m_personal_message->new_conversation($sender_id,$receiver_id,$subject,$message);
				if ($insert==TRUE)
				{
					
				}
			}
		}
	}
	
	public function json()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{	
			$this->form_validation->set_rules('term','Key','required|xss_clean');
			if ($this->form_validation->run()==FALSE)
			{
				$return_array = array();
				$row['id'] = "";
				$row['user_name'] = "Try another key";
				$row['user_fullname'] = "result for keyword '".$key."' not found";
				$row['user_dept'] = "";
				array_push($return_array,$row);
			}
			else
			{
				$key = $this->input->post('term');
				$return_array = array();
				$d = $this->m_personal_message->json($key,'data');
				foreach ($d as $r)
				{
					$row['id'] = $r->user_id;
					$row['user_name'] = $r->user_name;
					$row['user_fullname'] = $r->user_fullName;
					$row['user_dept'] = $r->user_dept;
					array_push($return_array,$row);
				}
				if (empty($row))
				{
					$row['id'] = "";
					$row['user_name'] = "Try another key";
					$row['user_fullname'] = "result for keyword '".$key."' not found";
					$row['user_dept'] = "";
					array_push($return_array,$row);
				}
			}
				echo json_encode($return_array);
		}
	}
	
	public function conversation()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{	
			$data['title'] = "New Conversation";
			if ($this->session->userdata('user_grid')=='Developer')
			{
				$this->session->set_userdata('SL_Active','PM');
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
				$this->session->set_userdata('SL_Active','PM');
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
				$data['content_module'] = "personal_message/v_personal_message";
				$this->load->view('template',$data);
		}
	}
}

?>