<?PHP if (!defined('BASEPATH')) exit ('No direct script access allowed');
/** Controllers SD Home
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home
 * 
 *
 *
 */
class C_sd_home extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		/*$this->load->model('user_request/m_user_request');
		$this->load->model('sd_home/m_sd_home');
		$this->load->model('md_request_type/m_request_type');
		$this->load->model('md_request_case/m_request_case');
		$this->load->model('user_side_left/m_sideleft');
		$this->load->model('status_request/m_sr');
		$this->load->model('status_request/m_history_request');*/
	}
	
	/*
	public function SDH_Index()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$sess_log_username = $this->session->userdata('login_name');
			$this->session->set_userdata('SL_Active','WR');
			$data['title'] = "Welcome ".$sess_log_username;
			$data['request_type'] = $this->m_request_type->data_requestType_req();
			$data['request_case'] = $this->m_request_case->data_RC_default();
			$data['SR_WR'] = $this->m_sr->WR_SDH();
			$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
			$data['SR_AR'] = $this->m_sr->AR_SDH();
			$data['SR_HR'] = $this->m_sr->HR_SDH();
			$data['SR_CR'] = $this->m_sr->CR_SDH();
			$data['SR_WD'] = $this->m_sr->WD_SDH();
			$data['SR_RR'] = $this->m_sr->RR_SDH();
			$data['SR_DR'] = $this->m_sr->DR_SDH();
			$data['DATA_WR_SDH'] = $this->m_sd_home->DATA_WR_SDH();
			$data['side_left'] = "user_side_left/v_sideleft_SDH";
			$data['content_module'] = "sd_home/v_sd_home";
			$this->load->view('template',$data);
		}
	}
	
	public function SDH_NR()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$cek['NR'] = $this->m_sd_home->NR_SDH();
			foreach ($cek['NR'] as $d)
			{
				echo $d->new_req;
			}
		}
	}
	
	public function SDH_WR()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$cek['WR'] = $this->m_sideleft->WR_SDH();
			foreach ($cek['WR'] as $d)
			{
				echo $d->new_req;
			}
		}
	}
	
	public function SDH_WD()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$cek['WD'] = $this->m_sr->WD_SDH();
			foreach ($cek['WD'] as $c)
			{
				echo $c->WD;
			}
		}
	}

	public function SDH_RR()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$cek['RR'] = $this->m_sr->RR_SDH();
			foreach ($cek['RR'] as $c)
			{
				echo $c->RR;
			}
		}
	}
	
	public function SDH_CR()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$cek['CR'] = $this->m_sr->CR_SDH();
			foreach ($cek['CR'] as $c)
			{
				echo $c->CR;
			}
		}
	}
	
	public function SDH_DR()
	{
		$sess_login  = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$cek['DR'] = $this->m_sr->DR_SDH();
			foreach ($cek['DR'] as $d)
			{
				echo $d->DR;
			}
		}
	}
	
	public function SDH_FTR()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$id = $this->input->post('TR_ID');
			$get['TR'] = $this->m_sd_home->FTR_SDH($id);
			foreach ($get['TR'] as $T)
			{
				echo $T->FTR_DATA;
			}
		}
	}
	
	public function SDH_TR()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$sekarang = date('Y-m-d h:i:s');
			$now = date("d-m-Y H:i:s");
			$this->session->set_userdata('SL_Active','WR');
			$sess_id = $this->session->userdata('login_id');
			$status = $this->input->post("status");
			$UH = $this->input->post("UH");
			$EST = $this->input->post('FTR_REQ_EST');
			$addr_from = $this->input->post('addr_from');
			$REQID = $this->input->post('FTR_REQID');
			$REQ_ID_RPL = str_replace('/','_',$REQID);
			$REQ_ID_RPLC = str_replace('-','_',$REQ_ID_RPL);
			$this->form_validation->set_rules('status','Status','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$PIC = $this->session->userdata('login_id');
				if ($status=="On Process")
				{
					$this->form_validation->set_rules('FTR_REQID','Request ID','required|xss_clean');
					$this->form_validation->set_rules('FTR_REQ_EST','Estimate Time','required|xss_clean');
					if ($this->form_validation->run()==FALSE)
					{
						$sess_log_username = $this->session->userdata('login_name');
						$data['openFTR'] = "BTN_ACT_GR_".$REQ_ID_RPLC;
						$data['status_openFTR'] = "YOP";
						
						if ($addr_from=="on_process")
						{
							$this->session->set_userdata('SL_Active','OP');
							$data['title'] = "On Process request :. ".$sess_log_username." .:";
							$data['SR_OP_SDH_DATA'] = $this->m_sr->SR_OP_DTL_SDH();
							$cm = "sdh_op/v_SDH_OP";
						}
						else if ($addr_from=="hold")
						{
							$this->session->set_userdata('SL_Active','HR');
							$data['title'] = "Hold request :. ".$sess_log_username." .:";
							$data['SR_HR_SDH_DATA'] = $this->m_sr->HR_SDH_DATA();
							$cm = "sdh_hr/v_HR";
						}
						$data['request_type'] = $this->m_request_type->data_requestType_req();
						$data['request_case'] = $this->m_request_case->data_RC_default();
						$data['SR_WR'] = $this->m_sr->WR_SDH();
						$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
						$data['SR_AR'] = $this->m_sr->AR_SDH();
						$data['SR_HR'] = $this->m_sr->HR_SDH();
						$data['SR_CR'] = $this->m_sr->CR_SDH();
						$data['side_left'] = "user_side_left/v_sideleft_SDH";
						$data['content_module'] = "".$cm;
						$this->load->view('template',$data);
					}
					else
					{
						$SQL = " UPDATE tbl_request SET 
											request_PIC='$PIC', request_estimateTime='$EST', request_notification='T', request_notificationRead='YTR;$PIC', request_status='On Process',
											request_statusReason='',
											request_statusDate='$now'
										WHERE request_id='$REQID'  ";
						$OP = $this->m_sr->SR_SET($SQL);
						$insert_history = $this->m_history_request->on_process($REQID,$sess_id,$sekarang);
						if ($OP==TRUE)
						{
							$SET_SR = "true";
							$SET_MSG =  "taken request";
							$this->session->set_flashdata("status_dml_dept",'Y');
							$this->session->set_flashdata('msg_status_dml_dept','Woaaaa! You has been '.$SET_MSG.' , '.$REQID.'');
							redirect('sdh_op/c_sdh_op/SDHOP_Index');
						}
					}
				}
				
				else if ($status=="Done")
				{
					$this->form_validation->set_rules('FTR_REQID','Request ID','required|xss_clean');
					if ($this->form_validation->run()==FALSE)
					{
						$sess_log_username = $this->session->userdata('login_name');
						$data['openFTR'] = "BTN_ACT_GR_".$REQ_ID_RPLC;
						$data['status_openFTR'] = "YD";
						if (!empty($UH)) // user home
						{
							if ($UH=="Y")
							{
								if ($addr_from=="on_process")
								{
									$this->session->set_userdata('SL_Active','OP');
									$data['title'] = "On Process request :. ".$sess_log_username." .:";
									$data['SR_WR'] = $this->m_sr->WR();
									$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
									$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
									$data['SR_HR'] = $this->m_sr->HR($sess_id);
									$data['SR_CR'] = $this->m_sr->CR($sess_id);
									$data['SR_OP_UH_DATA'] = $this->m_sr->SR_OP_UH_DATA();
									$data['side_left'] = "user_side_left/v_sideleft";
									$data['content_module'] = "uh_op/v_OP";
									$this->load->view('template',$data);
								}
								else if ($addr_from=="hold")
								{
									$sess_log_username = $this->session->userdata('login_name');
									$this->session->set_userdata('SL_Active','HR');
									$data['title'] = "On Process request :. ".$sess_log_username." .:";
									$data['SR_WR'] = $this->m_sr->WR();
									$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
									$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
									$data['SR_HR'] = $this->m_sr->HR($sess_id);
									$data['SR_CR'] = $this->m_sr->CR($sess_id);
									$data['SR_HR_UH_DATA'] = $this->m_sr->HR_DATA($sess_id);
									$data['side_left'] = "user_side_left/v_sideleft";
									$data['content_module'] = "uh_hr/v_HR";
									$this->load->view('template',$data);
								}
								else if ($addr_from=="WR")
								{
									$sess_log_username = $this->session->userdata('login_name');
									$sess_id = $this->session->userdata('login_id');
									$this->session->set_userdata('SL_Active','WR');
									$data['title'] = "Waiting Respond Request ".$sess_log_username;
									$data['SR_WR'] = $this->m_sr->WR();
									$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
									$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
									$data['SR_HR'] = $this->m_sr->HR($sess_id);
									$data['SR_CR'] = $this->m_sr->CR($sess_id);
									$data['Detail_WR_UR'] = $this->m_user_request->DTL_WR_UR();
									$data['side_left'] = "user_side_left/v_sideleft";
									$data['content_module'] = "uh_wr/v_WR";
									$this->load->view('template',$data);
								}
							}
						}
						else
						{
							if ($addr_from=="on_process")
							{
								$this->session->set_userdata('SL_Active','OP');
								$data['title'] = "On Process request :. ".$sess_log_username." .:";
								$data['SR_OP_SDH_DATA'] = $this->m_sr->SR_OP_DTL_SDH();
								$cm = "sdh_op/v_SDH_OP";
							}
							else if ($addr_from=="hold")
							{
								$this->session->set_userdata('SL_Active','HR');
								$data['title'] = "Hold request :. ".$sess_log_username." .:";
								$data['SR_HR_SDH_DATA'] = $this->m_sr->HR_SDH_DATA();
								$cm = "sdh_hr/v_HR";
							}
							$data['SR_WR'] = $this->m_sr->WR_SDH();
							$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
							$data['SR_AR'] = $this->m_sr->AR_SDH();
							$data['SR_HR'] = $this->m_sr->HR_SDH();
							$data['SR_CR'] = $this->m_sr->CR_SDH();
							$data['side_left'] = "user_side_left/v_sideleft_SDH";
							$data['content_module'] = "".$cm;
							$this->load->view('template',$data);
						}
					}
					else
					{
						if (!empty($UH)) // user home
						{
							if ($UH=="Y")
							{
								$SQL = " UPDATE tbl_request SET 
												request_notification='D', request_notificationRead='YDR;$PIC', request_status='DONE',
												request_statusReason='',
												request_statusDate='$now'
												WHERE request_id='$REQID' ";
								$SET_SR = "true";
								$SET_MSG =  "set DONE request ";
								$rdrct = "uh_wd/c_WD";
								
								$done_folder = str_replace("/","_",$REQID);
								$fdone_path = 'UAT_'.$done_folder;
								if (!file_exists("uploads/".$done_folder.'/'.$fdone_path))
								{
									mkdir("uploads/".$done_folder.'/'.$fdone_path);
								}
								$config['upload_path'] = './uploads/'.$done_folder.'/'.$fdone_path.'/';
								$config['allowed_types'] = "pdf|doc|docx";
								$config['overwrite'] = TRUE;
								$config['max_size'] = '0';
								$this->load->library('upload',$config);
								foreach($_FILES as $field => $file)
								{
									// No problems with the file
									if($file['error'] == 0)
									{
										// So lets upload
										$this->upload->do_upload($field);
										$data = $this->upload->data();
										$file_name = $data['file_name'];
									}
								}
								$update_file_uat = $this->m_user_request->upload_uat($REQID,$file_name);
								$insert_history = $this->m_history_request->done($REQID,$sess_id,$sekarang);
							}
						}
						else
						{
							$SQL = " UPDATE tbl_request SET 
											request_notification='W', request_notificationRead='YWD;$PIC', request_status='Waiting_confirmation_DONE',
											request_statusReason='',request_statusDate='$now'
											WHERE request_id='$REQID'  ";
							$SET_SR = "true";
							$SET_MSG = "sent status done to user for ";
							$rdrct = "sdh_wd/c_WD";
							$insert_history = $this->m_history_request->sent_done($REQID,$sess_id,$sekarang);
						}
						$WD = $this->m_sr->SR_SET($SQL);
						if ($WD==TRUE)
						{
							
							$this->session->set_flashdata("status_dml_dept",'Y');
							$this->session->set_flashdata('msg_status_dml_dept','Woaaaa! You has been '.$SET_MSG.' , '.$REQID.'');
							redirect(''.$rdrct);
						}
					}
				}
				
				else if ($status=="Hold")
				{
					$this->form_validation->set_rules('FTR_REQID','Request ID','required|xss_clean');
					$this->form_validation->set_rules('FTR_REQ_Reason','Reason','required|xss_clean');
					if ($this->form_validation->run()==FALSE)
					{
						$data['openFTR'] = "BTN_ACT_GR_".$REQ_ID_RPLC;
						$data['status_openFTR'] = "YH";
						$sess_log_username = $this->session->userdata('login_name');
						if ($addr_from=="on_process")
						{
							$this->session->set_userdata('SL_Active','OP');
							$data['title'] = "On Process request :. ".$sess_log_username." .:";
							$data['SR_OP_SDH_DATA'] = $this->m_sr->SR_OP_DTL_SDH();
							$cm = "sdh_op/v_SDH_OP";
						}
						else if ($addr_from=="hold")
						{
							$this->session->set_userdata('SL_Active','HR');
							$data['title'] = "Hold request :. ".$sess_log_username." .:";
							$data['SR_HR_SDH_DATA'] = $this->m_sr->HR_SDH_DATA();
							$cm = "sdh_hr/v_HR";
						}
						
						$data['SR_WR'] = $this->m_sr->WR_SDH();
						$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
						$data['SR_AR'] = $this->m_sr->AR_SDH();
						$data['SR_HR'] = $this->m_sr->HR_SDH();
						$data['SR_CR'] = $this->m_sr->CR_SDH();
						$data['SR_WD'] = $this->m_sr->WD_SDH();
						$data['SR_RR'] = $this->m_sr->RR_SDH();
						$data['SR_DR'] = $this->m_sr->DR_SDH();
						$data['side_left'] = "user_side_left/v_sideleft_SDH";
						$data['content_module'] = "".$cm;
						$this->load->view('template',$data);
					}
					else
					{
						$now = date("d-m-Y H:i:s");
						$reason = $this->input->post('FTR_REQ_Reason');
						$SQL = " UPDATE tbl_request SET 
										request_notification='H', request_notificationRead='YHR;$PIC', request_status='HOLD' ,request_statusDate='$now', request_estimateTime='',request_statusReason='$reason'
										WHERE request_id='$REQID' AND request_PIC='$PIC' ";
						$H = $this->m_sr->SR_SET($SQL);
						$insert_history = $this->m_history_request->hold($REQID,$sess_id,$reason,$sekarang);
						if ($H==TRUE)
						{
							$SET_SR = "true";
							$SET_MSG =  "HOLD request";
							$this->session->set_flashdata("status_dml_dept",'Y');
							$this->session->set_flashdata('msg_status_dml_dept','Woaaaa! You has been '.$SET_MSG.' , '.$REQID.'');
							redirect('sdh_hr/C_HR');
						}
					}
				}
				
				else if ($status=="Cancel")
				{
					$this->form_validation->set_rules('FTR_REQID','Request ID','required|xss_clean');
					$this->form_validation->set_rules('FTR_REQ_Reason','Reason','required|xss_clean');
					if ($this->form_validation->run()==FALSE)
					{
						$data['openFTR'] = "BTN_ACT_GR_".$REQ_ID_RPLC;
						$data['status_openFTR'] = "YC";
						$sess_log_username = $this->session->userdata('login_name');
						if (!empty($UH)) // user home
						{
							if ($UH=="Y")
							{
								if ($addr_from=="on_process")
								{
									$this->session->set_userdata('SL_Active','OP');
									$data['title'] = "On Process request :. ".$sess_log_username." .:";
									$data['SR_WR'] = $this->m_sr->WR();
									$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
									$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
									$data['SR_HR'] = $this->m_sr->HR($sess_id);
									$data['SR_CR'] = $this->m_sr->CR($sess_id);
									$data['SR_OP_UH_DATA'] = $this->m_sr->SR_OP_UH_DATA();
									$data['side_left'] = "user_side_left/v_sideleft";
									$data['content_module'] = "uh_op/v_OP";
									$this->load->view('template',$data);
								}
								else if ($addr_from=="hold")
								{
									$sess_log_username = $this->session->userdata('login_name');
									$this->session->set_userdata('SL_Active','HR');
									$data['title'] = "On Process request :. ".$sess_log_username." .:";
									$data['SR_WR'] = $this->m_sr->WR();
									$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
									$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
									$data['SR_HR'] = $this->m_sr->HR($sess_id);
									$data['SR_CR'] = $this->m_sr->CR($sess_id);
									$data['SR_HR_UH_DATA'] = $this->m_sr->HR_DATA($sess_id);
									$data['side_left'] = "user_side_left/v_sideleft";
									$data['content_module'] = "uh_hr/v_HR";
									$this->load->view('template',$data);
								}
								else if ($addr_from=="WR")
								{
									$sess_log_username = $this->session->userdata('login_name');
									$sess_id = $this->session->userdata('login_id');
									$this->session->set_userdata('SL_Active','WR');
									$data['title'] = "Waiting Respond Request ".$sess_log_username;
									$data['SR_WR'] = $this->m_sr->WR();
									$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
									$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
									$data['SR_HR'] = $this->m_sr->HR($sess_id);
									$data['SR_CR'] = $this->m_sr->CR($sess_id);
									$data['Detail_WR_UR'] = $this->m_user_request->DTL_WR_UR();
									$data['side_left'] = "user_side_left/v_sideleft";
									$data['content_module'] = "uh_wr/v_WR";
									$this->load->view('template',$data);
								}
							}
						}
						else
						{
							if ($addr_from=="on_process")
							{
								$this->session->set_userdata('SL_Active','OP');
								$data['title'] = "On Process request :. ".$sess_log_username." .:";
								$data['SR_OP_SDH_DATA'] = $this->m_sr->SR_OP_DTL_SDH();
								$cm = "sdh_op/v_SDH_OP";
							}
							else if ($addr_from=="hold")
							{
								$this->session->set_userdata('SL_Active','HR');
								$data['title'] = "Hold request :. ".$sess_log_username." .:";
								$data['SR_HR_SDH_DATA'] = $this->m_sr->HR_SDH_DATA();
								$cm = "sdh_hr/v_HR";
							}
							$data['SR_WR'] = $this->m_sr->WR_SDH();
							$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
							$data['SR_AR'] = $this->m_sr->AR_SDH();
							$data['SR_HR'] = $this->m_sr->HR_SDH();
							$data['SR_CR'] = $this->m_sr->CR_SDH();
							$data['SR_CR_SDH_DATA'] = $this->m_sr->CR_SDH_DATA();
							$data['side_left'] = "user_side_left/v_sideleft_SDH";
							$data['content_module'] = "".$cm;
							$this->load->view('template',$data);
						}
					}
					else
					{
						$now = date("d-m-Y H:i:s");
						if (!empty($UH)) // user home
						{
							if ($UH=="Y")
							{
								$reason = $this->input->post('FTR_REQ_Reason');
								$SQL = " UPDATE tbl_request SET 
												request_notification='C', request_notificationRead='YCR;$PIC', request_status='CANCEL' , request_cancel='Y', request_statusDate='$now',request_statusReason='$reason'
												WHERE request_id='$REQID' AND request_userIdRequested='$PIC' ";
								$C = $this->m_sr->SR_SET($SQL);
								$this->m_history_request->cancel($REQID,$sess_id,$reason,$sekarang);
								if ($C==TRUE)
								{
									$SET_SR = "true";
									$SET_MSG =  "CANCEL request";
									$this->session->set_flashdata("status_dml_dept",'Y');
									$this->session->set_flashdata('msg_status_dml_dept','Woaaaa! You has been '.$SET_MSG.' , '.$REQID.'');
									redirect('uh_cr/c_CR');
								}
							}
						}
						else
						{
						$reason = $this->input->post('FTR_REQ_Reason');
						$SQL = " UPDATE tbl_request SET 
										request_notification='C', request_notificationRead='YCR;$PIC', request_status='CANCEL' , request_cancel='Y',request_statusDate='$now', request_estimateTime='',request_statusReason='$reason'
										WHERE request_id='$REQID' AND request_PIC='$PIC' ";
						$C = $this->m_sr->SR_SET($SQL);
						$this->m_history_request->cancel($REQID,$sess_id,$reason,$sekarang);
						if ($C==TRUE)
						{
							$SET_SR = "true";
							$SET_MSG =  "CANCEL request";
							$this->session->set_flashdata("status_dml_dept",'Y');
							$this->session->set_flashdata('msg_status_dml_dept','Woaaaa! You has been '.$SET_MSG.' , '.$REQID.'');
							redirect('sdh_cr/C_CR');
						}
						}
					}
				}
				
				else if ($status=="Revision")
				{
					$this->form_validation->set_rules('FTR_REQID','Request ID','required|xss_clean');
					$this->form_validation->set_rules('FTR_REQ_Reason','Reason','required|xss_clean');
					if ($this->form_validation->run()==FALSE)
					{
						$data['openFTR'] = "BTN_ACT_GR_".$REQ_ID_RPLC;
						$data['status_openFTR'] = "YR";
						$sess_log_username = $this->session->userdata('login_name');
						if (!empty($UH)) // user home
						{
							if ($UH=="Y")
							{
								if ($addr_from=="WD")
								{
									$sess_log_username = $this->session->userdata('login_name');
									$sess_id = $this->session->userdata('login_id');
									$this->session->set_userdata('SL_Active','WD');
									$data['title'] = "Waiting Respond Request ".$sess_log_username;
									$data['SR_WR'] = $this->m_sr->WR();
									$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
									$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
									$data['SR_HR'] = $this->m_sr->HR($sess_id);
									$data['SR_CR'] = $this->m_sr->CR($sess_id);
									$data['SR_WD'] = $this->m_sr->WD($sess_id);
									$data['WD'] = $this->m_sr->WD_DATA($sess_id);
									$data['side_left'] = "user_side_left/v_sideleft";
									$data['content_module'] = "uh_wd/v_WD";
									$this->load->view('template',$data);
								}
							}
						}
						else
						{
							if ($addr_from=="WD")
							{
								$this->session->set_userdata('SL_Active','WD');
								$data['title'] = "On Process request :. ".$sess_log_username." .:";
								$data['SR_OP_SDH_DATA'] = $this->m_sr->SR_OP_DTL_SDH();
								$cm = "sdh_op/v_SDH_OP";
							}
							$data['SR_WR'] = $this->m_sr->WR_SDH();
							$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
							$data['SR_AR'] = $this->m_sr->AR_SDH();
							$data['SR_HR'] = $this->m_sr->HR_SDH();
							$data['SR_CR'] = $this->m_sr->CR_SDH();
							$data['SR_CR_SDH_DATA'] = $this->m_sr->CR_SDH_DATA();
							$data['side_left'] = "user_side_left/v_sideleft_SDH";
							$data['content_module'] = "".$cm;
							$this->load->view('template',$data);
						}
					}
					else
					{
						$now = date("d-m-Y H:i:s");
						if (!empty($UH)) // user home
						{
							if ($UH=="Y")
							{
								$reason = $this->input->post('FTR_REQ_Reason');
								$SQL = " UPDATE tbl_request SET 
												request_notification='R', request_notificationRead='YRR;$PIC', request_status='REVISION' ,request_statusDate='$now', request_estimateTime='', request_statusReason='$reason'
												WHERE request_id='$REQID' AND request_userIdRequested='$PIC' ";
								$R = $this->m_sr->SR_SET($SQL);
								$this->m_history_request->sent_revision($REQID,$sess_id,$reason,$sekarang);
								if ($R==TRUE)
								{
									$SET_SR = "true";
									$SET_MSG =  "Sent Revision request";
									$this->session->set_flashdata("status_dml_dept",'Y');
									$this->session->set_flashdata('msg_status_dml_dept','Woaaaa! You has been '.$SET_MSG.' , '.$REQID.'');
									redirect('uh_cr/c_CR');
								}
							}
						}
						else
						{
						$reason = $this->input->post('FTR_REQ_Reason');
						$SQL = " UPDATE tbl_request SET 
										request_notification='C', request_notificationRead='YCR;$PIC', request_status='CANCEL' , request_cancel='Y',request_statusDate='$now', request_estimateTime='',request_statusReason='$reason'
										WHERE request_id='$REQID' AND request_PIC='$PIC' ";
						$C = $this->m_sr->SR_SET($SQL);
						$insert_history = $this->m_history_request->cancel($REQID,$sess_id,$reason,$sekarang);
						if ($C==TRUE)
						{
							$SET_SR = "true";
							$SET_MSG =  "CANCEL request";
							$this->session->set_flashdata("status_dml_dept",'Y');
							$this->session->set_flashdata('msg_status_dml_dept','Woaaaa! You has been '.$SET_MSG.' , '.$REQID.'');
							redirect('sdh_cr/C_CR');
						}
						}
					}
				}
			}
			else
			{
				$sess_log_username = $this->session->userdata('login_name');
				$data['openFTR'] = "BTN_ACT_GR_".$REQ_ID_RPLC;
				$data['status_openFTR'] = "Y";
				if ($addr_from=="on_process")
				{
					if (!empty($UH))
					{
						if ($UH=="Y")
						{
							$sess_log_username = $this->session->userdata('login_name');
							$this->session->set_userdata('SL_Active','OP');
							$data['title'] = "On Process request :. ".$sess_log_username." .:";
							$data['SR_WR'] = $this->m_sr->WR();
							$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
							$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
							$data['SR_HR'] = $this->m_sr->HR($sess_id);
							$data['SR_CR'] = $this->m_sr->CR($sess_id);
							$data['SR_OP_UH_DATA'] = $this->m_sr->SR_OP_UH_DATA();
							$data['side_left'] = "user_side_left/v_sideleft";
							$data['content_module'] = "uh_op/v_OP";
							$this->load->view('template',$data);
						}
					}
					else
					{
					$this->session->set_userdata('SL_Active','OP');
					$data['title'] = "On Process request :. ".$sess_log_username." .:";
					$data['SR_WR'] = $this->m_sr->WR_SDH();
					$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
					$data['SR_AR'] = $this->m_sr->AR_SDH();
					$data['SR_HR'] = $this->m_sr->HR_SDH();
					$data['SR_CR'] = $this->m_sr->CR_SDH();
					$data['SR_OP_SDH_DATA'] = $this->m_sr->SR_OP_DTL_SDH();
					$cm = "sdh_op/v_SDH_OP";
					$data['side_left'] = "user_side_left/v_sideleft_SDH";
					$data['content_module'] = "".$cm;
					$this->load->view('template',$data);
					}
				}
				else if ($addr_from=="hold")
				{
					if (!empty($UH))
					{
						if ($UH=="Y")
						{
							$sess_log_username = $this->session->userdata('login_name');
							$this->session->set_userdata('SL_Active','HR');
							$data['title'] = "On Process request :. ".$sess_log_username." .:";
							$data['SR_WR'] = $this->m_sr->WR();
							$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
							$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
							$data['SR_HR'] = $this->m_sr->HR($sess_id);
							$data['SR_CR'] = $this->m_sr->CR($sess_id);
							$data['SR_HR_UH_DATA'] = $this->m_sr->HR_DATA($sess_id);
							$data['side_left'] = "user_side_left/v_sideleft";
							$data['content_module'] = "uh_hr/v_HR";
							$this->load->view('template',$data);
						}
					}
					else
					{
						$this->session->set_userdata('SL_Active','HR');
						$data['title'] = "Hold request :. ".$sess_log_username." .:";
						$data['SR_WR'] = $this->m_sr->WR_SDH();
						$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
						$data['SR_AR'] = $this->m_sr->AR_SDH();
						$data['SR_HR'] = $this->m_sr->HR_SDH();
						$data['SR_CR'] = $this->m_sr->CR_SDH();
						$data['SR_HR_SDH_DATA'] = $this->m_sr->HR_SDH_DATA();
						$cm = "sdh_hr/v_HR";
						$data['side_left'] = "user_side_left/v_sideleft_SDH";
						$data['content_module'] = "".$cm;
						$this->load->view('template',$data);
					}
				}
				else if ($addr_from=="WD")
				{
					if (!empty($UH))
					{
						if ($UH=="Y")
						{
							$sess_log_username = $this->session->userdata('login_name');
							$sess_id = $this->session->userdata('login_id');
							$this->session->set_userdata('SL_Active','WD');
							$data['title'] = "Waiting Confirmation Done ".$sess_log_username;
							$data['SR_WR'] = $this->m_sr->WR();
							$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
							$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
							$data['SR_HR'] = $this->m_sr->HR($sess_id);
							$data['SR_CR'] = $this->m_sr->CR($sess_id);
							$data['SR_WD'] = $this->m_sr->WD($sess_id);
							$data['SR_RR'] = $this->m_sr->RR($sess_id);
							$data['WD'] = $this->m_sr->WD_DATA($sess_id);
							$data['side_left'] = "user_side_left/v_sideleft";
							$data['content_module'] = "uh_wd/v_WD";
							$this->load->view('template',$data);
						}
					}
					else
					{
						echo"<script Language='javascript'>alert('Please don't disturb development system');</script>";
						redirect('logins/c_login');
					}
				}
			}
			
		}
	}
	
	public function SDH_CTR()
	{
		$id = $this->input->post('id');
		$data['SR_CTR'] = $this->m_sr->SR_CTR($id);
		$data['SR_CTR_CNT'] = $this->m_sr->SR_CTR_CNT();
		foreach ($data['SR_CTR_CNT'] as $p)
		{
			$exec = $p->jml;
		}
		
		if ($exec>0)
		{
			foreach ($data['SR_CTR'] as $S)
			{
				$NR[] = $S->request_notificationRead;
				$REQ_ID[] = $S->request_id;
				$PIC[] = $S->username_exec;
				$PICnREQ_ID[] = $S->username_exec."+".$S->request_id;
				$nr_cek[] = $S->request_notificationRead;
			}
			
			if (!empty($nr_cek[0]))
			{
				$NR_implode = implode("|",$NR);
				$REQ_ID_implode = implode(";",$REQ_ID);
				$PIC_implode = implode(";",$PIC);
				$PICnREQ_ID_implode = implode(";",$PICnREQ_ID);
				
				$NR_explode = explode("|",$NR_implode);
				$REQ_ID_explode = explode(";",$REQ_ID_implode);
				$PIC_explode = explode(";",$PIC_implode);
				$PICnREQ_ID_explode = explode(";",$PICnREQ_ID_implode);
				
				$NR_cnt = count($NR_explode);
				$REQ_ID_cnt = count($REQ_ID_explode);
				$PIC_cnt = count($PIC_explode);
				$PICnREQ_ID_cnt = count($PICnREQ_ID_explode);
				
				
				for ($x=0; $x<$NR_cnt; $x++)
				{
					$NR_data = explode(";",$NR_explode[$x]);
					$NR_data_cnt = count($NR_data);
					for ($y=1; $y<$NR_data_cnt; $y++)
					{
						if ($NR_data[$y]!=$id)
						{
							$req_id_willNotif[] = $NR_data[$y-1]."+".$PICnREQ_ID_explode[$x];
						}				
					}
				}
				
				if (!empty($req_id_willNotif))
				{
					$req_id_willNotif_implode = implode(";",$req_id_willNotif);
					$req_id_willNotif_explode = explode(";",$req_id_willNotif_implode);
					$req_id_willNotif_cnt = count($req_id_willNotif_explode);
					echo $req_id_willNotif_implode;
					
					/*for ($xx=0; $xx<$NR_cnt; $xx++)
					{
						$this->m_sr->SR_CTR_UPDATE($id,$REQ_ID_explode[$xx]);
					}*/
					/*
				}
				else
				{
					echo "nothing";
				}
			}
			else
			{
				echo "nothing";
			}
		}
		else
		{
			echo "nothing";
		}
		
	}
	
	public function SDH_CHR()
	{
		$data['SR_HR'] = $this->m_sr->HR_SDH();
		foreach ($data['SR_HR'] as $SR_HR)
		{
			echo $SR_HR->HR;
		}
	}
	*/
}

?>