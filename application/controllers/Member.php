<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata["member"]))
		{
			redirect("login");
		}
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		$data["title"] 	= "Member Dashboard";
		$data["server"] = $this->db->count_all("server");
		$data["port"]  	= $this->db->count_all("configuration");

		$id = $this->session->userdata["id_member"];
		$member_data = $this->db->get_where("user",array("id" => $id))->result();
		foreach($member_data as $row)
		{
			$data["credit"] = $row->credit_premium;
		}
		$account_member = $this->db->get_where("account", array("id_user" => $id))->result();
		$data["expired_account"] = 0;
		$data["active_account"] = 0;
		foreach($account_member as $row)
		{
			$now = date("Y-m-d");
			if($now >= $row->expired_date)
			{
				$data["expired_account"]++;
			}
			else
			{
				$data["active_account"]++;
			}
		}

		$this->load->view("member/header",$data);
		$this->load->view("member/index",$data);
		$this->load->view("member/footer");
	}
	// ------------------ PROFIL ---------------------------- //
	public function profile()
	{
		$data["title"] = "My Profile";
		$id 	= $this->session->userdata["id_member"];
		$user 	= $this->db->get_where("user",array("role" => "MEMBER", "id" => $id))->result();
		foreach($user as $u)
		{
			$data["email"] 	 		= $u->email;
			$data["first_name"]		= $u->first_name;
			$data["last_name"]		= $u->last_name;
			$data["credit_premium"]	= $u->credit_premium;
			$data["address"]		= $u->address;
			$data["no_hp"]			= $u->no_hp;
			$data["facebook"]		= $u->facebook;
		}
		$this->load->view("member/header",$data);
		$this->load->view("member/profile",$data);
		$this->load->view("member/footer");
	}

	public function profil_update()
	{
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$first_name		= $this->input->post("first_name");
		$last_name		= $this->input->post("last_name");
		$address 		= $this->input->post("address");
		$no_hp			= $this->input->post("no_hp");
		$facebook 		= $this->input->post("facebook");

		$data = array(
			"first_name" 	=> $first_name,
			"last_name"		=> $last_name,
			"address"		=> $address,
			"no_hp"			=> $no_hp,
			"facebook"		=> $facebook
			);

		$id = $this->session->userdata["id_member"];
		$this->db->where("id",$id);
		$result = $this->db->update("user",$data);
		if($result)
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Profile Updated...</div>";
		else
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed!!. Please Try Again.</div>";
	}

	// --------------------- Change Password ---------------------- //
	public function change_password()
	{
		$data["title"] = "Change Password";
		$this->load->view("member/header",$data);
		$this->load->view("member/change_password",$data);
		$this->load->view("member/footer");
	}

	public function change_password_submit()
	{
		if(empty($this->session->userdata["member"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("current_password","Current Password","trim|required|xss_clean");
		$this->form_validation->set_rules("new_password","New Password","trim|required|xss_clean");
		$this->form_validation->set_rules("new_password_confirm","New Password Confirm","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
		$current_password 			= hash("md5",$this->input->post("current_password"));
		$new_password 				= hash("md5",$this->input->post("new_password"));
		$new_password_confirm		= hash("md5",$this->input->post("new_password_confirm"));

		$id = $this->session->userdata["id_member"];
		$user = $this->db->get_where("user",array("role" => "MEMBER","id" => $id))->result();
		if(empty($user))
		{
			redirect("login");
		}
		foreach($user as $u)
		{
			$user_password = $u->password;
		}

		if($user_password != $current_password)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Invalid Current Password !!</div>";
			exit();
		}
		if($current_password == $new_password)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>New Password cannot be sama as Current Password. !!</div>";
			exit();
		}
		if($new_password != $new_password_confirm)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Invalid New Password Confirm !!. Please Try Again. </div>";
			exit();
		}

		$this->db->where("id",$id);
		$this->db->where("role","MEMBER");
		$result = $this->db->update("user",array("password" => $new_password));
		if($result)
		{
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Password Updated..</div>";
		}
		else
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Can not Update Password !!. Please Try Again.</div>";
		}
	}
	// ----------------------- Download Area ------------------- //
	public function download()
	{
		$data["title"] = "Download Area";

		$this->db->order_by("name","ASC");
		$data["server"] 		= $this->db->get("server")->result();

		$this->db->order_by("id_server","ASC");
		$this->db->order_by("port","ASC");
		$data["configuration"]	= $this->db->get("configuration")->result();
		$this->load->view("member/header",$data);
		$this->load->view("member/download",$data);
		$this->load->view("member/footer");
	}

	//--------------------Server INformation ---------------------------- //
	public function server()
	{
		$data['title'] = "Server Information";
		$this->db->order_by("name","asc");
		$data["server"] = $this->db->get("server")->result();

		$this->db->order_by("id_server","ASC");
		$data["configuration"] = $this->db->get("configuration")->result();
		$this->load->view("member/header",$data);
		$this->load->view('member/server',$data);
		$this->load->view("member/footer");
	}

	// --------------------- Transaction --------------------------------//
	public function transaction()
	{
		$data["title"] = "My Transaction";
		$id = $this->session->userdata["id_member"];
		$this->db->order_by("transaction_date","DESC");
		$data["transaction"] = $this->db->get_where("transaction",array("id_user" => $id))->result();

		$this->load->view("member/header",$data);
		$this->load->view("member/transaction",$data);
		$this->load->view("member/footer");
	}


	// ------------------ Account -------------------------- //

	public function account()
	{
		$id = $this->session->userdata["id_member"];		
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

		$this->load->view("member/header",$data);
		$this->load->view('member/account',$data);
		$this->load->view("member/footer");
	}

	public function account_create()
	{
		$data['title'] = "Create New Account";
		$id = $this->session->userdata["id_member"];
		$user = $this->db->get_where("user",array("id" => $id,"role" => "MEMBER"))->result();
		foreach($user as $u)
		{
			$data['trial_account'] = $u->credit_free;
		}
		
		$this->load->view("member/header",$data);
		$this->load->view('member/account_create',$data);
		$this->load->view("member/footer");
	}

	public function account_create_submit()
	{
		if(empty($this->session->userdata["member"]))
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
	
		// Ambil data dari server
		$id 			= $this->session->userdata["id_member"];
		$cek_credit 	= $this->db->get_where("user",array("id" => $id,"role" => "MEMBER"))->result();
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
			"expired_date" 	=> $expired_date,
			);
		$this->db->insert("account",$data);

		// Add Account to Sesion _account
		$server 	= $this->db->get("server")->result();
		foreach($server as $s)
		{
			$host 	= $s->host;
			$data 	= array(
				"username"		=> $username,
				"ip_address"	=> $host,
				"status"		=> 0
				);
			$this->db->insert("session_account",$data);
		}
		
		// Update Credit in User
		if($type_account == 'FREE')
		{
			$this->db->where("id",$id);
			$this->db->update("user",array("credit_free" => $credit));
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account $username Has Been Created.<br>Please wait 10 - 15 minutes until Account ready to Use.<br>Free Credit Now : $credit .</div>";
		}
		else
		{
			$this->db->where("id",$id);
			$this->db->update("user",array("credit_premium" => $credit));
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account $username Has Been Created.<br>Please wait 10 - 15 minutes until Account ready to Use.<br>Premium Credit Now : $credit .</div>";
		}
	}

	public function account_edit($id = null)
	{
		$id_user = $this->session->userdata["id_member"];
		$account = $this->db->get_where("account", array("id" => $id))->result();
		if(empty($account))
		{
			redirect("member/account");
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
		$this->load->view("member/header",$data);
		$this->load->view('member/account_edit',$data);
		$this->load->view("member/footer");
	}

	public function account_edit_submit($id = null)
	{
		if(empty($this->session->userdata["member"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("current_password","Current Password","trim|required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("new_password","New Password","trim|required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("new_password_confirm","New Password Confirm","trim|required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
		// Ambil Password Account form
		$current_password		= $this->input->post("current_password");
		$new_password 			= $this->input->post("new_password");
		$new_password_confirm  	= $this->input->post("new_password_confirm");
	
		$id_user = $this->session->userdata["id_member"];
		$account = $this->db->get_where("account", array("id" => $id))->result();
		if(empty($account))
		{
			redirect("member/account");
		}
		foreach($account as $row)
		{
			if($row->id_user != $id_user)
			{
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account Does Not Exist !!</div>";
				exit();
			}
			if($row->password != $current_password)
			{
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Invalid Password !!</div>";
				exit();
			}
			if($current_password == $new_password)
			{
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>New Password Cannot be same as Current Password !!</div>";
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
		$id_member = $this->session->userdata("id_member");
		$user_data = $this->db->get_where("user",array("id" => $id_member))->result();
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
			if($row->id_user != $id_member)
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
		// Change Expired Date Account Daeomon Table
		$this->db->where("id_account",$id);
		$this->db->update("account_daeomon",array("expired_date" => $add_expired_date,"modified" => "YES"));
		// Update Credit
		$credit = $credit - 1;
		$this->db->where("id",$id_member);
		$this->db->update("user",array("credit_premium" => $credit));
		echo "Success, Expired account $username : $add_expired_date";
	}
}