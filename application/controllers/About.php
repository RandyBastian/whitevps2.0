<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$data["title"] = "About";
		$data["navigation"]	= "about";
		$this->load->view("header",$data);
		$this->load->view('about',$data);
		$this->load->view("footer");
	}
}