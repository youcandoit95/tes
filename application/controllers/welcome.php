<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['side_left'] = 'homepage/v_sideleft';
		$this->load->view('template', $data);
	}
	
	private function md_user()
	{
		$data['content'] = 'users/users_view';
		$this->load->view('template_admin',$data);
	}
	
}
