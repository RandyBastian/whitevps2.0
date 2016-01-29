<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buy extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] = "Buy Premium";

		$data["server"] = $this->db->get_where("server",array("flag" => 1))->result();

		$this->load->view("header",$data);
		$this->load->view("buy",$data);
		$this->load->view("footer");
		
	}

}