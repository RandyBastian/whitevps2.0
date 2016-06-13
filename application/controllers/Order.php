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
			$user_id 	= $this->session->userdata["id_member"];
			$email 		= $this->session->userdata["member"];
		}
		elseif(!empty($this->session->userdata["partner"]))
		{
			$user_id 	= $this->session->userdata["id_partner"];
			$email 		= $this->session->userdata["partner"];
		}
		elseif(!empty($this->session->userdata["administrator"]))
		{
			$user_id 	= $this->session->userdata["id_administrator"];
			$email 		= $this->session->userdata["administrator"];
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
			$price 			= $p->price_idr;
			$product_name 	= $p->name;
		}
		//Cek Price Random 3 Digit //
		$uniq_number 	= rand(1,999);
		$cek_price 		= $this->db->get_where("transaction",array("status" => "PENDING","price" => $price + $uniq_number))->result();
		$no = 1;
		while(!empty($cek_price))
		{
			if($no == 990)
			{
				$uniq_number = rand(1000,2000);	
				break;
			}
			$uniq_number 	= rand(1,999);
			$cek_price 		= $this->db->get_where("transaction",array("status" => "PENDING","price" => $price + $uniq_number))->result();
			$no++;
		}
		//----------------------------------//
		$this_time		= date("Y-m-d H:i:s");
		$invoice 		= "VPN-". strtoupper(hash('crc32',"$email-$this_time"));
		// Entry to Database Transaction
		$data = array(
			"name"				=> 	$product_name,
			"price"				=> 	$price + $uniq_number,
			"transaction_date"	=> 	$this_time,
			"status"			=>  "PENDING",
			"invoice"			=>  $invoice,
			"id_user"			=>  $user_id,
			"keterangan"		=>  "",
			"price_type"		=>  "IDR",
			"payment_method"	=>  "",
			"flag"				=>	"0"
		);
		$this->db->insert("transaction",$data);
		$data["invoice"]		= $invoice;
		$data["price"]			= $price;
		$data["uniq_number"]	= $uniq_number;
		$data["price_total"]	= $price + $uniq_number;
		$data["title"] 			= "Transaksi Berhasil";
		$data["product"]		= $product_name;
		$data["navigation"] 	= "";
		$this->load->view("header",$data);
		$this->load->view("rincian",$data);
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

	public function testing()
	{
		$data["title"] = "Rincian";
		$this->load->view("header",$data);
		$this->load->view("rincian",$data);
		$this->load->view("footer");
	}
}