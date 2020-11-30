<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_Model');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('encrypt');
		//include("../service_billing/application/libraries/cryptojs-aes.php"); 
	
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
		$data['title'] = 'LOGIN';
		$data['baseurl'] = base_url();
		$data['siteurl'] = site_url();
		// $this->load->view('templates/header',$data);
		$this->load->view('main/login',$data);
		// $this->load->view('templates/footer',$data);
	}
	
	public function cekLogin()
	{
		$arrHasil = array();
		$user = trim($this->input->post('username'));
		$pass = trim($this->input->post('password'));

		$i = 0;
		$cek = $this->Login_Model->cekUser($user,$pass);
		if($cek==true)
		{
			$this->session->set_userdata(array("validUser" => $user,"isLoggedIn" => true));
			$arrHasil[0]["msg"] = "";
		}
		else
		{
			$arrHasil[0]["msg"] = "*Wrong username/password combination";
		}
		echo json_encode($arrHasil);
	}
		
	// public function ubah(){
	// 	$arrayx=array();
	// 	$username = $this->input->post('username');
	// 	$passlama =  $this->input->post('passlama');
	// 	$passbaru1 = $this->input->post('passbaru1');
	// 	$passbaru2 = $this->input->post('passbaru2');
	// 	$cek = $this->login_model->cekUser($username,$passlama);
	// 	if($cek===false){
	// 		$arrayx[0]['status']="Not Found";
	// 		echo json_encode($arrayx);
	// 	}else{	
	// 		$cek2 = $this->login_model->ubahUser($username,$passbaru2);
	// 		echo json_encode($cek2);
			
	// 	}			
		
	// }
}
?>
