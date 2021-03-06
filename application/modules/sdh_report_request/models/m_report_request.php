<?PHP if (!defined('BASEPATH')) exit ('No direct script access allowed');

/** Model user request(UR) / form request 
 * Created April 2013 - Mohamad Yansen Riadi
 * RC = Request Case , UR = User Request , DTL = Detail, WR = Waiting Respond
 *
 *
 *
 */
 
class M_report_request extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}	
	
	public function req_type()
	{
		$sql = "SELECT TYPE_NO, TYPE_NAME FROM TBL_REQUEST_TYPE WHERE TYPE_ACTIVE = 1 AND TYPE_DELETED = 99";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function translate_req_type($p_req_type)
	{
		$sql = "SELECT TYPE_NAME FROM TBL_REQUEST_TYPE WHERE TYPE_NO = $p_req_type";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['TYPE_NAME'];
		}
	}
	
	public function req_category()
	{
		$sql = "SELECT CATEGORY_NO, CATEGORY_NAME FROM TBL_REQUEST_CATEGORY WHERE CATEGORY_ACTIVE = 1 AND CATEGORY_DELETED = 99";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function translate_req_category($p_req_category)
	{
		$sql = "SELECT CATEGORY_NAME FROM TBL_REQUEST_CATEGORY WHERE CATEGORY_NO = $p_req_category";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['CATEGORY_NAME'];
		}
	}
	
	public function req_priority()
	{
		$sql = "SELECT PRIORITY_NO, PRIORITY_NAME FROM TBL_REQUEST_PRIORITY WHERE PRIORITY_ACTIVE = 1 AND PRIORITY_DELETED = 99";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function req_pic()
	{
		$sql = "SELECT
						USER_NO, USER_FNAME
					FROM TBL_USER
					WHERE USER_ACTIVE=1
						AND USER_DELETED=99
						AND DEPT_NO = 1
					ORDER BY USER_FNAME ASC";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function generate_report($p_req_by,$p_date_from,$p_date_thru,$p_req_type,$p_req_category,$p_req_pic, $p_req_by)
	{
		$by_pic = $p_req_pic!="" ? "AND R.REQ_PIC = $p_req_pic" : "";
		$req_by = $p_req_by!="" ? "AND R.REQ_BY = $p_req_by" : "";
		
			$filter_date_from = $p_date_from!="" ? "AND R.REQ_CREATED >= TO_DATE('$p_date_from','DD-MM-RRRR')" : "";
			$filter_date_thru = $p_date_thru!="" ? "AND R.REQ_CREATED <= TO_DATE('$p_date_thru','DD-MM-RRRR')" : "";
		
		$sql = "SELECT 
						R.REQ_NO,
						R.TYPE_NO,
						NVL(XTY.TYPE_NAME, 'N/A') AS REQ_TYPE,
						R.REQ_NAME,
						R.PRIORITY_NO,
						NVL(XP.PRIORITY_NAME, 'N/A') AS REQ_PRIORITY,
						R.PRIORITY_REASON,
						R.CATEGORY_NO,
						XC.CATEGORY_NAME AS REQ_CATEGORY,
						NVL(R.REF_NO, 'N/A') AS REF_NO, 
						R.REQ_REASON, 
						R.REQ_NOTE, 
						NVL(XPIC.USER_ID, 'N/A') AS REQ_PIC, 
						NVL(XS.STATUS_NAME, 'N/A') AS REQ_LSTATUS,
						R.REQ_LSTATUS_REASON,
						TO_CHAR(R.REQ_CREATED, 'DD-MM-RRRR') AS REQ_CREATED, 
						NVL(TO_CHAR(R.REQ_EST_TIME, 'DD-MM-RRRR HH24:MI'), 'N/A') AS REQ_EST_TIME,
						NVL(TO_CHAR(R.REQ_LUPDATED, 'DD-MM-RRRR HH24:MI'), 'N/A') AS REQ_LUPDATED,
						(SELECT F.FILE_DOC_SUPPORT FROM TBL_REQUEST_FILE F WHERE F.REQ_NO = R.REQ_NO) AS F_DOC_SUPPORT,
						(SELECT F.FILE_UAT FROM TBL_REQUEST_FILE F WHERE F.REQ_NO = R.REQ_NO) AS FILE_UAT
					FROM TBL_REQUEST R,
						(SELECT TY.TYPE_NAME, TY.TYPE_NO FROM TBL_REQUEST_TYPE TY) XTY,
						(SELECT P.PRIORITY_NO, P.PRIORITY_NAME FROM TBL_REQUEST_PRIORITY P) XP,
						(SELECT C.CATEGORY_NO, C.CATEGORY_NAME FROM TBL_REQUEST_CATEGORY C) XC,
						(SELECT U.USER_NO, U.USER_ID FROM TBL_USER U) XPIC,
						(SELECT S.STATUS_NO,S.STATUS_NAME FROM TBL_STATUS S) XS
					WHERE R.TYPE_NO (+) = XTY.TYPE_NO
						AND R.PRIORITY_NO = XP.PRIORITY_NO(+)
						AND R.CATEGORY_NO = XC.CATEGORY_NO(+)
						AND R.REQ_PIC= XPIC.USER_NO(+)
						AND R.REQ_LSTATUS = XS.STATUS_NO
						AND R.TYPE_NO LIKE '%$p_req_type%'
						AND R.CATEGORY_NO LIKE '%$p_req_category%' 
						".$by_pic."
						".$req_by."
						".$filter_date_from."
						".$filter_date_thru."
					ORDER BY R.REQ_NO ASC";
		$query = $this->db->GetArray($sql)	;
		return $query;
	}
	
	public function name_pic($p_req_pic)
	{
		$sql = "SELECT
						USER_FNAME
					FROM TBL_USER
					WHERE USER_NO=$p_req_pic";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['USER_FNAME'];
		}
	}
	
	public function data_user_isd()
	{
		$sql = "SELECT 
						USER_NO, USER_FNAME
					FROM TBL_USER
					WHERE
						DEPT_NO = '2'
						AND LEVEL_NO = '2' 
						AND USER_ACTIVE = '1'
						AND USER_DELETED = '99' ";
						
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function translate_req_by($p_req_by)
	{
		$sql = "SELECT 
						USER_FNAME
					FROM TBL_USER
					WHERE
						USER_NO = $p_req_by 
					";
		$query = $this->db->GetArray($sql);
		foreach ($query as $q)
		{
			return $q['USER_FNAME'];
		}
	}
}

?>