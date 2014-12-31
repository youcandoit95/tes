<?PHP if(!defined('BASEPATH')) exit ('No direct script allowed access');
/** @author Mohamad Yansen Riadi - 2014
 * 
 * cp = Change Password
 * Start of file c_cp.php */
 /* Location: ./application/modules/cp/controllers/c_cp.php 
 */

CLASS C_cp EXTENDS MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cp/m_cp');
	}

	public function index()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if($sess_login_level<0)
		{
			$this->session->sess_destroy();
			$data['title'] = "Access Denied for Change Password | Approval Purchase";
			$data['judul'] = "You don't have permission.";
			$data['isi'] = "You don't have permission, please re-login.";
			$this->load->view('cp/v_notification',$data);
			sleep(1);
			redirect('logins/c_login');
		}
		else
		{
			$data['title_content'] = "Change Password";
			$data['width_content'] = "12";
			$data['content'] = "cp/v_cp";
			$this->load->view('template_system',$data);
		}
	}
	
	public function cp()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if($sess_login_level<0)
		{
			$this->session->sess_destroy();
			$data['title'] = "Access Denied for Change Password | Approval Purchase";
			$data['judul'] = "You don't have permission.";
			$data['isi'] = "You don't have permission, please re-login.";
			$this->load->view('cp/v_notification',$data);
			sleep(1);
			redirect('logins/c_login');
		}
		else
		{
			$this->form_validation->set_rules('old_pass','Old Password','required|xss_clean');
			$this->form_validation->set_rules('new_pass','New Password','required|xss_clean');
			$this->form_validation->set_rules('conf_pass','Confirm Password','required|xss_clean|matches[new_pass]');
			if ($this->form_validation->run()==FALSE)
			{
				$this->index();
			}
			else
			{
				$username = $this->session->userdata('karyawan_nik');
				$old_pass = $this->input->post('old_pass');
				$cek_old = $this->m_cp->cek_old($old_pass,$username);
				if ($cek_old==TRUE)
				{
					$new_pass = strtoupper($this->input->post('conf_pass'));
					$cp = $this->m_cp->cp($new_pass,$username);
					if ($cp==TRUE)
					{
						$data['judul'] = "Success Change Password.";
						$data['isi'] = "Your password has been changed.<br>Please change password frequently.";
						$data['title'] = "Access Denied for Change Password | Approval Purchase";
						$this->session->sess_destroy();
						$this->load->view('cp/v_notification',$data);
					}
				}
				else
				{
					$this->session->set_flashdata('text_alert_danger','Password lama salah, silahkan coba lagi');
					redirect('cp/c_cp/');
				}
			}
		}
	}
}

/* End of file c_cp.php */
/* Location: ./application/modules/cp/controllers/c_cp.php */
?>