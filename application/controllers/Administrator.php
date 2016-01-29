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
		$this->db->order_by("expired_date","ASC");
		$this->db->order_by("username","ASC");
		$data["account"] = $this->db->get("account")->result();

		$data["user"] = $this->db->get("user")->result();
		$this->load->view("administrator/header",$data);
		$this->load->view('administrator/account',$data);
		$this->load->view("administrator/footer");
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
	// ---------------------- ANNOUNCEMENT -------------------------- //
	public function announcement()
	{
		$data["title"] = "Announcement";
		$this->db->order_by("date","DES");
		$data["announcement"] = $this->db->get("announcement")->result();
		$this->load->view("administrator/header",$data);
		$this->load->view("administrator/announcement",$data);
		$this->load->view("administrator/footer");
	}

	public function announcement_create()
	{
		$data["title"] = "Create Announcement";
		$this->load->view("administrator/header",$data);
		$this->load->view("administrator/announcement_create",$data);
		$this->load->view("administrator/footer");
	}

	public function announcement_create_submit()
	{
		/*
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		*/
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }	

		$this->form_validation->set_rules("title","Title","trim|required|xss_clean");
		$this->form_validation->set_rules("tag","Tag","trim|required|xss_clean");
		$this->form_validation->set_rules("source","Source","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
	
		$title 	= $this->input->post("title");
		$tag 	= $this->input->post("tag");
		$source = $this->input->post("source");

		$data = array(
			"title" 	=> $title,
			"tag" 		=> $tag,
			"source"	=> $source
			);
		$result = $this->db->insert("announcement",$data);
		if($result)
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Success...</div>";
		else
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed..Please Try Again..</div>";
	}

	public function announcement_edit($id = null)
	{
		if(!$id)
		{
			redirect("administrator/announcement");
		}
		$data["title"] = "Edit Announcement";
		$choose = $this->db->get_where("announcement",array("id" => $id))->result();
		foreach($choose as $c)
		{
			$data["id"]		= $c->id;
			$data["title"]	= $c->title;
			$data["tag"]	= $c->tag;
			$data["source"] = $c->source;
 		}
 		$this->load->view("administrator/header",$data);
 		$this->load->view("administrator/announcement_edit",$data);
 		$this->load->view("administrator/footer");
	}

	public function announcement_edit_submit($id = null)
	{
		if(!$id)
		{
			redirect("administrator/announcement");
		}

		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }	

		$this->form_validation->set_rules("title","Title","trim|required|xss_clean");
		$this->form_validation->set_rules("tag","Tag","trim|required|xss_clean");
		$this->form_validation->set_rules("source","Source","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
	
		$title 	= $this->input->post("title");
		$tag 	= $this->input->post("tag");
		$source = $this->input->post("source");

		$data = array(
			"title" 	=> $title,
			"tag" 		=> $tag,
			"source"	=> $source
			);
		$this->db->where("id",$id);
		$result = $this->db->update("announcement",$data);
		if($result)
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Success...</div>";
		else
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed..Please Try Again..</div>";
	}

	public function announcement_multi_action()
	{
		/*
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		*/
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$config 	= $this->input->post("msg");
		$sum = count($config);
		for($i = 0; $i < $sum; $i++)
		{
			$result = $this->db->delete("announcement",array("id" => $config[$i]));
		}
		echo "Selected Announcements are Deleted.";
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
		/*
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		*/
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$config 	= $this->input->post("msg");
		$sum = count($config);
		for($i = 0; $i < $sum; $i++)
		{
			$result = $this->db->delete("configuration",array("id" => $config[$i]));
		}
		echo "Selected Port Configuration Has Been Deleted.";
	}

	// ------------------------- Transaction ----------------------//
	public function transaction()
	{
		$data["title"] = "Transaction List";
		$this->db->order_by("transaction_date","ASC");
		$data["transaction"] = $this->db->get("transaction")->result();
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
