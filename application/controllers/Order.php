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
			redirect("order");
		}
		foreach($product as $p)
		{
			$product_id = $p->id;
			$price_idr 	= $p->price_idr;
			$price_usd 	= $p->Price_usd;
			$product_name = $p->name;
		}
		
		$transaction_details = array(
			"order_id" 			=> uniqid(),
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
		
		$user_id = $this->session->userdata["id_member"];
		$billing_address = array(
				
		);
	}
}