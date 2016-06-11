<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cron extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        
	}

	// Cek mutasi berjalan sempurna Sejam Sekali //
	public function cek_mutasi_jalan(){
		$info_bank 		= $this->db->get("info_bank")->result();
		$date 	 		= date("Y-m-d H:i:s",strtotime("-2 hour"));
		foreach($info_bank as $i)
		{
			if($i->update_date < $date)
			{
				// KIrim Email karena Script mutasi tidak berfungsi
				$this->_kirim_email($i->nama);
			}
		}
	}

	// Cek Transaksi Setiap 5 menit sekali
	public function transaksi()
	{
		$transaksi 	= $this->db->get_where("transaction",array("status" => "PENDING"))->result();
		$bank 		= $this->db->get_where("bank",array("status" => "0"))->result();

		foreach($bank as $b)
		{
			foreach($transaksi as $t)
			{
				if($t->price == $b->value)
				{
					// Tambah Credit User
					$product 	= $this->db->get_where("product",array("name" => $t->name))->result();
					$user 		= $this->db->get_where("user",array("id" => $t->id_user))->result();
					if(!empty($product))
					{
						foreach($product as $p)
						{
							$credit 	= $p->value;
						}
					}
					if(!empty($user))
					{
						foreach($user as $u)
						{
							$user_credit 	= $u->credit_premium;
							$email 			= $u->email;
						}
					}

					$this->db->where("id",$t->id_user);
					$this->db->update("user",array("credit_premium" => $user_credit + $credit));

					// Update Status Transaksi
					$this->db->where("id",$t->id);
					$this->db->update("transaction",array("status" => "PAID"));

					// Update Status Bank
					$this->db->where("id",$b->id);
					$this->db->update("bank",array("status" => "1"));

					// Kirim Email
					$this->_kirim_email_pembayaran($t->invoice, $email);

				}
			}
		}
	}


	// Kirim EMail Pembayaran//
	public function _kirim_email_pembayaran($invoice = null, $email = null)
	{
		// Send Email setting
		$config["protocol"]	= 'smtp';
		$config['smtp_host']	= "ssl://smtp.zoho.com";
		$config["smtp_port"]	= 465;
		$config["smtp_user"]	= "pembayaran@white-vps.com";
		$config["smtp_pass"]	= "Bast27Randy!";
		
		// Load email library and passing configured values to email library
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		// Sender email address
		$this->email->from("pembayaran@white-vps.com", "Pembayaran WHITE-VPS");
		// Subject of email
		$this->email->subject("Info Pembayaran");
		$this->email->set_mailtype("html");
		// Message in email
		$data["info"] = "Invoice : $invoice telah dibayar !.<br>Terima kasih.";
		$html_email = $this->load->view("email_pembayaran",$data,true);
		$this->email->message($html_email);
		
		//Ambil file
		$this->email->to($email);
		if ($this->email->send()) {
			//echo "Email Successfully Send !<br>";
			$data["pesan"] = "SUCCESS";
		}
		else
		{
		    //echo "<p class='error_msg'>Check Your account or Connection !</p>";
		    $data["pesan"] = "ERROR";
		}
	}

	// Kirim Email Error Mutasi //
	public function _kirim_email($bank = null)
	{
		$config["protocol"]	= 'smtp';
		$config['smtp_host']	= "ssl://smtp.zoho.com";
		$config["smtp_port"]	= 465;
		$config["smtp_user"]	= "no_reply@white-vps.com";
		$config["smtp_pass"]	= "randy27bast";
		
		// Load email library and passing configured values to email library
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		// Sender email address
		$this->email->from("no_reply@white-vps.com", "No Reply WHITE-VPS");
		// Subject of email
		$this->email->subject("Informasi Error Mutasi $bank");
		$this->email->set_mailtype("html");
		// Message in email
		$data["error"] = "Mutasi Bank $bank Terganggu !!!. Segera Cek !!!";
		$html_email = $this->load->view("email_error",$data,true);
		$this->email->message($html_email);
		
		//Ambil file
		$this->email->to('randy.bastbast@gmail.com');
		if ($this->email->send()) {
			//echo "Email Successfully Send !<br>";
			$data["pesan"] = "SUCCESS";
		}
		else
		{
		    //echo "<p class='error_msg'>Check Your account or Connection !</p>";
		    $data["pesan"] = "ERROR";
		}

	}


	// ==== Dijalankan Sekali Saja ==== //
	public function delete_expired_account()
	{
		$expired 	= date("Y-m-d",strtotime("-5 day"));
		$account 	= $this->db->get("account")->result();
		foreach($account as $a)
		{
			if($a->expired_date < $expired)
			{
				$this->db->delete("account",array("username" => $a->username));
			}
		} 
	}

	public function entry_session_account()
	{
		$server 		= $this->db->get("server")->result();
		$account 		= $this->db->get("account")->result();

		foreach($server as $s)
		{
			foreach($account as $a)
			{
				$data = array(
					"username" 		=> $a->username,
					"ip_address"	=> $s->host
					);
				$this->db->insert("session_account",$data);
			}
		}
	}

	public function delete_transaction()
	{
		$transaksi 	= $this->db->get_where("transaction",array("status" => "PENDING"))->result();
		foreach($transaksi as $t)
		{
			if($t->transaction_date < date("Y-m-d",strtotime("-5 day"))
			{
				$this->db->delete("transaction",array("id" => $t->id));
			}
		}
	}

}