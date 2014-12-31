<?PHP if (!defined('BASEPATH')) exit ('No direct script allowed access');
/** Controllers C_OP
 * Created by yansen April 2013
 * SD = Staff Dev , RC = Request Case, UR = User Request, SR = Status Requested , SDH = Staff dev Home , OP = On Process
 * Controllers untuk menu ON Process
 *
 *
 */
class C_OP extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('status_request/m_sr');
		$this->load->model('report/m_rep');
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
			$report = $this->m_rep->print_rep('1');
			foreach ($report as $rep)
			{
				$data['rep1'] = $rep->rep_ip;
				$data['rep2'] = $rep->rep_url;
			}
			$sess_log_username = $this->session->userdata('login_name');
			$sess_id = $this->session->userdata('login_id');
			$this->session->set_userdata('SL_Active','OP');
			$data['title'] = "On Process request :. ".$sess_log_username." .:";
			$data['SR_WR'] = $this->m_sr->WR();
			$data['SR_OP'] = $this->m_sr->SR_OP_CNT();
			$data['SR_AR'] = $this->m_sr->AR_UH($sess_id);
			$data['SR_HR'] = $this->m_sr->HR($sess_id);
			$data['SR_CR'] = $this->m_sr->CR($sess_id);
			$data['SR_WD'] = $this->m_sr->WD($sess_id);
			$data['SR_RR'] = $this->m_sr->RR($sess_id);
			$data['SR_DR'] = $this->m_sr->DR($sess_id);
			$data['SR_OP_UH_DATA'] = $this->m_sr->SR_OP_UH_DATA();
			$data['side_left'] = "user_side_left/v_sideleft";
			$data['content_module'] = "uh_op/v_OP";
			$this->load->view('template',$data);
		}
	}
}

?>