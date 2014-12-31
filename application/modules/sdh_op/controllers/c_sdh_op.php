<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_sdh_op extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sdh_op/m_sdh_op');
		$this->load->model('md/m_md_developer');
		$this->load->model('md/m_md_followup_request');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1 || $sess_login_level==3)
		{
			$sess_nickname = $sess_login_level==3 ? "ALL PIC" : $this->session->userdata('user_nickname');
			
			$this->session->set_userdata('menu_active','on_process');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_sdh_op->data_on_process_request($user_no);
			$data['req_priority'] = $this->m_md_developer->data_request_priority();
			$data['data_req_status'] = $this->m_md_developer->data_status();
			$data['title_content'] = "On Process Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "sdh_op/v_sdh_op";
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function follow_up_request()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1)
		{
			$this->form_validation->set_rules('req_no','Secret Param 1','required|xss_clean');
			$this->form_validation->set_rules('req_status','Status','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_req_no = $this->input->post('req_no');
				$p_req_status = $this->input->post('req_status');
				$user_no = $this->session->userdata('user_no');
				if ($p_req_status==1) // done
				{
					$p_req_done_note_pic = $this->input->post('req_status_reason');
					$done = $this->m_md_followup_request->set_waiting_done($p_req_no,$user_no,$p_req_done_note_pic);
					if ($done==TRUE)
					{
						$this->session->set_flashdata('text_alert_sukses','Anda telah mengirim permintaan DONE request ke ISD dengan nomor request <b>"'.$p_req_no.'"</b>');
						redirect('sdh_wd/c_sdh_wd');
					}
					else
					{
						echo "a";
					}
				}
				else // hold
				{
					$this->form_validation->set_rules('req_status_reason','Status Reason','required|xss_clean');
					if ($this->form_validation->run()==TRUE)
					{
						$p_req_reason = $this->input->post('req_status_reason');
						$hold = $this->m_md_followup_request->set_hold($p_req_no,$user_no,$p_req_reason);
						if ($hold==TRUE)
						{
							$this->session->set_flashdata('text_alert_sukses','Anda telah men-HOLD request dengan nomor request <b>"'.$p_req_no.'"</b>');
							redirect('sdh_hr/c_sdh_hr');
						}
					}
				}
			}
			else
			{
				echo validation_errors();
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}

?>