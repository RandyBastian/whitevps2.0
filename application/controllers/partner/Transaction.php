<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaction extends CI_Controller {

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
		$data["title"] = "My Transaction";
		$id = $this->session->userdata["id_partner"];
		$this->db->order_by("transaction_date","DESC");
		$data["transaction"] = $this->db->get_where("transaction",array("id_user" => $id,"flag" => "1"))->result();

		$this->load->view("partner/header",$data);
		$this->load->view("partner/transaction",$data);
		$this->load->view("partner/footer");
	}

}