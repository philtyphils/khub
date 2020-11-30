<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_Model','dashboard');
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
		$data['title'] = 'Dashboard';
		$data['menu'] = 'Dashboard';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		$data['notification']	= $this->dashboard->notification();	

		$r = $this->dashboard->status_aktif()->result();
		$f = $this->dashboard->getallstatus()->result();

		$provinsi = array();
		$tuks_aktif = array();
		$tersus_aktif = array();
		$tuks_nonaktif = array();
		$tersus_nonaktif = array();
		foreach ($f as $key => $value)
		{
			$provinsi[] =  $value->provinsi;
			$tuks_aktif[] = (int) $value->TUKS_AKTIF;
			$tuks_nonaktif[] = (int) $value->TUKS_NONAKTIF;
			$tersus_nonaktif[] = (int) $value->TERSUS_NONAKTIF;
			$ersus_aktif[] = (int) $value->TERSUS_AKTIF;
		}
		$tersus = array(
			array(
				"name" => "AKTIF",
				"y"    => (int) $r[0]->TERSUS_AKTIF
			),
			array(
				"name" => "NON AKTIF",
				"y"	   => (int) $r[0]->TERSUS_NONAKTIF
			)
		);

		$tuks = array(
			array(
				"name" => "AKTIF",
				"y"    => (int) $r[0]->TUKS_AKTIF
			),
			array(
				"name" => "NON AKTIF",
				"y"	   => (int) $r[0]->TUKS_NONAKTIF
			)
		);

		$data['tuks'] = json_encode($tuks);		
		$data['tersus'] = json_encode($tersus);
		$data['provinsi'] = json_encode($provinsi);
		$data['tuks_aktif'] = json_encode($tuks_aktif);
		$data['tuks_nonaktif'] = json_encode($tuks_nonaktif);
		$data['tersus_aktif'] = json_encode($tersus_aktif);
		$data['tersus_nonaktif'] = json_encode($tersus_nonaktif);
		$this->load->view('main/dashboard',$data);

		
	}
	
	
	
}
