<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Server extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] 	= "Server Information";
		$data["server"] = $this->db->get_where("server",array("flag" => 1))->result();
		$data["port"]	= $this->db->get("configuration")->result();

		$this->load->view("header",$data);
		$this->load->view("server_information",$data);
		$this->load->view("footer");
	}

}
