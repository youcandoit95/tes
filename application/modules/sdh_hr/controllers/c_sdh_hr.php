<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_sdh_hr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_sdh_hr');
		$this->load->model('md/m_md_followUp_request');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1 || $sess_login_level==3)
		{
			$sess_nickname = $sess_login_level==3 ? "ALL PIC" : $this->session->userdata('user_nickname');
		
			/* include header */
			$this->session->set_userdata('menu_active','hold');
			$user_no = $this->session->userdata('user_no');
			$data['recent_update'] = $this->m_sdh_hr->recent_update_hold_request($user_no);
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_sdh_hr->data_hold_request($user_no);
			$data['data_req_status'] = $this->m_sdh_hr->data_status();
			
			$data['title_content'] = "Hold Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "sdh_hr/v_sdh_hr";
			$this->load->view('template_system',$data);
			
			$this->m_sdh_hr->flag_read_hold($user_no);
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
					$done = $this->m_md_followUp_request->set_waiting_done($p_req_no,$user_no);
					if ($done==TRUE)
					{
						$this->session->set_flashdata('msg_dml','You was sent done information for Request No # <b><u>"'.$p_req_no.'"</b></u>');
						redirect('sdh_wd/c_sdh_wd');
					}
				}
				else // revision
				{
					$this->form_validation->set_rules('req_est_time','Est. Time','required|xss_clean');
					if ($this->form_validation->run()==TRUE)
					{
						$p_req_est_time = $this->input->post('req_est_time');
						$revision = $this->m_sdh_rr->revision_request($p_req_no,$p_req_est_time,$user_no);
						if ($revision==TRUE)
						{
							redirect('sdh_op/c_sdh_op');
						}
					}
				}
			}
		}
	}
}

?>