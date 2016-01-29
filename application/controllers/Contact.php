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
		$this->db->order_by("name","asc");
		$data["server"] = $this->db->get_where("server",array("flag" => 1))->result();
		
		$this->load->view("header",$data);
		$this->load->view("contact",$data);
		$this->load->view("footer");
	}

}