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
					$password 		= hash("md5",$password);
					$key_password 	= hash("sha512",$email.$password.date("Y-m-d H:i:s")); 
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
						"role"			=> "MEMBER",
						"account_status"	=> "LOCK",
						"key_password"	=> $key_password,
						"my_credit"		=> 0
					);
					
					$result = $this->db->insert("user",$data);
					if($result)
					{
						$this->load->library('recaptcha');
						$data["result"] = "Registration Success !!. Check Your Email to Activate this Account.";
						$this->kirim_email_key($key_password, $email);

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
	
	public function kirim_email_key($key, $email)
	{
		// Configure email library
		if(empty($key) || empty($email))
		{
			redirect("not_found");
		}

		
		$user = $this->db->get_where("user",array("key_password" => $key, "email" => $email))->result();
		if(empty($user))
		{
			redirect("not_found");
		}
		

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
		$this->email->subject("Member Activation - White-VPS");
		$this->email->set_mailtype("html");
		// Message in email
		$data["key"] = $key;
		$html_email = $this->load->view("email_key",$data,true);
		$this->email->message($html_email);
		//Ambil file
		//exit();
		$this->email->to($email);
		if ($this->email->send()) {
			//echo "<center>Email Successfully Send !<br></center>";
		}
		else
		{
		    echo "<p class='error_msg'>Error, Use Active Email to register Or Try again later !</p>";
		}
		//echo "<br> DONE !!!";
	}	

	public function resend_member_activation()
	{
		$data["title"] = "Resend Activation Key";
		$data["navigation"] = "";
		$this->load->view("header",$data);
		$this->load->view("resend_member_activation",$data);
		$this->load->view("footer");
	}

	public function resend_key_submit()
	{
		// Form Validation

		$this->form_validation->set_rules("email","Email","trim|required|valid_email|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			$data["title"] = "Resend Activation Key";
			$data["navigation"] = "";
			$this->load->view("header",$data);
			$this->load->view("resend_member_activation",$data);
			$this->load->view("footer");
			exit();
		}

		// Get Email input
		$email = $this->input->post("email");
		
		// Check email on Database
		$user = $this->db->get_where("user",array("email" => $email, "account_status" => "LOCK"))->result();
		if(empty($user))
		{
			redirect("not_found");
		}

		foreach($user as $u)
		{
			$key = $u->key_password;
		}

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
		$this->email->subject("Resend Member Activation - White-VPS");
		$this->email->set_mailtype("html");
		// Message in email
		$data["key"] = $key;
		$html_email = $this->load->view("email_key",$data,true);
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
		$data["title"] = "Resend Activation Key";
		$data["navigation"] = "";
		$this->load->view("header",$data);
		$this->load->view("resend_member_activation",$data);
		$this->load->view("footer");
	}
}