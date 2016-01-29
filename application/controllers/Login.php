<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if(!empty($this->session->userdata["administrator"]))
		{
			redirect("administrator");
		}
		if(!empty($this->session->userdata["member"]))
		{
			redirect("member");
		}
		else
			$this->load->view("login");
	}

	public function signin()
	{
		$this->form_validation->set_rules("username","Username","required|xss_clean");
		$this->form_validation->set_rules("password","Password","required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			redirect("login");
		}
		else
		{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$member = $this->db->get("user")->result();
			foreach($member as $cek)
			{
				if($cek->name == $username && $cek->password == $password)
				{
					$this->session->set_userdata("password",$password);
					if($cek->role == 1)
					{
						$this->session->set_userdata("administrator",$username);
						$this->session->set_userdata("id_administrator",$cek->id);
						redirect("administrator");
					}
					else
					{
						$this->session->set_userdata("member",$username);
						$this->session->set_userdata("id_member",$cek->id);
						redirect("member");
					}
				}
			}
			redirect("login");
		}
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect("login");
	}
}
