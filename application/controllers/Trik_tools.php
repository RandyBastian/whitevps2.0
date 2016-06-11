<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trik_tools extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$data["title"] = "Trik & Tools";
		$data["navigation"]	= "trik";

		$this->db->order_by("created_date","DESC");
		$data["trik"]	= $this->db->get("trik")->result();
		$data["user"]	= $this->db->get_where("user",array("role" => "PARTNER"))->result();

		$data["status"] = "false";

		if($this->session->userdata["partner"] || $this->session->userdata["member"] || $this->session->userdata["administrator"])
		{
			$data["status"] = "true";
		}

		$this->load->view("header",$data);
		$this->load->view('trik_tools',$data);
		$this->load->view("footer");
	}
}