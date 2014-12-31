<?php if (!defined('BASEPATH')) exit ('No direct script allowed access');

class C_print_request extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_print_request');
	}
	
	public function index()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login=="developer" || $sess_login=="end_user")
		{
			$this->form_validation->set_rules('req_no','Secret Param 1','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_req_no = str_replace("_","/",$this->input->post('req_no'));
				/*$data['pdf_type'] = "P";
				$data['pdf_size'] = "A4";
				$data['pdf_name'] = "namarequest.pdf";*/
				$data['login_fname'] = $this->session->userdata('user_fname');
				$data['title_page'] = "Pint Request $p_req_no";
				$data['data_request'] = $this->m_print_request->print_request($p_req_no);
				$data['content'] = 'print_request/v_print_request';
				$this->load->view('template_print_pdf',$data);
			}
		}
		else
		{
			redirect('logins/c_login');
		}
	}
}

?>