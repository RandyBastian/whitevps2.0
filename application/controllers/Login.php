<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if(!empty($this->session->userdata["member"]))
		{
			redirect("member");
		}
		else
			$this->load->view("login");
	}

	public function signin()
	{
		$this->form_validation->set_rules("email","Email","required|xss_clean");
		$this->form_validation->set_rules("password","Password","required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			redirect("login");
		}
		
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$member = $this->db->get_where("user",array("role" => "MEMBER"))->result();
		foreach($member as $cek)
		{
			if($cek->email == $email && $cek->password == $password)
			{
				$this->session->set_userdata("password",$password);
				$this->session->set_userdata("member",$email);
				$this->session->set_userdata("id_member",$cek->id);
				redirect("member");
				
			}
		}
		redirect("login");
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect("login");
	}
}
