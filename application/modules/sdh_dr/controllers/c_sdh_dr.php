<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_CR
 * Created by yansen Des 2013
 * 
 *
 *
 */
class C_sdh_dr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sdh_dr/m_sdh_dr');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level==1 || $sess_login_level==3)
		{
			$sess_nickname = $sess_login_level==3 ? "ALL PIC" : $this->session->userdata('user_nickname');
			
			$this->session->set_userdata('menu_active','done_request');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $user_no;
			$data['data_table'] = $this->m_sdh_dr->data_done_request($user_no);
			
			$data['title_content'] = "Done Request - ".$sess_nickname;
			$data['width_content'] = "12";
			$data['content'] = "sdh_dr/v_sdh_dr";
			$this->load->view('template_system',$data);
			
			$flag_notif = $this->m_sdh_dr->flag_read_notif_done();
		}
	}
}

?>