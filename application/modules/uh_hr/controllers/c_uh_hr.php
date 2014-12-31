<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_uh_hr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('uh_hr/m_uh_hr');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==2 || $sess_login_level==4)
		{
			$sess_nickname = $sess_login_level==4 ? "ALL PIC" : $this->session->userdata('user_nickname');
			
			/* include header */
			$this->session->set_userdata('menu_active','hold');
			$user_no = $this->session->userdata('user_no');
			$data['recent_update'] = $this->m_uh_hr->recent_update_hold_request($user_no);
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_uh_hr->data_hold_request($user_no);
			
			$data['title_content'] = "Hold Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "uh_hr/v_uh_hr";
			$this->load->view('template_system',$data);
			
			//$flag_read = $this->m_uh_hr->flag_read_notif_hold($user_no);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}

?>