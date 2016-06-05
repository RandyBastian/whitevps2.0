<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Trik extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata["partner"]))
		{
			redirect("login");
		}
		
	}

	public function index()
	{
		$data['title'] = "My Trik & Tools";
		
		$data["trik"] = $this->db->get_where("trik",array("id_creator" => $this->session->userdata["id_partner"]))->result();

		$this->load->view("partner/header",$data);
		$this->load->view('partner/trik',$data);
		$this->load->view("partner/footer");
	}
	public function trik_create()
	{
		$data['title'] = "Create New Trik";
		$id = $this->session->userdata["id_partner"];
		
		$this->load->view("partner/header",$data);
		$this->load->view('partner/trik_create',$data);
		$this->load->view("partner/footer_trik");
	}

	public function trik_create_submit()
	{
		if(empty($this->session->userdata["partner"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("judul","Judul","trim|required|xss_clean");
		$this->form_validation->set_rules("isi","Isi","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}
	
		// Ambil data partner dari server
		$id 			= $this->session->userdata["id_partner"];
		
		$judul 		= $this->input->post("judul");
		$isi 		= $this->input->post("isi");
		
		// Insert ke trik Table
		$data = array (
			"id_creator" 	=> $id,
			"judul" 		=> $judul,
			"isi" 			=> $isi,
			"created_date" 	=> date("Y-m-d")
			);
		$this->db->insert("trik",$data);
		// Update Credit in User
		echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Trik telah ditambahkan !!.</div>";
	}

	public function trik_edit($id = null)
	{
		$id_user = $this->session->userdata["id_partner"];
		$trik = $this->db->get_where("trik", array("id" => $id))->result();
		if(empty($trik))
		{
			redirect("partner/trik");
		}
		foreach($trik as $row)
		{
			$data["id"] 			= $id;
			$data["judul"] 			= $row->judul;
			$data["isi"]			= $row->isi;
			$data["title"] 			= "Edit Trik";
			if($row->id_creator != $id_user)
			{
				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>trik Does Not Exist !!</div>";
				exit();
			}
		}

		$this->load->view("partner/header",$data);
		$this->load->view('partner/trik_edit',$data);
		$this->load->view("partner/footer_trik");
	}

	public function trik_edit_submit($id = null)
	{
		if(empty($this->session->userdata["partner"]))
		{
			exit("-1");
		}
		if (!$this->input->is_ajax_request()) { exit('ILLEGAL REQUEST or Active Your Javascript !!!!.'); }
		$this->form_validation->set_rules("judul","Judul","trim|required|xss_clean");
		$this->form_validation->set_rules("isi","Isi","trim|required|xss_clean");
		if($this->form_validation->run() == FALSE)
		{
			echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>".validation_errors()."</div>";
			exit();
		}

	
		$judul 		= $this->input->post("judul");
		$isi 		= $this->input->post("isi");
		
		// Insert ke trik Table
		$data = array (
			"judul" 		=> $judul,
			"isi" 			=> $isi
			);

		$this->db->where("id",$id);
		$this->db->update("trik",$data);
		// Echo hasil
		echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Trik telah diupdate !!!</div>";
	}

	public function trik_delete($id = null)
	{
		$this->db->where("id",$id);
		$this->db->delete("trik");
		redirect("partner/trik");
	}


}