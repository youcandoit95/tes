<?PHP if (!defined('BASEPATH')) exit ('No direct script access allowed');

/** Model SD home
 * Created April 2013 - Mohamad Yansen Riadi
 * SDH = staff dev home,  RC = Request Case , UR = User Request , DTL = Detail, WR = Waiting Respond , NR = New Request
 *
 *
 *
 */
 
class M_sd_home extends CI_Model
{
	public function NR_SDH()
	{
		$query = $this->db->query(" SELECT COUNT(request_id) AS new_req FROM tbl_request WHERE request_notification='Y' AND request_notificationRead IS NULL AND request_status='Waiting_respond' AND request_PIC IS NULL ");
		return $query->result();
	}
	
	public function DATA_WR_SDH()
	{
		$DATA_WR_SDH = $this->db->query(" SELECT request_id,request_based,
       (SELECT requestType_name FROM tbl_requesttype WHERE requestType_id=req.request_type) AS request_type,
       (SELECT requestCase_name FROM tbl_requestcase WHERE requestCase_id=req.request_case) AS request_case,
       request_modul,request_desc,request_reason,DATE_FORMAT(request_dateCreated, '%d-%m-%Y %h:%i:%s') AS request_dateCreated,request_status
	   FROM tbl_request req WHERE request_notification='Y' AND request_notificationRead IS NULL AND request_status='Waiting_respond' AND request_PIC IS NULL ");
		return $DATA_WR_SDH->result();
	}	
	
	public function FTR_SDH($id)
	{
		$FTR_SDH = $this->db->query(" SELECT CONCAT_WS(';', request_id,request_based,
       (SELECT requestType_name FROM tbl_requesttype WHERE requestType_id=req.request_type),
       (SELECT requestCase_name FROM tbl_requestcase WHERE requestCase_id=req.request_case),
	   request_modul,request_desc,request_reason,
       (SELECT user_name FROM tbl_user WHERE user_id=request_userIdRequested),
       (SELECT user_phonePersonal FROM tbl_user WHERE user_id=request_userIdRequested),
       (SELECT user_phoneOffice FROM tbl_user WHERE user_id=request_userIdRequested),
       DATE_FORMAT(request_dateCreated, '%d-%m-%Y %h:%i:%s'),
       request_status,
	   ifnull(req.request_statusReason,''),
	   ifnull(req.request_statusDate,'')
	   ) AS FTR_DATA
	   FROM tbl_request req WHERE request_id='$id' ");
	   return $FTR_SDH->result();
	}
}

?>