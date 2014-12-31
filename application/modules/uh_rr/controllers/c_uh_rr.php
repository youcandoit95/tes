<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_uh_rr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_uh_rr');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==2 || $sess_login_level==4)
		{
			$sess_nickname = $sess_login_level==4 ? "ALL PIC" : $this->session->userdata('user_nickname');
			
			$this->session->set_userdata('menu_active','revision_request');
			$user_no = $this->session->userdata('user_no');
			$data['recent_update'] = $this->m_uh_rr->recent_update_revision_request($user_no);
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_uh_rr->data_revision_request($user_no);
			
			$data['title_content'] = "Revision Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "uh_rr/v_uh_rr";
			$this->load->view('template_system',$data);
			
			$flag_read = $this->m_uh_rr->flag_read_notif_revision($user_no);
		}
	}
}

?>