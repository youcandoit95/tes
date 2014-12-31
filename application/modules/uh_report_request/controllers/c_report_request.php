<?PHP if (!defined('BASEPATH')) exit ('No direct script access allowed');
/** Controllers user request
 * Created by yansen April 2013
 * RC = Request Case, UR = User Request, SR = Status Requested
 * 
 *
 *
 */
class C_report_request extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_report_request');
	}
	
	public function index()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="end_user")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','report');
			$sess_log_username = $this->session->userdata('user_fname');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $user_no;
			$data['title'] = "Report Request ";
			$data['req_type'] = $this->m_report_request->req_type();
			$data['req_category'] = $this->m_report_request->req_category();
			$data['req_priority'] = $this->m_report_request->req_priority();
			$data['content'] = "uh_report_request/v_report_request";
			$this->load->view('template',$data);
		}
	}
	
	public function generate_report()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="end_user")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->form_validation->set_rules('date_from','Date From','required|xss_clean');
			$this->form_validation->set_rules('date_thru','Date Thru','required|xss_clean');
			$this->form_validation->set_rules('req_type','Request Type','xss_clean');
			$this->form_validation->set_rules('req_category','Request Category','xss_clean');
			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_userdata('menu_active','report');
				$sess_log_username = $this->session->userdata('user_fname');
				$user_no = $this->session->userdata('user_no');
				$data['user_no'] = $user_no;
				$data['title'] = "Report Request ";
				$data['req_type'] = $this->m_report_request->req_type();
				$data['req_category'] = $this->m_report_request->req_category();
				$data['req_priority'] = $this->m_report_request->req_priority();
				$data['content'] = "uh_report_request/v_report_request";
				$this->load->view('template',$data);
			}
			else
			{
				$user_no = $this->session->userdata('user_no');
				$p_date_from = $this->input->post('date_from');
				$p_date_thru = $this->input->post('date_thru');
				$p_req_type = $this->input->post('req_type');
				$p_req_category = $this->input->post('req_category');
				$data['result_generate'] = $this->m_report_request->generate_report($user_no,$p_date_from,$p_date_thru,$p_req_type,$p_req_category);
				$data['user_no'] = $user_no;
				$data['p_date_from'] = $p_date_from;
				$data['p_date_thru'] = $p_date_thru;
				$data['p_req_type'] = $p_req_type;
				$data['p_req_category'] = $p_req_category;
				$data['title'] = "Report Request ";
				$data['content'] = "uh_report_request/v_result_generate_report_request";
				$this->load->view('template',$data);
			}
		}
	}
	
	public function print_report_request()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="end_user")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->form_validation->set_rules('date_from','secret param 1','required|xss_clean');
			$this->form_validation->set_rules('date_thru','secret param 2','required|xss_clean');
			$this->form_validation->set_rules('req_type','secret param 3','xss_clean');
			$this->form_validation->set_rules('req_category','secret param 4','xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$user_no = $this->session->userdata('user_no');
				$p_date_from = $this->input->post('date_from');
				$p_date_thru = $this->input->post('date_thru');
				$p_req_type = $this->input->post('req_type');
				$p_req_category = $this->input->post('req_category');
				$data['result_generate'] = $this->m_report_request->generate_report($user_no,$p_date_from,$p_date_thru,$p_req_type,$p_req_category);
				$data['user_no'] = $user_no;
				$data['login_fname'] = $this->session->userdata('user_fname');
				$data['p_date_from'] = $p_date_from;
				$data['p_date_thru'] = $p_date_thru;
				$data['p_req_type'] = $p_req_type;
				$data['p_req_category'] = $p_req_category;
				$data['title'] = "Print Report Request ";
				$data['content'] = "uh_report_request/v_print_report_request";
				$this->load->view('template_print_uh_report',$data);
			}
			else
			{
				echo validation_errors();
			}
		}
	}
}

?>