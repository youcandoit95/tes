<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_uh_cr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_uh_cr');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==2 || $sess_login_level==4)
		{
			$sess_nickname = $sess_login_level==4 ? "ALL PIC" : $this->session->userdata('user_nickname');
			
			$this->session->set_userdata('menu_active','cancel_request');
			$user_no = $this->session->userdata('user_no');
			$data['recent_update'] = $this->m_uh_cr->recent_update_cancel_request($user_no);
			$data['data_table'] = $this->m_uh_cr->data_cancel_request($user_no);
			$data['user_no'] = $user_no;
			
			$data['title_content'] = "Cancel Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "uh_cr/v_uh_cr";
			$this->load->view('template_system',$data);
			
			$flag_read = $this->m_uh_cr->flag_read_notif_cancel($user_no);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function cancel_request()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="end_user")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->form_validation->set_rules('req_no','Secret Param 1','required|xss_clean');
			$this->form_validation->set_rules('req_cancel_reason','Cancel Reason','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_req_no = $this->input->post('req_no');
				$user_no = $this->session->userdata('user_no');
				$p_cancel_reason = $this->input->post('req_cancel_reason');
				$cancel = $this->m_uh_cr->cancel_request($p_req_no,$user_no,$p_cancel_reason);
				if ($cancel==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Anda telah <b>men-CANCEL</b> request dengan nomor request <b>"'.$p_req_no.'"</b>');
					redirect('uh_cr/c_uh_cr');
				}
				else
				{
					echo "gagal";
				}
			}
		}
	}
}

?>