<?php if (!defined('BASEPATH')) exit ('No direct script allowed access');

class C_report_request extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('report/m_report_request');
		$this->load->model('report/m_rep');
	}
	
	public function form_report_graphic()
	{
		$verified_auth = $this->session->userdata('auth');
		$verified_superuser = $this->session->userdata('superuser');
		if ($verified_auth=='true'&&$verified_superuser='Y')
		{
			$this->session->set_userdata('menu_active','reporting');
			$data['generate_report_request'] = "N";
			$data['title'] = "Graphics Reporting - ";
			$data['content_admin'] = 'report/v_report_request_graph';			
			$this->load->view('template_admin_graph',$data);
		}
		else
		{
			$this->session->set_flashdata('info','You dont have permission or your session was expired');
			$this->session->set_flashdata('class_alert','danger');
			redirect('logins/c_login');
		}
	}
	
	public function generate_report_graphic()
	{
		$this->form_validation->set_rules('date_from','From','required|xss_clean');
		$this->form_validation->set_rules('date_thru','Thru','required|xss_clean');
		if ($this->form_validation->run()==FALSE)
		{
			$this->session->set_userdata('menu_active','reporting');
			$data['title'] = "Graphics Reporting - ";
			$data['content_admin'] = 'report/v_report_request_graph';
			$this->load->view('template_admin_graph',$data);
		}
		else
		{
			$from = $this->input->post('date_from');
			$thru = $this->input->post('date_thru');
			$this->session->set_userdata('menu_active','reporting');
			$data['title'] = "Graphics Reporting - ";
			$data['content_admin'] = 'report/v_report_request_graph';
			$data['report'] = $this->m_report_request->graph($from,$thru);
			$data['generate_report_request'] = "Y";
			$this->load->view('template_admin_graph',$data);
		}
	}
	
	public function form_report_request()
	{
		$verified_auth = $this->session->userdata('auth');
		$verified_superuser = $this->session->userdata('superuser');
		if ($verified_auth=='true'&&$verified_superuser='Y')
		{
			$this->session->set_userdata('menu_active','reporting');
			$data['title'] = "Reporting - ";
			$data['request_type'] = $this->m_report_request->md_req_type('data');
			$data['request_case'] = $this->m_report_request->md_req_case('data');
			$data['content_admin'] = 'report/v_report_request';
			$this->load->view('template_admin',$data);
		}
		else
		{
			$this->session->set_flashdata('info','You dont have permission or your session was expired');
			$this->session->set_flashdata('class_alert','danger');
			redirect('logins/c_login');
		}
	}
	
	public function generate_report_request()
	{
		$verified_auth = $this->session->userdata('auth');
		$verified_superuser = $this->session->userdata('superuser');
		if ($verified_auth=='true'&&$verified_superuser='Y')
		{
			$this->form_validation->set_rules('date_from','Date Period From','required|xss_clean');
			$this->form_validation->set_rules('date_thru','Date Period Thru','required|xss_clean');
			$this->form_validation->set_rules('status','Request Status','required|xss_clean');
			$this->form_validation->set_rules('based','Request Based','required|xss_clean');
			$this->form_validation->set_rules('type','Request Type','required|xss_clean');
			$this->form_validation->set_rules('case','Request Case','required|xss_clean');
			$this->form_validation->set_rules('canceled','Canceled','xss_clean');
			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_userdata('menu_active','reporting');
				$data['title'] = "Reporting - ";
				$data['request_type'] = $this->m_report_request->md_req_type('data');
				$data['request_case'] = $this->m_report_request->md_req_case('data');
				$data['content_admin'] = 'report/v_report_request';
				$this->load->view('template_admin',$data);
			}
			else
			{
				// POST DATA
				$type = $this->input->post('type');
				$explode_type = explode(":",$type);
				$from = $this->input->post('date_from');
				$thru = $this->input->post('date_thru');
				$status = $this->input->post('status');
				$based = $this->input->post('based');
				$type = $explode_type[0];
				$case = $this->input->post('case');
				$canceled = $this->input->post('canceled');
					
				/* attribute for report */
				$rep_generate = $this->m_rep->print_rep('2');
				foreach ($rep_generate as $rep_gen)
				{
					$data['rep_generate1'] = $rep_gen->rep_ip;
					$data['rep_generate2'] = $rep_gen->rep_url;
				}
				$rep_request = $this->m_rep->print_rep('1');
				foreach ($rep_request as $rep_req)
				{
					$data['rep_request1'] = $rep_req->rep_ip;
					$data['rep_request2'] = $rep_req->rep_url;
				}
				
				$this->session->set_userdata('menu_active','reporting');
				$data['title'] = "Reporting - ";
				$data['request_type'] = $this->m_report_request->md_req_type('data');
				$data['request_case'] = $this->m_report_request->md_req_case('data');
				$data['result'] = $this->m_report_request->generate_report_request($from,$thru,$status,$based,$type,$case,$canceled,'data');
				$data['generate_report_request'] = 'Y';
				$data['content_admin'] = 'report/v_report_request';
				$this->load->view('template_admin',$data);
			}
		}
		else
		{
			$this->session->set_flashdata('info','You dont have permission or your session was expired');
			$this->session->set_flashdata('class_alert','danger');
			redirect('logins/c_login');
		}
	}
	
	public function ajax_request_case()
	{
		$verified_auth = $this->session->userdata('auth');
		$verified_superuser = $this->session->userdata('superuser');
		if ($verified_auth=='true'&&$verified_superuser='Y')
		{
			$t = $this->input->post('type')=="ALL" ? "ALL" : $this->input->post('type');
			$b = $this->input->post('based')=="ALL" ? "ALL" : $this->input->post('based');
			if ($t=="ALL"&&$b=="ALL")
			{
				$data['RC_'] = $this->m_report_request->md_req_case('data');
				echo"<option value=''>Choose</option>
						 <option value='ALL'>ALL</option>
				";
				foreach ($data['RC_'] as $RC)
				{
					echo"
						<option value='$RC->requestCase_name'>$RC->requestCase_name</option>
					";
				}
			}			
			else
			{
				$explode_type = explode(":",$t);
				$t = $explode_type[1];
				$data['RC_'] = $this->m_report_request->ajax_request_case($t,$b,'data');
				echo"<option value=''>Choose</option>
						 <option value='ALL'>ALL</option>
				";
				foreach ($data['RC_'] as $RC)
				{
					echo"
						<option value='$RC->requestCase_name'>$RC->requestCase_name</option>
					";
				}
			}
		}
		else
		{
			$this->session->set_flashdata('info','You dont have permission or your session was expired');
			$this->session->set_flashdata('class_alert','danger');
			redirect('logins/c_login');
		}
	}
}

?>