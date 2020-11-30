<?php
	class Kategori_model extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}
		
		public function get_kategori($id = NULL)
		{
			if(!empty($id) && $id != "")
			{
				$this->db->where("kategori_id",(int) $id);
			}
			$this->db->where("flag",1);
			$data = $this->db->get('kategori');
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
			$nama = $data['name'];
			
			$this->db->where("kategori_id",$id);
			$data = $this->db->update("kategori",array(
				"nama" => $nama
			));

			return $data;
		}

		public function create($data)
		{
			$nama = $data['name'];
			
			$data = $this->db->insert("kategori",array(
				"nama" => $nama
			));

			return $data;
		}

		public function delete($data)
		{
			$id = (int) $data['id'];
			$this->db->where("kategori_id",$id);
			$data = $this->db->update("kategori",array(
				"flag" => "0"
			));

			return $data;
		}

		public function notification()
    	{
    	    return $this->db->where("flag",1)->where("ms_berlaku < '".date('Y-m-d H:i:s')."'")->count_all_results("daftar_perusahaan");
    	}
		
		
	}
?>