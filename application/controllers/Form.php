<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
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
		$data['title'] = 'Form';
		$data['menu'] = 'Form';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$this->load->view('templates/header',$data);
		// $this->load->view('templates/hmenu',$data);
		$this->load->view('main/form',$data);
	
	}
	
	
}
