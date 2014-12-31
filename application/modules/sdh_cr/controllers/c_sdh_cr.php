<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_CR
 * Created by yansen Des 2013
 * 
 *
 *
 */
class C_sdh_cr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_sdh_cr');
	}
	
	public function index()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="developer")
		{
			redirect('logins/c_login');
		}
		else
		{
			/* include header */
			$this->session->set_userdata('menu_active','cancel_request');
			$user_no = $this->session->userdata('user_no');
			$data['recent_update'] = $this->m_sdh_cr->recent_update_cancel_request($user_no);
			$data['user_no'] = $user_no;
			$data['title'] = "Cancel Request ";
			$data['data_table'] = $this->m_sdh_cr->data_cancel_request($user_no);
			$data['content'] = "sdh_cr/v_sdh_cr";
			$flag_read = $this->m_sdh_cr->flag_read_notif_cancel($user_no);
			$this->load->view('template_developer',$data);
		}
	}
}

?>