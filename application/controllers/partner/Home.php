<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata["partner"]))
		{
			redirect("login");
		}
	}

	public function index()
	{
		$data['title'] = "Partner Dashboard";
		$this->load->view("partner/header",$data);
		$this->load->view('partner/index');
		$this->load->view("partner/footer");
	}

}