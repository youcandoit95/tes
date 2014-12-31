<?php if (!defined('BASEPATH')) exit ('No direct script allowed access');

class M_report_request extends CI_Model
{
	public function graph($from,$thru)
	{
		$sql = "SELECT 
					sg.THN_BLN,IFNULL(X.JML,0) AS JML_DONE,IFNULL(X.STATUS,'DONE') AS ST_DONE,
					IFNULL(WCD.JML,0) AS JML_WCD,IFNULL(WCD.STATUS,'WCD') AS ST_WCD, 
					IFNULL(H.JML,0) AS JML_HOLD,IFNULL(H.STATUS,'HOLD') AS ST_HOLD, 
					IFNULL(R.JML,0) AS JML_REV,IFNULL(R.STATUS,'REVISION') AS ST_REV, 
					IFNULL(OP.JML,0) AS JML_REV,IFNULL(OP.STATUS,'REVISION') AS ST_OP,
					IFNULL(WR.JML,0) AS JML_WR,IFNULL(WR.STATUS,'WR') AS ST_WR,
					IFNULL(Y.JML,0) AS JML_CANCEL,IFNULL(Y.STATUS,'CANCEL') AS ST_CANCEL
				FROM tbl_support_graph sg LEFT  JOIN (
								SELECT 
									COUNT(d.request_id) AS JML, 
									d.request_status AS STATUS,
									DATE_FORMAT( d.request_dateCreated, '%Y-%m') AS BLN
								FROM tbl_request d
								WHERE d.request_status='DONE'  
								AND DATE_FORMAT( d.request_dateCreated, '%Y-%m') BETWEEN '$from' AND  '$thru'
								GROUP BY d.request_status,DATE_FORMAT( d.request_dateCreated, '%Y-%m')) AS X 
								ON (sg.THN_BLN=X.BLN)
								
								LEFT JOIN (
									SELECT 
										COUNT(rc.request_id) AS JML, 
										rc.request_status AS STATUS ,
										DATE_FORMAT( rc.request_dateCreated, '%Y-%m') AS BLN
									FROM tbl_request rc
									WHERE rc.request_cancel='Y' 
									AND DATE_FORMAT( rc.request_dateCreated, '%Y-%m') BETWEEN '$from' AND  '$thru'
									GROUP BY rc.request_status,DATE_FORMAT( rc.request_dateCreated, '%Y-%m')) AS Y 
								ON (sg.THN_BLN=Y.BLN)
								
								LEFT JOIN (
									SELECT 
										COUNT(rwd.request_id) AS JML, 
										rwd.request_status AS STATUS ,
										DATE_FORMAT( rwd.request_dateCreated, '%Y-%m') AS BLN
									FROM tbl_request rwd
									WHERE rwd.request_status='Waiting_confirmation_DONE'
									AND DATE_FORMAT( rwd.request_dateCreated, '%Y-%m') BETWEEN '$from' AND  '$thru'
									GROUP BY rwd.request_status,DATE_FORMAT( rwd.request_dateCreated, '%Y-%m')) AS WCD 
								ON (sg.THN_BLN=WCD.BLN)
								
								LEFT JOIN (
									SELECT 
										COUNT(rh.request_id) AS JML, 
										rh.request_status AS STATUS ,
										DATE_FORMAT( rh.request_dateCreated, '%Y-%m') AS BLN
									FROM tbl_request rh
									WHERE rh.request_status='HOLD'
									AND DATE_FORMAT( rh.request_dateCreated, '%Y-%m') BETWEEN '$from' AND  '$thru'
									GROUP BY rh.request_status,DATE_FORMAT( rh.request_dateCreated, '%Y-%m')) AS H 
								ON (sg.THN_BLN=H.BLN)
								
								LEFT JOIN (
									SELECT 
										COUNT(rr.request_id) AS JML, 
										rr.request_status AS STATUS ,
										DATE_FORMAT( rr.request_dateCreated, '%Y-%m') AS BLN
									FROM tbl_request rr
									WHERE rr.request_status='REVISION'
									AND DATE_FORMAT( rr.request_dateCreated, '%Y-%m') BETWEEN '$from' AND  '$thru'
									GROUP BY rr.request_status,DATE_FORMAT( rr.request_dateCreated, '%Y-%m')) AS R
								ON (sg.THN_BLN=R.BLN)
								
								LEFT JOIN (
									SELECT 
										COUNT(rop.request_id) AS JML, 
										rop.request_status AS STATUS ,
										DATE_FORMAT( rop.request_dateCreated, '%Y-%m') AS BLN
									FROM tbl_request rop
									WHERE rop.request_status='On Process'
									AND DATE_FORMAT( rop.request_dateCreated, '%Y-%m') BETWEEN '$from' AND  '$thru'
									GROUP BY rop.request_status,DATE_FORMAT( rop.request_dateCreated, '%Y-%m')) AS OP
								ON (sg.THN_BLN=OP.BLN)
								
								LEFT JOIN (
									SELECT 
										COUNT(rwr.request_id) AS JML, 
										rwr.request_status AS STATUS ,
										DATE_FORMAT( rwr.request_dateCreated, '%Y-%m') AS BLN
									FROM tbl_request rwr
									WHERE rwr.request_status='Waiting_respond'
									AND DATE_FORMAT( rwr.request_dateCreated, '%Y-%m') BETWEEN '$from' AND  '$thru'
									GROUP BY rwr.request_status,DATE_FORMAT( rwr.request_dateCreated, '%Y-%m')) AS WR
								ON (sg.THN_BLN=WR.BLN)
				WHERE
				sg.THN_BLN BETWEEN '$from' AND  '$thru' ";
		$query = $this->db->query($sql);
		
		if ($query)
		{
			return $query->result();
		}
	}

