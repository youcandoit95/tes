<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_signup extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function cekusers($username){
		$query = $this->db->query("SELECT user_name FROM tbl_user WHERE user_name = '$username'");
		return $query->num_rows();
	}
	
	public function insert_user($name, $email, $username, $real_pass, $depart, $phone, $o_phone,$activation_code)
	{
		$query = $this->db->query(" INSERT INTO tbl_user
														(user_name,user_email,user_pass,user_fullName,user_dept,user_phonePersonal,user_phoneOffice,user_created,user_activationCode) 
														VALUES ('$username','$email','$real_pass','$name','$depart','$phone','$o_phone',now(),'$activation_code')
													");
		if($query)
		{return true;}
	}
	
	public function reset_password($email,$reset_code)
	{
		$sql = "UPDATE tbl_user SET user_activationCode='$reset_code', user_active='R' WHERE user_email='$email'";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function exist_data($field,$param)
	{
		$sql = "SELECT $field FROM tbl_user WHERE $field='$param'";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->num_rows();
		}
	}
	
	public function do_reset_password($pass,$code)
	{
		$sql = "UPDATE tbl_user SET user_pass='$pass', user_activationCode='recovered', user_active='Y' WHERE user_activationCode='$code' AND user_active='R' ";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
	
	public function check_reset_password($param)
	{
		$sql_check = "SELECT user_name FROM tbl_user WHERE user_active='R' AND user_activationCode='$param' ";
		$query_check = $this->db->query($sql_check);
		if ($query_check)
		{
			return $query_check->num_rows();
		}
	}
	
	public function cek_reset_password($email)
	{
		$sql = "SELECT user_name FROM tbl_user WHERE user_email='$email'";
		$query = $this->db->query($sql);
		if ($query)
		{
			return $query->num_rows();
		}
	}
	
	public function activation($code)
	{
		$sql = "UPDATE tbl_user SET user_active='Y',user_activationCode='activated' WHERE user_activationCode='$code'";
		$query = $this->db->query($sql);
		if ($query)
		{
			return true;
		}
	}
}
?>