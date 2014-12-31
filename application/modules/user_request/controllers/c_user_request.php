<?PHP if (!defined('BASEPATH')) exit ('No direct script access allowed');
/** Controllers user request
 * Created by yansen April 2013
 * RC = Request Case, UR = User Request, SR = Status Requested
 * 
 *
 *
 */
class C_user_request extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_request/m_user_request');
		$this->load->model('status_request/m_sr');
	}
	
	public function index()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="end_user")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','new_req');
			$sess_log_username = $this->session->userdata('user_fname');
			$user_no = $this->session->userdata('user_no');
			$data['user_no'] = $user_no;
			$data['req_type'] = $this->m_user_request->req_type($user_no);
			$data['req_category'] = $this->m_user_request->req_category();
			$data['req_priority'] = $this->m_user_request->req_priority();
			$data['total_request'] = $this->m_sr->total_all_request($user_no);
			$data['active_NR'] = "Y";
			$data['title_content'] = "New Request";
			$data['width_content'] = "12";
			$data['content'] = "user_request/v_user_request";
			$this->load->view('template_system',$data);
		}
	}
	
	public function ifexist_ref_no()
	{
		$this->form_validation->set_rules('ref_no','ref no ','required|xss_clean');
		if ($this->form_validation->run()==TRUE)
		{
			$p_ref_no = $this->input->post('ref_no');
			$exist = $this->m_user_request->ifexist_ref_no($p_ref_no);
			echo $exist;
		}
	}
	
	function sequence_request($p_req_type)
	{
		switch ($p_req_type)
		{
			case 1: //PROJEK
			$type_req = "PJN";
			break;
			
			case 2: //MODIFIKASI
			$type_req = "PJM";
			break;
			
			case 3: //REVISI
			$type_req = "RVD";
			break;
			
			default:
			$type_req = "999";
			break;
		}
		if ($type_req=="999")
		{
			return false;
		}
		else
		{
			$tahun = date('Y');
			$bulan = date('m');
			$seq_no = $this->m_user_request->get_sequence();
			$seq_request = $seq_no."/".$type_req."-IDD/".$bulan."/".$tahun;
			return $seq_request;
		}
	}
	
	function kirim_mail($email_to, $subject, $message)
	{
		$email_from = "SVR-2.95@jne.co.id";
		
		$headers = "From: $email_from \r\n";
		$headers .= "Reply-To: $email_from \r\n";
		$headers .= "Return-Path: $email_from\r\n";
		$headers .= "X-Mailer: PHP \r\n";
		
		
		if(mail($email_to,$subject,$message,$headers)) 
		{
			return true;
		} 
		else 
		{
		   return false;
		}
	}
	
	public function new_request()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="end_user")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->form_validation->set_rules('req_name','Request Name','required|xss_clean');
			$this->form_validation->set_rules('req_type','Request Type','required|xss_clean');
			$this->form_validation->set_rules('req_category','Request Category','required|xss_clean');
			$this->form_validation->set_rules('req_reason','Request Reason','required|xss_clean');
			$this->form_validation->set_rules('req_note','Request Note','xss_clean');
			$this->form_validation->set_rules('req_ref_no','Ref No','xss_clean');
			$this->form_validation->set_rules('include_documentSupport','Include Document Support','xss_clean');
			if ($this->form_validation->run()==FALSE)
			{
				$this->session->set_userdata('menu_active','new_req');
				$sess_log_username = $this->session->userdata('user_fname');
				$sess_id = $this->session->userdata('user_no');
				$data['title'] = "New Request ".$sess_log_username;
				$data['req_type'] = $this->m_user_request->req_type();
				$data['req_category'] = $this->m_user_request->req_category();
				$data['req_priority'] = $this->m_user_request->req_priority();
				$data['active_NR'] = "Y";
				$data['side_left'] = "user_side_left/v_sideleft";
				$data['content_module'] = "user_request/v_user_request";
				$this->load->view('template',$data);
			}
			else
			{
				$p_req_by = $this->session->userdata('user_no');
				$p_req_name = $this->input->post('req_name');
				$p_req_type = $this->input->post('req_type');
				$p_req_no = trim($this->sequence_request($p_req_type));
				$p_req_category = $this->input->post('req_category');
				$p_req_reason = $this->input->post('req_reason');
				$p_req_note = $this->input->post('req_note');
				$p_req_refNo = $this->input->post('req_ref_no');
					$p_DS_form_req_dev = $this->input->post('form_req_dev')!="Y" ? "N" : "Y";
					$p_DS_bisnis_proses = $this->input->post('bisnis_proses')!="Y" ? "N" : "Y";
					$p_DS_regulasi = $this->input->post('regulasi')!="Y" ? "N" : "Y";
					$p_DS_master_data = $this->input->post('master_data')!="Y" ? "N" : "Y";
					$p_DS_fungsi_utama_app = $this->input->post('fungsi_utama_app')!="Y" ? "N" : "Y";
					$p_DS_karakteristik_pengguna = $this->input->post('karakteristik_pengguna')!="Y" ? "N" : "Y";
					$p_DS_prototype = $this->input->post('prototype')!="Y" ? "N" : "Y";
					$p_DS_RAS = $this->input->post('RAS')!="Y" ? "N" : "Y";
				$insert = $this->m_user_request->new_request($p_req_no,$p_req_name,$p_req_type,$p_req_category,$p_req_reason,$p_req_note,$p_req_refNo,$p_req_by);
				if ($insert==TRUE)
				{
					$folder_file = str_replace("/","_",$p_req_no);
					mkdir( "uploads/".$folder_file );
					$config['upload_path'] = './uploads/'.$folder_file.'/';
					//$config['allowed_types'] = 'zip|rar|doc|docx|xls|xlsx|pdf|jpeg|jpg|png|PNG|txt|oft|OFT|msg|MSG';
					$config['allowed_types'] = '*';
					$config['overwrite'] = TRUE;
					$config['max_size'] = '0';
					$this->load->library('upload',$config);
					
					if ($this->upload->do_upload('req_documentSupport'))
					{
						$data = $this->upload->data();
						$file_upload = $data['file_name'];
						$insert_req_file = $this->m_user_request->new_request_file($file_upload,$p_req_no,$p_DS_form_req_dev,$p_DS_bisnis_proses,$p_DS_regulasi,$p_DS_master_data,$p_DS_fungsi_utama_app,
																												$p_DS_karakteristik_pengguna,$p_DS_prototype,$p_DS_RAS);
						if ($insert_req_file==TRUE)
						{
							/*
							$email_to = "itwebdevelopment1@jne.co.id";
							$subject = "ITDEV SYSTEM - New Request Notification || Request No ";
							/*
							$message = "<b>New request<b><br><br>Request No # : ".$p_req_no."<br>Request Name : ".$p_req_name."<br>Request Reason : ".$p_req_reason."<br>Request Note : ".$p_req_note."<br>";
							$send_mail = kirim_mail($email_to, $subject, $message);
							*/
							
							$from_add = "SVR-2.95@jne.co.id"; 

							$to_add = "itdevelopment@jne.co.id"; //<-- put your yahoo/gmail email address here
							$subject = "ITDEV SYSTEM - New Request Notification || Request No# $p_req_no";
							$message = "New request\n\nRequest No # : $p_req_no \nRequest Name : $p_req_name \nRequest Reason : $p_req_reason \nRequest Note : $p_req_note\nTerima Kasih atas responnya\n\nDo your BEST !";
							
							$headers = "From: $from_add \r\n";
							$headers .= "Reply-To: $from_add \r\n";
							$headers .= "Return-Path: $from_add\r\n";
							$headers .= "X-Mailer: PHP \r\n";
							
							
							if(mail($to_add,$subject,$message,$headers)) 
							{
								$msg = "Mail sent OK";
							} 
							else 
							{
							   $msg = "Error sending email!";
							}
	//echo $msg;
							
							$this->session->set_flashdata('text_alert_sukses','Anda telah membuat request baru dengan nomor request <b>"'.$p_req_no.'"</b>');
							redirect('user_request/c_user_request');
						}
					}
					else
					{
						echo "gagal upload";
						$data = $this->upload->data();
						$file_upload = $data['file_type'];
						echo $this->upload->display_errors('<p>', '</p>');
					}
				}
				else
				{
					echo "fail";
				}
			}
		}
	}
}

?>