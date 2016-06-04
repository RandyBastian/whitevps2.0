<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Not_found extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] = "404 Not Found";
		$data["navigation"] = "";
		$this->load->view("header",$data);
		$this->load->view("404",$data);
		$this->load->view("footer");
	}
}
