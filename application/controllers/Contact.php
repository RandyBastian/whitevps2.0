<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] = "Contact Us";
		$data["navigation"] = "contact";
		$this->load->view("header",$data);
		$this->load->view("contact",$data);
		$this->load->view("footer");
	}

}