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
		$this->load->model('sdh_report_request/m_report_request');
	}
	
	public function index()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level>0)
		{
			$this->session->set_userdata('menu_active','report');
			$sess_log_username = $this->session->userdata('user_fname');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $user_no;
			$data['title_content'] = "Generate Report Request";
			$data['width_content'] = "8";
			$data['req_type'] = $this->m_report_request->req_type();
			$data['data_user_isd'] = $this->m_report_request->data_user_isd();
			$data['req_category'] = $this->m_report_request->req_category();
			$data['req_priority'] = $this->m_report_request->req_priority();
			$data['req_pic'] = $this->m_report_request->req_pic();
			$data['content'] = "sdh_report_request/v_report_request";
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function generate_report()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level>0)
		{
			$this->form_validation->set_rules('date_from','Date From','xss_clean');
			$this->form_validation->set_rules('date_thru','Date Thru','xss_clean');
			$this->form_validation->set_rules('req_type','Request Type','xss_clean');
			$this->form_validation->set_rules('req_category','Request Category','xss_clean');
			if ($sess_login_level==2 || $sess_login_level==4)
			{
				$this->form_validation->set_rules('req_by','Request By','xss_clean');			
			}
			$this->form_validation->set_rules('req_pic','Request PIC','xss_clean');
			if ($this->form_validation->run()==FALSE)
			{
				$this->index();
			}
			else
			{
				$user_no = $this->session->userdata('user_no');
				$p_date_from = $this->input->post('date_from');
				$p_date_thru = $this->input->post('date_thru');
				$p_req_type = $this->input->post('req_type');
				$p_req_category = $this->input->post('req_category');
				$p_req_pic = $this->input->post('req_pic');
				$p_req_by = $this->input->post('req_by');
				$data['result_generate'] = $this->m_report_request->generate_report($user_no,$p_date_from,$p_date_thru,$p_req_type,$p_req_category,$p_req_pic, $p_req_by);
				$data['user_no'] = $user_no;
				$data['p_date_from'] = $p_date_from;
				$data['p_date_thru'] = $p_date_thru;
				$data['p_req_type_id'] = $p_req_type;
				$data['p_req_type'] = $p_req_type!="" ? $this->m_report_request->translate_req_type($p_req_type) : $p_req_type;
				$data['p_req_category'] = $p_req_category!="" ? $this->m_report_request->translate_req_category($p_req_category) : $p_req_category;
				$data['p_req_by_translate'] = $p_req_by!="" ? $this->m_report_request->translate_req_by($p_req_by) : "ALL";
				$data['p_req_by'] = $p_req_by;
				$data['p_req_pic'] = $p_req_pic;
				$data['p_req_pic_name'] = empty($p_req_pic) ? "ALL" : $this->m_report_request->name_pic($p_req_pic);
				$data['title_content'] = "Result - Generate Report Request";
				$data['width_content'] = "12";
				$data['content'] = "sdh_report_request/v_result_generate_report_request";
				$this->load->view('template_system',$data);
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function print_report_request()
	{
		$sess_login_level = $this->session->userdata('user_level');
		if ($sess_login_level>0)
		{
			$this->form_validation->set_rules('date_from','secret param 1','xss_clean');
			$this->form_validation->set_rules('date_thru','secret param 2','xss_clean');
			$this->form_validation->set_rules('req_type','secret param 3','xss_clean');
			$this->form_validation->set_rules('req_category','secret param 4','xss_clean');
			$this->form_validation->set_rules('req_pic','secret param 5','xss_clean');
			$this->form_validation->set_rules('req_by','secret param 6','xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$user_no = $this->session->userdata('user_no');
				$p_date_from = $this->input->post('date_from');
				$p_date_thru = $this->input->post('date_thru');
				$p_req_type = $this->input->post('req_type');
				$p_req_category = $this->input->post('req_category');
				$p_req_pic = $this->input->post('req_pic');
				$p_req_by = $this->input->post('req_by');
				$data['result_generate'] = $this->m_report_request->generate_report($user_no,$p_date_from,$p_date_thru,$p_req_type,$p_req_category,$p_req_pic, $p_req_by);
				$data['user_no'] = $user_no;
				$data['login_fname'] = $this->session->userdata('user_fname');
				$data['p_date_from'] = $p_date_from;
				$data['p_date_thru'] = $p_date_thru;
				$data['p_req_type'] = $p_req_type!="" ? $this->m_report_request->translate_req_type($p_req_type) : $p_req_type;
				$data['p_req_category'] = $p_req_category!="" ? $this->m_report_request->translate_req_category($p_req_category) : $p_req_category;
				$data['p_req_by_translate'] = $p_req_by!="" ? $this->m_report_request->translate_req_by($p_req_by) : "ALL";
				$data['p_req_pic'] = empty($p_req_pic) ? "ALL" : $this->m_report_request->name_pic($p_req_pic);
				$data['title'] = "Print Report Request ";
				$data['content'] = "sdh_report_request/v_print_report_request";
				$this->load->view('template_print_sdh_report',$data);
			}
			else
			{
				echo validation_errors();
			}
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
}

?>