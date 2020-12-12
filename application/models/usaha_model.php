<?php
	class usaha_model extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}
		
		public function _getTotal_usaha()
		{
			return $this->db->where('flag',1)->count_all_results("bdg_usaha");
		}
		
		public function gets($post = array())
		{
		
			//if(!empty($post['provinsi']) && $post['provinsi'] != "" )
			//{
			//	$this->db->where("ksop.provinsi_id",(int) $post['provinsi']);
			//}
//
			//if(!empty($post['searchbox']) && $post['searchbox'] != "" )
			//{
			//	$this->db->like("ksop.nama",trim(htmlentities($post['searchbox'])));
			//}
			//$this->db->where('flag',1);
			$query = "SELECT * FROM rekaptulasi_bidang_usaha ORDER BY if(kategori_id = '' or kategori_id is null,1,0), kategori_id ASC, bidang_usaha ASC, TOTAL DESC";
			$data = $this->db->query($query);
			//echo "<pre>";print_r($this->db->last_query());die();
			return $data;
        }
        
        public function _getKategori($id = NULL)
        {
			if($id != NULL)
			{
				$this->db->where("kategori_id",$id);
			}
            $this->db->order_by("nama","ASC");
            $data = $this->db->get("kategori");
            return $data;
		}
		
				public function count_all()
		{
			$data = $this->db->where("flag",1)->count_all_results("kategori");
			return $data;
		}

		public function edit($data)
		{
			$id = (int) $data['id'];
			$nama = $data['nama'];
			$kategori_id = $data['kategori_id'];
			
			$this->db->where("bdg_usaha_id",$id);
			$data = $this->db->update("bdg_usaha",array(
				"nama" => $nama,
				"kategori_id" => $kategori_id
			));

			return $data;
		}

		public function create($data)
		{
			
			$data = $this->db->insert("bdg_usaha",array(
				"kategori_id" => $data['kategori_id'],
				"nama"		  => $data['nama'],
				"flag"		  => "1"
			));

			return $data;
		}

		public function delete($data)
		{ 
			$this->db->where("bdg_usaha_id",$data['id']);
			$data = $this->db->update("bdg_usaha",array(
				"flag" => "0"
			));
			return $data;
		}

		public function _get($id)
		{
			$id 	= (int) $id;
			$data 	= $this->db->where("bdg_usaha_id",$id)->get('bdg_usaha');
			return $data->result_array();

		}

		public function notification()
    	{
			$this->db->cache_on();
    	    return $this->db->where("flag",1)->where("ms_berlaku < '".date('Y-m-d H:i:s')."'")->count_all_results("daftar_perusahaan");
		}
		
		public function notif_yellow()
    	{
			$this->db->cache_on();
    	    return $this->db->where('ter_tuk','')->or_where('koordinat','')->or_where("lokasi",'')->or_where('sk','')->or_where('tgl_terbit','0000-00-00 00:00:00')->or_where('ms_berlaku','0000-00-00 00:00:00')->count_all_results("daftar_perusahaan");
    	}
		
		
	}
?>