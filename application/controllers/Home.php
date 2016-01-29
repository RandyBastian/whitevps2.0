<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		//redirect("maintanence");
	}

	public function index()
	{
		$data["title"] = "Home";
		$this->db->where("flag",1);
		$this->db->order_by("name","asc");
		$data["server"] = $this->db->get("server")->result();

		$this->db->order_by("port","asc");
		$data["port"] = $this->db->get("configuration")->result();

		$data["sum_server"] = 0;
		$data["account_created"] = 0;
		$data["sum_server_asia"] = 0;
		$data["sum_server_europe"] = 0;
		$data["sum_server_us"] = 0;
		foreach($data["server"] as $row)
		{
			$data["sum_server"]++;
			if($row->location == "1")
			{
				$data["sum_server_asia"]++;
			}
			elseif($row->location == "2")
			{
				$data["sum_server_europe"]++;
			}
			elseif($row->location == "3")
			{
				$data["sum_server_us"]++;
			}
			$data["account_created"] = $data["account_created"] + $row->account_created;
		}

		$this->load->view("header",$data);
		$this->load->view('home',$data);
		$this->load->view("footer");
	}

	public function server($name = null)
	{
		if(!$name)
			redirect("home");
		$list_server = $this->db->get("server")->result();
		$data["server"] = $this->db->get_where("server",array("flag" => 1))->result();
		foreach($list_server as $row)
		{
			$name_server = strtolower($row->name);
			if($name_server == $name)
			{
				$data["id"] = $row->id;
				$id_server = $row->id;
				$data["name"] = $row->name;
				$data["host"] = $row->host;
				$data["max_day"] = $row->max_day;
				$data["squid"] = $row->squid_port;
				$data["title"] = $row->name;
				$data["expired"] = $row->expired_account;
			}
		}
		if(!$id_server)
			redirect("home");

		$data["port"]  = $this->db->get_where("configuration",array("id_server" => $id_server))->result();
		//var_dump($data["port"]);
		$this->load->view('header',$data);
		$this->load->view('server',$data);
		$this->load->view('footer');
	}

	public function server_create($id = null)
	{
		if(!$id) exit("Invalid Server..");
		//if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("username","Username","required|alpha_numeric|min_length[5]|xss_clean");
		$this->form_validation->set_rules("password","Password","required|alpha_numeric|min_length[5]|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
		
		
		$list_server = $this->db->get_where("server",array("id" => $id))->result();
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
			exit("Failed to Connect Server.");
		
		$username 		= $this->input->post("username");
		$password 		= $this->input->post("password");

		$account_expired 	= $account_expired + 1;
		$tanggal = date("Y-m-d", strtotime("+$account_expired day"));
		$whitevps_username = "white-vps.com-".$username;
		if($date_now == date("Y-m-d"))
		{
			if($available < 1)
				exit("FULL for this day. Try again tomorrow.");
		}
		elseif($date_now != date("Y-m-d"))
		{
			$available = $max_day;
			$date_now = date("Y-m-d");
		}
		
		//$callback 	= $this->ssh->execute("echo $whitevps_username:$password > /home/$username");
		//$callback1	= $this->ssh->execute("useradd -M -s /bin/false -e $tanggal $whitevps_username");
		//$callback2	= $this->ssh->execute("cat /home/$username | chpasswd");
	
		//if($callback && $callback1 && $callback2)
		if(1)
		{
			$this->db->where("id",$id);
			$this->db->update("server",array("date_now" => $date_now, "available_account" => $available - 1,"account_created" => $account_created + 1));
			echo "<p>Success.....</p>";
			echo "<p>Username : $whitevps_username</p>";
			echo "<p>Password : $password</p>";
			echo "<p>Expired Account : $tanggal 23:59</p>";
			//echo "Available Account : $available";
		}
		else
			exit("Cannot Create $whitevps_username. Try other username");
	}


}
