<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_policy extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$data["title"] = "Privacy Policy";
		$data["navigation"]	= "privacy-policy";
		$this->load->view("header",$data);
		$this->load->view('privacy_policy',$data);
		$this->load->view("footer");
	}
}