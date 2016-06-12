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

		$this->db->select("*");
		$this->db->from("session_account");
		$this->db->join("account","account.username = session_account.username","left");
		$this->db->where("session_account.status",1);
		$data["account"] = $this->db->get()->result();
		$data["id"] = "";
		if(!empty($this->session->userdata["member"]))
		{
			$data["id"] = $this->session->userdata["id_member"];
			$id 		= $data["id"];
		}
		elseif(!empty($this->session->userdata["partner"]))
		{
			$data["id"] = $this->session->userdata["id_partner"];
			$id 		= $data["id"];
		}
		elseif(!empty($this->session->userdata["administrator"]))
		{
			$data["id"] = $this->session->userdata["id_administrator"];
			$id 		= $data["id"];
		}

		$this->load->view("header",$data);
		$this->load->view("server_information",$data);
		$this->load->view("footer");
	}

}
