<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {

    public function index()
	{
		echo "ehe, ngapain hayo ??? :v";	
	}

	public function activation_member($key)
	{
		if(empty($key))
		{
			redirect("not_found");
		}

		$user 		= $this->db->get_where("user",array("key_password" => $key))->result();
		if(empty($user))
		{
			$data["hasil"] = "ERROR";
		}
		else
		{
			$update_user = array(
				"account_status" => "ACTIVE",
				"key_password" => ""
				);
			$this->db->where("key_password",$key);
			$this->db->update("user",$update_user);
			$data["hasil"] = "ACTIVE";
		}

		$data["title"] = "Member Activataion";
		$data["navigation"] = "";
		$this->load->view("header",$data);
		$this->load->view("account_verify",$data);
		$this->load->view("footer");
	}
}