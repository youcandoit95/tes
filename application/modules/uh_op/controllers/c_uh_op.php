<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_uh_op extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_uh_op');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==2 || $sess_login_level==4)
		{
			$sess_nickname = $sess_login_level==4 ? "ALL PIC" : $this->session->userdata('user_nickname');
		
			/* include header */
			$this->session->set_userdata('menu_active','on_process');
			$user_no = $this->session->userdata('user_no');
			$data['recent_update'] = $this->m_uh_op->recent_update_taken_request($user_no);
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_uh_op->data_on_process_request($user_no);
			
			$data['title_content'] = "On Process Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "uh_op/v_uh_op";
			$this->load->view('template_system',$data);
			
			$flag_read = $this->m_uh_op->flag_read_notif_on_process($user_no);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}

?>