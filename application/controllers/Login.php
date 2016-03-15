<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('recaptcha');
	}

	public function index()
	{
		if(!empty($this->session->userdata["member"]))
		{
			redirect("member");
		}
		if(!empty($this->session->userdata["administrator"]))
		{
			redirect("administrator");
		}
		$this->load->view("login");
	}

	public function signin()
	{
		$this->form_validation->set_rules("email","Email","trim|required|valid_email|xss_clean");
		$this->form_validation->set_rules("password","Password","trim|required|xss_clean");
		/*
		$captcha_answer = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($captcha_answer);
		if(!$response["success"])
		{
			$data["pesan"] = "Invalid re-Captcha !!!";
			$this->load->view("login",$data);
		
		}
		else*/if($this->form_validation->run() == FALSE)
		{
			$this->load->view("login");
		}
		else
		{
			$email 		= $this->input->post("email");
			$password 	= $this->input->post("password");
			$user 		= $this->db->get_where("user",array("email" => $email,"password" => $password))->result();
			if($user)
			{
				foreach($user as $u)
				{
					$enkrip = hash("sha512", "$email-$u->id");
					if($u->role == "MEMBER")
					{
						$this->session->set_userdata("member",$enkrip);
						$this->session->set_userdata("id_member",$u->id);
						redirect("member");
					}
					else
					{
						$this->session->set_userdata("administrator",$enkrip);
						$this->session->set_userdata("id_administrator",$u->id);
						redirect("administrator");
					}
				}
			}
			else
			{
				$data["pesan"] = "Invalid Email or Password !!.";
				$this->load->view("login",$data);
			}
		}
	}

	public function admin()
	{
		if(!empty($this->session->userdata["administrator"]))
		{
			redirect("administrator");
		}
		$this->load->view("login");
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect("login");
	}
}
