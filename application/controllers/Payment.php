<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{

		$data["title"] = "Payment";
		$data["navigation"] = "payment";

		$this->load->view("header",$data);
		$this->load->view("payment");
		$this->load->view("footer");
	}
}