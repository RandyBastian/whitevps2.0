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

	public function account()
	{
		if(empty($this->session->userdata["member"]))
		{
			redirect("login");
		}

		$id = $this->session->userdata["id_member"];		

		$this->db->where("id_user",$id);
		$this->db->order_by("expired_date",'asc');
		$data["account"] = $this->db->get("account")->result();

		//var_dump($data["account"]);
		$this->db->order_by("name",'asc');
		$data["server"] = $this->db->get("server")->result();

		// View Credit
		$cek_user = $this->db->get_where("user",array("id" => $id))->result();
		foreach($cek_user as $row)
		{
			$credit = $row->credit;
		}

		$data['title'] = "Accounts | Credit : $credit";

		$this->load->view("member/header",$data);
		$this->load->view('member/account',$data);
		$this->load->view("member/footer");
	}

	public function account_create()
	{
		if(empty($this->session->userdata["member"]))
		{
			redirect("login");
		}
		$data['title'] = "Create Account";
		$this->db->order_by("name",'asc');
		$data['server'] = $this->db->get("server")->result();
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
		$this->form_validation->set_rules("username","Username","required|alpha_numeric|min_length[5]|xss_clean");
		$this->form_validation->set_rules("password","Password","required|alpha_numeric|min_length[5]|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
		}
		else
		{
			// Check Credit user
			$id = $this->session->userdata["id_member"];
			$cek_credit = $this->db->get_where("user",array("id" => $id))->result();
			foreach($cek_credit as $row)
			{
				if($row->credit < 1)
				{
					echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed !!. Check your credit.</div>";
					exit();
				}
				$user_credit = $row->credit;
			}

			$username 		= $this->input->post("username");
			$password 		= $this->input->post("password");
			$id_server		= $this->input->post("server");
			$created_date 	= date("Y-m-d");
			$expired_date 	= date("Y-m-d",strtotime("+31 day"));
			$id_user	 	= $this->session->userdata("id_member");

			if($id_server == "-1")
				exit("INVALID SERVER...");
			// Cek username exist in database
			$account = $this->db->get("account")->result();
			foreach($account as $list)
			{

				if($list->username == $username)
				{
					echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Username Exist. Try other username !!!</div>";
					exit();
				}
			}

			$list_server = $this->db->get_where("server",array("id" => $id_server))->result();
			foreach($list_server as $list)
			{
				$user_login 		= $list->username;
				$pass_login 		= $list->password;
				$host 				= $list->host;
				$account_created 	= $list->account_created;
				$port 				= $list->port;
				$server_cost		= $list->cost;
			}
			$param = array(
				"hostname" => $host,
				"port" => $port,
				"username" => $user_login,
				"password" => $pass_login
			);
			$hasil = $this->ssh->connect($param);
			if(!$hasil) exit("Cannot connect selected server!!!");
			$callback = $this->ssh->execute("echo $username:$password > /home/$username");
			$callback1 = $this->ssh->execute("useradd -M -s /bin/false -e $expired_date $username");
			$callback2 = $this->ssh->execute("cat /home/$username | chpasswd");
			if($callback && $callback1 && $callback2)
			{
				$data = array (
					"id_user" => $id_user,
					"username" => $username,
					"password" => $password,
					"created_date" => $created_date,
					"expired_date" => $expired_date,
					"id_server" => $id_server,
					);
				$this->db->insert("account",$data);
				//Update account created di server
				$this->db->where("id",$id_server);
				$this->db->update("server",array("account_created" => $account_created + 1));
				// Update Credit in User
				$new_user_credit = $user_credit  - $server_cost;
				$this->db->where("id",$id);
				$this->db->update("user",array("credit" => $new_user_credit));
				echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account $username has created.<br>Your Credit Now : $new_user_credit .</div>";
			}
		}
	}

	public function account_edit($id = null)
	{
		if(empty($this->session->userdata["member"]))
		{
			redirect("login");
		}
		$id_user = $this->session->userdata["id_member"];
		$account = $this->db->get_where("account", array("id" => $id))->result();
		foreach($account as $row)
		{
			$data["id"] = $id;
			$data["username"] = $row->username;
			$data["password"] = $row->password;
			$data["expired_date"] = $row->expired_date;
			$data["id_server"] = $row->id_server;
			$data["title"] = "Edit Account $row->username";
			if($row->id_user != $id_user)
			{
				echo "This is not Your Account... :)";
				exit();
			}
		}
		$data["server"]	= $this->db->get("server")->result();

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
		// Account
		$username_form		= $this->input->post("username");
		$password_form		= $this->input->post("password");
		$id_server_form		= $this->input->post("server");

		$id_user = $this->session->userdata["id_member"];
		$account = $this->db->get_where("account", array("id" => $id))->result();
		foreach($account as $row)
		{
			$username 		= $row->username;
			$password 		= $row->password;
			$expired 		= $row->expired_date;
			$id_server 		= $row->id_server;
			if($row->id_user != $id_user)
			{
				echo "This is not Your Account... :)";
				exit();
			}
		}
		
		//Server Source
		$list_server = $this->db->get_where("server",array("id" => $id_server))->result();
		foreach($list_server as $list)
		{
			$host				= $list->host;
			$user_login			= $list->username;
			$pass_login			= $list->password;
			$port_source		= $list->port;
			$account_created 	= $list->account_created;
			$account_expired 	= $list->expired_account;
			$date_now			= $list->date_now;
			$max_day			= $list->max_day;
			$available			= $list->available_account;
		}

		$param = array(
			"hostname" => $host,
			"port" => $port_source,
			"username" => $user_login,
			"password" => $pass_login
		);

		$hasil = $this->ssh->connect($param);
		if(!$hasil)
		{	
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Source Server cannot connect !!!</div>";
		}
		else
			$callback1 = $this->ssh->execute("userdel $username");
		
		// If same server
		if($id_server == $id_server_form)
		{
			$callback2 = $this->ssh->execute("echo $username:$password_form > /home/edit_account");
			$callback3 = $this->ssh->execute("useradd -M -s /bin/false -e $expired $username");
			$callback4 = $this->ssh->execute("cat /home/edit_account | chpasswd");
			
			$data = array (
				"password" => $password_form
				);
			$this->db->where("id",$id);
			$this->db->update("account",$data);
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account $username has updated !!!</div>";
			exit();
		}
		
		//Server Destination
		$list_server = $this->db->get_where("server",array("id" => $id_server_form))->result();
		foreach($list_server as $list)
		{
			$host				= $list->host;
			$user_login			= $list->username;
			$pass_login			= $list->password;
			$port				= $list->port;
			$account_created 	= $list->account_created;
			$account_expired 	= $list->expired_account;
			$date_now			= $list->date_now;
			$max_day			= $list->max_day;
			$available			= $list->available_account;
		}

		if(!$host)
		{
			exit("Invalid server");
		}

		$param = array(
			"hostname" => $host,
			"port" => $port,
			"username" => $user_login,
			"password" => $pass_login
		);

		$hasil = $this->ssh->connect($param);
		if(!$hasil)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Destination Server cannot connect !!!</div>";
			exit();
		}
		$callback2 = $this->ssh->execute("echo $username:$password_form > /home/edit_account");
		$callback3 = $this->ssh->execute("useradd -M -s /bin/false -e $expired $username");
		$callback4 = $this->ssh->execute("cat /home/edit_account | chpasswd");
		if($callback2 && $callback3 && $callback4)
		{
			$data = array (
				"password" => $password_form,
				"id_server" => $id_server_form
				);
			$this->db->where("id",$id);
			$this->db->update("account",$data);
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account has moved !!!</div>";
		}
		else
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Destination Server cannot connect !!!</div>";
	}

	public function account_multi_action()
	{
		if(empty($this->session->userdata["member"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }

		// Server Destination untuk Pindah (Case 2)
		$server_dest = $this->db->get_where("server",array("id" => $this->input->post("server")))->result();
		foreach($server_dest as $list)
		{	
			$user_login_dest 		= $list->username;
			$pass_login_dest 		= $list->password;
			$host_dest 				= $list->host;
			$port_dest 				= $list->port;
		}
		//-------------------------//
		$action 	= $this->input->post("multi_action");
		$account 	= $this->input->post("msg");
		$sum 		= count($account);
		for($i = 0; $i < $sum; $i++)
		{
			$list_account = $this->db->get_where("account",array("id" => $account[$i]))->result();
			if(!$list_account)
			{
				echo "Account is not exist...";
				continue;
			}
			// Check Account in Database
			foreach($list_account as $choose)
			{
				$username 			= $choose->username;
				$password 			= $choose->password;
				$expired_account 	= $choose->expired_date;
				$id_server 			= $choose->id_server;
				if($choose->id_user != $this->session->userdata["id_member"])
				{
					echo "$username is not your Account.";
					continue;
				}
			}
			// Server Source
			$list_server = $this->db->get_where("server",array("id" => $id_server))->result();
			foreach($list_server as $list)
			{
				$user_login_source 		= $list->username;
				$pass_login_source 		= $list->password;
				$host_source 			= $list->host;
				$port_source 			= $list->port;
				$name_source			= $list->name;
			}
			if(!$host_source)
			{
				echo "Invalid Server";
				continue;
			}
			$param = array(
				"hostname" => $host_source,
				"port" => $port_source,
				"username" => $user_login_source,
				"password" => $pass_login_source
			);
			$hasil = $this->ssh->connect($param);
			if($hasil)
			{
				$callback = $this->ssh->execute("userdel $username");
			}

			switch ($action) {
				// Case 1 : Delete Account
				case '1':
					$result = $this->db->delete("account",array("id" => $account[$i]));
					if($result)
						echo "<div class='alert alert-success'>Account $username has Deleted...</div>";
					else
						echo "<div class='alert alert-warning'>Account $username is not Deleted !!</div>";
					break;
				// Case 2 : Move Account
				case '2':
					
					$param = array(
						"hostname" => $host_dest,
						"port" => $port_dest,
						"username" => $user_login_dest,
						"password" => $pass_login_dest
					);

					$hasil = $this->ssh->connect($param);
					if(!$hasil)
					{
						echo "<div class='alert alert-danger'>Account $username is NOT moved !!</div>";
						exit();
					}
					$callback2 = $this->ssh->execute("echo $username:$password > /home/$username");
					$callback3 = $this->ssh->execute("useradd -M -s /bin/false -e $expired_account $username");
					$callback4 = $this->ssh->execute("cat /home/$username | chpasswd");
					if($callback2 && $callback3 && $callback4)
					{
						$this->db->where("id",$account[$i]);
						$this->db->update("account",array("id_server" => $this->input->post("server")));
					}
					echo "<div class='alert alert-success'>Account $username is moved...</div>";
					break;

				default:
						echo "<div class='alert alert-success'>Check Your Submit Form...</div>";
					break;
			}
		}
	}

	//-----//Server INformation
	public function server()
	{
		if(empty($this->session->userdata["member"]))
		{
			redirect("login");
		}
		$data['title'] = "Server";
		$this->db->order_by("location","asc");
		$data["server"] = $this->db->get("server")->result();
		$data["account"] = $this->db->get("account")->result();
		$this->load->view("member/header",$data);
		$this->load->view('member/server',$data);
		$this->load->view("member/footer");
	}

	public function top_up($id = null)
	{
		$data['title'] = "Reseller Area";
		if(empty($this->session->userdata["member"]))
		{
			redirect("login");
		}
		$get_akun = $this->db->get_where("account",array("id" => $id))->result();
		$id_member = $this->session->userdata("id_member");
		$user_data = $this->db->get_where("user",array("id" => $id_member))->result();
		foreach($user_data as $coloum)
		{
			if($coloum->credit < 1)
			{
				echo "Check Your Credit Please... :) ";
				exit();
			}
		}

		foreach($get_akun as $row)
		{
			if($row->id_user != $id_member)
				exit("This is not Your Account");
			
			$expired_date 	= $row->expired_date;
			$username 		= $row->username;
			$password 		= $row->password;

		}
		$cek_server = $this->db->get_where("server", array("id" => $row->id_server))->result();
		foreach($cek_server as $rows)
		{
			$host = $rows->host;
			$pass = $rows->password;
			$user = $rows->username;
			$port = $rows->port;			
		}
		$now = date("Y-m-d");
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
		
		$add_expired_date = date("Y-m-d", strtotime($next_expired. "+31 day"));
		//echo "$add_expired_date ";
		$param = array(
			"hostname" => "$host",
			"port" => $port,
			"username" => $username,
			"password" => $password
		);
		$hasil = $this->ssh->connect($param);
		if(!$hasil) exit("Cannot Conenct Server. Please check your connection or contact admin..");
		$callback = $this->ssh->execute("userdel $username");
		$callback1 = $this->ssh->execute("useradd -M -s /bin/false -e $add_expired_date $username");
		$callback2 = $this->ssh->execute("echo $username:$password > /home/$username");
		$callback3 = $this->ssh->execute("cat /home/$username | chpasswd");
		if($callback && $callback1 && $callback2 && $callback3)
		{
			$this->db->where("id",$id);
			$this->db->update("account",array("expired_date" => $add_expired_date));
			$user_data = $this->db->get_where("user",array("id" => $id_member))->result();
			foreach($user_data as $coloum)
			{
				$credit_ku = $coloum->credit - 1;
				$this->db->where("id",$coloum->id);
				$this->db->update("user",array("credit" => $credit_ku));
			}
			echo "Success, Expired account $username : $add_expired_date";
		}
	}
}