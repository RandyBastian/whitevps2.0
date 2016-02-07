<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {

    public function index()
	{
	    // Configure email library
		$config["protocol"]	= 'smtp';
		$config['smtp_host']	= "ssl://smtp.emailarray.com";
		$config["smtp_port"]	= 465;
		$config["smtp_user"]	= "admin@white-vps.com";
		$config["smtp_pass"]	= "Randy27Bast!";
		
		// Load email library and passing configured values to email library
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		// Sender email address
		$this->email->from("admin@white-vps.com", "Admin WHITE-VPS");
		// Receiver email address
		$this->email->to("randy.bastbast@gmail.com");
		// Subject of email
		$this->email->subject("Email Verification WHITE-VPS");
		// Message in email
		$this->email->message("Ini email verification");
		
		if ($this->email->send()) {
			$data['message_display'] = 'Email Successfully Send !';
		}
		else
		{
		    $data['message_display'] =  '<p class="error_msg">Invalid Gmail Account or Password !</p>';
		}
	}
}