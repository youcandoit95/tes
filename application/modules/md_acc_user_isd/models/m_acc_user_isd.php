<?php if (!defined('BASEPATH')) exit ('No direct script allowed access');

class M_acc_user_isd extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('adodb_loader',array('name'=>'db','group'=>'default'));
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
	
	public function data_req_type()
	{
		$sql = "SELECT 
						TYPE_NO, TYPE_NAME
					FROM TBL_REQUEST_TYPE
					WHERE
						TYPE_ACTIVE = 1
						AND TYPE_DELETED = 99
					ORDER BY TYPE_NO ASC ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function data_acc_user_isd()
	{
		$sql = "SELECT 
						ACC_ID,
						U.USER_FNAME,
						T.TYPE_NAME,
						A.ACC_ACTIVE,
						TO_CHAR(A.ACC_CREATED_DATE, 'DD-MM-RRRR HH24:MI:SS') AS ACC_CREATED_DATE,
						TO_CHAR(A.ACC_LAST_UPDATED, 'DD-MM-RRRR HH24:MI:SS') AS ACC_LAST_UPDATED 
					FROM TBL_ACC_USER_ISD_REQ A, TBL_USER U, TBL_REQUEST_TYPE T
					WHERE
						A.USER_NO = U.USER_NO
						AND A.TYPE_NO = T.TYPE_NO ";
		$query = $this->db->GetArray($sql);
		return $query;
	}
	
	public function insert($p_user_isd, $p_req_type)
	{
		$sql = "SELECT ACC_ID 
					FROM TBL_ACC_USER_ISD_REQ
					WHERE USER_NO = '$p_user_isd'
						AND TYPE_NO = '$p_req_type' ";
		$query = $this->db->GetArray($sql);
		if (empty($query))
		{		
			$sql = " INSERT INTO TBL_ACC_USER_ISD_REQ
							(ACC_ID, USER_NO, TYPE_NO)
						VALUES
							(SEQ_ACC_USER_ISD_REQ.NEXTVAL, '$p_user_isd', '$p_req_type') ";
			$query = $this->db->Execute($sql);
			if ($query)
			{
				return 1;
			}
			else
			{
				return 2;
			}
		}
		else
		{
			return 99;
		}
	}
	
	public function activate($p_acc_id)
	{
		$sql = "UPDATE TBL_ACC_USER_ISD_REQ
					SET ACC_ACTIVE = 1, ACC_LAST_UPDATED = SYSDATE
					WHERE ACC_ID = '$p_acc_id' ";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return 1;
		}
	}
	
	public function disactivate($p_acc_id)
	{
		$sql = "UPDATE TBL_ACC_USER_ISD_REQ
					SET ACC_ACTIVE = 99, ACC_LAST_UPDATED = SYSDATE
					WHERE ACC_ID = '$p_acc_id' ";
		$query = $this->db->Execute($sql);
		if ($query)
		{
			return 1;
		}
	}
}