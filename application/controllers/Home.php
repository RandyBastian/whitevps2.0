<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data["title"] = "Home";
		$data["navigation"]	= "home";
		$this->load->view("header",$data);
		$this->load->view('home',$data);
		$this->load->view("footer");
	}
}
