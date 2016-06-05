<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata["partner"]))
		{
			redirect("login");
		}
		
	}

	public function index()
	{
		$data["title"] = "Configuration Download Area";

		$this->db->order_by("name","ASC");
		$data["server"] 		= $this->db->get("server")->result();

		$this->db->order_by("id_server","ASC");
		$this->db->order_by("port","ASC");
		$data["configuration"]	= $this->db->get("configuration")->result();
		$this->load->view("partner/header",$data);
		$this->load->view("partner/download",$data);
		$this->load->view("partner/footer");
	}

}