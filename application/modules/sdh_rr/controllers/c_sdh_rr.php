<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_sdh_rr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sdh_rr/m_sdh_rr');
		$this->load->model('md/m_md_followup_request');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1 || $sess_login_level==3)
		{
			$sess_nickname = $sess_login_level==3 ? "ALL PIC" : $this->session->userdata('user_nickname');
			/* include header */
			$this->session->set_userdata('menu_active','revision');
			$user_no = $this->session->userdata('user_no');
			$data['recent_update'] = $this->m_sdh_rr->recent_update_revision_request($user_no);
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_sdh_rr->data_revision_request($user_no);
			$data['data_req_status'] = $this->m_sdh_rr->data_status();
			
			$data['title_content'] = "Revision Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "sdh_rr/v_sdh_rr";
			$this->load->view('template_system',$data);
			
			$flag_notif = $this->m_sdh_rr->flag_read_notif_revision();
		}
	}
	
	public function follow_up_request()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="developer")
		{
			redirect('logins/c_login');
		}
		else
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
						$this->session->set_flashdata('text_alert_sukses','Anda telah mengirim permintaan DONE request ke ISD, dengan nomor request <b>"'.$p_req_no.'"</b>');
						redirect('sdh_wd/c_sdh_wd');
					}
				}
				else // op
				{
					$this->form_validation->set_rules('req_est_time','Est. Time','required|xss_clean');
					if ($this->form_validation->run()==TRUE)
					{
						$p_req_est_time = $this->input->post('req_est_time');
						$revision = $this->m_sdh_rr->revision_request($p_req_no,$p_req_est_time,$user_no);
						if ($revision==TRUE)
						{
							$this->session->set_flashdata('text_alert_sukses','Anda telah men-set ON PROCESS request, dengan nomor request <b>"'.$p_req_no.'"</b>');
							redirect('sdh_op/c_sdh_op');
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