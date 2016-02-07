<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Announcement extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] = "Announcement";
		$data["navigation"] = "announcement";
		$this->load->view("header",$data);
		$this->load->view("announcement",$data);
		$this->load->view("footer");
	}

}