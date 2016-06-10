<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata["partner"]))
		{
			redirect("login");
		}
		date_default_timezone_set("Asia/Jakarta");
	}

	// ------------------ PROFIL ---------------------------- //
	public function index()
	{
		$data["title"] = "My Profile";
		$id 	= $this->session->userdata["id_partner"];
		$user 	= $this->db->get_where("user",array("role" => "PARTNER", "id" => $id))->result();
		foreach($user as $u)
		{
			$data["email"] 	 		= $u->email;
			$data["first_name"]		= $u->first_name;
			$data["last_name"]		= $u->last_name;
			$data["credit_premium"]	= $u->credit_premium;
			$data["address"]		= $u->address;
			$data["no_hp"]			= $u->no_hp;
			$data["facebook"]		= $u->facebook;
		}
		$this->load->view("partner/header",$data);
		$this->load->view("partner/profile",$data);
		$this->load->view("partner/footer");
	}

	public function profil_update()
	{
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$first_name		= $this->input->post("first_name");
		$last_name		= $this->input->post("last_name");
		$address 		= $this->input->post("address");
		$no_hp			= $this->input->post("no_hp");
		$facebook 		= $this->input->post("facebook");

		$data = array(
			"first_name" 	=> $first_name,
			"last_name"		=> $last_name,
			"address"		=> $address,
			"no_hp"			=> $no_hp,
			"facebook"		=> $facebook
			);

		$id = $this->session->userdata["id_partner"];
		$this->db->where("id",$id);
		$result = $this->db->update("user",$data);
		if($result)
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Profile Updated...</div>";
		else
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed!!. Please Try Again.</div>";
	}

	// --------------------- Change Password ---------------------- //
	public function change_password()
	{
		$data["title"] = "Change Password";
		$this->load->view("partner/header",$data);
		$this->load->view("partner/change_password",$data);
		$this->load->view("partner/footer");
	}

	public function change_password_submit()
	{
		if(empty($this->session->userdata["partner"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("current_password","Current Password","trim|required|xss_clean");
		$this->form_validation->set_rules("new_password","New Password","trim|required|xss_clean");
		$this->form_validation->set_rules("new_password_confirm","New Password Confirm","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
		$current_password 			= hash("md5",$this->input->post("current_password"));
		$new_password 				= hash("md5",$this->input->post("new_password"));
		$new_password_confirm		= hash("md5",$this->input->post("new_password_confirm"));

		$id = $this->session->userdata["id_partner"];
		$user = $this->db->get_where("user",array("role" => "partner","id" => $id))->result();
		if(empty($user))
		{
			redirect("login");
		}
		foreach($user as $u)
		{
			$user_password = $u->password;
		}

		if($user_password != $current_password)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Invalid Current Password !!</div>";
			exit();
		}
		if($current_password == $new_password)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>New Password cannot be sama as Current Password. !!</div>";
			exit();
		}
		if($new_password != $new_password_confirm)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Invalid New Password Confirm !!. Please Try Again. </div>";
			exit();
		}

		$this->db->where("id",$id);
		$this->db->where("role","partner");
		$result = $this->db->update("user",array("password" => $new_password));
		if($result)
		{
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Password Updated..</div>";
		}
		else
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Can not Update Password !!. Please Try Again.</div>";
		}
	}

}