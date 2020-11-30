<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kategori_model','kategori');
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
		$data['title'] = 'Kategori';
		$data['menu'] = 'Kategori';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['notification']	= $this->kategori->notification();
	
		$this->load->view('templates/header',$data);
		$this->load->view('main/kategori',$data);
			
	}

	public function get_kategori()
	{
		$data = $this->kategori->get_kategori();
		$result = array(); $no = 0;
		foreach($data->result() as $key => $value)
		{
			$row = array();$no++;

			$edit_url = base_url()."Kategori/edit/". (int) $value->kategori_id;
			$row[] = $no;
			$row[] = html_escape($value->nama);
			$row[] = '<a href="'.$edit_url.'" class="btn btn-simple btn-warning btn-icon edit">
							<i class="fa fa-edit"></i>
					  </a>
                      <button id="delete" personal-id="'. $value->kategori_id.'" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
                          <i class="fa fa-times"></i>
					  </button>';
			$result[] = $row;
		}
		$output = array(
			"recordsTotal" => $this->kategori->count_all(),
			"recordsFiltered" => count($data->result()),
			"data" => $result,
		);
		//output to json format
		echo json_encode($output);

	}

	public function edit($id)
	{
		$data['title'] = 'Edit Kategori';
		$data['menu'] = 'Kategori';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['notification']	= $this->kategori->notification();

		$id = (int) $id;
		$return = $this->kategori->get_kategori($id);

		$data['data'] = $return->result();
		$this->load->view('templates/header',$data);
		$this->load->view('main/kategori_edit',$data);
	}

	public function create()
	{
		$data['title'] = 'Create Kategori';
		$data['menu'] = 'Kategori';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['notification']	= $this->kategori->notification();	
		$this->load->view('templates/header',$data);
		$this->load->view('templates/hmenu',$data);
		$this->load->view('main/kategori_create',$data);
	}

	public function submit($action)
	{
		if($action == "edit")
		{
			$data = $this->kategori->edit($this->input->post());
			$alert = array('teks'=>'<div class="alert-error text-center" role="alert"><b> UPDATE DATA GAGAL!</b></div>');
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> UPDATE DATA BERHASIL !</b></div>');
			}
			$this->session->set_flashdata($alert);
			$id = (int) $this->input->post("id");
			redirect(base_url()."Kategori/edit/".$id);
		}

		if($action == "create")
		{
			$data = $this->kategori->create($this->input->post());
			$alert = array('teks'=>'<div class="alert-error text-center" role="alert"><b> CREATE DATA GAGAL!</b></div>');
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> CREATE DATA BERHASIL !</b></div>');
			}
			$this->session->set_flashdata($alert);
			redirect(base_url()."Kategori/create");
		}

		if($action == "delete")
		{
			$data = $this->kategori->delete($this->input->post());
			$alert = array('teks'=>'<div class="alert-error text-center" role="alert"><b> DELETE DATA GAGAL!</b></div>');
			if($data)
			{
				$alert = array('teks'=>'<div class="alert-success text-center" role="alert"><b> DELETE DATA BERHASIL !</b></div>');
			}
			$this->session->set_flashdata($alert);
			echo json_encode(["result" => "always Fine."]);
		}
	}


	
	
	
}
