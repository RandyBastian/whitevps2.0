<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if(!empty($this->session->userdata["member"]))
		{
			
		}
		elseif(!empty($this->session->userdata["administrator"]))
		{
		    
		}
		else
		{
		    redirect("login");
		}
	}
	
	public function index()
	{
	    
	}
}