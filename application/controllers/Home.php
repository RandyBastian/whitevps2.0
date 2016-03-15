<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$data["title"] = "Home";
		$data["navigation"]	= "home";
		$this->load->view("header",$data);
		$this->load->view('home',$data);
		$this->load->view("footer");
	}

	function Ping()
	{
		// 0 = Aktif / UP, 1 = Tidak AKtif / DOWN
		$server 	= $this->db->get("server")->result();
		foreach($server as $s)
		{
			exec("ping -n 3 $s->host",$output,$status);
			if($status == "0")
			{
				$server_status = "UP";
			}
			else
			{
				$server_status = "DOWN";
			}
			$this->db->where("id",$s->id);
			$this->db->update("server",array("status" => $server_status,"update_status" => date("Y-m-d H:i")));
			echo "$s->name is $server_status<br>";
		}
	}
}