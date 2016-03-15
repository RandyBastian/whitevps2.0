<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] = "Register";
		$data["navigation"] = "";
		$this->load->view("header",$data);
		$this->load->view("register",$data);
		$this->load->view("footer");
	}

	public function process()
	{
		if($this->input->post("submit"))
		{
			$this->form_validation->set_rules("first_name","First Name","trim|required|xss_clean");
			$this->form_validation->set_rules("last_name","Last Name","trim|required|xss_clean");
			$this->form_validation->set_rules("email","Email","trim|required|valid_email|xss_clean");
			$this->form_validation->set_rules("password","Password","trim|required|xss_clean");
			$this->form_validation->set_rules("confirm_password","Confirm Password","trim|required|xss_clean");
			$this->form_validation->set_rules("phone","Phone","trim|integer|required|xss_clean");
			$this->form_validation->set_rules("address","Address","trim|required|xss_clean");
			if($this->form_validation->run() == FALSE)
			{
				$data["title"] = "Register";
				$data["navigation"] = "";
				$this->load->view("header",$data);
				$this->load->view("register",$data);
				$this->load->view("footer");
			}
			else
			{
				$first_name		= $this->input->post("first_name");
				$last_name		= $this->input->post("last_name");
				$email 			= $this->input->post("email");
				$phone 			= $this->input->post("phone");
				$password 		= $this->input->post("password");
				$confirm_pass 	= $this->input->post("confirm_password");
				$facebook		= $this->input->post("facebook");
				$city			= $this->input->post("city");
				$address 		= $this->input->post("address");

				// Ambil Data user
				$user 	= $this->db->get_where("user",array("email" => $email))->result();
				// Check Password dan Current Password apakah sama atau tidak
				if($password != $confirm_pass)
				{
					$data["pesan"] = "<strong>Password</strong> Does Not Match !!";
					$data["title"] = "Register";
					$data["navigation"] = "";
					$this->load->view("header",$data);
					$this->load->view("register",$data);
					$this->load->view("footer");
				}
				// Check Apakah User Exist
				elseif(!empty($user))
				{
					$data["pesan"] = "<strong>Email</strong> already Exist !!.";
					$data["title"] = "Register";
					$data["navigation"] = "";
					$this->load->view("header",$data);
					$this->load->view("register",$data);
					$this->load->view("footer");
				}
				else
				{
					$data 	= array(
						"first_name" 	=> $first_name,
						"last_name"		=> $last_name,
						"email"			=> $email,
						"password"		=> $password,
						"no_hp"			=> $phone,
						"facebook"		=> $facebook,
						"city"			=> $city,
						"address"		=> $address,
						"credit_free"	=> 1,
						"credit_premium" => 0,
						"role"			=> "MEMBER"
						);
					$result = $this->db->insert("user",$data);
					if($result)
					{
						$this->load->library('recaptcha');
						$data["result"] = "Success.. Please Login to Order <a href=". site_url("order") .">Here</a>";
						$this->load->view("login",$data);
					}
					else
					{
						$data["pesan"] = "<strong>Error !!.</strong> Try Again. !!.";
						$data["title"] = "Register";
						$data["navigation"] = "";
						$this->load->view("header",$data);
						$this->load->view("register",$data);
						$this->load->view("footer");
					}
				}
			}
		}
		else
		{
			redirect("register");
		}
	}

}