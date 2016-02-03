<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notification extends CI_Controller {
    function __construct()
	{
		parent::__construct();
        $params = array('server_key' => 'VT-server-fPGukD0_jr5eyrMycAleC4xS', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
	}

    public function index()
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		if($result){
			$notif = $this->veritrans->status($result->order_id);
		}
		else
		{
		    exit("Error...");
		}

		$log = error_log(print_r($result,TRUE));
		

		//notification handler sample

		$transaction 		= $notif->transaction_status;
		$type 				= $notif->payment_type;
		$order_id 			= $notif->order_id;
		$this_time			= date("Y-m-d H:i:s");
		$data				= "";
		
		if ($transaction == 'capture') {
		  	// For credit card transaction, we need to check whether transaction is challenge by FDS or not
			if ($type == 'credit_card'){
			        $fraud = $notif->fraud_status;
			    	if($fraud == 'challenge'){
			      		//echo "Transaction order_id: " . $order_id ." is challenged by FDS";
			      		$data = array(
							"payment_date"		=>  "",
							"status"			=>  "CANCEL",
							"keterangan"		=>  "Transaction $order_id is challenged by FDS",
							"payment_method"	=>  ""	
						);
			      	}
			      	else {
			      		// TODO set payment status in merchant's database to 'Success'
			      		//echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
			      		$data = array(
							"payment_date"		=>  $this_time,
							"status"			=>  "PAID",
							"keterangan"		=>  "Transaction Success",
							"payment_method"	=>  $type
						);
			      	}
			}
		}
		else if ($transaction == 'settlement'){
		  	// TODO set payment status in merchant's database to 'Settlement'
		  	//echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  	$data = array(
				"payment_date"		=>  $this_time,
				"status"			=>  "PAID",
				"keterangan"		=>  "Transaction Success",
				"payment_method"	=>  $type	
				);
		} 
		else if($transaction == 'pending'){
		  	// TODO set payment status in merchant's database to 'Pending'
		  	//echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  	$data = array(
				"payment_date"		=>  "",
				"status"			=>  "PENDING",
				"keterangan"		=>  "Transaction Pending",
				"payment_method"	=>  $type	
				);
		} 
		else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  //echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		  $data = array(
				"payment_date"		=>  "",
				"status"			=>  "CANCEL",
				"keterangan"		=>  "Transaction Is Denied",
				"payment_method"	=>  $type	
				);
		}
		
		$this->db->where("invoice",$order_id);
		$this->db->update("transaction",$data);
		if($data["status"]	== "PAID")
		{
			// Ambil Nama dan ID user transaksi
			$transaction 		= $this->db->get_where("transaction",array("invoice" => $order_id))->result();
			foreach($transaction as $t)
			{
				$id_user		= $t->id_user;
				$name			= $t->name;
				if($t->status == "PAID")
				{
				    exit("This transaction Has Been PAID");
				}
			}
			// Ambil value untuk ditambahkan ke credit
			$product = $this->db->get_where("product",array("name" => $name))->result();
			foreach($product as $p)
			{
				$value		= $p->value;
			}
			
			$user	= $this->db->get_where("user",array("id" => $id_user))->result();
			foreach($user as $u)
			{
				$credit_premium	= $u->credit_premium; 
			}
			
			$credit_premium = $credit_premium + $value;
			$this->db->where("id",$id_user);
			$this->db->update("user",array("credit_premium" => $credit_premium));
		}
	}
}