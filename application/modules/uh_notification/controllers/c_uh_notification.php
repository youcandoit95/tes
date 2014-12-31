<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_uh_notification extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_uh_notification');
	}
	
	public function on_process_request() // request on process (was taken by developer)
	{
		if ($this->session->userdata('user_level')=="4")
		{
			echo "0";
		}
		else
		{
			$user_no = $this->session->userdata('user_no');
			$total_on_process_request = $this->m_uh_notification->on_process_request($user_no);
			echo $total_on_process_request;
		}
	}
	
	public function waiting_done_confirmation() // request waiting to set done from user (was sent by developer)
	{
		if ($this->session->userdata('user_level')=="4")
		{
			echo "0";
		}
		else
		{
			$user_no = $this->session->userdata('user_no');
			$total_waiting_done_confirmation = $this->m_uh_notification->waiting_done_confirmation($user_no);
			echo $total_waiting_done_confirmation;
		}
	}
	
	public function hold_request() 
	{
		if ($this->session->userdata('user_level')=="4")
		{
			echo "0";
		}
		else
		{
			$user_no = $this->session->userdata('user_no');
			$total_hold_request = $this->m_uh_notification->hold_request($user_no);
			echo $total_hold_request;
		}
	}
	
	public function request_detail() //detail new request (modal)
	{
		$this->form_validation->set_rules('req_no','Secret Param 1','required|xss_clean');
		if ($this->form_validation->run()==TRUE)
		{
			$p_req_no = $this->input->post('req_no');
			$user_no = $this->session->userdata('user_no');;
			$data = $this->m_uh_notification->request_detail($p_req_no,$user_no);
			foreach ($data as $d)
			{
				$row['REQ_NO'] = str_replace("/","_",$d['REQ_NO']);
				$row['REQ_NAME'] = $d['REQ_NAME'];
				$row['TYPE_NO'] = $d['TYPE_NO'];
				$row['TYPE_NAME'] = $d['TYPE_NAME'];
				$row['CATEGORY_NAME'] = $d['CATEGORY_NAME'];
				$row['REF_NO'] = $d['REF_NO'];
				$row['PRIORITY_NAME'] = $d['PRIORITY_NAME'];
				$row['PRIORITY_REASON'] = $d['PRIORITY_REASON'];
				$row['PIC_FNAME'] = $d['PIC_FNAME'];
				$row['STATUS'] = $d['STATUS'];
				$row['STATUS_REASON'] = $d['STATUS_REASON'];
				$row['REQ_EST_TIME'] = $d['REQ_EST_TIME'];
				$row['F_DOC_SUPPORT'] = $d['F_DOC_SUPPORT'];
				$row['REQ_REASON'] = $d['REQ_REASON'];
				$row['REQ_NOTE'] = $d['REQ_NOTE'];
			}
			echo json_encode($row);
		}
	}
}

?>


