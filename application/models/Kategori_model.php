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
			$this->db->order_by("(CASE WHEN nama = '' THEN 1 ELSE 0 END)");
			$this->db->order_by("nama","ASC");
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
			$this->db->cache_delete_all();
			$this->db->where("kategori_id",$id);
			$data = $this->db->update("kategori",array(
				"nama" => $nama
			));

			return $data;
		}

		public function create($data)
		{
			$nama = $data['name'];
			$this->db->cache_delete_all();
			$data = $this->db->insert("kategori",array(
				"nama" => $nama
			));

			return $data;
		}

		public function delete($data)
		{
			$id = (int) $data['id'];
			$this->db->cache_delete_all();
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
		
		public function notif_yellow()
    	{
    	    return $this->db->or_where('ter_tuk','')->or_where('koordinat','')->or_where("lokasi",'')->or_where('sk','')->or_where('tgl_terbit','0000-00-000 00:00:00')->or_where('ms_berlaku','0000-00-000 00:00:00')->count_all_results("daftar_perusahaan");
    	}
		
	}
?>