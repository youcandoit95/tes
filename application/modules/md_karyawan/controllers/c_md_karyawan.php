<?php if (!defined('BASEPATH'))  exit ('No direct script access allowed');

class C_md_karyawan extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('md_karyawan/m_md_karyawan');
		$this->load->model('procedure/m_proc_schd_job');
	}

	public function index()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level==88)
		{
			$this->session->set_userdata('sub_menu_active','karyawan');
			
			$data['md_division'] = $this->m_md_karyawan->md_division();
			$data['md_jabatan'] = $this->m_md_karyawan->md_jabatan();
			$data['data_user'] = $this->m_md_karyawan->data_user();
			
			$data['title_content'] = "Management Data Karyawan";
			$data['width_content'] = "12";
			$data['content'] = 'md_karyawan/v_md_karyawan';
			$this->load->view('template_system',$data);
		}
		else
		{
			$this->session->sess_destroy();
			redirect('logins/c_login');
		}
	}
	
	public function ajax_option_md_dept()
	{
		$p_div_no = $this->input->post('div_no');
		if (empty($p_div_no))
		{
			echo "<option value=''>Pilih Divisi</option>";
		}
		else
		{
			$data_md_dept = $this->m_md_karyawan->md_dept($p_div_no);
			echo "<option value=''>Pilih Department</option>";
			foreach ($data_md_dept as $d)
			{
				echo "<option value='".$d['dept_no']."'>".$d['dept_name']."</option>";
			}
		}
	}
	
	public function ajax_option_md_dept_report()
	{
		$p_div_no = $this->input->post('div_no');
		if (empty($p_div_no))
		{
			echo "<option value='888'>Pilih Divisi</option>";
		}
		else
		{
			if ($p_div_no=="888")
			{
				echo "<option value='888'>Semua Departement</option>";
			}
			else
			{
				$data_md_dept = $this->m_md_karyawan->md_dept($p_div_no);
				echo "<option value=''>Pilih Departement</option>";
				echo "<option value='888'>Semua Departement</option>";
				foreach ($data_md_dept as $d)
				{
					echo "<option value='".$d['dept_no']."'>".$d['dept_name']."</option>";
				}
			}
		}
	}
	
	public function ajax_option_md_bagian()
	{
		$p_div_no = $this->input->post('div_no');
		$p_dept_no = $this->input->post('dept_no');
		if (empty($p_div_no) || empty($p_dept_no))
		{
			echo "<option value=''>Pilih Department</option>";
		}
		else
		{
			$data_md_bagian = $this->m_md_karyawan->md_bagian($p_div_no, $p_dept_no);
			if (empty($data_md_bagian))
			{
				echo "<option value=''>Tidak memliki bagian</option>";
			}
			else
			{
				echo "<option value=''>Pilih Bagian</option>";
				foreach ($data_md_bagian as $d)
				{
					echo "<option value='".$d['bagian_no']."'>".$d['bagian_name']."</option>";
				}
			}
		}
	}
	
	public function ajax_option_md_bagian_report()
	{
		$p_div_no = $this->input->post('div_no');
		$p_dept_no = $this->input->post('dept_no');
		if (empty($p_div_no) || empty($p_dept_no))
		{
			echo "<option value=''>Pilih Department</option>";
		}
		else
		{
			if ($p_dept_no=="888")
			{
				echo "<option value='888'>Semua Bagian</option>";
			}
			else
			{
				$data_md_bagian = $this->m_md_karyawan->md_bagian($p_div_no, $p_dept_no);
				if (empty($data_md_bagian))
				{
					echo "<option value='888'>Tidak memliki bagian</option>";
				}
				else
				{
					echo "<option value='888'>Semua Bagian</option>";
					foreach ($data_md_bagian as $d)
					{
						echo "<option value='".$d['bagian_no']."'>".$d['bagian_name']."</option>";
					}
				}
			}
		}
	}
	
	public function ajax_detail_karyawan()
	{
		$p_nik = $this->input->post('nik');
		if (empty($p_nik))
		{
			
		}
		else
		{
			$data_detail_karyawan = $this->m_md_karyawan->detail_karyawan($p_nik);
			foreach ($data_detail_karyawan as $d)
			{
				$row['karyawan_nik'] = $d['karyawan_nik'];
				$row['karyawan_div_name'] = $d['karyawan_div_name'];
				$row['karyawan_dept_name'] = $d['karyawan_dept_name'];
				$row['karyawan_bagian_name'] = $d['karyawan_bagian_name'];
				$row['karyawan_jabatan_name'] = $d['karyawan_jabatan_name'];
				$row['karyawan_fullname'] = $d['karyawan_fullname'];
				$row['karyawan_address'] = $d['karyawan_address'];
					
					$karyawan_phone2 = $d['karyawan_phone2']!="" ? ", ".$d['karyawan_phone2'] : "";
					
				$row['karyawan_phone1'] = $d['karyawan_phone1'].$karyawan_phone2;
				$row['karyawan_email'] = $d['karyawan_email'];
				$row['karyawan_get_cuti'] = $d['karyawan_get_cuti']==1 ? "Ya" : "Tidak";
			}
			
			echo json_encode($row);
		}
	}
	
	public function karyawan_baru()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level==88)
		{
			$this->session->set_userdata('sub_menu_active','karyawan');
			
			$this->form_validation->set_rules('txt_karyawan_nik','NIK','trim|required|xss_clean|is_unique[hcis_md_karyawan.karyawan_nik]');
			$this->form_validation->set_rules('cmb_karyawan_jabatan_no','Jabatan','trim|required|xss_clean');
			$p_karyawan_jabatan_no = $this->input->post('cmb_karyawan_jabatan_no');
			
			if ($p_karyawan_jabatan_no==1) // top director
			{
				$this->form_validation->set_rules('cmb_karyawan_div_no','Division','trim|xss_clean');
			}
			
			if ($p_karyawan_jabatan_no>3) // mulai dari manager kebawah
			{
				$this->form_validation->set_rules('cmb_karyawan_div_no','Division','trim|required|xss_clean');
				$this->form_validation->set_rules('cmb_karyawan_dept_no','Departemen','required|xss_clean');
			}
			
			if ($p_karyawan_jabatan_no>4)
			{
				$this->form_validation->set_rules('cmb_karyawan_div_no','Division','trim|required|xss_clean');
				$this->form_validation->set_rules('cmb_karyawan_bagian_no','Bagian','xss_clean');
			}
			
			$this->form_validation->set_rules('txt_karyawan_fullname','Nama Lengkap','required|xss_clean');
			$this->form_validation->set_rules('txt_tanggal_lahir','Tanggal Lahir','required|xss_clean');
			$this->form_validation->set_rules('txt_karyawan_address','Alamat','required|xss_clean');
			$this->form_validation->set_rules('txt_karyawan_phone1','Telepon 1','required|xss_clean');
			$this->form_validation->set_rules('txt_karyawan_phone2','Telepon 2','xss_clean');
			$this->form_validation->set_rules('txt_karyawan_email','Email','trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('cmb_dapat_cuti','Dapat Cuti','required|xss_clean');
			if ($this->form_validation->run() == TRUE)
			{
				$p = str_replace("-","",$this->input->post('txt_tanggal_lahir'));
				$acak = "4ut1sm95";
				$p_karyawan_password = md5($p.$acak.$p.$p.md5($acak.$p.$acak.$p).$p);
				
				$p_karyawan_nik = $this->input->post('txt_karyawan_nik');
				$p_karyawan_div_no = $this->input->post('cmb_karyawan_div_no');
				
				if ($p_karyawan_jabatan_no==1) // top director
				{
					$p_karyawan_div_no = "99";
					$p_karyawan_dept_no = "99";
					$p_karyawan_bagian_no = "99";
				}
				if ($p_karyawan_jabatan_no<=3) // gm keatas
				{
					$p_karyawan_dept_no = "99";
					$p_karyawan_bagian_no = "99";
				}
				else
				{
					$p_karyawan_dept_no = $this->input->post('cmb_karyawan_dept_no');
					$p_karyawan_bagian_no = $this->input->post('cmb_karyawan_bagian_no');
				}	
				
				$p_karyawan_fullname = $this->input->post('txt_karyawan_fullname');
				$p_tanggal_lahir = $this->input->post('txt_tanggal_lahir');
				$p_karyawan_address = $this->input->post('txt_karyawan_address');
				$p_karyawan_phone1 = $this->input->post('txt_karyawan_phone1');
				$p_karyawan_phone2 = $this->input->post('txt_karyawan_phone2');
				$p_karyawan_email = $this->input->post('txt_karyawan_email');
				$p_karyawan_dapat_cuti = $this->input->post('cmb_dapat_cuti');
				$karyawan_baru = $this->m_md_karyawan->karyawan_baru($p_karyawan_nik, $p_karyawan_password, $p_karyawan_div_no,$p_karyawan_dept_no, $p_karyawan_bagian_no, $p_karyawan_jabatan_no, $p_karyawan_fullname, $p_tanggal_lahir, $p_karyawan_address, $p_karyawan_phone1, $p_karyawan_phone2, $p_karyawan_email, $p_karyawan_dapat_cuti);
				if ($karyawan_baru==TRUE)
				{
					$type_alert = "text_alert_warning";
					$message_alert = "Karyawan baru berhasil di buat , terjadi kesalahan saat generate data absen. Silahkan hubungi administrator ";
					
					$generate_absen_karyawan = $this->m_proc_schd_job->generate_absen_karyawan($p_karyawan_nik, $p_karyawan_jabatan_no);
					if ($generate_absen_karyawan==TRUE)
					{
						$type_alert = "text_alert_sukses";
						$message_alert = "Karyawan baru berhasil di buat";
					}
					
					$this->session->set_flashdata($type_alert, $message_alert);
					redirect('md_karyawan/c_md_karyawan/karyawan_baru');
				}
				else
				{
					$this->session->set_flashdata('text_alert_danger','Karyawan baru gagal di buat');
					redirect('md_karyawan/c_md_karyawan/karyawan_baru');
				}
			}
			else
			{
				$this->index();
			}
		}
		else
		{
			redirect('logins/c_login');
		}
	}
	
	public function edit_user()
	{
		if ($this->session->userdata('auth')!="superuser")
		{
			redirect('logins/c_login');
		}
		else
		{
			$this->session->set_userdata('menu_active','user');
			$this->form_validation->set_rules('user_no','User No','required|xss_clean');
			$this->form_validation->set_rules('department','Deparment','required|xss_clean');
			$this->form_validation->set_rules('user_fname','User Fullname','required|xss_clean');
			$this->form_validation->set_rules('user_nname','User Nickname','required|xss_clean');
			$this->form_validation->set_rules('user_email','User Email','required|xss_clean');
			$this->form_validation->set_rules('user_phone','User Phone','required|xss_clean');
			$this->form_validation->set_rules('user_level','User Level','required|xss_clean');
			$this->form_validation->set_rules('user_unit','Unit','xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_user_no = $this->input->post('user_no');
				$p_department = $this->input->post('department');
				$p_user_fname = $this->input->post('user_fname');
				$p_user_nname = $this->input->post('user_nname');
				$p_user_email = $this->input->post('user_email');
				$p_user_phone = $this->input->post('user_phone');
				$p_user_level = $this->input->post('user_level');
				$p_user_unit = $this->input->post('user_unit');
				$update = $this->m_md_karyawan->update_users($p_user_no, $p_department, $p_user_fname, $p_user_nname, $p_user_email, $p_user_phone, $p_user_level, $p_user_unit);
				if ($update==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Data user berhasil di perbarui');
					redirect('md_karyawan/c_users/user');
				}
				else
				{
					echo "fail";
				}
			}
			else
			{
				$data['title'] = "Management Data User - ";
				$data['dept'] = $this->m_md_karyawan->data_dept();
				$data['level'] = $this->m_md_karyawan->level_user();
				$data['data_user'] = $this->m_md_karyawan->data_user();
				$data['TD_user'] = $this->m_md_karyawan->TD_user();
				$data['content_admin'] = 'md_karyawan/v_users';
				$this->load->view('template_admin',$data);
			}
		}
	}
	
	public function FED_User()
	{
		$this->session->set_userdata('menu_active','user');
		$id = $this->input->post('FED_user_id');
		$data_user = $this->m_md_karyawan->FED_User($id);
		foreach ($data_user as $d)
		{
			$row['LEVEL_NO'] = $d['LEVEL_NO'];
			$row['USER_ID'] = $d['USER_ID'];
			$row['DEPT_NO'] = $d['DEPT_NO'];
			$row['CATEGORY_NO'] = $d['CATEGORY_NO'];
			$row['USER_FNAME'] = $d['USER_FNAME'];
			$row['USER_NICKNAME'] = $d['USER_NICKNAME'];
			$row['USER_EMAIL'] = $d['USER_EMAIL'];
			$row['USER_PHONE'] = $d['USER_PHONE'];
		}
		echo json_encode($row);
	}
	
	public function Activate_user($id)
	{
		$this->session->set_userdata('menu_active','user');
		$nonAndActivate_user = $this->m_md_karyawan->nonAndActivate_user($id);
		if ($nonAndActivate_user=="1")
		{
			$this->session->set_flashdata('text_alert_sukses','User berhasil di aktifkan');
			redirect('md_karyawan/c_users/user');
		}
		else
		{
			$this->session->set_flashdata('text_alert_sukses','User berhasil di non-aktifkan');
			redirect('md_karyawan/c_users/user');
		}
	}
	
	public function cek_user()
	{
		$p_nik = $this->input->post('nik');
		if (empty($data))
		{
			echo "4";
		}
		else
		{
			$cek = $this->m_md_karyawan->cek_user_available($p_nik);
			echo $cek;
		}
	}
	
	public function set_ya_get_cuti()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level==88)
		{
			$this->form_validation->set_rules('nik','secret','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $this->input->post('nik');
				$set_ya_get_cuti = $this->m_md_karyawan->set_ya_get_cuti($p_nik);
				if ($set_ya_get_cuti==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Berhasil men-set Ya mendapatkan cuti');
					redirect('md_karyawan/c_md_karyawan/');
				}
				else
				{
					$this->session->set_flashdata('text_alert_danger','Gagal men-set Ya mendapatkan cuti');
					redirect('md_karyawan/c_md_karyawan/');
				}
			}
		}
		else
		{
			redirect('logins/c_login');
		}
	}
	
	public function set_tidak_get_cuti()
	{
		$sess_login_level = $this->session->userdata('karyawan_jabatan_no');
		if ($sess_login_level==88)
		{
			$this->form_validation->set_rules('nik','secret','required|xss_clean');
			if ($this->form_validation->run()==TRUE)
			{
				$p_nik = $this->input->post('nik');
				$set_tidak_get_cuti = $this->m_md_karyawan->set_tidak_get_cuti($p_nik);
				if ($set_tidak_get_cuti==TRUE)
				{
					$this->session->set_flashdata('text_alert_sukses','Berhasil men-set Tidak mendapatkan cuti');
					redirect('md_karyawan/c_md_karyawan/');
				}
				else
				{
					$this->session->set_flashdata('text_alert_danger','Gagal men-set Tidak mendapatkan cuti');
					redirect('md_karyawan/c_md_karyawan/');
				}
			}
		}
		else
		{
			redirect('logins/c_login');
		}
	}
}

?>