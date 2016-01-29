<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] = "Announcement";
		$this->db->order_by("date","DES");
		$data["announcement"] = $this->db->get("announcement")->result();
		$this->load->view("administrator/header",$data);
		$this->load->view("administrator/announcement",$data);
		$this->load->view("administrator/footer");
	}

}