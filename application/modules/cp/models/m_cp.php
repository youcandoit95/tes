<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');
/** @author Mohamad Yansen Riadi - 2013
 * 
 * Start of file m_cp.php */
 /* Location: ./application/modules/cp/models/m_cp.php 
 */
 
 Class M_cp extends CI_Model
 {
	public function cek_old($old_pass,$username)
	{
		$acak = "4ut1sm95";
		$old_pass = md5($old_pass.$acak.$old_pass.$old_pass.md5($acak.$old_pass.$acak.$old_pass).$old_pass);
	
		$sql = " SELECT
					  COUNT(1) as cek
					FROM hcis_md_karyawan
					WHERE
					  karyawan_nik = '$username'
					  AND karyawan_password = '$old_pass' ";
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $q)
		{
			$CEK = $q['cek'];
		}
		
		if ($CEK==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function cp($new_pass,$username)
	{
		$acak = "4ut1sm95";
		$new_pass = md5($new_pass.$acak.$new_pass.$new_pass.md5($acak.$new_pass.$acak.$new_pass).$new_pass);
		$sql = "UPDATE hcis_md_karyawan SET karyawan_password = '$new_pass' WHERE karyawan_nik='$username'";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
 }
 
 /* End of file m_cp.php */
/* Location: ./application/modules/cp/models/m_cp.php */
?>