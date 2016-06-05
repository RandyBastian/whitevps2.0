<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends CI_Controller {

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
		$id = $this->session->userdata["id_partner"];

		$this->db->where("id_user",$id);
		$this->db->order_by("expired_date",'ASC');
		$data["account"] = $this->db->get("account")->result();

		// View Credit
		$cek_user = $this->db->get_where("user",array("id" => $id))->result();
		foreach($cek_user as $row)
		{
			$credit = $row->credit_premium;
		}

		$data['title'] = "My OpenVPN Accounts | Credit : $credit";

		$this->load->view("partner/header",$data);
		$this->load->view('partner/account',$data);
		$this->load->view("partner/footer");
	}

	public function account_create()
	{
		$data['title'] = "Create New Account";
		$id = $this->session->userdata["id_partner"];
		$user = $this->db->get_where("user",array("id" => $id,"role" => "partner"))->result();
		foreach($user as $u)
		{
			$data['trial_account'] = $u->credit_free;
		}
		
		$this->load->view("partner/header",$data);
		$this->load->view('partner/account_create',$data);
		$this->load->view("partner/footer");
	}

	public function account_create_submit()
	{
		if(empty($this->session->userdata["partner"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("username","Username","trim|required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("password","Password","trim|required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
	
		// Ambil data partner dari server
		$id 			= $this->session->userdata["id_partner"];
		$cek_credit 	= $this->db->get_where("user",array("id" => $id,"role" => "partner"))->result();
		$type_account 	= $this->input->post("type");
		$username 		= $this->input->post("username");
		$password 		= $this->input->post("password");
		$created_date 	= date("Y-m-d");
		// Check Tipe Account yang dibuat
		foreach($cek_credit as $row)
		{
			if($type_account == "FREE")
			{
				if($row->credit_free < 1 )
				{
					echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed !!. check your Free credit !!</div>";
					exit();
				}
				$expired_date 	= date("Y-m-d",strtotime("+2 day"));
				$credit 		= $row->credit_free - 1;
			}
			else
			{
				if($row->credit_premium < 1)
				{
					echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed !!. Check your Premium Credit !!</div>";
					exit();
				}
				$expired_date 	= date("Y-m-d",strtotime("+30 day"));
				$credit 		= $row->credit_premium - 1;
			}
		}
		// Check Exist Username
		$account = $this->db->get("account")->result();
		foreach($account as $list)
		{
			if($list->username == $username)
			{
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Username  Exist. Try another Username !!!</div>";
				exit();
			}
		}
		// Insert ke Account Table
		$data = array (
			"id_user" 		=> $id,
			"username" 		=> $username,
			"password" 		=> $password,
			"created_date" 	=> $created_date,
			"expired_date" 	=> $expired_date
			);
		$this->db->insert("account",$data);
		// Update Credit in User
		if($type_account == 'FREE')
		{
			$this->db->where("id",$id);
			$this->db->update("user",array("credit_free" => $credit));
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account $username Has Been Created.<br>Free Credit Now : $credit .</div>";
		}
		else
		{
			$this->db->where("id",$id);
			$this->db->update("user",array("credit_premium" => $credit));
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account $username Has Been Created.<br>Premium Credit Now : $credit .</div>";
		}
	}

	public function account_edit($id = null)
	{
		$id_user = $this->session->userdata["id_partner"];
		$account = $this->db->get_where("account", array("id" => $id))->result();
		if(empty($account))
		{
			redirect("partner/account");
		}
		foreach($account as $row)
		{
			$data["id"] 			= $id;
			$data["username"] 		= $row->username;
			$data["title"] 			= "Change Password $row->username";
			if($row->id_user != $id_user)
			{
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account Does Not Exist !!</div>";
				exit();
			}
		}
		$this->load->view("partner/header",$data);
		$this->load->view('partner/account_edit',$data);
		$this->load->view("partner/footer");
	}

	public function account_edit_submit($id = null)
	{
		if(empty($this->session->userdata["partner"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("new_password","New Password","trim|required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("new_password_confirm","New Password Confirm","trim|required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
		// Ambil Password Account form
		$new_password 			= $this->input->post("new_password");
		$new_password_confirm  	= $this->input->post("new_password_confirm");
	
		$id_user = $this->session->userdata["id_partner"];
		$account = $this->db->get_where("account", array("id" => $id))->result();
		if(empty($account))
		{
			redirect("partner/account");
		}
		foreach($account as $row)
		{
			if($row->id_user != $id_user)
			{
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account Does Not Exist !!</div>";
				exit();
			}
			if($new_password != $new_password_confirm)
			{
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Invalid New Password Confirm !!. Please check your New Password !!</div>";
				exit();
			}
		}
		// Update password di tabel account
		$data = array (
			"password" => $new_password
			);
		$this->db->where("id",$id);
		$this->db->update("account",$data);
		// Echo hasil
		echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Password Changed !!!</div>";
	}

	public function top_up($id = null)
	{
		$id_partner = $this->session->userdata("id_partner");
		$user_data = $this->db->get_where("user",array("id" => $id_partner))->result();
		$get_akun = $this->db->get_where("account",array("id" => $id))->result();
		foreach($user_data as $coloum)
		{
			if($coloum->credit_premium < 1)
			{
				echo "Check Your Credit Please... :) ";
				exit();
			}
			$credit = $coloum->credit_premium;
		}

		foreach($get_akun as $row)
		{
			if($row->id_user != $id_partner)
				exit("Account does not Exist !!");
			
			$expired_date 	= $row->expired_date;
			$username 		= $row->username;
		}
		
		$now = date("Y-m-d H:i:s");
		if($expired_date == $now)
		{
			//echo "$expired_date == $now ";
			$next_expired = $expired_date;
		}
		elseif($expired_date < $now)
		{
			//echo "$expired_date < $now ";
			$next_expired = $now;
		}
		else
		{
			//echo "$expired_date > $now ";
			$next_expired = $expired_date;
		}
		
		$add_expired_date = date("Y-m-d", strtotime($next_expired. "+30 day"));
		// Change Expired Date Account table
		$this->db->where("id",$id);
		$this->db->update("account",array("expired_date" => $add_expired_date));
		
		// Update Credit
		$credit = $credit - 1;
		$this->db->where("id",$id_partner);
		$this->db->update("user",array("credit_premium" => $credit));
		echo "Success, Expired account $username : $add_expired_date";
	}

}