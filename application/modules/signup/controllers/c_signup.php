<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_signup extends MX_Controller {

	public function __construct()
    {
        parent::__construct();
       $this->load->model('signup/m_signup');
    }
	public function index(){
		$this->load->view('signup/v_signup');
	}
	
	public function go_reset_password($param)
	{
		$check = $this->m_signup->check_reset_password($param);
		if ($check>0)
		{
			$this->session->set_flashdata('reset_code',$param);
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_flashdata('info','Activation code was used , please do forgot password again if you want it.');
			$this->session->set_flashdata('class_alert','warning');
			redirect('logins/c_login');
		}
	}
	
	public function do_reset_password()
	{
		$this->form_validation->set_rules('reset_code','Secret Param','required');
		$this->form_validation->set_rules('pass','New Password','required|xss_clean');
		$this->form_validation->set_rules('confpass','Confirm Password','required|xss_clean|matches[pass]');
		$code = $this->input->post('reset_code');
		if ($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('error_reset','true');
			$this->session->set_flashdata('reset_code',$code);
			redirect('logins/c_login');
		}
		else
		{
			$pass = $this->input->post('confpass');
			$acak = "ASFGWGRGERHY744765*%1SDF@#";
			$real_pass = md5($pass.$acak.$pass.$pass.md5($acak.$pass.$acak.$pass).$pass);
			$do_reset = $this->m_signup->do_reset_password($real_pass,$code);
			if ($do_reset==TRUE)
			{
				$this->session->set_flashdata('info','Your password was successfully changed to <u>'.$pass.'</u>');
				$this->session->set_flashdata('class_alert','info');
				redirect('logins/c_login');
			}
		}
	}
	
	public function reset_password()
	{
		$this->form_validation->set_rules('reset_email','Email','required|xss_clean');
		if ($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('info','Please fill form reset password correctly');
			$this->session->set_flashdata('class_alert','danger');
			redirect('logins/c_login');
		}
		else
		{
			$email = $this->input->post('reset_email');
			$cek = $this->m_signup->cek_reset_password($email);
			if ($cek>0)
			{
				$enc_key = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
				$waktu = date('d-m-Y h:i:s');
				$reset_code = md5($email.$enc_key.$waktu.SHA1($email.$enc_key.$waktu));
				$reset = $this->m_signup->reset_password($email,$reset_code);
				if ($reset==TRUE)
				{
					$url_activation = "http://192.168.1.132:5050/itdev/signup/c_signup/go_reset_password/";
					$subject = "Recovery password IT Development System ";
					$url = base_url()."/mail/reset_pass.php";
					$curl_post_data = array(
												"kepada" => $email,
												"subject" => $subject,
												"urlactv" => $url_activation,
												"reset_code" => $reset_code,
												);
					$curl = curl_init($url);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
					$curl_response = curl_exec($curl);
					curl_close($curl);

					if($curl_response==1)
					{
						$this->session->set_flashdata('info','Request reset password was sent to your mail , please check it');
						$this->session->set_flashdata('class_alert','info');
						redirect('logins/c_login');
					}
				}
			}
			else
			{
				$this->session->set_flashdata('info','Your email is not registered');
				$this->session->set_flashdata('class_alert','warning');
				redirect('logins/c_login');
			}
		}
	}
	
	public function activation($param)
	{
		$activating = $this->m_signup->activation($param);
		if ($activating==TRUE)
		{
			$this->session->set_flashdata('info','Your account was successfully activated');
			$this->session->set_flashdata('class_alert','info');
			redirect('logins/c_login');
		}
	}
	
	public function signup_proses()
	{
		$this->form_validation->set_rules('name','Name','required|xss_clean');
		$this->form_validation->set_rules('email','Email','required|xss_clean');
		$this->form_validation->set_rules('username','Username','required|xss_clean');
		$this->form_validation->set_rules('pass','Pass','required|xss_clean');
		$this->form_validation->set_rules('re_pass','Re Pass','required|xss_clean');
		$this->form_validation->set_rules('depart','Department','required|xss_clean');
		$this->form_validation->set_rules('phone','Phone','required|xss_clean');
		$this->form_validation->set_rules('o_phone','Office Phone','required|xss_clean');
		if ($this->form_validation->run()==FALSE)
		{
			echo "1";
		}
		else
		{
			include "function.php";
			//include "Mail.php";
			$name = $this->input->post('name');
			//$cekname = cekstring($name);
			$email = $this->input->post('email');
	//		$cekemail = cekemail($email);
			$username = $this->input->post('username');
			//$cekuser = cekstring($username);
			$pass = $this->input->post('pass');
			$re_pass = $this->input->post('re_pass');
			$depart = $this->input->post('depart');
			$phone = $this->input->post('phone');
			$o_phone = $this->input->post('o_phone');
			$waktu = date('d-m-Y h:i:s');
			
			$cekusers = $this->m_signup->cekusers($username);
			$cekemail = $this->m_signup->exist_data('user_email',$email);
			if ($cekemail>0)	
			{
				echo "2";
			}
			else if ($pass!=$re_pass)	
			{
				echo "5";
			}
			else if($cekusers>0)
			{
				echo "4";
			}
			else
			{
				$acak = "ASFGWGRGERHY744765*%1SDF@#";
				$real_pass = md5($pass.$acak.$pass.$pass.md5($acak.$pass.$acak.$pass).$pass);
				$activation_code = md5($name.$pass.$acak.$email.$depart.$waktu.md5($name.$pass.$acak.$email.$depart.$waktu).md5($acak.$waktu));
				
				$url_activation = base_url()."/signup/c_signup/activation/";
				
				$from = "No Reply - IT Dev System <itwebdevelopment1@jne.co.id>";
				 $to = "".$username." <".$email.">";
				$subject = "Activation user IT Development System";
				$body = "Hi ".$name."! Anda telah mendaftar di IT Development System\nSilahkan klik link dibawah ini untuk aktifasi user anda\n".$url_activation.$activation_code."\nTerima Kasih\n\nBest Regards\nIT Development Robot's";
					 
				$insert = $this->m_signup->insert_user($name, $email, $username, $real_pass, $depart, $phone, $o_phone, $activation_code);
				if($insert==true)
				{
					$url = base_url()."/mail/send_email.php";
					$curl_post_data = array(
												"kepada" => $to,
												"subject" => $subject,
												"nama" => $name,
												"urlactv" => $url_activation,
												"actv_code" => $activation_code,
												);
					$curl = curl_init($url);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
					$curl_response = curl_exec($curl);
					curl_close($curl);

					if($curl_response==1)
					{
						echo "6";
					}
					else
					{
						echo "7";
					}
				}
			}
		}
	}
}
?>