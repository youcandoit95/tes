<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_homepage extends MX_Controller 
{

	public function index()
	{
		$data['side_left'] = 'user_page/v_sideleft';
		$data['content_module'] = 'request_user/v_request_user';
		$this->load->view('template', $data);
	}
	
}

?>