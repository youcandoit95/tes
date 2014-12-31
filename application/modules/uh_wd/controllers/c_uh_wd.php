<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_uh_wd extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_uh_wd');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==2 || $sess_login_level==4)
		{
			$sess_nickname = $sess_login_level==4 ? "ALL PIC" : $this->session->userdata('user_nickname');
			
			$this->session->set_userdata('menu_active','waiting_done');
			$user_no = $this->session->userdata('user_no');
			$data['recent_update'] = $this->m_uh_wd->recent_update_waiting_done($user_no);
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_uh_wd->data_waiting_done_request($user_no);
			$data['data_status'] = $this->m_uh_wd->md_status_followUp_request();
			
			$data['title_content'] = "Waiting Done Confirmation Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "uh_wd/v_uh_wd";
			$this->load->view('template_system',$data);
			
			$flag_read = $this->m_uh_wd->flag_read_notif_waiting_done($user_no);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function followUp_request()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="end_user")
		{
			redirect('logins/c_login');
		}
		else
		{
			$user_no = $this->session->userdata('user_no');
			$this->form_validation->set_rules('req_no','Secret Param 1','required|xss_clean');
			$this->form_validation->set_rules('req_status','Status','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_req_no = $this->input->post('req_no');
				$p_req_status = $this->input->post('req_status');
				$p_type_no = $this->input->post('req_type_no');
				
				if ($p_req_status==1) // done
				{
					if ($p_type_no!=3) // project || maintenance
					{
						$folder_file = str_replace("/","_",$p_req_no);
						$config['upload_path'] = './uploads/'.$folder_file.'/';
						//$config['allowed_types'] = 'zip|rar|doc|docx|xls|xlsx|pdf|jpeg|jpg|png|PNG';
						$config['allowed_types'] = '*';
						$config['overwrite'] = TRUE;
						$config['max_size'] = '0';
						$this->load->library('upload',$config);
						if ($this->upload->do_upload('f_uat'))
						{
							$data = $this->upload->data();
							$file_upload = $data['file_name'];
							$done = $this->m_uh_wd->set_done_w_uat($p_req_no,$p_req_status,$user_no,$file_upload);
							if ($done==TRUE)
							{
								$this->session->set_flashdata('msg_dml','Request No # "'.$p_req_no.'" was done');
								redirect('uh_dr/c_uh_dr');
							}
						}
						else
						{
							echo"b";
						}
					}
					else // revisi
					{
						$done = $this->m_uh_wd->set_done($p_req_no,$p_req_status,$user_no);
						if ($done==TRUE)
						{
							$this->session->set_flashdata('msg_dml','Request No # "'.$p_req_no.'" was done');
							redirect('uh_dr/c_uh_dr');
						}
					}
				}
				else if ($p_req_status==6) // revision
				{
					$this->form_validation->set_rules('req_status_reason','Status Reason','required|xss_clean');
					if ($this->form_validation->run()==TRUE)
					{
						$p_req_reason = $this->input->post('req_status_reason');
						$revision = $this->m_uh_wd->set_revision($p_req_no,$p_req_status,$p_req_reason,$user_no);
						if ($revision==TRUE)
						{
							$this->session->set_flashdata('msg_dml','You was sent request revision for "'.$p_req_no.'"');
							redirect('uh_rr/c_uh_rr');
						}
					}
				}
			}
			else
			{
				echo validation_errors();
			}
		}
	}
}

?>