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
		$user = $this->db->get_where("user",array("id"=>$id,"role" => "MEMBER"))->result();
		if(empty($user))
		{
			redirect("partner/user");
		}
		foreach($user as $c)
		{
			$data["id"] 			= $id;

			$data['title'] = "Tambah Credit $c->email";
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

		$this->form_validation->set_rules("credit_premium","Credit Premium","required|greater_than[-1]");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}

		$session_partner 	= $this->db->get_where("user",array("id" => $this->session->userdata["id_partner"], "role" => "PARTNER"))->result();
		foreach($session_partner as $s)
		{
			$credit_premium_partner 	= $s->credit_premium;
		}

		if($credit_premium_partner < 1)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Credit anda Habis !!</div>";
			exit();
		}

		$credit_ditambahkan = $this->input->post("credit_premium");

		if($credit_ditambahkan > $credit_premium_partner)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Credit anda tidak Cukup !!</div>";
			exit();
		}

		// ---- Masukkan ke database member yang ditambakan ----- //
		$member_data 		= $this->db->get_where("user",array("id" => $id, "role" => "MEMBER"))->result();
		if(!empty($member_data))
		{
			foreach($member_data as $m)
			{
				$member_credit 	= $m->credit_premium;
				$member_email	= $m->email;
			}
		}

		$data = array(
			"credit_premium" => $member_credit + $credit_ditambahkan
			);

		$this->db->where("id",$id);
		$this->db->update("user",$data);

		//---- Update Credit Partner / Credit Partner pasti berkurang ----- //
		$data = array(
			"credit_premium" => $credit_premium_partner - $credit_ditambahkan
			);

		$this->db->where("id",$this->session->userdata["id_partner"]);
		$this->db->update("user",$data);

		$sisa =  $credit_premium_partner - $credit_ditambahkan;

		echo "
			<div class='alert alert-success alert-dismisabble'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<p>$member_email telah ditambahkan $credit_ditambahkan Credit !!!. Sisa Credit anda : $sisa .</p>
			</div>";
	}
}