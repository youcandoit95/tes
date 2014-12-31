<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

/** Model side left homepage user
 * created by yansen April 2013
 * WR = waiting respond
 *
 *
 *
 */

class M_sideleft extends CI_Model
{
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
}

?>