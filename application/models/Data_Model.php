<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

    var $table = 'daftar_perusahaan';
    var $column_order = array('a.id','a.nm_perusahaan','a.ksop_id','a.bdgusaha_id','a.kategori_id','a.lokasi','a.koordinat','a.ter_tuk','a.sk','a.tgl_terbit','a.status','a.ms_berlaku'); //set column field database for datatable orderable
    var $column_search = array('a.id','a.nm_perusahaan','c.nama','d.nama','e.nama','a.lokasi','a.koordinat','a.ter_tuk','a.sk','a.tgl_terbit','a.status','a.ms_berlaku'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order 
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.*,b.name as nmprov,c.nama as nmksop,d.nama as nmusaha,e.nama as nmkateg');
        $this->db->from('daftar_perusahaan as a');
        $this->db->join('provinsi as b','a.provinsi_id=b.id','left');
        $this->db->join('ksop as c','a.ksop_id=c.ksop_id','left');
        $this->db->join('bdg_usaha as d','a.bdgusaha_id=d.bdg_usaha_id');
        $this->db->join('kategori as e','a.kategori_id=e.kategori_id','left');
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    //$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                //if(count($this->column_search) - 1 == $i) //last loop
                    //$this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_provinsi()
    {
        $this->db->cache_on();
        $this->db->from('wilayah');
        $this->db->where('length(kode) = 2');
        $this->db->order_by('kode','asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_kategori()
    {
        $this->db->from('kategori');
        $this->db->order_by('kategori_id','asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_bidangusaha()
    {
        $this->db->from('bdg_usaha');
        $this->db->order_by('bdg_usaha_id','asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_Kota($id)
    {
        $where = "";
        if(count($id) > 0)
        {
            $query =" WHERE (";
            foreach($id as $p)
            {
                $query = $query." (substr(kode,1,2) =".$p. " and kode!='".$p."') OR ";
            }
            $query = substr($query,0,-4);
            $where = $query.") AND LENGTH(kode) = 5 ORDER BY nama";
        
            $sql ="SELECT * from wilayah ".$where;
            $query= $this->db->query($sql);
                
            return $query->result(); 
        }
        else
        {
            return (object) [];
        }
       
    }

    public function get_Kota2($id)
    {
        
        $sql ="SELECT * from wilayah where substr(kode,1,2) = '".$id."' and kode!='".$id."' and length(kode) = 5  ORDER BY nama ASC";
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function get_Kecamatan($id)
    {
        $sql ="SELECT * from wilayah where length(kode) = 8 && substr(kode,1,5) = '".$id."' ORDER BY nama ASC";
       
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function get_Kecamatan2($id)
    {
        $sql ="SELECT * from wilayah where length(kode) = 5 and substr(kode,1,2) = '".$id."'  ORDER BY nama ASC";
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function get_Kelurahan($id)
    {
        $sql ="SELECT * from wilayah where length(kode) > 5 and substr(kode,1,5) = '".$id."' ORDER BY nama ASC";
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function get_Kelas($id)
    {
        $where = "";
        if(count($id) > 0)
        {
            $query =" WHERE (";
            foreach($id as $p)
            {
                $query = $query." ksop.provinsi_id ='".$p."' OR ";
            }
            $query = substr($query,0,-4);
            $where = $query.") ORDER BY ksop.provinsi_id ASC, ksop.order ASC";

            $sql ="SELECT * from ksop left join provinsi on ksop.provinsi_id=provinsi.id ".$where;
            $query= $this->db->query($sql);

            return $query->result();
            
        }
        else
        {
            return (object) array();
        }

         
    }

    public function get_Kelas2($id)
    {
       
        $sql ="SELECT * from ksop left join provinsi on ksop.provinsi_id=provinsi.id where provinsi_id ='".$id."'";
        $query= $this->db->query($sql);
            
        return $query->result(); 
    }

    public function DMStoDD($deg,$min,$sec)
    {

        // Converting DMS ( Degrees / minutes / seconds ) to decimal format
        return $deg+((($min*60)+($sec))/3600);
    }    


    public function create($data)
    {
        //echo "<pre>";print_r($data);die();
        $d_provinsi = "";
        for($i=0;$i<count($data['lokasi_f']);$i++)
        {
            $provinsi_f = "";
            if($data['provinsi_f'][$i] != "")
            {
                $dData = explode("|",$data['provinsi_f'][$i]);
                $provinsi_f = (int) $dData[0];
                $provinsi_text = $dData[1];
            }

            $kota_f = "";
            if($data['kota'][$i] != "")
            {
                $dData = explode("|",$data['kota'][$i]);
                $kota_f = $dData[0];
                $kota_text = $dData[1];
            }

            $kecamatan_f = "";
            if($data['kecamatan'][$i] != "")
            {
                $dData = explode("|",$data['kecamatan'][$i]);
                $kecamatan_f    = $dData[0];
                $kecamatan_text = $dData[1];
            }

            $kelurahan_f = "";
            if($data['kelurahan'][$i] != "")
            {
                $kelurahan_f = $data['kelurahan'][$i];
            }

            $spesifikasi = "";
            foreach($data['dermaga'][$i] as $key=>$val){ // Loop though one array
                
                $val2 = $data['spesifikasi'][$i][$key];
                $val3 = $data['peruntukan'][$i][$key]; 
                $val4 = $data['meter'][$i][$key];
                $val5 = $data['kapasitas'][$i][$key];
                $val6 = $data['satuan'][$i][$key];                 
                $spesifikasi .= "DERMAGA TIPE: ".$val .", SPESIFIKASI: " . $val2 .", KEDALAMAN: " .str_replace(" ","",$val4)." M LWS, PERUNTUKAN: " .$val3.", UKURAN MAKSIMUM " .$val5." ".$val6 . ". | ";
            
            }
            $spesifikasi        = substr($spesifikasi,0,-3);

            $bdgusaha_id        = (int) $data['bidangusaha'][$i];
            $_get_kategori_id   = $this->db->where('bdg_usaha_id',(int) $data['bidangusaha'])->get("bdg_usaha")->row();
            $kategori_id        = $_get_kategori_id->kategori_id;

            $insert_lokasi             = "";
            if($data['lokasi_f'][$i] != "")
            {
                $insert_lokasi .= strtoupper($data['lokasi_f'][$i]) . ", ";
            }
            if($kelurahan_f != "")
            {
                $insert_lokasi .= "KELURAHAN ". strtoupper($kelurahan_f).", ";
            }
            if($kecamatan_text && $kecamatan_text != "")
            {
                $insert_lokasi .= "KECAMATAN ". strtoupper($kecamatan_text).", ";
            }
            if($provinsi_text && $provinsi_text != "")
            {
                $insert_lokasi .= "PROVINSI ". strtoupper($provinsi_text).".";
            }

            $insert = array(
                "provinsi_id"           => $provinsi_f,
                "ksop_id"               => $data['kelas'][$i],
                "bdgusaha_id"           => $bdgusaha_id,
                "kategori_id"           => $kategori_id,
                "nm_perusahaan"         => $data['name'],
                "lokasi"                => $insert_lokasi,
                "lokasi_kota"           => $kota_f,
                "lokasi_kecamatan"      => $kecamatan_f,
                "lokasi_kelurahan"      => $kelurahan_f,
                "koordinat"             => $data["d_lat"][$i]."°-".$data['m_lat'][$i]."'-".$data['s_lat'][$i].".".$data['s_lat2'][$i]."\"".$data['direction_lat'][$i]."/". $data["d_long"][$i]."°-".$data['m_long'][$i]."'-".$data['s_long'][$i].".".$data['s_long'][$i]."\"BT",
                "koordinat_dd"          => $this->DMStoDD($data["d_lat"][$i],$data['m_lat'][$i],$data['s_lat'][$i].".".$data['s_lat2'][$i]) ." ". $this->DMStoDD($data["d_long"][$i],$data['m_long'][$i],$data['s_long'][$i].".".$data['s_long2'][$i]),
                "k_lat"                 => $this->DMStoDD($data["d_lat"][$i],$data['m_lat'][$i],$data['s_lat'][$i].".".$data['s_lat2'][$i]),
                "k_long"                => $this->DMStoDD($data["d_long"][$i],$data['m_long'][$i],$data['s_long'][$i].".".$data['s_lat2'][$i]),
                "ter_tuk"               => $data['tersus_tuks'][$i],
                "spesifikasi"           => html_escape($spesifikasi),
                "sk"                    => $this->security->xss_clean($data['nosk'][$i]),
                "jns_legalitas"         => $data['jenissk'][$i],
                "tgl_terbit"            => date("Y-m-d H:i:s",strtotime($data['tgl_terbit'][$i])),
                "ms_berlaku"            => date("Y-m-d H:i:s",strtotime($data['tgl_akhir'][$i])),
                "update_date"           => date("Y-m-d"),
                "status"                => $data['status'][$i]
    
            );

            try
            {
                $exec = $this->db->insert("daftar_perusahaan",$insert);
            }
            catch (\Exception $e) 
            {
                die($e->getMessage());
                //return FALSE;
            }
        }

        return $exec;
    }

    public function edit($data)
    {
        //echo "<pre>";print_r($data);die();
        $d_kota = "";
        if( $data['kota'] != "")
        {
            $d_kota = $data["kota"];
        }

        $d_kecamatan = "";
        if( $data['kecamatan'] != "")
        {
            $d_kecamatan = $data['kecamatan'];
        }

        $d_kelurahan = "";
        if($data['kelurahan'] != "")
        {
            $d_kelurahan = $data['kelurahan'];
        }

        $provinsi_f = "";$prov_nama = "";
        if($data['provinsi_f'] != "")
        {
            $dData = explode("|",$data['provinsi_f']);
            $provinsi_f = (int) $dData[0];
            $prov_nama  = $dData[1];
        }

       
        $spesifikasi = "";
        foreach($data['dermaga'] as $key=>$val){ // Loop though one array
            
            $val2 = $data['spesifikasi'][$key];
            $val3 = $data['peruntukan'][$key]; 
            $val4 = $data['meter'][$key];
            $val5 = $data['kapasitas'][$key];
            $val6 = $data['satuan'][$key];                 
            $spesifikasi .= "TIPE: ".$val .", SPESIFIKASI:" . $val2 .", KEDALAMAN: " .str_replace(" ","",$val4)." M LWS, PERUNTUKAN: " .$val3.", UKURAN MAKSIMUM " .$val5." ".$val6 . ". | ";
           
        }
        //echo "<pre>";print_r($d_kecamatan);die("<<<");
        $spesifikasi        = substr($spesifikasi,0,-3);

        $_get_kategori_id   = $this->db->where('bdg_usaha_id',(int) $data['bidangusaha'])->get("bdg_usaha")->row();

        $lok_kec            = $this->db->where("kode",$d_kecamatan)->get('wilayah')->row();
        $lok_kot            = $this->db->where("kode",$d_kota)->get('wilayah')->row();
        /* ------------ table update ---------------*/
        $provinsi_id        = $provinsi_f;
        $ksop_id            = (int) $data['wilayah_kerja'];
        $bdg_usaha_id       = (int) $data['bidangusaha'];
        $kategori_id        = $_get_kategori_id->kategori_id;        
        $nm_perusahaan      = trim($data['name']);
        $lokasi             = $data['lokasi_f'];
        $lokasi_kota        = $d_kota;
        $lokasi_kecamatan   = $d_kecamatan;
        $lokasi_kelurahan   = $d_kelurahan;
        //$alamat             = $data['alamat'];
        //$alamat_provinsi_id = $d_provinsi;        
        //$alamat_kelurahan   = $data['kelurahan'];
        //$alamat_kecamatan   = $data['kecamatan'];
        //$alamat_kodepos     = $data['kodepos'];
        //$alamat_email       = $data['email'];
        //$no_tlp             = $data['contactperson'];
        $koordinat          = $data["d_lat"]."°-".$data['m_lat']."'-".$data['s_lat'].".".$data['s_lat2']."\"".$data['direction_lat']."/". $data["d_long"]."°-".$data['m_long']."'-".$data['s_long'].".".$data['s_long2']."\"BT";
        $koordinat_dd       = $this->DMStoDD($data["d_lat"],$data['m_lat'],$data['s_lat'].".".$data['s_lat2']) ." ". $this->DMStoDD($data["d_long"],$data['m_long'],$data['s_long'].".".$data['s_long2']);
        $k_lat              = $this->DMStoDD($data["d_lat"],$data['m_lat'],$data['s_lat'].".".$data['s_lat2']);
        $k_long             = $this->DMStoDD($data["d_long"],$data['m_long'],$data['s_long'].".".$data['s_long2']);
        $ter_tuk            = $data['ter_tuk'];
        $spesifikasi        = $spesifikasi;
        $sk                 = $data['nosk'];
        $jns_legalitas      = $data['jenissk'];
        $tgl_terbit         = date("Y-m-d",strtotime($data['tgl_terbit']));
        $ms_berlaku         = date("Y-m-d",strtotime($data['tgl_akhir']));

        $data = $this->db->where("id",$data['_id'])->update("daftar_perusahaan",array(
            "provinsi_id"           => $provinsi_id,
            "ksop_id"               => $ksop_id,
            "bdgusaha_id"           => $bdg_usaha_id,
            "kategori_id"           => $kategori_id,
            "nm_perusahaan"         => $nm_perusahaan,
            "lokasi"                => $lokasi,
            "lokasi_kecamatan"      => $lokasi_kecamatan,
            "lokasi_kelurahan"      => $lokasi_kelurahan,
            //"alamat"                => $alamat,
            //"alamat_provinsi_id"    => $alamat_provinsi_id,
            //"alamat_kelurahan"      => $alamat_kelurahan,
            //"alamat_kecamatan"      => $alamat_kecamatan,
            //"alamat_kodepos"        => $alamat_kodepos,
            //"alamat_email"          => $alamat_email,
            //"no_tlp"                => $no_tlp,
            "koordinat"             => $koordinat,
            "koordinat_dd"          => $koordinat_dd,
            "k_lat"                 => $k_lat,
            "k_long"                => $k_long,
            "ter_tuk"               => $ter_tuk,
            "spesifikasi"           => $spesifikasi,
            "sk"                    => $sk,
            "jns_legalitas"         => $jns_legalitas,
            "tgl_terbit"            => date("Y-m-d",strtotime($tgl_terbit)),
            "ms_berlaku"            => date("Y-m-d",strtotime($ms_berlaku)),
            "update_date"           => date("Y-m-d"),
            "status"                => $data['status']

        ));

        return $data;


    }

    public function _getSingleData($id)
    {
        $data           = $this->db->where("id",$id)->get("daftar_perusahaan")->row();
        $kota           = $this->db->where("substr(kode,1,2)",$data->provinsi_id)->where("LENGTH(kode)",5)->get("wilayah")->result();
        $kecamatan      = $this->db->where("substr(kode,1,2)",$data->provinsi_id)->where("LENGTH(kode)",8)->get("wilayah")->result();
        $kelurahan      = $this->db->where("substr(kode,1,2)",$data->provinsi_id)->where("LENGTH(kode)>8")->get("wilayah")->result();
        $wilayah_kerja  = $this->db->where("provinsi_id",$data->provinsi_id)->get("ksop")->result();
       
        $alamat_kecamtan=  $this->db->where("substr(kode,1,2)",$data->alamat_provinsi_id)->where("LENGTH(kode)",5)->get("wilayah")->result();
        return array(
            "data" => $data,
            "kota"      => $kota,
            "kecamatan" => $kecamatan,
            "kelurahan" => $kelurahan,
            "wilayah_kerja" => $wilayah_kerja,
            "alamat_kecamatan" => $alamat_kecamtan
        );
    }

    public function _getspesifikasi($id)
    {
        $this->db->where("id",$id);
        $data = $this->db->get('daftar_perusahaan')->result();
        return $data;

    }

    public function check_sk($val)
    {
        $this->db->where("sk",trim($val));
        $data = $this->db->count_all_results("daftar_perusahaan");
        return $data;

    }

    public function jenis_sk()
    {
        $this->db->cache_on();
        return $this->db->get("jenis_sk")->result();
    }

    public function delete($data)
    {
        $this->db->cache_off();
        $data = $this->db->where("id",$data['id'])->update("daftar_perusahaan",array(
            "flag" => "0"
        ));
        return $data;
    }

    public function get_dermaga()
    {
        $this->db->cache_on();
        return $this->db->order_by("type","ASC")->get("dermaga_tipe")->result();
    }

    public function notification()
    {
        return $this->db->where("flag",1)->where("ms_berlaku < '".date('Y-m-d H:i:s')."'")->count_all_results("daftar_perusahaan");
    }

    public function notif_yellow()
    {
        return $this->db->or_where('ter_tuk','')->or_where('koordinat','')->or_where("lokasi",'')->or_where('sk','')->or_where('tgl_terbit','0000-00-000 00:00:00')->or_where('ms_berlaku','0000-00-000 00:00:00')->count_all_results("daftar_perusahaan");
    }

    public function _get_bidangusaha($data)
    {
        for($i=0;$i<count($data);$i++)
        {
            if($i = 0)
            {
                $this->db->where("kategori_id",$data['kategori'][$i]);
            }
            else
            {
                $this->db->or_where("kategori_id",$data['kategori'][$i]);
            }
        }
        $this->db->where('flag',1);
        $data = $this->db->get("bdg_usaha");
        return $data->result();
    }

    public function _get_kategori($data)
    {
        for($i=0;$i<count($data);$i++)
        {
            if($i = 0)
            {
                $this->db->where("bdg_usaha_id",$data['bidangusaha'][$i]);
            }
            else
            {
                $this->db->or_where("bdg_usaha_id",$data['bidangusaha'][$i]);
            }
        }
        $this->db->where('flag',1);
        $data = $this->db->get("bdg_usaha");
        return $data->result();
    }

   

}