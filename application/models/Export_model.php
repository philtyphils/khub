<?php
	class Export_model extends CI_Model {
		public function __construct(){
			$this->load->database();	
        }
        

        public function getProvinsi()
        {
            $data = $this->db->where("LENGTH(kode)",2)->get('wilayah');
            return $data;
        }

        public function getData($provinsi_id,$kategori_id,$wilayah_kerja,$bdgusaha_id)
        {
            
            $filter_session = array(
                'nm_perusahaan' => $this->session->userdata('nm_perusahaan'),
                'dermaga'       => $this->session->userdata('dermaga'),
                'kapasitas'     => $this->session->userdata('kapasistas'),
                'satuan'        => $this->session->userdata('satuan'),
                'ms_berlaku'    => $this->session->userdata('tglakhir'),
                'meter'         => $this->session->userdata('meter'),
                'status'        => $this->session->userdata('status'),
                'tukter'        => $this->session->userdata('tukter'),
                'expired'       => $this->session->userdata('expired'),
            );
           
            if($filter_session['nm_perusahaan'] != '')
            {
                $query = "(";
                $query .= "daftar_perusahaan.nm_perusahaan LIKE '%".$filter_session['nm_perusahaan']. "'%";
                $query .= ")";
                $this->db->where($query);
            }

            if($filter_session['dermaga'] != '')
            {
                $query = "(";
                $query .= "daftar_perusahaan.spesifikasi LIKE '%".$filter_session['dermaga']. "'%";
                $query .= ")";
                $this->db->where($query);
            }

            if($filter_session['kapasitas'] != '')
            {
                
                $query = "(";
                $query .= "daftar_perusahaan.spesifikasi LIKE '%".$filter_session['dermaga']. " " . $filter_session['satuan']."%'";
                $query .= ")";
                $this->db->where($query);
            }

            if($filter_session['ms_berlaku'] != '')
            {
                $query = "(";
                $query .= "daftar_perusahaan.ms_berlaku < '".date("Y-m-d H:i:s",strtotime("31-".$filter_session['ms_berlaku'])). "'";
                $query .= ")";
                $this->db->where($query);
            }

            if($filter_session['expired'])
            {
                $query = "(";
                $query .= "daftar_perusahaan.ms_berlaku < '".date("Y-m-d H:i:s"). "'";
                $query .= ")";
                $this->db->where($query);
            }

            if($filter_session['meter'] != '')
            {
                
                $query = "(";
                $query .= "daftar_perusahaan.spesifikasi LIKE '%".$filter_session['meter']. " M LWS%'";
                $query .= ")";
                $this->db->where($query);
            }

            if($filter_session['status'] != '')
            {
                
                $query = "(";
                $query .= "daftar_perusahaan.status = '".$filter_session['status']."'";
                $query .= ")";
                $this->db->where($query);
            }

            if($filter_session['tukter'] != '')
            {
                
                $query = "(";
                $query .= "daftar_perusahaan.ter_tuk = '".$filter_session['tukter']."'";
                $query .= ")";
                $this->db->where($query);
                unset($query);
            }
        
            if(count($provinsi_id) > 0)
            { 
                $query ="(";
                foreach($provinsi_id as $p)
                {
                    $query = $query."daftar_perusahaan.provinsi_id=".$p. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                $this->db->where($query);
            }

            if(count($kategori_id) > 0)
            {
                $query ="(";
                foreach($kategori_id as $p)
                {
                    $query = $query."daftar_perusahaan.kategori_id=".$p. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                $this->db->where($query);
                
            }

            
            if(count($wilayah_kerja) > 0)
            {
                $query ="(";
                foreach($wilayah_kerja as $p)
                {
                    $query = $query."daftar_perusahaan.ksop_id=".$p. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                $this->db->where($query);
                
            }

            if(count($bdgusaha_id) > 0)
            {
                $query ="(";
                foreach($bdgusaha_id as $p)
                {
                    $query = $query."daftar_perusahaan.bdgusaha_id=".$p. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                $this->db->where($query);
            }
            
            $this->db->where("LENGTH(wilayah.kode)","2");
            $this->db->join("wilayah","daftar_perusahaan.provinsi_id=wilayah.kode");
            $this->db->join("ksop","daftar_perusahaan.ksop_id=ksop.ksop_id");
            $this->db->join("bdg_usaha","daftar_perusahaan.bdgusaha_id=bdg_usaha.bdg_usaha_id");
            $this->db->join("kategori","daftar_perusahaan.kategori_id=kategori.kategori_id");
            $this->db->select("
                wilayah.nama as provinsi,
                ksop.nama as wilayah_kerja,
                daftar_perusahaan.nm_perusahaan as perusahaan,
                bdg_usaha.nama as bidang_usaha,
                kategori.nama as kategori,
                daftar_perusahaan.lokasi as lokasi,
                daftar_perusahaan.alamat as alamat,
                daftar_perusahaan.png_jwb as png_jwb,
                daftar_perusahaan.npwp as npwp,
                daftar_perusahaan.koordinat as koordinat,
                daftar_perusahaan.ter_tuk as ter_tuk,
                daftar_perusahaan.spesifikasi as spesifikasi,
                daftar_perusahaan.sk as legalitas,
                daftar_perusahaan.tgl_terbit as tgl_terbit,
                daftar_perusahaan.status as status,
                daftar_perusahaan.ms_berlaku as ms_berlaku,
                daftar_perusahaan.k_lat as latitude,
                daftar_perusahaan.k_long as longitude,
            ");
            $this->db->order_by("daftar_perusahaan.provinsi_id","asc");
            $this->db->order_by("ksop.order","ASC");
            $data = $this->db->get("daftar_perusahaan");
            return $data;
        }

        public function rekapProvinsi($provinsi_id,$kategori_id,$wilayah_kerja,$bdgusaha_id)
        {
            $query = ""; $prov_id = "";
            $filter_session = array(
                'nm_perusahaan' => $this->session->userdata('nm_perusahaan'),
                'dermaga'       => $this->session->userdata('dermaga'),
                'kapasitas'     => $this->session->userdata('kapasistas'),
                'satuan'        => $this->session->userdata('satuan'),
                'ms_berlaku'    => $this->session->userdata('tglakhir'),
                'meter'         => $this->session->userdata('meter'),
                'status'        => $this->session->userdata('status'),
                'tukter'        => $this->session->userdata('tukter'),
                'expired'       => $this->session->userdata('expired'),
            );
           
            if($filter_session['nm_perusahaan'] != '')
            {
                $query .= " AND (";
                $query .= "daftar_perusahaan.nm_perusahaan LIKE \'%".$filter_session['nm_perusahaan']. "\'%";
                $query .= ")";
            }

            if($filter_session['dermaga'] != '')
            {
                $query .= " AND (";
                $query .= "daftar_perusahaan.spesifikasi LIKE \'%".$filter_session['dermaga']. "\'%";
                $query .= ")";
            }

            if($filter_session['kapasitas'] != '')
            {
                
                $query = " AND (";
                $query .= "daftar_perusahaan.spesifikasi LIKE \'%".$filter_session['dermaga']. " " . $filter_session['satuan']."%\'";
                $query .= ")";
            }

            if($filter_session['ms_berlaku'] != '')
            {
                $query = " AND (";
                $query .= "daftar_perusahaan.ms_berlaku < \'".date("Y-m-d H:i:s",strtotime("31-".$filter_session['ms_berlaku'])). "\'";
                $query .= ")";
            }

            if($filter_session['expired'])
            {
                $query = " AND (";
                $query .= "daftar_perusahaan.ms_berlaku < \'".date("Y-m-d H:i:s"). "\'";
                $query .= ")";
            }

            if($filter_session['meter'] != '')
            {
                
                $query = " AND (";
                $query .= "daftar_perusahaan.spesifikasi LIKE \'%".$filter_session['meter']. " M LWS%\'";
                $query .= ")";
            }

            if($filter_session['status'] != '')
            {
                
                $query = " AND (";
                $query .= "daftar_perusahaan.status = \'".$filter_session['status']."\'";
                $query .= ")";
            }

            if($filter_session['tukter'] != '')
            {
                
                $query = " AND (";
                $query .= "daftar_perusahaan.ter_tuk = \'".$filter_session['tukter']."\'";
                $query .= ")";
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
                foreach($wilayah_kerja as $p)
                {
                    $query = $query."daftar_perusahaan.ksop_id=".$p. " OR ";
                }
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
           
            
            return $data;
        }

        public function rekapWilayahkerja($provinsi_id,$kategori_id,$wilayah_kerja,$bdgusaha_id)
        {
            $no = 0;
            $prov_total = count($provinsi_id);
            if ($prov_total > 0)
            {
                $query ="(";
                foreach($provinsi_id as $p)
                {
                    $query = $query."provinsi_id=".$p. " OR ";
                }
                $query = substr($query,0,-4);
                $query= $query.")";
                $this->db->where($query);
            }
           
            $data = $this->db->get('rekaptulasi_wilayah_kerja');
            return $data;
        }

        public function rekapKategori($provinsi_id,$kategori_id)
        {
            $no = 0;
            $prov_id = "NULL";
            if(count($provinsi_id) > 0)
            {
                $prov_id = "'" . implode(",",$provinsi_id) ."'";
            }

            $kat_id = "NULL";
            if(count($kategori_id) > 0)
            {
                $kat_id = "'" . implode(",",$kategori_id) ."'";
            }

            $data = $this->db->query("call store_kategori(".$prov_id.",".$kat_id.",NULL)");
            mysqli_next_result($this->db->conn_id);
            return $data->result_array();
        }
    }
?>