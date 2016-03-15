<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Forget_password extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data["title"] = "Forget Password";
		$data["navigation"] = "";
		$this->load->view("header",$data);
		$this->load->view("forget_password",$data);
		$this->load->view("footer");
	}
}