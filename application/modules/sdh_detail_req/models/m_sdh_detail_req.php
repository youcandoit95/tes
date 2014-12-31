<?PHP

class M_sdh_detail_req extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function detail_request($p_req_no)
	{
		$sql = "SELECT R.REQ_NO,
                             R.REQ_NAME,
                             R.TYPE_NO,
                             RT.TYPE_NAME,
                             R.PRIORITY_NO,
                             NVL (RP.PRIORITY_NAME, 'N/A') PRIORITY_NAME,
                             NVL (R.PRIORITY_REASON, 'N/A') PRIORITY_REASON,
                             R.CATEGORY_NO,
                             RC.CATEGORY_NAME,
                             NVL (R.REF_NO, 'N/A') REF_NO,
                             NVL (R.REQ_REASON, 'N/A') REQ_REASON,
                             NVL(R.REQ_NOTE, 'N/A') REQ_NOTE,
                             R.REQ_BY,
                             U.USER_ID AS REQ_BY_USERID,
                             R.REQ_TAKEN,
                             R.REQ_PIC,
                             NVL(UP.USER_ID, 'N/A') AS REQ_PIC_USERID,
                             R.REQ_LSTATUS,
                             S.STATUS_NAME,
                             S.CLASS_TABLE AS NOTIF,
                             NVL(R.REQ_LSTATUS_REASON, 'N/A') REQ_LSTATUS_REASON,
                             R.REQ_CANCEL,
                             TO_CHAR (R.REQ_CREATED, 'DD-MM-RRRR HH24:MI:SS') REQ_CREATED,
                             TO_CHAR (R.REQ_EST_TIME, 'DD-MM-RRRR') REQ_EST_TIME,
                             TO_CHAR (R.REQ_LUPDATED, 'DD-MM-RRRR') REQ_LUPDATED,
							 R.REQ_DONE_NOTE_PIC,
                             F.FILE_DOC_SUPPORT,
                             (SELECT F.FILE_UAT FROM TBL_REQUEST_FILE F WHERE F.REQ_NO = R.REQ_NO) AS FILE_UAT,
                             DECODE(F.FILE_FORM_REQ_DEV,'Y','checked','') AS FILE_FORM_REQ_DEV, 
                             DECODE(F.FILE_BISNIS_PROSES,'Y','checked','') AS FILE_BISNIS_PROSES,
                             DECODE(F.FILE_REGULASI,'Y','checked','') AS FILE_REGULASI,
                             DECODE(F.FILE_MASTER_DATA,'Y','checked','') AS FILE_MASTER_DATA,
                             DECODE(F.FILE_FUNGSI_UTAMA_APP,'Y','checked','') AS FILE_FUNGSI_UTAMA_APP,
                             DECODE(F.FILE_KARAKTERISTIK_PENGGUNA,'Y','checked','') AS FILE_KARAKTERISTIK_PENGGUNA,
                             DECODE(F.FILE_PROTOTYPE,'Y','checked','') AS FILE_PROTOTYPE,
                             DECODE(F.FILE_RAS,'Y','checked','') AS FILE_RAS
                        FROM TBL_REQUEST R, TBL_REQUEST_FILE F,
                             (  SELECT TYPE_NO, TYPE_NAME FROM TBL_REQUEST_TYPE) RT,
                             (  SELECT PRIORITY_NO, PRIORITY_NAME FROM TBL_REQUEST_PRIORITY) RP,
                             (  SELECT CATEGORY_NO, CATEGORY_NAME FROM TBL_REQUEST_CATEGORY) RC,
                             (  SELECT USER_NO, USER_ID FROM TBL_USER) U,
                             (  SELECT USER_NO, USER_ID FROM TBL_USER) UP,
                             (  SELECT STATUS_NO, STATUS_NAME, CLASS_TABLE FROM TBL_STATUS) S
                       WHERE     R.TYPE_NO = RT.TYPE_NO
                             AND R.PRIORITY_NO = RP.PRIORITY_NO
                             AND R.CATEGORY_NO = RC.CATEGORY_NO
                             AND R.REQ_BY = U.USER_NO
                             AND R.REQ_PIC = UP.USER_NO
                             AND R.REQ_LSTATUS = S.STATUS_NO
                             AND R.REQ_NO = F.REQ_NO
                             AND R.REQ_NO = '$p_req_no'
                    ";
		$query = $this->db->GetArray($sql);
		if ($query)
		{
			return $query;
		}
	}
}