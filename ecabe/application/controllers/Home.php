<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
            $data['content'] = 'v_home';
//            $this->load->view('header');
            $this->load->view('template', $data);
//            $this->load->view('footer');
	}
}
