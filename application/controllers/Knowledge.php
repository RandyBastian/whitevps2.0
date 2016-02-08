<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Knowledge extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] 	= "Knowledge Base";
		$data["navigation"] = "knowledge";
		
		$this->load->view("header",$data);
		$this->load->view("knowledge",$data);
		$this->load->view("footer");
	}

}
