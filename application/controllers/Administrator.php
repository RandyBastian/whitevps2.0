<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata["administrator"]))
		{
			redirect("login");
		}
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
		
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("name","Name","trim|required|xss_clean");
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

		$user 	= $this->db->get("account")->result();
		foreach($user as $u)
		{
			$data = array (
				"username" 		=> $u->username,
				"ip_address"	=> $host,
				"status"		=> 0
				);

			$this->db->insert("session_account",$data);
		}

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
		
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		
		if(!$id)
		{
			redirect("administrator/server");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("name","Server Name","required|xss_clean");
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

			$server 	= $this->db->get_where("server",array("id" => $id))->result();
			foreach($server as $s)
			{
				if($s->host != $host)
				{
					$this->db->where("ip_address",$s->host);
					$this->db->update("session_account",array("ip_address" => $host));
				}
			}

			echo "
				<div class='alert alert-success alert-dismisabble'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<p>Server has been Updated....</p>
				</div>";
		}
	}

	public function server_multi_action()
	{
		
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		
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
				$host = $choose->host;
			}
			$result 	= $this->db->delete("server",array("id" => $server[$i]));
			$result2 	= $this->db->delete("configuration",array("id_server" => $server[$i]));

			$this->db->delete("session_account", array("ip_address" => $host));

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
		
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
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
		
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		
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
		
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		
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
			$result = $this->db->delete("configuration",array("id" => $config[$i]));
		}
		echo "Selected Port Configuration Has Been Deleted.";
	}

	// ------------------------- Transaction ----------------------//
	public function transaction()
	{
		$data["title"] = "Transaction List";
		$this->db->order_by("transaction_date","DESC");
		$data["transaction"] = $this->db->get_where("transaction",array("flag" => "1"))->result();
		$this->load->view("administrator/header",$data);
		$this->load->view("administrator/transaction",$data);
		$this->load->view("administrator/footer");
	}

	public function transaction_edit($id = null)
	{
		if(!$id)
		{
			redirect("administrator/transaction");
		}

		$transaksi = $this->db->get_where("transaction",array("id" => $id))->result();
		if(empty($transaksi))
		{
			//redirect("administrator/transaction");
			echo "Transaksi Tidak ditemukan";
			exit();
		}
		
		foreach($transaksi as $t)
		{
			$name 		= $t->name;
			$id_user 	= $t->id_user;
			if($t->status == "PAID")
			{
				echo "Transaksi sudah dibayar";
				exit();
			} 
		}

		$product = $this->db->get_where("product",array("name" => $name))->result();
		if(empty($product))
		{
			//redirect("administrator/transaction");
			echo "Produk Tidak ditemukan";
			exit();
		}
		foreach($product as $p)
		{
			$value = $p->value;
		}

		$user = $this->db->get_where("user",array("id" => $id_user))->result();
		if(empty($user))
		{
			//redirect("administrator/transaction");
			echo "User Tidak ditemukan";
			exit();
		}
		foreach($user as $u)
		{
			$credit_premium = $u->credit_premium + $value;
		}
		$this->db->where("id",$id_user);
		$this->db->update("user",array("credit_premium" => $credit_premium));

		$this->db->where("id",$id);
		$this->db->update("transaction",array("status" => "PAID","payment_date" => date("Y-m-d H:i:s")));
		redirect("administrator/transaction");
	}
	
	// ------------------------- Produk ---------------------------//
	public function product()
	{
		$data["title"] = "Products";
		$data["product"] = $this->db->get("product")->result();
		$this->load->view("administrator/header",$data);
		$this->load->view("administrator/product",$data);
		$this->load->view("administrator/footer",$data);
	}

	public function product_create()
	{
		$data["title"] = "Create New Product";
		$this->load->view("administrator/header",$data);
		$this->load->view("administrator/product_create",$data);
		$this->load->view("administrator/footer",$data);
	}

	public function product_create_submit()
	{
		
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }	

		$this->form_validation->set_rules("name","Name","trim|required|xss_clean");
		$this->form_validation->set_rules("price_idr","Price IDR","trim|required|xss_clean");
		$this->form_validation->set_rules("price_usd","Price USD","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
	
		// Entry Port Config to Server
		$name 		= $this->input->post("name");
		$price_idr 	= $this->input->post("price_idr");
		$price_usd 	= $this->input->post("price_usd");
		$data = array(
			"name" 		=> $name,
			"price_idr"	=> $price_idr,
			"price_usd"	=> $price_usd
			);
		$result = $this->db->insert("product",$data);
		if($result)
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Success...</div>";
		else
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed..Please Try Again..</div>";
	}

	public function product_edit($id = null)
	{
		if(!$id)
		{
			redirect("administrator/product");
		}
		$product = $this->db->get_where("product",array("id" => $id))->result();
		$data["title"] = "Edit Product";
		if(empty($product))
		{
			redirect("administrator/product");
		}

		foreach($product as $p)
		{
			$data["id"]			= $id;
			$data["name"] 		= $p->name;
			$data["price_idr"]	= $p->price_idr;
			$data["price_usd"]	= $p->price_usd;
		}

		$this->load->view("administrator/header",$data);
		$this->load->view("administrator/product_edit",$data);
		$this->load->view("administrator/footer");
	}

	public function product_edit_submit($id = null)
	{
		
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		
		if(!$id)
		{
			redirect("administrator/product");
		}

		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }	

		$this->form_validation->set_rules("name","Name","trim|required|xss_clean");
		$this->form_validation->set_rules("price_idr","Price IDR","trim|required|xss_clean");
		$this->form_validation->set_rules("price_usd","Price USD","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
	
		// Entry Port Config to Server
		$name 		= $this->input->post("name");
		$price_idr 	= $this->input->post("price_idr");
		$price_usd 	= $this->input->post("price_usd");
		$data = array(
			"name" 		=> $name,
			"price_idr"	=> $price_idr,
			"price_usd"	=> $price_usd
			);
		$this->db->where("id",$id);
		$result = $this->db->update("product",$data);
		if($result)
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Success...</div>";
		else
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Failed..Please Try Again..</div>";
	}

	public function product_multi_action()
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
			$result = $this->db->delete("product",array("id" => $config[$i]));
		}
		echo "Selected Products Have Been Deleted.";
	}

	/*======================== USER ============================== */
	public function user()
	{
		$data['title'] = "Users";
		
		//$data["user"] = $this->db->get_where("user",array("role"=>"MEMBER"))->result();
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

	public function user_create_submit()
	{
		
		if(empty($this->session->userdata["administrator"]))
		{
			exit("-1");
		}
		
		//Check Input From Ajax or Not
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("email","Email","trim|required|max_length[40]|xss_clean");
		$this->form_validation->set_rules("password","Password","trim|required|min_length[5]|max_length[40]|xss_clean");
		$this->form_validation->set_rules("credit_premium","Credit Premium","required|greater_than[-1]");
		$this->form_validation->set_rules("telp","No. Telepon","max_length[20]|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
		}
		else
		{
			$email 			= $this->input->post("email");
			$password 		= $this->input->post("password");
			$first			= $this->input->post("first_name");
			$last			= $this->input->post("last_name");
			$address		= $this->input->post("address");
			$credit_premium = $this->input->post("credit_premium");
			$facebook 		= $this->input->post("facebook");
			$telp 			= $this->input->post("telp");

			$data = array(
				"email"			=> $email,
				"password"		=> $password,
				"first_name"	=> $first,
				"last_name" 	=> $last,
				"credit_premium" => $credit_premium,
				"address" 		=> $address,
				"join_date"		=> date("Y-m-d H:i"),
				"role"			=> "MEMBER",
				"credit_free"	=> "1",
				"no_hp"			=> $telp,
				"facebook"		=> $facebook
				);

			$data_user = $this->db->get("user")->result();
			foreach($data_user as $user)
			{
				if($user->email == $email)
				{
					exit("<div class='alert alert-danger alert-dismisabble'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>ERROR !!. Email Exist !!!.</div>");
				}
			}

			$this->db->insert("user",$data);
			echo "
				<div class='alert alert-success alert-dismisabble'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<div class='row'>
						<p>Account Has Been Created</p>
					</div>
				</div>";
		}
	}

	public function user_edit($id = null)
	{
		if(!$id)
			redirect("administrator/user");
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
			$result = $this->db->delete("user",array("id" => $user[$i]));
			if($result)
				echo "<div class='alert alert-success'>User Deleted...</div>";
			else
				echo "<div class='alert alert-warning'>User Can not Be Deleted !!</div>";
			break;
		}
	}

}
