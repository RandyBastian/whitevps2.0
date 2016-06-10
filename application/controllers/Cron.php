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
			}
		}
	}

	// Cek Transaksi Setiap 5 menit sekali
	public function transaksi()
	{
		
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