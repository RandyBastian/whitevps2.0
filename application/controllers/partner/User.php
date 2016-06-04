<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata["partner"]))
		{
			redirect("login");
		}
		
	}

	public function index()
	{
		$data['title'] = "Users";
		
		$data["user"] = $this->db->get_where("user",array("role"=>"MEMBER"))->result();
		
		$this->load->view("partner/header",$data);
		$this->load->view('partner/user',$data);
		$this->load->view("partner/footer");
		
	}

	public function user_edit($id = null)
	{
		if(!$id)
			redirect("partner/user");
		$user = $this->db->get_where("user",array("id"=>$id))->result();
		foreach($user as $c)
		{
			$data["id"] 			= $id;
			$data["email"] 			= $c->email;
			$data["password"]		= $c->password;
			$data["first_name"]		= $c->first_name;
			$data["last_name"]		= $c->last_name;
			$data["credit_premium"] = $c->credit_premium;
			$data["address"]		= $c->address;
			$data["no_hp"]			= $c->no_hp;
			$data["facebook"]		= $c->facebook;
			$data["role"]			= $c->role;

			$data['title'] = "Edit $c->email";
			$this->load->view("partner/header",$data);
			$this->load->view("partner/user_edit",$data);
			$this->load->view("partner/footer");
		}
	}

	public function user_edit_submit($id = null)
	{
		
		if(empty($this->session->userdata["partner"]))
		{
			exit("-1");
		}
		
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		if(!$id)
			exit('Invalid User !!!!...');

		$this->form_validation->set_rules("password","Password","trim|required|min_length[5]|max_length[40]|xss_clean");
		$this->form_validation->set_rules("credit_premium","Credit Premium","required|greater_than[-1]");
		$this->form_validation->set_rules("telp","No. Telepon","max_length[20]|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
		
		$password 		= $this->input->post("password");
		$first			= $this->input->post("first_name");
		$last			= $this->input->post("last_name");
		$address		= $this->input->post("address");
		$credit_premium = $this->input->post("credit_premium");
		$facebook 		= $this->input->post("facebook");
		$telp 			= $this->input->post("telp");
		$role 			= $this->input->post("role");

		$data = array(
			"password"		=> $password,
			"first_name"	=> $first,
			"last_name" 	=> $last,
			"credit_premium" => $credit_premium,
			"address" 		=> $address,
			"no_hp"			=> $telp,
			"facebook"		=> $facebook,
			"role"			=> $role
			);

		$this->db->where("id",$id);
		$this->db->update("user",$data);
		echo "
			<div class='alert alert-success alert-dismisabble'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<p>user User has been Updated....</p>
			</div>";
	}
}