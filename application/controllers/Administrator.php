<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		/*
		if(empty($this->session->userdata["administrator"]))
		{
			redirect("login");
		}
		*/
	}
	public function index()
	{
		$data['title'] = "Admin Dashboard";
		$this->load->view("administrator/header",$data);
		$this->load->view('administrator/index');
		$this->load->view("administrator/footer");
	}
	public function account()
	{
		$data['title'] = "Accounts";
		$this->db->order_by("expired_date",'asc');
		$data["account"] = $this->db->get("account")->result();

		$this->db->order_by("name",'asc');
		$data["server"] = $this->db->get("server")->result();

		$data["user"] = $this->db->get("user")->result();
		$this->load->view("administrator/header",$data);
		$this->load->view('administrator/account',$data);
		$this->load->view("administrator/footer");
	}

	public function account_create()
	{
		$data['title'] = "Create Account";
		$this->db->order_by("name",'asc');
		$data['server'] = $this->db->get("server")->result();
		$this->load->view("administrator/header",$data);
		$this->load->view('administrator/account_create',$data);
		$this->load->view("administrator/footer");
	}

	public function account_edit($id = null)
	{
		$account = $this->db->get_where("account", array("id" => $id))->result();
		foreach($account as $row)
		{
			$data["id"] = $id;
			$data["username"] = $row->username;
			$data["password"] = $row->password;
			$data["expired_date"] = $row->expired_date;
			$data["id_server"] = $row->id_server;
			$data["title"] = "Edit Account $row->username";
		}
		$data["server"]	= $this->db->get("server")->result();

		$this->load->view("administrator/header",$data);
		$this->load->view('administrator/account_edit',$data);
		$this->load->view("administrator/footer");
	}

	public function account_edit_submit($id = null)
	{
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		// Account
		$username_form		= $this->input->post("username");
		$password_form		= $this->input->post("password");
		$expired_form		= $this->input->post("expired");
		$id_server_form		= $this->input->post("server");

		$account = $this->db->get_where("account", array("id" => $id))->result();
		foreach($account as $row)
		{
			$username 		= $row->username;
			$password 		= $row->password;
			$expired 		= $row->expired_date;
			$id_server 		= $row->id_server;
		}

		//Server Source
		$server_source = $this->db->get_where("server",array("id" => $id_server))->result();
		foreach($server_source as $row)
		{
			$host_source		= $row->host;
			$username_source	= $row->username;
			$password_source	= $row->password;
			$port_source		= $row->port;
		}
		
		$param = array(
			"host" 		=> $host_source,
			"username" 	=> $username_source,
			"password" 	=> $password_source,
			"port"		=> $port_source
			);
		$connection = $this->ssh->connect($param);
		$callback1 = $this->ssh->execute("userdel $username");
		
		// If same server
		if($id_server == $id_server_form)
		{
			$callback2 = $this->ssh->execute("echo $username:$password_form > /home/edit_account");
			$callback3 = $this->ssh->execute("useradd -M -s /bin/false -e $expired_form $username");
			$callback4 = $this->ssh->execute("cat /home/edit_account | chpasswd");

			$data = array (
				"password" => $password_form,
				"expired_date" => $expired_form
				);
			$this->db->where("id",$id);
			$this->db->update("account",$data);
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account $username has updated !!!</div>";
			exit();
		}

		//Server Destination
		$server_dest 	= $this->db->get_where("server",array("id" => $id_server_form))->result();
		foreach($server_dest as $row)
		{
			$host_dest		= $row->host;
			$username_dest	= $row->username;
			$password_dest	= $row->password;
			$port_dest		= $row->port;
		}
		
		$param = array(
			"host" 		=> $host_dest,
			"username" 	=> $username_dest,
			"password" 	=> $password_dest,
			"port"		=> $port_dest
			);
		$connection = $this->ssh->connect($param);
		if(!$connection)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Destination Server cannot connect !!!</div>";
			exit();
		}
		$callback2 = $this->ssh->execute("echo $username:$password_form > /home/edit_account");
		$callback3 = $this->ssh->execute("useradd -M -s /bin/false -e $expired_form $username");
		$callback4 = $this->ssh->execute("cat /home/edit_account | chpasswd");
		if($callback2 && $callback3 && $callback4)
		{
			$data = array (
				"password" => $password_form,
				"expired_date" => $expired_form,
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
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		// Server Destination untuk Pindah (Case 2)
		$server_dest = $this->db->get("server",array("id" => $this->input->post("server")))->result();
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
			$param = array(
				"hostname" => $host_source,
				"port" => $port_source,
				"username" => $user_login_source,
				"password" => $pass_login_source
			);
			$hasil = $this->ssh->connect($param);
			$callback = $this->ssh->execute("userdel $username");
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
					$callback2 = $this->ssh->execute("echo $username:$password > /home/ganti_server");
					$callback3 = $this->ssh->execute("useradd -M -s /bin/false -e $expired_account $username");
					$callback4 = $this->ssh->execute("cat /home/ganti_server | chpasswd");
					if($callback2 && $callback3 && $callback4)
					{
						$this->db->where("id",$account[$i]);
						$this->db->update("account",array("id_server" => $this->input->post("server")));
						echo "<div class='alert alert-success'>Account $username is moved...</div>";
					}
					else
						echo "<div class='alert alert-danger'>Account $username is NOT moved...</div>";
					break;

				default:
						echo "<div class='alert alert-success'>Check Your Submit Form...</div>";
					break;
			}
		}
	}

	public function account_create_submit()
	{
		if(empty($this->session->userdata["administrator"]))
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
			$username 		= $this->input->post("username");
			$password 		= $this->input->post("password");
			$id_server		= $this->input->post("server");
			$created_date 	= date("Y-m-d");
			$expired_date 	= date("Y-m-d",strtotime("+31 day"));
			$id_user	 	= $this->session->userdata("id_administrator");

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
			}
			$param = array(
				"hostname" => $host,
				"port" => $port,
				"username" => $user_login,
				"password" => $pass_login
			);
			$hasil = $this->ssh->connect($param);
			if(!$hasil) exit("Cannot connect selected server!!!");
			$callback = $this->ssh->execute("echo $username:$password > /home/data");
			$callback1 = $this->ssh->execute("useradd -M -s /bin/false -e $expired_date $username");
			$callback2 = $this->ssh->execute("cat /home/data | chpasswd");
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
				echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account $username has created....</div>";
			}
		}
	}
	
	/*======================== Server =========================== */
	public function server()
	{
		$data['title'] = "Server";
		$this->db->order_by("area","ASC");
		$this->db->order_by("name","ASC");
		$data["server"] = $this->db->get("server")->result();
		$this->load->view("administrator/header",$data);
		$this->load->view('administrator/server',$data);
		$this->load->view("administrator/footer");
	}

	public function server_create()
	{
		$data['title'] = "Create Server";
		$this->load->view("administrator/header",$data);
		$this->load->view('administrator/server_create');
		$this->load->view("administrator/footer");
	}

	public function server_create_submit()
	{
		/*
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		*/
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("name","Name","trim|required|alpha_numeric|xss_clean");
		$this->form_validation->set_rules("host","Host","trim|required|xss_clean");
		$this->form_validation->set_rules("user_login","User Login","trim|required|xss_clean");
		$this->form_validation->set_rules("password_login","Password Login","trim|required|xss_clean");
		$this->form_validation->set_rules("port","Port Login","trim|required|greater_than[-1]|xss_clean");
		$this->form_validation->set_rules("certificate","Certificate","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
		
		$name 			= $this->input->post("name");
		$host 			= $this->input->post("host");
		$username 		= $this->input->post("user_login");
		$password 		= $this->input->post("password_login");
		$port 			= $this->input->post("port");
		$area 	 		= $this->input->post("area");
		$certificate 	= $this->input->post("certificate");
		$data = array(
			"name" 				=> $name,
			"host" 				=> $host,
			"user_login" 		=> $username,
 			"password_login" 	=> $password,
			"port_login"		=> $port,
			"area" 				=> $area,
			"certificate"		=> $certificate,
			"status"			=> "UP",
			"update_status"		=> date("Y-m-d H:i:s")
			);
		$this->db->insert("server",$data);
		echo "
			<div class='alert alert-success alert-dismisabble'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<p>Server has been Created....</p>
			</div>";
	}

	public function server_edit($id = null)
	{
		if(!$id)
			redirect("administrator/server");
		$server = $this->db->get_where("server",array("id"=>$id))->result();
		if(empty($server))
		{
			redirect("administrator/server");
		}
		foreach($server as $choose)
		{
			$data["id"] 				= $id;
			$data["name"] 				= $choose->name;
			$data["host"] 				= $choose->host;
			$data["user_login"]			= $choose->user_login;
			$data["password_login"]		= $choose->password_login;
			$data["port_login"]			= $choose->port_login;
			$data["certificate"]		= $choose->certificate;
			$data["area"]				= $choose->area;

			$data['title'] = "Edit Server $choose->name";
			$this->load->view("administrator/header",$data);
			$this->load->view("administrator/server_edit",$data);
			$this->load->view("administrator/footer");
		}
	}

	public function server_edit_submit($id = null)
	{
		/*
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		*/
		if(!$id)
		{
			redirect("administrator/server");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("name","Server Name","required|alpha_numeric|xss_clean");
		$this->form_validation->set_rules("host","Host","required|xss_clean");
		$this->form_validation->set_rules("user_login","User Login","required|xss_clean");
		$this->form_validation->set_rules("password_login","Password Login","required|xss_clean");
		$this->form_validation->set_rules("port","Port Login","required|greater_than[-1]|xss_clean");
		$this->form_validation->set_rules("certificate","Certificate","required|xss_clean");
		
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
		}
		else
		{
			$name 			= $this->input->post("name");
			$host 			= $this->input->post("host");
			$username 		= $this->input->post("user_login");
			$password 		= $this->input->post("password_login");
			$port 			= $this->input->post("port");
			$location 		= $this->input->post("area");
			$certificate 	= $this->input->post("certificate");			

			$data = array(
				"name" 				=> $name,
				"host" 				=> $host,
				"user_login" 		=> $username,
 				"password_login" 	=> $password,
				"port_login"		=> $port,
				"area" 				=> $location,
				"certificate"		=> $certificate
				
				);
			$this->db->where("id",$id);
			$this->db->update("server",$data);
			echo "
				<div class='alert alert-success alert-dismisabble'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<p>Server has been Updated....</p>
				</div>";
		}
	}

	public function server_multi_action()
	{
		/*
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		*/
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$action = $this->input->post("multi_action");
		$server 	= $this->input->post("msg");
		$sum = count($server);
		for($i = 0; $i < $sum; $i++)
		{
			$server_data = $this->db->get_where("server",array("id" => $server[$i]))->result();
			foreach($server_data as $choose)
			{
				$name = $choose->name;
			}
			$result 	= $this->db->delete("server",array("id" => $server[$i]));
			$result2 	= $this->db->delete("configuration",array("id_server" => $server[$i]));
			if($result && $result2)
				echo "<div class='alert alert-success'>Server $name has Deleted...</div>";
			else
				echo "<div class='alert alert-warning'>Server $name Can not be Deleted !!</div>";
		}
	}
	// ---------------------- MANAGE CONIFG ========================= //
	public function manage_config($id = null)
	{
		$server = $this->db->get_where("server",array("id"=> $id))->result();
		foreach($server as $server_choose)
		{
			$data["name"] = $server_choose->name;
			$name = $server_choose->name;
		}
		$data["id"] 	= $id;
		$data["title"] 	= "Port Configuration Server $name";	
		$data["config"] = $this->db->get_where("configuration",array("id_server"=>$id))->result();
		$this->load->view("administrator/header",$data);
		$this->load->view("administrator/manage_config",$data);
		$this->load->view("administrator/footer");
	}

	public function manage_config_submit($id = null)
	{
		/*
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		*/
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }	
		if(!$id)
			exit('Invalid Server !!!!.');

		$this->form_validation->set_rules("port","Port","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
	
		// Entry Port Config to Server
		$port = $this->input->post("port");
		$type = $this->input->post("config");
		$data = array(
			"id_server" => $id,
			"port" 		=> $port,
			"type"		=> $type
			);
		$result = $this->db->insert("configuration",$data);
		if($result)
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Success...</div>";
		else
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed..Please Try Again..</div>";
	}

	public function config_multi_action()
	{
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$config 	= $this->input->post("msg");
		$sum = count($config);
		for($i = 0; $i < $sum; $i++)
		{
			$config_data = $this->db->get_where("configuration",array("id" => $config[$i]))->result();
			foreach($config_data as $choose)
			{
				$name = $choose->filename;
			}
			$result = $this->db->delete("configuration",array("id" => $config[$i]));
			if($result)
			{
				echo "$name has deleted....";
			}
			else
				echo "$name has NOT deleted....";
		}
	}

	/*======================== USER ============================== */
	public function user()
	{
		$data['title'] = "Users";
		$user = $this->db->get("user")->result();
		foreach($user as $choose_user)
		{
			$now = date("Y-m-d");
			if($choose_user->expired_user < $now)
			{
				$this->db->where("id",$choose_user->id);
				$this->db->update("user",array("flag" => 0));
			}
		}

		$data['user'] = $this->db->get("user")->result();
		$this->load->view("administrator/header",$data);
		$this->load->view('administrator/user',$data);
		$this->load->view("administrator/footer");
	}

	public function user_create()
	{
		$data['title'] = "Create User";
		$this->load->view("administrator/header",$data);
		$this->load->view('administrator/user_create');
		$this->load->view("administrator/footer");
	}

	public function user_edit($id = null)
	{
		if(!$id)
			redirect("administrator/user");
		$user = $this->db->get_where("user",array("id"=>$id))->result();
		foreach($user as $choose_user)
		{
			$data["id"] = $id;
			$data["username"] = $choose_user->name;
			$data["password"] = $choose_user->password;
			$data["credit"] = $choose_user->credit;
			$data["role"] = $choose_user->role;
			$data["flag"] = $choose_user->flag;
			$data["facebook"] = $choose_user->facebook_account;
			$data["account"] = $choose_user->account_created;
			$data["hp"] = $choose_user->no_telepon;
			$data["expired"] = $choose_user->expired_user;

			$data['title'] = "Edit User $choose_user->name";
			$this->load->view("administrator/header",$data);
			$this->load->view("administrator/user_edit",$data);
			$this->load->view("administrator/footer");
		}
	}

	public function user_edit_submit($id = null)
	{
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		if(!$id)
			exit('Invalid User !!!!...');

		$this->form_validation->set_rules("username","Username","required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("password","Password","required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("credit","Credit","required|greater_than[-1]");
		$this->form_validation->set_rules("hp","No. Telepon","max_length[20]|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
		}
		else
		{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$credit = $this->input->post("credit");
			$role = $this->input->post("role_user");
			$facebook = $this->input->post("facebook");
			$hp = $this->input->post("telp");
			$expired = $this->input->post("expired");
			$flag = $this->input->post("status");

			$data = array(
				"name" => $username,
				"password" => $password,
				"credit" => $credit,
				"role" => $role,
				"expired_user" => $expired,
				"flag" => $flag,					//Flag Value : 1 = activated, 0 = lock, 2 = not activated
				"facebook_account" => $facebook,
				"no_telepon" => $hp
				);
			$data_user = $this->db->get("user")->result();
			$this->db->where("id",$id);
			$this->db->update("user",$data);
			echo "
				<div class='alert alert-success alert-dismisabble'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<p>user $username has been updated....</p>
				</div>";
		}
	}

	public function user_view($id = null)
	{
		if($id == null)
		{
			redirect("administrator/user");
		}
		$user = $this->db->get_where("user",array("id" => $id))->result();
		foreach($user as $choose_user)
		{
			$data["username"] = $choose_user->name;
			$data["password"] = $choose_user->password;
			$data["credit"] = $choose_user->credit;
			$data["role"] = $choose_user->role;
			$data["flag"] = $choose_user->flag;
			$data["facebook"] = $choose_user->facebook_account;
			$data["account"] = $choose_user->account_created;
			$data["hp"] = $choose_user->no_telepon;
			$data["expired"] = $choose_user->expired_user;

			$data['title'] = "View User $choose_user->name";

			$now = date("Y-m-d");
			if($choose_user->expired_user < $now)
			{
				$this->db->where("id",$choose_user->id);
				$this->db->update("user",array("flag" => 0));
				$data["flag"] = 0;
			}
		}
		$this->load->view("administrator/header",$data);
		$this->load->view("administrator/user_view",$data);
		$this->load->view("administrator/footer");
	}

	public function user_create_submit()
	{
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		//Check Input From Ajax or Not
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("username","Username","required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("password","Password","required|alpha_numeric|min_length[5]|max_length[20]|xss_clean");
		$this->form_validation->set_rules("credit","Credit","required|greater_than[-1]");
		$this->form_validation->set_rules("hp","No. Telepon","max_length[20]|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
		}
		else
		{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$credit = $this->input->post("credit");
			$role = $this->input->post("role_user");
			$facebook = $this->input->post("facebook");
			$hp = $this->input->post("telp");
			$expired = date("Y-m-d",strtotime("+90 day"));

			$data = array(
				"name" => $username,
				"password" => $password,
				"credit" => $credit,
				"role" => $role,
				"expired_user" => $expired,
				"flag" => 1,					//Flag Value : 1 = activated, 0 = lock, 2 = not activated
				"account_created" => 0,
				"facebook_account" => $facebook,
				"no_telepon" => $hp
				);
			$data_user = $this->db->get("user")->result();
			foreach($data_user as $name_user)
			{
				if($name_user->name == $username)
				{
					exit("<div class='alert alert-danger alert-dismisabble'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>ERROR !!. Please try other Username.</div>");
				}
			}

			$server = $this->db->get("server")->result();
			if($role == 2)
			{
				foreach($server as $list)
				{
					$param = array(
						"hostname" => $host,
						"port" => $port,
						"username" => $user_login,
						"password" => $pass_login
					);
					$hasil = $this->ssh->connect($param);
					if(!$hasil){
						echo "<div>Cannot create user in $host.</div>";
						continue;
					}
					$callback = $this->ssh->execute("echo $username:$password > /home/$username");
					$callback1 = $this->ssh->execute("useradd -M -s /bin/false $username");
					$callback2 = $this->ssh->execute("cat /home/$username | chpasswd");
				}
			}

			$this->db->insert("user",$data);
			echo "
				<div class='alert alert-success alert-dismisabble'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='row'>
						<div class='col-lg-3'>Username</div>
						<div class='col-lg-4'>: $username</div>
					</div>
					<div class='row'>
						<div class='col-lg-3'>Password</div>
						<div class='col-lg-4'>: $password</div>
					</div>
					<div class='row'>
						<div class='col-lg-3'>Credit</div>
						<div class='col-lg-4'>: $credit</div>
					</div>
					<div class='row'>
						<div class='col-lg-3'>Role User</div>
						<div class='col-lg-4'>: $role</div>
					</div>
					<div class='row'>
						<div class='col-lg-3'>Expired</div>
						<div class='col-lg-4'>: $expired</div>
					</div>
					<div class='row'>
						<div class='col-lg-3'>Status</div>
						<div class='col-lg-2'>: Activated</div>
					</div>
					<div class='row'>
						<div class='col-lg-3'>Facebook</div>
						<div class='col-lg-4'>: $facebook</div>
					</div>
					<div class='row'>
						<div class='col-lg-3'>No. Telepon</div>
						<div class='col-lg-4'>: $hp</div>
					</div>
				</div>";
		}
	}

	public function user_multi_action()
	{
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$action = $this->input->post("multi_action");
		$user 	= $this->input->post("msg");
		$sum = count($user);
		for($i = 0; $i < $sum; $i++)
		{
			$user_data = $this->db->get_where("user",array("id" => $user[$i]))->result();
			foreach($user_data as $choose_user)
			{
				$name = $choose_user->name;
				$flag = $choose_user->flag;			//Flag Value : 1 = activated, 0 = lock, 2 = not activated
				$expired = $choose_user->expired_user;	
				$credit = $choose_user->credit;
			}
			switch ($action) {
				// Case 1 : Delete Users
				case '1':
					$result = $this->db->delete("user",array("id" => $user[$i]));
					if($result)
						echo "<div class='alert alert-success'>User $name Deleted...</div>";
					else
						echo "<div class='alert alert-warning'>User $name is not Deleted !!</div>";
					break;
				// Case 2 : Active User (Flag 1)
				case '2':
					$now = date("Y-m-d");
					if($expired < $now)
						$expired = $now;
					$expired_date = date("Y-m-d", strtotime($expired. "+90 day"));
					$this->db->where("id",$user[$i]);
					$result = $this->db->update("user",array("expired_user" => $expired, "flag" => 1));
					if($result)
						echo "<div class='alert alert-success'>User $name Activated...</div>";
					else
						echo "<div class='alert alert-warning'>User $name is not Changed !!</div>";
					break;
				// Case 3 : Lock User (Flag 0)
				case '3':
					$this->db->where("id",$user[$i]);
					$result = $this->db->update("user",array("flag" => 0));
					if($result)
						echo "<div class='alert alert-success'>User $name has been Locked...</div>";
					else
						echo "<div class='alert alert-warning'>User $name is not Changed !!</div>";
					break;
				// Case 4 : Not Activated User (Flag 2)
				case '4':
					$this->db->where("id",$user[$i]);
					$result = $this->db->update("user",array("flag" => 2));
					if($result)
						echo "<div class='alert alert-success'>User $name Not Active...</div>";
					else
						echo "<div class='alert alert-warning'>User $name is not Changed !!</div>";
					break;
				default:
						echo "<div class='alert alert-success'>Check Your Submit Form...</div>";
					break;
			}
		}
	}
}
