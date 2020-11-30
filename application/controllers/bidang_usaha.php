<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bidang_usaha extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usaha_model','usaha');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('encrypt');
		
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title'] = 'Kelas';
		$data['menu'] = 'Kelas';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['total']  = $this->usaha->_getTotal_usaha();
		$data['notification']	= $this->usaha->notification();
	
		$this->load->view('templates/header',$data);
		$this->load->view('main/bidang_usaha',$data);	
		
	}

	public function gets()
	{
		$data = $this->usaha->gets($this->input->post());
		$result = array(); $no = 0;
		foreach($data->result() as $key => $value)
		{
			$row = array();$no++;
			$row[] 		= $no;
			$row[] 		= $value->bidang_usaha;
			$row[] 		= $value->nama_kategori;
			$row[] 		= $value->TOTAL . " Perusahaan";
			$edit_url 	= base_url()."bidang_usaha/edit/".$value->bdg_usaha_id;
			$row[] 		= '<a href="'.$edit_url.'" class="btn btn-simple btn-warning btn-icon edit">
							<i class="fa fa-edit"></i>
					  </a>
                      <button id="delete" personal-id="'. $value->bdg_usaha_id.'" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
                          <i class="fa fa-times"></i>
					  </button>';
			$result[] = $row;
		}
		$output = array(
			"draw" => 1,
			"recordsTotal" => count($data->result()),
			"recordsFiltered" => count($data->result()),
			"data" => $result,
		);
		//output to json format
		echo json_encode($output);
	}

	public function create()
	{
		$data['title'] = 'Create Bidang Usaha';
		$data['menu'] = 'Bidang Usaha';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['kategori'] = $this->usaha->_getKategori();
		$data['notification']	= $this->usaha->notification();

		$this->load->view('templates/header',$data);
		$this->load->view('main/bidang_usaha_create',$data);
	}

	public function edit($id)
	{
		$data['title'] 			= 'Edit Bidang Usaha';
		$data['menu'] 			= 'Bidang Usaha';
		$data['baseurl'] 		= base_url();
		$data['siteurl'] 		= site_url();
		$data['bidang_usaha']	= $this->usaha->_get($id);
		$data['kategori'] 		= $this->usaha->_getKategori();
		$data['notification']	= $this->usaha->notification();

		$this->load->view('templates/header',$data);
		$this->load->view('main/bidang_usaha_edit',$data);
	}

	public function submit($action)
	{
		if($action == "edit")
		{
			$data = $this->usaha->edit($this->input->post());
			$alert = array('teks'=>'<div class="alert-error text-center" role="alert"><b> UPDATE DATA GAGAL!</b></div>');
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> UPDATE DATA BERHASIL !</b></div>');
			}
			$this->session->set_flashdata($alert);
			$id = (int) $this->input->post("id");
			redirect(base_url()."bidang_usaha/edit/".$id);
		}

		if($action == "create")
		{
			$data = $this->usaha->create($this->input->post());
			$alert = array('teks'=>'<div class="alert-error text-center" role="alert"><b> CREATE DATA GAGAL!</b></div>');
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> CREATE DATA BERHASIL !</b></div>');
			}
			$this->session->set_flashdata($alert);
			redirect(base_url()."bidang_usaha/create");
		}

		if($action == "delete")
		{ 
			$data = $this->usaha->delete($this->input->post());
			$alert = array('teks'=>'<div class="alert-error text-center" role="alert"><b> DELETE DATA GAGAL!</b></div>');
			$return = array(
				"status" => 400,
				"text"   => "Request can not proccessed."
			);
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> DELETE DATA BERHASIL !</b></div>');
				$return = array(
					"status" => 200,
					"text"   => "Successfully"
				);

			}
			$this->session->set_flashdata($alert);
			echo json_encode($return);
		}
	}
	
	
}
