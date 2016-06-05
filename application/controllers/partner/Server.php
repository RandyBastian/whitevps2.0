<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Server extends CI_Controller {

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
		$data['title'] = "Server Information";
		$this->db->order_by("name","asc");
		$data["server"] = $this->db->get("server")->result();

		$this->db->order_by("id_server","ASC");
		$data["configuration"] = $this->db->get("configuration")->result();
		$this->load->view("partner/header",$data);
		$this->load->view('member/server',$data);
		$this->load->view("partner/footer");
	}

}