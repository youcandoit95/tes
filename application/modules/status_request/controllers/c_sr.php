<?php  if (!defined('BASEPATH')) exit ('No direct script access allowed');

class C_sr extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('status_request/m_sr');
	}
	
	public function AR_detail()
	{
		$id = $this->input->post('Req_ID');
		$data['ARD'] = $this->m_sr->AR_SDH_Detail($id);
		foreach ($data['ARD'] as $ARD)
		{
			$reqid = $ARD->request_id;
			$dreq1 = $ARD->detail_request1;
			$dCreated = $ARD->request_dateCreated;
			$dreq2 = $ARD->detail_request2;
			$reqEST = $ARD->request_estimateTime;
			$dreq3 = $ARD->detail_request3;
			$reqDateDone = $ARD->request_dateDone;
			$reqStatDate = $ARD->request_statusDate;
			$doc_support = $ARD->doc_support;
			$detail = $dreq1."+".$dCreated."+".$dreq2."+".$reqEST."+".$dreq3."+".$reqDateDone."+".$reqStatDate."+".$doc_support;
		}
		
		echo $detail;
	}
	
	public function SR_VN()
	{
		$id = $this->input->post("view_id");
		$YTR = $this->input->post("VN_YTR");
		$YHR = $this->input->post("VN_YHR");
		$REQ_ID = $YTR.$YHR;
		$REQ_ID_EXPLODE = explode(';',$REQ_ID);
		$REQ_ID_COUNT = count($REQ_ID_EXPLODE);
		
		$VN = $this->m_sr->VN($id,$REQ_ID,$REQ_ID_COUNT);
		if ($VN==TRUE)
		{
			echo "2";
		}
		else
		{
			echo "1";
		}
	}
}

?>