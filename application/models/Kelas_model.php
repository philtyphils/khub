<?php
	class Kelas_model extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}
		
		public function get_kelas($post = array())
		{
		
			if(!empty($post['provinsi']) && $post['provinsi'] != "" )
			{
				$this->db->where("ksop.provinsi_id",(int) $post['provinsi']);
			}

			if(!empty($post['searchbox']) && $post['searchbox'] != "" )
			{
				$this->db->like("ksop.nama",trim(htmlentities($post['searchbox'])));
			}
			
			$this->db->where("LENGTH(wilayah.kode)",2);
			$this->db->where("ksop.flag","1");
            $this->db->select("ksop.ksop_id as ksop_id,ksop.nama as nama, wilayah.kode as provinsi_id, wilayah.nama as provinsi,");
            $this->db->join("wilayah","wilayah.kode=ksop.provinsi_id");
            $this->db->order_by("ksop.provinsi_id","ASC");
			$this->db->order_by("ksop.order","ASC");
			$data = $this->db->get('ksop');
			return $data;
        }
        
        public function wilayah_kerja()
        {
            $this->db->where("LENGTH(wilayah.kode)",2);
            $this->db->order_by("nama","ASC");
            $data = $this->db->get("wilayah");
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
			$temp = array(
				"1" => "OP",
				"2" => "KSOP KELAS I",
				"3" => "KSOP KELAS II",
				"4" => "KSOP KELAS III",
				"5" => "KSOP KELAS IV",
				"6" => "KSOP KELAS V",
				"100" => "KUPP KELAS I",
				"101" => "KUPP KELAS II",
				"102" => "KUPP KELAS III",
				"103" => "KUPP KELAS IV"
			);

			$nama 		= $temp[$data['kelas']] ." ". $data["name"];
			$provinsi 	= (int) $data['provinsi'];			
			
			$data = $this->db->insert("ksop",array(
				"provinsi_id" => $provinsi,
				"nama"		  => $nama,
				"order"		  => (int) $data['kelas'],
				"flag"		  => "1"
			));

			return $data;
		}

		public function delete($data)
		{ 
			$this->db->where("ksop_id",$data['id']);
			$data = $this->db->update("ksop",array(
				"flag" => "0"
			));
			return $data;
		}

		public function _get($id)
		{
			$id 	= (int) $id;
			$data 	= $this->db->where("ksop_id",$id)->get('ksop');
			return $data->result_array();

		}

		public function notification()
    	{
    	    return $this->db->where("flag",1)->where("ms_berlaku < '".date('Y-m-d H:i:s')."'")->count_all_results("daftar_perusahaan");
    	}
		
		
	}
?>