	public function generate_report_request($from,$thru,$status,$based,$type,$case,$canceled,$data)
	{
		$canceled = $canceled=="Y" ? "" : "AND request_cancel is null";
		$status = $status=="ALL" ? "" : "AND request_status LIKE '$status%'";
		$based = $based=="ALL" ? "" : "AND request_based LIKE '$based%'";
		$type = $type=="ALL" ? "" : "AND request_type LIKE '$type%'";
		$case = $case=="ALL" ? "" : "AND request_case LIKE '$case%'";
		
		$sql = "SELECT * FROM AR 
					WHERE STR_TO_DATE(request_dateCreated, '%d-%m-%Y') between STR_TO_DATE('$from','%d-%m-%Y') AND STR_TO_DATE('$thru','%d-%m-%Y')
					".$status."
					".$based."
					".$type."
					".$case."
					".$canceled." ";
		
		$query = $this->db->query($sql);
		if ($query)
		{
			if ($data=="data")
			{
				return $query->result();
			}
			else if ($data=="row")
			{
				return $query->num_rows();
			}
		}
	}

	public function md_dept($data)
	{
		$sql = "SELECT dept_id,dept_name FROM tbl_dept WHERE dept_active='Y' AND dept_deleted='N' AND dept_SD=null ";
		$query = $this->db->query($sql);
		if ($data=="data")
		{
			return $query->result();
		}
		else if ($data=="row")
		{
			return $query->num_rows();
		}
	}
	
	public function md_req_type($data)
	{
		$sql = "SELECT requestType_id,requestType_name FROM tbl_requesttype WHERE requestType_active='Y' AND requestType_deleted='N' ";
		$query = $this->db->query($sql);
		if ($data=="data")
		{
			return $query->result();
		}
		else if ($data=="row")
		{
			return $query->num_rows();
		}
	}
	
	public function md_req_case($data)
	{
		$sql = "SELECT requestCase_id,requestCase_name FROM tbl_requestcase WHERE requestCase_active='Y' AND requestCase_deleted='N' ";
		$query = $this->db->query($sql);
		if ($data=="data")
		{
			return $query->result();
		}
		else if ($data=="row")
		{
			return $query->num_rows();
		}
	}
	
	public function ajax_request_case($t,$b,$data)
	{
		$type = $t=="ALL" ? "requestCase_type LIKE '%%'" : "requestCase_type='$t'";
		$based = $b=="ALL" ? "requestCase_based LIKE '%%'" : "requestCase_based='$b'";
		$sql = "SELECT requestCase_name FROM tbl_requestcase 
					WHERE ".$type." AND ".$based." AND requestCase_active='Y' AND requestCase_deleted='N' ";
		$query = $this->db->query($sql);
		echo $sql;
		if ($data=="data")
		{
			return $query->result();
		}
		else if ($data=="row")
		{
			return $query->num_rows();
		}
	}
}

?>