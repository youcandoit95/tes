<?php

class M_print_request extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
	}
	
	public function print_request($p_req_no)
	{
		$sql = "SELECT R.REQ_NO,
						   TO_CHAR (R.REQ_CREATED, 'DD-MM-RRRR HH24:MI:SS') AS REQ_CREATED,
						   A.DEPT_NAME,
						   R.CATEGORY_NO,
						   C.CATEGORY_NAME,
						   R.TYPE_NO,
						   TY.TYPE_NAME,
						   R.REF_NO,
						   R.PRIORITY_NO,
						   PR.PRIORITY_NAME,
						   R.PRIORITY_REASON,
						   R.REQ_REASON,
						   F.FILE_FORM_REQ_DEV,
						   F.FILE_BISNIS_PROSES,
						   F.FILE_REGULASI,
						   F.FILE_MASTER_DATA,
						   F.FILE_FUNGSI_UTAMA_APP,
						   F.FILE_KARAKTERISTIK_PENGGUNA,
						   F.FILE_PROTOTYPE,
						   F.FILE_RAS,
						   F.FILE_UAT,
						   USR.USER_FNAME AS REQUEST_BY,
						   A.DEPT_MGR_NAME AS BY_USER_DEPT_MGR,
						   B.DEPT_MGR_NAME AS PIC_USER_DEPT_MGR,
						   R.REQ_NOTE
					  FROM TBL_REQUEST R,
						   TBL_REQUEST_CATEGORY C,
						   TBL_REQUEST_TYPE TY,
						   TBL_REQUEST_PRIORITY PR,
						   TBL_REQUEST_FILE F,
						   TBL_USER USR,
						   (SELECT D.DEPT_NAME, U.USER_NO, D.DEPT_MGR_NAME
							  FROM TBL_USER U, TBL_DEPT D
							 WHERE U.DEPT_NO = D.DEPT_NO) A,
						   (SELECT D.DEPT_MGR_NAME, U.USER_NO
							  FROM TBL_USER U, TBL_DEPT D
							 WHERE U.DEPT_NO = D.DEPT_NO) B
					 WHERE     
							R.REQ_NO='$p_req_no'
						   AND A.USER_NO = R.REQ_BY
						   AND C.CATEGORY_NO = R.CATEGORY_NO
						   AND TY.TYPE_NO = R.TYPE_NO
						   AND PR.PRIORITY_NO = R.PRIORITY_NO
						   AND F.REQ_NO = R.REQ_NO
						   AND USR.USER_NO = R.REQ_BY
						   AND B.USER_NO = R.REQ_PIC ";
		$query = $this->db->GetArray($sql);
		if ($query)
		{
			return $query;
		}
	}
}

?>