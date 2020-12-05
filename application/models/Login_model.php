<?php
	class Login_Model extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}
		public function Set_ANSI_NULLS(){
			$this->db->query('SET ANSI_NULLS ON');
			$this->db->query('SET ANSI_WARNINGS ON');
		}

		public function cekUser($user,$pass){
			//$query = $this->db->get_where('tbluser',array('USERID' => $user));
			
			#$query = $this->db->query("SELECT * FROM tbluser where userid='".$user."'");
			#if($query->num_rows()>0){
			#	$row = $query->row();
			#	$hash = $row->PASSWORD;
			#	if(password_verify($pass, $hash)) 
			#	{
			#	    return true;
			#	}else
			#	{
			#	    return false;
			#	}
			#}else{
			#	return false;	
			#}

			$this->db->where('userid',$user);
			$this->db->where('PASSWORD',md5($pass));
			$data = $this->db->count_all_results('tbluser');
			//print_r($this->db->last_query());die();
			if($data > 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		
	}
?>