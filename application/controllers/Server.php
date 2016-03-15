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
		$data["navigation"] = "server";
		$this->db->order_by("name","ASC");
		$data["server"] = $this->db->get_where("server")->result();
		$this->db->order_by("port","ASC");
		$data["port"]	= $this->db->get("configuration")->result();

		$this->load->view("header",$data);
		$this->load->view("server_information",$data);
		$this->load->view("footer");
	}

}
