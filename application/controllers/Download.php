<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] = "Download Area";
		$data["server"] = $this->db->get_where("server",array("flag" => 1))->result();
		$data["configuration"] = $this->db->get("configuration")->result();

		$this->load->view("header",$data);
		$this->load->view("download",$data);
		$this->load->view("footer");
	}
	
	public function file($id = null)
	{
		if(!$id)
			exit();
		
		$file = $this->db->get_where("configuration",array("id" => $id))->result();
		foreach($file as $row)
		{
			$id_server 	= $row->id_server;
			$port 		= $row->port;
			$type 		= strtolower($row->type);
		}

		$server 	= $this->db->get_where("server",array("id" => $id_server))->result();
		foreach($server as $s)
		{
			$host 			= $s->host;
			$name 			= $s->name;
			$ca 			= $s->certificate;
		}

		$root_path  = getcwd();
		$filename 	= "$name-$type-$port.ovpn";
		$source  	= "client\r\n"
					. "dev tun\r\n"
					. "proto $type\r\n"
					. "remote $host $port\r\n"
					. "route-method exe\r\n"
					. "nobind\r\n"
					. "persist-key\r\n"
					. "persist-tun\r\n"
					. "auth-user-pass\r\n"
					. "comp-lzo\r\n"
					. "verb 3\r\n"
					. "<ca>\r\n"
					. "$ca\r\n"
					. "</ca>";

		$file_location		= "assets/config/".$filename;
		$open_file 			= fopen("$file_location","w");
		fwrite($open_file, $source);
		fclose($open_file);
		
		$data = file_get_contents($file_location);
		force_download($filename,$data);
		unlink("$root_path/$file_location");
	}
}