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
		$data["navigation"]	= "trik-tools";
		$this->load->view("header",$data);
		$this->load->view('trik_tools',$data);
		$this->load->view("footer");
	}
}