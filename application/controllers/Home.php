<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
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
		die("AAA");
		$data['title'] = 'HOME';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['notification']	= $this->Home_model->notification();	
		
		$isLoggedIn = $this->session->userdata("isLoggedIn");
		$validUser = $this->session->userdata("validUser");
		$validPass = $this->session->userdata("validPass");
		$validLevel = $this->session->userdata("validLevel");
		$validNama = $this->session->userdata("validNama");
		$validSession = $this->session->userdata("validSession");
		$validRole = $this->session->userdata("validRole");

		if(!$isLoggedIn){
			$data['title'] = 'LOGIN';
			$this->load->view('templates/header',$data);
			$this->load->view('main/index',$data);
			$this->load->view('templates/footer',$data);
		}else{
			$data['judul'] = 'HOME';
			$data['validUser'] = $validUser;
			$data['validNama'] = $validNama;
			$data['menu']='';
			$data['validUser']=$validUser;
			$data['validSession']=$validSession;
			$data['validLevel']=$validLevel;
			$this->load->view('templates/header',$data);
			$this->load->view('templates/hmenu',$data);
			$this->load->view('main/frmhome',$data);
			$this->load->view('templates/footer',$data);
			
		}
	}
	
	public function getDataRole()
	{
		$ID_USER = trim($this->input->post('USER_ID'));
		$cek=$this->Home_model->getDataRole($ID_USER);
		echo json_encode($cek);
	}
	
}
