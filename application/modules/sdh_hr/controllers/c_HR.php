<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers SDH_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_HR extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('status_request/m_sr');
	}

	public function index()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$sess_log_username = $this->session->userdata('login_name');
			$this->session->set_userdata('SL_Active','HR');
			$data['title'] = "Hold request :. ".$sess_log_username." .:";
			$data['SR_WR'] = $this->m_sr->WR_SDH();
			$data['SR_OP'] = $this->m_sr->SR_OP_CNT_SDH();
			$data['SR_AR'] = $this->m_sr->AR_SDH();
			$data['SR_HR'] = $this->m_sr->HR_SDH();
			$data['SR_CR'] = $this->m_sr->CR_SDH();
			$data['SR_WD'] = $this->m_sr->WD_SDH();
			$data['SR_RR'] = $this->m_sr->RR_SDH();
			$data['SR_DR'] = $this->m_sr->DR_SDH();
			$data['SR_HR_SDH_DATA'] = $this->m_sr->HR_SDH_DATA();
			$data['side_left'] = "user_side_left/v_sideleft_SDH";
			$data['content_module'] = "sdh_hr/v_HR";
			$this->load->view('template',$data);
		}
	}
}

?>