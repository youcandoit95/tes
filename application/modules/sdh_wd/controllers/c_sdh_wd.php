<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_CR
 * Created by yansen Des 2013
 * 
 *
 *
 */
class C_sdh_wd extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_sdh_wd');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1 || $sess_login_level==3)
		{
			$sess_nickname = $sess_login_level==3 ? "ALL PIC" : $this->session->userdata('user_nickname');
		
			/* include header */
			$this->session->set_userdata('menu_active','waiting_done');
			$user_no = $this->session->userdata('user_no');
			$data['recent_update'] = $this->m_sdh_wd->recent_update_waiting_done_request($user_no);
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_sdh_wd->data_waiting_done_request($user_no);
			
			$data['title_content'] = "Waiting Done Confirmation Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "sdh_wd/v_sdh_wd";
			$this->load->view('template_system',$data);
			
			$flag_read = $this->m_sdh_wd->flag_read_notif_waiting_done($user_no);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}

?>