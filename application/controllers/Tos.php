<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$data["title"] = "Term Of Service";
		$data["navigation"]	= "tos";
		$this->load->view("header",$data);
		$this->load->view('tos',$data);
		$this->load->view("footer");
	}
	
}