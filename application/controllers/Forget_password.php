<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Forget_password extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('recaptcha');
	}
	
	public function index()
	{
		$data["title"] = "Forget My Password";
		$data["navigation"] = "";
		$this->load->view("header",$data);
		$this->load->view("forget_password",$data);
		$this->load->view("footer");
	}
	
	public function send()
	{
		// Form Validation
		$this->form_validation->set_rules("email","Email","trim|required|valid_email|xss_clean");
		
		$captcha_answer = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($captcha_answer);
		if(!$response["success"])
		{
			$data["title"] = "Forget Password";
			$data["pesan"] = "ERROR";
			$data["navigation"] = "";
			$this->load->view("header",$data);
			$this->load->view("forget_password",$data);
			$this->load->view("footer");
			exit();
		
		}
		elseif($this->form_validation->run() == FALSE)
		{
			$data["title"] = "Forget Password";
			$data["navigation"] = "";
			$this->load->view("header",$data);
			$this->load->view("forget_password",$data);
			$this->load->view("footer");
			exit();
		}

		// Get Email input
		$email = $this->input->post("email");

		// Chek email on Database
		$user = $this->db->get_where("user",array("email" => $email, "role" => "MEMBER"))->result();

		if(empty($user))
		{
			redirect("not_found");
		}

		$random 		= rand(1000, 10000);
		$new_password 	= "white-vps-$random";

		// Hash password untuk dimasukkan ke database
		$new_password_hash = hash("md5",$new_password);

		$this->db->where("email",$email);
		$this->db->update("user",array("password" => $new_password_hash));

		// Send Email setting
		$config["protocol"]	= 'smtp';
		$config['smtp_host']	= "ssl://smtp.zoho.com";
		$config["smtp_port"]	= 465;
		$config["smtp_user"]	= "no_reply@white-vps.com";
		$config["smtp_pass"]	= "randy27bast";
		
		// Load email library and passing configured values to email library
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		// Sender email address
		$this->email->from("no_reply@white-vps.com", "No Reply WHITE-VPS");
		// Subject of email
		$this->email->subject("New Password - White-VPS");
		$this->email->set_mailtype("html");
		// Message in email
		$data["password"] = $new_password;
		$html_email = $this->load->view("email_password",$data,true);
		$this->email->message($html_email);
		
		//Ambil file
		$this->email->to($email);
		if ($this->email->send()) {
			//echo "Email Successfully Send !<br>";
			$data["pesan"] = "SUCCESS";
		}
		else
		{
		    //echo "<p class='error_msg'>Check Your account or Connection !</p>";
		    $data["pesan"] = "ERROR";
		}

		$data["title"] = "Forget Password";
		$data["navigation"] = "";
		$this->load->view("header",$data);
		$this->load->view("forget_password",$data);
		$this->load->view("footer");
	}
}