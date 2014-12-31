<?PHP IF (!DEFINED('BASEPATH')) EXIT ('NO DIRECT SCRIPT ACCESS ALLOWED');

class M_sr extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function total_all_request($user_no)
	{
		$sql = "SELECT COUNT(REQ_NO) AS TOTAL_REQUEST FROM TBL_REQUEST WHERE REQ_BY=$user_no ";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TOTAL_REQUEST'];
		}
	}
	
	/*
	public function SR_OP_CNT()
	{
		$user_id = $this->session->userdata('login_id');
		$SR_OP = $this->db->query(" SELECT COUNT(request_id) AS COUNT_OP FROM tbl_request 
		WHERE request_estimateTime IS NOT NULL AND request_status='On Process' AND request_dateDone IS NULL 
		AND request_PIC IS NOT NULL AND request_userIdRequested='$user_id' ");
		return $SR_OP->result();
	}
	
	public function SR_OP_UH_DATA()
	{
		$user_id = $this->session->userdata('login_id');
		$sql = " SELECT request_id,request_based,
       (SELECT requestType_name FROM tbl_requesttype WHERE requestType_id=req.request_type) AS request_type,
       (SELECT requestCase_name FROM tbl_requestcase WHERE requestCase_id=req.request_case) AS request_case,
       request_modul,request_desc,request_reason,
       request_userFullNameRequested AS requested_FullName,
       request_userEmailRequested AS requested_email, 
       (SELECT tbl_user.user_phonePersonal FROM tbl_user WHERE tbl_user.user_id = req.request_userIdRequested) AS requested_UserPP,
       (SELECT tbl_user.user_phoneOffice FROM tbl_user WHERE tbl_user.user_id = req.request_userIdRequested) AS requested_UserPO,
       (SELECT tbl_user.user_dept FROM tbl_user WHERE tbl_user.user_id = req.request_userIdRequested) AS requested_userDept,
       (SELECT tbl_dept.dept_name FROM tbl_dept WHERE tbl_dept.dept_id = requested_userDept) AS requested_userDeptName,
       DATE_FORMAT(request_dateCreated, '%d-%m-%Y %H:%i:%s') AS request_dateCreated,
       request_estimateTime,request_status
	    FROM tbl_request req
		WHERE request_estimateTime IS NOT NULL AND request_status='On Process' AND request_dateDone IS NULL 
		AND request_userIdRequested='$user_id'; ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function SR_OP_CNT_SDH()
	{
		$user_id = $this->session->userdata('login_id');
		$SR_OP_CNT_SDH = $this->db->query(" SELECT COUNT(request_id) AS COUNT_OP FROM tbl_request 
		WHERE request_estimateTime IS NOT NULL AND request_status='On Process' AND request_dateDone IS NULL 
		AND request_PIC='$user_id' ");
		return $SR_OP_CNT_SDH->result();
	}
	
	public function SR_OP_DTL_SDH()
	{
		$user_id = $this->session->userdata('login_id');
		$SR_OP_CNT_SDH = $this->db->query(" SELECT request_id,request_based,
       (SELECT requestType_name FROM tbl_requesttype WHERE requestType_id=req.request_type) AS request_type,
       (SELECT requestCase_name FROM tbl_requestcase WHERE requestCase_id=req.request_case) AS request_case,
       request_modul,request_desc,request_reason,
       request_userFullNameRequested AS requested_FullName,
       request_userEmailRequested AS requested_email, 
       (SELECT tbl_user.user_phonePersonal FROM tbl_user WHERE tbl_user.user_id = req.request_userIdRequested) AS requested_UserPP,
       (SELECT tbl_user.user_phoneOffice FROM tbl_user WHERE tbl_user.user_id = req.request_userIdRequested) AS requested_UserPO,
       (SELECT tbl_user.user_dept FROM tbl_user WHERE tbl_user.user_id = req.request_userIdRequested) AS requested_userDept,
       (SELECT tbl_dept.dept_name FROM tbl_dept WHERE tbl_dept.dept_id = requested_userDept) AS requested_userDeptName,
       DATE_FORMAT(request_dateCreated, '%d-%m-%Y %H:%i:%s') AS request_dateCreated,
       request_estimateTime,request_status
	    FROM tbl_request req
		WHERE request_estimateTime IS NOT NULL AND request_status='On Process' AND request_dateDone IS NULL 
		AND request_PIC='$user_id' ");
		return $SR_OP_CNT_SDH->result();
	}
	
	public function WR()
	{
		$id = $this->session->userdata('login_id');
		$WR = $this->db->query(" SELECT COUNT(request_id) AS WR FROM tbl_request WHERE request_status='Waiting_respond' AND request_userIdRequested='$id' ");
		return $WR->result();
	}
	
	public function WR_SDH()
	{
		$WR = $this->db->query(" SELECT COUNT(request_id) AS new_req FROM tbl_request WHERE request_notification='Y' AND request_notificationRead IS NULL AND request_status='Waiting_respond'; ");
		return $WR->result();
	}
	
	public function HR($sess_id)
	{
		$sql = " SELECT COUNT(request_id) AS HR FROM tbl_request WHERE request_status='HOLD' AND request_notification='H' AND request_userIdRequested='$sess_id' ";
		$HR = $this->db->query($sql);
		return $HR->result();
	}
	
	public function HR_DATA($sess_id)
	{
		$HR_SDH_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='HOLD' AND request_notification='H' AND request_userIdRequested=$sess_id ");
		return $HR_SDH_DATA->result();
	}
	
	public function HR_SDH()
	{
		$id = $this->session->userdata('login_id');
		$HR = $this->db->query(" SELECT COUNT(request_id) AS HR FROM tbl_request WHERE request_status='HOLD' AND request_notification='H' AND request_PIC='$id' ");
		return $HR->result();
	}
	
	public function HR_SDH_DATA()
	{
		$id = $this->session->userdata('login_id');
		$HR_SDH_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='HOLD' AND request_notification='H' AND PIC='$id' ");
		return $HR_SDH_DATA->result();
	}
	
	public function CR($sess_id)
	{
		$CR = $this->db->query(" SELECT COUNT(request_id) AS CR FROM tbl_request WHERE request_status='CANCEL' AND request_notification='C'  AND request_cancel='Y' AND request_userIdRequested='$sess_id' ");
		return $CR->result();
	}
	
	public function CR_DATA($sess_id)
	{
		$CR_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='CANCEL' AND request_notification='C' AND request_cancel='Y' AND request_userIdRequested='$sess_id' ");
		return $CR_DATA->result();
	}
	
	public function CR_SDH()
	{
		$id = $this->session->userdata('login_id');
		$CR = $this->db->query(" SELECT COUNT(request_id) AS CR FROM tbl_request WHERE request_status='CANCEL' AND request_notification='C' AND request_cancel='Y' AND request_PIC='$id' ");
		return $CR->result();
	}
	
	public function CR_SDH_DATA()
	{
		$id = $this->session->userdata('login_id');
		$CR_SDH_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='CANCEL' AND request_notification='C' AND request_cancel='Y' AND PIC='$id' ");
		return $CR_SDH_DATA->result();
	}
	
	public function WD($sess_id)
	{
		$WD = $this->db->query(" SELECT COUNT(request_id) AS WD FROM tbl_request WHERE request_status='Waiting_confirmation_DONE' AND request_notification='W' AND request_userIdRequested='$sess_id' ");
		return $WD->result();
	}
	
	public function WD_DATA($sess_id)
	{
		$WD_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='Waiting_confirmation_DONE' AND request_notification='W' AND request_userIdRequested='$sess_id' ");
		return $WD_DATA->result();
	}
	
	public function RR($sess_id)
	{
		$RR = $this->db->query(" SELECT COUNT(request_id) AS RR FROM tbl_request WHERE request_status='REVISION' AND request_notification='R' AND request_userIdRequested='$sess_id' ");
		return $RR->result();
	}
	
	public function RR_DATA($sess_id)
	{
		$RR_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='REVISION' AND request_notification='R' AND request_userIdRequested='$sess_id' ");
		return $RR_DATA->result();
	}
	
	public function RR_SDH()
	{
		$id = $this->session->userdata('login_id');
		$RR = $this->db->query(" SELECT COUNT(request_id) AS RR FROM tbl_request WHERE request_status='REVISION' AND request_notification='R' AND request_PIC='$id' ");
		return $RR->result();
	}
	
	public function RR_SDH_DATA()
	{
		$id = $this->session->userdata('login_id');
		$RR_SDH_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='REVISION' AND request_notification='R' AND PIC='$id' ");
		return $RR_SDH_DATA->result();
	}
	
	public function DR($sess_id)
	{
		$DR = $this->db->query(" SELECT COUNT(request_id) AS DR FROM tbl_request WHERE request_status='DONE' AND request_notification='D' AND request_userIdRequested='$sess_id' ");
		return $DR->result();
	}
	
	public function DR_DATA($sess_id)
	{
		$DR_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='DONE' AND request_notification='D' AND request_userIdRequested='$sess_id' ");
		return $DR_DATA->result();
	}
	
	public function DR_SDH()
	{
		$id = $this->session->userdata('login_id');
		$RR = $this->db->query(" SELECT COUNT(request_id) AS DR FROM tbl_request WHERE request_status='DONE' AND request_notification='D' AND request_PIC='$id' ");
		return $RR->result();
	}
	
	public function DR_SDH_DATA()
	{
		$id = $this->session->userdata('login_id');
		$DR_SDH_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='DONE' AND request_notification='D' AND PIC='$id' ");
		return $DR_SDH_DATA->result();
	}
	
	public function WD_SDH()
	{
		$id = $this->session->userdata('login_id');
		$CR = $this->db->query(" SELECT COUNT(request_id) AS WD FROM tbl_request WHERE request_status='Waiting_confirmation_DONE' AND request_notification='W' AND request_PIC='$id' ");
		return $CR->result();
	}
	
	public function WD_SDH_DATA()
	{
		$id = $this->session->userdata('login_id');
		$CR_SDH_DATA = $this->db->query(" SELECT * FROM AR WHERE request_status='Waiting_confirmation_DONE' AND request_notification='W' AND PIC='$id' ");
		return $CR_SDH_DATA->result();
	}
	
	public function SR_CTR_UH($id)
	{
		$SR_CTR = $this->db->query(" SELECT request_id,request_notificationRead,request_PIC,
		(SELECT user_fullName FROM tbl_user WHERE tbl_user.user_id=request_PIC) AS PIC_Dev
		FROM tbl_request WHERE request_notificationRead NOT LIKE '%$id%' AND request_userIdRequested=$id ");
		return $SR_CTR->result();
	}
	
	public function SR_CTR($id)
	{
		$SR_CTR = $this->db->query(" SELECT request_id,request_notificationRead,request_PIC,
		SUBSTRING(request_notificationRead,5,1) AS user_exec,
		(SELECT user_fullName FROM tbl_user WHERE tbl_user.user_id=user_exec) AS username_exec
		FROM tbl_request WHERE request_notificationRead NOT LIKE '%$id%' ");
		return $SR_CTR->result();
	}
	
	public function SR_CTR_CNT()
	{
		$SR_CTR = $this->db->query(" SELECT COUNT(request_id) AS jml FROM tbl_request ");
		return $SR_CTR->result();
	}
	
	public function SR_CTR_UPDATE($id_view,$id_req)
	{
		$sql_current = " SELECT request_notificationRead FROM tbl_request WHERE request_id='$id_req' ";
		$query_current = $this->db->query($sql_current);
		foreach ($query_current->result() as $qc)
		{
			$sql_update = " UPDATE tbl_request SET request_notificationRead=".$qc->request_notificationRead.";".$id_view." WHERE request_id='$id_req' ";
			$query_update = $this->db->query($sql_update);
		}
	}
	
	public function FTR_UH($id)
	{
		$sql = " SELECT * FROM FTR_UH WHERE request_id='$id'; ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function FTR_UH_new($id)
	{
		$sql = "SELECT request_id,CONCAT_WS(';', 
        ifnull(request_id,''),ifnull(request_based,''),
        ifnull((SELECT requestType_name FROM tbl_requesttype WHERE requestType_id=req.request_type),''),
        ifnull((SELECT requestCase_name FROM tbl_requestcase WHERE requestCase_id=req.request_case),''),
	      ifnull(request_modul,''),ifnull(request_desc,''),ifnull(request_reason,''),
        ifnull((SELECT tbl_user.user_name FROM tbl_user WHERE user_id=request_PIC),''),
        ifnull((SELECT tbl_user.user_fullName FROM tbl_user  WHERE user_id=request_PIC),''),
        ifnull((SELECT tbl_user.user_phonePersonal FROM tbl_user WHERE user_id=request_PIC),''),
        ifnull((SELECT tbl_user.user_phoneOffice FROM tbl_user WHERE user_id=request_PIC),''),
        ifnull(DATE_FORMAT(request_dateCreated, '%d-%m-%Y %h:%i:%s'),''),
        ifnull(request_status,''),
		ifnull(req.request_statusReason,''),
		ifnull(req.request_statusDate,'')) AS FTR_DATA
	   FROM tbl_request req WHERE req.request_id='$id'";
	   $query = $this->db->query($sql);
	   return $query ->result();
	}
	
	public function AR_UH($sess_id)
	{
		$sql = " SELECT COUNT(request_id) AS AR FROM AR WHERE request_userIdRequested=$sess_id;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function AR_UH_DATA()
	{
		$sql = " SELECT * FROM AR WHERE request_userIdRequested=1;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function AR_SDH()
	{
		$sess_log_id = $this->session->userdata('login_id');
		$sql = " SELECT COUNT(request_id) AS jml_AR FROM tbl_request WHERE request_PIC=$sess_log_id ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function AR_SDH_DATA()
	{
		$sess_log_id = $this->session->userdata('login_id');
		$sql = " SELECT * FROM AR where PIC=$sess_log_id";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function AR_SDH_Detail($id)
	{
		$sql = " SELECT a.*, b.doc_support FROM ar_concat a inner join ar_file_concat b on a.request_id=b.F_Req_id WHERE a.request_id='$id' "; 
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function SR_SET($S)
	{
		$sql = $S;
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function VN($id,$REQ_ID,$REQ_ID_COUNT)
	{
		$y = $REQ_ID_COUNT - 1;
		$reqid_explode = explode(";",$REQ_ID);
		$z =1;
		for ($x=0; $x<$y; $x++)
		{
			$sql_current = " SELECT request_notificationRead FROM tbl_request WHERE request_id='$reqid_explode[$x]' ";
			$query_current = $this->db->query($sql_current);
			foreach ($query_current->result() as $qc)
			{
				$NR = $qc->request_notificationRead;
			}
			
			$sql_vn = " UPDATE tbl_request SET request_notificationRead='".$NR.";".$id."' WHERE request_id='".$reqid_explode[$x]."' ";
			$query_vn = $this->db->query($sql_vn);
			if ($query_vn)
			{
				$z++;
			}
		}	
		if ($z==$REQ_ID_COUNT)
		{
			return true;
		}
	}*/
}
?>