<?php
	class Dashboard_Model extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}
		
		public function status_aktif() 
		{
			$session_data = array(
       		    "nm_perusahaan" => $this->session->userdata('nm_perusahaan'),
       		    "provinsi"      => $this->session->userdata('provinsi'),
       		    "lokasi"        => $this->session->userdata('kota'),
       		    "wilayah_kerja" => $this->session->userdata('kelas'),
       		    "kategori"      => $this->session->userdata('kategori'),
				"bidangusaha"   => $this->session->userdata('bidangusaha'),
				"rn"			=> $this->session->userdata('expired'),
				"tukter"		=> $this->session->userdata('tukter'),
				"status"		=> $this->session->userdata('status'),
				"yn"			=> $this->session->userdata('YN')
			);

			//echo "<pre>";print_r($session_data);die();
			   
			$provinsi_id	= ($session_data['provinsi']) ? $session_data['provinsi'] : array();
			$kategori_id	= ($session_data['kategori']) ? $session_data['kategori'] : array();
			$wilayah_kerja	= ($session_data['wilayah_kerja']) ? $session_data['wilayah_kerja'] : array();
			$bdgusaha_id	= ($session_data['bidangusaha']) ? $session_data['bidangusaha'] : array();
			$RN				= ($session_data['rn']) ? $session_data['rn'] :"";
			$YN				= ($session_data['yn']) ? $session_data['yn'] :"";
			$query = ""; $prov_id = "";

			if($session_data['nm_perusahaan'] != "")
			{
				$query = " AND (";
				$query = $query . "daftar_perusahaan.nm_perusahaan LIKE \'%".$session_data['nm_perusahaan']."%\'";
				$query = $query . ")";
			}

			if($session_data['status'] != "")
			{
				$query = " AND (";
				$query = $query . "daftar_perusahaan.status = \'".$session_data['status']."\'";
				$query = $query . ")";
			}

			if($session_data['tukter'] != "")
			{
				$query = " AND (";
				$query = $query . "daftar_perusahaan.ter_tuk = \'".$session_data['tukter']."\'";
				$query = $query . ")";
			}

			if($YN != "")
			{
				$query =" AND (";
               
                $query = $query."daftar_perusahaan.ms_berlaku = '' AND daftar_perusahaan.koordinat = '' AND daftar_perusahaan.sk = '' AND daftar_perusahaan.tgl_terbit = ''";
                
                $query =  $query.")";
			}

			if($RN != "")
			{
				$query =" AND (";
               
                $query = $query.'daftar_perusahaan.ms_berlaku <= "'.date("Y-m-d H:i:s").'"';
                
                $query = $query.")";
			}

            if(count($provinsi_id) > 0)
            {
                $prov_id = "'" . implode(",",$provinsi_id) ."'";
            }
            if(count($kategori_id) > 0)
            {
                $query =" AND (";
                foreach($kategori_id as $p)
                {
                    $query = $query."daftar_perusahaan.kategori_id=".$p. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                
            }

            
            if(count($wilayah_kerja) > 0)
            {

                $query =" AND (";
                
              	$query = $query."daftar_perusahaan.ksop_id=".$wilayah_kerja. " OR ";
               
                $query = substr($query,0,-4);
                $query= $query.")";
                
            }

            if(count($bdgusaha_id) > 0)
            {
                $query =" AND (";
                foreach($bdgusaha_id as $p)
                {
                    $query = $query."daftar_perusahaan.bdgusaha_id=".$p. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
            }
            if($query == "" && $prov_id == "")
            {
				
                $data = $this->db->get('rekaptulasi_provinsi');
            }
            else
            {
                $prov_id = ($prov_id == "") ? "NULL" : $prov_id;
				$query  = ($query == "") ? "NULL" : "'".$query."'";
			
                $data = $this->db->query("call store_provinsi(".$prov_id.",".$query.")");
                mysqli_next_result($this->db->conn_id);
            }
		
			$tuks_aktif 		= 0;
			$tersus_aktif 		= 0;
			$tuks_nonaktif 		= 0;
			$tersus_nonaktif 	= 0;
			foreach($data->result() as $key => $value)
			{
				$tuks_aktif 		+= $value->TUKS_AKTIF;
				$tersus_aktif 		+= $value->TERSUS_AKTIF;
				$tuks_nonaktif 		+= $value->TUKS_NONAKTIF;
				$tersus_nonaktif 	+= $value->TERSUS_NONAKTIF;
			}

			$arr[] = (object) array(
				"TERSUS_AKTIF" => $tersus_aktif,
				"TUKS_AKTIF"   => $tuks_aktif,
				"TUKS_NONAKTIF"	=> $tuks_nonaktif,
				"TERSUS_NONAKTIF" => $tersus_nonaktif
			); 
    
            return $arr;
			//$this->db->select_sum('TERSUS_AKTIF');
			//$this->db->select_sum('TERSUS_NONAKTIF');
			//$this->db->select_sum('TUKS_AKTIF');
			//$this->db->select_sum('TUKS_NONAKTIF');
			//$data = $this->db->get('rekaptulasi_provinsi');
//
			//return $data;
		}

		public function getallstatus()
		{
			$this->db->cache_on();
			$data = $this->db->get('rekaptulasi_provinsi');

			return $data;
		}
		
		public function notification()
    	{
    	    return $this->db->where("flag",1)->where("ms_berlaku < '".date('Y-m-d H:i:s')."'")->count_all_results("daftar_perusahaan");
    	}
		
	}
?>