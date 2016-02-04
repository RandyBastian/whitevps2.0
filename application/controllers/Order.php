<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $params = array('server_key' => 'VT-server-fPGukD0_jr5eyrMycAleC4xS', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		if(!empty($this->session->userdata["member"]))
		{
			
		}
		elseif(!empty($this->session->userdata["administrator"]))
		{
		    
		}
		else
		{
		    redirect("login");
		}
	}
	
	public function index()
	{
	    $data["title"] = "Order OpenVPN";
	    $data["order"] = $this->db->get("product")->result();
	    $this->load->view("member/header",$data);
	    $this->load->view("member/order",$data);
	    $this->load->view("member/footer");
	}
	
	public function process($id = null)
	{
		if(!$id)
		{
			redirect("order");
		}
		
		$product = $this->db->get_where("product",array("id" => $id))->result();
		if(empty($product))
		{
			redirect("logout");
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
		
		$this_time		= date("Y-m-d H:i:s");
		$invoice 		= "INVOICE-". strtoupper(hash('crc32',"$enkrip-$this_time"));
		// Entry to Database Transaction
		$data = array(
			"name"				=> 	$product_name,
			"price"				=> 	$price_idr,
			"transaction_date"	=> 	$this_time,
			"payment_date"		=>  "",
			"status"			=>  "PENDING",
			"invoice"			=>  $invoice,
			"id_user"			=>  $id_user,
			"keterangan"		=>  "",
			"price_type"		=>  "IDR",
			"payment_method"	=>  "",
			"flag"				=>	"0"
		);
		$this->db->insert("transaction",$data);
		
		// Transaction data
		$transaction_details = array(
			"order_id" 			=> $invoice,
			"gross_amount"		=> $price_idr
			);
		$items = [
			array(
				"id"		=> $product_id,
				"price"		=> $price_idr,
				"quantity"	=> 1,
				"name"		=> $product_name
			)
		];
		
		$billing_address = array(
			"first_name"	=> $first_name,
			"last_name"		=> $last_name,
			"address"		=> $address,
			"city"			=> $city,
			"portal_code"	=> $portal_code,
			"phone"			=> $phone,
			"county_code"	=> $country_code
		);
		
		$shipping_address = $billing_address;
		
		$customer_details = array(
			"first_name"		=> $first_name,
			"last_name"			=> $last_name,
			"email"				=> $email,
			"phone"				=> $phone,
			"billing_address" 	=> $billing_address,
			"shipping_address" 	=> $shipping_address
		);
		
		// Kirim data
		$transaction_data = array(
			"payment_type"		=> "vtweb",
			"vtweb"				=> array(
				"credit_card_3d_secure" => true,
				"enabled_payments"		=> array("bank_transfer", "credit_card","cstore")
			),
			"transaction_details"	=> $transaction_details,
			"item_details"			=> $items,
			"customer_details"		=> $customer_details
		);
		
		try
		{
			$vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
			header("Location: " . $vtweb_url);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function finish()
	{
		$data["title"] = "Transaction Finish";
		$this->load->view("member/header",$data);
		$data["pesan"] = "Transaction Finish. Please check your Payment Method for Detail.";
		$this->load->view("member/pesan",$data);
		$this->load->view("member/footer");
	}
	
	public function error()
	{
		$data["title"] = "Transaction Error";
		$this->load->view("member/header",$data);
		$data["pesan"] = "Error. Please check your Transaction for Detail.";
		$this->load->view("member/pesan",$data);
		$this->load->view("member/footer");
	}
}