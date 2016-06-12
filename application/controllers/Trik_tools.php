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

		if(!empty($this->session->userdata["partner"]) || !empty($this->session->userdata["member"]) || !empty($this->session->userdata["administrator"]))
		{
			$id = "";
			if(!empty($this->session->userdata["id_member"]))
			{
				$id = $this->session->userdata["id_member"];
			}
			elseif(!empty($this->session->userdata["id_partner"]))
			{
				$id = $this->session->userdata["id_partner"];
			}
			elseif(!empty($this->session->userdata["id_administrator"]))
			{
				$id = $this->session->userdata["id_administrator"];
				$data["status"] = "true";
			}

			$date = date("Y-m-d",strtotime("+3 day"));
			$account = $this->db->get_where("account",array("id_user" => $id))->result();
			//echo $date;
			if(!empty($account))
			{
				foreach($account as $a)
				{
					if($a->expired_date > $date)
					{
						$data["status"] = "true";
						break;
					}
				}
			}
		}

		$this->load->view("header",$data);
		$this->load->view('trik_tools',$data);
		$this->load->view("footer");
	}
}