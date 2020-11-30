<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kelas_model','kelas');
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
		$data['wilayah_kerja'] = $this->kelas->wilayah_kerja();
		$data['notification']	= $this->kelas->notification();	
	
		$this->load->view('templates/header',$data);
		$this->load->view('main/Kelas',$data);	
		
	}

	public function get_kelas()
	{
		$data = $this->kelas->get_kelas($this->input->post());
		$result = array(); $no = 0;
		foreach($data->result() as $key => $value)
		{
			$row = array();$no++;
			$row[] = $no;
			$row[] = $value->nama;
			$row[] = $value->provinsi;
			$edit_url = base_url()."kelas/edit/".$value->ksop_id;
			$row[] = '<a href="'.$edit_url.'" class="btn btn-simple btn-warning btn-icon edit">
							<i class="fa fa-edit"></i>
					  </a>
                      <button id="delete" personal-id="'. $value->ksop_id.'" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
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
		$data['title'] = 'Create Wilayah Kerja';
		$data['menu'] = 'Wilayah Kerja';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['provinsi'] = $this->kelas->wilayah_kerja();
		$data['notification']	= $this->kelas->notification();	

		$this->load->view('templates/header',$data);
		$this->load->view('main/kelas_create',$data);
	}

	public function edit($id)
	{
		$data['title'] 			= 'Edit Wilayah Kerja';
		$data['menu'] 			= 'Wilayah Kerja';
		$data['baseurl'] 		= base_url();
		$data['siteurl'] 		= site_url();
		$data['provinsi'] 		= $this->kelas->wilayah_kerja();
		$data['kategori'] 		= $this->kelas->_get($id);
		$data['notification']	= $this->kelas->notification();	

		$this->load->view('templates/header',$data);
		$this->load->view('main/kelas_edit',$data);
	}

	public function submit($action)
	{
		if($action == "edit")
		{
			$data = $this->kelas->edit($this->input->post());
			$alert = array('teks'=>'<div class="alert-error text-center" role="alert"><b> UPDATE DATA GAGAL!</b></div>');
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> UPDATE DATA BERHASIL !</b></div>');
			}
			$this->session->set_flashdata($alert);
			$id = (int) $this->input->post("id");
			redirect(base_url()."kelas/edit/".$id);
		}

		if($action == "create")
		{
			$data = $this->kelas->create($this->input->post());
			$alert = array('teks'=>'<div class="alert-error text-center" role="alert"><b> CREATE DATA GAGAL!</b></div>');
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> CREATE DATA BERHASIL !</b></div>');
			}
			$this->session->set_flashdata($alert);
			redirect(base_url()."kelas/create");
		}

		if($action == "delete")
		{ 
			$data = $this->kelas->delete($this->input->post());
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
