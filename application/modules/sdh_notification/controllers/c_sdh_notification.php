<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_sdh_notification extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_sdh_notification');
	}
	
	public function new_request() //request baru masuk
	{
		$total_new_request = $this->m_sdh_notification->new_request();
		echo $total_new_request;
	}
	
	public function new_request_detail() //detail new request (modal)
	{
		$this->form_validation->set_rules('required|xss_clean');
		if ($this->form_validation->run()==TRUE)
		{
			$p_req_no = $this->input->post('req_no');
			$data = $this->m_sdh_notification->new_request_detail($p_req_no);
			foreach ($data as $d)
			{
				$row['REQ_NO'] = str_replace("/","_",$d['REQ_NO']);
				$row['REQ_NAME'] = $d['REQ_NAME'];
				$row['TYPE_NAME'] = $d['TYPE_NAME'];
				$row['CATEGORY_NAME'] = $d['CATEGORY_NAME'];
				$row['REF_NO'] = $d['REF_NO'];
				$row['REQ_REASON'] = $d['REQ_REASON'];
				$row['REQ_NOTE'] = $d['REQ_NOTE'];
				$row['PRIORITY_NAME'] = $d['PRIORITY_NAME'];
				$row['PRIORITY_REASON'] = $d['PRIORITY_REASON'];
				$row['STATUS'] = $d['STATUS'];
				$row['STATUS_REASON'] = $d['STATUS_REASON'];
				$row['REQ_BY'] = $d['USER_FNAME'];
			}
			echo json_encode($row);
		}
	}
	
	public function cancel_request()
	{
		$user_no = $this->session->userdata('user_no');
		$total_cancel_request = $this->m_sdh_notification->cancel_request($user_no);
		echo $total_cancel_request;
	}
	
	public function done_request()
	{
		$user_no = $this->session->userdata('user_no');
		$total_done_request = $this->m_sdh_notification->done_request($user_no);
		echo $total_done_request;
	}
	
	public function revision_request()
	{
		$user_no = $this->session->userdata('user_no');
		$total_revision_request = $this->m_sdh_notification->revision_request($user_no);
		echo $total_revision_request;
	}
	
	public function detail_request()
	{
		$this->form_validation->set_rules('req_no','Secret Param 1','required|xss_clean');
		if ($this->form_validation->run()==TRUE)
		{
			$p_req_no = $this->input->post('req_no');
			$detail_request = $this->m_sdh_notification->detail_request($p_req_no);
			foreach ($detail_request as $d)
			{
				$row['REQ_NO'] = $d['REQ_NO'];
				$row['REQ_BY_USERID'] = $d['REQ_BY_USERID'];
				$row['REF_NO'] = $d['REF_NO'];
				$row['REQ_NAME'] = $d['REQ_NAME'];
				$row['TYPE_NAME'] = $d['TYPE_NAME'];
				$row['CATEGORY_NAME'] = $d['CATEGORY_NAME'];
				$row['PRIORITY_NAME'] = $d['PRIORITY_NAME'];
				$row['PRIORITY_REASON'] = $d['PRIORITY_REASON'];
				$row['REQ_REASON'] = $d['REQ_REASON'];
				$row['REQ_NOTE'] = $d['REQ_NOTE'];
				$row['REQ_CREATED'] = $d['REQ_CREATED'];
				$row['REQ_PIC_USERID'] = $d['REQ_PIC_USERID'];
				$row['STATUS_NAME'] = $d['STATUS_NAME'];
				$row['REQ_LSTATUS_REASON'] = $d['REQ_LSTATUS_REASON'];
				$row['REQ_LUPDATED'] = $d['REQ_LUPDATED'];
				$row['REQ_EST_TIME'] = $d['REQ_EST_TIME'];
			}
			
			echo json_encode($row);
		}
	}
}

?>


