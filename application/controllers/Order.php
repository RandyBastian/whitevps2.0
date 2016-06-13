<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        
	}
	
	public function index()
	{
	    $data["title"] 		= "Order OpenVPN";
	    $data["navigation"] = "order";
	    $data["order"] = $this->db->get("product")->result();
	    $this->load->view("header",$data);
	    $this->load->view("order",$data);
	    $this->load->view("footer");
	}
	
	public function process($id = null, $name = null)
	{
		if(!empty($this->session->userdata["member"]))
		{
			
		}
		elseif(!empty($this->session->userdata["partner"]))
		{

		}
		elseif(!empty($this->session->userdata["administrator"]))
		{

		}
		else
		{
			redirect("login");
		}
		if(!$id)
		{
			redirect("order");
		}
		$product = $this->db->get_where("product",array("id" => $id))->result();
		if(empty($product))
		{
			redirect("order");
		}
		foreach($product as $p)
		{
			$product_id 	= $p->id;
			$price_idr 		= $p->price_idr;
			$price_usd 		= $p->price_usd;
			$product_name 	= $p->name;
		}
		
		// Cek Valid User
		$user_id 	= $this->session->userdata["id_member"];
		$user 		= $this->db->get_where("user",array("id" => $user_id))->result();
		if(empty($user))
		{
			redirect("logout");
		}
		foreach($user as $u)
		{
			$first_name 		= $u->first_name;
			$last_name			= $u->last_name;
			$email				= $u->email;
			$address			= $u->address;
			$city				= $u->city;
			$portal_code 		= $u->portal_code;
			$phone				= $u->no_hp;
			$country_code		= "IDN";
			$id_user			= $u->id;
			$enkrip 			= hash("sha512", "$email-$id_user");
			$session_member		= $this->session->userdata["member"];
			if($enkrip != $session_member)
			{
				redirect("logout");
			}
		}

		//----------------------------------//
		
		$this_time		= date("Y-m-d H:i:s");
		$invoice 		= "VPN-". strtoupper(hash('crc32',"$enkrip-$this_time"));
		// Entry to Database Transaction
		$data = array(
			"name"				=> 	$product_name,
			"price"				=> 	$price_idr,
			"transaction_date"	=> 	$this_time,
			
			"status"			=>  "PENDING",
			"invoice"			=>  $invoice,
			"id_user"			=>  $id_user,
			"keterangan"		=>  "",
			"price_type"		=>  "IDR",
			"payment_method"	=>  "",
			"flag"				=>	"0"
		);
		$this->db->insert("transaction",$data);
		$data["invoice"]		= $invoice;
		$data["price_idr"]		= $price_idr;
		$data["title"] = "Finish Payment";
		$data["navigation"] = "";
		$this->load->view("header",$data);
		$this->load->view("rincian",$data);
		$this->load->view("payment");
		$this->load->view("footer");
		//Veritrans Module Here//
	}
	
	public function finish()
	{
		$data["title"] = "Transaction Finish";
		$data["navigation"]	= "";
		$this->load->view("header",$data);
		$data["pesan"] = "Transaction Finish. Please check your Payment Method for Detail.";
		$this->load->view("pesan",$data);
		$this->load->view("footer");
	}
	
	public function error()
	{
		$data["title"] = "Transaction Error";
		$data["navigation"]	= "";
		$this->load->view("header",$data);
		$data["pesan"] = "Error. Please check your Transaction for Detail.";
		$this->load->view("pesan",$data);
		$this->load->view("footer");
	}
}