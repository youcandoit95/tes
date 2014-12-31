<?PHP if (!defined('BASEPATH')) exit ("No direct scipt access allowed");

class C_SR_UH extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('status_request/m_sr');
	}
	
	public function AR()
	{
		$sess_login = $this->session->userdata('auth');
		$sess_user_id = $this->session->userdata('login_id');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$data['AR'] = $this->m_sr->AR_UH($sess_user_id);
			foreach($data['AR'] as $d)
			{
				echo $d->AR;
			}
		}
	}
	
	public function OP()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$data['OP'] = $this->m_sr->SR_OP_CNT();
			foreach ($data['OP'] as $d)
			{
				echo $d->COUNT_OP;
			}
		}
	}
	
	public function HR()
	{
		$sess_login = $this->session->userdata('auth');
		$sess_id = $this->session->userdata('login_id');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$data['HR'] = $this->m_sr->HR($sess_id);
			foreach ($data['HR'] as $d)
			{
				echo $d->HR;
			}
		}
	}
	
	public function WR()
	{
		$sess_login = $this->session->userdata('auth');
		$sess_id = $this->session->userdata('login_id');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$data['WR'] = $this->m_sr->WR($sess_id);
			foreach ($data['WR'] as $d)
			{
				echo $d->WR;
			}
		}
	}
	
	public function CR()
	{
		$sess_login = $this->session->userdata('auth');
		$sess_id = $this->session->userdata('login_id');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$data['CR'] = $this->m_sr->CR($sess_id);
			foreach ($data['CR'] as $d)
			{
				echo $d->CR;
			}
		}
	}
	
	public function DR()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$sess_id = $this->session->userdata('login_id');
			$data['DR'] = $this->m_sr->DR($sess_id);
			foreach ($data['DR'] as $d)
			{
				echo $d->DR;
			}
		}
	}
	
	public function WD()
	{
		$sess_login = $this->session->userdata('auth');
		$sess_id = $this->session->userdata('login_id');
		if ($sess_login!='true')
		{
			redirect('logins/c_login');
		}
		else
		{
			$data['WD'] = $this->m_sr->WD($sess_id);
			foreach ($data['WD'] as $d)
			{
				echo $d->WD;
			}
		}
	}
	
	public function RR()
	{
		$sess_login = $this->session->userdata('auth');
		$sess_id = $this->session->userdata('login_id');
		if ($sess_login!='true')
		{
			redirect('logins/c_login');
		}
		else
		{
			$data['RR'] = $this->m_sr->RR($sess_id);
			foreach ($data['RR'] as $d)
			{
				echo $d->RR;
			}
		}
	}
	
	public function FTR()
	{
		$sess_login = $this->session->userdata('auth');
		if ($sess_login!="true")
		{
			redirect('logins/c_login');
		}
		else
		{
			$id = $this->input->post('TR_ID');
			$get['TR'] = $this->m_sr->FTR_UH_new($id);
			foreach ($get['TR'] as $T)
			{
				echo $T->FTR_DATA;
			}
		}
	}
	
	public function UH_CTR()
	{
		$id = $this->input->post('id');
		$data['SR_CTR'] = $this->m_sr->SR_CTR_UH($id);
		$data['SR_CTR_CNT'] = $this->m_sr->SR_CTR_CNT();
		foreach ($data['SR_CTR_CNT'] as $p)
		{
			$exec = $p->jml;
		}
		
		if ($exec>0)
		{
			foreach ($data['SR_CTR'] as $S)
			{
				$NR[] = $S->request_notificationRead;
				$REQ_ID[] = $S->request_id;
				$PIC[] = $S->PIC_Dev;
				$PICnREQ_ID[] = $S->PIC_Dev."+".$S->request_id;
				$nr_cek[] = $S->request_notificationRead;
			}
			
			if (!empty($nr_cek[0]))
			{
				$NR_implode = implode("|",$NR);
				$REQ_ID_implode = implode(";",$REQ_ID);
				$PIC_implode = implode(";",$PIC);
				$PICnREQ_ID_implode = implode(";",$PICnREQ_ID);
				
				$NR_explode = explode("|",$NR_implode);
				$REQ_ID_explode = explode(";",$REQ_ID_implode);
				$PIC_explode = explode(";",$PIC_implode);
				$PICnREQ_ID_explode = explode(";",$PICnREQ_ID_implode);
				
				$NR_cnt = count($NR_explode);
				$REQ_ID_cnt = count($REQ_ID_explode);
				$PIC_cnt = count($PIC_explode);
				$PICnREQ_ID_cnt = count($PICnREQ_ID_explode);
				
				
				for ($x=0; $x<$NR_cnt; $x++)
				{
					$NR_data = explode(";",$NR_explode[$x]);
					$NR_data_cnt = count($NR_data);
					for ($y=1; $y<$NR_data_cnt; $y++)
					{
						if ($NR_data[$y]!=$id)
						{
							$req_id_willNotif[] = $NR_data[$y-1]."+".$PICnREQ_ID_explode[$x];
						}				
					}
				}
				
				if (!empty($req_id_willNotif))
				{
					$req_id_willNotif_implode = implode(";",$req_id_willNotif);
					$req_id_willNotif_explode = explode(";",$req_id_willNotif_implode);
					$req_id_willNotif_cnt = count($req_id_willNotif_explode);
					echo $req_id_willNotif_implode;
					
					/*for ($xx=0; $xx<$NR_cnt; $xx++)
					{
						$this->m_sr->SR_CTR_UPDATE($id,$REQ_ID_explode[$xx]);
					}*/
				}
				else
				{
					echo "nothing";
				}
			}
			else
			{
				echo "nothing";
			}
		}
		else
		{
			echo "nothing";
		}
		
	}
}

?>