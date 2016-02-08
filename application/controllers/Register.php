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
				exit();
			}
			
			$first_name		= $this->input->post("first_name");
			$last_name		= $this->input->post("last_name");
			$email 			= $this->input->post("email");
			$phone 			= $this->input->post("phone");
			$password 		= $this->input->post("password");
			$current_pass 	= $this->input->post("current_password");
			$facebook		= $this->input->post("facebook");
			$city			= $this->input->post("city");
			$address 		= $this->input->post("address");
			if($password != $current_pass)
			{
				$pesan = "Password Does Not Match";
				$data["title"] = "Register";
				$data["navigation"] = "";
				$this->load->view("header",$data);
				$this->load->view("register",$data);
				$this->load->view("footer");
				exit();
			} 

			$user 	= $this->db->get_where("user",array("email" => $email))->result();
			if(!empt($user))
			{
				$pesan = "Email already Exist !!.";
				$data["title"] = "Register";
				$data["navigation"] = "";
				$this->load->view("header",$data);
				$this->load->view("register",$data);
				$this->load->view("footer");
				exit();
			}

			
		}
	}

}